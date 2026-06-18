# Plataforma de Pagos GEMA — Métodos activos vs diferidos

Fecha: 2026-06-16 · Fuentes: `~/.cumbre-mirror/shared/paymentPlatformPolicy.ts`, plugin `gema-payments-platform` v0.2.3

## Política operativa (pruebas sin MP/ML)

| Método | Estado checkout | Rol |
|--------|-----------------|-----|
| **Nave Galicia** | **Activo** (primario) | Tarjetas, QR, Naranja X — cobro online post-trial |
| **Transferencia bancaria** | **Activo** | CBU/CVU/Alias Galicia + confirmación manual |
| **GEMA Pagos** | **Activo** (interno) | Orquestador billing, webhooks `gemaPagosWebhook`, trial→paid sandbox |
| Mercado Pago | Diferido — Próximamente | Adapter + OAuth en código; `habilitado: false` en tenant GEMA |
| Mercado Libre | Diferido — Próximamente | Módulo ML + webhook; gate productivo bloqueado |
| PayPal | Diferido — Próximamente | Stub sandbox; no checkout live |
| Stripe | Diferido — Próximamente | Catálogo WP only |

## WordPress (`gema-payments-platform`)

- REST `GET /wp-json/gema-payments/v1/providers` expone `status`, `checkout_active`, `deferred_label`.
- REST cart incluye `checkout.active_providers`: `nave`, `bank_transfer`.
- Webhooks de proveedores diferidos responden `503 deferred_provider` (no rompe el sitio).

## Cumbre ERP (mirror)

- Política central: `shared/paymentPlatformPolicy.ts`
- Router: `resolveActiveCheckoutPaymentAdapter()` excluye MP/PayPal del checkout live
- Simulación trial→paid activa: `nave_galicia`, `transferencia_bancaria`, `gema_pagos`
- Tenant GEMA prod (`tenant_gema_prod_interno`): default `nave_galicia` + transferencia; MP deshabilitado en seed

## Comandos de validación

```bash
cd ~/.cumbre-mirror
npm run test:payment-simulation-trial-paid
npm run test:nave-galicia-cobros-adapter
npm run test:mercado-pago-adapter   # adapter sigue registrado; checkout bloqueado
```

## Flujo end-to-end (dogfood, sin MP)

1. Carrito WP → signup Cumbre → trial 14 días
2. Día 14: `npm run admin:advance-trial-day14 -- --tenant-id tenant_gema_prod_interno`
3. Cobro sandbox vía Nave o transferencia manual → webhook billing → `payment.approved`

## Pendientes productivos (no bloquean pruebas)

- OAuth Mercado Pago seller + habilitar en `paymentPlatformPolicy`
- Aprobación app Mercado Libre + IAM invoker webhook (org policy GCP — ver ticket aparte)
- Nave Galicia production + credenciales reales en `.credentials/gema-integraciones.local`
