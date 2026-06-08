# Cumbre — Entorno Local Firebase

Este directorio contiene la base local del futuro SaaS ERP Cumbre. El sitio WordPress de Gema Digital queda separado en `../wordpress/`.

## Objetivo

Levantar un entorno hermetico para pruebas locales con Firebase Emulator Suite:

- Auth Emulator: `localhost:9099`
- Firestore Emulator: `localhost:8080`
- Storage Emulator: `localhost:9199`
- Emulator UI: `http://localhost:4000`

## Primer arranque

Desde `cumbre/`:

```bash
npm install -g firebase-tools
firebase login
firebase emulators:start
```

Si preferimos no instalar globalmente, se puede usar `npx firebase-tools emulators:start`.

## Flujo diario

```bash
cd cumbre
npm run emulators
```

El SDK de `src/lib/firebaseConfig.ts` conecta a emuladores solo cuando detecta entorno local o `NODE_ENV=development`.

## Proyecto Firebase

El alias local apunta a:

```txt
cumbre-erp-prod
```

Antes de hacer deploy real hay que confirmar que ese proyecto exista en la cuenta de Google correcta. No desplegar reglas, indexes ni storage sin validar credenciales y entorno.

## Matriz Cumbre

La estructura inicial queda en dos zonas:

```txt
artifacts/{appId}/public/data/modulos_disponibles/{moduleId}
artifacts/{appId}/users/{tenantId}/suscripcion_modulos/config
```

Regla de seguridad base:

- El catalogo de modulos es publico para lectura.
- La escritura global queda reservada para usuarios con claim `admin`.
- Cada tenant solo lee/escribe su propia rama privada.

## Semillas

`seed/matriz-cumbre.seed.json` define datos iniciales para cargar manualmente o mediante un script futuro.

Todavia no hay script de importacion porque primero conviene decidir si vamos a usar Admin SDK, un script web contra emulador o fixtures exportados por Firebase.
