# Stack Google SEO, SEM y GEO para GEMA Digital

## Objetivo

Centralizar las herramientas Google necesarias para medir, indexar, auditar y optimizar `gema-digital.com` sin romper performance, privacidad ni estructura SEO.

## Cuenta objetivo

- Cuenta Google: `info@gema-digital.com`
- Dominio: `gema-digital.com`
- Sitemap recomendado: `https://gema-digital.com/sitemap_index.xml`

## Herramientas principales

### Google Search Console

Uso:
- Indexación.
- Consultas orgánicas.
- CTR.
- Cobertura.
- Sitemaps.
- Core Web Vitals.
- Inspección de URLs.

Configuración recomendada:
- Propiedad de dominio: `gema-digital.com` si hay acceso DNS.
- Propiedad URL-prefix alternativa: `https://gema-digital.com/` si se verifica por meta tag o archivo HTML.
- Enviar sitemap: `https://gema-digital.com/sitemap_index.xml`.

Estado actual:
- Pendiente de verificación con `info@gema-digital.com`.
- El navegador de Cursor seguía autenticado con `info@generatuenergia.net`; no se debe registrar la propiedad con esa cuenta.

### Google Analytics 4

Uso:
- Medición de tráfico.
- Conversiones.
- Eventos.
- Embudos.
- Audiencias.
- Integración con Google Ads y Search Console.

Configuración recomendada:
- Crear cuenta/propiedad GA4 para `GEMA Digital`.
- Crear web data stream para `https://gema-digital.com`.
- Activar Enhanced Measurement solo si respeta política de cookies y privacidad.
- Definir conversiones: formulario enviado, click WhatsApp, click teléfono, solicitar demo, prueba gratis, contacto por módulo.

### Google Tag Manager

Uso:
- Administrar GA4, Google Ads, conversiones, remarketing y futuras etiquetas sin editar el theme.

Configuración recomendada:
- Crear contenedor Web para `gema-digital.com`.
- Activar el ID `GTM-PB7TZGWJ` en el theme.
- Cargar GA4 y Ads desde GTM para evitar tags duplicados.

Estado actual:
- Contenedor provisto para GEMA: `GTM-PB7TZGWJ`.
- El theme ya imprime el snippet estándar de GTM y el `noscript` cuando se define la opción `gema_google_tag_manager_id`.
- Producción ya tiene activa la opción `gema_google_tag_manager_id = GTM-PB7TZGWJ`.
- Verificado en HTML público de Home, `/faqs/`, `/erp-cumbre/` y `/cumbre-crm/`.
- No pegar el snippet manualmente en plantillas para evitar doble carga.

### Google Ads

Uso:
- SEM.
- Conversion tracking.
- Remarketing.
- Campañas de búsqueda para ERP, CRM, software de gestión, Cumbre y GEMA.

Configuración recomendada:
- Crear conversiones importadas desde GA4 o conversiones nativas de Ads.
- Priorizar conversiones de calidad: demo, diagnóstico, formulario, WhatsApp comercial.
- Evitar campañas antes de tener Search Console, GA4 y landing auditadas.

### PageSpeed Insights y Core Web Vitals

Uso:
- Performance.
- Mobile UX.
- Core Web Vitals.
- Diagnóstico técnico.

URLs útiles:
- `https://pagespeed.web.dev/analysis?url=https://gema-digital.com/`
- `https://pagespeed.web.dev/analysis?url=https://gema-digital.com/erp-cumbre/`
- `https://pagespeed.web.dev/analysis?url=https://gema-digital.com/cumbre-crm/`
- `https://pagespeed.web.dev/analysis?url=https://gema-digital.com/faqs/`

Estado medido el 2026-06-08:
- Home `/`: móvil con Rendimiento 90, Accesibilidad 96, Recomendaciones 100, SEO 100.
- ERP Cumbre `/erp-cumbre/`: móvil con Rendimiento 93, Accesibilidad 96, Recomendaciones 100, SEO 100 y datos estructurados válidos.
- Cumbre CRM `/cumbre-crm/`: móvil con Rendimiento 92, Accesibilidad 96, Recomendaciones 100, SEO 100 y datos estructurados válidos.
- FAQs `/faqs/` antes del deploy: móvil con Rendimiento 89, Accesibilidad 100, Recomendaciones 96, SEO 50 porque producción respondió 404.
- FAQs `/faqs/` post-deploy: móvil con Rendimiento 75, Accesibilidad 96, Recomendaciones 100, SEO 100 y datos estructurados válidos.
- FAQs `/faqs/` post-optimización: móvil con Rendimiento 98, Accesibilidad 96, Recomendaciones 100, SEO 100. Métricas: FCP 1.0 s, LCP 2.4 s, TBT 10 ms, CLS 0, Speed Index 1.6 s.
- Sitemap: `https://gema-digital.com/page-sitemap.xml` ya incluye `/faqs/`.
- Auditoría de sitemap: 151 URLs de `page-sitemap.xml` revisadas; 0 fallas de HTTP, title o meta description.

Oportunidades recurrentes detectadas:
- Se reemplazó el logo de interfaz por `gema-logo-web-mark-160.webp`, reduciendo el asset de ~415 KB a ~6 KB.
- Se creó `seo-geo-nodo-conocimiento-lite.webp`, reduciendo la imagen compartida SEO de ~24 KB a ~13 KB.
- Se integraron tokens CSS dentro de `style.css` para eliminar requests bloqueantes a `colors.css` y `typography.css`.
- Se agregó `defer` a scripts propios del theme (`theme-toggle.js` y `gema-floating-agent.js`).
- Se completaron meta descriptions faltantes para `/erp/`, `/erp/funciones/` y `/legal/`.
- Pendientes menores: cache headers de algunos assets, JS sin usar asociado a GTM/terceros, una animación no compuesta y revisión fina de contraste.
- Revisar contraste de algunos textos en modo visual.

### Google Business Profile

Uso:
- SEO local.
- Reputación.
- Map Pack.
- Reseñas.
- Presencia de marca.

Configuración recomendada:
- Revisar perfil de GEMA Digital.
- Confirmar NAP: nombre, dirección, teléfono.
- Publicar servicios: ERP, software, IA, marketing, automatización.
- Agregar URLs principales: home, ERP Cumbre, contacto.

### Google Merchant Center

Uso:
- No prioritario para GEMA institucional.
- Potencialmente útil más adelante si Cumbre Web/eCommerce o clientes requieren feeds.

### Looker Studio

Uso:
- Dashboard ejecutivo.
- Mezclar GA4, Search Console, Ads y CRM/leads.

Configuración recomendada:
- Crear tablero por clusters: Cumbre ERP, Comparativas, FAQs, Blog, Servicios, Contacto.

## Activación técnica en WordPress

El theme `theme-gema-sovereign` quedó preparado para cargar herramientas Google mediante constantes o opciones WordPress.

Constantes disponibles:

```php
define( 'GEMA_GOOGLE_SITE_VERIFICATION', 'TOKEN_SEARCH_CONSOLE' );
define( 'GEMA_GOOGLE_TAG_MANAGER_ID', 'GTM-PB7TZGWJ' );
define( 'GEMA_GOOGLE_ANALYTICS_ID', 'G-XXXXXXXXXX' );
define( 'GEMA_GOOGLE_ADS_ID', 'AW-XXXXXXXXXX' );
```

Opciones equivalentes:

```bash
wp option update gema_google_site_verification 'TOKEN_SEARCH_CONSOLE'
wp option update gema_google_tag_manager_id 'GTM-PB7TZGWJ'
wp option update gema_google_analytics_id 'G-XXXXXXXXXX'
wp option update gema_google_ads_id 'AW-XXXXXXXXXX'
```

Regla:
- Si `GEMA_GOOGLE_TAG_MANAGER_ID` o `gema_google_tag_manager_id` existe, se carga GTM y no se cargan GA4/Ads directos desde el theme para evitar duplicación.
- Si no hay GTM, el theme puede cargar GA4 y/o Ads directos con `gtag`.
- Si no hay IDs reales, no se imprime ningún tag externo.

## Orden recomendado

1. Verificar Search Console con `info@gema-digital.com`.
2. Enviar sitemap Yoast: `https://gema-digital.com/sitemap_index.xml`.
3. Crear GA4.
4. Crear GTM.
5. Instalar GTM en producción con el ID real. Completado con `GTM-PB7TZGWJ`.
6. Configurar GA4 dentro de GTM.
7. Crear eventos/conversiones.
8. Vincular GA4 con Search Console.
9. Vincular GA4 con Google Ads si se activan campañas SEM.
10. Medir PageSpeed y Core Web Vitals después del deploy.
11. Crear tablero Looker Studio.

## Pendientes

- Obtener/verificar acceso real de `info@gema-digital.com` en Search Console.
- Definir si la verificación será DNS, meta tag o archivo HTML.
- Obtener IDs reales de GA4 y Google Ads.
- Revisar política de cookies antes de activar cookies analíticas/publicitarias.
- Repetir auditoría Rich Results y Search Console cuando la cuenta `info@gema-digital.com` esté disponible.
- Configurar/validar consentimiento de cookies para analítica/publicidad antes de campañas SEM.
