# Workflows n8n GEMA

## Workflow disponible

- `gema-social-campaign-dry-run.workflow.json`

Objetivo:

- Leer la cola JSON de campaña institucional GEMA / ERP Cumbre.
- Filtrar por dia, red y primer lote.
- Preparar items para revision humana.
- No publicar automaticamente.

## Variables requeridas

Configurar en n8n o en el entorno del contenedor/VPS:

- `GEMA_SOCIAL_QUEUE_JSON_URL`

Valor sugerido cuando la rama este mergeada:

`https://raw.githubusercontent.com/administrador-cmyk/Gema/main/docs/social-publication-queue/gema-cumbre-20-dias.queue.json`

Mientras se trabaja desde la rama actual:

`https://raw.githubusercontent.com/administrador-cmyk/Gema/cursor/brand-wordpress-foundation/docs/social-publication-queue/gema-cumbre-20-dias.queue.json`

## Importacion

1. Abrir n8n.
2. Ir a `Workflows`.
3. Importar desde archivo.
4. Seleccionar `docs/n8n-workflows/gema-social-campaign-dry-run.workflow.json`.
5. Revisar nodo `Campaign Config`.
6. Ejecutar manualmente.

## Configuracion inicial

Nodo `Campaign Config`:

- `targetDay`: dia maximo de la cola a preparar.
- `targetNetwork`: red objetivo, por ejemplo `linkedin`, `facebook`, `pinterest` o `x`.
- `firstBatchOnly`: `true` para preparar solo el primer lote recomendado.
- `dryRun`: debe quedar `true` hasta tener aprobaciones y credenciales.

## Resultado esperado

El workflow devuelve items con:

- `campaignId`
- `postId`
- `day`
- `network`
- `title`
- `pillar`
- `url` con UTM
- `mediaStatus`
- `approvalStatus = pending_human_approval`
- checklist de revision

## Proximo paso

Agregar un canal de revision humana:

- Email.
- Telegram.
- Slack.
- Google Sheet.
- Airtable.

Publicacion por API debe agregarse despues y solo si:

- `approvalStatus = approved`
- cuenta destino verificada.
- credenciales OAuth guardadas fuera del repositorio.
- imagen/video aprobado cuando la red lo requiera.

## Seguridad

- No pegar tokens en el workflow JSON.
- No activar nodos de publicacion directa sin aprobacion humana.
- No publicar en activos de Genera Tu Energia salvo autorizacion explicita.
- No tocar anuncios, pagos, ownership ni permisos desde este workflow.
