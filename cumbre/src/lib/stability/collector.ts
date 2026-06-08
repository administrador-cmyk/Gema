import { doc, getDoc, serverTimestamp, setDoc } from "firebase/firestore";

import { CUMBRE_APP_ID, db } from "../firebaseConfig";
import { enrichSnapshotWithAi } from "./aiAgent";
import { notificationsFromEvents } from "./notifications";
import { evaluateTargetResult, eventsFromChecks, recommendationsFromEvents } from "./rules";
import { DEFAULT_SECURITY_OBSERVATIONS, securityChecksFromObservations, securityEventsFromObservations } from "./security";
import { DEFAULT_STABILITY_TARGETS } from "./targets";
import type { StabilityCheckResult, StabilitySeverity, StabilitySnapshot, StabilityTarget } from "./types";

async function runHttpTarget(target: StabilityTarget, checkedAt: string): Promise<StabilityCheckResult> {
  const startedAt = performance.now();

  if (!target.url) {
    return evaluateTargetResult(target, checkedAt, {
      ok: false,
      message: "El target HTTP no tiene URL configurada.",
      evidence: ["Configurar URL antes de activar el check."]
    });
  }

  try {
    await fetch(target.url, {
      method: "HEAD",
      mode: "no-cors",
      cache: "no-store"
    });

    const latencyMs = Math.round(performance.now() - startedAt);

    return evaluateTargetResult(target, checkedAt, {
      ok: true,
      latencyMs,
      message: `${target.label} respondio al chequeo de red en ${latencyMs} ms.`,
      evidence: [
        `URL: ${target.url}`,
        "Modo navegador no-cors: confirma alcance de red, el status HTTP exacto debe validarlo el agente servidor."
      ]
    });
  } catch (error) {
    const latencyMs = Math.round(performance.now() - startedAt);

    return evaluateTargetResult(target, checkedAt, {
      ok: false,
      latencyMs,
      message: `${target.label} no respondio al chequeo de red.`,
      evidence: [error instanceof Error ? error.message : "Error de red desconocido.", `URL: ${target.url}`]
    });
  }
}

async function runFirestoreReadTarget(
  target: StabilityTarget,
  tenantId: string,
  checkedAt: string
): Promise<StabilityCheckResult> {
  const startedAt = performance.now();

  try {
    const probeRef = doc(db, "artifacts", CUMBRE_APP_ID, "users", tenantId, "stability_runtime", "read_probe");
    await getDoc(probeRef);
    const latencyMs = Math.round(performance.now() - startedAt);

    return evaluateTargetResult(target, checkedAt, {
      ok: true,
      latencyMs,
      message: `Firestore respondio lectura controlada en ${latencyMs} ms.`,
      evidence: [`Ruta probe: artifacts/${CUMBRE_APP_ID}/users/${tenantId}/stability_runtime/read_probe`]
    });
  } catch (error) {
    const latencyMs = Math.round(performance.now() - startedAt);

    return evaluateTargetResult(target, checkedAt, {
      ok: false,
      latencyMs,
      message: "Firestore no permitio completar la lectura controlada.",
      evidence: [error instanceof Error ? error.message : "Error Firestore desconocido."]
    });
  }
}

async function runFirestoreWriteTarget(
  target: StabilityTarget,
  tenantId: string,
  checkedAt: string
): Promise<StabilityCheckResult> {
  const startedAt = performance.now();

  try {
    const probeRef = doc(db, "artifacts", CUMBRE_APP_ID, "users", tenantId, "stability_runtime", "write_probe");
    await setDoc(
      probeRef,
      {
        checkedAt,
        updatedAt: serverTimestamp(),
        source: "cumbre-stability-center"
      },
      { merge: true }
    );

    const latencyMs = Math.round(performance.now() - startedAt);

    return evaluateTargetResult(target, checkedAt, {
      ok: true,
      latencyMs,
      message: `Firestore acepto escritura controlada en ${latencyMs} ms.`,
      evidence: [`Ruta probe: artifacts/${CUMBRE_APP_ID}/users/${tenantId}/stability_runtime/write_probe`]
    });
  } catch (error) {
    const latencyMs = Math.round(performance.now() - startedAt);

    return evaluateTargetResult(target, checkedAt, {
      ok: false,
      latencyMs,
      message: "Firestore no permitio completar la escritura controlada.",
      evidence: [error instanceof Error ? error.message : "Error Firestore desconocido."]
    });
  }
}

function runServerAgentTarget(target: StabilityTarget, checkedAt: string): StabilityCheckResult {
  return evaluateTargetResult(target, checkedAt, {
    ok: true,
    message: `${target.label} pendiente de conectar con agente servidor.`,
    evidence: [
      "Este check requiere metricas de VM, GCP Monitoring, logs, SSL o costos.",
      "El panel ya reserva el target y no ejecuta acciones destructivas desde navegador."
    ]
  });
}

export async function runStabilityChecks(
  tenantId: string,
  targets: StabilityTarget[] = DEFAULT_STABILITY_TARGETS
): Promise<StabilitySnapshot> {
  const checkedAt = new Date().toISOString();
  const checks = await Promise.all(
    targets.map((target) => {
      if (target.requiresServerAgent) {
        return Promise.resolve(runServerAgentTarget(target, checkedAt));
      }

      if (target.kind === "http") {
        return runHttpTarget(target, checkedAt);
      }

      if (target.kind === "firebase-read") {
        return runFirestoreReadTarget(target, tenantId, checkedAt);
      }

      if (target.kind === "firebase-write") {
        return runFirestoreWriteTarget(target, tenantId, checkedAt);
      }

      return Promise.resolve(
        evaluateTargetResult(target, checkedAt, {
          ok: true,
          message: `${target.label} registrado para fase de integracion avanzada.`,
          evidence: ["Check reservado para Cloud Functions o Cloud Run."]
        })
      );
    })
  );

  const securityChecks = securityChecksFromObservations(DEFAULT_SECURITY_OBSERVATIONS, checkedAt);
  const allChecks = [...checks, ...securityChecks];
  const events = [...eventsFromChecks(allChecks), ...securityEventsFromObservations(DEFAULT_SECURITY_OBSERVATIONS, checkedAt)];
  const recommendations = recommendationsFromEvents(events);
  const severityOrder: Record<StabilitySeverity, number> = { info: 0, warning: 1, critical: 2, incident: 3 };
  const severity = allChecks.reduce<StabilitySeverity>(
    (current, check) => (severityOrder[check.severity] > severityOrder[current] ? check.severity : current),
    "info"
  );

  return enrichSnapshotWithAi({
    tenantId,
    status: severity === "info" ? "healthy" : severity === "warning" ? "degraded" : "critical",
    severity,
    generatedAt: checkedAt,
    checks: allChecks,
    events,
    recommendations,
    notifications: notificationsFromEvents(events)
  });
}
