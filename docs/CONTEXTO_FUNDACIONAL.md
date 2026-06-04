# Contexto fundacional — Gema Digital

Documento saneado para orientar decisiones de arquitectura, contenido y diseño.

## Fuente fundacional

Archivo leído:

`../../00-Datos de Empresa/00-Primeros pasos/Piedra Fundamental.pdf`

## Concepto central

Gema Digital se construye alrededor de una tesis clara: la IA dejó de ser experimentación y pasó a ser infraestructura de producción. El sitio y el producto deben comunicar ingeniería real para operar IA con calidad, trazabilidad, seguridad y eficiencia de costos.

La narrativa técnica se apoya en:

- Observabilidad profunda de IA en producción: trazas, latencia, costos, prompts, respuestas y llamadas a herramientas.
- Evaluaciones continuas: definir qué es una buena respuesta y bloquear regresiones antes de afectar usuarios.
- Brainstore: base de datos optimizada para trazas de IA, con búsqueda y escritura más rápidas que bases tradicionales para este tipo de carga.
- RAG y salidas estructuradas: reducir alucinaciones y conectar los modelos con datos propietarios.
- Agentes autónomos: sistemas capaces de descomponer tareas, usar herramientas y operar flujos complejos.
- Forward Deployed Engineering: ingenieros integrados en el cliente para convertir estrategia de IA en implementación real.
- Seguridad empresarial: RBAC, SSO/SAML, cumplimiento y posibilidad de despliegues híbridos.
- Optimización de costos: prompt caching, arquitectura eficiente y control de consumo.

## Traducción al proyecto web

El sitio WordPress debe vender confianza técnica, no solo diseño. Cada landing debe mostrar que Gema Digital entiende la diferencia entre una demo de IA y un sistema productivo confiable.

Lineamientos de contenido:

- Hablar de producción, observabilidad, seguridad y costos con precisión.
- Evitar promesas vagas de IA; explicar mecanismos concretos: evals, RAG, trazas, agentes, caching, RBAC.
- Mantener dos marcas diferenciadas:
  - Gema Digital: agencia de tecnología, IA y desarrollo elite.
  - ERP Cumbre: producto SaaS transaccional, financiero y robusto.
- Usar el caso local argentino como ventaja: ARCA, facturación, bancos, Mercado Libre, comercios y holdings.

## Datos públicos de contacto

Fuente: `../00-datos de acceso/DATOS_DE_ACCESO.md`, JSON-LD y landings Stitch.

- Nombre comercial: Gema / Gema Digital ERP
- Sitio oficial: `https://gema-digital.com`
- Teléfono comercial: `0800 345 4474`
- WhatsApp / celular corporativo: `+54 9 11 6598-0069`
- WhatsApp link: `https://wa.me/5491165980069`
- Email principal: `info@gema-digital.com`
- Email comercial: `ventas@gema-digital.com`
- Email técnico / redes: `redes@gema-digital.com`
- Email directivo: `norberto@gema-digital.com`

## Redes oficiales

- Facebook: `https://www.facebook.com/gema.digital.erp/`
- LinkedIn: `https://www.linkedin.com/company/gema-digital-erp`
- Instagram: `https://www.instagram.com/gema.digital.erp/`
- YouTube: `https://www.youtube.com/@gema_digital_erp`
- TikTok: `https://www.tiktok.com/@gestiongema`
- Google Business / reviews: `https://g.page/r/CRUtSuexEpbwEBM/review`

## Datos estructurados recomendados

Base actual encontrada en `../03-Silo contenido/gemini-code-1780321660733.json`:

- `Organization`: Gema Digital
- `WebSite`: gema-digital.com
- `ContactPoint`: atención general y ventas
- `sameAs`: redes sociales oficiales

Usar esta fuente para generar Schema.org en WordPress, evitando duplicados entre plugins SEO y plantillas.

## Fuentes de verdad operativas

- Contenido SEO: `../03-Silo contenido/base_de_datos_master.csv`
- Menús e interlinks: `../03-Silo contenido/gema-menus.cvs`
- Diseños HTML: `../03-Silo contenido/30) Paginas creadas en stritch/`
- Design system heredado: `../03-Silo contenido/30) Paginas creadas en stritch/sovereign_4.0/DESIGN.md`
- Logos oficiales raster: `../02-Logos/`
- Credenciales privadas: `../00-datos de acceso/`

## Regla de seguridad

No copiar ni versionar credenciales, contraseñas, tokens, claves SMTP, claves Google, accesos de WordPress, CyberPanel o GCP dentro de este repositorio.

En documentación del proyecto, exponer solo datos públicos de marca y contacto.

## Implicancia para la Fase 2

La Home debe presentar tres mensajes desde el primer scroll:

1. Gema Digital desarrolla infraestructura real de IA y gestión empresarial.
2. ERP Cumbre es el producto SaaS robusto para operación financiera/contable.
3. La ventaja competitiva está en IA productiva: observabilidad, agentes, Brainstore, RAG, seguridad y costos controlados.
