# Prompt Web: Cumbre Seguridad y Auditoria

## Nombre de la pieza

Cumbre Seguridad y Auditoria

## Objetivo de la landing

Diseñar una landing de confianza para presentar `Cumbre Seguridad y Auditoria` como la capa transversal que protege usuarios, roles, permisos, tenants, secretos, aprobaciones, integraciones y trazabilidad dentro de ERP Cumbre.

No debe venderse como un modulo aislado ni prometer seguridad absoluta. Debe presentarse como la base de gobierno operativo que permite que Cumbre sea modular, auditable y escalable.

## Publico ideal

PyMEs, empresas en crecimiento, estudios contables, administradores, dueños, gerentes, equipos de operaciones, responsables de sistemas, agencias implementadoras y empresas que necesitan delegar trabajo sin perder control.

## Mensaje principal

Roles, permisos y auditoria para operar Cumbre con control real.

## Subtitulo

Cumbre Seguridad y Auditoria registra acciones criticas, separa datos por empresa, protege credenciales, valida permisos fuera de la UI y deja trazabilidad para que cada modulo funcione con confianza.

## Problema que resuelve

Muchas empresas crecen con sistemas donde:

- Todos usan el mismo usuario.
- No queda claro quien hizo cada cambio.
- Los permisos dependen de la pantalla y no de una regla real.
- Las credenciales quedan en chats, planillas o computadoras personales.
- Los implementadores tienen accesos permanentes.
- Las automatizaciones ejecutan acciones sin aprobacion.
- Los datos de una empresa pueden mezclarse con otra.
- No hay evidencia cuando ocurre un error.

## Propuesta de valor

Cumbre Seguridad y Auditoria ordena el gobierno interno del ERP: cada accion importante evalua tenant, usuario, rol, permiso, modulo, plan, suscripcion, integracion y aprobacion humana cuando corresponde.

El resultado es una plataforma donde se puede delegar sin perder control, conectar integraciones sin exponer secretos y crecer en modulos sin improvisar seguridad.

## Funcionalidades principales

### Usuarios y roles

- Owner.
- Admin.
- Operador.
- Ventas.
- Contable.
- Marketing.
- Solo lectura.
- Implementador Gema autorizado.
- Permisos extra auditables.
- Revision de accesos activos.

### Permisos reales

- Validacion backend de acciones sensibles.
- Permisos por tenant, modulo, plan y estado de suscripcion.
- UI como ayuda visual, no como autoridad final.
- Bloqueo de acciones sin modulo activo.
- Bloqueo de automatizaciones si falta permiso, plan o consentimiento.

### Auditoria transversal

- Registro de acciones criticas.
- Usuario, rol, modulo, entidad y resultado.
- Estado anterior y estado nuevo por referencia.
- Idempotency key para operaciones de riesgo.
- Aprobacion humana asociada cuando corresponde.
- Exportacion de auditoria segun plan.
- Retencion ampliada en planes superiores.

### Secretos e integraciones

- Credenciales por `credencial_ref`.
- No guardar secretos en Firestore, logs, chats ni documentos.
- Estados de integracion: sin configurar, pendiente, conectado, error o requiere reautorizacion.
- Rotacion de credenciales auditada.
- Conexion con Tutoriales API Cumbre.
- Compatibilidad con Secret Manager.

### Aprobaciones humanas

- Publicaciones.
- Campanas.
- Comprobantes fiscales.
- Cambios de permisos.
- Exportaciones sensibles.
- Automatizaciones externas.
- Acciones IA con impacto financiero, fiscal, legal, contable, comunicacional o publico.

### Alertas de seguridad

- Credenciales vencidas.
- Integraciones con error.
- Usuarios con permisos altos.
- Implementadores autorizados.
- Aprobaciones pendientes.
- Acciones criticas recientes.
- Intentos bloqueados.

## Modulos Cumbre conectados

- `Cumbre Core Plataforma`: tenant, panel, usuarios y alertas.
- `Cumbre Matriz y Billing`: planes, limites, estado de suscripcion y funciones bloqueadas.
- `Cumbre Tutoriales API`: onboarding seguro de integraciones.
- `Cumbre Automatizaciones`: triggers, acciones, aprobaciones y pausado seguro.
- `Cumbre Facturador ARCA`: acciones fiscales auditadas.
- `Cumbre Cobros`: pagos, devoluciones y conciliaciones trazables.
- `Cumbre Marketing`: publicaciones, campañas y consentimientos.
- `Cumbre WhatsApp Hub`: opt-in, plantillas y envios autorizados.
- `Cumbre Reportes BI`: reportes de actividad, consumo y alertas.

## Integraciones prioritarias

- Firebase Auth o proveedor de identidad.
- Firestore Rules.
- Cloud Run/API Gateway.
- Secret Manager.
- Bigtable para auditoria de alto volumen.
- Gema Pagos.
- Tutoriales API Cumbre.
- Google Workspace cuando el cliente lo use para identidad, email o activos Google.

## Diferenciadores

- Seguridad pensada desde la arquitectura, no agregada al final.
- Auditoria conectada a modulos, billing e integraciones.
- Separacion estricta por tenant.
- Implementadores con acceso autorizado, limitado y revocable.
- Acciones IA con contexto limitado y aprobacion humana.
- Credenciales tratadas como secretos, no como texto libre.

## Guardrails tecnicos, legales y de seguridad

- No prometer seguridad absoluta.
- No usar la UI como fuente real de permisos.
- No permitir acciones criticas sin auditoria.
- No guardar secretos en Firestore, logs, prompts, chats ni documentos.
- No permitir implementadores sin autorizacion del tenant.
- No exponer datos entre tenants.
- No borrar auditoria para ocultar errores.
- No capturar datos personales innecesarios en logs.
- No usar cuentas personales como owner permanente de activos criticos del cliente.
- No permitir IA con acciones criticas sin permisos, contexto limitado y aprobacion humana.
- No presentar auditoria interna como reemplazo de asesoramiento legal, fiscal o contable.

## Estructura sugerida de landing

1. Hero: “Control real para un ERP modular”.
2. Problema: crecer sin roles, permisos ni trazabilidad.
3. Solucion: capa transversal de seguridad y auditoria.
4. Demo de usuarios y roles.
5. Demo de permisos por modulo, plan y tenant.
6. Demo de auditoria de acciones criticas.
7. Secretos e integraciones: `credencial_ref`, Secret Manager y Tutoriales API.
8. Aprobaciones humanas para acciones sensibles e IA.
9. Implementadores autorizados y accesos revocables.
10. Alertas, reportes y exportacion de auditoria.
11. Guardrails: seguridad responsable, sin promesas absolutas.
12. CTA: conocer la plataforma Cumbre.

## Casos de uso

- Dar acceso a un vendedor sin permitirle cambiar billing.
- Permitir a un contador gestionar fiscal sin editar marketing.
- Autorizar temporalmente a Gema como implementador.
- Registrar quien aprobo una campana.
- Auditar una factura emitida o anulada.
- Bloquear una automatizacion externa si el modulo esta suspendido.
- Rotar una credencial de integración y dejar evidencia.
- Exportar auditoria para una revision interna.
- Revisar usuarios con permisos altos.

## Tono

Profesional, confiable, claro y sobrio. Hablar de control, trazabilidad y responsabilidad. Evitar lenguaje de miedo extremo o promesas absolutas.

## SEO

Title sugerido:
Cumbre Seguridad y Auditoria | Roles, permisos y trazabilidad para ERP

Meta description:
Controlá usuarios, permisos, integraciones, secretos, aprobaciones y acciones críticas con Cumbre Seguridad y Auditoria, la capa de confianza de ERP Cumbre.

Keywords:
ERP seguro, ERP con auditoria, software con roles y permisos, ERP multi tenant, trazabilidad empresarial, ERP con aprobaciones, seguridad ERP PyME, control de usuarios ERP

H1:
Seguridad y auditoria para operar Cumbre con control real

## CTA

Principal:
Conocer la plataforma Cumbre

Secundario:
Ver arquitectura modular
