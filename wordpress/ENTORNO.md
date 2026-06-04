# WordPress — Entornos Gema Digital

## Local (desarrollo)

| Parámetro | Valor |
|-----------|--------|
| Motor | Studio by WordPress.com |
| URL | http://localhost:8881/ |
| Ruta instalación | `/Users/norbertosarlinga/Studio/gema-digital-local` |
| Base de datos | SQLite (integrada) |
| Admin | Ver `../00-datos de acceso/DATOS_DE_ACCESO.md` |

### Credenciales locales

No duplicar contraseñas en este repo. Copiar plantilla:

```bash
cp .env.example .env.local
# Completar desde 00-datos de acceso/
```

### Application Password (REST / MCP)

Usar la contraseña de aplicación documentada en la ficha maestra para integraciones Cursor ↔ WordPress.

## Producción

| Parámetro | Valor |
|-----------|--------|
| URL | https://gema-digital.com |
| Admin | https://gema-digital.com/wp-admin |
| Servidor | GCP VM `gema-web-server` — CyberPanel + OpenLiteSpeed |
| Caché | LiteSpeed + Redis + Memcached |

## Tema objetivo

**Child theme:** `gema-sovereign`  
Ubicación planificada en Studio:

`wp-content/themes/gema-sovereign/`

Fuente de diseño en este repo → copiar/sincronizar con script `scripts/sync-theme-to-studio.sh` (Fase 2).

## Plugins recomendados (stack marketing)

- Yoast SEO (keywords del CSV maestro)
- LiteSpeed Cache (prod)
- WP Mail SMTP (CyberPanel Cloud SMTP)
- Opcional: bloques personalizados o página builder acotado

## Próximo paso técnico

1. Crear tema hijo en Studio apuntando a tokens `brand/tokens/`
2. Registrar menús según `03-Silo contenido/gema-menus.cvs`
3. Importar 29 páginas con slugs del CSV
