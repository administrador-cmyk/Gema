export type StabilitySeverity = "info" | "warning" | "critical" | "incident";

export type StabilityStatus = "healthy" | "degraded" | "critical" | "unknown";

export type StabilitySignalSource =
  | "wordpress"
  | "api"
  | "firebase"
  | "storage"
  | "ssl"
  | "capacity"
  | "security"
  | "cost"
  | "remediation";

export type StabilityCheckKind =
  | "http"
  | "firebase-read"
  | "firebase-write"
  | "storage"
  | "ssl-expiry"
  | "resource-capacity"
  | "security-signal"
  | "cost-quota";

export interface StabilityTarget {
  id: string;
  label: string;
  source: StabilitySignalSource;
  kind: StabilityCheckKind;
  url?: string;
  expectedStatus?: number;
  warningLatencyMs?: number;
  criticalLatencyMs?: number;
  warningThreshold?: number;
  criticalThreshold?: number;
  unit?: string;
  requiresServerAgent?: boolean;
  description: string;
}

export interface StabilityCheckResult {
  id: string;
  targetId: string;
  label: string;
  source: StabilitySignalSource;
  kind: StabilityCheckKind;
  status: StabilityStatus;
  severity: StabilitySeverity;
  checkedAt: string;
  latencyMs?: number;
  observedValue?: number;
  unit?: string;
  message: string;
  evidence: string[];
  remediationKey?: RemediationKey;
}

export interface StabilityEvent {
  id: string;
  checkId: string;
  severity: StabilitySeverity;
  source: StabilitySignalSource;
  title: string;
  summary: string;
  detectedAt: string;
  risk: string;
  recommendation: string;
  requiresHumanApproval: boolean;
  remediationKey?: RemediationKey;
}

export interface StabilityRecommendation {
  id: string;
  severity: StabilitySeverity;
  title: string;
  explanation: string;
  nextAction: string;
  canAutoRemediate: boolean;
  remediationKey?: RemediationKey;
  createdAt: string;
}

export type NotificationChannel = "panel" | "email" | "whatsapp";

export interface StabilityNotification {
  id: string;
  channel: NotificationChannel;
  severity: StabilitySeverity;
  title: string;
  body: string;
  createdAt: string;
  deliveryStatus: "queued" | "sent" | "requires-config";
}

export type RemediationKey =
  | "purge-wordpress-cache"
  | "restart-non-critical-service"
  | "pause-background-jobs"
  | "disable-failing-integration"
  | "enable-degraded-mode"
  | "block-abusive-ip"
  | "create-internal-ticket";

export interface RemediationAction {
  key: RemediationKey;
  label: string;
  description: string;
  automaticAllowed: boolean;
  requiresHumanApproval: boolean;
  runbook: string;
}

export interface StabilitySnapshot {
  tenantId: string;
  status: StabilityStatus;
  severity: StabilitySeverity;
  generatedAt: string;
  checks: StabilityCheckResult[];
  events: StabilityEvent[];
  recommendations: StabilityRecommendation[];
  notifications: StabilityNotification[];
}
