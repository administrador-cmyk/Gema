import type {
  RemediationKey,
  StabilityCheckResult,
  StabilityEvent,
  StabilityRecommendation,
  StabilitySeverity,
  StabilityStatus,
  StabilityTarget
} from "./types";

function severityForLatency(target: StabilityTarget, latencyMs?: number): StabilitySeverity {
  if (latencyMs === undefined) {
    return "info";
  }

  if (target.criticalLatencyMs !== undefined && latencyMs >= target.criticalLatencyMs) {
    return "critical";
  }

  if (target.warningLatencyMs !== undefined && latencyMs >= target.warningLatencyMs) {
    return "warning";
  }

  return "info";
}

function severityForValue(target: StabilityTarget, value?: number): StabilitySeverity {
  if (value === undefined) {
    return "info";
  }

  if (target.criticalThreshold !== undefined && value >= target.criticalThreshold) {
    return "critical";
  }

  if (target.warningThreshold !== undefined && value >= target.warningThreshold) {
    return "warning";
  }

  return "info";
}

function statusForSeverity(severity: StabilitySeverity): StabilityStatus {
  if (severity === "critical" || severity === "incident") {
    return "critical";
  }

  if (severity === "warning") {
    return "degraded";
  }

  return "healthy";
}

function remediationForTarget(target: StabilityTarget): RemediationKey | undefined {
  if (target.source === "wordpress" && target.kind === "http") {
    return "purge-wordpress-cache";
  }

  if (target.source === "api") {
    return "enable-degraded-mode";
  }

  if (target.source === "security") {
    return "block-abusive-ip";
  }

  if (target.source === "capacity") {
    return "create-internal-ticket";
  }

  return undefined;
}

export function evaluateTargetResult(
  target: StabilityTarget,
  checkedAt: string,
  params: {
    latencyMs?: number;
    observedValue?: number;
    ok: boolean;
    message: string;
    evidence: string[];
  }
): StabilityCheckResult {
  const latencySeverity = severityForLatency(target, params.latencyMs);
  const valueSeverity = severityForValue(target, params.observedValue);
  const severityOrder: Record<StabilitySeverity, number> = {
    info: 0,
    warning: 1,
    critical: 2,
    incident: 3
  };
  const thresholdSeverity =
    severityOrder[valueSeverity] > severityOrder[latencySeverity] ? valueSeverity : latencySeverity;
  const severity = params.ok ? thresholdSeverity : "incident";

  return {
    id: `${target.id}-${Date.parse(checkedAt)}`,
    targetId: target.id,
    label: target.label,
    source: target.source,
    kind: target.kind,
    status: params.ok ? statusForSeverity(severity) : "critical",
    severity,
    checkedAt,
    latencyMs: params.latencyMs,
    observedValue: params.observedValue,
    unit: target.unit,
    message: params.message,
    evidence: params.evidence,
    remediationKey: remediationForTarget(target)
  };
}

export function eventsFromChecks(checks: StabilityCheckResult[]): StabilityEvent[] {
  return checks
    .filter((check) => check.severity !== "info")
    .map((check) => ({
      id: `event-${check.id}`,
      checkId: check.id,
      severity: check.severity,
      source: check.source,
      title: check.label,
      summary: check.message,
      detectedAt: check.checkedAt,
      risk: riskForCheck(check),
      recommendation: recommendationForCheck(check),
      requiresHumanApproval: check.severity === "critical" || check.severity === "incident",
      remediationKey: check.remediationKey
    }));
}

export function recommendationsFromEvents(events: StabilityEvent[]): StabilityRecommendation[] {
  return events.map((event) => ({
    id: `rec-${event.id}`,
    severity: event.severity,
    title: `Revisar ${event.title}`,
    explanation: event.risk,
    nextAction: event.recommendation,
    canAutoRemediate: Boolean(event.remediationKey) && !event.requiresHumanApproval,
    remediationKey: event.remediationKey,
    createdAt: event.detectedAt
  }));
}

function riskForCheck(check: StabilityCheckResult): string {
  if (check.source === "capacity") {
    return "Riesgo de que el recurso quede chico y provoque degradacion o caida si la tendencia continua.";
  }

  if (check.source === "security") {
    return "Riesgo de ataque, fuerza bruta, abuso de endpoints o bloqueo por consumo anomalo.";
  }

  if (check.source === "api") {
    return "Riesgo de perdida de operaciones, formularios o respuestas del asistente por saturacion de API.";
  }

  if (check.source === "wordpress") {
    return "Riesgo de que usuarios y buscadores no puedan acceder al sitio comercial o a paginas criticas.";
  }

  return "Riesgo de degradacion operativa que debe revisarse antes de afectar usuarios.";
}

function recommendationForCheck(check: StabilityCheckResult): string {
  if (check.source === "capacity") {
    return "Revisar tendencia, liberar recursos y preparar escalamiento con aprobacion humana.";
  }

  if (check.source === "security") {
    return "Revisar logs, identificar origen y aplicar rate limit o bloqueo temporal si corresponde.";
  }

  if (check.source === "api") {
    return "Activar modo degradado, revisar latencia, errores y capacidad antes de escalar infraestructura.";
  }

  if (check.source === "wordpress") {
    return "Verificar cache, estado del servidor, PHP, base de datos y respuesta publica.";
  }

  return "Revisar evidencia, confirmar impacto y registrar accion correctiva.";
}
