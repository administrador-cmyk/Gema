# Subdominios Modulares ERP Cumbre

Última actualización: 2026-06-06

## Objetivo

Preparar un portal por módulo de ERP Cumbre, cada uno con landing, planes, plataforma de pagos, diagnóstico comercial y conexión con el asistente IA.

Primero se publican URLs internas estables bajo `/cumbre/{modulo}`. Luego, cuando DNS/SSL estén listos, cada subdominio podrá apuntar a su landing correspondiente.

## Estado

- Landings internas: preparadas en WordPress.
- Plugin de mapeo: `gema-cumbre-subdomains`.
- Endpoint técnico: `/wp-json/gema-cumbre/v1/subdomains`.
- DNS real: pendiente.
- Wildcard SSL: pendiente.
- Server alias/vhost para subdominios: pendiente.
- Cuentas de pago reales: pendiente.

## Mapa de Subdominios

| Módulo | Subdominio previsto | Landing interna |
|---|---|---|
| Cumbre CRM | `crm.gema-digital.com` | `/cumbre/crm` |
| Cumbre ERP Negocios | `negocios.gema-digital.com` | `/cumbre/negocios` |
| Cumbre ERP PyMEs | `pymes.gema-digital.com` | `/cumbre/pymes` |
| Cumbre Empresas | `empresas.gema-digital.com` | `/cumbre/empresas` |
| Cumbre Facturador | `facturador.gema-digital.com` | `/cumbre/facturador` |
| Cumbre Cobros | `cobros.gema-digital.com` | `/cumbre/cobros` |
| Cumbre Catálogo | `catalogo.gema-digital.com` | `/cumbre/catalogo` |
| Cumbre Compras | `compras.gema-digital.com` | `/cumbre/compras` |
| Cumbre Ventas | `ventas.gema-digital.com` | `/cumbre/ventas` |
| Cumbre Personal | `personal.gema-digital.com` | `/cumbre/personal` |
| Cumbre Tesorería | `tesoreria.gema-digital.com` | `/cumbre/tesoreria` |
| Cumbre Marketing | `marketing.gema-digital.com` | `/cumbre/marketing` |
| Cumbre Automatizaciones | `automatizaciones.gema-digital.com` | `/cumbre/automatizaciones` |
| Cumbre Web | `web.gema-digital.com` | `/cumbre/web` |
| Cumbre eCommerce | `ecommerce.gema-digital.com` | `/cumbre/ecommerce` |
| Cumbre Kioscos | `kioscos.gema-digital.com` | `/cumbre/kioscos` |
| Cumbre Resto | `resto.gema-digital.com` | `/cumbre/resto` |
| Cumbre Depósitos WMS | `wms.gema-digital.com` | `/cumbre/wms` |
| Cumbre Constructoras | `constructoras.gema-digital.com` | `/cumbre/constructoras` |
| Cumbre Agro | `agro.gema-digital.com` | `/cumbre/agro` |
| Cumbre Mercados | `mercados.gema-digital.com` | `/cumbre/mercados` |
| Asistente Guiado Cumbre | `asistente.gema-digital.com` | `/cumbre/asistente` |
| Panel de Control Cumbre | `panel.gema-digital.com` | `/cumbre/panel` |

## Contenido Base de Cada Portal

Cada landing incluye:

- Propuesta de valor del módulo.
- Subdominio previsto.
- URL interna actual.
- Bloque de planes por alcance: Inicial, PyME y Empresa.
- Trial de 14 días por módulo, preservando datos al convertir a pago.
- Bloque de pagos y activación conectado con Cumbre Cobros.
- Enlaces a ERP Cumbre, pagos, pagos Argentina y contacto.
- FAQ sobre estado del subdominio, planes y cobros.

## Activación Técnica Pendiente

Para activar subdominios reales:

1. Crear DNS `A` o `CNAME` por subdominio, o wildcard `*.gema-digital.com`.
2. Configurar el servidor web para aceptar esos hosts.
3. Emitir wildcard SSL o certificados por subdominio.
4. Activar el plugin `gema-cumbre-subdomains` en producción.
5. Validar endpoint `/wp-json/gema-cumbre/v1/subdomains`.
6. Probar cada host con `curl -I https://{subdominio}.gema-digital.com`.
7. Definir si el SEO usa canonical al path principal o indexación independiente por subdominio.

## Pagos

Cada portal queda preparado para conectarse con:

- `/erp-cumbre/cumbre-cobros`
- `/pagos`
- `/pagos/argentina`
- `/pagos/mercado-pago`
- `/pagos/nave`
- `/pagos/paypal`
- `/pagos/stripe`

No se conectan credenciales reales hasta que GEMA confirme cuentas y permisos.
