# Registro de Trabajo GEMA Digital

Última actualización: 2026-06-16 ART (arquitectura ideal GEMA+Cumbre post-investigación web 2025–2026)

Este archivo es el registro maestro del proyecto GEMA Digital / ERP Cumbre. Debe actualizarse en cada cambio relevante del sitio, backend, infraestructura, contenido, SEO, integraciones, plugins, despliegues o validaciones.

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
- JS mejorado en `00-Proyecto Gema/wordpress/theme-gema-sovereign/assets/gema-mega-menu.js` (tap en «Cumbre ERP» expande submenú en móvil).
- Deploy pendiente: `gcloud auth login` + `bash 00-Proyecto\ Gema/scripts/deploy-theme-production.sh` (token GCP expirado en sesión agente).

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

