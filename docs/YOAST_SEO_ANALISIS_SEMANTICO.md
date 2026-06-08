# Analisis Yoast SEO y Semantica - GEMA Digital

Fecha: 2026-06-06

## Criterio general

La optimizacion se organiza por intencion de busqueda y clusters semanticos, no por repeticion mecanica de keywords. Cada pagina recibe una frase objetivo principal para Yoast, sinonimos/variantes semanticas, title SEO, metadescripcion, imagen social y contexto para Open Graph/Twitter.

## Cluster marca y solucion general

Frase objetivo principal:

- `software ERP IA automatización empresas`

Semantica asociada:

- software de gestion empresarial
- ERP para pymes
- inteligencia artificial para empresas
- automatizacion empresarial
- agencia de software e IA

Paginas:

- `/`
- `/empresas/`
- `/nosotros/`
- `/contacto/`
- `/tecnologia/`
- `/integraciones/`
- `/blog/`

Intencion:

- Captar busquedas de marca, diagnostico inicial, proveedor tecnologico, agencia de software e IA y empresas que todavia no eligieron producto.

## Cluster ERP Cumbre

Frase objetivo principal:

- `ERP para PyMEs argentinas`

Semantica asociada:

- software de gestion empresarial
- ERP modular
- CRM para PyMEs argentinas
- control de stock
- facturacion ARCA en piloto controlado
- presupuestos
- cobros
- catalogo

Paginas:

- `/erp-cumbre/`
- `/gema-negocios/`
- `/gestion/`
- `/erp/precios/`
- `/erp/funciones/facturacion-electronica/`
- landings internas bajo `/cumbre/{modulo}/`

Intencion:

- Busquedas comerciales de empresas que comparan soluciones de gestion y necesitan demo, trial o implementacion asistida.

## Cluster Cumbre CRM

Frase objetivo principal:

- `CRM para PyMEs argentinas`

Semantica asociada:

- CRM con presupuestos
- CRM con catalogo y stock
- CRM con facturacion electronica ARCA
- CRM para ventas B2B
- CRM con asistente de IA
- software de gestion comercial para PyMEs

Paginas:

- `/cumbre-crm/`
- `/cumbre/crm/`
- `/competencia/cumbre-crm-vs-hubspot-salesforce/`

Intencion:

- Captar compradores que ya buscan CRM, pero necesitan que el CRM este conectado a operacion real: presupuesto, stock, cobros, facturacion y seguimiento comercial.

Cuidado editorial:

- ARCA se comunica como demo comercial, piloto controlado o implementacion asistida. No se promete facturacion productiva abierta sin validacion.

## Cluster Cumbre ERP Negocios

Frase objetivo principal:

- `sistema POS para comercios`

Semantica asociada:

- sistema para kioscos
- sistema para kiosco Argentina
- sistema para almacenes
- software para mercados
- software POS Argentina
- sistema para restaurantes chicos
- sistema de caja para negocios
- control de stock para kioscos
- ERP economico para comercios
- programa para almacen
- sistema para verduleria
- sistema para carniceria
- sistema para deposito chico

Paginas:

- `/cumbre-erp-negocios/`
- `/cumbre/negocios/`
- `/competencia/cumbre-erp-negocios-vs-tango-factura/`

Intencion:

- Captar comercios minoristas argentinos que necesitan una solucion simple, economica y escalable para mostrador: vender, controlar caja, stock, precios y reposicion diaria.

Cuidado editorial:

- No se comunica como ERP empresarial completo.
- ARCA se presenta como Facturador ARCA controlado, piloto controlado o implementacion asistida.
- Integraciones, stock avanzado, Multi-CUIT, multiempresa y funcionalidades complejas se tratan como add-ons, planes superiores o implementacion asistida.

## Cluster IA Productiva y automatizacion

Frase objetivo principal:

- `inteligencia artificial para empresas`

Semantica asociada:

- agentes IA
- automatizacion con IA
- RAG empresarial
- asistente IA para empresas
- observabilidad IA
- automatizacion de procesos

Paginas:

- `/ia-productiva/`
- `/automatizacion/`
- `/ia/automatizacion-whatsapp/`

Intencion:

- Captar empresas que quieren automatizar procesos, responder consultas, ordenar datos o incorporar asistentes con control humano.

## Cluster Marketing digital

Frase objetivo principal:

- `marketing digital para empresas`

Semantica asociada:

- SEO para empresas
- GEO
- Google Ads
- Meta Ads
- redes sociales para PyMEs
- contenido comercial
- automatizacion de leads

Paginas:

- `/marketing/`

Intencion:

- Captar empresas que quieren crecer con contenido, campanias, SEO/GEO, redes, Google Business Profile y medicion.

## Cluster pagos y cobros

Frase objetivo principal:

- `plataforma de pagos para empresas`

Semantica asociada:

- Mercado Pago para empresas
- Nave
- Stripe
- PayPal
- Cumbre Cobros
- conciliacion de pagos
- medios de pago Argentina

Paginas:

- `/pagos/`
- `/pagos/argentina/`
- `/pagos/mercado-pago/`
- `/pagos/nave/`
- `/pagos/paypal/`
- `/pagos/stripe/`
- `/erp-cumbre/cumbre-cobros/`

Intencion:

- Captar busquedas sobre cobros nacionales/globales, conciliacion y medios de pago conectados a operacion comercial.

## Cluster comparativas

Frase objetivo principal:

- `comparativas ERP`

Semantica asociada:

- ERP Cumbre vs Tango
- ERP Cumbre vs Odoo
- alternativa SAP Business One
- software de gestion para PyMEs argentinas
- CRM argentino conectado a operacion

Paginas:

- `/competencia/`
- paginas bajo `/competencia/{comparativa}/`

Intencion:

- Captar busquedas bottom funnel de usuarios que comparan alternativas antes de decidir migracion, convivencia por etapas o implementacion modular.

## Reglas Yoast aplicadas

- Cada pagina prioritaria recibe `_yoast_wpseo_focuskw`.
- Se agregan sinonimos semanticos en `_yoast_wpseo_keywordsynonyms`.
- Se cargan SEO title y metadescripcion por pagina.
- Se cargan Open Graph title, description e image.
- Se cargan Twitter title, description e image.
- Las imagenes sociales se organizan por cluster en `assets/seo-visuals/`.

## Imagenes sociales y avisos

- `gema-digital-og.png`: marca, home, institucionales.
- `erp-cumbre-og.png`: ERP Cumbre, gestion, modulos.
- `cumbre-crm-og.png`: Cumbre CRM y comparativa CRM.
- `cumbre-erp-negocios-og.png`: Cumbre ERP Negocios, POS, caja, stock y comercios minoristas.
- `ia-productiva-og.png`: IA Productiva y automatizacion.
- `marketing-digital-og.png`: marketing, SEO, GEO, redes y campanias.
- `pagos-cobros-og.png`: pagos, cobros, conciliacion y proveedores.
- `comparativas-erp-og.png`: comparativas ERP y decision de software.

## Siguiente mejora recomendada

Medir rendimiento por cluster en Search Console y ajustar frase objetivo segun impresiones, CTR y consultas reales. La prioridad inicial deberia ser Cumbre CRM, ERP Cumbre, GEMA Negocios, Marketing y pagos/cobros.
