import type { StabilityTarget } from "./types";

export const DEFAULT_STABILITY_TARGETS: StabilityTarget[] = [
  {
    id: "web-home",
    label: "Sitio publico GEMA",
    source: "wordpress",
    kind: "http",
    url: "https://gema-digital.com/",
    expectedStatus: 200,
    warningLatencyMs: 1500,
    criticalLatencyMs: 4000,
    description: "Valida que la home publica responda y no degrade latencia."
  },
  {
    id: "web-legal-cumbre",
    label: "Centro legal Cumbre",
    source: "wordpress",
    kind: "http",
    url: "https://gema-digital.com/legal/cumbre/",
    expectedStatus: 200,
    warningLatencyMs: 1500,
    criticalLatencyMs: 4000,
    description: "Confirma que la informacion legal publica siga disponible."
  },
  {
    id: "web-erp-cumbre",
    label: "Landing ERP Cumbre",
    source: "wordpress",
    kind: "http",
    url: "https://gema-digital.com/erp-cumbre/",
    expectedStatus: 200,
    warningLatencyMs: 1500,
    criticalLatencyMs: 4000,
    description: "Chequea la landing principal del producto."
  },
  {
    id: "web-cumbre-crm",
    label: "Landing Cumbre CRM",
    source: "wordpress",
    kind: "http",
    url: "https://gema-digital.com/cumbre-crm/",
    expectedStatus: 200,
    warningLatencyMs: 1500,
    criticalLatencyMs: 4000,
    description: "Chequea la pagina comercial del modulo CRM."
  },
  {
    id: "api-agent",
    label: "API agente IA",
    source: "api",
    kind: "http",
    url: "https://api.gema-digital.com/health",
    expectedStatus: 200,
    warningLatencyMs: 1200,
    criticalLatencyMs: 3500,
    description: "Valida disponibilidad del backend del agente IA cuando este expuesto."
  },
  {
    id: "firebase-firestore-read",
    label: "Firestore lectura",
    source: "firebase",
    kind: "firebase-read",
    warningLatencyMs: 600,
    criticalLatencyMs: 1800,
    description: "Mide disponibilidad logica de lectura para la matriz Cumbre."
  },
  {
    id: "firebase-firestore-write",
    label: "Firestore escritura controlada",
    source: "firebase",
    kind: "firebase-write",
    warningLatencyMs: 900,
    criticalLatencyMs: 2500,
    description: "Mide si el tenant puede registrar eventos operativos."
  },
  {
    id: "ssl-gema-digital",
    label: "SSL gema-digital.com",
    source: "ssl",
    kind: "ssl-expiry",
    warningThreshold: 21,
    criticalThreshold: 7,
    unit: "dias",
    requiresServerAgent: true,
    description: "Anticipa vencimientos de certificado antes de que el sitio quede inseguro."
  },
  {
    id: "gcp-vm-disk",
    label: "Disco servidor WordPress",
    source: "capacity",
    kind: "resource-capacity",
    warningThreshold: 75,
    criticalThreshold: 90,
    unit: "%",
    requiresServerAgent: true,
    description: "Detecta crecimiento de disco para anticipar colapso del servidor."
  },
  {
    id: "gcp-vm-memory",
    label: "Memoria servidor WordPress",
    source: "capacity",
    kind: "resource-capacity",
    warningThreshold: 75,
    criticalThreshold: 90,
    unit: "%",
    requiresServerAgent: true,
    description: "Detecta presion de memoria sostenida."
  },
  {
    id: "wp-login-bruteforce",
    label: "Fuerza bruta WordPress",
    source: "security",
    kind: "security-signal",
    warningThreshold: 30,
    criticalThreshold: 100,
    unit: "intentos/10m",
    requiresServerAgent: true,
    description: "Observa intentos repetidos contra wp-login, XML-RPC o rutas sensibles."
  },
  {
    id: "firebase-cost-projection",
    label: "Proyeccion costos Firebase",
    source: "cost",
    kind: "cost-quota",
    warningThreshold: 70,
    criticalThreshold: 90,
    unit: "%",
    requiresServerAgent: true,
    description: "Anticipa consumo de cuotas o costos antes de que el plan quede chico."
  }
];
