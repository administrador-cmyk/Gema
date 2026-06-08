# Matriz de riesgos legales - Cumbre / GEMA Digital

Fecha: 2026-06-06

Estado: documento interno de gestion de riesgos. Requiere validacion profesional antes de usarlo como politica formal.

## Escala

- Critico: puede bloquear lanzamiento, generar sancion relevante, perdida de PI, reclamo masivo o exposicion regulatoria.
- Alto: puede generar reclamos, contingencias contractuales o dano reputacional si no se controla.
- Medio: requiere documentacion y proceso, pero no bloquea por si solo.
- Bajo: monitoreo y mejora continua.

## Riesgos criticos

### 1. Titularidad indefinida de GEMA/Cumbre

Riesgo: vender, registrar o contratar sin definir razon social/persona titular, CUIT, domicilio, email legal y responsable de privacidad.

Impacto: contratos debiles, dificultad para cobrar, registrar marcas, responder reclamos o transferir activos.

Mitigacion:

- Definir titular contractual antes de publicar checkout.
- Usar el mismo titular en terminos, facturas, propuestas, privacidad, INPI, DNDA y proveedores.
- Crear correo legal y privacidad.

Responsable sugerido: direccion GEMA.

Prioridad: inmediata.

### 2. Propiedad intelectual sin cadena de titularidad

Riesgo: codigo, disenos, textos, prompts o marca creados por terceros sin cesion expresa.

Impacto: reclamos de autores, imposibilidad de vender/licenciar, perdida de valor del activo.

Mitigacion:

- Contratos de cesion de derechos patrimoniales con desarrolladores, disenadores, redactores y freelancers.
- NDA y clausula de confidencialidad.
- Registro/deposito DNDA de versiones clave.
- Registro de marcas INPI.
- Inventario de activos: codigo, UI, logos, textos, prompts, bases, manuales.

Responsable sugerido: direccion legal/operaciones.

Prioridad: inmediata.

### 3. Facturador ARCA comunicado como garantia fiscal

Riesgo: prometer cumplimiento automatico con ARCA o emision productiva sin validacion.

Impacto: reclamos por comprobantes incorrectos, problemas fiscales del cliente, dano reputacional.

Mitigacion:

- Lenguaje publico: "controlado", "piloto", "implementacion asistida", "sujeto a validacion".
- Checklist de produccion firmado por cliente/contador.
- Anexo ARCA obligatorio.
- Bitacora de homologacion y pruebas.
- No reemplazar contador.

Responsable sugerido: producto + implementacion + legal.

Prioridad: inmediata antes de venta.

### 4. Cobros/pagos con rol PSP no definido

Riesgo: GEMA cobra por terceros, custodia fondos, ofrece cuentas, inicia pagos o actua como agregador sin registro BCRA.

Impacto: exposicion regulatoria, sanciones, bloqueo de operatoria.

Mitigacion:

- Modelo recomendado inicial: integrador tecnico de pasarelas, sin custodia de fondos.
- Fondos liquidados directamente del proveedor al cliente.
- Anexo pagos con terminos de Mercado Pago/Nave/Stripe/PayPal u otros.
- Revision BCRA antes de asumir cualquier funcion de PSP.

Responsable sugerido: direccion + producto pagos + asesor regulatorio.

Prioridad: inmediata antes de Cumbre Cobros productivo.

### 5. Datos personales sin DPA ni registro operativo

Riesgo: tratar datos de clientes, leads, usuarios, proveedores y ventas sin roles claros ni politica especifica.

Impacto: denuncias AAIP, reclamos de clientes, perdida de confianza.

Mitigacion:

- Politica de privacidad Cumbre.
- DPA B2B.
- Registro de bases ante AAIP si corresponde.
- Mapa de subprocesadores y transferencias internacionales.
- Procedimiento ARCO.
- Medidas de seguridad documentadas.

Responsable sugerido: privacidad + tecnologia.

Prioridad: inmediata.

## Riesgos altos

### 6. Contratacion online sin prueba de aceptacion

Riesgo: usuario niega haber aceptado terminos, precio, renovacion o limites.

Mitigacion:

- Clickwrap obligatorio.
- Guardar version de terminos, fecha, hora, IP, usuario, email, plan, CUIT y hash/documento aceptado.
- Enviar confirmacion por email.
- Para contratos grandes, firma digital/electronica robusta.

Prioridad: alta.

### 7. Baja, arrepentimiento o reembolso mal gestionados

Riesgo: venta online alcanzada por defensa del consumidor sin Boton de Arrepentimiento/Baja ni codigo de gestion.

Mitigacion:

- Definir si el modelo sera B2B puro o mixto.
- Si hay consumidores o contratacion digital alcanzada, implementar botones visibles.
- Codigo de gestion dentro de 24 horas.
- Politica de reembolsos y excepciones.

Prioridad: alta si hay checkout.

### 8. Marketing/CRM usado para spam o contactos no autorizados

Riesgo: llamadas, WhatsApp, SMS o emails sin consentimiento o contra Registro No Llame.

Mitigacion:

- Politica de comunicaciones comerciales.
- Consentimiento y opt-out.
- Clausula donde cliente declara base legal para contactos cargados.
- Consulta No Llame para acciones propias de telemarketing.

Prioridad: alta para Cumbre CRM/Marketing.

### 9. IA con recomendaciones no validadas

Riesgo: asistente produce instrucciones equivocadas, sesgadas o interpretadas como asesoramiento profesional.

Mitigacion:

- Anexo IA.
- Aviso visible: orienta, puede equivocarse, no reemplaza profesional.
- Human-in-the-loop en acciones criticas.
- Minimizar datos enviados a proveedores de IA.
- Evaluacion de impacto si se automatizan decisiones relevantes.

Prioridad: alta.

### 10. Seguridad prometida como absoluta

Riesgo: claims como "seguridad total" o "datos 100% protegidos".

Mitigacion:

- Usar "medidas razonables", "buenas practicas", "cifrado en transito", "roles", "backups".
- Politica de incidentes.
- No revelar arquitectura sensible.
- SLA realista.

Prioridad: alta.

## Riesgos medios

### 11. Planes y limites poco claros

Riesgo: cliente reclama que esperaba funciones no incluidas.

Mitigacion:

- Grilla de planes.
- Anexo por modulo.
- Diferenciar incluido, add-on, beta, piloto, implementacion asistida.

### 12. Exportacion y eliminacion de datos indefinidas

Riesgo: conflicto al finalizar contrato.

Mitigacion:

- Politica de retencion.
- Ventana de exportacion.
- Formatos basicos.
- Retencion tecnica de backups.
- Eliminacion definitiva documentada.

### 13. Integraciones con terceros

Riesgo: caidas, cambios de API, costos externos, tokens vencidos.

Mitigacion:

- Anexo integraciones.
- No garantizar terceros.
- Documentar responsabilidades del cliente sobre credenciales y permisos.

### 14. Uso de marcas, imagenes o contenidos de terceros

Riesgo: clientes cargan logos, fotos, textos o marcas sin derechos.

Mitigacion:

- Politica de uso aceptable.
- Clausula de responsabilidad del cliente.
- Proceso de remocion ante reclamo.

### 15. Partners o implementadores sin contrato

Riesgo: terceros venden Cumbre con promesas no autorizadas.

Mitigacion:

- Contrato de partner.
- Guia de marca.
- Prohibicion de promesas no aprobadas.
- Comisiones y soporte definidos.

## Controles minimos antes de vender online

1. Titular contractual definido.
2. Terminos SaaS versionados.
3. Privacidad + DPA.
4. Anexos por modulo.
5. Clickwrap con evidencia.
6. Politica de baja/exportacion.
7. Registro de PI/marcas iniciado.
8. Anexo ARCA si hay facturacion.
9. Anexo pagos si hay cobros.
10. Anexo IA si hay asistente.

## Controles minimos antes de produccion con clientes

1. Backup y restauracion probados.
2. Roles/permisos revisados.
3. Logs de auditoria.
4. Procedimiento de incidentes.
5. Procedimiento ARCO.
6. Lista de subprocesadores.
7. Checklist de datos migrados.
8. Aceptacion del cliente de alcance y limites.
9. Soporte/SLA del plan.
10. Responsable interno asignado.
