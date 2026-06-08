import { CUMBRE_APP_ID } from "../firebaseConfig";
import type { StabilityCheckResult, StabilitySeverity, StabilitySnapshot, StabilityStatus } from "./types";

export function stabilityCollectionPath(tenantId: string, collection: "checks" | "events" | "recommendations" | "notifications" | "remediation") {
  return ["artifacts", CUMBRE_APP_ID, "users", tenantId, `stability_${collection}`] as const;
}

export function statusFromSeverity(severity: StabilitySeverity): StabilityStatus {
  if (severity === "incident") {
    return "critical";
  }

  if (severity === "critical") {
    return "critical";
  }

  if (severity === "warning") {
    return "degraded";
  }

  return "healthy";
}

export function highestSeverity(checks: StabilityCheckResult[]): StabilitySeverity {
  const order: Record<StabilitySeverity, number> = {
    info: 0,
    warning: 1,
    critical: 2,
    incident: 3
  };

  return checks.reduce<StabilitySeverity>(
    (current, check) => (order[check.severity] > order[current] ? check.severity : current),
    "info"
  );
}

export function buildSnapshot(tenantId: string, checks: StabilityCheckResult[]): StabilitySnapshot {
  const severity = highestSeverity(checks);

  return {
    tenantId,
    status: statusFromSeverity(severity),
    severity,
    generatedAt: new Date().toISOString(),
    checks,
    events: [],
    recommendations: [],
    notifications: []
  };
}
