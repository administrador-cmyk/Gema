# Prompt Web: Cumbre Automatizaciones

## Nombre del módulo

Cumbre Automatizaciones

## Objetivo de la landing

Diseñar una landing profesional para presentar `Cumbre Automatizaciones` como el motor transversal de ERP Cumbre para flujos internos, triggers, condiciones, acciones, webhooks, aprobaciones, auditoría e idempotencia.

## Público ideal

PyMEs, empresas en crecimiento, equipos administrativos, dueños, responsables de operaciones y usuarios que quieren automatizar tareas repetitivas entre módulos sin perder control.

## Mensaje principal

Automatizá tu ERP sin perder permisos, auditoría ni control humano.

## Subtítulo

Cumbre Automatizaciones conecta eventos de CRM, ventas, cobros, stock, compras, tesorería, WhatsApp, marketing, contabilidad y otros módulos para ejecutar flujos seguros, pausables e idempotentes.

## Problema que resuelve

Las empresas repiten tareas manuales todos los días: avisar pagos, crear seguimientos, actualizar estados, enviar alertas, pedir aprobaciones o registrar acciones entre sistemas. Cuando se automatiza sin controles, aparecen errores, loops, datos duplicados o acciones sensibles sin revisión.

## Propuesta de valor

Cumbre Automatizaciones permite crear flujos dentro del ERP con contexto, permisos, trazabilidad y guardrails del módulo dueño. No es automatizar por automatizar: es automatizar operaciones empresariales con seguridad.

## Funcionalidades principales

- Flujos no-code/low-code.
- Triggers por evento de módulo.
- Condiciones y filtros.
- Acciones internas.
- Webhooks entrantes y salientes controlados.
- Tareas programadas.
- Reintentos idempotentes.
- Panel de ejecuciones, errores y logs.
- Pausa por módulo o tenant.
- Aprobación humana para acciones críticas.

## Módulos Cumbre conectados

- Todos los módulos Cumbre como fuentes de eventos.
- `Cumbre WhatsApp Hub` para notificaciones y seguimiento.
- `Cumbre Marketing` para campañas y segmentos.
- `Cumbre Empresas` para aprobaciones.
- `Cumbre Reportes BI` para alertas y monitoreo.
- `Tutoriales API Cumbre` para webhooks externos y credenciales.

## Guardrails técnicos, legales y de seguridad

- No ejecutar acciones críticas sin permisos y aprobación cuando corresponda.
- No guardar secretos en claro; usar `credencial_ref`.
- No permitir loops infinitos entre flujos.
- Toda ejecución debe tener idempotency key.
- Todo webhook externo debe validar firma o secreto.
- Toda automatización debe poder pausarse por módulo o tenant.
- No borrar datos automáticamente; usar estados, anulaciones o acciones reversibles auditadas.
- Acciones fiscales, contables, pagos, bajas, mensajes sensibles y cambios de precio deben respetar guardrails del módulo dueño.

## Estructura sugerida de landing

1. Hero con diagrama de flujo: evento → condición → acción → auditoría.
2. Problema: tareas repetitivas y automatizaciones inseguras.
3. Solución: flujos internos con permisos, logs y pausas.
4. Diferencial ERP: automatiza con contexto real de módulos.
5. Seguridad: idempotencia, anti-loop, aprobaciones y webhooks firmados.
6. Casos de uso.
7. Planes y add-ons.
8. Timeline: elegir trigger → condición → acción → prueba → activar → monitorear.
9. Integraciones con WhatsApp, Marketing, Empresas, BI y APIs.
10. CTA final.

## Casos de uso

- Avisar por WhatsApp cuando un pago vence.
- Crear seguimiento comercial al cambiar una oportunidad.
- Generar alerta cuando stock cae debajo del mínimo.
- Pedir aprobación antes de enviar un pago.
- Notificar al contador por cierre pendiente.
- Activar campaña a clientes inactivos.
- Registrar evento BI cuando una automatización falla.

## SEO

Title sugerido:
Cumbre Automatizaciones | Workflows seguros para ERP y PyMEs

Meta description:
Automatizá tareas entre módulos del ERP con triggers, condiciones, acciones, webhooks, auditoría, idempotencia y aprobaciones humanas.

Keywords:
automatizaciones para ERP, workflows empresariales, automatizar tareas PyME, flujos no-code para empresas, automatizaciones con WhatsApp, webhooks ERP

H1:
Automatizaciones seguras para tu ERP

H2 sugeridos:
- Automatizá tareas sin perder control.
- Flujos con permisos, auditoría e idempotencia.
- WhatsApp, pagos, stock, ventas y aprobaciones conectadas.
- Pausá, auditá y corregí cada ejecución.

## CTAs

- Solicitar demo
- Ver planes
- Hablar con Gema Digital

## Planes

- Automatizaciones Base: hasta 5 flujos activos, triggers internos, acciones simples e historial básico.
- Automatizaciones Standard: hasta 50 flujos activos, condiciones avanzadas, webhooks, reintentos e idempotencia. Recomendado.
- Automatizaciones Full: hasta 500 flujos activos, multi módulo avanzado, aprobaciones, auditoría extendida y alertas BI.

Add-ons:

- Bloque de flujos adicionales.
- Webhooks avanzados.
- Automatizaciones críticas asistidas.
- Soporte prioritario.

## Estilo visual

Tecnológico, claro y operativo. Usar diagramas de nodos, cards de triggers/acciones, estados de ejecución, logs, alertas y switches de pausa. Evitar parecer una herramienta técnica solo para programadores; debe sentirse accesible para una PyME.

## Auditoría previa al cierre

- Producto: se posiciona como automatización segura del ERP, no como Zapier abierto.
- SEO: cubre workflows, automatizaciones, ERP, PyMEs y WhatsApp.
- Legal: aclara responsabilidad del usuario en acciones sensibles.
- Seguridad: idempotencia, anti-loop, permisos, firmas y pausas.
- Integraciones: todos los módulos Cumbre, WhatsApp Hub, Marketing, Empresas, BI y Tutoriales API.

## Próximos pasos

Implementar landing en WordPress cuando se decida publicar. No desplegar desde este prompt.
