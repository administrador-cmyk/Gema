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
- [x] Definición del isotipo principal: forma original de GEMA
- [x] Kit operativo de logos en `../../00-Proyecto Gema/00-Logos`
- [x] Variantes `.png` y `.webp` para día, dark, texto, horizontal y redes
- [ ] Validación visual final del kit de logos

### Fase 2 — UI web (WordPress + Stitch)

- Sprint v0 para explorar Home/header/cards usando `docs/V0_WORKFLOW.md`
- Maquetación clave desde `03-Silo contenido/30) Paginas creadas en stritch/`
- Tema hijo `gema-sovereign` (bridge Sovereign 4.0 + nuevas paletas Gema/Cumbre)
- `tailwind.config.js` con presets `gema` y `cumbre`
- 29 landing pages según slugs del CSV maestro

### Fase 3 — Datos & seguridad (ERP)

- Firebase Emulator Suite local para ERP Cumbre
- Firestore multi-tenant con Matriz Cumbre modular
- Auditoría Claude Code en CI local
- Arquitectura faseada Cumbre: núcleo SaaS, Matriz/Billing, roles/permisos, auditoría, Brainstore, workers backend, Secret Manager, Tutoriales API, módulos base e integraciones.
- Plan maestro de ejecución Cumbre: inventario real, demo funcional interna, compuertas go/no-go, orden técnico de módulos base, tablero de validación y criterios de beta cerrada.
- Filosofía de construcción tipo edificio: arquitectura completa, cimientos auditados, columnas, vigas, instalaciones, pisos funcionales, terminaciones, inspección interna y beta cerrada.
- Blueprint `Cumbre Seguridad y Auditoría` para roles, permisos, secretos, aprobaciones, trazabilidad e implementadores autorizados.
- Prioridad antes de profundizar módulos insignia: CRM, Catálogo, Cobros, Facturador ARCA, Stock, Compras, Ventas, Tesorería, Contabilidad, Impuestos y Reportes BI.

### Fase 3B — Plataforma Cumbre operable

- Panel de control general por tenant.
- Activación/desactivación de módulos desde `config_suscripcion/modulos_billing`.
- Router de UI por Matriz Cumbre.
- Importador Universal.
- Workers backend para operaciones fiscales, cobros, stock, importaciones, notificaciones e integraciones.
- Blueprint `Cumbre Backend, Workers e Integraciones Seguras` para Cloud Run/API Gateway, webhooks, OAuth, colas, reintentos, dead letters, Secret Manager e idempotencia.
- Secretos externos por `credencial_ref`, nunca en WordPress ni Firestore.

### Fase 3C — Módulos insignia y verticales

- `Cumbre WhatsApp Hub` como comunicación transversal con API oficial Meta por cliente.
- `Cumbre Marketing` por fases: primero calendario, IA creativa, previews, aprobación y carga asistida; luego APIs oficiales; finalmente publicación automática y generación audiovisual avanzada.
- `Cumbre Prospección B2B` como social selling y outbound inteligente conectado a CRM, Marketing, Ventas y BI, con automatización responsable y control humano.
- Verticales sectoriales como empaquetados sobre módulos base, no como sistemas paralelos.

### Fase 4 — Ventas & despliegue

- Pitch deck B2B
- CI/CD → GCP (`gema-digital-web`)

## Stack

| Herramienta | Rol |
|-------------|-----|
| WordPress 7 + Studio | Sitio marketing local |
| v0.dev | Prototipos UI rápidos |
| Cursor | IDE / tema / automatización |
| Firebase / Firestore | ERP Cumbre modular + emuladores locales |
| GCP | Producción |
| Claude | Auditoría DevOps |

## Contenido

Inventario de páginas: `../03-Silo contenido/base_de_datos_master.csv`  
Menú: `../03-Silo contenido/gema-menus.cvs`
