# Manual de identidad — Gema Digital & ERP Cumbre

Versión 1.0 — Fase 1. Referencia para WordPress, Tailwind y materiales B2B.

---

## 1. Diferenciación de marcas

### Gema Digital (agencia)

- **Rol:** Nave nodriza — transformación digital, IA agéntica, desarrollo elite.
- **Tono:** Vanguardista, tecnológico, cyber-pro corporativo.
- **Audiencia:** CTOs, founders, equipos de innovación.

### ERP Cumbre (producto)

- **Rol:** Software transaccional de misión crítica.
- **Tono:** Profesional, financiero, indestructible.
- **Audiencia:** CFOs, contadores, directores de operaciones.
- **Competencia de referencia:** SAP, Tango, Odoo, NetSuite, Holded.

**Regla:** En el sitio WordPress, el shell global (header/footer) usa identidad **Gema Digital**. Las páginas de producto ERP destacan acentos **ERP Cumbre** (verde esmeralda, oro moderado).

---

## 2. Gema Digital — paleta

| Token | HEX | RGB | Uso |
|-------|-----|-----|-----|
| `gema-primary` | `#0B192C` | 11, 25, 44 | Fondos hero, header, confianza |
| `gema-secondary` | `#00F2FE` | 0, 242, 254 | IA, highlights, “gema” brillante |
| `gema-accent` | `#E2E8F0` | 226, 232, 240 | Texto secundario, fondos limpios |
| `gema-surface` | `#F8FAFC` | 248, 250, 252 | Fondos de página |
| `gema-on-primary` | `#FFFFFF` | 255, 255, 255 | Texto sobre primario |

### Tipografía Gema

| Rol | Familia | Fallback |
|-----|---------|----------|
| Títulos | Geist Sans | Inter Tight, system-ui |
| Cuerpo | Inter | system-ui, sans-serif |

### Isotipo

Dirección aprobada v2: monograma `G` sobrio, vectorial, con señales de red/IA y gema tecnológica. El logo original multicolor queda como referencia conceptual, no como versión final de lanzamiento.

**Archivos recomendados:**

- `brand/logos/gema-digital/logo-primary-v2.svg`
- `brand/logos/gema-digital/logo-wordmark-v2.svg`
- `brand/logos/favicons/favicon-gema-v2.svg`

---

## 3. ERP Cumbre — paleta

| Token | HEX | RGB | Uso |
|-------|-----|-----|-----|
| `cumbre-primary` | `#0F172A` | 15, 23, 42 | Integridad, dashboards |
| `cumbre-primary-alt` | `#1E293B` | 30, 41, 59 | Variante slate |
| `cumbre-secondary` | `#10B981` | 16, 185, 129 | Crecimiento, éxito, salud |
| `cumbre-accent` | `#F59E0B` | 245, 158, 11 | Alertas premium, CTA secundario (moderado) |
| `cumbre-on-primary` | `#F8FAFC` | 248, 250, 252 | Texto sobre oscuro |

### Tipografía Cumbre

| Rol | Familia | Fallback |
|-----|---------|----------|
| Títulos | Plus Jakarta Sans | Satoshi, system-ui |
| Datos / tablas | Roboto Mono | SF Mono, ui-monospace |

### Isotipo

Dirección aprobada v2: escudo institucional + montaña/gráfico financiero. Debe sentirse más robusto, contable y seguro que Gema Digital.

**Archivos recomendados:**

- `brand/logos/erp-cumbre/logo-primary-v2.svg`
- `brand/logos/erp-cumbre/logo-wordmark-v2.svg`
- `brand/logos/favicons/favicon-cumbre-v2.svg`

---

## 4. Bridge — Sovereign 4.0 (Stitch legacy)

Las maquetas existentes en `03-Silo contenido` usan **Sovereign 4.0**:

- Industrial Blue `#003366`
- Action Yellow `#FFD400`
- Geist + grid 8px

En WordPress migraremos gradualmente: **shell Gema Digital** + **componentes producto** con tokens Cumbre donde aplique (tarjetas ERP, comparativas, precios).

---

## 5. CSS

Importar en tema hijo:

```css
@import '../../brand/tokens/colors.css';
@import '../../brand/tokens/typography.css';
```

Variables disponibles como `--gema-*`, `--cumbre-*`, `--sovereign-*`.

---

## 6. Logos raster (fuente oficial)

Copia de trabajo en Drive:

`01-Pagina Web/02-Logos/`

- `Sin Fondo/` — web y overlays
- `Fondo blando/` — presentaciones
- `virjos/` — exploraciones Gemini

Los PNG originales son fuente histórica y referencia de concepto. Para nuevas pantallas usar los SVG v2, salvo que se necesite comparar contra el logo previo.

---

## 7. Accesibilidad

- Contraste mínimo WCAG AA en texto body (4.5:1).
- `#00F2FE` sobre blanco: usar solo en elementos grandes o con texto oscuro adyacente.
- CTA principal sitio: amarillo Sovereign `#FFD400` o cyan Gema según sección — un solo estilo primario por vista.

---

## 8. Próximos entregables (Fase 1)

1. Aprobación de isotipos SVG vs PNG existentes  
2. Favicon set en `brand/logos/favicons/`  
3. Variables en `theme.json` del tema hijo WordPress  

---

## 9. Decisiones de marca

Ver `brand/decisions/001-identidad-logo-v2.md`.

Preview local: `brand/previews/logos-v2.html`.
