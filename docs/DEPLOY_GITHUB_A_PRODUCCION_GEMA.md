# Deploy de GitHub a produccion GEMA

## Objetivo

Definir un flujo controlado para publicar el theme WordPress `gema-sovereign` desde GitHub hacia la instalacion productiva de `gema-digital.com`, sin guardar credenciales en el repositorio.

## Estrategia recomendada

1. `main` en GitHub es la fuente estable.
2. Los cambios entran por pull request.
3. El deploy se ejecuta manualmente desde GitHub Actions con `workflow_dispatch`.
4. GitHub Actions sincroniza solo el theme `wordpress/theme-gema-sovereign/` hacia el servidor.
5. Antes de sobrescribir, el servidor genera backup comprimido del theme actual.
6. Despues del sync, se corrige ownership y se limpian caches WordPress.

## Secretos requeridos en GitHub

Configurar en:

`GitHub > Repo > Settings > Secrets and variables > Actions`

Secrets:

- `GEMA_PROD_SSH_HOST`: host o IP del servidor WordPress.
- `GEMA_PROD_SSH_PORT`: puerto SSH. Si no se define, usar `22`.
- `GEMA_PROD_SSH_USER`: usuario SSH con permisos de deploy.
- `GEMA_PROD_SSH_KEY`: private key SSH para deploy.
- `GEMA_PROD_WP_PATH`: ruta absoluta de WordPress en produccion.
- `GEMA_PROD_THEME_OWNER`: usuario/grupo del servidor para el theme, por ejemplo `gemad2467:gemad2467`.

No guardar estos valores en archivos versionados.

## Workflow creado

Archivo:

- `.github/workflows/deploy-wordpress-theme.yml`

Modo de ejecucion:

- Manual.
- Rama recomendada: `main`.
- Sin deploy automatico al merge hasta validar varias corridas.

## Validacion previa

Antes de correr deploy:

1. Confirmar que `main` contiene el PR aprobado.
2. Confirmar que los secrets estan cargados.
3. Confirmar que el path remoto apunta al WordPress correcto.
4. Ejecutar backup remoto.
5. Sincronizar theme.
6. Verificar home y paginas principales:
   - `/`
   - `/erp-cumbre/`
   - `/cumbre-crm/`
   - `/cumbre-erp-negocios/`
   - `/contacto/`

## Rollback

El workflow crea backup en:

`$GEMA_PROD_WP_PATH/../gema-production-backups/`

Rollback manual:

1. Entrar por SSH.
2. Ubicar el `.tgz` anterior.
3. Restaurar sobre `wp-content/themes/gema-sovereign/`.
4. Corregir ownership.
5. Limpiar cache WordPress.

## Pendientes

- Cargar secrets en GitHub.
- Ejecutar primer deploy manual controlado.
- Agregar auditoria post-deploy automatizada desde n8n.
- Integrar aviso de resultado en Slack/email si se define canal.
