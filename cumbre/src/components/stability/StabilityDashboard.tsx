import { proposeRemediation } from "../../lib/stability/remediation";
import type { StabilityCheckResult, StabilitySeverity, StabilitySnapshot } from "../../lib/stability/types";
import { useStabilityCenter } from "../../lib/stability/useStabilityCenter";
import {
  CumbreActionButton,
  CumbreBadge,
  CumbreMetricCard,
  CumbrePageHeader,
  CumbrePanel,
  cumbreShellClass,
  cx
} from "../design/CumbreDesignSystem";

interface StabilityDashboardProps {
  tenantId?: string;
}

const severityStyles: Record<StabilitySeverity, string> = {
  info: "border-slate-700 bg-slate-900/80 text-slate-100",
  warning: "border-amber-500/70 bg-amber-950/70 text-amber-100",
  critical: "border-red-500/70 bg-red-950/70 text-red-100",
  incident: "border-fuchsia-500/70 bg-fuchsia-950/70 text-fuchsia-100"
};

function formatMetric(check: StabilityCheckResult) {
  if (check.latencyMs !== undefined) {
    return `${check.latencyMs} ms`;
  }

  if (check.observedValue !== undefined) {
    return `${check.observedValue}${check.unit ? ` ${check.unit}` : ""}`;
  }

  return "Registrado";
}

function statusCopy(snapshot: StabilitySnapshot | null) {
  if (!snapshot) {
    return "Sin medicion";
  }

  if (snapshot.status === "healthy") {
    return "Sistema saludable";
  }

  if (snapshot.status === "degraded") {
    return "Advertencias tempranas";
  }

  return "Riesgo critico";
}

export default function StabilityDashboard({ tenantId }: StabilityDashboardProps) {
  const { snapshot, loading, error, refresh } = useStabilityCenter(tenantId);
  const criticalEvents = snapshot?.events.filter((event) => event.severity === "critical" || event.severity === "incident") ?? [];
  const remediationProposals = criticalEvents.map(proposeRemediation);

  return (
    <main className={cx(cumbreShellClass, "p-6")}>
      <CumbrePageHeader
        eyebrow="Centro de Estabilidad Cumbre"
        title="Radar operativo, seguridad y anticipacion de fallas"
        description="Monitorea WordPress, APIs, Firebase, seguridad, capacidad, costos y señales de saturacion. El agente IA resume riesgos y propone acciones antes de que el sistema se caiga."
        actions={
          <CumbreActionButton disabled={loading} tone="cyan" onClick={() => void refresh()}>
            {loading ? "Chequeando..." : "Ejecutar checks"}
          </CumbreActionButton>
        }
      />

      {error && <p className="mt-4 rounded-2xl border border-red-500 bg-red-950 p-3 text-red-100">{error}</p>}

      <section className="my-6 grid gap-4 md:grid-cols-4">
        <CumbreMetricCard label="Estado general" value={statusCopy(snapshot)} detail={snapshot?.severity ?? "Sin severidad"} tone="emerald" />
        <CumbreMetricCard label="Checks" value={snapshot?.checks.length ?? 0} detail="Sondas activas" tone="cyan" />
        <CumbreMetricCard label="Eventos" value={snapshot?.events.length ?? 0} detail="Riesgos detectados" tone="amber" />
        <CumbreMetricCard label="Notificaciones" value={snapshot?.notifications.length ?? 0} detail="Canales preparados" tone="violet" />
      </section>

      <section className="mb-6 grid gap-4 xl:grid-cols-[1.2fr_0.8fr]">
        <CumbrePanel>
          <div className="mb-4 flex flex-wrap items-center justify-between gap-3">
            <h2 className="text-xl font-black text-white">Checks de estabilidad</h2>
            <CumbreBadge tone="cyan">{snapshot?.checks.length ?? 0} checks</CumbreBadge>
          </div>
          <div className="grid gap-3">
            {(snapshot?.checks ?? []).map((check) => (
              <article key={check.id} className={`rounded-xl border p-4 ${severityStyles[check.severity]}`}>
                <div className="flex flex-wrap justify-between gap-3">
                  <div>
                    <h3 className="font-semibold">{check.label}</h3>
                    <p className="mt-1 text-sm opacity-90">{check.message}</p>
                  </div>
                  <span className="rounded-full border border-current px-3 py-1 text-sm">{formatMetric(check)}</span>
                </div>
                <ul className="mt-3 list-disc space-y-1 pl-5 text-sm opacity-90">
                  {check.evidence.map((evidence) => (
                    <li key={evidence}>{evidence}</li>
                  ))}
                </ul>
              </article>
            ))}
          </div>
        </CumbrePanel>

        <CumbrePanel tone="emerald">
          <div className="mb-4 flex flex-wrap items-center justify-between gap-3">
            <h2 className="text-xl font-black text-white">Agente IA de estabilidad</h2>
            <CumbreBadge>IA preventiva</CumbreBadge>
          </div>
          <div className="space-y-3">
            {(snapshot?.recommendations ?? []).slice(0, 6).map((recommendation) => (
              <article key={recommendation.id} className={`rounded-xl border p-4 ${severityStyles[recommendation.severity]}`}>
                <h3 className="font-semibold">{recommendation.title}</h3>
                <p className="mt-2 text-sm opacity-90">{recommendation.explanation}</p>
                <p className="mt-2 text-sm font-medium">{recommendation.nextAction}</p>
              </article>
            ))}
            {snapshot && snapshot.recommendations.length === 0 && (
              <p className="rounded-xl border border-emerald-700 bg-emerald-950 p-4 text-emerald-100">
                Sin recomendaciones criticas. El sistema queda en vigilancia preventiva.
              </p>
            )}
          </div>
        </CumbrePanel>
      </section>

      <section className="grid gap-4 lg:grid-cols-2">
        <CumbrePanel tone="cyan">
          <h2 className="mb-4 text-xl font-black text-white">Notificaciones preparadas</h2>
          <div className="space-y-3">
            {(snapshot?.notifications ?? []).map((notification) => (
              <article key={notification.id} className="rounded-xl border border-slate-700 p-3">
                <div className="flex justify-between gap-3">
                  <strong>{notification.channel}</strong>
                  <span className="text-sm text-slate-400">{notification.deliveryStatus}</span>
                </div>
                <p className="mt-1 text-sm text-slate-300">{notification.body}</p>
              </article>
            ))}
            {snapshot && snapshot.notifications.length === 0 && <p className="text-slate-400">No hay notificaciones pendientes.</p>}
          </div>
        </CumbrePanel>

        <CumbrePanel tone="amber">
          <h2 className="mb-4 text-xl font-black text-white">Remediacion controlada</h2>
          <div className="space-y-3">
            {remediationProposals.map((proposal) => (
              <article key={proposal.eventId} className="rounded-xl border border-slate-700 p-3">
                <strong>{proposal.action.label}</strong>
                <p className="mt-1 text-sm text-slate-300">{proposal.reason}</p>
                <p className="mt-2 text-sm text-slate-400">{proposal.action.runbook}</p>
              </article>
            ))}
            {remediationProposals.length === 0 && (
              <p className="text-slate-400">No hay remediaciones criticas propuestas. Las acciones sensibles quedan bloqueadas por aprobacion humana.</p>
            )}
          </div>
        </CumbrePanel>
      </section>
    </main>
  );
}
