# Estado del arbol local GEMA

Fecha: 2026-06-08.

## Limpieza aplicada

- Se agregaron ignores para artefactos Python temporales:
  - `.pycache-validation/`
  - `.pycache_tmp/`
  - `__pycache__/`
  - `*.pyc`

Esto evita que caches generados por validaciones locales contaminen futuros commits.

## Cambios preparados para siguiente commit

- `.gitignore`: limpieza de temporales.
- `.github/workflows/deploy-wordpress-theme.yml`: workflow manual para deploy del theme WordPress.
- `docs/DEPLOY_GITHUB_A_PRODUCCION_GEMA.md`: runbook de deploy controlado desde GitHub a produccion.
- `docs/ESTADO_ARBOL_LOCAL_GEMA.md`: este inventario.

## Cambios locales no relacionados que siguen pendientes

No se borraron ni se revirtieron.

Grupos detectados:

- `.cursor/`: hooks y reglas locales de Cursor.
- `REGISTRO_DE_TRABAJO_GEMA.md`: tiene entradas tecnicas posteriores no incluidas en esta tarea.
- `cumbre/`: varios archivos de plataforma Cumbre, Firebase, UI, estabilidad y emuladores.
- `docs/`: auditorias, planes, legales, prompts y documentos de producto/SEO.
- `wordpress/plugins/`: plugins GEMA/Cumbre.
- `wordpress/theme-gema-sovereign/`: assets, agente flotante, eventos Google y SEO visuals.
- `cumbre-platform-preview.html`: preview local.

## Recomendacion

Crear commits separados por bloque:

1. Deploy GitHub -> produccion.
2. Plataforma Cumbre / Firebase.
3. WordPress SEO/plugins/assets.
4. Docs legales/SEO/publicista.
5. Hooks/reglas Cursor si se quieren versionar.

No mezclar estos grupos en un mismo PR.
