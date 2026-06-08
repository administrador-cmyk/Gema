#!/usr/bin/env bash
set -euo pipefail

STATE_FILE=".cursor/hooks/cumbre-modules-chain.state"
MAX_RUNS=30

if [[ ! -f "$STATE_FILE" ]]; then
  printf '{}\n'
  exit 0
fi

status="$(awk -F= '$1 == "status" { print $2 }' "$STATE_FILE" | tail -n 1)"
count="$(awk -F= '$1 == "count" { print $2 }' "$STATE_FILE" | tail -n 1)"

status="${status:-enabled}"
count="${count:-0}"

if [[ "$status" != "enabled" ]]; then
  printf '{}\n'
  exit 0
fi

if ! [[ "$count" =~ ^[0-9]+$ ]]; then
  count=0
fi

if (( count >= MAX_RUNS )); then
  {
    printf 'status=paused\n'
    printf 'count=%s\n' "$count"
    printf 'reason=max_runs_reached\n'
  } > "$STATE_FILE"

  python3 - <<'PY'
import json

print(json.dumps({
    "followup_message": (
        "La cadena de módulos Cumbre llegó al límite de seguridad configurado. "
        "No continúes automáticamente. Revisá `docs/cumbre-landing-prompts/` y "
        "`REGISTRO_DE_TRABAJO_GEMA.md`; si todavía faltan módulos, pedí al usuario "
        "reactivar la cadena."
    )
}, ensure_ascii=False))
PY
  exit 0
fi

next_count=$((count + 1))
{
  printf 'status=enabled\n'
  printf 'count=%s\n' "$next_count"
} > "$STATE_FILE"

python3 - <<'PY'
import json

message = """Continuá la cadena de desarrollo de módulos Cumbre.

Objetivo: tomar SOLO el próximo módulo pendiente de Cumbre, construirlo conceptualmente, auditarlo y crear el prompt web completo para su landing.

Proceso obligatorio:
1. Revisá el estado actual del proyecto, `REGISTRO_DE_TRABAJO_GEMA.md`, `docs/cumbre-landing-prompts/` y los módulos ya implementados para no duplicar trabajo.
2. Identificá el próximo módulo pendiente según el contexto actual del desarrollo. No inventes módulos nuevos si no quedan pendientes.
3. Para ese módulo, prepará: objetivo, público, problema, propuesta de valor, funcionalidades, módulos conectados, casos de uso, guardrails legales/técnicos/comerciales, SEO, estructura de landing, CTAs, planes y criterios visuales.
4. Auditá el módulo antes de cerrar: coherencia con Cumbre ERP, SEO, seguridad, privacidad, integraciones, lenguaje comercial, riesgos legales, dependencia de APIs externas y límites de automatización/IA.
5. Guardá el prompt final para la landing en `docs/cumbre-landing-prompts/<slug-del-modulo>.md`.
6. Actualizá `REGISTRO_DE_TRABAJO_GEMA.md` con el módulo trabajado, archivo creado, auditoría realizada, estado y próximos pasos.

Reglas:
- Estamos en desarrollo: no publicar, no desplegar, no tocar producción.
- No modifiques la landing web todavía salvo que el usuario lo pida explícitamente.
- Si no quedan módulos pendientes, registrá `sin módulos pendientes` en `docs/cumbre-landing-prompts/ESTADO_CADENA.md` y cambiá `.cursor/hooks/cumbre-modules-chain.state` a `status=complete` manteniendo el contador.
- Si encontrás ambigüedad seria o falta una decisión comercial, dejá el prompt en estado `requiere definición` y no avances con supuestos riesgosos.
"""

print(json.dumps({"followup_message": message}, ensure_ascii=False))
PY
