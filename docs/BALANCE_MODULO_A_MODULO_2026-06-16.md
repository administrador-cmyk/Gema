# Balance módulo a módulo — Cumbre ERP

**Fecha:** 2026-06-16  
**Objetivo:** Cierre dogfood 32 módulos × beta + prod (64 checks E2E Playwright)  
**Fuente canónica:** `listPlatformFullModuleIds()` en `shared/platformFullModuleIds.ts`

## Veredicto global

| Métrica | Resultado |
|---------|-----------|
| Checks E2E paneles | **64/64 PASS** |
| Beta (`tenant_prueba_interna`) | **32/32 PASS** |
| Prod (`tenant_gema_prod_interno`) | **32/32 PASS** |
| Bugs de panel corregidos en sesión | **0** (sin regresiones) |
| Deploy beta/prod | **No ejecutado** — ADC `invalid_grant` |

Reportes JSON: `docs/BETA_DOGFOOD_PANELS_E2E.latest.json`, `docs/PROD_DOGFOOD_PANELS_E2E.latest.json`, `docs/AUDITORIA_MODULO_A_MODULO.latest.json`

## Entornos y tenants

| Entorno | URL | Tenant | Login E2E |
|---------|-----|--------|-----------|
| Beta | https://cumbre-erp-beta.web.app | `tenant_prueba_interna` | `beta@gema-digital.com` |
| Prod | https://cumbre-erp-prod.web.app | `tenant_gema_prod_interno` | `beta@gema-digital.com` |

## Matriz módulo × beta × prod

Todos los módulos cargaron panel sin `panel-error`, sin crash React, sin `permission-denied` ni vista no implementada.

| # | moduleId | Vista | Beta | Prod | Bugs |
|---|----------|-------|------|------|------|
| 1 | `modulo_crm_hubspot` | crm | PASS | PASS | — |
| 2 | `modulo_facturador_arca` | facturador_arca | PASS | PASS | — |
| 3 | `modulo_cumbre_cobros` | cobros | PASS | PASS | — |
| 4 | `modulo_cumbre_tesoreria` | tesoreria | PASS | PASS | — |
| 5 | `modulo_cumbre_legal` | legal | PASS | PASS | — |
| 6 | `modulo_cumbre_catalogo` | catalogo | PASS | PASS | — |
| 7 | `modulo_cumbre_stock` | stock | PASS | PASS | — |
| 8 | `modulo_cumbre_compras` | compras | PASS | PASS | — |
| 9 | `modulo_cumbre_ecommerce` | ecommerce | PASS | PASS | — |
| 10 | `modulo_cumbre_mercado_libre` | mercado_libre | PASS | PASS | — |
| 11 | `modulo_cumbre_erp_negocios` | negocios | PASS | PASS | — |
| 12 | `modulo_cumbre_erp_pymes` | pymes | PASS | PASS | — |
| 13 | `modulo_cumbre_empresas` | empresas | PASS | PASS | — |
| 14 | `modulo_cumbre_contabilidad` | contabilidad | PASS | PASS | — |
| 15 | `modulo_cumbre_impuestos` | impuestos | PASS | PASS | — |
| 16 | `modulo_cumbre_reportes_bi` | reportes_bi | PASS | PASS | — |
| 17 | `modulo_cumbre_importador_datos` | panel | PASS | PASS | — |
| 18 | `modulo_cumbre_planificacion` | planificacion | PASS | PASS | — |
| 19 | `modulo_cumbre_whatsapp_hub` | whatsapp_hub | PASS | PASS | — |
| 20 | `modulo_cumbre_agente_chatbot` | agente_chatbot | PASS | PASS | — |
| 21 | `modulo_cumbre_activos_fijos` | activos_fijos | PASS | PASS | — |
| 22 | `modulo_cumbre_marketing` | marketing | PASS | PASS | — |
| 23 | `modulo_cumbre_automatizaciones` | automatizaciones | PASS | PASS | — |
| 24 | `modulo_cumbre_web` | web | PASS | PASS | — |
| 25 | `modulo_cumbre_prospeccion_b2b` | prospeccion_b2b | PASS | PASS | — |
| 26 | `modulo_cumbre_core` | core_plataforma | PASS | PASS | — |
| 27 | `modulo_cumbre_ventas` | ventas | PASS | PASS | — |
| 28 | `modulo_cumbre_personal` | personal | PASS | PASS | — |
| 29 | `modulo_cumbre_marketing_organico` | marketing_organico | PASS | PASS | — |
| 30 | `capa_empaquetado_verticales_cumbre` | verticales | PASS | PASS | — |
| 31 | `modulo_cumbre_backend_workers` | operations | PASS | PASS | — |
| 32 | `modulo_cumbre_seguridad_auditoria` | security_audit | PASS | PASS | — |

## Validaciones ejecutadas

| Comando | Resultado | Notas |
|---------|-----------|-------|
| `npm run beta:check:adc` | **FAIL** | `invalid_grant` — ver `docs/fase4/PASO3_RENOVAR_ADC.md` |
| `npm run test:bank:fast` | **FAIL parcial** | 24 PASS, 3 FAIL, 4 SKIP (E2E omitidos por `--fast`) |
| `npm run beta:e2e:dogfood-panels` | **PASS** | 32/32 @ 2026-06-16T06:12:07Z |
| `npm run prod:e2e:dogfood-panels` | **PASS** | 32/32 @ 2026-06-16T06:12:58Z |
| `bash scripts/smoke-integracion-web-cumbre.sh` | **PASS** | 16 pass tras fix header (GEMA repo) |

## Fixes aplicados en sesión

1. **Web GEMA — header mega menú:** enlace `https://cumbre-erp-prod.web.app` en `wordpress/theme-gema-sovereign/parts/header.html` (smoke `header links prod ERP`).
2. **Mirror — TypeScript:** parámetro no usado en `scripts/run-audit-cierre.ts` (`syncToGema`) para desbloquear `npm run build:prod`.

## Bloqueos documentados (no impiden 64/64 E2E)

| Bloqueo | Impacto | Fix propuesto |
|---------|---------|---------------|
| ADC `invalid_grant` | Sin deploy Firebase, sin bootstrap Firestore remoto, `prod:health` parcial | `gcloud auth application-default login` según `docs/fase4/PASO3_RENOVAR_ADC.md` |
| Firebase CLI sin sesión | `prod:health` falla reachability | `npm run beta:repair:auth` tras renovar ADC |
| `dist/` ausente o beta antes de sesión | `check:prod:build` fallaba | `npm run build:prod` (corregido tras fix TS) |

## Próximos pasos operativos

1. Renovar ADC y ejecutar `npm run beta:check:adc` → verde.
2. Opcional: `npm run deploy:prod:hosting` / `deploy:beta:hosting` si hay cambios de código pendientes en mirror.
3. Desplegar theme GEMA con header actualizado (`rsync` + WP-CLI según runbook habitual).
4. Re-ejecutar `npm run test:bank` (sin `--fast`) tras ADC OK para banco completo con E2E incluidos.
