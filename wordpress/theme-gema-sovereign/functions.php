<?php
/**
 * Gema Sovereign theme bootstrap.
 *
 * @package GemaSovereign
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function gema_sovereign_enqueue_assets(): void {
	$theme = wp_get_theme();
	$version = $theme->get( 'Version' ) ?: '0.1.0';

	wp_enqueue_style(
		'gema-sovereign-style',
		get_stylesheet_uri(),
		array(),
		$version
	);

	wp_enqueue_script(
		'gema-theme-toggle',
		get_stylesheet_directory_uri() . '/assets/theme-toggle.js',
		array(),
		$version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'gema_sovereign_enqueue_assets' );

function gema_sovereign_enqueue_admin_assets(): void {
	$theme   = wp_get_theme();
	$version = $theme->get( 'Version' ) ?: '0.1.0';

	wp_enqueue_script(
		'gema-admin-behavior',
		get_stylesheet_directory_uri() . '/assets/admin-behavior.js',
		array(),
		$version,
		true
	);
}
add_action( 'admin_enqueue_scripts', 'gema_sovereign_enqueue_admin_assets' );

function gema_sovereign_apply_local_wordpress_preferences(): void {
	if ( false === strpos( home_url( '/' ), 'localhost' ) && false === strpos( home_url( '/' ), '127.0.0.1' ) ) {
		return;
	}

	if ( 'es_ES' !== get_option( 'WPLANG' ) ) {
		update_option( 'WPLANG', 'es_ES' );
	}
}
add_action( 'init', 'gema_sovereign_apply_local_wordpress_preferences', 1 );

function gema_sovereign_flush_local_rewrites_once(): void {
	if ( false === strpos( home_url( '/' ), 'localhost' ) && false === strpos( home_url( '/' ), '127.0.0.1' ) ) {
		return;
	}

	if ( get_option( 'gema_sovereign_rewrites_flushed_20260605' ) ) {
		return;
	}

	flush_rewrite_rules( false );
	update_option( 'gema_sovereign_rewrites_flushed_20260605', '1' );
}
add_action( 'init', 'gema_sovereign_flush_local_rewrites_once', 99 );

function gema_sovereign_get_organization_schema(): array {
	return array(
		'@type'        => 'ProfessionalService',
		'@id'          => home_url( '/#organization' ),
		'name'         => 'GEMA Digital',
		'alternateName' => array(
			'Gema Digital ERP',
			'GEMA Digital ERP',
		),
		'url'          => home_url( '/' ),
		'description'  => 'Software, ERP, automatizacion, inteligencia artificial y marketing digital para negocios, pymes y empresas.',
		'email'        => 'ventas@gema-digital.com',
		'telephone'    => '+54 9 11 6598-0069',
		'address'      => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Av. Alicia Moreau de Justo 740',
			'addressLocality' => 'Ciudad Autonoma de Buenos Aires',
			'addressRegion'   => 'Buenos Aires',
			'addressCountry'  => 'AR',
		),
		'areaServed'   => array(
			array(
				'@type' => 'AdministrativeArea',
				'name'  => 'AMBA',
			),
			array(
				'@type' => 'Country',
				'name'  => 'Argentina',
			),
			array(
				'@type' => 'Place',
				'name'  => 'Latinoamerica y publico de habla hispana',
			),
			array(
				'@type' => 'Country',
				'name'  => 'Espana',
			),
		),
		'contactPoint' => array(
			array(
				'@type'       => 'ContactPoint',
				'telephone'   => '0800 345 4474',
				'contactType' => 'customer service',
				'areaServed'  => 'AR',
				'availableLanguage' => array( 'es' ),
			),
			array(
				'@type'       => 'ContactPoint',
				'email'       => 'ventas@gema-digital.com',
				'contactType' => 'sales',
				'availableLanguage' => array( 'es' ),
			),
		),
		'sameAs'       => array(
			'https://www.facebook.com/gema.digital.erp/',
			'https://www.linkedin.com/company/gema-digital-erp',
			'https://www.instagram.com/gema.digital.erp/',
			'https://www.youtube.com/@gema_digital_erp',
			'https://www.tiktok.com/@gestiongema',
			'https://g.page/r/CRUtSuexEpbwEBM/review',
		),
		'knowsAbout'   => array(
			'ERP',
			'software de gestion empresarial',
			'automatizacion empresarial',
			'inteligencia artificial aplicada a negocios',
			'marketing digital',
			'SEO',
			'GEO',
			'integraciones',
		),
	);
}

function gema_sovereign_print_home_schema(): void {
	if ( ! is_front_page() ) {
		return;
	}

	$schema = array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			gema_sovereign_get_organization_schema(),
			array(
				'@type'       => 'WebSite',
				'@id'         => home_url( '/#website' ),
				'url'         => home_url( '/' ),
				'name'        => 'GEMA Digital',
				'description' => 'Software, IA y gestion empresarial para empresas reales.',
				'publisher'   => array(
					'@id' => home_url( '/#organization' ),
				),
				'inLanguage'  => 'es-AR',
			),
			array(
				'@type'       => 'Service',
				'@id'         => home_url( '/#service-gema-negocios' ),
				'name'        => 'GEMA Negocios',
				'serviceType' => 'Software de gestion para comercios y emprendedores',
				'description' => 'Solucion integral para facturacion, inventario y gestion de clientes.',
				'provider'    => array(
					'@id' => home_url( '/#organization' ),
				),
			),
			array(
				'@type'               => 'SoftwareApplication',
				'@id'                 => home_url( '/#erp-cumbre' ),
				'name'                => 'ERP Cumbre',
				'applicationCategory' => 'BusinessApplication',
				'operatingSystem'     => 'Web',
				'description'         => 'Software de gestion empresarial para contabilidad, recursos humanos, compras, ventas e integraciones.',
				'publisher'           => array(
					'@id' => home_url( '/#organization' ),
				),
			),
			array(
				'@type'       => 'Service',
				'@id'         => home_url( '/#service-ia-productiva' ),
				'name'        => 'IA Productiva',
				'serviceType' => 'Automatizacion e inteligencia artificial para empresas',
				'description' => 'Agentes conversacionales, automatizacion inteligente y observabilidad para procesos de negocio.',
				'provider'    => array(
					'@id' => home_url( '/#organization' ),
				),
			),
			array(
				'@type'      => 'FAQPage',
				'@id'        => home_url( '/#faq' ),
				'inLanguage' => 'es-AR',
				'mainEntity' => array(
					array(
						'@type'          => 'Question',
						'name'           => 'Que tipo de empresas pueden trabajar con GEMA Digital?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'GEMA Digital trabaja con comercios, emprendedores, pymes y empresas que necesitan software de gestion, automatizacion, integraciones o inteligencia artificial aplicada a procesos concretos.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'Que diferencia a GEMA Digital de una agencia web tradicional?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'GEMA Digital combina software empresarial, ERP, automatizacion, inteligencia artificial productiva, SEO/GEO y criterios de operacion real.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'ERP Cumbre es parte de GEMA Digital?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'Si. ERP Cumbre es el producto de gestion empresarial desarrollado por GEMA Digital.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'GEMA Digital implementa inteligencia artificial en negocios?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'Si. GEMA Digital disenia automatizaciones, agentes IA, asistentes conversacionales, flujos de datos y sistemas observables.',
						),
					),
				),
			),
		),
	);

	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
	);
}
add_action( 'wp_head', 'gema_sovereign_print_home_schema' );

function gema_sovereign_print_cumbre_schema(): void {
	if ( ! is_page( 'erp-cumbre' ) ) {
		return;
	}

	$schema = array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			gema_sovereign_get_organization_schema(),
			array(
				'@type'               => 'SoftwareApplication',
				'@id'                 => home_url( '/erp-cumbre/#software' ),
				'name'                => 'ERP Cumbre',
				'url'                 => home_url( '/erp-cumbre/' ),
				'applicationCategory' => 'BusinessApplication',
				'operatingSystem'     => 'Web',
				'description'         => 'ERP Cumbre es un software de gestion empresarial para centralizar ventas, compras, inventario, contabilidad, recursos humanos, integraciones y reportes.',
				'publisher'           => array(
					'@id' => home_url( '/#organization' ),
				),
				'offers'              => array(
					'@type'         => 'Offer',
					'availability'  => 'https://schema.org/InStock',
					'priceCurrency' => 'ARS',
					'url'           => home_url( '/contacto/' ),
				),
			),
			array(
				'@type'       => 'Service',
				'@id'         => home_url( '/erp-cumbre/#implementation' ),
				'name'        => 'Implementacion de ERP Cumbre',
				'serviceType' => 'Implementacion de software ERP y automatizacion empresarial',
			'description' => 'Diagnostico, configuracion, integraciones y acompaniamiento para implementar ERP Cumbre en comercios, pymes y empresas.',
				'provider'    => array(
					'@id' => home_url( '/#organization' ),
				),
			),
			array(
				'@type'      => 'FAQPage',
				'@id'        => home_url( '/erp-cumbre/#faq' ),
				'inLanguage' => 'es-AR',
				'mainEntity' => array(
					array(
						'@type'          => 'Question',
						'name'           => 'Que es ERP Cumbre?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'ERP Cumbre es un software de gestion empresarial desarrollado por GEMA Digital para centralizar ventas, compras, inventario, contabilidad, recursos humanos, integraciones y reportes.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'ERP Cumbre sirve para comercios y pymes?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'Si. ERP Cumbre puede adaptarse a comercios, emprendedores, pymes y empresas que necesitan ordenar su operacion y crecer con informacion confiable.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'ERP Cumbre incluye inteligencia artificial?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'ERP Cumbre puede incorporar automatizaciones, alertas, asistentes y analisis de datos para reducir tareas repetitivas y mejorar decisiones operativas.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'Como empiezo con ERP Cumbre?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'El primer paso es solicitar un diagnostico para entender procesos actuales, modulos necesarios, integraciones y prioridades de implementacion.',
						),
					),
				),
			),
		),
	);

	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
	);
}
add_action( 'wp_head', 'gema_sovereign_print_cumbre_schema' );

function gema_sovereign_print_solution_schema(): void {
	$solutions = array(
		'gema-negocios' => array(
			'name'        => 'GEMA Negocios',
			'type'        => 'Software de gestion para comercios y emprendedores',
			'description' => 'Solucion de gestion para ordenar ventas, facturacion, inventario, clientes y reportes en comercios, emprendedores y pymes.',
			'faq'         => array(
				array( 'Que es GEMA Negocios?', 'GEMA Negocios es una solucion de gestion para comercios, emprendedores y pymes que necesitan ordenar ventas, facturacion, inventario, clientes y reportes.' ),
				array( 'Sirve para un comercio chico?', 'Si. La propuesta esta pensada para empezar simple y crecer por modulos.' ),
				array( 'Puede integrarse con otros canales de venta?', 'Si. GEMA Negocios puede proyectarse con integraciones a ecommerce, Mercado Libre, herramientas administrativas y sistemas de cobro.' ),
			),
		),
		'ia-productiva' => array(
			'name'        => 'IA Productiva',
			'type'        => 'Automatizacion e inteligencia artificial para empresas',
			'description' => 'Servicio de inteligencia artificial aplicada a procesos reales: agentes conversacionales, automatizacion, RAG, reportes, integraciones y observabilidad.',
			'faq'         => array(
				array( 'Que es IA Productiva?', 'IA Productiva es el enfoque de GEMA Digital para implementar inteligencia artificial en procesos reales de negocio.' ),
				array( 'La IA reemplaza mi sistema actual?', 'No necesariamente. En muchos casos la IA se integra sobre sistemas existentes para automatizar tareas, responder consultas o mejorar el acceso a informacion.' ),
				array( 'Como se controla la calidad de la IA?', 'Con observabilidad: trazas, reglas, evaluaciones, costos, permisos y revision de resultados.' ),
			),
		),
	);

	foreach ( $solutions as $slug => $solution ) {
		if ( ! is_page( $slug ) ) {
			continue;
		}

		$faq = array();
		foreach ( $solution['faq'] as $item ) {
			$faq[] = array(
				'@type'          => 'Question',
				'name'           => $item[0],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $item[1],
				),
			);
		}

		$schema = array(
			'@context' => 'https://schema.org',
			'@graph'   => array(
				gema_sovereign_get_organization_schema(),
				array(
					'@type'       => 'Service',
					'@id'         => home_url( '/' . $slug . '/#service' ),
					'name'        => $solution['name'],
					'url'         => home_url( '/' . $slug . '/' ),
					'serviceType' => $solution['type'],
					'description' => $solution['description'],
					'provider'    => array(
						'@id' => home_url( '/#organization' ),
					),
				),
				array(
					'@type'      => 'FAQPage',
					'@id'        => home_url( '/' . $slug . '/#faq' ),
					'inLanguage' => 'es-AR',
					'mainEntity' => $faq,
				),
			),
		);

		printf(
			'<script type="application/ld+json">%s</script>' . "\n",
			wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		);
	}
}
add_action( 'wp_head', 'gema_sovereign_print_solution_schema' );

function gema_sovereign_get_local_page_definitions(): array {
	return array(
		'gestion'                       => array(
			'title'       => 'Gestion empresarial para negocios, pymes y empresas',
			'kicker'      => 'Gestion',
			'description' => 'GEMA Digital ayuda a ordenar la gestion de negocios y empresas con ERP Cumbre, software a medida, integraciones, automatizacion e inteligencia artificial aplicada a procesos reales.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/erp-cumbre-equipo-gestion-empresarial.webp',
				'alt' => 'Equipo de GEMA Digital trabajando en gestion empresarial, ERP Cumbre, procesos y control operativo',
			),
			'modules'     => array(
				array( 'Cumbre Negocios', 'Sistema de gestion para comercios, emprendedores y locales que necesitan ventas, caja, stock, clientes, facturacion, reportes simples y control diario sin depender de planillas.' ),
				array( 'Cumbre Empresas', 'ERP para pymes y empresas que requieren compras, ventas, inventario, contabilidad, tesoreria, recursos humanos, permisos, trazabilidad, tableros e integraciones.' ),
				array( 'Cumbre Constructoras', 'Gestion de obras, presupuestos, proveedores, compras, pagos, avances, centros de costo, documentacion y reportes para constructoras y desarrolladoras.' ),
				array( 'Cumbre Agro', 'Gestion para agroindustria, acopios y operaciones rurales con trazabilidad, stock, compras, ventas, comprobantes, cuentas corrientes, integraciones y reportes.' ),
				array( 'Cumbre Omnicanal', 'Gestion para ecommerce, locales fisicos y marketplaces que necesitan sincronizar stock, precios, ventas, pagos, facturacion y publicaciones.' ),
				array( 'Cumbre Servicios', 'Gestion para agencias, estudios y servicios profesionales con clientes, proyectos, agenda, tareas, propuestas, cobros, reportes y automatizaciones.' ),
			),
			'list'        => array(
				'Gestion no es solo cargar datos: es tener informacion confiable para vender, cobrar, comprar, pagar, medir y decidir.',
				'ERP Cumbre puede resolver procesos de caja, stock, facturacion, compras, proveedores, clientes, cuentas corrientes, bancos, reportes y permisos.',
				'GEMA adapta el modelo a cada operacion: comercio chico, pyme, empresa, constructora, agro, ecommerce, servicios o estructura mixta.',
				'El objetivo es que cada negocio deje de operar con planillas dispersas, sistemas aislados y decisiones tomadas sin datos.',
			),
			'faq'         => array(
				array( 'Que puede resolver GEMA en gestion?', 'Puede resolver orden operativo, ventas, caja, stock, facturacion, compras, proveedores, cuentas corrientes, bancos, reportes, permisos, integraciones y automatizaciones.' ),
				array( 'Tengo que adaptar mi empresa al software?', 'No. La idea es partir de su forma real de trabajar y adaptar tecnologia, procesos e implementacion a esa operacion.' ),
				array( 'Cumbre sirve para negocios chicos y empresas?', 'Si. Cumbre puede plantearse por modelos: negocios, empresas, constructoras, agro, ecommerce, servicios y otras verticales.' ),
			),
		),
		'empresas'                      => array(
			'title'       => 'Servicios para empresas, comercios, pymes y organizaciones',
			'kicker'      => 'Empresas',
			'description' => 'GEMA Digital brinda servicios de software, gestion, marketing, automatizacion e inteligencia artificial para distintos tipos de empresas, desde comercios y emprendedores hasta pymes, constructoras, agroindustrias y equipos corporativos.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/nosotros-equipo-gema-digital.webp',
				'alt' => 'Equipo de GEMA Digital reunido con empresas, pymes y clientes para diagnosticar soluciones de software e inteligencia artificial',
			),
			'modules'     => array(
				array( 'Comercios y emprendedores', 'Locales, profesionales y emprendimientos que necesitan facturar, vender, cobrar, controlar stock, ordenar clientes y crecer con presencia digital.' ),
				array( 'Pymes en crecimiento', 'Empresas que ya tienen equipo, procesos, proveedores y canales, pero necesitan control, reportes, integraciones y menos trabajo manual.' ),
				array( 'Empresas operativas', 'Organizaciones con areas, roles, permisos, aprobaciones, finanzas, compras, ventas, RRHH, datos y necesidad de trazabilidad.' ),
				array( 'Constructoras y desarrolladoras', 'Empresas que trabajan por obra, proyecto, presupuesto, proveedor, avance, centro de costo y control financiero.' ),
				array( 'Agroindustria y acopios', 'Operaciones que requieren trazabilidad, stock, comprobantes, compras, ventas, logistica, reportes y administracion ordenada.' ),
				array( 'Ecommerce y omnicanalidad', 'Negocios que venden por web, local, redes, Mercado Libre u otros canales y necesitan sincronizar ventas, pagos y stock.' ),
				array( 'Servicios profesionales', 'Agencias, estudios, consultoras y equipos de servicios que necesitan clientes, proyectos, propuestas, agenda, cobros y seguimiento.' ),
				array( 'Startups y equipos tech', 'Equipos que necesitan MVP, automatizaciones, integraciones, IA, datos, SEO/GEO y arquitectura escalable sin sobredimensionar.' ),
			),
			'list'        => array(
				'Podemos trabajar con empresas que necesitan ordenar gestion interna, vender mas, automatizar tareas o mejorar presencia digital.',
				'La propuesta cambia segun el tipo de cliente: no se atiende igual a un comercio de barrio que a una empresa con multiples areas.',
				'GEMA puede actuar como socio tecnico, implementador de ERP, agencia de marketing, equipo de automatizacion o combinacion de esos roles.',
				'El diagnostico inicial define prioridades, alcance, modulos, integraciones, contenido, campanias y automatizaciones recomendadas.',
			),
			'faq'         => array(
				array( 'Con que tipo de empresas trabaja GEMA?', 'Con comercios, emprendedores, pymes, empresas, constructoras, agroindustrias, ecommerce, servicios profesionales, startups y organizaciones con procesos para ordenar.' ),
				array( 'GEMA solo vende software?', 'No. Tambien puede prestar servicios de marketing, automatizacion, implementacion, integraciones, IA, SEO/GEO y acompanamiento operativo.' ),
				array( 'Como saben que necesita cada empresa?', 'El primer paso es un diagnostico para entender procesos, sistemas actuales, problemas, oportunidades y prioridades.' ),
			),
		),
		'marketing'                     => array(
			'title'       => 'Marketing digital, contenido, web, redes, SEO y campanias',
			'kicker'      => 'Marketing',
			'description' => 'GEMA Digital puede gestionar el marketing de su empresa o crear el software y los flujos para que su equipo lo haga internamente con Cumbre Marketing.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/marketing-digital-seo-redes-ads.webp',
				'alt' => 'Equipo revisando estrategia de marketing digital, SEO, redes sociales, campanias pagas y medicion de resultados',
			),
			'modules'     => array(
				array( 'Contenido y estrategia', 'Planificacion de contenidos, calendario editorial, mensajes comerciales, notas, publicaciones, guiones, piezas para redes y contenido orientado a SEO/GEO.' ),
				array( 'Sitios web y landing pages', 'Desarrollo de sitios web, paginas de servicios, landing pages, estructuras SEO, arquitectura de contenido, llamadas a la accion y formularios de contacto.' ),
				array( 'SEO y GEO', 'Optimizacion para Google, buscadores, respuestas generativas, entidades, preguntas frecuentes, interlinking, estructura semantica y contenido por intencion de busqueda.' ),
				array( 'Redes sociales', 'Contenido para Instagram, Facebook, LinkedIn, TikTok, YouTube, YouTube Shorts, X/Twitter, Pinterest, WhatsApp Business y publicaciones adaptadas a cada canal.' ),
				array( 'Campanias pagas', 'Google Ads, Meta Ads para Facebook e Instagram, LinkedIn Ads, TikTok Ads, YouTube Ads, remarketing, audiencias, conversiones y medicion de resultados.' ),
				array( 'Google Business Profile', 'Optimizacion de Google Mi Negocio / Google Business Profile, publicaciones, fotos, servicios, categorias, resenias y presencia local para busquedas cercanas.' ),
				array( 'Email y automatizaciones', 'Emails comerciales, newsletters, formularios, respuestas automaticas, CRM, seguimiento de leads, segmentacion y recuperacion de oportunidades.' ),
				array( 'Cumbre Marketing', 'Software y paneles para que la empresa gestione contenidos, campanias, calendarios, redes, leads, publicaciones y reportes con asistencia de IA.' ),
			),
			'list'        => array(
				'Podemos hacer el marketing por usted: contenido, web, redes, SEO, campanias, Google Business Profile y reportes.',
				'Tambien podemos construir el sistema para que su equipo lo haga internamente con procesos, software, IA y medicion.',
				'El contenido se adapta a cada red: Instagram, Facebook, LinkedIn, TikTok, YouTube, YouTube Shorts, X/Twitter, Pinterest, WhatsApp Business y Google Business Profile.',
				'La estrategia puede incluir SEO local, SEO nacional, GEO para respuestas generativas, campanias pagas y automatizacion de leads.',
				'El objetivo no es publicar por publicar: es atraer oportunidades, explicar servicios, construir autoridad y convertir consultas en ventas.',
			),
			'faq'         => array(
				array( 'GEMA puede manejar todo el marketing?', 'Si. Podemos encargarnos de contenido, web, redes, SEO, campanias, Google Business Profile, reportes y mejora continua.' ),
				array( 'Tambien puedo hacerlo con mi equipo?', 'Si. Podemos crear software, procesos y automatizaciones para que su equipo gestione marketing internamente con Cumbre Marketing.' ),
				array( 'Que redes puede trabajar GEMA?', 'Instagram, Facebook, LinkedIn, TikTok, YouTube, YouTube Shorts, X/Twitter, Pinterest, WhatsApp Business y Google Business Profile, segun el negocio.' ),
			),
		),
		'automatizacion'                => array(
			'title'       => 'Automatizacion empresarial adaptada a su forma de trabajar',
			'kicker'      => 'Automatizacion',
			'description' => 'GEMA Digital automatiza procesos reales de negocios y empresas. No buscamos que su operacion se adapte a nosotros: nosotros adaptamos software, IA e integraciones a su manera de trabajar.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/automatizacion-procesos-empresa.webp',
				'alt' => 'Reunion de automatizacion empresarial con procesos, integraciones, CRM, ERP, WhatsApp y reportes adaptados al cliente',
			),
			'modules'     => array(
				array( 'Automatizacion operativa', 'Flujos para ventas, compras, caja, stock, facturacion, clientes, proveedores, tareas, aprobaciones, reportes y seguimiento diario.' ),
				array( 'Agentes IA y asistentes', 'Agentes conversacionales, asistentes internos, consultas sobre datos, respuestas a clientes, generacion de documentos y soporte a equipos.' ),
				array( 'Integraciones a medida', 'Conexion entre ERP, ecommerce, Mercado Libre, bancos, pasarelas de pago, formularios, CRM, WhatsApp, planillas, APIs y sistemas heredados.' ),
				array( 'Criterio humano y control', 'Automatizaciones con permisos, reglas, aprobaciones, observabilidad, trazas y supervision para evitar riesgos innecesarios.' ),
			),
			'list'        => array(
				'1. Aviso automatico cuando un cliente importante baja su frecuencia de compra y conviene contactarlo.',
				'2. Reposicion inteligente que combina stock, ventas, estacionalidad, proveedor y tiempo de entrega.',
				'3. Conciliacion entre ventas, cobros, Mercado Pago, banco, posnet y caja diaria.',
				'4. Generacion automatica de presupuestos desde WhatsApp, formulario web o consulta comercial.',
				'5. Seguimiento de obras con alertas por desvio de costo, avance, pagos pendientes o compras criticas.',
				'6. Asistente interno que responde preguntas sobre ventas, stock, clientes, deudas, facturas o reportes.',
				'7. Publicacion semiautomatica de productos en web, redes y marketplace con control de stock.',
				'8. Clasificacion automatica de consultas entrantes por urgencia, rubro, producto, etapa y responsable.',
				'9. Reporte ejecutivo semanal enviado por email o WhatsApp con ventas, margen, cobranzas, stock y tareas pendientes.',
				'10. Flujo de alta de cliente o proveedor con validaciones, documentacion, permisos y tareas internas.',
				'Estas automatizaciones no suelen venir listas en ERP enlatados porque dependen de como trabaja cada negocio.',
				'GEMA puede crear automatizaciones especiales para su operacion, conectando software, datos, IA y procesos humanos.',
			),
			'faq'         => array(
				array( 'Tengo que cambiar mi forma de trabajar?', 'No. Primero entendemos su operacion y despues adaptamos software, integraciones e IA a sus procesos reales.' ),
				array( 'Que diferencia hay con un ERP enlatado?', 'Un ERP enlatado suele cubrir flujos generales. GEMA puede crear automatizaciones especiales para reglas, excepciones, canales y tareas propias de cada empresa.' ),
				array( 'Las automatizaciones son seguras?', 'Deben disenarse con permisos, limites, registros, aprobaciones y observabilidad segun el nivel de riesgo.' ),
			),
		),
		'suscripciones'                 => array(
			'title'       => 'Precios, planes y suscripciones',
			'kicker'      => 'Planes flexibles',
			'description' => 'Compare opciones para implementar ERP Cumbre, GEMA Negocios e inteligencia artificial productiva con una estructura de costos clara.',
			'modules'     => array(
				array( 'Planes por etapa', 'Empezar simple, validar necesidades y crecer por modulos sin sobredimensionar el proyecto.' ),
				array( 'Licenciamiento SaaS', 'Abonos mensuales para software, soporte, automatizaciones e integraciones segun alcance.' ),
				array( 'Implementacion guiada', 'Diagnostico, configuracion, capacitacion y acompaniamiento para que el sistema llegue a uso real.' ),
			),
			'list'        => array(
				'Planes para comercios, emprendedores, pymes y empresas.',
				'Opciones para software, IA, integraciones, soporte y mantenimiento.',
				'Presupuesto final definido despues del diagnostico operativo.',
			),
			'faq'         => array(
				array( 'Hay un unico precio?', 'No. El precio depende de modulos, usuarios, integraciones, soporte y alcance de implementacion.' ),
				array( 'Puedo empezar con algo simple?', 'Si. La propuesta permite empezar por una necesidad concreta y crecer por etapas.' ),
			),
		),
		'prueba-gratis'                 => array(
			'title'       => 'Prueba gratis y diagnostico inicial',
			'kicker'      => 'Demo y validacion',
			'description' => 'Solicite una evaluacion para entender si ERP Cumbre, GEMA Negocios o IA Productiva encajan con su operacion actual.',
			'modules'     => array(
				array( 'Relevamiento', 'Analizamos procesos, sistemas actuales, dolores operativos y prioridades de negocio.' ),
				array( 'Demo orientada', 'Mostramos flujos concretos segun rubro, equipo y necesidades reales.' ),
				array( 'Plan de avance', 'Definimos una ruta inicial con modulos, tiempos, integraciones y riesgos.' ),
			),
			'list'        => array(
				'Ideal para validar antes de invertir en implementacion.',
				'Permite ordenar alcance, prioridades y dependencias tecnicas.',
				'Puede derivar en demo, piloto o propuesta formal.',
			),
			'faq'         => array(
				array( 'La prueba reemplaza una implementacion?', 'No. La prueba ayuda a validar enfoque y alcance antes de una puesta en marcha real.' ),
				array( 'Necesito datos reales?', 'No al inicio. Podemos trabajar con escenarios representativos y luego avanzar con datos controlados.' ),
			),
		),
		'erp/precios'                   => array(
			'title'       => 'Precios de ERP Cumbre y prueba gratis de 14 dias',
			'kicker'      => 'Precio personalizado',
			'description' => 'Conozca como se cotiza ERP Cumbre: primero puede probar la version general durante 14 dias y luego se define una implementacion personalizada segun procesos, usuarios e integraciones.',
			'modules'     => array(
				array( 'Prueba general', 'La prueba gratuita de 14 dias permite conocer el producto sin personalizacion inicial.' ),
				array( 'Diagnostico comercial', 'La reunion inicial es gratuita, dura normalmente 45 minutos y sirve para entender alcance real.' ),
				array( 'Cotizacion responsable', 'El precio final depende de modulos, usuarios, integraciones, soporte, datos y nivel de implementacion.' ),
			),
			'list'        => array(
				'No publicamos un precio unico porque cada empresa tiene procesos, volumen e integraciones diferentes.',
				'La prueba gratis ayuda a validar si ERP Cumbre encaja antes de avanzar con una propuesta.',
				'El equipo comercial puede acompaniar por telefono, Meet o reunion presencial con cita previa.',
			),
			'faq'         => array(
				array( 'ERP Cumbre tiene prueba gratis?', 'Si. Se ofrece una prueba gratuita de 14 dias de la version general, sin personalizacion.' ),
				array( 'Por que no hay un precio fijo publicado?', 'Porque GEMA trabaja de forma personalizada. La cotizacion se define despues de entender procesos, usuarios, integraciones y soporte requerido.' ),
				array( 'La reunion inicial tiene costo?', 'No. La reunion inicial es gratuita y suele durar 45 minutos.' ),
			),
		),
		'erp/funciones/facturacion-electronica' => array(
			'title'       => 'Facturacion electronica, ARCA y gestion fiscal en ERP Cumbre',
			'kicker'      => 'Facturacion y administracion',
			'description' => 'ERP Cumbre puede organizar ventas, comprobantes, clientes, stock y procesos administrativos. Las integraciones fiscales se validan por caso y segun normativa aplicable.',
			'modules'     => array(
				array( 'Ventas y comprobantes', 'Centralizacion de clientes, ventas, comprobantes y seguimiento administrativo.' ),
				array( 'Stock conectado', 'Relacion entre ventas, disponibilidad, reposicion y trazabilidad operativa.' ),
				array( 'Validacion fiscal', 'Las conexiones fiscales deben revisarse segun pais, regimen, permisos y requisitos tecnicos.' ),
			),
			'list'        => array(
				'En Argentina se evalua alcance ARCA/AFIP segun necesidad e integracion disponible.',
				'Fuera de Argentina no se promete cumplimiento fiscal automatico sin validar normativa local.',
				'El objetivo es reducir carga manual y mejorar consistencia entre ventas, stock y administracion.',
			),
			'faq'         => array(
				array( 'ERP Cumbre puede manejar facturacion?', 'Si, puede contemplar procesos de facturacion y administracion, con alcance final validado por caso.' ),
				array( 'Sirve para normativa de otros paises?', 'GEMA trabaja con empresas de habla hispana, pero las integraciones fiscales fuera de Argentina requieren validacion normativa local.' ),
			),
		),
		'nosotros'                      => array(
			'title'       => 'GEMA Digital: software, IA y gestion para empresas reales',
			'kicker'      => 'Trayectoria y criterio operativo',
			'description' => 'GEMA Digital combina desarrollo de software, gestion empresarial, automatizacion e inteligencia artificial para resolver procesos concretos.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/nosotros-equipo-gema-digital.webp',
				'alt' => 'Equipo de GEMA Digital en una reunion de trabajo sobre software, ERP, automatizacion e inteligencia artificial para empresas',
			),
			'modules'     => array(
				array( 'Ingenieria aplicada', 'Construimos soluciones pensando en operacion, soporte, escalabilidad y continuidad.' ),
				array( 'Vision de negocio', 'No separamos tecnologia de gestion: cada modulo debe mejorar control, ventas o eficiencia.' ),
				array( 'Acompaniamiento', 'Trabajamos con diagnostico, implementacion, capacitacion y mejora continua.' ),
			),
			'list'        => array(
				'Software de gestion para comercios, pymes y empresas.',
				'Automatizacion e inteligencia artificial aplicada a procesos reales.',
				'SEO/GEO y arquitectura de contenido para crecimiento digital.',
			),
			'faq'         => array(
				array( 'GEMA Digital es solo una agencia web?', 'No. La propuesta combina software empresarial, ERP, IA, automatizacion, SEO/GEO y acompaniamiento operativo.' ),
				array( 'Trabajan con negocios chicos y empresas?', 'Si. El enfoque cambia segun el tipo de cliente, desde comercios hasta estructuras corporativas.' ),
			),
		),
		'contacto'                      => array(
			'title'       => 'Contacto y diagnostico',
			'kicker'      => 'Hablemos de su operacion',
			'description' => 'Cuentenos que necesita ordenar, automatizar o mejorar. Atendemos presencialmente en CABA y AMBA, y de forma remota a empresas de Argentina, Latinoamerica y habla hispana.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/contacto-diagnostico-cliente-pyme.webp',
				'alt' => 'Reunion de diagnostico entre GEMA Digital y un cliente pyme para evaluar software, ERP, automatizacion y marketing',
			),
			'modules'     => array(
				array( 'Email comercial', 'ventas@gema-digital.com para consultas, cotizaciones, diagnosticos y propuestas.' ),
				array( 'Telefono y WhatsApp', '0800 345 4474 y WhatsApp corporativo +54 9 11 6598-0069.' ),
				array( 'Direccion fisica', 'Av. Alicia Moreau de Justo 740, Ciudad Autonoma de Buenos Aires, Argentina.' ),
				array( 'Atencion remota', 'Reuniones por videollamada para AMBA, Argentina, Latinoamerica, Espana y publico de habla hispana.' ),
				array( 'Diagnostico', 'Relevamiento inicial para definir la mejor solucion, prioridades, integraciones, presupuesto y proximos pasos.' ),
			),
			'list'        => array(
				'Consultas por ERP Cumbre, GEMA Negocios e IA Productiva.',
				'Relevamiento para integraciones, automatizaciones y software a medida.',
				'Contacto comercial para comercios, pymes, empresas, profesionales, ecommerce, constructoras, agro y servicios.',
				'Prioridad comercial inicial: Cumbre Negocios y servicios de Marketing, sin descuidar ERP Cumbre, IA Productiva y automatizacion.',
			),
			'faq'         => array(
				array( 'Que informacion conviene enviar?', 'Rubro, cantidad de usuarios, sistemas actuales, problemas principales e integraciones necesarias.' ),
				array( 'Puedo consultar aunque no tenga todo definido?', 'Si. El diagnostico existe justamente para ordenar necesidades y prioridades.' ),
			),
		),
		'ia'                            => array(
			'title'       => 'Tecnologia e inteligencia artificial aplicada',
			'kicker'      => 'IA productiva',
			'description' => 'Servicios y componentes para llevar inteligencia artificial a procesos reales con control, trazabilidad y criterios de negocio.',
			'modules'     => array(
				array( 'Agentes autonomos', 'Asistentes y flujos agenticos para tareas repetitivas, consultas y operaciones.' ),
				array( 'Brainstore', 'Base de conocimiento y almacenamiento de contexto para respuestas utiles y auditables.' ),
				array( 'Observabilidad', 'Monitoreo de calidad, costos, trazas, permisos y comportamiento de modelos.' ),
			),
			'list'        => array(
				'Implementaciones de IA conectadas a datos, procesos y herramientas.',
				'Automatizaciones con reglas, supervision y medicion.',
				'Arquitecturas preparadas para evolucionar sin perder control.',
			),
			'faq'         => array(
				array( 'La IA se conecta con sistemas existentes?', 'Si. En muchos casos se integra con ERP, CRM, bases de datos, formularios o canales de atencion.' ),
				array( 'Como se evita que la IA responda cualquier cosa?', 'Con contexto controlado, permisos, evaluaciones, trazas, reglas y observabilidad.' ),
			),
		),
		'ia/brainstore'                 => array(
			'title'       => 'Brainstore: base de conocimiento para IA',
			'kicker'      => 'Datos y contexto',
			'description' => 'Brainstore organiza informacion, historiales y contexto para que los agentes y asistentes trabajen con datos utiles y recuperables.',
			'modules'     => array(
				array( 'Contexto reutilizable', 'Documentos, respuestas, datos y trazas disponibles para consultas futuras.' ),
				array( 'Busqueda semantica', 'Recuperacion de informacion relevante para mejorar respuestas y automatizaciones.' ),
				array( 'Trazabilidad', 'Base para auditar de donde sale una respuesta y como se uso la informacion.' ),
			),
			'list'        => array(
				'Reduce respuestas improvisadas al conectar la IA con conocimiento real.',
				'Ordena datos para agentes, asistentes y flujos internos.',
				'Aporta memoria operativa sin perder control de acceso.',
			),
			'faq'         => array(
				array( 'Brainstore es una base de datos tradicional?', 'No solamente. Es una capa de conocimiento y recuperacion pensada para IA aplicada.' ),
				array( 'Sirve para soporte interno?', 'Si. Puede alimentar asistentes para equipos, clientes, ventas, administracion o soporte.' ),
			),
		),
		'ia/observabilidad'             => array(
			'title'       => 'Observabilidad de IA y modelos LLM',
			'kicker'      => 'Control y calidad',
			'description' => 'Monitoree respuestas, costos, trazas, errores y calidad de automatizaciones basadas en inteligencia artificial.',
			'modules'     => array(
				array( 'Trazas', 'Registro de entradas, salidas, herramientas usadas y decisiones relevantes.' ),
				array( 'Calidad', 'Evaluacion de respuestas, desvios, regresiones y alucinaciones.' ),
				array( 'Costos', 'Control de consumo, tokens, llamadas, tiempos y eficiencia.' ),
			),
			'list'        => array(
				'Pensado para IA en produccion, no solo demostraciones.',
				'Ayuda a detectar fallas invisibles para software tradicional.',
				'Mejora seguridad, control y confianza operativa.',
			),
			'faq'         => array(
				array( 'Por que observar la IA?', 'Porque los modelos pueden cambiar resultados, costos y comportamiento aunque el sistema parezca funcionar.' ),
				array( 'Se puede medir cada respuesta?', 'Si. Se pueden registrar trazas, contexto, usuario, herramientas, costos y resultado.' ),
			),
		),
		'ia/agentes-autonomos'          => array(
			'title'       => 'Agentes autonomos de IA para procesos empresariales',
			'kicker'      => 'Flujos agenticos',
			'description' => 'Diseniamos agentes que ayudan a ejecutar tareas, consultar informacion y coordinar procesos con supervision y reglas claras.',
			'modules'     => array(
				array( 'Asistentes internos', 'Agentes para equipos administrativos, comerciales, soporte o direccion.' ),
				array( 'Automatizacion', 'Flujos que combinan datos, APIs, documentos y acciones controladas.' ),
				array( 'Supervision', 'Permisos, limites, aprobaciones y observabilidad para operar con confianza.' ),
			),
			'list'        => array(
				'Automatizacion de consultas, reportes y tareas repetitivas.',
				'Integracion con sistemas existentes y datos de negocio.',
				'Disenio por etapas para evitar riesgos innecesarios.',
			),
			'faq'         => array(
				array( 'Un agente puede ejecutar acciones?', 'Si, pero conviene hacerlo con permisos, reglas, logs y aprobaciones segun criticidad.' ),
				array( 'Sirve para atencion al cliente?', 'Si. Tambien puede servir para soporte interno, ventas, administracion y analisis operativo.' ),
			),
		),
		'ia/automatizacion-whatsapp'    => array(
			'title'       => 'Automatizacion WhatsApp para ventas B2B',
			'kicker'      => 'WhatsApp + IA + seguimiento',
			'description' => 'Diseniamos flujos de WhatsApp para capturar leads, responder consultas, derivar al equipo comercial, agendar reuniones y sostener seguimiento con control humano.',
			'modules'     => array(
				array( 'Captura de leads', 'Registro de nombre, WhatsApp o telefono y necesidad para no perder oportunidades comerciales.' ),
				array( 'Derivacion inteligente', 'El bot puede iniciar la conversacion y derivar a soporte o equipo comercial cuando corresponde.' ),
				array( 'Agenda y recordatorios', 'Integracion con Google Calendar, alertas internas y seguimiento posterior a la consulta.' ),
			),
			'list'        => array(
				'Ideal para empresas que reciben consultas por WhatsApp y necesitan orden comercial.',
				'Puede conectarse con CRM, ERP, formularios, sitio web y bases de datos.',
				'Se disena con limites, aprobaciones, trazabilidad y cuidado de datos personales.',
			),
			'faq'         => array(
				array( 'El bot vende solo?', 'No necesariamente. El enfoque recomendado es automatizar respuestas y seguimiento, manteniendo derivacion humana para oportunidades importantes.' ),
				array( 'Se puede conectar con mi CRM?', 'Si, se evalua segun API, permisos, estructura de datos y objetivos del proceso.' ),
				array( 'Puede agendar reuniones?', 'Si. Puede coordinar llamadas o Google Meet cuando el flujo y las credenciales esten configurados.' ),
			),
		),
		'tecnologia'                    => array(
			'title'       => 'Tecnologia para gestion, integraciones e IA',
			'kicker'      => 'Arquitectura operativa',
			'description' => 'Soluciones tecnicas para conectar sistemas, automatizar tareas, reducir costos y mejorar decisiones con informacion confiable.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/integraciones-erp-ecommerce-crm.webp',
				'alt' => 'Persona revisando integraciones entre ERP, ecommerce, CRM, datos y automatizaciones de negocio',
			),
			'modules'     => array(
				array( 'Costos cloud', 'Disenio eficiente para que la IA y el software sean sostenibles.' ),
				array( 'Conexion bancaria', 'Integraciones para conciliacion, tesoreria y control financiero.' ),
				array( 'Cumbre Negocios', 'Aplicacion SaaS para gestion minorista, ventas, caja y stock.' ),
			),
			'list'        => array(
				'Arquitectura pensada para crecer por modulos.',
				'Integraciones con sistemas, APIs y canales digitales.',
				'Automatizacion con criterios de seguridad, trazabilidad y soporte.',
			),
			'faq'         => array(
				array( 'GEMA trabaja solo con una tecnologia?', 'No. Elegimos herramientas segun necesidad, estabilidad, costos e integraciones.' ),
				array( 'Se puede integrar con sistemas actuales?', 'Si. Primero se evalua viabilidad, acceso a datos, APIs y riesgos.' ),
			),
		),
		'tecnologia/optimizacion-costos' => array(
			'title'       => 'Optimizacion de costos cloud e IA',
			'kicker'      => 'Eficiencia operativa',
			'description' => 'Diseniamos arquitecturas para que software, automatizaciones e IA sean utiles sin disparar costos innecesarios.',
			'modules'     => array(
				array( 'Consumo medible', 'Control de llamadas, tokens, almacenamiento, ejecuciones y tiempos.' ),
				array( 'Arquitectura eficiente', 'Uso de cache, recuperacion de contexto y automatizaciones bien acotadas.' ),
				array( 'Mejora continua', 'Analisis periodico para bajar desperdicio y sostener rendimiento.' ),
			),
			'list'        => array(
				'Reduce costos sin sacrificar utilidad operativa.',
				'Permite escalar IA con control financiero.',
				'Mejora tiempos, estabilidad y experiencia de usuario.',
			),
			'faq'         => array(
				array( 'La IA puede volverse cara?', 'Si. Por eso se disenian limites, cache, recuperacion eficiente y medicion de consumo.' ),
				array( 'Se puede optimizar despues de lanzar?', 'Si. La observabilidad permite detectar oportunidades y ajustar arquitectura.' ),
			),
		),
		'tecnologia/conexion-bancaria'  => array(
			'title'       => 'Conexion bancaria y tesoreria automatizada',
			'kicker'      => 'Finanzas conectadas',
			'description' => 'Integre movimientos, cobros, conciliaciones y control de caja para reducir carga manual y errores administrativos.',
			'modules'     => array(
				array( 'Conciliacion', 'Cruce de movimientos, comprobantes, cobros y cuentas corrientes.' ),
				array( 'Tesoreria', 'Visibilidad de caja, bancos, pagos, posnets y medios digitales.' ),
				array( 'Reportes', 'Indicadores para administracion, direccion y seguimiento financiero.' ),
			),
			'list'        => array(
				'Disminuye planillas manuales y carga repetitiva.',
				'Mejora control de cobros, pagos y saldos.',
				'Puede conectarse con ERP Cumbre y herramientas externas.',
			),
			'faq'         => array(
				array( 'Todos los bancos tienen API?', 'No siempre. La integracion depende de banco, proveedor, permisos y formato disponible.' ),
				array( 'Tambien sirve para Mercado Pago o posnets?', 'Si, se puede evaluar integracion con pasarelas y medios de cobro.' ),
			),
		),
		'tecnologia/cumbre-negocios'    => array(
			'title'       => 'ERP Cumbre Negocios para comercios',
			'kicker'      => 'Gestion minorista',
			'description' => 'Aplicacion SaaS para ventas, caja, stock, comandas, facturacion e informacion diaria de negocios y comercios.',
			'modules'     => array(
				array( 'Caja y ventas', 'Operacion diaria simple para registrar ventas, cobros y movimientos.' ),
				array( 'Stock', 'Control de productos, faltantes, reposicion y movimientos.' ),
				array( 'Movilidad', 'Pensado para trabajar desde tablet, celular o navegador segun el flujo.' ),
			),
			'list'        => array(
				'Ideal para comercios que necesitan empezar ordenados.',
				'Puede crecer hacia ERP Cumbre e integraciones mayores.',
				'Reduce dependencia de planillas y registros dispersos.',
			),
			'faq'         => array(
				array( 'Es lo mismo que ERP Cumbre?', 'Es una version orientada a negocios y gestion minorista, con posibilidad de crecer hacia modulos mas amplios.' ),
				array( 'Sirve para locales fisicos?', 'Si. Esta pensado para ventas, caja, stock y operacion diaria.' ),
			),
		),
		'servicios'                     => array(
			'title'       => 'Servicios de implementacion y acompaniamiento',
			'kicker'      => 'Del diagnostico al uso real',
			'description' => 'Acompaniamos la implementacion de software, IA e integraciones con criterio tecnico y operativo.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/soporte-capacitacion-cliente.webp',
				'alt' => 'Soporte y capacitacion de GEMA Digital para clientes durante la implementacion de software, ERP e IA',
			),
			'modules'     => array(
				array( 'Diagnostico', 'Entender procesos, sistemas actuales, datos e indicadores.' ),
				array( 'Implementacion', 'Configurar, integrar, probar y capacitar para uso real.' ),
				array( 'Soporte evolutivo', 'Medir, mejorar, automatizar y ajustar con el negocio en marcha.' ),
			),
			'list'        => array(
				'Servicios para comercios, pymes, empresas y equipos internos.',
				'Trabajo por etapas con prioridades claras.',
				'Integracion entre tecnologia, gestion y crecimiento digital.',
			),
			'faq'         => array(
				array( 'El servicio incluye capacitacion?', 'Si. La adopcion es parte clave de una implementacion exitosa.' ),
				array( 'Pueden trabajar con mi equipo?', 'Si. Podemos acompaniar a responsables internos, administracion, ventas o tecnologia.' ),
			),
		),
		'servicios/fde-engineering'     => array(
			'title'       => 'Forward Deployed Engineering para IA y ERP',
			'kicker'      => 'Ingenieria cerca del problema',
			'description' => 'Llevamos criterio tecnico al frente operativo para integrar sistemas, datos, APIs e IA en procesos concretos.',
			'modules'     => array(
				array( 'Relevamiento tecnico', 'Mapeo de sistemas, datos, restricciones, APIs y responsables.' ),
				array( 'Integracion', 'Conexion entre ERP, canales, bases de datos, automatizaciones y servicios externos.' ),
				array( 'Operacion', 'Pruebas, monitoreo, documentacion y mejora con usuarios reales.' ),
			),
			'list'        => array(
				'Ideal para proyectos donde la integracion define el exito.',
				'Reduce distancia entre negocio, usuarios y tecnologia.',
				'Permite validar soluciones en contexto real.',
			),
			'faq'         => array(
				array( 'Que significa FDE?', 'Forward Deployed Engineer: ingenieria aplicada cerca del usuario, el proceso y el problema real.' ),
				array( 'Sirve para IA?', 'Si. Muchos proyectos de IA fallan por falta de integracion, datos y operacion controlada.' ),
			),
		),
		'impuestos'                     => array(
			'title'       => 'Impuestos, facturacion y gestion fiscal',
			'kicker'      => 'Gestion administrativa',
			'description' => 'Herramientas y procesos para ordenar facturacion, impuestos, comprobantes y obligaciones administrativas.',
			'modules'     => array(
				array( 'Facturacion', 'Comprobantes, clientes, ventas y seguimiento administrativo.' ),
				array( 'Control fiscal', 'Datos ordenados para liquidaciones, reportes y obligaciones.' ),
				array( 'Integracion', 'Conexion con sistemas de gestion, contabilidad y canales comerciales.' ),
			),
			'list'        => array(
				'Pensado para Argentina y operaciones con necesidades fiscales concretas.',
				'Puede integrarse con ERP Cumbre y GEMA Negocios.',
				'Reduce dispersion entre facturacion, ventas y administracion.',
			),
			'faq'         => array(
				array( 'GEMA reemplaza a mi contador?', 'No. Ordena informacion y procesos para trabajar mejor con administracion y asesores.' ),
				array( 'Sirve para monotributo y empresas?', 'El alcance depende del caso, regimen, volumen e integraciones necesarias.' ),
			),
		),
		'impuestos/arca-fiscal'         => array(
			'title'       => 'Modulo fiscal ARCA y facturacion electronica',
			'kicker'      => 'Facturacion argentina',
			'description' => 'Gestion de comprobantes, datos fiscales y procesos administrativos conectados a la operacion comercial.',
			'modules'     => array(
				array( 'Comprobantes', 'Facturas, notas, clientes, condiciones y seguimiento.' ),
				array( 'IVA e impuestos', 'Informacion estructurada para control administrativo y reportes.' ),
				array( 'Operacion', 'Flujos pensados para comercios, pymes y empresas con volumen.' ),
			),
			'list'        => array(
				'Centraliza informacion fiscal y comercial.',
				'Mejora trazabilidad de ventas y comprobantes.',
				'Prepara la base para reportes e integraciones contables.',
			),
			'faq'         => array(
				array( 'Incluye facturacion electronica?', 'La pagina describe el modulo fiscal; el alcance final se define segun integraciones y requisitos.' ),
				array( 'Se integra con gestion de stock?', 'Si, puede integrarse con ventas, caja, clientes e inventario.' ),
			),
		),
		'sectores'                      => array(
			'title'       => 'Sectores, industrias y comercios para GEMA',
			'kicker'      => 'Soluciones por rubro',
			'description' => 'Adaptamos software, gestion e inteligencia artificial a negocios, comercios, pymes y empresas con necesidades operativas distintas.',
			'modules'     => array(
				array( 'Comercios', 'Ventas, caja, stock, clientes, facturacion y canales digitales.' ),
				array( 'Pymes', 'Procesos, reportes, integraciones, cuentas corrientes y control administrativo.' ),
				array( 'Empresas', 'Trazabilidad, permisos, automatizacion, IA y tableros de decision.' ),
			),
			'list'        => array(
				'GEMA Negocios para comercios y emprendedores.',
				'ERP Cumbre para operaciones que necesitan control integral.',
				'IA Productiva para automatizar tareas y decisiones repetitivas.',
			),
			'faq'         => array(
				array( 'Hay soluciones por rubro?', 'Si. El enfoque cambia segun operaciones, canales, stock, facturacion e integraciones.' ),
				array( 'Puedo empezar aunque mi rubro no este listado?', 'Si. El diagnostico permite adaptar el alcance al caso concreto.' ),
			),
		),
		'sectores/gema-negocios'        => array(
			'title'       => 'GEMA Negocios: servicios 360 para emprendedores',
			'kicker'      => 'Comercios y emprendedores',
			'description' => 'Acompaniamiento para ordenar gestion, presencia digital, facturacion, ventas, marketing e implementacion de tecnologia.',
			'modules'     => array(
				array( 'Alta y orden administrativo', 'Base para empezar a operar con estructura y menos improvisacion.' ),
				array( 'Gestion comercial', 'Ventas, clientes, canales, inventario y reportes simples.' ),
				array( 'Crecimiento digital', 'Web, SEO/GEO, campanias y automatizaciones segun etapa.' ),
			),
			'list'        => array(
				'Pensado para comercios, profesionales y emprendimientos.',
				'Integra gestion, marketing y tecnologia.',
				'Puede conectarse con GEMA Negocios y ERP Cumbre.',
			),
			'faq'         => array(
				array( 'Es solo software?', 'No. Es una propuesta de acompaniamiento 360 para ordenar gestion y crecimiento.' ),
				array( 'Sirve para un negocio que recien empieza?', 'Si. Justamente busca evitar desorden administrativo y comercial desde el inicio.' ),
			),
		),
		'sectores/directorio-minorista' => array(
			'title'       => 'Directorio de rubros comerciales y negocios',
			'kicker'      => 'Gestion por rubro',
			'description' => 'Soluciones para minimercados, indumentaria, gastronomia, servicios, ferreterias, tiendas online y otros comercios.',
			'modules'     => array(
				array( 'Retail', 'Stock, precios, caja, ventas, proveedores y reposicion.' ),
				array( 'Gastronomia', 'Comandas, productos, caja, turnos y control diario.' ),
				array( 'Servicios', 'Clientes, agenda, cobros, seguimiento y comunicacion.' ),
			),
			'list'        => array(
				'Cada rubro requiere datos, reportes e integraciones diferentes.',
				'El objetivo es reducir carga manual y mejorar control.',
				'Puede conectarse con canales digitales y medios de pago.',
			),
			'faq'         => array(
				array( 'Tienen soluciones para todos los rubros?', 'Se parte de patrones comunes y se ajusta el alcance segun cada operacion.' ),
				array( 'Puedo pedir una pagina por mi rubro?', 'Si. Es parte de la estrategia SEO/GEO y de adquisicion por sectores.' ),
			),
		),
		'sectores/agroindustria'        => array(
			'title'       => 'Software de gestion para agroindustria y acopios',
			'kicker'      => 'Sector agro',
			'description' => 'Gestion, trazabilidad, stock, compras, ventas, integraciones e informacion operativa para empresas agroindustriales.',
			'modules'     => array(
				array( 'Trazabilidad', 'Seguimiento de operaciones, unidades, comprobantes, movimientos y responsables.' ),
				array( 'Administracion', 'Compras, ventas, proveedores, cuentas corrientes y reportes.' ),
				array( 'Automatizacion', 'Alertas, integraciones y tableros para reducir tareas manuales.' ),
			),
			'list'        => array(
				'Soluciones adaptables a operaciones con volumen y datos dispersos.',
				'Integracion con facturacion, inventario, finanzas y reportes.',
				'Base para crecer hacia ERP Cumbre e IA Productiva.',
			),
			'faq'         => array(
				array( 'Sirve para acopios?', 'Puede adaptarse a acopios y operaciones agroindustriales segun procesos, datos e integraciones.' ),
				array( 'Incluye reportes?', 'Si. Los reportes se definen segun indicadores relevantes de cada operacion.' ),
			),
		),
		'sectores/constructoras'        => array(
			'title'       => 'Software de gestion para constructoras y desarrollos',
			'kicker'      => 'Construccion',
			'description' => 'Controle obras, presupuestos, compras, proveedores, pagos, avances e informacion financiera desde una base ordenada.',
			'modules'     => array(
				array( 'Obras y avances', 'Seguimiento de proyectos, etapas, responsables y estado operativo.' ),
				array( 'Compras y costos', 'Control de proveedores, materiales, presupuestos y pagos.' ),
				array( 'Reportes', 'Visibilidad para direccion sobre costos, desvios y prioridades.' ),
			),
			'list'        => array(
				'Reduce dispersion entre planillas, chats y documentos.',
				'Mejora control de costos y trazabilidad administrativa.',
				'Puede conectarse con tesoreria, facturacion y bancos.',
			),
			'faq'         => array(
				array( 'Sirve para varias obras?', 'Si. El alcance puede contemplar multiples proyectos, responsables y centros de costo.' ),
				array( 'Se puede integrar con contabilidad?', 'Si. Se evalua segun sistema actual, datos disponibles e integraciones.' ),
			),
		),
		'sectores/e-commerce'           => array(
			'title'       => 'Gestion para ecommerce y omnicanalidad',
			'kicker'      => 'Venta online',
			'description' => 'Unifique stock, ventas, precios, pedidos, facturacion y pagos entre tienda online, marketplace y negocio fisico.',
			'modules'     => array(
				array( 'Stock centralizado', 'Disponibilidad real entre canales para reducir errores y cancelaciones.' ),
				array( 'Pedidos', 'Gestion de ventas, estados, clientes, pagos y comprobantes.' ),
				array( 'Integraciones', 'Conexion con ecommerce, Mercado Libre, pasarelas y ERP.' ),
			),
			'list'        => array(
				'Pensado para negocios que venden en mas de un canal.',
				'Reduce carga manual y diferencias de stock.',
				'Mejora control comercial y administrativo.',
			),
			'faq'         => array(
				array( 'Integra Mercado Libre?', 'Si. Existe una pagina especifica para analizar esa integracion.' ),
				array( 'Sirve para tienda fisica y online?', 'Si. La omnicanalidad busca unificar ambas operaciones.' ),
			),
		),
		'sectores/servicios-profesionales' => array(
			'title'       => 'Gestion para servicios profesionales y agencias',
			'kicker'      => 'Servicios',
			'description' => 'Organice clientes, proyectos, tareas, cobros, agenda, propuestas, reportes e inteligencia artificial para equipos de servicios.',
			'modules'     => array(
				array( 'Clientes', 'Historial, seguimiento comercial, comunicaciones y oportunidades.' ),
				array( 'Proyectos', 'Tareas, entregables, responsables, tiempos y estado de avance.' ),
				array( 'Automatizacion', 'Asistentes, reportes y flujos para reducir trabajo repetitivo.' ),
			),
			'list'        => array(
				'Ideal para estudios, consultoras, agencias y profesionales.',
				'Permite ordenar operaciones sin perder flexibilidad.',
				'Puede incorporar IA para soporte, ventas y gestion interna.',
			),
			'faq'         => array(
				array( 'Sirve para agencias?', 'Si. Puede organizar clientes, proyectos, entregables y seguimiento comercial.' ),
				array( 'Puede conectarse con herramientas actuales?', 'Si. Se evalua segun APIs, datos y prioridades.' ),
			),
		),
		'sectores/startups'             => array(
			'title'       => 'Software, IA y gestion para startups',
			'kicker'      => 'Crecimiento tecnico',
			'description' => 'Acompaniamiento para startups que necesitan producto, automatizacion, datos, integraciones, SEO/GEO y arquitectura escalable.',
			'modules'     => array(
				array( 'MVP y producto', 'Definicion, implementacion y mejora por etapas.' ),
				array( 'Automatizacion', 'Procesos internos, soporte, ventas y datos conectados.' ),
				array( 'SEO/GEO', 'Base de contenido y arquitectura para adquisicion organica.' ),
			),
			'list'        => array(
				'Enfoque practico para validar sin sobredimensionar.',
				'Integracion entre producto, datos, IA y crecimiento.',
				'Arquitectura pensada para evolucionar con el negocio.',
			),
			'faq'         => array(
				array( 'Trabajan con MVP?', 'Si. Podemos empezar por una version acotada y validar rapido.' ),
				array( 'Incluye estrategia de contenido?', 'Si. SEO/GEO puede formar parte del sistema de crecimiento.' ),
			),
		),
		'integraciones'                 => array(
			'title'       => 'Integraciones para conectar ventas, pagos y gestion',
			'kicker'      => 'Ecosistema conectado',
			'description' => 'Conectamos ERP, ecommerce, Mercado Libre, pasarelas de pago, bancos, formularios, CRMs y herramientas internas.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/integraciones-erp-ecommerce-crm.webp',
				'alt' => 'Persona revisando integraciones entre ERP, ecommerce, pagos, CRM, APIs y sistemas conectados',
			),
			'modules'     => array(
				array( 'Canales de venta', 'Sincronizacion con ecommerce, marketplaces y puntos de venta.' ),
				array( 'Pagos', 'Conexion con pasarelas, cobros, conciliaciones y reportes.' ),
				array( 'APIs y datos', 'Integraciones a medida para evitar carga duplicada.' ),
			),
			'list'        => array(
				'Reduce errores por carga manual.',
				'Mejora visibilidad y control entre sistemas.',
				'Permite automatizar procesos repetitivos.',
			),
			'faq'         => array(
				array( 'Se puede integrar cualquier sistema?', 'Depende de APIs, permisos, formatos y estabilidad del proveedor.' ),
				array( 'Conviene integrar todo desde el inicio?', 'No siempre. Se priorizan integraciones segun impacto y riesgo.' ),
			),
		),
		'integraciones/mercado-libre'   => array(
			'title'       => 'Integracion con Mercado Libre',
			'kicker'      => 'Omnicanalidad',
			'description' => 'Sincronice ventas, stock, publicaciones y facturacion para reducir quiebres, errores y trabajo manual.',
			'modules'     => array(
				array( 'Stock sincronizado', 'Evita vender productos sin disponibilidad real.' ),
				array( 'Ventas centralizadas', 'Unifica pedidos y datos comerciales con gestion interna.' ),
				array( 'Automatizacion', 'Reduce tareas repetidas entre marketplace, ERP y facturacion.' ),
			),
			'list'        => array(
				'Ideal para comercios con venta online y local fisico.',
				'Permite ordenar depositos, publicaciones y precios.',
				'Puede combinarse con pasarelas de pago y ERP Cumbre.',
			),
			'faq'         => array(
				array( 'La sincronizacion es inmediata?', 'El objetivo es acercarse a tiempo real, pero depende de API, volumen y arquitectura.' ),
				array( 'Sirve para varias cuentas?', 'Se puede evaluar segun permisos, estructura comercial e integraciones necesarias.' ),
			),
		),
		'tecnologia/pasarela-pagos'     => array(
			'title'       => 'Pasarela de pagos multidivisa',
			'kicker'      => 'Cobros conectados',
			'description' => 'Integre medios de pago locales e internacionales para mejorar ventas, conciliacion y control administrativo.',
			'modules'     => array(
				array( 'Cobros locales', 'Mercado Pago, bancos, posnets u otros medios segun disponibilidad.' ),
				array( 'Pagos internacionales', 'Opciones como Stripe o PayPal cuando el modelo lo requiere.' ),
				array( 'Conciliacion', 'Cruce de ventas, liquidaciones, comisiones y estados de cobro.' ),
			),
			'list'        => array(
				'Pensado para ecommerce, servicios y operaciones omnicanal.',
				'Reduce conciliacion manual y errores de seguimiento.',
				'Puede integrarse con ERP, web y reportes financieros.',
			),
			'faq'         => array(
				array( 'GEMA procesa los pagos?', 'GEMA integra proveedores de pago; las condiciones dependen de cada pasarela.' ),
				array( 'Puedo cobrar en distintas monedas?', 'Se evalua segun pais, proveedor, cuenta, moneda y requisitos legales.' ),
			),
		),
		'blog'                          => array(
			'title'       => 'Blog Gema: tecnologia, IA y gestion',
			'kicker'      => 'Conocimiento y novedades',
			'description' => 'Articulos sobre software de gestion, inteligencia artificial aplicada, integraciones, SEO/GEO y operacion empresarial.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/seo-visuals/seo-geo-nodo-conocimiento.webp',
				'alt' => 'Mapa de contenidos estructurados para blog tecnico, FAQ, comparativas, schema, datos y conversion SEO GEO',
			),
			'modules'     => array(
				array( 'IA aplicada', 'Casos, criterios y aprendizajes sobre IA en procesos reales.' ),
				array( 'Gestion empresarial', 'Contenido para ordenar ventas, caja, stock, finanzas y administracion.' ),
				array( 'Tecnologia', 'Integraciones, arquitectura, cloud, observabilidad y automatizacion.' ),
			),
			'list'        => array(
				'Hub de contenido para posicionamiento SEO y GEO.',
				'Base para responder dudas frecuentes de clientes.',
				'Canal para educar, atraer y convertir oportunidades.',
			),
			'faq'         => array(
				array( 'El blog sera tecnico o comercial?', 'Ambos. Debe explicar con claridad problemas reales y tambien sostener autoridad tecnica.' ),
				array( 'Sirve para SEO?', 'Si. Es una pieza central para crecer por busquedas, entidades, preguntas y temas relacionados.' ),
			),
		),
		'competencia'                   => array(
			'title'       => 'Comparativas de ERP y software de gestion',
			'kicker'      => 'Decision informada',
			'description' => 'Compare ERP Cumbre y el ecosistema GEMA frente a alternativas conocidas para elegir segun operacion, costos e integraciones.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/seo-visuals/seo-geo-nodo-conocimiento.webp',
				'alt' => 'Nodo visual de comparativas ERP con datos, FAQ, schema, integraciones y criterios de conversion para SEO y GEO',
			),
			'modules'     => array(
				array( 'Costo total', 'Licencias, implementacion, soporte, integraciones y mantenimiento.' ),
				array( 'Adaptacion local', 'Fiscalidad, medios de pago, canales e idioma operativo.' ),
				array( 'Flexibilidad', 'Capacidad para crecer por modulos, integrar datos e incorporar IA.' ),
			),
			'list'        => array(
				'Comparativas pensadas para pymes, comercios y empresas.',
				'Analisis orientado a decision, no a marketing vacio.',
				'Base para explicar diferencias frente a sistemas conocidos.',
			),
			'faq'         => array(
				array( 'Que se compara?', 'Costo, alcance, integraciones, soporte, adaptacion local, IA y facilidad de adopcion.' ),
				array( 'GEMA reemplaza a todos los ERP?', 'No siempre. La decision depende del caso, madurez, procesos y presupuesto.' ),
			),
		),
		'competencia/tango'             => array(
			'title'       => 'ERP Cumbre vs Tango Gestion',
			'kicker'      => 'Comparativa argentina',
			'description' => 'Analisis inicial para comparar ERP Cumbre con Tango Gestion en adopcion, flexibilidad, integraciones e inteligencia artificial.',
			'modules'     => array(
				array( 'Operacion local', 'Facturacion, administracion, stock y necesidades argentinas.' ),
				array( 'Modernizacion', 'Integraciones, cloud, automatizaciones y tableros.' ),
				array( 'Adopcion', 'Curva de aprendizaje, soporte, datos y cambio operativo.' ),
			),
			'list'        => array(
				'Pagina base para capturar busquedas comparativas.',
				'Debe completarse con tabla detallada antes de produccion.',
				'Enfoque consultivo y no agresivo contra competidores.',
			),
			'faq'         => array(
				array( 'Conviene migrar desde Tango?', 'Depende de procesos, integraciones, costos y objetivos de modernizacion.' ),
				array( 'Se pueden importar datos?', 'Se evalua segun formatos, calidad de informacion y alcance.' ),
			),
		),
		'competencia/odoo'              => array(
			'title'       => 'ERP Cumbre vs Odoo',
			'kicker'      => 'Comparativa ERP',
			'description' => 'Compare ERP Cumbre con Odoo en localizacion, implementacion, modulos, costos, soporte e integraciones.',
			'modules'     => array(
				array( 'Modularidad', 'Alcance funcional y crecimiento por etapas.' ),
				array( 'Localizacion', 'Adaptacion a operacion argentina, fiscalidad y canales.' ),
				array( 'Implementacion', 'Tiempo, costo, soporte y adopcion real.' ),
			),
			'list'        => array(
				'Odoo puede ser potente pero requiere buena implementacion.',
				'ERP Cumbre busca cercania operativa e integraciones locales.',
				'La decision depende de madurez tecnica y necesidades reales.',
			),
			'faq'         => array(
				array( 'Odoo es mejor o peor?', 'No hay respuesta unica. Depende de alcance, presupuesto, localizacion y equipo.' ),
				array( 'GEMA puede integrarse con Odoo?', 'Se puede evaluar si conviene integrar, migrar o convivir por etapas.' ),
			),
		),
		'competencia/sap'               => array(
			'title'       => 'ERP Cumbre vs SAP Business One',
			'kicker'      => 'Comparativa empresarial',
			'description' => 'Analisis para empresas que comparan ERP Cumbre con SAP Business One en costo, implementacion, flexibilidad e integraciones.',
			'modules'     => array(
				array( 'Escala', 'Necesidades de control, permisos, reportes y trazabilidad.' ),
				array( 'Costo y complejidad', 'Licencias, consultoria, mantenimiento y tiempo de adopcion.' ),
				array( 'Flexibilidad', 'Integraciones, automatizaciones y adaptacion al negocio.' ),
			),
			'list'        => array(
				'SAP puede ser adecuado para estructuras grandes y maduras.',
				'ERP Cumbre apunta a control con implementacion mas cercana.',
				'La comparativa debe revisarse segun cada operacion.',
			),
			'faq'         => array(
				array( 'ERP Cumbre reemplaza a SAP?', 'No necesariamente. Puede ser alternativa, complemento o etapa previa segun caso.' ),
				array( 'Que empresas deberian comparar?', 'Pymes y empresas que necesitan control sin sobredimensionar costos.' ),
			),
		),
		'competencia/netsuite'          => array(
			'title'       => 'ERP Cumbre vs Oracle NetSuite',
			'kicker'      => 'Comparativa cloud ERP',
			'description' => 'Compare ERP Cumbre con Oracle NetSuite considerando moneda, costos, implementacion, soporte e integraciones locales.',
			'modules'     => array(
				array( 'Cloud ERP', 'Escalabilidad, disponibilidad y operaciones distribuidas.' ),
				array( 'Costos', 'Licencias, moneda, implementacion y mantenimiento.' ),
				array( 'Localizacion', 'Necesidades fiscales, pagos, bancos y canales argentinos.' ),
			),
			'list'        => array(
				'NetSuite puede ser fuerte en empresas globales.',
				'ERP Cumbre busca cercania local y control gradual.',
				'La decision requiere analizar costo total y adopcion.',
			),
			'faq'         => array(
				array( 'Por que comparar con NetSuite?', 'Porque muchas empresas evaluan ERP cloud y necesitan entender costo total y localizacion.' ),
				array( 'ERP Cumbre es internacional?', 'La prioridad inicial es resolver operaciones reales con foco local y escalabilidad.' ),
			),
		),
		'competencia/holded'            => array(
			'title'       => 'ERP Cumbre vs Holded',
			'kicker'      => 'Comparativa para pymes',
			'description' => 'Compare ERP Cumbre con Holded para entender diferencias en gestion, localizacion, soporte, integraciones e IA.',
			'modules'     => array(
				array( 'Simplicidad', 'Facilidad de uso, puesta en marcha y adopcion.' ),
				array( 'Gestion local', 'Facturacion, pagos, bancos y procesos argentinos.' ),
				array( 'Crecimiento', 'Modulos, integraciones y automatizaciones a medida.' ),
			),
			'list'        => array(
				'Holded puede funcionar para gestion simple.',
				'ERP Cumbre busca mayor adaptacion a procesos e integraciones.',
				'La eleccion depende de etapa, equipo y complejidad.',
			),
			'faq'         => array(
				array( 'Holded sirve para Argentina?', 'Depende de requisitos fiscales, medios de pago e integraciones necesarias.' ),
				array( 'ERP Cumbre es mas complejo?', 'Puede crecer por etapas para evitar complejidad inicial innecesaria.' ),
			),
		),
		'atencion-personalizada'        => array(
			'title'       => 'Atencion personalizada para clientes GEMA',
			'kicker'      => 'Acompaniamiento humano',
			'description' => 'Canal de confianza para entender necesidades, ordenar prioridades y acompaniar decisiones de software, gestion e IA.',
			'modules'     => array(
				array( 'Diagnostico', 'Escucha inicial y relevamiento de problemas concretos.' ),
				array( 'Seguimiento', 'Prioridades, proximos pasos y comunicacion clara.' ),
				array( 'Soporte', 'Acompaniamiento durante implementacion y mejora continua.' ),
			),
			'list'        => array(
				'Pensado para reducir incertidumbre tecnica.',
				'Conecta negocio, tecnologia y operacion diaria.',
				'Complementa software con criterio y soporte humano.',
			),
			'faq'         => array(
				array( 'La atencion es automatizada?', 'Puede haber automatizaciones, pero el enfoque es mantener criterio humano cuando importa.' ),
				array( 'Como se empieza?', 'Con una consulta o diagnostico para entender contexto y prioridades.' ),
			),
		),
		'terminos'                      => array(
			'title'       => 'Terminos y condiciones',
			'kicker'      => 'Marco de uso y contratacion',
			'description' => 'Condiciones generales para el uso del sitio, comunicaciones comerciales, diagnosticos, propuestas y servicios ofrecidos por GEMA Digital.',
			'modules'     => array(
				array( 'Uso del sitio', 'El contenido publicado informa sobre soluciones de software, ERP, automatizacion, inteligencia artificial, marketing digital, integraciones y servicios relacionados. Puede actualizarse para reflejar cambios tecnicos, comerciales o normativos.' ),
				array( 'Propuestas y contratacion', 'Todo servicio profesional, implementacion, desarrollo, consultoria, diagnostico o producto se rige por una propuesta, presupuesto, orden de trabajo, contrato o acuerdo especifico aceptado por las partes.' ),
				array( 'Alcance de resultados', 'Los resultados de SEO, SEM, GEO, automatizacion, software, ERP o marketing dependen de datos disponibles, adopcion del cliente, integraciones externas, presupuesto, competencia, tiempos de implementacion y decisiones operativas.' ),
				array( 'Propiedad intelectual', 'Textos, disenos, codigo, recursos visuales, metodologias, documentacion, marcas y materiales del sitio pertenecen a GEMA Digital o a sus respectivos titulares, salvo indicacion expresa en contrario.' ),
				array( 'Servicios de terceros', 'Algunas soluciones pueden integrarse con plataformas como Google, Meta, WhatsApp, Mercado Libre, bancos, pasarelas de pago, CRMs, ERPs, servicios cloud u otras herramientas sujetas a terminos propios.' ),
				array( 'Uso responsable', 'El usuario se compromete a no utilizar el sitio, formularios, demos, accesos o comunicaciones para fines ilegales, abusivos, fraudulentos, de scraping no autorizado, interferencia tecnica o vulneracion de derechos.' ),
			),
			'list'        => array(
				'La informacion del sitio no constituye asesoramiento legal, fiscal, contable ni financiero. Para decisiones criticas debe consultarse a profesionales correspondientes.',
				'Los contratos, presupuestos, anexos tecnicos, acuerdos de confidencialidad y terminos particulares prevalecen sobre el contenido general publicado en el sitio.',
				'Las demostraciones, estimaciones, calculadoras, comparativas o ejemplos son orientativos y pueden variar segun el caso real, integraciones, datos y alcance contratado.',
				'GEMA Digital puede modificar contenidos, rutas, precios informativos, funcionalidades o condiciones generales del sitio para mantener informacion actualizada y precisa.',
				'El contacto comercial no genera obligacion de contratacion hasta que exista aceptacion expresa de una propuesta o acuerdo entre las partes.',
			),
			'faq'         => array(
				array( 'Estos terminos reemplazan un contrato?', 'No. Los terminos del sitio son generales. Cada proyecto, implementacion o servicio debe regirse por su propuesta, alcance y acuerdo especifico.' ),
				array( 'Las comparativas y calculadoras garantizan resultados?', 'No. Son referencias para orientar decisiones. Los resultados reales dependen de datos, procesos, integraciones, adopcion y contexto competitivo.' ),
				array( 'GEMA Digital trabaja con herramientas de terceros?', 'Si. Muchas soluciones pueden usar APIs, plataformas cloud, servicios publicitarios, pasarelas de pago, CRMs, marketplaces u otras herramientas sujetas a condiciones propias.' ),
			),
		),
		'privacidad'                    => array(
			'title'       => 'Politica de privacidad',
			'kicker'      => 'Datos, confianza y proteccion del cliente',
			'description' => 'Politica sobre como GEMA Digital puede recopilar, usar, proteger y conservar informacion de contacto, datos comerciales, formularios, analitica, diagnosticos y comunicaciones.',
			'modules'     => array(
				array( 'Datos que podemos recibir', 'Nombre, apellido, email, telefono, empresa, cargo, rubro, sitio web, pais, ciudad, mensaje, necesidades operativas, informacion enviada en formularios y datos necesarios para responder consultas o preparar propuestas.' ),
				array( 'Finalidad del tratamiento', 'Usamos la informacion para responder consultas, coordinar diagnosticos, elaborar propuestas, prestar servicios, mejorar el sitio, medir rendimiento, prevenir abuso y mantener comunicaciones comerciales relacionadas.' ),
				array( 'Datos de proyectos', 'En implementaciones de software, ERP, automatizacion o marketing, el cliente puede compartir informacion operativa. Esa informacion debe tratarse segun alcance contratado, confidencialidad, permisos y medidas de seguridad acordadas.' ),
				array( 'Herramientas y proveedores', 'Podemos utilizar servicios de hosting, correo, analitica, CRM, formularios, automatizacion, publicidad, videollamadas, almacenamiento, soporte o integraciones. Cada proveedor puede procesar datos segun sus propias politicas.' ),
				array( 'Seguridad y minimizacion', 'Aplicamos el criterio de recopilar solo lo necesario, limitar accesos, proteger informacion sensible y evitar usos incompatibles con la finalidad informada o acordada con el cliente.' ),
				array( 'Derechos del titular', 'Las personas pueden solicitar acceso, rectificacion, actualizacion, baja o informacion sobre sus datos escribiendo a los canales de contacto publicados por GEMA Digital.' ),
			),
			'list'        => array(
				'La informacion enviada por formularios se utiliza principalmente para responder consultas, diagnosticar necesidades y preparar propuestas comerciales o tecnicas.',
				'No vendemos datos personales como producto. Podemos compartir informacion solo cuando sea necesario para operar servicios, cumplir obligaciones, usar proveedores o ejecutar acuerdos.',
				'En proyectos B2B, la informacion operativa del cliente debe tratarse con confidencialidad y de acuerdo con permisos, usuarios, roles y alcances definidos.',
				'La retencion de datos debe limitarse al tiempo razonable para responder consultas, cumplir acuerdos, mantener registros comerciales, soporte, seguridad o requisitos aplicables.',
				'Esta politica debe revisarse antes de produccion definitiva con la configuracion real de analitica, CRM, cookies, formularios, publicidad y proveedores activos.',
			),
			'faq'         => array(
				array( 'Que datos pide GEMA Digital?', 'Principalmente datos de contacto, empresa, consulta y contexto necesario para responder, diagnosticar o preparar una propuesta.' ),
				array( 'GEMA vende datos personales?', 'No vendemos datos personales como producto. Podemos usar proveedores necesarios para operar el sitio, comunicaciones, analitica, CRM, publicidad o servicios contratados.' ),
				array( 'Como puedo pedir baja o correccion de mis datos?', 'Puede escribir por los canales de contacto publicados solicitando acceso, actualizacion, correccion o baja, indicando los datos necesarios para identificar la solicitud.' ),
			),
		),
		'politica-de-cookies'           => array(
			'title'       => 'Politica de cookies',
			'kicker'      => 'Transparencia digital',
			'description' => 'Informacion sobre el uso de cookies, tecnologias similares, analitica, medicion publicitaria y preferencias del usuario en el sitio de GEMA Digital.',
			'modules'     => array(
				array( 'Que son las cookies', 'Son pequenos archivos o identificadores que un sitio puede usar para recordar preferencias, medir uso, mejorar experiencia, mantener seguridad o analizar rendimiento.' ),
				array( 'Cookies necesarias', 'Permiten funciones basicas como navegacion, seguridad, formularios, preferencias tecnicas y funcionamiento estable del sitio. Sin ellas algunas partes pueden no operar correctamente.' ),
				array( 'Analitica y rendimiento', 'Podemos medir visitas, paginas consultadas, origen de trafico, eventos, conversiones y rendimiento para mejorar contenido, SEO, GEO, campanas y experiencia de usuario.' ),
				array( 'Publicidad y remarketing', 'Si se activan campanas, pueden usarse identificadores para medir anuncios, evitar repeticion excesiva, crear audiencias, optimizar conversiones o mostrar comunicaciones relevantes.' ),
				array( 'Herramientas externas', 'Servicios como Google, Meta, HubSpot, formularios, CRM, mapas, videos, chat, automatizaciones o integraciones pueden usar tecnologias propias sujetas a sus politicas.' ),
				array( 'Control del usuario', 'El usuario puede gestionar cookies desde el navegador, borrar datos almacenados o bloquear ciertas tecnologias. Algunas funciones del sitio pueden verse afectadas.' ),
			),
			'list'        => array(
				'La configuracion final de cookies debe alinearse con las herramientas reales activas en produccion.',
				'El sitio debe evitar cargas innecesarias y priorizar medicion clara, proporcional y orientada a mejorar experiencia, seguridad y conversion.',
				'Las cookies de analitica y publicidad deben informarse con transparencia cuando se activen herramientas concretas.',
				'Para SEO/GEO, una politica clara de cookies y privacidad ayuda a reforzar confianza, profesionalismo y cumplimiento frente a usuarios, Google y motores de IA.',
				'Si se incorpora banner de consentimiento, debe permitir informar, aceptar, rechazar o configurar categorias segun corresponda.',
			),
			'faq'         => array(
				array( 'El sitio usa cookies?', 'Puede utilizar cookies necesarias y, segun configuracion, tecnologias de analitica, medicion publicitaria, formularios, CRM o herramientas externas.' ),
				array( 'Puedo bloquear cookies?', 'Si. Puede hacerlo desde la configuracion del navegador, aunque algunas funciones de seguridad, formularios o preferencias pueden verse afectadas.' ),
				array( 'La politica cambiara?', 'Si se agregan herramientas como analitica, CRM, chat, pixel publicitario o automatizaciones, la politica debe actualizarse para reflejar el uso real.' ),
			),
		),
		'login'                         => array(
			'title'       => 'Acceso a clientes',
			'kicker'      => 'Portal en preparacion',
			'description' => 'Espacio reservado para futuros accesos a clientes, demos, soporte o paneles relacionados con productos GEMA.',
			'modules'     => array(
				array( 'Demos', 'Accesos controlados para pruebas y validaciones.' ),
				array( 'Soporte', 'Futuro punto de ingreso para clientes y seguimiento.' ),
				array( 'Productos', 'Acceso a herramientas, documentacion o paneles cuando esten disponibles.' ),
			),
			'list'        => array(
				'Pagina placeholder para evitar enlaces rotos.',
				'No habilita autenticacion real todavia.',
				'Debe conectarse al portal final cuando se defina la arquitectura.',
			),
			'faq'         => array(
				array( 'Ya puedo iniciar sesion?', 'Todavia no. Este acceso queda preparado para una etapa posterior.' ),
				array( 'Para que servira?', 'Para demos, soporte, clientes o herramientas internas segun roadmap.' ),
			),
		),
	);
}

function gema_sovereign_get_authority_references( string $path ): array {
	$references = array(
		'gestion'             => array(
			array( 'Normas internacionales de gestion de calidad ISO', 'https://www.iso.org/' ),
		),
		'empresas'            => array(
			array( 'Estrategia digital de la Union Europea', 'https://digital-strategy.ec.europa.eu/' ),
			array( 'Productividad empresarial segun la OCDE', 'https://www.oecd.org/' ),
		),
		'marketing'           => array(
			array( 'Documentacion oficial de Google Search Central', 'https://developers.google.com/search/docs' ),
			array( 'Buenas practicas de medicion digital en Google Analytics', 'https://support.google.com/analytics' ),
		),
		'automatizacion'      => array(
			array( 'Concepto de hiperautomatizacion segun Gartner', 'https://www.gartner.com/en/information-technology/glossary/hyperautomation' ),
		),
		'integraciones'       => array(
			array( 'Arquitectura de servicios web REST', 'https://restfulapi.net/' ),
			array( 'Estandares PCI para seguridad de pagos', 'https://www.pci-securitystandards.org/' ),
		),
		'tecnologia'          => array(
			array( 'Fundamentos de computacion en la nube de Google Cloud', 'https://cloud.google.com/learn' ),
		),
		'blog'                => array(
			array( 'World Economic Forum sobre futuro del empleo y tecnologia', 'https://www.weforum.org/' ),
			array( 'Documentacion oficial de Google Search Central', 'https://developers.google.com/search/docs' ),
		),
		'competencia'         => array(
			array( 'Comparativas de software de gestion en Capterra', 'https://www.capterra.es/' ),
		),
		'nosotros'            => array(
			array( 'Recomendacion de UNESCO sobre etica de la inteligencia artificial', 'https://www.unesco.org/en/artificial-intelligence/recommendation-ethics' ),
		),
		'privacidad'          => array(
			array( 'Guia oficial de la AEPD sobre proteccion de datos', 'https://www.aepd.es/' ),
		),
		'terminos'            => array(
			array( 'Boletin Oficial del Estado sobre legislacion vigente', 'https://www.boe.es/' ),
		),
		'politica-de-cookies' => array(
			array( 'Guia oficial de la AEPD sobre cookies', 'https://www.aepd.es/guia-cookies' ),
		),
	);

	return $references[ trim( $path, '/' ) ] ?? array();
}

function gema_sovereign_build_local_page_content( array $page, string $path = '' ): string {
	$modules = '';
	foreach ( $page['modules'] as $index => $module ) {
		$modules .= sprintf(
			'<article class="cumbre-module-card"><span>%s</span><h3>%s</h3><p>%s</p></article>',
			esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ),
			esc_html( $module[0] ),
			esc_html( $module[1] )
		);
	}

	$list = '';
	foreach ( $page['list'] as $item ) {
		$list .= sprintf( '<p>%s</p>', esc_html( $item ) );
	}

	$faq = '';
	foreach ( $page['faq'] as $item ) {
		$faq .= sprintf(
			'<details><summary>%s</summary><p>%s</p></details>',
			esc_html( $item[0] ),
			esc_html( $item[1] )
		);
	}

	$visual = '';
	if ( ! empty( $page['visual'] ) && is_array( $page['visual'] ) ) {
		$visual = sprintf(
			'<!-- wp:html --><figure class="gema-seo-visual"><img src="%s" alt="%s" width="1280" height="720" loading="lazy" decoding="async" /></figure><!-- /wp:html -->',
			esc_url( $page['visual']['src'] ),
			esc_attr( $page['visual']['alt'] )
		);
	}

	$references = '';
	foreach ( gema_sovereign_get_authority_references( $path ) as $reference ) {
		$references .= sprintf(
			'<li><a href="%s" target="_blank" rel="noopener noreferrer">%s</a></li>',
			esc_url( $reference[1] ),
			esc_html( $reference[0] )
		);
	}

	$authority_section = '';
	if ( '' !== $references ) {
		$authority_section = sprintf(
			'<!-- wp:group {"tagName":"section","className":"gema-content-section gema-authority-section","layout":{"type":"constrained"}} --><section class="wp-block-group gema-content-section gema-authority-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Referencias de autoridad</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Fuentes externas que respaldan este enfoque</h2><!-- /wp:heading --><!-- wp:html --><ul class="gema-authority-list">%s</ul><!-- /wp:html --></section><!-- /wp:group -->',
			$references
		);
	}

	return sprintf(
		'<!-- wp:group {"tagName":"section","className":"gema-content-hero","layout":{"type":"constrained"}} --><section class="wp-block-group gema-content-hero"><!-- wp:paragraph {"className":"gema-kicker"} --><p class="gema-kicker">%1$s</p><!-- /wp:paragraph --><!-- wp:heading {"level":1,"className":"cumbre-title"} --><h1 class="wp-block-heading cumbre-title">%2$s</h1><!-- /wp:heading --><!-- wp:paragraph {"className":"gema-content-copy"} --><p class="gema-content-copy">%3$s</p><!-- /wp:paragraph --><!-- wp:buttons {"className":"gema-content-actions"} --><div class="wp-block-buttons gema-content-actions"><!-- wp:button {"className":"btn-cta-primary"} --><div class="wp-block-button btn-cta-primary"><a class="wp-block-button__link wp-element-button" href="/contacto">Solicitar diagnostico</a></div><!-- /wp:button --><!-- wp:button {"className":"btn-cta-secondary"} --><div class="wp-block-button btn-cta-secondary"><a class="wp-block-button__link wp-element-button" href="/">Volver al inicio</a></div><!-- /wp:button --></div><!-- /wp:buttons -->%7$s</section><!-- /wp:group --><!-- wp:group {"tagName":"section","className":"gema-content-section","layout":{"type":"constrained"}} --><section class="wp-block-group gema-content-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Puntos clave</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Que resuelve esta pagina</h2><!-- /wp:heading --><!-- wp:html --><div class="gema-content-grid">%4$s</div><!-- /wp:html --></section><!-- /wp:group --><!-- wp:group {"tagName":"section","className":"gema-content-section gema-content-band","layout":{"type":"constrained"}} --><section class="wp-block-group gema-content-section gema-content-band"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Resumen operativo</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Informacion util para decidir</h2><!-- /wp:heading --><!-- wp:html --><div class="gema-content-list">%5$s</div><!-- /wp:html --></section><!-- /wp:group -->%8$s<!-- wp:group {"tagName":"section","className":"gema-faq-section","layout":{"type":"constrained"}} --><section class="wp-block-group gema-faq-section" aria-label="Preguntas frecuentes"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Preguntas frecuentes</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Respuestas rapidas</h2><!-- /wp:heading --><!-- wp:html --><div class="gema-faq-list">%6$s</div><!-- /wp:html --></section><!-- /wp:group -->',
		esc_html( $page['kicker'] ),
		esc_html( $page['title'] ),
		esc_html( $page['description'] ),
		$modules,
		$list,
		$faq,
		$visual,
		$authority_section
	);
}

function gema_sovereign_print_local_page_schema(): void {
	$pages = gema_sovereign_get_local_page_definitions();

	foreach ( $pages as $path => $page ) {
		if ( ! is_page( $path ) ) {
			continue;
		}

		$faq = array();
		foreach ( $page['faq'] as $item ) {
			$faq[] = array(
				'@type'          => 'Question',
				'name'           => $item[0],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $item[1],
				),
			);
		}

		$webpage = array(
			'@type'       => 'WebPage',
			'@id'         => home_url( '/' . trim( $path, '/' ) . '/#webpage' ),
			'name'        => $page['title'],
			'url'         => home_url( '/' . trim( $path, '/' ) . '/' ),
			'description' => $page['description'],
			'isPartOf'    => array(
				'@id' => home_url( '/#website' ),
			),
			'publisher'   => array(
				'@id' => home_url( '/#organization' ),
			),
			'inLanguage'  => 'es-AR',
		);

		$authority_references = gema_sovereign_get_authority_references( $path );
		if ( ! empty( $authority_references ) ) {
			$webpage['citation'] = array_map(
				static function ( array $reference ): string {
					return $reference[1];
				},
				$authority_references
			);
		}

		$schema = array(
			'@context' => 'https://schema.org',
			'@graph'   => array(
				gema_sovereign_get_organization_schema(),
				$webpage,
				array(
					'@type'      => 'FAQPage',
					'@id'        => home_url( '/' . trim( $path, '/' ) . '/#faq' ),
					'inLanguage' => 'es-AR',
					'mainEntity' => $faq,
				),
			),
		);

		printf(
			'<script type="application/ld+json">%s</script>' . "\n",
			wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		);
	}
}
add_action( 'wp_head', 'gema_sovereign_print_local_page_schema' );

function gema_sovereign_ensure_page_path( string $path, string $title, string $content, bool $force_update = false ): void {
	$segments = array_values( array_filter( explode( '/', trim( $path, '/' ) ) ) );
	$parent   = 0;
	$current  = '';

	foreach ( $segments as $index => $segment ) {
		$current = trim( $current . '/' . $segment, '/' );
		$is_last = count( $segments ) - 1 === $index;
		$page    = get_page_by_path( $current );

		if ( ! $page ) {
			$page_id = wp_insert_post(
				array(
					'post_title'   => $is_last ? $title : ucwords( str_replace( '-', ' ', $segment ) ),
					'post_name'    => $segment,
					'post_status'  => 'publish',
					'post_type'    => 'page',
					'post_parent'  => $parent,
					'post_content' => $is_last ? $content : '',
				)
			);
		} else {
			$page_id = $page->ID;

			if ( $is_last && ( $force_update || '' === trim( (string) $page->post_content ) ) ) {
				wp_update_post(
					array(
						'ID'           => $page_id,
						'post_title'   => $title,
						'post_content' => $content,
					)
				);
			}
		}

		$parent = (int) $page_id;
	}
}

function gema_sovereign_ensure_local_pages(): void {
	if ( false === strpos( home_url( '/' ), 'localhost' ) && false === strpos( home_url( '/' ), '127.0.0.1' ) ) {
		return;
	}

	$pages = array(
		'erp-cumbre'    => 'ERP Cumbre',
		'gema-negocios' => 'GEMA Negocios',
		'ia-productiva' => 'IA Productiva',
	);

	foreach ( $pages as $slug => $title ) {
		if ( get_page_by_path( $slug ) ) {
			continue;
		}

		wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			)
		);
	}

	foreach ( gema_sovereign_get_local_page_definitions() as $path => $page ) {
		$force_update = in_array( $path, array( 'gestion', 'empresas', 'marketing', 'automatizacion', 'nosotros', 'contacto', 'servicios', 'terminos', 'privacidad', 'politica-de-cookies', 'blog', 'competencia', 'integraciones', 'tecnologia', 'erp/precios', 'erp/funciones/facturacion-electronica', 'ia/automatizacion-whatsapp' ), true );

		gema_sovereign_ensure_page_path(
			$path,
			$page['title'],
			gema_sovereign_build_local_page_content( $page, $path ),
			$force_update
		);
	}
}
add_action( 'init', 'gema_sovereign_ensure_local_pages' );

function gema_sovereign_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );

	register_nav_menus(
		array(
			'primary' => __( 'Menu principal', 'gema-sovereign' ),
			'footer'  => __( 'Menu footer', 'gema-sovereign' ),
		)
	);
}
add_action( 'after_setup_theme', 'gema_sovereign_setup' );

