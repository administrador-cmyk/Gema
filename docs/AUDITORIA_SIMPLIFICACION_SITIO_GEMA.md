# Auditoria de simplificacion del sitio GEMA

Fecha: 2026-06-06

## Objetivo

Simplificar la arquitectura publica de GEMA Digital y ERP Cumbre sin perder paginas utiles para SEO, legales o conversion. La decision principal es separar navegacion global de paginas satelite: el usuario ve una estructura simple, mientras los clusters long-tail siguen disponibles desde hubs y enlaces contextuales.

## Inventario resumido

Fuentes revisadas:

- `wordpress/theme-gema-sovereign/parts/header.html`
- `wordpress/theme-gema-sovereign/parts/footer.html`
- `wordpress/theme-gema-sovereign/functions.php`
- `wordpress/theme-gema-sovereign/inc/seo-yoast.php`
- `docs/YOAST_SEO_ANALISIS_SEMANTICO.md`

Clusters principales:

- Marca y solucion general: `/`, `/empresas`, `/nosotros`, `/contacto`, `/tecnologia`, `/integraciones`, `/blog`.
- ERP Cumbre: `/erp-cumbre`, `/erp/precios`, `/erp/funciones/facturacion-electronica`, portales bajo `/cumbre/`.
- Cumbre CRM: `/cumbre-crm` como slug comercial principal.
- Cumbre ERP Negocios: `/cumbre-erp-negocios` como slug comercial principal.
- IA y automatizacion: `/ia-productiva`, `/automatizacion`, `/ia/automatizacion-whatsapp`.
- Pagos y cobros: `/pagos`, `/pagos/*`, `/erp-cumbre/cumbre-cobros`.
- Comparativas: `/competencia` y satelites long-tail bajo `/competencia/cumbre-*`.
- Legal: `/terminos`, `/privacidad`, `/politica-de-cookies`, `/legal/cumbre*`.

## Nueva jerarquia publica

Header:

- Soluciones
- ERP Cumbre
- IA Productiva
- GEMA Negocios
- Recursos
- Contacto

Footer:

- GEMA Digital: Inicio, Soluciones, GEMA Negocios, IA Productiva, Contacto.
- ERP Cumbre: ERP Cumbre, Cumbre CRM, ERP Negocios, Precios y prueba, Portales Cumbre, Comparativas.
- Pagos: Plataforma de pagos, Cumbre Cobros, Pagos Argentina, Mercado Pago, Webhooks, Conciliacion.
- Legal y recursos: Blog, Terminos, Privacidad, Cookies, Legal Cumbre.

Las paginas profundas de modulos, proveedores de pago, comparativas especificas y documentos legales Cumbre quedan fuera de la navegacion global. Deben aparecer en hubs como `/competencia`, `/pagos`, `/cumbre`, `/legal/cumbre` y en enlaces contextuales internos.

## Mapa de consolidacion SEO

| URL secundaria | Accion | URL principal | Motivo |
| --- | --- | --- | --- |
| `/cumbre/crm` | 301 | `/cumbre-crm/` | Duplica la landing comercial Cumbre CRM. |
| `/cumbre/negocios` | 301 | `/cumbre-erp-negocios/` | Duplica la landing comercial Cumbre ERP Negocios. |
| `/cumbre/cobros` | 301 | `/erp-cumbre/cumbre-cobros/` | Duplica el modulo Cumbre Cobros dentro del cluster pagos. |
| `/tecnologia/pasarela-pagos` | 301 | `/pagos/` | Solapa la intencion con el hub de pagos GEMA. |
| `/impuestos` | 301 | `/erp/funciones/facturacion-electronica/` | Solapa la intencion fiscal con la pagina principal de facturacion ERP. |
| `/impuestos/arca-fiscal` | 301 | `/erp/funciones/facturacion-electronica/` | Solapa la intencion ARCA con facturacion ERP. |
| `/competencia/tango` | 301 | `/competencia/cumbre-erp-pymes-vs-tango-bejerman-odoo/` | Reemplazada por comparativa bottom-funnel completa. |
| `/competencia/odoo` | 301 | `/competencia/cumbre-erp-pymes-vs-tango-bejerman-odoo/` | Reemplazada por comparativa bottom-funnel completa. |
| `/competencia/sap` | 301 | `/competencia/cumbre-empresas-vs-sap-netsuite/` | Reemplazada por comparativa empresarial completa. |
| `/competencia/netsuite` | 301 | `/competencia/cumbre-empresas-vs-sap-netsuite/` | Reemplazada por comparativa empresarial completa. |
| `/competencia/holded` | 301 | `/competencia/cumbre-erp-pymes-vs-tango-bejerman-odoo/` | Consolidada dentro del cluster ERP para PyMEs. |

## Criterio de preservacion

No se eliminaron definiciones de paginas. Las URLs secundarias pueden seguir existiendo a nivel programatico, pero el trafico publico se consolida hacia los slugs principales mediante redireccion y canonical. Esto evita canibalizacion sin perder trazabilidad ni compatibilidad durante la transicion.

## Pendientes recomendados

- Verificar en produccion, despues del despliegue, que cada URL consolidada responda 301 y no genere cadenas de redireccion.
- Revisar Search Console luego de publicar para detectar paginas con impresiones que no convenga consolidar.
- Decidir politica final de subdominios Cumbre: indexar subdominio propio o redirigir/canonicalizar hacia el slug principal.
- Mantener las comparativas long-tail fuera del menu global y fortalecer `/competencia` como hub.
