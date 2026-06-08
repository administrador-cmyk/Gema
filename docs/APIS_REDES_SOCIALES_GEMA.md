# APIs de redes sociales GEMA

## Objetivo

Crear una base segura para que GEMA pueda generar, aprobar, publicar y medir contenido por APIs oficiales, evitando depender de sesiones abiertas en Chrome.

Regla principal: las APIs se usan para publicar, programar, medir y auditar. La creacion de cuentas, verificacion, 2FA, ownership, pagos y permisos sensibles siguen requiriendo aprobacion manual de la plataforma.

## Cuentas de acceso

- Facebook, Instagram y LinkedIn: acceso operativo via `info@generatuenergia.net`.
- Pinterest, YouTube, Google/APIs y resto: acceso operativo via `info@gema-digital.com`.
- No guardar contrasenas, recovery codes, tokens ni secretos en el repositorio.
- Usar `.env` local, gestor de secretos o variables del entorno de despliegue.

## Estado actual

| Red | Perfil / activo | Estado API | Bloqueo actual |
| --- | --- | --- | --- |
| Facebook | `Gema Sistemas ERP` | Pendiente Meta Developer App y Page Access Token | Requiere crear app y aprobar permisos |
| Instagram | `gema.digital.erp` | Pendiente Instagram Business + Graph API | No publica texto solo; requiere media |
| LinkedIn | `Gema Sistemas ERP` | Pendiente LinkedIn Developer App y OAuth | Requiere permisos de organizacion |
| Pinterest | `GemaDigitalERP` | Cuenta creada; API pendiente | Requiere Pinterest Developer App y token |
| YouTube | Pendiente canal GEMA | Pendiente Google Cloud / YouTube Data API | Falta canal propio o autorizacion sobre canal personal |
| X | Pendiente cuenta | Pendiente X Developer | Alta visible requiere telefono o Apple |

## Variables esperadas

La plantilla queda en `cumbre/.env.social.example`.

Variables principales:

- `META_FACEBOOK_PAGE_ID`
- `META_FACEBOOK_PAGE_ACCESS_TOKEN`
- `META_INSTAGRAM_BUSINESS_ACCOUNT_ID`
- `META_INSTAGRAM_ACCESS_TOKEN`
- `LINKEDIN_ORGANIZATION_ID`
- `LINKEDIN_ACCESS_TOKEN`
- `PINTEREST_ACCESS_TOKEN`
- `PINTEREST_DEFAULT_BOARD_ID`
- `YOUTUBE_CHANNEL_ID`
- `YOUTUBE_ACCESS_TOKEN`
- `X_ACCESS_TOKEN`

## Scaffold tecnico creado

Modulo: `cumbre/src/lib/socialPublisher/`.

Incluye:

- `types.ts`: contratos de redes, drafts, resultados y variables.
- `content.ts`: politicas de cuenta y drafts institucionales base.
- `adapters.ts`: adaptadores HTTP para Facebook, Instagram, LinkedIn y Pinterest.
- `index.ts`: exports y `runSocialPublisherDryRun()` para validar estado sin publicar.

Comportamiento seguro:

- Si faltan tokens o IDs, devuelve `skipped`.
- Si una red requiere media y el draft no la tiene, devuelve `blocked`.
- Si se usa `dryRun`, no publica nada.
- No maneja passwords, 2FA, pagos, anuncios ni ownership.

## Permisos minimos por red

### Meta / Facebook

Usar Meta Developers con una app de GEMA.

Permisos orientativos:

- `pages_manage_posts`
- `pages_read_engagement`
- `pages_show_list`
- `business_management` solo si Meta lo exige para vincular activos.

Publicacion objetivo:

- Facebook Page Feed de `Gema Sistemas ERP`.

### Instagram

Requisitos:

- Cuenta `gema.digital.erp` como Instagram Business o Creator.
- Conectada a la pagina de Facebook correcta.
- Token Graph API con permisos aprobados.

Notas:

- Instagram Graph API no publica posts organicos solo texto.
- Para publicar se necesita imagen o video.

### LinkedIn

Requisitos:

- LinkedIn Developer App.
- Producto/permisos para publicar como organizacion.
- Organization ID de `Gema Sistemas ERP`.

Permisos habituales:

- `w_organization_social`
- `r_organization_social`

### Pinterest

Requisitos:

- Pinterest Developer App.
- OAuth conectado a `GemaDigitalERP`.
- Board ID destino.

Notas:

- Para crear pins por API se requiere imagen o media source.
- Los tableros base ya existen en la cuenta.

### YouTube

Requisitos:

- Google Cloud Project bajo `info@gema-digital.com`.
- YouTube Data API habilitada.
- Canal GEMA propio o autorizacion expresa sobre canal personal.

Permisos:

- `youtube.upload`
- `youtube.readonly` para metricas basicas.

### X / Twitter

Requisitos:

- Cuenta X GEMA creada.
- Acceso a X Developer Platform.
- Plan/API habilitado segun funcionalidad requerida.

Nota:

- La creacion actual quedo bloqueada porque X no ofrecio alta por email en el flujo visible.

## Proximo flujo recomendado

1. Crear Meta Developer App y conectar Facebook/Instagram.
2. Crear Pinterest Developer App y obtener token OAuth para `GemaDigitalERP`.
3. Crear LinkedIn Developer App y conectar la organizacion `Gema Sistemas ERP`.
4. Definir canal YouTube GEMA antes de habilitar YouTube Data API.
5. Resolver X con telefono/Apple o decidir no priorizarlo.

## Publicacion de contenido

El flujo final recomendado:

1. Generar draft desde landings del sitio.
2. Revisar tono, hashtags, CTA y UTM.
3. Ejecutar `dryRun`.
4. Publicar por API solo si la red esta lista.
5. Registrar resultado remoto y metrica inicial.
6. Recolectar metricas por API en una segunda pasada.

