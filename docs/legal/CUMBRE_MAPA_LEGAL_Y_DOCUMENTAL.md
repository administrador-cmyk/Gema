# Mapa legal y documental - Plataforma Cumbre

Fecha de inicio: 2026-06-06

Estado: borrador de investigación operativa. No reemplaza revisión de abogado, contador ni especialista regulatorio.

## Objetivo

Definir la documentación legal necesaria para publicar, vender, operar e implementar la plataforma Cumbre y sus módulos sin prometer alcances no validados.

Cumbre debe comunicarse como una plataforma SaaS modular con implementación asistida, planes, add-ons y pilotos controlados cuando corresponda. Cada módulo debe tener alcance funcional, límites, responsabilidades del cliente, responsabilidades de GEMA/Cumbre, datos tratados, proveedores externos, condiciones comerciales y restricciones.

## Fuentes normativas iniciales revisadas

- Ley 25.326 de Protección de Datos Personales y AAIP: protección de datos personales, Registro Nacional de Bases de Datos, derechos de acceso, rectificación, actualización y supresión.
- AAIP sobre transferencias internacionales: restricciones para transferir datos personales a países sin nivel adecuado y uso de cláusulas contractuales modelo.
- Ley 24.240 de Defensa del Consumidor: información cierta, clara y detallada; contratación a distancia; contratos de adhesión; derecho de revocación.
- Disposición 954/2025 de Defensa del Consumidor: botón de arrepentimiento y botón de baja para contratación a distancia, con acceso visible y sin trabas.
- Ley 11.723 de Propiedad Intelectual y Ley 25.036: protección de programas de computación fuente/objeto, bases de datos, documentación y contenidos.
- ARCA: facturación electrónica, clave fiscal, puntos de venta, comprobantes electrónicos, CAE y validación fiscal caso por caso.
- BCRA: normativa de proveedores de servicios de pago, PSP, billeteras, QR, transferencias y registro cuando se asumen funciones reguladas.
- PCI DSS: estándar de seguridad aplicable si se almacenan, procesan o transmiten datos de tarjetas.
- Ley 26.951 Registro Nacional No Llame: comunicaciones comerciales telefónicas no solicitadas.

## Principio rector

Cumbre debe separar claramente:

- Lo que el software permite operar.
- Lo que depende de configuración, proveedor externo o cuenta del cliente.
- Lo que requiere implementación asistida.
- Lo que está en demo comercial o piloto controlado.
- Lo que no está incluido en el plan base.
- Lo que está sujeto a normativa fiscal, bancaria, de consumo o de datos.

## Documentos legales necesarios

### 1. Términos y condiciones generales del sitio

Debe cubrir el uso del sitio público, páginas comerciales, formularios, comparativas, contenido informativo, propiedad intelectual y límites de responsabilidad por información no contractual.

Estado actual: existe `/terminos`, pero es genérico. Debe ampliarse o complementarse con documentos específicos de Cumbre.

### 2. Términos de servicio SaaS Cumbre

Documento principal para clientes de Cumbre.

Debe incluir:

- Identificación de titular/proveedor contractual.
- Naturaleza del servicio SaaS.
- Licencia de uso limitada, revocable, no exclusiva, no transferible.
- Planes, add-ons, módulos y límites.
- Usuarios, cajas, locales, productos, comprobantes, almacenamiento, integraciones.
- Prueba gratuita y conversión a plan pago.
- Reglas de suspensión, bloqueo parcial y conservación de datos.
- Baja del servicio, exportación y retención.
- Soporte, mantenimiento y cambios.
- Actualizaciones del producto.
- Prohibiciones de uso.
- Responsabilidades del cliente.
- Responsabilidades de GEMA/Cumbre.
- Exclusiones: no ERP empresarial completo en planes económicos, no asesoramiento contable/legal/fiscal, no garantía de resultados comerciales.

### 3. Condiciones comerciales, planes y facturación

Documento o anexo con:

- Precios vigentes.
- Moneda.
- Impuestos aplicables.
- Promociones y duración.
- Renovación mensual/anual.
- Mora.
- Cambios de plan.
- Upgrade/downgrade.
- Extras y add-ons.
- Políticas de reembolso.
- Diferencia entre B2B y consumidor final.
- Condiciones de prueba gratuita.

Debe alinearse con Cumbre ERP Negocios, Cumbre CRM y futuros planes por módulo.

### 4. Botón de arrepentimiento y botón de baja

Si Cumbre permite contratar online a consumidores o usuarios finales, se debe evaluar implementar:

- Botón de Arrepentimiento.
- Botón de Baja de Servicio.
- Confirmación de recepción con código de gestión.
- Registro de solicitudes.
- Flujo sin login obligatorio ni trabas.

En escenarios B2B puros puede haber matices, pero el sitio debe estar preparado si vende por canales digitales a consumidores o monotributistas/comercios alcanzados.

### 5. Política de privacidad Cumbre

Documento específico para Cumbre, separado o anexo de la política general.

Debe cubrir:

- Datos de cuenta.
- Datos de usuarios del cliente.
- Datos de clientes/proveedores cargados por el cliente.
- Datos comerciales: productos, precios, stock, ventas, presupuestos, cobros, comprobantes.
- Datos fiscales y administrativos.
- Logs, auditoría, soporte y seguridad.
- Datos tratados por el asistente IA.
- Finalidades.
- Bases de tratamiento.
- Conservación.
- Derechos ARCO: acceso, rectificación, actualización y supresión.
- Contacto para privacidad.
- Transferencias internacionales.
- Subencargados/proveedores.
- Seguridad.
- Incidentes.

### 6. Acuerdo de tratamiento de datos / DPA

Necesario para clientes B2B cuando Cumbre procesa datos por cuenta del cliente.

Debe distinguir:

- GEMA/Cumbre como responsable de sus datos comerciales propios.
- Cliente como responsable de los datos de sus clientes, empleados, proveedores y operaciones.
- GEMA/Cumbre como encargado/procesador de datos en la prestación del SaaS.

Debe incluir:

- Objeto y duración.
- Naturaleza y finalidad del tratamiento.
- Tipos de datos.
- Categorías de titulares.
- Medidas de seguridad.
- Subencargados.
- Confidencialidad.
- Asistencia ante derechos de titulares.
- Eliminación/devolución de datos al finalizar.
- Transferencias internacionales.
- Auditoría razonable.

### 7. Política de cookies y tecnologías similares

Existe `/politica-de-cookies`, pero debe conectarse con:

- Analytics.
- Pixel/ads si se activan.
- CRM/leads.
- Chat/asistente.
- Consentimiento si se activan cookies no necesarias.
- Medición de conversiones.

### 8. Política de seguridad y disponibilidad

Debe explicar sin revelar arquitectura interna:

- Medidas razonables de seguridad.
- Control de accesos.
- Roles y permisos.
- Backups.
- Monitoreo.
- Logs.
- Cifrado en tránsito.
- Gestión de incidentes.
- Limitaciones de disponibilidad.
- Ventanas de mantenimiento.
- Responsabilidad del cliente sobre contraseñas, usuarios y dispositivos.

### 9. SLA / Soporte y mantenimiento

Debe separar:

- Soporte incluido por plan.
- Soporte pago o implementación asistida.
- Canales.
- Horarios.
- Prioridades.
- Tiempos objetivo de respuesta.
- Exclusiones.
- Incidentes de proveedores externos.
- Capacitación.
- Migraciones.

### 10. Política de backups, retención y exportación

Debe cubrir:

- Retención durante trial.
- Retención tras baja.
- Exportación básica.
- Bloqueo por límites.
- Mora.
- Eliminación definitiva.
- Backups técnicos no como archivo legal garantizado.
- Responsabilidad del cliente de descargar información crítica.

### 11. Política de uso aceptable

Debe prohibir:

- Uso ilícito.
- Carga de datos sin autorización.
- Spam.
- Scraping abusivo.
- Fraude.
- Manipulación fiscal.
- Emisión de comprobantes falsos.
- Violación de derechos de terceros.
- Carga de malware.
- Intentos de vulnerar seguridad.
- Reventa no autorizada.

### 12. Aviso de propiedad intelectual y derechos reservados

Debe proteger:

- Software Cumbre.
- Código fuente/objeto.
- Diseño.
- Flujos.
- Documentación.
- Bases de conocimiento.
- Marca Cumbre.
- Marca GEMA Digital.
- Contenidos.
- Logos.
- Material comercial.
- Templates, prompts, asistentes, configuraciones e integraciones.

Debe aclarar:

- El cliente no adquiere propiedad del software.
- Se otorga derecho de uso bajo licencia.
- El cliente conserva sus datos y contenidos propios.
- Feedback puede ser usado para mejorar el producto sin transferir secretos.
- No se permite ingeniería inversa, copia, sublicencia o extracción no autorizada.

### 13. Anexo de módulos Cumbre

Cada módulo debe tener una ficha legal/comercial con:

- Alcance incluido.
- Funciones no incluidas.
- Dependencias.
- Datos tratados.
- Riesgos.
- Requisitos del cliente.
- Add-ons aplicables.
- Límites de responsabilidad.
- Estado: activo, beta, piloto, implementación asistida.

### 14. Anexo fiscal ARCA

Necesario para Cumbre Facturador y cualquier integración fiscal.

Debe aclarar:

- No es asesoramiento contable, impositivo ni legal.
- El cliente es responsable de su situación fiscal.
- Emisión real requiere CUIT, clave fiscal, punto de venta, certificados/delegaciones y configuración validada.
- ARCA, normativa, servicios web y disponibilidad pueden cambiar.
- Producción fiscal requiere piloto controlado.
- El cliente debe validar comprobantes emitidos, categorías, alícuotas, domicilios, actividad, condición frente al IVA y datos de clientes.

### 15. Anexo de pagos y cobros

Necesario para Cumbre Cobros y Gema Pagos.

Debe aclarar:

- Si GEMA/Cumbre sólo integra proveedores externos o si opera funciones de pago propias.
- Medios soportados según proveedor.
- Comisiones, retenciones, contracargos, demoras y conciliación.
- No custodia de fondos si se opera con cuentas del cliente/proveedor externo.
- No capturar datos completos de tarjeta si se delega a pasarelas.
- PCI DSS si se procesan tarjetas.
- BCRA/PSP si se asumieran funciones reguladas.
- Responsabilidad de Mercado Pago, Nave, Stripe, PayPal u otros proveedores.

### 16. Anexo de IA y asistentes

Necesario para Asistente Guiado, Asistente IA Plus, recomendaciones, análisis de datos y chat.

Debe aclarar:

- La IA orienta, no reemplaza criterio humano.
- Puede equivocarse.
- No brinda asesoramiento legal, fiscal, médico, financiero o contable.
- Recomendaciones sujetas a validación humana.
- Datos enviados a proveedores de IA si aplica.
- No cargar información sensible innecesaria.
- Logs y mejora del servicio.
- Human-in-the-loop en acciones críticas.

### 17. Anexo de integraciones y terceros

Debe cubrir:

- APIs de terceros.
- Cambios de disponibilidad.
- Límites, tokens, permisos.
- Costos externos.
- Condiciones propias de terceros.
- Marketplaces, ecommerce, WhatsApp, bancos, pasarelas, ARCA, proveedores de IA.

### 18. Política de comunicaciones comerciales

Debe cubrir:

- Consentimiento para contacto.
- Baja de comunicaciones.
- WhatsApp/email/teléfono.
- Registro No Llame.
- Leads captados por formularios, campañas y eventos.
- Comunicaciones transaccionales vs promocionales.

### 19. Contrato de implementación / orden de trabajo

Para proyectos asistidos:

- Alcance.
- Entregables.
- Cronograma.
- Hitos.
- Responsabilidades del cliente.
- Migración de datos.
- Capacitación.
- Integraciones.
- Aceptación.
- Cambios de alcance.
- Pago.
- Soporte post-implementación.

### 20. Política de migración de datos

Debe cubrir:

- Formatos aceptados.
- Calidad de datos.
- Responsabilidad por datos incompletos o erróneos.
- Validación por cliente.
- Pruebas antes de producción.
- Exclusiones.

## Matriz por módulo

### Cumbre ERP Negocios

Riesgos principales:

- Prometer más que POS/caja/stock básico.
- Confundir con ERP empresarial.
- Facturación ARCA productiva sin validación.
- Manejo de datos de ventas, clientes y comprobantes.

Documentos aplicables:

- Términos SaaS.
- Planes y precios.
- Trial y límites.
- Anexo POS/Negocios.
- Anexo fiscal si activa Facturador ARCA.
- Anexo pagos si activa Cumbre Cobros.
- Privacidad/DPA.
- Soporte/SLA.

### Cumbre CRM

Riesgos principales:

- Leads y datos personales.
- Seguimiento comercial.
- Historial de contactos.
- Integraciones con WhatsApp, email, web, campañas.
- Recomendaciones IA.

Documentos aplicables:

- Términos SaaS.
- Privacidad/DPA.
- Política de comunicaciones comerciales.
- Anexo IA.
- Anexo CRM.
- Anexo integraciones.

### Cumbre Catálogo

Riesgos principales:

- Datos de productos, precios, IVA, proveedores, imágenes y marcas.
- Errores de precio.
- Errores de alícuotas.
- Datos aportados por proveedores.

Documentos aplicables:

- Anexo Catálogo.
- Propiedad de datos.
- Responsabilidad del cliente por veracidad de productos/precios/impuestos.
- Privacidad si hay datos de proveedores/personas.

### Cumbre Cobros / Gema Pagos

Riesgos principales:

- Pagos digitales.
- Conciliación incorrecta.
- Retenciones, comisiones, contracargos.
- Dependencia de proveedores externos.
- Eventual regulación PSP/BCRA si se asumen funciones de pago.

Documentos aplicables:

- Anexo pagos.
- Términos de proveedores externos.
- PCI DSS si aplica.
- Política de seguridad.
- Privacidad/DPA.

### Cumbre Facturador ARCA

Riesgos principales:

- Emisión fiscal.
- Datos tributarios.
- CAE, comprobantes, puntos de venta.
- Errores impositivos.
- Disponibilidad ARCA.

Documentos aplicables:

- Anexo fiscal ARCA.
- Implementación asistida.
- Responsabilidad del contribuyente.
- Validación de contador/cliente.

### Cumbre Stock / Depósito / WMS

Riesgos principales:

- Diferencias de inventario.
- Errores de carga.
- Stock crítico.
- Trazabilidad.
- Transferencias internas.

Documentos aplicables:

- Anexo stock/deposito.
- Límites de stock básico vs avanzado.
- Responsabilidad por conteo físico.
- Política de soporte.

### Cumbre Resto / Panadería / Comidas

Riesgos principales:

- Comandas.
- Producción diaria.
- Recetas.
- Merma.
- Turnos.
- Propinas.
- Pedidos.

Documentos aplicables:

- Anexo vertical gastronómico.
- Limitaciones operativas.
- No reemplaza obligaciones bromatológicas, laborales o fiscales.

### Cumbre eCommerce / Mercado Libre

Riesgos principales:

- Publicaciones.
- Stock sincronizado.
- Precios.
- Reputación.
- Cancelaciones.
- Proveedores externos.
- Defensa del consumidor.

Documentos aplicables:

- Anexo ecommerce/marketplace.
- Términos de terceros.
- Botón arrepentimiento/baja si hay contratación directa.
- Política de consumidores.

### Cumbre Marketing

Riesgos principales:

- Publicidad.
- Remarketing.
- Datos de leads.
- Cookies.
- Consentimiento.
- Registro No Llame.

Documentos aplicables:

- Política de comunicaciones comerciales.
- Cookies.
- Privacidad.
- Anexo marketing.
- Responsabilidad por claims publicitarios.

### Asistente Guiado / IA Plus

Riesgos principales:

- Recomendaciones automáticas.
- Error de IA.
- Datos sensibles.
- Acciones críticas.
- Proveedores de IA.

Documentos aplicables:

- Anexo IA.
- Aviso de no asesoramiento profesional.
- Human-in-the-loop.
- Privacidad/DPA.

## Documentos prioritarios para redactar primero

1. Términos de Servicio SaaS Cumbre.
2. Política de Privacidad Cumbre.
3. DPA / Acuerdo de tratamiento de datos.
4. Anexo de Planes, Trial, Límites y Baja.
5. Anexo de Propiedad Intelectual y Derechos Reservados.
6. Anexo Fiscal ARCA.
7. Anexo de Pagos y Cobros.
8. Anexo de IA y Asistentes.
9. Política de Seguridad, Backups y Disponibilidad.
10. Política de Comunicaciones Comerciales.

## Acciones recomendadas antes de publicar contratación online

- Definir titular legal exacto: persona jurídica/persona humana, CUIT, domicilio, email legal.
- Definir si Cumbre se vende B2B, B2C o ambos.
- Publicar términos por plan y modalidad.
- Implementar Botón de Arrepentimiento y Botón de Baja si corresponde.
- Registrar o revisar bases de datos personales ante AAIP.
- Revisar transferencias internacionales por hosting, IA, analytics, email, CRM y soporte.
- Confirmar si GEMA/Cumbre actúa como PSP o sólo integra proveedores externos.
- Evitar almacenar datos completos de tarjetas.
- Definir proceso de incidentes de seguridad.
- Definir exportación/baja de datos.
- Revisar marcas Cumbre/GEMA ante INPI.
- Evaluar registro de software/base de datos ante DNDA.

## Nota de revisión profesional

Estos documentos son una base operativa para ordenar producto, web y contrato. Antes de usarlos como términos vinculantes, deben ser revisados por profesionales en derecho tecnológico, defensa del consumidor, protección de datos, derecho tributario y regulación de pagos.
