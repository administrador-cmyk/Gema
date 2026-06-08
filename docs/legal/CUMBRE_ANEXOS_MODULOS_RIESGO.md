# Anexos legales por módulo y riesgo - Cumbre

Estado: borrador interno para producto, web y revisión legal.

## Anexo A - Cumbre ERP Negocios

### Alcance

POS económico, caja, stock básico, precios, reposición diaria, productos, proveedores básicos, compras simples, Vista Hoy del Negocio, asistente guiado y submódulos verticales.

### Exclusiones

- ERP empresarial completo.
- Multiempresa avanzada.
- Multi-CUIT avanzado.
- Stock avanzado complejo.
- Integraciones a medida incluidas.
- Facturación ARCA productiva incluida por defecto.
- Asesoramiento contable, fiscal o legal.

### Add-ons

- Cumbre Cobros.
- Facturador ARCA controlado.
- Asistente IA Plus.
- Submódulos verticales.
- Integraciones de pasarela.

### Advertencia contractual

El cliente es responsable por datos de productos, precios, alícuotas, stock físico, caja, usuarios y decisiones operativas.

## Anexo B - Cumbre CRM

### Alcance

Leads, clientes, oportunidades, pipeline, presupuestos, próximas acciones, historial comercial, relación con catálogo, cobros y seguimiento.

### Exclusiones

- No reemplaza asesoramiento comercial profesional.
- No garantiza cierre de ventas.
- No garantiza performance de campañas.
- No implica facturación fiscal automática.

### Datos sensibles del módulo

- Datos de contacto.
- Historial de interacción.
- Presupuestos.
- Notas comerciales.
- Segmentación.
- Comunicaciones.

### Advertencia contractual

El cliente debe tener base legal o autorización para cargar, contactar y procesar datos de terceros.

## Anexo C - Cumbre Catálogo

### Alcance

Productos, servicios, precios, IVA, stock base, proveedores, insumos, combos y datos necesarios para presupuestos/ventas.

### Riesgos

- Precios desactualizados.
- Alícuotas incorrectas.
- Datos de proveedor incompletos.
- Marcas, imágenes o contenidos sin autorización.

### Advertencia contractual

El cliente responde por veracidad, legalidad y actualización de productos, precios, imágenes, impuestos y datos cargados.

## Anexo D - Cumbre Cobros / Gema Pagos

### Alcance

Registro de cobros, referencias manuales, QR/link de pago, conciliación, integración con proveedores externos y medios de pago según configuración.

### Riesgos

- Contracargos.
- Comisiones.
- Retenciones.
- Demoras de liquidación.
- Rechazos.
- Errores de conciliación.
- Disponibilidad de proveedores externos.

### Advertencia contractual

Si Cumbre sólo integra pasarelas externas, debe aclararse que Mercado Pago, Nave, Stripe, PayPal u otros proveedores procesan pagos bajo sus propios términos.

Si Cumbre/GEMA llegara a custodiar fondos, iniciar pagos o prestar servicios regulados, debe revisarse normativa BCRA/PSP antes de operar.

No almacenar datos completos de tarjetas salvo cumplimiento PCI DSS aplicable.

## Anexo E - Cumbre Facturador ARCA

### Alcance

Preparación, emisión o gestión de comprobantes electrónicos según estado del módulo, configuración fiscal y validación del cliente.

### Riesgos

- Errores de alícuota.
- Datos fiscales incorrectos.
- Indisponibilidad ARCA.
- Cambios normativos.
- CAE rechazado.
- Punto de venta mal configurado.
- Certificados/delegaciones vencidas.

### Advertencia contractual

La facturación ARCA se comunica como demo, piloto controlado o implementación asistida hasta validar cada caso. El cliente y su contador son responsables de la situación fiscal, datos declarados y revisión de comprobantes.

## Anexo F - Cumbre Stock / Depósito / WMS

### Alcance

Stock básico o avanzado según plan, ubicaciones, ingresos, egresos, remitos, picking, transferencias internas y preparación de pedidos.

### Riesgos

- Diferencias con stock físico.
- Errores de carga.
- Falta de conteo.
- Uso incorrecto por usuarios.
- Etiquetas/códigos erróneos.

### Advertencia contractual

El sistema asiste el control, pero el cliente mantiene responsabilidad por conteos físicos, procesos internos, carga correcta y validación de movimientos.

## Anexo G - Cumbre Resto / Panadería / Comidas

### Alcance

Comandas, mesas, cocina, take away, delivery básico, platos, combos, insumos, recetas simples, turnos, propinas, merma y producción diaria según submódulo.

### Exclusiones

- No reemplaza control bromatológico.
- No reemplaza asesoramiento laboral.
- No garantiza cumplimiento municipal/sanitario.
- No reemplaza control contable o fiscal.

## Anexo H - Cumbre eCommerce / Mercado Libre

### Alcance

Sincronización de productos, stock, pedidos, publicaciones, cobros y facturación según integración.

### Riesgos

- Cambios de APIs.
- Pausas o sanciones de marketplace.
- Diferencias de stock.
- Cancelaciones.
- Reputación.
- Reclamos de consumidores.

### Advertencia contractual

El cliente debe cumplir términos de marketplaces, defensa del consumidor, políticas de publicación, derechos de imagen/marca y condiciones de entrega.

## Anexo I - Cumbre Marketing

### Alcance

Campañas, contenido, audiencias, leads, calendarios, reportes y automatizaciones comerciales según plan.

### Riesgos

- Claims publicitarios.
- Uso de datos sin consentimiento.
- Spam.
- Registro No Llame.
- Cookies/remarketing.
- Cambios de plataformas.

### Advertencia contractual

El cliente debe aprobar claims, ofertas, precios, promociones, imágenes, bases de contactos y condiciones comerciales.

## Anexo J - Asistente Guiado / IA Plus

### Alcance

Ayuda contextual, recomendaciones, checklist, respuestas y asistencia operativa.

### Exclusiones

- No reemplaza criterio humano.
- No reemplaza asesoramiento legal, fiscal, contable o financiero.
- No garantiza exactitud perfecta.
- No debe ejecutar acciones críticas sin revisión cuando el flujo lo requiera.

### Advertencia contractual

Las respuestas de IA deben validarse. El cliente no debe cargar datos sensibles innecesarios. La configuración puede depender de proveedores externos de IA.

## Anexo K - Panel de Control

### Alcance

Módulos activos, trial, límites, alertas, planes, billing, estado operativo y configuración según rol.

### Riesgos

- Errores de configuración.
- Cambios de plan.
- Usuarios con permisos excesivos.
- Alertas ignoradas.

### Advertencia contractual

El cliente debe administrar usuarios, permisos, responsables y configuraciones internas.

## Anexo L - Integraciones

### Alcance

APIs, webhooks, conectores, sincronización de datos y automatizaciones con terceros.

### Riesgos

- Cambios de API.
- Tokens vencidos.
- Rate limits.
- Errores de terceros.
- Costos externos.
- Caídas.
- Datos incompletos.

### Advertencia contractual

Las integraciones dependen de servicios externos, permisos del cliente y condiciones del proveedor. Las integraciones a medida no están incluidas salvo pacto expreso.
