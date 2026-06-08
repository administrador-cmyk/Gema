# Sistema visual Cumbre

Fecha: 2026-06-07

## Objetivo

Crear una identidad propia para el panel Cumbre que sea sobria, confiable y comercialmente clara para PyMEs argentinas. Cumbre debe acompañar la estética del sitio GEMA Digital, pero traducida a una interfaz SaaS operativa: más datos, estados, permisos, acciones y control. El sistema debe servir para CRM, Negocios, ERP PyMEs, Cumbre Empresas, Cobros, Tesorería, Contabilidad, Impuestos, Reportes BI, Planificación, Activos Fijos, Personal, Ventas, Marketing, Automatizaciones, Web, WhatsApp Hub, Stock, Compras, Facturador ARCA, Legal, Tutoriales API, Estabilidad, verticales sectoriales y futuros modulos.

## Principios

- Cumbre debe sentirse como herramienta de control, no como plantilla generica.
- El sitio GEMA vende, explica y posiciona; la plataforma Cumbre opera, prioriza y guía.
- Cada modulo tiene acento propio, pero todos comparten shell, estructura, radios, bordes, estados, tablas y lenguaje.
- La IA aparece como copiloto operativo: explica, recomienda y anticipa, sin prometer automatizaciones absolutas.
- El trial y los pagos deben ser visibles, simples y honestos: 14 dias, datos conservados y conversion clara.
- ARCA, pagos, stock, legal e integraciones sensibles se comunican siempre con implementacion asistida, validacion backend, aprobacion humana o revision profesional segun corresponda.

## Base visual

- Fondo principal: slate oscuro con acentos suaves emerald/cyan heredados de GEMA Digital.
- Superficies: cards sobrias `bg-slate-950/60` o `bg-slate-900/70`, bordes translucidos y profundidad medida. Evitar exceso de brillo o efectos decorativos en pantallas de trabajo.
- Tipografia sugerida: Plus Jakarta Sans para UI y Roboto Mono para datos, importadas desde los tokens de marca.
- Radios: grandes (`rounded-2xl`, `rounded-3xl`) para transmitir producto moderno pero serio.
- Estados: badges con borde, fondo translúcido y copy corto.
- Orden de pantalla recomendado: contexto -> estado -> accion -> detalle -> auditoria.

## Tonos por modulo

- `emerald`: CRM, Cobros, acciones positivas y crecimiento.
- `emerald`: tambien aplica a Ventas cuando el foco sea cierre comercial, POS, cobros, stock y facturacion vinculada.
- `emerald`: tambien aplica a Planificación cuando el foco sea crecimiento proyectado, cashflow futuro, escenarios y decisiones financieras.
- `emerald`: tambien aplica a WhatsApp Hub cuando el foco sea conversación activa, opt-in, seguimiento y comunicación por Meta Cloud API.
- `cyan`: ERP PyMEs, Reportes BI, Estabilidad, Tutoriales API, mediciones, integraciones y sistemas.
- `cyan`: tambien aplica a Marketing, Automatizaciones y Web cuando el foco sea captacion, campañas, workflows, eventos y medicion.
- `amber`: ERP Negocios, Stock, Compras, Facturador ARCA, Impuestos, caja, reposicion, alertas, vencimientos y operaciones del dia.
- `amber`: tambien aplica a verticales sectoriales como Kioscos, Resto, Depositos WMS, Constructoras, Agro y Mercados cuando el foco sea operacion por rubro.
- `violet`: Cumbre Empresas, gobernanza, auditoria, aprobaciones y reportes ejecutivos.
- `violet`: tambien aplica a Cumbre Contabilidad cuando el foco sea registro formal, cierres, libros, revisión profesional y trazabilidad.
- `violet`: tambien aplica a Activos Fijos cuando el foco sea patrimonio, valor libro, amortización, responsables y bajas contables.
- `violet`: tambien aplica a Personal cuando el foco sea legajos, documentos laborales, aprobaciones y costos de personal.
- `violet`: tambien aplica a Cumbre Legal cuando el foco sea revision, fuentes y control documental.
- `rose`: incidentes, seguridad critica y bloqueos.
- `slate`: informacion neutra, areas inactivas y superficies base.

## Relacion web GEMA vs plataforma Cumbre

- Web GEMA Digital: narrativa comercial, SEO, confianza, comparativas, CTAs y explicacion.
- Plataforma Cumbre: foco operativo, menos ruido visual, estados claros, tareas, aprobaciones, limites, consumo, alertas y trazabilidad.
- Transicion esperada: el usuario debe sentir continuidad de marca al pasar de `gema-digital.com` al panel, pero tambien notar que entro a una herramienta de trabajo.
- No copiar un template externo literalmente. Referencias como "cosmic night" sirven como nivel de calidad profesional, no como identidad final.

## Regla por modulo

La base visual comun no cambia por modulo:

- Shell: sidebar, topbar, contexto de empresa, plan, alertas y estado.
- Superficies: panels, cards, tablas, listas, formularios, modales y empty states.
- Estados: `trial`, `activo`, `pendiente`, `requiere configuracion`, `error`, `bloqueado`, `asistido`.
- Acciones: CTA primaria, accion secundaria, accion peligrosa y solicitud de ayuda.

Lo que si cambia por modulo:

- Acento cromatico.
- Iconografia y microvisualizacion.
- Datos principales.
- Terminologia operativa.
- Tipo de alerta.
- Forma de auditoria o aprobacion.

## Movimiento y graficas

El movimiento de Cumbre debe sentirse profesional y funcional, no decorativo.

- Usar animaciones suaves para entrada de sectores, hover de cards, cambios de estado y carga de datos.
- Evitar movimiento excesivo, rebotes fuertes o efectos que distraigan del trabajo.
- Respetar `prefers-reduced-motion` para usuarios que prefieren menos animacion.
- Todo boton principal debe tener microinteraccion hover: subir levemente, escalar apenas y volver con estado active.
- La navegacion lateral debe tener desplazamiento horizontal sutil al hover, no saltos grandes.
- Las cards de modulo deben elevarse levemente al hover para indicar que son accionables.
- Las etiquetas/badges pueden moverse apenas, pero sin competir con el CTA principal.
- Los efectos de brillo o barrido deben ser sutiles y usarse solo en botones o items interactivos, no en bloques de texto.
- Las graficas deben responder preguntas operativas: que paso, que riesgo hay, que modulo esta involucrado y cual es la proxima accion.
- Graficas recomendadas: barras de demanda por canal, uso/limite por plan, flujo de estado, distribucion por modulo, alertas por severidad, tendencia simple y comparador de proveedores.
- Para Compras, las graficas clave son: stock minimo, ventas aceleradas, demanda Mercado Libre/eCommerce, comparador de proveedor, solicitudes pendientes, ordenes aprobadas, recepciones observadas e impacto en Stock.
- Para Stock, las graficas clave son: saldos por deposito, bajo minimo, reservas, lotes por vencer, ingestas pendientes y movimientos recientes.
- Para Cobros, las graficas clave son: eventos, medios activos, conciliacion, pagos pendientes, webhook con error y comisiones externas.
- Para Contabilidad, las graficas clave son: asientos por estado, pendientes de cierre, balance de asientos, IVA compras/ventas, libros generados, centros de costo y exportaciones para contador.
- Para Impuestos, las graficas clave son: posicion IVA por periodo, IIBB por jurisdiccion, retenciones, percepciones, saldos a pagar/a favor, vencimientos, alertas fiscales y pagos vinculados a Tesoreria.
- Para Reportes BI, las graficas clave son: KPIs ejecutivos, ventas y margen, caja/cashflow, stock critico, vencimientos, rendimiento por canal, series historicas, alertas por severidad y exportaciones trazables.
- Para Planificación, las graficas clave son: escenarios base/optimista/pesimista/estres, cashflow proyectado, real vs plan, desvíos por rubro, presupuesto anual, forecast IA, inversiones y necesidades de caja.
- Para Activos Fijos, las graficas clave son: activos por categoria, valor libro, amortizacion mensual, bienes por responsable, mantenimientos proximos, bajas pendientes y auditoria patrimonial.
- Para Personal, las graficas clave son: personas activas, ausencias, novedades pendientes, vencimientos documentales, costo laboral y aprobaciones.
- Para Ventas, las graficas clave son: ventas por canal, ticket promedio, margen, descuentos, cobros pendientes, facturacion y conversion.
- Para Marketing, las graficas clave son: campañas activas, segmentos, conversion, ventas atribuidas, clientes reactivados, ROAS y cohortes.
- Para Automatizaciones, las graficas clave son: flujos activos, ejecuciones, errores, reintentos, pausas, idempotencia y alertas.
- Para Web, las graficas clave son: paginas, formularios, leads, conversion, UTM, eventos y performance SEO.
- Para verticales sectoriales, las graficas clave dependen del rubro: precios/stock/caja en Kioscos, comandas y stock gastronomico en Resto, ubicaciones/picking en WMS, certificados y costos en Constructoras, cartas de porte/acopio en Agro, gondolas/merma/vencimientos en Mercados.
- Para WhatsApp Hub, las graficas clave son: conversaciones por estado, opt-in, plantillas aprobadas, eventos webhook, alertas por modulo, derivaciones humanas, automatizaciones pausadas y errores de Meta.
- Para Estabilidad, las graficas clave son: salud de servicios, latencia, saturacion de API, riesgo de seguridad y remediaciones controladas.

### Clases base en React

Archivo: `cumbre/src/components/design/CumbreDesignSystem.tsx`

- `cumbreInteractiveMotionClass`: usar en botones principales, cards accionables y CTAs importantes.
- `cumbreSubtleMotionClass`: usar en badges, chips, mini cards y elementos secundarios.
- `cumbreNavMotionClass`: usar en items de navegacion lateral o listas accionables.

Estas clases deben aplicarse como estándar antes de crear nuevas variantes de movimiento. Si un modulo necesita una animacion propia, debe conservar la misma intensidad visual y respetar `motion-reduce`.

## Componentes base implementados

Archivo: `cumbre/src/components/design/CumbreDesignSystem.tsx`

- `CumbreBadge`: etiqueta de estado por tono.
- `CumbrePanel`: contenedor principal de secciones y cards.
- `CumbrePageHeader`: encabezado de pantalla con eyebrow, titulo, descripcion y acciones.
- `CumbreActionButton`: boton consistente para acciones primarias/secundarias.
- `CumbreMetricCard`: KPI o resumen ejecutivo.
- `CumbreModuleCard`: card de modulo con estado, descripcion y CTA.
- `cumbreModuleVisuals`: catalogo visual inicial de modulos, ampliado con Stock, Compras, Tesorería, Contabilidad, Impuestos, Reportes BI, Planificación, Activos Fijos, Personal, Ventas, Marketing, Automatizaciones, Web, WhatsApp Hub, Facturador ARCA, Legal, Tutoriales API y verticales sectoriales.
- `cumbreVisualPrinciples`: principios de continuidad con GEMA, uso de IA y modularidad visual.
- `cumbreSurfaceClass`: superficie base comun para panels y cards del producto.

## Pantallas actualizadas

- `AppSidebar`: ahora usa estructura de Centro de Control, modulos activos y bloque comercial de trial.
- `StabilityDashboard`: ahora comparte header, metric cards, panels y badges con el resto del sistema.
- `CumbreCommandCenter`: pantalla inicial propuesta para mostrar base profesional, mapa modular, principios visuales, KPIs de shell y narrativa de continuidad GEMA -> Cumbre.
- Canvas de preview: `cumbre-platform-preview.canvas.tsx` muestra la dirección estética de plataforma antes de diseñar cada módulo funcional.

## Extension futura

- Conectar `CumbreCommandCenter` al router real cuando se defina el entrypoint de la app.
- Reemplazar valores demo por datos de Firestore: plan, trial, modulos activos, alertas y estado de pago.
- Crear variantes para estados de pago: `trial`, `active`, `past_due`, `suspended`, `requires_setup`.
- Crear componentes especificos para tablas financieras, pipelines CRM, listas de comprobantes y aprobaciones.
- Preparar modo claro cuando haya decision comercial; por ahora el panel prioriza modo oscuro profesional.
