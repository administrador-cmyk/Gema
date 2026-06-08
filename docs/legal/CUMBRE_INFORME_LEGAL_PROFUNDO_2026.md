# Informe legal profundo - Cumbre / GEMA Digital

Fecha: 2026-06-06

Estado: informe interno de direccion legal operativa. No debe publicarse ni usarse como contrato definitivo sin revision de abogado matriculado, contador y especialista regulatorio cuando corresponda.

## 1. Resumen ejecutivo

Cumbre debe operar con una arquitectura legal similar a la de competidores maduros de ERP/SaaS argentinos: licencia de uso limitada, propiedad intelectual reservada, privacidad separada, condiciones por modalidad, anexos por modulo, reglas de baja/exportacion, limites fiscales, limites de pagos, seguridad razonable y prueba clara de aceptacion contractual.

La investigacion de referencias publicas de Axoft/Tango, Tango Nexo, Bejerman/Thomson Reuters, Acont y otros proveedores confirma una practica consistente: el cliente recibe una licencia, no propiedad; el proveedor conserva software, marcas, documentacion y metodologia; el cliente es responsable por los datos que carga, su situacion fiscal, sus usuarios, sus credenciales y el uso de integraciones; los servicios cloud se apoyan en terceros y tienen limites de disponibilidad; y las funciones fiscales/pagos requieren anexos especificos.

Para proteger a GEMA y tambien a los clientes, Cumbre debe documentar desde el inicio:

- Quien contrata y bajo que CUIT/razon social.
- Que se licencia, por cuanto tiempo, bajo que plan y con que limites.
- Que datos se tratan, quien es responsable y quien es encargado.
- Que subprocesadores intervienen.
- Que ocurre ante baja, mora, trial vencido, exportacion y eliminacion.
- Que es demo, piloto, add-on, implementacion asistida o produccion validada.
- Que derechos de propiedad intelectual conserva GEMA.
- Que derechos conserva el cliente sobre sus datos.
- Que garantias no se dan: resultados comerciales, cumplimiento fiscal automatico, disponibilidad absoluta, seguridad absoluta, exactitud perfecta de IA o funcionamiento permanente de terceros.

## 2. Hallazgos comparativos: Tango/Axoft y otros ERP

### Axoft / Tango Software

Fuentes revisadas:

- `https://www.axoft.com/terminosycondiciones/cloud.html`
- `https://www.axoft.com/terminosycondiciones/onpremise.html`
- `https://www.tangonexo.com/eula/`
- `https://www.tangonexo.com/privacypolicy/`
- `https://www.axoft.com/politicadeprivacidad/privacidad.html`

Buenas practicas detectadas:

- Diferencian contrato cloud, contrato on-premise y terminos de portal.
- Declaran licencia no exclusiva, intransferible y temporal o segun modalidad.
- Reservan propiedad intelectual sobre software, marcas y documentacion.
- Mencionan Ley 11.723, tratados internacionales y registros de DNDA para software Tango/Restô/Astor.
- Aclaran que el uso del producto implica aceptacion de terminos.
- Prevén renovacion mensual y suspension por falta de pago.
- Aclaran que el cliente es responsable por su informacion, usuarios, datos y extraccion antes de la terminacion.
- Separan privacidad y terminos del servicio.
- Aclaran que internet, conectividad y terceros pueden afectar seguridad/disponibilidad.

Aprendizaje para Cumbre:

- Cumbre debe tener terminos SaaS propios, no depender solo de terminos generales del sitio.
- Debe separar modalidad SaaS, implementacion asistida, pilotos fiscales y eventualmente on-premise si existiera.
- Debe reservar derechos de PI con lenguaje fuerte y detallado.
- Debe registrar o al menos iniciar estrategia de registro de marcas/software para poder sostener mejor sus clausulas.
- Debe crear prueba de aceptacion: checkbox, version de terminos, fecha/hora, usuario, IP, plan y propuesta aceptada.

### Bejerman / Thomson Reuters

Fuentes revisadas:

- `https://onvio.us/ua/help/ar-es/staff/general-articles/terms-conditions-onvio.htm/1000`
- `https://www.thomsonreuters.com.ar/es/soluciones-fiscales-contables-gestion/soluciones-de-gestion-para-pymes/bejerman-erp.html`
- `https://www.thomsonreuters.com.ar/es/soluciones-fiscales-contables-gestion/soluciones-de-gestion-para-pymes/bejerman-web.html`

Buenas practicas detectadas:

- Identificacion clara del titular del sitio/servicio.
- Licencia intransferible y no exclusiva para necesidades profesionales.
- Reserva amplia de propiedad intelectual e industrial.
- Jurisdiccion y ley argentina definidas.
- Diferenciacion de modalidades: on-premise, virtual, suscripcion.
- Mensaje comercial de cumplimiento normativo, pero con soporte profesional y red de implementadores.

Aprendizaje para Cumbre:

- Si se comunica cumplimiento ARCA, debe aclararse que Cumbre ayuda a operar y actualizar, pero no sustituye validacion contable/fiscal.
- Si hay implementadores o partners futuros, debe existir contrato de partner y reglas de uso de marca.

### Acont y SaaS argentinos

Fuente revisada:

- `https://acont.com.ar/terminos-y-condiciones/`

Buenas practicas detectadas:

- Declara proveedor SaaS y no sociedad, mandato general ni resultado profesional.
- Protege software, arquitectura, bases de datos, diseno, marcas, logos y contenidos.
- Trata datos personales bajo Ley 25.326.
- Aclara hosting en terceros, incluso fuera de Argentina.
- Disclaimers sobre herramienta informativa/de gestion sin asesoramiento profesional.

Aprendizaje para Cumbre:

- Los terminos deben evitar que GEMA sea interpretada como asesor contable, fiscal, legal, financiero, gestor de pagos o representante general del cliente.
- Cuando Cumbre Cobros integre pasarelas, debe decir que GEMA no custodia fondos salvo que expresamente asuma una funcion regulada y cumpla el marco BCRA.

## 3. Marco legal argentino aplicable

### Propiedad intelectual del software

Fuentes principales:

- Ley 11.723 de Propiedad Intelectual.
- Ley 25.036, que incorpora programas de computacion fuente y objeto.
- Direccion Nacional del Derecho de Autor (DNDA), deposito/registro de software.
- Referencia oficial: `https://www.argentina.gob.ar/justicia/derechofacil/leysimple/propiedad-intelectual`
- Tramite software inedito: `https://www.argentina.gob.ar/servicio/deposito-en-custodia-de-obra-inedita-software`

Conclusion:

El software se protege desde su creacion, pero el registro/deposito ante DNDA es estrategicamente recomendable porque aporta fecha cierta y prueba. Para Cumbre, la proteccion no debe limitarse al codigo: tambien debe cubrir arquitectura, interfaces, flujos, documentacion, bases de conocimiento, prompts, plantillas, contenidos, disenos, manuales y configuraciones.

Accion legal:

- Iniciar inventario de activos protegibles.
- Definir titularidad: GEMA, sociedad, fundador o cesion formal.
- Obtener cesiones de derechos de todo colaborador, freelance, agencia o desarrollador externo.
- Registrar versiones clave ante DNDA o deposito de obra inedita si todavia no se publica.
- Mantener repositorio, commits, releases y evidencias como prueba complementaria.

### Marcas y nombres comerciales

Fuentes principales:

- Ley 22.362 de Marcas y Designaciones.
- INPI.
- Clasificacion de Niza.
- WIPO Lex: `https://www.wipo.int/wipolex/es/legislation/details/19069`
- Clase 42: SaaS, desarrollo de software, cloud.
- Clase 9: software descargable/apps.
- Clase 35: servicios comerciales, marketing, marketplace o gestion comercial si aplica.

Conclusion:

La propiedad de una marca y la exclusividad de uso se obtienen con el registro. Cumbre/GEMA deben hacer busqueda de antecedentes y registrar cuanto antes `GEMA Digital`, `Cumbre`, `ERP Cumbre`, `Cumbre CRM`, `Cumbre ERP Negocios` y, si la estrategia lo justifica, modulos principales.

Accion legal:

- Busqueda fonetica y visual previa en INPI.
- Registro minimo recomendado: clase 42.
- Registro complementario: clase 9 si hay app o software descargable; clase 35 si se ofrecen servicios comerciales/marketing/marketplace; evaluar clase 36 solo si se brindan servicios financieros/pagos propios, con cautela regulatoria.
- Crear guia de uso de marca para web, partners y clientes.

### Datos personales y privacidad

Fuentes principales:

- Ley 25.326 de Proteccion de Datos Personales.
- Decreto 1558/2001.
- AAIP: obligaciones de responsables de bases de datos.
- Registro Nacional de Bases de Datos Personales.
- Resolucion AAIP 47/2018 sobre medidas de seguridad recomendadas.
- Disposicion 60/2016 y normas sobre transferencias internacionales.
- Obligaciones AAIP: `https://www.argentina.gob.ar/aaip/datospersonales/responsables/obligaciones`

Conclusion:

Cumbre trata datos propios de leads/clientes y datos de terceros cargados por clientes. En B2B, normalmente el cliente es responsable de datos de sus clientes/proveedores/usuarios, y GEMA/Cumbre actua como encargado/procesador. Esto exige politica de privacidad y DPA.

Accion legal:

- Registrar bases propias si corresponde: leads, clientes, soporte, marketing.
- Crear DPA para clientes B2B.
- Mapear subprocesadores reales: hosting, email, IA, analytics, soporte, pagos, backups.
- Definir transferencias internacionales y mecanismos legales.
- Implementar proceso ARCO: acceso en 10 dias corridos; rectificacion/supresion en 5 dias habiles segun normativa.
- Documentar seguridad: accesos, logs, backups, segregacion, incidentes, entornos de desarrollo.

### Consumidor y contratacion online

Fuentes principales:

- Ley 24.240 de Defensa del Consumidor.
- Codigo Civil y Comercial, contratacion a distancia.
- Disposicion 954/2025: Boton de Arrepentimiento y Boton de Baja.

Conclusion:

Si Cumbre vende online a consumidores, monotributistas o pequenos comercios en condiciones que puedan ser interpretadas como relacion de consumo, debe contemplar informacion clara, precio, duracion, renovacion, baja, arrepentimiento y canales sin trabas.

Accion legal:

- Decidir si la venta sera B2B pura, B2C o mixta.
- Si hay checkout online, implementar Boton de Arrepentimiento y Boton de Baja visibles.
- Generar codigo de gestion dentro de 24 horas para solicitudes.
- Guardar evidencia de contratacion, terminos aceptados y version vigente.
- Definir politica de reembolso y excepciones para software usado, implementaciones personalizadas y servicios ya prestados.

### Firma digital, firma electronica y clickwrap

Fuentes principales:

- Ley 25.506 de Firma Digital.
- Codigo Civil y Comercial.
- Ley simple oficial: `https://www.argentina.gob.ar/justicia/derechofacil/leysimple/firma-digital`

Conclusion:

El clickwrap puede servir como firma electronica/manifestacion de voluntad, pero si se desconoce, GEMA debe probarlo. Por eso se necesita trazabilidad tecnica y documental.

Accion legal:

- Usar checkbox obligatorio: "Lei y acepto Terminos de Servicio, Politica de Privacidad, DPA si corresponde y Anexos del plan".
- Guardar usuario, email, CUIT, plan, fecha/hora, IP, user agent, version hash de terminos, propuesta aceptada y comprobante de pago.
- Evitar browsewrap como unica prueba.
- Para contratos de mayor valor, usar firma digital o firma electronica robusta.

### Pagos, cobros y BCRA

Fuentes principales:

- Registro de proveedores de servicios de pago BCRA.
- Normas sobre PSP, aceptadores, adquirentes, agregadores, iniciadores.
- BCRA: `https://www.bcra.gob.ar/registro-de-proveedores-de-servicios-de-pago/`

Conclusion:

Cumbre Cobros es de bajo riesgo regulatorio si se limita a integrar proveedores externos y registrar/conciliar informacion. El riesgo crece si GEMA cobra por cuenta de terceros, custodia fondos, ofrece cuentas de pago, inicia transferencias o actua como agregador/subadquirente.

Accion legal:

- Definir por escrito: "GEMA/Cumbre no es banco, entidad financiera ni PSP; integra proveedores externos".
- Los fondos deben liquidar desde el proveedor al cliente, no pasar por cuentas de GEMA salvo modelo revisado.
- Si se usa QR/link de pago, dejar claro quien procesa.
- No almacenar datos completos de tarjetas.
- Si en el futuro GEMA asume rol de PSP/agregador, detener operacion y revisar BCRA antes de lanzar.

### PCI DSS y tarjetas

Conclusion:

PCI DSS no es una ley argentina, pero es requisito contractual de la industria de tarjetas. La estrategia recomendada es mantener a Cumbre fuera del alcance sensible: checkout alojado, redireccion o iframe seguro de proveedor certificado; no almacenar PAN completo, CVV ni PIN; usar tokenizacion.

Accion legal:

- Usar Mercado Pago, Stripe, PayPal, Nave u otros proveedores certificados.
- Incluir en terminos que el procesamiento de tarjetas queda bajo terminos del proveedor.
- Implementar HTTPS, CSP y controles contra scripts maliciosos si se embeben iframes.
- Guardar solo tokens/referencias no sensibles.

### ARCA / facturacion electronica

Conclusion:

El contribuyente/cliente sigue siendo responsable por su CUIT, clave fiscal, certificados, punto de venta, datos fiscales, alicuotas, comprobantes y asesoramiento contable. Cumbre puede facilitar emision y gestion, pero no debe prometer cumplimiento fiscal absoluto.

Accion legal:

- Usar lenguaje "Facturador ARCA controlado", "implementacion asistida", "piloto validado", "sujeto a configuracion fiscal".
- Requerir checklist firmado por cliente/contador antes de produccion.
- Mantener bitacora de homologacion y prueba.
- Aclarar que cambios de ARCA pueden requerir actualizaciones o pausas.
- Aclarar que Cumbre no reemplaza contador.

### Marketing, CRM, WhatsApp y No Llame

Fuentes principales:

- Ley 26.951 Registro Nacional No Llame.
- AAIP No Llame: `https://nollame.aaip.gob.ar/faqs.html`

Conclusion:

Cumbre CRM y Marketing deben evitar que GEMA sea responsable por spam del cliente. El cliente debe tener base legal para cargar contactos y hacer comunicaciones. Si GEMA hace campañas propias, debe cumplir consentimiento, baja y Registro No Llame.

Accion legal:

- Politica de comunicaciones comerciales.
- Clausula de indemnidad por bases de datos cargadas por el cliente sin autorizacion.
- Mecanismo de baja en newsletters.
- Si se llama/escribe por WhatsApp con fines comerciales, verificar No Llame cuando corresponda y/o consentimiento.

### IA y asistentes

Fuentes principales:

- Programa Nacional de Transparencia y Proteccion de Datos Personales en el uso de IA, AAIP.
- Resolucion AAIP 161/2023.
- Guia AAIP para IA responsable.

Conclusion:

La IA debe comunicarse como asistencia, no como decision automatica vinculante ni asesor profesional. Deben existir transparencia, minimizacion de datos, revision humana y opcion de no cargar datos sensibles.

Accion legal:

- Anexo IA.
- Aviso dentro del asistente.
- Registro de proveedores de IA y datos enviados.
- Evaluacion de impacto si se hacen decisiones automatizadas relevantes.
- Human-in-the-loop en acciones criticas: facturar, enviar campañas masivas, borrar datos, cambiar precios, ejecutar cobros.

## 4. Arquitectura documental recomendada

Documentos publicos minimos:

- Terminos y condiciones generales del sitio.
- Politica de privacidad.
- Politica de cookies.
- Terminos de servicio Cumbre.
- Condiciones comerciales, planes, trial, baja y reembolsos.
- Boton de Arrepentimiento y Boton de Baja si hay contratacion online alcanzada.
- Aviso de propiedad intelectual y derechos reservados.

Documentos contractuales para aceptacion:

- Propuesta comercial / orden de servicio.
- Terminos SaaS Cumbre.
- DPA para B2B.
- SLA / soporte y mantenimiento.
- Anexo de modulo contratado.
- Anexo ARCA si aplica.
- Anexo pagos si aplica.
- Anexo IA si aplica.
- Acuerdo de implementacion/migracion si aplica.

Documentos internos:

- Inventario de PI.
- Registro de marcas/software.
- Politica de secretos comerciales.
- Registro de subprocesadores.
- Registro de incidentes.
- Procedimiento ARCO.
- Procedimiento de baja/exportacion/eliminacion.
- Matriz BCRA/PSP.
- Checklist de produccion ARCA.
- Checklist de seguridad.

## 5. Principios de redaccion para proteger a GEMA y clientes

Usar:

- "licencia de uso limitada, no exclusiva, no transferible y revocable".
- "herramienta de gestion, no asesoramiento profesional".
- "sujeto a configuracion, validacion y disponibilidad de terceros".
- "el cliente conserva sus datos".
- "GEMA conserva software, marca, codigo, diseno, metodologia y documentacion".
- "medidas razonables de seguridad".
- "exportacion razonable de datos disponibles".
- "acciones criticas requieren validacion humana".

Evitar:

- "cumplimiento garantizado con ARCA".
- "sin errores".
- "seguridad total".
- "disponibilidad 24/7 garantizada" si no hay SLA real.
- "cobros propios" si no hay rol regulatorio revisado.
- "la IA decide por vos".
- "ERP completo" para planes economicos minoristas.

## 6. Riesgos rojos inmediatos

1. No tener titular contractual definido.
2. No registrar marcas antes de escalar comercialmente.
3. No documentar cesion de derechos de colaboradores/desarrolladores.
4. Vender Facturador ARCA como productivo sin piloto y validacion.
5. Capturar pagos de terceros sin analizar BCRA.
6. Usar datos de leads/clientes para marketing sin consentimiento/baja.
7. No tener DPA para clientes B2B.
8. No guardar prueba de aceptacion de terminos.
9. Prometer seguridad o disponibilidad absoluta.
10. No definir exportacion/baja/eliminacion de datos.

## 7. Conclusion legal

Cumbre puede blindarse de forma profesional si adopta desde ahora una estructura legal modular. El objetivo no es llenar la web de textos defensivos, sino tener contratos claros que protejan al cliente, eviten promesas excesivas y conviertan la propiedad intelectual de GEMA en un activo defendible.

La prioridad legal de los proximos pasos debe ser:

1. Identidad legal y titularidad.
2. Registro de marcas y software.
3. Terminos SaaS + DPA + anexos.
4. Procesos probatorios de aceptacion, baja, exportacion e incidentes.
5. Revision especifica de ARCA, pagos e IA antes de venderlos como funciones productivas.
