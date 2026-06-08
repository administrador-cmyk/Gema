import {
  CumbreActionButton,
  CumbreBadge,
  CumbreMetricCard,
  CumbreModuleCard,
  CumbrePageHeader,
  CumbrePanel,
  cumbreModuleVisuals,
  cumbreShellClass,
  cumbreVisualPrinciples,
  cx
} from "./design/CumbreDesignSystem";

const executiveSignals = [
  "Misma familia visual que GEMA Digital, pero optimizada para trabajo diario.",
  "Cada modulo conserva acento propio sin romper la navegacion comun.",
  "Estados, permisos, consumo y proximas acciones visibles desde el shell.",
  "Integraciones sensibles siempre con validacion backend y aprobacion asistida."
];

export default function CumbreCommandCenter() {
  return (
    <main className={cx(cumbreShellClass, "p-6")}>
      <CumbrePageHeader
        eyebrow="Centro Cumbre"
        title="Base profesional para el entorno operativo de Cumbre"
        description="Cumbre hereda el tono premium de GEMA Digital y lo convierte en una interfaz SaaS de trabajo: datos claros, estados visibles, acciones guiadas y modulos con personalidad propia."
        actions={
          <>
            <CumbreActionButton>Ver modulos</CumbreActionButton>
            <CumbreActionButton tone="cyan">Guia visual</CumbreActionButton>
          </>
        }
      />

      <section className="my-6 grid gap-4 md:grid-cols-4">
        <CumbreMetricCard label="Identidad" value="GEMA" detail="Continuidad visual" tone="emerald" />
        <CumbreMetricCard label="Shell" value="SaaS" detail="Sidebar, topbar y estados" tone="cyan" />
        <CumbreMetricCard label="Modulos" value="Propios" detail="Acento por funcion" tone="violet" />
        <CumbreMetricCard label="IA" value="Asistida" detail="Control humano visible" tone="amber" />
      </section>

      <section className="grid gap-4 xl:grid-cols-[1.25fr_0.75fr]">
        <CumbrePanel tone="emerald">
          <div className="mb-5 flex flex-wrap items-center justify-between gap-3">
            <div>
              <CumbreBadge>Mapa modular</CumbreBadge>
              <h2 className="mt-3 text-2xl font-black text-white">Una base comun, experiencias especificas por modulo</h2>
            </div>
            <span className="rounded-full border border-slate-700 px-3 py-1 text-sm text-slate-300">Base visual v0.2</span>
          </div>
          <div className="grid gap-4 md:grid-cols-2">
            {cumbreModuleVisuals.map((module) => (
              <CumbreModuleCard key={module.id} module={module} />
            ))}
          </div>
        </CumbrePanel>

        <div className="grid gap-4">
          <CumbrePanel tone="violet">
            <CumbreBadge tone="violet">Regla de diseño</CumbreBadge>
            <h2 className="mt-4 text-2xl font-black text-white">El sitio vende, la plataforma opera</h2>
            <p className="mt-3 text-sm leading-6 text-slate-300">
              La web de GEMA explica y convierte. El panel de Cumbre debe reducir ruido, ordenar estados y guiar acciones sin perder continuidad visual con la marca.
            </p>
          </CumbrePanel>

          <CumbrePanel tone="amber">
            <CumbreBadge tone="amber">Principios visuales</CumbreBadge>
            <ul className="mt-4 space-y-3">
              {cumbreVisualPrinciples.map((signal) => (
                <li key={signal} className="rounded-2xl border border-slate-700 bg-slate-950/40 p-3 text-sm leading-6 text-slate-200">
                  {signal}
                </li>
              ))}
            </ul>
          </CumbrePanel>

          <CumbrePanel tone="cyan">
            <CumbreBadge tone="cyan">Senales del shell</CumbreBadge>
            <ul className="mt-4 space-y-3">
              {executiveSignals.map((signal) => (
                <li key={signal} className="rounded-2xl border border-slate-700 bg-slate-950/40 p-3 text-sm leading-6 text-slate-200">
                  {signal}
                </li>
              ))}
            </ul>
          </CumbrePanel>
        </div>
      </section>
    </main>
  );
}
