# Registro de Trabajo GEMA Digital

Última actualización: 2026-06-17 — Asistente IA on-demand (canvas overlay, sin columna lateral)

### 2026-06-17 — Asistente IA on-demand: canvas overlay (sin columna lateral fija)

- **Objetivo:** Eliminar columna derecha permanente del asistente; abrir guía contextual + chat soporte solo bajo demanda en panel canvas moderno.
- **Archivos cumbre-mirror:** `src/components/assistant/AssistantCanvasContext.tsx`, `PrismAssistantCanvas.tsx`, `App.tsx`, `CumbreGuidedAssistant.tsx` (`variant=canvas`), `CustomerPortalSupportChat.tsx` (`embedded`), `CustomerPortalPanel.tsx`, `src/styles/prism-template.css`.
- **Archivos GEMA:** `docs/EXPERIENCIA_CLIENTE_CUMBRE_2026-06-17.md` (UX asistente on-demand).
- **Impacto web:** ERP Cumbre prod — CRM y módulos a ancho completo; asistente vía botón topbar + FAB móvil.
- **Impacto asistente IA:** Misma lógica `guidedAssistant` + perfil `cliente_soporte`; solo cambia presentación (tabs Guía | Chat IA).
- **Despliegue:** `npm run deploy:prod:hosting` ✅ https://cumbre-erp-prod.web.app
- **Validaciones:** `npm run build:prod` ✅
- **Pendientes:** Actualizar E2E P3 que buscaba sidebar fijo `.guided-assistant`.

### 2026-06-17 — Template-first UX/UI Prism (librería + shell global + deploy prod)

- **Objetivo:** Extraer template completo del kit Prism (Dashboard.png canónico), construir librería `prism/template/`, cablear shell global y aplicar en vistas prioritarias + mínimo en 28+ módulos.
- **Archivos cumbre-mirror:** `src/components/prism/template/*` (17 componentes), `src/styles/prism-template.css`, `src/lib/prismNavConfig.ts`, `src/App.tsx` (PrismLoginTemplate + PrismAppShell), `src/components/CumbreAppShell.tsx`, `src/components/design/CumbreModulePageLayout.tsx`, `src/appPanelRouter.tsx`, `src/components/CumbreCommandCenter.tsx`, `src/components/CumbreCrmPanel.tsx`, `src/main.tsx`.
- **Archivos GEMA:** `docs/PRISM_TEMPLATE_UX_UI.md` (SSOT), `docs/PLAN_REESTRUCTURACION_UX_UI_CUMBRE.md` (estrategia template-first actualizada).
- **Impacto web:** ERP Cumbre prod https://cumbre-erp-prod.web.app — sidebar 288px, topbar búsqueda/avatar, badge trial compacto, KPI grid, charts 8+4, CRM tabs/kanban.
- **Impacto asistente IA:** Pendiente — sync copy template (sidebar secciones, trial badge) en knowledge agente.
- **Despliegue:** `npm run build:prod` + `deploy:prod:hosting` ✅ prod
- **Validaciones:** `tsc --noEmit`, `check:prod:build` ✅
- **Pendientes:** Consolidar `design/PrismComponents.tsx` con template; wiring búsqueda global topbar; asistente IA copy.

### 2026-06-17 — Prism Etapa 1 CRM: `CrmPrismView` unificado (cliente + admin)

- **Objetivo:** Reestructura visual CRM al kit Prism (Clients.png / Dashboard-4.png): tabs, 4 KPIs con trend/sparkline, charts 8/4, tabla sin IDs, kanban white cards; CRUD completo preservado.
- **Archivos cumbre-mirror:** `src/components/crm/CrmPrismView.tsx` (nuevo), `src/components/prism/PrismModuleLayout.tsx`, `PrismAppShell.tsx`, `src/appPanelRouter.tsx`, `src/appLazyPanels.ts`, `src/lib/prismChartData.ts` (`buildCrmPipelineDonutData`), `src/styles.css` (module layout, tabs, kanban, assistant prism), `src/components/CumbreGuidedAssistant.tsx` (`variant=prism`), `src/App.tsx`, `src/components/prism/template/index.ts` (fix build).
- **Archivos GEMA:** `docs/PRISM_CRM_REDESIGN_ETAPA1.md` (análisis Phase 1 + QA checklist Norberto).
- **Impacto web:** Sin cambio WP; CRM prod en https://cumbre-erp-prod.web.app?view=crm
- **Impacto asistente IA:** Pendiente — sync copy UX CRM Prism en knowledge base agente.
- **Despliegue:** `npm run deploy:prod:hosting` ✅ prod
- **Validaciones:** `npm run build:prod` ✅
- **Pendientes:** Etapa 2 Ventas/Stock/Cobros tras aprobación visual Norberto; asistente IA copy.

### 2026-06-17 — Mapa definitivo Prism → sectores Cumbre (120 PNG)

- **Objetivo:** Completar mapeo abortado subagente 5de613b7 — asignar los 120 PNG del kit Prism Desktop a cada sector/módulo ERP Cumbre con primary, alternative y justificación; JSON programático para scripts/validación UX.
- **Archivos GEMA:** `docs/PRISM_SECTOR_IMAGEN_MAPA.md` (nuevo), `docs/prism-sector-map.json` (nuevo).
- **Fuente diseño:** `GEMA/01-Proyecto Cumbre Erp/01-Diseño de plataforma/Prism Dashboard UI Kit_ Desktop Version (Preview) (1)/` — 120 PNG verificados en disco.
- **Cobertura:** 38 sectores Cumbre (30 módulos + login, portal, soporte, onboarding, tokens, tiers) · 120/120 PNG inventariados · 13 patrones layout documentados.
- **Top 5 prioritarios:** CRM→`Clients.png`, Centro Control→`Dashboard.png`, Cobros→`Billing.png`, Ventas→`Projects.png`, Portal→`Settings_Overview.png`.
- **Impacto web:** Sin cambio WP; referencia para reestructuración UX Etapas 1–7 en `PLAN_REESTRUCTURACION_UX_UI_CUMBRE.md`.
- **Impacto asistente IA:** Puede citar PNG de referencia al describir roadmap UI por módulo.
- **Despliegue:** Solo documentación — sin deploy.
- **Validaciones:** Conteo 120 PNG alfabético; coherencia con `PRISM_MODULO_IMAGEN_MAPA.md` y matriz 30 módulos.
- **Pendientes:** Implementar layouts DOM según mapa (Etapa 1 CRM pendiente).

### 2026-06-17 — Plan maestro reestructuración UX/UI ERP Cumbre (Prism)

- **Objetivo:** Documentar plan staged (7 etapas + Fase 0) para llevar Cumbre de ~42% estructura UX a ~90% “profesional como las imágenes” del kit Prism — DOM/layout/organización, no solo tokens CSS.
- **Archivos GEMA:** `docs/PLAN_REESTRUCTURACION_UX_UI_CUMBRE.md` (nuevo).
- **Referencias usadas:** `PRISM_MODULO_IMAGEN_MAPA.md`, `PRISM_GRAFICAS_ANALISIS.md`, `PRISM_DESIGN_TOKENS_CUMBRE.md`, `PRISM_APLICACION_CUMBRE_2026-06-17.md`, `EXPERIENCIA_CLIENTE_CUMBRE_2026-06-17.md`, `PORTAL_CLIENTE_SELF_SERVICE_2026-06-17.md`.
- **Etapa 1 CRM (e5f394b4):** **Pendiente** — `CrmPrismView`, `PrismAppShell`, `PrismTopBar` aún no implementados; plan define spec y checklist QA.
- **Estrategia:** CRM piloto → módulos core → Centro Control → admin → 28 módulos batch → login/onboarding → dark/tablet QA. Mismo design system admin/cliente trial.
- **Cronograma:** ~14–18 semanas realistas; hitos M1–M4.
- **Impacto web:** Sin cambio WP; plan orienta evolución ERP prod.
- **Impacto asistente IA:** Puede referir fases y DoD al describir roadmap UI Cumbre.
- **Despliegue:** Solo documentación — sin deploy en esta tarea.
- **Validaciones:** Coherencia con inventario 120 PNG y estado honesto vs `PRISM_APLICACION` (~98% tokens, ~42% estructura).
- **Pendientes:** Ejecutar Etapa 1 tras aprobación implícita del plan; sign-off Norberto por etapa.

### 2026-06-17 — Prism UI Kit → plataforma completa ERP Cumbre

- **Objetivo:** Extender el sistema Prism del shell a **100% de la UI visible** — todos los módulos, portal cliente, admin, customer work panels; eliminar mezcla de paneles dark Tailwind y cards slate legacy.
- **Fase 1 — Foundation:** Tokens ampliados en `styles.css` (superficies modal/tabla, badges semánticos, spacing, sombras); `PRISM_PALETTE` en `cumbreTheme.ts`; primitives en `src/components/prism/`; tone classes theme-aware en `CumbreDesignSystem.tsx`.
- **Fase 2 — Migración paneles:** Overrides globales `.cumbre-app`; migración explícita de CommandCenter, AgentsHub, ControlPanel, CustomerPortal, SoporteAdmin, SupportChat, CrmPricing, CrmDashboard; 28+ módulos vía `.page`/`.card`/`.status-pill` theme-aware.
- **Fase 3 — Layout Prism:** Page headers, metric rows, tablas, empty states, guided assistant, charts Recharts (`PrismCharts.tsx`).
- **Fase 4 — Paridad cliente/admin:** Mismo sistema visual; customer work panels heredan tokens.
- **Archivos cumbre-mirror (principal):** `src/styles.css`, `src/lib/cumbreTheme.ts`, `src/components/design/CumbreDesignSystem.tsx`, `src/components/CumbreAppShell.tsx`, `src/components/prism/*`, `src/components/CumbreCommandCenter.tsx`, `CumbreAgentsHub.tsx`, `CumbreControlPanel.tsx`, `CustomerPortalPanel.tsx`, `CustomerPortalSupportChat.tsx`, `SoporteAdminPanel.tsx`, `CumbreCrmPricing.tsx`, `CumbreCrmDashboard.tsx`, `App.tsx`.
- **Impacto web:** Sin cambio WP; ERP prod con UI cohesiva Prism light/dark.
- **Impacto asistente IA:** Puede describir dashboard Prism unificado en toda la plataforma.
- **Despliegue:** `npm run build:prod` + `deploy:prod:hosting` ✅ → https://cumbre-erp-prod.web.app
- **Validaciones:** `build:prod`, `check:prod:build`, deploy Firebase OK.
- **Cobertura:** ~98% (matriz en `docs/PRISM_APLICACION_CUMBRE_2026-06-17.md`).
- **Pendientes:** Consolidar `design/PrismComponents` + `prism/`; iconografía nav kit; pixel-perfect PNGs en módulos de bajo tráfico; `CumbreMvpDemo`/`P1Readiness` refactor visual dedicado.

### 2026-06-17 — Prism gráficas: análisis 33 PNG + Recharts en 7 pantallas

- **Objetivo:** Inventariar y analizar PNG con charts del kit; implementar `PrismCharts.tsx` (line/bar/area/donut/sparkline/metric+trend/chart card) con tema light/dark; datos demo/tenant en módulos clave.
- **Docs:** `docs/PRISM_GRAFICAS_ANALISIS.md` (33 PNG); sección Gráficas en `docs/PRISM_MODULO_IMAGEN_MAPA.md`.
- **Pantallas con charts:** Centro de Control, CRM pipeline, Ventas, Stock, Cobros, Portal Facturación, Reportes BI.
- **Despliegue:** https://cumbre-erp-prod.web.app ✅

### 2026-06-17 — Uso operativo real en modo cliente trial (Customer Work Panels)

- **Objetivo:** Reemplazar paneles P1/demo (métricas, IDs técnicos, readiness) por UI operativa real cuando `panelPresentationMode === customer_work` (tenant trial como Solar Norte).
- **Causa raíz:** `appPanelRouter` enrutaba a `CumbreCrmPanel` etc. con solo tweaks cosméticos; no había listas, formularios ni CRUD.
- **Archivos cumbre-mirror:**
  - `src/components/customer/CustomerCrmWorkPanel.tsx` — tabla leads, pipeline, modal nuevo lead, drawer editar + notas
  - `src/components/customer/CustomerVentasWorkPanel.tsx` — lista pedidos, nuevo pedido con ítems
  - `src/components/customer/CustomerStockWorkPanel.tsx` — saldos + movimientos entrada/salida
  - `src/components/customer/CustomerCobrosWorkPanel.tsx` — facturas/recibos `documentos_cliente`
  - `src/components/customer/CustomerWorkLayout.tsx` — layout Prism compartido
  - `src/lib/customerWorkTools.ts` — CRUD Firestore scoped al tenant
  - `src/appPanelRouter.tsx`, `src/appLazyPanels.ts` — routing `customer_work`
  - `firestore.rules` — `canTenantWrite` en empresas_clientes, ventas, stock, eventos_crm
- **Impacto web:** Sin cambio WP; ERP prod con workspace usable para trial.
- **Impacto asistente IA:** Flujos `customer_crm`, `customer_ventas`, etc. alineados con acciones reales.
- **Despliegue:** `deploy:prod:hosting` + `deploy:prod:firestore-rules` ✅ → https://cumbre-erp-prod.web.app
- **Validaciones:** `build:prod`, `check:prod:build`, deploy Firebase OK.
- **Test manual:** Login trial → CRM → Nuevo lead → visible en lista/pipeline; Ventas → Nuevo pedido; Stock → movimiento.
- **Pendientes:** Drag-and-drop pipeline; seed `vista_hoy` opcional para trial.

### 2026-06-17 — Prism Dashboard UI Kit → shell ERP Cumbre

- **Objetivo:** Analizar 120 capturas del kit Prism Desktop y alinear tokens, sidebar, header, login, cards y portal cliente al estilo Prism; conservar emerald GEMA en módulos y toggle día/noche.
- **Inventario diseño:** 120 PNG en `01-Proyecto Cumbre Erp/01-Diseño de plataforma/Prism Dashboard UI Kit_ Desktop Version (Preview) (1)/` — sin SVG exportables; no se copiaron assets al repo.
- **Archivos cumbre-mirror:** `src/styles.css`, `src/lib/cumbreTheme.ts`, `src/components/design/CumbreDesignSystem.tsx`, `src/components/CumbreLoginShell.tsx`, `src/components/AppSidebar.tsx`, `src/App.tsx`, `src/components/CustomerPortalPanel.tsx`.
- **Archivos GEMA:** `docs/PRISM_DESIGN_TOKENS_CUMBRE.md`, `docs/PRISM_APLICACION_CUMBRE_2026-06-17.md`.
- **Decisión acento:** Azul Prism `#2563EB` para nav/botones shell; emerald GEMA en badges módulo y marca.
- **Impacto web:** Sin cambio WP; ERP prod actualizado visualmente.
- **Impacto asistente IA:** Sin cambio copy; puede describir UI «dashboard Prism» en ERP.
- **Despliegue:** `npm run deploy:prod:hosting` → https://cumbre-erp-prod.web.app
- **Validaciones:** `build:prod` en pipeline deploy.
- **Pendientes:** Refinar clases Tailwind fijas en paneles internos para light mode; iconos nav opcionales en iteración futura.

### 2026-06-17 — Login ERP estilo SaaS (Google/Apple + logo GEMA)

- **Objetivo:** Rediseñar pantalla login ERP Cumbre al estilo Cursor/modern SaaS: logo GEMA en esquina, botones oficiales Google/Apple, email secundario, sin GitHub.
- **Archivos cumbre-mirror:** `src/components/CumbreLoginShell.tsx`, `src/components/LoginSocialButtons.tsx`, `src/components/icons/GoogleLogoIcon.tsx`, `src/components/icons/AppleLogoIcon.tsx`, `src/assets/gema-logo-designed*.svg`, `src/App.tsx`, `src/styles.css`, `src/lib/firebaseConfig.ts` (`loginWithAppleSSO`, `OAuthProvider`), `shared/googleAuthPolicy.ts`, `docs/FIREBASE_APPLE_SIGNIN_CUMBRE.md`.
- **Impacto web:** Sin cambio redirect WP `/login` → ERP; UI login prod actualizada.
- **Impacto asistente IA:** Puede referir «Continuar con Google/Apple» en pantalla ERP.
- **Despliegue:** `npm run deploy:prod:hosting` → https://cumbre-erp-prod.web.app/login
- **Validaciones:** `build:prod` OK.
- **Pendientes:** Habilitar proveedor Apple en Firebase Console (ver `docs/FIREBASE_APPLE_SIGNIN_CUMBRE.md`); QA browser Norberto.

### 2026-06-17 — Temas día/noche en login ERP Cumbre (azul oscuro noche)

- **Objetivo:** Responder feedback UI: mantener estética actual, agregar toggle día/noche, modo noche en azul oscuro (no negro puro), persistir preferencia; auditar y eliminar referencias GitHub en UI ERP.
- **Archivos cumbre-mirror:** `src/lib/cumbreTheme.ts`, `src/lib/useCumbreTheme.ts`, `src/components/CumbreThemeToggle.tsx`, `src/styles.css` (tokens `[data-theme="light"|"dark"]`), `src/components/design/CumbreDesignSystem.tsx`, `src/App.tsx` (toggle login + shell), `src/main.tsx`, `index.html` (script anti-flash).
- **Tokens noche (dark):** fondo `#0a1628`, elevado `#0f1d32`, superficie `rgb(15 29 50 / 0.72)`, bordes `rgb(30 58 95 / 0.9)`, acentos GEMA emerald conservados.
- **Tokens día (light):** fondo `#f1f5f9`, superficie blanca translúcida, texto `#0f172a`, acentos emerald `#047857`.
- **Persistencia:** `localStorage` clave `cumbre-theme`; default `prefers-color-scheme` si no hay valor guardado.
- **GitHub:** Búsqueda en `src/`, `dist/`, theme WP `gema-sovereign` y footer — **sin referencias GitHub** en UI login/footer/sidebar; no hubo botón/link que remover (solo Google SSO). Si el usuario veía «GitHub» podría ser confusión con otro proveedor o build antiguo.
- **Impacto web:** Sin cambio WP (redirect `/login` intacto).
- **Impacto asistente IA:** Sin cambio copy.
- **Despliegue:** `npm run deploy:prod:hosting` ✅ → `https://cumbre-erp-prod.web.app`
- **Validaciones:** `build:prod` OK; `check:prod:build` OK; deploy Firebase hosting `cumbre-erp-prod` OK.
- **Pendientes:** QA visual Norberto (toggle sol/luna en login y shell autenticado); módulos internos con clases Tailwind fijas (`text-white`, `slate-800`) pueden refinarse en iteración futura para light mode completo en panel.

### 2026-06-17 — Google Sign-In en ERP Cumbre y accesos web GEMA

- **Objetivo:** Habilitar login con Google en todos los puntos de acceso (web GEMA → ERP, login directo ERP) para staff y clientes trial con cuenta existente; política de dominios; fallback redirect; documentación QA.
- **Archivos cumbre-mirror:** `shared/googleAuthPolicy.ts` (nuevo), `src/lib/firebaseConfig.ts` (popup+redirect, claims-based allow), `src/App.tsx` (UI español, banner `from=gema-web`), `scripts/test-google-auth-policy.ts`, `scripts/inspect-google-auth-providers.ts`, `package.json`.
- **Archivos GEMA:** `wordpress/plugins/gema-cumbre-subdomains` 0.1.4 (`from=gema-web` en redirect), `wordpress/theme-gema-sovereign/functions.php`, `docs/ACCESOS_Y_URLS_GEMA.md`.
- **Impacto web:** `/login` y `/mi-cuenta` redirigen a ERP con `&from=gema-web`; banner en login ERP indica opción Google.
- **Impacto asistente IA:** Sin cambio copy; puede indicar «Iniciar con Google» en pantalla ERP post-redirect.
- **Despliegue:** `deploy:prod:hosting` ✅; `sync-wordpress-prod.sh` ✅ (plugins + theme).
- **Validaciones:** `test:google-auth-policy` OK; `test:customer-portal:routing` OK; `build:prod` OK; curl `/login/` → `from=gema-web` ✅.
- **Pendientes:** QA browser Norberto con cuenta Google real; `inspect:google-auth-providers:prod` para confirmar providers en `norberto@`; verificar Authorized domains en Firebase Console si `auth/unauthorized-domain`.

### 2026-06-17 — Login cliente desde gema-digital.com (redirect chain MVP)

- **Objetivo:** Clientes trial acceden al ERP desde la web GEMA sin conocer la URL directa `cumbre-erp-prod.web.app`; post-login aterrizan en Portal Cliente.
- **Archivos GEMA:** `wordpress/plugins/gema-cumbre-subdomains` 0.1.3 (`/login` + `/mi-cuenta` → ERP login portal); `wordpress/theme-gema-sovereign/functions.php` (helpers login); `parts/header.html`, `parts/footer.html`, `templates/page-erp-cumbre.html` (CTAs `/login`, `/mi-cuenta`).
- **Archivos cumbre-mirror:** `shared/customerPortal.ts` (`parseReturnViewFromSearchParams` — alias `returnTo`/`returnUrl`); `src/App.tsx`; `scripts/test-customer-portal-routing.ts`.
- **Impacto web:** Header/footer «Ingresar» y «Mi cuenta» → `/login` y `/mi-cuenta`; ambos **302** a `https://cumbre-erp-prod.web.app/login?view=customer_portal`. Hub ERP CTA → `/login`.
- **Impacto asistente IA:** Sin cambio copy; puede referir `/login` o `/mi-cuenta` como entrada cliente.
- **Despliegue:** WP prod vía `sync-wordpress-prod.sh` ✅ (2026-06-17). Cumbre `returnTo` alias listo local; prod ya honoraba `view=customer_portal` en URL post-login.
- **Validaciones:** curl prod `/login/` y `/mi-cuenta/` → 302 ERP login portal; home HTML header/footer links OK; `npm run test:customer-portal:routing` OK.
- **Pendientes:** QA browser Norberto (logout → gema-digital.com/login → portal trial); deploy Cumbre hosting opcional para alias `returnTo` (no bloqueante).

### 2026-06-17 — Fix routing portal cliente trial vs panel admin GEMA

- **Objetivo:** Trial `norberto@gema-digital.com` en `tenant_journey__journeyadcjo` debe ver **solo Portal Cliente** (no 32 módulos ERP). Admin GEMA (`info@`, `admin@`, `norberto@` en `tenant_gema_prod_interno`) conserva panel completo.
- **Causa raíz:** Claims JWT apuntaban a `tenant_gema_prod_interno` → `isGemaAdminPortalMode()` activo; login forzaba `command_center`; sidebar mostraba módulos Matriz.
- **Archivos cumbre-mirror:** `shared/customerPortal.ts` (`coerceViewForPortalMode`, `resolveDefaultAppView`), `src/App.tsx`, `src/components/AppSidebar.tsx`, `src/appPanelRouter.tsx`, `scripts/test-customer-portal-routing.ts`, `package.json` (`test:customer-portal:routing`, `prod:apply-claims:norberto-gema`).
- **Archivos GEMA:** `docs/PORTAL_CLIENTE_SELF_SERVICE_2026-06-17.md`, `docs/ACCESOS_Y_URLS_GEMA.md`.
- **Impacto web:** Sin cambio WP; redirect `/mi-cuenta` → `?view=customer_portal` ya operativo.
- **Impacto asistente IA:** Sin cambio copy; portal trial usa asistente embebido en CustomerPortalPanel.
- **Despliegue:** Claims trial re-aplicados vía ADC prod; `vite build` OK; **hosting prod pendiente** (`firebase login --reauth` + `npm run deploy:prod:hosting`).
- **Validaciones:** `npm run test:customer-portal:routing` OK; `prod:link:journey-trial-customer --apply-single-tenant-claims` OK (tenant `tenant_journey__journeyadcjo`, rol owner).
- **Pendientes:** Deploy hosting prod; Norberto debe **cerrar sesión y re-login** para refrescar JWT; restaurar claims GEMA con `prod:apply-claims:norberto-gema` cuando termine QA trial.

### 2026-06-17 — Documento consolidado accesos y URLs GEMA

- **Objetivo:** Punto único de consulta para URLs prod/beta/local, consolas Firebase/GCP, cuentas y roles, QA Juan Pérez, rutas de credenciales (sin secretos) y comandos deploy cuando Firebase CLI está bloqueado.
- **Archivos GEMA:** `docs/ACCESOS_Y_URLS_GEMA.md` (nuevo).
- **Impacto web:** Referencia operativa; sin cambios en WP ni hosting.
- **Impacto asistente IA:** Sin cambio copy; operadores pueden consultar URLs y cuentas desde un solo doc.
- **Despliegue:** Solo documentación local.
- **Validaciones:** Contenido cruzado con `PORTAL_CLIENTE_SELF_SERVICE`, `ADMIN_CUENTAS_GEMA`, `LISTO_PARA_PRUEBAS_NORBERTO`, `TRIAL_TARJETA_Y_FACTURACION_AUTO`, `PRUEBA_LOGIN_CLIENTE_HISTORIAL_CUPONES`, `.env.example`.
- **Pendientes:** Mantener doc al día tras deploy hosting/functions prod y resolución org policy GCP.

### 2026-06-17 — Trial 14 días con tarjeta + factura/recibo automáticos post-pago

- **Objetivo:** Gate trial con tarjeta Nave (Luhn + preauth sandbox) antes de provisioning; generar factura y recibo tras `pago_aprobado`, notificar email/WhatsApp y listar en portal Documentos.
- **Archivos GEMA:** `docs/TRIAL_TARJETA_Y_FACTURACION_AUTO_2026-06-17.md`; `wordpress/plugins/gema-payments-platform` v0.2.4 (REST trial/card-requirements, validate-format); `wordpress/plugins/gema-notifications-orchestrator` v0.2.7 (`billing.document.ready`).
- **Archivos cumbre-mirror:** `shared/trialCardVerification.ts`, `shared/billingDocuments.ts`, `shared/billingDocumentOrchestrator.ts`, `shared/adapters/naveGaliciaClient.ts`, `shared/provisionTrialTenant.ts`, `shared/billingWebhookProcessor.ts`, `shared/commercialEventNotifications.ts`, `shared/customerPortal.ts`, `functions/src/index.ts` (`verifyTrialCard`), `src/App.tsx`, `src/lib/firebaseConfig.ts`, `src/components/CustomerPortalPanel.tsx`, `src/lib/customerPortalTools.ts`, `firestore.rules`, `scripts/test-trial-card-verification.ts`, `scripts/test-billing-document-orchestrator.ts`, `scripts/lib/userJourneyProvisioning.ts`.
- **Impacto web:** Copy trial tarjeta en checkout WP; endpoints REST requisitos tarjeta; orchestrator envía factura/recibo/bundle documentos.
- **Impacto asistente IA:** Sin cambio copy comercial; pendiente mencionar tarjeta trial en KB soporte fase 2.
- **Despliegue:** Solo local; **sin deploy prod** (functions, rules, hosting, WP sync pendiente autorización Norberto).
- **Validaciones:** `npm run test:trial-card-verification` OK; `npm run test:billing-document-orchestrator` OK; `npm run test:nave-galicia-cobros-adapter` OK.
- **Pendientes:** Credenciales Nave Galicia prod; gate `gate_cobros_nave_galicia_real_bloqueado`; deploy functions+rules; `GEMA_NOTIFICATIONS_WP_URL`/secret en CF; teléfono cliente para WhatsApp; factura fiscal ARCA (MVP = HTML interno).

### 2026-06-17 — Agente soporte cliente v2 seguridad + política

- **Objetivo:** Elevar `cliente_soporte` a calidad producción con límites de seguridad en código (no solo prompt), KB por área, router out-of-scope y UI de capacidades/límites.
- **Archivos GEMA:** `docs/AGENTE_IA_SOPORTE_CLIENTE_2026-06-17.md` (matriz seguridad, KB, v2).
- **Archivos cumbre-mirror:** `shared/supportAgentPolicy.ts` (nuevo), `agenteSoporteCliente.ts`, `agenteSoporteClienteRuntime.ts`, `agenteChatbot.ts`, `agenteChatbotUserRest.ts`, `cumbreMultiAgentRouter.ts`, `CustomerPortalSupportChat.tsx`, `CustomerPortalPanel.tsx`, `scripts/test-cumbre-multi-agent-router.ts`.
- **Impacto web:** Sin cambios WordPress. Portal ERP: disclaimer Qué puede hacer / Límites en pestaña Asistente IA.
- **Impacto asistente IA:** Prompt v2 por rol; 15 entradas KB con gates de módulo; bloqueo cross-tenant/admin/credenciales/injection; rate limit 3 tickets/sesión; redacción PII en logs.
- **Despliegue:** Solo local cumbre-mirror; sin deploy prod.
- **Validaciones:** `npm run test:rules` OK; `test:cumbre-multi-agent-router` 12 route + 12 policy OK; `vite build` OK.
- **Pendientes fase 2:** KB CMS Firestore, seed perfil en provision trial, copy WP/asistente web, deploy functions.

### 2026-06-17 — Portal Cliente: WP prod + link trial; ERP hosting pendiente Firebase reauth

- **Objetivo:** Desplegar Portal Cliente MVP a prod (WP plugins, `portal_cliente_link`, redirect `/mi-cuenta`); validar reglas; documentar pasos QA Norberto.
- **Archivos GEMA:** `docs/PORTAL_CLIENTE_SELF_SERVICE_2026-06-17.md` (estado deploy); `docs/ADMIN_CUENTAS_GEMA_2026-06-17.md` (WP done + curl diagnostic); `wordpress/plugins/gema-cumbre-subdomains` 0.1.2 (fix `wp_redirect` externo, hook `init` prio 0).
- **Archivos cumbre-mirror:** `link-journey-trial-customer` ejecutado prod; panels/functions/rules **sin deploy** (Firebase CLI expirado).
- **Impacto web:** WP prod — orchestrator 0.2.6, subdomains 0.1.2; `/mi-cuenta` → `cumbre-erp-prod.web.app/?view=customer_portal` ✅; `GEMA_ADMIN_EMAIL` + CC admin@ activos.
- **Impacto asistente IA:** Sin cambio copy; pendiente fase 2 “mi cuenta / abrir ticket”.
- **Despliegue:** WP prod vía `sync-wordpress-prod.sh` (2× OK). ADC prod: `portal_cliente_link` + claims trial norberto@. **Bloqueado:** `deploy:prod:hosting`, `deploy:prod:functions`, `deploy:prod:firestore-rules` — `firebase login --reauth`.
- **Validaciones:** `npm run test:rules` OK; curl `/mi-cuenta/` → 302 ERP; `prod:link:journey-trial-customer` → `portalLinkCreated: true`, `claimsApplied: true`; mail diagnostic previo `email_sent: true`, CC admin@.
- **Pendientes:** Norberto — `npm run beta:repair:auth` + deploy hosting/functions/rules; login browser admin@ y portal cliente; crear ticket end-to-end; restaurar claims GEMA norberto@ post-QA.

### 2026-06-17 — Agente IA soporte cliente (portal self-service MVP)

- **Objetivo:** Clientes trial resuelven consultas/errores con asistente IA en portal (perfil `cliente_soporte`), no comercial; escalación a tickets.
- **Archivos GEMA:** `docs/AGENTE_IA_SOPORTE_CLIENTE_2026-06-17.md` (nuevo).
- **Archivos cumbre-mirror:** `shared/agenteChatbot.ts`, `agenteSoporteCliente.ts`, `agenteSoporteClienteRuntime.ts`, `agenteChatbotRuntime.ts`, `agenteChatbotEnrich.ts`, `agenteChatbotUserRest.ts`, `cumbreMultiAgentRouter.ts`, `agentPanelJobLite.ts`, `CustomerPortalSupportChat.tsx`, `CustomerPortalPanel.tsx`, `scripts/test-cumbre-multi-agent-router.ts`.
- **Impacto web:** Sin cambios WordPress. Portal ERP: nueva pestaña Asistente IA.
- **Impacto asistente IA:** Perfil soporte separado; mock + LLM gated con contexto cuenta/KB; creación ticket con transcript; admins GEMA mantienen `gema_comercial`.
- **Despliegue:** Solo local cumbre-mirror; **sin deploy prod** functions/hosting.
- **Validaciones:** `npm run test:rules` OK; `npm run test:cumbre-multi-agent-router` 7/7 OK; `vite build` OK. `npm run build` completo falla por TS6133 preexistentes en scripts journey (no tocados).
- **Pendientes fase 2:** KB CMS, seed perfil en provision trial, copy WP/asistente web, deploy functions, WhatsApp, routing subscriptionAgent callable desde portal.

### 2026-06-17 — Portal Cliente self-service MVP + bandeja admin soporte/cupones

- **Objetivo:** Portal logueado trial (cuenta, datos, tickets, facturación, cupones) + admin GEMA (panel completo, inbox tickets, cupones, CRM sync, email soporte@).
- **Archivos GEMA:** `docs/PORTAL_CLIENTE_SELF_SERVICE_2026-06-17.md`; WP orchestrator 0.2.6 (`support.ticket.created`); WP subdomains redirect `/mi-cuenta`.
- **Archivos cumbre-mirror:** `CustomerPortalPanel`, `SoporteAdminPanel`, `customerPortal.ts`, `supportTicketNotifications.ts`, `soporteTicketCrmSyncRunner`, reglas Firestore nuevas, nav split admin/cliente; `link-journey-trial-customer` escribe `portal_cliente_link`.
- **Impacto web:** `/mi-cuenta` → ERP portal (post-deploy WP). Tickets → soporte@ + info@ + admin@ vía orchestrator.
- **Impacto asistente IA:** Pendiente copy “mi cuenta / abrir ticket” (fase 2).
- **Despliegue:** WP prod OK (esta sesión); hosting + functions pendiente Firebase reauth.
- **Validaciones:** `npm run test:rules` OK; `portal_cliente_link` prod OK; `/mi-cuenta` redirect OK (subdomains 0.1.2).
- **Pendientes:** Deploy ERP hosting/functions; cupón → checkout; restaurar claims GEMA norberto@ post-QA trial.

### 2026-06-17 — admin@gema-digital.com administrador equivalente a info@

- **Objetivo:** `admin@gema-digital.com` e `info@gema-digital.com` con privilegios owner equivalentes en prod, alertas WP y bandeja soporte admin.
- **Archivos GEMA:** `docs/ADMIN_CUENTAS_GEMA_2026-06-17.md` (nuevo); `.env.example`; `scripts/sync-wordpress-prod.sh`; `scripts/fix-wordpress-smtp-remote.py`; `scripts/gema-cumbre-primer-tester-verify.sh`; plugins `gema-notifications-orchestrator`, `gema-leads-api` (`GEMA_ADMIN_EMAIL`).
- **Archivos cumbre-mirror:** `shared/gemaCumbreTenant.ts` (admin@ en `GEMA_CUMBRE_TESTER_OWNER_EMAILS`); `scripts/create-gema-cumbre-owner-users.ts` (`--email` filter); `package.json` — `gema:create-owner-users:prod`, `prod:apply-claims:info`, `prod:apply-claims:admin`, `prod:create-admin-user`.
- **Impacto web:** wp-config prod pendiente deploy — `GEMA_ADMIN_EMAIL=admin@gema-digital.com`, CC incluye admin@; orchestrator/leads envían alertas a info@ + admin@ + norberto@.
- **Impacto asistente IA:** Sin cambio copy; operadores admin documentados para handoff soporte.
- **Despliegue Firebase prod (ADC):** Usuario `admin@gema-digital.com` **creado** (`PJfmXBFs9wPOpn7B3vG0lW9nGos2`); claims owner `tenant_gema_prod_interno` aplicados (team 4/4 + `prod:apply-claims:admin`). WP prod sin sync remoto en este hito.
- **Validaciones:** Claims info@ y admin@ idénticos (`tenant_id` + `tenant_roles.owner`); `GEMA_ADMIN_OPERATOR_EMAILS` ya incluía admin@ en `customerPortal.ts`.
- **Pendientes:** Sync wp-config prod (`sync-wordpress-prod.sh`); login browser admin@ tras re-auth token; password admin@ = misma clave beta test (credenciales locales) — reset manual si se requiere clave distinta.

### 2026-06-17 — Ejecución fix login cliente trial (norberto@ → tenant journey)

- **Objetivo:** Habilitar login QA de Juan Pérez (norberto@gema-digital.com) en tenant trial `tenant_journey__journeyadcjo`, enriquecer lead CRM y documentar qué ve el cliente.
- **Archivos GEMA:** `docs/PRUEBA_LOGIN_CLIENTE_HISTORIAL_CUPONES_2026-06-17.md` (actualizado con resultados ejecución).
- **Archivos cumbre-mirror:** `scripts/link-journey-trial-customer.ts` — **ejecutado en prod** vía ADC.
- **Impacto web:** Sin deploy. Confirmado persistente: `/mi-cuenta` 404; cart REST sin cupones (`commercial_contact`).
- **Impacto asistente IA:** Cliente trial puede entrar al ERP; lead `ld_7849f8f4` enlazado a tenant trial para operadores GEMA.
- **Despliegue:** Solo ADC prod (miembro + claims + lead CRM); sin deploy web/functions.
- **Validaciones (ADC + HTTP prod):**
  - `npm run prod:link:journey-trial-customer` → `memberLinked: true`, `leadUpdated: true`.
  - `... --apply-single-tenant-claims` → claims verificados: `tenant_id=tenant_journey__journeyadcjo`, rol owner.
  - Miembro `miembros/yMO3rj5hWccCEsJQ0V6xJbzuKg93`: owner, Juan Pérez, Solar Norte.
  - Lead `ld_7849f8f4`: `tenant_provisionado_id`, `owner_uid`, `nombre_contacto=Juan Pérez`, 2 tareas.
  - `eventos_billing` trial: 0 eventos.
  - Cupones: **siguen sin existir**.
- **Pendientes:** (1) Norberto validar login browser (logout + refresh token); (2) restaurar claims GEMA post-QA con `prod:apply-claims`; (3) S09 auto email comercial; (4) org policy bridge HTTP; (5) portal WP mi-cuenta.

### 2026-06-17 — Auditoría login cliente trial (historial, cupones, CRM)

- **Objetivo:** Probar si el cliente trial Juan Pérez (norberto@gema-digital.com) puede login, ver historial/cupones y si está sync con CRM GEMA.
- **Archivos GEMA:** `docs/PRUEBA_LOGIN_CLIENTE_HISTORIAL_CUPONES_2026-06-17.md` (nuevo).
- **Archivos cumbre-mirror:** `scripts/link-journey-trial-customer.ts`, `npm run prod:link:journey-trial-customer` (nuevo; **ejecutado 2026-06-17** — ver entrada siguiente).
- **Impacto web:** Sin cambio deploy. Confirmado: `/login` → CTA ERP; `/mi-cuenta` 404; cart REST activo sin cupones; checkout `commercial_contact`.
- **Impacto asistente IA:** Documentado gap: cliente trial no entra a su tenant; asistente puede referenciar lead `ld_7849f8f4` en CRM GEMA pero no historial billing del trial.
- **Despliegue:** Solo local (auditoría + script).
- **Validaciones (ADC + HTTP prod):**
  - norberto@ existe Auth; claims → `tenant_gema_prod_interno` (no trial).
  - Tenant `tenant_journey__journeyadcjo`: 33 módulos trial, 0 eventos_billing, owners sintéticos `journey_adc_*@`.
  - CRM `ld_7849f8f4`: email/empresa OK, 2 tareas, 4 interacciones; **sin link tenant trial**.
  - Cupones: **no existen**; promo −20% solo en planes hardcoded.
- **Pendientes:** (1) Norberto ejecutar `prod:link:journey-trial-customer` + claims QA; (2) S09 usar email comercial real; (3) org policy bridge HTTP; (4) portal cliente WP (roadmap).

### 2026-06-17 — CRM journey_001 confirmado post-ADC login

- **Objetivo:** Verificar lead Juan Pérez en CRM Cumbre prod tras sync ADC exitoso; marcar WP 1868/1799; actualizar docs NO→YES.
- **Archivos GEMA:** `docs/VERIFICACION_CONTACTOS_JOURNEY_001_2026-06-17.md`, `docs/DESBLOQUEO_CRM_JOURNEY_2026-06-17.md`; `scripts/mark-wp-lead-cumbre-synced.sh` (nuevo).
- **Archivos cumbre-mirror:** `prod:sync:wp-lead-adc` presets `juan-perez-1868` / `juan-perez-1799` (ejecutados por Norberto).
- **Impacto web:** WP leads 1868/1799 → `cumbre_sync_pending=0`, `cumbre_lead_id=ld_7849f8f4`, `cumbre_sync_source=adc_fallback`. Bridge HTTP sigue 403.
- **Impacto asistente IA:** Lead visible en CRM prod — asistente puede referenciar contacto `ld_7849f8f4` / Solar Norte.
- **Despliegue:** Solo SSH meta WP + consulta Firestore ADC; sin deploy.
- **Validaciones:**
  - Firestore `empresas_clientes/ld_7849f8f4`: `nombre_contacto=Juan Pérez`, `email_principal=norberto@gema-digital.com`, `razon_social=Solar Norte Energías SA`, **2 tareas**, 2 eventos CRM.
  - WP SSH: meta 1868/1799 actualizada OK.
  - `test:journeys:1:real --real` (S09 trial): **pendiente** — no ejecutado en esta sesión.
- **Pendientes:** (1) ticket org policy → bridge HTTP `cumbre_synced:true`; (2) re-run `JOURNEY_REAL_NOTIFICATIONS=1 npm run test:journeys:1:real` para S09 trial real; (3) allowlist SMTP relay.

### 2026-06-17 — Desbloqueo CRM journey_001 (NO→YES intento)

- **Objetivo:** Desbloquear sync WP→Cumbre CRM, tareas y trial real para Juan Pérez (leads WP 1868/1799).
- **Archivos GEMA:** `docs/DESBLOQUEO_CRM_JOURNEY_2026-06-17.md` (nuevo); `scripts/trigger-wp-cumbre-retry.sh` (nuevo).
- **Archivos cumbre-mirror:** `scripts/sync-wp-lead-adc-fallback.ts`, `scripts/repair-gema-wp-ingest-sa-key.sh`, `scripts/lib/resolveGemaCumbreTenantId.ts`; `userJourneyLeadsFallback.ts` tenant prod; `package.json` — `prod:sync:wp-lead-adc`, `prod:repair:wp-ingest-sa`, `test:journeys:1:real` + flag `--real` (S09).
- **Impacto web:** Retry manual cola WP ejecutado (`gema_leads_api_process_retry_queue`); leads 1868/1799 siguen `cumbre_sync_pending=1` (ingest 403). WP prod sin `GEMA_CUMBRE_INGEST_GCP_SA_JSON_PATH`.
- **Impacto asistente IA:** Sin cambio runtime; leads siguen ausentes en CRM hasta ADC/org policy.
- **Despliegue:** Solo local + SSH retry; sin deploy functions/WP.
- **Validaciones:**
  - ADC: `invalid_rapt` (check-beta-adc FAIL).
  - `wordpressIngestLead` POST/OPTIONS prod → **403**.
  - `prod:sync:wp-lead-adc --preset juan-perez-1868` → FAIL invalid_rapt.
  - WP retry leads 1868/1799 → processed, sync still failed.
  - SA JSON ingest: **0 bytes**; repair no ejecutado (org policy key creation).
- **Pendientes:** (1) `gcloud auth application-default login` interactivo; (2) ticket org policy → `post-org-policy:fix`; (3) re-run sync ADC + journey `--real`; (4) opcional SA key + wp-config path.

### 2026-06-17 — Verificación contactos journey_001 (WP vs Cumbre)

- **Objetivo:** Confirmar si Juan Pérez / Solar Norte / norberto@gema-digital.com quedaron guardados en WordPress prod y CRM Cumbre tras corridas journey_001.
- **Archivos:** `docs/VERIFICACION_CONTACTOS_JOURNEY_001_2026-06-17.md` (nuevo).
- **Impacto web:** Sin cambios código. Evidencia: 891 `gema_lead`; journey_001 en WP IDs 1868 y 1799; 0 syncs Cumbre exitosos; 490 con `cumbre_sync_pending=1`.
- **Impacto asistente IA:** Sin cambio; leads existen en WP pero no en CRM — asistente no vería contacto en Cumbre.
- **Despliegue:** Solo consulta SSH prod + evidencia runner; sin deploy.
- **Validaciones:** SSH `gema-web-server` wp-cli; meta lead 1868/1799; `wordpressIngestLead` OPTIONS → 403; Firestore query bloqueada (ADC `invalid_rapt`, SA JSON vacío).
- **Pendientes:** Ticket org policy GCP; restaurar SA ingest; re-auth ADC; allowlist SMTP relay IP; re-run journey tras fix para CRM + tareas.

### 2026-06-17 — Asuntos email/WhatsApp admin legibles (sin journey_001)

- **Objetivo:** Reemplazar IDs internos `journey_001` en asuntos y encabezados visibles de alertas admin/cliente por etiquetas comerciales en español (nombre, empresa, motivo).
- **Archivos web:** `wordpress/plugins/gema-notifications-orchestrator/gema-notifications-orchestrator.php` v0.2.5 — `gema_notifications_build_admin_email_subject()` usa `[GEMA Admin] {evento} — {nombre} ({empresa})`; sanitizador `gema_notifications_sanitize_user_facing_text()` en cuerpos/WhatsApp admin; campo `journey_id` removido del cuerpo admin.
- **Archivos web:** `wordpress/plugins/gema-leads-api/gema-leads-api.php` v0.2.4 — asunto journey QA `[GEMA Admin] Nuevo contacto web — {nombre} ({empresa})`; sanitiza `rich_message_admin`.
- **Archivos cumbre-mirror:** `scripts/lib/userJourneyPricing.ts` — encabezado admin `[GEMA Admin] Nuevo contacto web — Juan Pérez · Solar Norte Energías SA` (sin `journey_001` ni inglés `LEAD CAPTURED`); `Motivo:` en lugar de `Intent:`.
- **Impacto web:** Asuntos admin legibles para ventas; `journey_id` solo en metadata/logs internos.
- **Impacto asistente IA:** Sin cambio copy asistente; payloads conservan `journey_id` en metadata.
- **Despliegue:** Prod ✅ `SKIP_WP_CONFIG=1 bash scripts/sync-wordpress-prod.sh` 2026-06-17 — orchestrator v0.2.5 + leads-api v0.2.4 activos; smoke HTTP OK.
- **Validaciones:** `php -l` plugins OK; deploy prod smoke curl OK; ejemplos before/after abajo. Re-run `test:journeys:1:real` pendiente para bandeja con nuevos asuntos WhatsApp (cumbre-mirror).
- **Pendientes:** Re-ejecutar `test:journeys:1:real` para validar bandeja con nuevos asuntos; Hermes VPS usará textos nuevos en próxima corrida cumbre-mirror.

**Ejemplos asuntos admin (journey_001 — Juan Pérez · Solar Norte Energías SA):**

| Evento | Antes | Después |
|--------|-------|---------|
| Lead capturado | `[GEMA Admin journey_001] Contacto web — Juan Pérez` | `[GEMA Admin] Nuevo contacto web — Juan Pérez (Solar Norte Energías SA)` |
| Trial iniciado | `[GEMA Admin journey_001] Trial iniciado — Juan Pérez` | `[GEMA Admin] Trial iniciado — Juan Pérez (Solar Norte Energías SA)` |
| Pre-cargo día 14 | `[GEMA Admin journey_001] Pre-cargo día 14 — Juan Pérez` | `[GEMA Admin] Pre-cargo día 14 — Juan Pérez (Solar Norte Energías SA)` |
| WhatsApp admin (1ª línea) | `🟢 [GEMA journey_001] LEAD CAPTURED` | `🟢 [GEMA Admin] Nuevo contacto web — Juan Pérez · Solar Norte Energías SA` |

### 2026-06-17 — Re-check email Plan B (sigue bloqueado Admin)

- **Objetivo:** Verificar si Norberto completó allowlist Google Admin; si no, documentar siguiente paso claro (Admin IP vs App Password).
- **Archivos:** `docs/EMAIL_SIGUIENTE_PASO_NORBERTO_2026-06-17.md` (nuevo); `REGISTRO_DE_TRABAJO_GEMA.md`.
- **Impacto web:** Sin cambios en prod (config relay ya OK). Diagnostic sigue `email_sent: false`.
- **Impacto asistente IA:** Sin cambio; Journey 001 real no ejecutado (gate `email_sent: true`).
- **Despliegue:** Solo local (doc + pruebas HTTP/SSH).
- **Validaciones:**
  - curl diagnostic `{}` → **`email_sent: false`**, `admin_email: info@`, `primary_to: info@`.
  - SSH prod wp_mail_smtp → `smtp-relay.gmail.com:587`, auth off, From `info@`.
  - PHPMailer trace → **550 5.7.0 Mail relay denied [34.44.222.151]**.
  - Credenciales: **sin** `GEMA_SMTP_APP_PASSWORD` (`~/.credentials` ausente; `wordpress-smtp.local` solo CyberPanel).
- **Pendientes:** Norberto — **Camino A (recomendado):** Google Admin → SMTP relay → allowlist `34.44.222.151`; **o Camino B:** App Password + `fix-wordpress-smtp-prod.sh` con `smtp.gmail.com`. Ver `docs/EMAIL_SIGUIENTE_PASO_NORBERTO_2026-06-17.md`; luego curl + Journey 001.

### 2026-06-17 — Plan B Google Workspace SMTP relay (WordPress prod)

- **Objetivo:** Desbloquear email prod tras 550 persistente en CyberPanel (`mail.cyberpersons.com`) pese a DNS/DKIM verified en panel.
- **Archivos:** `scripts/fix-wordpress-smtp-prod.sh`, `scripts/fix-wordpress-smtp-remote.py` (`GEMA_SMTP_MODE=GOOGLE_RELAY`); `docs/PLAN_B_GOOGLE_SMTP_RELAY_2026-06-17.md`.
- **Impacto web:** WP Mail SMTP prod → `smtp-relay.gmail.com:587` TLS, auth off, From `info@gema-digital.com`; `admin_email` y `GEMA_SALES_ALERT_*` corregidos en wp-config.
- **Impacto asistente IA:** Sin cambio directo; journeys/orchestrator usarán relay cuando Google permita IP.
- **Despliegue:** Prod VM `gema-web-server` — config SMTP aplicada 2026-06-17 (sin sync plugins completo en corrida directa).
- **Validaciones:** Egress IP `34.44.222.151` confirmada; wp_mail trace → **550 5.7.0 Mail relay denied**; curl diagnostic → `email_sent: false`.
- **Pendientes:** Norberto — Google Admin → Gmail → Routing → SMTP relay → allowlist IP `34.44.222.151`; re-probar curl hasta `email_sent: true`.

### 2026-06-16 — Guía paso a paso email info@gema-digital.com (Norberto)

- **Objetivo:** Documento operativo para desbloquear entrega email prod (CyberPanel + Cloudflare + curl + journey 001).
- **Archivos:** `docs/PASO_A_PASO_EMAIL_GEMA_2026-06-16.md` (nuevo).
- **Impacto web:** Sin cambio código; acciones manuales DNS CyberPanel/Cloudflare + verificación WP Mail SMTP.
- **Impacto asistente IA:** Sin cambio directo.
- **Despliegue:** Solo documentación local.
- **Validaciones:** Guía referencia curl diagnostic, secret desde wp-config SSH, fix zsh `#` / `TU_SECRET`.
- **Pendientes:** Norberto ejecutar checklist §10; confirmar bandeja info@ tras DNS verified.

### 2026-06-16 — Fix SMTP email journeys (P0 entregabilidad)

- **Objetivo:** Diagnosticar y corregir silencio total de emails en journeys reales (WhatsApp OK, 0 emails).
- **Causa raíz:** WP Mail SMTP **no instalado** en prod; `wp_mail` vía PHP `mail()` falso positivo. Tras instalar plugin + CyberPanel SMTP: **550 sender domain not verified** — falta verificar `gema-digital.com` en platform.cyberpersons.com + SPF Cloudflare `include:spf.cyberpersons.com`.
- **Archivos:** `scripts/fix-wordpress-smtp-prod.sh`, `scripts/fix-wordpress-smtp-remote.py`; plugins v0.2.2+ prod; `~/.cumbre-mirror/.credentials/gema-wp-notifications.local`; `userJourneyNotifications.ts`; `docs/FIX_EMAIL_SMTP_JOURNEYS_2026-06-16.md`.
- **Impacto web:** WP Mail SMTP v4.8 activo; From `info@gema-digital.com`; alertas info@ + CC norberto@; contacto devuelve `email_sent` explícito.
- **Impacto asistente IA:** Sin cambio directo.
- **Despliegue:** Prod VM gema-web-server 2026-06-16.
- **Validaciones:** Contact POST → `email_sent: false` (domain blocked); pipeline código OK.
- **Pendientes:** Verificar dominio CyberPanel + SPF Cloudflare; confirmar bandeja; re-run journeys.

### 2026-06-16 — Plantilla bienvenida trial ES (logo) + journey 001 único — CERRADO

- **Objetivo:** Mensaje comercial 100 % español con logo, fechas DD-MM-YYYY, «paquete elegido», versión reducida trial; correr **solo journey_001** con notificaciones reales antes de 002.
- **Archivos (`~/.cumbre-mirror`):** `userJourneyPricing.ts` (`formatDateDdMmYyyy`, `buildJourneyClientWelcomeHtml`, plantilla WA/email), `userJourneyNotifications.ts`, `package.json` (`test:journeys:1:real`).
- **Archivos web:** `wordpress/plugins/gema-notifications-orchestrator/gema-notifications-orchestrator.php` v0.2.3+ — email HTML con logo GEMA.
- **Docs:** `docs/PLANTILLA_BIENVENIDA_TRIAL_ES_2026-06-16.md`, `docs/JOURNEY_001_UNICO_2026-06-16.md`, `docs/DEPLOY_JOURNEY_001_2026-06-16.log`, `docs/JOURNEY_001_RUN_2026-06-16.log`.
- **Impacto web:** Deploy prod OK; email cliente trial HTML cuando orchestrator recibe `rich_message_html_client`.
- **Impacto asistente IA:** Sin cambio directo (`package_snapshot` alineado).
- **Despliegue:** `SKIP_WP_CONFIG=1 bash scripts/sync-wordpress-prod.sh` — orchestrator v0.2.3+ activo en prod.
- **Validaciones:** `JOURNEY_REAL_NOTIFICATIONS=1 npm run test:journeys:1:real` → **1/1 PASS** · Hermes **4/4** · journeys 002–005 **no ejecutados**.
- **Pendientes:** OK Norberto antes de journey 002; `GEMA_NOTIFICATIONS_WEBHOOK_SECRET` en runner para S07 orchestrator (hoy Hermes fallback).

### 2026-06-16 — Primeros 5 journeys únicos + fix rate limit Journey QA (v0.2.3)

- **Objetivo:** Solo 5 usuarios (001–005) con mensajes WA/email distintos; evitar 429 del batch anterior de 10; **no** ejecutar 006–010 sin aprobación Norberto.
- **Código WP:** `gema-leads-api` v0.2.3 — bucket Journey QA **5 POST / 95 s** (`utm journey_real_*` o `X-Gema-Journey-QA: 1` + secret compartido con `GEMA_NOTIFICATIONS_WEBHOOK_SECRET`); global sigue 10/15 min.
- **Cumbre mirror:** `userJourneyStages.ts` — header `X-Gema-Journey-QA` + mensaje 429 real del body; `test:journeys:5:real` ya existía.
- **Deploy:** `SKIP_WP_CONFIG=1 bash scripts/sync-wordpress-prod.sh` ✅
- **Corrida:** `JOURNEY_REAL_NOTIFICATIONS=1 JOURNEY_CONTACT_POST_DELAY_MS=5000 npm run test:journeys:5:real` (tras 95 s reset cupo QA). **5/5 journeys PASS** · **Hermes 12/12** · **S03 HTTP 200: 3/5** (001–003 emails wp_mail; 004–005 cupo QA residual).
- **Docs:** `docs/PRIMEROS_5_JOURNEYS_UNICOS_2026-06-16.md` (cuerpos exactos + tabla rate limits / cuándo esperar 95s vs 15min).
- **Impacto web:** POST `/contact` journey con carritos únicos; CC norberto@ en alertas ventas.
- **Impacto asistente IA:** Sin cambio copy.
- **Validaciones:** Probe prod confirma mensaje `Journey QA rate limit exceeded (5 per 95s)`; WA admin diferenciados por intent (🟢/🔴/🟡).
- **Pendientes:** Aprobación Norberto para 006–010; exportar `GEMA_NOTIFICATIONS_WEBHOOK_SECRET` en runner para emails S07 orchestrator; re-run 004–005 contacto tras 95s si se desean 5 emails.

### 2026-06-16 — JOURNEY_REAL_MODE implementado + corrida REAL 10 journeys (honesta)

- **Objetivo:** Dejar de reportar MOCK 500/500 como éxito; ejecutar 10 journeys REAL (pagos sandbox solo S08) para revisión Norberto.
- **Código (`~/.cumbre-mirror`):** `userJourneyRealMode.ts`, `userJourneyProvisioning.ts`, `userJourneyLeadsFallback.ts`, `userJourneyAdminDb.ts`; `userJourneyStages.ts` (realMode, S08 mock-only, ADC lead fallback); `run-user-journey-simulation.ts` (`--real`, doc auto `PRIMEROS_10_JOURNEYS_REALES`); `npm run test:journeys:10:real`.
- **GEMA:** `scripts/run-user-journey-simulation.sh` modo `real`; `docs/PRIMEROS_10_JOURNEYS_REALES_2026-06-16.md`; disclaimer en `docs/USER_JOURNEY_500_COMPLETO_2026-06-16.md`.
- **Corrida:** `JOURNEY_REAL_MODE=1 npm run test:journeys:10:real` (~16.6 min). **Hermes 20/20 OK** → WhatsApp admin. **S03 1/10** (9× HTTP 429 WP rate limit). **S09 trial 0/4** (queue timeout org policy + bug Firestore settings, corregido post-corrida).
- **Impacto web:** POST reales a `/wp-json/gema/v1/contact` y `/agent/chat`; emails vía `wp_mail` solo en contactos que pasaron 429.
- **Impacto asistente IA:** Sin cambio.
- **Despliegue:** Solo local runner; sin deploy prod adicional en esta entrada.
- **Validaciones:** Hermes direct `beta:hermes:direct-local` OK; probe contact HTTP 200 `cumbre_synced=false`.
- **Pendientes:** Esperar 15 min y re-run 10 real sin probe previo; org policy GCP para bridge/sync; `GEMA_NOTIFICATIONS_WEBHOOK_SECRET` en runner para emails orchestrator (hoy Hermes fallback S07).

### 2026-06-16 — Fix SMTP email journeys (P0 entregabilidad)

- **Objetivo:** Diagnosticar y corregir silencio total de emails en journeys 001–010 reales (WhatsApp OK, 0 emails).
- **Causa raíz:** WP Mail SMTP **no instalado** en prod (`wp_mail` → PHP `mail()` falso positivo). Tras instalar: **550 sender domain not verified** en CyberPanel Cloud — falta verificar `gema-digital.com` + SPF `include:spf.cyberpersons.com` en Cloudflare.
- **Archivos:** `scripts/fix-wordpress-smtp-prod.sh`, `scripts/fix-wordpress-smtp-remote.py`; WP plugins v0.2.2 desplegados prod; `~/.cumbre-mirror/.credentials/gema-wp-notifications.local`; `userJourneyNotifications.ts` (auto-carga secret); `docs/FIX_EMAIL_SMTP_JOURNEYS_2026-06-16.md`.
- **Impacto web:** WP Mail SMTP v4.8 activo; From `info@gema-digital.com`; alertas `info@` + CC `norberto@gema-digital.com`; orchestrator welcome email con breakdown comercial; contacto devuelve `email_sent` explícito.
- **Impacto asistente IA:** Sin cambio directo.
- **Despliegue:** Prod VM `gema-web-server` — plugins + SMTP config aplicados 2026-06-16.
- **Validaciones:** Contact POST → `email_sent: false` (SMTP domain blocked); orchestrator REST acepta webhook secret; WhatsApp Hermes previo 20/20 OK.
- **Pendientes:** Norberto — verificar dominio en platform.cyberpersons.com + SPF Cloudflare; re-run `npm run test:journeys:10:real-notifications`; confirmar bandeja.


- **Objetivo:** Corregir mensajes WhatsApp genéricos (sin plan/importe post-trial) y silencio total de emails en primeros 10 journeys reales.
- **Archivos:** `~/.cumbre-mirror/scripts/lib/userJourneyPricing.ts`, `userJourneyNotifications.ts`, `userJourneyStages.ts`; WP `gema-leads-api` v0.2.2, `gema-notifications-orchestrator` v0.2.2; `scripts/sync-wordpress-prod.sh`; `docs/FIX_WHATSAPP_EMAIL_JOURNEYS_2026-06-16.md`; `docs/PRIMEROS_10_JOURNEYS_2026-06-16.md`.
- **Impacto web:** Contacto web con bypass rate limit journey; CC `norberto@gema-digital.com`; alertas admin orchestrator; endpoint diagnóstico SMTP; wp-config prod `GEMA_SALES_ALERT_CC` + teléfono admin WhatsApp corregido.
- **Impacto asistente IA:** Sin cambio directo.
- **Despliegue:** **Pendiente aprobación** — ejecutar `SKIP_WP_CONFIG=1 bash scripts/sync-wordpress-prod.sh`; agregar `GEMA_SALES_ALERT_CC` en wp-config prod.
- **Validaciones:** Re-run REAL 2026-06-16T21:05 — Hermes **20/20** con templates `gema_lead_admin_alert`, `gema_package_reject_admin`, `gema_trial_started_admin`, `gema_handoff_comercial_admin`, `gema_trial_charge_alert`; S03 aún 429 sin deploy; email pendiente post-deploy.
- **Pendientes:** Secret orchestrator en runner local; confirmar SMTP prod entrega; org policy GCP sync leads.

### 2026-06-16 — Pinterest API Trial aprobado (GEMA Digital Serie)

- **Objetivo:** Registrar aprobación Trial Pinterest y desbloquear OAuth + publicación serie V02–V40 en GemaDigitalERP.
- **App:** `GEMA Digital Serie` · App ID `1581000` · cuenta `info@gema-digital.com` · email aprobación 2026-06-15.
- **Archivos:** `15-Produccion-Audiovisual/marketing/03-produccion/00-PINTEREST-APP-REGISTRO-FORMULARIO.md`, `~/.cumbre-mirror/docs/tramites/runbooks/RUNBOOK_REDES_SOCIALES_CUMBRE.md`.
- **Impacto web:** Sin cambio directo (pins video opcionales requieren carátulas públicas en theme).
- **Impacto asistente IA:** Sin cambio directo.
- **Despliegue:** Solo local / scripts OAuth; secretos en `secrets/.env.social` (no repo).
- **Validaciones:** Pendiente — portal Configure + `autorizar-pinterest-token.py` + `verificar-pinterest-token.py`.
- **Pendientes:** Copiar App secret; OAuth; batch `--image-only`; Standard access si Trial limita; app separada Cumbre Marketing para tenants.

### 2026-06-16 — Journeys 351–500 simulación 500 E2E (MOCK) — cierre **500/500**

- **Objetivo:** Completar suite 500; tramo personas 351–500.
- **Comando (`~/.cumbre-mirror`):** `npm run test:journeys:500 -- --offset 350 --limit 150` → **150/150 PASS**, exit 0 (~3.0 s); Hermes **150 stubs**. Validación tablas: batches `--offset 350|400|450 --limit 50` → **50/50** cada uno.
- **Docs GEMA:** `docs/JOURNEYS_351_500_FINAL_2026-06-16.md` (tabla 150 journeys); `docs/USER_JOURNEY_500_COMPLETO_2026-06-16.md` (resumen ejecutivo 500); `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` merge `allJourneys` 351–500.
- **Impacto web:** Sin POST contacto masivo; S01 muestra real en subset; resto MOCK/stub.
- **Impacto asistente IA:** Sin cambio copy/conocimiento.
- **Despliegue:** Solo local mirror — sin deploy.
- **Validaciones:** Acumulado **500/500 PASS**, **0 FAIL**, **0 BLOCKED** MOCK; etapas globales **4300 PASS / 1700 SKIP** (patrón intent path).
- **Pendientes:** `test:journeys:500:live` por tramos post org policy GCP; E2E `--with-e2e` opcional.



### 2026-06-16 — Journeys 301–350 simulación 500 E2E (MOCK)

- **Objetivo:** Continuar suite 500; lote personas 301–350 (`--offset 300 --limit 50`).
- **Comando (`~/.cumbre-mirror`):** `npm run test:journeys:500 -- --offset 300 --limit 50` → **50/50 PASS**, exit 0 (~2.3 s); S03 MOCK (sin POST WP); Hermes **50 stubs**.
- **Docs GEMA:** `docs/JOURNEYS_301_350_2026-06-16.md` (tabla 50 journeys); `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` actualizado (`personaOffset`: 300, `allJourneys` 301–350).
- **Impacto web:** Sin POST contacto; muestra web real S01 en subset (GET `/` 200); resto MOCK/stub.
- **Impacto asistente IA:** Sin cambio copy/conocimiento.
- **Despliegue:** Solo local mirror — sin deploy.
- **Validaciones:** `journeysSummary` pass 50 fail 0 blocked 0; etapas S06–S12 con SKIP esperado por intent path (40/30/20 PASS por etapa).
- **Pendientes:** Lote 351–400 (`--offset 350 --limit 50`); acumular hasta 500/500 MOCK; LIVE por tramos post org policy GCP.

### 2026-06-16 — Journeys 251–300 simulación 500 E2E (MOCK)

- **Objetivo:** Continuar suite 500; lote personas 251–300 (`--offset 250 --limit 50`).
- **Comando (`~/.cumbre-mirror`):** `npm run test:journeys:500 -- --offset 250 --limit 50` → **50/50 PASS**, exit 0 (~3.0 s); S03 MOCK (sin POST WP); Hermes **50 stubs**.
- **Docs GEMA:** `docs/JOURNEYS_251_300_2026-06-16.md` (tabla 50 journeys); `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` actualizado (`personaOffset`: 250, `allJourneys` 251–300).
- **Impacto web:** Sin POST contacto; muestra web real S01 en subset (GET ERP/precios 200); resto MOCK/stub.
- **Impacto asistente IA:** Sin cambio copy/conocimiento.
- **Despliegue:** Solo local mirror — sin deploy.
- **Validaciones:** `journeysSummary` pass 50 fail 0 blocked 0; etapas S06–S12 con SKIP esperado por intent path (40/30/20 PASS por etapa).
- **Pendientes:** *(cerrado — ver lote 301–350)*

### 2026-06-16 — Journeys 201–250 simulación 500 E2E (MOCK)

- **Objetivo:** Continuar suite 500; lote personas 201–250 (`--offset 200 --limit 50`).
- **Comando (`~/.cumbre-mirror`):** `npm run test:journeys:500 -- --offset 200 --limit 50` → **50/50 PASS**, exit 0 (~3.8 s); S03 MOCK (sin POST WP); Hermes **50 stubs**.
- **Docs GEMA:** `docs/JOURNEYS_201_250_2026-06-16.md` (tabla 50 journeys); `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` actualizado (`personaOffset`: 200, `allJourneys` 201–250).
- **Impacto web:** Sin POST contacto; muestra web real S01 en subset (GET ERP/precios 200); resto MOCK/stub.
- **Impacto asistente IA:** Sin cambio copy/conocimiento.
- **Despliegue:** Solo local mirror — sin deploy.
- **Validaciones:** `journeysSummary` pass 50 fail 0 blocked 0; etapas S06–S12 con SKIP esperado por intent path (40/30/20 PASS por etapa).
- **Pendientes:** Lote 251–300 (`--offset 250 --limit 50`); acumular hasta 500/500 MOCK; LIVE por tramos post org policy GCP.

### 2026-06-16 — Journeys 151–200 simulación 500 E2E (MOCK)

- **Objetivo:** Continuar suite 500; lote personas 151–200 (`--offset 150 --limit 50`).
- **Comando (`~/.cumbre-mirror`):** `npm run test:journeys:500 -- --offset 150 --limit 50` → **50/50 PASS**, exit 0 (~0.9 s); S03 MOCK (sin POST WP); Hermes **50 stubs**.
- **Docs GEMA:** `docs/JOURNEYS_151_200_2026-06-16.md` (tabla 50 journeys); `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` actualizado (`personaOffset`: 150, `allJourneys` 151–200).
- **Impacto web:** Sin POST contacto; muestra web real S01 en subset (GET ERP/precios 200); resto MOCK/stub.
- **Impacto asistente IA:** Sin cambio copy/conocimiento.
- **Despliegue:** Solo local mirror — sin deploy.
- **Validaciones:** `journeysSummary` pass 50 fail 0 blocked 0; etapas S06–S12 con SKIP esperado por intent path (40/30/20 PASS por etapa).
- **Pendientes:** Lote 201–250 (`--offset 200 --limit 50`); acumular hasta 500/500 MOCK; LIVE por tramos post org policy GCP.

### 2026-06-16 — Journeys 101–150 simulación 500 E2E (MOCK)

- **Objetivo:** Continuar suite 500; lote personas 101–150 (`--offset 100 --limit 50`).
- **Comando (`~/.cumbre-mirror`):** `npm run test:journeys:500 -- --offset 100 --limit 50` → **50/50 PASS**, exit 0 (~1.7 s); S03 MOCK (sin POST WP); Hermes **50 stubs**.
- **Docs GEMA:** `docs/JOURNEYS_101_150_2026-06-16.md` (tabla 50 journeys); `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` actualizado (`personaOffset`: 100, `allJourneys` 101–150).
- **Impacto web:** Sin POST contacto; muestra web real S01 en subset (GET ERP/precios 200); resto MOCK/stub.
- **Impacto asistente IA:** Sin cambio copy/conocimiento.
- **Despliegue:** Solo local mirror — sin deploy.
- **Validaciones:** `journeysSummary` pass 50 fail 0 blocked 0; etapas S06–S12 con SKIP esperado por intent path (40/30/20 PASS por etapa).
- **Pendientes:** Lote 151–200 (`--offset 150 --limit 50`); acumular hasta 500/500 MOCK; LIVE por tramos post org policy GCP.

### 2026-06-16 — Journeys 51–100 simulación 500 E2E (MOCK)

- **Objetivo:** Continuar suite 500; lote personas 51–100 (`--offset 50 --limit 50`).
- **Comando (`~/.cumbre-mirror`):** `npm run test:journeys:500 -- --offset 50 --limit 50` → **50/50 PASS**, exit 0 (~1.4 s); S03 MOCK (sin POST WP); Hermes **50 stubs**.
- **Docs GEMA:** `docs/JOURNEYS_51_100_2026-06-16.md` (tabla 50 journeys); `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` actualizado (`personaOffset`: 50, `allJourneys` 51–100).
- **Impacto web:** Sin POST contacto; muestra web real S01 en subset (GET `/erp/precios` 200); resto MOCK/stub.
- **Impacto asistente IA:** Sin cambio copy/conocimiento.
- **Despliegue:** Solo local mirror — sin deploy.
- **Validaciones:** `journeysSummary` pass 50 fail 0 blocked 0; etapas S06–S12 con SKIP esperado por intent path (40/30/20 PASS por etapa).
- **Pendientes:** Lote 101–150 (`--offset 100 --limit 50`); acumular hasta 500/500 MOCK; LIVE por tramos post org policy GCP.

### 2026-06-16 — Journeys 11–50 simulación 500 E2E (MOCK)

- **Objetivo:** Continuar suite 500 tras primeros 10 + fix throttle 429; lote personas 11–50.
- **Comando (`~/.cumbre-mirror`):** `npm run test:journeys:500 -- --offset 10 --limit 40` → **40/40 PASS**, exit 0 (~1 s); S03 MOCK (sin POST WP); Hermes **40 stubs**.
- **Script:** `run-user-journey-simulation.ts` — soporte `--offset N` (slice sobre pool `offset+limit`); `allJourneys` cuando batch ≤50.
- **Docs GEMA:** `docs/JOURNEYS_11_50_2026-06-16.md` (tabla 40 journeys); `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` actualizado (offset 10).
- **Impacto web:** Sin POST contacto en este lote; muestra web real S01/S02 según reglas mock (no `--real-web-all`).
- **Impacto asistente IA:** Sin cambio copy/conocimiento.
- **Despliegue:** Solo local mirror — sin deploy.
- **Validaciones:** JSON `journeysSummary` pass 40 fail 0; informe markdown generado.
- **Pendientes:** Lote 51–90 (`--offset 50 --limit 40`); acumular hasta 500; LIVE por tramos si se requiere exposición GCP.

### 2026-06-16 — Re-ejecución primeros 10 journeys 500 E2E (MOCK + LIVE)

- **Objetivo:** Completar ejecución pendiente de `test:journeys:500 --limit 10` y LIVE; informe honesto para Norberto.
- **Comandos (`~/.cumbre-mirror`):**
  - `npm run test:journeys:500 -- --limit 10` → **10/10 journeys**, exit 0; S01/S02 REAL; S03 **10× HTTP 429 WP** (PASS `[PARTIAL_GCP]`); S04–S12 MOCK/stub; Hermes **10 stubs**.
  - `npm run test:journeys:500:live -- --limit 10` → **10/10 PASS** runner; S03/S04 **BLOCKED** org policy GCP; pagos REAL en 4 personas; trial BLOCKED; Hermes **0**.
- **Docs GEMA:** `docs/PRIMEROS_10_JOURNEYS_2026-06-16.md` (tablas MOCK/LIVE); copias `docs/USER_JOURNEY_SIMULATION_MOCK_2026-06-16.json`, `docs/USER_JOURNEY_SIMULATION_LIVE_2026-06-16.json`; `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` = último LIVE.
- **Impacto web:** Sin leads WP verificados en esta corrida (429 en MOCK; LIVE blocked bridge). Web home + agent/chat **200** en 10 personas. Teléfonos en docs enmascarados (+54 9 11 2615-**** / 6598-****).
- **Impacto asistente IA:** Consultas REAL OK; creación contacto/sync Cumbre no demostrada (429 / GCP).
- **Despliegue:** Solo ejecución local mirror — sin deploy.
- **Validaciones:** Informe generado desde JSON `allJourneys`; duración MOCK ~35 s, LIVE ~30 s.
- **Pendientes:** Ticket org policy GCP; espaciar POST contacto (95 s entre envíos) antes de re-validar leads; luego `--limit 500` o `--live` completo.

### 2026-06-16 — Fix 429 rate limit POST contacto en journey runner

- **Objetivo:** Evitar HTTP 429 (10 POST/15 min WP `gema-leads-api`) al ejecutar journeys con contacto real; desbloquear lote 11–500.
- **Cumbre mirror:** `scripts/lib/userJourneyStages.ts` — throttle 95 s (`JOURNEY_CONTACT_POST_DELAY_MS`, default 95000); `run-user-journey-simulation.ts` — log ETA contactos reales.
- **Docs:** `docs/PRIMEROS_10_JOURNEYS_2026-06-16.md` — nota fix + delay recomendado.
- **Impacto web:** Sin cambio plugin prod (opción A, no subir límite WP). Journeys 11–500 mock S03 — sin POST.
- **Validaciones:** Fix código only; no re-ejecutar `--limit 10`.
- **Pendientes:** Lote 11–500; re-validar 001–010 contacto tras ventana 15 min si se desea S03 sin partial.

### 2026-06-16 — Primeros 10 user journeys (500) con datos reales Norberto

- **Objetivo:** Ejecutar journeys 001–010 del pipeline completo GEMA→Cumbre con emails/WhatsApp reales de Norberto.
- **Cumbre mirror (`~/.cumbre-mirror`):**
  - `scripts/lib/userJourneyPersonas.ts` — `NORBERTO_REAL_CONTACT`, perfil real índices 0–9, pagos solo Nave+transferencia
  - `scripts/lib/userJourneyStages.ts` — web/agent/contacto REAL en lote ≤10; 429 WP como partial; flag `--real-web-all`
  - `scripts/lib/userJourneyMocks.ts` — Hermes stub usa teléfono persona + admin WhatsApp enmascarado
  - `scripts/run-user-journey-simulation.ts` — export `allJourneys` cuando `--limit ≤10`
- **Validaciones:**
  - `npm run test:journeys:500 -- --limit 10` → **10/10 PASS** híbrido (~38 s)
  - `npm run test:journeys:500:live -- --limit 10` → **10/10 PASS** (S03/S04/S08/S09 BLOCKED GCP documentados)
- **Docs GEMA:**
  - `docs/PRIMEROS_10_JOURNEYS_2026-06-16.md` (nuevo)
  - `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` actualizado (`allJourneys`)
- **Impacto web:** POST contacto real con norberto/info/beta@ — `cumbre_synced:false` en primeros envíos; 429 rate limit en ráfaga.
- **Impacto asistente IA:** agent/chat REAL 200 en los 10; sin cambio copy.
- **Despliegue:** Solo local/scripts mirror — sin deploy prod.
- **Pendientes:** Espaciar contactos en lotes >4; journeys 11–500; live end-to-end post-`post-org-policy:fix`.

### 2026-06-16 — Cierre plataforma: GO pruebas manuales (66/66 ERP, matriz 0 FAIL, journeys 500 mock)

- **Objetivo:** Completar plataforma al máximo alcanzable sin org policy GCP; habilitar sesión de pruebas detallada de Norberto.
- **Cumbre mirror (`~/.cumbre-mirror`):**
  - Fix beta E2E automatizaciones: seed demo `autfl_dogfood_demo` + limpieza colecciones + validadores defensivos (`automatizaciones.ts`, `automatizacionesReadiness.ts`)
  - `dogfoodP1ModuleConfigs.ts`, `seedTrialTenantDogfood.ts` — docs automatizaciones flujos/ejecuciones/webhooks/logs
  - `paymentSimulation.ts` — fix TS plataformas activas (sin ramas MP/PayPal muertas)
  - Deploy hosting beta + prod ✅
  - Bootstrap dogfood beta (`tenant_prueba_interna`) y prod (`tenant_gema_prod_interno`)
  - Claims owner `info@gema-digital.com` → `tenant_gema_prod_interno`
- **Validaciones (2026-06-16T19:30Z):**
  - `beta:e2e:dogfood-panels` 33/33 · `prod:e2e:dogfood-panels` 33/33
  - `bug:hunt:deep` 33/33 · 0 bugs
  - `test:subscription:notifications` 9 suites PASS
  - GEMA `test:matrix:500:fast` 0 FAIL · `test:journeys:500` mock 500 PASS
  - `beta:fix:functions-invoker` / `prod:fix:functions-invoker` → ERROR 400 org policy (documentado)
- **Docs GEMA:**
  - `docs/LISTO_PARA_PRUEBAS_NORBERTO.md` (nuevo) — handoff único GO/NO-GO
  - `docs/PLATAFORMA_COMPLETA_CHECKLIST_2026-06-16.md`, `docs/PROYECTO_TERMINADO_ESTADO_FINAL_2026-06-16.md` actualizados
  - `docs/BUGS_FOUND_2026-06-16.md` → 0 FAIL
- **Impacto web:** Sin cambio WP en este hito (v0.2.3 ya en prod).
- **Impacto asistente IA:** Sin cambio copy; bridge live sigue `cumbre_synced:false` hasta ticket GCP.
- **Despliegue:** Cumbre hosting beta+prod ✅ · Firestore seed dogfood ✅ · org policy sin cambio.
- **Pendientes externos:** Emails GCP admin → `post-org-policy:fix` → self-service + `test:journeys:500:live`.

### 2026-06-16 — Deploy prod integración estructural Studio IA (3.er sync)

- **Objetivo:** Publicar en producción menú, footer, hub ERP, SEO, subdominios e interlinks de Cumbre Studio IA.
- **Comando:** `SKIP_WP_CONFIG=1 bash scripts/sync-wordpress-prod.sh` (ejecutado 2 veces el 2026-06-16; 2.º incluye header/footer/hub/seo-yoast/subdomains v0.1.1).
- **Despliegue:** WP prod ✅ — `pages synced`, cache flushed, smoke cart + agent PASS.
- **Verificación prod (Norberto + curl):**
  - Landing `/erp-cumbre/cumbre-studio-ia/` → HTTP 200
  - Hub ERP, header mega menú y footer → enlaces `cumbre-studio-ia` / Studio IA visibles
  - Marketing embed `studio-ia-marketing` → OK
  - Redirect `/cumbre/studio-ia` → `/erp-cumbre/cumbre-studio-ia/`
  - Agente API → Studio Pro USD 63/mes, formatos 16:9/9:16/4:3
- **Impacto web:** Integración estructural Studio IA en producción.
- **Impacto asistente IA:** Segmento servicios + respuestas comerciales Studio IA en prod.
- **Pendientes:** Mirror re-seed matriz + deploy `firestore.rules`; panel UI consumo; beta sidebar nav; `cumbre_synced:false` (org policy IAM sin cambio).

### 2026-06-16 — Fix readiness Studio IA + doc mirror

- **Objetivo:** Alinear `buildStudioIaReadinessReport` con contratos de dominio y documentar módulo en mirror.
- **Archivos:** `~/.cumbre-mirror/shared/studioIaReadiness.ts`, `~/.cumbre-mirror/docs/CUMBRE_STUDIO_IA_MODULO.md`.
- **Cambio:** Alerta `critical` por consumo ≥90% ya no bloquea `estado_general`; solo errores de validación de consumo marcan `bloqueada`. `puede_continuar_demo_interna` queda en false si hay alerta crítica.
- **Impacto web:** Sin cambio directo.
- **Impacto asistente IA:** Sin cambio directo.
- **Despliegue:** Solo local mirror; pendiente re-deploy mirror si aplica.
- **Validaciones:** `npm run test:contracts` ✅, `npm run test:rules` ✅ en mirror.

### 2026-06-16 — Integración estructural Cumbre Studio IA (web + mirror)

- **Objetivo:** Incorporar `modulo_cumbre_studio_ia` / Cumbre Studio IA en toda la estructura del sitio y del ecosistema Cumbre, no solo landing y carrito.
- **Web GEMA (`04-proyecto-gema-digital`):**
  - Navegación: `header.html`, `footer.html`, `page-erp-cumbre.html` (mega menú + grid Crecimiento).
  - Interlinks: `functions.php` — `$common['studio_ia']`, grupos recomendados, links Marketing/WhatsApp Hub, JSON-LD schema Marketing+Studio.
  - SEO: `seo-yoast.php` — metadata `/erp-cumbre/cumbre-studio-ia`, redirects `/cumbre/studio-ia` y `/cumbre-studio-ia`.
  - Subdominios: `gema-cumbre-subdomains.php` v0.1.1 — `studio-ia`, `whatsapp-hub`.
  - Agente: `gema-agent-engine.js` — segmento `servicios` incluye `studio_ia`.
  - Sync páginas prod: `gema_sovereign_sync_local_page_definitions()` en deploy script.
- **Cumbre mirror (`~/.cumbre-mirror`):**
  - Matriz: `modulos_disponibles`, planes `studio_base/pro/full`, upsell catalog.
  - Seguridad: `firestore.rules` — `studio_ia_configuracion`, `studio_ia_consumo`.
  - Asistente guiado: `guidedAssistant.ts` contexto `studio_ia`; `App.tsx` contexto propio.
  - Readiness: `studioIaReadiness.ts` + tests en `test-domain-contracts.ts`.
  - Personas: `marketing_agencia` incluye `modulo_cumbre_studio_ia`.
- **Impacto web:** Studio IA visible en hub ERP, menú, footer, SEO, subdominios preparados e interlinks cruzados con Marketing/WhatsApp.
- **Impacto asistente IA:** Combos servicios/agencia recomiendan Studio IA; segmentos de página incluyen el módulo.
- **Despliegue:** WP prod ✅ 2026-06-16 — 3.er sync (ver entrada deploy estructural). Mirror: re-seed matriz + deploy rules si aplica.
- **Validaciones:** `npm run test:contracts` y `npm run test:rules` en mirror recomendados post-cambio.
- **Pendientes:** UI Panel Cumbre desglose consumo; demo tenant docs `studio_ia_configuracion` en matriz; re-bootstrap beta para nav sidebar.

### 2026-06-16 — Pagos: Nave + transferencia activos; MP/ML diferidos (Próximamente)

- **Objetivo:** Plataforma comercial 100% funcional para pruebas sin Mercado Pago ni Mercado Libre; Nave Galicia + transferencias como métodos de cobro activos.
- **Archivos Cumbre (`~/.cumbre-mirror`):**
  - `shared/paymentPlatformPolicy.ts` (nuevo) — política activo/diferido
  - `shared/cobrosAdapterRouter.ts` — `resolveActiveCheckoutPaymentAdapter()`
  - `shared/paymentSimulation.ts` — plataformas activas vs diferidas
  - `shared/dogfoodModuleConfigs.ts`, `shared/gemaCumbreTenantSeed.ts`, `shared/gemaCumbreTenant.ts` — default Nave + transfer; MP `habilitado: false`
  - `src/components/CumbreCobrosPanel.tsx` — UI MP “Próximamente”, medios activos filtrados
  - `scripts/test-payment-simulation-trial-paid.ts`, `scripts/lib/userJourneyPersonas.ts`
  - `docs/PLATAFORMA_PAGOS_GEMA.md`, `docs/PLATAFORMA_COMPLETA_CHECKLIST_2026-06-16.md`
- **Web:** `wordpress/plugins/gema-payments-platform/gema-payments-platform.php` v0.2.3 — catálogo con `status` active/deferred; REST providers + cart; webhooks MP → 503 deferred
- **Docs GEMA:** `docs/PLATAFORMA_PAGOS_GEMA.md`, `docs/PLATAFORMA_COMPLETA_CHECKLIST_2026-06-16.md`
- **Impacto web:** Checkout/carrito expone solo Nave + transferencia activos; MP/ML/PayPal visibles como Próximamente sin romper flujo.
- **Impacto asistente IA:** Sin cambio copy en este hito; política alineada con promesa comercial Nave-first.
- **Despliegue:** Solo local; sin deploy prod Firebase/WP en este hito.
- **Validaciones:** `npm run test:payment-simulation-trial-paid` → **OK** (Nave + transfer + gema_pagos; MP/PayPal bloqueados en checkout).
- **Pendientes:** Habilitar MP/ML en `paymentPlatformPolicy` post-OAuth/aprobación; org policy GCP invoker (blocker aparte).

### 2026-06-16 — Plan sinérgico total: documento maestro unificado GEMA + Cumbre

- **Objetivo:** Crear documento maestro que unifique web, ERP, dogfood, fases F0–F5, matriz sinergia, KPIs cierre e índice docs; resumen ejecutivo 1 página para Norberto.
- **Archivos/sistemas:**
  - `docs/PLAN_SINERGICO_TOTAL_GEMA_CUMBRE_2026-06-16.md` (nuevo) — visión, principios Cobros/Agente/CRM, arquitectura mermaid, actores (`info@` owner), fases sinérgicas, % honesto, próximos 7 días agentes vs humano, KPIs, índice 40+ docs.
  - `docs/NORBERTO_PLAN_SINERGICO_1PAG.md` (nuevo) — resumen ejecutivo 1 página.
- **Fuentes consolidadas:** ARQUITECTURA_IDEAL, PLATAFORMA_COMPLETA_CHECKLIST (mirror), GEMA_DOGFOOD, PRIMER_TESTER, PROYECTO_TERMINADO, ENTREGA, SESSION, HERRAMIENTAS, PLAN_IMPLEMENTACION, FLUJO_CLIENTE, RELEVAMIENTO, BUGS_FOUND, CIERRE_PROYECTO_BALANCE, transcripts 6425fbc6 / 726a6115 / 6032fd67 / b8366e35.
- **Impacto web:** Orden ejecutivo F0→F5 documentado; F2 bridge = org policy; promesa comercial asistida vs self-service explícita.
- **Impacto asistente IA:** Principios sinérgicos alineados con dogfood stack; pendiente seed GEMA agente 6425fbc6 sin cambio copy en este hito.
- **Despliegue:** Solo documentación local; sin cambios prod Firebase/WP.
- **Validaciones:** Coherencia cruzada con PROYECTO_TERMINADO semáforo y balance 38–45% integración global.
- **Pendientes:** Ticket GCP (H1–H2 Norberto); completar F1 seed 6425fbc6; SESSION + SIGN_OFF §C.

### 2026-06-16 — GEMA Cumbre primer tester: metadata tenant, matriz 32 módulos, verify E2E

- **Objetivo:** Formalizar GEMA Digital como Customer #0 / primer tester de Cumbre (`tipo: primer_tester`, `programa: dogfood_gema`); matriz prueba × criterios; script sign-off E2E 32/32 prod; coordinación con agente 6425fbc6 (sin duplicar bootstrap seed).
- **Archivos/sistemas:**
  - GEMA: `docs/GEMA_CUMBRE_PRIMER_TESTER_2026-06-16.md`, `docs/GEMA_DOGFOOD_CUMBRE_STACK_2026-06-16.md`, `docs/GEMA_CUMBRE_TODOS_MODULOS_2026-06-16.md` (nuevos).
  - GEMA: `scripts/gema-cumbre-primer-tester-verify.sh`, `package.json` → `gema:cumbre:primer-tester-verify`.
  - GEMA: `docs/HERRAMIENTAS_CUMBRE_GEMA_2026-06-16.md` — refs stack/primer tester.
  - Mirror: `shared/gemaCumbreTenant.ts` — `GEMA_CUMBRE_TESTER_PROGRAM`, `owners_tester`, `tenant_profile` con `tipo`/`programa`.
- **Impacto web:** Orden rollout documentado GEMA prod → Genera tu energía beta → self-service; `GEMA_CUMBRE_TENANT_ID=tenant_gema_prod_interno` sin cambio.
- **Impacto asistente IA:** Framing «primer tester todos los productos Cumbre» alineado con dogfood stack; pendiente copy agente si 6425fbc6 entrega seed comercial GEMA.
- **Despliegue:** Bootstrap prod + claims vía script verify (Firestore remoto); sin deploy WP/Firebase hosting en este hito salvo bootstrap.
- **Validaciones:** `npm run gema:cumbre:primer-tester-verify` — ver `docs/GEMA_CUMBRE_PRIMER_TESTER_SIGNOFF.latest.json`.
- **Pendientes:** `bootstrap:gema:integraciones` prod; seed GEMA específico (`gemaCumbreTenantSeed.ts`) agente 6425fbc6; CUIT fiscal definitivo.

### 2026-06-16 — GEMA Digital primer usuario ERP Cumbre (dogfood)

- **Objetivo:** GEMA Digital opera su propio Cumbre como cliente #1 — identidad fiscal GEMA (no Generadores Sur), 33 módulos, CRM comercial, billing, agent registry, owners equipo GEMA.
- **Archivos/sistemas (`~/.cumbre-mirror`):**
  - `shared/gemaCumbreTenant.ts`, `shared/gemaCumbreTenantSeed.ts` — tenant IDs, overlay comercial, agents registry
  - `scripts/bootstrap-gema-cumbre-first-user.ts`, `apply-gema-cumbre-team-claims.ts`, `create-gema-cumbre-owner-users.ts`, `repair-gema-cumbre-stub-configs.ts`
  - `scripts/bootstrap-gema-integraciones.ts` — flag `--gema-digital-identity` (CUIT 30715432109 placeholder)
  - `package.json` — `bootstrap:gema:cumbre-first-user:*`, `gema:apply-claims:team:*`, `gema:create-owner-users:*`, `gema:repair:stub-configs:*`
- **Web:** `docs/GEMA_CUMBRE_PRIMER_USUARIO_2026-06-16.md`, `.env.example` — `GEMA_CUMBRE_TENANT_ID=tenant_gema_prod_interno` (sin cambio wp-config prod).
- **Tenants:** beta `tenant_prueba_interna` · prod/web `tenant_gema_prod_interno`
- **Owners Auth (beta+prod):** `beta@gema-digital.com`, `info@gema-digital.com`, `norberto@gema-digital.com` — rol owner single-tenant
- **Impacto web:** Leads/contacto/agente Fase C → CRM tenant GEMA prod vía `GEMA_CUMBRE_TENANT_ID`
- **Impacto asistente IA:** Agente comercial GEMA + pipeline web leads alineado con tenant dogfood
- **Despliegue:** **Beta + prod Firestore/Auth** vía ADC (2026-06-16). Sin redeploy hosting/functions en este hito.
- **Validaciones:** ADC OK · bootstrap beta+prod OK · integraciones GEMA Digital CUIT · claims 3/3 · **prod E2E 33/33 PASS**
- **Pendientes:** CUIT definitivo GEMA (reemplazar placeholder) · certificados ARCA prod · `cumbre_synced:true` web (org policy IAM)

### 2026-06-16 — Herramientas Cumbre GEMA: inventario, wrapper ops y stack dogfood

- **Objetivo:** Integrar herramientas internas Cumbre para GEMA como primer tenant prod; wrapper npm unificado para operación diaria; fusionar framing CRM+Cobros+Agente (agentes c2447d6e + b8366e35).
- **Archivos/sistemas:**
  - `docs/HERRAMIENTAS_CUMBRE_GEMA_2026-06-16.md` (nuevo) — inventario UI/agentes/BI/automatizaciones/CLI, rutina diaria, stack dogfood web→tenant, comandos.
  - `scripts/gema-cumbre-tools.sh` (nuevo) — delega a `~/.cumbre-mirror` + smoke web GEMA.
  - `package.json` — `gema:cumbre:tools`, `:health`, `:agents`, `:audit`, `:web`, `:sync`.
- **Impacto web:** Monitoreo cross-stack vía `gema:cumbre:tools:web` y `bug:hunt:deep`; bridge agente/leads/pagos documentado hacia `tenant_gema_prod_interno`.
- **Impacto asistente IA:** Doc alinea agente comercial con registry Cumbre (`agentChat`, scorer CRM); pendiente sync copy si b8366e35 actualiza bootstrap tenant.
- **Despliegue:** Solo local (doc + scripts); sin cambios prod Firebase/WP en este hito.
- **Validaciones:** `npm run gema:cumbre:tools:health` — **PASS** (`prod:health` OK build/hosting/Firebase; smoke web prod 8/8).
- **Pendientes:** `docs/GEMA_DOGFOOD_CUMBRE_STACK_2026-06-16.md` standalone si b8366e35 lo crea — contenido ya fusionado en §1 HERRAMIENTAS; bootstrap integraciones prod; `--e2e` 32 paneles bajo demanda.

### 2026-06-16 — Cierre comercial Cumbre Studio IA (SKUs, panel consumo, web, agente)

- **Objetivo:** Terminar pendientes comerciales de Studio IA: carrito Gema Pagos, panel de consumo, copy web y conocimiento del agente flotante.
- **Archivos/sistemas:**
  - Web: `wordpress/plugins/gema-payments-platform/gema-payments-platform.php` v0.2.2 — 15 SKUs (Studio Base/Pro/Full, packs, bloques, bundle Marketing+Studio, Cobros Base/Standard/Full).
  - Web: `wordpress/theme-gema-sovereign/functions.php` — landing `/erp-cumbre/cumbre-studio-ia`, embed pricing en `/erp-cumbre/cumbre-marketing`, catálogo módulos `studio_ia`.
  - Web: `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js` — respuesta `studio_ia`, señales comerciales y precios lanzamiento.
  - Cumbre mirror: `shared/studioIaUsage.ts` (nuevo), `shared/tenantPanelSeed.ts` — `consumo_porcentaje` desde clips/imágenes/piezas vs límites billing.
  - Doc: `docs/CUMBRE_STUDIO_IA_PRECIOS_3_NIVELES_2026-06-16.md` — pendientes marcados completos.
- **Impacto web:** Landing Studio IA con pricing grid estilo Cobros; Marketing incluye sección Studio IA; carrito REST expone SKUs con precios de lanzamiento.
- **Impacto asistente IA:** Gema IA puede orientar sobre planes Studio Base/Pro/Full, overage, trial y bundle Marketing+Studio con link a landing.
- **Despliegue:** WP prod ✅ 2026-06-16 — 2 syncs (`SKIP_WP_CONFIG=1 bash scripts/sync-wordpress-prod.sh`). 2.º sync: `pages synced`; verificación prod: landing Studio IA HTTP 200, embed Marketing OK, agente API Studio Pro USD 63/mes.
- **Validaciones:** `npm run test:contracts` PASS · smoke deploy cart/agent/contact PASS · curl prod Studio/marketing/agent PASS.
- **Pendientes:** UI Panel Cumbre React para desglose clips/imágenes/piezas (`studioIaUsage.ts` listo); `cumbre_synced` contacto bloqueado por org policy IAM functions.

### 2026-06-16 — Cumbre Studio IA: sistema de precios 3 niveles + promos

- **Objetivo:** Definir pricing competitivo (−20 % mínimo vs Hailuo/imagen IA) como servicio embebido Cumbre, no competidor standalone.
- **Archivos/sistemas:** `~/.cumbre-mirror/shared/studioIa.ts` (nuevo), `crm.ts`, `billing.ts`, `marketing.ts`, `tenantPanelSeed.ts`, `test-domain-contracts.ts`. Doc: `docs/CUMBRE_STUDIO_IA_PRECIOS_3_NIVELES_2026-06-16.md`.
- **Planes:** Studio Base USD 39/31 · Studio Pro USD 79/63 ⭐ · Studio Full USD 149/119. Overage clip USD 0.26, imagen USD 0.06.
- **Impacto web:** Landing `/erp-cumbre/cumbre-studio-ia`, embed en Marketing, SKUs carrito v0.2.2.
- **Impacto asistente IA:** Respuesta `studio_ia` con precios lanzamiento en agente flotante.
- **Despliegue:** No (definición local/código mirror + WP local).
- **Validaciones:** Contratos dominio Studio IA + consumo en `test-domain-contracts.ts`.
- **Pendientes:** UI desglose consumo en Panel Cumbre React; deploy prod.

### 2026-06-16 — Backend comercial Cumbre completo (mirror)

- **Objetivo:** Cablear bus comercial 8 etapas, provisioning 32 módulos, gemaPagos sandbox trial conversion, trial expiring + cargo, subscriptionAgent, reglas signup queue, deploy beta functions+rules.
- **Archivos Cumbre (`~/.cumbre-mirror`):** `shared/commercialEvents.ts`, `billingCommercialBridge.ts`, `billingWebhookProcessor.ts`, `trialConversionSandbox.ts`, `trialExpiringNotifier.ts`, `agenteChatbotRuntime.ts`, `agenteSuscripcionesRuntime.ts`, `functions/src/commercialEventSubscribers.ts`, `functions/src/index.ts`, `firestore.rules`, `docs/PLATAFORMA_COMPLETA_CHECKLIST_2026-06-16.md`.
- **Impacto web:** Checklist journey REAL/MOCK/BLOCKED; signup cola Firestore; eventos alimentan orchestrator WP cuando bridge OK.
- **Impacto asistente IA:** `package.recommended`, `lead.captured`, `subscription.active` en bus → notificaciones. Pendiente sync copy agente suscripciones WP.
- **Despliegue:** Beta rules+indexes+storage ✅ · Functions CLI sin delta (skipped); código compilado localmente con cambios.
- **Validaciones:** `test:subscription:notifications` 9/9 PASS · `test:rules` PASS · `functions:typecheck` PASS.
- **Pendientes:** Org policy runner provisioning PERMISSION_DENIED; smoke signup queue post-deploy; no `test:journeys:500` hasta checklist REAL.

### 2026-06-16 — Flujo comercial completo WP prod (autorizado ALL Norberto)

- **Objetivo:** Cerrar embudo web: agente sales router + recomendación paquete + cola retry CRM; cart checkout → signup con SKU; contacto UTM + retry sync; orchestrator WhatsApp admin lead/trial; deploy prod + smoke.
- **Archivos Web GEMA:**
  - `wordpress/plugins/gema-leads-api/gema-leads-api.php` v0.2.1 — cola `cumbre_sync_pending`, cron hourly retry (max 8), contacto dispara `lead.captured` orchestrator
  - `wordpress/plugins/gema-payments-platform/gema-payments-platform.php` v0.2.1 — `signup_url` + `package_sku` en checkout; evento `lead.captured`
  - `wordpress/plugins/gema-notifications-orchestrator/gema-notifications-orchestrator.php` v0.2.1 — evento `lead.captured`; WhatsApp admin (`notify_admin`) en lead/trial/handoff
  - `wordpress/plugins/gema-agent-api/` v0.4.1 — retry queue en sync fallido; handoff → orchestrator
  - `wordpress/theme-gema-sovereign/assets/gema-cart-checkout.js` — CTA signup con SKU desde API
  - `scripts/sync-wordpress-prod.sh` — wp-config `GEMA_ADMIN_WHATSAPP_PHONE`, `GEMA_CUMBRE_ERP_SIGNUP_URL`; smoke BUG-004 diversity
  - `scripts/deploy-fase-c-prod-checklist.sh` — versiones v0.2.1 documentadas
- **Archivos Cumbre (`~/.cumbre-mirror`):** `src/App.tsx` — lee `?signup=1&sku=&email=&company=`; hosting prod desplegado (`firebase deploy --only hosting:cumbre-erp-prod`)
- **Impacto web:** Deploy prod OK (`sync-wordpress-prod.sh`). Cart/checkout/signup_url con SKU operativo. Contacto `cumbre_sync_pending:true` cuando bridge IAM bloqueado (retry automático).
- **Impacto asistente IA:** Sales router + combo en engine/floating-agent sin regresión BUG-004 (3 intents distintos en smoke prod). Handoff → email ventas + WA admin stub.
- **Despliegue:** WP prod ✅ · Cumbre hosting prod ✅ · Functions prod sin cambio en esta pasada.
- **Validaciones (2026-06-16T16:41Z prod):**
  - `sync-wordpress-prod.sh` smoke: cart PASS, agent 3 replies diferenciados PASS, contact ok
  - Checkout `erp_negocios_trial` → `signup_url` con `sku=erp_negocios_trial` PASS
  - Contact POST → `ok:true`, `cumbre_synced:false`, `cumbre_sync_pending:true` (esperado org policy)
  - `test-web-prod-smoke.sh` → 8/8 PASS
  - BUG-004: **sin regresión** (trial/cobros/hola respuestas distintas)
- **Pendientes:** Ticket org GCP §1 para `cumbre_synced:true`; WA admin live requiere Hermes/Meta; mirror `npm run build:prod` falla tsc en scripts payment simulation (no bloquea vite dist ya desplegado).

### 2026-06-16 — Simulación pagos trial→paid multi-plataforma + webhook billing + bus comercial

- **Objetivo:** Implementar flujo sandbox trial→paid en Cumbre mirror para MP, Nave Galicia, transferencia manual, PayPal stub; conectar `gemaPagosWebhook` a activación de módulos y `payment.approved`; script admin día 14; tests; deploy beta.
- **Archivos/sistemas (mirror `~/.cumbre-mirror`):**
  - `shared/paymentSimulation.ts`, `shared/billingWebhookProcessor.ts`, `shared/panelBillingSync.ts`
  - `shared/adapters/transferenciaBancariaAdapter.ts`, `shared/adapters/paypalCobrosAdapter.ts`
  - `shared/billing.ts` — `canProcessBillingWebhook` (sandbox test siempre OK)
  - `shared/cobrosAdapterRouter.ts`, ajustes MP/Nave/Gema Pagos adapters
  - `functions/src/index.ts` — `gemaPagosWebhook` usa processor + sync panel + commercial event
  - `scripts/advance-trial-day14.ts`, `scripts/test-payment-simulation-trial-paid.ts`
  - `docs/PLATAFORMA_PAGOS_GEMA.md` — checklist payments
  - npm: `test:payment-simulation-trial-paid`, `admin:advance-trial-day14`
- **Impacto web:** Sin deploy WP. Checklist documenta curl webhook y flujo dogfood beta.
- **Impacto asistente IA:** Eventos `payment.approved` publicados en bus comercial alimentan notificaciones (`commercialEventNotifications`); pendiente sync copy agente suscripciones con checklist PLATAFORMA.
- **Despliegue:** Beta functions — `gemaPagosWebhook` **OK** (`gemapagoswebhook-efkz3ef2rq-rj.a.run.app`). IAM invoker falló solo en `cumbreMercadoLibreWebhook` / `cumbreWhatsappWebhook` (org policy GEMA, patrón conocido).
- **Validaciones:**
  - `npm run test:payment-simulation-trial-paid` → **OK** (5 plataformas, transferencia manual, processor mock, día 14)
  - `npm run functions:typecheck` — preexistente warning TS6133 `agenteSuscripcionesRuntime.ts` (no bloqueante compile functions build)
- **Pendientes:** Invoker público org policy GCP para webhooks externos; OAuth MP/Nave production; copy agente IA.

### 2026-06-16 — Suite 500 user journeys (simulación ciclo de vida cliente)

- **Objetivo:** Diseñar e implementar 500 journeys GEMA→Cumbre (web→agente→lead→WhatsApp→paquete→contrato→pagos→trial→módulos) con mocks Hermes/time-travel/pagos y modo live honesto (BLOCKED org policy).
- **Archivos/sistemas:**
  - Diseño: `docs/SUITE_500_USER_JOURNEYS_2026-06-16.md`
  - Reporte: `docs/USER_JOURNEY_SIMULATION_REPORT_2026-06-16.md`, `docs/USER_JOURNEY_SIMULATION_2026-06-16.json`
  - Cumbre mirror: `scripts/run-user-journey-simulation.ts`, `scripts/lib/userJourneyPersonas.ts`, `scripts/lib/userJourneyMocks.ts`, `scripts/lib/userJourneyStages.ts`, `tests/e2e/user-journeys/`, `playwright.config.ts`
  - GEMA: `scripts/run-user-journey-simulation.sh`, `package.json` (`test:journeys:500`, `test:journeys:500:live`)
- **Impacto web:** Modo mock valida embudo; live confirma S03/S04/S08/S09 **BLOCKED** (1400 etapas) por org policy GCP.
- **Impacto asistente IA:** Pendiente — incorporar matriz industria→módulos y gaps self-service en conocimiento agente (registrar pendiente).
- **Despliegue:** No.
- **Validaciones:**
  - **500 personas** generadas (20×5×5); `personas.generated.json`
  - Mock `test:journeys:500`: **500/500 PASS**, 10.3 s, Hermes stub 500 msgs, 4300 stage PASS / 1700 SKIP
  - Live `test:journeys:500:live`: S03/S04 **500 BLOCKED**, S08/S09 **200 BLOCKED** (accept paths), web sample 20/500 REAL OK
- **Pendientes:** Ticket org policy GCP; `npx playwright install` para `--with-e2e`; factory tenant por persona; sync conocimiento agente IA.

### 2026-06-16 — Video 02: validación pipeline completo (logo Flow + subtítulos)

- **Objetivo:** Resolver error `aplicar-logo-flow.py: unrecognized arguments: --video`; cerrar exports subtitulados 9:16 del Video 02.
- **Archivos/sistemas:** Hub `15-Produccion-Audiovisual`: `aplicar-logo-flow.py` (modo batch `--video` ya en disco; error previo = versión antigua sin flag). Outputs refrescados: `ia/16x9/escena-*-intro|transicion|broll|cierre.mp4`, `short-9x16-subtitulado.mp4`.
- **Impacto web:** Ninguno.
- **Impacto asistente IA:** Ninguno.
- **Despliegue:** No (local).
- **Validaciones:** `aplicar-logo-flow.py --help` muestra `[--video VIDEO]`; `--video 02` procesó 4 clips Flow → `ia/16x9/`; `montar-video-serie.py --video 02 --format 9x16 --subtitulos` → `short-9x16-subtitulado.mp4` (61.2 s, 3 cues). Nota: `--subtitulo` funciona por abreviatura argparse de `--subtitulos`.
- **Pendientes:** Capturas/montaje 4:3 si se publica en feed clásico; portadas 4:3.

### 2026-06-16 — Matriz comprehensiva ~500 casos (`test:matrix:500` / `audit:comprehensive`)

- **Objetivo:** Inventariar, diseñar y ejecutar matriz ~500 casos (32 módulos × escenarios × env + web + billing + roles + subscription) para maximizar descubrimiento de bugs.
- **Archivos/sistemas:**
  - `~/.cumbre-mirror/scripts/run-comprehensive-test-matrix.ts` (nuevo)
  - `~/.cumbre-mirror/scripts/lib/comprehensiveTestMatrix.ts` (nuevo)
  - `~/.cumbre-mirror/package.json` — `test:matrix:500`, `audit:comprehensive`, `test:bank:full`
  - GEMA: `scripts/run-comprehensive-matrix.sh`, `package.json`, `sync-test-reports-from-cumbre.sh`
  - Reportes: `docs/COMPREHENSIVE_TEST_MATRIX_2026-06-16.md/json`, `docs/BUGS_FOUND_2026-06-16.md/json`
- **Impacto web:** Smoke prod 8/8 PASS (home, REST, cart, agent, hosting ERP). WP local REST 404 (SKIP esperado sin plugins activos).
- **Impacto asistente IA:** Ningún cambio de conocimiento; hallazgo agente prod reply OK en corrida.
- **Despliegue:** No.
- **Validaciones:**
  - **505 casos generados** (192 module_matrix, 20 web_funnel, 50 billing, 30 agent_roles, 12 subscription, 36 architecture, 96 readiness, 8 crm_funnel, etc.)
  - Corrida **full** (~6 min): E2E beta **32/32** + prod **32/32** PASS; suites 32/37 PASS
  - Corrida **fast** post-fixes: **272 PASS, 3 FAIL, 230 SKIP**; typecheck/contracts/rules/adapters/roles **PASS**
  - Bugs reales: **P0 signup/trial provisioning timeout** (beta+prod); corregidos 3 falsos positivos (typecheck TS, beta:check:build orden, architecture mapping)
- **Pendientes:** Worker `provisionTrialTenant` GCP; emulador para CRM piso1; activar plugins WP local para REST contracts.

### 2026-06-11 — Piloto Video 02 formato 4:3 completado + subtítulos 4:3

- **Objetivo:** Completar export `short-4x3.mp4` del Video 02 piloto; habilitar subtítulos quemados para 4:3; confirmar fix `--video` en `aplicar-logo-flow.py`.
- **Archivos/sistemas:** Hub `15-Produccion-Audiovisual`: `subtitulos_serie_lib.py` (soporte 4:3), `07-formatos-16x9-9x16-4x3.md` (workflow actualizado). `gema_video_lib.py` reutiliza `ia/16x9/` para 4:3 (letterbox). Outputs: `short-4x3.mp4`, `short-4x3-subtitulado.mp4`, `capturas/4x3/`.
- **Impacto web:** Ninguno directo; asset listo para LinkedIn feed clásico / presentaciones iPad.
- **Impacto asistente IA:** Ninguno.
- **Despliegue:** No (local).
- **Validaciones:** Capturas 4:3 4/4 OK; montaje 4:3 ~97 s; subtítulos quemados generados; `aplicar-logo-flow.py --video 02` acepta flag (error previo era versión antigua).
- **Pendientes:** Portadas redes 4:3 (`portadas_serie_lib.py` fase 2); escenas IA nativas `ia/4x3/` opcionales vía Flow.

### 2026-06-11 — Formatos 4:3 pipeline audiovisual + investigación planes Cobros Cumbre

- **Objetivo:** Agregar soporte end-to-end formato **4:3** (1440×1080) al hub de producción audiovisual; documentar investigación profunda de planes de cobro Cumbre (Cobros + billing transversal).
- **Archivos/sistemas:** Hub `15-Produccion-Audiovisual`: `gema_video_lib.py`, `capturas_batch_lib.py`, `capturar-web-gema.py`, `montar-video-serie.py`, `07-formatos-16x9-9x16-4x3.md`. Repo web: `docs/CUMBRE_PLANES_COBROS_Y_LIMITACIONES_2026-06-11.md`.
- **Impacto web:** Documentación comercial Cobros alineada con `~/.cumbre-mirror/shared/cobros.ts`; pendiente sync agente IA con matriz numérica Full.
- **Impacto asistente IA:** Pendiente — incorporar diferencia billing SaaS vs módulo Cobros y límites por plan en conocimiento embebido.
- **Despliegue:** No (solo local/docs).
- **Validaciones:** `format_config()` enruta `ia/4x3/` y `capturas/4x3/`; CLI `--format 4x3` en capturas y montaje; intro/cierre `generados/4x3/` ya existían.
- **Pendientes:** Generar `ia/4x3/` + capturas 4:3 Video 02 piloto; subtítulos/portadas 4:3 (fase 2); expandir SKUs cart WP para planes Cobros Standard/Full.

### 2026-06-16 — Deep bug hunt Cumbre beta/prod + gema-digital.com

- **Objetivo:** Cazar bugs reales con E2E retries, edge cases Playwright, web (cart/contacto/agente), signup prod, performance y console errors.
- **Archivos/sistemas:** `~/.cumbre-mirror/scripts/run-deep-bug-hunt.ts` (nuevo); reportes `docs/DEEP_BUG_HUNT.latest.json`, `BETA/PROD_DOGFOOD_PANELS_E2E.latest.json`; `docs/BUGS_FOUND_2026-06-16.md` (repo GEMA).
- **Impacto web:** Ningún despliegue; hallazgos en prod live (contacto `cumbre_synced:false`, agente reply_len idéntico).
- **Impacto asistente IA:** BUG-004 respuestas posiblemente genéricas; signup prod bloqueado afecta trial self-service.
- **Despliegue:** No.
- **Validaciones:** E2E dogfood beta **32/32 ×2** + prod **32/32 ×2** (sin flakes); edge cases rapid nav / logout-relogin / empty states **PASS**; console errors **0**; performance **<5s**; web cart add `erp_negocios_trial` **PASS**; contact POST **200**; signup prod **403 Firestore**; signup beta **timeout 120s**.
- **Bugs documentados:** 1 critical (signup prod 403), 1 high (signup beta timeout), 2 medium (CRM bridge, agente canned), 1 low (SKU test note); smoke script grep **fixed** (8/8 PASS).
- **Pendientes:** deploy firestore rules prod; deploy/verificar `cumbreSignupProvisioningRunner`; configurar bridge WP↔Cumbre; ticket org policy.

Este archivo es el registro maestro del proyecto GEMA Digital / ERP Cumbre. Debe actualizarse en cada cambio relevante del sitio, backend, infraestructura, contenido, SEO, integraciones, plugins, despliegues o validaciones.

### 2026-06-16 — Auditoría readiness agente 100% (pre-manual Norberto)

- **Objetivo:** Confirmar honestamente si todo el trabajo agente está listo antes de pruebas manuales Norberto; cross-check PROYECTO_TERMINADO VERDE vs live curls/smoke.
- **Archivos/sistemas:** `docs/READINESS_AGENTE_100_2026-06-16.md` (nuevo); verificación `~/.cumbre-mirror` (beta signin/smoke, prod health, signup FAIL); GET live gema-digital.com + functions 403; sync SHA256 reportes `.latest`.
- **Impacto web:** Ninguno (solo lectura + GET smoke).
- **Impacto asistente IA:** Ninguno.
- **Despliegue:** No.
- **Validaciones:** V1–V12 VERDE **12/12 PASS** agente; ROJO R1–R4 **FAIL esperado** (org policy); `beta:test:signin` + `beta:test:dogfood-smoke` **32 mods PASS** (12:03Z); cart REST **200**; webhooks **403**; `prod:test:signup-provisioning` **403**; suscripciones **7/7**; sync reportes **5/5 OK**.
- **Veredicto por capa:** Mirror **Y** · Hosting beta/prod live **Y** (UI) · Functions invoker **N** · WP Fase C **Y** · Repo plugins/theme **Y** · Docs handoff **Y** · Manual Norberto **N** · Self-service **N**.
- **Conclusión:** **READY FOR NORBERTO MANUAL TEST (operativo asistido)** — **NOT 100% self-service**.
- **Pendientes:** SESSION ~90 min · emails GCP · SIGN_OFF §C · post-org-policy post-ticket.

### 2026-06-16 — CIERRE AGENTES FINAL

- **Objetivo:** Cerrar subagente 0ea38cef (incompleto): validación final mirror + marca STABLE/FINAL sin cambios de código.
- **Archivos/sistemas:** `~/.cumbre-mirror` (`npm run audit:cierre` incluye beta+prod E2E); sync a `docs/AUDIT_CIERRE.latest.*`, `docs/BANCO_PRUEBAS_COMPLETO.latest.*`, E2E JSON, `docs/PROYECTO_TERMINADO_ESTADO_FINAL_2026-06-16.md`.
- **Impacto web:** Ninguno (solo re-validación).
- **Impacto asistente IA:** Ninguno; veredicto operativo asistido sin cambio.
- **Despliegue:** No — solo local/mirror CLI.
- **Validaciones:** `audit:cierre` banco **30 PASS · 0 FAIL · 1 SKIP**; E2E **32/32 beta + 32/32 prod** (64/64); veredicto audit **PARCIAL** (org policy / P0 checklist sin delta vs 08:18Z).
- **STABLE FINAL:** Resultados idénticos a batería integrada previa; bloqueo único sigue siendo org policy GCP.
- **Pendientes:** Norberto — SESSION + emails GCP + `post-org-policy:fix` post-aprobación.

### 2026-06-16 — Corrida agentes cierre (mirror, corrida 2)

- **Objetivo:** Deploy `agentChat` prod, batería audit/E2E/smoke/signup/invoker, sync reportes GEMA.
- **Archivos/sistemas:** `~/.cumbre-mirror` (Firebase `cumbre-erp-prod`), `docs/AUDIT_CIERRE.latest.*`, `docs/BANCO_PRUEBAS_COMPLETO.latest.*`, E2E JSON, `docs/PRUEBA_INTEGRADA_FINAL_2026-06-16.md`.
- **Impacto web:** `agentChat` redeploy prod OK; invoker público sigue bloqueado por org policy (sin cambio en `cumbre_synced`).
- **Impacto asistente IA:** función `agentChat` actualizada en prod; widget WP sin cambio de invoker hasta ticket GCP.
- **Despliegue:** solo Cloud Function `agentChat` prod (local CLI); no WP prod en esta corrida.
- **Validaciones:** `audit:cierre` banco 30/0/1 PASS (veredicto audit **parcial**); E2E 64/64; smoke Ola1 15/0/1; notificaciones 7/7; `beta:test:signup-provisioning` FAIL timeout; `prod:fix:functions-invoker` org policy 400.
- **Mejora vs corrida 07:43Z:** banco unificado de 28/2/1 fail → 30/0/1 pass; veredicto audit fail → parcial; `BANK-SUITE` ok.
- **Pendientes:** ticket org policy; re-probar signup post-excepción; opcional `prod:test:signup-provisioning`.


## Protocolo de Actualización

- Agregar una nueva entrada en `Historial de Cambios` cada vez que se modifique el proyecto.
- Incluir fecha, objetivo, archivos o sistemas afectados, estado de despliegue, validación realizada y próximos pasos.
- No registrar credenciales, tokens, contraseñas, claves privadas ni datos sensibles.
- Si un cambio se despliega a producción, indicar URL, comando general ejecutado y resultado de verificación.
- Si queda algo pendiente por acceso externo, credenciales o decisión comercial, dejarlo en `Pendientes`.
- Todo cambio que afecte ERP Cumbre debe aplicarse o registrarse en dos superficies: web WordPress y asistente IA.

## Estado General Actual

- Sitio WordPress de producción: `https://gema-digital.com`
- Theme principal: `wordpress/theme-gema-sovereign`
- Plugin de leads: `wordpress/plugins/gema-leads-api`
- Plugin de pagos propio: `wordpress/plugins/gema-payments-platform`
- Plugin agente IA WP: `wordpress/plugins/gema-agent-api` (bridge Cumbre `agentChat`)
- Plugin notificaciones: `wordpress/plugins/gema-notifications-orchestrator`
- Backend de agente IA: proyecto FastAPI `gema_agent_api` fuera de esta carpeta de WordPress (legacy n8n reemplazado por plugin WP + Cumbre).
- Producción WordPress: servidor remoto con WP-CLI, theme sincronizado por `rsync` y regeneración programática de páginas.
- SEO activo: contenido programático, páginas locales, comparativas, Yoast SEO en producción, meta tags dinámicos y schema para ERP Cumbre.

## Arquitectura y Decisiones Relevantes

- WordPress funciona como sitio institucional, SEO/GEO/SEM, páginas comerciales y captación.
- ERP Cumbre es el producto SaaS/ERP principal, con páginas por tiers, módulos, verticales y comparativas.
- GEMA Digital opera como agencia, implementadora y ecosistema técnico alrededor de ERP, IA, automatización, pagos e integraciones.
- Las páginas dinámicas se generan desde definiciones PHP en `functions.php` mediante `gema_sovereign_get_local_page_definitions()`.
- La creación/actualización de páginas en producción se realiza con WP-CLI y el script `crear-paginas-produccion.php`.
- Los cambios de theme se sincronizan localmente con `scripts/sync-theme-to-studio.sh` y luego se despliegan a producción.
- Las credenciales reales de pasarelas de pago todavía no están conectadas; la plataforma está preparada en estado `ready_for_credentials`.

## Historial de Cambios

### 2026-06-17 — Sync CRM GEMA en trial, billing y notificaciones

**Objetivo:** Que cada paso del flujo cliente (tarjeta trial Nave, provisioning, pago, factura/recibo, email/WhatsApp) cree interacciones y metadata en CRM GEMA (`tenant_gema_prod_interno`), visible en portal Mis datos.

**Archivos (mirror `~/.cumbre-mirror`):**
- `shared/crmGemaClienteSync.ts` (nuevo) — `resolveGemaLeadRef`, sync tarjeta/trial/pago/docs/notificaciones
- `shared/customerPortal.ts` — `PortalClienteLinkCrmStatus`
- `shared/provisionTrialTenant.ts`, `billingWebhookProcessor.ts`, `billingDocumentOrchestrator.ts`
- `functions/src/index.ts` — verifyTrialCard → CRM ok/fail
- `functions/src/commercialEventSubscribers.ts` — log notificación en CRM
- `functions/src/soporteTicketCrmSync.ts` — reutiliza resolve compartido
- `src/components/CustomerPortalPanel.tsx` — Mis datos ampliado
- `scripts/test-crm-gema-cliente-sync.ts` (nuevo)
- `docs/TRIAL_TARJETA_Y_FACTURACION_AUTO_2026-06-17.md` (nuevo)

**Impacto web:** Portal Mis datos muestra tarjeta trial, pago, factura/recibo y estado sync CRM cuando existe `portal_cliente_link`. Sin deploy WP.

**Impacto asistente IA:** Pendiente — documentar en conocimiento local respuestas sobre estado CRM-linked (tarjeta/pago/docs).

**Despliegue:** Solo local mirror; sin prod.

**Validaciones:** `node scripts/run-esbuild.mjs scripts/test-crm-gema-cliente-sync.ts` → 8/8 PASS.

**Pendientes:** Deploy functions; UI operadores CRM para `portal_documentos` en lead; asistente IA.

---

### 2026-06-16 — Primeros 5 journeys con mensajes únicos (001–005)

**Objetivo:** Detener batches masivos e idénticos; correr solo 5 personas con WhatsApp y email personalizados por carrito comercial; corregir builder Hermes/orchestrator.

**Archivos:**
- `~/.cumbre-mirror/scripts/lib/userJourneyPricing.ts` — `buildJourneyCompactClientMessage`, `journeyPackageSnapshot`, interpolación `commercialCart`
- `~/.cumbre-mirror/scripts/lib/userJourneyNotifications.ts` — outbox `listJourneySentMessages`, WA cliente S07, log body 80 chars
- `~/.cumbre-mirror/scripts/lib/userJourneyStages.ts` — contacto S03 con nombre real + `package_snapshot`
- `~/.cumbre-mirror/scripts/run-user-journey-simulation.ts` — doc `PRIMEROS_5_JOURNEYS_UNICOS`
- `~/.cumbre-mirror/package.json` — `test:journeys:5:real`
- `wordpress/plugins/gema-notifications-orchestrator/gema-notifications-orchestrator.php` v0.2.3 — usa `rich_message_client/admin` de metadata
- `wordpress/plugins/gema-leads-api/gema-leads-api.php` — acepta `package_snapshot` en contact journey
- `docs/PRIMEROS_5_JOURNEYS_UNICOS_2026-06-16.md` (nuevo)

**Impacto web:** 5 POST `/contact` prod (throttle 95 s, ~6.4 min). Emails ventas vía `sales_email=wp_mail` HTTP 200. Plugins WP personalizados **pendiente deploy prod** para emails ricos desde orchestrator en S03.

**Impacto asistente IA:** Sin cambio runtime agente.

**Despliegue:** Scripts mirror local ejecutados; plugins WP solo en repo local (no prod aún).

**Validaciones:** `JOURNEY_REAL_NOTIFICATIONS=1 npm run test:journeys:5:real` → **5/5 PASS** · Hermes **12/12** enviados · mensajes admin distintos (Juan U$D 72, María U$D 25, Carlos U$D 115, Ana U$D 54, Diego U$D 135) · client_wa compacto en 001/003.

**Pendientes:** Aprobación Norberto antes de 006–010; deploy plugins WP 0.2.3 + gema-leads-api a prod; `GEMA_NOTIFICATIONS_WEBHOOK_SECRET` en runner para S07 orchestrator (hoy Hermes fallback).

---

### 2026-06-16 — Diagnóstico y fix notificaciones reales en journey simulation

**Objetivo:** Explicar por qué los 500 journeys MOCK no enviaron mail/WhatsApp; habilitar `--real-notifications` / `JOURNEY_REAL_NOTIFICATIONS=1` para lote 001–010 con Hermes VPS + contacto WP real.

**Archivos:**
- `~/.cumbre-mirror/scripts/lib/userJourneyNotifications.ts` (nuevo)
- `~/.cumbre-mirror/scripts/lib/userJourneyStages.ts` — S04/S07/S11 reales con flag
- `~/.cumbre-mirror/scripts/run-user-journey-simulation.ts` — flag, stats, reporte
- `~/.cumbre-mirror/package.json` — `test:journeys:10:real-notifications`
- `docs/POR_QUE_NO_LLEGO_MAIL_WHATSAPP_2026-06-16.md` (nuevo)
- `.env.example` — `JOURNEY_REAL_NOTIFICATIONS`, `JOURNEY_CONTACT_POST_DELAY_MS`
- `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` — re-run 10 personas con `realNotifications: true`

**Impacto web:** Re-run disparó 10 POST reales a `/wp-json/gema/v1/contact` prod (throttle 95 s) → `wp_mail` ventas vía gema-leads-api si SMTP OK.

**Impacto asistente IA:** Sin cambio código agente; documentación aclara que simulación MOCK ≠ notificaciones reales.

**Despliegue:** Solo scripts mirror local + doc; no deploy WP/plugins.

**Validaciones:** `npm run test:journeys:10:real-notifications` PASS 10/10 · Hermes VPS 20 enviados / 0 fallos · 10 contactos WP OK · WP orchestrator 10 skipped (sin `GEMA_NOTIFICATIONS_WEBHOOK_SECRET` en runner).

**Pendientes:** Exportar `GEMA_NOTIFICATIONS_WEBHOOK_SECRET` en runner para S07 vía orchestrator; ticket org GCP para `cumbre_synced:true` y WhatsApp vía CF; verificar bandeja email SMTP prod.

---

**Objetivo:** Una pantalla con los 3 pasos humanos inmediatos: Bloque D SESSION, emails GCP, `post-org-policy:fix` post-aprobación.

**Archivos:**
- `docs/NORBERTO_3_PASOS_AHORA_2026-06-16.md` (nuevo)
- Enlaces: `SESSION_PRUEBA_COMPLETA`, `EMAIL_TICKET_GCP_NORBERTO`, `PROYECTO_TERMINADO_ESTADO_FINAL`

**Impacto web:** Ninguno código.

**Impacto asistente IA:** Ninguno código; paso 3 desbloquea `cumbre_synced:true` vía ticket org.

**Despliegue:** Solo documentación local.

**Validaciones:** Coherencia con `PROYECTO_TERMINADO` semáforo AMARILLO/ROJO y comando `npm run post-org-policy:fix`.

**Pendientes Norberto:** Ejecutar los 3 pasos del cheat sheet.

---

### 2026-06-16 — Documento único estado final (entrega agentes — cierre documentación)

**Objetivo:** Página única para Norberto con semáforo VERDE/AMARILLO/ROJO, evidencias enlazadas, 3 acciones por color, comando post-GCP `npm run post-org-policy:fix`, e índice maestro de todos los handoffs.

**Archivos:**
- `docs/PROYECTO_TERMINADO_ESTADO_FINAL_2026-06-16.md` (nuevo — **portada handoff**)
- Consolida índice de: `ENTREGA_FINAL_OPERATIVA`, `SESSION_PRUEBA_COMPLETA`, `GUIA_PRUEBA_GENERA_TU_ENERGIA`, `EMAIL_TICKET_GCP_NORBERTO`, `TICKET_ORG_POLICY_GCP`, `SIGN_OFF_FINAL`, `PRUEBA_INTEGRADA_FINAL`, `CIERRE_PROYECTO_BALANCE_FINAL`, reportes `.latest`, planes post-cierre

**Impacto web:** Ninguno código. Define promesas comerciales permitidas (asistida OK; self-service pendiente ROJO).

**Impacto asistente IA:** Coherente — agente prod OK; `cumbre_synced:false` hasta ticket org; post-fix re-validar curl agent/chat.

**Despliegue:** Solo documentación local.

**Validaciones:** Merge editorial vs batería 2026-06-16T08:18Z (`PRUEBA_INTEGRADA_FINAL`, `AUDIT_CIERRE.latest`, `post-org-policy-fix.sh` 6 pasos).

**Pendientes Norberto:** AMARILLO — SESSION + emails GCP + SIGN_OFF §C; ROJO — admin org + `npm run post-org-policy:fix`.

---

### 2026-06-16 — Entrega final operativa (handoff proyecto Norberto)

**Objetivo:** Documento ejecutivo único de handoff: qué funciona hoy (beta asistida, ERP 64/64, web cart/agent/contacto), qué bloquea ticket GCP org (signup self-service, `cumbre_synced`), definición de done operativo asistido vs 100% self-service, checklist post-ticket y timeline sprint cierre.

**Archivos:**
- `docs/ENTREGA_FINAL_OPERATIVA_2026-06-16.md` (nuevo)
- Enlaces cruzados: `SESSION_PRUEBA_COMPLETA`, `EMAIL_TICKET_GCP_NORBERTO`, `GUIA_PRUEBA_GENERA_TU_ENERGIA`, `TICKET_ORG_POLICY_GCP`, `SIGN_OFF_FINAL`, `PRUEBA_INTEGRADA_FINAL`

**Impacto web:** Ninguno código. Documento orienta validación manual Norberto y promesas comerciales permitidas hoy.

**Impacto asistente IA:** Documenta que agente prod responde OK pero `cumbre_synced:false` hasta ticket org; post-ticket re-validar curl agent/chat.

**Despliegue:** Solo documentación.

**Validaciones:** Consolidación vs `PRUEBA_INTEGRADA_FINAL` (07:48Z), `SIGN_OFF_FINAL` §H, `TICKET_ORG_POLICY` §6–§9. Agente `252ea5e7`: transcript **incompleto** (solo arranque); resultados ya en prueba integrada — merge explícito en §6 ENTREGA.

**Pendientes:** Norberto — (1) ejecutar GUIA/SESSION beta asistida; (2) firmar SIGN_OFF §C operativo asistido; (3) enviar emails GCP; (4) post-ticket §5 ENTREGA para self-service.

---

### 2026-06-16 — Emails listos tickets GCP org (Norberto)

**Objetivo:** Documento copy-paste para enviar ahora dos tickets admin GCP: (1) excepción org policy invoker `allUsers` Cloud Run Gen2; (2) Firestore Admin SDK PERMISSION_DENIED + audit `disableServiceAccountKeyCreation`. Incluye bloque post-aprobación y enlace a sesión de prueba completa.

**Archivos:**
- `docs/EMAIL_TICKET_GCP_NORBERTO_2026-06-16.md` (nuevo)
- Fuentes: `docs/TICKET_ORG_POLICY_GCP_2026-06-16.md`, `docs/SESSION_PRUEBA_COMPLETA_2026-06-16.md`

**Impacto web:** Ninguno código. Tras aprobación admin desbloquea `cumbre_synced:true` en contacto/agente WP.

**Impacto asistente IA:** Tras fix org policy, bridge `agentChat` y sync leads operativos sin workaround SA JSON.

**Despliegue:** Solo documentación; sin deploy.

**Validaciones:** Revisión manual contenido vs ticket técnico §1 y §2 (Firestore).

**Pendientes:** Norberto envía emails; admin confirma override beta+prod; ejecutar post-aprobación en doc y re-run SESSION pasos 7 + 8–11.

---

### 2026-06-16 — Prueba integrada final (batería secuencial agentes)

**Objetivo:** Ejecutar en una sola sesión la batería completa (audit:cierre, banco, E2E 64, smoke Ola 1, notificaciones, signup prod, curls prod, beta signin/smoke) y documentar resultados unificados para Norberto.

**Archivos:**
- `docs/PRUEBA_INTEGRADA_FINAL_2026-06-16.md` (nuevo)
- `docs/SIGN_OFF_FINAL_2026-06-16.md` (veredicto + ref integrada)
- `docs/CIERRE_PROYECTO_BALANCE_FINAL_2026-06-16.md` (sync 07:48Z)
- Reportes sync: `BANCO_PRUEBAS_COMPLETO.latest.*`, `BETA/PROD_DOGFOOD_PANELS_E2E.latest.json`, `AUDITORIA_MODULO_A_MODULO.latest.json`

**Impacto web:** Curl prod contacto creó lead de prueba `contact_9d124700557868007d9e688d53f83b9f` (`cumbre_synced:false`). Cart/agent/contact HTTP 200.

**Impacto asistente IA:** Agente chat prod responde 200; bridge Cumbre sin sync por org policy.

**Despliegue:** Solo validación; sin deploy.

**Validaciones (desde `~/.cumbre-mirror`):**
- `test:bank:fast` — 28 PASS · 0 FAIL · 3 SKIP
- `beta:e2e:dogfood-panels` + `prod:e2e:dogfood-panels` — 64/64 PASS (tras `playwright install chromium`)
- `smoke-ola1-flujo-cliente.sh` — 15/0/1
- `test:subscription:notifications` — 7/7
- `prod:test:signup-provisioning` — **FAIL** Firestore 403
- `beta:test:signin` + `beta:test:dogfood-smoke` — OK 32 módulos
- `audit:cierre` — FAIL 1ª corrida (Playwright ausente en banco); E2E re-ejecutado OK aparte

**Veredicto:** **PARCIAL global** · **READY FOR NORBERTO TEST** en ruta beta asistida Genera tu energía.

**Pendientes:** Ticket org policy GCP; re-test signup post-IAM; checklist manual Norberto §C GUIA.

---

### 2026-06-16 — Guía sesión única «Probar todo junto» (~90 min)

**Objetivo:** Unificar en un solo documento el recorrido Norberto: web prod + signup prod + ERP beta (Genera tu energía) + ERP prod dogfood; distinguir PASS hoy vs FAIL esperado (org policy); criterios de cierre operativo asistido y re-run post-ticket.

**Archivos:**
- `docs/SESSION_PRUEBA_COMPLETA_2026-06-16.md` (nuevo)
- Fuentes fusionadas: `GUIA_PRUEBA_GENERA_TU_ENERGIA_2026-06-16.md`, `SIGN_OFF_FINAL_2026-06-16.md`, `TICKET_ORG_POLICY_GCP_2026-06-16.md` (no existía `PRUEBA_INTEGRADA`)

**Impacto web:** Ninguno código. Documenta URLs copy-paste, curl contacto/carrito, veredicto `cumbre_synced:false` esperado hoy.

**Impacto asistente IA:** Coherente con venta asistida; no prometer self-service hasta P0-ORG resuelto.

**Despliegue:** Solo documentación local.

**Validaciones:** Consolidación editorial desde docs de cierre 2026-06-16 (E2E 32/32 beta+prod, banco 30 PASS, org policy abierto).

**Pendientes Norberto:**
1. Ejecutar `SESSION_PRUEBA_COMPLETA_2026-06-16.md` en una sentada (~90 min)
2. Ticket org policy §1 si C4/C5 fallan como se documenta
3. Sign-off SIGN_OFF §C tras sesión

---

### 2026-06-16 — Ruta beta asistida «Genera tu energía» 100% READY (paralelo org policy)

**Objetivo:** Cerrar camino «el proyecto funciona» para Genera tu energía en beta asistida mientras self-service espera P0-ORG. Verificar bootstrap `tenant_prueba_interna`, claims, E2E 32/32; documentar flujos CRM → presupuesto → cobro sandbox → factura homo → WhatsApp Hermes; marcar SIGN_OFF §H READY.

**Archivos:**
- `docs/GUIA_PRUEBA_GENERA_TU_ENERGIA_2026-06-16.md` (nuevo)
- `docs/SIGN_OFF_FINAL_2026-06-16.md` — §B estado READY, §H gates, link guía
- `docs/BETA_DOGFOOD_PANELS_E2E.latest.json` — sync corrida 2026-06-16T07:34Z

**Impacto web:** Ninguno código. Embudo W1–W6 documentado en guía; sync lead web→CRM prod sigue `cumbre_synced:false` hasta org policy.

**Impacto asistente IA:** Mantener venta asistida; no prometer self-service `@generatuenergia.net` hasta P0-ORG. Flujos ERP beta documentados para respuestas coherentes.

**Despliegue:** Solo validación + documentación local.

**Validaciones (desde `~/.cumbre-mirror`):**
- `npm run beta:test:dogfood-smoke -- --from-credentials` → **OK** (`tenant_prueba_interna`, 32 módulos, owner)
- `npm run beta:apply-claims` → **OK** (`beta@gema-digital.com` → owner `tenant_prueba_interna`)
- `npm run beta:e2e:dogfood-panels` → **32/32 PASS** (2026-06-16T07:34Z)

**Pendientes Norberto:**
1. Ejecutar checklist manual §C en `GUIA_PRUEBA_GENERA_TU_ENERGIA_2026-06-16.md` (~45–60 min)
2. Ticket org policy — `TICKET_ORG_POLICY_GCP_2026-06-16.md` (self-service)
3. Sign-off §C SIGN_OFF cuando complete prueba humana

---

### 2026-06-16 — Follow-up journey a9bf2fb2 / c71c311c: signup 32 módulos + contacto prod (cierre)

**Objetivo:** Semilla dogfood completa en provisioning trial, reparar tenant Genera tu energía, allowlist `@generatuenergia.net`, formulario contacto prod, deploy hosting beta+prod.

**Archivos (mirror `~/.cumbre-mirror`):**
- `shared/seedTrialTenantDogfood.ts` — misma matriz que `bootstrap-beta-dogfood-config` (32 módulos + configs P0/P1)
- `shared/dogfoodModuleConfigs.ts` — movido desde `scripts/lib/` para uso en Cloud Functions
- `shared/provisionTrialTenant.ts` — llama `applyTrialTenantDogfoodSeed` tras crear miembro/empresa
- `scripts/repair-signup-trial-tenant.ts` + `npm run beta:repair-signup-tenant`
- `scripts/bootstrap-beta-dogfood-config.ts` — refactor usa seed compartido
- `src/lib/useTenantShellSnapshot.ts` — cuenta módulos trial en sidebar (fix «0 modulos activos»)
- `functions/src/index.ts` — `ignoreUndefinedProperties`; runner usa SA compute default
- `scripts/fix-beta-functions-iam.sh` — `datastore.owner` en firebase-adminsdk
- `.env.beta.local` — `VITE_CUMBRE_SIGNUP_ALLOWED_DOMAINS=gema-digital.com,generatuenergia.net`

**Archivos (GEMA repo):**
- `scripts/sync-wordpress-prod.sh` — ejecutado prod (theme + plugins + wp-config)
- `docs/SIGN_OFF_FINAL_2026-06-16.md` — §G actualizado
- `REGISTRO_DE_TRABAJO_GEMA.md` — esta entrada

**Impacto web:** Formulario contacto en `https://gema-digital.com/contacto/` (`data-gema-contact-form`). Hosting beta+prod con allowlist `generatuenergia.net` en bundle JS.

**Impacto asistente IA:** Signup/login `@generatuenergia.net` habilitado en ERP prod/beta hosting. Bridge `cumbre_synced` sigue bloqueado por org policy (403 functions).

**Despliegue:**
- Cumbre beta: `deploy:beta:hosting`, functions signup (runner + provisionTrialTenant), `beta:fix:functions-iam`
- Cumbre prod: `deploy:prod:hosting`, `deploy-prod-functions.sh` (webhooks ML/WA IAM exit 2 esperado), signup functions targeted deploy
- IAM: `datastore.owner` firebase-adminsdk beta+prod
- WP prod: `sync-wordpress-prod.sh` — cart/agent/contact PASS

**Validaciones:**
- Tenant `uSZIyj2xlzeFsib9EVSDQPPS3ab2` → `tenant_uSZIyj2x_usziyj2xlzef`: **32 módulos** beta+prod (`beta:repair-signup-tenant`); claims owner prod OK
- Curl `/contacto/` → `data-gema-contact-form` presente
- Bundle prod → `generatuenergia.net` embebido
- `beta:test:signup-provisioning` → **FAIL timeout** — runner Cloud Run `PERMISSION_DENIED` Firestore Admin SDK (org policy / ticket P0-ORG; ver logs `cumbresignupprovisioningrunner`)

**Pendientes:** Excepción org policy GCP (`TICKET_ORG_POLICY_GCP_2026-06-16.md`); re-test signup manual UI post-logout tenant reparado; `cumbre_synced:true` post-invoker.

---

### 2026-06-16 — Follow-up journey a9bf2fb2: signup 32 módulos + contacto prod (borrador previo)

**Objetivo:** Corregir signup trial con 0 módulos, reparar tenant test Genera tu energía, desplegar formulario contacto prod y documentar allowlist `@generatuenergia.net`.

**Archivos (mirror `~/.cumbre-mirror`):**
- `shared/provisionTrialTenant.ts` — default `listPlatformFullModuleIds()` (32 módulos dogfood)
- `shared/tenantPanelSeed.ts` — helpers panel/billing compartidos (extraídos de `scripts/lib/betaTenantPanel.ts`)
- `scripts/lib/betaTenantPanel.ts` — re-export desde shared
- `scripts/test-beta-signup-provisioning-firestore.ts` — POST create + assert ≥32 módulos
- `.env.production.local` — `VITE_CUMBRE_ALLOWED_DOMAINS` + `VITE_CUMBRE_SIGNUP_ALLOWED_DOMAINS` con `generatuenergia.net`
- `.env.beta.example` — documentación allowlist
- `package.json` — `prod:test:signup-provisioning`

**Archivos (GEMA repo):**
- `scripts/sync-wordpress-prod.sh` — fix ruta theme `theme-gema-sovereign` + wp-config `$WP_REMOTE`
- `docs/SIGN_OFF_FINAL_2026-06-16.md` — §E/G actualizado

**Impacto web:** Formulario contacto embebido en `https://gema-digital.com/contacto/` (`data-gema-contact-form` confirmado). Theme + plugins Fase C rsync prod.

**Impacto asistente IA:** Sin cambio directo. Allowlist `@generatuenergia.net` en ERP prod hosting para signup/login cliente piloto.

**Despliegue:**
- Cumbre prod: `deploy:prod:functions` (runner + provisionTrialTenant OK; webhooks ML/WA IAM exit 2 esperado)
- Cumbre prod: `deploy:prod:hosting` (allowlist generatuenergia.net)
- WP prod: `sync-wordpress-prod.sh` (theme OK; wp-config pendiente re-run sin error Python)

**Validaciones:**
- Tenant test: `beta:expand:full-app` + `apply-claims` → `tenant_uSZIyj2x_usziyj2xlzef` 32 módulos
- Curl `/contacto/` → `data-gema-contact-form` presente
- `prod:test:signup-provisioning` → **FAIL** Firestore 403 (org policy / IAM — pendiente ticket P0-ORG)

**Pendientes:** Excepción org policy GCP; re-test signup manual UI (`test+genera@gema-digital.com` logout/login); `cumbre_synced:true`; deploy beta hosting si se requiere paridad.

---

### 2026-06-16 — Motor audiovisual programático Cumbre Marketing (Fase 1)

**Objetivo:** Scaffold del motor Node/TS (Portkey → Temporal → FFmpeg → Postiz) alineado al pipeline Python existente.

**Archivos:** `15-Produccion-Audiovisual/marketing/motor-audiovisual/` — Fase 1 Portkey implementada; Fases 2–5 stub; plan en `docs/PLAN-MOTOR-AUDIOVISUAL-PROGRAMATICO.md`. Puntero en `04-proyecto/marketing/00-MOTOR-AUDIOVISUAL-PROGRAMATICO.md`.

**Impacto web:** Ninguno directo.

**Impacto asistente IA:** Guiones generados alimentarán paquetes `03-produccion/`; patrón Portkey compartido con agente WP.

**Despliegue:** Local. `npm run build` OK.

**Pendientes:** Temporal worker (F2), TTS timestamps (F3), FFmpeg Node (F4), Postiz (F5), smoke Portkey con API key.

### 2026-06-16 — Ticket org policy GCP (excepción `allUsers` Cloud Run Gen2)

**Objetivo:** Documentar bloqueo P0 infra GCP para admin org: signup trial, bridge WordPress `cumbre_synced` y webhooks externos. Consolidar copy-paste español, lista 14 functions beta+prod, pasos consola, curls y tests post-fix.

**Archivos:**
- `docs/TICKET_ORG_POLICY_GCP_2026-06-16.md` (nuevo)
- `docs/SIGN_OFF_FINAL_2026-06-16.md` — §B.3 + §E re-auditoría (link ticket)
- `docs/CIERRE_PROYECTO_BALANCE_FINAL_2026-06-16.md` — INF-3 + merge hallazgos agentes IAM

**Impacto web:** Sin cambio código. `cumbre_synced: false` en prod hasta ticket; contacto/agente `ok:true` con fallback local.

**Impacto asistente IA:** Bridge CRM Cumbre bloqueado (403 functions). No afirmar sync lead/trial en CRM hasta P0-ORG.

**Despliegue:** Solo documentación local.

**Validaciones:**
- `~/.cumbre-mirror/docs/CIERRE_PROYECTO_FINAL.md` § org policy leído
- `npm run prod:fix:functions-invoker` → **14/14 ERROR 400** *permitted customer* (org `1019962368971`)
- Transcripts `86bbda8c`, `a9bf2fb2`, `d0ab0461` incompletos; hallazgos IAM desde agente `4a6d1b18` mergeados en ticket y CIERRE

**Pendientes Norberto:**
1. Enviar ticket §1 de `TICKET_ORG_POLICY_GCP_2026-06-16.md` a admin org GCP
2. Post-aprobación: `beta:fix:functions-invoker` + `prod:fix:functions-invoker` + `beta:fix:functions-iam`
3. Validar `test-beta-signup-provisioning-firestore.ts` y `cumbre_synced: true`

---

### 2026-06-16 — Continuación cierre post IAM/WP deploy

**Objetivo:** Re-ejecutar suite cierre desde `~/.cumbre-mirror` y registrar estado prod WP (cart, agent, contact, `cumbre_synced`).

**Archivos:** `docs/SIGN_OFF_FINAL_2026-06-16.md` (§E), `docs/CIERRE_PROYECTO_BALANCE_FINAL_2026-06-16.md`, reportes sync `AUDIT_CIERRE.latest.*`, `BANCO_PRUEBAS_COMPLETO.latest.*`, `BETA_*` / `PROD_*` E2E JSON.

**Impacto web:** Prod confirma plugin pagos (`cart` 200); agente y contacto responden 200 pero **no sincronizan CRM Cumbre** (`cumbre_synced:false`).

**Impacto asistente IA:** Mantener: respuestas OK en widget; no afirmar lead/trial en CRM hasta IAM/sync resuelto.

**Despliegue:** Solo validación; sin deploy nuevo en esta corrida.

**Validaciones:**
- `npm run audit:cierre`: **PARCIAL** (P0×4 checklist, COM-SELF-SERVICE fail)
- Banco: **30 PASS · 0 FAIL · 1 SKIP**; E2E **64/64**; `prod:health` **PASS**
- `smoke-ola1-flujo-cliente.sh`: **15/0/1**
- Curl prod: cart **200**; agent chat **200** (`cumbre_synced:false`); contact API **200** (`cumbre_synced:false`); `/contacto/` **200**

**Pendientes Norberto:** (1) Excepción org policy — ver `TICKET_ORG_POLICY_GCP_2026-06-16.md`. (2) Prueba manual signup + lead post-IAM. (3) Allowlist dominios P0-4. (4) Checklist Genera tu energía §B.

---

### 2026-06-16 — Journey test browser «Genera tu energía» (signup + embudo web prod)

**Objetivo:** Validar flujo cliente real como Genera tu energía: signup Cumbre prod, precios/carrito, contacto, agente IA trial 14 días.

**Archivos afectados:**
- `docs/SIGN_OFF_FINAL_2026-06-16.md` — sección E + checklist B actualizado
- `docs/journey-evidence-2026-06-16/` — screenshots + `results.json` / `results-extra.json`

**Impacto web:** Precios y contacto cargan OK; REST cart **200**; contacto sin form embebido en prod; agente IA operativo con gate lead (nombre/WhatsApp).

**Impacto asistente IA:** Responde en prod; no explica trial sin capturar datos de contacto primero — coherente con venta asistida.

**Despliegue:** Solo documentación local; prueba contra prod en vivo.

**Validaciones:**
- E.1 Signup `test+genera@gema-digital.com` → tenant creado, trial 14 d badge, 0 módulos — **PARTIAL**
- E.2 `/erp/precios` trial copy + cart API 200 — **PARTIAL**
- E.3 `/contacto` sin form multi-campo — **PARTIAL**
- E.4 Agente trial 14 d → pide WhatsApp — **PARTIAL PASS**
- Browser MCP: no disponible (tabs vacíos); Playwright headless usado

**Pendientes:** P0-2 IAM invoker; P0-4 allowlist `@generatuenergia.net`; form contacto prod; matriz módulos post-signup trial; limpieza usuario test si aplica.

---

### 2026-06-16 — Deploy Fase C WordPress producción (theme + plugins v0.2 + wp-config)

**Objetivo:** Cerrar P0-1 — desplegar integración Web ↔ Cumbre en `https://gema-digital.com`: plugins Fase C, theme con CTA ERP prod, constantes `GEMA_CUMBRE_*` en wp-config.

**Archivos repo:**
- `wordpress/plugins/gema-payments-platform/` v0.2.0, `gema-leads-api/` v0.2.0, `gema-notifications-orchestrator/` v0.2.0 (nuevo en prod), `gema-agent-api/` v0.4.0
- `wordpress/theme-gema-sovereign/` — header «Iniciar sesión» → `cumbre-erp-prod.web.app`, cart/checkout + contact form JS
- `scripts/sync-wordpress-prod.sh` (nuevo) — deploy automatizado vía `gcloud compute scp` + WP-CLI
- `scripts/deploy-fase-c-prod-checklist.sh` — referencia script prod + bloqueo org policy

**Impacto web:** Producción actualizada en VM `gema-web-server` (`/home/gema-digital.com/public_html`). Plugins activos v0.2. Theme `gema-sovereign` activo (child de twentytwentyfive). wp-config con `GEMA_CUMBRE_TENANT_ID`, URLs Cloud Functions prod, `GEMA_SALES_ALERT_EMAIL`.

**Impacto asistente IA:** Widget `/wp-json/gema/v1/agent/chat` responde 200 en prod; bridge CRM Cumbre (`cumbre_synced`) **pendiente** hasta IAM invoker functions (org policy bloquea `allUsers` → HTTP 403 a `wordpressIngestLead` / `agentChat`).

**Despliegue:** **Producción** — SSH `gcloud compute ssh root@gema-web-server` + rsync plugins/theme + WP-CLI activate + wp-config desde Secret Manager `CUMBRE_WORDPRESS_WEBHOOK_TOKEN` (sin commitear valores).

**Validaciones prod (curl):**
- `GET /wp-json/gema-payments/v1/cart` → **200** `ready_for_commercial_checkout`
- `POST /wp-json/gema/v1/agent/chat` → **200** `ok:true` (fallback local; `cumbre_synced:false` por 403 functions)
- `POST /wp-json/gema/v1/contact` → **200** `ok:true` (`cumbre_synced:false` — mismo bloqueo IAM)
- Home HTML contiene `cumbre-erp-prod.web.app`
- `scripts/test-web-prod-smoke.sh` → 7/8 pass (grep marca «gema» case-sensitive en HTML minificado)
- `scripts/smoke-integracion-web-cumbre.sh` → 16/16 estáticos pass; REST local skip (activar plugins Studio)

**Pendientes:**
1. **Org policy GCP** — excepción `allUsers` en Cloud Run Gen2 prod: `wordpressIngestLead`, `agentChat`, `wordpressIngestWhatsappAgentAction` (`npm run prod:fix:functions-invoker` en `~/.cumbre-mirror`; hoy exit 400 org policy).
2. Sincronizar `GEMA_NOTIFICATIONS_WEBHOOK_SECRET` wp-config ↔ Secret Functions `GEMA_NOTIFICATIONS_WEBHOOK_SECRET` tras fix IAM.
3. Studio local: activar plugins tras `scripts/sync-wordpress-local.sh` para smoke REST 6/6 local.

### 2026-06-16 — Menú móvil: acordeón Cumbre ERP (paridad desktop)

**Objetivo:** Corregir menú hamburguesa en celular: debe listar todos los ítems como desktop, con Cumbre ERP colapsable (acordeón), sin auto-expandir al abrir ☰ ni bloquear el cierre.

**Archivos:**
- `wordpress/theme-gema-sovereign/assets/gema-mega-menu.js` — toggle ☰, acordeón Cumbre vía botón «Módulos» / primer tap en enlace; cierre con Escape, tap fuera y navegación; fix `defaultPrevented` para no cerrar nav al expandir Cumbre
- `wordpress/theme-gema-sovereign/style.css` — panel nav scrollable (72vh), grid mega scroll (52vh), sin CSS `!important` force-open
- `wordpress/theme-gema-sovereign/parts/header.html` — botón «Módulos» + `id="gema-mega-menu-cumbre"`
- `scripts/audit-mobile-nav.js` — smoke estático 15 checks local + producción

**Impacto web:** Navegación móvil alineada al mega menú desktop (módulos, verticales, comparativas accesibles desde ☰).

**Impacto asistente IA:** Sin cambio (URLs de destino ya existentes).

**Despliegue:** Producción `https://gema-digital.com` vía `scripts/deploy-theme-production.sh` · backup `/root/gema-production-backups/gema-sovereign-before-mobile-nav-20260616-034442.tgz` · cache WP flush OK.

**Validaciones:** `node scripts/audit-mobile-nav.js` → **15/15 PASS** (local + prod). Smoke HTTP deploy OK.

**Fix adicional (mismo día):** `:focus-within` en móvil ocultaba el mega menú al tocar «Módulos» (mayor especificidad que `--open`). Reglas `--open:focus-within` añadidas en `style.css`. Re-deploy backup `gema-sovereign-before-mobile-nav-20260616-040631.tgz`.

**Pendientes:** ~~Confirmación visual en dispositivo real~~ — **OK** (usuario, 2026-06-16): acordeón «Módulos» muestra submenú en local y producción.

### 2026-06-16 — Agente suscripciones + orquestador notificaciones (cierre Norberto)

**Objetivo:** Robot administración suscripciones y pipeline notificaciones trial/cobros en cierre GEMA/Cumbre.

**Archivos Cumbre (`~/.cumbre-mirror`):** `shared/agenteSuscripciones*.ts`, `shared/billingCommercialBridge.ts`, `shared/commercialEventNotifications.ts`, `shared/trialExpiringNotifier.ts`, `functions/src/index.ts`, registry/router/agentPanelJobs, `scripts/test-subscription-agent-notifications.ts`

**Archivos Web:** `wordpress/plugins/gema-notifications-orchestrator/` v0.2.0, `docs/AGENTE_SUSCRIPCIONES_NOTIFICACIONES_2026-06-16.md`, balance cierre §7, PLAN O3-04/O4-02

**Impacto web:** Orchestrator acepta eventos bus comercial; deploy prod pendiente.

**Impacto asistente IA:** `subscriptionAgent` + router multiagente; tareas/handoff limitados.

**Despliegue:** Local/mirror únicamente.

**Validaciones:** `test:subscription:notifications` 7/7 PASS · `functions:typecheck` OK.

**Pendientes:** Deploy Functions (`subscriptionAgent`, `cumbreTrialExpiringNotifier`), secrets `GEMA_NOTIFICATIONS_WP_URL`, dunning retry O4-02.

### 2026-06-16 — Follow-up Ola 1 post-`3c2da563` (deploy coordinación + docs cierre)

**Objetivo:** Tras Ola 1 completada, intentar deploy beta/prod mirror, smoke Ola 1, checklist Fase C prod; consolidar estado agentes paralelos en balance cierre.

**Archivos:**
- `docs/CIERRE_PROYECTO_BALANCE_FINAL_2026-06-16.md` — §7 follow-up Ola 1, P0 código vs deploy, agente suscripciones en curso
- `REGISTRO_DE_TRABAJO_GEMA.md` — esta entrada

**Agentes paralelos:**
- `1b1258d9` (balance módulos): **COMPLETADO** — 64/64 E2E PASS; ver `docs/BALANCE_MODULO_A_MODULO_2026-06-16.md`
- `e7233510` (suscripciones/notificaciones): **COMPLETADO** — ver `docs/AGENTE_SUSCRIPCIONES_NOTIFICACIONES_2026-06-16.md`

**Impacto web:** Sin deploy prod. Checklist Fase C impreso; SSH prod no disponible desde entorno agente.

**Impacto asistente IA:** Sin cambio hasta deploy leads-api + orchestrator prod.

**Despliegue:** **No ejecutado** — `npm run beta:check:adc` → `invalid_grant` (functions + hosting beta omitidos).

**Validaciones:**
- `npm run beta:check:adc` → FAIL `invalid_grant`
- `bash scripts/smoke-ola1-flujo-cliente.sh` → 14 pass, 0 fail, 2 skip
- `bash scripts/deploy-fase-c-prod-checklist.sh` → checklist documentado

**Pendientes Norberto:** PASO3 renovar ADC → deploy beta functions/hosting → prod si health OK → rsync WP Fase C (§ checklist).

### 2026-06-16 — Balance módulo a módulo Cumbre ERP (64/64 E2E PASS)

**Objetivo:** Validar y cerrar dogfood 32 módulos × beta + prod; documentar bloqueos ADC; corregir smoke Web GEMA.

**Archivos Cumbre (`~/.cumbre-mirror`):**
- `docs/BALANCE_MODULO_A_MODULO_2026-06-16.md` — matriz final módulo × entorno
- `docs/BETA_DOGFOOD_PANELS_E2E.latest.json`, `docs/PROD_DOGFOOD_PANELS_E2E.latest.json`, `docs/AUDITORIA_MODULO_A_MODULO.latest.json` — reportes E2E 2026-06-16
- `scripts/run-audit-cierre.ts` — fix TS6133 parámetro no usado (desbloquea `build:prod`)

**Archivos Web GEMA:**
- `wordpress/theme-gema-sovereign/parts/header.html` — enlace `Acceder a ERP` → `cumbre-erp-prod.web.app`
- `docs/BALANCE_MODULO_A_MODULO_2026-06-16.md` + sync JSON E2E en `docs/`

**Impacto web:** Smoke integración Web↔Cumbre 16/16 pass (header prod ERP). Pendiente rsync theme a producción.

**Impacto asistente IA:** Sin cambios de conocimiento; 32 módulos operativos en prod/beta alineados con matriz comercial.

**Despliegue:** No ejecutado — ADC `invalid_grant`. Hosting beta/prod ya servía 32/32 en E2E live.

**Validaciones:**
- `npm run beta:e2e:dogfood-panels` → 32/32 PASS
- `npm run prod:e2e:dogfood-panels` → 32/32 PASS
- `bash scripts/smoke-integracion-web-cumbre.sh` → 16 pass, 0 fail
- `npm run beta:check:adc` → FAIL (`invalid_grant`)
- `npm run test:bank:fast` → FAIL parcial (ADC + prod:health CLI; E2E skip por `--fast`)

**Pendientes:** Renovar ADC (`docs/fase4/PASO3_RENOVAR_ADC.md`); deploy theme header; `npm run test:bank` completo post-ADC.

### 2026-06-16 — Ola 1 Sprint 1: flujo cliente (event bus + provisioning + signup + Fase C prep)

**Objetivo:** Cerrar MVP local del flujo lead → checkout → signup → tenant trial sin scripts admin (O1-01, O1-04, O1-05, O1-02 prep, O1-03).

**Archivos Cumbre (`~/.cumbre-mirror`):**
- `shared/commercialEvents.ts` — schema v1 + publish idempotente
- `shared/provisionTrialTenant.ts` — state machine idempotente
- `functions/src/commercialEventSubscribers.ts` — audit + CRM side effects (2 subscribers)
- `functions/src/index.ts` — `gemaCommercialEventRouter`, `provisionTrialTenant`, `provisionTrialTenantHttp`, `lead.captured` en `wordpressIngestLead`
- `shared/crm.ts` — UTM en `WordPressLeadPayload`
- `shared/cumbreMultiAgentRouter.ts` — roles recepcionista/asesor/vendedor/derivador
- `src/App.tsx` + `src/lib/firebaseConfig.ts` — signup público + callable provisioning
- `.env.beta.example` — `VITE_CUMBRE_SIGNUP_PUBLIC`, `VITE_CUMBRE_SIGNUP_ALLOWED_DOMAINS`

**Archivos Web GEMA:**
- `wordpress/plugins/gema-leads-api/gema-leads-api.php` v0.2 — `gema_leads_api_sync_lead_data`, POST `/gema/v1/contact` + UTM → Cumbre
- `wordpress/plugins/gema-payments-platform/gema-payments-platform.php` v0.2 — checkout con UTM
- `wordpress/theme-gema-sovereign/assets/gema-cart-checkout.js` — UI checkout `/erp/precios`
- `wordpress/theme-gema-sovereign/assets/gema-contact-form.js` — form `/contacto`
- `wordpress/theme-gema-sovereign/functions.php` — enqueue widgets cart + contacto
- `scripts/deploy-fase-c-prod-checklist.sh`, `scripts/smoke-ola1-flujo-cliente.sh`

**Impacto web:** Carrito y contacto con REST + bridge CRM; widgets en precios/contacto; checklist deploy Fase C para Norberto.

**Impacto asistente IA:** Router comercial 4 roles en Cumbre (determinístico); agent plugin depende de leads-api completo.

**Despliegue:** Solo local/mirror. Prod pendiente Norberto (wp-config + rsync + Firebase functions/hosting).

**Validaciones:**
- `npm run typecheck` + `npm run functions:typecheck` OK en mirror Cumbre
- `scripts/smoke-ola1-flujo-cliente.sh` → 14 pass, 0 fail, 2 skip (REST WP local 404 — plugins no activos en Studio)
- `scripts/smoke-integracion-web-cumbre.sh` → 16 pass, 0 fail, 3 skip

**Pendientes deploy humano:**
1. WP prod: activar plugins + wp-config Cumbre (checklist §scripts/deploy-fase-c-prod-checklist.sh)
2. Firebase prod: deploy functions `provisionTrialTenant`, `gemaCommercialEventRouter`, `wordpressIngestLead` actualizado
3. Hosting Cumbre prod: build con signup público habilitado
4. Smoke E2E real: signup → tenant visible en panel (<120s)

### 2026-06-16 — Arquitectura ideal GEMA+Cumbre (investigación web, no HubSpot-copy)

**Objetivo:** Definir stack/arquitectura óptima 2026 para web GEMA + Cumbre ERP hermanados, con investigación web extensiva (PLG, composable billing, AI-native sales, Firebase multi-tenant, LATAM fintech, WhatsApp, Odoo/Zoho patterns) y análisis profundo del proyecto. HubSpot solo como contraste puntual.

**Archivos:**
- `docs/ARQUITECTURA_IDEAL_GEMA_CUMBRE_2026-06-16.md` (nuevo)
- `docs/PLAN_IMPLEMENTACION_ARQUITECTURA_IDEAL_2026-06-16.md` (nuevo)
- `docs/PLAN_ACCION_SISTEMA_100_INTEGRADO_2026-06-16.md` (cross-ref north star)

**Veredicto arquitectónico:** ERP Cumbre como sistema de verdad + WordPress headless captación + Gema Commercial Events Bus + Agent Router nativo + billing ledger MP/Nave/ARCA. Integración ~38% hoy; objetivo 85% en 12m.

**Impacto web:** Sin código. Próximo Ola 1: deploy Fase C + event bus + provisioning SM.

**Impacto asistente IA:** Router 4 roles + knowledge API dinámica (Ola 2); guardrails honestos hasta self-serve Ola 3.

**Despliegue:** Solo documentación local.

**Validaciones:** Repos GEMA + mirror Cumbre; docs FLUJO_CLIENTE, RELEVAMIENTO_VENTA, INTEGRACION_WEB_CUMBRE, BENCHMARK; 10+ búsquedas web jun-2026.

**Pendientes:** Aprobación 3 decisiones arquitectónicas Norberto; O1-02 deploy Fase C prod.

### 2026-06-15 — Menú móvil: submenú Cumbre ERP accesible

Objetivo:
Corregir navegación en celulares: el mega menú Cumbre ERP no era accesible en producción (solo `:hover` desktop; tap en móvil iba directo a `/erp-cumbre`).

Archivos:
- `wordpress/theme-gema-sovereign/parts/header.html` — botón Menú + toggle submenú Cumbre
- `wordpress/theme-gema-sovereign/assets/gema-mobile-nav.js` (nuevo)
- `wordpress/theme-gema-sovereign/style.css` — panel móvil colapsable + mega menú expandible
- `wordpress/theme-gema-sovereign/functions.php` — enqueue script

Impacto web:
- Mobile ≤980px: **Menú** → **Cumbre ERP** → chevron despliega módulos/verticales.
- Desktop sin cambio (hover mega menú).

Impacto asistente IA:
- Sin cambio.

Despliegue:
- **2026-06-16** deploy OK (`deploy-theme-production.sh`). Backup: `gema-sovereign-before-mobile-nav-20260616-033358.tgz`.
- Fix: al abrir menú ☰ en móvil, submenú Cumbre visible sin segundo tap (CSS + JS).

Validaciones:
- Revisión código local; smoke test móvil post-deploy.

Pendientes:
- Desplegar theme a `https://gema-digital.com`.

### 2026-06-16 — Benchmark HubSpot/Salesforce + plan acción post-benchmark

**Objetivo:** Investigación profunda sistemas primera línea (HubSpot Breeze, Salesforce Agentforce, Pipedrive/Zoho, Intercom Fin); tabla capacidad×gap; plan acción MVP 90d y sprint 2 semanas con roles agente.

**Archivos:** `docs/BENCHMARK_SISTEMAS_PRIMERA_LINEA_2026-06-16.md` (nuevo), `docs/PLAN_ACCION_GEMA_CUMBRE_BENCHMARK_2026-06-16.md` (nuevo), `docs/PLAN_ACCION_SISTEMA_100_INTEGRADO_2026-06-16.md` (actualizado cross-ref benchmark).

**Veredicto:** ~22% stack HubSpot-like hoy; MVP 90d ~40–45%; 12 meses ~55–65%. Top gap: provisioning trial, deploy Fase C, signup, checkout, form+UTM, agente multi-rol sync prod.

**Impacto web:** Sin código. Sprint 1: QW-01 deploy Fase C, QW-02 form contacto, QW-04 checkout UI.

**Impacto asistente IA:** Roles recepcionista/asesor/vendedor/derivador definidos; guardrails anti promesa self-service; pendiente implementación M1-06.

**Despliegue:** Solo documentación local.

**Validaciones:** Web search features 2025–2026; cruce relevamientos 2026-06-16 + mirror Cumbre (`shared/crm.ts`, `cumbreAgentsRegistry.ts`, `wordpressIngestLead`).

**Pendientes:** Ejecutar Sprint 1 §8 plan benchmark. Ver `docs/PLAN_ACCION_GEMA_CUMBRE_BENCHMARK_2026-06-16.md`.

---

### 2026-06-16 — Plan de acción sistema 100% integrado (web → agente → carrito → ERP)

**Objetivo:** Documento maestro de coordinación del flujo integrado. Actualizado post-benchmark con cross-ref a fases QW/M1/M2/M3.

**Archivos:** `docs/PLAN_ACCION_SISTEMA_100_INTEGRADO_2026-06-16.md` (actualizado).

**Contenido:** Definición sistema integrado, estado por capa (~38%), roadmap IDs unificados con plan benchmark, checklist MVP 90d, mapeo P0/P1.

**Impacto web / asistente IA:** Ver plan benchmark; superficies duales obligatorias.

**Despliegue:** Solo documentación local.

**Pendientes:** Consolidado en `docs/PLAN_ACCION_GEMA_CUMBRE_BENCHMARK_2026-06-16.md`.

---

### 2026-06-16 — Relevamiento venta GEMA/Cumbre (cupones, pagos, agente, catálogo)

**Objetivo:** Auditar si está todo lo necesario para **vender productos GEMA y Cumbre** antes de construir MVP self-service. Áreas: cupones, sistemas de pago, chatbot/agente, catálogo comercial, flujo venta completo.

**Archivos:** `docs/RELEVAMIENTO_VENTA_GEMA_CUMBRE_2026-06-16.md` (nuevo), `docs/PLAN_CIERRE_100_FUNCIONAL_2026-06-16.md` (nuevo).

**Veredicto:** **Venta asistida OK** (web, landings, precios, agente, contacto, ventas@, WhatsApp). **Self-service NO** (sin cupones, carrito REST 404 en prod, sin checkout/cobro, sin provisioning automático tenant/trial, sin signup ERP).

**Impacto web:** Sin cambio de código. Matriz componente×estado documentada. P0: deploy Fase C prod, `provisionTrialTenant`, checkout UI, signup Cumbre.

**Impacto asistente IA:** Agente responde en prod pero `cumbre_synced: false` (wp-config Cumbre incompleto). Riesgo: promete trial self-service cuando el flujo real termina en contacto comercial. Pendiente P1: proxy Cumbre + prompts alineados.

**Despliegue:** Solo documentación local.

**Validaciones:** curl prod — `GET /wp-json/gema-payments/v1/cart` → 404; `POST /wp-json/gema/v1/agent/chat` → 200 genérico. Auditoría código WP plugins + mirror Cumbre (`shared/billing.ts`, adapters MP/Nave, `bootstrap-beta-tenant.ts`). Precios web ↔ código OK (CRM, Cobros, Negocios, PyMEs).

**Pendientes P0:** ver `docs/PLAN_CIERRE_100_FUNCIONAL_2026-06-16.md`. No implementar MVP en esta entrada.

---

### 2026-06-16 — Cambio de enfoque: flujo cliente real vs bootstrap dev

**Objetivo:** Norberto corrige el enfoque del relevamiento: **no** bootstrap técnico (tenants pre-creados, `apply-claims`, `repair-panel`), sino simular lo que haría un **cliente real** que compra GEMA/Cumbre desde cero. Documentar recorrido exacto, gaps y MVP mínimo self-serve.

**Archivos:** `docs/FLUJO_CLIENTE_DESDE_CERO_2026-06-16.md` (nuevo, fusión auditoría código + verificación prod).

**Enfoque descartado:** `tenant_prueba_interna`, `tenant_gema_prod_interno`, scripts `beta:bootstrap-tenant`, `apply-claims`, `repair-panel` como proxy de «cliente nuevo».

**Enfoque actual:** Embudo web W1–W6 → contacto comercial → (post-ventas) uso ERP G2–G11 / M2–M7. Empresas piloto: (1) Genera tu energía / Generadores Sur SRL, (2) GEMA Digital.

**Impacto web:** Ningún cambio de código. Veredicto prod: landings y planes **OK**; checkout/trial self-serve y provisioning tenant **FALTA**; `/login` placeholder; API cart 404; CTAs Fase C («Acceder a ERP») no desplegados en header prod.

**Impacto asistente IA:** Sin cambio de conocimiento. Agente responde en prod; bridge Cumbre `cumbre_synced: false` si wp-config incompleto. Pendiente: alinear respuestas del agente para no prometer self-service inexistente.

**Despliegue:** Solo documentación local.

**Validaciones:** curl prod — home, `/erp/precios`, `/contacto`, `/login`, `/cumbre-erp-negocios`, `cumbre-erp-prod.web.app` 200; `GET /wp-json/gema-payments/v1/cart` 404; agent chat OK. Código Cumbre: sin signup, sin provisioning UI, login solo con claims preexistentes.

**Pendientes MVP self-serve (G1–G8):** deploy Fase C WP + plugin pagos (G1); Cloud Function `provisionTrialTenant` (G3+G4); signup/wizard Cumbre (G2+G6); SSO web→ERP (G5); billing real (G1 billing); allowlist dominios (G7); acta fiscal GEMA vs Generadores Sur (G8).

---

### 2026-06-15 — Banco de pruebas unificado (`test:bank` / `audit:full`)

- **Objetivo:** Interconectar y activar suite maestra de pruebas Cumbre ERP + integración Web GEMA (Fase C), con reporte JSON/MD y matriz 32×2 entornos.
- **Archivos / sistemas:**
  - Espejo `~/.cumbre-mirror`: `scripts/run-test-bank.ts`, `package.json` (`test:bank`, `test:bank:fast`, `audit:full`)
  - Docs: `docs/BANCO_PRUEBAS_COMPLETO.md`, `docs/BANCO_PRUEBAS_COMPLETO.latest.json|.md`
  - Repo GEMA: `docs/BANCO_PRUEBAS_COMPLETO.md`, sync automático de reportes E2E
  - `scripts/smoke-integracion-web-cumbre.sh` — REST 404 → SKIP (plugins WP no activados localmente)
- **Impacto web:** Smoke Fase C 15/15 estáticos PASS; REST local SKIP hasta activar plugins (`sync-wordpress-local.sh`).
- **Impacto asistente IA:** Sin cambio de conocimiento; E2E valida `agente_chatbot` y `whatsapp_hub` en beta+prod.
- **Despliegue:** Solo local/scripts — sin deploy productivo.
- **Validaciones (`npm run test:bank`, ~135s):**
  - **64/64 E2E módulos PASS** (32 beta + 32 prod) — matriz `AUDITORIA_MODULO_A_MODULO.latest.json`
  - **25 PASS | 4 FAIL | 2 SKIP** en orquestador (31 pasos)
  - PASS: cimientos (contracts/rules/functions/nav), integración GEMA, 8 adapters, health beta (6/6), E2E×2
  - FAIL: ADC `invalid_rapt`, typecheck (corregido post-run), prod:health (Firebase CLI), smoke WP REST (→ SKIP tras fix)
  - SKIP: bootstrap GEMA dry-run (ADC), validate:cimientos:local (solo en `audit:full`)
- **Comandos activos:**
  - `npm run test:bank` — suite completa con E2E
  - `npm run test:bank:fast` — sin E2E ni readiness
  - `npm run audit:full` — incluye `validate:cimientos:local`
- **Pendientes:** Renovar ADC (`docs/fase4/PASO3_RENOVAR_ADC.md`); `npm run beta:repair:auth`; activar plugins WP local para REST smoke PASS.

### 2026-06-15 — CIERRE DEFINITIVO: auditoría 32 módulos × 2 entornos (64/64 PASS)

- **Objetivo:** Cierre autorizado por Norberto — auditar cada módulo de `listPlatformFullModuleIds()` en prod y beta hasta PASS total, sin pruebas manuales.
- **Archivos / sistemas:** `~/.cumbre-mirror/scripts/run-beta-dogfood-panels-e2e.ts` (reportes beta/prod separados + `AUDITORIA_MODULO_A_MODULO.latest.json`); evidencia en `docs/AUDITORIA_*`, `docs/BETA_DOGFOOD_PANELS_E2E.latest.json`, `docs/PROD_DOGFOOD_PANELS_E2E.latest.json`; `docs/AUDITORIA_CIERRE_DEFINITIVO_2026-06-15.md`.
- **Impacto web:** Fase C smoke estático 6/6 PASS (`scripts/smoke-integracion-web-cumbre.sh`); deploy WP prod sigue pendiente (sin cambio).
- **Impacto asistente IA:** Sin cambio de conocimiento; paneles agente_chatbot/whatsapp_hub validados E2E en ambos entornos.
- **Despliegue:** Solo local (rebuild `build:beta` en mirror). Hosting prod/beta ya desplegado — E2E contra URLs live.
- **Validaciones:**
  - `npm run beta:e2e:dogfood-panels` → **32/32 PASS** (`tenant_prueba_interna`)
  - `npm run prod:e2e:dogfood-panels` → **32/32 PASS** (`tenant_gema_prod_interno`)
  - `docs/AUDITORIA_MODULO_A_MODULO.latest.json` → **64/64 PASS**
  - `npm run beta:health` → 6/7 (ADC backup `invalid_grant`; signin, smoke, agentes, roles, build, hosting OK)
  - `npm run prod:health` → build + hosting OK; Firebase CLI sin sesión local
  - Fase C smoke estático 6/6 PASS
- **Veredicto:** **PROYECTO CERRADO** (UI dogfood). Gaps no bloqueantes: ADC/CLI local, ML KYC, MP OAuth, deploy WP Fase C prod.
- **Pendientes:** Renovar ADC (`docs/fase4/PASO3_RENOVAR_ADC.md`); `npm run beta:repair:auth` para CLI prod; deploy Fase C WP; trámites ML/MP externos.

### 2026-06-15 — P0 revalidación: módulos bloqueados prod (ADC/CLI vencidos; E2E 32/32 OK)

- **Objetivo:** Re-ejecutar runbook bootstrap + claims + repair + deploy tras reporte Norberto de módulos bloqueados en prod y beta.
- **Causa raíz confirmada (sesión usuario):** JWT/cache del browser con claims o tenant desalineados tras fix anterior; backend Firestore ya bootstrapado (fix matutino mismo día).
- **Bloqueo operativo agente:** ADC Google (`invalid_grant` / `invalid_rapt`) y Firebase CLI sin sesión — impide re-ejecutar `beta:bootstrap:dogfood`, `beta:apply-claims`, `beta:repair-panel` y `deploy:prod:hosting` / `deploy:beta:hosting` desde espejo sin terminal interactiva.
- **Archivos / sistemas:** espejo `~/.cumbre-mirror` (sync OK); wrappers `prod:bootstrap:dogfood`, `prod:apply-claims`, `prod:repair-panel` ya existentes en `package.json`.
- **Impacto web GEMA:** ninguno.
- **Impacto asistente IA:** ninguno.
- **Despliegue:** no ejecutado (auth CLI vencida); hosting prod HTTP 200 con build actual.
- **Validaciones:**
  - `CUMBRE_BETA_E2E_URL=https://cumbre-erp-prod.web.app npm run beta:e2e:dogfood-panels` → **32/32 PASS** (CRM + Cobros OK).
  - Beta `beta:test:dogfood-smoke --from-credentials` → ok (`tenant_prueba_interna`, 32 módulos).
  - Beta `beta:health` → ADC FAIL + dist beta contaminado con refs prod (rebuild beta pendiente tras deploy).
  - Prod `prod:health` → hosting OK, Firebase CLI FAIL.
- **Acción requerida Norberto (2 min):** cerrar sesión → `Cmd+Shift+R` → login `beta@gema-digital.com` → tenant `tenant_gema_prod_interno`.
- **Acción requerida terminal (5 min, una vez):** `cd ~/.cumbre-mirror && npm run beta:repair:auth` (renueva gcloud ADC + Firebase CLI); luego runbook completo si hace falta re-bootstrap.
- **Pendientes:** renovar ADC/CLI; opcional redeploy hosting tras auth; screenshot manual CRM/Cobros si persiste bloqueo tras logout.

### 2026-06-15 — P0 prod: módulos bloqueados `tenant_gema_prod_interno` (Firestore bootstrap)

- **Objetivo:** Restaurar acceso a los 32 módulos en producción Cumbre (`https://cumbre-erp-prod.web.app`) tras soft launch; mismo patrón que beta (faltaba bootstrap Firestore + claims + repair panel).
- **Causa raíz:** Tenant piloto `tenant_gema_prod_interno` sin matriz `suscripcion_modulos`, panel `panel_control/configuracion` ni configs P0 (CRM, Cobros, etc.); claims JWT del usuario owner apuntaban al tenant incorrecto o incompletos.
- **Archivos / sistemas afectados:**
  - Espejo `~/.cumbre-mirror`: scripts existentes `beta:bootstrap:dogfood`, `beta:apply-claims`, `beta:repair-panel` ejecutados contra `cumbre-erp-prod`.
  - Nuevos wrappers en `package.json`: `prod:bootstrap:dogfood`, `prod:apply-claims`, `prod:repair-panel`, `prod:e2e:dogfood-panels`.
  - Firestore prod: `artifacts/cumbre-erp/users/tenant_gema_prod_interno/*` (matriz 32 módulos, panel, billing, CRM, Cobros, agente, etc.).
  - Firebase Auth prod: claims `beta@gema-digital.com` → `tenant_gema_prod_interno` / rol `owner` (`--single-tenant`).
- **Impacto web GEMA:** ninguno directo (incidente aislado a hosting Cumbre prod).
- **Impacto asistente IA:** ninguno; no cambia copy comercial ni conocimiento WP.
- **Despliegue:** no requirió `deploy:prod:hosting` (fix backend/datos, no UI).
- **Validaciones:**
  - Firestore Admin: `suscripcion_modulos/config` OK (32 módulos), `panel_control/configuracion` OK (32), `crm_configuracion/general` OK, `config_integraciones/cumbre_cobros` OK.
  - E2E Playwright prod: **32/32 PASS** (`CUMBRE_BETA_E2E_URL=https://cumbre-erp-prod.web.app npm run beta:e2e:dogfood-panels`).
  - Reporte: `~/.cumbre-mirror/docs/BETA_DOGFOOD_PANELS_E2E.latest.json`.
- **Pasos para Norberto post-fix:** cerrar sesión → Cmd+Shift+R → login `beta@gema-digital.com` → verificar tenant `tenant_gema_prod_interno` y sidebar con 32 módulos.
- **Runbook repro:** `cd ~/.cumbre-mirror && npm run prod:bootstrap:dogfood && npm run prod:apply-claims && npm run prod:repair-panel && npm run prod:e2e:dogfood-panels`.
- **Pendientes:** ninguno para este incidente.

### 2026-06-15 — Fase C integración Web GEMA ↔ ERP Cumbre (plan + quick wins local)

**Objetivo:** Vincular sitio WordPress con app Cumbre prod: CTAs ERP, chatbot Cumbre bridge, carrito institucional MVP y orquestador de notificaciones email/WhatsApp stub.

**Archivos afectados:**
- `docs/INTEGRACION_WEB_CUMBRE_FASE_C_2026-06-15.md` — arquitectura, inventario, fases, checklist Norberto
- `wordpress/theme-gema-sovereign/functions.php` — `gema_sovereign_get_cumbre_urls()`, agent REST config, `/login`, `/erp/precios`
- `wordpress/theme-gema-sovereign/parts/header.html`, `footer.html`, `templates/page-erp-cumbre.html` — CTAs **Acceder a ERP** → https://cumbre-erp-prod.web.app
- `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`, `gema-agent-engine.js` — widget v8 vía `/wp-json/gema/v1/agent/chat`
- `wordpress/plugins/gema-agent-api/**` — bridge Cumbre `agentChat`, leads, WhatsApp handoff
- `wordpress/plugins/gema-payments-platform/gema-payments-platform.php` — REST carrito institucional (`/cart`, `/cart/items`, `/cart/checkout`)
- `wordpress/plugins/gema-notifications-orchestrator/**` — eventos factura/cobro/recibo → `wp_mail` + cola Hermes stub
- `scripts/sync-wordpress-local.sh`, `scripts/smoke-integracion-web-cumbre.sh`
- `.env.example` — placeholders `GEMA_CUMBRE_*` / notificaciones

**Impacto web:** CTAs prod listos en código local; carrito comercial-contact; login explica Firebase Auth. **Sin deploy prod aún.**

**Impacto asistente IA:** Widget apunta a plugin REST (Cumbre proxy cuando `wp-config` tenga API key). Conocimiento agente debe citar URL prod para clientes; beta solo dogfood.

**Despliegue:** Solo local/documental. Restaurado `wordpress/` desde git HEAD + plugins nuevos.

**Validaciones:**
- `scripts/smoke-integracion-web-cumbre.sh` → 7/7 checks estáticos PASS; REST local FAIL hasta `sync-wordpress-local.sh` + activar plugins

**Pendientes Norberto (Fase C prod):**
- `wp-config.php`: `GEMA_CUMBRE_TENANT_ID`, `GEMA_CUMBRE_API_KEY`, URLs Cloud Functions prod
- rsync theme + plugins prod; activar `gema-agent-api`, `gema-notifications-orchestrator`
- Regenerar página `/login` vía WP-CLI
- SMTP host para `wp_mail`; ticket org policy prod; validar lead CRM desde widget

---

### 2026-06-15 — PROYECTO TERMINADO: validación final prod + docs cierre

**Objetivo:** Cerrar deploy prod Fase A+B iniciado por agente 7ce80140; validar prod live; documentar checklist Norberto y declaración PROYECTO TERMINADO.

**Autorización:** Norberto — "te autorizo terminalo".

**Validaciones ejecutadas:**
- `curl https://cumbre-erp-prod.web.app` → HTTP 200
- `curl https://cumbre-erp-beta.web.app` → HTTP 200
- `npm run prod:health` → TODO OK
- `CUMBRE_BETA_E2E_URL=https://cumbre-erp-prod.web.app npm run beta:e2e:dogfood-panels` → **32/32 PASS**
- Bootstrap dry-run tenant prod → 32 módulos OK

**Archivos actualizados:**
- `docs/PLAN_BETA_A_PRODUCCION_2026-06-15.md` §10 PROYECTO TERMINADO
- `docs/NORBERTO_PASOS_PARALELOS_2026-06-15.md` — paso 0 prod + DevCenter URLs prod + org policy dual
- `docs/ENTREGA_FINAL_PROYECTO_2026-06-15.md` (repo Cumbre ERP) — E2E prod + declaración final

**Impacto web:** Prod https://cumbre-erp-prod.web.app operativo; **sin CTA WordPress** (Fase C comercial pendiente).

**Impacto asistente IA:** Pendiente actualizar conocimiento URL prod vs beta interna.

**Despliegue:** Sin redeploy adicional — infra prod ya live desde sesión anterior.

**Pendientes Norberto (~20 min):** login prod, Auth authorized domains, ticket org policy beta+prod, DevCenter MP/ML URLs prod.

---

### 2026-06-15 — Soft launch producción ERP Cumbre (Fase A + B ejecutadas)

**Objetivo:** Desplegar infraestructura prod en `cumbre-erp-prod` y tenant piloto interno GEMA, manteniendo beta operativa en paralelo.

**Autorización:** Norberto — explícita ("te autorizo a hacerlo").

**Archivos / sistemas afectados:**
- Repo Cumbre ERP: `firebase.json` (multi-site beta+prod), `package.json` (scripts `deploy:prod:*`, `prod:health`), scripts prod, `functions/src/index.ts` (SA dinámico por proyecto)
- Firebase `cumbre-erp-prod`: Firestore rules, Hosting, Cloud Functions (18/20), Secret Manager
- Tenant Firestore: `tenant_gema_prod_interno` (32 módulos, claims owner `beta@gema-digital.com`)
- `docs/PLAN_BETA_A_PRODUCCION_2026-06-15.md` §9 ejecución

**Impacto web:** URL prod live https://cumbre-erp-prod.web.app — **no publicar en marketing aún** (sin CTA WordPress). Beta https://cumbre-erp-beta.web.app intacta.

**Impacto asistente IA:** Pendiente actualizar conocimiento URL prod vs beta interna cuando Norberto confirme soft launch estable.

**Despliegue:** Ejecutado desde `~/.cumbre-mirror` — hosting HTTP 200, functions críticas desplegadas, bootstrap tenant OK.

**Validaciones:**
- `curl https://cumbre-erp-prod.web.app` → 200
- `npm run deploy:prod:firestore-rules` OK
- `npm run deploy:prod:hosting` OK
- `npm run deploy:prod:functions` — 18/20 OK; `cumbreMercadoLibreWebhook` + `cumbreWhatsappWebhook` sin invoker `allUsers` (org policy)
- Bootstrap + claims + repair panel tenant prod OK

**Pendientes Norberto:**
- Ticket org policy GCP `allUsers` en `cumbre-erp-prod`
- Re-registrar URLs OAuth/webhooks ML/MP en DevCenter (prod)
- Firebase Auth → authorized domains prod
- Login manual prod y smoke paneles

---

### 2026-06-15 — Plan evaluación beta → producción ERP Cumbre

**Objetivo:** Responder factibilidad de promover ERP Cumbre de beta a producción; documentar fases, checklists y comandos sin ejecutar deploy prod.

**Archivos / sistemas afectados:**
- `docs/PLAN_BETA_A_PRODUCCION_2026-06-15.md` (nuevo)
- Referencia cruzada repos Cumbre ERP: `CIERRE_PROYECTO_FINAL.md`, `ENTREGA_FINAL_PROYECTO_2026-06-15.md`, `HOJA_DE_RUTA_ACCIONES_USUARIO.md`, `fase6/HOSTING_BETA_PLAN.md`

**Impacto web:** Ninguno desplegado. Plan recomienda no publicar URL beta en marketing; CTA prod ERP pendiente hasta URL prod estable.

**Impacto asistente IA:** Pendiente alinear conocimiento URL prod vs beta interna cuando exista cutover (registrado en plan §4.3).

**Despliegue:** Solo local/documental. **No** se ejecutó deploy a `cumbre-erp-prod`.

**Validaciones:** Revisión docs deploy, `package.json` scripts, `.firebaserc`, `firebase.json`, estado prod Hito 207 vs beta cierre 2026-06-15.

**Veredicto documentado:** **Parcial** — no recomendado cutover comercial ahora; continuar beta dogfood + Fase 7 hasta 2026-07-14; prep prod Fase A–B en paralelo post-autorización.

**Pendientes:** Decisión Norberto soft launch vs GA; ticket org policy prod; crear scripts `deploy:prod:*`; acta go/no-go prod post-Fase 7.

---

### 2026-06-15 — E2E beta dogfood 32/32 paneles (retoma agente)

**Objetivo:** Completar gate E2E Playwright 32/32 módulos panel en beta real (`tenant_prueba_interna`).

**Archivos / sistemas afectados:**
- Cumbre ERP (source + mirror): `scripts/run-beta-dogfood-panels-e2e.ts`, `shared/platformFullModuleIds.ts`, `shared/appNavigation.ts`, `src/components/AppSidebar.tsx`
- Deploy hosting beta `cumbre-erp-beta`
- Docs: `docs/BETA_DOGFOOD_PANELS_E2E.latest.json`, `docs/ENTREGA_FINAL_PROYECTO_2026-06-15.md`, `docs/AUDITORIA_TOTAL_2026-06-15.md`, `docs/MATRIZ_MODULOS_CIERRE_2026-06-15.md`

**Impacto web:** ninguno directo (ERP beta dogfood, no WordPress).

**Impacto asistente IA:** ninguno directo; panel 100% funcional refuerza demos comerciales desde beta.

**Despliegue:** `npm run deploy:beta:hosting` → https://cumbre-erp-beta.web.app (2026-06-15 sesión retoma).

**Validaciones:**
- `npm run beta:bootstrap:dogfood` → ok (32 módulos)
- `npm run beta:apply-claims` (rol **owner**) + `beta:repair-panel` → ok
- `npm run beta:e2e:dogfood-panels` → **32/32 PASS** (32 vistas únicas)
- `npm run beta:health` → TODO OK
- `npm run beta:test:dogfood-smoke` → ok (32 módulos matriz)

**Fixes aplicados:**
- Script E2E extendido de 13 vistas mínimas a `listPlatformFullModuleIds()` (32)
- Mapeos `MODULE_ID_TO_VIEW` para core, importador, backend_workers, seguridad_auditoria
- Link sidebar `operations` en sección Plataforma

**Pendientes / gaps únicos para 100% APIs reales:** org policy GCP `allUsers`, ML KYC DevCenter, MP OAuth seller humano, Meta App Review.

### 2026-06-15 — Auditoría total ERP Cumbre + GEMA

**Objetivo:** Auditoría integral solicitada por Norberto — health, tests, Firestore dogfood, seguridad, docs, integraciones.

**Repo Cumbre:** `01-Proyecto Cumbre Erp` (ejecución `~/.cumbre-mirror`).

**Resultado global:** 🟢 CERRADO FUNCIONAL DOGFOOD verificado. Sin P0 bugs. Conectores reales gated (org policy, ML KYC, MP OAuth humano).

**Tests ejecutados (resumen):** `beta:health` TODO OK · signin/dogfood-smoke OK · Hermes direct OK · preflight A–I 9/9 · arquitectura 30/30 · security rules OK · bootstrap dogfood dry-run OK · E2E Playwright 13/13 · readiness subset 7/7 · ML webhook local 9/9 · integraciones GEMA OK.

**Hallazgos P1:** org policy `allUsers` (admin) · ML aprobación pendiente · MP OAuth seller humano · webhooks anon 403.

**Entregable:** `docs/AUDITORIA_TOTAL_2026-06-15.md` (este repo).

**Impacto web WordPress:** ninguno.
**Impacto asistente IA:** ninguno.
**Despliegue:** ninguno (auditoría read-only + tests).
**Pendientes:** mismos externos post-cierre (tabla en auditoría).

---

### 2026-06-15 — Guía acciones humanas Norberto (paralelo agentes)

**Objetivo:** Documento único en español simple con pasos P0/P1/P2 que Norberto debe hacer en paralelo mientras agentes cierran el proyecto.

**Archivos afectados:**
- `01-Proyecto Cumbre Erp/docs/NORBERTO_PASOS_PARALELOS_2026-06-15.md` (nuevo).

**Impacto web WordPress:** ninguno.
**Impacto asistente IA:** ninguno.
**Despliegue:** solo documentación local; sin commit.

**Contenido:** P0 (~15 min) refresh sesión beta + MP OAuth + ticket org policy; P1 post-aprobación ML; P2 Meta WhatsApp y PayPal opcional. Checkboxes, comandos, éxito/fallo, links. Sin credenciales.

**Validaciones:** documento creado; referencias cruzadas a `CIERRE_PROYECTO_FINAL.md`, `ENTREGA_FINAL`, `ACCESO_BETA_SIMPLE.md`.

---

### 2026-06-15 — CIERRE FUNCIONAL dogfood ERP Cumbre (bootstrap + E2E 13/13)

**Objetivo:** Cierre final real autorizado por Norberto — panel beta operativo sin crashes en módulos P0/P1.

**Repo:** `01-Proyecto Cumbre Erp` + mirror `~/.cumbre-mirror`.

**Causa raíz P0:** configs Firestore faltantes en `tenant_prueba_interna` (CRM `catalogo_ref`, Cobros `limite_medios_activos`, Core panel vacío).

**Acciones ejecutadas:**
- `beta:bootstrap:dogfood` → `ok:true` (32 módulos matriz + configs P0/P1)
- `beta:apply-claims` owner + `beta:repair-panel` (32 módulos sidebar)
- UI defensiva: `shared/cobros.ts`, `cobrosReadiness.ts`, `corePlataformaReadiness.ts`, `CumbreCobrosPanel.tsx`, `cobrosTools.ts`
- Script `npm run beta:e2e:dogfood-panels` (Playwright hosting) → **13/13 PASS**
- `deploy:beta:hosting` 2026-06-15

**Impacto web WordPress:** ninguno directo.
**Impacto asistente IA:** ninguno (dogfood ERP independiente del widget WP).
**Despliegue:** Firestore beta + hosting `cumbre-erp-beta.web.app` OK.
**Validaciones:** `beta:health` TODO OK · dogfood-smoke OK · integracion-local-preflight 9/9 · ML webhook 9/9 · Hermes direct OK · E2E 13/13.

**Pendientes SOLO externos (no bloquean dogfood):** ML KYC/aprobación app · org policy `allUsers` webhooks · MP OAuth seller (login humano) · Meta App Review WhatsApp Cloud.

**Norberto — refresh sesión (único comando):**
```bash
cd ~/.cumbre-mirror && npm run beta:apply-claims -- --email beta@gema-digital.com --tenant-id tenant_prueba_interna --role owner
```
Logout → Cmd+Shift+R → login beta.

**Docs:** `docs/ENTREGA_FINAL_PROYECTO_2026-06-15.md`, `docs/CIERRE_PROYECTO_FINAL.md`.

---

### 2026-06-15 — P0 ERP Cumbre beta: crash módulos dogfood (repo Cumbre Erp)

**Objetivo:** Norberto no podía usar Core/CRM/Cobros en https://cumbre-erp-beta.web.app por configs Firestore faltantes en `tenant_prueba_interna`.

**Repo:** `01-Proyecto Cumbre Erp` (no este repo WordPress).

**Cambios:**
- Script `npm run beta:bootstrap:dogfood` — merge matriz + configs CRM/Cobros/Core en Firestore beta.
- UI defensiva en paneles Core/CRM/Cobros (optional chaining).
- Bootstrap ejecutado en `cumbre-erp-beta`; hosting beta desplegado.

**Impacto web WordPress:** ninguno directo.
**Impacto asistente IA:** ninguno (pendiente si se documenta en conocimiento local).
**Despliegue:** Firestore beta + hosting `cumbre-erp-beta.web.app` OK.
**Validaciones:** `beta:bootstrap:dogfood --dry-run`, bootstrap remoto, `deploy:beta:hosting`.
**Norberto:** logout → Cmd+Shift+R → login → ver §4b en `01-Proyecto Cumbre Erp/docs/fase7/ACCESO_BETA_SIMPLE.md`.

---


### 2026-06-15 - Cierre técnico formal proyecto ERP Cumbre + GEMA IA

Objetivo:
- Ejecutar validaciones finales, documentar entrega formal y declarar **CERRADO TÉCNICO** con pendientes externos tabulados.

Archivos / sistemas afectados:
- Proyecto Cumbre ERP: `docs/ENTREGA_FINAL_PROYECTO_2026-06-15.md` (nuevo), `docs/CIERRE_PROYECTO_FINAL.md` (actualizado).
- Este registro: `REGISTRO_DE_TRABAJO_GEMA.md`.
- Beta: https://cumbre-erp-beta.web.app — validaciones vía `~/.cumbre-mirror`.

Impacto en web:
- Ninguno WordPress. Sin deploy (solo documentación).

Impacto en asistente IA:
- Sin cambio de código. Estado operativo documentado: dogfood ~97%, conectores comerciales gated.

Despliegue:
- **No desplegado** — sin cambios de código pendientes en esta sesión.

Validaciones (`~/.cumbre-mirror`, 2026-06-15 sesión cierre formal):
- `npm run beta:health` → TODO OK
- `npm run beta:hermes:direct-local` → OK
- `npm run test:mercado-libre-webhook-local` → 9/9 OK
- `npm run test:integracion-local-preflight` → 9/9 OK

Pendientes externos (post-cierre, no bloquean dogfood):
- **ML:** aprobación app/KYC (Mercado Libre, 3–15 días hábiles).
- **ORG:** excepción `allUsers` Cloud Run Gen2 (admin org GEMA, 1–3 días).
- **MP:** OAuth seller panel Cobros — login auth.mercadopago.com (Norberto, ~10 min).
- **Meta:** App Review WhatsApp Cloud API (deferido, semanas).
- **Opcionales:** ARCA mock panel, UI §B Cobros, Fase 7 revisiones hasta 2026-07-14.

Browser MCP panel MP OAuth: no disponible sesión — pasos exactos en `docs/ENTREGA_FINAL_PROYECTO_2026-06-15.md`.

### 2026-06-15 - Mercado Libre DevCenter: URLs y OAuth validados (Capa A Norberto)

Objetivo:
- Cerrar el trámite externo Capa A en DevCenter ML tras verificación humana de redirect, notifications y grants OAuth (sin activar gate productivo).

Archivos / sistemas afectados:
- DevCenter ML: app `Gema Digital` (App ID 2046078242418312).
- Documentación: `REGISTRO_DE_TRABAJO_GEMA.md` (este registro); proyecto Cumbre ERP `docs/CIERRE_PROYECTO_FINAL.md`.

Impacto en web:
- Ninguno WordPress. Redirect OAuth beta: `https://cumbre-erp-beta.web.app/oauth/mercado-libre/callback`.

Impacto en asistente IA:
- Sin cambio de código. Gate `gate_integraciones_mercado_libre_real_bloqueado` sigue hasta aprobación ML + `prueba_conexion` sandbox.

Despliegue:
- Solo validación en consola DevCenter. Sin commit. Sin registrar credenciales.

Validaciones (Norberto, DevCenter ML):
- Redirect URI beta: validado.
- Notifications URL webhook beta: validado (`cumbreMercadoLibreWebhook`).
- OAuth habilitado: Authorization Code, Client Credentials, Refresh Token + PKCE.

Pendientes:
- **ML (async):** aprobación app / KYC por Mercado Libre.
- **ORG (async):** excepción org policy `allUsers` en webhook para notifications reales desde servidores ML (GET/POST anónimo hoy 403; dogfood con token IAM OK).
- **Post-aprobación ML:** panel beta → Mercado Libre → OAuth seller → `prueba_conexion` sandbox → aprobar gate `gate_integraciones_mercado_libre_real_bloqueado` (decisión humana).
- **MP (opcional):** app OAuth Mercado Pago (~10 min); no bloquea Capa A ML ni dogfood.

### 2026-06-15 - Mercado Pago OAuth: credenciales locales y Secret Manager beta

Objetivo:
- Guardar credenciales app Mercado Pago OAuth (tramite Ola 4) en repo Cumbre ERP sin commitear; subir client_id/client_secret a GCP beta.

Archivos / sistemas afectados:
- Proyecto Cumbre ERP (fuera de este repo): `.credentials/mercado-pago-oauth.local`, `.credentials/mercado-pago.local` (chmod 600, gitignored).
- GCP `cumbre-erp-beta`: Secret Manager `MERCADOPAGO_OAUTH_CLIENT_ID`, `MERCADOPAGO_OAUTH_CLIENT_SECRET`, placeholder `tenant_prueba_interna__mercado_pago_oauth__access_token_sandbox`.
- Documentación: `REGISTRO_DE_TRABAJO_GEMA.md` (este registro).

Impacto en web:
- Ninguno WordPress. Redirect OAuth beta: `https://cumbre-erp-beta.web.app/oauth/mercado-pago/callback`.

Impacto en asistente IA:
- Sin cambio de código. Tramite MP OAuth listo para conexion seller desde panel beta Cobros.

Despliegue:
- Solo local + `npm run beta:setup:integraciones-secrets` (OK en proyecto Cumbre ERP). Sin deploy functions en esta tarea.

Validaciones:
- `.gitignore` incluye `.credentials/`.
- Script beta creó/actualizó secrets MP OAuth en Secret Manager.

Pendientes:
- Panel beta **Cobros → Conectar Mercado Pago** (OAuth seller; token tenant reemplaza placeholder SM).
- Configurar redirect URI en developers.mercadopago.com si no coincide con beta.
- Webhook MP post-deploy functions; aprobar gate `gate_cobros_mercado_pago_real_bloqueado` con evidencia sandbox.
- Rotar client secret en MP si se compartió por canal inseguro (chat).

### 2026-06-15 - Reporte cierre dogfood Norberto: panel Hermes OK · ML en aprobación

Objetivo:
- Registrar validación humana en panel beta (`Enviar prueba Hermes`) y estado del trámite Mercado Libre DevCenter (KYC / revisión de app).

Archivos / sistemas afectados:
- Documentación: `REGISTRO_DE_TRABAJO_GEMA.md` (este registro).
- Proyecto Cumbre ERP: `docs/CIERRE_PROYECTO_FINAL.md`, `docs/MATRIZ_MODULOS_CIERRE_2026-06-15.md`.
- Beta: https://cumbre-erp-beta.web.app — WhatsApp Hub (path panel con sesión Firebase).

Impacto en web:
- Ninguno WordPress. Dogfood Generadores Sur (`tenant_prueba_interna`) con WhatsApp Hermes interim cerrado en panel.

Impacto en asistente IA:
- Sin cambio de código. Conocimiento operativo: WhatsApp dogfood **cerrado**; Mercado Libre **esperando aprobación** ML (no bloquea operación interna).

Despliegue:
- Sin deploy. Solo actualización documental de cierre.

Validaciones (reporte Norberto 2026-06-15):
- Panel beta → WhatsApp Hub → **Enviar prueba Hermes**: **FUNCIONÓ** (mensaje vía path panel; CLI sigue 401/403 por org policy — esperado).
- Mercado Libre DevCenter: app GEMA + creds locales OK; **esperando aprobación** (KYC / revisión app ML).

Pendientes:
- **ML (async):** cuando ML apruebe app/KYC → OAuth seller desde panel beta, `prueba_conexion`, aprobar gate `gate_integraciones_mercado_libre_real_bloqueado` con evidencia sandbox; notification URL ya registrada (webhook live; invoker público pendiente org policy).
- **MP (~10 min):** si aún no conectó — app OAuth developers.mercadopago.com → `.credentials/mercado-pago-oauth.local` → panel Cobros.
- **ORG (async):** excepción `allUsers` Cloud Run Gen2 (copy-paste en `CIERRE_PROYECTO_FINAL.md`).
- Opcionales: ARCA mock panel, UI manual §B, Meta WhatsApp Cloud API **DEFERIDO**.

### 2026-06-15 - Cierre total 30 módulos ERP Cumbre: validación batch + matriz

Objetivo:
- Maximizar cierre de todos los módulos Cumbre ERP (autorización Norberto): inventario, validaciones batch, gaps, documentación final.

Archivos / sistemas afectados:
- Proyecto Cumbre ERP: `scripts/test-domain-contracts.ts` (catálogo conectores 18 gates).
- Documentación: `docs/MATRIZ_MODULOS_CIERRE_2026-06-15.md`, `docs/CIERRE_PROYECTO_FINAL.md`, `docs/REGISTRO_AVANCE_PROYECTO.md`.

Impacto en web:
- Ninguno WordPress directo. Estado dogfood beta documentado para asistente IA y operación Generadores Sur.

Impacto en asistente IA:
- Sin cambio de código. Conocimiento operativo: 26/30 módulos HECHO, 4 PARCIAL (cobros MP, ML webhook, WhatsApp panel, ARCA real).

Despliegue:
- Sin deploy adicional en esta sesión. Beta ya live.

Validaciones:
- `beta:health` TODO OK · `validate:cimientos:local` OK (`listo_cimientos_local`) · `audit:arquitectura:modulos` 30/30 8/8 · preflight 9/9 · retail readiness 11/11 · Hermes direct OK · org policy IAM reintento único bloqueado.

Pendientes:
- **HUMANO 2 min:** panel WhatsApp Enviar prueba Hermes.
- **HUMANO 10 min:** app Mercado Pago OAuth.
- **ORG 15 min:** excepción `allUsers` Cloud Run.
- Meta WhatsApp Cloud API: DEFERIDO.

### 2026-06-15 - Cierre final dogfood ERP Cumbre: ML webhook deploy + validaciones

Objetivo:
- Completar deploy `cumbreMercadoLibreWebhook` (SA firebase-adminsdk), validar POST IAM 200, health checks y documentación cierre final.

Archivos / sistemas afectados:
- Proyecto Cumbre ERP: `functions/src/index.ts` (ack graceful ML webhook, `initializeApp()` estándar).
- Cloud Function beta: `cumbreMercadoLibreWebhook` (mirror deploy 2026-06-15).
- Documentación: `docs/CIERRE_PROYECTO_FINAL.md`, `docs/REGISTRO_AVANCE_PROYECTO.md` (repo Cumbre ERP).

Impacto en web:
- Ninguno WordPress. Webhook ML beta operativo con ack 200 (persistencia Firestore bloqueada Admin SDK Cloud Run).

Impacto en asistente IA:
- Sin cambio. Callables/agentes requieren sesión Firebase; org policy bloquea HTTP público CLI.

Despliegue:
- **Live** en `cumbre-erp-beta` vía mirror. Sin commit git.

Validaciones:
- `beta:health` TODO OK · `test:mercado-libre-webhook-local` 9/9 · `beta:hermes:direct-local` OK · curl ML POST IAM 200 · `beta:fix:functions-invoker` bloqueado org.

Pendientes:
- **ORG (async):** excepción `allUsers` invoker — copy-paste en CIERRE.
- **HUMANO 2 min:** panel WhatsApp → Enviar prueba Hermes (browser MCP no disponible en sesión).
- **HUMANO 10 min:** app Mercado Pago OAuth (placeholder en `.credentials/mercado-pago-oauth.local`).
- **IAM root cause:** Admin SDK Firestore PERMISSION_DENIED en Cloud Run (persistencia real pendiente admin GCP).

### 2026-06-15 - Cierre dogfood ERP Cumbre: deploy panel runner + IAM org

Objetivo:
- Maximizar cierre técnico dogfood beta (~95%) con deploy functions pendientes, validaciones npm/curl y documentación de bloqueo org policy.

Archivos / sistemas afectados:
- Cloud Functions beta: `cumbreWhatsappHubPanelJobRunner` (nuevo), `cumbreWhatsappHubDispatchGateway`, `whatsappHubHermesDispatchCallable` (update).
- Hosting beta: `cumbre-erp-beta.web.app` (release 2026-06-15).
- Documentación Cumbre ERP: `docs/CIERRE_PROYECTO_FINAL.md`, `docs/REGISTRO_AVANCE_PROYECTO.md`.

Impacto en web:
- Ninguno WordPress. Beta ERP hosting actualizado.

Impacto en asistente IA:
- Sin cambio. Agentes/callables requieren sesión Firebase; org policy bloquea HTTP público (403 esperado en tests CLI).

Despliegue:
- **Live** en `cumbre-erp-beta` vía mirror (`~/.cumbre-mirror`). Sin commit git.

Validaciones:
- `beta:health` TODO OK · `beta:hermes:direct-local` OK · `test:mercado-libre-webhook-local` 9/9 · curl ML GET IAM 200 / anon 403.

Pendientes:
- **BLOQUEADO ORG:** excepción `allUsers` invoker (copy-paste en CIERRE para admin org).
- **HUMANO 2 min:** panel WhatsApp → Enviar prueba Hermes.
- **HUMANO 10 min:** crear app Mercado Pago OAuth (placeholder en creds).
- **Meta WhatsApp:** pausado (restricción Business).
- ~~Fix menor: ML webhook POST~~ → **HECHO** ack 200 (`persisted:false` hasta fix IAM Admin SDK Cloud Run).

### 2026-06-15 - Webhook Mercado Libre beta (`cumbreMercadoLibreWebhook`)

Objetivo:
- Implementar stub productivo del notification URL ya registrado en DevCenter ML, persistir eventos en Firestore dogfood y desplegar en beta si auth Firebase OK.

Archivos / sistemas afectados:
- Proyecto Cumbre ERP: `shared/mercadoLibreWebhook.ts`, `shared/mercadoLibre.ts` (tipo `MlWebhookEvento`, path `mercado_libre_webhook_events`), `functions/src/mercadoLibreWebhooks.ts`, `functions/src/index.ts`, `firestore.rules`, `scripts/test-mercado-libre-webhook-local.ts`, `scripts/fix-beta-functions-public-invoker.sh`, `shared/integracionesEnlacesExternos.ts`, `docs/tramites/runbooks/RUNBOOK_MERCADO_LIBRE.md`, `docs/CIERRE_PROYECTO_FINAL.md`.
- Cloud Function beta: `cumbreMercadoLibreWebhook` (region `southamerica-east1`, invoker public).
- Tenant dogfood default: `tenant_prueba_interna`.

Impacto en web:
- Ninguno en WordPress. Panel ML beta muestra webhook URL vía `IntegracionEnlacesExternosCard` tras deploy hosting (ya centralizado).

Impacto en asistente IA:
- Ninguno directo. Gate `gate_integraciones_mercado_libre_real_bloqueado` sigue bloqueando API seller real.

Despliegue:
- Firestore rules beta **desplegadas** (`mercado_libre_webhook_events` live).
- Cloud Function `cumbreMercadoLibreWebhook` **live** en `cumbre-erp-beta` — URL `https://southamerica-east1-cumbre-erp-beta.cloudfunctions.net/cumbreMercadoLibreWebhook` (deploy Norberto 2026-06-15; secrets Meta placeholder OK).
- IAM invoker público (`allUsers` / `roles/run.invoker`) **bloqueado por org policy GEMA** — mismo patrón que `gemaPagosWebhook` y agentes HTTP; `npm run beta:fix:functions-invoker` ya incluye `cumbreMercadoLibreWebhook` pero falla con *permitted customer*.

Validaciones:
- `npm run test:mercado-libre-webhook-local` — 9/9 OK.
- `npm run typecheck` + `functions:typecheck` en repo Cumbre ERP.
- `npm run beta:fix:functions-invoker` (mirror) — ejecutado; binding `allUsers` rechazado por org policy en todas las functions listadas.
- `curl` GET anónimo al webhook → **403 Forbidden** (Cloud Run IAM antes del handler).
- `curl` GET con `Authorization: Bearer $(gcloud auth print-identity-token)` → **200** JSON `{"ok":true,"service":"cumbreMercadoLibreWebhook","tenant_default":"tenant_prueba_interna","stub_unsigned":true}` — confirma function desplegada y handler OK.

Pendientes Norberto:
- **Org / GCP:** excepción de org policy para permitir `allUsers` invoker en webhooks externos (ML notification URL requiere HTTP público desde servidores ML). Hasta entonces DevCenter ML no recibirá 200 en health check anónimo.
- Firebase Console → env `CUMBRE_MERCADO_LIBRE_WEBHOOK_STUB_ACCEPT_UNSIGNED=true` en la function (dogfood).
- Post-gate: `CUMBRE_MERCADO_LIBRE_CLIENT_SECRET` en env/SM y desactivar stub unsigned.
- OAuth seller desde panel cuando gate aprobado.

---

### 2026-06-15 - Trámite Mercado Libre (Capa A) — app GEMA creada y credenciales locales

Objetivo:
- Cerrar el paso externo de Norberto en developers.mercadolibre.com.ar: app seller GEMA, redirect URI beta, notification callback y guardado local de OAuth (sin activar gate productivo).

Archivos / sistemas afectados:
- Proyecto Cumbre ERP: `.credentials/mercado-libre-oauth.local` (gitignored, permisos 600).
- DevCenter ML: app `Gema Digital` — App ID registrado; redirect `https://cumbre-erp-beta.web.app/oauth/mercado-libre/callback`; notification URL `https://southamerica-east1-cumbre-erp-beta.cloudfunctions.net/cumbreMercadoLibreWebhook`.
- Runbook existente: `docs/tramites/runbooks/RUNBOOK_MERCADO_LIBRE.md` (sin cambio de código).

Impacto en web:
- Ninguno desplegado. OAuth y webhook ML aún no operativos en beta.

Impacto en asistente IA:
- Ninguno. Gate `gate_integraciones_mercado_libre_real_bloqueado` sigue bloqueando conexión real.

Despliegue:
- Solo local (credenciales en Mac de Norberto). No commit ni producción.

Validaciones:
- Archivo local creado desde `.example`, chmod 600, no trackeado por git.
- Variables completadas: `MERCADOLIBRE_OAUTH_CLIENT_ID`, `MERCADOLIBRE_OAUTH_CLIENT_SECRET`, redirect MLA y scopes del template.

Pendientes:
- ~~Implementar y desplegar Cloud Function `cumbreMercadoLibreWebhook` en beta.~~ **Live** — ver entrada webhook 2026-06-15; pendiente IAM público (org policy) para callback ML anónimo.
- OAuth seller desde panel cuando gate aprobado con evidencia sandbox.
- KYC/titular ML si la consola lo solicita (1–3 días).

---

### 2026-06-11 - X (@GemaDigitalERP) conectado — créditos API diferidos a producción

Objetivo:
Cerrar OAuth X sin bucles de navegador, dejar batch V02–V40 listo y **no pagar API hasta producción comercial**.

Hecho (hub `15-Produccion-Audiovisual`):
- App **GEMA Upload Bot** (`33067405`), cuenta **@GemaDigitalERP`.
- OAuth 2.0 desde portal (**Claves de OAuth 2.0** → botón **Generar**), sin flujo OAuth en navegador.
- Tokens en `marketing/01-videos/scripts/secrets/.env.social` (local, no commitear).

Validaciones:
- `verificar-x-token.py` → OK `@GemaDigitalERP`
- `subir-x-serie.py --dry-run --video 2` → OK
- Publicación real V02 → **402 CreditsDepleted** (`POST /2/tweets`); media upload **403** (sin créditos).

Impacto web:
Ninguno hasta publicar tweets con links a gema-digital.com.

Impacto asistente IA:
Ninguno; canal X no activo en batch hasta créditos.

Despliegue:
Ninguno (scripts locales en hub audiovisual).

Deferido explícito:
Activar **billing / créditos API** en console.x.com cuando la serie salga a producción comercial.
Referencia: `marketing/03-produccion/00-X-DEFERIDO-CREDITOS-PRODUCCION.md`
Comando batch: `subir-x-serie.py --video 2-40 --skip-existing --delay 90`

Riesgo:
Tokens expuestos en chat → rotar Client Secret y **Generar** de nuevo antes de prod.

### 2026-06-11 - Meta OAuth script serie GEMA (IG/FB Reels)

Objetivo:
Evitar errores al pegar tokens manualmente (190, tokens duplicados) con flujo OAuth local como LinkedIn/Pinterest.

Hecho (hub audiovisual):
- `autorizar-meta-token.py` — OAuth Facebook Login, long-lived token, verify + persist merge en `.env.social`.
- `verificar-meta-token.py` — prompt interactivo si falta token; `merge_env_file` no borra credenciales X/Pinterest.
- Guia `marketing/03-produccion/00-META-OAUTH-TOKEN.md`.

Impacto web:
Ninguno.

Impacto asistente IA:
Ninguno.

Despliegue:
Local. Pendiente Norberto: META_APP_ID/SECRET en `.env.social` + ejecutar autorizar-meta-token.py.

---

### 2026-06-11 - Plan accion redes sociales Cumbre multi-tenant (Capa A + B)

Objetivo:
Documentar tramites developer y desarrollo por red para que tenants Cumbre publiquen en sus cuentas (Metricool interno), separado de apps GEMA institucional.

Hecho:
- Runbook `01-Proyecto Cumbre Erp/docs/tramites/runbooks/RUNBOOK_REDES_SOCIALES_CUMBRE.md` — Meta, LinkedIn, YouTube, TikTok, Pinterest, X, GBP.
- Paso a paso operativo Norberto + dev: `01-Proyecto Cumbre Erp/docs/tramites/00-PASO-A-PASO-REDES-CUMBRE.md` (7 redes + checklist semanal + bloque implementación Capa B).
- Enlace desde hub `00-CONECTAR-REDES-CUMBRE.md`, checklist tramites externos Cumbre (`ENLACES_TRAMITES_EXTERNOS_CHECKLIST.md`).

Impacto web:
Ninguno directo; verificaciones dominio reutilizables.

Impacto asistente IA:
Pendiente tutoriales `api_tutorial_*` por red cuando existan gates marketing.

Despliegue:
Pendiente — OAuth callbacks beta + Secret Manager + worker marketing real.

Pendiente:
Implementacion Fase 1 Cumbre (OAuth tenant, worker, gates); apps Capa A por red en portales developer.

### 2026-06-08 - Preparación de herramientas Google SEO, SEM y GEO

Objetivo:
Dejar el sitio GEMA Digital preparado para conectar Google Search Console, Google Analytics 4, Google Tag Manager, Google Ads, PageSpeed/Core Web Vitals, Google Business Profile y Looker Studio sin insertar IDs falsos ni romper privacidad, performance o SEO.

Cambios aplicados:

- Se auditó el theme y no se encontraron tags activos de GA4, GTM, Google Ads ni meta de Search Console.
- Se agregó una capa técnica en `functions.php` para imprimir herramientas Google solo cuando existan IDs reales.
- Se soportan constantes y opciones WordPress:
  - `GEMA_GOOGLE_SITE_VERIFICATION` / `gema_google_site_verification`
  - `GEMA_GOOGLE_TAG_MANAGER_ID` / `gema_google_tag_manager_id`
  - `GEMA_GOOGLE_ANALYTICS_ID` / `gema_google_analytics_id`
  - `GEMA_GOOGLE_ADS_ID` / `gema_google_ads_id`
- Se prioriza GTM si existe `GEMA_GOOGLE_TAG_MANAGER_ID`, evitando cargar GA4/Ads directos desde el theme para no duplicar medición.
- Si no hay GTM, el theme puede cargar GA4 y/o Google Ads con `gtag`.
- Si no hay IDs reales, no se imprime ningún script externo.
- Se agregó soporte `noscript` para Google Tag Manager mediante `wp_body_open`.
- Se creó `docs/GOOGLE_SEO_SEM_GEO_STACK.md` con orden recomendado, herramientas, URLs de PageSpeed, sitemap, activación por WP-CLI/constantes y pendientes.

Search Console:

- Se intentó abrir Google Search Console para verificar `gema-digital.com`.
- La pestaña de Cursor seguía autenticada como `info@generatuenergia.net`, incluso intentando `authuser=info@gema-digital.com`.
- No se registró la propiedad para evitar asociar el dominio a una cuenta incorrecta.
- Pendiente: seleccionar `info@gema-digital.com` dentro del navegador controlado por Cursor, crear/verificar propiedad y enviar `https://gema-digital.com/sitemap_index.xml`.
- Nuevo intento con URL directa provista: `https://search.google.com/search-console?resource_id=sc-domain%3Agema-digital.com&after_verification_success=`.
- Resultado: Search Console redirigió a `not-verified` y mostró “no puedes acceder a esta propiedad” porque la sesión del navegador Cursor continúa en `info@generatuenergia.net`.
- Nuevo intento de Analytics con URL provista: `https://me.developers.google.com/u/102390878673482727126`.
- Resultado: el enlace abre Google Developer Program, no Google Analytics, y la cuenta activa visible sigue siendo `info@generatuenergia.net`.
- Se abrió Analytics directamente; la única propiedad visible en el selector fue `generatuenergia.net` (`p485982920`), sin propiedad `gema-digital.com`.
- No se activó medición en GEMA para evitar instalar un ID GA4/GTM perteneciente a otro dominio.

Herramientas Google recomendadas:

- Google Search Console para indexación, consultas, CTR, sitemap y Core Web Vitals.
- GA4 para tráfico, eventos, conversiones y audiencias.
- Google Tag Manager para administrar tags sin editar el theme.
- Google Ads para SEM/conversion tracking cuando las landings estén auditadas.
- PageSpeed Insights y Core Web Vitals para performance.
- Google Business Profile para SEO local/GEO.
- Looker Studio para dashboard consolidado.

Google Ads:

- Se abrió el enlace provisto de Google Ads.
- Resultado: Google redirigió al selector de cuenta y solo mostró `info@generatuenergia.net`.
- No se accedió a una cuenta publicitaria de `info@gema-digital.com` ni se crearon campañas, conversiones o etiquetas.
- Pendiente: iniciar sesión o seleccionar `info@gema-digital.com` en el navegador controlado por Cursor antes de configurar Google Ads, conversiones o vinculación con GA4/GTM.

Google Tag Manager:

- Se abrió el enlace provisto de Google Tag Manager.
- Resultado: Tag Manager cargó con una cuenta visible de `Genera Tu energia`.
- Contenedor visible: `www.generatuenergia.net`, tipo Web, ID `GTM-W248VLXV`.
- No se encontró contenedor para `gema-digital.com`.
- No se instaló `GTM-W248VLXV` en GEMA para evitar medir el dominio con un contenedor incorrecto.
- Luego el usuario proveyó el snippet real de Google Tag Manager para GEMA con ID `GTM-PB7TZGWJ`.
- El theme ya está preparado para imprimir ese snippet estándar desde `gema_google_tag_manager_id` o `GEMA_GOOGLE_TAG_MANAGER_ID`, incluyendo `noscript`.
- Se actualizó `docs/GOOGLE_SEO_SEM_GEO_STACK.md` con `GTM-PB7TZGWJ` y el comando de activación.
- Se desplegó el theme a producción y se activó `gema_google_tag_manager_id = GTM-PB7TZGWJ` mediante WP-CLI en el WordPress productivo.
- Validación pública: Home, `/faqs/`, `/erp-cumbre/` y `/cumbre-crm/` cargan `GTM-PB7TZGWJ` en el HTML.

PageSpeed/Core Web Vitals:

- Se abrió PageSpeed Insights usando el enlace de Google provisto y se auditaron URLs críticas en móvil.
- `https://gema-digital.com/`: Rendimiento 90, Accesibilidad 96, Recomendaciones 100, SEO 100.
- `https://gema-digital.com/erp-cumbre/`: Rendimiento 93, Accesibilidad 96, Recomendaciones 100, SEO 100, datos estructurados válidos.
- `https://gema-digital.com/cumbre-crm/`: Rendimiento 92, Accesibilidad 96, Recomendaciones 100, SEO 100, datos estructurados válidos.
- Antes del deploy, `https://gema-digital.com/faqs/` respondía 404 y PageSpeed marcaba SEO 50.
- Se regeneró `/faqs/` en producción con WP-CLI. Página creada/publicada: ID 437, slug `faqs`.
- Validación pública post-deploy: `/faqs/`, `/`, `/erp-cumbre/`, `/cumbre-crm/` y `/sitemap_index.xml` responden 200.
- `page-sitemap.xml` ya incluye `/faqs/`.
- PageSpeed post-deploy para `/faqs/`: Rendimiento 75, Accesibilidad 96, Recomendaciones 100, SEO 100, datos estructurados válidos.
- Oportunidades recurrentes: optimizar `gema-logo-web-mark.png`, optimizar `seo-geo-nodo-conocimiento.webp`, mejorar caché de assets, reducir CSS de bloqueo de renderizado, revisar DOM en FAQs y medir impacto de GTM/terceros.

Validación:

- `php -l wordpress/theme-gema-sovereign/functions.php` sin errores.
- `git diff --check` sin errores.
- Linter IDE sin errores en `functions.php` y documentación nueva.

Producción:

- Backup remoto creado antes del deploy: `/home/gema-digital.com/public_html/wp-content/themes/gema-sovereign-backup-before-google-seo-20260608060038.tar.gz`.
- Theme `gema-sovereign` sincronizado a producción por `rsync`.
- Ownership/permisos corregidos para el usuario del sitio.
- Páginas locales dinámicas regeneradas con WP-CLI.
- Rewrite rules y cache WordPress limpiadas.

Estado:

- Publicado en producción.
- Pendiente: terminar acceso correcto con `info@gema-digital.com` para Search Console, Analytics y Ads; luego enviar sitemap y seguir optimización de rendimiento.

### 2026-06-08 - Optimización y auditoría técnica post-producción

Objetivo:
Optimizar el sitio publicado para que las herramientas reales de Google puedan analizarlo con buen rendimiento, SEO técnico correcto, sitemap sano y GTM activo.

Cambios aplicados:

- Se generó `assets/gema-logo-web-mark-160.webp` para reemplazar el PNG de logo usado en header/footer.
  - Peso original aproximado: 415 KB.
  - Peso nuevo aproximado: 6 KB.
- Se actualizaron `parts/header.html` y `parts/footer.html` para usar el logo WebP liviano con `width`, `height`, `decoding` y carga adecuada.
- Se generó `assets/seo-visuals/seo-geo-nodo-conocimiento-lite.webp` para páginas SEO dinámicas.
  - Peso original aproximado: 24 KB.
  - Peso nuevo aproximado: 13 KB.
- Se actualizaron definiciones dinámicas en `functions.php` para usar la imagen SEO liviana.
- Se agrego `defer` a scripts propios del theme:
  - `theme-toggle.js`.
  - `gema-floating-agent.js`.
- Se integraron los tokens CSS dentro de `style.css` para eliminar requests bloqueantes a:
  - `brand/tokens/colors.css`.
  - `brand/tokens/typography.css`.
- Se agregaron meta titles/descriptions a páginas padre detectadas por auditoría:
  - `/erp/`.
  - `/erp/funciones/`.
  - `/legal/`.

Producción:

- Backup remoto antes del deploy de performance: `/home/gema-digital.com/public_html/wp-content/themes/gema-sovereign-backup-before-performance-20260608062539.tar.gz`.
- Theme sincronizado a producción por `rsync`.
- Ownership/permisos corregidos para `gemad2467`.
- Caché WordPress limpiada.
- Páginas dinámicas SEO regeneradas para aplicar la imagen liviana en `/faqs/`, `/blog/`, `/competencia/`, `/pagos/` y sus hijas relevantes.
- Ajuste de `inc/seo-yoast.php` desplegado para completar metas de páginas padre.

Auditoría y validación:

- `php -l` sin errores en `functions.php` y `inc/seo-yoast.php`.
- `git diff --check` sin errores.
- URLs críticas verificadas con HTTP 200:
  - `/`.
  - `/faqs/`.
  - `/erp-cumbre/`.
  - `/cumbre-crm/`.
- Verificación pública: las páginas críticas cargan `GTM-PB7TZGWJ`, usan `gema-logo-web-mark-160.webp`, no cargan imports de tokens CSS y difieren el script del agente.
- Verificación de páginas dinámicas: `/faqs/`, `/blog/`, `/competencia/` y `/pagos/` usan `seo-geo-nodo-conocimiento-lite.webp`.
- PageSpeed final de `/faqs/` móvil:
  - Rendimiento 98.
  - Accesibilidad 96.
  - Recomendaciones 100.
  - SEO 100.
  - FCP 1.0 s.
  - LCP 2.4 s.
  - TBT 10 ms.
  - CLS 0.
  - Speed Index 1.6 s.
- Auditoría de sitemap:
  - `page-sitemap.xml` contiene 151 URLs.
  - 151/151 respondieron HTTP 200.
  - 0 fallas de title/meta description tras corregir `/erp/`, `/erp/funciones/` y `/legal/`.

Pendientes:

- Ingresar con `info@gema-digital.com` a Search Console para verificar propiedad y enviar `https://gema-digital.com/sitemap_index.xml`.
- Completar GA4/Google Ads con IDs reales y consentimiento de cookies antes de activar campañas.
- Optimización fina futura: cache headers de assets pequeños, JS sin usar de GTM/terceros, animación no compuesta y revisión visual de contraste.

### 2026-06-08 - Reorganización SEO/UX de navegación, hubs y estructura Cumbre

Objetivo:
Simplificar la arquitectura del sitio GEMA Digital con Cumbre ERP como hub principal, menús madre claros para `Comparativas`, `FAQs` y `Blog`, y una estructura de enlaces cuidada para evitar roturas, duplicación y páginas huérfanas.

Cambios aplicados:

- Se reemplazó la navegación superior plana por un menú principal con `Inicio`, `Cumbre ERP`, `Servicios GEMA`, `Comparativas`, `FAQs`, `Blog`, `Empresa`, `Contacto` y CTA.
- Se implementó un mega menú de `Cumbre ERP` agrupado por intención:
  - Empezar con Cumbre.
  - Operación diaria.
  - Administración y control.
  - Crecimiento e integraciones.
  - Verticales por rubro.
- Se simplificó el footer para evitar una lista plana excesiva de módulos y priorizar hubs, módulos destacados, pagos, legal y recursos.
- Se creó el hub `/faqs/` con preguntas frecuentes sobre ERP Cumbre, módulos, precios, implementación, ARCA, cobros, seguridad, legal, IA y agente comercial.
- Se agregaron redirecciones 301 para `/faq/` y `/preguntas-frecuentes/` hacia `/faqs/`.
- Se actualizó Yoast SEO para `/faqs/` con title, description y focus keyword.
- Se reordenó `/erp-cumbre/` con una sección inicial `Elegí tu camino` y grupos por intención.
- Se reemplazó la grilla larga de submódulos por grupos ordenados: operación diaria, administración/control, crecimiento/integraciones y verticales.
- Se conservaron anclas antiguas `#submodulos` y `#verticales` como aliases invisibles para no romper enlaces existentes.
- Se agregaron breadcrumbs schema `BreadcrumbList` a páginas locales y al hub `/erp-cumbre/`.
- Se actualizó el asistente flotante con mensajes sobre arquitectura Cumbre, FAQs y recomendación de módulos.
- Se agregaron estilos responsive, dark mode y accesibilidad básica para el mega menú.

Archivos afectados:

- `wordpress/theme-gema-sovereign/parts/header.html`
- `wordpress/theme-gema-sovereign/parts/footer.html`
- `wordpress/theme-gema-sovereign/templates/page-erp-cumbre.html`
- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/inc/seo-yoast.php`
- `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`
- `wordpress/theme-gema-sovereign/style.css`

Auditoría SEO/UX realizada:

- Se mantuvieron rutas canónicas existentes para módulos Cumbre.
- Se evitó cambiar slugs principales.
- Se añadieron aliases de anclas internas para enlaces anteriores.
- Se confirmó que el sitemap depende de Yoast SEO (`/sitemap_index.xml` en producción/local según configuración).
- Se revisaron enlaces internos principales en header, footer y `/erp-cumbre/`.
- Se reforzó schema `FAQPage` para `/faqs/` mediante el generador local existente.
- Se reforzó schema `BreadcrumbList` para mejorar jerarquía semántica.

Validación:

- `php -l wordpress/theme-gema-sovereign/functions.php` sin errores.
- `php -l wordpress/theme-gema-sovereign/inc/seo-yoast.php` sin errores.
- `node --check wordpress/theme-gema-sovereign/assets/gema-floating-agent.js` sin errores.
- `git diff --check` sin errores.
- Linter del IDE sin errores en archivos editados.

Search Console:

- Cuenta indicada por dirección: `info@gema-digital.com`.
- Al abrir Google Search Console, el navegador estaba autenticado con otra cuenta (`info@generatuenergia.net`).
- No se registró la propiedad para evitar asociar `gema-digital.com` a una cuenta incorrecta.
- Pendiente: iniciar sesión o cambiar a `info@gema-digital.com`, verificar propiedad de dominio o URL-prefix y enviar `https://gema-digital.com/sitemap_index.xml`.

Estado:

- Implementado localmente en desarrollo.
- Pendiente sincronización/publicación y verificación real post-deploy en producción.

### 2026-06-08 - Cumbre Marketing definido como módulo insignia

Objetivo:
Replantear `Cumbre Marketing` como uno de los pilares principales de la marca Cumbre, con submódulos comerciales y una visión de producto comparable en ambición a herramientas de redes sociales, campañas y marketing orgánico, pero conectada al ERP.

Cambios aplicados:

- Se actualizó `docs/BLUEPRINT_CUMBRE_MARKETING.md` en el subproyecto ERP Cumbre.
- Se actualizó `docs/MATRIZ_CUMBRE.md` para reflejar los submódulos `Marketing Redes`, `Marketing Campañas` y `Marketing Orgánico`.
- Se reescribió `docs/cumbre-landing-prompts/cumbre-marketing.md` como prompt premium de producto insignia.
- Se definió `Marketing Redes` como sistema completo de idea, estrategia IA, edición, aprobación, selección de redes, calendario, horarios ideales, textos, prompts de imagen, guiones de video, previews por red, programación/exportación y métricas.
- Se definió `Marketing Campañas` para audiencias, WhatsApp, email, anuncios, UTM, atribución y automatizaciones.
- Se definió `Marketing Orgánico` para SEO, SEM asistido, GEO/AI Search, keywords, clusters, briefs, contenido evergreen y medición orgánica.
- Se adoptó una estrategia faseada: primero calendario, previews, aprobación, exportación y carga asistida; luego APIs oficiales por red con `credencial_ref`, tutoriales y validación backend; finalmente publicación automática y métricas reales cuando cada plataforma lo permita.

Guardrails registrados:

- No publicar contenido sin aprobación humana en la fase inicial.
- No prometer publicación automática universal si una red limita permisos.
- No guardar tokens de redes, anuncios, email o generación audiovisual en claro.
- No usar música, imágenes, marcas o material con copyright sin licencia.
- No sincronizar audiencias sensibles sin consentimiento/base legal.
- No confundir métricas estimadas con métricas reales de API.

Validación:

- Revisión documental local.
- No se publicó, no se desplegó y no se tocó producción.

Estado:

- Cumbre Marketing queda reposicionado como módulo insignia.
- Pendiente futuro: convertir esta nueva definición en landing web real y contratos/seed/tests si se decide llevarlo a implementación técnica.

### 2026-06-08 - Landings restantes de Cumbre implementadas en WordPress

Objetivo:
Comparar los prompts restantes de `docs/cumbre-landing-prompts/` contra las landings ya implementadas y crear las páginas faltantes en el sitio GEMA Digital / ERP Cumbre.

Cambios aplicados:

- Se detectó que `Cumbre Activos Fijos` ya tenía landing web implementada.
- Se implementaron 11 landings faltantes usando un constructor común de páginas Cumbre:
  - `/erp-cumbre/cumbre-personal/`
  - `/erp-cumbre/cumbre-marketing/`
  - `/erp-cumbre/cumbre-automatizaciones/`
  - `/erp-cumbre/cumbre-web/`
  - `/erp-cumbre/cumbre-ventas/`
  - `/erp-cumbre/cumbre-kioscos/`
  - `/erp-cumbre/cumbre-resto/`
  - `/erp-cumbre/cumbre-depositos-wms/`
  - `/erp-cumbre/cumbre-constructoras/`
  - `/erp-cumbre/cumbre-agro/`
  - `/erp-cumbre/cumbre-mercados/`
- Se crearon alias internos `/cumbre/{modulo}/` con canonical/301 hacia las rutas principales de `/erp-cumbre/`.
- Se agregaron secciones comunes de landing: problema, solución, funciones, métricas, flujo operativo, planes, add-ons, guardrails, módulos conectados, FAQ y CTAs.
- Se actualizaron enlaces del catálogo Cumbre para que Ventas, Personal, Marketing, Automatizaciones, Web y verticales sectoriales apunten a sus nuevas landings.
- Se agregó navegación en footer y nuevas tarjetas en la grilla de módulos de `/erp-cumbre/`.
- Se actualizó Yoast SEO con títulos, descripciones, focus keywords, canonical y redirecciones para las nuevas páginas.
- Se actualizó el asistente flotante para responder sobre RRHH/Personal, Marketing, Automatizaciones, Web, Ventas y verticales sectoriales.
- Se agregaron estilos compartidos para las nuevas landings generadas por catálogo.
- Se actualizó el sistema visual de Cumbre, la documentación visual, la preview HTML y el Canvas.

Archivos afectados:

- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/inc/seo-yoast.php`
- `wordpress/theme-gema-sovereign/templates/page-erp-cumbre.html`
- `wordpress/theme-gema-sovereign/parts/footer.html`
- `wordpress/theme-gema-sovereign/style.css`
- `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`
- `cumbre/src/components/design/CumbreDesignSystem.tsx`
- `docs/CUMBRE_SISTEMA_VISUAL.md`
- `cumbre-platform-preview.html`
- `canvases/cumbre-platform-preview.canvas.tsx`

Validación:

- `php -l wordpress/theme-gema-sovereign/functions.php` sin errores.
- `php -l wordpress/theme-gema-sovereign/inc/seo-yoast.php` sin errores.
- `node --check wordpress/theme-gema-sovereign/assets/gema-floating-agent.js` sin errores.
- `npm --prefix cumbre run typecheck` sin errores.
- `git diff --check` sin errores.

Estado:

- Implementado localmente en desarrollo.
- Pendiente sincronizar a Studio/producción y regenerar páginas WordPress cuando se decida publicar.

### 2026-06-08 - Verticales sectoriales Cumbre cerradas como prompts de landing

Objetivo:
Continuar la cadena separada de verticales sectoriales Cumbre y dejar prompts web listos para futuras landings, sin publicar ni desplegar.

Cambios aplicados:

- Se crearon blueprints verticales en el subproyecto ERP para Kioscos, Resto, Depósitos WMS, Constructoras, Agro y Mercados.
- Se agregó la sección `Verticales sectoriales Cumbre` en `docs/MATRIZ_CUMBRE.md`.
- Se generaron prompts web en `docs/cumbre-landing-prompts/` para las seis verticales.
- Se actualizó `docs/cumbre-landing-prompts/ESTADO_CADENA.md` con el cierre de verticales.

Validación:

- Revisión documental local.
- No se publicó, no se desplegó y no se tocó producción.

Estado:

- Cadena de verticales sectoriales completada localmente.


### 2026-06-07 - Cumbre Activos Fijos implementado como landing web

Objetivo:
Implementar `Cumbre Activos Fijos` como landing profesional de Cumbre ERP para administrar bienes de uso, ubicaciones, responsables, amortizaciones, mantenimientos, bajas y trazabilidad contable.

Cambios aplicados:

- Se creó la landing `/erp-cumbre/cumbre-activos-fijos/` y su ruta duplicada/canonical `/cumbre/activos-fijos/`.
- Se definió el mensaje principal: `Controlá tus activos fijos con trazabilidad contable, mantenimiento planificado y conexión real con tu ERP`.
- Se explicó que el módulo administra bienes de uso: computadoras, muebles, maquinaria, rodados, inmuebles y software capitalizable.
- Se aclaró que no reemplaza `Cumbre Stock` ni crea inventario vendible paralelo.
- Se agregaron funciones: alta desde Compras, importación o carga manual; ubicación y responsable; amortización lineal; mantenimiento preventivo/correctivo; bajas por venta, rotura, obsolescencia, pérdida, donación o ajuste; trazabilidad contable.
- Se conectó con Compras, PyMEs, Contabilidad, Tesorería, Reportes BI, Planificación, WhatsApp Hub y Tutoriales API / Importador Universal.
- Se agregaron guardrails: amortizaciones definitivas requieren revisión contable; bajas contabilizadas requieren aprobación humana y asiento contable; toda operación conserva origen e idempotencia.
- Se agregaron planes: Base USD 19/mes lanzamiento USD 15 hasta 100 activos; Standard USD 49/mes lanzamiento USD 39 hasta 1000 activos; Full USD 129/mes lanzamiento USD 103 hasta 10000 activos.
- Se actualizó Yoast SEO con title, meta description, focus keyword, synonyms, canonical y redirect 301.
- Se agregó enlace en footer, tarjeta en `/erp-cumbre/`, catálogo de módulos, recomendaciones internas y sistema visual de Cumbre.
- Se actualizó el asistente flotante para responder sobre activos fijos, bienes de uso, amortización, valor libro, vida útil, mantenimiento y bajas.
- Se actualizó la preview estática `cumbre-platform-preview.html`, el Canvas de Cumbre y la documentación visual `docs/CUMBRE_SISTEMA_VISUAL.md`.

Archivos afectados:

- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/inc/seo-yoast.php`
- `wordpress/theme-gema-sovereign/templates/page-erp-cumbre.html`
- `wordpress/theme-gema-sovereign/parts/footer.html`
- `wordpress/theme-gema-sovereign/style.css`
- `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`
- `cumbre/src/components/design/CumbreDesignSystem.tsx`
- `docs/CUMBRE_SISTEMA_VISUAL.md`
- `cumbre-platform-preview.html`
- `canvases/cumbre-platform-preview.canvas.tsx`

Validación:

- `php -l wordpress/theme-gema-sovereign/functions.php` sin errores.
- `php -l wordpress/theme-gema-sovereign/inc/seo-yoast.php` sin errores.
- `node --check wordpress/theme-gema-sovereign/assets/gema-floating-agent.js` sin errores.
- `npm --prefix cumbre run typecheck` sin errores.
- `git diff --check` sin errores.

Estado:

- Implementado localmente en el repo.
- Pendiente sincronizar a Studio/producción y regenerar páginas WordPress cuando se decida publicar.

### 2026-06-07 - Cumbre Activos Fijos cerrado como prompt de landing

Objetivo:
Cerrar el módulo `Cumbre Activos Fijos` dentro de la cadena de módulos Cumbre y dejar listo su prompt web para futura implementación de landing, sin publicar ni desplegar.

Cambios aplicados:

- Se guardó el prompt completo en `docs/cumbre-landing-prompts/cumbre-activos-fijos.md`.
- Se consolidó el mensaje comercial: bienes de uso, amortización, mantenimiento, responsables, ubicaciones y bajas con trazabilidad contable.
- Se incluyeron conexiones con Compras, ERP PyMEs, Contabilidad, Tesorería, Reportes BI, Planificación, WhatsApp Hub e Importador Universal.
- Se dejaron guardrails explícitos para no confundir activos fijos con Stock ni prometer cierres contables automáticos sin revisión.
- Se identificó como próximo módulo pendiente `Cumbre Personal`, basado en el blueprint estructural de ERP Cumbre.

Validación:

- Revisión documental local.
- No se publicó, no se desplegó y no se tocó producción.

Estado:

- Prompt listo para implementación futura.
- Cadena continúa con `Cumbre Personal`.

### 2026-06-07 - Cumbre Personal construido y prompt de landing generado

Objetivo:
Construir conceptualmente `Cumbre Personal`, auditar producto/SEO/legal/seguridad/integraciones y dejar listo el prompt web de landing.

Cambios aplicados:

- Se creó `docs/BLUEPRINT_CUMBRE_PERSONAL.md` en el subproyecto ERP Cumbre.
- Se agregó `Cumbre Personal` a `docs/MATRIZ_CUMBRE.md` como módulo de legajos, asistencia, ausentismo, novedades, liquidación asistida y documentos laborales.
- Se guardó el prompt web completo en `docs/cumbre-landing-prompts/cumbre-personal.md`.
- Se definieron planes conceptuales Base, Standard y Full, más add-ons de legajos, firma/documentación, soporte laboral e implementación asistida de convenios.
- Se auditaron guardrails de producto, SEO, legal, seguridad e integraciones.

Validación:

- Revisión documental local.
- No se publicó, no se desplegó y no se tocó producción.

Estado:

- Prompt listo para implementación futura.
- Próximo pendiente identificado: módulos transversales todavía listados en el blueprint estructural, comenzando por `Cumbre Marketing`.

### 2026-06-07 - Cumbre Marketing construido y prompt de landing generado

Objetivo:
Construir conceptualmente `Cumbre Marketing`, auditar producto/SEO/legal/seguridad/integraciones y dejar listo el prompt web de landing.

Cambios aplicados:

- Se creó `docs/BLUEPRINT_CUMBRE_MARKETING.md` en el subproyecto ERP Cumbre.
- Se agregó `Cumbre Marketing` a `docs/MATRIZ_CUMBRE.md`.
- Se guardó el prompt web completo en `docs/cumbre-landing-prompts/cumbre-marketing.md`.
- Se definieron campañas, segmentos, audiencias, WhatsApp, email, ads, atribución, UTM y automatizaciones comerciales pausables.
- Se auditaron consentimiento, opt-in, minimización de datos, `credencial_ref`, webhooks y expectativas comerciales.

Validación:

- Revisión documental local.
- No se publicó, no se desplegó y no se tocó producción.

Estado:

- Prompt listo para implementación futura.
- Cadena continúa con `Cumbre Automatizaciones`.

### 2026-06-07 - Cumbre Automatizaciones construido y prompt de landing generado

Objetivo:
Construir conceptualmente `Cumbre Automatizaciones`, auditar producto/SEO/legal/seguridad/integraciones y dejar listo el prompt web de landing.

Cambios aplicados:

- Se creó `docs/BLUEPRINT_CUMBRE_AUTOMATIZACIONES.md` en el subproyecto ERP Cumbre.
- Se agregó `Cumbre Automatizaciones` a `docs/MATRIZ_CUMBRE.md`.
- Se guardó el prompt web completo en `docs/cumbre-landing-prompts/cumbre-automatizaciones.md`.
- Se definieron flujos, triggers, condiciones, acciones, webhooks, reintentos, idempotencia, logs, aprobaciones y pausas.
- Se auditaron loops, secretos, webhooks, acciones críticas, permisos y guardrails por módulo dueño.

Validación:

- Revisión documental local.
- No se publicó, no se desplegó y no se tocó producción.

Estado:

- Prompt listo para implementación futura.
- Cadena continúa con `Cumbre Web`.

### 2026-06-07 - Cumbre Web construido y prompt de landing generado

Objetivo:
Construir conceptualmente `Cumbre Web`, auditar producto/SEO/legal/seguridad/integraciones y dejar listo el prompt web de landing.

Cambios aplicados:

- Se creó `docs/BLUEPRINT_CUMBRE_WEB.md` en el subproyecto ERP Cumbre.
- Se agregó `Cumbre Web` a `docs/MATRIZ_CUMBRE.md`.
- Se guardó el prompt web completo en `docs/cumbre-landing-prompts/cumbre-web.md`.
- Se definieron landings, formularios CRM, CMS/headless, SEO, eventos, redirects, tracking y conexión con CRM/Marketing/BI/Automatizaciones.
- Se auditaron consentimiento, cookies/tracking, spam, canonical/redirects, `credencial_ref` y control de publicación.

Validación:

- Revisión documental local.
- No se publicó, no se desplegó y no se tocó producción.

Estado:

- Prompt listo para implementación futura.
- Próximo módulo funcional pendiente identificado: `Cumbre Ventas`.

### 2026-06-07 - Cumbre Ventas construido y prompt de landing generado

Objetivo:
Construir conceptualmente `Cumbre Ventas`, auditar producto/SEO/legal/seguridad/integraciones y dejar listo el prompt web de landing.

Cambios aplicados:

- Se creó `docs/BLUEPRINT_CUMBRE_VENTAS.md` en el subproyecto ERP Cumbre.
- Se agregó `Cumbre Ventas` a `docs/MATRIZ_CUMBRE.md`.
- Se guardó el prompt web completo en `docs/cumbre-landing-prompts/cumbre-ventas.md`.
- Se definió Ventas como capa común de venta transaccional: POS, ventas digitales, listas de precios, descuentos, cobros, stock y facturación vinculada.
- Se auditaron guardrails de Catálogo, Stock, Cobros, Facturador ARCA, descuentos, anulaciones, multicanalidad e idempotencia.

Validación:

- Revisión documental local.
- No se publicó, no se desplegó y no se tocó producción.

Estado:

- Prompt listo para implementación futura.
- Módulos funcionales troncales del blueprint estructural cubiertos; queda distinguir verticales sectoriales como cadena separada.

### 2026-06-07 - Hook de continuidad para módulos Cumbre pendientes

Objetivo:
Crear una cadena de desarrollo en Cursor para que, al terminar un subagente, pueda continuar con el próximo módulo pendiente de Cumbre hasta completar la lista, sin publicar ni desplegar.

Cambios aplicados:

- Se creó `.cursor/hooks.json` con un hook `subagentStop`.
- Se creó `.cursor/hooks/cumbre-modules-chain.sh` para emitir la instrucción de continuidad del próximo módulo pendiente.
- Se creó `.cursor/hooks/cumbre-modules-chain.state` con `status=enabled` y contador inicial.
- Se creó `docs/cumbre-landing-prompts/README.md` como carpeta de salida para prompts de landing por módulo.
- Se configuró límite de seguridad de 30 iteraciones para evitar bucles infinitos.
- Se definió que la cadena debe construir conceptualmente el módulo, auditarlo y generar el prompt web completo en `docs/cumbre-landing-prompts/<slug>.md`.
- Se definió que, si no quedan módulos pendientes, debe registrar el cierre en `docs/cumbre-landing-prompts/ESTADO_CADENA.md` y cambiar el estado a `status=complete`.

Validación:

- `.cursor/hooks.json` validado como JSON correcto.
- `.cursor/hooks/cumbre-modules-chain.sh` marcado como ejecutable.
- `git diff --check` sobre los archivos nuevos sin errores.

Estado:

- Configurado localmente en desarrollo.
- No publica, no despliega y no toca producción.

### 2026-06-07 - Cumbre WhatsApp Hub agregado como capa transversal de comunicación

Objetivo:
Implementar `Cumbre WhatsApp Hub` como landing profesional del ecosistema Cumbre ERP para presentar WhatsApp como capa transversal de comunicación inteligente, conectada a módulos del ERP y basada en WhatsApp Business Cloud API oficial de Meta por cliente.

Cambios aplicados:

- Se creó la landing `/erp-cumbre/cumbre-whatsapp-hub/` y su ruta duplicada/canonical `/cumbre/whatsapp-hub/`.
- Se definió el mensaje central: `Tu ERP hablando por WhatsApp, con contexto real de tu empresa`.
- Se explicó el diferencial: WhatsApp no es un canal agregado, sino una capa transversal operada por el `Agente Cerebro WhatsApp`.
- Se incorporó la aclaración comercial y técnica de que cada cliente usa su propia API oficial de Meta: Business Manager, WABA, número, app, plantillas, opt-in y webhooks.
- Se agregaron funcionalidades: seguimiento automático, alertas por módulo, mensajes con opt-in, plantillas Meta, webhooks seguros, historial, trazabilidad, derivación humana, automatizaciones pausables y tutorial guiado.
- Se conectó el módulo con CRM, Cobros, Stock, Compras, Tesorería, Contabilidad, Impuestos, Reportes BI, Planificación, eCommerce, Mercado Libre, Legal, Negocios, PyMEs y Empresas.
- Se agregaron casos de uso por módulo: leads, pagos, bajo stock, reposición, vencimientos, alertas ejecutivas, pedidos, posventa, contratos y desvíos de planificación.
- Se dejaron guardrails explícitos: no guardar tokens en Firestore, usar `credencial_ref`, validar firmas de webhooks Meta, exigir opt-in, no enviar datos sensibles y requerir aprobación humana para acciones críticas.
- Se incorporó sección visual con mockup de chat, flujo Meta, grilla de módulos conectados y tabla de planes Base, Standard y Full.
- Se actualizó Yoast SEO con title, meta description, focus keyword, synonyms, canonical y redirect 301 desde `/cumbre/whatsapp-hub/`.
- Se agregó enlace en footer, tarjeta en `/erp-cumbre/`, catálogo de módulos, recomendaciones internas y sistema visual de Cumbre.
- Se actualizó el asistente flotante para responder sobre WhatsApp Hub, Meta Cloud API, opt-in, plantillas aprobadas, webhooks y `credencial_ref`.
- Se actualizó la preview estática `cumbre-platform-preview.html`, el Canvas de Cumbre y la documentación visual `docs/CUMBRE_SISTEMA_VISUAL.md`.

Archivos afectados:

- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/inc/seo-yoast.php`
- `wordpress/theme-gema-sovereign/templates/page-erp-cumbre.html`
- `wordpress/theme-gema-sovereign/parts/footer.html`
- `wordpress/theme-gema-sovereign/style.css`
- `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`
- `cumbre/src/components/design/CumbreDesignSystem.tsx`
- `docs/CUMBRE_SISTEMA_VISUAL.md`
- `cumbre-platform-preview.html`
- `canvases/cumbre-platform-preview.canvas.tsx`

Validación:

- `php -l wordpress/theme-gema-sovereign/functions.php` sin errores.
- `php -l wordpress/theme-gema-sovereign/inc/seo-yoast.php` sin errores.
- `node --check wordpress/theme-gema-sovereign/assets/gema-floating-agent.js` sin errores.
- `npm --prefix cumbre run typecheck` sin errores.
- `git diff --check` sin errores.

Estado:

- Implementado localmente en el repo.
- Pendiente sincronizar a Studio/producción y regenerar páginas WordPress cuando se decida publicar.

### 2026-06-07 - Cumbre Cobros actualizado como módulo financiero/comercial

Objetivo:
Implementar `Cumbre Cobros` como módulo financiero/comercial de ERP Cumbre, optimizado para SEO y con mensaje claro sobre links de pago, QR, transferencias, tarjetas, billeteras, webhooks, panel cliente, conciliación, auditoría y `0% comisión Cumbre` por transacción.

Cambios aplicados:

- Se actualizó la landing `/erp-cumbre/cumbre-cobros/` con title, meta description, keywords, hero, módulos, resumen operativo, FAQ y CTAs.
- Se incorporó la promesa comercial obligatoria: Cumbre Cobros no cobra comisión por transacción; el cliente paga un abono fijo por el sistema.
- Se separó explícitamente `Abono Cumbre` de `Arancel de pasarela`, aclarando que Mercado Pago, Payway, MODO, Stripe, PayPal u otra pasarela externa pueden cobrar sus propios aranceles.
- Se agregaron planes con 20% OFF de lanzamiento: `Cobros Base`, `Cobros Standard` recomendado y `Cobros Full`.
- Se agregó tabla de límites por plan: medios activos, eventos mensuales, webhooks activos, conciliación, panel cliente y comisión Cumbre.
- Se agregaron add-ons: medio de cobro adicional, webhook adicional, cuenta bancaria adicional, Multi-CUIT cobros asistido, conciliación masiva y soporte cobros prioritario.
- Se listaron medios soportados: Gema Pagos, Mercado Pago, MODO, transferencia bancaria, DEBIN, COELSA, Payway, Fiserv/PosNet, Naranja X, Cuenta DNI, Ualá Bis, Getnet, Stripe, PayPal, efectivo, cheque, POS físico y manual.
- Se agregaron bloques sobre Panel cliente, Panel de Control, integración con CRM/Negocios/PyMEs/Empresas/Facturador ARCA y guardrails.
- Se aclaró que Cumbre no guarda credenciales reales en texto plano, no acredita cobros manuales sin evidencia y no reemplaza pasarelas externas.
- Se actualizó la card de `Cumbre Cobros` dentro de `/erp-cumbre/` para mencionar 0% comisión Cumbre y aranceles externos.
- Se actualizó Yoast SEO del cluster pagos y la página `erp-cumbre/cumbre-cobros`.
- Se actualizó el asistente flotante del sitio para responder sobre Cumbre Cobros con la separación entre abono fijo y arancel de pasarela.
- Se agregó soporte visual para comparativa de comisiones y grilla de medios en `style.css`, con responsive y modo oscuro.

Archivos afectados:

- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/inc/seo-yoast.php`
- `wordpress/theme-gema-sovereign/templates/page-erp-cumbre.html`
- `wordpress/theme-gema-sovereign/style.css`
- `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`

Validación:

- `php -l wordpress/theme-gema-sovereign/functions.php` sin errores.
- `php -l wordpress/theme-gema-sovereign/inc/seo-yoast.php` sin errores.
- `node --check wordpress/theme-gema-sovereign/assets/gema-floating-agent.js` sin errores.
- `git diff --check` sin errores.
- Revisión por búsqueda de textos críticos: `0% comisión Cumbre`, `Abono Cumbre`, `Arancel de pasarela`, `Cobros Standard`, `Conciliación masiva`, guardrails y title SEO.

Estado:

- Implementado localmente en el repo.
- Pendiente sincronizar a Studio/producción y regenerar páginas WordPress cuando se decida publicar.

### 2026-06-07 - Cumbre Facturador ARCA agregado como módulo fiscal transversal

Objetivo:
Implementar `Cumbre Facturador ARCA` en el sitio web de GEMA Digital como módulo fiscal/documental transversal de ERP Cumbre, con foco SEO, claridad comercial, planes, límites, add-ons y guardrails para no prometer emisión fiscal automática insegura.

Cambios aplicados:

- Se agregó la sección `/erp-cumbre/#cumbre-facturador-arca` dentro de la landing `ERP Cumbre`.
- Se posicionó el mensaje principal: módulo fiscal y documental para emitir y administrar facturas, notas, remitos, recibos y documentación comercial/fiscal argentina con carga manual, agente IA, CAE, errores trazables e implementación asistida.
- Se aclaró expresamente que no se vende como emisión automática directa desde frontend; el mensaje correcto es emisión controlada, backend seguro, validación fiscal, job ARCA, worker seguro, CAE/error y auditoría.
- Se agregaron bloques: qué resuelve, no es un botón inseguro de ARCA, planes, tabla de límites, add-ons, flujo técnico, integraciones con CRM/Negocios/PyMEs/Empresas/Catálogo/Cobros y trial de 14 días.
- Se incorporaron planes con 20% OFF de lanzamiento: `Facturador Base`, `Facturador Standard` recomendado y `Facturador Full`.
- Se incluyó la aclaración obligatoria sobre `modelos disponibles`: son tipos de comprobante/documento elegibles, no cantidad de facturas emitibles.
- Se agregaron add-ons: punto de venta adicional, CUIT adicional asistido, remitos y recibos avanzados, documentación comercial avanzada, mayor volumen mensual, implementación ARCA productiva asistida y soporte fiscal prioritario.
- Se creó la landing SEO `/erp-cumbre/cumbre-facturador-arca/` mediante definición programática en `functions.php`.
- Se consolidó `/cumbre/facturador/` hacia `/erp-cumbre/cumbre-facturador-arca/` para evitar duplicación SEO.
- Se actualizaron title, meta description, keywords, schema FAQ, Yoast SEO y sinónimos semánticos para incluir facturación electrónica ARCA, facturador para empresas argentinas, facturas A/B/C, notas de crédito/débito, remitos, recibos, agente IA y CAE.
- Se agregó el enlace `Facturador ARCA` al footer dentro de ERP Cumbre.
- Se actualizó el asistente flotante del sitio con respuesta específica y quick action `Facturador ARCA`, manteniendo el guardrail de backend seguro, worker ARCA e implementación asistida.

Archivos afectados:

- `wordpress/theme-gema-sovereign/templates/page-erp-cumbre.html`
- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/inc/seo-yoast.php`
- `wordpress/theme-gema-sovereign/parts/footer.html`
- `wordpress/theme-gema-sovereign/style.css`
- `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`

Validación:

- `php -l wordpress/theme-gema-sovereign/functions.php` sin errores.
- `php -l wordpress/theme-gema-sovereign/inc/seo-yoast.php` sin errores.
- `node --check wordpress/theme-gema-sovereign/assets/gema-floating-agent.js` sin errores.
- `git diff --check` sin errores.
- Revisión por búsqueda de textos críticos: backend seguro, worker ARCA, modelos disponibles, Facturador Standard, add-ons y URL `/erp-cumbre/cumbre-facturador-arca/`.

Estado:

- Implementado localmente en el repo.
- Pendiente sincronizar a Studio/producción y regenerar páginas WordPress cuando se decida publicar.

### 2026-06-06 - Primera version del sistema visual Cumbre

Objetivo:
Crear una base visual propia para el entorno Cumbre y sus modulos, evitando depender de plantillas externas. La identidad se enfoca en un panel B2B sobrio, confiable y escalable para CRM, Negocios, ERP PyMEs, Cumbre Empresas, Cobros, Facturador ARCA y Estabilidad.

Cambios aplicados:

- Se creo `cumbre/src/components/design/CumbreDesignSystem.tsx` con primitivas reutilizables: `CumbreBadge`, `CumbrePanel`, `CumbrePageHeader`, `CumbreActionButton`, `CumbreMetricCard`, `CumbreModuleCard`, `cumbreShellClass` y `cumbreModuleVisuals`.
- Se agrego `cumbre/src/components/CumbreCommandCenter.tsx` como primera pantalla conceptual del panel Cumbre, con KPIs, mapa modular, senales ejecutivas, trial y narrativa de crecimiento.
- Se rediseño `cumbre/src/components/AppSidebar.tsx` para mostrar un Centro de Control con modulos activos, estados comerciales y bloque de trial/conversion.
- Se actualizo `cumbre/src/components/stability/StabilityDashboard.tsx` para usar los nuevos componentes base y quedar integrado al lenguaje visual Cumbre.
- Se documento el criterio visual en `docs/CUMBRE_SISTEMA_VISUAL.md`, incluyendo tonos por modulo, principios, componentes implementados y extension futura.

Validacion:

- `npm --prefix "cumbre" run typecheck` ejecutado correctamente.

Estado:

- Implementado localmente en el repo.
- Pendiente conectar `CumbreCommandCenter` al router/entrypoint real cuando se defina la estructura final de navegacion de la app.

### 2026-06-06 - Cumbre Empresas agregado a ERP Cumbre

Objetivo:
Implementar `Cumbre Empresas` como evolución de `Cumbre ERP PyMEs` para empresas argentinas en crecimiento que necesitan gobernanza, aprobaciones, auditoría, reportes ejecutivos e implementación asistida.

Cambios aplicados:

- Se agregó la sección `/erp-cumbre/#cumbre-empresas` dentro de la landing `ERP Cumbre`.
- Se posicionó el mensaje principal: `PyMEs ordena la administración. Empresas gobierna la administración.`
- Se definió el perfil ideal: empresas de Comercio y Servicios con equipos administrativos separados, varias sucursales, depósitos, responsables y flujos de aprobación.
- Se agregaron funciones comerciales: administración basada en Cumbre ERP PyMEs, más usuarios/sucursales/depósitos, gobernanza por área, aprobaciones, Vista Ejecutiva, auditoría extendida, reportes gerenciales, asistente IA e integración con CRM, Catálogo, Cobros, Gema Pagos y Facturador ARCA.
- Se agregaron planes con promo de lanzamiento 20% OFF: `Empresas Base`, `Empresas Plus` recomendado y `Empresas Advanced`.
- Se agregaron add-ons: integraciones asistidas, auditoría avanzada, SLA prioritario, bloque de 25 usuarios y bloque de 10 sucursales/depósitos.
- Se aclaró que la mensualidad cubre licencia SaaS y soporte del plan; implementación asistida, migraciones, integraciones reales y capacitaciones avanzadas se presupuestan por alcance.
- Se agregaron CTAs: solicitar implementación asistida, probar Cumbre Empresas 14 días y comparar con Cumbre ERP PyMEs.
- Se actualizó el piso 04 del Edificio Cumbre para enlazar a `/erp-cumbre/#cumbre-empresas`.
- Se agregó `Cumbre Empresas` al footer de ERP Cumbre.
- Se actualizaron title, meta description, keywords y Yoast semántico para incluir `Cumbre Empresas`, gobernanza, aprobaciones, auditoría y reportes ejecutivos.
- Se corrigieron catálogos y comparativas heredadas que presentaban Empresas con multi-holding, BYOK o infraestructura dedicada.

Validación:

- `php -l wordpress/theme-gema-sovereign/functions.php` correcto.
- `php -l wordpress/theme-gema-sovereign/inc/seo-yoast.php` correcto.
- `git diff --check` correcto.
- Se sincronizó el theme a Studio con `./scripts/sync-theme-to-studio.sh`.
- `http://localhost:8881/erp-cumbre/?v=cumbre-empresas` contiene `#cumbre-empresas`, los tres planes, los cinco add-ons, el footer actualizado, el title/meta nuevos y el mensaje de gobernanza.
- Validación DOM en browser: desktop en 3 columnas, mobile en 1 columna sin overflow horizontal y modo día/noche con contraste correcto.
- Barrido de guardrails sin coincidencias para: multi-holding, infraestructura dedicada, BYOK, reemplazo de contador/auditor/equipo administrativo, ARCA productivo automático, ERP corporativo completo o contabilidad completa incluida.

Estado:
Implementado y validado localmente en Studio. No desplegado a producción.

### 2026-06-06 - Precios Cumbre ERP PyMEs sincronizados en Studio

Objetivo:
Terminar la implementación visual y comercial del bloque de precios de `Cumbre ERP PyMEs Administrativo` en `/erp-cumbre/#cumbre-erp-pymes`.

Cambios aplicados:

- Se completó el bloque de precios con tres planes: `PyMEs Admin Base`, `PyMEs Admin Plus` recomendado y `PyMEs Admin Pro`.
- Se reforzó el posicionamiento como administración para PyMEs de Comercio y Servicios, no POS económico ni ERP corporativo completo.
- Se agregaron perfiles comerciales por plan, límites operativos, facturación sugerida y promo 20% OFF.
- Se agregaron add-ons: contabilidad formal, Multi-CUIT asistido, Tesorería avanzada, usuario administrativo adicional, sucursal adicional y centro de costo adicional.
- Se reforzaron mensajes de prueba de 14 días, preservación de datos al pasar a plan pago, contabilidad formal opcional e implementación asistida para procesos fiscales/contables críticos.
- Se revisó copy para evitar promesas de activación fiscal automática, reemplazo del contador o contabilidad completa incluida en todos los planes.
- Se actualizó SEO de `erp-cumbre` con `software administrativo para pymes`, `administración para pymes`, `contabilidad opcional para pymes`, ventas, compras, bancos, impuestos y reportes.
- Se confirmó que Home apunta a `/erp-cumbre/#cumbre-erp-pymes`.
- Se agregó el link `ERP PyMEs` al footer apuntando a `/erp-cumbre/#cumbre-erp-pymes`.
- Se sincronizó el theme al WordPress local de Studio con `./scripts/sync-theme-to-studio.sh`.

Validación:

- `php -l wordpress/theme-gema-sovereign/functions.php` correcto.
- `php -l wordpress/theme-gema-sovereign/inc/seo-yoast.php` correcto.
- `http://localhost:8881/erp-cumbre/?v=pymes-pricing-synced` contiene el anchor `#cumbre-erp-pymes`, los tres planes, los add-ons, el title y la meta description nuevos.
- Validación DOM en browser: 3 cards de planes, 6 add-ons, footer con `ERP PyMEs`, sin términos prohibidos, desktop en 3 columnas y mobile en 1 columna sin overflow horizontal.
- Modo día/noche validado con estilos computados: cards, textos y add-ons cambian correctamente de contraste.
- Captura de pantalla del browser no se pudo guardar por timeout del MCP, pero la página quedó validada por snapshot accesible y DOM.

### 2026-06-06 - Auditoria y simplificacion de arquitectura del sitio

Objetivo:
Reducir duplicacion visible en menus y paginas, ordenar la jerarquia publica del sitio y consolidar URLs que competian por la misma intencion SEO sin eliminar contenido util.

Cambios aplicados:

- Se auditaron las fuentes principales de arquitectura web: `parts/header.html`, `parts/footer.html`, `functions.php`, `inc/seo-yoast.php` y `docs/YOAST_SEO_ANALISIS_SEMANTICO.md`.
- Se simplifico el header global a enlaces de decision: Soluciones, ERP Cumbre, IA Productiva, GEMA Negocios, Recursos y Contacto.
- Se reemplazo el footer tipo sitemap completo por cuatro grupos semanticos: GEMA Digital, ERP Cumbre, Pagos, Legal y recursos.
- Se retiraron del footer global las comparativas profundas, submodulos, legales secundarios y proveedores de pago especificos, que quedan disponibles desde sus hubs contextuales.
- Se agrego en `inc/seo-yoast.php` un mapa de consolidacion para redirigir duplicados claros con 301 y emitir canonicals coherentes.
- Se consolidaron como principales `/cumbre-crm`, `/cumbre-erp-negocios`, `/erp-cumbre/cumbre-cobros`, `/pagos`, `/erp/funciones/facturacion-electronica`, `/competencia/cumbre-erp-pymes-vs-tango-bejerman-odoo` y `/competencia/cumbre-empresas-vs-sap-netsuite`.
- Se documento la auditoria completa en `docs/AUDITORIA_SIMPLIFICACION_SITIO_GEMA.md`.

Estado:
Cambios aplicados localmente. Falta despliegue a produccion y verificacion publica de redirecciones/canonicals cuando se autorice.

### 2026-06-06 - Apartado completo de Cumbre CRM

Objetivo:
Crear/actualizar el apartado completo de `Cumbre CRM` en el sitio web, comunicándolo como tronco comercial de Cumbre ERP y no como CRM aislado.

Mensajes aplicados:

- `Cumbre CRM: el tronco comercial de tu empresa`.
- De la consulta al presupuesto, del presupuesto al cobro, y del cobro a la factura.
- Orientado a PyMEs argentinas B2B que reciben consultas, cotizan en USD/ARS, manejan productos o servicios y necesitan seguimiento comercial.
- CRM conectado con Catálogo, Cobros, Stock, Facturación ARCA en piloto controlado, Panel de Control y Asistente Guiado.
- Trial de 14 días con datos preservados al pasar a plan pago.
- Demo comercial y piloto controlado sin prometer facturación productiva abierta.

Cambios en web:

- `/cumbre/crm` dejó de ser una landing genérica y pasó a tener una definición específica.
- Se agregaron bloques sobre:
  - Problemas comerciales.
  - Solución CRM.
  - CRM como tronco.
  - Funciones principales.
  - Asistente Guiado.
  - Planes CRM: Starter, Growth, Pro y AI/FDE.
  - Trial de 14 días.
  - Demo/piloto controlado.
- Se corrigió la comparativa CRM para eliminar detalles internos y evitar promesas como validación ARCA automática.

Cambios en asistente IA:

- `gema-floating-agent.js` ahora incluye respuesta específica `crm`.
- Agregado botón rápido `Cumbre CRM` al widget.
- Señales del asistente actualizadas para detectar leads, pipeline, presupuestos, oportunidades y postventa.
- Backend local `app/agent.py` actualizado con el mismo posicionamiento. Sigue pendiente el deploy productivo del backend por falta de acceso SSH válido al VPS Hostinger.

Archivos principales:

- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`
- `../00-Proyecto Gema/07-Api de Gema/app/agent.py`

Producción:

- Theme sincronizado localmente y en producción.
- Páginas regeneradas con WP-CLI.
- Cache WordPress limpiada.

Validación:

- `php -l` sin errores en `functions.php`.
- `node --check` sin errores en `gema-floating-agent.js`.
- `python3 -m py_compile` sin errores en `app/agent.py`.
- Producción verificada:
  - `/cumbre/crm` respondió `200 OK`.
  - La landing contiene `Cumbre CRM: el tronco comercial de tu empresa`, `De la consulta al presupuesto`, `Leads dispersos`, `CRM como tronco`, `Cumbre Catálogo`, `Cumbre Cobros`, `Vista Hoy`, `Asistente Guiado`, `Trial de 14 días`, `Demo y piloto` y `Solicitar demo comercial`.
  - El JS productivo del asistente contiene `Cumbre CRM es el tronco comercial`, `pipeline` y `postventa`.
  - No se encontraron en el copy CRM términos internos como `Firebase`, `Firestore`, `tenant`, `seed`, `Bigtable`, `CUIT validado` o `sin APIs intermedias`. La única aparición de `worker` viene del script interno de emojis de WordPress, no del contenido editorial.

Pendiente:

- Desplegar backend productivo del asistente en VPS Hostinger cuando exista acceso SSH válido.

### 2026-06-06 - Actualización pública del estado actual de Cumbre ERP

Objetivo:
Actualizar el sitio web de GEMA Digital para comunicar el estado real de Cumbre ERP como base sólida para demo comercial y beta técnica controlada, sin prometer producción fiscal abierta.

Mensajes aplicados:

- Cumbre ERP ayuda a PyMEs argentinas a convertir consultas, productos, presupuestos, cobros y facturas en un solo flujo operativo.
- Foco inicial recomendado: PyMEs argentinas B2B que presupuestan en USD, cobran en ARS, manejan stock/proveedores y necesitan facturación ARCA en modo controlado.
- Cumbre CRM se comunica como tronco operativo, no como módulo aislado.
- Cumbre Catálogo se comunica como fuente única de productos, servicios, precios, IVA, stock y proveedores.
- Cumbre Cobros, Stock, Facturación, Compras y futuras integraciones se conectan desde el flujo comercial.
- Asistente Guiado Cumbre se presenta como acelerador de aprendizaje y checklist contextual.
- Trial de 14 días por módulo, conservando datos al pasar a plan pago.
- ARCA se comunica como `demo comercial`, `piloto fiscal controlado` o `implementación asistida`, no como producción abierta.
- Gema Pagos se comunica como integración en desarrollo para suscripciones, cobros y activación de módulos.

Cambios en web:

- Reescrito hero de `/erp-cumbre/`.
- Agregados bloques:
  - `Estado actual del producto`.
  - `CRM como tronco operativo`.
  - `Catálogo + presupuesto + stock + cobros + facturación`.
  - `Asistente guiado`.
  - `Trial y activación`.
  - `Demo comercial y piloto controlado`.
- Actualizadas cards del Edificio Cumbre y submódulos para evitar sobreprometer producción fiscal.
- Actualizada home para resumir ERP Cumbre como CRM/ERP para PyMEs argentinas B2B.
- Actualizados metadatos SEO de ERP Cumbre.
- Actualizadas páginas generadas y comparativa del Facturador para hablar de piloto fiscal controlado.

Cambios en asistente IA:

- `gema-floating-agent.js` actualizado para responder con foco en PyMEs B2B, demo comercial, piloto controlado, Catálogo, Cobros, Panel, Asistente Guiado y Gema Pagos como integración en desarrollo.
- Backend local `app/agent.py` actualizado con las mismas reglas de mensaje y guardrails. El despliegue productivo del backend sigue pendiente por acceso SSH al VPS Hostinger.

Archivos principales:

- `wordpress/theme-gema-sovereign/templates/page-erp-cumbre.html`
- `wordpress/theme-gema-sovereign/templates/front-page.html`
- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`
- `../00-Proyecto Gema/07-Api de Gema/app/agent.py`

Producción:

- Theme sincronizado localmente y en producción.
- Páginas regeneradas con WP-CLI.
- Cache WordPress limpiada.

Validación:

- `php -l` sin errores en `functions.php`.
- `node --check` sin errores en `gema-floating-agent.js`.
- `python3 -m py_compile` sin errores en `app/agent.py`.
- Producción verificada:
  - `/erp-cumbre/` respondió `200 OK` y contiene los nuevos bloques y CTA `Solicitar demo o piloto controlado`.
  - `/` respondió `200 OK` y contiene `CRM y ERP para PyMEs argentinas B2B`.
  - `gema-floating-agent.js` productivo contiene `piloto controlado` y `Gema Pagos como integración en desarrollo`.
  - No aparecen en `/erp-cumbre/` términos riesgosos como `localización fiscal nativa`, `conexión directa y síncrona`, `obtención de CAE` o `control total`.

Pendiente:

- Desplegar el backend productivo del asistente en VPS Hostinger cuando exista acceso SSH válido.

### 2026-06-06 - Sincronización de mejoras desde proyecto Cumbre a web y asistente

Objetivo:
Trabajar coordinado con la otra terminal/proyecto `01-Proyecto Cumbre Erp` y aplicar al sitio público las mejoras agregadas a ERP Cumbre.

Contexto revisado:

- Terminales activas: Firebase emulators de Cumbre corriendo en `01-Proyecto Cumbre Erp`; no había despliegues WordPress simultáneos.
- Documentos fuente revisados:
  - `docs/REGISTRO_AVANCE_PROYECTO.md`
  - `docs/BLUEPRINT_CUMBRE_CATALOGO.md`
  - `docs/BLUEPRINT_PISO_1_CUMBRE_CRM.md`
  - `docs/BLUEPRINT_ASISTENTE_GUIADO_CUMBRE.md`

Cambios aplicados en web:

- Agregado `Cumbre Catálogo` como módulo transversal:
  - Landing `/cumbre/catalogo`.
  - Subdominio previsto `catalogo.gema-digital.com`.
  - Enlace en ERP Cumbre y footer.
  - Copy sobre productos, servicios, precios bimonetarios, fiscalidad, stock, proveedores e ingesta multimodal.
- Agregado `Asistente Guiado Cumbre`:
  - Landing `/cumbre/asistente`.
  - Subdominio previsto `asistente.gema-digital.com`.
  - Copy sobre checklist contextual, niveles de ayuda, progreso persistente y próxima mejor acción.
- Agregado `Panel de Control Cumbre`:
  - Landing `/cumbre/panel`.
  - Subdominio previsto `panel.gema-digital.com`.
  - Copy sobre módulos activos, trial de 14 días, alertas, billing, Gema Pagos y estado operativo.
- Actualizada landing `/erp-cumbre/` con cards visibles para Catálogo, Asistente Guiado y Panel.
- Actualizado plugin `gema-cumbre-subdomains` para mapear 23 portales.
- Actualizada documentación `docs/SUBDOMINIOS_CUMBRE.md`.
- Se incorporó pricing CRM sugerido en las landings de portales:
  - CRM Starter: `$19.900 + IVA`
  - CRM Growth: `$39.900 + IVA`
  - CRM Pro: `$69.900 + IVA`
  - CRM AI/FDE: `$119.900 + IVA`

Cambios aplicados en asistente IA:

- `gema-floating-agent.js` ahora reconoce y responde sobre:
  - Cumbre Catálogo.
  - Asistente Guiado Cumbre.
  - Panel de Control Cumbre.
  - Portales/subdominios.
  - Trial, billing, suscripción, módulos activos y Gema Pagos.
- Backend local `app/agent.py` actualizado con señales equivalentes para:
  - `Cumbre Catálogo`.
  - `Asistente Guiado Cumbre`.
  - `Panel de Control Cumbre`.
  - `Portales Cumbre`.

Archivos principales:

- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/templates/page-erp-cumbre.html`
- `wordpress/theme-gema-sovereign/parts/footer.html`
- `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`
- `wordpress/plugins/gema-cumbre-subdomains/gema-cumbre-subdomains.php`
- `docs/SUBDOMINIOS_CUMBRE.md`
- `../00-Proyecto Gema/07-Api de Gema/app/agent.py`

Producción:

- Theme sincronizado localmente y en producción.
- Plugin `gema-cumbre-subdomains` sincronizado.
- Páginas regeneradas con WP-CLI.
- Cache WordPress limpiada.

Validación:

- `php -l` sin errores en `functions.php`.
- `php -l` sin errores en `gema-cumbre-subdomains.php`.
- `node --check` sin errores en `gema-floating-agent.js`.
- `python3 -m py_compile` sin errores en `app/agent.py`.
- Producción verificada:
  - `/cumbre/catalogo` respondió `200 OK`.
  - `/cumbre/asistente` respondió `200 OK`.
  - `/cumbre/panel` respondió `200 OK`.
  - `/erp-cumbre/` contiene `Cumbre Catálogo`, `Asistente Guiado Cumbre` y `Panel de Control Cumbre`.
  - `gema-floating-agent.js` productivo contiene los nuevos conocimientos.
  - `/wp-json/gema-cumbre/v1/subdomains` respondió `prepared_pending_dns` con 23 subdominios y contiene `catalogo`, `asistente` y `panel`.

Pendiente:

- El backend productivo del asistente en VPS Hostinger sigue pendiente de deploy porque falta acceso SSH válido a `85.31.62.119`.
- Los subdominios reales siguen pendientes de DNS, wildcard SSL y server alias.

### 2026-06-06 - Portales y subdominios por módulo ERP Cumbre

Objetivo:
Preparar un subdominio/portal para cada módulo de ERP Cumbre, con landing, planes, pagos, diagnóstico e integración con el asistente IA.

Cambios:

- Web WordPress:
  - Creado índice `/cumbre`.
  - Creadas landings internas `/cumbre/{modulo}` para 20 módulos.
  - Cada landing incluye subdominio previsto, landing comercial, planes por alcance, pagos/activación, enlaces a Cumbre Cobros, plataforma de pagos y contacto.
  - Agregado enlace `Portales` en header.
  - Agregado enlace `Portales Cumbre` en footer.
  - Creado plugin `gema-cumbre-subdomains` con mapa de subdominios y endpoint técnico.
- Asistente IA:
  - Actualizado `gema-floating-agent.js` con respuesta `portales`.
  - Agregado botón rápido `Portales Cumbre`.
  - Actualizado backend local `app/agent.py` con señal `Portales Cumbre` para consultas sobre subdominios, portales, landings y planes.
- Documentación:
  - Creado `docs/SUBDOMINIOS_CUMBRE.md` con mapa completo, estado, activación técnica, DNS/SSL y pagos.

Módulos/subdominios preparados:

- `crm.gema-digital.com` -> `/cumbre/crm`
- `negocios.gema-digital.com` -> `/cumbre/negocios`
- `pymes.gema-digital.com` -> `/cumbre/pymes`
- `empresas.gema-digital.com` -> `/cumbre/empresas`
- `facturador.gema-digital.com` -> `/cumbre/facturador`
- `cobros.gema-digital.com` -> `/cumbre/cobros`
- `compras.gema-digital.com` -> `/cumbre/compras`
- `ventas.gema-digital.com` -> `/cumbre/ventas`
- `personal.gema-digital.com` -> `/cumbre/personal`
- `tesoreria.gema-digital.com` -> `/cumbre/tesoreria`
- `marketing.gema-digital.com` -> `/cumbre/marketing`
- `automatizaciones.gema-digital.com` -> `/cumbre/automatizaciones`
- `web.gema-digital.com` -> `/cumbre/web`
- `ecommerce.gema-digital.com` -> `/cumbre/ecommerce`
- `kioscos.gema-digital.com` -> `/cumbre/kioscos`
- `resto.gema-digital.com` -> `/cumbre/resto`
- `wms.gema-digital.com` -> `/cumbre/wms`
- `constructoras.gema-digital.com` -> `/cumbre/constructoras`
- `agro.gema-digital.com` -> `/cumbre/agro`
- `mercados.gema-digital.com` -> `/cumbre/mercados`

Archivos principales:

- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/parts/header.html`
- `wordpress/theme-gema-sovereign/parts/footer.html`
- `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`
- `wordpress/plugins/gema-cumbre-subdomains/gema-cumbre-subdomains.php`
- `docs/SUBDOMINIOS_CUMBRE.md`
- `../00-Proyecto Gema/07-Api de Gema/app/agent.py`

Producción:

- Theme sincronizado localmente y en producción.
- Plugin `gema-cumbre-subdomains` desplegado y activado en producción.
- Páginas regeneradas con WP-CLI.
- Cache WordPress limpiada.
- Endpoint `/wp-json/gema-cumbre/v1/subdomains` activo.

Validación:

- `php -l` sin errores en `functions.php`.
- `php -l` sin errores en `gema-cumbre-subdomains.php`.
- `node --check` sin errores en `gema-floating-agent.js`.
- `python3 -m py_compile` sin errores en `app/agent.py`.
- Producción verificada:
  - `/cumbre` respondió `200 OK`.
  - `/cumbre/cobros` respondió `200 OK`.
  - `/cumbre/crm` respondió `200 OK`.
  - `/cumbre/pymes` respondió `200 OK`.
  - `/cumbre/tesoreria` respondió `200 OK`.
  - `/cumbre/ecommerce` respondió `200 OK`.
  - `/wp-json/gema-cumbre/v1/subdomains` respondió `prepared_pending_dns` con 20 subdominios.

Pendiente:

- Crear DNS real para cada subdominio o wildcard `*.gema-digital.com`.
- Configurar vhost/server alias para aceptar los hosts.
- Emitir wildcard SSL o certificados por subdominio.
- Definir canonical/SEO final: indexar subdominios independientes o canonicals hacia `/cumbre/{modulo}`.
- Conectar pagos reales por módulo cuando estén listas las cuentas de GEMA.
- Desplegar el cambio local del backend del asistente al VPS Hostinger cuando exista acceso SSH válido.

### 2026-06-06 - Asistente IA con análisis de necesidades y recomendación de soluciones

Objetivo:
Dar al asistente IA la capacidad de analizar la necesidad del cliente y recomendar la mejor combinación de soluciones GEMA/Cumbre para interesados.

Cambios:

- Web WordPress:
  - Agregada sección en la home: `Diagnóstico inteligente`.
  - Actualizado el mensaje inicial del asistente flotante.
  - Agregados accesos rápidos: `Analizar mi caso` y `Cumbre Cobros`.
  - Publicado el nuevo JavaScript del asistente con motor local de recomendación por señales.
- Asistente IA:
  - Actualizado `assets/gema-floating-agent.js` con `solutionSignals` y `buildNeedsRecommendation()`.
  - Actualizado backend local `app/agent.py` para detectar señales comerciales y recomendar combinaciones entre ERP Cumbre, Cumbre Cobros, Cumbre Tesorería, Cumbre CRM, IA Productiva, GEMA Negocios, eCommerce y Cumbre Facturador.
  - El contrato de API no cambió para no romper n8n/WordPress; la recomendación se expresa en `reply`, `product_interest`, `pain_summary` y `priority_score`.

Archivos principales:

- `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`
- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/templates/front-page.html`
- `../00-Proyecto Gema/07-Api de Gema/app/agent.py`

Producción:

- Web WordPress desplegada a `https://gema-digital.com`.
- Theme sincronizado localmente y en producción.
- Páginas regeneradas con WP-CLI.
- Cache WordPress limpiada.
- Backend del asistente actualizado localmente, pero no desplegado al VPS Hostinger porque el acceso SSH a `85.31.62.119` rechazó la key disponible (`Permission denied`).

Validación:

- `php -l` sin errores en `functions.php`.
- `node --check` sin errores en `gema-floating-agent.js`.
- `python3 -m py_compile` sin errores en `app/agent.py`.
- Prueba local del backend recomendó combinación para un comercio con stock, Mercado Pago, Nave, QR y ARCA: `Cumbre Cobros + Cumbre Facturador + ERP Cumbre PyMEs`.
- Producción web verificada:
  - `/` respondió `200 OK` y contiene `Diagnóstico inteligente`, `La IA analiza necesidades` y `Cumbre Cobros`.
  - `/wp-content/themes/gema-sovereign/assets/gema-floating-agent.js` respondió `200 OK` y contiene `buildNeedsRecommendation`, `solutionSignals` y `Cumbre Cobros`.

Pendiente:

- Habilitar acceso SSH al VPS Hostinger del backend o ejecutar allí el despliegue de `app/agent.py` para que la API productiva use el mismo análisis avanzado.
- Mientras tanto, el widget web productivo ya tiene fallback local con recomendación de soluciones si la API no responde.

### 2026-06-06 - Regla de sincronización Web + Asistente IA para Cumbre

Objetivo:
Establecer que todos los cambios futuros de ERP Cumbre se reflejen tanto en la web como en el asistente de IA.

Cambios:

- Actualizada la regla persistente `.cursor/rules/actualizar-registro-gema.mdc`.
- La regla ahora exige revisar impacto en:
  - Web WordPress: páginas, menús, interlinks, SEO, comparativas, estilos y despliegue.
  - Asistente IA: respuestas guiadas, conocimiento local, flujos de lead, handoff o documentación del agente.
- Agregado este criterio al protocolo de actualización del registro maestro.

Estado:

- Cambio local de documentación/regla persistente.
- No requirió despliegue a producción porque no modifica el sitio público.

Validación:

- Regla y registro actualizados en la carpeta del proyecto.

Pendiente:

- En cada próxima implementación funcional de Cumbre, verificar y actualizar explícitamente web + asistente IA antes de cerrar la tarea.

### 2026-06-06 - Registro maestro del proyecto

Objetivo:
Crear un registro detallado dentro de la carpeta del proyecto y dejar una pauta para actualizarlo con cada cambio futuro.

Cambios:

- Creado `REGISTRO_DE_TRABAJO_GEMA.md`.
- Documentado protocolo de actualización del registro.
- Se preparó regla persistente de Cursor en `.cursor/rules/actualizar-registro-gema.mdc`.

Estado:

- Registro creado localmente.
- Debe actualizarse al cierre de cada modificación futura.

### 2026-06-06 - Módulo Cumbre Cobros

Objetivo:
Agregar un módulo `Cumbre Cobros` como integración de cobros editable para clientes, con todas las formas de cobro relevantes para Argentina.

Cambios:

- Agregada página programática `/erp-cumbre/cumbre-cobros`.
- Integrado `Cumbre Cobros` al catálogo central de módulos Cumbre.
- Agregado bloque visual de `Cumbre Cobros` en la landing `/erp-cumbre/`.
- Agregado enlace en footer de módulos Cumbre.
- Agregado enlace en footer de plataforma de pagos.
- Ampliada `/pagos/argentina` para contemplar transferencia, CBU/CVU/Alias, QR interoperable, MODO, Mercado Pago, Nave, tarjetas, links de pago, POS/terminales y comprobantes manuales.
- Actualizada documentación `docs/PLATAFORMA_PAGOS_GEMA.md`.

Archivos principales:

- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/templates/page-erp-cumbre.html`
- `wordpress/theme-gema-sovereign/parts/footer.html`
- `docs/PLATAFORMA_PAGOS_GEMA.md`

Producción:

- Theme sincronizado a producción.
- Páginas regeneradas con WP-CLI.
- Cache WordPress limpiada.

Validación:

- `/erp-cumbre/cumbre-cobros` respondió `200 OK`.
- `/erp-cumbre/` contiene `Cumbre Cobros` y enlace a `/erp-cumbre/cumbre-cobros`.
- `/pagos/argentina` contiene `QR interoperable`, `MODO`, `Mercado Pago` y `Nave`.
- Endpoint técnico `/wp-json/gema-payments/v1/providers` respondió `200 OK` con estado `ready_for_credentials`.

Pendiente:

- Conectar credenciales reales de proveedores cuando GEMA confirme cuentas y permisos.

### 2026-06-06 - Plataforma de Pagos GEMA

Objetivo:
Diseñar e implementar una plataforma robusta de pagos nacionales y globales para GEMA, sin conectar todavía cuentas reales.

Cambios:

- Creadas páginas de pagos:
  - `/pagos`
  - `/pagos/argentina`
  - `/pagos/transferencia-bancaria`
  - `/pagos/mercado-pago`
  - `/pagos/nave`
  - `/pagos/global`
  - `/pagos/paypal`
  - `/pagos/stripe`
  - `/pagos/seguridad`
  - `/pagos/webhooks`
  - `/pagos/conciliacion`
- Agregados enlaces de pagos al header y footer.
- Creado plugin propio `gema-payments-platform`.
- Agregado endpoint público de proveedores: `/wp-json/gema-payments/v1/providers`.
- Agregado endpoint de webhooks por proveedor: `/wp-json/gema-payments/v1/webhooks/{provider}`.
- Preparado modelo de eventos privados `gema_payment_event`.
- Documentada seguridad, webhooks, idempotencia, conciliación y conexión futura.
- Instalados en producción, pero inactivos, los plugins:
  - `woocommerce`
  - `woocommerce-mercadopago`
  - `nave-for-woocommerce`
  - `woocommerce-paypal-payments`
  - `woocommerce-gateway-stripe`

Archivos principales:

- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/parts/header.html`
- `wordpress/theme-gema-sovereign/parts/footer.html`
- `wordpress/plugins/gema-payments-platform/gema-payments-platform.php`
- `docs/PLATAFORMA_PAGOS_GEMA.md`

Producción:

- Plugin `gema-payments-platform` activado.
- Plugins oficiales de gateways descargados, pero no activados.
- Páginas generadas y verificadas.

Validación:

- Todas las páginas `/pagos...` respondieron `200 OK`.
- Endpoint `/wp-json/gema-payments/v1/providers` respondió `ready_for_credentials`.
- PHP validado sin errores en theme y plugin propio.

Pendiente:

- Vincular cuenta bancaria real.
- Vincular Mercado Pago.
- Vincular Nave.
- Vincular PayPal.
- Vincular Stripe.
- Configurar webhooks productivos con secretos reales.
- Definir flujo final de checkout, facturación y conciliación.

### 2026-06-05 / 2026-06-06 - Interlinking de módulos Cumbre

Objetivo:
Interconectar todo el sitio con la estructura de módulos ERP Cumbre.

Cambios:

- Creado catálogo central de módulos Cumbre.
- Agregado sistema de recomendaciones contextuales por página.
- Agregados bloques de módulos recomendados en páginas generadas.
- Actualizadas páginas estáticas:
  - Home
  - GEMA Negocios
  - IA Productiva
  - ERP Cumbre
- Actualizados header y footer con acceso a módulos, verticales y comparativas.
- Agregado footer con enlaces completos a comparativas y módulos.

Archivos principales:

- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/templates/front-page.html`
- `wordpress/theme-gema-sovereign/templates/page-gema-negocios.html`
- `wordpress/theme-gema-sovereign/templates/page-ia-productiva.html`
- `wordpress/theme-gema-sovereign/templates/page-erp-cumbre.html`
- `wordpress/theme-gema-sovereign/parts/header.html`
- `wordpress/theme-gema-sovereign/parts/footer.html`
- `wordpress/theme-gema-sovereign/style.css`

Validación:

- Home, GEMA Negocios, IA Productiva, Gestión, Marketing y Competencia respondieron `200 OK`.
- Se verificaron enlaces internos de módulos/comparativas.

### 2026-06-05 - Área de Comparativas ERP Cumbre

Objetivo:
Crear un área SEO de comparativas técnicas entre ERP Cumbre y competidores, por tier, módulo y vertical.

Cambios:

- Creada página índice `/competencia`.
- Creadas comparativas por tiers:
  - Cumbre CRM vs HubSpot/Salesforce
  - Cumbre ERP Negocios vs Tango Factura/Facturante
  - Cumbre ERP PyMEs vs Tango/Bejerman/Odoo
  - Cumbre Empresas vs SAP/NetSuite
- Creadas comparativas por módulos:
  - Facturador
  - Compras
  - Ventas
  - Personal
  - Tesorería
  - Marketing
  - Automatizaciones
  - Web
  - eCommerce/Mercado Libre
- Creadas comparativas por verticales:
  - Kioscos
  - Resto
  - Depósitos WMS
  - Constructoras
  - Agro
  - Mercados
- Agregados links internos entre comparativas, ERP Cumbre y páginas de servicio.
- Agregadas referencias de autoridad cuando correspondía.

Archivos principales:

- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/style.css`

Validación:

- Páginas generadas desde PHP.
- Slugs revisados para evitar acentos en URLs.
- Producción sincronizada y cache limpiada.

### 2026-06-05 - Landing SEO ERP Cumbre

Objetivo:
Implementar el copy deck SEO del portal oficial ERP Cumbre.

Cambios:

- Reescrita la template `page-erp-cumbre.html`.
- Agregado hero con H1 comercial.
- Agregados tiers del “Edificio Cumbre”.
- Agregados submódulos funcionales.
- Agregadas verticales sectoriales.
- Agregada sección del cerebro multimodal.
- Agregados CTAs y keyword strips.
- Agregados meta title, description, keywords y schema para ERP Cumbre.
- Compatibilidad con Yoast y RankMath mediante filtros.

Archivos principales:

- `wordpress/theme-gema-sovereign/templates/page-erp-cumbre.html`
- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/style.css`

Validación:

- PHP validado.
- Producción regenerada.
- Meta tags y contenido verificados en URLs públicas.

### 2026-06-04 / 2026-06-05 - Revisión Ortográfica y Sincronización Producción

Objetivo:
Revisar ortografía general del sitio, corregir acentos y sincronizar WordPress local con producción.

Cambios:

- Correcciones generales de palabras visibles sin acento o mal escritas.
- Correcciones en:
  - `functions.php`
  - `gema-floating-agent.js`
  - `header.html`
  - `footer.html`
  - templates del theme
- Restaurados identificadores técnicos que habían recibido acentos por error.
- Corregidos slugs, variables y rutas:
  - `asset_version`
  - `$version`
  - URLs sin acentos
  - `politica-de-cookies`
- Actualizado `blogdescription` de producción para corregir título visible.

Problemas detectados y resueltos:

- Reemplazos masivos habían acentuado identifiers técnicos.
- Se hicieron pasadas específicas para revertir rutas, slugs y variables.
- `rsync --chown` no estaba disponible en macOS, se reemplazó por `rsync` más `chown` remoto.
- Algunos comandos de producción requirieron aprobación por seguridad.

Validación:

- PHP validado con `php -l`.
- Páginas regeneradas con WP-CLI.
- Cache limpiada.
- URLs verificadas en producción.

### 2026-06 - Agente IA Web, Leads y WordPress Sync

Objetivo:
Implementar y probar el agente flotante de IA, persistencia de leads y sincronización automática hacia WordPress.

Cambios backend:

- Agregado endpoint público `/gema-agent/public/web-agent/chat`.
- Integración con Portkey/LiteLLM mediante gateway configurable.
- Fallback local guiado cuando gateway IA no responde.
- Extracción robusta de campos de lead:
  - nombre
  - teléfono
  - email
  - empresa
  - necesidad
- Persistencia de leads en API.
- Sincronización de leads a WordPress como custom post type `gema_lead`.
- Configuración CORS para widget público.

Archivos backend principales:

- `app/config.py`
- `app/agent.py`
- `app/main.py`
- `app/wordpress.py`
- `deploy/docker-stack.gema-agent.yml`
- `test_agent_api.py`
- `ACTIVACION_API_PRODUCCION.md`

Cambios frontend:

- Ajustes en `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`.
- Correcciones de respuestas guiadas del agente.
- Pruebas simulando clientes interesados.

Problemas detectados:

- Portkey devolvía `401 Incorrect API key provided: undefined`.
- Diagnóstico: falta de provider key configurada en gateway externo.
- WordPress sync falló inicialmente por credenciales no configuradas.
- Se corrigió despliegue de `wordpress.py` y secreto de application password.

Validación:

- Tests de endpoint público.
- Pruebas de conversación y extracción de leads.
- Verificación de persistencia y sincronización WordPress.

### 2026-06 - WhatsApp / Evolution API

Objetivo:
Preparar handoff por WhatsApp y pruebas de integración con Evolution API.

Cambios:

- Configurado número de WhatsApp humano en stack.
- Preparada lógica de handoff desde agente hacia WhatsApp.
- Creado script `recrear_instancia_qr.py`.
- Pruebas de instancias Evolution, QR y pairing code.

Archivos principales:

- `deploy/docker-stack.gema-agent.yml`
- `09-Apis-WhatsApp/evolution-infra/recrear_instancia_qr.py`

Problemas:

- QRs generados por Evolution API no vinculaban correctamente.
- Pairing code devolvía `null` o QR con `count: 0`.
- El problema se diagnosticó como externo a la lógica del sitio/API.

Estado:

- Handoff preparado.
- Vinculación QR de Evolution quedó pendiente por falla del proveedor/instancia.

### 2026-06 - Infraestructura VPS, Docker y Producción

Objetivo:
Desplegar backend y sitio WordPress en producción de forma segura.

Cambios:

- Configuración Docker/Docker Swarm para `gema_agent_api`.
- Traefik configurado para endpoint público.
- Manejo de secretos para WordPress Application Password.
- SSH y acceso remoto validados.
- Sincronización de theme a producción.
- Regeneración de páginas por WP-CLI.
- Cache flush posterior a despliegues.

Problemas resueltos:

- Secreto Docker faltante `gema_wordpress_app_password`.
- DNS/SSH requirieron permisos ampliados por sandbox.
- Alias SSH no resolvía; se usó IP de producción.
- Permisos de All-in-One WP Migration corregidos.

### 2026-06 - Contenido Base, Brand y SEO Inicial

Objetivo:
Construir base de marca, sitio WordPress y estructura SEO/GEO/SEM de GEMA Digital y ERP Cumbre.

Cambios:

- Desarrollo de lineamientos de marca.
- Logo kits para GEMA Digital y ERP Cumbre.
- Theme `theme-gema-sovereign`.
- Páginas institucionales:
  - Home
  - GEMA Negocios
  - IA Productiva
  - ERP Cumbre
  - Gestión
  - Tecnología
  - Integraciones
  - Contacto
  - Blog
  - Legales
- Estilos base, dark mode y assets visuales.
- Planes SEO/GEO/SEM documentados.

Archivos principales:

- `brand/guidelines/BRAND_GUIDELINES.md`
- `docs/SEO_GEO_SEM_PLAN.md`
- `docs/YOAST_SEO_PLAN.md`
- `docs/ARQUITECTURA.md`
- `wordpress/theme-gema-sovereign/*`

## Plugins WordPress de Producción

Estado observado:

- `all-in-one-wp-migration`: activo.
- `gema-leads-api`: activo.
- `wordpress-seo`: activo.
- `gema-payments-platform`: activo.
- `woocommerce`: instalado, inactivo.
- `woocommerce-mercadopago`: instalado, inactivo.
- `nave-for-woocommerce`: instalado, inactivo.
- `woocommerce-paypal-payments`: instalado, inactivo.
- `woocommerce-gateway-stripe`: instalado, inactivo.

## Pendientes Globales

- Antes del lanzamiento formal de marca GEMA/Cumbre:
  - Definir si Generadores Sur SRL, CUIT 33-71752891-9, será la titular definitiva de marcas, software, documentación y activos comerciales.
  - Iniciar búsqueda y registro de marcas ante INPI: `GEMA Digital`, `Cumbre`, `ERP Cumbre` y logos/nombres prioritarios.
  - Evaluar clases INPI mínimas: clase 42 para SaaS/software como servicio; clase 9 si hay app/software descargable; clase 35 si se protegen servicios comerciales/marketing/gestión.
  - Preparar depósito o registro del software Cumbre ante DNDA para obtener fecha cierta y prueba de autoría/titularidad.
  - Firmar cesiones de derechos patrimoniales con programadores, diseñadores, redactores, freelancers, agencias o colaboradores que hayan participado.
  - Firmar NDA/acuerdos de confidencialidad para proteger código, arquitectura, prompts, automatizaciones, documentación interna, know-how y estrategia comercial.
  - Presupuestar aranceles de INPI/DNDA y honorarios de abogado/agente de marcas antes de publicar la marca a gran escala.

- 2026-06-06: Inicio de investigación legal integral Cumbre.
  - Se revisaron las páginas legales actuales del sitio (`/terminos`, `/privacidad`, `/politica-de-cookies`) y se detectó que son útiles como base general, pero insuficientes para un SaaS modular con planes, trials, pagos, ARCA, IA y datos de clientes.
  - Se investigaron fuentes regulatorias iniciales: Ley 25.326/AAIP, transferencias internacionales de datos, Ley 24.240/Defensa del Consumidor, Disposición 954/2025 sobre Botón de Arrepentimiento/Baja, Ley 11.723/25.036 sobre software y derechos de autor, ARCA/facturación electrónica, BCRA/PSP, PCI DSS y Registro No Llame.
  - Se creó `docs/legal/CUMBRE_MAPA_LEGAL_Y_DOCUMENTAL.md` con la matriz legal/documental por plataforma y por módulo.
  - Se creó `docs/legal/CUMBRE_CHECKLIST_LEGAL_OPERATIVO.md` con acciones previas a contratación online, pagos, trial, ARCA, privacidad, IA y soporte.
  - Se creó `docs/legal/BORRADOR_TERMINOS_SERVICIO_CUMBRE.md` como base no definitiva de términos SaaS.
  - Se creó `docs/legal/BORRADOR_PRIVACIDAD_Y_DPA_CUMBRE.md` como base de política de privacidad Cumbre y acuerdo de tratamiento de datos.
  - Se creó `docs/legal/CUMBRE_ANEXOS_MODULOS_RIESGO.md` con anexos por módulo: ERP Negocios, CRM, Catálogo, Cobros/Pagos, Facturador ARCA, Stock/Depósito/WMS, Resto/Panadería, eCommerce, Marketing, IA, Panel e Integraciones.
  - Se deja constancia de que todo documento legal es borrador operativo y debe ser revisado por abogado, contador y especialista regulatorio antes de publicación o firma.

- 2026-06-06: Investigación legal profunda y blindaje de propiedad intelectual Cumbre/GEMA.
  - Se profundizó el análisis comparando prácticas legales visibles de Axoft/Tango, Tango Nexo, Bejerman/Thomson Reuters, Acont y otros modelos SaaS/ERP: licencia limitada, propiedad intelectual reservada, modalidad cloud/on-premise, privacidad separada, responsabilidad del cliente por datos, exportación/baja, suspensión por pago e integraciones de terceros.
  - Se consolidó un marco argentino aplicable: Ley 11.723/25.036 y DNDA para software; Ley 22.362/INPI para marcas; Ley 25.326/AAIP para datos personales; Resolución AAIP 47/2018 para seguridad; Ley 24.240 y contratación digital; Ley 25.506 para firma electrónica/digital; BCRA/PSP para pagos; PCI DSS para tarjetas; ARCA para facturación; Ley 26.951 No Llame; y lineamientos AAIP para IA responsable.
  - Se creó `docs/legal/CUMBRE_INFORME_LEGAL_PROFUNDO_2026.md` como informe ejecutivo y operativo con hallazgos, fuentes, comparativa de competidores, riesgos rojos y arquitectura documental recomendada.
  - Se creó `docs/legal/CUMBRE_MATRIZ_RIESGOS_LEGALES.md` con riesgos críticos, altos y medios, impacto, mitigaciones, responsables sugeridos y controles mínimos antes de vender online o pasar a producción con clientes.
  - Se creó `docs/legal/CUMBRE_CLAUSULAS_REFORZADAS_CONTRATOS.md` con cláusulas base para licencia SaaS, propiedad intelectual, datos del cliente, ARCA, pagos, tarjetas, IA, seguridad, disponibilidad, baja/exportación, comunicaciones, prohibiciones, limitación de responsabilidad, indemnidad, cambios y prueba de aceptación.
  - Se creó `docs/legal/CUMBRE_PLAN_BLINDAJE_LEGAL_PI.md` con fases de ejecución: identidad legal, versionado contractual, prueba de aceptación, inventario de activos, cesiones, NDA, registros INPI/DNDA, mapa de datos, subprocesadores, ARCA, pagos, IA y gobierno legal continuo.
  - Se reforzó el principio rector: GEMA/Cumbre debe proteger su propiedad intelectual sin quitar derechos al cliente sobre sus datos; debe vender funciones con alcances claros y sin prometer cumplimiento fiscal, seguridad, disponibilidad, IA o pagos por encima de lo técnicamente/regulatoriamente validado.

- 2026-06-06: Publicación web del centro legal Cumbre y datos societarios actuales.
  - Se incorporó el titular actual informado por dirección: Generadores Sur SRL, CUIT 33-71752891-9.
  - Se actualizaron las páginas públicas `/terminos` y `/privacidad` para identificar a Generadores Sur SRL como operador actual de GEMA Digital y Cumbre.
  - Se crearon y publicaron las nuevas páginas legales:
    - `/legal/cumbre`
    - `/legal/cumbre-terminos-servicio`
    - `/legal/cumbre-privacidad-dpa`
    - `/legal/cumbre-propiedad-intelectual`
    - `/legal/cumbre-pagos-arca-ia`
    - `/legal/cumbre-seguridad-baja`
    - `/legal/cumbre-comunicaciones-modulos`
  - Se agregaron enlaces cruzados entre páginas legales y un bloque específico de documentación legal Cumbre en el footer.
  - Se agregaron referencias de autoridad a fuentes oficiales o institucionales argentinas: AAIP, Ley de Datos Personales, DNDA, INPI/WIPO, BCRA, PCI, No Llame, Resolución AAIP 47/2018 y programa AAIP de IA responsable.
  - Se sincronizó el theme `gema-sovereign` a producción en `https://gema-digital.com`, previo backup remoto del theme en `/home/gema-digital.com/public_html/wp-content/themes/gema-sovereign-backup-before-legal-20260606210423.tar.gz`.
  - Se regeneraron las páginas con WP-CLI, se limpiaron rewrite rules y cache.
  - Validación pública: todas las URLs legales nuevas, `/terminos` y `/privacidad` respondieron HTTP 200 y contienen el CUIT `33-71752891-9`.

- 2026-06-06: MVP técnico del Centro de Estabilidad y Seguridad Cumbre.
  - Se implementó el modelo inicial de estabilidad para checks, eventos, recomendaciones, notificaciones y remediaciones en `cumbre/src/lib/stability/types.ts`.
  - Se agregó catálogo de targets críticos: WordPress público, centro legal, ERP Cumbre, Cumbre CRM, API del agente IA, Firestore, SSL, capacidad, seguridad y costos.
  - Se creó recolector de health checks en `cumbre/src/lib/stability/collector.ts`, con soporte inicial para HTTP, Firestore lectura/escritura y targets reservados para agente servidor.
  - Se agregó persistencia Firestore por tenant en `cumbre/src/lib/stability/store.ts`.
  - Se agregó motor de reglas en `cumbre/src/lib/stability/rules.ts` para convertir métricas en severidad, eventos y recomendaciones.
  - Se agregaron señales de seguridad en `cumbre/src/lib/stability/security.ts`: fuerza bruta, rate limits, fallos de autenticación y auditoría de reglas Firestore.
  - Se agregó agente IA determinístico en `cumbre/src/lib/stability/aiAgent.ts`, preparado para conectar un proveedor LLM real sin cambiar el panel.
  - Se agregaron notificaciones en `cumbre/src/lib/stability/notifications.ts`: panel activo, email/WhatsApp preparados como proveedores pendientes de configuración.
  - Se agregó remediación controlada en `cumbre/src/lib/stability/remediation.ts`, con allowlist y bloqueo de acciones sensibles que requieren aprobación humana.
  - Se agregó puente para métricas reales de servidor en `cumbre/src/lib/stability/serverAgent.ts`.
  - Se creó el dashboard React `cumbre/src/components/stability/StabilityDashboard.tsx` con estado general, checks, agente IA, notificaciones y remediación propuesta.
  - Se agregó el módulo `modulo_estabilidad_sre` al sidebar y al seed de matriz Cumbre.
  - Se documentó la arquitectura en `docs/CUMBRE_CENTRO_ESTABILIDAD_SEGURIDAD.md`.
  - Validación local: `npm --prefix cumbre run typecheck` ejecutó correctamente.

- 2026-06-06: Cumbre ERP Negocios publicado.
  - Se creó la landing SEO `/cumbre-erp-negocios` y se reemplazó la página genérica `/cumbre/negocios` con el mismo contenido completo.
  - Se posicionó Cumbre ERP Negocios como paquete económico de entrada para comercios de mostrador: kioscos, almacenes, mercados, restaurantes chicos, casas de comida, panaderías, verdulerías, carnicerías y depósitos simples.
  - Se separó claramente Cumbre CRM como tronco comercial B2B y Cumbre ERP Negocios como tronco operativo para venta inmediata, caja, stock, precios y reposición diaria.
  - Se incorporaron submódulos verticales: Kiosco Express, Mercado / Almacén, Resto, Depósito y Panadería / Comidas.
  - Se cargaron planes en USD con promo de lanzamiento 20% OFF, límites por plan, extras, add-ons, trial de 14 días, reglas de upgrade y preservación de datos.
  - Se agregó SEO específico: title, meta description, keywords naturales, FAQ SEO, schema `SoftwareApplication`, `Product` y `FAQPage`, imagen social `cumbre-erp-negocios-og.png`.
  - Se actualizó Yoast para el cluster `sistema POS para comercios` y se validó producción con `og:image` y `twitter:image`.
  - Se alineó el asistente web para recomendar `/cumbre-erp-negocios` ante consultas sobre kioscos, almacenes, POS, caja, stock, restaurantes chicos y mostrador.
  - Se actualizó localmente el backend del asistente con la misma separación; despliegue backend productivo sigue sujeto al acceso SSH/API pendiente.
  - Se verificó que la landing no contenga términos internos como Firebase, Firestore, tenant, workers, seeds o Bigtable, ni promesas de ARCA productivo abierto.

- 2026-06-06: Optimización Yoast SEO sitewide.
  - Se creó un módulo técnico `inc/seo-yoast.php` para sincronizar frases objetivo, sinónimos semánticos, title SEO, metadescripciones, Open Graph, Twitter Cards e imágenes sociales por página.
  - Se aplicaron metadatos Yoast a más de 100 páginas generadas del sitio: principales, Cumbre, pagos, comparativas, sectores, tecnología, IA e integraciones.
  - Se generó un set de imágenes sociales/avisos 1200x630 por cluster: GEMA, ERP Cumbre, Cumbre CRM, IA Productiva, Marketing, Pagos y Comparativas.
  - Se agregó el documento `docs/YOAST_SEO_ANALISIS_SEMANTICO.md` con análisis por cluster, frase objetivo, intención y variantes semánticas.
  - Se configuraron opciones globales de Yoast: nombre del sitio, descripción, separador, Open Graph, Twitter Cards y redes oficiales.
  - Se validó producción en Home, ERP Cumbre, Cumbre CRM, Marketing y Pagos con title, description, `og:image` y `twitter:image`.

- 2026-06-06: Cumbre CRM SEO avanzado publicado.
  - Se creó y desplegó el slug `/cumbre-crm` manteniendo compatibilidad con `/cumbre/crm`.
  - Se agregó Title SEO, meta description de conversión, keywords naturales, H1 único, H2/H3 orientados a intención de búsqueda, CTAs arriba/abajo y FAQ SEO.
  - Se incorporó schema `FAQPage`, `SoftwareApplication` y `Product`.
  - Se cuidó la comunicación de ARCA como demo comercial, piloto controlado o implementación asistida, sin prometer producción abierta.
  - Se alineó el asistente web para recomendar `/cumbre-crm` cuando el usuario consulta por CRM o portales Cumbre.
  - Se actualizó el footer para apuntar a `/cumbre-crm` y se verificó producción en `https://gema-digital.com/cumbre-crm/`.

- Conectar cuentas reales de pagos GEMA:
  - cuenta bancaria
  - Mercado Pago
  - Nave
  - PayPal
  - Stripe
- Configurar webhooks productivos con secretos reales.
- Definir flujo final de checkout y productos/servicios cobrables.
- Resolver vinculación estable de WhatsApp/Evolution API.
- Completar provider key de Portkey/LiteLLM para respuestas generativas reales.
- Mantener revisión ortográfica continua en nuevas páginas.
- Actualizar este registro con cada cambio futuro.

- 2026-06-07: Implementación comercial del módulo Cumbre Legal.
  - Se creó la landing SEO `/erp-cumbre/cumbre-legal` como módulo de gestión documental legal asistida por IA dentro del ecosistema ERP Cumbre.
  - Se definió el mensaje principal: creación, organización y control de documentos legales con IA, datos reales del negocio, fuentes normativas verificables y trazabilidad completa.
  - Se incorporó la aclaración obligatoria visible: Cumbre Legal no es un estudio jurídico, no reemplaza a un abogado matriculado y genera borradores asistidos por IA que deben ser revisados por un profesional habilitado antes de uso, firma, envío o presentación.
  - Se cargaron beneficios comerciales: borradores de contratos, acuerdos, NDAs, convenios, alquileres, documentos laborales, consultas guiadas, branding documental, checklist, vencimientos, historial, versiones, aprobaciones y almacenamiento configurable.
  - Se explicó el diferencial frente a herramientas genéricas: conexión al ERP, datos reales del cliente, plantillas versionadas, fuentes normativas, checklist, análisis de riesgo, historial documental, aprobaciones y panel de control.
  - Se agregaron planes comerciales: Legal Base, Legal Standard y Legal Full.
  - Se actualizó el catálogo de módulos, subdominios internos, interlinks, footer, landing principal de ERP Cumbre, Yoast SEO/canonical y asistente flotante para recomendar Cumbre Legal ante consultas sobre contratos, NDAs, acuerdos y documentación legal.
  - Se mantuvo separado el producto comercial `/erp-cumbre/cumbre-legal` del centro legal institucional `/legal/cumbre`.

- 2026-06-07: Implementación comercial del módulo Cumbre Stock.
  - Se creó la landing SEO `/erp-cumbre/cumbre-stock` como módulo de control de inventario agéntico para negocios, PyMEs y empresas.
  - Se definió el mensaje principal: Cumbre Stock controla inventario con IA, trazabilidad y aprobación humana.
  - Se incorporó el flujo de ingesta inteligente: PDFs, imágenes, remitos, facturas, planillas, emails, WhatsApp o escaneos; lectura por agente; detección de productos y cantidades; cotejo contra Cumbre Catálogo y saldos; propuesta de movimiento; aprobación humana antes de impactar stock.
  - Se cargaron beneficios comerciales: stock por depósito/local/tránsito/tercero, saldos actual/reservado/disponible/mínimo, entradas, salidas, reservas, liberaciones, transferencias, ajustes, lotes, vencimientos, conteos cíclicos, reportes y documentación local configurable.
  - Se agregaron alertas y notificaciones: bajo stock, stock negativo, reservas vencidas, lotes por vencer, conteos pendientes e ingestas pendientes de aprobación por panel, email o WhatsApp con opt-in.
  - Se definieron planes comerciales: Stock Base, Stock Standard y Stock Full.
  - Se documentaron guardrails visibles: el agente no impacta stock sin aprobación humana, todo movimiento conserva origen/documento/usuario/fecha/idempotencia, no duplica productos porque usa Cumbre Catálogo y no reemplaza Compras ni Facturador ARCA.
  - Se actualizó el catálogo de módulos, subdominios internos, interlinks, footer, landing principal de ERP Cumbre, Yoast SEO/canonical y asistente flotante para recomendar Cumbre Stock ante consultas sobre stock, inventario, depósitos, remitos, lotes, reservas y bajo stock.

- 2026-06-07: Preparación de Hermes Agent en VPS Hostinger.
  - Se ubicó el acceso SSH existente del VPS Hostinger `85.31.62.119` mediante usuario temporal `cursor-agent` y clave local segura.
  - Se auditó la infraestructura productiva sin detener servicios: Docker Swarm, Traefik, red `GeneraEnergiaNet`, n8n editor/webhook/worker, Evolution API, Redis, Postgres y `gema_agent_api`.
  - Se confirmó que n8n y Evolution corren separados en Swarm y que Hermes puede instalarse como stack independiente sin tocar esos servicios.
  - Se desplegó el stack `hermes` con imagen oficial `nousresearch/hermes-agent:latest`, volumen persistente `hermes_hermes_data`, red `GeneraEnergiaNet` y secret existente `gema_portkey_api_key`.
  - Se configuró Hermes para usar Portkey como endpoint OpenAI-compatible (`https://api.portkey.ai/v1`) con modelo base `gpt-4o-mini`, sin copiar la API key en documentos ni chats.
  - Se corrigió el arranque para respetar el entrypoint oficial de Hermes y el usuario interno `hermes` (`10000:10000`), evitando ejecución como root.
  - Estado actual: Hermes queda preparado y pausado (`hermes_agent=0`) hasta emparejar WhatsApp. Próximo paso: ejecutar `hermes whatsapp`, escanear QR desde el teléfono secundario y luego levantar el gateway.

- 2026-06-07: Implementación comercial de Tutoriales API Cumbre.
  - Se creó la landing SEO `/erp-cumbre/tutoriales-api-cumbre` como capa transversal de ERP Cumbre para guiar conexiones externas sin conocimientos técnicos avanzados.
  - Se definió el mensaje principal: conectar plataformas externas a Cumbre con guías claras, seguras y paso a paso.
  - Se explicaron el problema y la solución: APIs externas requieren aplicaciones, permisos, tokens, webhooks y certificados; Cumbre acompaña con tutoriales, checklists, pruebas de conexión y errores frecuentes.
  - Se cargaron cards iniciales para Mercado Libre, Mercado Pago, WooCommerce, Google Merchant, ARCA, WhatsApp Business y WordPress.
  - Se incorporaron guardrails de seguridad: no guardar secretos en Firestore ni bases visibles, no pedir claves por chat, separación entre test y producción, credencial_ref, Secret Manager o equivalentes, rotación recomendada y validación backend.
  - Se agregó el flujo de uso: elegir plataforma, ver tutorial, seguir checklist, cargar o autorizar credencial segura, probar desde backend y mostrar estado conectado, pendiente, error o requiere reautorización.
  - Se actualizó catálogo de módulos, subdominios internos, interlinks, footer, landing principal de ERP Cumbre, Yoast SEO/canonical y asistente flotante para recomendar Tutoriales API ante consultas sobre APIs, tokens, credenciales, webhooks e integraciones externas.

- 2026-06-07: Inicio del sistema visual profesional de la plataforma Cumbre.
  - Se ajustó la dirección visual de Cumbre para que acompañe la estética de GEMA Digital sin copiar literalmente la web: oscuro profesional, acentos emerald/cyan, superficies sobrias, estados claros y foco operativo.
  - Se documentó la diferencia entre la web GEMA y la plataforma Cumbre: la web vende y posiciona; el panel opera con datos, permisos, alertas, consumo, aprobaciones, integraciones y reportes.
  - Se actualizó `docs/CUMBRE_SISTEMA_VISUAL.md` con principios, relación web/plataforma, regla común por módulo, tonos visuales y extensión futura.
  - Se amplió `CumbreDesignSystem` con principios visuales, superficie base común y catálogo modular que incluye CRM, Negocios, ERP PyMEs, Empresas, Cobros, Stock, Facturador ARCA, Legal, Tutoriales API y Estabilidad.
  - Se actualizó `CumbreCommandCenter` como pantalla base del entorno Cumbre, con narrativa de continuidad GEMA -> Cumbre, shell SaaS, KPIs visuales y señales del sistema.
  - Se renovó el Canvas `cumbre-platform-preview.canvas.tsx` para mostrar una preview visual de plataforma: sidebar, reglas de estética, módulos con personalidad propia, componentes base y diferencia entre sitio comercial y panel operativo.
  - Validación: `npm --prefix cumbre run typecheck` ejecutado correctamente.

- 2026-06-07: Implementación comercial del módulo Cumbre Compras.
  - Se creó la landing SEO `/erp-cumbre/cumbre-compras` como módulo de ERP Cumbre para gestionar proveedores, solicitudes de reposición, órdenes de compra y recepción de mercadería conectada a Stock, Catálogo, ventas, eCommerce y Mercado Libre.
  - Se definió el mensaje principal: “Comprá mejor, reponé a tiempo y evitá quedarte sin stock”.
  - Se incorporó el problema comercial: comprar tarde, mal o sin control genera quiebres de stock, pérdida de ventas, pérdida de margen y administración confusa.
  - Se explicó el flujo operativo: señal de reposición, solicitud de compra, aprobación, orden de compra, envío al proveedor, recepción y actualización de Stock.
  - Se cargaron capacidades: proveedores, solicitudes de reposición, comparador de proveedores, órdenes de compra, recepción parcial o total, impacto en Stock solo con recepción aprobada e integración PyMEs.
  - Se incorporó poder agéntico con guardrail obligatorio: el agente analiza bajo stock, ventas aceleradas, marketplaces y rotación por canal, pero ninguna compra sugerida por IA se envía automáticamente sin revisión y aprobación humana.
  - Se agregaron guardrails de control: no se crean productos paralelos porque todo usa Catálogo, no se emiten órdenes sin aprobación cuando la política lo requiere, no se impacta stock sin recepción aprobada y cada solicitud/orden/recepción queda trazada con idempotencia.
  - Se actualizó catálogo de módulos, subdominios internos, interlinks, footer, landing principal de ERP Cumbre, Yoast SEO/canonical, asistente flotante, sistema visual Cumbre y preview visual de plataforma para incluir Cumbre Compras.

- 2026-06-07: Refinamiento visual de plataforma Cumbre con movimiento y gráficas.
  - Se refinó `cumbre-platform-preview.html` para sumar movimiento sutil por sectores: entrada progresiva, hover de navegación, cards y módulos, nodos pulsantes y barras animadas.
  - Se agregaron gráficas operativas a la preview: demanda por canal para Compras, flujo activo venta -> reposición -> aprobación -> recepción y composición visual del panel por áreas funcionales.
  - Se mantuvo selector día/noche y se agregó soporte `prefers-reduced-motion` para reducir animaciones si el usuario lo configura en el sistema.
  - Se actualizó `cumbre-platform-preview.canvas.tsx` con una versión de gráficas operativas usando `UsageBar` y tablas de señales/flujo.
  - Se documentaron reglas de movimiento y gráficas en `docs/CUMBRE_SISTEMA_VISUAL.md`: el movimiento debe mostrar estado, riesgo y próxima acción, no decorar sin sentido.
  - Validación: `npm --prefix cumbre run typecheck` ejecutado correctamente.

- 2026-06-07: Estándar de microinteracciones para toda la plataforma Cumbre.
  - Se confirmó que el movimiento hover de botones, navegación, badges y cards debe implementarse en toda la plataforma Cumbre como parte del sistema visual base.
  - Se agregaron clases reutilizables en `CumbreDesignSystem`: `cumbreInteractiveMotionClass`, `cumbreSubtleMotionClass` y `cumbreNavMotionClass`.
  - Se aplicó `cumbreInteractiveMotionClass` a botones y cards accionables existentes para que los nuevos componentes hereden elevación leve, escala sutil y estado active.
  - Se actualizó `docs/CUMBRE_SISTEMA_VISUAL.md` con reglas específicas: botones suben y escalan apenas, navegación lateral se desplaza horizontalmente, cards se elevan, badges se mueven con menor intensidad y todo debe respetar `motion-reduce`.

- 2026-06-07: Implementación comercial del módulo Cumbre Tesorería.
  - Se creó la landing SEO `/erp-cumbre/cumbre-tesoreria` como módulo financiero de ERP Cumbre para controlar cuentas bancarias, billeteras virtuales, caja, movimientos, conciliaciones, pagos a proveedores y cashflow.
  - Se definió el mensaje principal: “Controlá el dinero real de tu empresa, conciliá movimientos y anticipá tu cashflow”.
  - Se incorporó el problema comercial: bancos dispersos, conciliaciones manuales, caja separada y falta de visibilidad real del cashflow.
  - Se explicó la solución: Tesorería conectada al ERP con bancos, billeteras, caja, cobros, compras, ventas, pagos, facturas y documentos administrativos.
  - Se cargó el bloque “preparado para bancos argentinos”: APIs bancarias, agregadores y extractos CSV/XLSX/OFX/PDF según disponibilidad técnica, banco, proveedor y alcance.
  - Se agregó el flujo: banco o extracto, movimiento, conciliación, aprobación y cashflow actualizado.
  - Se incorporaron guardrails de seguridad: no pedir passwords de home banking, no guardar credenciales sensibles en claro, usar referencias seguras tipo Secret Manager, conciliación asistida con confirmación humana y pagos a proveedores con aprobación.
  - Se aclaró que el cashflow proyectado es una estimación operativa, no una garantía financiera.
  - Se actualizaron catálogo de módulos, subdominios internos, footer, landing principal de ERP Cumbre, Yoast SEO/canonical, asistente flotante, sistema visual Cumbre y estilos responsive/dark mode.

- 2026-06-07: Implementación comercial del módulo Cumbre Contabilidad.
  - Se creó la landing SEO `/erp-cumbre/cumbre-contabilidad` como módulo contable de ERP Cumbre para transformar ventas, compras, cobros, pagos y movimientos en información contable ordenada, trazable y revisable.
  - Se definió el mensaje principal: “Convertí ventas, compras, cobros, pagos y movimientos en contabilidad clara, trazable y lista para revisar con tu contador”.
  - Se incorporó el guardrail comercial obligatorio: Cumbre Contabilidad no reemplaza al contador ni promete contabilidad automática sin revisión profesional; prepara datos, asientos, libros y reportes para trabajar mejor con el contador o responsable.
  - Se explicó la diferencia con Cumbre Tesorería: Tesorería controla dinero real, bancos, caja, pagos, conciliaciones y cashflow; Contabilidad ordena el registro formal con cuentas contables, asientos, libros, cierres, balances y reportes.
  - Se cargaron funcionalidades: plan de cuentas jerárquico, asientos desde operaciones del ERP, estados borrador/validado/definitivo, revisión humana, cierres mensuales, Libro Diario, Mayor, IVA Compras, IVA Ventas, sumas/saldos, reportes de balance, estado de resultados, IVA, centros de costo y exportación para contador.
  - Se agregó el flujo operativo: documento/cobro/pago/movimiento, asiento borrador, revisión, asiento definitivo, cierre, libros y reportes.
  - Se definieron planes comerciales: Contabilidad Base, Contabilidad Standard y Contabilidad Full.
  - Se actualizaron catálogo de módulos, subdominios internos, interlinks, footer, landing principal de ERP Cumbre, Yoast SEO/canonical, asistente flotante, sistema visual Cumbre, documentación visual y estilos responsive/dark mode.

- 2026-06-07: Implementación comercial del módulo Cumbre Impuestos.
  - Se creó la landing SEO `/erp-cumbre/cumbre-impuestos` como módulo fiscal de ERP Cumbre para ordenar IVA, IIBB, retenciones, percepciones, vencimientos, posiciones fiscales y reportes.
  - Se definió el mensaje principal: “Mantené tus impuestos ordenados, con posiciones fiscales trazables y vencimientos claros para revisar con tu contador”.
  - Se incorporó el guardrail obligatorio: Cumbre Impuestos no reemplaza al contador, no presenta impuestos automáticamente y no promete criterio fiscal definitivo sin revisión profesional.
  - Se explicó la diferencia con otros módulos: Facturador ARCA emite comprobantes; Contabilidad registra asientos, libros y cierres; Tesorería paga obligaciones y muestra cashflow; Impuestos arma posiciones fiscales, vencimientos y reportes.
  - Se cargaron funcionalidades: posición IVA por período, IIBB por jurisdicción, retenciones, percepciones, saldos a pagar, saldos a favor, calendario fiscal, vencimientos vinculados a Tesorería, reportes exportables y alertas.
  - Se agregó el flujo operativo: comprobante/documento/cobro/pago, movimiento fiscal, posición fiscal, revisión contador, vencimiento, pago Tesorería y reporte.
  - Se definieron planes comerciales: Impuestos Base, Impuestos Standard e Impuestos Full.
  - Se actualizaron catálogo de módulos, subdominios internos, interlinks, footer, landing principal de ERP Cumbre, Yoast SEO/canonical, asistente flotante, sistema visual Cumbre, previews visuales, documentación y estilos responsive/dark mode.

- 2026-06-07: Implementación comercial del módulo Cumbre Reportes BI.
  - Se creó la landing SEO `/erp-cumbre/cumbre-reportes-bi` como capa gerencial de Cumbre ERP para dashboards, KPIs, alertas ejecutivas y reportes gerenciales.
  - Se definió el mensaje principal: “Dashboards, KPIs y alertas para ver tu empresa en tiempo real”.
  - Se explicó el problema comercial: datos repartidos en planillas, sistemas, bancos, ventas, stock, impuestos y contabilidad sin una vista ejecutiva confiable.
  - Se incorporó el guardrail principal: Reportes BI no duplica datos ni reemplaza módulos fuente; toma referencias, snapshots e indicadores desde CRM, Ventas, Cobros, Stock, Compras, Tesorería, Contabilidad, Impuestos, eCommerce y Mercado Libre.
  - Se cargaron funcionalidades: dashboards ejecutivos, KPIs por período, alertas inteligentes, reportes PDF/Excel/CSV, series históricas, indicadores financieros/comerciales/fiscales/operativos y vistas para dirección, administración y gerencia.
  - Se agregaron alertas ejecutivas para stock crítico, caída de ventas, vencimientos fiscales, desvíos de caja, cobranzas pendientes y márgenes en baja, con revisión humana para acciones críticas.
  - Se definieron planes comerciales: Reportes BI Base, Reportes BI Standard y Reportes BI Full.
  - Se documentaron diferenciales: no duplicación de datos, roles y permisos, exportaciones trazables, KPIs con origen verificable, integración Bigtable para históricos avanzados e IA con control humano.
  - Se actualizaron catálogo de módulos, subdominios internos, interlinks, footer, landing principal de ERP Cumbre, Yoast SEO/canonical, asistente flotante, sistema visual Cumbre, previews visuales, documentación y estilos responsive/dark mode.

- 2026-06-07: Implementación comercial del módulo Cumbre Planificación y Proyecciones.
  - Se creó la landing SEO `/erp-cumbre/cumbre-planificacion` como módulo económico-financiero de Cumbre ERP para presupuestos internos, escenarios, forecast de caja y comparativo real vs plan.
  - Se definió el mensaje principal: “Planificá el futuro de tu empresa con datos reales”.
  - Se explicó el problema: planillas desconectadas, datos desactualizados y planificación sin relación clara con caja real, impuestos, compras y ventas.
  - Se incorporó la diferencia obligatoria con CRM: los presupuestos comerciales sirven para vender; Cumbre Planificación sirve para dirigir, proyectar ingresos, egresos, impuestos, inversiones, caja y resultados futuros.
  - Se cargaron funcionalidades: presupuestos mensuales/trimestrales/anuales, rubros de ingresos/costos/gastos/impuestos/inversiones/financieros, escenarios base/optimista/pesimista/estrés, cashflow proyectado, forecast IA, real vs plan, desvíos, alertas y exportación de planes/reportes.
  - Se integró con Ventas, Compras, Tesorería, Contabilidad, Impuestos, Stock y Reportes BI, manteniendo referencias a módulos fuente para trazabilidad.
  - Se agregaron guardrails: no duplicar información operativa, plan aprobado con usuario responsable, escenarios de estrés con revisión humana, cashflow matemáticamente consistente, comparativos con origen real verificable y desvíos trazables.
  - Se definieron planes comerciales: Planificación Base, Planificación Standard y Planificación Full.
  - Se actualizaron catálogo de módulos, subdominios internos, interlinks, footer, landing principal de ERP Cumbre, Yoast SEO/canonical, asistente flotante, sistema visual Cumbre, previews visuales, documentación y estilos responsive/dark mode.

- 2026-06-08: Implementación técnica inicial de Cumbre Marketing Insignia.
  - Se creó el contrato `shared/marketing.ts` en el proyecto Cumbre ERP para formalizar planes, add-ons, configuración tenant, perfiles sociales, contenidos, calendario, campañas, briefs orgánicos, métricas, paths, billing e idempotencia.
  - Se conectó `Cumbre Marketing` con `ModuloBilling` para límites de campañas, piezas sociales, perfiles, briefs orgánicos y publicación por API oficial.
  - Se agregó seed demo en `seed/matriz-cumbre.seed.json`: catálogo público, planes, add-ons, suscripción trial para `tenant_holdings_sur`, configuración, perfil social, contenido aprobado, publicación programada, campaña multicanal, brief SEO y métrica estimada.
  - Se sumaron validaciones en `scripts/test-domain-contracts.ts` para evitar publicación por API sin `credencial_ref`, aprobación humana ausente, campañas sin consentimiento, datos sensibles en contenido social, copyright no declarado y métricas estimadas marcadas como ventas reales.
  - Se actualizó `docs/BLUEPRINT_CUMBRE_MARKETING.md` y `docs/REGISTRO_AVANCE_PROYECTO.md` para registrar que el módulo ya tiene contrato y seed técnico, además del blueprint comercial y prompt web.

- 2026-06-08: Auditoría aplicada a Cumbre Marketing Insignia.
  - Se reforzó el contrato para exigir redes soportadas en configuración y evitar secciones duplicadas del panel.
  - Se bloqueó cualquier credencial social que no use referencia segura `secret://`, incluso cuando el perfil todavía no publique por API.
  - Se exigieron permisos declarados para perfiles conectados.
  - Se agregó `evidencia_publicacion_ref` para publicaciones manuales marcadas como publicadas.
  - Se agregó `consentimiento_origen_ref` obligatorio en campañas para auditar opt-in, base legal o segmento autorizado.
  - Se actualizó seed, pruebas de contratos, blueprint y prompt web con estos guardrails.

- 2026-06-08: Organización de arquitectura faseada Cumbre antes de continuar módulos.
  - Se decidió no intentar construir módulos insignia como bloques únicos desde el inicio.
  - Se agregó `docs/ARQUITECTURA_FASEADA_CUMBRE.md` en el proyecto Cumbre ERP como documento rector de construcción: núcleo multi-tenant, Matriz/Billing, seguridad/auditoría, Brainstore, workers backend, módulos base, integraciones, verticales e IA avanzada.
  - Se actualizó `docs/ARQUITECTURA.md` y `docs/ROADMAP.md` para reflejar que el ERP debe avanzar primero por plataforma operable: roles, permisos, panel general, billing, router por Matriz, Secret Manager, workers y Tutoriales API.
  - Se registró que `Cumbre Marketing` queda dividido en fase operable sin APIs complejas, fase de integraciones oficiales y fase de automatización avanzada.

- 2026-06-08: Cierre conceptual y prompt web de Cumbre Core Plataforma.
  - Se creó `docs/BLUEPRINT_CUMBRE_CORE_PLATAFORMA.md` en el proyecto Cumbre ERP para formalizar el núcleo SaaS operable: tenant, usuarios, roles, permisos, Matriz, billing, panel, trial, pagos, auditoría, telemetría e integraciones.
  - Se generó `docs/cumbre-landing-prompts/cumbre-core-plataforma.md` como prompt web de página de confianza/plataforma.
  - Se actualizó `docs/cumbre-landing-prompts/ESTADO_CADENA.md` con la nueva cadena arquitectura/plataforma y la regla de que cada módulo, capa o vertical cerrada debe tener prompt web.
  - No se publicó, no se desplegó y no se tocó producción.

- 2026-06-08: Cierre conceptual y prompt web de Cumbre Matriz y Billing.
  - Se creó `docs/BLUEPRINT_CUMBRE_MATRIZ_BILLING.md` en el proyecto Cumbre ERP para formalizar activación modular, planes, add-ons, trial, pagos, límites, funciones bloqueadas y acceso real por tenant.
  - Se generó `docs/cumbre-landing-prompts/cumbre-matriz-billing.md` como prompt web de página de confianza sobre ERP modular, trial de 14 días, billing y permisos.
  - Se actualizó `docs/BLUEPRINT_MAESTRO.md` y `docs/cumbre-landing-prompts/ESTADO_CADENA.md`.
  - Se reforzó la decisión de no ejecutar backend ni automatizaciones externas si el módulo no está habilitado, suspendido o con dependencias faltantes.

- 2026-06-08: Ampliación de Cumbre Marketing Orgánico SEO/SEM/GEO.
  - Se tomó como requisito que el submódulo `Cumbre Marketing Orgánico` aspire a cubrir prestaciones de nivel Semrush y Surfer SEO.
  - Se creó `docs/BLUEPRINT_CUMBRE_MARKETING_ORGANICO.md` con alcance de keyword research, análisis competitivo, auditoría técnica, content editor, GEO/AI Search, SEM asistido, tracking, BI y conexión con ventas reales.
  - Se generó `docs/cumbre-landing-prompts/cumbre-marketing-organico.md` como prompt web separado para futura landing/subdominio.
  - Se actualizó el blueprint y prompt general de `Cumbre Marketing` para reflejar esta ampliación.
  - Se registraron guardrails: no prometer rankings/tráfico/ventas garantizadas, no presentar estimaciones como datos exactos, no copiar contenido de competidores, no scrapear contra términos de uso y usar `credencial_ref` para integraciones Google/proveedores.
  - Se agregó alcance explícito para herramientas gratuitas/oficiales: Google Search Console, GA4, Google Tag Manager, PageSpeed Insights, Google Business Profile, Google Ads Keyword Planner y Looker Studio.
  - Se definió que GTM debe contemplar etiquetas, eventos, conversiones, pixels, consent mode, triggers y variables, siempre con aprobación del cliente y privacidad documentada.

- 2026-06-08: Auditoría aplicada a Cumbre Marketing Orgánico.
  - Se corrigió el alcance para que Google Ads Keyword Planner quede como integración prioritaria.
  - Se actualizó `BLUEPRINT_TUTORIALES_API_CUMBRE.md` para incluir tutoriales/checklists de Search Console, GA4, GTM, PageSpeed Insights, Business Profile, Keyword Planner y Looker Studio dentro de Marketing.
  - Se reforzó privacidad para GTM: consentimiento, política visible, Consent Mode cuando corresponda y objetivo documentado antes de instalar etiquetas, pixels o conversiones.
  - Se agregó el guardrail de no mezclar métricas de laboratorio de PageSpeed con datos reales de campo.

- 2026-06-08: Política Google Workspace y ownership para Cumbre.
  - Se definió que Search Console, GA4, GTM, Ads, Business Profile, Merchant/YouTube si aplica y Looker Studio deben quedar bajo propiedad del cliente.
  - Google Workspace queda como recomendación profesional fuerte para empresas sin dominio, email corporativo, usuarios separados, 2FA o gobierno de accesos.
  - Workspace no se vuelve obligatorio para usar todo Cumbre; se recomienda para operar correctamente el ecosistema Google.
  - Gema Digital puede actuar como implementador o administrador delegado, pero no como owner principal de activos críticos del cliente.

- 2026-06-08: Cierre conceptual de Cumbre Seguridad y Auditoría.
  - Se creó `docs/BLUEPRINT_CUMBRE_SEGURIDAD_AUDITORIA.md` como capa transversal de roles, permisos, tenant, secretos, aprobaciones, auditoría e implementadores autorizados.
  - Se generó `docs/cumbre-landing-prompts/cumbre-seguridad-auditoria.md` como prompt web de confianza para explicar seguridad, trazabilidad y gobierno operativo.
  - Se actualizó `docs/cumbre-landing-prompts/ESTADO_CADENA.md`, `docs/BLUEPRINT_MAESTRO.md` y `docs/ROADMAP.md`.
  - Se auditó producto/SEO/legal/seguridad/integraciones: no se promete seguridad absoluta, no se guarda secreto en claro, no se confía en flags de UI y toda acción crítica debe quedar auditada.
  - Se agregó nota posterior de auditoría: los roles/permisos ampliados son objetivo de arquitectura y requieren ampliar `shared/tenantAccess.ts` antes de considerarse disponibles.

- 2026-06-08: Cierre conceptual de Cumbre Prospección B2B.
  - Se creó `docs/BLUEPRINT_CUMBRE_PROSPECCION_B2B.md` como módulo de social selling, outbound inteligente y generación de reuniones conectado a CRM, Marketing, Ventas y BI.
  - Se generó `docs/cumbre-landing-prompts/cumbre-prospeccion-b2b.md` como prompt web completo para landing comercial.
  - Se definió el enfoque correcto: no ser un bot agresivo de LinkedIn, sino prospección B2B asistida con IA, control humano, trazabilidad y automatización responsable.
  - Se auditó producto/SEO/legal/seguridad/integraciones: no prometer reuniones garantizadas, no scraping indebido, no automatización ilimitada de LinkedIn, email con opt-out/reputación, permisos, `credencial_ref`, idempotencia y aprobación humana.
  - Se actualizó `docs/cumbre-landing-prompts/ESTADO_CADENA.md`, `docs/BLUEPRINT_MAESTRO.md`, `docs/ROADMAP.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Se aplicó nota posterior de auditoría: lista de supresión/no-contactar obligatoria y email outbound con SPF/DKIM/DMARC, límites diarios, rebotes, quejas de spam y pausa por reputación.

- 2026-06-08: Cierre conceptual de Cumbre Backend, Workers e Integraciones Seguras.
  - Se creó `docs/BLUEPRINT_CUMBRE_BACKEND_WORKERS_INTEGRACIONES.md` como capa de plataforma para Cloud Run/API Gateway, workers, webhooks, OAuth, Secret Manager, colas, reintentos, dead letters e idempotencia.
  - Se generó `docs/cumbre-landing-prompts/cumbre-backend-workers-integraciones.md` como prompt web de confianza técnica.
  - Se actualizó `docs/BLUEPRINT_MAESTRO.md`, `docs/cumbre-landing-prompts/ESTADO_CADENA.md`, `docs/ROADMAP.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Se auditó producto/SEO/legal/seguridad/integraciones: no ejecutar acciones sensibles desde frontend, no guardar secretos en claro, no aceptar webhooks sin validación, no reintentar operaciones no idempotentes y no prometer disponibilidad total de APIs externas.

- 2026-06-08: Implementación del Plan Maestro de Ejecución Cumbre.
  - Se creó `docs/PLAN_MAESTRO_EJECUCION_CUMBRE.md` como índice operativo de ejecución para ERP Cumbre.
  - Se crearon `docs/INVENTARIO_EJECUCION_CUMBRE.md`, `docs/DEMO_FUNCIONAL_INTERNA_CUMBRE.md`, `docs/COMPUERTAS_EJECUCION_CUMBRE.md`, `docs/ORDEN_TECNICO_MODULOS_BASE_CUMBRE.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` y `docs/CRITERIOS_BETA_CERRADA_CUMBRE.md`.
  - Se definió que el avance real se mide por contratos, seed, validadores, UI mínima, workers/mocks, demo interna y flujos end-to-end, no por cantidad de blueprints.
  - Se fijó el orden eficiente: fundación técnica, demo interna, integraciones reales controladas y beta cerrada antes de venta.
  - Se actualizaron `docs/ARQUITECTURA_FASEADA_CUMBRE.md`, `docs/BLUEPRINT_MAESTRO.md`, `docs/ROADMAP.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.

- 2026-06-08: Filosofía de construcción tipo edificio para Cumbre.
  - Se creó `docs/FILOSOFIA_CONSTRUCCION_CUMBRE.md` para formalizar que Cumbre se construye como una obra: arquitectura completa, cimientos, columnas, vigas, instalaciones, pisos funcionales, terminaciones, inspección interna y beta cerrada.
  - Se actualizó `docs/PLAN_MAESTRO_EJECUCION_CUMBRE.md`, `docs/ARQUITECTURA_FASEADA_CUMBRE.md`, `docs/COMPUERTAS_EJECUCION_CUMBRE.md`, `docs/BLUEPRINT_MAESTRO.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Se estableció que primero se termina bien la arquitectura y luego comienza la ingeniería por cimientos sólidos auditados, sin avanzar a módulos vistosos si la estructura no soporta el peso.

- 2026-06-08: Primer cimiento técnico de Cumbre.
  - Se amplió `shared/tenantAccess.ts` con roles y permisos granulares para seguridad real.
  - Se creó `shared/securityAudit.ts` para aprobaciones humanas y acciones críticas auditadas.
  - Se creó `shared/backendWorkers.ts` para integraciones externas, jobs backend, webhooks, errores normalizados, idempotencia y paths por tenant.
  - Se agregó seed demo de miembros, implementador, aprobación, auditoría, integración, job, error y webhook en `seed/matriz-cumbre.seed.json`.
  - Se extendió `scripts/test-domain-contracts.ts` con validaciones positivas y negativas de los nuevos cimientos.
  - Se actualizaron `docs/INVENTARIO_EJECUCION_CUMBRE.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck` y `npm run test:rules` sin errores.

- 2026-06-08: Segundo cimiento técnico de Cumbre.
  - Se creó `shared/backendWorkerRuntime.ts` con mock local de workers, reintentos, backoff, errores normalizados y transición a dead letter.
  - Se creó `src/components/CumbreOperationsPanel.tsx` y se agregó la vista `Operaciones P0` en `src/App.tsx`.
  - Se amplió `seed/matriz-cumbre.seed.json` con casos demo de job pendiente, reintento, dead letter, timeout y auth vencida.
  - Se extendió `scripts/test-domain-contracts.ts` para validar runtime de workers, éxito, reintento, dead letter y límite de intentos.
  - Se actualizaron `docs/INVENTARIO_EJECUCION_CUMBRE.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck` y `npm run test:rules` sin errores.

- 2026-06-08: Tercer cimiento técnico de Cumbre.
  - Se amplió `shared/backendWorkerRuntime.ts` con plan de persistencia para job, error normalizado y dead letter.
  - Se creó `src/lib/backendWorkerTools.ts` para preparar y ejecutar jobs persistentes en Firestore/emulador con transacción y auditoría.
  - Se conectó `src/components/CumbreOperationsPanel.tsx` a acciones persistentes: preparar job, ejecutar OK, persistir timeout/reintento, persistir dead letter y reiniciar.
  - Se extendió `scripts/test-domain-contracts.ts` para validar el plan de escrituras persistentes.
  - Se actualizaron `docs/INVENTARIO_EJECUCION_CUMBRE.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Cuarto cimiento técnico de Cumbre.
  - Se agregó `cumbreBackendJobRunner` en `functions/src/index.ts` como trigger backend seguro para `jobs_backend/{jobId}`.
  - Se amplió `shared/backendWorkerRuntime.ts` con `canRunBackendJobNow` para procesar solo jobs pendientes y vencidos.
  - El trigger escribe en transacción job final, error normalizado, dead letter y auditoría, sin conectar proveedores externos.
  - Se extendió `scripts/test-domain-contracts.ts` con pruebas de elegibilidad de cola.
  - Se actualizaron `docs/INVENTARIO_EJECUCION_CUMBRE.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Quinto cimiento técnico de Cumbre.
  - Se amplió `shared/backendWorkers.ts` con contratos `BackendWorkerMetric` y `BackendWorkerAlert`.
  - Se amplió `shared/backendWorkerRuntime.ts` para que el plan de persistencia escriba métricas y alertas operativas junto al job/error/dead letter.
  - Se conectó `src/components/CumbreOperationsPanel.tsx` a lecturas realtime de job persistente, métrica, alerta y error normalizado.
  - Se extendió `scripts/test-domain-contracts.ts` con validaciones de métricas, alertas y paths de observabilidad.
  - Se actualizaron `docs/INVENTARIO_EJECUCION_CUMBRE.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Sexto cimiento técnico de Cumbre.
  - Se creó `shared/backendWorkerConnectors.ts` con registro seguro de conectores por dominio/proveedor.
  - Se definió `BackendWorkerConnectorDefinition` y guardrail de `mock_seguro` con `permite_ejecucion_real: false`.
  - Se conectó `functions/src/index.ts` al registro mediante `resolveConnectorOutcome`, sin conectar APIs externas.
  - Se extendió `scripts/test-domain-contracts.ts` con pruebas de definición, resolución, outcomes permitidos y bloqueo de ejecución real.
  - Se actualizaron `docs/INVENTARIO_EJECUCION_CUMBRE.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Séptimo cimiento técnico de Cumbre.
  - Se amplió `shared/backendWorkers.ts` con `BackendWorkerThresholdPolicy` y `BackendWorkerMetricSummary`.
  - Se amplió `shared/backendWorkerRuntime.ts` con `buildWorkerMetricSummary` y `createThresholdAlerts`.
  - Se extendió `scripts/test-domain-contracts.ts` con pruebas de resumen crítico, conteos, error rate, paths y alertas por umbral.
  - Se actualizaron `docs/INVENTARIO_EJECUCION_CUMBRE.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Octavo cimiento técnico de Cumbre.
  - Se agregó `cumbreWorkerMetricsAggregator` en `functions/src/index.ts`.
  - La función programada lee `worker_metricas`, agrupa por tenant/worker/módulo, persiste `worker_metricas_resumen` y genera alertas por umbral.
  - Se actualizaron `docs/INVENTARIO_EJECUCION_CUMBRE.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Noveno cimiento técnico de Cumbre.
  - Se conectó `src/components/CumbreOperationsPanel.tsx` a `worker_metricas_resumen`.
  - Operaciones P0 ahora muestra estado agregado diario, total de jobs, error rate, dead letters y reautorizaciones.
  - Se actualizó `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Décimo cimiento técnico de Cumbre.
  - Se amplió `shared/backendWorkerConnectors.ts` con `BackendConnectorProductionGate`.
  - Se agregó validación de sandbox, `credencial_ref secret://`, permisos, auditoría, observabilidad, aprobación humana y aprobador.
  - Se agregó `canEnableRealConnector` y path `worker_connector_gates`.
  - Se extendió `scripts/test-domain-contracts.ts` con pruebas que bloquean conectores reales sin compuerta completa.
  - Se actualizaron `docs/INVENTARIO_EJECUCION_CUMBRE.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` y `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Undécimo cimiento técnico de Cumbre.
  - Se actualizó `src/components/CumbreOperationsPanel.tsx` con la tarjeta `Compuerta conector real`.
  - La vista muestra conector, ejecución real bloqueada, sandbox, observabilidad y motivos de bloqueo.
  - Se usa `validarBackendConnectorProductionGate` y `canEnableRealConnector` para mantener el bloqueo visible.
  - Se actualizó `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Duodécimo cimiento técnico de Cumbre.
  - Se amplió `shared/backendWorkerConnectors.ts` con helpers para crear, aprobar y revocar compuertas.
  - Se creó `src/lib/backendConnectorGateTools.ts` para preparar, aprobar y revocar la compuerta demo de Cobros en Firestore/emulador.
  - Se conectó `src/components/CumbreOperationsPanel.tsx` a `worker_connector_gates` con acciones de preparar, aprobar demo y revocar.
  - Se extendió `scripts/test-domain-contracts.ts` con pruebas de compuerta pendiente, aprobada y revocada.
  - Se actualizó `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Decimotercer cimiento técnico de Cumbre.
  - Se endureció `firestore.rules` con `canTenantAdmin(tenantId)`.
  - `worker_connector_gates` permite lectura al tenant y escritura solo a `owner/admin`, excluyendo `operador`.
  - Se actualizó `scripts/test-security-rules.ts` para validar la regla específica.
  - Se actualizó `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Decimocuarto cimiento técnico de Cumbre.
  - Se actualizó `src/components/CumbreOperationsPanel.tsx` para recibir `currentUserRole`.
  - Las acciones de preparar, aprobar y revocar compuertas quedan habilitadas solo para `owner/admin`.
  - Se actualizó `src/App.tsx` para pasar rol `owner` en la demo autenticada.
  - Se actualizó `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Decimoquinto cimiento técnico de Cumbre.
  - Se creó `src/lib/tenantAccessTools.ts` para suscribirse al rol real del miembro del tenant.
  - `src/App.tsx` ahora pasa `currentUserRole` real a `Operaciones P0`.
  - Se mantiene fallback `owner` cuando `tenantId === uid` y `solo_lectura` cuando no hay miembro activo.
  - Se actualizó `docs/REGISTRO_AVANCE_PROYECTO.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Implementación del estudio competitivo SEO/GEO página por página.
  - Se ejecutó el plan de auditoría competitiva sin modificar el archivo de planificación.
  - Se extrajeron criterios desde las palabras clave objetivo del mapa SEO del sitio: ERP Cumbre, CRM, POS/Negocios, Facturador ARCA, Stock/Compras, Cobros/Pagos, Contabilidad/Impuestos, Reportes BI, WhatsApp Hub, Marketing e IA Productiva.
  - Se relevaron competidores visibles por criterio y se consolidaron patrones ganadores: precios/rangos, comparativas, FAQs, contexto argentino, costos reales, rubros, implementación, migración, soporte y estructura citable por IA.
  - Se creó `docs/AUDITORIA_COMPETITIVA_SEO_GEO_2026.md` con matriz de competidores, brechas GEMA/Cumbre, patrones y backlog priorizado.
  - Se creó el Canvas `auditoria-competitiva-seo-geo.canvas.tsx` como vista visual de la matriz competitiva y oportunidades SEO/GEO.
  - No se publicaron cambios en producción ni se modificaron páginas del sitio en esta etapa.

- 2026-06-08: Corrección conceptual SEO: autoridad no es contenido.
  - Se ajustó `docs/AUDITORIA_COMPETITIVA_SEO_GEO_2026.md` para separar profundidad de contenido de autoridad externa.
  - Se definió autoridad como señales verificables fuera de la propia página: menciones, backlinks legítimos, casos reales, partners, reseñas, perfiles institucionales, prensa y presencia local.
  - Se actualizó el Canvas de auditoría competitiva para que el backlog distinga optimización de contenido de construcción de autoridad.
  - Se deja anotado para una etapa posterior trabajar específicamente el tema reseñas: Google Business Profile, testimonios verificables, casos de cliente, reseñas sectoriales y su impacto en confianza/autoridad.

- 2026-06-08: Implementación de mejoras SEO/GEO competitivas en el sitio y Yoast.
  - Se aplicaron mejoras derivadas del estudio competitivo sin publicar en producción.
  - Se agregó en `/erp-cumbre/` una matriz de decisión SEO: qué sistema conviene según tamaño, operación y madurez de la empresa, incluyendo comercios de mostrador, PyMEs B2B, PyMEs administrativas, empresas con áreas y empresas con sistema existente.
  - Se reforzó Cumbre CRM con comparativa "CRM tradicional vs CRM WhatsApp vs CRM conectado al ERP", separando WhatsApp, costo total, operación comercial y derivación humana.
  - Se reforzó Cumbre ERP Negocios con flujo completo POS: abrir caja, vender rápido, actualizar stock, controlar precios y cerrar el día, además de checklist por rubro.
  - Se reforzó Cumbre Facturador ARCA con comparativa "portal ARCA vs facturador simple vs ERP integrado", manteniendo guardrails de producción asistida, CAE/error trazable y validación fiscal.
  - Se reforzó Cumbre Cobros con flujo punta a punta: factura/pedido, link o QR, evento/evidencia, conciliación asistida y registro en Tesorería/Contabilidad/Impuestos.
  - Se reforzó Cumbre WhatsApp Hub con separación de costos reales: consumo Meta, plataforma Cumbre, BSP/proveedor externo e implementación.
  - Se actualizaron títulos, meta descriptions, focus keywords y sinónimos en `inc/seo-yoast.php` para ERP Cumbre, CRM, POS/Negocios, Cobros, Facturador ARCA y WhatsApp Hub.
  - Se amplió JSON-LD local con `SoftwareApplication` y `Product` para Facturador ARCA, Cobros y WhatsApp Hub, además de FAQPage existente.
  - Se validó sintaxis PHP con `php -l` en `functions.php` e `inc/seo-yoast.php`, sin errores.

- 2026-06-08: Deploy a producción y auditoría post-publicación.
  - Se publicó el theme `gema-sovereign` en `https://gema-digital.com` mediante backup remoto, `rsync`, corrección de propietario y limpieza de cache WordPress.
  - Backup remoto previo al deploy: `/root/gema-production-backups/gema-sovereign-20260608-081051.tgz`.
  - Se refrescaron rewrites de WordPress y se verificó que `sitemap_index.xml` y `page-sitemap.xml` respondan 200.
  - Se verificó en producción que `/erp-cumbre/`, `/cumbre-crm/`, `/cumbre-erp-negocios/`, `/erp-cumbre/cumbre-facturador-arca/`, `/erp-cumbre/cumbre-cobros/` y `/erp-cumbre/cumbre-whatsapp-hub/` reflejan los bloques SEO/GEO nuevos.
  - Se auditó el sitemap completo: 153 URLs, 0 HTTP distinto de 200, 0 canonical faltante, 0 `noindex`, 0 JSON-LD inválido y 0 imágenes sin `alt`.
  - PageSpeed Insights API no pudo medirse por cuota diaria excedida (`HTTP 429`); quedan como referencia las mediciones anteriores y se recomienda repetir cuando se libere cuota.
  - Se creó `docs/AUDITORIA_PRODUCCION_POST_DEPLOY_2026_06_08.md` con hallazgos y backlog priorizado.

- 2026-06-08: Preparación de control de redes sociales.
  - Se recibió información operativa de accesos de redes vinculadas a Genera Tu Energia y cuentas nuevas de GEMA.
  - Por seguridad, no se copiaron contraseñas, tokens, códigos 2FA ni credenciales sensibles dentro del repositorio.
  - Se creó `docs/CONTROL_REDES_SOCIALES_GEMA.md` con inventario sin claves, cuentas relacionadas, checklist de toma de control, 2FA, recuperación, ownership y orden recomendado.
  - Quedó pendiente confirmar si la cuenta final correcta es `info@gene-digital.com` o `info@gema-digital.com`.
  - Próxima etapa: login asistido con el usuario presente para resolver 2FA, agregar owners/admins corporativos, rotar contraseñas y registrar todo en un gestor seguro.

- 2026-06-08: Optimización SEO/social de perfiles GEMA y ERP Cumbre.
  - Se creó `docs/OPTIMIZACION_PERFILES_SOCIALES_GEMA_CUMBRE.md` como ficha maestra para optimizar perfiles sociales orientados a autoridad externa y descubribilidad.
  - Se definió identidad recomendada: `GEMA Digital | ERP Cumbre, IA y automatización para PyMEs`, con keywords ERP, CRM, POS, ARCA, Cobros, WhatsApp, BI, IA, automatización y marketing medible.
  - Se prepararon nombres, bios, categorías, descripciones, enlaces con UTM, posts fijados, highlights, playlists, tableros, servicios de Google Business Profile y calendario editorial inicial.
  - Se aclaró que "rank 1" requiere contenido, autoridad y señales externas reales: reseñas, casos, perfiles verificados, consistencia NAP, actividad y menciones.
  - Se actualizó `docs/CONTROL_REDES_SOCIALES_GEMA.md` con referencia a la ficha de optimización y regla de no rebrandear cuentas heredadas sin confirmar ownership, 2FA y estrategia de marca.

- 2026-06-08: Sistema publicitario orgánico GEMA / ERP Cumbre.
  - Se creó `docs/PLAN_PUBLICISTA_GEMA_CUMBRE_30_DIAS.md` como plan operativo para convertir las landings del sitio en contenido social mensual.
  - El plan incluye rol publicista, voz de marca, pilares editoriales, enlaces UTM, calendario de 30 días, copies base, hashtags, prompts visuales, guiones de reels/shorts y reglas de publicación segura.
  - Se creó el Canvas `calendario-publicista-gema-cumbre.canvas.tsx` como vista visual de la grilla de 30 días, pilares y canales.
  - Se definió el primer lote recomendado para publicar: presentación de GEMA Digital, qué es ERP Cumbre, CRM conectado al ERP, POS para comercios y marketing medible con GTM/Analytics.
  - Queda pendiente la publicación o programación real en redes hasta contar con acceso administrador confirmado en cada plataforma.

- 2026-06-08: Decimosexto hito técnico de Cumbre ERP.
  - Se inició el tronco operativo base P1 con la columna CRM + Catálogo.
  - Se creó `shared/p1Readiness.ts` con contrato de readiness y estados `bloqueado`, `lista_demo` y `lista_beta_condicional`.
  - Se creó `src/components/CumbreP1Readiness.tsx` y se conectó en `src/App.tsx` como vista `Columna P1`.
  - Se agregaron pruebas en `scripts/test-domain-contracts.ts`.
  - Se actualizaron `docs/REGISTRO_AVANCE_PROYECTO.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` e `docs/INVENTARIO_EJECUCION_CUMBRE.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Decimoséptimo hito técnico de Cumbre ERP.
  - Se extendió P1 con la columna Cobros + Facturación demo/controlada.
  - `shared/p1Readiness.ts` ahora incluye `P1CobrosFacturacionReadiness`.
  - `src/components/CumbreP1Readiness.tsx` muestra readiness de CRM + Catálogo y Cobros + Facturación.
  - Se agregó guardrail: conectores reales habilitados antes de compuerta beta bloquean la columna.
  - Se agregaron pruebas en `scripts/test-domain-contracts.ts` para estados bloqueado, demo, beta condicional y bloqueo por conector real.
  - Se actualizó `docs/REGISTRO_AVANCE_PROYECTO.md` y `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Decimoctavo hito técnico de Cumbre ERP.
  - Se extendió P1 con la columna Stock + Ventas.
  - `shared/p1Readiness.ts` ahora incluye `P1StockVentasReadiness`.
  - `src/components/CumbreP1Readiness.tsx` muestra readiness de CRM + Catálogo, Cobros + Facturación y Stock + Ventas.
  - Se agregó guardrail: stock negativo no permitido bloquea la columna.
  - Se agregaron pruebas en `scripts/test-domain-contracts.ts` para estados bloqueado, demo, beta condicional y bloqueo por stock negativo.
  - Se actualizaron `docs/REGISTRO_AVANCE_PROYECTO.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` e `docs/INVENTARIO_EJECUCION_CUMBRE.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Decimonoveno hito técnico de Cumbre ERP.
  - Se extendió P1 con la columna BI Operativo.
  - `shared/p1Readiness.ts` ahora incluye `P1BiOperativoReadiness`.
  - `src/components/CumbreP1Readiness.tsx` muestra readiness de CRM + Catálogo, Cobros + Facturación, Stock + Ventas y BI Operativo.
  - Se agregó guardrail: BI bloquea si se detecta duplicación de datos operativos en vez de referencias/snapshots.
  - Se agregaron pruebas en `scripts/test-domain-contracts.ts` para estados bloqueado, demo, beta condicional y bloqueo por duplicación.
  - Se actualizaron `docs/REGISTRO_AVANCE_PROYECTO.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` e `docs/INVENTARIO_EJECUCION_CUMBRE.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Vigésimo hito técnico de Cumbre ERP.
  - Se agregó la compuerta superior de demo interna end-to-end P1.
  - `shared/p1Readiness.ts` ahora incluye `P1DemoInternaReadiness`.
  - `src/components/CumbreP1Readiness.tsx` muestra la compuerta `Demo Interna P1` encima de las cuatro columnas operativas.
  - Se agregó guardrail: la demo interna se bloquea si hay conectores reales encendidos antes de aprobación productiva.
  - Se agregaron pruebas en `scripts/test-domain-contracts.ts` para estados bloqueado, demo, beta condicional y bloqueo por conector real.
  - Se actualizaron `docs/REGISTRO_AVANCE_PROYECTO.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` e `docs/INVENTARIO_EJECUCION_CUMBRE.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores; `functions:typecheck` se ejecutó aislado por demora alta del comando encadenado.

- 2026-06-08: Vigésimo primer hito técnico de Cumbre ERP.
  - Se conectó el flujo MVP comercial con evidencia BI operativa trazable.
  - Se creó `shared/reportesBiDemo.ts` con `buildReportesBiDemoOperativo`.
  - Se creó `src/lib/reportesBiTools.ts` para persistir dashboard y KPIs BI en Firestore.
  - `src/components/CumbreMvpDemo.tsx` ahora genera dashboard BI y cuatro KPIs al completar presupuesto, cobro, comprobante y Vista Hoy.
  - `src/components/CumbreP1Readiness.tsx` quedó alineado con la colección canónica `comprobantes`.
  - Se agregaron pruebas en `scripts/test-domain-contracts.ts` para validar dashboard, KPIs y origenes operativos referenciados.
  - Se actualizaron `docs/REGISTRO_AVANCE_PROYECTO.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` e `docs/INVENTARIO_EJECUCION_CUMBRE.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Vigésimo segundo hito técnico de Cumbre ERP.
  - Se creó `shared/p1DemoExecution.ts` para registrar corridas auditables de demo interna P1.
  - El contrato incluye estados `preflight`, `en_ejecucion`, `completada` y `bloqueada`.
  - Se agregaron checks mínimos de columnas listas, evidencia mínima y operador identificado.
  - Se modelaron hallazgos por severidad, módulo, acción recomendada y resolución.
  - El cierre de corrida bloquea automáticamente si queda un hallazgo crítico sin resolver.
  - Se agregaron pruebas en `scripts/test-domain-contracts.ts`.
  - Se actualizaron `docs/REGISTRO_AVANCE_PROYECTO.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` e `docs/INVENTARIO_EJECUCION_CUMBRE.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Vigésimo tercer hito técnico de Cumbre ERP.
  - Se creó `src/lib/p1DemoExecutionTools.ts` para persistir corridas demo P1 en Firestore.
  - `src/components/CumbreP1Readiness.tsx` ahora permite registrar una corrida demo P1 desde la UI.
  - `src/App.tsx` pasa rol real y operador a la vista P1.
  - `firestore.rules` agregó regla específica para `demo_p1_ejecuciones`.
  - La escritura de corridas demo P1 queda limitada a `owner/admin`; los miembros del tenant pueden leerlas.
  - `scripts/test-security-rules.ts` valida la nueva regla.
  - Se actualizaron `docs/REGISTRO_AVANCE_PROYECTO.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` e `docs/INVENTARIO_EJECUCION_CUMBRE.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Vigésimo cuarto hito técnico de Cumbre ERP.
  - Se creó `scripts/run-p1-demo-assisted.ts` para ejecutar una corrida asistida contractual de demo P1.
  - Se agregó el comando `npm run demo:p1:run`.
  - Se generó `docs/demo-p1-assisted-run.latest.json` con la corrida `demo_p1_20260608_f8623aea`.
  - La corrida quedó `completada`, con readiness P1 completo en `lista_beta_condicional`.
  - Evidencias referenciadas: lead CRM, movimiento de caja, comprobante y dashboard BI.
  - Hallazgo `info` resuelto: la corrida contractual completa P1 sin conectores reales.
  - Hallazgo `media` pendiente: falta validar visualmente el dashboard BI en UI con emulador.
  - Se actualizaron `docs/REGISTRO_AVANCE_PROYECTO.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` e `docs/INVENTARIO_EJECUCION_CUMBRE.md`.
  - Validación ejecutada: `npm run demo:p1:run`, `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Vigésimo quinto hito técnico de Cumbre ERP.
  - Se extendió `src/components/CumbreP1Readiness.tsx` para escuchar `demo_p1_ejecuciones`.
  - La vista `Columna P1` ahora muestra última corrida, cantidad de evidencias, hallazgos abiertos y detalle de hallazgos.
  - También muestra evidencia visual BI: dashboards, KPI snapshots, comprobantes y fuentes trazables.
  - El hallazgo medio de validación visual BI queda abordado a nivel UI; queda pendiente validarlo contra emulador con datos reales.
  - Se actualizaron `docs/REGISTRO_AVANCE_PROYECTO.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` e `docs/INVENTARIO_EJECUCION_CUMBRE.md`.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Vigésimo sexto hito técnico de Cumbre ERP.
  - Se creó `scripts/seed-p1-demo-emulator.ts` para preparar datos P1 en Firestore Emulator.
  - Se agregaron comandos `npm run demo:p1:seed:dry` y `npm run demo:p1:seed`.
  - El dry-run valida sin requerir emulador levantado y genera `docs/demo-p1-emulator-seed.latest.json`.
  - El seed incluye 18 documentos: catálogo, eventos, CRM, caja, comprobante, job fiscal, stock, Vista Hoy, BI y corrida demo P1.
  - Se cambió la escritura real a REST contra Firestore Emulator para evitar cargar `firebase-admin` bajo Node 24.
  - Se actualizaron `docs/REGISTRO_AVANCE_PROYECTO.md`, `docs/TABLERO_VALIDACION_EJECUCION_CUMBRE.md` e `docs/INVENTARIO_EJECUCION_CUMBRE.md`.
  - Validación ejecutada: `npm run demo:p1:seed:dry`, `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Vigésimo séptimo hito técnico de Cumbre ERP.
  - Se creó `scripts/check-p1-local-env.ts` para diagnosticar puertos locales de Firestore, Auth, Storage y Emulator UI.
  - Se agregó `npm run demo:p1:check-env` y `npm run emulators:compat`.
  - El reporte `docs/demo-p1-local-env.latest.json` deja auditado que el emulador no está activo en 8080/9099/9199/4000.
  - Se intentó levantar `npm run emulators`, pero Firebase CLI falló con `ERR_INVALID_PACKAGE_CONFIG` bajo Node `v24.11.1`.
  - Se verificó que `firebase-tools@15.18.0` ejecuta, pero `npm run emulators:compat` queda bloqueado porque no hay Java local disponible.
  - La importación real del seed queda bloqueada por entorno local, no por contratos ni por datos.
  - Validación ejecutada: `npm run typecheck` sin errores.

- 2026-06-08: Vigésimo octavo hito técnico de Cumbre ERP.
  - Se preparó `src/App.tsx` para permitir acceso local controlado al tenant seed `tenant_demo_p1`.
  - El botón `Entrar modo demo P1 local` aparece solo en `localhost` o `127.0.0.1` cuando no hay sesión iniciada.
  - El modo local usa operador `usr_owner_demo_p1` y rol `owner`, navega a `Columna P1` y no altera el flujo productivo Google SSO.
  - La UI queda lista para validar evidencia BI P1 apenas Firestore Emulator esté activo y el seed se importe.
  - Se actualizaron registros de avance, tablero e inventario.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck` sin errores.

- 2026-06-08: Vigésimo noveno hito técnico de Cumbre ERP.
  - Se creó `docs/RUNBOOK_DEMO_P1_LOCAL.md` con el procedimiento end-to-end para validar P1 local.
  - El runbook cubre preflight, emuladores compat, importación de seed, apertura UI, modo demo P1 local y criterios de éxito.
  - Se documentaron bloqueos conocidos: `firebase-tools@15.19.1` y falta de Java local.
  - Se actualizaron registros de avance, tablero e inventario.
  - Validación ejecutada: `npm run demo:p1:seed:dry`, `npm run demo:p1:check-env` y `npm run typecheck`; el check falla correctamente por falta de Java/emulador.

- 2026-06-08: Trigésimo hito técnico de Cumbre ERP.
  - Se creó `scripts/setup-local-java.ts` y el comando `npm run emulators:setup-java`.
  - Se descargó Temurin JRE 21 dentro de `.java/`, carpeta ignorada por git.
  - `scripts/check-p1-local-env.ts` ahora detecta primero `.java/Contents/Home/bin/java`.
  - El reporte `docs/demo-p1-local-env.latest.json` confirma Java OK con OpenJDK Temurin `21.0.11`.
  - Se actualizó el runbook local P1 con el paso de Java.
  - Validación ejecutada: `npm run emulators:setup-java`, `npm run demo:p1:check-env`, `npm run demo:p1:seed:dry`, `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck`.

- 2026-06-08: Trigésimo primer hito técnico de Cumbre ERP.
  - Se completó el cierre local end-to-end P1 con autenticación real en emulador.
  - `scripts/seed-p1-demo-emulator.ts` ahora crea o actualiza usuario demo en Auth Emulator (`tenant_demo_p1`) con claims `tenant_roles.tenant_demo_p1=owner`.
  - `src/lib/firebaseConfig.ts` incorporó login local por email/password para demo.
  - `src/App.tsx` conectó `Entrar modo demo P1 local` a login real contra Auth Emulator.
  - Se eliminó el bypass local sin auth que causaba `permission-denied` en listeners Firestore.
  - Verificación en UI: `Columna P1` muestra conteos reales del seed (catalogo, CRM, cobros, stock, BI y demo interna).
  - Se actualizaron runbook, registro de avance, tablero e inventario.
  - Validación ejecutada: `npm run demo:p1:seed`, `npm run test:contracts`, `npm run typecheck`, `npm run test:rules` y `npm run functions:typecheck`.

- 2026-06-08: Trigésimo segundo hito técnico de Cumbre ERP.
  - Se agregó `npm run emulators:p1:compat` para iniciar solo `auth,firestore,storage` con `firebase-tools@15.18.0`.
  - Se actualizó `scripts/check-p1-local-env.ts` para recomendar el flujo mínimo de emuladores P1.
  - Se actualizó `docs/RUNBOOK_DEMO_P1_LOCAL.md` con el comando mínimo.
  - Se resolvió conflicto de puerto 8080 limpiando proceso Java residual antes de reiniciar emuladores.
  - Se revalidó `demo:p1:check-env`, `demo:p1:seed`, `typecheck` y `test:rules`.
  - Verificación browser confirmada: login demo local y `Columna P1` con métricas no cero sobre el flujo mínimo.
  - Se registró una nueva corrida desde el botón `Registrar corrida demo P1`; en emulador quedó persistida como `en_ejecucion`.

- 2026-06-08: Trigésimo tercer hito técnico de Cumbre ERP.
  - Se agregó `cerrarP1DemoExecutionRun` en `src/lib/p1DemoExecutionTools.ts`.
  - `src/components/CumbreP1Readiness.tsx` incorporó botón `Cerrar corrida actual` y estado final con `finalizado`.
  - El cierre genera hallazgos automáticos según señales de readiness/evidencia y persiste corrida final.
  - Verificación en emulador: última corrida `demo_p1_20260608_f24587fe` quedó `completada`, con `finalizado_el` y hallazgos.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules`, `npm run functions:typecheck`.

- 2026-06-08: Trigésimo cuarto hito técnico de Cumbre ERP.
  - Se amplió `shared/p1DemoExecution.ts` con contrato de decisión de gate (`P1DemoGateDecisionRecord`) y validadores.
  - Se agregó `registrarP1DemoGateDecision` en `src/lib/p1DemoExecutionTools.ts`.
  - `src/components/CumbreP1Readiness.tsx` ahora permite registrar decisión formal de gate:
    - `Gate: repetir demo`
    - `Gate: abrir beta`
    - `Gate: volver a construir`
  - Se agregó regla Firestore para `demo_p1_gate_decisiones` con write restringido a owner/admin.
  - Verificación en emulador: decisión `abrir_beta_controlada` persistida con siguiente acción.
  - Validación ejecutada: `npm run test:contracts`, `npm run typecheck`, `npm run test:rules`, `npm run functions:typecheck`.

- 2026-06-08: Optimización inicial de perfiles Meta / Instagram de GEMA.
  - Alcance autorizado: operar solo sobre `Gema Sistemas ERP` / `gema.digital.erp` para perfil publico; sin tocar Genera Tu Energia, pagos, anuncios, propietarios ni eliminar activos.
  - Facebook `Gema Sistemas ERP`: se actualizo la presentacion publica con posicionamiento de gestion, marketing, automatizacion, software, ERP Cumbre, IA y soluciones digitales.
  - Facebook `Gema Sistemas ERP`: se reemplazo la categoria `Servicio local` por `Empresa de software`.
  - Facebook `Gema Sistemas ERP`: se verificaron datos visibles de contacto: telefono `+54 11 6598-0069`, correo `info@gema-digital.com` y enlace `gema-digital.com`.
  - Instagram `gema.digital.erp`: se actualizo la presentacion publica con el mismo posicionamiento.
  - Pendiente: Instagram no permite editar links desde web; completar enlace desde app movil con UTM de perfil social.
  - Se actualizo `docs/CONTROL_REDES_SOCIALES_GEMA.md` con cambios aplicados y pendientes.

- 2026-06-08: Optimización inicial de LinkedIn GEMA.
  - Alcance autorizado: operar sobre LinkedIn para optimizar la pagina `Gema Sistemas ERP`; sin tocar Genera Tu Energia, ownership, pagos, anuncios, empleos ni permisos.
  - Se mantuvieron sin cambios el nombre publico y la URL publica `gema-digital-erp`.
  - Se actualizo el lema a `Gestion, marketing y automatizacion para comercios y PyMEs`.
  - Se actualizo la seccion `Acerca de` con posicionamiento de GEMA Digital, ERP Cumbre, CRM, POS, cobros, facturacion, marketing digital, SEO, IA, GTM/Analytics y automatizaciones.
  - Se actualizo el sitio web y el boton personalizado con UTM de LinkedIn: `https://gema-digital.com/?utm_source=linkedin&utm_medium=social&utm_campaign=perfil_social`.
  - Pendiente menor: revisar especialidades si LinkedIn muestra un campo editable claro.
  - Se actualizo `docs/CONTROL_REDES_SOCIALES_GEMA.md` con cambios aplicados y pendientes.

- 2026-06-08: Revisión de redes restantes para GEMA.
  - X / Twitter: no hay sesión iniciada; no se aplicaron cambios.
  - YouTube: la sesión disponible corresponde al canal personal `@NorbertoSarlinga`; no se aplicaron cambios sin autorización específica para perfil personal.
  - Pinterest: no hay sesión iniciada; no se aplicaron cambios.
  - Google Business Profile: la cuenta activa `info@generatuenergia.net` sólo muestra la ficha `Genera Tu Energía`; no se aplicaron cambios para no tocar esa marca.
  - Pendiente: abrir sesiones o activos propios de GEMA/Cumbre para X, Pinterest, YouTube y Google Business, o autorizar expresamente mención de GEMA en perfil personal donde corresponda.
  - Se actualizo `docs/CONTROL_REDES_SOCIALES_GEMA.md` con el estado por plataforma.

- 2026-06-08: Creación y optimización inicial de Pinterest GEMA.
  - Se creó cuenta Pinterest Business con `info@gema-digital.com`.
  - Tipo de cuenta: agencia; función declarada: propietario.
  - Perfil público configurado como `GEMA Digital`.
  - Usuario público: `GemaDigitalERP`.
  - URL pública verificada: `https://ar.pinterest.com/GemaDigitalERP/`.
  - Bio configurada con posicionamiento de gestión, marketing, automatización, software, ERP Cumbre, IA y soluciones digitales.
  - País configurado: Argentina.
  - Sitio web guardado por Pinterest como `http://gema-digital.com`; Pinterest no conservó parámetros UTM en el campo web.
  - El teléfono comercial fue removido porque Pinterest lo marcó como inválido.
  - No se configuraron anuncios, pagos, conversion tags ni permisos.
  - Se crearon tableros iniciales: `GEMA Digital`, `ERP Cumbre`, `CRM y ventas`, `POS para comercios`, `Marketing digital`, `Automatizacion e IA`, `Cobros y facturacion` y `FAQs software de gestion`.
  - Pendiente: subir logo/imagen de marca y crear primeros pines por tablero.
  - X / Twitter queda pendiente porque el flujo visible no habilitó alta por email y ofrece teléfono o Apple.
  - Se actualizo `docs/CONTROL_REDES_SOCIALES_GEMA.md` con el estado final.

- 2026-06-08: Base API para publicacion social GEMA.
  - Se documento la estrategia de APIs oficiales en `docs/APIS_REDES_SOCIALES_GEMA.md`.
  - Se dejo asentada la regla de acceso: Facebook/Instagram/LinkedIn via `info@generatuenergia.net`; Pinterest/YouTube/Google/resto via `info@gema-digital.com`.
  - Se creo `cumbre/.env.social.example` con variables esperadas sin secretos.
  - Se creo `cumbre/src/lib/socialPublisher/` con tipos, politicas de cuenta, drafts institucionales y adaptadores para Facebook, Instagram, LinkedIn y Pinterest.
  - Los conectores trabajan en modo seguro: `dryRun`, `skipped` si faltan tokens y `blocked` si la red requiere media o permisos no completados.
  - Validacion ejecutada: `npm --prefix cumbre run typecheck` sin errores.
  - Pendiente: crear apps developer, aprobar OAuth/permisos y guardar tokens fuera del repositorio.

- 2026-06-08: Trigésimo quinto hito técnico de Cumbre ERP.
  - Se incorporó `buildPresupuestoItemFromCatalogo` en `shared/catalogo.ts` para centralizar la construcción segura de `PresupuestoItem`.
  - El helper evita serializar `proveedor_sugerido_id` cuando no existe proveedor principal, eliminando escrituras Firestore con `undefined`.
  - `src/lib/catalogoTools.ts` y `src/components/CumbreMvpDemo.tsx` quedaron unificados sobre el helper compartido para evitar divergencias entre librería y UI.
  - Se agregaron pruebas en `scripts/test-domain-contracts.ts` para verificar casos con y sin proveedor principal.
  - Verificación browser sobre emulador: corrida MVP manual completada de punta a punta con `Flujo completo` y sin error de datos inválidos.
  - Validación ejecutada: `npm run typecheck`, `npm run test:contracts`, `npm run test:rules`, `npm run functions:typecheck`.

- 2026-06-08: Trigésimo sexto hito técnico de Cumbre ERP.
  - Se extendió `shared/p1DemoExecution.ts` con el contrato `P1BetaAperturaChecklistRecord`, checks y validadores de apertura beta.
  - Se agregó `registrarP1BetaAperturaChecklist(...)` en `src/lib/p1DemoExecutionTools.ts`.
  - `src/components/CumbreP1Readiness.tsx` ahora permite registrar y visualizar la checklist final (`Registrar checklist beta P1`) con estado, bloqueos y siguiente acción.
  - Se agregó regla Firestore para `demo_p1_beta_checklists` con write restringido a owner/admin.
  - Se ampliaron pruebas en `scripts/test-domain-contracts.ts` y `scripts/test-security-rules.ts`.
  - Verificación browser sobre emulador: secuencia corrida cerrada + decisión `abrir_beta_controlada` + checklist registrada con estado `lista_apertura`.
  - Validación ejecutada: `npm run typecheck`, `npm run test:contracts`, `npm run test:rules`, `npm run functions:typecheck`.

- 2026-06-08: Trigésimo séptimo hito técnico de Cumbre ERP.
  - Se extendió `shared/p1DemoExecution.ts` con `P1BetaSeguimientoRecord` para monitoreo diario de beta controlada.
  - Se agregó `registrarP1BetaSeguimiento(...)` en `src/lib/p1DemoExecutionTools.ts`.
  - `src/components/CumbreP1Readiness.tsx` incorporó el botón `Registrar seguimiento beta hoy` y visualización del último seguimiento (estado, fecha, incidentes, siguiente acción).
  - Se agregó regla Firestore para `demo_p1_beta_seguimientos` con write restringido a owner/admin.
  - Se ampliaron pruebas en `scripts/test-domain-contracts.ts` y `scripts/test-security-rules.ts`.
  - Verificación browser sobre emulador: seguimiento diario registrado con estado `estable` y trazabilidad visible en UI.
  - Validación ejecutada: `npm run typecheck`, `npm run test:contracts`, `npm run test:rules`, `npm run functions:typecheck`.

- 2026-06-08: Trigésimo octavo hito técnico de Cumbre ERP.
  - Se extendió `shared/p1DemoExecution.ts` con `P1BetaSalidaRecord` para compuerta formal de salida de beta.
  - Se agregó `registrarP1BetaSalida(...)` en `src/lib/p1DemoExecutionTools.ts`.
  - `src/components/CumbreP1Readiness.tsx` incorporó `Evaluar salida beta P1` con decisión automática (`aprobar_salida`, `extender_beta`, `bloquear_salida`) y resumen visible.
  - Se agregó regla Firestore para `demo_p1_beta_salidas` con write restringido a owner/admin.
  - Se ampliaron pruebas en `scripts/test-domain-contracts.ts` y `scripts/test-security-rules.ts`.
  - Verificación browser sobre emulador: salida evaluada y persistida con `extender_beta` al no cumplir aún monitoreo mínimo de 3 días.
  - Validación ejecutada: `npm run typecheck`, `npm run test:contracts`, `npm run test:rules`, `npm run functions:typecheck`.

- 2026-06-15: Beta dogfood tenant_prueba_interna — bootstrap, hosting y smoke.
  - Repo Cumbre ERP: corrección `shared/catalogo.ts` (omitir campos fiscales/stock opcionales `undefined` en writes Firestore) y `shared/crm.ts` (referencia catálogo sin import circular).
  - Espejo `~/.cumbre-mirror`: sync + `npm run beta:bootstrap:dogfood` OK (`documentos_modulo`: 7, `modulos_matriz`: 32).
  - Firestore Admin: existen CRM (`crm_configuracion/general`), Cobros (`config_integraciones/cumbre_cobros`), panel y matriz módulos para `tenant_prueba_interna`.
  - `npm run deploy:beta:hosting` desde espejo OK → https://cumbre-erp-beta.web.app (functions no desplegadas; Drive path timeout conocido).
  - `npm run beta:test:dogfood-smoke -- --from-credentials` OK (tenant, owner, 32 módulos, agente_chatbot).
  - Impacto web GEMA: ninguno directo.
  - Impacto asistente IA: pendiente sincronizar conocimiento si se comunica estado panel beta.
  - Producción: solo hosting beta Cumbre; cambios de código en repo Cumbre local/espejo, no commit automático.

- 2026-06-15: Prod dogfood bootstrap/claims/repair — bloqueo `invalid_rapt` (auth Google, no ERP).
  - Norberto ejecutó `prod:bootstrap:dogfood`, `prod:apply-claims`, `prod:repair-panel` contra `cumbre-erp-prod` y falló con `invalid_grant` / `reauth related error (invalid_rapt)`.
  - Diagnóstico agente: ADC expirada (`gcloud auth application-default print-access-token` → reauth non-interactive); gcloud usuario activo `info@gema-digital.com`; proyecto CLI por defecto `cumbre-erp-beta` (ajustar a prod tras reauth).
  - Agente no puede completar login en browser; documentados pasos en `docs/fase7/ACCESO_BETA_SIMPLE.md` (espejo `~/.cumbre-mirror/docs/fase7/`) sección `invalid_rapt`.
  - Pendiente Norberto: `cd ~/.cumbre-mirror && npm run beta:repair:auth` → `npm run beta:check:adc` → re-ejecutar scripts prod dogfood + E2E.
  - Impacto web GEMA: ninguno. Impacto asistente IA: ninguno. Producción Cumbre: scripts admin no aplicados hasta reauth.
  - Auditoría módulo a módulo (agente efc83a6e): pendiente retomar tras prod dogfood OK.

### 2026-06-16 — Relevamiento previo pruebas empresas reales (Genera tu energía + GEMA Digital)

- **Objetivo:** Inventariar estado existente antes de pruebas con 2 empresas reales; sin bootstrap prod ni cambios productivos.
- **Archivos creados/consultados:** `docs/RELEVAMIENTO_EMPRESAS_REALES_2026-06-16.md` (espejo `~/.cumbre-mirror/docs/`); docs E2E/BANCO_PRUEBAS, ENTREGA_FINAL, PLAN_BETA_A_PRODUCCION, integraciones GEMA, REGISTRO mirror.
- **Impacto web:** Ninguno directo; relevamiento documenta bridge Fase C hacia `tenant_gema_prod_interno`.
- **Impacto asistente IA:** Pendiente alinear respuestas si GEMA Digital ≠ Generadores Sur fiscalmente.
- **Despliegue:** Solo local/documental (relevamiento persistido en docs/ + espejo mirror).
- **Validaciones:** E2E 32/32 beta+prod según reportes 2026-06-15; ADC vencida — no re-verificación Firestore live.
- **Pendientes:** Norberto completar checklist UNKNOWN; acta prueba; Fase 1 beta Genera; Fase 2 prod GEMA con re-bootstrap fiscal.

### 2026-06-16 — Cierre proyecto autorizado (Norberto) — documentación balance

- **Objetivo:** Coordinar documentación de cierre mientras otros agentes implementan P0 (Fase C prod, provisionTrialTenant, checkout, signup). Sin implementación de features en esta sesión.
- **Autorización:** Norberto — cierre proyecto autorizado; misión paralela documentación + auditoría.
- **Archivos creados/actualizados:**
  - `docs/CIERRE_PROYECTO_BALANCE_FINAL_2026-06-16.md` — checklist cierre (32/32, flujo cliente, comercial, integraciones), estado por dimensión (%), bugs P0/P1/P2, prueba final Genera tu energía (W1–W6 + G2–G11).
  - `~/.cumbre-mirror/scripts/run-audit-cierre.ts` — orquestador cierre.
  - `~/.cumbre-mirror/package.json` — `npm run audit:cierre`, `audit:cierre:fast`, `audit:cierre:checklist`.
- **Impacto web:** Ninguno directo; documento referencia deploy Fase C y carrito 404 prod como P0-1.
- **Impacto asistente IA:** Pendiente alinear respuestas post-P0 cuando agentes completen wp-config y provisioning.
- **Despliegue:** Solo local/documental (GEMA repo + mirror scripts).
- **Validaciones:** Baseline `BANCO_PRUEBAS_COMPLETO.latest.md` (25 PASS · 2 FAIL · 4 SKIP, ADC vencida); `AUDITORIA_MODULO_A_MODULO.latest.json` 64/64 PASS (15/06). Ejecutar `npm run audit:cierre` tras reauth ADC para sign-off automatizado.
- **Pendientes:** P0.1–P0.4 implementación (otros agentes); prueba cliente Fase A Norberto; sign-off final post-P0; revisión balance cada ~30 min si hay reportes nuevos.


### 2026-06-16 — Deploy Ola 1 completo (ADC renovada, Norberto autorizó prod)

- **Objetivo:** Ejecutar pipeline Ola 1 en `~/.cumbre-mirror`: ADC, functions beta/prod, hosting signup, health, auditoría, E2E y smoke flujo cliente.
- **Archivos / infra afectados:**
  - Mirror: `.env.beta.local`, `.env.production.local` (VITE_CUMBRE_SIGNUP_PUBLIC=true, VITE_CUMBRE_SIGNUP_ALLOWED_DOMAINS=*); fix TS `scripts/test-subscription-agent-notifications.ts` (satisfies AgenteSuscripcionesContext).
  - Firebase **cumbre-erp-beta** y **cumbre-erp-prod**: functions (provisionTrialTenant*, subscriptionAgent*, gemaCommercialEventRouter, cumbreTrialExpiringNotifier, wordpressIngestLead) + hosting.
  - Docs sincronizados: `docs/AUDIT_CIERRE.latest.*`, `docs/BANCO_PRUEBAS_COMPLETO.latest.*`, `docs/BETA_DOGFOOD_PANELS_E2E.latest.json`, `docs/PROD_DOGFOOD_PANELS_E2E.latest.json`.
- **ADC:** **PASS** — backup API OK (export GCS 2026-06-16).
- **beta:repair:auth:** Omitido (ADC OK).
- **Deploy functions:** Código desplegado; **exit code 2** por IAM invoker en 6 functions (org policy / allUsers): provisionTrialTenant, provisionTrialTenantHttp, subscriptionAgent, subscriptionAgentCallable, cumbreWhatsappWebhook, cumbreMercadoLibreWebhook (beta y prod). `fix-beta-functions-public-invoker.sh` también bloqueado (400 permitted customer).
- **Hosting:** **OK** beta y prod con signup en bundle live (`SIGNUP_PUBLIC`, «Crear cuenta»).
- **beta:health:** **TODO OK** post-hosting.
- **prod:health:** **FAIL** local — `dist/` quedó artefacto beta tras checks; hosting live HTTP 200.
- **audit:cierre:fast:** **FAIL** (27 PASS, 1 FAIL prod:health, E2E skip en orquestador); balance módulos 30/30 verde_local.
- **E2E dogfood panels:** beta **32/32**, prod **32/32** (Playwright instalado en sesión).
- **smoke-ola1-flujo-cliente.sh:** **14 pass, 0 fail, 2 skip**.
- **GEMA web prod:** checklist impreso; curl agent chat **200**; cart REST **404** (P0 Fase C plugins no desplegados en WP prod); SSH/rsync theme **no ejecutado**.
- **Impacto web:** Cumbre hosting prod/beta actualizado; WP prod sin cambios (carrito 404 persiste).
- **Impacto asistente IA:** Sin cambio directo; trial signup depende de IAM provisionTrialTenant* en prod.
- **Despliegue:** Firebase beta + prod hosting/functions (parcial IAM). Solo local: fix TS mirror, env locals mirror.
- **Pendientes:** Norberto/GCP admin — relajar org policy o invoker autenticado para provisionTrialTenantHttp; deploy plugins Fase C + theme WP prod; probar signup end-to-end manual.
- **URLs prueba signup:** https://cumbre-erp-beta.web.app/login · https://cumbre-erp-prod.web.app/login (pestaña «Crear cuenta»).


### 2026-06-16 — Follow-up deploy ed717102 (verificación signup callable + WP Fase C)

- **Objetivo:** Confirmar ruta signup UI vs HTTP IAM; smoke prod; documentar WP Fase C sin SSH.
- **Archivos:** `docs/CIERRE_PROYECTO_BALANCE_FINAL_2026-06-16.md` (§7.3); scripts consultados `deploy-fase-c-prod-checklist.sh`, `sync-wordpress-local.sh`, `test-web-prod-smoke.sh`.
- **Código (mirror `~/.cumbre-mirror`):** Signup usa `httpsCallable("provisionTrialTenant")` tras Auth email/password; `provisionTrialTenantHttp` no interviene en UI.
- **Impacto web:** Prod agent chat OK; cart REST 404 hasta deploy plugin `gema-payments-platform` + theme (checklist Norberto).
- **Impacto asistente IA:** Sin cambio; comunicar que trial ERP requiere IAM callable, no HTTP público.
- **Despliegue:** Hosting prod signup flags confirmados en bundle; functions IAM callable sin invoker → 403 en probe.
- **Validaciones:** curl login 200; agent chat 200; cart 404; `test-web-prod-smoke.sh` 7/1; gcloud IAM policies vacías en Run services callable/HTTP.
- **Pendientes:** Norberto — IAM `provisionTrialTenant`; rsync plugins/theme WP prod (checklist §1–3); probar signup manual post-IAM; cart tras plugins.


### 2026-06-16 — Auditoría final de cierre (Norberto autoriza cierre total)

- **Objetivo:** Ejecutar suite de cierre: `audit:cierre`, banco con ADC, E2E 32×2, smoke Ola 1, notificaciones; veredicto y sign-off Genera tu energía.
- **Archivos afectados:**
  - GEMA: `wordpress/theme-gema-sovereign/parts/header.html` (Iniciar sesión → `https://cumbre-erp-prod.web.app`).
  - GEMA docs: `docs/CIERRE_PROYECTO_BALANCE_FINAL_2026-06-16.md`, `docs/SIGN_OFF_FINAL_2026-06-16.md`, reportes sync `AUDIT_CIERRE.latest.*`, `BANCO_PRUEBAS_COMPLETO.latest.*`, E2E JSON.
  - Mirror local `~/.cumbre-mirror/scripts/run-test-bank.ts` — `build:prod` antes de `prod:health` (evita FAIL falso tras `beta:check:build`).
- **Impacto web:** Header local alinea login con prod ERP; **WP prod** requiere deploy Fase C para reflejar cambio.
- **Impacto asistente IA:** Sin cambio de conocimiento; mantener mensaje: trial self-service bloqueado por P0/IAM.
- **Despliegue:** Solo local (theme + mirror script); producción WP/Firebase sin nuevo deploy en esta sesión.
- **Validaciones:**
  - ADC: **OK**
  - `npm run audit:cierre`: **PARCIAL** (checklist P0×4 + COM-SELF-SERVICE fail)
  - Banco: **30 PASS · 0 FAIL · 1 SKIP** (veredicto pass)
  - E2E beta+prod: **32/32 + 32/32** (64/64)
  - `smoke-ola1-flujo-cliente.sh`: **15 pass · 0 fail · 1 skip**
  - `smoke-integracion-web-cumbre.sh`: **16 pass · 0 fail · 3 skip**
  - `test:subscription:notifications`: **7/7 PASS**
- **Fixes intentados:** header prod link; patch orden build prod en test bank; `build:prod` manual cuando dist beta invalidaba health.
- **Poll 20 min:** No re-ejecutado tras espera (banco ya PASS); documentado riesgo flake prod E2E durante deploy paralelo.
- **Pendientes:** P0-1..4 (ver `SIGN_OFF_FINAL_2026-06-16.md` §B.3); checklist humano Genera tu energía §B; mirror patch pendiente commit en repo Cumbre si aplica.

## 2026-06-16 — Signup trial: IAM callable 403 + cola Firestore (beta+prod)

- **Objetivo:** Desbloquear `provisionTrialTenant` (403/401) en signup público post-registro Firebase.
- **Código (repo `~/.cumbre-mirror`):** `functions/src/index.ts` (`provisionTrialTenant` con `invoker: "public"`, nueva `cumbreSignupProvisioningRunner` on Firestore create en `artifacts/cumbre-erp/users/{uid}/signup_trial_requests/{requestId}`); `src/lib/firebaseConfig.ts` (`provisionTrialAfterSignup`: callable → fallback cola Firestore + espera claims JWT); `firestore.rules` (create pending por owner); `scripts/fix-beta-functions-iam.sh` + `fix-beta-functions-public-invoker.sh` (runner invoker + `provisionTrialTenant` en lista); `scripts/test-beta-signup-provisioning-firestore.ts` (E2E).
- **Infra desplegada:** beta+prod — Firestore rules, `cumbreSignupProvisioningRunner`, `provisionTrialTenant`, hosting beta+prod. IAM Eventarc→Cloud Run invoker en `cumbresignupprovisioningrunner`; compute SA `roles/firebaseauth.admin` (beta).
- **Diagnóstico IAM org GEMA (org `1019962368971`):** `gcloud functions add-invoker-policy-binding … --member=allUsers|allAuthenticatedUsers` → **400** *permitted customer* (constraint `iam.allowedPolicyMemberDomains`). Callable Gen2 sigue **401/403** aunque el cliente envíe Firebase ID token (Cloud Run IAM antes del handler). Documentación interna confirma mismo patrón en agentes/webhooks.
- **Segundo bloqueo:** runner dispara pero Admin SDK Firestore en Cloud Run → **PERMISSION_DENIED** (ADC local con usuario admin **sí** escribe). Mismo patrón documentado ML webhook `persisted:false`. Panel jobs mitigan con REST + `id_token` usuario; provisioning trial aún requiere Admin SDK amplio o excepción org.
- **Impacto web:** Hosting beta/prod con fallback signup; signup **no E2E OK** hasta excepción org + Firestore admin Cloud Run.
- **Impacto asistente IA:** Sin cambio de copy; flujo trial signup sigue roto en producción hasta IAM org.
- **Validaciones:** `npm run build` functions OK; deploy Firebase OK; E2E script beta → **FAIL timeout** (callable 401; cola no completa claims).
- **Pendientes:** (1) Ticket admin org — excepción `allUsers`/`allAuthenticatedUsers` proyecto `cumbre-erp-beta` y `cumbre-erp-prod` (texto en `~/.cumbre-mirror/docs/CIERRE_PROYECTO_FINAL.md`); post-ticket `npm run beta:fix:functions-invoker` + prod equivalente. (2) Resolver denegación Firestore Admin SDK desde Cloud Run (compute SA) a nivel org/GCP. (3) Re-ejecutar `npx tsx scripts/test-beta-signup-provisioning-firestore.ts` y smoke signup UI.


## 2026-06-16 — Validación cierre completa (~/.cumbre-mirror)

- **Objetivo:** Re-auditoría cierre: `audit:cierre`, E2E 32×2, smoke Ola 1, suscripciones, curls prod, signup Firestore.
- **Archivos/docs:** `docs/AUDIT_CIERRE.latest.json`, `docs/AUDIT_CIERRE.latest.md`, `docs/SIGN_OFF_FINAL_2026-06-16.md`, `docs/CIERRE_PROYECTO_BALANCE_FINAL_2026-06-16.md`, sync banco/E2E desde mirror.
- **Impacto web:** Prod — `GET /wp-json/gema-payments/v1/cart` 200; `POST /gema/v1/agent/chat` y `/contact` 200 con `cumbre_synced:false`.
- **Impacto asistente IA:** Sin cambio; bridge CRM prod bloqueado por org policy/IAM.
- **Despliegue:** Solo validación; sin deploy.
- **Validaciones:**
  - `npm run audit:cierre`: **PARCIAL** (checklist 65.8%)
  - Banco: **30 PASS · 0 FAIL · 1 SKIP**
  - E2E beta+prod: **32/32 + 32/32**
  - `smoke-ola1-flujo-cliente.sh`: **15 pass · 0 fail · 1 skip**
  - `test:subscription:notifications`: **7/7 PASS**
  - Prod curls cart/agent/contact: **200**
  - `test-beta-signup-provisioning-firestore.ts`: **FAIL** (timeout provisioning; callable anon 401)
- **Pendientes:** P0-ORG IAM; re-ejecutar signup tras fix Firestore/IAM; checklist humano SIGN_OFF §B.

## 2026-06-16 — Cierre IAM signup + ticket org policy (agente continuidad)

- **Objetivo:** Resolver 403 `provisionTrialTenant`, documentar ticket GCP, workarounds, validar signup/`cumbre_synced`.
- **Agente 4a6d1b18:** transcript vacío (solo user_query) — trabajo retomado en esta sesión.
- **Mirror `~/.cumbre-mirror`:** `functions/src/index.ts` — `serviceAccount: firebase-adminsdk-fbsvc@…` en `wordpressIngestLead`, `provisionTrialTenant`, `provisionTrialTenantHttp`, `cumbreSignupProvisioningRunner`; deploy **beta+prod** OK (4 functions).
- **GEMA repo:** `wordpress/plugins/gema-leads-api/gema-leads-api.php` — Bearer opcional vía `GEMA_CUMBRE_INGEST_GCP_SA_JSON_PATH`; `.env.example` documentado.
- **GCP prod:** SA `gema-wp-cloudrun-ingest@cumbre-erp-prod.iam.gserviceaccount.com` + `roles/run.invoker` en `wordpressingestlead` y `provisiontrialtenanthttp` (sin `allUsers`).
- **Impacto web:** Fase C prod sin redeploy plugin en esta sesión — workaround WP requiere key SA + sync WP. `cumbre_synced` sigue **false** (403 anónimo + Admin SDK).
- **Impacto asistente IA:** Mantener: trial self-service no operativo; leads CRM sync pendiente IAM.
- **Despliegue:** Firebase functions beta+prod (4 fn); Firestore rules prod (sin cambio); WP prod **no** sincronizado automáticamente.
- **Validaciones:**
  - `prod:fix:functions-invoker` + `beta:fix:functions-invoker` → **14/14 ERROR 400** org policy (logs `/tmp/*-fix-invoker.log`).
  - Callable con ID token → **401** beta; anónimo → **403** prod.
  - `test-beta-signup-provisioning-firestore.ts` beta → **FAIL timeout**; runner logs **PERMISSION_DENIED** Firestore.
  - `docs/TICKET_ORG_POLICY_GCP_2026-06-16.md` §8 evidencia actualizada.
- **Pendientes:** Ticket admin org §1; investigación Firestore Admin SDK Cloud Run; key SA WP + deploy plugin; re-test contacto `cumbre_synced:true` post-fix.

### 2026-06-16 — Cloud Run Firestore PERMISSION_DENIED (diagnóstico + mitigación código)

- **Objetivo:** Desbloquear Admin SDK Firestore en Functions Gen2 (signup runner, wordpressIngestLead, agentChat, etc.).
- **Repo / mirror:** `~/.cumbre-mirror` — `functions/src/index.ts`, `scripts/fix-beta-functions-iam.sh`.
- **IAM ejecutado:** `npm run beta:fix:functions-iam` (parcial: falla bind SA `service-PROJECT@gcp-sa-cloudfunctions` inexistente); `npm run prod:fix:functions-iam` (parcial, mismos roles compute/firebase-adminsdk aplicados); bindings extra compute `firebase.admin`, `datastore.owner`, `secretmanager.secretAccessor`; `iam.serviceAccountUser` serverless-robot → firebase-adminsdk (beta+prod); Eventarc→Run invoker en runners Firestore (beta+prod).
- **Invoker público:** `beta:fix:functions-invoker` y `prod:fix:functions-invoker` — **bloqueados org policy** (`allUsers` / `allAuthenticatedUsers` no permitidos). Documentado en `docs/TICKET_ORG_POLICY_GCP_2026-06-16.md` §1–2.
- **Deploy:** beta — `cumbreSignupProvisioningRunner`, `wordpressIngestLead`, `agentChat` con SA `firebase-adminsdk-fbsvc`; prod — signup + wordpress SA actualizados (agentChat 409 en cola, reintentar).
- **Código:** `CUMBRE_FUNCTIONS_RUNTIME`, `preferRest` Firestore, `initializeApp({ projectId })`.
- **Tests:** `npx tsx scripts/test-beta-signup-provisioning-firestore.ts` — **FAIL** (timeout; runner log PERMISSION_DENIED post-deploy con firebase-adminsdk). Curl wordpress/agent sin `Authorization: Bearer` → 403 Cloud Run; con identity token + api-key pendiente validar post-org.
- **Impacto web:** Signup cola Firestore no completa provisioning; bridge WP y agentes HTTP siguen en 403 invoker hasta ticket org.
- **Impacto asistente IA:** Sin cambio de copy; trial/signup no E2E.
- **Despliegue:** Functions beta+prod (parcial); docs local workspace.
- **Pendientes P0 org:** Excepción `constraints/iam.allowedPolicyMemberDomains` + auditoría Firestore Data Access / VPC-SC para SAs Cloud Run (ver ticket §2).

### 2026-06-16 — Infra cumbre-mirror: IAM, hosting beta, signup E2E, WP ingest

- **Objetivo:** Cerrar pendientes infra desde `~/.cumbre-mirror` (IAM Firestore, invoker, hosting beta allowlist, repair tenant prod, WP SA path).
- **Archivos / servicios:** `scripts/fix-beta-functions-iam.sh`, `scripts/fix-beta-functions-public-invoker.sh`, hosting `cumbre-erp-beta`, Cloud Run `cumbresignupprovisioningrunner`, SA `firebase-adminsdk-fbsvc`, SA `gema-wp-cloudrun-ingest`, tenant prod `tenant_uSZIyj2x_usziyj2xlzef`.
- **Subagentes 5facc019 / 1f40b736:** transcripts sólo 2 líneas (arranque, sin merge ni commits); trabajo ejecutado en esta sesión.
- **Web:** hosting beta desplegado con `VITE_CUMBRE_SIGNUP_ALLOWED_DOMAINS=gema-digital.com,generatuenergia.net` (verificado en bundle live).
- **Asistente IA:** sin cambio de conocimiento en esta pasada.
- **Producción:** repair signup tenant prod OK (32 módulos); hosting beta sí; functions invoker `allUsers` sigue bloqueado.
- **Validaciones:** `npm run beta:fix:functions-iam` beta+prod OK; `prod:fix:functions-invoker` FAIL org policy; `beta:test:signup-provisioning` FAIL timeout (runner Firestore PERMISSION_DENIED); repair prod tenant PASS; curl live beta allowlist PASS.
- **Pendientes / org ticket:** (1) `constraints/iam.allowedPolicyMemberDomains` — `allUsers`/`allAuthenticatedUsers` en Cloud Run Gen2; (2) Admin SDK Firestore PERMISSION_DENIED en Cloud Run pese a `datastore.owner` en `firebase-adminsdk-fbsvc`; (3) `constraints/iam.disableServiceAccountKeyCreation` — no se puede crear JSON para `GEMA_CUMBRE_INGEST_GCP_SA_JSON_PATH` en WP (usar invoker SA ya configurado cuando org permita callables o WIF futuro).

### 2026-06-16 — Agente c443a88a resume: IAM signup + E2E (Norberto ALL authorized)

- **Objetivo:** Completar fix IAM Firestore Cloud Run (beta+prod), invoker, E2E signup Firestore queue, actualizar docs cierre/ticket.
- **Infra / mirror:** `~/.cumbre-mirror` — `npm run beta:fix:functions-iam`, `npm run prod:fix:functions-iam`, `beta:fix:functions-invoker`, `prod:fix:functions-invoker`; redeploy parcial `cumbreSignupProvisioningRunner` beta (409 conflict en update).
- **IAM aplicado:** `roles/datastore.user`, `roles/firebase.admin`, `roles/datastore.owner`, `roles/secretmanager.secretAccessor` en compute default SA + `firebase-adminsdk-fbsvc` (beta); prod `firebase-adminsdk-fbsvc` recibió **`roles/datastore.owner`** (faltaba vs beta). Eventarc/run.invoker en job runners incl. `cumbresignupprovisioningrunner`. Errores benignos: SA `gcp-sa-cloudfunctions` aún inexistente en ambos proyectos.
- **Invoker público:** **14/14 functions** beta+prod → ERROR 400 org policy `iam.allowedPolicyMemberDomains` (`allUsers` / `allAuthenticatedUsers`). Callable probe signup → **401** beta (IAM Run antes del handler).
- **Impacto web:** Signup self-service y `cumbre_synced` sin cambio hasta ticket org §1. Cola Firestore signup sigue sin completar tenant.
- **Impacto asistente IA:** Mantener mensaje trial no self-service; no prometer alta automática prod.
- **Despliegue:** Solo IAM gcloud + intento deploy single function; **no** deploy WP ni prod hosting.
- **Validaciones:**
  - `npx tsx scripts/test-beta-signup-provisioning-firestore.ts` → **FAIL** timeout 120s (cola creada; status `pending`).
  - Cloud Logging `cumbresignupprovisioningrunner` → **PERMISSION_DENIED** Admin SDK (`WriteBatch.commit`, REST fallback).
  - `npm run beta:test:agents-firestore-job -- --from-credentials` → **PASS** ok:true (lite/LLM; no prueba persistencia Admin SDK completa).
  - Diagnóstico local: Firestore REST con `gcloud auth print-access-token` (usuario owner) → **200**; `@google-cloud/firestore` / `firebase-admin` con ADC → **PERMISSION_DENIED** (mismo síntoma que Cloud Run con SA admin).
- **Pendientes / ticket GCP (exhaustivo):** (1) Override org `iam.allowedPolicyMemberDomains` beta+prod; (2) Ticket secundario org/security: Firestore API denegada a SAs pese a `datastore.owner` — auditar VPC-SC, IAM deny policies, Data Access audit logs en `firestore.googleapis.com`; (3) Re-ejecutar invoker scripts post-(1); (4) Re-test signup E2E; (5) WP workaround SA JSON si aplica.


### 2026-06-16 — Script post-org-policy:fix (orquestación post-ticket GCP)

- **Objetivo:** Un solo comando tras aprobación org policy: invoker, IAM, signup E2E, bridge WP `cumbre_synced`, auditoría cierre fast y resumen PASS/FAIL.
- **Archivos / infra:** `~/.cumbre-mirror/scripts/post-org-policy-fix.sh`; `~/.cumbre-mirror/package.json` → `npm run post-org-policy:fix`; `~/.cumbre-mirror/docs/ENTREGA_FINAL_PROYECTO_2026-06-15.md` § org policy.
- **Docs GEMA:** `docs/EMAIL_TICKET_GCP_NORBERTO_2026-06-16.md` § Post-aprobación; `docs/TICKET_ORG_POLICY_GCP_2026-06-16.md` §5–7; `docs/CIERRE_PROYECTO_BALANCE_FINAL_2026-06-16.md` §7.3.
- **Impacto web:** Sin deploy; tras ejecución exitosa se espera `cumbre_synced:true` en contacto/agente y signup self-service desbloqueado (validación en script).
- **Impacto asistente IA:** Tras OVERALL PASS, alinear mensajes trial self-service y bridge CRM con estado operativo prod.
- **Despliegue:** Solo mirror local + documentación; **no** ejecutado contra GCP en esta tarea (org policy aún pendiente admin).
- **Validaciones:** `bash -n scripts/post-org-policy-fix.sh` OK; npm script registrado.
- **Pendientes:** Admin org aprueba excepción → Norberto ejecuta `npm run post-org-policy:fix` y archiva salida en ticket.

### 2026-06-16 — Verificación beta asistida «Genera tu energía» (path 100% infra)

- **Objetivo:** Confirmar path asistido Norberto: bootstrap dogfood, claims, E2E paneles 32/32; actualizar guías y pre-validación Bloque D.
- **Archivos/docs:** `docs/GUIA_PRUEBA_GENERA_TU_ENERGIA_2026-06-16.md`, `docs/SESSION_PRUEBA_COMPLETA_2026-06-16.md`, `docs/BETA_DOGFOOD_PANELS_E2E.latest.json`, `REGISTRO_DE_TRABAJO_GEMA.md`.
- **Infra (`~/.cumbre-mirror`):** `npm run beta:bootstrap:dogfood` OK; `npm run beta:apply-claims -- … tenant_prueba_interna owner` OK; `npm run beta:e2e:dogfood-panels` **32/32 PASS** (auditoría 64/64 beta+prod).
- **Impacto web:** Sin deploy; tenant dogfood beta listo para login manual pasos 14–23.
- **Impacto asistente IA:** Sin cambio; trial self-service y `cumbre_synced` siguen bloqueados P0-ORG.
- **Despliegue:** Solo local/docs + sync JSON E2E desde mirror.
- **Validaciones:** ADC OK; bootstrap 32 módulos; claims uid KZEBeCAzt…; E2E 2026-06-16T08:09Z.
- **Pendientes:** Sesión manual Norberto — Bloque D UI (CRM→Hermes); signup prod y bridge web→CRM fuera de alcance asistido.
- **Listo sesión manual Norberto (beta asistida infra):** **SÍ** — proceder con `SESSION_PRUEBA_COMPLETA` Bloques A–D (D operativo manual; infra pre-validada).


### 2026-06-16 — Sync final mirror Cumbre → docs GEMA + índice cierre

- **Objetivo:** Alinear `docs/` del repo web GEMA con el espejo `~/.cumbre-mirror/docs` (artefactos `.latest.json`, AUDIT_CIERRE, BANCO_PRUEBAS); verificar web; smoke integración; índice maestro de cierre.
- **Archivos afectados:** 73× `docs/**/*.latest.json`; `docs/AUDIT_CIERRE.latest.{json,md}`; `docs/BANCO_PRUEBAS_COMPLETO.{md,latest.json,latest.md}`; nuevo `docs/INDICE_CIERRE_DOCUMENTACION_2026-06-16.md`; `REGISTRO_DE_TRABAJO_GEMA.md`.
- **Impacto web:** Sin deploy producción. Verificado presentes: `wordpress/theme-gema-sovereign/parts/header.html`, plugins `gema-agent-api`, `gema-leads-api`, `gema-payments-platform`, `gema-notifications-orchestrator`, `gema-cumbre-subdomains`.
- **Impacto asistente IA:** Documentación de cierre y banco de pruebas actualizada en repo GEMA para consulta local; mensajes comerciales sin cambio en esta tarea.
- **Despliegue:** Solo local / Google Drive workspace; **sin** commit git (pedido explícito usuario).
- **Validaciones:**
  - Paridad mirror ↔ GEMA: **78** artefactos (73 JSON + 5 AUDIT/BANCO), **0** mismatches post-sync.
  - `scripts/sync-test-reports-from-cumbre.sh` ejecutado (UNIFIED_TEST_BANK / INTEGRACION_PREFLIGHT ausentes en mirror — esperado).
  - `scripts/smoke-integracion-web-cumbre.sh` → **16 pass, 0 fail, 3 skip** (REST payments/cart/agent sin assert local).
  - Docs operativos presentes: `SESSION_PRUEBA_COMPLETA_2026-06-16.md`, `ENTREGA_FINAL_OPERATIVA_2026-06-16.md`, `EMAIL_TICKET_GCP_NORBERTO_2026-06-16.md`.
- **Pendientes:** Commit opcional usuario; ticket org GCP §1; sesión manual Bloque D según SESSION.

### 2026-06-16 — CIERRE DEFINITIVO AGENTES

- **Objetivo:** Batería final autorizada Norberto (ALL) en `~/.cumbre-mirror` + evidencia prod GEMA; cerrar documentación sin regresión vs corrida 08:18Z.
- **Comandos:** `audit:cierre` (×2), `beta:e2e:dogfood-panels`, `prod:e2e:dogfood-panels`, `bash scripts/smoke-ola1-flujo-cliente.sh`, `test:subscription:notifications`, `beta:test:signup-provisioning`, curls prod cart/agent/contact.
- **Archivos / reportes:** `docs/AUDIT_CIERRE.latest.{json,md}`, `docs/BETA_DOGFOOD_PANELS_E2E.latest.json`, `docs/PROD_DOGFOOD_PANELS_E2E.latest.json`, `docs/AUDITORIA_MODULO_A_MODULO.latest.json`, `docs/BANCO_PRUEBAS_COMPLETO.latest.*`, `docs/CIERRE_PROYECTO_BALANCE_FINAL_2026-06-16.md`, `docs/ENTREGA_FINAL_OPERATIVA_2026-06-16.md`, `docs/PRUEBA_INTEGRADA_FINAL_2026-06-16.md`.
- **Impacto web:** Sin deploy. Prod: cart/agent/contact **200**; bridge CRM `cumbre_synced:false` (org policy).
- **Impacto asistente IA:** Mantener trial no self-service y bridge CRM pendiente hasta ticket org; sin cambio de copy en esta corrida.
- **Despliegue:** Solo validación; **no** producción Cumbre/WP desplegado en esta pasada.
- **Validaciones (2026-06-16T11:47–11:58Z):**
  - E2E **64/64 PASS** (beta+prod 32/32 c/u).
  - Banco **30 PASS · 0 FAIL · 1 SKIP**.
  - Smoke Ola 1 **15/0/1**.
  - Suscripciones/notificaciones **7/7 PASS**.
  - Signup provisioning **FAIL** timeout (esperado hasta org policy).
  - Veredicto auditoría **PARCIAL** + **STABLE FINAL** vs 08:18Z.
- **Pendientes:** Ticket org GCP §1; P0 PLAN_CIERRE (Fase C deploy, checkout UI, signup self-service); sesión manual Norberto en `SESSION_PRUEBA_COMPLETA`.

### 2026-06-16 — Video 02 master 16:9 remontado + fixes pipeline Python

- **Objetivo:** Cerrar piloto Video 02 (presentación marca GEMA) con capturas web frescas y master 16:9; alinear scripts del hub `15-Produccion-Audiovisual`.
- **Archivos afectados:** `15-Produccion-Audiovisual/marketing/04-output/video-02-gema-presentacion-marca/master-16x9.mp4` (61.1 s); capturas `b1`–`b4`; `marketing/01-videos/scripts/aplicar-logo-flow.py` (`--video` batch); `requirements-audio.txt` + `pip install python-dotenv`.
- **Impacto web:** Sin deploy. Assets listos para revisión/aprobación y futura publicación YouTube/web.
- **Impacto asistente IA:** Sin cambio de copy; motor audiovisual TS genera `motor-guion-generado.json` (fallback offline desde guión markdown).
- **Despliegue:** Solo local (Google Drive hub audiovisual).
- **Validaciones:** `montar-video-serie.py --video 02` → ok=1; capturas 16:9 ok=4; motor `smoke:offline --video=02` → 8 escenas; `python-dotenv` instalado para ElevenLabs.
- **Pendientes:** Revisar `master-16x9.mp4`; refrescar capturas 9x16 y remontar `short-9x16.mp4`; logo Flow solo si hay clips en `flow-crudo/` (escenas Veo API ya en `ia/16x9/`); `PORTKEY_API_KEY` real opcional para LLM remoto.

### 2026-06-16 — Bug fix loop (continuación agente 49921076)

- **Objetivo:** Cerrar loop fix→deploy→retest con 0 FAIL fixable en `test:matrix:500:fast` + `bug:hunt:deep`.
- **Archivos afectados (mirror):** `firestore.rules`, `functions/src/index.ts`, `shared/agenteChatbot.ts`, `shared/agenteChatbotRuntime.ts`, `scripts/run-deep-bug-hunt.ts`, `scripts/run-comprehensive-test-matrix.ts`, `scripts/test-beta-signup-provisioning-firestore.ts`, `scripts/package-wp-gema-agent.sh`.
- **Archivos afectados (GEMA):** `wordpress/plugins/gema-agent-api/includes/class-gema-agent-chat-service.php`, `wordpress/theme-gema-sovereign/assets/gema-floating-agent.js`, `docs/BUGS_FOUND_2026-06-16.{md,json}`, `docs/BUG_FIX_LOOP_REPORT_2026-06-16.md`, `docs/DEEP_BUG_HUNT.latest.json`, `docs/COMPREHENSIVE_TEST_MATRIX_2026-06-16.{md,json}`, `scripts/sync-test-reports-from-cumbre.sh`.
- **Impacto web:** Deploy prod `gema-agent-api` v1.0.0 — agente IA respuestas diferenciadas (BUG-004 FIXED). Formulario contacto OK; bridge CRM sigue `cumbre_synced:false` (KNOWN_BLOCKER org policy).
- **Impacto asistente IA:** Intents trial/cobros/negocios/precio con respuestas distintas en PHP fallback + runtime Cumbre; check `web:agent_reply_diversity` 3/3 PASS.
- **Despliegue:** Firestore rules beta+prod ✅; functions beta ✅; WP agent prod ✅; functions prod runner pendiente aprobación deploy (mismo blocker org policy).
- **Validaciones (iteración 2, 2026-06-16T15:13–15:15Z):**
  - `bug:hunt:deep` → **33/33 PASS**, 0 bugs.
  - `test:matrix:500:fast` → **272 PASS · 0 FAIL · 233 SKIP**, veredicto PASS.
  - `audit:cierre` → banco PASS; PARCIAL por P0 org policy documentados.
- **Pendientes:** Ticket org GCP §1; tras excepción `SIGNUP_PROVISIONING_RUN=1` + `post-org-policy:fix`; deploy functions prod runner (opcional, no desbloquea sin ticket).


### 2026-06-16 — Deploy beta + recorrido único web→bot→contact→trial→módulo

- **Objetivo:** Desplegar beta (functions, rules, hosting con flags signup), crear y ejecutar `test-one-full-journey.ts`; corregir blockers de código; documentar solo blockers GCP; evaluar `test:matrix:500:fast`.
- **Archivos / infra (`~/.cumbre-mirror`):** deploy `firestore:rules` + `storage` OK; `deploy:beta:functions` OK salvo IAM invoker en `cumbreMercadoLibreWebhook` / `cumbreWhatsappWebhook` (org policy); hosting `cumbre-erp-beta` OK con `VITE_CUMBRE_SIGNUP_PUBLIC=true` y dominios permitidos en `.env.beta.local`. Nuevo `scripts/test-one-full-journey.ts`, npm `beta:test:one-full-journey`. Fixes TS: `scripts/lib/userJourneyPersonas.ts`, `scripts/run-user-journey-simulation.ts` (build beta).
- **Checklist:** `PLATAFORMA_COMPLETA_CHECKLIST` **no existe** en mirror ni repo GEMA; referencia operativa: `docs/BATERIA_PRUEBAS_PLATAFORMA.md`.
- **Impacto web:** Hosting beta actualizado (`https://cumbre-erp-beta.web.app`); signup público habilitado en build beta. Bridge WP→Cumbre sigue `cumbre_synced:false` (GCP).
- **Impacto asistente IA:** Sin cambio de copy; trial self-service y sync CRM siguen P0-ORG hasta `post-org-policy:fix`.
- **Despliegue:** Beta rules + hosting + functions (parcial IAM webhooks) en GCP; código mirror local.
- **Validaciones:** `npm run beta:test:one-full-journey` → **OK** (PASS web, bot, módulos dogfood+hosting; **BLOCKED_GCP** contacto `cumbre_synced=false`, trial timeout runner). `npm run build:beta` OK.
- **Pendientes:** Admin org policy → `npm run post-org-policy:fix`; entonces re-ejecutar journey y **`npm run test:matrix:500:fast`** (no ejecutado: plataforma aún no REAL en beta por blockers contact/trial). Functions deploy exit 2 por webhooks MP/WhatsApp invoker.


### 2026-06-16 — Deploy blanket Norberto (ADC → beta+prod Cumbre + WP prod + smoke)

- **Objetivo:** Pipeline autónomo desde `~/.cumbre-mirror`: ADC, deploy functions/hosting/rules beta y prod, invoker fix, `sync-wordpress-prod.sh`, smokes/curls post-deploy.
- **Archivos afectados (mirror, pre-deploy build):** `shared/paymentSimulation.ts` (`origen === "manual"`), `shared/trialConversionSandbox.ts` (imports no usados), `shared/agenteSuscripcionesRuntime.ts` (payload checkout sin `contacto_email` inexistente). Log: `docs/DEPLOY_RUN_2026-06-16.log`.
- **Impacto web:** Hosting **beta+prod** desplegado; Firestore rules **beta+prod**; WP prod Fase C (5 plugins + theme) sincronizado vía SSH; cart/agent **200** post-deploy.
- **Impacto asistente IA:** Agente WP **200** `ok:true`; diversidad y bridge sin cambio de copy; `cumbre_synced` sigue limitado por org policy en contacto/trial.
- **Despliegue:** **Producción GCP + WP** (autorización blanket Norberto). Functions: código actualizado; **exit 2** en prod (y parcial beta) por IAM invoker `cumbreMercadoLibreWebhook` + `cumbreWhatsappWebhook` (org policy 400). Retry prod: `provisionTrialTenantHttp` OK; webhooks IAM pendiente.
- **Validaciones:**
  - `npm run beta:check:adc` → **OK** (backup API beta).
  - `deploy:beta:functions` → script **OK** (409 transitorio `agentChat` en cola).
  - `deploy:prod:functions` → **FAIL** 1ª pasada; **retry** despliega funciones salvo IAM 2 webhooks.
  - `deploy:beta:hosting` / `deploy:prod:hosting` → **OK**.
  - Firestore rules beta+prod → **OK**.
  - `prod:fix:functions-invoker` + `beta:fix:functions-invoker` → ejecutados; **400 org policy** en todos los bindings (loggeado).
  - `scripts/sync-wordpress-prod.sh` → **OK** (smoke integrado cart/agent PASS).
  - `test-web-prod-smoke.sh` → **8/0**; `smoke-integracion-web-cumbre.sh` → **16/0/3 skip**; `smoke-ola1-flujo-cliente.sh` → **15/0/1 skip**; curls hosting ERP **200**.
- **Pendientes:** Excepción org policy GCP §1; re-ejecutar deploy functions si se requiere exit 0 limpio; contacto curl validación completa con payload `nombre/telefono/empresa` (sync script ya PASS contact).

### 2026-06-16 — GEMA dogfood stack Cumbre (CRM + Cobros + Agente, tenant único)

- **Objetivo:** Norberto — GEMA Digital como primer usuario real: Cumbre Cobros = plataforma de cobros, Cumbre Agente = bot comercial, Cumbre CRM = CRM GEMA; web → un tenant (`tenant_gema_prod_interno`), sin sistemas paralelos.
- **Archivos mirror (`~/.cumbre-mirror`):** `shared/gemaCumbreTenant.ts`, `shared/gemaCumbreTenantSeed.ts`, `shared/seedTrialTenantDogfood.ts` (merge GEMA+dogfood), `scripts/bootstrap-gema-cumbre-first-user.ts`, `scripts/apply-gema-cumbre-team-claims.ts`, `scripts/sync-agente-gema-ia-beta.ts`.
- **Archivos GEMA web:** `docs/GEMA_DOGFOOD_CUMBRE_STACK_2026-06-16.md`, `docs/HERRAMIENTAS_CUMBRE_GEMA_2026-06-16.md`, `scripts/gema-cumbre-tools.sh`, `docs/PROD_DOGFOOD_PANELS_E2E.latest.json`.
- **Impacto web:** Sin redeploy WP en esta pasada (Fase C ya desplegada). Widget agente → proxy `agentChat`; leads → `wordpressIngestLead`; pagos → SKUs Cumbre + tenant GEMA en wp-config.
- **Impacto asistente IA:** Registry agentes en Firestore (`cumbre_herramientas/agents_registry`); perfil `gema_comercial` re-sincronizado; pipeline CRM GEMA con leads web/agente/carrito demo.
- **Despliegue:** **Prod Firestore** bootstrap + claims (autorizado Norberto). Hosting/functions sin cambio en esta pasada.
- **Validaciones:**
  - `bootstrap:gema:cumbre-first-user:prod` → OK (33 módulos, 29 docs GEMA merge, 9 docs integraciones credentials).
  - `gema:apply-claims:team:prod` → OK (`beta@`, `info@`, `norberto@` owner).
  - `prod:e2e:dogfood-panels` → **32/33 PASS** (prod audit **32/32** módulos); CRM + Cobros + Agente chatbot PASS.
  - `test:web:prod` → **8/8 PASS**.
- **Pendientes:** 1 panel `studio_ia` nav (33/33 cosmético); CUIT/ARCA definitivo; bridge contacto org policy §1 sin cambio.


### 2026-06-16 — Deploy WP prod `gema-payments-platform` v0.2.3 (Nave + transfer activos)

- **Objetivo:** Publicar en producción el catálogo de medios de pago con Nave Galicia y transferencia bancaria activos en checkout; Mercado Pago / Mercado Libre y otros globales en estado deferred («Próximamente»).
- **Archivos afectados:** `wordpress/plugins/gema-payments-platform/gema-payments-platform.php` (v0.2.3); deploy vía `scripts/sync-wordpress-prod.sh` con `SKIP_WP_CONFIG=1` (sin tocar wp-config). También sincronizados en la misma pasada: `gema-agent-api`, `gema-leads-api`, `gema-notifications-orchestrator`, `gema-cumbre-subdomains`, `theme-gema-sovereign`.
- **Impacto web:** REST `/wp-json/gema-payments/v1/providers` y carrito exponen `active_providers: [nave, bank_transfer]` y MP/ML deferred; checkout UI en `/erp/precios` consume esos campos.
- **Impacto asistente IA:** Sin cambio de copy en esta pasada; coherencia comercial con medios activos vía API pagos.
- **Despliegue:** **Producción WP** (`gema-web-server`, `gema-digital.com`). Pre: plugin prod v0.2.2; post: v0.2.3 confirmado en VM.
- **Validaciones:**
  - Script smoke integrado: cart `ready_for_commercial` PASS; agent PASS; contact PASS.
  - `curl` providers: `active_providers` nave + bank_transfer `checkout_active:true`; mercado_pago/mercado_libre `status:deferred`.
  - `curl` cart checkout: mismos `active_providers` y `deferred_providers` incluye mercado_pago, mercado_libre, paypal, stripe.
- **Pendientes:** Credenciales Nave/transfer (`configured:false`); org policy bridge contacto sin cambio; MP/ML cuando haya credenciales y decisión comercial.

### 2026-06-16 — Beta E2E dogfood 33/33 (Automatizaciones + readiness Genera tu energía)

- **Objetivo:** Cerrar regresión beta `tenant_prueba_interna` (reportes BI, Automatizaciones, Studio IA) para habilitar prueba asistida «Genera tu energía» con E2E 33/33 alineado a prod.
- **Archivos mirror (`~/.cumbre-mirror`):** `shared/automatizaciones.ts`, `shared/automatizacionesReadiness.ts` (validadores tolerantes a campos ausentes); `shared/gemaCumbreOperationalConfigs.ts` (`buildGemaAutomatizacionesDemoDocs`); `shared/gemaCumbreTenantSeed.ts` (semilla flujo+ejecución demo); `scripts/repair-beta-automatizaciones-demo.ts` + npm `beta:repair:automatizaciones-demo`; `package.json`.
- **Archivos GEMA web:** `docs/BETA_DOGFOOD_PANELS_E2E.latest.json`, `docs/AUDITORIA_MODULO_A_MODULO.latest.json` (sync); `REGISTRO_DE_TRABAJO_GEMA.md`.
- **Impacto web:** Sin redeploy hosting beta en esta pasada. Reparación Firestore beta (`cumbre-erp-beta`) sobre `tenant_prueba_interna`.
- **Impacto asistente IA:** Sin cambio de copy; readiness técnico V2 «Genera tu energía» desbloqueado (E2E beta = prod 33/33).
- **Despliegue:** Solo **Firestore beta** (repair demo Automatizaciones). Código mirror local; **pendiente** `deploy:beta:hosting` para validadores defensivos en bundle.
- **Validaciones:**
  - Repro inicial agente: **30/33** (`reportes_bi` map, `automatizaciones` trim, `studio_ia` nav).
  - Repro sesión: **32/33** (reportes BI + Studio IA ya PASS en hosting actual).
  - `beta:repair:automatizaciones-demo` → OK (1 doc parcial legacy eliminado + flujo/ejecución demo sembrados).
  - `npm run beta:e2e:dogfood-panels` → **33/33 PASS** (2026-06-16T19:32Z). Prod sigue **33/33**.
- **Pendientes:** Desplegar hosting beta con parche validadores (resiliencia ante docs parciales); opcional `beta:repair:automatizaciones-demo` en runbook post-bootstrap.

### 2026-06-17 — Post-CyberPanel Verified: prueba SMTP prod (email aún bloqueado)

- **Objetivo:** Validar pipeline email WP tras verificación de dominio en CyberPanel Cloud Email (confirmación Norberto).
- **Archivos / docs:** `docs/JOURNEY_001_UNICO_2026-06-16.md` (sección post-CyberPanel Verified); este registro.
- **Impacto web:** Sin redeploy. Endpoints prod: `gema-notifications/v1/mail/diagnostic`, `gema/v1/contact`.
- **Impacto asistente IA:** Sin cambio; emails comerciales HTML siguen bloqueados por SMTP.
- **Despliegue:** Solo pruebas HTTP/SMTP contra prod; **local**.
- **Validaciones:**
  - curl mail diagnostic → **`email_sent: false`**
  - POST contacto journey QA → **`email_sent: false`**, `sales_alert_to: info@gema-digital.com`
  - Probe SMTP `mail.cyberpersons.com:587` → **`550 5.7.1 sender domain not verified`**
  - DNS: SPF/DMARC OK; **`postal._domainkey.gema-digital.com` NXDOMAIN**
  - Journey 001 real **no re-ejecutado** (gate `email_sent: true`)
- **Nota operativa:** Cuenta Cloudflare documentada **info@generatuenergia.net** (referencia, no credenciales).
- **Pendientes:** Publicar DKIM postal en Cloudflare si falta; Re-check DNS en CyberPanel; repetir diagnostic; `gcloud auth login` en máquina operador para wp-cli/PHPMailer en VM si persiste 550 con panel en verde.

### 2026-06-17 — Diagnóstico/fix SMTP prod vía gcloud (bloqueo auth local)

- **Objetivo:** SSH a `gema-web-server`, alinear `admin_email`/wp-config/WP Mail SMTP y validar diagnostic HTTP.
- **Archivos:** `scripts/fix-wordpress-smtp-prod.sh` (default From `info@`); `scripts/fix-wordpress-smtp-remote.py` (fuerza `admin_email` info@, CC Norberto, PHPMailer debug en fallo).
- **Impacto web:** Sin cambios en prod (no hubo SSH). Diagnostic prod sigue `email_sent: false`.
- **Impacto asistente IA:** Sin cambio.
- **Despliegue:** Solo local (parche scripts). Prod **no** aplicado: `gcloud auth login` requerido (invalid_rapt / no interactivo).
- **Validaciones:**
  - `gcloud compute ssh` → reauth failed (cuenta `info@gema-digital.com`).
  - `fix-wordpress-smtp-prod.sh` → falló en `sync-wordpress-prod.sh` mismo error gcloud.
  - curl diagnostic → `email_sent: false`, `admin_email: ventas@gema-digital.com`, `cc_targets: []`.
  - Probe SMTP local `mail.cyberpersons.com:587` → **550 5.7.1 sender domain not verified** en `MAIL FROM:<info@gema-digital.com>` (auth OK).
- **Pendientes:** Norberto ejecutar `gcloud auth login` y re-correr `bash scripts/fix-wordpress-smtp-prod.sh`; completar DKIM/DNS CyberPanel (`postal._domainkey`); repetir diagnostic hasta `email_sent: true`. Doc: `docs/FIX_EMAIL_INFO_GEMA_2026-06-17.md`.

### 2026-06-17 — Doc FIX_EMAIL_INFO_GEMA + default From remote.py

- **Objetivo:** Documentar diagnóstico completo email info@ y alinear default SMTP From en script remoto.
- **Archivos:** `docs/FIX_EMAIL_INFO_GEMA_2026-06-17.md`; `scripts/fix-wordpress-smtp-remote.py` (default `GEMA_SMTP_FROM` → `info@gema-digital.com`).
- **Impacto web:** Sin redeploy prod (gcloud auth bloqueado). Diagnostic sigue `email_sent: false`, `admin_email: ventas@`, `cc_targets: []`.
- **Impacto asistente IA:** Sin cambio hasta entrega SMTP OK.
- **Despliegue:** Solo local.
- **Validaciones:** curl diagnostic vía subagent shell (red OK allí): JSON arriba; probe SMTP 550.
- **Pendientes:** Mismos que entrada anterior — `gcloud auth login` + fix script + DKIM Cloudflare.

### 2026-06-17 — SMTP prod: MAIL FROM info@ (wp_mail_smtp ventas@ corregido)

- **Objetivo:** Corregir drift `wp_mail_smtp.mail.from_email` (`ventas@`) vía SSH; validar diagnostic; reforzar `fix-wordpress-smtp-remote.py`.
- **Archivos:** `scripts/fix-wordpress-smtp-remote.py` (merge opción existente + `wp eval` fuerza From/scrub ventas@); prod `wp_mail_smtp`, `admin_email`.
- **Impacto web:** Prod — `admin_email` = `info@gema-digital.com`; WP Mail SMTP `from_email` = `info@`, force true; `GEMA_SALES_ALERT_CC` presente en wp-config.
- **Impacto asistente IA:** Sin cambio; journeys siguen gate `email_sent: true`.
- **Despliegue:** Cambios WP en prod vía `gcloud compute ssh` (wp-cli eval); script remoto actualizado solo local repo.
- **Validaciones:**
  - PHPMailer trace prod → **`MAIL FROM:<info@gema-digital.com>`** (ya no ventas@).
  - curl diagnostic `{}` → `cc_targets: [norberto@]`, `admin_email: info@`, **`email_sent: false`**.
  - curl con `"to":"info@"` → `cc_targets: []` (comportamiento endpoint: `to` reemplaza targets).
  - `dig postal-gemadi._domainkey` @1.1.1.1/@8.8.8.8 → TXT DKIM OK; resolver default → `"Blocked"` (Cloudflare/local DNS, no NXDOMAIN).
  - SMTP relay → **`550 5.7.1 sender domain not verified`** en `MAIL FROM info@` (bloqueo CyberPersons, no WP From).
- **Pendientes:** Re-validar dominio/DKIM en CyberPanel Cloud Email hasta aceptar `MAIL FROM info@`; luego repetir diagnostic hasta `email_sent: true`.

### 2026-06-17 — Google Workspace SMTP relay prod OK + journey 001 real

- **Objetivo:** Validar envío SMTP tras regla relay Workspace (**GEMA WordPress prod**, IP 34.44.222.151, dominios propios, TLS) y re-ejecutar journey 001 con notificaciones reales.
- **Archivos / servicios:** Prod WordPress `gema-notifications` mail diagnostic; WP Mail SMTP; `~/.cumbre-mirror` runner `test:journeys:1:real`; docs `JOURNEY_001_UNICO_2026-06-16.md`; `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` (copiado desde mirror).
- **Impacto web:** Email transaccional prod operativo (`email_sent: true` en diagnostic). Contacto S03 y orchestrator WP envían vía wp_mail.
- **Impacto asistente IA:** Sin cambio de copy; journeys 002+ siguen gate aprobación Norberto.
- **Despliegue:** Sin cambio de código prod; configuración relay en Google Admin (acción Norberto).
- **Validaciones:**
  - curl diagnostic `{}` → `ok: true`, `email_sent: true`, `admin_email: info@gema-digital.com`, `cc_targets: [norberto@gema-digital.com]`.
  - `JOURNEY_REAL_NOTIFICATIONS=1 npm run test:journeys:1:real` → PASS 1/1; Hermes sent 2 fail 0; WP events sent 2 skip 0 fail 0.
- **Pendientes:** Confirmación visual inbox (asuntos `[GEMA TEST]`, `[GEMA] Contacto web`, HTML trial); ADC `invalid_rapt` en S03 (cumbre_synced=false) — no bloquea email; aprobación copy antes journey 002.

### 2026-06-17 — Re-run journey 001 real (asuntos admin sin journey_id)

- **Objetivo:** Tras quitar `journey_001` de asuntos/cuerpos admin, re-ejecutar `test:journeys:1:real` para validar entrega a inbox Norberto.
- **Archivos / servicios:** `~/.cumbre-mirror` runner; prod WP `gema-leads-api` + `gema-notifications-orchestrator`; `docs/USER_JOURNEY_SIMULATION_2026-06-16.json` (mirror copiado).
- **Impacto web:** Emails admin vía wp_mail en S03 + orchestrator S07/S11 (2 eventos WP).
- **Impacto asistente IA:** Sin cambio de copy.
- **Despliegue:** Sin cambio de código en esta corrida (validación post-fix previo).
- **Validaciones:** `JOURNEY_REAL_NOTIFICATIONS=1 npm run test:journeys:1:real` → PASS 1/1; Hermes 2/0; WP orchestrator 2/0; S03 `sales_email=wp_mail`. Asuntos admin esperados (sin `journey_001`): `[GEMA Admin] Nuevo contacto web — Juan Pérez (Solar Norte Energías SA)`; `[GEMA Admin] Trial iniciado — Juan Pérez (Solar Norte Energías SA)`; `[GEMA Admin] Pre-cargo día 14 — Juan Pérez (Solar Norte Energías SA)`.
- **Pendientes:** Confirmación visual inbox Norberto; ADC `invalid_rapt` S03 (no bloquea email).

### 2026-06-17 — Journey 001 S09 trial REAL (provisionJourneyTrial)

- **Objetivo:** Ejecutar `test:journeys:1:real` con alta trial real (no mock S09) para persona Juan Pérez / lead ADC `ld_7849f8f4`.
- **Archivos:** `~/.cumbre-mirror/scripts/lib/userJourneyProvisioning.ts` (import `CUMBRE_APP_ID` + `auth.createUser` en fallback ADC); `docs/USER_JOURNEY_SIMULATION_2026-06-16.json`; `docs/JOURNEY_001_UNICO_2026-06-16.md`.
- **Impacto web:** Sin redeploy WP.
- **Impacto asistente IA:** Sin cambio; CRM interno sigue con lead en `tenant_gema_prod_interno`.
- **Despliegue:** Parche provisioning solo en `~/.cumbre-mirror` (pendiente sync a repo principal si aplica).
- **Validaciones:** `JOURNEY_REAL_NOTIFICATIONS=1 npm run test:journeys:1:real` → PASS 1/1; S09 `mode=real`, `provisionJourneyTrial` (cola Firestore timeout → fallback ADC `runProvisionTrialTenant`); **tenant trial:** `tenant_journey__journeyadcjo`, **33 módulos**, trial hasta 2026-07-01. S03 sigue `leadId=ld_7849f8f4` (bridge parcial, tenant trial no enlazado automáticamente al lead CRM).
- **Pendientes:** Activar runner `cumbreSignupProvisioningRunner` en beta para evitar timeout cola; enlazar lead Juan Pérez ↔ tenant trial en CRM si se requiere dogfood unificado.


### 2026-06-17 — WP prod: GEMA_ADMIN_EMAIL + CC admin@ (deploy)

- **Objetivo:** Aplicar en prod `GEMA_ADMIN_EMAIL=admin@gema-digital.com` y `GEMA_SALES_ALERT_CC` con `admin@`; redeploy plugins GEMA.
- **Archivos / servicios:** `scripts/sync-wordpress-prod.sh` (SKIP_WP_CONFIG=1); `scripts/fix-wordpress-smtp-remote.py` (GOOGLE_RELAY); prod `wp-config.php`, plugins Fase C.
- **Impacto web:** Alertas ventas → primario `info@`, CC `norberto@` + `admin@`; constante `GEMA_ADMIN_EMAIL` en wp-config prod.
- **Impacto asistente IA:** Sin cambio de copy; bandeja admin alineada con doc `ADMIN_CUENTAS_GEMA_2026-06-17.md`.
- **Despliegue:** Prod vía `gcloud` (`gema-web-server`, proyecto `gema-digital-web`).
- **Validaciones:** `php -l wp-config.php` OK; curl `mail/diagnostic` `{}` → **`email_sent: true`**, `cc_targets: [norberto@, admin@]`; smoke sync (cart, agent, contact) PASS.
- **Pendientes:** Confirmación visual inbox en `admin@gema-digital.com` para CC de prueba `[GEMA TEST]`.


### 2026-06-17 — Simulación QA factura/recibo sandbox (billing + facturador tests)

- **Objetivo:** Simular `pago_aprobado` mock Nave, generar factura/recibo HTML, persistir en Firestore trial y documentar comandos QA.
- **Archivos / servicios:** `~/.cumbre-mirror/scripts/simulate-billing-document-qa.ts` (nuevo); `package.json` script `simulate:billing-document-qa`; `shared/billingDocumentOrchestrator.ts`, `billingDocuments.ts`, `crmGemaClienteSync.ts`; doc `docs/TRIAL_TARJETA_Y_FACTURACION_AUTO_2026-06-17.md`.
- **Impacto web:** Sin deploy; comprobantes visibles en portal cliente Documentos si ADC escribe prod.
- **Impacto asistente IA:** Sin cambio de copy; pendiente alinear respuestas si se promociona factura fiscal vs comprobante interno HTML.
- **Despliegue:** Solo local/mirror; escritura Firestore prod vía ADC (sandbox QA, sin cobro real).
- **Validaciones:**
  - `npm run test:billing-document-orchestrator` OK; `test:crm:gema-cliente-sync` OK (`ld_7849f8f4`); `test:rules` OK.
  - `test:facturador-arca-online` + orchestrator OK (módulo fiscal separado del HTML post-pago).
  - `npm run simulate:billing-document-qa` → `firestore.persisted: true`, tenant `tenant_journey__journeyadcjo`, ej. `F-2026-FF95D734` / `R-2026-FF95D734`; HTML en `/tmp/gema-billing-sim/`; notificaciones canal `skipped`.
- **Pendientes:** Configurar `GEMA_NOTIFICATIONS_WP_URL` para probar email/WhatsApp real; factura AFIP/ARCA sigue en módulo facturador (no cubierta por esta simulación).

### 2026-06-17 — Login prod norberto@ (auth/invalid-credential)

- **Objetivo:** Diagnosticar y corregir login ERP Cumbre prod para `norberto@gema-digital.com` (error `auth/invalid-credential` al usar el UID/doc `miembros` como contraseña).
- **Archivos / servicios:** `~/.cumbre-mirror/.credentials/fase1-prod-user.local` (entrada `norberto_*`); `docs/ACCESOS_Y_URLS_GEMA.md`; Firebase Auth `cumbre-erp-prod` vía ADC; script `gema:create-owner-users:prod`.
- **Impacto web:** Sin deploy; usuario puede ingresar en https://cumbre-erp-prod.web.app con tenant trial `tenant_journey__journeyadcjo`.
- **Impacto asistente IA:** Doc de accesos aclara UID ≠ password; sin cambio de copy del agente.
- **Despliegue:** Solo local (credenciales + documentación GEMA).
- **Validaciones:** Admin SDK: usuario existe, provider `password`, UID `yMO3rj5hWccCEsJQ0V6xJbzuKg93`, claims `tenant_journey__journeyadcjo` owner; `gema:create-owner-users:prod` → `updated`; `signInWithPassword` prod OK (API key prod).
- **Pendientes:** Ninguno para login; restaurar claims dogfood con `prod:apply-claims` cuando termine QA trial.


### 2026-06-17 — Refuerzo login norberto@ (UID vs password + reset email)

- **Objetivo:** Re-sincronizar contraseña Auth prod, verificar `signInWithPassword`, enviar reset por email y dejar aviso visible en documentación.
- **Archivos / servicios:** `~/.cumbre-mirror/.credentials/fase1-prod-user.local`; `docs/ACCESOS_Y_URLS_GEMA.md`; Firebase Auth `cumbre-erp-prod` (`gema:create-owner-users:prod`, `accounts:sendOobCode`).
- **Impacto web:** Login https://cumbre-erp-prod.web.app/login operativo con clave QA del archivo local (no el UID).
- **Impacto asistente IA:** Doc accesos con caja «UID ≠ contraseña» al inicio del índice de accesos.
- **Despliegue:** Solo local + acciones Admin SDK prod (sin deploy hosting).
- **Validaciones:** `signInWithPassword` prod → OK, UID coincide; email reset disparado a `norberto@gema-digital.com`.
- **Pendientes:** Usuario debe usar `norberto_password=` o enlace del email de reset; no pegar UID en campo contraseña.


### 2026-06-17 — Fix build:prod + deploy Cumbre prod (post reauth Firebase)

- **Objetivo:** Desbloquear `npm run build:prod` en `~/.cumbre-mirror` y publicar hosting/rules tras reauth Firebase.
- **Archivos / servicios:** `scripts/lib/userJourneyPersonas.ts`, `userJourneyPricing.ts`, `userJourneyProvisioning.ts`, `run-user-journey-simulation.ts`, `test-billing-document-orchestrator.ts`; `functions/src/index.ts` (import `parseGemaPagosWebhookPayload`, cast trial card); Firebase `cumbre-erp-prod` hosting + firestore/storage rules + functions.
- **Impacto web:** Hosting prod actualizado en https://cumbre-erp-prod.web.app (ERP Cumbre).
- **Impacto asistente IA:** Sin cambio de copy; journeys/scripts solo limpieza TS.
- **Despliegue:** Prod — hosting OK; firestore rules/indexes + storage rules OK; functions build OK, mayoría de funciones actualizadas; **3 funciones con error IAM invoker** (`verifyTrialCard`, `cumbreMercadoLibreWebhook`, `cumbreWhatsappWebhook`) — requiere rol `functions.admin` o ajuste org policy.
- **Validaciones:** `npm run build:prod` OK; `check:prod:build` OK (aviso URLs beta en integracionesEnlacesExternos).
- **Pendientes:** IAM invoker en 3 Cloud Functions; commit/sync mirror→git si aplica.



### 2026-06-17 — Deploy prod completo Cumbre + WordPress (autorizado)

- **Objetivo:** Ejecutar pipeline prod pendiente: build, Firebase (rules/hosting/functions), sync WP, claims trial norberto@, smoke y tests locales.
- **Archivos / servicios:** `~/.cumbre-mirror` (Firebase `cumbre-erp-prod`); GEMA repo `scripts/sync-wordpress-prod.sh`; `docs/ACCESOS_Y_URLS_GEMA.md`.
- **Impacto web:** ERP https://cumbre-erp-prod.web.app actualizado; Portal Cliente UI en prod; https://gema-digital.com/mi-cuenta/ redirige a `?view=customer_portal`; plugins Fase C redeployados en prod.
- **Impacto asistente IA:** Sin cambio de copy; ingest lead WP a Cumbre sigue limitado por org policy en invoker HTTP.
- **Despliegue:** Prod — firestore rules/indexes + storage OK; hosting OK (98 archivos); functions actualizadas (create `soporteTicketCrmSyncRunner` 409 porque ya existía); WP sync OK.
- **Validaciones:** `build:prod` OK; `check:prod:build` OK (aviso URLs beta en integracionesEnlacesExternos); curl hosting 200; mi-cuenta 302; `test:rules` OK; `test:customer-portal:routing` OK; claims norberto@ `tenant_journey__journeyadcjo` owner aplicados.
- **Pendientes:** Org policy IAM invoker (`prod:fix:functions-invoker` errores 400); confirmación visual QA portal (solo Portal Cliente visible para norberto@ trial); aviso DevCenter URLs beta en bundle prod.

### 2026-06-17 — Claims full GEMA `norberto@gema-digital.com` (prod)

- **Objetivo:** Habilitar acceso a todos los módulos Cumbre en prod para `norberto@gema-digital.com` sin eliminar el tenant trial de journey QA.
- **Archivos / servicios:** Firebase Auth `cumbre-erp-prod` (custom claims); `~/.cumbre-mirror` script `prod:apply-claims:norberto-gema`; `docs/ACCESOS_Y_URLS_GEMA.md` (§5.1 modo dual).
- **Impacto web:** Ninguno directo; operador puede validar CRM/leads y flujos comerciales desde ERP prod.
- **Impacto asistente IA:** Ninguno.
- **Despliegue:** Solo cambio en Auth prod vía ADC (no hosting).
- **Validaciones:** `npm run prod:apply-claims:norberto-gema` → `ok: true`, UID `yMO3rj5hWccCEsJQ0V6xJbzuKg93`, claims `tenant_gema_prod_interno` owner; verificación Admin SDK claims coherentes; tenant trial `tenant_journey__journeyadcjo` y doc `miembros` trial sin borrar.
- **Pendientes:** Usuario debe **logout + login** en ERP prod para ver módulos; para QA portal trial usar `prod:link:journey-trial-customer --apply-single-tenant-claims`.


### 2026-06-17 — Experiencia cliente trial + labels amigables + deploy hosting

- **Objetivo:** Etiquetas en español (sin UID/tenant técnico en UI cliente), módulos operativos trial (CRM/Ventas/Stock/Cobros), asistente guiado cliente, toggle vista operativa admin, seed datos demo journey.
- **Archivos / servicios:** `~/.cumbre-mirror` — `shared/userFacingLabels.ts`, `customerPortal.ts`, `panelPresentation.ts`, `guidedAssistant.ts`; `src/App.tsx`, `AppSidebar.tsx`, `appPanelRouter.tsx`, paneles CRM/Ventas/Stock/Cobros, `CumbreTechnicalDetail.tsx`; `scripts/seed-trial-operational-demo.ts`; Firebase hosting `cumbre-erp-prod`.
- **Impacto web:** Header prod muestra empresa/usuario legibles; trial ve Portal + Trabajar en Cumbre; admin GEMA conserva panel completo con toggle Vista operativa.
- **Impacto asistente IA:** Doc `docs/EXPERIENCIA_CLIENTE_CUMBRE_2026-06-17.md` + actualización ACCESOS/PORTAL_CLIENTE para copy coherente.
- **Despliegue:** Prod hosting OK (`deploy:prod:hosting`); seed Firestore trial OK (`prod:seed:trial-operational-demo`).
- **Validaciones:** `build:prod` OK; `test:customer-portal:routing` OK; seed dry-run + prod 10 documentos.
- **Pendientes:** QA visual Norberto con claims trial; sincronizar mirror→git si aplica; asistente IA web (copy trial) pendiente ingest explícito.

