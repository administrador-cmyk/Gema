<?php
/**
 * Yoast SEO synchronization for GEMA Digital.
 *
 * @package GemaSovereign
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function gema_sovereign_yoast_social_image_url( string $image ): string {
	return home_url( '/wp-content/themes/gema-sovereign/assets/seo-visuals/' . ltrim( $image, '/' ) );
}

function gema_sovereign_get_url_consolidation_map(): array {
	return array(
		'cumbre/crm'                => array(
			'action' => '301',
			'target' => '/cumbre-crm/',
			'reason' => 'Duplicado del slug comercial Cumbre CRM.',
		),
		'cumbre/negocios'           => array(
			'action' => '301',
			'target' => '/cumbre-erp-negocios/',
			'reason' => 'Duplicado del slug comercial Cumbre ERP Negocios.',
		),
		'cumbre/cobros'             => array(
			'action' => '301',
			'target' => '/erp-cumbre/cumbre-cobros/',
			'reason' => 'Duplicado del modulo Cumbre Cobros dentro del cluster pagos.',
		),
		'cumbre/facturador'         => array(
			'action' => '301',
			'target' => '/erp-cumbre/cumbre-facturador-arca/',
			'reason' => 'Duplicado del modulo fiscal dentro del cluster ERP Cumbre.',
		),
		'cumbre/legal'              => array(
			'action' => '301',
			'target' => '/erp-cumbre/cumbre-legal/',
			'reason' => 'Duplicado del modulo documental legal dentro del cluster ERP Cumbre.',
		),
		'cumbre/stock'              => array(
			'action' => '301',
			'target' => '/erp-cumbre/cumbre-stock/',
			'reason' => 'Duplicado del modulo de inventario dentro del cluster ERP Cumbre.',
		),
		'cumbre/compras'            => array(
			'action' => '301',
			'target' => '/erp-cumbre/cumbre-compras/',
			'reason' => 'Duplicado del modulo de compras y reposicion dentro del cluster ERP Cumbre.',
		),
		'cumbre/tesoreria'          => array(
			'action' => '301',
			'target' => '/erp-cumbre/cumbre-tesoreria/',
			'reason' => 'Duplicado del modulo financiero y de tesoreria dentro del cluster ERP Cumbre.',
		),
		'cumbre/contabilidad'       => array(
			'action' => '301',
			'target' => '/erp-cumbre/cumbre-contabilidad/',
			'reason' => 'Duplicado del modulo contable dentro del cluster ERP Cumbre.',
		),
		'cumbre/impuestos'          => array(
			'action' => '301',
			'target' => '/erp-cumbre/cumbre-impuestos/',
			'reason' => 'Duplicado del modulo fiscal dentro del cluster ERP Cumbre.',
		),
		'cumbre/reportes-bi'        => array(
			'action' => '301',
			'target' => '/erp-cumbre/cumbre-reportes-bi/',
			'reason' => 'Duplicado del modulo BI gerencial dentro del cluster ERP Cumbre.',
		),
		'cumbre/planificacion'      => array(
			'action' => '301',
			'target' => '/erp-cumbre/cumbre-planificacion/',
			'reason' => 'Duplicado del modulo de planificacion dentro del cluster ERP Cumbre.',
		),
		'cumbre/activos-fijos'      => array(
			'action' => '301',
			'target' => '/erp-cumbre/cumbre-activos-fijos/',
			'reason' => 'Duplicado del modulo de activos fijos dentro del cluster ERP Cumbre.',
		),
		'cumbre/whatsapp-hub'       => array(
			'action' => '301',
			'target' => '/erp-cumbre/cumbre-whatsapp-hub/',
			'reason' => 'Duplicado del modulo de comunicacion WhatsApp dentro del cluster ERP Cumbre.',
		),
		'cumbre/personal'           => array( 'action' => '301', 'target' => '/erp-cumbre/cumbre-personal/', 'reason' => 'Duplicado del modulo RRHH dentro del cluster ERP Cumbre.' ),
		'cumbre/marketing'          => array( 'action' => '301', 'target' => '/erp-cumbre/cumbre-marketing/', 'reason' => 'Duplicado del modulo marketing dentro del cluster ERP Cumbre.' ),
		'cumbre/automatizaciones'   => array( 'action' => '301', 'target' => '/erp-cumbre/cumbre-automatizaciones/', 'reason' => 'Duplicado del modulo de automatizaciones dentro del cluster ERP Cumbre.' ),
		'cumbre/web'                => array( 'action' => '301', 'target' => '/erp-cumbre/cumbre-web/', 'reason' => 'Duplicado del modulo web dentro del cluster ERP Cumbre.' ),
		'cumbre/ventas'             => array( 'action' => '301', 'target' => '/erp-cumbre/cumbre-ventas/', 'reason' => 'Duplicado del modulo ventas dentro del cluster ERP Cumbre.' ),
		'cumbre/kioscos'            => array( 'action' => '301', 'target' => '/erp-cumbre/cumbre-kioscos/', 'reason' => 'Duplicado de vertical sectorial dentro del cluster ERP Cumbre.' ),
		'cumbre/resto'              => array( 'action' => '301', 'target' => '/erp-cumbre/cumbre-resto/', 'reason' => 'Duplicado de vertical sectorial dentro del cluster ERP Cumbre.' ),
		'cumbre/depositos-wms'      => array( 'action' => '301', 'target' => '/erp-cumbre/cumbre-depositos-wms/', 'reason' => 'Duplicado de vertical sectorial dentro del cluster ERP Cumbre.' ),
		'cumbre/constructoras'      => array( 'action' => '301', 'target' => '/erp-cumbre/cumbre-constructoras/', 'reason' => 'Duplicado de vertical sectorial dentro del cluster ERP Cumbre.' ),
		'cumbre/agro'               => array( 'action' => '301', 'target' => '/erp-cumbre/cumbre-agro/', 'reason' => 'Duplicado de vertical sectorial dentro del cluster ERP Cumbre.' ),
		'cumbre/mercados'           => array( 'action' => '301', 'target' => '/erp-cumbre/cumbre-mercados/', 'reason' => 'Duplicado de vertical sectorial dentro del cluster ERP Cumbre.' ),
		'cumbre/tutoriales-api'      => array(
			'action' => '301',
			'target' => '/erp-cumbre/tutoriales-api-cumbre/',
			'reason' => 'Duplicado de la capa transversal de tutoriales API dentro del cluster ERP Cumbre.',
		),
		'tecnologia/pasarela-pagos' => array(
			'action' => '301',
			'target' => '/pagos/',
			'reason' => 'Solapa intención con el hub de pagos GEMA.',
		),
		'impuestos'                 => array(
			'action' => '301',
			'target' => '/erp/funciones/facturacion-electronica/',
			'reason' => 'Solapa intención fiscal con la página principal de facturación ERP.',
		),
		'impuestos/arca-fiscal'     => array(
			'action' => '301',
			'target' => '/erp/funciones/facturacion-electronica/',
			'reason' => 'Solapa intención ARCA con la página principal de facturación ERP.',
		),
		'competencia/tango'         => array(
			'action' => '301',
			'target' => '/competencia/cumbre-erp-pymes-vs-tango-bejerman-odoo/',
			'reason' => 'Comparativa corta reemplazada por cluster bottom-funnel completo.',
		),
		'competencia/odoo'          => array(
			'action' => '301',
			'target' => '/competencia/cumbre-erp-pymes-vs-tango-bejerman-odoo/',
			'reason' => 'Comparativa corta reemplazada por cluster bottom-funnel completo.',
		),
		'faq'                       => array(
			'action' => '301',
			'target' => '/faqs/',
			'reason' => 'Consolidación del hub de preguntas frecuentes.',
		),
		'preguntas-frecuentes'      => array(
			'action' => '301',
			'target' => '/faqs/',
			'reason' => 'Consolidación del hub de preguntas frecuentes.',
		),
		'competencia/sap'           => array(
			'action' => '301',
			'target' => '/competencia/cumbre-empresas-vs-sap-netsuite/',
			'reason' => 'Comparativa corta reemplazada por comparativa empresarial completa.',
		),
		'competencia/netsuite'      => array(
			'action' => '301',
			'target' => '/competencia/cumbre-empresas-vs-sap-netsuite/',
			'reason' => 'Comparativa corta reemplazada por comparativa empresarial completa.',
		),
		'competencia/holded'        => array(
			'action' => '301',
			'target' => '/competencia/cumbre-erp-pymes-vs-tango-bejerman-odoo/',
			'reason' => 'Comparativa corta consolidada en el hub de ERP para PyMEs.',
		),
	);
}

function gema_sovereign_get_yoast_cluster_defaults(): array {
	return array(
		'home'         => array(
			'focuskw'  => 'software ERP IA automatización empresas',
			'synonyms' => 'software de gestión empresarial, ERP para pymes, inteligencia artificial para empresas, automatización empresarial, agencia de software e IA',
			'intent'   => 'marca y solución general',
			'image'    => 'gema-digital-og.png',
		),
		'erp'          => array(
			'focuskw'  => 'ERP para PyMEs argentinas',
			'synonyms' => 'Cumbre Activos Fijos, activos fijos ERP, bienes de uso, control de activos fijos, amortización lineal, mantenimiento de activos, bajas de activos, trazabilidad contable, patrimonio empresa, valor libro, Cumbre WhatsApp Hub, WhatsApp Business integrado a ERP, WhatsApp Business Cloud API, Meta WhatsApp API, agente conversacional ERP, opt-in WhatsApp, plantillas Meta, webhooks WhatsApp seguros, Cumbre Planificación, planificación financiera para PyMEs, presupuestos internos, escenarios financieros, cashflow proyectado, forecast de caja, real vs plan, proyecciones empresariales, presupuesto anual empresa, Cumbre Reportes BI, dashboards para PyMEs, KPIs empresariales, reportes gerenciales ERP, business intelligence para PyMEs, BI conectado al ERP, alertas ejecutivas, tableros de control, reportes Excel PDF CSV, Cumbre Impuestos, impuestos para PyMEs argentinas, software fiscal para PyMEs, posición IVA, IIBB por jurisdicción, retenciones y percepciones, calendario fiscal, vencimientos fiscales, reportes fiscales para contador, Cumbre Contabilidad, contabilidad conectada al ERP, software contable para PyMEs, asientos contables ERP, plan de cuentas, libro diario, libro mayor, IVA compras, IVA ventas, cierre contable mensual, reportes contables, exportación para contador, Cumbre Tesorería, tesorería para PyMEs, software de tesorería Argentina, conciliación bancaria asistida, cashflow para empresas, control de caja y bancos, billeteras virtuales empresas, pagos a proveedores, ERP financiero Argentina, Cumbre Compras, software de compras para PyMEs, gestión de proveedores, órdenes de compra, solicitudes de reposición, reposición de stock, compras conectadas a inventario, compras Mercado Libre, compras ecommerce, Cumbre Empresas, Tutoriales API Cumbre, integraciones ERP, conectar Mercado Libre con ERP, conectar Mercado Pago con ERP, WooCommerce ERP, Google Merchant ERP, WhatsApp Business API, credenciales API seguras, webhooks Cumbre, Cumbre Stock, inventario agéntico, control de stock con IA, stock por depósito, remitos con IA, facturas con IA, alertas de bajo stock, Cumbre Legal, gestión documental legal con IA, contratos asistidos por IA, borradores legales para empresas, fuentes normativas verificables, checklist legal empresarial, Cumbre Facturador ARCA, facturación electrónica ARCA, facturador para empresas argentinas, ERP con facturación electrónica, facturas A B C, notas de crédito y débito, remitos y recibos digitales, software de facturación para PyMEs, agente IA para facturación, ERP administrativo con gobernanza, software administrativo para PyMEs, sistema de gestión PyME, administración para PyMEs, aprobaciones, auditoría, reportes ejecutivos, contabilidad opcional para PyMEs, ventas, compras, bancos, impuestos, reportes, ERP modular, CRM para PyMEs argentinas, control de stock',
			'intent'   => 'producto y demo comercial',
			'image'    => 'erp-cumbre-og.png',
		),
		'negocios'     => array(
			'focuskw'  => 'sistema POS para comercios',
			'synonyms' => 'sistema para kioscos, sistema para almacenes, software para mercados, software POS Argentina, sistema de caja para negocios, control de stock para kioscos, ERP económico para comercios, sistema para restaurantes chicos, sistema para depósito chico',
			'intent'   => 'POS económico para comercios minoristas',
			'image'    => 'cumbre-erp-negocios-og.png',
		),
		'crm'          => array(
			'focuskw'  => 'CRM para PyMEs argentinas',
			'synonyms' => 'CRM con presupuestos, CRM con catálogo y stock, CRM para ventas B2B, CRM con asistente de IA, software de gestión comercial para PyMEs',
			'intent'   => 'producto bottom funnel',
			'image'    => 'cumbre-crm-og.png',
		),
		'ia'           => array(
			'focuskw'  => 'inteligencia artificial para empresas',
			'synonyms' => 'agentes IA, automatización con IA, RAG empresarial, asistente IA para empresas, observabilidad IA',
			'intent'   => 'solución IA',
			'image'    => 'ia-productiva-og.png',
		),
		'marketing'    => array(
			'focuskw'  => 'marketing digital para empresas',
			'synonyms' => 'SEO para empresas, GEO, campañas Google Ads, Meta Ads, redes sociales para PyMEs, contenido comercial',
			'intent'   => 'servicio comercial',
			'image'    => 'marketing-digital-og.png',
		),
		'payments'     => array(
			'focuskw'  => 'plataforma de pagos para empresas',
			'synonyms' => 'Cumbre Cobros, cobros online Argentina, links de pago para empresas, cobrar sin comisión de sistema, conciliación de pagos, ERP con cobros, módulo de cobros para PyMEs, QR Mercado Pago MODO Payway, gestión de cobranzas, panel de cobros, Mercado Pago para empresas, Nave, Stripe, PayPal, medios de pago Argentina',
			'intent'   => 'pagos y cobros',
			'image'    => 'pagos-cobros-og.png',
		),
		'comparativas' => array(
			'focuskw'  => 'comparativas ERP',
			'synonyms' => 'ERP Cumbre vs Tango, ERP Cumbre vs Odoo, Cumbre Empresas, software de gestión para PyMEs argentinas, ERP administrativo con gobernanza',
			'intent'   => 'comparación y decisión',
			'image'    => 'comparativas-erp-og.png',
		),
		'generic'      => array(
			'focuskw'  => 'software de gestión empresarial',
			'synonyms' => 'ERP para pymes, automatización empresarial, IA productiva, integraciones, marketing digital para empresas',
			'intent'   => 'información comercial',
			'image'    => 'gema-digital-og.png',
		),
	);
}

function gema_sovereign_get_yoast_primary_pages(): array {
	return array(
		''                  => array(
			'cluster'     => 'home',
			'title'       => 'GEMA Digital | Software, ERP, IA y automatización para empresas',
			'description' => 'Software, ERP Cumbre, automatización, inteligencia artificial, integraciones y marketing digital para negocios, PyMEs y empresas que quieren crecer con control.',
		),
		'erp-cumbre'        => array(
			'cluster'     => 'erp',
			'title'       => gema_sovereign_get_cumbre_seo_title(),
			'description' => gema_sovereign_get_cumbre_meta_description(),
		),
		'erp'               => array(
			'cluster'     => 'erp',
			'focuskw'     => 'ERP para PyMEs argentinas',
			'title'       => 'ERP para PyMEs argentinas | Módulos, precios y funciones Cumbre',
			'description' => 'Hub ERP de GEMA Digital para explorar Cumbre, módulos, precios, funciones, facturación, cobros, CRM, stock, compras y automatización para empresas.',
		),
		'erp/funciones'     => array(
			'cluster'     => 'erp',
			'focuskw'     => 'funciones ERP Cumbre',
			'title'       => 'Funciones ERP Cumbre | Facturación, cobros, stock, CRM y reportes',
			'description' => 'Guía de funciones ERP Cumbre para PyMEs: facturación, cobros, stock, CRM, compras, reportes, tesorería, integraciones e IA aplicada.',
		),
		'cumbre-crm'        => array(
			'cluster'     => 'crm',
			'focuskw'     => 'CRM para PyMEs argentinas',
			'synonyms'    => 'CRM WhatsApp para PyMEs, CRM conectado al ERP, CRM con presupuestos, CRM con catálogo y stock, CRM para ventas B2B, CRM con asistente de IA',
			'title'       => 'Cumbre CRM | CRM para PyMEs argentinas con WhatsApp, presupuestos y ERP',
			'description' => 'CRM para PyMEs argentinas B2B: leads, WhatsApp, presupuestos, catálogo, stock, cobros y próximas acciones conectadas al ERP Cumbre.',
		),
		'cumbre/crm'        => array(
			'cluster'     => 'crm',
			'focuskw'     => 'CRM para PyMEs argentinas',
			'synonyms'    => 'CRM WhatsApp para PyMEs, CRM conectado al ERP, CRM con presupuestos, CRM con catálogo y stock, CRM para ventas B2B, CRM con asistente de IA',
			'title'       => 'Cumbre CRM | CRM para PyMEs argentinas con WhatsApp, presupuestos y ERP',
			'description' => 'CRM para PyMEs argentinas B2B: leads, WhatsApp, presupuestos, catálogo, stock, cobros y próximas acciones conectadas al ERP Cumbre.',
		),
		'cumbre-erp-negocios' => array(
			'cluster'     => 'negocios',
			'focuskw'     => 'sistema POS para comercios',
			'synonyms'    => 'sistema POS para kioscos, sistema para almacenes, sistema de caja para negocios, control de stock para kioscos, código de barras, cierre de caja, reposición diaria, facturación ARCA para comercios',
			'title'       => 'Cumbre ERP Negocios | Sistema POS para kioscos, almacenes y comercios',
			'description' => 'Sistema POS para comercios argentinos: caja, stock, códigos de barra, precios, cierre diario, reposición y facturación ARCA asistida.',
		),
		'cumbre/negocios'  => array(
			'cluster'     => 'negocios',
			'focuskw'     => 'sistema POS para comercios',
			'synonyms'    => 'sistema POS para kioscos, sistema para almacenes, sistema de caja para negocios, control de stock para kioscos, código de barras, cierre de caja, reposición diaria, facturación ARCA para comercios',
			'title'       => 'Cumbre ERP Negocios | Sistema POS para kioscos, almacenes y comercios',
			'description' => 'Sistema POS para comercios argentinos: caja, stock, códigos de barra, precios, cierre diario, reposición y facturación ARCA asistida.',
		),
		'gema-negocios'     => array(
			'cluster'     => 'erp',
			'focuskw'     => 'software de gestión para comercios',
			'synonyms'    => 'gestión de ventas, caja y stock, software para PyMEs, facturación para comercios, clientes y reportes',
			'title'       => 'GEMA Negocios | Software de gestión para comercios y PyMEs',
			'description' => 'Gestión simple para comercios, emprendedores y PyMEs: ventas, caja, stock, clientes, facturación, reportes e integraciones en una sola solución.',
		),
		'ia-productiva'     => array(
			'cluster'     => 'ia',
			'title'       => 'IA Productiva | Automatización e inteligencia artificial para empresas',
			'description' => 'Agentes IA, RAG, automatización de procesos, reportes, integraciones y observabilidad para aplicar inteligencia artificial en operaciones reales.',
		),
		'gestion'           => array(
			'cluster'     => 'erp',
			'focuskw'     => 'gestión empresarial',
			'title'       => 'Gestión empresarial con ERP, automatización e IA | GEMA Digital',
			'description' => 'Ordená ventas, caja, stock, compras, clientes, reportes e integraciones con ERP Cumbre y soluciones adaptadas a negocios, PyMEs y empresas.',
		),
		'empresas'          => array(
			'cluster'     => 'generic',
			'focuskw'     => 'servicios tecnológicos para empresas',
			'title'       => 'Servicios tecnológicos para empresas, PyMEs y comercios | GEMA Digital',
			'description' => 'Software, ERP, automatización, IA, marketing digital e integraciones para comercios, PyMEs, constructoras, agro, ecommerce y servicios.',
		),
		'marketing'         => array(
			'cluster'     => 'marketing',
			'title'       => 'Marketing digital, SEO, redes y campañas para empresas | GEMA',
			'description' => 'Contenido, sitios web, SEO/GEO, redes sociales, Google Ads, Meta Ads, Google Business Profile, automatización de leads y Cumbre Marketing.',
		),
		'automatizacion'    => array(
			'cluster'     => 'ia',
			'focuskw'     => 'automatización empresarial',
			'title'       => 'Automatización empresarial adaptada a cada negocio | GEMA Digital',
			'description' => 'Automatizamos procesos de ventas, caja, stock, clientes, reportes, WhatsApp, CRM, ERP, ecommerce y tareas internas con software e IA.',
		),
		'integraciones'     => array(
			'cluster'     => 'generic',
			'focuskw'     => 'integraciones ERP',
			'title'       => 'Integraciones ERP, ecommerce, pagos, CRM y APIs | GEMA Digital',
			'description' => 'Conectá ERP, ecommerce, Mercado Libre, pagos, bancos, CRM, formularios, WhatsApp y sistemas internos para reducir carga manual.',
		),
		'tecnologia'        => array(
			'cluster'     => 'generic',
			'focuskw'     => 'arquitectura tecnológica para empresas',
			'title'       => 'Tecnología para gestión, integraciones e IA empresarial | GEMA',
			'description' => 'Arquitectura tecnológica, APIs, cloud, automatización, datos e inteligencia artificial para empresas que necesitan sistemas conectados y escalables.',
		),
		'blog'              => array(
			'cluster'     => 'generic',
			'focuskw'     => 'blog de tecnología IA y gestión',
			'title'       => 'Blog GEMA | ERP, IA, automatización, marketing y gestión',
			'description' => 'Guías, comparativas y contenido técnico sobre ERP, inteligencia artificial, automatización, marketing digital, SEO/GEO e integraciones empresariales.',
		),
		'faqs'              => array(
			'cluster'     => 'generic',
			'focuskw'     => 'preguntas frecuentes ERP Cumbre',
			'title'       => 'FAQs GEMA Digital | Preguntas frecuentes sobre ERP Cumbre, IA y módulos',
			'description' => 'Respuestas rápidas sobre ERP Cumbre, módulos, precios, implementación, ARCA, cobros, seguridad, legal, IA y el agente comercial de GEMA Digital.',
		),
		'competencia'       => array(
			'cluster'     => 'comparativas',
			'title'       => 'Comparativas ERP y software de gestión | GEMA Digital',
			'description' => 'Compará ERP Cumbre con alternativas de gestión según costos, integraciones, soporte, flexibilidad, IA, implementación y necesidades de negocio.',
		),
		'nosotros'          => array(
			'cluster'     => 'generic',
			'focuskw'     => 'agencia de software e IA',
			'title'       => 'Nosotros | GEMA Digital, software, ERP, IA y gestión empresarial',
			'description' => 'Conocé GEMA Digital: equipo de software, gestión, automatización, inteligencia artificial, marketing e integraciones para empresas reales.',
		),
		'contacto'          => array(
			'cluster'     => 'generic',
			'focuskw'     => 'diagnóstico ERP automatización IA',
			'title'       => 'Contacto GEMA Digital | Diagnóstico ERP, IA y automatización',
			'description' => 'Consultá por ERP Cumbre, GEMA Negocios, IA Productiva, automatizaciones, integraciones, software a medida o marketing digital para tu empresa.',
		),
		'pagos'             => array(
			'cluster'     => 'payments',
			'title'       => 'Plataforma de pagos GEMA | Cobros nacionales y globales',
			'description' => 'Base de pagos para GEMA y Cumbre: transferencia, Mercado Pago, Nave, PayPal, Stripe, webhooks, conciliación y activación asistida.',
		),
		'legal'             => array(
			'cluster'     => 'legal',
			'focuskw'     => 'legal GEMA Digital Cumbre',
			'title'       => 'Legal GEMA Digital y Cumbre | Términos, privacidad y seguridad',
			'description' => 'Centro legal de GEMA Digital y Cumbre con términos, privacidad, propiedad intelectual, pagos, ARCA, IA, seguridad, baja y comunicaciones.',
		),
		'erp-cumbre/cumbre-cobros' => array(
			'cluster'     => 'payments',
			'focuskw'     => 'links de pago para empresas Argentina',
			'synonyms'    => 'Cumbre Cobros, cobros online Argentina, conciliación de pagos, ERP con cobros, módulo de cobros para PyMEs, QR Mercado Pago MODO Payway, gestión de cobranzas, panel de cobros, 0% comisión Cumbre, webhooks de pago',
			'title'       => 'Cumbre Cobros | Links de pago, QR, webhooks y conciliación',
			'description' => 'Cobros para PyMEs: links de pago, QR, transferencias, tarjetas, billeteras, webhooks, conciliación y 0% comisión Cumbre por transacción.',
		),
		'erp-cumbre/cumbre-facturador-arca' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'facturación electrónica ARCA',
			'synonyms'    => 'Cumbre Facturador ARCA, portal ARCA vs facturador, facturador para empresas argentinas, ERP con facturación electrónica, facturas A B C, notas de crédito y débito, remitos y recibos digitales, software de facturación para PyMEs, CAE, errores trazables, worker ARCA, implementación asistida',
			'title'       => 'Cumbre Facturador ARCA | Portal ARCA vs facturador vs ERP integrado',
			'description' => 'Facturación electrónica ARCA integrada al ERP: portal ARCA vs facturador simple, CAE, errores trazables, cobros y producción asistida.',
		),
		'erp-cumbre/cumbre-legal' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'gestión documental legal con IA',
			'synonyms'    => 'Cumbre Legal, contratos asistidos por IA, borradores legales para empresas, documentos legales para PyMEs, fuentes normativas verificables, checklist legal empresarial, vencimientos legales, contratos con trazabilidad, revisión profesional',
			'title'       => 'Cumbre Legal | Gestión documental legal asistida por IA para empresas',
			'description' => 'Cumbre Legal ayuda a crear, organizar y controlar borradores de contratos, acuerdos, NDAs, vencimientos y fuentes normativas verificables con IA y trazabilidad.',
		),
		'erp-cumbre/cumbre-stock' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'control de stock con IA',
			'synonyms'    => 'Cumbre Stock, inventario agéntico, software de stock para PyMEs, stock por depósito, remitos con IA, facturas con IA, control de inventario ERP, alertas de bajo stock, stock con WhatsApp, aprobación humana',
			'title'       => 'Cumbre Stock | Inventario agéntico con IA, depósitos y aprobación humana',
			'description' => 'Cumbre Stock controla inventario por depósito con IA, documentos inteligentes, cotejo contra Catálogo, aprobación humana, alertas y trazabilidad.',
		),
		'erp-cumbre/cumbre-compras' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'software de compras para PyMEs',
			'synonyms'    => 'Cumbre Compras, gestión de proveedores, órdenes de compra, solicitudes de reposición, reposición de stock, compras conectadas a inventario, compras Mercado Libre, compras ecommerce, recepción de mercadería, comparador de proveedores',
			'title'       => 'Cumbre Compras | Proveedores, reposición y órdenes de compra para PyMEs',
			'description' => 'Cumbre Compras ayuda a comprar mejor, reponer a tiempo, evitar quiebres de stock y gestionar proveedores, solicitudes, órdenes y recepciones conectadas a Stock y Catálogo.',
		),
		'erp-cumbre/cumbre-tesoreria' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'tesorería para PyMEs',
			'synonyms'    => 'Cumbre Tesorería, software de tesorería Argentina, conciliación bancaria asistida, cashflow para empresas, control de caja y bancos, billeteras virtuales empresas, pagos a proveedores, ERP financiero Argentina, bancos argentinos, extractos CSV OFX PDF',
			'title'       => 'Cumbre Tesorería | Bancos, caja, conciliación y cashflow para PyMEs',
			'description' => 'Cumbre Tesorería centraliza bancos, billeteras y caja, importa movimientos, concilia con confirmación humana, programa pagos a proveedores y proyecta cashflow.',
		),
		'erp-cumbre/cumbre-contabilidad' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'contabilidad conectada al ERP',
			'synonyms'    => 'Cumbre Contabilidad, software contable para PyMEs, asientos contables ERP, plan de cuentas, libro diario, libro mayor, IVA compras, IVA ventas, cierre contable mensual, reportes contables, exportación para contador, centros de costo',
			'title'       => 'Cumbre Contabilidad | Asientos, cierres y libros conectados al ERP',
			'description' => 'Cumbre Contabilidad transforma ventas, compras, cobros, pagos y tesorería en asientos, cierres, libros, IVA y reportes trazables listos para revisar con tu contador.',
		),
		'erp-cumbre/cumbre-impuestos' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'impuestos para PyMEs argentinas',
			'synonyms'    => 'Cumbre Impuestos, software fiscal para PyMEs, posición IVA, IIBB por jurisdicción, retenciones y percepciones, calendario fiscal, vencimientos fiscales, saldos a pagar, saldos a favor, reportes fiscales para contador',
			'title'       => 'Cumbre Impuestos | IVA, IIBB, retenciones y vencimientos para PyMEs',
			'description' => 'Cumbre Impuestos ordena IVA, IIBB, retenciones, percepciones, saldos, vencimientos y reportes fiscales trazables para revisar con tu contador.',
		),
		'erp-cumbre/cumbre-reportes-bi' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'dashboards para PyMEs',
			'synonyms'    => 'Cumbre Reportes BI, KPIs empresariales, reportes gerenciales ERP, business intelligence para PyMEs, BI conectado al ERP, alertas ejecutivas, tableros de control, reportes Excel PDF CSV, dashboards gerenciales',
			'title'       => 'Cumbre Reportes BI | Dashboards, KPIs y alertas para PyMEs',
			'description' => 'Módulo BI de Cumbre ERP para consolidar dashboards, KPIs, alertas y reportes gerenciales conectados a ventas, stock, compras, tesorería, contabilidad e impuestos.',
		),
		'erp-cumbre/cumbre-planificacion' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'planificación financiera para PyMEs',
			'synonyms'    => 'Cumbre Planificación, presupuestos internos, escenarios financieros, cashflow proyectado, forecast de caja, real vs plan, proyecciones empresariales, presupuesto anual empresa, escenarios de estrés, comparar real contra planificado',
			'title'       => 'Cumbre Planificación | Presupuestos, escenarios y proyecciones para PyMEs',
			'description' => 'Módulo de Cumbre ERP para planificar ingresos, costos, impuestos y caja con presupuestos internos, escenarios, forecast y comparativo real vs plan.',
		),
		'erp-cumbre/cumbre-activos-fijos' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'activos fijos ERP',
			'synonyms'    => 'Cumbre Activos Fijos, bienes de uso, control de activos fijos, amortización lineal, mantenimiento de activos, bajas de activos, trazabilidad contable, patrimonio empresa, activos fijos PyMEs, valor libro',
			'title'       => 'Cumbre Activos Fijos | Bienes de uso, amortizaciones y trazabilidad contable',
			'description' => 'Módulo de Cumbre ERP para administrar bienes de uso: altas, ubicaciones, responsables, amortización lineal, mantenimiento, bajas y trazabilidad contable.',
		),
		'erp-cumbre/cumbre-whatsapp-hub' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'WhatsApp Business API Argentina',
			'synonyms'    => 'Cumbre WhatsApp Hub, WhatsApp Business Cloud API, Meta WhatsApp API, CRM WhatsApp para PyMEs, agente conversacional ERP, webhooks WhatsApp seguros, plantillas Meta, opt-in WhatsApp, API oficial de Meta por cliente, WhatsApp ERP, costos WhatsApp API',
			'title'       => 'Cumbre WhatsApp Hub | WhatsApp Business API Argentina conectado al ERP',
			'description' => 'WhatsApp Business API para PyMEs: costos Meta, API oficial por cliente, CRM, opt-in, plantillas, webhooks y ERP Cumbre conectado.',
		),
		'erp-cumbre/cumbre-personal' => array( 'cluster' => 'erp', 'focuskw' => 'software de recursos humanos para PyMEs', 'title' => 'Cumbre Personal | Software de RRHH, legajos y asistencia para PyMEs', 'description' => 'Gestioná legajos digitales, asistencia, ausencias, novedades de liquidación y documentos laborales con Cumbre Personal, el módulo RRHH conectado a tu ERP.' ),
		'erp-cumbre/cumbre-marketing' => array( 'cluster' => 'erp', 'focuskw' => 'software de marketing para PyMEs', 'title' => 'Cumbre Marketing | Campañas, CRM y automatizaciones para PyMEs', 'description' => 'Creá segmentos, campañas por WhatsApp/email, audiencias y atribución comercial con Cumbre Marketing, conectado al CRM, eCommerce y ERP.' ),
		'erp-cumbre/cumbre-automatizaciones' => array( 'cluster' => 'erp', 'focuskw' => 'automatizaciones para ERP', 'title' => 'Cumbre Automatizaciones | Workflows seguros para ERP y PyMEs', 'description' => 'Automatizá tareas entre módulos del ERP con triggers, condiciones, acciones, webhooks, auditoría, idempotencia y aprobaciones humanas.' ),
		'erp-cumbre/cumbre-web' => array( 'cluster' => 'erp', 'focuskw' => 'sitio web conectado al ERP', 'title' => 'Cumbre Web | Sitio web, formularios y SEO conectados al ERP', 'description' => 'Conectá landings, formularios, eventos, SEO y conversiones con CRM, Marketing, WhatsApp y Reportes BI usando Cumbre Web.' ),
		'erp-cumbre/cumbre-ventas' => array( 'cluster' => 'erp', 'focuskw' => 'software de ventas para PyMEs', 'title' => 'Cumbre Ventas | POS, ventas, cobros, stock y facturación para PyMEs', 'description' => 'Unificá ventas mostrador, digitales y administrativas con stock, cobros, facturación, CRM, eCommerce y Mercado Libre conectados al ERP.' ),
		'erp-cumbre/cumbre-kioscos' => array( 'cluster' => 'erp', 'focuskw' => 'software para kioscos', 'title' => 'Cumbre Kioscos | ERP Cumbre para kioscos y minimercados', 'description' => 'Precios, stock y caja rápida para kioscos y minimercados, con ventas, stock, cobros, WhatsApp, reportes y automatizaciones de ERP Cumbre.' ),
		'erp-cumbre/cumbre-resto' => array( 'cluster' => 'erp', 'focuskw' => 'software para restaurantes', 'title' => 'Cumbre Resto | ERP Cumbre para gastronomía', 'description' => 'Comandas, caja y stock gastronómico conectados al ERP, con ventas, stock, cobros, WhatsApp, reportes y automatizaciones de ERP Cumbre.' ),
		'erp-cumbre/cumbre-depositos-wms' => array( 'cluster' => 'erp', 'focuskw' => 'WMS para PyMEs', 'title' => 'Cumbre Depósitos WMS | Ubicaciones, picking e inventario visual', 'description' => 'Depósitos, ubicaciones, picking e inventario visual para PyMEs, conectados a stock, ventas, eCommerce, WhatsApp, reportes y automatizaciones.' ),
		'erp-cumbre/cumbre-constructoras' => array( 'cluster' => 'erp', 'focuskw' => 'software para constructoras', 'title' => 'Cumbre Constructoras | Obras, certificados y facturación conectadas', 'description' => 'Obras, certificados, redeterminaciones y facturación conectadas con compras, tesorería, contabilidad, reportes y planificación de ERP Cumbre.' ),
		'erp-cumbre/cumbre-agro' => array( 'cluster' => 'erp', 'focuskw' => 'software agro', 'title' => 'Cumbre Agro | Cartas de porte, acopio y trazabilidad', 'description' => 'Cartas de porte, acopio, compras y trazabilidad agro conectadas con stock, tesorería, facturación, contabilidad, WhatsApp y reportes.' ),
		'erp-cumbre/cumbre-mercados' => array( 'cluster' => 'erp', 'focuskw' => 'software para mercados', 'title' => 'Cumbre Mercados | Góndolas, vencimientos y merma conectadas', 'description' => 'Góndolas, vencimientos, merma y promociones conectadas al ERP para mercados y autoservicios con stock, ventas, eCommerce, WhatsApp y BI.' ),
		'erp-cumbre/tutoriales-api-cumbre' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'tutoriales API ERP',
			'synonyms'    => 'Tutoriales API Cumbre, conectar Mercado Libre con ERP, conectar Mercado Pago con ERP, WooCommerce ERP, Google Merchant ERP, WhatsApp Business API, credenciales API seguras, webhooks Cumbre, integraciones ERP Cumbre, Secret Manager',
			'title'       => 'Tutoriales API Cumbre | Guías para conectar integraciones ERP',
			'description' => 'Guías paso a paso para conectar Mercado Libre, Mercado Pago, WooCommerce, Google Merchant, ARCA, WhatsApp Business, WordPress y otras APIs con Cumbre ERP.',
		),
		'cumbre/facturador' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'facturación electrónica ARCA',
			'synonyms'    => 'Cumbre Facturador ARCA, portal ARCA vs facturador, facturador para empresas argentinas, ERP con facturación electrónica, CAE, errores trazables, implementación asistida',
			'title'       => 'Cumbre Facturador ARCA | Portal ARCA vs facturador vs ERP integrado',
			'description' => 'Facturación electrónica ARCA integrada al ERP: portal ARCA vs facturador simple, CAE, errores trazables, cobros y producción asistida.',
			'canonical'   => '/erp-cumbre/cumbre-facturador-arca/',
		),
		'cumbre/legal' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'Cumbre Legal',
			'title'       => 'Cumbre Legal | Gestión documental legal asistida por IA para empresas',
			'description' => 'Cumbre Legal ayuda a crear, organizar y controlar borradores de contratos, acuerdos, NDAs, vencimientos y fuentes normativas verificables con IA y trazabilidad.',
			'canonical'   => '/erp-cumbre/cumbre-legal/',
		),
		'cumbre/stock' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'Cumbre Stock',
			'title'       => 'Cumbre Stock | Inventario agéntico con IA, depósitos y aprobación humana',
			'description' => 'Cumbre Stock controla inventario por depósito con IA, documentos inteligentes, cotejo contra Catálogo, aprobación humana, alertas y trazabilidad.',
			'canonical'   => '/erp-cumbre/cumbre-stock/',
		),
		'cumbre/compras' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'Cumbre Compras',
			'title'       => 'Cumbre Compras | Proveedores, reposición y órdenes de compra para PyMEs',
			'description' => 'Cumbre Compras ayuda a comprar mejor, reponer a tiempo, evitar quiebres de stock y gestionar proveedores, solicitudes, órdenes y recepciones conectadas a Stock y Catálogo.',
			'canonical'   => '/erp-cumbre/cumbre-compras/',
		),
		'cumbre/tesoreria' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'Cumbre Tesorería',
			'title'       => 'Cumbre Tesorería | Bancos, caja, conciliación y cashflow para PyMEs',
			'description' => 'Cumbre Tesorería centraliza bancos, billeteras y caja, importa movimientos, concilia con confirmación humana, programa pagos a proveedores y proyecta cashflow.',
			'canonical'   => '/erp-cumbre/cumbre-tesoreria/',
		),
		'cumbre/contabilidad' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'Cumbre Contabilidad',
			'title'       => 'Cumbre Contabilidad | Asientos, cierres y libros conectados al ERP',
			'description' => 'Cumbre Contabilidad transforma ventas, compras, cobros, pagos y tesorería en asientos, cierres, libros, IVA y reportes trazables listos para revisar con tu contador.',
			'canonical'   => '/erp-cumbre/cumbre-contabilidad/',
		),
		'cumbre/impuestos' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'Cumbre Impuestos',
			'title'       => 'Cumbre Impuestos | IVA, IIBB, retenciones y vencimientos para PyMEs',
			'description' => 'Cumbre Impuestos ordena IVA, IIBB, retenciones, percepciones, saldos, vencimientos y reportes fiscales trazables para revisar con tu contador.',
			'canonical'   => '/erp-cumbre/cumbre-impuestos/',
		),
		'cumbre/reportes-bi' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'Cumbre Reportes BI',
			'title'       => 'Cumbre Reportes BI | Dashboards, KPIs y alertas para PyMEs',
			'description' => 'Módulo BI de Cumbre ERP para consolidar dashboards, KPIs, alertas y reportes gerenciales conectados a ventas, stock, compras, tesorería, contabilidad e impuestos.',
			'canonical'   => '/erp-cumbre/cumbre-reportes-bi/',
		),
		'cumbre/planificacion' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'Cumbre Planificación',
			'title'       => 'Cumbre Planificación | Presupuestos, escenarios y proyecciones para PyMEs',
			'description' => 'Módulo de Cumbre ERP para planificar ingresos, costos, impuestos y caja con presupuestos internos, escenarios, forecast y comparativo real vs plan.',
			'canonical'   => '/erp-cumbre/cumbre-planificacion/',
		),
		'cumbre/activos-fijos' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'Cumbre Activos Fijos',
			'title'       => 'Cumbre Activos Fijos | Bienes de uso, amortizaciones y trazabilidad contable',
			'description' => 'Módulo de Cumbre ERP para administrar bienes de uso: altas, ubicaciones, responsables, amortización lineal, mantenimiento, bajas y trazabilidad contable.',
			'canonical'   => '/erp-cumbre/cumbre-activos-fijos/',
		),
		'cumbre/whatsapp-hub' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'WhatsApp Business API Argentina',
			'synonyms'    => 'Cumbre WhatsApp Hub, WhatsApp Business Cloud API, Meta WhatsApp API, CRM WhatsApp para PyMEs, costos WhatsApp API, opt-in WhatsApp, webhooks WhatsApp seguros',
			'title'       => 'Cumbre WhatsApp Hub | WhatsApp Business API Argentina conectado al ERP',
			'description' => 'WhatsApp Business API para PyMEs: costos Meta, API oficial por cliente, CRM, opt-in, plantillas, webhooks y ERP Cumbre conectado.',
			'canonical'   => '/erp-cumbre/cumbre-whatsapp-hub/',
		),
		'cumbre/personal' => array( 'cluster' => 'erp', 'focuskw' => 'Cumbre Personal', 'title' => 'Cumbre Personal | Software de RRHH, legajos y asistencia para PyMEs', 'description' => 'Gestioná legajos digitales, asistencia, ausencias, novedades de liquidación y documentos laborales con Cumbre Personal, el módulo RRHH conectado a tu ERP.', 'canonical' => '/erp-cumbre/cumbre-personal/' ),
		'cumbre/marketing' => array( 'cluster' => 'erp', 'focuskw' => 'Cumbre Marketing', 'title' => 'Cumbre Marketing | Campañas, CRM y automatizaciones para PyMEs', 'description' => 'Creá segmentos, campañas por WhatsApp/email, audiencias y atribución comercial con Cumbre Marketing, conectado al CRM, eCommerce y ERP.', 'canonical' => '/erp-cumbre/cumbre-marketing/' ),
		'cumbre/automatizaciones' => array( 'cluster' => 'erp', 'focuskw' => 'Cumbre Automatizaciones', 'title' => 'Cumbre Automatizaciones | Workflows seguros para ERP y PyMEs', 'description' => 'Automatizá tareas entre módulos del ERP con triggers, condiciones, acciones, webhooks, auditoría, idempotencia y aprobaciones humanas.', 'canonical' => '/erp-cumbre/cumbre-automatizaciones/' ),
		'cumbre/web' => array( 'cluster' => 'erp', 'focuskw' => 'Cumbre Web', 'title' => 'Cumbre Web | Sitio web, formularios y SEO conectados al ERP', 'description' => 'Conectá landings, formularios, eventos, SEO y conversiones con CRM, Marketing, WhatsApp y Reportes BI usando Cumbre Web.', 'canonical' => '/erp-cumbre/cumbre-web/' ),
		'cumbre/ventas' => array( 'cluster' => 'erp', 'focuskw' => 'Cumbre Ventas', 'title' => 'Cumbre Ventas | POS, ventas, cobros, stock y facturación para PyMEs', 'description' => 'Unificá ventas mostrador, digitales y administrativas con stock, cobros, facturación, CRM, eCommerce y Mercado Libre conectados al ERP.', 'canonical' => '/erp-cumbre/cumbre-ventas/' ),
		'cumbre/kioscos' => array( 'cluster' => 'erp', 'focuskw' => 'Cumbre Kioscos', 'title' => 'Cumbre Kioscos | ERP Cumbre para kioscos y minimercados', 'description' => 'Precios, stock y caja rápida para kioscos y minimercados, con ventas, stock, cobros, WhatsApp, reportes y automatizaciones de ERP Cumbre.', 'canonical' => '/erp-cumbre/cumbre-kioscos/' ),
		'cumbre/resto' => array( 'cluster' => 'erp', 'focuskw' => 'Cumbre Resto', 'title' => 'Cumbre Resto | ERP Cumbre para gastronomía', 'description' => 'Comandas, caja y stock gastronómico conectados al ERP, con ventas, stock, cobros, WhatsApp, reportes y automatizaciones de ERP Cumbre.', 'canonical' => '/erp-cumbre/cumbre-resto/' ),
		'cumbre/depositos-wms' => array( 'cluster' => 'erp', 'focuskw' => 'Cumbre Depósitos WMS', 'title' => 'Cumbre Depósitos WMS | Ubicaciones, picking e inventario visual', 'description' => 'Depósitos, ubicaciones, picking e inventario visual para PyMEs, conectados a stock, ventas, eCommerce, WhatsApp, reportes y automatizaciones.', 'canonical' => '/erp-cumbre/cumbre-depositos-wms/' ),
		'cumbre/constructoras' => array( 'cluster' => 'erp', 'focuskw' => 'Cumbre Constructoras', 'title' => 'Cumbre Constructoras | Obras, certificados y facturación conectadas', 'description' => 'Obras, certificados, redeterminaciones y facturación conectadas con compras, tesorería, contabilidad, reportes y planificación de ERP Cumbre.', 'canonical' => '/erp-cumbre/cumbre-constructoras/' ),
		'cumbre/agro' => array( 'cluster' => 'erp', 'focuskw' => 'Cumbre Agro', 'title' => 'Cumbre Agro | Cartas de porte, acopio y trazabilidad', 'description' => 'Cartas de porte, acopio, compras y trazabilidad agro conectadas con stock, tesorería, facturación, contabilidad, WhatsApp y reportes.', 'canonical' => '/erp-cumbre/cumbre-agro/' ),
		'cumbre/mercados' => array( 'cluster' => 'erp', 'focuskw' => 'Cumbre Mercados', 'title' => 'Cumbre Mercados | Góndolas, vencimientos y merma conectadas', 'description' => 'Góndolas, vencimientos, merma y promociones conectadas al ERP para mercados y autoservicios con stock, ventas, eCommerce, WhatsApp y BI.', 'canonical' => '/erp-cumbre/cumbre-mercados/' ),
		'cumbre/tutoriales-api' => array(
			'cluster'     => 'erp',
			'focuskw'     => 'Tutoriales API Cumbre',
			'title'       => 'Tutoriales API Cumbre | Guías para conectar integraciones ERP',
			'description' => 'Guías paso a paso para conectar Mercado Libre, Mercado Pago, WooCommerce, Google Merchant, ARCA, WhatsApp Business, WordPress y otras APIs con Cumbre ERP.',
			'canonical'   => '/erp-cumbre/tutoriales-api-cumbre/',
		),
	);
}

function gema_sovereign_detect_yoast_cluster( string $path, array $page ): string {
	$path = trim( $path, '/' );

	if ( '' === $path ) {
		return 'home';
	}

	if ( 'cumbre-crm' === $path || 'cumbre/crm' === $path || false !== strpos( $path, 'crm' ) ) {
		return 'crm';
	}

	if ( 'cumbre-erp-negocios' === $path || 'cumbre/negocios' === $path || false !== strpos( $path, 'negocios' ) ) {
		return 'negocios';
	}

	if ( 'erp-cumbre' === $path || 0 === strpos( $path, 'cumbre/' ) || 0 === strpos( $path, 'erp/' ) ) {
		return 'erp';
	}

	if ( 0 === strpos( $path, 'competencia' ) ) {
		return 'comparativas';
	}

	if ( 0 === strpos( $path, 'pagos' ) || false !== strpos( $path, 'cobros' ) ) {
		return 'payments';
	}

	if ( false !== strpos( $path, 'marketing' ) || false !== strpos( $path, 'seo' ) ) {
		return 'marketing';
	}

	if ( false !== strpos( $path, 'ia' ) || false !== strpos( $path, 'automatizacion' ) ) {
		return 'ia';
	}

	return 'generic';
}

function gema_sovereign_build_yoast_entry( string $path, array $page, array $override = array() ): array {
	$clusters = gema_sovereign_get_yoast_cluster_defaults();
	$cluster  = $override['cluster'] ?? gema_sovereign_detect_yoast_cluster( $path, $page );
	$defaults = $clusters[ $cluster ] ?? $clusters['generic'];
	$key      = trim( $path, '/' );
	$url_map  = gema_sovereign_get_url_consolidation_map();
	$redirect = $url_map[ $key ] ?? null;
	$title    = $override['title'] ?? $page['seo_title'] ?? ( $page['title'] . ' | GEMA Digital' );
	$desc     = $override['description'] ?? $page['meta_description'] ?? $page['description'] ?? 'GEMA Digital desarrolla software, ERP, automatización, inteligencia artificial, integraciones y marketing digital para empresas reales.';
	$focuskw  = $override['focuskw'] ?? $page['focuskw'] ?? $defaults['focuskw'];
	$synonyms = $override['synonyms'] ?? $page['keywords'] ?? $defaults['synonyms'];
	$image    = $override['image'] ?? $defaults['image'];
	$canonical = $override['canonical'] ?? ( $redirect['target'] ?? '' );

	return array(
		'path'        => $key,
		'cluster'     => $cluster,
		'intent'      => $override['intent'] ?? $defaults['intent'],
		'focuskw'     => $focuskw,
		'synonyms'    => $synonyms,
		'title'       => $title,
		'description' => $desc,
		'og_title'    => $override['og_title'] ?? $title,
		'og_desc'     => $override['og_desc'] ?? $desc,
		'og_image'    => gema_sovereign_yoast_social_image_url( $image ),
		'canonical'   => $canonical ? home_url( $canonical ) : '',
	);
}

function gema_sovereign_get_yoast_seo_map(): array {
	$pages     = function_exists( 'gema_sovereign_get_local_page_definitions' ) ? gema_sovereign_get_local_page_definitions() : array();
	$primary   = gema_sovereign_get_yoast_primary_pages();
	$seo_pages = array();

	foreach ( $pages as $path => $page ) {
		$seo_pages[ trim( $path, '/' ) ] = gema_sovereign_build_yoast_entry( $path, $page, $primary[ trim( $path, '/' ) ] ?? array() );
	}

	foreach ( $primary as $path => $override ) {
		$key  = trim( $path, '/' );
		$page = $pages[ $key ] ?? array(
			'title'       => $override['title'] ?? 'GEMA Digital',
			'description' => $override['description'] ?? '',
		);
		$seo_pages[ $key ] = gema_sovereign_build_yoast_entry( $key, $page, $override );
	}

	return $seo_pages;
}

function gema_sovereign_update_yoast_global_options(): void {
	update_option( 'blogname', 'GEMA Digital' );
	update_option( 'blogdescription', 'Software, ERP, automatización, IA y marketing digital para empresas reales' );

	$seo_map = gema_sovereign_get_yoast_seo_map();
	$home    = $seo_map[''] ?? null;

	$titles = get_option( 'wpseo_titles', array() );
	if ( ! is_array( $titles ) ) {
		$titles = array();
	}

	if ( $home ) {
		$titles['title-home-wpseo']    = $home['title'];
		$titles['metadesc-home-wpseo'] = $home['description'];
	}

	$titles['separator'] = 'sc-dash';
	update_option( 'wpseo_titles', $titles );

	$social = get_option( 'wpseo_social', array() );
	if ( ! is_array( $social ) ) {
		$social = array();
	}

	$social['opengraph']    = true;
	$social['twitter']      = true;
	$social['twitter_card'] = 'summary_large_image';
	$social['facebook_site'] = 'https://www.facebook.com/gema.digital.erp/';
	$social['instagram_url'] = 'https://www.instagram.com/gema.digital.erp/';
	$social['linkedin_url']  = 'https://www.linkedin.com/company/gema-digital-erp';
	$social['youtube_url']   = 'https://www.youtube.com/@gema_digital_erp';

	if ( $home ) {
		$social['og_frontpage_title'] = $home['og_title'];
		$social['og_frontpage_desc']  = $home['og_desc'];
		$social['og_frontpage_image'] = $home['og_image'];
	}

	update_option( 'wpseo_social', $social );
}

function gema_sovereign_get_current_yoast_seo_entry(): ?array {
	$seo_map = gema_sovereign_get_yoast_seo_map();

	if ( is_front_page() || is_home() ) {
		return $seo_map[''] ?? null;
	}

	if ( ! is_page() ) {
		return null;
	}

	$page = get_queried_object();
	if ( ! $page instanceof WP_Post ) {
		return null;
	}

	$path = trim( get_page_uri( $page ), '/' );
	return $seo_map[ $path ] ?? null;
}

function gema_sovereign_get_current_consolidation_entry(): ?array {
	if ( ! is_page() ) {
		return null;
	}

	$page = get_queried_object();
	if ( ! $page instanceof WP_Post ) {
		return null;
	}

	$path = trim( get_page_uri( $page ), '/' );
	$map  = gema_sovereign_get_url_consolidation_map();

	return $map[ $path ] ?? null;
}

function gema_sovereign_redirect_consolidated_pages(): void {
	if ( is_admin() || ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) ) {
		return;
	}

	$entry = gema_sovereign_get_current_consolidation_entry();
	if ( ! $entry || '301' !== ( $entry['action'] ?? '' ) || empty( $entry['target'] ) ) {
		return;
	}

	wp_safe_redirect( home_url( $entry['target'] ), 301 );
	exit;
}
add_action( 'template_redirect', 'gema_sovereign_redirect_consolidated_pages', 1 );

function gema_sovereign_filter_consolidated_canonical( string $canonical ): string {
	$seo = gema_sovereign_get_current_yoast_seo_entry();
	if ( ! empty( $seo['canonical'] ) ) {
		return $seo['canonical'];
	}

	$entry = gema_sovereign_get_current_consolidation_entry();
	if ( ! empty( $entry['target'] ) ) {
		return home_url( $entry['target'] );
	}

	return $canonical;
}
add_filter( 'wpseo_canonical', 'gema_sovereign_filter_consolidated_canonical', 45 );
add_filter( 'rank_math/frontend/canonical', 'gema_sovereign_filter_consolidated_canonical', 45 );

function gema_sovereign_filter_yoast_sitewide_title( string $title ): string {
	$seo = gema_sovereign_get_current_yoast_seo_entry();
	return $seo['title'] ?? $title;
}
add_filter( 'wpseo_title', 'gema_sovereign_filter_yoast_sitewide_title', 45 );
add_filter( 'rank_math/frontend/title', 'gema_sovereign_filter_yoast_sitewide_title', 45 );

function gema_sovereign_filter_yoast_sitewide_description( string $description ): string {
	$seo = gema_sovereign_get_current_yoast_seo_entry();
	return $seo['description'] ?? $description;
}
add_filter( 'wpseo_metadesc', 'gema_sovereign_filter_yoast_sitewide_description', 45 );
add_filter( 'rank_math/frontend/description', 'gema_sovereign_filter_yoast_sitewide_description', 45 );

function gema_sovereign_filter_yoast_sitewide_og_title( string $title ): string {
	$seo = gema_sovereign_get_current_yoast_seo_entry();
	return $seo['og_title'] ?? $title;
}
add_filter( 'wpseo_opengraph_title', 'gema_sovereign_filter_yoast_sitewide_og_title', 45 );
add_filter( 'wpseo_twitter_title', 'gema_sovereign_filter_yoast_sitewide_og_title', 45 );

function gema_sovereign_filter_yoast_sitewide_og_description( string $description ): string {
	$seo = gema_sovereign_get_current_yoast_seo_entry();
	return $seo['og_desc'] ?? $description;
}
add_filter( 'wpseo_opengraph_desc', 'gema_sovereign_filter_yoast_sitewide_og_description', 45 );
add_filter( 'wpseo_twitter_description', 'gema_sovereign_filter_yoast_sitewide_og_description', 45 );

function gema_sovereign_filter_yoast_sitewide_og_image( string $image ): string {
	$seo = gema_sovereign_get_current_yoast_seo_entry();
	return $seo['og_image'] ?? $image;
}
add_filter( 'wpseo_opengraph_image', 'gema_sovereign_filter_yoast_sitewide_og_image', 45 );
add_filter( 'wpseo_twitter_image', 'gema_sovereign_filter_yoast_sitewide_og_image', 45 );

function gema_sovereign_print_frontpage_og_image_fallback(): void {
	if ( ! ( is_front_page() || is_home() ) || ! defined( 'WPSEO_VERSION' ) ) {
		return;
	}

	$seo_map = gema_sovereign_get_yoast_seo_map();
	$home    = $seo_map[''] ?? null;
	if ( ! $home ) {
		return;
	}

	printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $home['og_image'] ) );
	printf( '<meta property="og:image:width" content="1200">' . "\n" );
	printf( '<meta property="og:image:height" content="630">' . "\n" );
}
add_action( 'wp_head', 'gema_sovereign_print_frontpage_og_image_fallback', 30 );

function gema_sovereign_apply_yoast_post_meta( int $post_id, array $seo ): void {
	$meta = array(
		'_yoast_wpseo_title'                 => $seo['title'],
		'_yoast_wpseo_metadesc'              => $seo['description'],
		'_yoast_wpseo_focuskw'               => $seo['focuskw'],
		'_yoast_wpseo_focuskeywords'         => wp_json_encode(
			array(
				array(
					'keyword' => $seo['focuskw'],
					'score'   => 0,
				),
			),
			JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
		),
		'_yoast_wpseo_keywordsynonyms'       => $seo['synonyms'],
		'_yoast_wpseo_opengraph-title'       => $seo['og_title'],
		'_yoast_wpseo_opengraph-description' => $seo['og_desc'],
		'_yoast_wpseo_opengraph-image'       => $seo['og_image'],
		'_yoast_wpseo_twitter-title'         => $seo['og_title'],
		'_yoast_wpseo_twitter-description'   => $seo['og_desc'],
		'_yoast_wpseo_twitter-image'         => $seo['og_image'],
		'_yoast_wpseo_canonical'             => $seo['canonical'],
	);

	foreach ( $meta as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}
}

function gema_sovereign_sync_yoast_seo_metadata(): array {
	gema_sovereign_update_yoast_global_options();

	$results = array(
		'updated' => array(),
		'missing' => array(),
	);

	foreach ( gema_sovereign_get_yoast_seo_map() as $path => $seo ) {
		$page = '' === $path ? get_option( 'page_on_front' ) : get_page_by_path( $path );
		if ( is_numeric( $page ) ) {
			$page = get_post( (int) $page );
		}

		if ( ! $page ) {
			$results['missing'][] = $path;
			continue;
		}

		gema_sovereign_apply_yoast_post_meta( (int) $page->ID, $seo );
		$results['updated'][] = $path;
	}

	update_option( 'gema_sovereign_yoast_last_sync', gmdate( 'c' ) );

	return $results;
}

function gema_sovereign_get_yoast_keyword_analysis(): array {
	$analysis = array();

	foreach ( gema_sovereign_get_yoast_seo_map() as $path => $seo ) {
		$analysis[] = array(
			'url'       => '/' . ( '' === $path ? '' : $path . '/' ),
			'focuskw'   => $seo['focuskw'],
			'cluster'   => $seo['cluster'],
			'intent'    => $seo['intent'],
			'semantic'  => $seo['synonyms'],
			'title'     => $seo['title'],
			'meta'      => $seo['description'],
			'og_image'  => $seo['og_image'],
		);
	}

	return $analysis;
}
