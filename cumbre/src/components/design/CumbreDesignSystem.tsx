import type { ReactNode } from "react";

export type CumbreTone = "emerald" | "cyan" | "amber" | "violet" | "rose" | "slate";

export const cumbreVisualPrinciples = [
  "Continuidad con GEMA Digital: oscuro, sobrio, premium y con acentos cyan/emerald.",
  "Producto SaaS operativo: menos narrativa, más estados, datos, permisos y próximas acciones.",
  "Una base común para todos los módulos; cada módulo cambia acento, iconografía y datos.",
  "IA como copiloto y control asistido, no como promesa automática absoluta."
];

export const cumbreShellClass =
  "min-h-screen bg-[radial-gradient(circle_at_top_left,rgba(16,185,129,0.12),transparent_34rem),radial-gradient(circle_at_top_right,rgba(14,165,233,0.12),transparent_30rem),#020617] text-slate-100";

export const cumbreSurfaceClass =
  "border border-slate-800/90 bg-slate-950/60 backdrop-blur-xl";

export const cumbreInteractiveMotionClass =
  "transition duration-200 ease-out hover:-translate-y-1 hover:scale-[1.015] active:translate-y-0 active:scale-[0.99] motion-reduce:transform-none motion-reduce:transition-none";

export const cumbreSubtleMotionClass =
  "transition duration-200 ease-out hover:-translate-y-0.5 active:translate-y-0 motion-reduce:transform-none motion-reduce:transition-none";

export const cumbreNavMotionClass =
  "transition duration-200 ease-out hover:translate-x-1 hover:bg-white/10 active:translate-x-0 motion-reduce:transform-none motion-reduce:transition-none";

const toneClasses: Record<CumbreTone, { badge: string; border: string; glow: string; text: string }> = {
  amber: {
    badge: "border-amber-400/40 bg-amber-400/10 text-amber-100",
    border: "border-amber-400/30",
    glow: "from-amber-400/18",
    text: "text-amber-200"
  },
  cyan: {
    badge: "border-cyan-400/40 bg-cyan-400/10 text-cyan-100",
    border: "border-cyan-400/30",
    glow: "from-cyan-400/18",
    text: "text-cyan-200"
  },
  emerald: {
    badge: "border-emerald-400/40 bg-emerald-400/10 text-emerald-100",
    border: "border-emerald-400/30",
    glow: "from-emerald-400/18",
    text: "text-emerald-200"
  },
  rose: {
    badge: "border-rose-400/40 bg-rose-400/10 text-rose-100",
    border: "border-rose-400/30",
    glow: "from-rose-400/18",
    text: "text-rose-200"
  },
  slate: {
    badge: "border-slate-500/40 bg-slate-700/40 text-slate-100",
    border: "border-slate-700",
    glow: "from-slate-500/12",
    text: "text-slate-200"
  },
  violet: {
    badge: "border-violet-400/40 bg-violet-400/10 text-violet-100",
    border: "border-violet-400/30",
    glow: "from-violet-400/18",
    text: "text-violet-200"
  }
};

export function cx(...classes: Array<string | false | null | undefined>) {
  return classes.filter(Boolean).join(" ");
}

interface BadgeProps {
  children: ReactNode;
  tone?: CumbreTone;
}

export function CumbreBadge({ children, tone = "emerald" }: BadgeProps) {
  return (
    <span className={cx("inline-flex rounded-full border px-3 py-1 text-xs font-semibold tracking-wide", toneClasses[tone].badge)}>
      {children}
    </span>
  );
}

interface PanelProps {
  children: ReactNode;
  className?: string;
  tone?: CumbreTone;
}

export function CumbrePanel({ children, className, tone = "slate" }: PanelProps) {
  return (
    <section
      className={cx(
        "relative overflow-hidden rounded-3xl p-5",
        cumbreSurfaceClass,
        toneClasses[tone].border,
        className
      )}
    >
      <div className={cx("pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r via-white/30 to-transparent", toneClasses[tone].glow)} />
      {children}
    </section>
  );
}

interface PageHeaderProps {
  eyebrow: string;
  title: string;
  description: string;
  actions?: ReactNode;
}

export function CumbrePageHeader({ eyebrow, title, description, actions }: PageHeaderProps) {
  return (
    <CumbrePanel className="p-6 md:p-8" tone="emerald">
      <div className="flex flex-wrap items-start justify-between gap-6">
        <div className="max-w-4xl">
          <CumbreBadge tone="emerald">{eyebrow}</CumbreBadge>
          <h1 className="mt-5 text-3xl font-black tracking-tight text-white md:text-5xl">{title}</h1>
          <p className="mt-4 max-w-3xl text-base leading-7 text-slate-300 md:text-lg">{description}</p>
        </div>
        {actions && <div className="flex flex-wrap gap-3">{actions}</div>}
      </div>
    </CumbrePanel>
  );
}

interface ActionButtonProps {
  children: ReactNode;
  disabled?: boolean;
  onClick?: () => void;
  tone?: CumbreTone;
  type?: "button" | "submit";
}

export function CumbreActionButton({ children, disabled = false, onClick, tone = "emerald", type = "button" }: ActionButtonProps) {
  return (
    <button
      className={cx(
        "rounded-2xl border px-4 py-2 text-sm font-bold disabled:cursor-not-allowed disabled:opacity-60",
        toneClasses[tone].badge,
        "hover:bg-white/10",
        cumbreInteractiveMotionClass
      )}
      disabled={disabled}
      type={type}
      onClick={onClick}
    >
      {children}
    </button>
  );
}

interface MetricCardProps {
  label: string;
  value: ReactNode;
  detail?: string;
  tone?: CumbreTone;
}

export function CumbreMetricCard({ label, value, detail, tone = "slate" }: MetricCardProps) {
  return (
    <CumbrePanel className="p-4" tone={tone}>
      <p className="text-sm text-slate-400">{label}</p>
      <strong className="mt-2 block text-2xl font-black text-white">{value}</strong>
      {detail && <p className={cx("mt-2 text-sm", toneClasses[tone].text)}>{detail}</p>}
    </CumbrePanel>
  );
}

export interface CumbreModuleVisual {
  id: string;
  name: string;
  description: string;
  href: string;
  status: string;
  tone: CumbreTone;
}

export const cumbreModuleVisuals: CumbreModuleVisual[] = [
  {
    id: "crm",
    name: "Cumbre CRM",
    description: "Leads, clientes, presupuestos, seguimiento y conversion comercial.",
    href: "/crm",
    status: "Tronco comercial",
    tone: "emerald"
  },
  {
    id: "negocios",
    name: "ERP Negocios",
    description: "Caja, mostrador, stock y ventas para comercios de operacion diaria.",
    href: "/negocios",
    status: "Operacion simple",
    tone: "amber"
  },
  {
    id: "pymes",
    name: "ERP PyMEs",
    description: "Administracion, bancos, impuestos, reportes y contabilidad opcional.",
    href: "/pymes",
    status: "Admin fuerte",
    tone: "cyan"
  },
  {
    id: "empresas",
    name: "Cumbre Empresas",
    description: "Gobernanza, aprobaciones, auditoria y reportes ejecutivos.",
    href: "/empresas",
    status: "Gobierno administrativo",
    tone: "violet"
  },
  {
    id: "cobros",
    name: "Cumbre Cobros",
    description: "Links, instrucciones, medios argentinos y conciliacion operativa.",
    href: "/cobros",
    status: "Cobros conectados",
    tone: "emerald"
  },
  {
    id: "tesoreria",
    name: "Cumbre Tesorería",
    description: "Bancos, billeteras, caja, conciliacion, pagos y cashflow.",
    href: "/tesoreria",
    status: "Control financiero",
    tone: "cyan"
  },
  {
    id: "contabilidad",
    name: "Cumbre Contabilidad",
    description: "Plan de cuentas, asientos, cierres, libros y reportes revisables.",
    href: "/contabilidad",
    status: "Registro formal",
    tone: "violet"
  },
  {
    id: "impuestos",
    name: "Cumbre Impuestos",
    description: "IVA, IIBB, retenciones, percepciones, vencimientos y reportes.",
    href: "/impuestos",
    status: "Control fiscal",
    tone: "amber"
  },
  {
    id: "reportes-bi",
    name: "Reportes BI",
    description: "Dashboards, KPIs, alertas ejecutivas, historicos y exportaciones.",
    href: "/reportes-bi",
    status: "Vista ejecutiva",
    tone: "cyan"
  },
  {
    id: "planificacion",
    name: "Planificación",
    description: "Presupuestos internos, escenarios, forecast y real vs plan.",
    href: "/planificacion",
    status: "Proyección financiera",
    tone: "emerald"
  },
  {
    id: "activos-fijos",
    name: "Activos Fijos",
    description: "Bienes de uso, responsables, amortizaciones y mantenimiento.",
    href: "/activos-fijos",
    status: "Patrimonio trazable",
    tone: "violet"
  },
  {
    id: "personal",
    name: "Personal",
    description: "Legajos, asistencia, ausencias, novedades y costos laborales.",
    href: "/personal",
    status: "RRHH PyME",
    tone: "violet"
  },
  {
    id: "ventas",
    name: "Ventas",
    description: "POS, ventas digitales, cobros, stock y facturacion vinculada.",
    href: "/ventas",
    status: "Venta transaccional",
    tone: "emerald"
  },
  {
    id: "marketing",
    name: "Marketing",
    description: "Segmentos, audiencias, campañas y atribucion comercial.",
    href: "/marketing",
    status: "Growth conectado",
    tone: "cyan"
  },
  {
    id: "automatizaciones",
    name: "Automatizaciones",
    description: "Workflows, webhooks, idempotencia, auditoria y pausas.",
    href: "/automatizaciones",
    status: "Motor seguro",
    tone: "cyan"
  },
  {
    id: "web",
    name: "Web",
    description: "Landings, formularios, SEO, eventos y CRM conectado.",
    href: "/web",
    status: "Captacion ERP",
    tone: "cyan"
  },
  {
    id: "whatsapp-hub",
    name: "WhatsApp Hub",
    description: "Agente conversacional, Meta Cloud API, opt-in y webhooks seguros.",
    href: "/whatsapp-hub",
    status: "Comunicación inteligente",
    tone: "emerald"
  },
  {
    id: "stock",
    name: "Cumbre Stock",
    description: "Depositos, saldos, ingesta documental, alertas y aprobacion humana.",
    href: "/stock",
    status: "Inventario agentico",
    tone: "amber"
  },
  {
    id: "compras",
    name: "Cumbre Compras",
    description: "Proveedores, reposicion, ordenes, recepcion y trazabilidad con Stock.",
    href: "/compras",
    status: "Compras trazables",
    tone: "amber"
  },
  {
    id: "facturador",
    name: "Facturador ARCA",
    description: "Comprobantes, CAE, errores trazables e implementacion asistida.",
    href: "/facturador",
    status: "Fiscal asistido",
    tone: "amber"
  },
  {
    id: "legal",
    name: "Cumbre Legal",
    description: "Borradores, fuentes verificables, vencimientos y revision profesional.",
    href: "/legal",
    status: "Documental IA",
    tone: "violet"
  },
  {
    id: "tutoriales-api",
    name: "Tutoriales API",
    description: "Checklists, credenciales seguras, webhooks y validacion backend.",
    href: "/tutoriales-api",
    status: "Integraciones guiadas",
    tone: "cyan"
  },
  {
    id: "estabilidad",
    name: "Estabilidad y Seguridad",
    description: "Radar preventivo, alertas IA y remediacion controlada.",
    href: "/estabilidad",
    status: "Vigilancia activa",
    tone: "cyan"
  },
  {
    id: "verticales",
    name: "Verticales sectoriales",
    description: "Kioscos, Resto, WMS, Constructoras, Agro y Mercados.",
    href: "/verticales",
    status: "Paquetes por rubro",
    tone: "amber"
  }
];

export function CumbreModuleCard({ module }: { module: CumbreModuleVisual }) {
  return (
    <a
      className={cx(
        "group rounded-3xl p-5 text-left transition hover:bg-slate-900",
        cumbreSurfaceClass,
        cumbreInteractiveMotionClass,
        toneClasses[module.tone].border
      )}
      href={module.href}
    >
      <div className="flex items-center justify-between gap-4">
        <CumbreBadge tone={module.tone}>{module.status}</CumbreBadge>
        <span className={cx("text-sm font-black transition group-hover:translate-x-1", toneClasses[module.tone].text)}>Abrir</span>
      </div>
      <h3 className="mt-5 text-xl font-black text-white">{module.name}</h3>
      <p className="mt-3 text-sm leading-6 text-slate-300">{module.description}</p>
    </a>
  );
}
