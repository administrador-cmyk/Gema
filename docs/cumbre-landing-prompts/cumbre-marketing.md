# Prompt Web: Cumbre Marketing

## Nombre del módulo

Cumbre Marketing

## Objetivo de la landing

Diseñar una landing premium para presentar `Cumbre Marketing` como uno de los pilares de marca de ERP Cumbre: una suite de marketing con IA para redes sociales, campañas multicanal y crecimiento orgánico SEO/SEM/GEO conectada al CRM, ventas, eCommerce, WhatsApp y BI.

## Público ideal

PyMEs argentinas, comercios, eCommerce, empresas B2B, creadores de marca, equipos comerciales, agencias implementadoras y dueños que quieren crear contenido, programar publicaciones, ejecutar campañas y medir resultados con datos reales del negocio.

## Mensaje principal

Creá, programá, publicá y medí tu marketing con IA y datos reales de tu ERP.

## Subtítulo

Cumbre Marketing une redes sociales, campañas y marketing orgánico en una suite conectada a tu CRM, ventas, eCommerce, WhatsApp y Reportes BI. De una idea inicial a un calendario completo con textos, imágenes, videos, previews, aprobaciones, publicación asistida y métricas.

## Posicionamiento

Debe sentirse como un buque insignia de Cumbre. La referencia funcional es tener capacidades comparables a herramientas como Metricool para redes, pero con una ventaja clara: Cumbre no publica en el vacío, trabaja con clientes, ventas, cobros, productos, campañas, WhatsApp y reportes del ERP.

## Submódulos comerciales

### Cumbre Marketing Redes

Sistema completo para redes sociales:

- El usuario carga una idea, tema, producto, promoción o fecha comercial.
- El agente IA le da forma estratégica.
- El usuario edita hasta aprobar concepto, tono y objetivo.
- El sistema pregunta en qué redes se quiere publicar.
- Se recomiendan redes, formatos, días y horarios ideales.
- Se genera una agenda/calendario tipo Metricool.
- Se crean textos, prompts de imagen, guiones de video y variantes por red.
- Se muestra vista previa por Instagram, Facebook, LinkedIn, TikTok, YouTube, X, Pinterest, Google Business Profile u otras redes soportadas.
- El usuario aprueba, programa, exporta o deja listo para carga asistida.
- El panel muestra estadísticas de cada publicación.

### Cumbre Marketing Campañas

Campañas multicanal conectadas al ciclo comercial:

- Segmentos desde CRM y `empresas_clientes`.
- Audiencias desde ventas, eCommerce, Mercado Libre y comportamiento.
- WhatsApp, email, anuncios y redes.
- UTM, eventos y atribución.
- Automatizaciones comerciales pausables.
- Métricas de conversión, ventas, cobros, CAC y ROAS.

### Cumbre Marketing Orgánico

SEO, SEM asistido y GEO/AI Search con prestaciones esperadas de una suite tipo Semrush y Surfer SEO, pero conectada al ERP:

- Keywords y clusters.
- Volumen, dificultad, tendencia e intención de búsqueda.
- Radar competitivo, brechas de keywords, páginas top y share of voice.
- Auditoría técnica SEO: indexabilidad, canonicals, sitemap, schema, performance, enlaces internos y canibalización.
- Content editor con score, entidades, términos recomendados, headings, longitud objetivo y alertas de sobreoptimización.
- Integraciones gratuitas/oficiales: Google Search Console, GA4, Google Tag Manager, PageSpeed Insights, Google Business Profile, Google Ads Keyword Planner y Looker Studio.
- Briefs SEO y GEO.
- Contenido evergreen.
- Páginas pilar.
- FAQs y schema sugerido.
- Auditoría de títulos, metas, enlaces internos y canibalización.
- Medición de contenido que genera leads, ventas o consultas.

Este submódulo tiene prompt web separado en `docs/cumbre-landing-prompts/cumbre-marketing-organico.md`.

## IA creativa

El agente debe trabajar como productor total de contenido:

- Copywriter por red.
- Diseñador de prompts para imágenes.
- Guionista para reels, shorts, historias, videos largos y anuncios.
- Planificador de formato: post, carrusel, story, reel, short, video largo, hilo, newsletter o anuncio.
- Generador de storyboard o resumen visual antes del video.
- Adaptador de tono por marca, rubro, buyer persona y objetivo.
- Editor asistido hasta aprobación humana.

Debe poder proponer si conviene un short, reel, carrusel, imagen simple, video largo o pieza de campaña, según objetivo, red y audiencia.

## Publicación por APIs

La landing debe explicar una estrategia profesional y segura:

- Fase 1: calendario, previews, aprobación, exportación, recordatorios y carga asistida.
- Fase 2: APIs oficiales por red, tutorial guiado, `credencial_ref`, permisos mínimos y validación backend.
- Fase 3: publicación automática, lectura de métricas, recomendaciones y optimización.

No prometer publicación automática universal desde el día uno. Cada red social tiene permisos, revisiones, límites y políticas propias.

## Módulos Cumbre conectados

- `Cumbre CRM`: contactos, oportunidades, scoring y pipeline.
- `Cumbre Ventas`: ventas atribuidas, margen, ticket y recompra.
- `Cumbre eCommerce`: carritos, productos vistos, pedidos y comportamiento.
- `Cumbre Mercado Libre`: ventas marketplace y clientes para posventa.
- `Cumbre WhatsApp Hub`: mensajes con opt-in, plantillas y seguimiento.
- `Cumbre Cobros`: pagos, recupero y conversión cobrada.
- `Cumbre Reportes BI`: CAC, ROAS, cohortes, conversión y dashboards.
- `Cumbre Legal`: disclaimers, consentimiento, políticas y textos sensibles.
- `Cumbre Automatizaciones`: flujos por campaña, publicación, lead o conversión.
- `Tutoriales API Cumbre`: conexión guiada con redes, Meta, Google, email providers y webhooks.

## Guardrails técnicos, legales y de seguridad

- No crear base paralela de contactos; usar `empresas_clientes`.
- No enviar campañas sin consentimiento u opt-in cuando corresponda.
- No activar campañas sin referencia auditable del consentimiento o segmento autorizado.
- No publicar contenido sin aprobación humana en fase inicial.
- No marcar publicaciones manuales como publicadas sin evidencia interna verificable.
- No prometer publicación automática universal si una red limita permisos.
- No guardar tokens Meta, Google, TikTok, LinkedIn, X, email o video en claro; usar `credencial_ref`.
- No sincronizar audiencias sensibles sin base legal, minimización y política visible.
- No generar contenido engañoso, ilegal, sensible o contrario a políticas de plataforma.
- No usar música, imágenes, marcas o material con copyright sin licencia.
- No confundir métricas estimadas con métricas reales de API.
- Todo webhook externo debe validar firma o secreto.
- Toda automatización crítica debe poder pausarse.
- Toda pieza debe conservar estado, red, formato, prompt, assets, usuario aprobador y fecha.

## Estructura sugerida de landing

1. Hero premium: idea → IA → calendario → publicación → métricas.
2. Problema: redes, campañas y SEO desconectados de ventas reales.
3. Presentación de los tres submódulos: Redes, Campañas y Marketing Orgánico.
4. Demo conceptual de Marketing Redes estilo Metricool: calendario, horarios ideales, previews y estadísticas.
5. IA creativa: textos, imágenes, videos, storyboards y formatos.
6. Publicación por APIs: enfoque faseado y seguro.
7. Integración ERP: CRM, Ventas, WhatsApp, eCommerce, BI y Cobros.
8. Guardrails de consentimiento, copyright, APIs y aprobación humana.
9. Planes y add-ons.
10. CTA final.

## Casos de uso

- Crear un mes completo de contenido desde una idea.
- Programar publicaciones por red con horarios recomendados.
- Adaptar una campaña para Instagram, TikTok, LinkedIn y YouTube.
- Crear prompts de imagen y guiones de video.
- Previsualizar publicaciones antes de aprobar.
- Medir qué contenido generó leads, ventas o cobros.
- Planificar SEO/GEO para atraer tráfico orgánico.
- Reactivar clientes con campaña conectada al CRM.

## SEO

Title sugerido:
Cumbre Marketing | Redes, campañas y marketing orgánico con IA para PyMEs

Meta description:
Creá contenido con IA, programá redes, gestioná campañas y medí resultados con Cumbre Marketing, conectado a CRM, ventas, WhatsApp, eCommerce y BI.

Keywords:
software de marketing para PyMEs, programar publicaciones en redes, calendario de redes sociales, marketing con IA, creador de contenido IA, marketing orgánico SEO GEO, CRM con marketing, campañas por WhatsApp, audiencias para Meta Ads, marketing para eCommerce

H1:
Marketing con IA conectado a tus ventas reales

H2 sugeridos:
- De una idea a un calendario completo de redes.
- Textos, imágenes y videos listos para revisar.
- Campañas conectadas a CRM, WhatsApp y ventas.
- Marketing Orgánico para SEO, SEM y GEO.
- Métricas reales, no solo likes aislados.

## CTAs

- Solicitar demo
- Ver submódulos
- Hablar con Gema Digital

## Planes

- Marketing Base: segmentos desde CRM, calendario manual, ideas y copies asistidos, UTM y atribución básica, hasta 5 campañas activas.
- Marketing Redes: calendario social avanzado, previews por red, horarios recomendados, copys, prompts de imagen, guiones de video, métricas por publicación y exportación/carga asistida.
- Marketing Standard: incluye Redes, audiencias CRM/Ventas/eCommerce, WhatsApp Hub, email, automatizaciones, Marketing Orgánico básico y reportes de conversión.
- Marketing Full: Redes, Campañas y Marketing Orgánico avanzado, integraciones asistidas Meta/Google/TikTok/LinkedIn, A/B testing, cohortes, CAC, ROAS, BI y APIs oficiales por red cuando estén aprobadas.

Add-ons:

- Bloque de campañas.
- Bloque de piezas sociales.
- Conector publicitario asistido.
- Conector de publicación por red.
- Generación audiovisual asistida.
- Marketing Orgánico avanzado.
- Soporte growth prioritario.

## Estilo visual

Premium, creativo, tecnológico y comercial. Mostrar un dashboard con calendario social, tarjetas de publicaciones por red, previews de Instagram/TikTok/LinkedIn/YouTube, panel de prompts para imagen/video, métricas por publicación y conexión con CRM/Ventas/BI. Debe sentirse como una suite insignia, no como una sección secundaria.

## Auditoría previa al cierre

- Producto: Cumbre Marketing queda como suite insignia con Redes, Campañas y Marketing Orgánico.
- SEO: cubre marketing con IA, redes, calendario, SEO/GEO, CRM y PyMEs.
- Legal: consentimiento, copyright, licencias, opt-out y políticas de plataformas.
- Seguridad: credenciales externas por `credencial_ref`, aprobación humana, webhooks firmados y mínimo privilegio.
- Integraciones: CRM, Ventas, WhatsApp Hub, eCommerce, Mercado Libre, Cobros, BI, Legal, Automatizaciones y Tutoriales API.

## Próximos pasos

Implementar landing en WordPress cuando se decida publicar. No desplegar desde este prompt.
