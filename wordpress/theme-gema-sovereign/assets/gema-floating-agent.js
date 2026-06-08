(function () {
  const STORAGE_KEY = 'gema-agent-opened-v2';
  const API_ENDPOINT = 'https://nnwebhooknn.generatuenergia-n8n.com/gema-agent/public/web-agent/chat';
  const lead = {
    name: '',
    phone: '',
    email: '',
    need: ''
  };

  const responses = {
    erp: 'ERP Cumbre ayuda a PyMEs argentinas a convertir consultas, productos, presupuestos, cobros y facturas en un solo flujo operativo. El foco inicial recomendado son empresas B2B que presupuestan en USD, cobran en ARS, manejan stock/proveedores y necesitan avanzar hacia facturación ARCA con piloto controlado.',
    crm: 'Cumbre CRM es el tronco comercial de Cumbre ERP: ordena consultas, leads, clientes, pipeline, presupuestos, cobros y próximas acciones. No es un CRM aislado; conecta Catálogo, Cobros, Stock, Facturación ARCA en piloto controlado, Panel y Asistente Guiado. Podés ver la landing SEO en /cumbre-crm.',
    diagnostico: 'Puedo analizar tu necesidad y sugerir una combinación de soluciones. Contame rubro, cantidad de usuarios, qué sistema usás hoy, cómo vendés, cómo cobrás y cuál es el problema más urgente.',
    arquitectura_cumbre: 'Para elegir módulos de Cumbre conviene pensar por intención: empezar con CRM, ERP Negocios, ERP PyMEs o Cumbre Empresas; ordenar operación diaria con Ventas, Catálogo, Stock, Compras, Cobros y Facturador ARCA; controlar administración con Tesorería, Contabilidad, Impuestos, BI, Planificación, Activos Fijos y Personal; crecer con WhatsApp Hub, Marketing, Web, Automatizaciones y API; o entrar por rubro con Kioscos, Resto, WMS, Constructoras, Agro y Mercados. El hub está en /erp-cumbre y las FAQs en /faqs.',
    faqs: 'El centro de FAQs reúne respuestas sobre ERP Cumbre, módulos, precios, implementación, Facturador ARCA, Cobros, seguridad, legal, IA y el agente comercial. Podés verlo en /faqs o preguntarme directamente tu caso.',
    portales: 'Estamos preparando un portal por módulo de Cumbre, por ejemplo cobros.gema-digital.com, crm.gema-digital.com, pymes.gema-digital.com o tesoreria.gema-digital.com. Mientras DNS queda pendiente, la landing principal de CRM vive en /cumbre-crm y el resto de landings internas en /cumbre/{modulo}.',
    catalogo: 'Cumbre Catálogo es la fuente única de productos, servicios, combos e insumos: precios bimonetarios, IVA, stock, proveedores, ingesta multimodal y conexión con CRM, presupuestos, facturación, cobros, compras y eCommerce.',
    stock: 'Cumbre Stock controla inventario con IA, trazabilidad y aprobación humana. Permite stock por depósito, saldos actual/reservado/disponible/mínimo, ingesta de PDFs, imágenes, remitos, facturas, planillas, emails o WhatsApp, cotejo contra Catálogo, bandeja de aprobación y alertas por panel, email o WhatsApp con opt-in. Landing: /erp-cumbre/cumbre-stock.',
    compras: 'Cumbre Compras ayuda a comprar mejor, reponer a tiempo y evitar quiebres de stock. Gestiona proveedores, solicitudes de reposición, comparador, órdenes de compra y recepción de mercadería conectada a Stock, Catálogo, ventas, eCommerce y Mercado Libre. La IA puede sugerir cantidades y proveedores, pero ninguna compra se envía sin revisión y aprobación humana. Landing: /erp-cumbre/cumbre-compras.',
    tutoriales_api: 'Tutoriales API Cumbre guía al usuario paso a paso para conectar plataformas externas como Mercado Libre, Mercado Pago, WooCommerce, Google Merchant, ARCA, WhatsApp Business y WordPress. Ayuda a obtener credenciales, configurar permisos, validar webhooks y probar conexiones sin guardar claves sensibles en claro. Landing: /erp-cumbre/tutoriales-api-cumbre.',
    facturador: 'Cumbre Facturador ARCA es el módulo fiscal y documental de ERP Cumbre para facturas A/B/C, notas, remitos, recibos y documentación comercial. No se vende como emisión automática directa desde el frontend: trabaja con emisión controlada, backend seguro, validación fiscal, worker ARCA, CAE o errores trazables e implementación asistida. Landing: /erp-cumbre/cumbre-facturador-arca.',
    panel: 'Cumbre contempla Panel de Control y Asistente Guiado: módulos activos, trial de 14 días, alertas, billing, Gema Pagos como integración en desarrollo, checklist contextual y próxima mejor acción por módulo.',
    negocios: 'Cumbre ERP Negocios es el paquete económico de entrada para comercios de mostrador: kioscos, almacenes, mercados, restaurantes chicos, casas de comida y depósitos simples. Ayuda a vender con POS simple, abrir y cerrar caja, controlar stock, precios, márgenes y reposición diaria. No es un ERP empresarial grande: se empieza con lo esencial y se suman usuarios, cajas, locales, submódulos, Cumbre Cobros o Facturador ARCA controlado según crecimiento. Landing: /cumbre-erp-negocios.',
    legal: 'Cumbre Legal ayuda a crear, organizar y controlar documentos legales de la empresa con IA, datos reales del negocio, fuentes normativas verificables, checklist, vencimientos y trazabilidad. No es un estudio jurídico ni reemplaza a un abogado matriculado: genera borradores asistidos por IA preparados para revisión profesional. Landing: /erp-cumbre/cumbre-legal.',
    marketing: 'GEMA Negocios y Marketing ayudan a comercios y PyMEs con web, redes, SEO/GEO, campañas, contenido, automatización de leads y acompañamiento comercial. Es un servicio de crecimiento, distinto del paquete Cumbre ERP Negocios para caja, stock y mostrador.',
    ia: 'IA Productiva permite automatizar respuestas, seguimiento comercial, tareas internas, WhatsApp, análisis de datos y procesos repetitivos. Siempre recomendamos mantener derivación humana para ventas complejas.',
    cobros: 'Cumbre Cobros permite cobrar con links de pago, QR, transferencias, tarjetas, billeteras, efectivo/manual, webhooks, conciliación, panel cliente y auditoría. Cumbre no cobra comisión por transacción: el cliente paga un abono fijo por el sistema. Si usa Mercado Pago, Payway, MODO, Stripe, PayPal u otra pasarela externa, esa pasarela puede cobrar sus propios aranceles. Landing: /erp-cumbre/cumbre-cobros.',
    tesoreria: 'Cumbre Tesorería centraliza bancos, billeteras virtuales, caja, movimientos, conciliaciones, pagos a proveedores y cashflow. Importa movimientos por API, agregadores o extractos CSV/XLSX/OFX/PDF según alcance, sin pedir passwords de home banking. La conciliación es asistida, con confirmación humana y credenciales seguras tipo Secret Manager. Landing: /erp-cumbre/cumbre-tesoreria.',
    contabilidad: 'Cumbre Contabilidad convierte ventas, compras, cobros, pagos y movimientos en plan de cuentas, asientos, cierres, libros, IVA, reportes y exportación para contador. No reemplaza al contador: prepara información trazable y revisable, con asientos borrador, validados y definitivos solo después de revisión. Landing: /erp-cumbre/cumbre-contabilidad.',
    impuestos: 'Cumbre Impuestos ordena IVA, IIBB, retenciones, percepciones, saldos, vencimientos fiscales y reportes exportables para revisar con tu contador. No reemplaza al contador ni presenta impuestos automáticamente: consolida información fiscal, alerta vencimientos y deja trazabilidad desde Facturador ARCA, Contabilidad, Compras, Cobros y Tesorería. Landing: /erp-cumbre/cumbre-impuestos.',
    reportes_bi: 'Cumbre Reportes BI convierte los datos de Cumbre ERP en dashboards, KPIs, alertas ejecutivas y reportes gerenciales. No duplica información ni reemplaza módulos fuente: toma referencias y snapshots de CRM, ventas, cobros, stock, compras, tesorería, contabilidad, impuestos, eCommerce y Mercado Libre. Las alertas críticas requieren revisión humana. Landing: /erp-cumbre/cumbre-reportes-bi.',
    planificacion: 'Cumbre Planificación y Proyecciones permite crear presupuestos internos, simular escenarios, proyectar caja, usar forecast asistido y comparar real vs plan con datos reales de Ventas, Compras, Tesorería, Contabilidad, Impuestos, Stock y Reportes BI. No es el presupuesto comercial del CRM: sirve para dirigir y requiere revisión humana en decisiones críticas. Landing: /erp-cumbre/cumbre-planificacion.',
    activos_fijos: 'Cumbre Activos Fijos administra bienes de uso y patrimonio de la empresa: altas, ubicación, responsable, amortización lineal, mantenimiento, bajas y trazabilidad contable. No reemplaza Stock ni crea inventario vendible paralelo; las amortizaciones definitivas y bajas contabilizadas requieren revisión humana y contable. Landing: /erp-cumbre/cumbre-activos-fijos.',
    whatsapp_hub: 'Cumbre WhatsApp Hub conecta CRM, Cobros, Stock, Compras, Tesorería, Impuestos, Reportes BI, Planificación, eCommerce y otros módulos con WhatsApp Business Cloud API. Cada cliente usa su propia API oficial de Meta, con opt-in, plantillas aprobadas, webhooks seguros, credencial_ref y derivación humana para acciones críticas. Landing: /erp-cumbre/cumbre-whatsapp-hub.',
    personal: 'Cumbre Personal ordena legajos digitales, asistencia, ausencias, licencias, novedades de liquidación, documentos laborales y costos de personal conectados al ERP. No reemplaza contador, abogado laboralista ni asesor profesional; prepara información revisable con permisos y auditoría. Landing: /erp-cumbre/cumbre-personal.',
    cumbre_marketing: 'Cumbre Marketing crea segmentos, audiencias, campañas por WhatsApp/email/anuncios y atribución usando datos reales de CRM, eCommerce, Cobros y WhatsApp Hub. Requiere consentimiento, opt-in y credenciales seguras; no promete resultados comerciales garantizados. Landing: /erp-cumbre/cumbre-marketing.',
    automatizaciones: 'Cumbre Automatizaciones permite crear workflows seguros dentro del ERP con triggers, condiciones, acciones, webhooks, idempotencia, auditoría y aprobaciones humanas. No ejecuta acciones críticas sin permisos y puede pausarse por módulo o tenant. Landing: /erp-cumbre/cumbre-automatizaciones.',
    cumbre_web: 'Cumbre Web conecta landings, formularios, eventos, SEO y conversiones con CRM, Marketing, WhatsApp Hub y Reportes BI. No publica sin aprobación ni promete ranking SEO garantizado; los formularios alimentan CRM sin contactos paralelos. Landing: /erp-cumbre/cumbre-web.',
    ventas_cumbre: 'Cumbre Ventas unifica POS, ventas digitales y ventas administrativas con Catálogo, Stock, Cobros, Facturador ARCA, CRM, eCommerce y Mercado Libre. No descuenta stock ni factura sin eventos trazables y permisos. Landing: /erp-cumbre/cumbre-ventas.',
    verticales: 'Cumbre también tiene verticales sectoriales sobre módulos existentes: Kioscos, Resto, Depósitos WMS, Constructoras, Agro y Mercados. Cada vertical empaqueta ventas, stock, cobros, WhatsApp, reportes y automatizaciones con guardrails del rubro. Landings: /erp-cumbre/cumbre-kioscos, /erp-cumbre/cumbre-resto, /erp-cumbre/cumbre-depositos-wms, /erp-cumbre/cumbre-constructoras, /erp-cumbre/cumbre-agro y /erp-cumbre/cumbre-mercados.',
    precios: 'No usamos un precio único porque cada empresa tiene procesos, usuarios, módulos e integraciones distintas. Primero hacemos diagnóstico, demo comercial o piloto controlado, y después preparamos una propuesta clara.',
    prueba: 'Sí. Cumbre contempla prueba de 14 días por módulo. Los datos cargados durante la prueba se conservan si la empresa pasa a plan pago. Las funciones ARCA/Gema Pagos requieren implementación asistida.',
    contacto: 'Puedo ayudarte a pedir contacto. Decime tu nombre, WhatsApp o teléfono, y qué necesitás resolver. También podés escribir a ventas@gema-digital.com.',
    ubicacion: 'GEMA Digital atiende en AMBA, Argentina y remoto para empresas de habla hispana. La oficina es con cita previa en Av. Alicia Moreau de Justo 740, CABA.',
    soporte: 'El soporte es personalizado. Primero intentamos resolver con el asistente y, si no alcanza, derivamos a una persona del equipo.',
    default: 'Te ayudo. Puedo orientarte sobre ERP Cumbre, GEMA Negocios, IA Productiva, automatizaciones, marketing, integraciones, precios o una reunión de diagnóstico. Contame qué necesitás resolver.'
  };

  const solutionSignals = [
    {
      name: 'ERP Cumbre PyMEs',
      reason: 'ordenar ventas, compras, stock, facturación, usuarios y reportes',
      words: ['erp', 'stock', 'inventario', 'facturacion', 'facturación', 'compras', 'ventas', 'sucursal', 'proveedores']
    },
    {
      name: 'Cumbre Cobros',
      reason: 'cobrar con links de pago, QR, transferencias, tarjetas, billeteras, webhooks, conciliación, panel cliente y 0% comisión Cumbre por transacción',
      words: ['cobro', 'cobros', 'pago', 'pagos', 'link de pago', 'links de pago', 'mercado pago', 'nave', 'modo', 'qr', 'transferencia', 'tarjeta', 'billetera', 'billeteras', 'posnet', 'pos', 'debin', 'coelsa', 'payway', 'fiserv', 'naranja', 'cuenta dni', 'uala', 'ualá', 'getnet', 'efectivo', 'cheque', 'webhook', 'webhooks', 'conciliacion', 'conciliación']
    },
    {
      name: 'Cumbre Tesorería',
      reason: 'controlar bancos, billeteras, caja, movimientos, conciliación asistida, pagos a proveedores y cashflow',
      words: ['banco', 'bancos', 'tesoreria', 'tesorería', 'conciliar', 'conciliacion', 'conciliación', 'caja', 'cashflow', 'flujo de caja', 'billetera', 'billeteras', 'home banking', 'extracto', 'extractos', 'ofx', 'csv', 'xlsx', 'movimiento bancario', 'movimientos bancarios', 'saldo', 'saldos', 'retenciones', 'comisiones', 'deuda', 'pago proveedor', 'pagos proveedores']
    },
    {
      name: 'Cumbre Contabilidad',
      reason: 'preparar plan de cuentas, asientos, cierres, libros, IVA, reportes y exportación para contador',
      words: ['contabilidad', 'contable', 'contador', 'contadora', 'estudio contable', 'plan de cuentas', 'asiento', 'asientos', 'libro diario', 'libro mayor', 'mayor', 'iva compras', 'iva ventas', 'sumas y saldos', 'sumas/saldos', 'balance', 'estado de resultados', 'centro de costo', 'centros de costo', 'cierre contable', 'cierres contables', 'exportacion contable', 'exportación contable']
    },
    {
      name: 'Cumbre Impuestos',
      reason: 'ordenar IVA, IIBB, retenciones, percepciones, saldos, vencimientos y reportes fiscales revisables',
      words: ['impuesto', 'impuestos', 'iva', 'iibb', 'ingresos brutos', 'retencion', 'retención', 'retenciones', 'percepcion', 'percepción', 'percepciones', 'posicion fiscal', 'posición fiscal', 'posiciones fiscales', 'vencimiento fiscal', 'vencimientos fiscales', 'calendario fiscal', 'saldo a pagar', 'saldos a pagar', 'saldo a favor', 'saldos a favor', 'reporte fiscal', 'reportes fiscales', 'jurisdiccion', 'jurisdicción']
    },
    {
      name: 'Cumbre Reportes BI',
      reason: 'consolidar dashboards, KPIs, alertas ejecutivas, reportes gerenciales y datos de toda la operación',
      words: ['bi', 'business intelligence', 'dashboard', 'dashboards', 'tablero', 'tableros', 'kpi', 'kpis', 'indicador', 'indicadores', 'alerta ejecutiva', 'alertas ejecutivas', 'reporte gerencial', 'reportes gerenciales', 'reportes bi', 'serie historica', 'serie histórica', 'series historicas', 'series históricas', 'excel', 'csv', 'pdf', 'gerencia', 'direccion', 'dirección', 'bigtable']
    },
    {
      name: 'Cumbre Planificación y Proyecciones',
      reason: 'crear presupuestos internos, simular escenarios, proyectar cashflow, usar forecast y comparar real vs plan',
      words: ['planificacion', 'planificación', 'proyeccion', 'proyección', 'proyecciones', 'presupuesto interno', 'presupuestos internos', 'presupuesto anual', 'forecast', 'cashflow proyectado', 'caja proyectada', 'escenario', 'escenarios', 'optimista', 'pesimista', 'estres', 'estrés', 'real vs plan', 'real contra plan', 'desvio', 'desvío', 'desvios', 'desvíos', 'inversion', 'inversión', 'expansion', 'expansión']
    },
    {
      name: 'Cumbre Activos Fijos',
      reason: 'administrar bienes de uso, responsables, amortizaciones, mantenimientos, bajas y trazabilidad contable',
      words: ['activo fijo', 'activos fijos', 'bienes de uso', 'bien de uso', 'patrimonio', 'valor libro', 'amortizacion', 'amortización', 'amortizaciones', 'depreciacion', 'depreciación', 'vida util', 'vida útil', 'valor residual', 'mantenimiento preventivo', 'mantenimiento correctivo', 'baja de activo', 'bajas de activos', 'rodado', 'rodados', 'maquinaria', 'mueble', 'muebles', 'inmueble', 'inmuebles', 'software capitalizable']
    },
    {
      name: 'Cumbre WhatsApp Hub',
      reason: 'conectar módulos ERP con WhatsApp Business Cloud API, opt-in, plantillas Meta, webhooks seguros y agente conversacional',
      words: ['whatsapp hub', 'whatsapp business cloud api', 'meta whatsapp', 'meta cloud api', 'api oficial de meta', 'waba', 'business manager', 'phone number id', 'plantilla meta', 'plantillas meta', 'plantilla aprobada', 'plantillas aprobadas', 'opt-in', 'opt in', 'webhook meta', 'webhooks meta', 'credencial_ref', 'agente cerebro whatsapp', 'derivacion humana', 'derivación humana']
    },
    {
      name: 'Cumbre CRM',
      reason: 'ordenar consultas, leads, pipeline, presupuestos, cobros, próximas acciones y postventa como tronco comercial',
      words: ['lead', 'leads', 'cliente', 'clientes', 'crm', 'seguimiento', 'vendedor', 'prospecto', 'pipeline', 'oportunidad', 'oportunidades', 'presupuesto', 'presupuestos', 'postventa']
    },
    {
      name: 'IA Productiva',
      reason: 'automatizar respuestas, WhatsApp, tareas repetitivas y procesos internos',
      words: ['ia', 'agente', 'chatbot', 'automatizar', 'automatico', 'automático', 'whatsapp', 'responder', 'repetitivo']
    },
    {
      name: 'Cumbre ERP Negocios',
      reason: 'ordenar comercio de mostrador con POS, caja, stock, precios, reposición diaria y planes económicos',
      words: ['negocio', 'negocios', 'comercio', 'local', 'kiosco', 'kioscos', 'almacen', 'almacén', 'despensa', 'mercado', 'minimercado', 'verduleria', 'verdulería', 'carniceria', 'carnicería', 'restaurante', 'resto', 'panaderia', 'panadería', 'caja', 'pos', 'stock', 'precio', 'precios', 'reposicion', 'reposición', 'mostrador']
    },
    {
      name: 'Cumbre Stock',
      reason: 'controlar inventario por depósito con documentos inteligentes, cotejo contra Catálogo, aprobación humana, alertas y trazabilidad',
      words: ['stock', 'inventario', 'deposito', 'depósito', 'depositos', 'depósitos', 'remito', 'remitos', 'lote', 'lotes', 'vencimiento', 'vencimientos', 'reserva', 'reservas', 'transferencia interna', 'conteo', 'conteos', 'bajo stock', 'stock minimo', 'stock mínimo', 'stock negativo', 'excel stock', 'planilla stock']
    },
    {
      name: 'Cumbre Compras',
      reason: 'gestionar proveedores, reposición, órdenes de compra, recepción de mercadería y compras conectadas a Stock, Catálogo y ventas',
      words: ['compra', 'compras', 'comprar', 'proveedor', 'proveedores', 'orden de compra', 'ordenes de compra', 'órdenes de compra', 'solicitud de compra', 'solicitudes de compra', 'reposicion', 'reposición', 'reponer', 'recepcion', 'recepción', 'mercaderia', 'mercadería', 'quiebre de stock', 'sin stock', 'comparar proveedores', 'plazo de entrega']
    },
    {
      name: 'Tutoriales API Cumbre',
      reason: 'guiar conexiones externas con credenciales seguras, permisos, webhooks, checklists y validación backend',
      words: ['api', 'apis', 'credencial', 'credenciales', 'token', 'tokens', 'webhook', 'webhooks', 'secret', 'secret manager', 'oauth', 'mercado libre', 'mercado pago', 'woocommerce', 'google merchant', 'whatsapp business', 'wordpress', 'integracion', 'integración', 'integraciones']
    },
    {
      name: 'Cumbre eCommerce',
      reason: 'sincronizar tienda online, Mercado Libre, pedidos, stock y cobros',
      words: ['ecommerce', 'tienda', 'mercado libre', 'woocommerce', 'carrito', 'online']
    },
    {
      name: 'Cumbre Facturador ARCA',
      reason: 'emitir y administrar facturas, notas, remitos, recibos y documentación comercial con backend seguro, CAE, errores trazables e implementación asistida',
      words: ['arca', 'afip', 'cae', 'factura', 'facturas', 'comprobante', 'comprobantes', 'nota de credito', 'nota de crédito', 'nota de debito', 'nota de débito', 'remito', 'remitos', 'recibo', 'recibos']
    },
    {
      name: 'Cumbre Legal',
      reason: 'crear borradores asistidos por IA, citar fuentes normativas verificables, controlar vencimientos, aprobaciones y revisión profesional',
      words: ['legal', 'legales', 'contrato', 'contratos', 'acuerdo', 'acuerdos', 'nda', 'convenio', 'convenios', 'alquiler', 'laboral', 'abogado', 'abogada', 'norma', 'normativa', 'fuente normativa', 'vencimiento', 'vencimientos', 'documento legal', 'documentos legales']
    },
    {
      name: 'Cumbre Catálogo',
      reason: 'ordenar productos, servicios, precios, IVA, stock, proveedores e ingesta multimodal',
      words: ['catalogo', 'catálogo', 'producto', 'productos', 'servicio', 'servicios', 'sku', 'precio', 'precios', 'proveedor', 'proveedores']
    },
    {
      name: 'Asistente Guiado Cumbre',
      reason: 'acompañar onboarding con checklist, niveles de ayuda y próxima acción por módulo',
      words: ['asistente guiado', 'ayuda', 'onboarding', 'capacitacion', 'capacitación', 'checklist', 'manual', 'aprender']
    },
    {
      name: 'Panel de Control Cumbre',
      reason: 'ver módulos activos, trial, alertas, billing, Gema Pagos y estado operativo',
      words: ['panel', 'control', 'trial', 'prueba', 'billing', 'suscripcion', 'suscripción', 'modulos activos', 'módulos activos']
    }
  ];

  const cumbreLandingSignals = [
    { response: 'personal', words: ['cumbre personal', 'rrhh', 'recursos humanos', 'legajo', 'legajos', 'asistencia', 'ausentismo', 'ausencias', 'vacaciones', 'licencia', 'licencias', 'novedades de liquidacion', 'novedades de liquidación', 'liquidacion de sueldos', 'liquidación de sueldos'] },
    { response: 'cumbre_marketing', words: ['cumbre marketing', 'campaña', 'campañas', 'audiencia', 'audiencias', 'segmento', 'segmentos', 'atribucion', 'atribución', 'utm', 'meta ads', 'google ads', 'email marketing', 'reactivar clientes'] },
    { response: 'automatizaciones', words: ['cumbre automatizaciones', 'workflow', 'workflows', 'automatizacion cumbre', 'automatización cumbre', 'trigger', 'triggers', 'idempotencia', 'webhook seguro', 'flujos internos', 'no-code', 'low-code'] },
    { response: 'cumbre_web', words: ['cumbre web', 'landing conectada', 'formulario crm', 'formularios crm', 'cms', 'headless', 'seo conectado', 'eventos web', 'captacion de leads', 'captación de leads'] },
    { response: 'ventas_cumbre', words: ['cumbre ventas', 'pos conectado', 'venta mostrador', 'ventas mostrador', 'ventas digitales', 'ventas multicanal', 'listas bimonetarias', 'ticket promedio', 'descuentos'] },
    { response: 'verticales', words: ['cumbre kioscos', 'kiosco', 'kioscos', 'minimercado', 'cumbre resto', 'restaurante', 'resto', 'comanda', 'comandas', 'cumbre depositos', 'cumbre depósitos', 'wms', 'picking', 'cumbre constructoras', 'constructora', 'constructoras', 'obra', 'obras', 'cumbre agro', 'cartas de porte', 'carta de porte', 'acopio', 'cumbre mercados', 'mercado', 'mercados', 'autoservicio', 'gondola', 'góndola', 'merma'] }
  ];

  function addMessage(container, text, type) {
    const message = document.createElement('div');
    message.className = `gema-floating-agent__message gema-floating-agent__message--${type}`;
    message.textContent = text;
    container.appendChild(message);
    container.scrollTop = container.scrollHeight;
  }

  function resolveMessage(text) {
    const normalized = text.toLowerCase();

    if (normalized.includes('hola') || normalized.includes('buenas') || normalized.includes('buen dia')) {
      return 'Hola, soy el asistente de GEMA Digital. Contame qué estás buscando: ERP, automatización con IA, marketing, WhatsApp, precios o una reunión con un asesor.';
    }

    if (normalized.includes('diagnost') || normalized.includes('necesito que me recomienden') || normalized.includes('que me conviene') || normalized.includes('que modulo necesito') || normalized.includes('qué modulo necesito') || normalized.includes('que módulo necesito')) {
      return buildNeedsRecommendation(normalized);
    }

    if (normalized.includes('faq') || normalized.includes('pregunta frecuente') || normalized.includes('duda frecuente')) {
      return responses.faqs;
    }

    for (const signal of cumbreLandingSignals) {
      if (signal.words.some((word) => normalized.includes(word))) {
        return responses[signal.response];
      }
    }

    if (normalized.includes('crm') || normalized.includes('pipeline') || normalized.includes('lead') || normalized.includes('presupuesto') || normalized.includes('seguimiento comercial')) {
      return responses.crm;
    }

    if (normalized.includes('subdominio') || normalized.includes('portal') || normalized.includes('landing') || normalized.includes('planes')) {
      return responses.portales;
    }

    if (normalized.includes('compra') || normalized.includes('compras') || normalized.includes('comprar') || normalized.includes('orden de compra') || normalized.includes('proveedor') || normalized.includes('proveedores') || normalized.includes('reposicion') || normalized.includes('reposición') || normalized.includes('reponer') || normalized.includes('recepcion') || normalized.includes('recepción') || normalized.includes('quiebre de stock')) {
      return responses.compras;
    }

    if (normalized.includes('catalogo') || normalized.includes('catálogo') || normalized.includes('producto') || normalized.includes('sku')) {
      return buildNeedsRecommendation(normalized);
    }

    if (normalized.includes('stock') || normalized.includes('inventario') || normalized.includes('deposito') || normalized.includes('depósito') || normalized.includes('remito') || normalized.includes('lote') || normalized.includes('reserva') || normalized.includes('bajo stock')) {
      return responses.stock;
    }

    if (normalized.includes('whatsapp hub') || normalized.includes('whatsapp erp') || normalized.includes('whatsapp en cumbre') || normalized.includes('whatsapp business cloud api') || normalized.includes('meta whatsapp') || normalized.includes('meta cloud api') || normalized.includes('api oficial de meta') || normalized.includes('waba') || normalized.includes('business manager') || normalized.includes('phone number id') || normalized.includes('plantilla meta') || normalized.includes('plantillas meta') || normalized.includes('plantilla aprobada') || normalized.includes('plantillas aprobadas') || normalized.includes('opt-in') || normalized.includes('opt in') || normalized.includes('webhook meta') || normalized.includes('webhooks meta') || normalized.includes('credencial_ref') || normalized.includes('agente cerebro whatsapp')) {
      return responses.whatsapp_hub;
    }

    if (normalized.includes('api') || normalized.includes('credencial') || normalized.includes('token') || normalized.includes('webhook') || normalized.includes('oauth') || normalized.includes('mercado libre') || normalized.includes('woocommerce') || normalized.includes('google merchant') || normalized.includes('whatsapp business') || normalized.includes('integracion') || normalized.includes('integración')) {
      return responses.tutoriales_api;
    }

    if (normalized.includes('panel') || normalized.includes('trial') || normalized.includes('asistente guiado') || normalized.includes('onboarding')) {
      return responses.panel;
    }

    if (normalized.includes('legal') || normalized.includes('contrato') || normalized.includes('acuerdo') || normalized.includes('nda') || normalized.includes('convenio') || normalized.includes('abogado') || normalized.includes('normativa')) {
      return responses.legal;
    }

    if (normalized.includes('activo fijo') || normalized.includes('activos fijos') || normalized.includes('bienes de uso') || normalized.includes('bien de uso') || normalized.includes('patrimonio') || normalized.includes('valor libro') || normalized.includes('amortizacion') || normalized.includes('amortización') || normalized.includes('depreciacion') || normalized.includes('depreciación') || normalized.includes('vida util') || normalized.includes('vida útil') || normalized.includes('valor residual') || normalized.includes('mantenimiento preventivo') || normalized.includes('mantenimiento correctivo') || normalized.includes('baja de activo') || normalized.includes('bajas de activos') || normalized.includes('rodado') || normalized.includes('rodados') || normalized.includes('maquinaria') || normalized.includes('software capitalizable')) {
      return responses.activos_fijos;
    }

    if (normalized.includes('contabilidad') || normalized.includes('contable') || normalized.includes('contador') || normalized.includes('plan de cuentas') || normalized.includes('asiento') || normalized.includes('asientos') || normalized.includes('libro diario') || normalized.includes('libro mayor') || normalized.includes('iva compras') || normalized.includes('iva ventas') || normalized.includes('sumas') || normalized.includes('balance') || normalized.includes('estado de resultados') || normalized.includes('cierre contable')) {
      return responses.contabilidad;
    }

    if (normalized.includes('impuesto') || normalized.includes('impuestos') || normalized.includes('iva') || normalized.includes('iibb') || normalized.includes('ingresos brutos') || normalized.includes('retencion') || normalized.includes('retención') || normalized.includes('percepcion') || normalized.includes('percepción') || normalized.includes('posicion fiscal') || normalized.includes('posición fiscal') || normalized.includes('vencimiento fiscal') || normalized.includes('vencimientos fiscales') || normalized.includes('calendario fiscal') || normalized.includes('saldo a pagar') || normalized.includes('saldo a favor') || normalized.includes('reporte fiscal') || normalized.includes('jurisdiccion') || normalized.includes('jurisdicción')) {
      return responses.impuestos;
    }

    if (normalized.includes('planificacion') || normalized.includes('planificación') || normalized.includes('proyeccion') || normalized.includes('proyección') || normalized.includes('presupuesto interno') || normalized.includes('presupuesto anual') || normalized.includes('forecast') || normalized.includes('cashflow proyectado') || normalized.includes('caja proyectada') || normalized.includes('escenario') || normalized.includes('escenarios') || normalized.includes('optimista') || normalized.includes('pesimista') || normalized.includes('estres') || normalized.includes('estrés') || normalized.includes('real vs plan') || normalized.includes('real contra plan') || normalized.includes('desvio') || normalized.includes('desvío') || normalized.includes('inversion') || normalized.includes('inversión') || normalized.includes('expansion') || normalized.includes('expansión')) {
      return responses.planificacion;
    }

    if (normalized.includes('business intelligence') || normalized.includes('dashboard') || normalized.includes('tablero') || normalized.includes('kpi') || normalized.includes('indicador') || normalized.includes('indicadores') || normalized.includes('alerta ejecutiva') || normalized.includes('alertas ejecutivas') || normalized.includes('reporte gerencial') || normalized.includes('reportes gerenciales') || normalized.includes('reportes bi') || normalized.includes('serie historica') || normalized.includes('serie histórica') || normalized.includes('gerencia') || normalized.includes('direccion') || normalized.includes('dirección') || normalized.includes('bigtable')) {
      return responses.reportes_bi;
    }

    if (normalized.includes('banco') || normalized.includes('tesoreria') || normalized.includes('tesorería') || normalized.includes('conciliar') || normalized.includes('conciliacion') || normalized.includes('conciliación') || normalized.includes('cashflow') || normalized.includes('flujo de caja') || normalized.includes('home banking') || normalized.includes('extracto') || normalized.includes('ofx') || normalized.includes('saldo') || normalized.includes('billetera')) {
      return responses.tesoreria;
    }

    if (normalized.includes('cobro') || normalized.includes('pago') || normalized.includes('mercado pago') || normalized.includes('nave') || normalized.includes('modo') || normalized.includes('qr')) {
      return buildNeedsRecommendation(normalized);
    }

    if (normalized.includes('arca') || normalized.includes('afip') || normalized.includes('cae') || normalized.includes('factur') || normalized.includes('comprobante') || normalized.includes('remito') || normalized.includes('recibo')) {
      return responses.facturador;
    }

    if (normalized.includes('erp') || normalized.includes('cumbre') || normalized.includes('factur')) {
      return responses.erp;
    }

    if (normalized.includes('ia') || normalized.includes('automat') || normalized.includes('whatsapp')) {
      return responses.ia;
    }

    if (normalized.includes('negocio') || normalized.includes('kiosco') || normalized.includes('almacen') || normalized.includes('almacén') || normalized.includes('pos') || normalized.includes('caja') || normalized.includes('mostrador') || normalized.includes('restaurante') || normalized.includes('panaderia') || normalized.includes('panadería')) {
      return responses.negocios;
    }

    if (normalized.includes('marketing') || normalized.includes('redes') || normalized.includes('campaña') || normalized.includes('campania') || normalized.includes('seo') || normalized.includes('web')) {
      return responses.marketing;
    }

    if (normalized.includes('prueba') || normalized.includes('demo') || normalized.includes('14')) {
      return responses.prueba;
    }

    if (normalized.includes('precio') || normalized.includes('cotiz') || normalized.includes('presupuesto') || normalized.includes('cuanto')) {
      return responses.precios;
    }

    if (normalized.includes('contact') || normalized.includes('reunion') || normalized.includes('asesor') || normalized.includes('llam')) {
      return responses.contacto;
    }

    if (normalized.includes('soporte') || normalized.includes('ayuda') || normalized.includes('problema')) {
      return responses.soporte;
    }

    if (normalized.includes('direccion') || normalized.includes('oficina') || normalized.includes('ubicacion')) {
      return responses.ubicacion;
    }

    if (/\b\d{8,}\b/.test(normalized) || normalized.includes('@')) {
      return 'Perfecto, ya tengo un dato de contacto. Para orientarte mejor, contame también tu nombre y qué necesitás resolver. Si preferís, podés ir a /contacto y dejar la consulta formal.';
    }

    if (normalized.length > 24) {
      return buildNeedsRecommendation(normalized);
    }

    return responses.default;
  }

  function buildNeedsRecommendation(normalizedText) {
    const matches = solutionSignals
      .map(function (solution) {
        const score = solution.words.reduce(function (total, word) {
          return normalizedText.includes(word) ? total + 1 : total;
        }, 0);

        return Object.assign({}, solution, { score: score });
      })
      .filter(function (solution) {
        return solution.score > 0;
      })
      .sort(function (a, b) {
        return b.score - a.score;
      })
      .slice(0, 3);

    if (!matches.length) {
      return 'Puedo analizar tu caso y recomendar la mejor combinación de soluciones. Para orientarte bien, contame rubro, cantidad de usuarios, qué sistema usás hoy, cómo vendés, cómo cobrás y cuál es el problema más urgente.';
    }

    const recommendation = matches.map(function (solution) {
      return `${solution.name} para ${solution.reason}`;
    }).join('; ');

    return `Por lo que contás, conviene evaluar una propuesta combinada: ${recommendation}. Para afinarla, decime tu nombre, WhatsApp, rubro, cantidad de usuarios, sistema actual y prioridad principal.`;
  }

  document.addEventListener('DOMContentLoaded', function () {
    const root = document.querySelector('[data-gema-floating-agent]');
    if (!root) {
      return;
    }

    const button = root.querySelector('.gema-floating-agent__button');
    const panel = root.querySelector('.gema-floating-agent__panel');
    const close = root.querySelector('.gema-floating-agent__close');
    const messages = root.querySelector('.gema-floating-agent__messages');
    const form = root.querySelector('.gema-floating-agent__form');
    const input = root.querySelector('#gema-agent-input');

    function setOpen(isOpen) {
      panel.hidden = !isOpen;
      button.setAttribute('aria-expanded', String(isOpen));
      root.classList.toggle('is-open', isOpen);

      if (isOpen && input) {
        window.setTimeout(function () {
          input.focus();
        }, 120);
      }
    }

    function maybeCaptureLead(text) {
      const phone = text.match(/\b\d{8,}\b/);
      const email = text.match(/[^\s@]+@[^\s@]+\.[^\s@]+/);

      if (phone && !lead.phone) {
        lead.phone = phone[0];
      }

    if (email && !lead.email) {
      lead.email = email[0];
      }

      if (!lead.need && text.length > 24) {
        lead.need = text;
      }
    }

  function getSessionId() {
    const key = 'gema-agent-session-id';
    let sessionId = window.sessionStorage.getItem(key);

    if (!sessionId) {
      sessionId = `web-${Date.now()}-${Math.random().toString(36).slice(2, 10)}`;
      window.sessionStorage.setItem(key, sessionId);
    }

    return sessionId;
  }

  async function requestAgentReply(text) {
    const response = await window.fetch(API_ENDPOINT, {
      method: 'POST',
      headers: {
        'content-type': 'application/json'
      },
      body: JSON.stringify({
        session_id: getSessionId(),
        message: text,
        page_url: window.location.href,
        known_lead: {
          name: lead.name,
          phone: lead.phone,
          email: lead.email,
          company_or_need: lead.need
        }
      })
    });

    if (!response.ok) {
      throw new Error(`Agent API failed with status ${response.status}`);
    }

    const data = await response.json();
    return data.reply || data.chat?.reply || resolveMessage(text);
  }

    button.addEventListener('click', function () {
      setOpen(panel.hidden);
    });

    close.addEventListener('click', function () {
      setOpen(false);
    });

    root.querySelectorAll('[data-agent-topic]').forEach(function (topicButton) {
      topicButton.addEventListener('click', function () {
        const topic = topicButton.getAttribute('data-agent-topic') || 'default';
        addMessage(messages, topicButton.textContent.trim(), 'user');
        addMessage(messages, responses[topic] || responses.default, 'bot');
      });
    });

    form.addEventListener('submit', async function (event) {
      event.preventDefault();
      const text = input.value.trim();
      if (!text) {
        return;
      }

      maybeCaptureLead(text);
      addMessage(messages, text, 'user');
      input.value = '';

      try {
        addMessage(messages, await requestAgentReply(text), 'bot');
      } catch (error) {
        addMessage(messages, resolveMessage(text), 'bot');
      }
    });

    window.setTimeout(function () {
      root.classList.add('is-attention-ready');
    }, 1800);

    if (!window.localStorage.getItem(STORAGE_KEY)) {
      window.setTimeout(function () {
        setOpen(true);
        window.localStorage.setItem(STORAGE_KEY, '1');
      }, 4500);
    }
  });
})();
