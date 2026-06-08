import type { SocialAccountPolicy, SocialPostDraft } from "./types";

export const socialAccountPolicies: SocialAccountPolicy[] = [
  {
    network: "facebook",
    ownerLogin: "info@generatuenergia.net",
    publicProfile: "Gema Sistemas ERP",
    canUseApiNow: false,
    notes: "Requiere Meta Developer App, pagina conectada y Page Access Token con permisos aprobados.",
  },
  {
    network: "instagram",
    ownerLogin: "info@generatuenergia.net",
    publicProfile: "gema.digital.erp",
    canUseApiNow: false,
    notes: "Requiere Instagram Business conectado a Meta; la API no publica posts solo texto.",
  },
  {
    network: "linkedin",
    ownerLogin: "info@generatuenergia.net",
    publicProfile: "Gema Sistemas ERP",
    canUseApiNow: false,
    notes: "Requiere LinkedIn Developer App, permiso de organizacion y token OAuth.",
  },
  {
    network: "pinterest",
    ownerLogin: "info@gema-digital.com",
    publicProfile: "GemaDigitalERP",
    canUseApiNow: false,
    notes: "Requiere Pinterest Developer App, token OAuth y board id destino.",
  },
  {
    network: "youtube",
    ownerLogin: "info@gema-digital.com",
    publicProfile: "Pendiente canal GEMA/Cumbre",
    canUseApiNow: false,
    notes: "Requiere canal GEMA definido y YouTube Data API habilitada.",
  },
  {
    network: "x",
    ownerLogin: "info@gema-digital.com",
    publicProfile: "Pendiente",
    canUseApiNow: false,
    notes: "Requiere crear cuenta X por telefono/Apple o habilitar alta compatible y luego X Developer access.",
  },
];

const baseUrl = "https://gema-digital.com/";

export function buildInstitutionalDrafts(): SocialPostDraft[] {
  const body =
    "GEMA Digital ayuda a comercios, PyMEs y empresas a ordenar su gestion, vender mejor y automatizar procesos con software, ERP Cumbre, marketing digital e IA.";
  const hashtags = ["GEMADigital", "ERPCumbre", "SoftwareDeGestion", "MarketingDigital", "Automatizacion"];

  return [
    {
      network: "facebook",
      title: "GEMA Digital: gestion, marketing y automatizacion",
      body,
      url: `${baseUrl}?utm_source=facebook&utm_medium=social&utm_campaign=publicista_api`,
      hashtags,
    },
    {
      network: "linkedin",
      title: "GEMA Digital: gestion, marketing y automatizacion para empresas",
      body: `${body} El foco es empezar por el problema correcto: vender mejor, ordenar la operacion, medir el marketing o implementar ERP Cumbre por etapas.`,
      url: `${baseUrl}?utm_source=linkedin&utm_medium=social&utm_campaign=publicista_api`,
      hashtags,
    },
    {
      network: "pinterest",
      title: "GEMA Digital",
      body,
      url: `${baseUrl}?utm_source=pinterest&utm_medium=social&utm_campaign=publicista_api`,
      hashtags,
      boardId: undefined,
    },
  ];
}

export function formatPostText(draft: SocialPostDraft): string {
  const tags = draft.hashtags.map((tag) => `#${tag.replace(/^#/, "")}`).join(" ");
  return `${draft.body}\n\n${draft.url}\n\n${tags}`;
}
