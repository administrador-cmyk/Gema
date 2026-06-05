# Decisión 003 — Logo original como isotipo principal

Fecha: 2026-06-04

## Decisión

La forma original de la `G` de nodos multicolor se respeta y pasa a ser el isotipo principal de Gema Digital.

No se redibuja la forma, no se simplifica la estructura y no se reemplaza por otro monograma. El trabajo de identidad se enfoca en:

- Mejorar el contraste.
- Separar isotipo y texto.
- Crear uso correcto sobre fondo blanco y fondo azul oscuro.
- Mantener la gama de colores original como paleta de marca.

## Archivo oficial

- `brand/logos/gema-digital/original/gema-logo-original.png`
- `brand/logos/gema-digital/original/gema-logo-original-transparent.png` (uso web activo)
- `brand/logos/gema-digital/original/gema-logo-original-transparent-clean.png` (uso web recomendado)
- `brand/logos/gema-digital/original/gema-logo-original-soft-bg.png` (export con fondo azul-blanco suave)
- `brand/logos/gema-digital/original/gema-logo-original-light-gray-bg.png` (uso activo: negro reemplazado por gris claro)
- `brand/logos/gema-digital/original/gema-logo-original-no-black.png` (uso activo actual: fondo negro removido)
- `brand/logos/gema-digital/original/gema-logo-original-white-bg.png` (uso activo actual: negro reemplazado por blanco)

## Uso recomendado actual

Usar la forma del PNG original, pero con el fondo negro reemplazado por blanco:

- `brand/logos/gema-digital/original/gema-logo-original-white-bg.png`

No redibujar la forma de la `G`. El único ajuste permitido es el fondo blanco para evitar el negro incrustado.

## Variantes archivadas

### Fondo dia

- Fondo: blanco `#FFFFFF`.
- Usar isotipo original + texto oscuro renderizado en HTML/CSS o vector separado.

### Fondo dark

- Fondo: azul profundo `#08213F`.
- Usar isotipo original con el negro reemplazado por blanco, dentro de un fondo redondo blando si la composición lo necesita.
- Usar texto blanco renderizado en HTML/CSS.

## Motivo

El usuario prefiere la forma del logo original y la considera parte esencial de la identidad. La marca debe preservar esa memoria visual mientras mejora su implementación web.

## Nota de arquitectura

Para WordPress, el isotipo se usa como imagen PNG independiente y el nombre `GEMA` se renderiza como texto. La versión activa del tema debe usar `gema-logo-original-white-bg.png`.
