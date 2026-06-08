# Plataforma de Pagos GEMA

## Alcance

La plataforma queda preparada para operar pagos nacionales e internacionales sin exponer credenciales reales en el repositorio.

Medios contemplados:

- Argentina: transferencia bancaria, CBU/CVU/Alias, QR interoperable, MODO, Mercado Pago, Nave, tarjetas, links de pago, POS/terminales y comprobantes manuales.
- Global: PayPal y Stripe.
- Backoffice: webhooks, auditoría, idempotencia, conciliación y seguridad.

Módulo funcional:

- `Cumbre Cobros`: página y módulo editable para configurar cobros por cliente, concepto, importe, vencimiento, moneda, medios habilitados, instrucciones y estado operativo.

## WordPress

Páginas creadas por el generador del theme:

- `/erp-cumbre/cumbre-cobros`
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

Plugin propio:

- `gema-payments-platform`
- Endpoint de estado: `/wp-json/gema-payments/v1/providers`
- Endpoint de webhooks: `/wp-json/gema-payments/v1/webhooks/{provider}`

Proveedores válidos:

- `bank_transfer`
- `mercado_pago`
- `nave`
- `paypal`
- `stripe`

## Seguridad

- No guardar PAN, CVV ni datos completos de tarjetas en GEMA.
- Usar checkout/tokenización del proveedor cuando corresponda.
- Guardar secretos como opciones protegidas o secretos de infraestructura, nunca en código.
- Separar sandbox y producción.
- Validar firma o secreto por webhook.
- Registrar eventos con idempotencia para evitar duplicados.

## Próxima conexión de cuentas

Cuando GEMA confirme accesos y cuentas reales:

- Transferencia: cargar razón social, CUIT, CBU/CVU/Alias y texto comercial aprobado.
- Mercado Pago: vincular cuenta, access token/public key, configurar webhook HTTPS y probar sandbox/producción.
- Nave: confirmar documentación/API/plugin oficial vigente y método de conciliación.
- PayPal: vincular business account, client ID/secret sandbox y live, configurar webhooks.
- Stripe: confirmar entidad legal/país, publicar/sandbox keys, webhook signing secret, monedas y productos.

## Validación mínima antes de cobrar

- Página pública responde `200 OK`.
- Plugin activo responde estado `ready_for_credentials`.
- Webhook sin secreto devuelve `503 not_configured`.
- Webhook con secreto incorrecto devuelve `401 invalid_signature`.
- Webhook con secreto correcto registra un evento privado e ignora duplicados.
- Cada proveedor tiene flujo de conciliación definido antes de operar producción.
