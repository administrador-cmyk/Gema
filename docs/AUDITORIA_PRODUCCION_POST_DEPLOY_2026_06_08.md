# Auditoria de produccion post deploy - 2026-06-08

## Alcance

Se publico en produccion el theme `gema-sovereign` desde `wordpress/theme-gema-sovereign/` hacia `https://gema-digital.com`.

Backup remoto previo:

- `/root/gema-production-backups/gema-sovereign-20260608-081051.tgz`

Acciones ejecutadas:

- Backup comprimido del theme productivo previo.
- Sincronizacion por `rsync` del theme completo.
- Correccion de propietario remoto a `gemad2467:gemad2467`.
- Limpieza de cache WordPress con WP-CLI.
- Refresco de reglas rewrite.

Nota: LiteSpeed no expone en este servidor el comando WP-CLI `litespeed-purge`; la purga especifica del plugin no se ejecuto por esa via.

## Verificacion de publicacion

El sitio publicado refleja las mejoras SEO/GEO implementadas:

- `/erp-cumbre/`: matriz de decision ERP y nuevo posicionamiento para PyMEs argentinas.
- `/cumbre-crm/`: comparativa CRM tradicional, CRM WhatsApp y CRM conectado al ERP.
- `/cumbre-erp-negocios/`: flujo POS/comercio y checklist por rubro.
- `/erp-cumbre/cumbre-facturador-arca/`: comparativa portal ARCA, facturador simple y ERP integrado.
- `/erp-cumbre/cumbre-cobros/`: flujo de cobro, evidencia, conciliacion y registro operativo.
- `/erp-cumbre/cumbre-whatsapp-hub/`: costos separados de Meta, plataforma, BSP e implementacion.

## Sitemap y SEO tecnico

Sitemap verificado:

- `https://gema-digital.com/sitemap_index.xml`: 200.
- `https://gema-digital.com/page-sitemap.xml`: 200.

Crawler de produccion:

- URLs auditadas desde sitemap: 153.
- URLs con HTTP distinto de 200: 0.
- Paginas con `noindex`: 0.
- Canonicals faltantes: 0.
- JSON-LD invalido: 0.
- Imagenes sin `alt`: 0.
- Open Graph / Twitter Cards: presentes en las paginas relevantes auditadas.

## Paginas prioritarias Cumbre

| URL | Estado | Title | Description | H1 | Schema | Observacion |
| --- | --- | ---: | ---: | ---: | --- | --- |
| `/erp-cumbre/` | 200 | 63 | 131 | 1 | BreadcrumbList, FAQPage, SoftwareApplication, Service | Sin issues |
| `/cumbre-crm/` | 200 | 71 | 131 | 1 | BreadcrumbList, FAQPage, Product, SoftwareApplication | Title 1 caracter sobre umbral conservador |
| `/cumbre-erp-negocios/` | 200 | 69 | 133 | 1 | BreadcrumbList, FAQPage, Product, SoftwareApplication | Sin issues |
| `/erp-cumbre/cumbre-facturador-arca/` | 200 | 67 | 134 | 1 | BreadcrumbList, FAQPage, Product, SoftwareApplication | Sin issues |
| `/erp-cumbre/cumbre-cobros/` | 200 | 58 | 136 | 1 | BreadcrumbList, FAQPage, Product, SoftwareApplication | Sin issues |
| `/erp-cumbre/cumbre-whatsapp-hub/` | 200 | 70 | 129 | 1 | BreadcrumbList, FAQPage, Product, SoftwareApplication | Sin issues |

## Hallazgos restantes

Se detectaron 38 URLs con ajustes menores:

- 22 meta descriptions fuera del rango conservador usado para auditoria.
- 16 titles fuera del rango conservador usado para auditoria.
- 3 paginas sin H1: `/erp/`, `/erp/funciones/`, `/legal/`.
- 2 URLs sin meta description: `/category/uncategorized/` y `/hello-world/`.

Prioridad recomendada:

1. Desindexar o eliminar de sitemap `/category/uncategorized/` y `/hello-world/`.
2. Agregar H1 a `/erp/`, `/erp/funciones/` y `/legal/`.
3. Ajustar titles/metas largos en paginas legales, pagos Argentina y algunos modulos Cumbre duplicados.
4. Recortar el title de `/cumbre-crm/` de 71 a 70 caracteres o menos si se quiere cumplir el umbral estricto.

## PageSpeed

PageSpeed Insights API no pudo medirse en esta corrida porque respondio `HTTP 429` por cuota diaria excedida. Quedan como referencia las mediciones previas documentadas en `docs/GOOGLE_SEO_SEM_GEO_STACK.md` y se recomienda repetir PSI cuando se libere la cuota.
