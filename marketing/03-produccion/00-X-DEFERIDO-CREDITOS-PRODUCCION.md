# X (Twitter) — créditos API diferidos a producción

**Estado:** OAuth conectado · publicación batch **bloqueada por billing** · **no pagar ahora**.

| Item | Valor |
|------|--------|
| Cuenta | [@GemaDigitalERP](https://x.com/GemaDigitalERP) |
| App | **GEMA Upload Bot** (`33067405`) |
| OAuth | 2.0 — tokens del portal (**Generar**, sin links Chrome) |
| Verificación | `verificar-x-token.py` → OK |
| Batch | `subir-x-serie.py` — dry-run OK · **0/39 publicados** |
| Bloqueo API | **402 CreditsDepleted** al crear tweet |
| Decisión | **Activar créditos solo cuando la serie esté en producción comercial** |

---

## Qué hacer cuando llegue producción

1. [console.x.com](https://console.x.com/) → proyecto / cuenta desarrollador → **Billing** o **Credits**.
2. Activar plan / créditos con permiso de **POST tweets** y **media upload**.
3. Si rotaste secretos: **Claves de OAuth 2.0** → Regenerar Client Secret → **Generar** access + refresh → actualizar `.env.social`.
4. Verificar:
   ```bash
   cd "/Users/norbertosarlinga/Library/CloudStorage/GoogleDrive-info@gema-digital.com/Mi unidad/GEMA/00-Proyecto Gema/15-Produccion-Audiovisual"
   python3 marketing/01-videos/scripts/verificar-x-token.py
   python3 marketing/01-videos/scripts/subir-x-serie.py --video 2 --delay 0
   ```
5. Batch completo:
   ```bash
   python3 marketing/01-videos/scripts/subir-x-serie.py --video 2-40 --skip-existing --delay 90
   ```

---

## Referencias

- OAuth portal (hub audiovisual): `00-X-OAUTH2-PORTAL-GENERAR.md`
- Matriz redes (hub audiovisual): `00-CONECTAR-REDES-CUMBRE.md`
- Credenciales: `marketing/01-videos/scripts/secrets/.env.social` (local, no commitear)
- Registro repo web: `REGISTRO_DE_TRABAJO_GEMA.md`

---

## Error de referencia (2026-06-11)

```json
{
  "title": "CreditsDepleted",
  "detail": "Your enrolled account does not have any credits to fulfill this request.",
  "type": "https://api.twitter.com/2/problems/credits"
}
```
