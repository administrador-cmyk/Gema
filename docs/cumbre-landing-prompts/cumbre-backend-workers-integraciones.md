# Prompt Web: Cumbre Backend, Workers e Integraciones Seguras

## Nombre de la pieza

Cumbre Backend, Workers e Integraciones Seguras

## Objetivo de la landing

Diseñar una landing de confianza para presentar `Cumbre Backend, Workers e Integraciones Seguras` como la capa técnica que permite ejecutar acciones sensibles, webhooks, OAuth, colas, reintentos, secretos e integraciones externas sin exponer datos ni depender del frontend.

No debe venderse como un módulo aislado. Debe presentarse como la base técnica que permite que ERP Cumbre sea una plataforma SaaS modular, segura, auditable y preparada para integraciones reales.

## Público ideal

Empresas que evalúan ERP Cumbre, responsables de sistemas, dueños técnicos, gerentes, estudios contables, agencias implementadoras, equipos de operaciones y clientes que necesitan conectar pagos, facturación, stock, marketing, WhatsApp, eCommerce, prospección y reportes sin improvisar seguridad.

## Mensaje principal

Integraciones seguras y workers backend para que Cumbre opere de verdad.

## Subtítulo

Cumbre ejecuta acciones sensibles desde backend controlado, protege credenciales, valida webhooks, maneja OAuth, reintenta operaciones sin duplicarlas y deja trazabilidad completa por tenant, módulo e integración.

## Problema que resuelve

Muchos sistemas conectan APIs de forma frágil:

- Secretos pegados en pantallas, planillas o chats.
- Webhooks sin validación real.
- Reintentos que duplican pagos, facturas o mensajes.
- Integraciones que fallan sin explicación.
- Automatizaciones externas activas aunque el módulo esté suspendido.
- OAuth sin reautorización ni rotación.
- Errores técnicos que el usuario no puede entender.
- Frontend tomando decisiones que deberían ocurrir en backend.

## Propuesta de valor

Cumbre Backend, Workers e Integraciones Seguras convierte las conexiones externas en procesos controlados: cada acción pasa por permisos, Matriz/Billing, Seguridad/Auditoría, `credencial_ref`, idempotencia, estados visibles, reintentos y logs trazables.

El resultado es una plataforma que puede conectar pagos, facturación, WhatsApp, email, Google, eCommerce, marketing, prospección y BI sin exponer secretos ni duplicar operaciones.

## Funcionalidades principales

### API Gateway y Cloud Run

- Entrada controlada para acciones sensibles.
- Validación de tenant, usuario, rol, módulo y plan.
- Corte de ejecución si falta permiso o suscripción.
- Separación entre solicitud del frontend y ejecución real.
- Respuesta normalizada para usuario y soporte.

### Workers por dominio

- Worker fiscal.
- Worker de cobros.
- Worker de stock.
- Worker de importaciones.
- Worker de integraciones.
- Worker de notificaciones.
- Worker de marketing.
- Worker de prospección.
- Worker de automatizaciones.
- Worker BI.

### Secretos protegidos

- Credenciales por `credencial_ref`.
- Secret Manager o equivalente.
- Sin secretos en Firestore, React, WordPress, logs, prompts ni chats.
- Rotación y revocación auditadas.
- Separación entre test y producción.

### Webhooks seguros

- Firma o token verificado.
- Tenant resuelto de forma determinística.
- Replay protection.
- Idempotency key.
- Payload normalizado.
- Evento crudo y resultado auditados.

### OAuth e integraciones externas

- Scopes mínimos.
- Consentimiento explícito.
- Refresh tokens protegidos.
- Reautorización si cambian permisos.
- Estados de integración visibles.
- Tutoriales API con prueba backend.

### Reintentos e idempotencia

- Reintentos con backoff.
- Dead-letter queue.
- Reproceso manual con aprobación.
- Evitar duplicar cobros, facturas, stock, mensajes, publicaciones o secuencias.
- Errores normalizados por proveedor.

### Panel de operaciones

- Integraciones por estado.
- Webhooks fallidos.
- Jobs en curso.
- Dead letters.
- Credenciales vencidas.
- Errores por proveedor.
- Acciones que requieren reautorización.
- Automatizaciones pausadas.

## Módulos Cumbre conectados

- `Cumbre Core Plataforma`: tenant, panel y estado general.
- `Cumbre Matriz y Billing`: módulo activo, plan, límites y suspensión.
- `Cumbre Seguridad y Auditoría`: permisos, aprobaciones, idempotencia y eventos.
- `Tutoriales API Cumbre`: onboarding y pruebas de conexión.
- `Cumbre Facturador ARCA`: worker fiscal y certificados.
- `Cumbre Cobros`: pagos, conciliación y webhooks.
- `Cumbre Stock`: reservas, movimientos e importaciones.
- `Cumbre Marketing`: publicaciones, métricas y proveedores externos.
- `Cumbre Prospección B2B`: email outbound, supresión, secuencias y calendario.
- `Cumbre WhatsApp Hub`: mensajes, opt-in y plantillas.
- `Cumbre Automatizaciones`: triggers, condiciones y acciones externas.
- `Cumbre Reportes BI`: eventos, errores y rendimiento.

## Integraciones prioritarias

- Cloud Run/API Gateway.
- Secret Manager.
- Pub/Sub o colas equivalentes.
- Firestore.
- Bigtable.
- Gema Pagos.
- ARCA y servicios fiscales.
- Mercado Pago y proveedores de cobro.
- Meta WhatsApp Business Cloud API.
- Google Workspace/Gmail, GA4, GTM, Search Console y Ads cuando aplique.
- WooCommerce, Shopify, Tiendanube, Mercado Libre y otros conectores.
- Proveedores de email, datos B2B, generación creativa y BI.

## Diferenciadores

- La UI no decide acciones sensibles: las solicita.
- Cada integración tiene estado visible.
- Los secretos se tratan como secretos, no como texto libre.
- Los reintentos no duplican operaciones.
- Los webhooks se validan antes de impactar datos.
- Los errores externos se convierten en mensajes accionables.
- Las automatizaciones dependen de permisos, plan, módulo e integración activa.

## Guardrails técnicos, legales y de seguridad

- No ejecutar acciones sensibles desde frontend.
- No guardar secretos en Firestore, logs, prompts, chats ni documentos.
- No aceptar webhooks sin validar firma, token, tenant y replay protection.
- No reintentar operaciones no idempotentes.
- No ejecutar automatizaciones externas si el módulo, tenant, plan o integración está suspendido.
- No mezclar ambientes test y producción.
- No ocultar errores externos.
- No borrar dead letters sin resolución o auditoría.
- No elevar scopes OAuth sin consentimiento.
- No prometer disponibilidad total de APIs externas.

## Estructura sugerida de landing

1. Hero: “Integraciones seguras para un ERP que opera de verdad”.
2. Problema: APIs frágiles, secretos expuestos y errores duplicados.
3. Solución: backend, workers, secretos, webhooks y reintentos controlados.
4. Demo de flujo: frontend -> API Gateway -> worker -> proveedor -> Brainstore.
5. Secretos: `credencial_ref` y Secret Manager.
6. Webhooks seguros y replay protection.
7. Idempotencia y dead-letter queue.
8. Estados de integración y reautorización.
9. Panel de operaciones.
10. Módulos conectados.
11. Guardrails de seguridad.
12. CTA de plataforma.

## Casos de uso

- Cobrar sin duplicar pagos ante reintentos.
- Emitir comprobantes desde worker fiscal seguro.
- Recibir webhooks de Mercado Pago o WhatsApp con validación.
- Rotar una credencial sin exponer secretos.
- Pausar automatizaciones si una integración falla.
- Reautorizar Google, Meta o Mercado Libre desde tutorial guiado.
- Reprocesar un job fallido con aprobación y auditoría.
- Ver qué proveedor está generando errores.

## Tono

Técnico, confiable, claro y orientado a negocio. Debe explicar infraestructura sin abrumar al usuario no técnico. Enfatizar continuidad, seguridad, trazabilidad y control.

## SEO

Title sugerido:
Cumbre Integraciones Seguras | Backend, Workers y Webhooks para ERP

Meta description:
ERP Cumbre ejecuta integraciones sensibles desde backend seguro, con Secret Manager, webhooks validados, OAuth, reintentos, idempotencia y auditoría por tenant.

Keywords:
ERP con integraciones seguras, ERP con API, backend para ERP, software con webhooks, ERP con automatizaciones seguras, Secret Manager ERP, workers backend, integraciones empresariales seguras

H1:
Backend y workers seguros para integrar Cumbre sin exponer secretos

## CTA

Principal:
Conocer la arquitectura Cumbre

Secundario:
Ver módulos conectados
