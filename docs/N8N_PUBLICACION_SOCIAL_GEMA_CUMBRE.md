# n8n - Publicacion social GEMA Digital / ERP Cumbre

## Objetivo

Usar n8n como orquestador para preparar, revisar y publicar contenido institucional de GEMA Digital / ERP Cumbre en redes sociales, usando APIs oficiales y sin guardar tokens en el repositorio.

## Fuentes de contenido

- Copy completo: `docs/CONTENIDO_INSTITUCIONAL_GEMA_CUMBRE_20_PUBLICACIONES.md`
- Calendario humano: `docs/COLA_PUBLICACION_GEMA_CUMBRE_20_DIAS.md`
- Cola JSON: `docs/social-publication-queue/gema-cumbre-20-dias.queue.json`
- Fuente TypeScript: `cumbre/src/lib/socialPublisher/institutionalCampaign.ts`

## Principio de seguridad

- Los tokens OAuth viven en credenciales de n8n o Secret Manager, nunca en Git.
- Toda publicacion debe pasar por revision humana al inicio.
- Instagram, Pinterest y YouTube requieren asset visual aprobado.
- No publicar en activos de Genera Tu Energia salvo autorizacion explicita.
- No tocar pagos, anuncios, propietarios ni permisos desde este flujo.

## Cuentas previstas

Facebook / Instagram / LinkedIn:

- Login operativo: `info@generatuenergia.net`
- Activos GEMA: `Gema Sistemas ERP` / `gema.digital.erp`
- Estado API: pendiente Meta Developer App, LinkedIn Developer App y permisos aprobados.

Pinterest / YouTube / X / Google:

- Login operativo recomendado: `info@gema-digital.com`
- Pinterest creado: `GemaDigitalERP`
- YouTube GEMA: pendiente canal propio.
- X: pendiente cuenta/acceso.
- Google Business GEMA: pendiente ficha propia.

## Workflow recomendado en n8n

### 1. Trigger manual o programado

Arrancar manualmente para las primeras publicaciones. Luego programar segun calendario.

Entrada:

- `campaign_id`
- `day`
- `network`
- `dry_run`: `true`

### 2. Leer cola JSON

Leer `docs/social-publication-queue/gema-cumbre-20-dias.queue.json` desde GitHub, filesystem sincronizado o repositorio clonado en el VPS.

Filtrar por:

- `status = draft_pending_review`
- `day <= dia objetivo`
- red incluida en `networks`
- `mediaStatus = ready` cuando la red requiere imagen/video.

### 3. Resolver copy

Opcion inicial:

- Usar el documento completo y copiar manualmente el texto por red.

Opcion API:

- Usar `cumbre/src/lib/socialPublisher/institutionalCampaign.ts` como fuente estructurada.
- Ejecutar dry-run con `runFirstInstitutionalBatchDryRun`.

### 4. Revision humana

Antes de publicar, enviar a un canal de aprobacion:

- Email.
- Slack/Telegram.
- Tarea interna.
- Google Sheet/Airtable.

Campos a aprobar:

- Red.
- Copy final.
- Link con UTM.
- Imagen/video.
- Fecha/hora.
- Cuenta destino.

### 5. Publicacion por red

Facebook:

- API: Meta Graph API Page Feed.
- Requiere Page ID y Page Access Token.
- Puede publicar texto + link.

Instagram:

- API: Instagram Graph API.
- Requiere imagen/video.
- Flujo: crear media container y luego publicar.

LinkedIn:

- API: LinkedIn UGC/Posts.
- Requiere Organization ID y OAuth token.
- Puede publicar texto organico como organizacion.

Pinterest:

- API: Pinterest v5 Pins.
- Requiere board ID, token e imagen.
- Tableros sugeridos: `GEMA Digital`, `ERP Cumbre`, `CRM y ventas`, `POS para comercios`, `Marketing digital`, `Automatizacion e IA`, `Cobros y facturacion`.

YouTube:

- Requiere canal GEMA definido.
- Shorts/Reels requieren asset de video generado y aprobado.

X:

- Requiere cuenta GEMA y X Developer access.
- No priorizar hasta resolver alta/acceso.

Google Business:

- Requiere ficha GEMA propia.
- No usar ficha de Genera Tu Energia.

## Estados sugeridos

- `draft_pending_review`: contenido listo, falta revision.
- `asset_pending`: falta imagen/video.
- `approved`: aprobado por humano.
- `scheduled`: programado en n8n.
- `published`: publicado correctamente.
- `blocked`: bloqueado por acceso, media, permisos o compliance.
- `failed`: error tecnico.

## Primer lote recomendado

Publicar primero:

1. GEMA Digital nace para ordenar empresas reales.
2. Que es ERP Cumbre.
3. Menos carga mental para el dueno de negocio.
4. Cobrar, registrar y conciliar.
5. Marketing que se puede medir.

Orden sugerido:

- LinkedIn y Facebook primero.
- Instagram/Pinterest cuando existan visuales aprobados.
- Google Business solo cuando exista ficha GEMA.
- X cuando exista cuenta.

## Variables y credenciales

Usar las variables documentadas en:

- `docs/APIS_REDES_SOCIALES_GEMA.md`
- `cumbre/.env.social.example`

No copiar valores reales a este repositorio.

## Siguiente paso tecnico

Crear en n8n:

1. Workflow `GEMA - Social Campaign Dry Run`.
2. Nodo de lectura de cola JSON.
3. Nodo de filtro por dia/red.
4. Nodo de aprobacion humana.
5. Nodo por red para publicar solo cuando `approved = true`.
