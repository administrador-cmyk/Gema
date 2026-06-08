import type { StabilityCheckResult, StabilityEvent, StabilitySeverity } from "./types";

export interface SecurityObservation {
  id: string;
  label: string;
  count: number;
  windowMinutes: number;
  warningThreshold: number;
  criticalThreshold: number;
  evidence: string[];
}

export interface SecurityConfigurationAudit {
  id: string;
  label: string;
  passed: boolean;
  severity: StabilitySeverity;
  evidence: string[];
  recommendation: string;
}

export const DEFAULT_SECURITY_OBSERVATIONS: SecurityObservation[] = [
  {
    id: "wp-login-attempts",
    label: "Intentos contra wp-login/XML-RPC",
    count: 0,
    windowMinutes: 10,
    warningThreshold: 30,
    criticalThreshold: 100,
    evidence: ["Pendiente de conectar logs OpenLiteSpeed/LiteSpeed o WAF."]
  },
  {
    id: "api-rate-limit",
    label: "Requests API con riesgo de rate limit",
    count: 0,
    windowMinutes: 10,
    warningThreshold: 250,
    criticalThreshold: 800,
    evidence: ["Pendiente de conectar logs de API Gateway, Cloud Run o Traefik."]
  },
  {
    id: "auth-failures",
    label: "Fallos de autenticacion repetidos",
    count: 0,
    windowMinutes: 10,
    warningThreshold: 20,
    criticalThreshold: 80,
    evidence: ["Pendiente de conectar Firebase Auth audit logs."]
  }
];

function severityForObservation(observation: SecurityObservation): StabilitySeverity {
  if (observation.count >= observation.criticalThreshold) {
    return "critical";
  }

  if (observation.count >= observation.warningThreshold) {
    return "warning";
  }

  return "info";
}

export function securityEventsFromObservations(observations: SecurityObservation[], checkedAt: string): StabilityEvent[] {
  return observations
    .filter((observation) => severityForObservation(observation) !== "info")
    .map((observation) => {
      const severity = severityForObservation(observation);

      return {
        id: `security-${observation.id}-${Date.parse(checkedAt)}`,
        checkId: observation.id,
        severity,
        source: "security",
        title: observation.label,
        summary: `${observation.count} eventos en ${observation.windowMinutes} minutos.`,
        detectedAt: checkedAt,
        risk: "Puede indicar fuerza bruta, abuso de API, credenciales atacadas o crawler agresivo.",
        recommendation: "Revisar origen, aplicar rate limit, bloquear IPs abusivas y confirmar que no haya usuarios comprometidos.",
        requiresHumanApproval: severity === "critical",
        remediationKey: severity === "critical" ? "block-abusive-ip" : "create-internal-ticket"
      };
    });
}

export function securityChecksFromObservations(
  observations: SecurityObservation[],
  checkedAt: string
): StabilityCheckResult[] {
  return observations.map((observation) => {
    const severity = severityForObservation(observation);

    return {
      id: `security-check-${observation.id}-${Date.parse(checkedAt)}`,
      targetId: observation.id,
      label: observation.label,
      source: "security",
      kind: "security-signal",
      status: severity === "info" ? "healthy" : severity === "warning" ? "degraded" : "critical",
      severity,
      checkedAt,
      observedValue: observation.count,
      unit: `eventos/${observation.windowMinutes}m`,
      message:
        severity === "info"
          ? `${observation.label}: sin anomalias conectadas por ahora.`
          : `${observation.label}: ${observation.count} eventos detectados.`,
      evidence: observation.evidence,
      remediationKey: severity === "critical" ? "block-abusive-ip" : "create-internal-ticket"
    };
  });
}

export function auditFirestoreRules(rulesSource: string): SecurityConfigurationAudit {
  const hasCatchAllAllow =
    /match\s+\/\{document=\*\*\}[\s\S]*allow\s+(read|write|read,\s*write)\s*:\s*if\s+true\s*;/.test(rulesSource);
  const hasPublicWrite = /allow\s+(write|read,\s*write)\s*:\s*if\s+true\s*;/.test(rulesSource);
  const hasDenyFallback = /match\s+\/\{document=\*\*\}[\s\S]*allow\s+read,\s*write:\s*if\s+false\s*;/.test(rulesSource);

  if (hasCatchAllAllow || hasPublicWrite) {
    return {
      id: "firestore-global-allow",
      label: "Reglas Firestore abiertas",
      passed: false,
      severity: "critical",
      evidence: ["Se detecto allow read/write if true en reglas Firestore."],
      recommendation: "Cerrar reglas globales y limitar acceso por tenant/admin antes de produccion."
    };
  }

  if (!hasDenyFallback) {
    return {
      id: "firestore-missing-deny-fallback",
      label: "Fallback deny ausente",
      passed: false,
      severity: "warning",
      evidence: ["No se detecto una regla final de denegacion explicita."],
      recommendation: "Agregar fallback deny para rutas no contempladas."
    };
  }

  return {
    id: "firestore-rules-baseline",
    label: "Reglas Firestore base",
    passed: true,
    severity: "info",
    evidence: ["No se detectaron reglas globales abiertas y existe fallback deny."],
    recommendation: "Mantener revision en cada cambio de reglas."
  };
}

export function configurationEventsFromAudits(audits: SecurityConfigurationAudit[], checkedAt: string): StabilityEvent[] {
  return audits
    .filter((audit) => !audit.passed)
    .map((audit) => ({
      id: `config-${audit.id}-${Date.parse(checkedAt)}`,
      checkId: audit.id,
      severity: audit.severity,
      source: "security",
      title: audit.label,
      summary: audit.evidence.join(" "),
      detectedAt: checkedAt,
      risk: "Una configuracion insegura puede exponer datos, permitir abuso o ampliar el impacto de un incidente.",
      recommendation: audit.recommendation,
      requiresHumanApproval: true,
      remediationKey: "create-internal-ticket"
    }));
}
