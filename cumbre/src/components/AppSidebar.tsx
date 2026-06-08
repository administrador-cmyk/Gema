import { onAuthStateChanged } from "firebase/auth";
import { doc, onSnapshot } from "firebase/firestore";
import { useEffect, useState } from "react";

import { CUMBRE_APP_ID, auth, db } from "../lib/firebaseConfig";
import { CumbreBadge, cumbreModuleVisuals, cx } from "./design/CumbreDesignSystem";

interface ModuloConfig {
  habilitado: boolean;
  [key: string]: unknown;
}

export default function AppSidebar() {
  const [modulosActivos, setModulosActivos] = useState<Record<string, ModuloConfig>>({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    let unsubscribeMatrix: (() => void) | undefined;

    const unsubscribeAuth = onAuthStateChanged(auth, (user) => {
      unsubscribeMatrix?.();

      if (!user) {
        setModulosActivos({});
        setLoading(false);
        return;
      }

      setLoading(true);

      const matrixRef = doc(
        db,
        "artifacts",
        CUMBRE_APP_ID,
        "users",
        user.uid,
        "suscripcion_modulos",
        "config"
      );

      unsubscribeMatrix = onSnapshot(
        matrixRef,
        (docSnap) => {
          const data = docSnap.exists() ? docSnap.data() : {};
          setModulosActivos((data.modulos_activos as Record<string, ModuloConfig>) || {});
          setLoading(false);
        },
        (error) => {
          console.error("Error cargando la Matriz del Tenant:", error);
          setLoading(false);
        }
      );
    });

    return () => {
      unsubscribeMatrix?.();
      unsubscribeAuth();
    };
  }, []);

  if (loading) {
    return (
      <aside className="flex h-screen w-72 flex-col bg-slate-950 p-4 text-slate-100">
        <div className="rounded-3xl border border-slate-800 bg-slate-900/80 p-4 text-sm text-slate-300">
          Cargando Matriz Cumbre...
        </div>
      </aside>
    );
  }

  const enabledModules = cumbreModuleVisuals.filter((module) => {
    if (module.id === "estabilidad") {
      return modulosActivos.modulo_estabilidad_sre?.habilitado;
    }

    if (module.id === "crm") {
      return modulosActivos.modulo_crm_basic?.habilitado;
    }

    if (module.id === "pymes") {
      return modulosActivos.modulo_facturacion_ar?.habilitado;
    }

    if (module.id === "negocios") {
      return modulosActivos.modulo_control_stock?.habilitado;
    }

    return module.id === "empresas" || module.id === "cobros";
  });

  return (
    <nav className="flex h-screen w-72 flex-col gap-4 border-r border-slate-800 bg-slate-950 p-4 text-white shadow-2xl shadow-slate-950/40">
      <div className="rounded-3xl border border-emerald-400/20 bg-gradient-to-br from-slate-900 to-slate-950 p-4">
        <CumbreBadge tone="emerald">ERP Cumbre</CumbreBadge>
        <h1 className="mt-4 text-2xl font-black tracking-tight">Centro de Control</h1>
        <p className="mt-2 text-sm leading-6 text-slate-400">PyMEs ordena. Empresas gobierna. IA acompaña.</p>
      </div>

      <a
        href="/dashboard"
        className="rounded-2xl border border-slate-800 bg-slate-900/70 px-4 py-3 text-sm font-bold text-slate-100 transition hover:border-emerald-400/40 hover:bg-slate-900"
      >
        Vista general
      </a>

      <div className="space-y-2">
        <p className="px-2 text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Modulos activos</p>
        {enabledModules.map((module) => (
          <a
            key={module.id}
            href={module.href}
            className={cx(
              "block rounded-2xl border bg-slate-900/70 px-4 py-3 transition hover:-translate-y-0.5 hover:bg-slate-900",
              module.tone === "emerald" && "border-emerald-400/25 hover:border-emerald-300/60",
              module.tone === "cyan" && "border-cyan-400/25 hover:border-cyan-300/60",
              module.tone === "amber" && "border-amber-400/25 hover:border-amber-300/60",
              module.tone === "violet" && "border-violet-400/25 hover:border-violet-300/60",
              module.tone === "rose" && "border-rose-400/25 hover:border-rose-300/60",
              module.tone === "slate" && "border-slate-700 hover:border-slate-500"
            )}
          >
            <strong className="block text-sm text-white">{module.name}</strong>
            <span className="mt-1 block text-xs leading-5 text-slate-400">{module.status}</span>
          </a>
        ))}
      </div>

      <div className="mt-auto rounded-3xl border border-amber-400/20 bg-amber-400/10 p-4">
        <p className="text-sm font-bold text-amber-100">Trial y conversion</p>
        <p className="mt-2 text-xs leading-5 text-amber-100/80">14 dias de prueba por modulo, conservando datos al pasar a plan pago.</p>
      </div>
    </nav>
  );
}
