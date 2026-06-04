#!/usr/bin/env bash
# Copia el tema gema-sovereign al WordPress local de Studio
set -euo pipefail

PROJECT_ROOT="$(cd "$(dirname "$0")/.." && pwd)"
STUDIO_WP="${WP_LOCAL_PATH:-/Users/norbertosarlinga/Studio/gema-digital-local}"
THEME_SRC="${PROJECT_ROOT}/wordpress/theme-gema-sovereign"
THEME_DEST="${STUDIO_WP}/wp-content/themes/gema-sovereign"
BRAND_DEST="${THEME_DEST}/brand"

if [[ ! -d "$STUDIO_WP/wp-content" ]]; then
  echo "Error: no existe instalación WordPress en: $STUDIO_WP"
  exit 1
fi

mkdir -p "$THEME_DEST"
rsync -a --delete \
  --exclude 'brand' \
  "$THEME_SRC/" "$THEME_DEST/"

mkdir -p "$BRAND_DEST"
rsync -a "${PROJECT_ROOT}/brand/tokens/" "${BRAND_DEST}/tokens/"
rsync -a "${PROJECT_ROOT}/brand/logos/" "${BRAND_DEST}/logos/"

# Ajustar imports en style.css para ruta dentro del tema copiado.
python3 - <<PY
from pathlib import Path
style = Path("${THEME_DEST}/style.css")
text = style.read_text()
text = text.replace("@import url('../../brand/tokens/colors.css');", "@import url('./brand/tokens/colors.css');")
text = text.replace("@import url('../../brand/tokens/typography.css');", "@import url('./brand/tokens/typography.css');")
style.write_text(text)
PY

echo "Tema sincronizado en: $THEME_DEST"
echo "Activar en WP Admin → Apariencia → Temas → Gema Sovereign"
