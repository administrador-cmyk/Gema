# Checklist legal operativo - Cumbre

Estado: borrador de trabajo para equipo GEMA/Cumbre.

## 1. Identidad legal y datos del proveedor

- Definir razón social o titular contractual.
- Definir CUIT.
- Definir domicilio legal/comercial.
- Definir email legal.
- Definir email de privacidad/datos personales.
- Definir email de soporte.
- Definir jurisdicción y ley aplicable.
- Definir si se usará marca Cumbre, GEMA Digital o ambas en contratos.

## 2. Propiedad intelectual y marcas

- Verificar disponibilidad y registro de marca GEMA Digital.
- Verificar disponibilidad y registro de marca Cumbre / ERP Cumbre.
- Evaluar registro de software Cumbre ante DNDA.
- Evaluar registro de documentación, manuales y base de datos si corresponde.
- Crear leyenda estándar:
  - `Cumbre`, `ERP Cumbre`, `Cumbre CRM`, `Cumbre ERP Negocios`, `GEMA Digital` y sus logos son marcas, nombres comerciales o activos de sus titulares.
  - Todos los derechos reservados.
  - El cliente recibe licencia de uso, no propiedad sobre el software.

## 3. Datos personales

- Identificar bases de datos:
  - Leads web.
  - Clientes Cumbre.
  - Usuarios de clientes.
  - Clientes/proveedores cargados por clientes.
  - Logs de uso.
  - Soporte.
  - Marketing.
  - WhatsApp/IA.
- Confirmar necesidad de inscripción ante Registro Nacional de Bases de Datos Personales.
- Definir responsable y encargado por escenario.
- Crear DPA para clientes B2B.
- Definir subencargados:
  - hosting/cloud.
  - email.
  - analytics.
  - CRM.
  - IA.
  - backups.
  - soporte.
  - pasarelas de pago.
- Mapear transferencias internacionales.
- Definir mecanismo contractual para transferencias a países no adecuados.
- Definir procedimiento ARCO:
  - acceso.
  - rectificación.
  - actualización.
  - supresión.
- Definir retención y eliminación.

## 4. Cookies, tracking y campañas

- Listar cookies necesarias.
- Listar cookies analíticas.
- Listar cookies publicitarias.
- Identificar Meta Pixel, Google Ads, Analytics, Search Console u otros.
- Definir banner/gestión de consentimiento si se activan cookies no necesarias.
- Actualizar política de cookies.
- Crear política de comunicaciones comerciales.
- Implementar baja de newsletters.
- Revisar Registro No Llame para acciones telefónicas comerciales.

## 5. Contratación online

- Definir si el sitio permitirá contratar online o sólo solicitar demo.
- Si se contrata online:
  - publicar modelo de contrato.
  - mostrar precio, impuestos, duración, renovación, baja y restricciones.
  - implementar Botón de Arrepentimiento.
  - implementar Botón de Baja.
  - generar código de gestión.
  - registrar fecha/hora/IP/correo de solicitud.
  - establecer proceso de respuesta.
- Si sólo hay demo/venta asistida:
  - aclarar que el contacto no implica contratación.
  - enviar propuesta/orden de trabajo por canal trazable.

## 6. Planes, trial y límites

- Publicar condiciones de trial de 14 días.
- Definir cuándo inicia el trial.
- Definir si requiere tarjeta o no.
- Definir qué funciones quedan bloqueadas.
- Definir alerta al 80%.
- Definir gracia operativa al 100%.
- Definir bloqueo posterior:
  - nuevas altas.
  - funciones premium.
  - exportación básica.
  - lectura.
  - cierre de caja.
- Aclarar que los datos no se borran automáticamente por superar límites.
- Definir retención tras baja o mora.

## 7. Pagos y cobros

- Definir si GEMA/Cumbre:
  - sólo integra proveedores externos.
  - cobra suscripciones propias.
  - procesa fondos de terceros.
  - ofrece cuentas de pago.
  - inicia pagos.
- Si sólo integra proveedores:
  - aclarar dependencia de Mercado Pago, Nave, PayPal, Stripe u otros.
  - aclarar comisiones, retenciones y contracargos según proveedor.
  - no prometer disponibilidad de terceros.
- Si se procesan tarjetas:
  - evitar almacenar PAN/CVV.
  - delegar checkout/tokenización a proveedor PCI.
  - revisar obligaciones PCI DSS.
- Si se asumen funciones PSP:
  - revisar BCRA y registro PSP antes de operar.

## 8. ARCA y fiscalidad

- Definir estado real de Facturador ARCA:
  - demo comercial.
  - piloto controlado.
  - implementación asistida.
  - producción validada por cliente.
- Crear anexo fiscal.
- Aclarar responsabilidad del cliente sobre:
  - CUIT.
  - clave fiscal.
  - punto de venta.
  - condición fiscal.
  - alícuotas.
  - datos de clientes.
  - contador.
- No prometer asesoramiento fiscal.
- No prometer emisión productiva hasta validar caso.

## 9. Seguridad, backups y disponibilidad

- Crear política de seguridad.
- Definir roles y permisos.
- Definir 2FA si aplica.
- Definir backups y restauración.
- Definir límites de soporte.
- Definir incident response.
- Definir SLA por plan.
- Definir mantenimiento programado.
- Definir limitación por terceros.

## 10. IA y asistentes

- Aclarar que IA orienta y puede equivocarse.
- No usar IA como asesor fiscal/legal/contable.
- Definir qué datos pueden enviarse a proveedores de IA.
- Definir logs de conversación.
- Definir revisión humana para acciones críticas.
- Definir opción de desactivar IA por cliente/plan si corresponde.

## 11. Módulos y anexos

Para cada módulo crear anexo con:

- descripción.
- alcance incluido.
- exclusiones.
- límites por plan.
- datos tratados.
- integraciones.
- dependencias.
- soporte.
- estado del módulo.

Módulos prioritarios:

- Cumbre ERP Negocios.
- Cumbre CRM.
- Cumbre Catálogo.
- Cumbre Cobros.
- Cumbre Facturador ARCA.
- Cumbre Stock/Depósito/WMS.
- Cumbre Resto.
- Cumbre Panadería/Comidas.
- Cumbre eCommerce/Mercado Libre.
- Cumbre Marketing.
- Asistente Guiado / IA Plus.
- Panel de Control.

## 12. Documentos a publicar o preparar

Publicar en web:

- Términos y condiciones generales.
- Política de privacidad.
- Política de cookies.
- Términos de servicio Cumbre.
- Planes, trial, baja y reembolsos.
- Botón de Arrepentimiento, si corresponde.
- Botón de Baja, si corresponde.

Preparar para firma/aceptación:

- Propuesta comercial.
- Orden de trabajo.
- DPA.
- SLA.
- Anexo de módulo.
- Anexo ARCA.
- Anexo pagos.
- Anexo IA.
- Acuerdo de confidencialidad si se accede a datos sensibles.

## 13. Decisiones pendientes

- Titular contractual exacto.
- Modelo B2B, B2C o mixto.
- Cuándo se habilita contratación online.
- Quién será responsable de privacidad.
- Dónde se alojan datos productivos.
- Qué proveedores internacionales se usarán.
- Si Cumbre cobrará fondos de terceros o sólo integrará pasarelas.
- Si se registrará marca/software antes de lanzamiento comercial fuerte.
- Política de devoluciones/reembolsos por plan.
- Tiempos de soporte por plan.
