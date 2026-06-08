# Prompt Web: Cumbre Core Plataforma

## Nombre del módulo/capa

Cumbre Core Plataforma

## Objetivo de la landing

Diseñar una página de confianza y arquitectura comercial para presentar `Cumbre Core Plataforma` como el núcleo SaaS que permite que ERP Cumbre sea modular, seguro, auditable, multi-tenant y escalable.

No debe parecer una landing de un módulo funcional más. Debe explicar la base que gobierna todos los módulos: usuarios, permisos, activación, billing, trial, panel de control, auditoría, integraciones y seguridad.

## Público ideal

Dueños de PyMEs, empresas en crecimiento, responsables administrativos, equipos de sistemas, contadores, implementadores, partners y decisores que necesitan entender por qué Cumbre puede crecer por módulos sin volverse desordenado.

## Mensaje principal

La plataforma que ordena, activa y gobierna todos tus módulos Cumbre.

## Subtítulo

Cumbre Core Plataforma reúne tenant, usuarios, roles, permisos, panel de control, billing, trial, auditoría, integraciones y activación modular para que cada empresa use solo lo que necesita, con trazabilidad y seguridad.

## Problema que resuelve

Muchos sistemas crecen sumando funciones, pero después se vuelven difíciles de administrar:

- Usuarios sin permisos claros.
- Módulos activados manualmente.
- Integraciones sin estado visible.
- Trials sin control real.
- Credenciales dispersas.
- Acciones sensibles sin auditoría.
- Reportes desconectados del plan contratado.
- Automatizaciones sin saber si el módulo está habilitado.

## Propuesta de valor

Cumbre Core Plataforma convierte ERP Cumbre en una plataforma SaaS modular real. Cada módulo se activa, limita, audita y conecta desde una base común. El cliente ve qué tiene activo, qué está en trial, qué consume, qué integración falta configurar y qué acciones requieren atención.

## Funcionalidades principales

- Multi-tenant por empresa.
- Usuarios, roles y permisos.
- Matriz Cumbre de módulos disponibles.
- Activación/desactivación de módulos.
- Panel de control general.
- Trial, planes, límites y funciones bloqueadas.
- Estado de pagos con Gema Pagos.
- Estado de integraciones externas.
- Alertas de consumo, trial, pagos, seguridad e integraciones.
- Asistente guiado por módulo.
- Auditoría de acciones críticas.
- Router de UI según módulos habilitados.
- Base para telemetría y costos por tenant.

## Módulos Cumbre conectados

- Todos los módulos Cumbre dependen de esta capa.
- `Cumbre CRM`: tronco relacional.
- `Cumbre Reportes BI`: consumo, alertas y dashboards.
- `Cumbre Automatizaciones`: eventos internos con permisos.
- `Cumbre WhatsApp Hub`: alertas y seguimiento con opt-in.
- `Tutoriales API Cumbre`: conexión guiada de plataformas externas.
- `Gema Pagos`: suscripciones, checkout, pagos y conversión de trial.

## Guardrails técnicos, legales y de seguridad

- No usar la UI como fuente real de permisos.
- No guardar secretos en Firestore ni en WordPress.
- No activar módulos sin revisar dependencias, plan y estado de suscripción.
- No permitir acciones críticas sin auditoría.
- No exponer datos entre tenants.
- No crear rutas privadas fuera de `artifacts/{appId}/users/{tenantId}`.
- No permitir implementadores sin autorización del tenant.
- No enviar alertas por WhatsApp/email sin configuración y consentimiento cuando corresponda.
- No prometer seguridad absoluta; comunicar trazabilidad, controles y buenas prácticas.

## Estructura sugerida de landing

1. Hero: “La plataforma que gobierna todos tus módulos Cumbre”.
2. Problema: crecer por módulos sin control genera caos.
3. Solución: núcleo SaaS multi-tenant con permisos, billing y auditoría.
4. Visual de panel: módulos activos, trial, consumo, pagos, integraciones y alertas.
5. Matriz Cumbre: cada empresa usa solo lo que necesita.
6. Seguridad: tenant, roles, permisos, credenciales seguras y auditoría.
7. Billing y trial: límites, upgrade, preservación de datos y Gema Pagos.
8. Integraciones: Tutoriales API, Secret Manager, WhatsApp Hub y Automatizaciones.
9. Casos de uso.
10. CTA final.

## Casos de uso

- Activar `Cumbre Stock` para una empresa que ya usa CRM y Catálogo.
- Ver qué módulos están en trial y cuándo vencen.
- Detectar una integración de WhatsApp que requiere reautorización.
- Bloquear una función premium que supera el plan contratado.
- Auditar quién aprobó una acción crítica.
- Convertir un trial a pago preservando datos.
- Dar acceso a un contador o implementador con permisos limitados.

## SEO

Title sugerido:
Cumbre Core Plataforma | ERP modular con permisos, billing y auditoría

Meta description:
Conocé Cumbre Core Plataforma, el núcleo SaaS de ERP Cumbre para módulos, usuarios, permisos, billing, trial, integraciones, panel de control y auditoría.

Keywords:
ERP modular, SaaS multi tenant, panel de control ERP, ERP con permisos, ERP con auditoría, software empresarial modular, ERP para PyMEs, plataforma SaaS empresarial

H1:
El núcleo que ordena todos tus módulos Cumbre

H2 sugeridos:

- Una plataforma modular, no un sistema rígido.
- Usuarios, roles y permisos por empresa.
- Trial, planes, límites y pagos bajo control.
- Integraciones visibles y auditables.
- Seguridad y trazabilidad desde la base.

## CTAs

- Solicitar demo
- Ver módulos Cumbre
- Hablar con Gema Digital

## Planes o niveles comerciales

Esta capa debe mostrarse como base incluida en todo ERP Cumbre, no como módulo opcional aislado.

Niveles sugeridos:

- Core Incluido: tenant, usuarios base, panel de control, activación modular, trial, billing, asistente guiado y auditoría básica.
- Core Empresas: roles avanzados, auditoría extendida, multi-área, implementador autorizado, alertas ejecutivas y exportaciones.
- Core Holding: multiempresa, gobierno de permisos, auditoría extendida, reportes consolidados y configuración asistida.

## Estilo visual

Robusto, claro, confiable y ejecutivo. Mostrar una interfaz de panel central con cards de módulos, estados de trial, consumo, pagos, integraciones, roles y alertas. Usar estética Cumbre: tecnológica, ordenada, sólida, con sensación de control empresarial.

No debe parecer una landing de “feature administrativa”; debe sentirse como el centro de mando del ERP.

## Auditoría previa al cierre

- Producto: posiciona la base SaaS que hace viable toda la modularidad Cumbre.
- SEO: cubre ERP modular, SaaS multi-tenant, permisos, panel y auditoría.
- Legal: aclara control de roles, permisos, datos, privacidad y responsabilidad del cliente.
- Seguridad: tenant isolation, credenciales seguras, permisos backend y auditoría.
- Integraciones: Gema Pagos, Tutoriales API, Secret Manager, BI, Automatizaciones y WhatsApp Hub.

## Próximos pasos

Implementar página explicativa en WordPress cuando se decida publicar. No desplegar desde este prompt.
