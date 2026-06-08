# Prompt Web: Cumbre Matriz y Billing

## Nombre del módulo/capa

Cumbre Matriz y Billing

## Objetivo de la landing

Diseñar una página de confianza para explicar cómo ERP Cumbre activa módulos, planes, trials, límites, pagos, permisos y funciones premium de forma ordenada, segura y auditable.

No debe parecer una página de precios genérica. Debe mostrar que Cumbre es modular de verdad: cada empresa usa lo que necesita, conserva sus datos, puede crecer por módulos y tiene control real de acceso.

## Público ideal

Dueños de PyMEs, responsables administrativos, gerentes, implementadores, partners, contadores y equipos de sistemas que quieren entender cómo se administra una plataforma ERP modular sin quedar atrapados en planes rígidos.

## Mensaje principal

Activá solo los módulos que necesitás, con planes, límites y permisos bajo control.

## Subtítulo

Cumbre Matriz y Billing conecta el catálogo de módulos, los planes contratados, el trial de 14 días, los pagos, las funciones premium y los permisos reales de cada tenant para que la plataforma crezca sin desorden.

## Problema que resuelve

En muchos ERP, crecer significa pagar por paquetes rígidos o activar funciones manualmente sin trazabilidad. Eso genera:

- Módulos que aparecen en la UI pero no deberían ejecutarse.
- Trials vencidos sin reglas claras.
- Pagos o upgrades que no actualizan límites.
- Funciones premium mezcladas con funciones base.
- Datos perdidos al pasar de prueba a pago.
- Integraciones que siguen activas aunque el plan esté suspendido.
- Usuarios con permisos que no coinciden con el plan.

## Propuesta de valor

Cumbre Matriz y Billing ordena el acceso a toda la plataforma. Define qué módulos existen, cuáles tiene cada cliente, en qué estado están, qué plan tiene activo, qué límites aplican, qué funciones están bloqueadas y qué eventos de pago modifican el acceso.

## Funcionalidades principales

- Catálogo público de módulos disponibles.
- Dependencias entre módulos.
- Planes y add-ons por módulo.
- Trial de 14 días por módulo.
- Estados: trial, trial vencido, activo, suspendido y cancelado.
- Límites de usuarios, operaciones, registros, tokens IA y almacenamiento.
- Funciones premium bloqueadas por plan.
- Preservación de datos del trial.
- Eventos de billing desde Gema Pagos.
- Aplicación idempotente de pagos, upgrades, cancelaciones y suspensiones.
- Control real de permisos por tenant, usuario, rol, módulo y plan.
- Bloqueo de automatizaciones externas si la suscripción no está activa.

## Módulos Cumbre conectados

- Todos los módulos Cumbre consultan esta capa antes de ejecutar acciones.
- `Cumbre Core Plataforma`: panel, roles, permisos y control general.
- `Gema Pagos`: checkout, suscripciones, pagos y cancelaciones.
- `Cumbre Automatizaciones`: solo ejecuta flujos si el módulo está habilitado.
- `Cumbre Reportes BI`: muestra consumo, límites, upgrades y alertas.
- `Tutoriales API Cumbre`: integra estado de plataformas externas.

## Guardrails técnicos, legales y de seguridad

- No confiar en flags locales del frontend.
- No ejecutar acciones backend si el módulo no está habilitado.
- No activar módulos con dependencias faltantes.
- No borrar datos por trial vencido, pago fallido o cancelación.
- No aplicar dos veces el mismo evento de billing.
- No mezclar Gema Pagos base con `Cumbre Cobros` operativo.
- No cambiar plan sin recalcular límites y funciones bloqueadas.
- No permitir automatizaciones externas si el módulo está suspendido.
- No prometer acceso indefinido a funciones premium sin pago.

## Estructura sugerida de landing

1. Hero: “ERP modular con planes, límites y permisos bajo control”.
2. Problema: los sistemas modulares se vuelven caóticos sin una matriz de acceso.
3. Solución: Matriz Cumbre + Billing por módulo.
4. Visual de catálogo: módulos disponibles, activos, en trial y bloqueados.
5. Trial de 14 días: probar sin perder datos.
6. Planes y add-ons: crecer por módulo.
7. Seguridad: permisos reales, no solo UI.
8. Pagos: eventos idempotentes desde Gema Pagos.
9. Dependencias: evitar activaciones incoherentes.
10. CTA final.

## Casos de uso

- Activar `Cumbre Stock` solo cuando el cliente ya tiene Catálogo.
- Convertir un trial de `Cumbre Marketing` a pago sin perder contenidos.
- Suspender funciones premium por falta de pago sin borrar datos.
- Actualizar límites al pasar de plan Base a Standard.
- Bloquear una automatización si el módulo dueño está suspendido.
- Mostrar upgrade cuando se supera el límite de operaciones.
- Auditar qué evento de pago activó un plan.

## SEO

Title sugerido:
Cumbre Matriz y Billing | ERP modular con planes, trial y permisos

Meta description:
Conocé cómo ERP Cumbre gestiona módulos, planes, trial de 14 días, límites, pagos, permisos y funciones premium con una matriz de acceso segura.

Keywords:
ERP modular, software ERP por módulos, ERP con trial, ERP con billing, ERP SaaS multi tenant, permisos ERP, planes ERP para PyMEs, ERP con add-ons

H1:
ERP modular con acceso, planes y límites bajo control

H2 sugeridos:

- Activá solo los módulos que necesitás.
- Trial de 14 días sin perder datos.
- Planes, límites y add-ons por módulo.
- Permisos reales, no solo pantallas ocultas.
- Billing conectado a Gema Pagos.

## CTAs

- Ver módulos Cumbre
- Solicitar demo
- Hablar con Gema Digital

## Planes o niveles comerciales

Esta capa no se vende como módulo independiente. Es parte de la plataforma Cumbre.

Puede explicarse en tres niveles:

- Matriz Base: módulos, trial, límites y activación modular.
- Matriz Empresas: roles avanzados, add-ons, auditoría extendida y upgrades.
- Matriz Holding: multiempresa, dependencias complejas, reportes consolidados y gobierno de acceso.

## Estilo visual

Claro, ejecutivo y modular. Usar cards de módulos con estados visuales: activo, trial, bloqueado, suspendido, disponible. Mostrar una tabla simple de plan/límites/funciones bloqueadas, un timeline de trial a pago y un diagrama de evento de billing → actualización de acceso.

Debe transmitir control y confianza, no complejidad técnica.

## Auditoría previa al cierre

- Producto: explica el modelo modular y evita que Cumbre parezca un ERP rígido.
- SEO: cubre ERP modular, trial, billing, permisos, SaaS y add-ons.
- Legal: preservación de datos, suspensión, cancelación y condiciones de acceso.
- Seguridad: validación backend, idempotencia, tenant isolation y menor privilegio.
- Integraciones: Gema Pagos, Core Plataforma, Reportes BI, Automatizaciones y Tutoriales API.

## Próximos pasos

Implementar página explicativa en WordPress cuando se decida publicar. No desplegar desde este prompt.
