# Workflow con v0

Cuenta/proyecto:

`https://v0.app/info-66077108s-projects`

## Cuándo usar v0

Usar v0 cuando convenga generar o comparar rápidamente:

- Layouts visuales de landing pages.
- Hero sections, headers, footers y cards.
- Variantes responsive.
- UI de secciones comerciales con estética pulida.
- Componentes React/Tailwind que luego se adapten a WordPress.

No usar v0 como fuente final de arquitectura, SEO, contenido, seguridad, datos, deploy o decisiones WordPress. Es una herramienta de diseño visual rápido.

## Regla de colaboración

Si una tarea es principalmente visual, pedirle al usuario que la ejecute en v0 y que traiga el resultado o captura. Luego se adapta en Cursor al tema `gema-sovereign`.

## Identidad a respetar

- Isotipo GEMA: usar la forma original.
- Sigla: `Gestion · Empresas · Marketing · Automatizacion`.
- Fondo día: blanco.
- Fondo dark: azul profundo `#08213F`.
- En dark, el isotipo debe ir con fondo/círculo blando blanco.
- La Home debe sentirse amigable-profesional, no corporativa fría.
- Las secciones corporativas pueden ser más formales.
- Las secciones Gema Negocios pueden ser más cálidas.

## Primer prompt recomendado para v0

```text
Diseña una landing page hero para Gema Digital, una empresa de Gestion, Empresas, Marketing y Automatizacion.

Objetivo visual:
- Marca amigable-profesional, tecnológica, clara y confiable.
- Debe servir tanto para clientes corporativos como para negocios y comercios.
- Fondo principal modo día blanco con aire y componentes claros.
- Incluir variante dark con fondo azul profundo #08213F.
- En dark, el isotipo/logo debe ir sobre un fondo circular blanco/blando para evitar problemas de contraste.

Logo:
- Usar un placeholder de isotipo circular a la izquierda. El isotipo real será la G multicolor de nodos.
- No redibujar la forma del isotipo.
- Al lado usar texto GEMA con fuente fina/moderna, no ultra bold.
- Debajo o al lado usar: Gestion · Empresas · Marketing · Automatizacion.

Contenido hero:
Título principal:
Software, IA y gestión empresarial para empresas reales.

Subtítulo:
Gema Digital ayuda a empresas, comercios y emprendedores a ordenar su operación, automatizar procesos y crecer con tecnología confiable.

CTA primario:
Solicitar diagnóstico

CTA secundario:
Ver soluciones

Secciones visibles en el primer scroll:
- Gema Negocios: para comercios y emprendedores.
- ERP Cumbre: software de gestión empresarial.
- IA Productiva: automatización, agentes y observabilidad.

Estilo:
- Bordes redondeados.
- Cards limpias.
- Iconografía simple.
- Mucho espacio blanco.
- Paleta basada en azul profundo, cian, verde, amarillo y rojo/naranja del isotipo.
- Responsive mobile-first.

Entrega:
- Genera componentes React con Tailwind.
- Mantén el código simple y fácil de trasladar a WordPress.
```

## Qué traer de v0

Cuando v0 genere algo útil, traer:

- Link del resultado.
- Captura.
- Código React/Tailwind si está disponible.
- Qué opción gustó más y qué no.

Luego se convierte a:

- bloques/patrones WordPress,
- CSS del tema hijo,
- plantillas `front-page.html` o partes reutilizables.
