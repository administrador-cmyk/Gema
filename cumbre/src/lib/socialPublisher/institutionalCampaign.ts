import type { SocialNetwork, SocialPostDraft } from "./types";

export type CampaignChannel = SocialNetwork | "google_business";

export interface InstitutionalCampaignPost {
  id: string;
  day: number;
  title: string;
  pillar: string;
  url: string;
  suggestedChannels: CampaignChannel[];
  body: string;
  shortBody: string;
  visualPrompt: string;
  hashtags: string[];
}

const baseUrl = "https://gema-digital.com";

const commonHashtags = [
  "GEMADigital",
  "ERPCumbre",
  "SoftwareDeGestion",
  "PyMEs",
  "GestionEmpresarial",
  "Automatizacion",
  "Argentina",
];

function withUtm(url: string, network: SocialNetwork): string {
  const separator = url.includes("?") ? "&" : "?";
  return `${url}${separator}utm_source=${network}&utm_medium=social&utm_campaign=contenido_institucional_20`;
}

export const institutionalCampaignPosts: InstitutionalCampaignPost[] = [
  {
    id: "gema-digital-nace-para-ordenar",
    day: 1,
    title: "GEMA Digital nace para ordenar empresas reales",
    pillar: "Identidad GEMA",
    url: `${baseUrl}/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube", "google_business"],
    body:
      "GEMA Digital nace para acompanar a comercios, PyMEs y empresas que quieren crecer sin vivir apagando incendios. Integramos gestion, marketing, automatizacion, software e inteligencia artificial para que cada negocio pueda ver mejor sus ventas, stock, cobros, clientes y proximas decisiones.",
    shortBody:
      "Somos GEMA Digital: gestion, marketing, automatizacion, software e IA para que comercios y PyMEs trabajen con mas orden y menos herramientas sueltas.",
    visualPrompt:
      "Portada institucional con logo GEMA Digital, fondo claro, frase 'Orden para crecer' y tres bloques visuales: Gestion, Marketing, Automatizacion.",
    hashtags: commonHashtags,
  },
  {
    id: "que-es-erp-cumbre",
    day: 2,
    title: "Que es ERP Cumbre",
    pillar: "ERP Cumbre",
    url: `${baseUrl}/erp-cumbre/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube", "google_business"],
    body:
      "ERP Cumbre es el ecosistema de gestion de GEMA Digital para conectar ventas, clientes, stock, cobros, facturacion, reportes y automatizaciones. No se trata solo de tener un sistema: se trata de que la informacion importante deje de estar perdida, duplicada o atrasada.",
    shortBody:
      "ERP Cumbre conecta ventas, clientes, stock, cobros, facturacion, reportes e IA para que la empresa trabaje con mas claridad.",
    visualPrompt:
      "Diagrama simple con ERP Cumbre al centro y modulos conectados alrededor: CRM, POS, Cobros, Facturacion, Reportes, IA.",
    hashtags: [...commonHashtags, "ERP", "CRM"],
  },
  {
    id: "menos-carga-mental-dueno",
    day: 3,
    title: "Menos carga mental para el dueno de negocio",
    pillar: "Transformacion cotidiana",
    url: `${baseUrl}/contacto/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube"],
    body:
      "El dueno no deberia ser el sistema de gestion. Cuando ventas, cobros, stock y clientes dependen de memoria, el negocio se vuelve pesado. GEMA y ERP Cumbre buscan ordenar la informacion para que decidir, delegar y crecer sea mas claro.",
    shortBody:
      "El dueno no deberia cargar en la cabeza ventas, cobros, stock y pendientes. ERP Cumbre ordena datos para devolver claridad.",
    visualPrompt:
      "Composicion antes/despues: a la izquierda 'todo en mi cabeza', a la derecha tablero ordenado de ventas, cobros y stock.",
    hashtags: [...commonHashtags, "Emprendedores", "Negocios"],
  },
  {
    id: "orden-operativo-diario",
    day: 4,
    title: "Del caos operativo al orden diario",
    pillar: "Gestion y procesos",
    url: `${baseUrl}/erp-cumbre/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube"],
    body:
      "La transformacion aparece en la rutina: saber que cliente llamar, que presupuesto responder, que cobro ingreso, que producto reponer y como cerrar el dia con informacion confiable. ERP Cumbre fue pensado para ordenar ese trabajo cotidiano.",
    shortBody:
      "La transformacion empieza en lo diario: clientes, presupuestos, cobros, stock y proximas acciones en un flujo mas claro.",
    visualPrompt:
      "Checklist operativo diario con ticks sobre Clientes, Presupuestos, Cobros, Stock y Reportes.",
    hashtags: [...commonHashtags, "Procesos", "Productividad"],
  },
  {
    id: "crm-conectado-negocio-real",
    day: 5,
    title: "CRM conectado al negocio real",
    pillar: "CRM y ventas",
    url: `${baseUrl}/cumbre-crm/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube"],
    body:
      "Un CRM no deberia ser solo una lista de contactos. Para una PyME, vender implica responder, presupuestar, consultar catalogo, coordinar entrega, cobrar, facturar y volver a contactar. Cumbre CRM conecta seguimiento comercial con operacion real.",
    shortBody:
      "CRM no es cargar contactos: es seguir oportunidades, presupuestos, cobros y proximas acciones con contexto.",
    visualPrompt:
      "Flujo visual lead -> presupuesto -> catalogo -> cobro -> entrega -> seguimiento, con estilo limpio y profesional.",
    hashtags: [...commonHashtags, "CRM", "Ventas"],
  },
  {
    id: "pos-comercios-mostrador",
    day: 6,
    title: "POS y mostrador con mas control",
    pillar: "POS y comercios",
    url: `${baseUrl}/cumbre-erp-negocios/`,
    suggestedChannels: ["facebook", "instagram", "x", "pinterest", "youtube", "google_business"],
    body:
      "En un comercio, cada minuto cuenta. El mostrador necesita precios claros, stock actualizado, caja ordenada, medios de cobro controlados y cierre diario confiable. Cumbre ERP Negocios esta pensado para esa operacion diaria.",
    shortBody:
      "Para comercios: caja, precios, stock, cobros y cierre diario con mas orden.",
    visualPrompt:
      "Mostrador moderno con iconos de caja, stock, cobro y cierre diario; estetica GEMA, colores sobrios.",
    hashtags: [...commonHashtags, "POS", "Comercios"],
  },
  {
    id: "cobros-trazabilidad",
    day: 7,
    title: "Cobrar, registrar y conciliar",
    pillar: "Cobros y administracion",
    url: `${baseUrl}/erp-cumbre/cumbre-cobros/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube"],
    body:
      "Cobrar no termina cuando el cliente paga. Despues hay que registrar, verificar, conciliar, asociar a una venta y saber que quedo pendiente. Cumbre Cobros parte de una idea simple: el dinero necesita trazabilidad.",
    shortBody:
      "Cobrar no es solo recibir plata. Es registrar, verificar, conciliar y saber que queda pendiente.",
    visualPrompt:
      "Recorrido visual pago -> comprobante -> registro -> conciliacion -> pendiente resuelto.",
    hashtags: [...commonHashtags, "Cobros", "Administracion"],
  },
  {
    id: "facturacion-arca-controlada",
    day: 8,
    title: "Facturacion conectada al flujo administrativo",
    pillar: "Facturacion y cumplimiento",
    url: `${baseUrl}/erp-cumbre/cumbre-facturador-arca/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest"],
    body:
      "Facturar no deberia ser una isla separada del negocio. La vision de Cumbre es que la facturacion se integre con cliente, venta, cobro, comprobante, estado y trazabilidad, siempre con implementacion asistida y cumplimiento segun el caso.",
    shortBody:
      "Facturacion conectada al negocio: cliente, venta, cobro, comprobante y trazabilidad.",
    visualPrompt:
      "Triangulo conectado entre Venta, Cobro y Facturacion, con lineas de trazabilidad y sello de control.",
    hashtags: [...commonHashtags, "Facturacion", "ARCA"],
  },
  {
    id: "ia-productiva-supervisada",
    day: 9,
    title: "IA productiva con supervision humana",
    pillar: "IA y automatizacion",
    url: `${baseUrl}/ia-productiva/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube"],
    body:
      "En GEMA creemos que la inteligencia artificial debe ser productiva, medible y supervisada. Puede resumir informacion, detectar pendientes, sugerir acciones y reducir tareas repetitivas, pero el criterio humano sigue siendo central.",
    shortBody:
      "IA para trabajar mejor: resumir, sugerir, detectar pendientes y automatizar con supervision humana.",
    visualPrompt:
      "Persona revisando un tablero junto a un asistente IA abstracto, con indicadores de control y aprobacion humana.",
    hashtags: [...commonHashtags, "IA", "InteligenciaArtificial"],
  },
  {
    id: "marketing-medible",
    day: 10,
    title: "Marketing que se puede medir",
    pillar: "Marketing y medicion",
    url: `${baseUrl}/marketing-digital/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube", "google_business"],
    body:
      "Marketing sin medicion se vuelve intuicion. GEMA conecta estrategia, contenido, SEO, GEO, Google Tag Manager, Analytics, CRM y automatizaciones para entender que atrae consultas, que convierte y que debe mejorarse.",
    shortBody:
      "Publicar esta bien. Medir es mejor. GEMA conecta marketing, web, CRM, GTM, Analytics y automatizacion.",
    visualPrompt:
      "Dashboard de marketing con fuentes de trafico, consultas, conversiones y ventas; estetica profesional.",
    hashtags: [...commonHashtags, "MarketingDigital", "SEO", "Analytics"],
  },
  {
    id: "menos-herramientas-sueltas",
    day: 11,
    title: "Menos herramientas sueltas",
    pillar: "Integracion",
    url: `${baseUrl}/erp-cumbre/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest"],
    body:
      "Muchas empresas no estan atrasadas por falta de herramientas, sino saturadas por herramientas que no se hablan entre si. ERP Cumbre busca integrar la informacion importante para que la tecnologia deje de fragmentar el trabajo.",
    shortBody:
      "No siempre faltan herramientas. Muchas veces sobran herramientas desconectadas.",
    visualPrompt:
      "Iconos dispersos de WhatsApp, planillas, pagos, stock y reportes que se conectan en un unico tablero Cumbre.",
    hashtags: [...commonHashtags, "Integraciones", "ERP"],
  },
  {
    id: "delegar-sin-perder-control",
    day: 12,
    title: "Delegar sin perder control",
    pillar: "Roles y equipos",
    url: `${baseUrl}/contacto/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest"],
    body:
      "Delegar no significa perder control. Para que un equipo crezca necesita procesos claros, informacion compartida, permisos, seguimiento y reportes confiables. ERP Cumbre ayuda a ordenar responsabilidades y pendientes.",
    shortBody:
      "Delegar mejor: roles claros, informacion compartida, seguimiento y reportes confiables.",
    visualPrompt:
      "Organigrama simple conectado a un tablero central con roles, permisos y pendientes.",
    hashtags: [...commonHashtags, "Equipos", "Gestion"],
  },
  {
    id: "reportes-para-decidir",
    day: 13,
    title: "Reportes para decidir, no para decorar",
    pillar: "Datos y BI",
    url: `${baseUrl}/erp-cumbre/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube"],
    body:
      "Un reporte sirve cuando ayuda a decidir: cuanto vendimos, que canal trajo consultas, que cliente esta pendiente, que producto rota mas y que cobro falta conciliar. Los datos deben convertirse en decisiones.",
    shortBody:
      "Un reporte sirve si responde preguntas reales: ventas, clientes, cobros, stock y canales.",
    visualPrompt:
      "Dashboard ejecutivo con pregunta central 'Que hacemos ahora?' y metricas simples de ventas, clientes y cobros.",
    hashtags: [...commonHashtags, "Datos", "BusinessIntelligence"],
  },
  {
    id: "whatsapp-seguimiento-real",
    day: 14,
    title: "Del WhatsApp al seguimiento real",
    pillar: "WhatsApp y CRM",
    url: `${baseUrl}/erp-cumbre/cumbre-whatsapp-hub/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube"],
    body:
      "WhatsApp es clave para vender y atender, pero cuando todo queda solo en chats la empresa pierde seguimiento. La vision de Cumbre es conectar conversacion, cliente, presupuesto y proxima accion con trazabilidad.",
    shortBody:
      "WhatsApp vende. Cumbre busca que no se pierdan oportunidades, presupuestos ni proximas acciones.",
    visualPrompt:
      "Chat de WhatsApp que se transforma en ficha de cliente, presupuesto y tarea de seguimiento.",
    hashtags: [...commonHashtags, "WhatsApp", "CRM"],
  },
  {
    id: "implementacion-asistida",
    day: 15,
    title: "Implementacion asistida",
    pillar: "Acompanamiento",
    url: `${baseUrl}/contacto/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "google_business"],
    body:
      "Implementar tecnologia no es instalar y listo. Cada empresa tiene procesos, personas, urgencias y datos heredados. GEMA propone diagnostico, prioridades, configuracion, capacitacion y mejora progresiva.",
    shortBody:
      "No es instalar y listo. GEMA acompana diagnostico, configuracion, capacitacion y mejora progresiva.",
    visualPrompt:
      "Camino de cinco pasos: Diagnostico, Prioridad, Configuracion, Capacitacion y Mejora.",
    hashtags: [...commonHashtags, "Implementacion", "Consultoria"],
  },
  {
    id: "tecnologia-con-criterio-humano",
    day: 16,
    title: "Tecnologia con criterio humano",
    pillar: "Cultura GEMA",
    url: `${baseUrl}/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube"],
    body:
      "La tecnologia sirve cuando entiende a las personas que la usan. En GEMA pensamos el software como una herramienta para que equipos reales trabajen mejor: menos friccion, menos doble carga y mas claridad.",
    shortBody:
      "Tecnologia con criterio humano: software, automatizacion e IA para que equipos reales trabajen mejor.",
    visualPrompt:
      "Equipo de trabajo mirando un tablero simple con frase 'Tecnologia que acompana', estilo institucional cercano.",
    hashtags: [...commonHashtags, "Tecnologia", "TransformacionDigital"],
  },
  {
    id: "crecer-sin-perder-trazabilidad",
    day: 17,
    title: "Crecer sin perder trazabilidad",
    pillar: "Escalabilidad",
    url: `${baseUrl}/erp-cumbre/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest"],
    body:
      "Crecer es bueno, pero crecer sin trazabilidad puede volverse peligroso. Mas ventas, clientes, cobros y tareas tambien significan mas posibilidades de error si no hay sistema. ERP Cumbre ayuda a crecer con registro y seguimiento.",
    shortBody:
      "Mas ventas sin trazabilidad pueden traer mas errores. ERP Cumbre ayuda a crecer con registro, estados y reportes.",
    visualPrompt:
      "Grafico de crecimiento sostenido por una base de procesos, estados, responsables y datos confiables.",
    hashtags: [...commonHashtags, "Crecimiento", "Trazabilidad"],
  },
  {
    id: "saber-que-hacer-despues",
    day: 18,
    title: "El valor de saber que hacer despues",
    pillar: "Proximas acciones",
    url: `${baseUrl}/prueba-gratis/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube"],
    body:
      "Una empresa no necesita solo saber que paso. Necesita saber que hacer despues: que cliente seguir, que presupuesto cerrar, que cobro revisar, que producto mirar y que canal reforzar.",
    shortBody:
      "No alcanza con saber que paso. El valor esta en saber que hacer despues.",
    visualPrompt:
      "Tablero con columna destacada 'Proxima accion' y tarjetas de cliente, cobro, presupuesto y stock.",
    hashtags: [...commonHashtags, "Productividad", "Ventas"],
  },
  {
    id: "socio-de-transformacion",
    day: 19,
    title: "GEMA como socio de transformacion",
    pillar: "Marca institucional",
    url: `${baseUrl}/contacto/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube", "google_business"],
    body:
      "GEMA Digital busca ser un socio de transformacion para empresas que quieren ordenar gestion, profesionalizar marketing, automatizar procesos y tomar mejores decisiones. ERP Cumbre representa esa vision conectando operacion, datos, personas e IA.",
    shortBody:
      "GEMA Digital: gestion, marketing, automatizacion, software e IA para empresas que quieren crecer con mas estructura.",
    visualPrompt:
      "Mapa de transformacion con etapas: Ordenar, Medir, Automatizar, Crecer.",
    hashtags: [...commonHashtags, "TransformacionDigital", "Consultoria"],
  },
  {
    id: "invitacion-diagnostico",
    day: 20,
    title: "Invitacion institucional a diagnostico",
    pillar: "Conversion",
    url: `${baseUrl}/contacto/`,
    suggestedChannels: ["facebook", "instagram", "linkedin", "x", "pinterest", "youtube", "google_business"],
    body:
      "Si tu empresa vende, cobra, atiende clientes, maneja stock, factura, publica contenido y toma decisiones todos los dias, necesita informacion ordenada. La transformacion empieza con una pregunta simple: que parte de tu negocio necesita mas claridad hoy?",
    shortBody:
      "Que parte de tu negocio necesita mas claridad hoy? GEMA Digital y ERP Cumbre pueden ayudarte a ordenar el camino.",
    visualPrompt:
      "CTA institucional con pregunta central 'Por donde empezamos?' y fondo con modulos de gestion conectados.",
    hashtags: [...commonHashtags, "Diagnostico", "PyMEs"],
  },
];

export function buildInstitutionalCampaignDrafts(networks: SocialNetwork[] = ["facebook", "linkedin", "pinterest", "x"]): SocialPostDraft[] {
  return institutionalCampaignPosts.flatMap((post) =>
    networks
      .filter((network) => post.suggestedChannels.includes(network))
      .map((network) => ({
        network,
        title: post.title,
        body: network === "x" || network === "instagram" ? post.shortBody : post.body,
        url: withUtm(post.url, network),
        hashtags: post.hashtags,
      })),
  );
}

export function buildFirstPublishingBatch(): SocialPostDraft[] {
  const firstPostIds = new Set([
    "gema-digital-nace-para-ordenar",
    "que-es-erp-cumbre",
    "menos-carga-mental-dueno",
    "cobros-trazabilidad",
    "marketing-medible",
  ]);

  return buildInstitutionalCampaignDrafts(["facebook", "linkedin", "pinterest", "x"]).filter((draft) =>
    institutionalCampaignPosts.some((post) => firstPostIds.has(post.id) && post.title === draft.title),
  );
}
