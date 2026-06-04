# Hoja de ruta — Gema Digital & ERP Cumbre

Plan secuencial alineado con el Master Sitio Web y el stack acordado.

## Relación de marcas

```
GEMA DIGITAL (agencia)
    │  crea y respalda
    ▼
ERP CUMBRE (producto SaaS)
```

| Marca | Personalidad | Uso en el sitio |
|-------|--------------|-----------------|
| Gema Digital | Creativa, IA, vanguardia | Home, blog, servicios FDE, agencia |
| ERP Cumbre | Robusta, financiera, militar | Producto, comparativas, módulos ERP |

## Fases

### Fase 1 — Identidad core ✅ (en curso)

- [x] Estructura del repositorio de proyecto
- [x] Brand Guidelines (`brand/guidelines/BRAND_GUIDELINES.md`)
- [x] Tokens CSS (`brand/tokens/`)
- [x] Logotipos SVG conceptuales + favicons
- [ ] Validación visual contra PNG en `02-Logos/`
- [ ] Export final de isotipos si se refinan en Figma/Illustrator

### Fase 2 — UI web (WordPress + Stitch)

- Maquetación clave desde `03-Silo contenido/30) Paginas creadas en stritch/`
- Tema hijo `gema-sovereign` (bridge Sovereign 4.0 + nuevas paletas Gema/Cumbre)
- `tailwind.config.js` con presets `gema` y `cumbre`
- 29 landing pages según slugs del CSV maestro

### Fase 3 — Datos & seguridad (ERP)

- Supabase: multi-tenant + RLS
- Auditoría Claude Code en CI local

### Fase 4 — Ventas & despliegue

- Pitch deck B2B
- CI/CD → GCP (`gema-digital-web`)

## Stack

| Herramienta | Rol |
|-------------|-----|
| WordPress 7 + Studio | Sitio marketing local |
| v0.dev | Prototipos UI rápidos |
| Cursor | IDE / tema / automatización |
| Supabase | ERP PostgreSQL |
| GCP | Producción |
| Claude | Auditoría DevOps |

## Contenido

Inventario de páginas: `../03-Silo contenido/base_de_datos_master.csv`  
Menú: `../03-Silo contenido/gema-menus.cvs`
