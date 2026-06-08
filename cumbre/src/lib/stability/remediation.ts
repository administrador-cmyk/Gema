import type { RemediationAction, RemediationKey, StabilityEvent } from "./types";

export const REMEDIATION_ACTIONS: Record<RemediationKey, RemediationAction> = {
  "purge-wordpress-cache": {
    key: "purge-wordpress-cache",
    label: "Limpiar cache WordPress/LiteSpeed",
    description: "Purga cache si una pagina publica degrada latencia o devuelve contenido stale.",
    automaticAllowed: true,
    requiresHumanApproval: false,
    runbook: "Ejecutar purge controlado y volver a medir latencia antes de escalar."
  },
  "restart-non-critical-service": {
    key: "restart-non-critical-service",
    label: "Reiniciar servicio no critico",
    description: "Reinicia un worker o servicio auxiliar cuando falla health check consecutivo.",
    automaticAllowed: false,
    requiresHumanApproval: true,
    runbook: "Confirmar servicio, revisar logs, reiniciar y verificar health check."
  },
  "pause-background-jobs": {
    key: "pause-background-jobs",
    label: "Pausar trabajos no criticos",
    description: "Reduce carga temporal pausando tareas batch, importaciones o jobs secundarios.",
    automaticAllowed: true,
    requiresHumanApproval: false,
    runbook: "Pausar jobs no criticos, proteger flujo principal y reactivar al normalizar recursos."
  },
  "disable-failing-integration": {
    key: "disable-failing-integration",
    label: "Desactivar integracion fallida",
    description: "Aisla una integracion externa que provoca errores o timeouts.",
    automaticAllowed: false,
    requiresHumanApproval: true,
    runbook: "Confirmar impacto con negocio, desactivar integracion y activar fallback manual."
  },
  "enable-degraded-mode": {
    key: "enable-degraded-mode",
    label: "Activar modo degradado",
    description: "Mantiene funciones esenciales aunque falle IA, API externa o servicio auxiliar.",
    automaticAllowed: true,
    requiresHumanApproval: false,
    runbook: "Registrar leads y operaciones esenciales sin depender del servicio degradado."
  },
  "block-abusive-ip": {
    key: "block-abusive-ip",
    label: "Bloquear IP abusiva",
    description: "Bloquea origen de fuerza bruta, scraping agresivo o abuso de endpoints.",
    automaticAllowed: false,
    requiresHumanApproval: true,
    runbook: "Validar IP/origen, aplicar bloqueo temporal y monitorear falsos positivos."
  },
  "create-internal-ticket": {
    key: "create-internal-ticket",
    label: "Crear ticket interno",
    description: "Genera una tarea con evidencia para resolver capacidad, costo o seguridad.",
    automaticAllowed: true,
    requiresHumanApproval: false,
    runbook: "Asignar responsable, registrar evidencia y fecha objetivo de resolucion."
  }
};

export interface RemediationProposal {
  eventId: string;
  action: RemediationAction;
  status: "ready" | "needs-approval" | "not-available";
  reason: string;
}

export interface RemediationExecutionResult {
  proposal: RemediationProposal;
  executedAt: string;
  executed: boolean;
  message: string;
}

export function proposeRemediation(event: StabilityEvent): RemediationProposal {
  if (!event.remediationKey) {
    return {
      eventId: event.id,
      action: REMEDIATION_ACTIONS["create-internal-ticket"],
      status: "not-available",
      reason: "El evento no tiene remediacion automatica asignada."
    };
  }

  const action = REMEDIATION_ACTIONS[event.remediationKey];

  if (action.requiresHumanApproval || event.requiresHumanApproval) {
    return {
      eventId: event.id,
      action,
      status: "needs-approval",
      reason: "La accion puede afectar produccion o seguridad y requiere aprobacion humana."
    };
  }

  if (action.automaticAllowed) {
    return {
      eventId: event.id,
      action,
      status: "ready",
      reason: "Accion incluida en allowlist de remediacion automatica controlada."
    };
  }

  return {
    eventId: event.id,
    action,
    status: "needs-approval",
    reason: "La accion no esta habilitada para ejecucion automatica."
  };
}

export async function executeSafeRemediation(proposal: RemediationProposal): Promise<RemediationExecutionResult> {
  const executedAt = new Date().toISOString();

  if (proposal.status === "needs-approval") {
    return {
      proposal,
      executedAt,
      executed: false,
      message: "Remediacion bloqueada: requiere aprobacion humana antes de tocar produccion."
    };
  }

  if (proposal.status === "not-available") {
    return {
      proposal,
      executedAt,
      executed: false,
      message: "No existe remediacion automatica para este evento; se debe crear ticket interno."
    };
  }

  return {
    proposal,
    executedAt,
    executed: true,
    message: `Remediacion preparada en modo seguro: ${proposal.action.label}. La integracion real debe ejecutarse desde agente servidor con auditoria.`
  };
}
