<?php
/**
 * Gema Sovereign theme bootstrap.
 *
 * @package GemaSovereign
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function gema_sovereign_asset_version( string $relative_path ): string {
	$path = get_stylesheet_directory() . '/' . ltrim( $relative_path, '/' );
	if ( file_exists( $path ) ) {
		return (string) filemtime( $path );
	}

	$theme = wp_get_theme();
	return $theme->get( 'Version' ) ?: '0.1.1';
}

function gema_sovereign_enqueue_assets(): void {
	wp_enqueue_style(
		'gema-sovereign-style',
		get_stylesheet_uri(),
		array(),
		gema_sovereign_asset_version( 'style.css' )
	);

	wp_enqueue_script(
		'gema-theme-toggle',
		get_stylesheet_directory_uri() . '/assets/theme-toggle.js',
		array(),
		gema_sovereign_asset_version( 'assets/theme-toggle.js' ),
		true
	);

	wp_enqueue_script(
		'gema-floating-agent',
		get_stylesheet_directory_uri() . '/assets/gema-floating-agent.js',
		array(),
		gema_sovereign_asset_version( 'assets/gema-floating-agent.js' ),
		true
	);

	wp_enqueue_script(
		'gema-google-events',
		get_stylesheet_directory_uri() . '/assets/gema-google-events.js',
		array(),
		gema_sovereign_asset_version( 'assets/gema-google-events.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'gema_sovereign_enqueue_assets' );

function gema_sovereign_defer_theme_scripts( string $tag, string $handle, string $src ): string {
	$deferred_handles = array( 'gema-theme-toggle', 'gema-floating-agent', 'gema-google-events' );
	if ( ! in_array( $handle, $deferred_handles, true ) || false !== strpos( $tag, ' defer' ) ) {
		return $tag;
	}

	return str_replace( ' src=', ' defer src=', $tag );
}
add_filter( 'script_loader_tag', 'gema_sovereign_defer_theme_scripts', 10, 3 );

function gema_sovereign_print_floating_agent(): void {
	if ( is_admin() ) {
		return;
	}
	?>
	<div class="gema-floating-agent" data-gema-floating-agent>
		<button class="gema-floating-agent__button" type="button" aria-label="Abrir asistente de GEMA Digital" aria-expanded="false">
			<span class="gema-floating-agent__orb" aria-hidden="true">
				<span class="gema-floating-agent__spark"></span>
			</span>
			<span class="gema-floating-agent__button-text">Asistente IA</span>
		</button>

		<section class="gema-floating-agent__panel" aria-label="Asistente virtual de GEMA Digital" hidden>
			<header class="gema-floating-agent__header">
				<div>
					<p class="gema-floating-agent__eyebrow">GEMA Digital</p>
					<h2>Asistente IA</h2>
				</div>
				<button class="gema-floating-agent__close" type="button" aria-label="Cerrar asistente">Cerrar</button>
			</header>

			<div class="gema-floating-agent__messages" aria-live="polite">
				<div class="gema-floating-agent__message gema-floating-agent__message--bot">
					Hola, soy el asistente de GEMA. Puedo analizar tu caso, recomendar qué módulo de Cumbre ERP conviene empezar, resolver FAQs y orientarte entre comparativas, precios, implementación, cobros, ARCA, seguridad o IA.
				</div>
			</div>

			<div class="gema-floating-agent__quick-actions" aria-label="Consultas rápidas">
				<button type="button" data-agent-topic="diagnostico">Analizar mi caso</button>
				<button type="button" data-agent-topic="arquitectura_cumbre">Qué módulo necesito</button>
				<button type="button" data-agent-topic="erp">ERP Cumbre</button>
				<button type="button" data-agent-topic="negocios">ERP Negocios</button>
				<button type="button" data-agent-topic="crm">Cumbre CRM</button>
				<button type="button" data-agent-topic="catalogo">Catálogo</button>
				<button type="button" data-agent-topic="stock">Cumbre Stock</button>
				<button type="button" data-agent-topic="compras">Cumbre Compras</button>
				<button type="button" data-agent-topic="tutoriales_api">Tutoriales API</button>
				<button type="button" data-agent-topic="cobros">Cumbre Cobros</button>
				<button type="button" data-agent-topic="tesoreria">Cumbre Tesorería</button>
				<button type="button" data-agent-topic="contabilidad">Cumbre Contabilidad</button>
				<button type="button" data-agent-topic="impuestos">Cumbre Impuestos</button>
				<button type="button" data-agent-topic="reportes_bi">Reportes BI</button>
				<button type="button" data-agent-topic="planificacion">Planificación</button>
				<button type="button" data-agent-topic="activos_fijos">Activos Fijos</button>
				<button type="button" data-agent-topic="whatsapp_hub">WhatsApp Hub</button>
				<button type="button" data-agent-topic="facturador">Facturador ARCA</button>
				<button type="button" data-agent-topic="legal">Cumbre Legal</button>
				<button type="button" data-agent-topic="faqs">FAQs</button>
				<button type="button" data-agent-topic="portales">Portales Cumbre</button>
				<button type="button" data-agent-topic="ia">IA Productiva</button>
				<button type="button" data-agent-topic="contacto">Hablar con GEMA</button>
			</div>

			<form class="gema-floating-agent__form">
				<label class="screen-reader-text" for="gema-agent-input">Escribi tu consulta</label>
				<input id="gema-agent-input" type="text" name="message" autocomplete="off" placeholder="Escribi tu consulta..." />
				<button type="submit">Enviar</button>
			</form>

			<p class="gema-floating-agent__note">El asistente orienta y registra consultas. ARCA y Gema Pagos se validan en implementación asistida antes de producción.</p>
		</section>
	</div>
	<?php
}
add_action( 'wp_footer', 'gema_sovereign_print_floating_agent' );

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


function gema_sovereign_get_cumbre_seo_title(): string {
	return 'ERP Cumbre | ERP para PyMEs argentinas, CRM, POS, ARCA y Cobros';
}

function gema_sovereign_get_cumbre_meta_description(): string {
	return 'ERP para PyMEs argentinas con CRM, POS, stock, cobros, Facturador ARCA, WhatsApp, BI y matriz para elegir según tamaño y operación.';
}

function gema_sovereign_get_cumbre_keywords(): string {
	return 'erp argentina, erp para pymes argentinas, que sistema erp conviene, software de gestión para pymes, sistema POS para comercios, CRM para PyMEs argentinas, CRM WhatsApp, Cumbre Empresas, Cumbre Facturador ARCA, portal ARCA vs facturador, facturación electrónica ARCA, facturador para empresas argentinas, erp con facturación electrónica, links de pago para empresas, conciliación de pagos, WhatsApp Business API Argentina, dashboards para PyMEs, stock compras bancos impuestos reportes, demo comercial erp';
}

function gema_sovereign_filter_document_title_parts( array $title ): array {
	if ( is_page( 'erp-cumbre' ) ) {
		$title['title'] = gema_sovereign_get_cumbre_seo_title();
		unset( $title['site'] );
	}

	return $title;
}
add_filter( 'document_title_parts', 'gema_sovereign_filter_document_title_parts', 20 );

function gema_sovereign_filter_wpseo_cumbre_title( string $title ): string {
	return is_page( 'erp-cumbre' ) ? gema_sovereign_get_cumbre_seo_title() : $title;
}
add_filter( 'wpseo_title', 'gema_sovereign_filter_wpseo_cumbre_title', 20 );
add_filter( 'rank_math/frontend/title', 'gema_sovereign_filter_wpseo_cumbre_title', 20 );

function gema_sovereign_filter_wpseo_cumbre_description( string $description ): string {
	return is_page( 'erp-cumbre' ) ? gema_sovereign_get_cumbre_meta_description() : $description;
}
add_filter( 'wpseo_metadesc', 'gema_sovereign_filter_wpseo_cumbre_description', 20 );
add_filter( 'rank_math/frontend/description', 'gema_sovereign_filter_wpseo_cumbre_description', 20 );

function gema_sovereign_get_current_local_page_definition(): ?array {
	$pages = gema_sovereign_get_local_page_definitions();
	foreach ( $pages as $path => $page ) {
		if ( is_page( $path ) ) {
			return $page;
		}
	}

	return null;
}

function gema_sovereign_filter_local_page_title_parts( array $title ): array {
	$page = gema_sovereign_get_current_local_page_definition();
	if ( $page && ! empty( $page['seo_title'] ) ) {
		$title['title'] = $page['seo_title'];
		unset( $title['site'] );
	}

	return $title;
}
add_filter( 'document_title_parts', 'gema_sovereign_filter_local_page_title_parts', 30 );

function gema_sovereign_filter_local_page_seo_title( string $title ): string {
	$page = gema_sovereign_get_current_local_page_definition();
	return $page && ! empty( $page['seo_title'] ) ? $page['seo_title'] : $title;
}
add_filter( 'wpseo_title', 'gema_sovereign_filter_local_page_seo_title', 30 );
add_filter( 'rank_math/frontend/title', 'gema_sovereign_filter_local_page_seo_title', 30 );

function gema_sovereign_filter_local_page_seo_description( string $description ): string {
	$page = gema_sovereign_get_current_local_page_definition();
	return $page && ! empty( $page['meta_description'] ) ? $page['meta_description'] : $description;
}
add_filter( 'wpseo_metadesc', 'gema_sovereign_filter_local_page_seo_description', 30 );
add_filter( 'rank_math/frontend/description', 'gema_sovereign_filter_local_page_seo_description', 30 );

function gema_sovereign_print_local_page_meta_tags(): void {
	$page = gema_sovereign_get_current_local_page_definition();
	if ( ! $page ) {
		return;
	}

	if ( ! defined( 'WPSEO_VERSION' ) && ! defined( 'RANK_MATH_VERSION' ) && ! empty( $page['meta_description'] ) ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $page['meta_description'] ) );
	}

	if ( ! empty( $page['keywords'] ) ) {
		printf( '<meta name="keywords" content="%s">' . "\n", esc_attr( $page['keywords'] ) );
	}
}
add_action( 'wp_head', 'gema_sovereign_print_local_page_meta_tags', 3 );

function gema_sovereign_print_cumbre_meta_tags(): void {
	if ( ! is_page( 'erp-cumbre' ) ) {
		return;
	}

	if ( ! defined( 'WPSEO_VERSION' ) && ! defined( 'RANK_MATH_VERSION' ) ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( gema_sovereign_get_cumbre_meta_description() ) );
	}

	printf( '<meta name="keywords" content="%s">' . "\n", esc_attr( gema_sovereign_get_cumbre_keywords() ) );
}
add_action( 'wp_head', 'gema_sovereign_print_cumbre_meta_tags', 2 );

function gema_sovereign_get_google_tool_value( string $constant, string $option ): string {
	if ( defined( $constant ) && is_scalar( constant( $constant ) ) ) {
		return trim( (string) constant( $constant ) );
	}

	return trim( (string) get_option( $option, '' ) );
}

function gema_sovereign_print_google_tool_tags(): void {
	$verification = gema_sovereign_get_google_tool_value( 'GEMA_GOOGLE_SITE_VERIFICATION', 'gema_google_site_verification' );
	$gtm_id       = gema_sovereign_get_google_tool_value( 'GEMA_GOOGLE_TAG_MANAGER_ID', 'gema_google_tag_manager_id' );
	$ga4_id       = gema_sovereign_get_google_tool_value( 'GEMA_GOOGLE_ANALYTICS_ID', 'gema_google_analytics_id' );
	$ads_id       = gema_sovereign_get_google_tool_value( 'GEMA_GOOGLE_ADS_ID', 'gema_google_ads_id' );

	if ( '' !== $verification ) {
		printf( '<meta name="google-site-verification" content="%s">' . "\n", esc_attr( $verification ) );
	}

	echo "<script>\n";
	echo "window.dataLayer = window.dataLayer || [];\n";
	printf(
		"window.dataLayer.push({event:'gema_site_context', site_domain:%s, page_path:%s, page_title:%s});\n",
		wp_json_encode( wp_parse_url( home_url( '/' ), PHP_URL_HOST ) ),
		wp_json_encode( wp_parse_url( home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) ), PHP_URL_PATH ) ?: '/' ),
		wp_json_encode( wp_get_document_title() )
	);
	echo "</script>\n";

	if ( '' !== $gtm_id ) {
		printf(
			"<!-- Google Tag Manager -->\n<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','%s');</script>\n<!-- End Google Tag Manager -->\n",
			esc_js( $gtm_id )
		);
		return;
	}

	$gtag_ids = array_filter( array_unique( array( $ga4_id, $ads_id ) ) );
	if ( empty( $gtag_ids ) ) {
		return;
	}

	printf( '<script async src="https://www.googletagmanager.com/gtag/js?id=%s"></script>' . "\n", esc_attr( $gtag_ids[0] ) );
	echo "<script>\n";
	echo "window.dataLayer = window.dataLayer || [];\n";
	echo "function gtag(){dataLayer.push(arguments);}\n";
	echo "gtag('js', new Date());\n";
	foreach ( $gtag_ids as $id ) {
		printf( "gtag('config', '%s');\n", esc_js( $id ) );
	}
	echo "</script>\n";
}
add_action( 'wp_head', 'gema_sovereign_print_google_tool_tags', 4 );

function gema_sovereign_print_google_tag_manager_noscript(): void {
	$gtm_id = gema_sovereign_get_google_tool_value( 'GEMA_GOOGLE_TAG_MANAGER_ID', 'gema_google_tag_manager_id' );
	if ( '' === $gtm_id ) {
		return;
	}

	printf(
		'<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=%s" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>' . "\n",
		esc_attr( $gtm_id )
	);
}
add_action( 'wp_body_open', 'gema_sovereign_print_google_tag_manager_noscript', 1 );

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
		'description'  => 'Software, ERP, automatización, inteligencia artificial y marketing digital para negocios, pymes y empresas.',
		'email'        => 'ventas@gema-digital.com',
		'telephone'    => '+54 9 11 6598-0069',
		'address'      => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Av. Alicia Moreau de Justo 740',
			'addressLocality' => 'Ciudad Autónoma de Buenos Aires',
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
				'name'  => 'Latinoamérica y público de habla hispana',
			),
			array(
				'@type' => 'Country',
				'name'  => 'España',
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
			'software de gestión empresarial',
			'automatización empresarial',
			'inteligencia artificial aplicada a negocios',
			'marketing digital',
			'SEO',
			'GEO',
			'integraciones',
		),
	);
}

function gema_sovereign_get_breadcrumb_schema( string $path, string $title, array $parents = array() ): array {
	$items = array(
		array(
			'@type'    => 'ListItem',
			'position' => 1,
			'name'     => 'Inicio',
			'item'     => home_url( '/' ),
		),
	);

	$position = 2;
	foreach ( $parents as $parent ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => $parent[0],
			'item'     => home_url( trailingslashit( ltrim( $parent[1], '/' ) ) ),
		);
		$position++;
	}

	$items[] = array(
		'@type'    => 'ListItem',
		'position' => $position,
		'name'     => $title,
		'item'     => home_url( trailingslashit( ltrim( $path, '/' ) ) ),
	);

	return array(
		'@type'           => 'BreadcrumbList',
		'@id'             => home_url( trailingslashit( ltrim( $path, '/' ) ) . '#breadcrumb' ),
		'itemListElement' => $items,
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
				'description' => 'Software, IA y gestión empresarial para empresas reales.',
				'publisher'   => array(
					'@id' => home_url( '/#organization' ),
				),
				'inLanguage'  => 'es-AR',
			),
			array(
				'@type'       => 'Service',
				'@id'         => home_url( '/#service-gema-negocios' ),
				'name'        => 'GEMA Negocios',
				'serviceType' => 'Software de gestión para comercios y emprendedores',
				'description' => 'Solución integral para facturación, inventario y gestión de clientes.',
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
				'description'         => 'Software de gestión empresarial para contabilidad, recursos humanos, compras, ventas e integraciones.',
				'publisher'           => array(
					'@id' => home_url( '/#organization' ),
				),
			),
			array(
				'@type'       => 'Service',
				'@id'         => home_url( '/#service-ia-productiva' ),
				'name'        => 'IA Productiva',
				'serviceType' => 'Automatización e inteligencia artificial para empresas',
				'description' => 'Agentes conversacionales, automatización inteligente y observabilidad para procesos de negocio.',
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
						'name'           => 'Qué tipo de empresas pueden trabajar con GEMA Digital?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'GEMA Digital trabaja con comercios, emprendedores, pymes y empresas que necesitan software de gestión, automatización, integraciones o inteligencia artificial aplicada a procesos concretos.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'Qué diferencia a GEMA Digital de una agencia web tradicional?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'GEMA Digital combina software empresarial, ERP, automatización, inteligencia artificial productiva, SEO/GEO y criterios de operación real.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'ERP Cumbre es parte de GEMA Digital?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'Sí. ERP Cumbre es el producto de gestión empresarial desarrollado por GEMA Digital.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'GEMA Digital implementa inteligencia artificial en negocios?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'Sí. GEMA Digital diseña automatizaciones, agentes IA, asistentes conversacionales, flujos de datos y sistemas observables.',
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
			gema_sovereign_get_breadcrumb_schema( '/erp-cumbre/', 'ERP Cumbre' ),
			array(
				'@type'               => 'SoftwareApplication',
				'@id'                 => home_url( '/erp-cumbre/#software' ),
				'name'                => 'ERP Cumbre',
				'url'                 => home_url( '/erp-cumbre/' ),
				'applicationCategory' => 'BusinessApplication',
				'operatingSystem'     => 'Web',
				'description'         => 'ERP Cumbre es un sistema de gestión y CRM para PyMEs argentinas, con Catálogo, presupuestos, cobros, stock y facturación ARCA en modo demo o piloto controlado con implementación asistida.',
				'keywords'            => gema_sovereign_get_cumbre_keywords(),
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
				'name'        => 'Implementación de ERP Cumbre',
				'serviceType' => 'Implementación de software ERP, CRM agéntico y automatización empresarial',
			'description' => 'Diagnóstico, configuración, integraciones, localización fiscal argentina y acompañamiento FDE para implementar ERP Cumbre en comercios, pymes, constructoras, agro, retail y empresas multi-CUIT.',
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
						'name'           => 'Qué es ERP Cumbre?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'ERP Cumbre es un software de gestión empresarial desarrollado por GEMA Digital para centralizar ventas, compras, inventario, contabilidad, recursos humanos, integraciones y reportes.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'ERP Cumbre sirve para pymes argentinas?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'Sí. ERP Cumbre está pensado para PyMEs argentinas, especialmente operaciones B2B que presupuestan en USD, cobran en ARS, manejan stock/proveedores y necesitan ordenar su flujo comercial y fiscal de forma asistida.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'ERP Cumbre incluye CRM e inteligencia artificial?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'Sí. ERP Cumbre combina CRM tipo HubSpot, agentes autónomos, automatizaciones, alertas, análisis de datos e ingesta multimodal para reducir tareas repetitivas y mejorar decisiónes operativas.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'ERP Cumbre puede modernizar sistemas existentes?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'ERP Cumbre puede funcionar como alternativa, complemento o etapa de modernización cuando la empresa necesita CRM, administración, facturación, stock, aprobaciones, reportes e IA operativa. La evaluación final depende del alcance, los datos y las integraciones.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'Qué sistema conviene según el tamaño de mi empresa?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'Para comercios de mostrador suele convenir Cumbre ERP Negocios; para ventas B2B, Cumbre CRM; para administración PyME, Cumbre ERP PyMEs; y para empresas con áreas, aprobaciones y auditoría, Cumbre Empresas. Si ya existe Tango, Odoo, Xubio, Colppy u otro sistema, se evalúa convivencia, integración o migración por etapas.',
						),
					),
					array(
						'@type'          => 'Question',
						'name'           => 'Qué es Cumbre Facturador ARCA?',
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => 'Cumbre Facturador ARCA es el módulo fiscal y documental de ERP Cumbre para facturas, notas, remitos, recibos y documentación comercial argentina. La emisión real se realiza con backend seguro, validación fiscal, worker ARCA, CAE o errores trazables e implementación asistida; no se vende como emisión automática directa desde el frontend.',
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
			'type'        => 'Software de gestión para comercios y emprendedores',
			'description' => 'Solución de gestión para ordenar ventas, facturación, inventario, clientes y reportes en comercios, emprendedores y pymes.',
			'faq'         => array(
				array( 'Qué es GEMA Negocios?', 'GEMA Negocios es una solución de gestión para comercios, emprendedores y pymes que necesitan ordenar ventas, facturación, inventario, clientes y reportes.' ),
				array( 'Sirve para un comercio chico?', 'Sí. La propuesta está pensada para empezar simple y crecer por módulos.' ),
				array( 'Puede integrarse con otros canales de venta?', 'Sí. GEMA Negocios puede proyectarse con integraciones a ecommerce, Mercado Libre, herramientas administrativas y sistemas de cobro.' ),
			),
		),
		'ia-productiva' => array(
			'name'        => 'IA Productiva',
			'type'        => 'Automatización e inteligencia artificial para empresas',
			'description' => 'Servicio de inteligencia artificial aplicada a procesos reales: agentes conversacionales, automatización, RAG, reportes, integraciones y observabilidad.',
			'faq'         => array(
				array( 'Qué es IA Productiva?', 'IA Productiva es el enfoque de GEMA Digital para implementar inteligencia artificial en procesos reales de negocio.' ),
				array( 'La IA reemplaza mi sistema actual?', 'No necesariamente. En muchos casos la IA se integra sobre sistemas existentes para automatizar tareas, responder consultas o mejorar el acceso a información.' ),
				array( 'Cómo se controla la calidad de la IA?', 'Con observabilidad: trazas, reglas, evaluaciones, costos, permisos y revisión de resultados.' ),
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
	$pages = array(
		'gestion'                       => array(
			'title'       => 'Gestión empresarial para negocios, pymes y empresas',
			'kicker'      => 'Gestión',
			'description' => 'GEMA Digital ayuda a ordenar la gestión de negocios y empresas con ERP Cumbre, software a medida, integraciones, automatización e inteligencia artificial aplicada a procesos reales.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/erp-cumbre-equipo-gestion-empresarial.webp',
				'alt' => 'Equipo de GEMA Digital trabajando en gestión empresarial, ERP Cumbre, procesos y control operativo',
			),
			'modules'     => array(
				array( 'Cumbre Negocios', 'Sistema de gestión para comercios, emprendedores y locales que necesitan ventas, caja, stock, clientes, facturación, reportes simples y control diario sin depender de planillas.' ),
				array( 'Cumbre Empresas', 'ERP para pymes y empresas que requieren compras, ventas, inventario, contabilidad, tesorería, recursos humanos, permisos, trazabilidad, tableros e integraciones.' ),
				array( 'Cumbre Constructoras', 'Gestión de obras, presupuestos, proveedores, compras, pagos, avances, centros de costo, documentación y reportes para constructoras y desarrolladoras.' ),
				array( 'Cumbre Agro', 'Gestión para agroindustria, acopios y operaciones rurales con trazabilidad, stock, compras, ventas, comprobantes, cuentas corrientes, integraciones y reportes.' ),
				array( 'Cumbre Omnicanal', 'Gestión para ecommerce, locales físicos y marketplaces que necesitan sincronizar stock, precios, ventas, pagos, facturación y publicaciones.' ),
				array( 'Cumbre Servicios', 'Gestión para agencias, estudios y servicios profesionales con clientes, proyectos, agenda, tareas, propuestas, cobros, reportes y automatizaciones.' ),
			),
			'list'        => array(
				'Gestión no es solo cargar datos: es tener información confiable para vender, cobrar, comprar, pagar, medir y decidir.',
				'ERP Cumbre puede resolver procesos de caja, stock, facturación, compras, proveedores, clientes, cuentas corrientes, bancos, reportes y permisos.',
				'GEMA adapta el modelo a cada operación: comercio chico, pyme, empresa, constructora, agro, ecommerce, servicios o estructura mixta.',
				'El objetivo es que cada negocio deje de operar con planillas dispersas, sistemas aislados y decisiónes tomadas sin datos.',
			),
			'faq'         => array(
				array( 'Qué puede resolver GEMA en gestión?', 'Puede resolver orden operativo, ventas, caja, stock, facturación, compras, proveedores, cuentas corrientes, bancos, reportes, permisos, integraciones y automatizaciones.' ),
				array( 'Tengo que adaptar mi empresa al software?', 'No. La idea es partir de su forma real de trabajar y adaptar tecnología, procesos e implementación a esa operación.' ),
				array( 'Cumbre sirve para negocios chicos y empresas?', 'Sí. Cumbre puede plantearse por modelos: negocios, empresas, constructoras, agro, ecommerce, servicios y otras verticales.' ),
			),
		),
		'empresas'                      => array(
			'title'       => 'Servicios para empresas, comercios, pymes y organizaciones',
			'kicker'      => 'Empresas',
			'description' => 'GEMA Digital brinda servicios de software, gestión, marketing, automatización e inteligencia artificial para distintos tipos de empresas, desde comercios y emprendedores hasta pymes, constructoras, agroindustrias y equipos corporativos.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/nosotros-equipo-gema-digital.webp',
				'alt' => 'Equipo de GEMA Digital reunido con empresas, pymes y clientes para diagnosticar soluciones de software e inteligencia artificial',
			),
			'modules'     => array(
				array( 'Comercios y emprendedores', 'Locales, profesionales y emprendimientos que necesitan facturar, vender, cobrar, controlar stock, ordenar clientes y crecer con presencia digital.' ),
				array( 'Pymes en crecimiento', 'Empresas que ya tienen equipo, procesos, proveedores y canales, pero necesitan control, reportes, integraciones y menos trabajo manual.' ),
				array( 'Empresas operativas', 'Organizaciones con áreas, roles, permisos, aprobaciones, finanzas, compras, ventas, RRHH, datos y necesidad de trazabilidad.' ),
				array( 'Constructoras y desarrolladoras', 'Empresas que trabajan por obra, proyecto, presupuesto, proveedor, avance, centro de costo y control financiero.' ),
				array( 'Agroindustria y acopios', 'Operaciones que requieren trazabilidad, stock, comprobantes, compras, ventas, logística, reportes y administración ordenada.' ),
				array( 'Ecommerce y omnicanalidad', 'Negocios que venden por web, local, redes, Mercado Libre u otros canales y necesitan sincronizar ventas, pagos y stock.' ),
				array( 'Servicios profesionales', 'Agencias, estudios, consultoras y equipos de servicios que necesitan clientes, proyectos, propuestas, agenda, cobros y seguimiento.' ),
				array( 'Startups y equipos tech', 'Equipos que necesitan MVP, automatizaciones, integraciones, IA, datos, SEO/GEO y arquitectura escalable sin sobredimensionar.' ),
			),
			'list'        => array(
				'Podemos trabajar con empresas que necesitan ordenar gestión interna, vender más, automatizar tareas o mejorar presencia digital.',
				'La propuesta cambia según el tipo de cliente: no se atiende igual a un comercio de barrio que a una empresa con múltiples áreas.',
				'GEMA puede actuar como socio técnico, implementador de ERP, agencia de marketing, equipo de automatización o combinación de esos roles.',
				'El diagnóstico inicial define prioridades, alcance, módulos, integraciones, contenido, campañas y automatizaciones recomendadas.',
			),
			'faq'         => array(
				array( 'Con que tipo de empresas trabaja GEMA?', 'Con comercios, emprendedores, pymes, empresas, constructoras, agroindustrias, ecommerce, servicios profesionales, startups y organizaciones con procesos para ordenar.' ),
				array( 'GEMA solo vende software?', 'No. También puede prestar servicios de marketing, automatización, implementación, integraciones, IA, SEO/GEO y acompañamiento operativo.' ),
				array( 'Cómo saben que necesita cada empresa?', 'El primer paso es un diagnóstico para entender procesos, sistemas actuales, problemas, oportunidades y prioridades.' ),
			),
		),
		'marketing'                     => array(
			'title'       => 'Marketing digital, contenido, web, redes, SEO y campañas',
			'kicker'      => 'Marketing',
			'description' => 'GEMA Digital puede gestionar el marketing de su empresa o crear el software y los flujos para que su equipo lo haga internamente con Cumbre Marketing.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/marketing-digital-seo-redes-ads.webp',
				'alt' => 'Equipo revisando estrategia de marketing digital, SEO, redes sociales, campañas pagas y medición de resultados',
			),
			'modules'     => array(
				array( 'Contenido y estrategia', 'Planificación de contenidos, calendario editorial, mensajes comerciales, notas, publicaciones, guiones, piezas para redes y contenido orientado a SEO/GEO.' ),
				array( 'Sitios web y landing pages', 'Desarrollo de sitios web, páginas de servicios, landing pages, estructuras SEO, arquitectura de contenido, llamadas a la acción y formularios de contacto.' ),
				array( 'SEO y GEO', 'Optimización para Google, buscadores, respuestas generativas, entidades, preguntas frecuentes, interlinking, estructura semántica y contenido por intención de búsqueda.' ),
				array( 'Redes sociales', 'Contenido para Instagram, Facebook, LinkedIn, TikTok, YouTube, YouTube Shorts, X/Twitter, Pinterest, WhatsApp Business y publicaciones adaptadas a cada canal.' ),
				array( 'Campañas pagas', 'Google Ads, Meta Ads para Facebook e Instagram, LinkedIn Ads, TikTok Ads, YouTube Ads, remarketing, audiencias, conversiones y medición de resultados.' ),
				array( 'Google Business Profile', 'Optimización de Google Mi Negocio / Google Business Profile, publicaciones, fotos, servicios, categorías, reseñas y presencia local para búsquedas cercanas.' ),
				array( 'Email y automatizaciones', 'Emails comerciales, newsletters, formularios, respuestas automáticas, CRM, seguimiento de leads, segmentación y recuperación de oportunidades.' ),
				array( 'Cumbre Marketing', 'Software y paneles para que la empresa gestione contenidos, campañas, calendarios, redes, leads, publicaciones y reportes con asistencia de IA.' ),
			),
			'list'        => array(
				'Podemos hacer el marketing por usted: contenido, web, redes, SEO, campañas, Google Business Profile y reportes.',
				'También podemos construir el sistema para que su equipo lo haga internamente con procesos, software, IA y medición.',
				'El contenido se adapta a cada red: Instagram, Facebook, LinkedIn, TikTok, YouTube, YouTube Shorts, X/Twitter, Pinterest, WhatsApp Business y Google Business Profile.',
				'La estrategia puede incluir SEO local, SEO nacional, GEO para respuestas generativas, campañas pagas y automatización de leads.',
				'El objetivo no es publicar por publicar: es atraer oportunidades, explicar servicios, construir autoridad y convertir consultas en ventas.',
			),
			'faq'         => array(
				array( 'GEMA puede manejar todo el marketing?', 'Sí. Podemos encargarnos de contenido, web, redes, SEO, campañas, Google Business Profile, reportes y mejora continua.' ),
				array( 'También puedo hacerlo con mi equipo?', 'Sí. Podemos crear software, procesos y automatizaciones para que su equipo gestione marketing internamente con Cumbre Marketing.' ),
				array( 'Qué redes puede trabajar GEMA?', 'Instagram, Facebook, LinkedIn, TikTok, YouTube, YouTube Shorts, X/Twitter, Pinterest, WhatsApp Business y Google Business Profile, según el negocio.' ),
			),
		),
		'automatizacion'                => array(
			'title'       => 'Automatización empresarial adaptada a su forma de trabajar',
			'kicker'      => 'Automatización',
			'description' => 'GEMA Digital automatiza procesos reales de negocios y empresas. No buscamos que su operación se adapte a nosotros: nosotros adaptamos software, IA e integraciones a su manera de trabajar.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/automatizacion-procesos-empresa.webp',
				'alt' => 'Reunión de automatización empresarial con procesos, integraciones, CRM, ERP, WhatsApp y reportes adaptados al cliente',
			),
			'modules'     => array(
				array( 'Automatización operativa', 'Flujos para ventas, compras, caja, stock, facturación, clientes, proveedores, tareas, aprobaciones, reportes y seguimiento diario.' ),
				array( 'Agentes IA y asistentes', 'Agentes conversacionales, asistentes internos, consultas sobre datos, respuestas a clientes, generación de documentos y soporte a equipos.' ),
				array( 'Integraciones a medida', 'Conexión entre ERP, ecommerce, Mercado Libre, bancos, pasarelas de pago, formularios, CRM, WhatsApp, planillas, APIs y sistemas heredados.' ),
				array( 'Criterio humano y control', 'Automatizaciones con permisos, reglas, aprobaciones, observabilidad, trazas y supervisión para evitar riesgos innecesarios.' ),
			),
			'list'        => array(
				'1. Aviso automático cuando un cliente importante baja su frecuencia de compra y conviene contactarlo.',
				'2. Reposición inteligente que combina stock, ventas, estacionalidad, proveedor y tiempo de entrega.',
				'3. Conciliación entre ventas, cobros, Mercado Pago, banco, posnet y caja diaria.',
				'4. Generación automática de presupuestos desde WhatsApp, formulario web o consulta comercial.',
				'5. Seguimiento de obras con alertas por desvío de costo, avance, pagos pendientes o compras críticas.',
				'6. Asistente interno que responde preguntas sobre ventas, stock, clientes, deudas, facturas o reportes.',
				'7. Publicación semiautomática de productos en web, redes y marketplace con control de stock.',
				'8. Clasificación automática de consultas entrantes por urgencia, rubro, producto, etapa y responsable.',
				'9. Reporte ejecutivo semanal enviado por email o WhatsApp con ventas, margen, cobranzas, stock y tareas pendientes.',
				'10. Flujo de alta de cliente o proveedor con validaciones, documentación, permisos y tareas internas.',
				'Estas automatizaciones no suelen venir listas en ERP enlatados porque dependen de cómo trabaja cada negocio.',
				'GEMA puede crear automatizaciones especiales para su operación, conectando software, datos, IA y procesos humanos.',
			),
			'faq'         => array(
				array( 'Tengo que cambiar mi forma de trabajar?', 'No. Primero entendemos su operación y después adaptamos software, integraciones e IA a sus procesos reales.' ),
				array( 'Qué diferencia hay con un ERP enlatado?', 'Un ERP enlatado suele cubrir flujos generales. GEMA puede crear automatizaciones especiales para reglas, excepciones, canales y tareas propias de cada empresa.' ),
				array( 'Las automatizaciones son seguras?', 'Deben diseñarse con permisos, límites, registros, aprobaciones y observabilidad según el nivel de riesgo.' ),
			),
		),
		'suscripciones'                 => array(
			'title'       => 'Precios, planes y suscripciones',
			'kicker'      => 'Planes flexibles',
			'description' => 'Compare opciones para implementar ERP Cumbre, GEMA Negocios e inteligencia artificial productiva con una estructura de costos clara.',
			'modules'     => array(
				array( 'Planes por etapa', 'Empezar simple, validar necesidades y crecer por módulos sin sobredimensionar el proyecto.' ),
				array( 'Licenciamiento SaaS', 'Abonos mensuales para software, soporte, automatizaciones e integraciones según alcance.' ),
				array( 'Implementación guíada', 'Diagnóstico, configuración, capacitación y acompañamiento para que el sistema llegue a uso real.' ),
			),
			'list'        => array(
				'Planes para comercios, emprendedores, pymes y empresas.',
				'Opciones para software, IA, integraciones, soporte y mantenimiento.',
				'Presupuesto final definido después del diagnóstico operativo.',
			),
			'faq'         => array(
				array( 'Hay un único precio?', 'No. El precio depende de módulos, usuarios, integraciones, soporte y alcance de implementación.' ),
				array( 'Puedo empezar con algo simple?', 'Sí. La propuesta permite empezar por una necesidad concreta y crecer por etapas.' ),
			),
		),
		'prueba-gratis'                 => array(
			'title'       => 'Prueba gratis y diagnóstico inicial',
			'kicker'      => 'Demo y validación',
			'description' => 'Solicite una evaluación para entender si ERP Cumbre, GEMA Negocios o IA Productiva encajan con su operación actual.',
			'modules'     => array(
				array( 'Relevamiento', 'Analizamos procesos, sistemas actuales, dolores operativos y prioridades de negocio.' ),
				array( 'Demo orientada', 'Mostramos flujos concretos según rubro, equipo y necesidades reales.' ),
				array( 'Plan de avance', 'Definimos una ruta inicial con módulos, tiempos, integraciones y riesgos.' ),
			),
			'list'        => array(
				'Ideal para validar antes de invertir en implementación.',
				'Permite ordenar alcance, prioridades y dependencias técnicas.',
				'Puede derivar en demo, piloto o propuesta formal.',
			),
			'faq'         => array(
				array( 'La prueba reemplaza una implementación?', 'No. La prueba ayuda a validar enfoque y alcance antes de una puesta en marcha real.' ),
				array( 'Necesito datos reales?', 'No al inicio. Podemos trabajar con escenarios representativos y luego avanzar con datos controlados.' ),
			),
		),
		'erp/precios'                   => array(
			'title'       => 'Precios de ERP Cumbre y prueba gratis de 14 días',
			'kicker'      => 'Precio personalizado',
			'description' => 'Conozca cómo se cotiza ERP Cumbre: primero puede probar la versión general durante 14 días y luego se define una implementación personalizada según procesos, usuarios e integraciones.',
			'modules'     => array(
				array( 'Prueba general', 'La prueba gratuita de 14 días permite conocer el producto sin personalización inicial.' ),
				array( 'Diagnóstico comercial', 'La reunión inicial es gratuita, dura normalmente 45 minutos y sirve para entender alcance real.' ),
				array( 'Cotización responsable', 'El precio final depende de módulos, usuarios, integraciones, soporte, datos y nivel de implementación.' ),
			),
			'list'        => array(
				'No publicamos un precio único porque cada empresa tiene procesos, volumen e integraciones diferentes.',
				'La prueba gratis ayuda a validar si ERP Cumbre encaja antes de avanzar con una propuesta.',
				'El equipo comercial puede acompañar por teléfono, Meet o reunión presencial con cita previa.',
			),
			'faq'         => array(
				array( 'ERP Cumbre tiene prueba gratis?', 'Sí. Se ofrece una prueba gratuita de 14 días de la versión general, sin personalización.' ),
				array( 'Por qué no hay un precio fijo publicado?', 'Porque GEMA trabaja de forma personalizada. La cotización se define después de entender procesos, usuarios, integraciones y soporte requerido.' ),
				array( 'La reunión inicial tiene costo?', 'No. La reunión inicial es gratuita y suele durar 45 minutos.' ),
			),
		),
		'erp/funciones/facturacion-electronica' => array(
			'title'       => 'Facturación ARCA en piloto controlado para ERP Cumbre',
			'kicker'      => 'Facturación y administración',
			'description' => 'ERP Cumbre puede organizar ventas, comprobantes, clientes, stock y procesos administrativos. Las integraciones fiscales se validan por caso y según normativa aplicable.',
			'modules'     => array(
				array( 'Ventas y comprobantes', 'Centralizacion de clientes, ventas, comprobantes y seguimiento administrativo.' ),
				array( 'Stock conectado', 'Relación entre ventas, disponibilidad, reposición y trazabilidad operativa.' ),
				array( 'Validación fiscal', 'Las conexiónes fiscales deben revisarse según país, régimen, permisos y requisitos técnicos.' ),
			),
			'list'        => array(
				'En Argentina se evalúa alcance ARCA/AFIP caso por caso. La facturación real se comunica como piloto fiscal controlado e implementación asistida, no como activación automática sin validación.',
				'Fuera de Argentina no se promete cumplimiento fiscal automático sin validar normativa local.',
				'El objetivo es reducir carga manual y mejorar consistencia entre ventas, stock y administración.',
			),
			'faq'         => array(
				array( 'ERP Cumbre puede manejar facturación?', 'Si, puede contemplar procesos de facturación y administración, con alcance final validado por caso.' ),
				array( 'Sirve para normativa de otros países?', 'GEMA trabaja con empresas de habla hispana, pero las integraciones fiscales fuera de Argentina requieren validación normativa local.' ),
			),
		),
		'nosotros'                      => array(
			'title'       => 'GEMA Digital: software, IA y gestión para empresas reales',
			'kicker'      => 'Trayectoria y criterio operativo',
			'description' => 'GEMA Digital combina desarrollo de software, gestión empresarial, automatización e inteligencia artificial para resolver procesos concretos.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/nosotros-equipo-gema-digital.webp',
				'alt' => 'Equipo de GEMA Digital en una reunión de trabajo sobre software, ERP, automatización e inteligencia artificial para empresas',
			),
			'modules'     => array(
				array( 'Ingeniería aplicada', 'Construimos soluciones pensando en operación, soporte, escalabilidad y continuidad.' ),
				array( 'Vision de negocio', 'No separamos tecnología de gestión: cada modulo debe mejorar control, ventas o eficiencia.' ),
				array( 'Acompañamiento', 'Trabajamos con diagnóstico, implementación, capacitación y mejora continua.' ),
			),
			'list'        => array(
				'Software de gestión para comercios, pymes y empresas.',
				'Automatización e inteligencia artificial aplicada a procesos reales.',
				'SEO/GEO y arquitectura de contenido para crecimiento digital.',
			),
			'faq'         => array(
				array( 'GEMA Digital es solo una agencia web?', 'No. La propuesta combina software empresarial, ERP, IA, automatización, SEO/GEO y acompañamiento operativo.' ),
				array( 'Trabajan con negocios chicos y empresas?', 'Sí. El enfoque cambia según el tipo de cliente, desde comercios hasta estructuras corporativas.' ),
			),
		),
		'contacto'                      => array(
			'title'       => 'Contacto y diagnóstico',
			'kicker'      => 'Hablemos de su operación',
			'description' => 'Cuentenos que necesita ordenar, automatizar o mejorar. Atendemos presencialmente en CABA y AMBA, y de forma remota a empresas de Argentina, Latinoamérica y habla hispana.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/contacto-diagnostico-cliente-pyme.webp',
				'alt' => 'Reunión de diagnóstico entre GEMA Digital y un cliente pyme para evaluar software, ERP, automatización y marketing',
			),
			'modules'     => array(
				array( 'Email comercial', 'ventas@gema-digital.com para consultas, cotizaciónes, diagnósticos y propuestas.' ),
				array( 'Teléfono y WhatsApp', '0800 345 4474 y WhatsApp corporativo +54 9 11 6598-0069.' ),
				array( 'Dirección física', 'Av. Alicia Moreau de Justo 740, Ciudad Autónoma de Buenos Aires, Argentina.' ),
				array( 'Atención remota', 'Reuniónes por videollamada para AMBA, Argentina, Latinoamérica, España y público de habla hispana.' ),
				array( 'Diagnóstico', 'Relevamiento inicial para definir la mejor solución, prioridades, integraciones, presupuesto y proximos pasos.' ),
			),
			'list'        => array(
				'Consultas por ERP Cumbre, GEMA Negocios e IA Productiva.',
				'Relevamiento para integraciones, automatizaciones y software a medida.',
				'Contacto comercial para comercios, pymes, empresas, profesionales, ecommerce, constructoras, agro y servicios.',
				'Prioridad comercial inicial: Cumbre Negocios y servicios de Marketing, sin descuidar ERP Cumbre, IA Productiva y automatización.',
			),
			'faq'         => array(
				array( 'Qué información conviene enviar?', 'Rubro, cantidad de usuarios, sistemas actuales, problemas principales e integraciones necesarias.' ),
				array( 'Puedo consultar aunque no tenga todo definido?', 'Sí. El diagnóstico existe justamente para ordenar necesidades y prioridades.' ),
			),
		),
		'ia'                            => array(
			'title'       => 'Tecnología e inteligencia artificial aplicada',
			'kicker'      => 'IA productiva',
			'description' => 'Servicios y componentes para llevar inteligencia artificial a procesos reales con control, trazabilidad y criterios de negocio.',
			'modules'     => array(
				array( 'Agentes autónomos', 'Asistentes y flujos agénticos para tareas repetitivas, consultas y operaciones.' ),
				array( 'Brainstore', 'Base de conocimiento y almacenamiento de contexto para respuestas útiles y auditables.' ),
				array( 'Observabilidad', 'Monitoreo de calidad, costos, trazas, permisos y comportamiento de modelos.' ),
			),
			'list'        => array(
				'Implementaciónes de IA conectadas a datos, procesos y herramientas.',
				'Automatizaciones con reglas, supervisión y medición.',
				'Arquitecturas preparadas para evolucionar sin perder control.',
			),
			'faq'         => array(
				array( 'La IA se conecta con sistemas existentes?', 'Sí. En muchos casos se integra con ERP, CRM, bases de datos, formularios o canales de atención.' ),
				array( 'Cómo se evita que la IA responda cualquier cosa?', 'Con contexto controlado, permisos, evaluaciones, trazas, reglas y observabilidad.' ),
			),
		),
		'ia/brainstore'                 => array(
			'title'       => 'Brainstore: base de conocimiento para IA',
			'kicker'      => 'Datos y contexto',
			'description' => 'Brainstore organiza información, historiales y contexto para que los agentes y asistentes trabajen con datos útiles y recuperables.',
			'modules'     => array(
				array( 'Contexto reutilizable', 'Documentos, respuestas, datos y trazas disponibles para consultas futuras.' ),
				array( 'Búsqueda semántica', 'Recuperación de información relevante para mejorar respuestas y automatizaciones.' ),
				array( 'Trazabilidad', 'Base para auditar de dónde sale una respuesta y cómo se usó la información.' ),
			),
			'list'        => array(
				'Reduce respuestas improvisadas al conectar la IA con conocimiento real.',
				'Ordena datos para agentes, asistentes y flujos internos.',
				'Aporta memoria operativa sin perder control de acceso.',
			),
			'faq'         => array(
				array( 'Brainstore es una base de datos tradicional?', 'No solamente. Es una capa de conocimiento y recuperación pensada para IA aplicada.' ),
				array( 'Sirve para soporte interno?', 'Sí. Puede alimentar asistentes para equipos, clientes, ventas, administración o soporte.' ),
			),
		),
		'ia/observabilidad'             => array(
			'title'       => 'Observabilidad de IA y modelos LLM',
			'kicker'      => 'Control y calidad',
			'description' => 'Monitoree respuestas, costos, trazas, errores y calidad de automatizaciones basadas en inteligencia artificial.',
			'modules'     => array(
				array( 'Trazas', 'Registro de entradas, salidas, herramientas usadas y decisiónes relevantes.' ),
				array( 'Calidad', 'Evaluación de respuestas, desvíos, regresiones y alucinaciones.' ),
				array( 'Costos', 'Control de consumo, tokens, llamadas, tiempos y eficiencia.' ),
			),
			'list'        => array(
				'Pensado para IA en producción, no solo demostraciones.',
				'Ayuda a detectar fallas invisibles para software tradicional.',
				'Mejora seguridad, control y confianza operativa.',
			),
			'faq'         => array(
				array( 'Por qué observar la IA?', 'Porque los modelos pueden cambiar resultados, costos y comportamiento aunque el sistema parezca funcionar.' ),
				array( 'Se puede medir cada respuesta?', 'Sí. Se pueden registrar trazas, contexto, usuario, herramientas, costos y resultado.' ),
			),
		),
		'ia/agentes-autonomos'          => array(
			'title'       => 'Agentes autónomos de IA para procesos empresariales',
			'kicker'      => 'Flujos agénticos',
			'description' => 'Diseñamos agentes que ayudan a ejecutar tareas, consultar información y coordinar procesos con supervisión y reglas claras.',
			'modules'     => array(
				array( 'Asistentes internos', 'Agentes para equipos administrativos, comerciales, soporte o dirección.' ),
				array( 'Automatización', 'Flujos que combinan datos, APIs, documentos y acciones controladas.' ),
				array( 'Supervisión', 'Permisos, límites, aprobaciones y observabilidad para operar con confianza.' ),
			),
			'list'        => array(
				'Automatización de consultas, reportes y tareas repetitivas.',
				'Integración con sistemas existentes y datos de negocio.',
				'Disenio por etapas para evitar riesgos innecesarios.',
			),
			'faq'         => array(
				array( 'Un agente puede ejecutar acciones?', 'Si, pero conviene hacerlo con permisos, reglas, logs y aprobaciones según criticidad.' ),
				array( 'Sirve para atención al cliente?', 'Sí. También puede servir para soporte interno, ventas, administración y análisis operativo.' ),
			),
		),
		'ia/automatizacion-whatsapp'    => array(
			'title'       => 'Automatización WhatsApp para ventas B2B',
			'kicker'      => 'WhatsApp + IA + seguimiento',
			'description' => 'Diseñamos flujos de WhatsApp para capturar leads, responder consultas, derivar al equipo comercial, agendar reuniónes y sostener seguimiento con control humano.',
			'modules'     => array(
				array( 'Captura de leads', 'Registro de nombre, WhatsApp o teléfono y necesidad para no perder oportunidades comerciales.' ),
				array( 'Derivación inteligente', 'El bot puede iniciar la conversacion y derivar a soporte o equipo comercial cuando corresponde.' ),
				array( 'Agenda y recordatorios', 'Integración con Google Calendar, alertas internas y seguimiento posterior a la consulta.' ),
			),
			'list'        => array(
				'Ideal para empresas que reciben consultas por WhatsApp y necesitan orden comercial.',
				'Puede conectarse con CRM, ERP, formularios, sitio web y bases de datos.',
				'Se disena con límites, aprobaciones, trazabilidad y cuidado de datos personales.',
			),
			'faq'         => array(
				array( 'El bot vende solo?', 'No necesariamente. El enfoque recomendado es automatizar respuestas y seguimiento, manteniendo derivación humana para oportunidades importantes.' ),
				array( 'Se puede conectar con mi CRM?', 'Si, se evalua según API, permisos, estructura de datos y objetivos del proceso.' ),
				array( 'Puede agendar reuniónes?', 'Sí. Puede coordinar llamadas o Google Meet cuando el flujo y las credenciales estén configurados.' ),
			),
		),
		'tecnologia'                    => array(
			'title'       => 'Tecnología para gestión, integraciones e IA',
			'kicker'      => 'Arquitectura operativa',
			'description' => 'Soluciones técnicas para conectar sistemas, automatizar tareas, reducir costos y mejorar decisiónes con información confiable.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/integraciones-erp-ecommerce-crm.webp',
				'alt' => 'Persona revisando integraciones entre ERP, ecommerce, CRM, datos y automatizaciones de negocio',
			),
			'modules'     => array(
				array( 'Costos cloud', 'Disenio eficiente para que la IA y el software sean sostenibles.' ),
				array( 'Conexión bancaria', 'Integraciones para conciliación, tesorería y control financiero.' ),
				array( 'Cumbre Negocios', 'Aplicación SaaS para gestión minorista, ventas, caja y stock.' ),
			),
			'list'        => array(
				'Arquitectura pensada para crecer por módulos.',
				'Integraciones con sistemas, APIs y canales digitales.',
				'Automatización con criterios de seguridad, trazabilidad y soporte.',
			),
			'faq'         => array(
				array( 'GEMA trabaja solo con una tecnología?', 'No. Elegimos herramientas según necesidad, estabilidad, costos e integraciones.' ),
				array( 'Se puede integrar con sistemas actuales?', 'Sí. Primero se evalua viabilidad, acceso a datos, APIs y riesgos.' ),
			),
		),
		'tecnologia/optimizacion-costos' => array(
			'title'       => 'Optimización de costos cloud e IA',
			'kicker'      => 'Eficiencia operativa',
			'description' => 'Diseñamos arquitecturas para que software, automatizaciones e IA sean útiles sin disparar costos innecesarios.',
			'modules'     => array(
				array( 'Consumo medible', 'Control de llamadas, tokens, almacenamiento, ejecuciones y tiempos.' ),
				array( 'Arquitectura eficiente', 'Uso de cache, recuperación de contexto y automatizaciones bien acotadas.' ),
				array( 'Mejora continua', 'Análisis periódico para bajar desperdicio y sostener rendimiento.' ),
			),
			'list'        => array(
				'Reduce costos sin sacrificar utilidad operativa.',
				'Permite escalar IA con control financiero.',
				'Mejora tiempos, estabilidad y experiencia de usuario.',
			),
			'faq'         => array(
				array( 'La IA puede volverse cara?', 'Sí. Por eso se diseñan límites, cache, recuperación eficiente y medición de consumo.' ),
				array( 'Se puede optimizar después de lanzar?', 'Sí. La observabilidad permite detectar oportunidades y ajustar arquitectura.' ),
			),
		),
		'tecnologia/conexion-bancaria'  => array(
			'title'       => 'Conexión bancaria y tesorería automatizada',
			'kicker'      => 'Finanzas conectadas',
			'description' => 'Integre movimientos, cobros, conciliaciones y control de caja para reducir carga manual y errores administrativos.',
			'modules'     => array(
				array( 'Conciliación', 'Cruce de movimientos, comprobantes, cobros y cuentas corrientes.' ),
				array( 'Tesorería', 'Visibilidad de caja, bancos, pagos, posnets y medios digitales.' ),
				array( 'Reportes', 'Indicadores para administración, dirección y seguimiento financiero.' ),
			),
			'list'        => array(
				'Disminuye planillas manuales y carga repetitiva.',
				'Mejora control de cobros, pagos y saldos.',
				'Puede conectarse con ERP Cumbre y herramientas externas.',
			),
			'faq'         => array(
				array( 'Todos los bancos tienen API?', 'No siempre. La integracion depende de banco, proveedor, permisos y formato disponible.' ),
				array( 'También sirve para Mercado Pago o posnets?', 'Si, se puede evaluar integracion con pasarelas y medios de cobro.' ),
			),
		),
		'tecnologia/cumbre-negocios'    => array(
			'title'       => 'ERP Cumbre Negocios para comercios',
			'kicker'      => 'Gestión minorista',
			'description' => 'Aplicación SaaS para ventas, caja, stock, comandas, facturación e información diaria de negocios y comercios.',
			'modules'     => array(
				array( 'Caja y ventas', 'Operación diaria simple para registrar ventas, cobros y movimientos.' ),
				array( 'Stock', 'Control de productos, faltantes, reposición y movimientos.' ),
				array( 'Movilidad', 'Pensado para trabajar desde tablet, celular o navegador según el flujo.' ),
			),
			'list'        => array(
				'Ideal para comercios que necesitan empezar ordenados.',
				'Puede crecer hacia ERP Cumbre e integraciones mayores.',
				'Reduce dependencia de planillas y registros dispersos.',
			),
			'faq'         => array(
				array( 'Es lo mismo que ERP Cumbre?', 'Es una versión orientada a negocios y gestión minorista, con posibilidad de crecer hacia módulos más amplios.' ),
				array( 'Sirve para locales físicos?', 'Sí. Esta pensado para ventas, caja, stock y operación diaria.' ),
			),
		),
		'servicios'                     => array(
			'title'       => 'Servicios de implementación y acompañamiento',
			'kicker'      => 'Del diagnóstico al uso real',
			'description' => 'Acompañamos la implementación de software, IA e integraciones con criterio técnico y operativo.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/soporte-capacitación-cliente.webp',
				'alt' => 'Soporte y capacitación de GEMA Digital para clientes durante la implementación de software, ERP e IA',
			),
			'modules'     => array(
				array( 'Diagnóstico', 'Entender procesos, sistemas actuales, datos e indicadores.' ),
				array( 'Implementación', 'Configurar, integrar, probar y capacitar para uso real.' ),
				array( 'Soporte evolutivo', 'Medir, mejorar, automatizar y ajustar con el negocio en marcha.' ),
			),
			'list'        => array(
				'Servicios para comercios, pymes, empresas y equipos internos.',
				'Trabajo por etapas con prioridades claras.',
				'Integración entre tecnología, gestión y crecimiento digital.',
			),
			'faq'         => array(
				array( 'El servicio incluye capacitación?', 'Sí. La adopción es parte clave de una implementación éxitosa.' ),
				array( 'Pueden trabajar con mi equipo?', 'Sí. Podemos acompañar a responsables internos, administración, ventas o tecnología.' ),
			),
		),
		'servicios/fde-engineering'     => array(
			'title'       => 'Forward Deployed Engineering para IA y ERP',
			'kicker'      => 'Ingeniería cerca del problema',
			'description' => 'Llevamos criterio técnico al frente operativo para integrar sistemas, datos, APIs e IA en procesos concretos.',
			'modules'     => array(
				array( 'Relevamiento técnico', 'Mapeo de sistemas, datos, restricciones, APIs y responsables.' ),
				array( 'Integración', 'Conexión entre ERP, canales, bases de datos, automatizaciones y servicios externos.' ),
				array( 'Operación', 'Pruebas, monitoreo, documentación y mejora con usuarios reales.' ),
			),
			'list'        => array(
				'Ideal para proyectos donde la integracion define el éxito.',
				'Reduce distancia entre negocio, usuarios y tecnología.',
				'Permite validar soluciones en contexto real.',
			),
			'faq'         => array(
				array( 'Qué significa FDE?', 'Forward Deployed Engineer: ingenieria aplicada cerca del usuario, el proceso y el problema real.' ),
				array( 'Sirve para IA?', 'Sí. Muchos proyectos de IA fallan por falta de integracion, datos y operación controlada.' ),
			),
		),
		'impuestos'                     => array(
			'title'       => 'Impuestos, facturación y gestión fiscal',
			'kicker'      => 'Gestión administrativa',
			'description' => 'Herramientas y procesos para ordenar facturación, impuestos, comprobantes y obligaciones administrativas.',
			'modules'     => array(
				array( 'Facturación', 'Comprobantes, clientes, ventas y seguimiento administrativo.' ),
				array( 'Control fiscal', 'Datos ordenados para liquidaciones, reportes y obligaciones.' ),
				array( 'Integración', 'Conexión con sistemas de gestión, contabilidad y canales comerciales.' ),
			),
			'list'        => array(
				'Pensado para Argentina y operaciones con necesidades fiscales concretas.',
				'Puede integrarse con ERP Cumbre y GEMA Negocios.',
				'Reduce dispersion entre facturación, ventas y administración.',
			),
			'faq'         => array(
				array( 'GEMA reemplaza a mi contador?', 'No. Ordena información y procesos para trabajar mejor con administración y asesores.' ),
				array( 'Sirve para monotributo y empresas?', 'El alcance depende del caso, régimen, volumen e integraciones necesarias.' ),
			),
		),
		'impuestos/arca-fiscal'         => array(
			'title'       => 'Modulo fiscal ARCA y facturación electrónica',
			'kicker'      => 'Facturación argentina',
			'description' => 'Gestión de comprobantes, datos fiscales y procesos administrativos conectados a la operación comercial.',
			'modules'     => array(
				array( 'Comprobantes', 'Facturas, notas, clientes, condiciones y seguimiento.' ),
				array( 'IVA e impuestos', 'Información estructurada para control administrativo y reportes.' ),
				array( 'Operación', 'Flujos pensados para comercios, pymes y empresas con volumen.' ),
			),
			'list'        => array(
				'Centraliza información fiscal y comercial.',
				'Mejora trazabilidad de ventas y comprobantes.',
				'Prepara la base para reportes e integraciones contables.',
			),
			'faq'         => array(
				array( 'Incluye facturación electrónica?', 'La página describe el modulo fiscal; el alcance final se define según integraciones y requisitos.' ),
				array( 'Se integra con gestión de stock?', 'Si, puede integrarse con ventas, caja, clientes e inventario.' ),
			),
		),
		'sectores'                      => array(
			'title'       => 'Sectores, industrias y comercios para GEMA',
			'kicker'      => 'Soluciones por rubro',
			'description' => 'Adaptamos software, gestión e inteligencia artificial a negocios, comercios, pymes y empresas con necesidades operativas distintas.',
			'modules'     => array(
				array( 'Comercios', 'Ventas, caja, stock, clientes, facturación y canales digitales.' ),
				array( 'Pymes', 'Procesos, reportes, integraciones, cuentas corrientes y control administrativo.' ),
				array( 'Empresas', 'Trazabilidad, permisos, automatización, IA y tableros de decisión.' ),
			),
			'list'        => array(
				'GEMA Negocios para comercios y emprendedores.',
				'ERP Cumbre para operaciones que necesitan control integral.',
				'IA Productiva para automatizar tareas y decisiónes repetitivas.',
			),
			'faq'         => array(
				array( 'Hay soluciones por rubro?', 'Sí. El enfoque cambia según operaciones, canales, stock, facturación e integraciones.' ),
				array( 'Puedo empezar aunque mi rubro no este listado?', 'Sí. El diagnóstico permite adaptar el alcance al caso concreto.' ),
			),
		),
		'sectores/gema-negocios'        => array(
			'title'       => 'GEMA Negocios: servicios 360 para emprendedores',
			'kicker'      => 'Comercios y emprendedores',
			'description' => 'Acompañamiento para ordenar gestión, presencia digital, facturación, ventas, marketing e implementación de tecnología.',
			'modules'     => array(
				array( 'Alta y orden administrativo', 'Base para empezar a operar con estructura y menos improvisacion.' ),
				array( 'Gestión comercial', 'Ventas, clientes, canales, inventario y reportes simples.' ),
				array( 'Crecimiento digital', 'Web, SEO/GEO, campañas y automatizaciones según etapa.' ),
			),
			'list'        => array(
				'Pensado para comercios, profesionales y emprendimientos.',
				'Integra gestión, marketing y tecnología.',
				'Puede conectarse con GEMA Negocios y ERP Cumbre.',
			),
			'faq'         => array(
				array( 'Es solo software?', 'No. Es una propuesta de acompañamiento 360 para ordenar gestión y crecimiento.' ),
				array( 'Sirve para un negocio que recien empieza?', 'Sí. Justamente busca evitar desorden administrativo y comercial desde el inicio.' ),
			),
		),
		'sectores/directorio-minorista' => array(
			'title'       => 'Directorio de rubros comerciales y negocios',
			'kicker'      => 'Gestión por rubro',
			'description' => 'Soluciones para minimercados, indumentaria, gastronomia, servicios, ferreterias, tiendas online y otros comercios.',
			'modules'     => array(
				array( 'Retail', 'Stock, precios, caja, ventas, proveedores y reposición.' ),
				array( 'Gastronomia', 'Comandas, productos, caja, turnos y control diario.' ),
				array( 'Servicios', 'Clientes, agenda, cobros, seguimiento y comunicación.' ),
			),
			'list'        => array(
				'Cada rubro requiere datos, reportes e integraciones diferentes.',
				'El objetivo es reducir carga manual y mejorar control.',
				'Puede conectarse con canales digitales y medios de pago.',
			),
			'faq'         => array(
				array( 'Tienen soluciones para todos los rubros?', 'Se parte de patrones comunes y se ajusta el alcance según cada operación.' ),
				array( 'Puedo pedir una página por mi rubro?', 'Sí. Es parte de la estrategia SEO/GEO y de adquisicion por sectores.' ),
			),
		),
		'sectores/agroindustria'        => array(
			'title'       => 'Software de gestión para agroindustria y acopios',
			'kicker'      => 'Sector agro',
			'description' => 'Gestión, trazabilidad, stock, compras, ventas, integraciones e información operativa para empresas agroindustriales.',
			'modules'     => array(
				array( 'Trazabilidad', 'Seguimiento de operaciones, unidades, comprobantes, movimientos y responsables.' ),
				array( 'Administración', 'Compras, ventas, proveedores, cuentas corrientes y reportes.' ),
				array( 'Automatización', 'Alertas, integraciones y tableros para reducir tareas manuales.' ),
			),
			'list'        => array(
				'Soluciones adaptables a operaciones con volumen y datos dispersos.',
				'Integración con facturación, inventario, finanzas y reportes.',
				'Base para crecer hacia ERP Cumbre e IA Productiva.',
			),
			'faq'         => array(
				array( 'Sirve para acopios?', 'Puede adaptarse a acopios y operaciones agroindustriales según procesos, datos e integraciones.' ),
				array( 'Incluye reportes?', 'Sí. Los reportes se definen según indicadores relevantes de cada operación.' ),
			),
		),
		'sectores/constructoras'        => array(
			'title'       => 'Software de gestión para constructoras y desarrollos',
			'kicker'      => 'Construccion',
			'description' => 'Controle obras, presupuestos, compras, proveedores, pagos, avances e información financiera desde una base ordenada.',
			'modules'     => array(
				array( 'Obras y avances', 'Seguimiento de proyectos, etapas, responsables y estado operativo.' ),
				array( 'Compras y costos', 'Control de proveedores, materiales, presupuestos y pagos.' ),
				array( 'Reportes', 'Visibilidad para dirección sobre costos, desvíos y prioridades.' ),
			),
			'list'        => array(
				'Reduce dispersion entre planillas, chats y documentos.',
				'Mejora control de costos y trazabilidad administrativa.',
				'Puede conectarse con tesorería, facturación y bancos.',
			),
			'faq'         => array(
				array( 'Sirve para varias obras?', 'Sí. El alcance puede contemplar múltiples proyectos, responsables y centros de costo.' ),
				array( 'Se puede integrar con contabilidad?', 'Sí. Se evalua según sistema actual, datos disponibles e integraciones.' ),
			),
		),
		'sectores/e-commerce'           => array(
			'title'       => 'Gestión para ecommerce y omnicanalidad',
			'kicker'      => 'Venta online',
			'description' => 'Unifique stock, ventas, precios, pedidos, facturación y pagos entre tienda online, marketplace y negocio físico.',
			'modules'     => array(
				array( 'Stock centralizado', 'Disponibilidad real entre canales para reducir errores y cancelaciones.' ),
				array( 'Pedidos', 'Gestión de ventas, estados, clientes, pagos y comprobantes.' ),
				array( 'Integraciones', 'Conexión con ecommerce, Mercado Libre, pasarelas y ERP.' ),
			),
			'list'        => array(
				'Pensado para negocios que venden en más de un canal.',
				'Reduce carga manual y diferencias de stock.',
				'Mejora control comercial y administrativo.',
			),
			'faq'         => array(
				array( 'Integra Mercado Libre?', 'Sí. Existe una página especifica para analizar esa integracion.' ),
				array( 'Sirve para tienda física y online?', 'Sí. La omnicanalidad busca unificar ambas operaciones.' ),
			),
		),
		'sectores/servicios-profesionales' => array(
			'title'       => 'Gestión para servicios profesionales y agencias',
			'kicker'      => 'Servicios',
			'description' => 'Organice clientes, proyectos, tareas, cobros, agenda, propuestas, reportes e inteligencia artificial para equipos de servicios.',
			'modules'     => array(
				array( 'Clientes', 'Historial, seguimiento comercial, comunicaciones y oportunidades.' ),
				array( 'Proyectos', 'Tareas, entregables, responsables, tiempos y estado de avance.' ),
				array( 'Automatización', 'Asistentes, reportes y flujos para reducir trabajo repetitivo.' ),
			),
			'list'        => array(
				'Ideal para estudios, consultoras, agencias y profesionales.',
				'Permite ordenar operaciones sin perder flexibilidad.',
				'Puede incorporar IA para soporte, ventas y gestión interna.',
			),
			'faq'         => array(
				array( 'Sirve para agencias?', 'Sí. Puede organizar clientes, proyectos, entregables y seguimiento comercial.' ),
				array( 'Puede conectarse con herramientas actuales?', 'Sí. Se evalua según APIs, datos y prioridades.' ),
			),
		),
		'sectores/startups'             => array(
			'title'       => 'Software, IA y gestión para startups',
			'kicker'      => 'Crecimiento técnico',
			'description' => 'Acompañamiento para startups que necesitan producto, automatización, datos, integraciones, SEO/GEO y arquitectura escalable.',
			'modules'     => array(
				array( 'MVP y producto', 'Definicion, implementación y mejora por etapas.' ),
				array( 'Automatización', 'Procesos internos, soporte, ventas y datos conectados.' ),
				array( 'SEO/GEO', 'Base de contenido y arquitectura para adquisicion orgánica.' ),
			),
			'list'        => array(
				'Enfoque practico para validar sin sobredimensionar.',
				'Integración entre producto, datos, IA y crecimiento.',
				'Arquitectura pensada para evolucionar con el negocio.',
			),
			'faq'         => array(
				array( 'Trabajan con MVP?', 'Sí. Podemos empezar por una versión acotada y validar rápido.' ),
				array( 'Incluye estrategia de contenido?', 'Sí. SEO/GEO puede formar parte del sistema de crecimiento.' ),
			),
		),
		'integraciones'                 => array(
			'title'       => 'Integraciones para conectar ventas, pagos y gestión',
			'kicker'      => 'Ecosistema conectado',
			'description' => 'Conectamos ERP, ecommerce, Mercado Libre, pasarelas de pago, bancos, formularios, CRMs y herramientas internas.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/human-visuals/integraciones-erp-ecommerce-crm.webp',
				'alt' => 'Persona revisando integraciones entre ERP, ecommerce, pagos, CRM, APIs y sistemas conectados',
			),
			'modules'     => array(
				array( 'Canales de venta', 'Sincronizacion con ecommerce, marketplaces y puntos de venta.' ),
				array( 'Pagos', 'Conexión con pasarelas, cobros, conciliaciones y reportes.' ),
				array( 'APIs y datos', 'Integraciones a medida para evitar carga duplicada.' ),
			),
			'list'        => array(
				'Reduce errores por carga manual.',
				'Mejora visibilidad y control entre sistemas.',
				'Permite automatizar procesos repetitivos.',
			),
			'faq'         => array(
				array( 'Se puede integrar cualquier sistema?', 'Depende de APIs, permisos, formatos y estabilidad del proveedor.' ),
				array( 'Conviene integrar todo desde el inicio?', 'No siempre. Se priorizan integraciones según impacto y riesgo.' ),
			),
		),
		'integraciones/mercado-libre'   => array(
			'title'       => 'Integración con Mercado Libre',
			'kicker'      => 'Omnicanalidad',
			'description' => 'Sincronice ventas, stock, publicaciones y facturación para reducir quiebres, errores y trabajo manual.',
			'modules'     => array(
				array( 'Stock sincronizado', 'Evita vender productos sin disponibilidad real.' ),
				array( 'Ventas centralizadas', 'Unifica pedidos y datos comerciales con gestión interna.' ),
				array( 'Automatización', 'Reduce tareas repetidas entre marketplace, ERP y facturación.' ),
			),
			'list'        => array(
				'Ideal para comercios con venta online y local físico.',
				'Permite ordenar depósitos, publicaciones y precios.',
				'Puede combinarse con pasarelas de pago y ERP Cumbre.',
			),
			'faq'         => array(
				array( 'La sincronización es inmediata?', 'El objetivo es acercarse a tiempo real, pero depende de API, volumen y arquitectura.' ),
				array( 'Sirve para varias cuentas?', 'Se puede evaluar según permisos, estructura comercial e integraciones necesarias.' ),
			),
		),
		'tecnologia/pasarela-pagos'     => array(
			'title'       => 'Pasarela de pagos multidivisa',
			'kicker'      => 'Cobros conectados',
			'description' => 'Integre medios de pago locales e internacionales para mejorar ventas, conciliación y control administrativo.',
			'modules'     => array(
				array( 'Cobros locales', 'Mercado Pago, bancos, posnets u otros medios según disponibilidad.' ),
				array( 'Pagos internacionales', 'Opciones cómo Stripe o PayPal cuando el modelo lo requiere.' ),
				array( 'Conciliación', 'Cruce de ventas, liquidaciones, comisiones y estados de cobro.' ),
			),
			'list'        => array(
				'Pensado para ecommerce, servicios y operaciones omnicanal.',
				'Reduce conciliación manual y errores de seguimiento.',
				'Puede integrarse con ERP, web y reportes financieros.',
			),
			'faq'         => array(
				array( 'GEMA procesa los pagos?', 'GEMA integra proveedores de pago; las condiciones dependen de cada pasarela.' ),
				array( 'Puedo cobrar en distintas monedas?', 'Se evalua según país, proveedor, cuenta, moneda y requisitos legales.' ),
			),
		),
		'blog'                          => array(
			'title'       => 'Blog Gema: tecnología, IA y gestión',
			'kicker'      => 'Conocimiento y novedades',
			'description' => 'Articulos sobre software de gestión, inteligencia artificial aplicada, integraciones, SEO/GEO y operación empresarial.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/seo-visuals/seo-geo-nodo-conocimiento-lite.webp',
				'alt' => 'Mapa de contenidos estructurados para blog técnico, FAQ, comparativas, schema, datos y conversión SEO GEO',
			),
			'modules'     => array(
				array( 'IA aplicada', 'Casos, criterios y aprendizajes sobre IA en procesos reales.' ),
				array( 'Gestión empresarial', 'Contenido para ordenar ventas, caja, stock, finanzas y administración.' ),
				array( 'Tecnología', 'Integraciones, arquitectura, cloud, observabilidad y automatización.' ),
			),
			'list'        => array(
				'Hub de contenido para posicionamiento SEO y GEO.',
				'Base para responder dudas frecuentes de clientes.',
				'Canal para educar, atraer y convertir oportunidades.',
			),
			'faq'         => array(
				array( 'El blog sera técnico o comercial?', 'Ambos. Debe explicar con claridad problemas reales y también sostener autoridad técnica.' ),
				array( 'Sirve para SEO?', 'Sí. Es una pieza central para crecer por búsquedas, entidades, preguntas y temas relacionados.' ),
			),
		),
		'faqs'                          => array(
			'title'       => 'Preguntas frecuentes sobre GEMA Digital y ERP Cumbre',
			'kicker'      => 'FAQs',
			'description' => 'Centro de respuestas rápidas sobre ERP Cumbre, módulos, precios, implementación, facturación ARCA, cobros, seguridad, legal, inteligencia artificial y el agente comercial de GEMA Digital.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/seo-visuals/seo-geo-nodo-conocimiento-lite.webp',
				'alt' => 'Centro de preguntas frecuentes sobre ERP Cumbre, módulos, SEO, IA, seguridad y soporte de GEMA Digital',
			),
			'modules'     => array(
				array( 'Cumbre ERP', 'Qué es, por dónde empezar, diferencias entre CRM, Negocios, PyMEs, Empresas, módulos transversales y verticales por rubro.' ),
				array( 'Precios e implementación', 'Prueba, diagnóstico, alcance, usuarios, módulos, acompañamiento, capacitación y activación por etapas.' ),
				array( 'Facturación, cobros y administración', 'Facturador ARCA, Cumbre Cobros, Tesorería, Contabilidad, Impuestos, Reportes BI y controles humanos.' ),
				array( 'Seguridad, legal e IA', 'Privacidad, datos, permisos, auditoría, propiedad intelectual, asistentes IA, agentes y límites de automatización.' ),
			),
			'list'        => array(
				'Use esta página para orientarse rápido antes de pedir demo o hablar con el agente.',
				'Las preguntas están agrupadas por intención: producto, precio, implementación, operación, seguridad, legal e IA.',
				'Si la duda depende de su rubro o proceso, el agente puede recomendar módulos y próximos pasos.',
				'Las respuestas no reemplazan asesoramiento legal, fiscal, contable o laboral profesional cuando corresponda.',
			),
			'faq'         => array(
				array( 'Qué es ERP Cumbre?', 'ERP Cumbre es el ecosistema de gestión de GEMA Digital para ordenar clientes, ventas, catálogo, stock, compras, cobros, facturación, administración, reportes, integraciones e inteligencia artificial en PyMEs y empresas.' ),
				array( 'Por dónde conviene empezar?', 'Depende del problema principal. Muchas empresas empiezan por CRM, ERP Negocios, ERP PyMEs o Cumbre Empresas. El agente puede orientar según rubro, volumen, usuarios y procesos actuales.' ),
				array( 'Cumbre tiene módulos y submódulos?', 'Sí. Cumbre se organiza por módulos troncales, operación diaria, administración y control, crecimiento e integraciones, y verticales por rubro.' ),
				array( 'La prueba gratis reemplaza la implementación?', 'No. La prueba ayuda a conocer el producto. La puesta en marcha real requiere diagnóstico, configuración, datos, usuarios, permisos, integraciones y capacitación.' ),
				array( 'Incluye facturación electrónica ARCA?', 'Cumbre contempla Facturador ARCA como módulo fiscal/documental controlado. La activación real requiere implementación asistida y validación técnica, normativa y operativa.' ),
				array( 'GEMA procesa pagos o actúa como banco?', 'No debe interpretarse así. GEMA/Cumbre integra proveedores de pago y tecnología de cobro, salvo contrato y cumplimiento regulatorio específico que indique otro rol.' ),
				array( 'La IA toma decisiones sola?', 'La IA puede asistir, interpretar y sugerir, pero las acciones críticas deben respetar permisos, auditoría, límites, idempotencia y aprobación humana cuando corresponda.' ),
				array( 'Cómo se protegen los datos?', 'La arquitectura considera permisos, minimización, trazabilidad, credenciales seguras, privacidad y documentación legal. Cada implementación debe validar alcance y responsabilidades.' ),
			),
		),
		'competencia'                   => array(
			'title'       => 'Comparativas de ERP y software de gestión',
			'kicker'      => 'Decisión informada',
			'description' => 'Compare ERP Cumbre y el ecosistema GEMA frente a alternativas conocidas para elegir según operación, costos e integraciones.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/seo-visuals/seo-geo-nodo-conocimiento-lite.webp',
				'alt' => 'Nodo visual de comparativas ERP con datos, FAQ, schema, integraciones y criterios de conversión para SEO y GEO',
			),
			'modules'     => array(
				array( 'Costo total', 'Licencias, implementación, soporte, integraciones y mantenimiento.' ),
				array( 'Adaptacion local', 'Fiscalidad, medios de pago, canales e idioma operativo.' ),
				array( 'Flexibilidad', 'Capacidad para crecer por módulos, integrar datos e incorporar IA.' ),
			),
			'list'        => array(
				'Comparativas pensadas para pymes, comercios y empresas.',
				'Análisis orientado a decisión, no a marketing vacío.',
				'Base para explicar diferencias frente a sistemas conocidos.',
			),
			'faq'         => array(
				array( 'Qué se compara?', 'Costo, alcance, integraciones, soporte, adaptación local, IA y facilidad de adopción.' ),
				array( 'GEMA reemplaza a todos los ERP?', 'No siempre. La decisión depende del caso, madurez, procesos y presupuesto.' ),
			),
		),
		'competencia/tango'             => array(
			'title'       => 'ERP Cumbre vs Tango Gestión',
			'kicker'      => 'Comparativa argentina',
			'description' => 'Análisis inicial para comparar ERP Cumbre con Tango Gestión en adopción, flexibilidad, integraciones e inteligencia artificial.',
			'modules'     => array(
				array( 'Operación local', 'Facturación, administración, stock y necesidades argentinas.' ),
				array( 'Modernización', 'Integraciones, cloud, automatizaciones y tableros.' ),
				array( 'Adopcion', 'Curva de aprendizaje, soporte, datos y cambio operativo.' ),
			),
			'list'        => array(
				'Página base para capturar búsquedas comparativas.',
				'Debe completarse con tabla detallada antes de producción.',
				'Enfoque consultivo y no agresivo contra competidores.',
			),
			'faq'         => array(
				array( 'Conviene migrar desde Tango?', 'Depende de procesos, integraciones, costos y objetivos de modernización.' ),
				array( 'Se pueden importar datos?', 'Se evalua según formatos, calidad de información y alcance.' ),
			),
		),
		'competencia/odoo'              => array(
			'title'       => 'ERP Cumbre vs Odoo',
			'kicker'      => 'Comparativa ERP',
			'description' => 'Compare ERP Cumbre con Odoo en localización, implementación, módulos, costos, soporte e integraciones.',
			'modules'     => array(
				array( 'Modularidad', 'Alcance funcional y crecimiento por etapas.' ),
				array( 'Localizacion', 'Adaptacion a operación argentina, fiscalidad y canales.' ),
				array( 'Implementación', 'Tiempo, costo, soporte y adopción real.' ),
			),
			'list'        => array(
				'Odoo puede ser potente pero requiere buena implementación.',
				'ERP Cumbre busca cercanía operativa e integraciones locales.',
				'La decisión depende de madurez técnica y necesidades reales.',
			),
			'faq'         => array(
				array( 'Odoo es mejor o peor?', 'No hay respuesta única. Depende de alcance, presupuesto, localización y equipo.' ),
				array( 'GEMA puede integrarse con Odoo?', 'Se puede evaluar si conviene integrar, migrar o convivir por etapas.' ),
			),
		),
		'competencia/sap'               => array(
			'title'       => 'ERP Cumbre vs SAP Business One',
			'kicker'      => 'Comparativa empresarial',
			'description' => 'Análisis para empresas que comparan ERP Cumbre con SAP Business One en costo, implementación, flexibilidad e integraciones.',
			'modules'     => array(
				array( 'Escala', 'Necesidades de control, permisos, reportes y trazabilidad.' ),
				array( 'Costo y complejidad', 'Licencias, consultoría, mantenimiento y tiempo de adopción.' ),
				array( 'Flexibilidad', 'Integraciones, automatizaciones y adaptación al negocio.' ),
			),
			'list'        => array(
				'SAP puede ser adecuado para estructuras grandes y maduras.',
				'ERP Cumbre apunta a control con implementación más cercana.',
				'La comparativa debe revisarse según cada operación.',
			),
			'faq'         => array(
				array( 'ERP Cumbre reemplaza a SAP?', 'No necesariamente. Puede ser alternativa, complemento o etapa previa según caso.' ),
				array( 'Qué empresas deberían comparar?', 'Pymes y empresas que necesitan control sin sobredimensionar costos.' ),
			),
		),
		'competencia/netsuite'          => array(
			'title'       => 'ERP Cumbre vs Oracle NetSuite',
			'kicker'      => 'Comparativa cloud ERP',
			'description' => 'Compare ERP Cumbre con Oracle NetSuite considerando moneda, costos, implementación, soporte e integraciones locales.',
			'modules'     => array(
				array( 'Cloud ERP', 'Escalabilidad, disponibilidad y operaciones distribuidas.' ),
				array( 'Costos', 'Licencias, moneda, implementación y mantenimiento.' ),
				array( 'Localizacion', 'Necesidades fiscales, pagos, bancos y canales argentinos.' ),
			),
			'list'        => array(
				'NetSuite puede ser fuerte en empresas globales.',
				'ERP Cumbre busca cercanía local y control gradual.',
				'La decisión requiere analizar costo total y adopción.',
			),
			'faq'         => array(
				array( 'Por qué comparar con NetSuite?', 'Porque muchas empresas evalúan ERP cloud y necesitan entender costo total y localización.' ),
				array( 'ERP Cumbre es internacional?', 'La prioridad inicial es resolver operaciones reales con foco local y escalabilidad.' ),
			),
		),
		'competencia/holded'            => array(
			'title'       => 'ERP Cumbre vs Holded',
			'kicker'      => 'Comparativa para pymes',
			'description' => 'Compare ERP Cumbre con Holded para entender diferencias en gestión, localización, soporte, integraciones e IA.',
			'modules'     => array(
				array( 'Simplicidad', 'Facilidad de uso, puesta en marcha y adopción.' ),
				array( 'Gestión local', 'Facturación, pagos, bancos y procesos argentinos.' ),
				array( 'Crecimiento', 'Módulos, integraciones y automatizaciones a medida.' ),
			),
			'list'        => array(
				'Holded puede funcionar para gestión simple.',
				'ERP Cumbre busca mayor adaptación a procesos e integraciones.',
				'La eleccion depende de etapa, equipo y complejidad.',
			),
			'faq'         => array(
				array( 'Holded sirve para Argentina?', 'Depende de requisitos fiscales, medios de pago e integraciones necesarias.' ),
				array( 'ERP Cumbre es más complejo?', 'Puede crecer por etapas para evitar complejidad inicial innecesaria.' ),
			),
		),
		'atencion-personalizada'        => array(
			'title'       => 'Atención personalizada para clientes GEMA',
			'kicker'      => 'Acompañamiento humano',
			'description' => 'Canal de confianza para entender necesidades, ordenar prioridades y acompañar decisiónes de software, gestión e IA.',
			'modules'     => array(
				array( 'Diagnóstico', 'Escucha inicial y relevamiento de problemas concretos.' ),
				array( 'Seguimiento', 'Prioridades, proximos pasos y comunicación clara.' ),
				array( 'Soporte', 'Acompañamiento durante implementación y mejora continua.' ),
			),
			'list'        => array(
				'Pensado para reducir incertidumbre técnica.',
				'Conecta negocio, tecnología y operación diaria.',
				'Complementa software con criterio y soporte humano.',
			),
			'faq'         => array(
				array( 'La atención es automatizada?', 'Puede haber automatizaciones, pero el enfoque es mantener criterio humano cuando importa.' ),
				array( 'Cómo se empieza?', 'Con una consulta o diagnóstico para entender contexto y prioridades.' ),
			),
		),
		'terminos'                      => array(
			'title'       => 'Términos y condiciones',
			'kicker'      => 'Marco de uso y contratación',
			'description' => 'Condiciones generales para el uso del sitio, comunicaciones comerciales, diagnósticos, propuestas y servicios ofrecidos por GEMA Digital.',
			'modules'     => array(
				array( 'Titular actual', 'GEMA Digital y Cumbre operan actualmente bajo Generadores Sur SRL, CUIT 33-71752891-9, sin perjuicio de futuras actualizaciones societarias, comerciales o marcarias que se informen en esta sección.' ),
				array( 'Uso del sitio', 'El contenido publicado informa sobre soluciones de software, ERP, automatización, inteligencia artificial, marketing digital, integraciones y servicios relacionados. Puede actualizarse para reflejar cambios técnicos, comerciales o normativos.' ),
				array( 'Propuestas y contratación', 'Todo servicio profesional, implementación, desarrollo, consultoría, diagnóstico o producto se rige por una propuesta, presupuesto, orden de trabajo, contrato o acuerdo específico aceptado por las partes.' ),
				array( 'Alcance de resultados', 'Los resultados de SEO, SEM, GEO, automatización, software, ERP o marketing dependen de datos disponibles, adopción del cliente, integraciones externas, presupuesto, competencia, tiempos de implementación y decisiónes operativas.' ),
				array( 'Propiedad intelectual', 'Textos, diseños, código, recursos visuales, metodologías, documentación, marcas y materiales del sitio pertenecen a GEMA Digital o a sus respectivos titulares, salvo indicación expresa en contrario.' ),
				array( 'Servicios de terceros', 'Algunas soluciones pueden integrarse con plataformas como Google, Meta, WhatsApp, Mercado Libre, bancos, pasarelas de pago, CRMs, ERPs, servicios cloud u otras herramientas sujetas a términos propios.' ),
				array( 'Uso responsable', 'El usuario se compromete a no utilizar el sitio, formularios, demos, accesos o comunicaciones para fines ilegales, abusivos, fraudulentos, de scraping no autorizado, interferencia técnica o vulneración de derechos.' ),
			),
			'list'        => array(
				'La información del sitio no constituye asesoramiento legal, fiscal, contable ni financiero. Para decisiónes críticas debe consultarse a profesionales correspondientes.',
				'Los contratos, presupuestos, anexos técnicos, acuerdos de confidencialidad y términos particulares prevalecen sobre el contenido general publicado en el sitio.',
				'Las demostraciones, estimaciones, calculadoras, comparativas o ejemplos son orientativos y pueden variar según el caso real, integraciones, datos y alcance contratado.',
				'GEMA Digital puede modificar contenidos, rutas, precios informativos, funcionalidades o condiciones generales del sitio para mantener información actualizada y precisa.',
				'El contacto comercial no genera obligación de contratación hasta que exista aceptación expresa de una propuesta o acuerdo entre las partes.',
			),
			'faq'         => array(
				array( 'Estos términos reemplazan un contrato?', 'No. Los términos del sitio son generales. Cada proyecto, implementación o servicio debe regirse por su propuesta, alcance y acuerdo específico.' ),
				array( 'Las comparativas y calculadoras garantizan resultados?', 'No. Son referencias para orientar decisiónes. Los resultados reales dependen de datos, procesos, integraciones, adopción y contexto competitivo.' ),
				array( 'GEMA Digital trabaja con herramientas de terceros?', 'Sí. Muchas soluciones pueden usar APIs, plataformas cloud, servicios publicitarios, pasarelas de pago, CRMs, marketplaces u otras herramientas sujetas a condiciones propias.' ),
			),
		),
		'privacidad'                    => array(
			'title'       => 'Política de privacidad',
			'kicker'      => 'Datos, confianza y protección del cliente',
			'description' => 'Política sobre cómo GEMA Digital puede recopilar, usar, proteger y conservar información de contacto, datos comerciales, formularios, analítica, diagnósticos y comunicaciones.',
			'modules'     => array(
				array( 'Responsable actual', 'GEMA Digital y Cumbre operan actualmente bajo Generadores Sur SRL, CUIT 33-71752891-9. Este dato identifica al responsable comercial actual de las consultas, propuestas y servicios vinculados al sitio.' ),
				array( 'Datos que podemos recibir', 'Nombre, apellido, email, teléfono, empresa, cargo, rubro, sitio web, país, ciudad, mensaje, necesidades operativas, información enviada en formularios y datos necesarios para responder consultas o preparar propuestas.' ),
				array( 'Finalidad del tratamiento', 'Usamos la información para responder consultas, coordinar diagnósticos, elaborar propuestas, prestar servicios, mejorar el sitio, medir rendimiento, prevenir abuso y mantener comunicaciones comerciales relacionadas.' ),
				array( 'Datos de proyectos', 'En implementaciones de software, ERP, automatización o marketing, el cliente puede compartir información operativa. Esa información debe tratarse según alcance contratado, confidencialidad, permisos y medidas de seguridad acordadas.' ),
				array( 'Herramientas y proveedores', 'Podemos utilizar servicios de hosting, correo, analítica, CRM, formularios, automatización, publicidad, videollamadas, almacenamiento, soporte o integraciones. Cada proveedor puede procesar datos según sus propias políticas.' ),
				array( 'Seguridad y minimización', 'Aplicamos el criterio de recopilar solo lo necesario, limitar accesos, proteger información sensible y evitar usos incompatibles con la finalidad informada o acordada con el cliente.' ),
				array( 'Derechos del titular', 'Las personas pueden solicitar acceso, rectificación, actualización, baja o información sobre sus datos escribiendo a los canales de contacto publicados por GEMA Digital.' ),
			),
			'list'        => array(
				'La información enviada por formularios se utiliza principalmente para responder consultas, diagnosticar necesidades y preparar propuestas comerciales o técnicas.',
				'No vendemos datos personales como producto. Podemos compartir información solo cuando sea necesario para operar servicios, cumplir obligaciones, usar proveedores o ejecutar acuerdos.',
				'En proyectos B2B, la información operativa del cliente debe tratarse con confidencialidad y de acuerdo con permisos, usuarios, roles y alcances definidos.',
				'La retención de datos debe limitarse al tiempo razonable para responder consultas, cumplir acuerdos, mantener registros comerciales, soporte, seguridad o requisitos aplicables.',
				'Esta política debe revisarse antes de producción definitiva con la configuración real de analítica, CRM, cookies, formularios, publicidad y proveedores activos.',
			),
			'faq'         => array(
				array( 'Qué datos pide GEMA Digital?', 'Principalmente datos de contacto, empresa, consulta y contexto necesario para responder, diagnosticar o preparar una propuesta.' ),
				array( 'GEMA vende datos personales?', 'No vendemos datos personales como producto. Podemos usar proveedores necesarios para operar el sitio, comunicaciones, analítica, CRM, publicidad o servicios contratados.' ),
				array( 'Cómo puedo pedir baja o corrección de mis datos?', 'Puede escribir por los canales de contacto publicados solicitando acceso, actualización, corrección o baja, indicando los datos necesarios para identificar la solicitud.' ),
			),
		),
		'politica-de-cookies'           => array(
			'title'       => 'Política de cookies',
			'kicker'      => 'Transparencia digital',
			'description' => 'Información sobre el uso de cookies, tecnologías similares, analítica, medición publicitaria y preferencias del usuario en el sitio de GEMA Digital.',
			'modules'     => array(
				array( 'Qué son las cookies', 'Son pequeños archivos o identificadores que un sitio puede usar para recordar preferencias, medir uso, mejorar experiencia, mantener seguridad o analizar rendimiento.' ),
				array( 'Cookies necesarias', 'Permiten funciones básicas como navegación, seguridad, formularios, preferencias técnicas y funcionamiento estable del sitio. Sin ellas algunas partes pueden no operar correctamente.' ),
				array( 'Analítica y rendimiento', 'Podemos medir visitas, páginas consultadas, origen de tráfico, eventos, conversiones y rendimiento para mejorar contenido, SEO, GEO, campañas y experiencia de usuario.' ),
				array( 'Publicidad y remarketing', 'Si se activan campañas, pueden usarse identificadores para medir anuncios, evitar repetición excesiva, crear audiencias, optimizar conversiones o mostrar comunicaciones relevantes.' ),
				array( 'Herramientas externas', 'Servicios como Google, Meta, HubSpot, formularios, CRM, mapas, videos, chat, automatizaciones o integraciones pueden usar tecnologías propias sujetas a sus políticas.' ),
				array( 'Control del usuario', 'El usuario puede gestionar cookies desde el navegador, borrar datos almacenados o bloquear ciertas tecnologías. Algunas funciones del sitio pueden verse afectadas.' ),
			),
			'list'        => array(
				'La configuración final de cookies debe alinearse con las herramientas reales activas en producción.',
				'El sitio debe evitar cargas innecesarias y priorizar medición clara, proporcional y orientada a mejorar experiencia, seguridad y conversión.',
				'Las cookies de analítica y publicidad deben informarse con transparencia cuando se activen herramientas concretas.',
				'Para SEO/GEO, una política clara de cookies y privacidad ayuda a reforzar confianza, profesionalismo y cumplimiento frente a usuarios, Google y motores de IA.',
				'Si se incorpora banner de consentimiento, debe permitir informar, aceptar, rechazar o configurar categorías según corresponda.',
			),
			'faq'         => array(
				array( 'El sitio usa cookies?', 'Puede utilizar cookies necesarias y, según configuración, tecnologías de analítica, medición publicitaria, formularios, CRM o herramientas externas.' ),
				array( 'Puedo bloquear cookies?', 'Sí. Puede hacerlo desde la configuración del navegador, aunque algunas funciones de seguridad, formularios o preferencias pueden verse afectadas.' ),
				array( 'La política cambiará?', 'Si se agregan herramientas como analítica, CRM, chat, pixel publicitario o automatizaciones, la política debe actualizarse para reflejar el uso real.' ),
			),
		),
		'legal/cumbre'                  => array(
			'title'               => 'Centro legal Cumbre',
			'kicker'              => 'Información legal para usuarios y clientes',
			'description'         => 'Centro público de información legal de Cumbre y GEMA Digital: términos SaaS, privacidad, datos, propiedad intelectual, pagos, ARCA, IA, seguridad, baja, comunicaciones y anexos por módulo.',
			'modules_title'       => 'Documentos disponibles',
			'list_title'          => 'Criterio general',
			'links_title'         => 'Páginas legales Cumbre',
			'faq_title'           => 'Preguntas legales frecuentes',
			'primary_cta_label'   => 'Consultar por un contrato',
			'secondary_cta_label' => 'Ver términos generales',
			'secondary_cta_url'   => '/terminos',
			'modules'             => array(
				array( 'Titular actual', 'GEMA Digital y Cumbre operan actualmente bajo Generadores Sur SRL, CUIT 33-71752891-9. Esta información podrá actualizarse si cambia la estructura societaria, comercial o contractual.' ),
				array( 'Términos SaaS', 'Condiciones para acceder y usar Cumbre como plataforma modular bajo licencia, con planes, límites, add-ons, soporte, baja y responsabilidades.' ),
				array( 'Privacidad y DPA', 'Información sobre datos personales, roles de responsable y encargado, derechos de titulares, subprocesadores, transferencias y seguridad.' ),
				array( 'Propiedad intelectual', 'Reserva de derechos sobre software, marcas, código, interfaces, documentación, flujos, prompts, contenidos y metodologías.' ),
				array( 'Módulos sensibles', 'Cumbre Cobros, Facturador ARCA e IA se informan con límites específicos para evitar promesas regulatorias o profesionales no validadas.' ),
				array( 'Clientes protegidos', 'Los clientes conservan sus datos y deben contar con reglas claras sobre exportación, baja, uso aceptable, comunicaciones y soporte.' ),
			),
			'list'                => array(
				'Estos textos se publican para dar transparencia a usuarios y clientes mientras continúan las revisiones profesionales correspondientes.',
				'La información legal publicada no reemplaza contratos, propuestas, anexos o acuerdos específicos aceptados por las partes.',
				'Cumbre debe entenderse como plataforma SaaS modular: el cliente recibe una licencia de uso, no propiedad sobre el software.',
				'El cliente conserva sus datos, contenidos y operaciones propias; GEMA/Cumbre conserva la titularidad del software, marcas, documentación, interfaces, prompts, flujos y materiales relacionados.',
				'Los módulos de ARCA, pagos e IA requieren validación técnica, fiscal, regulatoria o humana según el caso antes de operar en escenarios críticos.',
			),
			'links'               => gema_sovereign_get_cumbre_legal_links(),
			'faq'                 => array(
				array( 'Por qué publicar esta información ahora?', 'Porque los usuarios deben poder conocer las condiciones generales, límites, responsabilidades, privacidad y protección de datos antes de contratar o usar Cumbre.' ),
				array( 'Estos textos son definitivos?', 'Son textos públicos vigentes de carácter informativo y contractual general, sujetos a futuras mejoras tras revisión profesional legal, contable y regulatoria.' ),
				array( 'Quién opera actualmente GEMA/Cumbre?', 'Actualmente opera bajo Generadores Sur SRL, CUIT 33-71752891-9, salvo actualización posterior publicada por GEMA Digital.' ),
			),
		),
		'legal/cumbre-terminos-servicio' => array(
			'title'               => 'Términos de Servicio SaaS Cumbre',
			'kicker'              => 'Licencia, planes y uso de la plataforma',
			'description'         => 'Condiciones de uso de la plataforma Cumbre como software en modalidad SaaS modular, operado actualmente por Generadores Sur SRL, CUIT 33-71752891-9.',
			'modules_title'       => 'Condiciones principales',
			'list_title'          => 'Resumen contractual',
			'links_title'         => 'Más documentos legales',
			'faq_title'           => 'Preguntas sobre contratación',
			'primary_cta_label'   => 'Solicitar propuesta',
			'secondary_cta_label' => 'Centro legal',
			'secondary_cta_url'   => '/legal/cumbre',
			'modules'             => array(
				array( 'Objeto', 'Estos términos regulan el acceso y uso de Cumbre, sus módulos, planes, add-ons, pruebas, implementación, soporte e integraciones relacionadas.' ),
				array( 'Naturaleza SaaS', 'Cumbre se presta como software en modalidad servicio. El cliente no adquiere propiedad sobre el software, código, marca, diseño, documentación, arquitectura, flujos, plantillas ni materiales relacionados.' ),
				array( 'Licencia de uso', 'Durante la vigencia del plan contratado, el cliente recibe una licencia limitada, no exclusiva, no sublicenciable, no transferible, revocable y temporal para usar los módulos habilitados.' ),
				array( 'Alcance modular', 'La contratación de un módulo no implica acceso automático a todos los módulos, add-ons, integraciones, funciones premium, implementaciones asistidas o desarrollos a medida.' ),
				array( 'Planes y límites', 'Los planes pueden limitar usuarios, cajas, locales, productos, comprobantes, leads, almacenamiento, automatizaciones, integraciones, soporte y reportes.' ),
				array( 'Suspensión y baja', 'El acceso puede limitarse por mora, uso abusivo, incumplimiento, riesgo de seguridad, requerimiento legal, superación de límites o uso fraudulento.' ),
			),
			'list'                => array(
				'El cliente es responsable por exactitud de datos cargados, usuarios, contraseñas, permisos internos, precios, impuestos, comprobantes, uso de integraciones y cumplimiento fiscal, contable, laboral, comercial o regulatorio.',
				'GEMA/Cumbre podrá procesar datos para prestar el servicio, soporte, seguridad, mantenimiento, mejoras, facturación, auditoría y cumplimiento legal.',
				'La plataforma no garantiza resultados comerciales, fiscales, contables, publicitarios, financieros o de posicionamiento.',
				'Las integraciones con terceros como pasarelas, marketplaces, APIs fiscales, servicios de IA, WhatsApp, correo, analytics, hosting, bancos o ecommerce quedan sujetas a condiciones y disponibilidad de esos terceros.',
				'Las condiciones particulares de una propuesta, orden de trabajo, SLA, DPA o anexo aceptado prevalecen sobre esta descripción general cuando regulen el mismo punto de forma específica.',
			),
			'links'               => gema_sovereign_get_cumbre_legal_links(),
			'faq'                 => array(
				array( 'Cumbre se vende como software propio del cliente?', 'No. Cumbre se licencia como SaaS. El cliente puede usar los módulos contratados, pero no adquiere propiedad del software.' ),
				array( 'Qué pasa si supero límites del plan?', 'Puede haber alertas, restricciones, bloqueo de nuevas altas o necesidad de upgrade, sin eliminación automática de datos.' ),
				array( 'Un contrato particular puede cambiar estas reglas?', 'Sí. Una propuesta, orden de trabajo o anexo aceptado puede definir condiciones particulares para un caso concreto.' ),
			),
		),
		'legal/cumbre-privacidad-dpa'   => array(
			'title'               => 'Privacidad y tratamiento de datos Cumbre',
			'kicker'              => 'Datos personales, DPA y derechos de titulares',
			'description'         => 'Política específica de privacidad y bases para el acuerdo de tratamiento de datos de Cumbre, con roles, finalidades, subprocesadores, transferencias, seguridad y derechos de titulares.',
			'modules_title'       => 'Cómo se tratan los datos',
			'list_title'          => 'Compromisos de privacidad',
			'links_title'         => 'Documentos relacionados',
			'faq_title'           => 'Preguntas sobre datos',
			'primary_cta_label'   => 'Consultar privacidad',
			'secondary_cta_label' => 'Centro legal',
			'secondary_cta_url'   => '/legal/cumbre',
			'modules'             => array(
				array( 'Responsable actual', 'GEMA Digital y Cumbre operan actualmente bajo Generadores Sur SRL, CUIT 33-71752891-9, como titular comercial actual de la plataforma y sus comunicaciones.' ),
				array( 'Roles de datos', 'GEMA/Cumbre puede actuar como responsable respecto de sus leads, clientes, facturación, soporte, marketing y analítica; y como encargado/procesador cuando trata datos por cuenta de clientes B2B.' ),
				array( 'Datos tratados', 'Pueden incluir usuarios, roles, permisos, clientes del cliente, proveedores, productos, precios, stock, ventas, caja, comprobantes, presupuestos, oportunidades, soporte, logs e interacciones con IA.' ),
				array( 'Finalidades', 'Prestar el servicio, administrar cuentas, procesar operaciones, brindar soporte, mantener seguridad, registrar auditoría, mejorar producto, cumplir obligaciones legales y gestionar comunicaciones relacionadas.' ),
				array( 'Subprocesadores', 'Pueden intervenir proveedores de hosting, bases de datos, backups, correo, mensajería, analítica, IA, pasarelas, soporte, monitoreo, videollamadas o CRM.' ),
				array( 'Derechos ARCO', 'Las personas pueden solicitar acceso, rectificación, actualización, supresión o retiro de consentimiento cuando corresponda, por los canales publicados por GEMA Digital.' ),
			),
			'list'                => array(
				'El cliente conserva derechos sobre sus datos comerciales, productos, precios, clientes, proveedores, usuarios, ventas, stock, comprobantes, contenidos y configuraciones propias.',
				'El cliente declara contar con autorización o base legal suficiente para cargar y tratar datos de terceros en Cumbre.',
				'Cuando Cumbre actúe como encargado, asistirá razonablemente al cliente responsable ante pedidos de titulares, incidentes, devolución o eliminación de datos.',
				'Si se usan servicios cloud, IA, email, analytics, soporte u otros proveedores alojados fuera de Argentina, puede existir transferencia internacional de datos sujeta a evaluación legal.',
				'Las medidas de seguridad pueden incluir autenticación, roles, permisos, cifrado en tránsito, backups, segregación lógica, registros de actividad, mínimos privilegios, monitoreo e incident response.',
			),
			'links'               => gema_sovereign_get_cumbre_legal_links(),
			'faq'                 => array(
				array( 'El cliente conserva sus datos?', 'Sí. El cliente conserva sus datos, contenidos y operaciones propias. GEMA/Cumbre procesa datos para prestar y proteger el servicio.' ),
				array( 'Cumbre necesita un DPA?', 'Para clientes B2B, el DPA es recomendable cuando Cumbre procesa datos por cuenta del cliente.' ),
				array( 'Se pueden borrar datos?', 'Puede solicitarse baja, supresión o exportación razonable, sujeto a plazos técnicos, legales, backups, auditoría, facturación y defensa ante reclamos.' ),
			),
		),
		'legal/cumbre-propiedad-intelectual' => array(
			'title'               => 'Propiedad intelectual y derechos reservados Cumbre',
			'kicker'              => 'Software, marcas, código, contenido y metodología',
			'description'         => 'Información pública sobre propiedad intelectual de Cumbre y GEMA Digital: licencia, derechos reservados, uso permitido, marcas, software, documentación, prompts, flujos y activos protegidos.',
			'modules_title'       => 'Activos protegidos',
			'list_title'          => 'Uso permitido y prohibiciones',
			'links_title'         => 'Más información legal',
			'faq_title'           => 'Preguntas sobre propiedad intelectual',
			'primary_cta_label'   => 'Consultar uso de marca',
			'secondary_cta_label' => 'Centro legal',
			'secondary_cta_url'   => '/legal/cumbre',
			'modules'             => array(
				array( 'Software y código', 'Cumbre, ERP Cumbre, Cumbre CRM, Cumbre ERP Negocios y sus módulos son activos protegidos. El acceso del cliente se otorga bajo licencia de uso, no como transferencia de propiedad.' ),
				array( 'Marcas y nombres', 'GEMA Digital, Cumbre, ERP Cumbre, Cumbre CRM, Cumbre ERP Negocios, logos y nombres comerciales son marcas, signos distintivos o activos de sus titulares actuales o futuros.' ),
				array( 'Interfaces y flujos', 'Diseños, pantallas, arquitectura, metodologías, automatizaciones, bases de conocimiento, prompts, reportes, plantillas e integraciones forman parte del activo protegido.' ),
				array( 'Documentación y contenidos', 'Textos, manuales, guías, propuestas, comparativas, imágenes, materiales comerciales y documentación técnica pertenecen a GEMA/Cumbre o sus licenciantes.' ),
				array( 'Datos del cliente', 'La reserva de propiedad intelectual no afecta los derechos del cliente sobre sus datos, productos, precios, contenidos propios, ventas, clientes, proveedores y operaciones.' ),
				array( 'Feedback', 'Las sugerencias o feedback pueden usarse para mejorar el producto, sin que ello transfiera secretos comerciales del cliente ni derechos sobre sus datos propios.' ),
			),
			'list'                => array(
				'Queda prohibido copiar, reproducir, distribuir, publicar, revender, sublicenciar, alquilar, ceder o explotar el software o sus componentes sin autorización previa y por escrito.',
				'No se permite realizar ingeniería inversa, descompilar, desensamblar, extraer código, remover avisos de propiedad intelectual o intentar vulnerar medidas técnicas.',
				'No se permite extraer, replicar o reutilizar interfaces, flujos, prompts, bases de conocimiento, documentación o materiales para crear productos competidores.',
				'El uso de marcas, logos, capturas, nombres comerciales o materiales de GEMA/Cumbre requiere autorización expresa salvo usos nominativos permitidos por la ley.',
				'GEMA/Cumbre podrá registrar marcas, software, documentación y otros activos ante INPI, DNDA u organismos correspondientes para reforzar su protección.',
			),
			'links'               => gema_sovereign_get_cumbre_legal_links(),
			'faq'                 => array(
				array( 'Puedo copiar pantallas o flujos de Cumbre?', 'No para crear productos competidores ni explotar componentes protegidos sin autorización.' ),
				array( 'El cliente pierde propiedad sobre sus datos?', 'No. El cliente conserva sus datos. La propiedad intelectual reservada se refiere al software, marcas, documentación, flujos y activos de Cumbre/GEMA.' ),
				array( 'Cumbre puede registrar el software y las marcas?', 'Sí. El software, documentación y marcas pueden registrarse o depositarse para reforzar prueba y protección.' ),
			),
		),
		'legal/cumbre-pagos-arca-ia'   => array(
			'title'               => 'Condiciones legales para pagos, ARCA e IA en Cumbre',
			'kicker'              => 'Módulos sensibles y validación humana',
			'description'         => 'Información legal sobre Cumbre Cobros, Gema Pagos, Facturador ARCA y asistentes de inteligencia artificial: límites, responsabilidades, proveedores externos y validación profesional.',
			'modules_title'       => 'Áreas sensibles',
			'list_title'          => 'Límites y responsabilidades',
			'links_title'         => 'Documentos legales complementarios',
			'faq_title'           => 'Preguntas sobre pagos, ARCA e IA',
			'primary_cta_label'   => 'Validar caso',
			'secondary_cta_label' => 'Centro legal',
			'secondary_cta_url'   => '/legal/cumbre',
			'modules'             => array(
				array( 'Cumbre Cobros', 'Puede integrar proveedores externos, registrar cobros, generar referencias, links, QR o conciliaciones según alcance y configuración.' ),
				array( 'Rol no financiero', 'Salvo indicación expresa y cumplimiento regulatorio aplicable, GEMA/Cumbre actúa como integrador tecnológico y no como banco, entidad financiera, PSP, billetera, adquirente, agregador, iniciador ni custodio de fondos.' ),
				array( 'Tarjetas y PCI', 'La estrategia recomendada es usar proveedores externos certificados, redirecciones, formularios alojados, iframes seguros o tokenización, evitando almacenar PAN completo, CVV o PIN.' ),
				array( 'Facturador ARCA', 'Las funciones vinculadas a ARCA dependen de CUIT, clave fiscal, punto de venta, certificados, delegaciones, servicios externos, normativa vigente y validación del cliente o su contador.' ),
				array( 'Asistentes IA', 'La IA orienta, recomienda y ayuda al usuario, pero puede equivocarse. No reemplaza criterio humano ni asesoramiento legal, fiscal, contable, financiero, médico o profesional.' ),
				array( 'Acciones críticas', 'Facturar, enviar campañas masivas, cambiar precios, borrar datos, ejecutar cobros o tomar decisiones fiscales requiere revisión humana autorizada.' ),
			),
			'list'                => array(
				'Los proveedores de pago aplican sus propios términos, comisiones, plazos de acreditación, retenciones, contracargos, políticas antifraude, disponibilidad y restricciones.',
				'Si en el futuro GEMA/Cumbre custodiara fondos, iniciara pagos, ofreciera cuentas o actuara como agregador, deberá revisarse normativa BCRA/PSP antes de operar.',
				'Cumbre no presta asesoramiento contable, impositivo, fiscal ni legal, salvo contrato profesional expreso y separado.',
				'El cliente es responsable por su situación fiscal, datos declarados, alícuotas, condición frente al IVA, domicilios, puntos de venta, certificados y revisión de comprobantes.',
				'Los usuarios no deben cargar en asistentes IA datos sensibles innecesarios, secretos comerciales de terceros o información que no estén autorizados a tratar.',
			),
			'links'               => gema_sovereign_get_cumbre_legal_links(),
			'faq'                 => array(
				array( 'GEMA/Cumbre es PSP?', 'No debe interpretarse así salvo contrato específico, registro y cumplimiento regulatorio aplicable. El modelo inicial se comunica como integración tecnológica con proveedores externos.' ),
				array( 'Cumbre garantiza cumplimiento ARCA?', 'No. Ayuda técnicamente, pero la emisión real depende de configuración, servicios externos, normativa y validación del contribuyente o contador.' ),
				array( 'La IA decide por el usuario?', 'No. La IA orienta y puede equivocarse. Las acciones críticas deben validarse humanamente.' ),
			),
		),
		'legal/cumbre-seguridad-baja'  => array(
			'title'               => 'Seguridad, disponibilidad, baja y exportación de datos Cumbre',
			'kicker'              => 'Continuidad, soporte y salida ordenada',
			'description'         => 'Información legal y operativa sobre seguridad razonable, disponibilidad, soporte, mantenimiento, backups, incidentes, baja, retención y exportación de datos en Cumbre.',
			'modules_title'       => 'Controles y procesos',
			'list_title'          => 'Reglas de continuidad y salida',
			'links_title'         => 'Más documentos legales',
			'faq_title'           => 'Preguntas sobre seguridad y baja',
			'primary_cta_label'   => 'Consultar soporte',
			'secondary_cta_label' => 'Centro legal',
			'secondary_cta_url'   => '/legal/cumbre',
			'modules'             => array(
				array( 'Seguridad razonable', 'GEMA/Cumbre aplicará medidas técnicas y organizativas razonables según el estado del servicio, tecnología disponible, riesgo, plan contratado y buenas prácticas aplicables.' ),
				array( 'Responsabilidad compartida', 'El cliente debe colaborar con contraseñas seguras, control de usuarios, permisos adecuados, capacitación interna, dispositivos protegidos y notificación temprana de incidentes.' ),
				array( 'Disponibilidad', 'La plataforma puede verse afectada por mantenimiento, actualizaciones, incidentes, conectividad, terceros, cambios de APIs, fuerza mayor, ataques o errores de uso.' ),
				array( 'Backups', 'Los backups son controles técnicos de continuidad y recuperación, no un archivo legal garantizado ni reemplazo de la obligación del cliente de conservar información crítica.' ),
				array( 'Baja y exportación', 'Cuando sea técnicamente posible y legalmente procedente, el cliente podrá solicitar exportación razonable de datos disponibles en formatos básicos.' ),
				array( 'Retención', 'Pueden conservarse datos durante plazos necesarios para cumplimiento legal, facturación, seguridad, backups, auditoría, defensa ante reclamos o continuidad operativa.' ),
			),
			'list'                => array(
				'Ningún sistema informático, servicio cloud, integración o transmisión por internet puede garantizar seguridad absoluta, disponibilidad ininterrumpida o ausencia total de errores.',
				'Los niveles de soporte, respuesta, disponibilidad o mantenimiento serán los indicados en el plan, SLA, propuesta comercial o anexo aplicable.',
				'La exportación no incluye necesariamente código, modelos internos, logs técnicos completos, información de terceros, backups históricos, configuraciones propietarias o componentes de la plataforma.',
				'La baja puede estar sujeta a validaciones de identidad, obligaciones pendientes, retención legal, seguridad, facturación, resolución de disputas o períodos técnicos de eliminación.',
				'Superar límites de plan o trial no implica eliminación automática de datos, pero puede restringir nuevas altas, funciones premium o requerir upgrade.',
			),
			'links'               => gema_sovereign_get_cumbre_legal_links(),
			'faq'                 => array(
				array( 'Cumbre garantiza seguridad absoluta?', 'No. Se aplican medidas razonables, pero ningún sistema conectado a internet puede garantizar seguridad absoluta.' ),
				array( 'Puedo exportar mis datos?', 'Se podrá solicitar exportación razonable de datos disponibles en formatos básicos, sujeto a límites técnicos, legales y de seguridad.' ),
				array( 'Qué pasa al pedir baja?', 'Se procesa según el canal y condiciones aplicables, con retención temporal cuando sea necesaria por cumplimiento, facturación, seguridad o reclamos.' ),
			),
		),
		'legal/cumbre-comunicaciones-modulos' => array(
			'title'               => 'Comunicaciones comerciales, uso aceptable y anexos por módulo Cumbre',
			'kicker'              => 'CRM, marketing, contenido y responsabilidades por módulo',
			'description'         => 'Información legal sobre comunicaciones comerciales, Registro No Llame, bases de contactos, uso aceptable, contenidos del cliente y anexos de riesgo por módulo Cumbre.',
			'modules_title'       => 'Reglas por uso y módulo',
			'list_title'          => 'Condiciones de uso aceptable',
			'links_title'         => 'Documentos legales Cumbre',
			'faq_title'           => 'Preguntas sobre comunicaciones y módulos',
			'primary_cta_label'   => 'Consultar módulo',
			'secondary_cta_label' => 'Centro legal',
			'secondary_cta_url'   => '/legal/cumbre',
			'modules'             => array(
				array( 'Comunicaciones comerciales', 'El cliente es responsable por contar con consentimiento, base legal o legitimación suficiente para cargar contactos, enviar comunicaciones, llamar, escribir por WhatsApp, SMS, email o newsletters.' ),
				array( 'Registro No Llame', 'Las acciones telefónicas, SMS o mensajería instantánea con fines publicitarios deben considerar normativa aplicable, Registro Nacional No Llame y excepciones legales.' ),
				array( 'CRM y Marketing', 'Cumbre CRM y Marketing ayudan a ordenar leads, oportunidades y campañas, pero no autorizan spam ni uso de bases sin legitimación.' ),
				array( 'Contenido del cliente', 'El cliente responde por veracidad, legalidad y autorización de productos, precios, imágenes, marcas, publicaciones, promociones, claims, bases de contacto y condiciones comerciales.' ),
				array( 'Módulos operativos', 'Stock, Resto, Panadería, Depósito, eCommerce, Mercado Libre, Catálogo y verticales asisten la operación, pero no reemplazan controles físicos, fiscales, laborales, bromatológicos o comerciales.' ),
				array( 'Integraciones', 'APIs, webhooks, conectores y terceros dependen de disponibilidad, permisos, costos externos, tokens, límites y condiciones propias del proveedor.' ),
			),
			'list'                => array(
				'No se puede usar Cumbre para cometer actos ilícitos, fraude, manipulación fiscal, emisión de comprobantes falsos, spam, scraping abusivo, infracción de derechos de terceros o intentos de vulnerar seguridad.',
				'El cliente debe aprobar claims, ofertas, precios, promociones, imágenes, bases de contactos y condiciones comerciales antes de campañas o publicaciones.',
				'Los módulos verticales no reemplazan obligaciones profesionales o regulatorias específicas del rubro, como controles bromatológicos, laborales, fiscales, municipales o contables.',
				'Las integraciones a medida, migraciones complejas, automatizaciones avanzadas o soporte especial no están incluidas salvo pacto expreso en propuesta o anexo.',
				'GEMA/Cumbre podrá suspender o limitar usos que afecten seguridad, reputación, cumplimiento legal, derechos de terceros o integridad del servicio.',
			),
			'links'               => gema_sovereign_get_cumbre_legal_links(),
			'faq'                 => array(
				array( 'Puedo cargar cualquier base de contactos?', 'No. El cliente debe tener autorización, consentimiento o base legal suficiente para cargar y contactar personas.' ),
				array( 'Cumbre Marketing habilita spam?', 'No. Las herramientas de marketing deben usarse respetando privacidad, baja de comunicaciones y normativa aplicable.' ),
				array( 'Los módulos reemplazan controles profesionales?', 'No. Asisten la operación, pero no reemplazan obligaciones fiscales, bromatológicas, laborales, contables, municipales o regulatorias.' ),
			),
		),
		'login'                         => array(
			'title'       => 'Acceso a clientes',
			'kicker'      => 'Portal en preparación',
			'description' => 'Espacio reservado para futuros accesos a clientes, demos, soporte o paneles relacionados con productos GEMA.',
			'modules'     => array(
				array( 'Demos', 'Accesos controlados para pruebas y validaciones.' ),
				array( 'Soporte', 'Futuro punto de ingreso para clientes y seguimiento.' ),
				array( 'Productos', 'Acceso a herramientas, documentación o paneles cuando estén disponibles.' ),
			),
			'list'        => array(
				'Página placeholder para evitar enlaces rotos.',
				'No habilita autenticación real todavía.',
				'Debe conectarse al portal final cuando se defina la arquitectura.',
			),
			'faq'         => array(
				array( 'Ya puedo iniciar sesión?', 'Todavía no. Este acceso queda preparado para una etapa posterior.' ),
				array( 'Para qué servirá?', 'Para demos, soporte, clientes o herramientas internas según roadmap.' ),
			),
		),
	);

	return array_merge( $pages, gema_sovereign_get_comparison_page_definitions(), gema_sovereign_get_cumbre_subdomain_page_definitions(), gema_sovereign_get_payment_page_definitions() );
}


function gema_sovereign_make_comparison_page( string $title, string $kicker, string $description, string $competitors, string $cumbre, string $differentiator, array $keywords, array $faq = array() ): array {
	return array(
		'title'       => $title,
		'kicker'      => $kicker,
		'description' => $description,
		'modules'     => array(
			array( 'La competencia', $competitors ),
			array( 'Impronta ERP Cumbre', $cumbre ),
			array( 'Diferencial SEO y operativo', $differentiator ),
		),
		'list'        => array(
			'Keywords objetivo: ' . implode( ', ', $keywords ) . '.',
			'Comparativa orientada a decisión: arquitectura, adopción, costos, automatización e integración con la realidad argentina.',
			'Página preparada para captar búsquedas transaccionales y long-tail sobre alternativas ERP, CRM, módulos y verticales.',
		),
		'faq'         => $faq ?: array(
			array( 'ERP Cumbre reemplaza directamente a la competencia?', 'Depende del proceso, datos, integraciones, equipo y madurez operativa. La comparación ayuda a decidir si conviene migrar, integrar o avanzar por etapas.' ),
			array( 'La implementación es igual para todas las empresas?', 'No. ERP Cumbre se implementa por diagnóstico, módulos, verticales y prioridades reales de negocio.' ),
		),
	);
}

function gema_sovereign_get_comparison_links(): array {
	return array(
		array( 'Cumbre CRM vs HubSpot y Salesforce', '/competencia/cumbre-crm-vs-hubspot-salesforce', 'CRM agéntico conectado con facturación, ARCA y Brainstore.' ),
		array( 'Cumbre ERP Negocios vs Tango Factura', '/competencia/cumbre-erp-negocios-vs-tango-factura', 'Zero-UI para comercios, monotributistas y billeteras virtuales.' ),
		array( 'Cumbre ERP PyMEs vs Tango, Bejerman y Odoo', '/competencia/cumbre-erp-pymes-vs-tango-bejerman-odoo', 'Administración, bancos, impuestos, reportes y contabilidad opcional para PyMEs.' ),
		array( 'Cumbre Empresas vs ERP corporativo pesado', '/competencia/cumbre-empresas-vs-sap-netsuite', 'Gobernanza, aprobaciones, auditoría y reportes ejecutivos sin sobredimensionar implementación.' ),
		array( 'Cumbre Facturador vs facturadores ARCA', '/competencia/cumbre-facturador-vs-facturadores-arca', 'Backoff inteligente y comprobantes pendientes de CAE.' ),
		array( 'Cumbre Compras vs carga manual', '/competencia/cumbre-compras-vs-carga-manual', 'OCR multimodal con CUIT, IVA, IIBB y asiento contable.' ),
		array( 'Cumbre Ventas vs POS tradicional', '/competencia/cumbre-ventas-vs-pos-tradicional', 'Precios bimonetarios sincronizados con dólar oficial, MEP o tarjeta.' ),
		array( 'Cumbre Personal vs liquidadores legacy', '/competencia/cumbre-personal-vs-liquidadores-sueldos', 'Libro de Sueldos Digital ARCA y productividad conectada al CRM.' ),
		array( 'Cumbre Tesorería vs conciliación manual', '/competencia/cumbre-tesoreria-vs-conciliacion-manual', 'Ruteador financiero asíncrono con human-in-the-loop.' ),
		array( 'Cumbre Marketing vs email masivo', '/competencia/cumbre-marketing-vs-email-masivo', 'Audiencias sincronizadas con comportamiento transaccional real.' ),
		array( 'Cumbre Automatizaciones vs Zapier y Make', '/competencia/cumbre-automatizaciones-vs-zapier-make', 'Cloud Functions y scripts FDE a costo controlado.' ),
		array( 'Cumbre Web vs hosting compartido', '/competencia/cumbre-web-vs-hosting-compartido', 'CMS headless en Cloud Run conectado al CRM.' ),
		array( 'Cumbre eCommerce y Mercado Libre vs sync legacy', '/competencia/cumbre-ecommerce-mercado-libre-vs-sync-legacy', 'Stock sub-segundo para reputación y quiebres de stock.' ),
		array( 'Cumbre Kioscos vs actualización manual', '/competencia/cumbre-kioscos-vs-software-kioscos', 'Actualizador inteligente de góndolas con PDF e IA.' ),
		array( 'Cumbre Resto vs comandas tradicionales', '/competencia/cumbre-resto-vs-software-restaurantes', 'WhatsApp Zero-UI para comandas por voz.' ),
		array( 'Cumbre Depósitos WMS vs lectores manuales', '/competencia/cumbre-depositos-wms-vs-lectores-manuales', 'Visión computacional para racks, QR y etiquetas.' ),
		array( 'Cumbre Constructoras vs ERP de obra tradicional', '/competencia/cumbre-constructoras-vs-software-construccion', 'Índice CAC, certificados y factura de readecuación.' ),
		array( 'Cumbre Agro vs gestión agro manual', '/competencia/cumbre-agro-vs-software-agro', 'CPe, LPG, patentes y kilos extraídos desde una foto.' ),
		array( 'Cumbre Mercados vs software retail tradicional', '/competencia/cumbre-mercados-vs-software-retail', 'Precios dinámicos por merma y vencimiento.' ),
	);
}


function gema_sovereign_get_cumbre_module_link_catalog(): array {
	return array(
		'crm'            => array( 'Cumbre CRM', '/cumbre-crm', 'Tronco comercial para leads, clientes, presupuestos, cobros, catálogo, stock, facturación y postventa.' ),
		'negocios'       => array( 'Cumbre ERP Negocios', '/cumbre-erp-negocios', 'Paquete económico para comercios de mostrador: POS, caja, stock, precios, reposición diaria y submódulos verticales.' ),
		'pymes'          => array( 'Cumbre ERP PyMEs', '/erp-cumbre/#cumbre-erp-pymes', 'Para PyMEs de Comercio y Servicios con administración, ventas, compras, bancos, impuestos, reportes y contabilidad opcional.' ),
		'empresas'       => array( 'Cumbre Empresas', '/erp-cumbre/#cumbre-empresas', 'Para empresas argentinas en crecimiento que necesitan gobernanza, aprobaciones, auditoría, reportes ejecutivos e implementación asistida.' ),
		'facturador'     => array( 'Cumbre Facturador ARCA', '/erp-cumbre/cumbre-facturador-arca', 'Facturación electrónica controlada con backend seguro, worker ARCA, CAE, errores trazables e implementación asistida.' ),
		'cobros'         => array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'Links de pago, QR, transferencias, tarjetas, billeteras, webhooks, conciliación y 0% comisión Cumbre por transacción.' ),
		'legal'          => array( 'Cumbre Legal', '/erp-cumbre/cumbre-legal', 'Gestión documental legal con borradores asistidos por IA, fuentes normativas verificables, checklist, vencimientos y revisión profesional.' ),
		'stock'          => array( 'Cumbre Stock', '/erp-cumbre/cumbre-stock', 'Inventario agéntico con depósitos, documentos inteligentes, cotejo contra Catálogo, aprobación humana, alertas y trazabilidad.' ),
		'compras'        => array( 'Cumbre Compras', '/erp-cumbre/cumbre-compras', 'Proveedores, solicitudes de reposición, órdenes de compra, recepción de mercadería, comparador y trazabilidad conectada a Stock, Catálogo, ventas y eCommerce.' ),
		'tutoriales_api' => array( 'Tutoriales API Cumbre', '/erp-cumbre/tutoriales-api-cumbre', 'Guías paso a paso, checklists y validaciones para conectar APIs externas sin exponer claves sensibles en claro.' ),
		'catalogo'       => array( 'Cumbre Catálogo', '/cumbre/catalogo', 'Fuente única de productos, servicios, precios, fiscalidad, stock, proveedores e ingesta multimodal.' ),
		'contabilidad'   => array( 'Cumbre Contabilidad', '/erp-cumbre/cumbre-contabilidad', 'Plan de cuentas, asientos, cierres, libros, reportes y exportación para contador con revisión humana y trazabilidad.' ),
		'impuestos'      => array( 'Cumbre Impuestos', '/erp-cumbre/cumbre-impuestos', 'IVA, IIBB, retenciones, percepciones, posiciones fiscales, vencimientos y reportes exportables para revisar con el contador.' ),
		'reportes_bi'    => array( 'Cumbre Reportes BI', '/erp-cumbre/cumbre-reportes-bi', 'Dashboards, KPIs, alertas ejecutivas, reportes gerenciales y snapshots trazables conectados a toda la operación.' ),
		'planificacion'  => array( 'Cumbre Planificación y Proyecciones', '/erp-cumbre/cumbre-planificacion', 'Presupuestos internos, escenarios, forecast de caja, real vs plan y proyecciones conectadas a datos reales del ERP.' ),
		'activos_fijos'  => array( 'Cumbre Activos Fijos', '/erp-cumbre/cumbre-activos-fijos', 'Bienes de uso, ubicaciones, responsables, amortizaciones, mantenimientos, bajas y trazabilidad contable.' ),
		'whatsapp_hub'   => array( 'Cumbre WhatsApp Hub', '/erp-cumbre/cumbre-whatsapp-hub', 'Agente Cerebro WhatsApp con Meta Cloud API por cliente, opt-in, plantillas aprobadas, webhooks seguros y trazabilidad.' ),
		'ventas'         => array( 'Cumbre Ventas', '/erp-cumbre/cumbre-ventas', 'POS, ventas digitales, descuentos, cobros, stock y facturación vinculada.' ),
		'personal'       => array( 'Cumbre Personal', '/erp-cumbre/cumbre-personal', 'Legajos digitales, asistencia, ausencias, novedades, documentos laborales y costos de personal.' ),
		'tesoreria'      => array( 'Cumbre Tesorería', '/erp-cumbre/cumbre-tesoreria', 'Bancos argentinos, billeteras, caja, movimientos, conciliación asistida, pagos a proveedores, cashflow, alertas y trazabilidad financiera.' ),
		'marketing'      => array( 'Cumbre Marketing', '/erp-cumbre/cumbre-marketing', 'Segmentos, campañas, audiencias, WhatsApp, email, anuncios y atribución conectada al ERP.' ),
		'automatizacion' => array( 'Cumbre Automatizaciones', '/erp-cumbre/cumbre-automatizaciones', 'Workflows internos con triggers, condiciones, acciones, webhooks, auditoría e idempotencia.' ),
		'web'            => array( 'Cumbre Web', '/erp-cumbre/cumbre-web', 'Landings, CMS/headless, formularios, SEO, eventos y captación conectada al CRM.' ),
		'ecommerce'      => array( 'Cumbre eCommerce y Mercado Libre', '/competencia/cumbre-ecommerce-mercado-libre-vs-sync-legacy', 'Para stock sub-segundo entre ecommerce, depósito físico y publicaciones de Mercado Libre.' ),
		'kioscos'        => array( 'Cumbre Kioscos', '/erp-cumbre/cumbre-kioscos', 'Precios, stock, listas de proveedores, caja rápida y reposición para kioscos y minimercados.' ),
		'resto'          => array( 'Cumbre Resto', '/erp-cumbre/cumbre-resto', 'Comandas, caja, stock gastronómico, WhatsApp, delivery y reportes conectados.' ),
		'wms'            => array( 'Cumbre Depósitos WMS', '/erp-cumbre/cumbre-depositos-wms', 'Ubicaciones, picking, conteos cíclicos, códigos e inventario visual para depósitos.' ),
		'constructoras'  => array( 'Cumbre Constructoras', '/erp-cumbre/cumbre-constructoras', 'Obras, certificados, redeterminaciones, compras, pagos y facturación conectadas.' ),
		'agro'           => array( 'Cumbre Agro', '/erp-cumbre/cumbre-agro', 'Cartas de porte, acopio, compras, kilos, patentes y trazabilidad agro.' ),
		'mercados'       => array( 'Cumbre Mercados', '/erp-cumbre/cumbre-mercados', 'Góndolas, vencimientos, merma, promociones, stock y eCommerce conectados.' ),
	);
}

function gema_sovereign_get_recommended_cumbre_modules( string $path ): array {
	$catalog = gema_sovereign_get_cumbre_module_link_catalog();
	$path    = trim( $path, '/' );

	$groups = array(
		'gema-negocios'       => array( 'negocios', 'stock', 'compras', 'cobros' ),
		'ia-productiva'       => array( 'whatsapp_hub', 'automatizacion', 'compras', 'tesoreria' ),
		'gestion'             => array( 'pymes', 'activos_fijos', 'planificacion', 'reportes_bi' ),
		'empresas'            => array( 'empresas', 'activos_fijos', 'planificacion', 'contabilidad' ),
		'marketing'           => array( 'marketing', 'whatsapp_hub', 'crm', 'automatizacion' ),
		'automatizacion'      => array( 'whatsapp_hub', 'automatizacion', 'compras', 'tesoreria' ),
		'integraciones'       => array( 'whatsapp_hub', 'tutoriales_api', 'ecommerce', 'stock' ),
		'tecnologia'          => array( 'tutoriales_api', 'whatsapp_hub', 'empresas', 'automatizacion' ),
		'erp/precios'         => array( 'negocios', 'activos_fijos', 'planificacion', 'cobros' ),
		'erp/funciones/facturacion-electronica' => array( 'facturador', 'impuestos', 'pymes', 'tesoreria' ),
		'ia/automatizacion-whatsapp' => array( 'whatsapp_hub', 'crm', 'automatizacion', 'marketing' ),
		'blog'                => array( 'crm', 'reportes_bi', 'activos_fijos', 'pymes' ),
		'competencia'         => array( 'crm', 'pymes', 'activos_fijos', 'planificacion' ),
		'nosotros'            => array( 'pymes', 'empresas', 'automatizacion', 'web' ),
		'contacto'            => array( 'crm', 'negocios', 'cobros', 'legal' ),
	);

	if ( 0 === strpos( $path, 'competencia/' ) ) {
		return array_values( array_slice( $catalog, 0, 4 ) );
	}

	$keys = $groups[ $path ] ?? array( 'crm', 'activos_fijos', 'whatsapp_hub', 'reportes_bi' );
	return array_values( array_filter( array_map( static fn( $key ) => $catalog[ $key ] ?? null, $keys ) ) );
}

function gema_sovereign_build_cumbre_module_links_section( string $path ): string {
	$modules = gema_sovereign_get_recommended_cumbre_modules( $path );
	if ( empty( $modules ) ) {
		return '';
	}

	$cards = '';
	foreach ( $modules as $module ) {
		$cards .= sprintf(
			'<article class="cumbre-module-card gema-cumbre-module-link-card"><span>%s</span><h3><a href="%s">%s</a></h3><p>%s</p></article>',
			esc_html( wp_parse_url( $module[1], PHP_URL_PATH ) ?: $module[1] ),
			esc_url( $module[1] ),
			esc_html( $module[0] ),
			esc_html( $module[2] )
		);
	}

	return sprintf(
		'<!-- wp:group {"tagName":"section","className":"gema-content-section gema-cumbre-module-links-section","layout":{"type":"constrained"}} --><section class="wp-block-group gema-content-section gema-cumbre-module-links-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Interlink Cumbre</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Módulos Cumbre recomendados para esta página</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"gema-section-copy"} --><p class="gema-section-copy">Según el caso, esta solución puede conectarse con estos módulos del ecosistema ERP Cumbre.</p><!-- /wp:paragraph --><!-- wp:html --><div class="cumbre-module-grid cumbre-module-grid--dense gema-cumbre-module-link-grid">%s</div><!-- /wp:html --></section><!-- /wp:group -->',
		$cards
	);
}



function gema_sovereign_get_cumbre_subdomain_catalog(): array {
	return array(
		'crm'            => array( 'Cumbre CRM', 'crm', 'CRM agéntico', 'Captura, calificación, Vista Hoy, presupuestos, caja y seguimiento comercial conectado con facturación, WhatsApp y clientes.' ),
		'negocios'       => array( 'Cumbre ERP Negocios', 'negocios', 'POS y gestión minorista', 'Paquete económico para vender, controlar caja, stock, precios, reposición diaria y sumar submódulos cuando el comercio crece.' ),
		'pymes'          => array( 'Cumbre ERP PyMEs', 'pymes', 'Gestión pyme', 'ERP para pymes con stock, compras, ventas, cuentas corrientes, IIBB y reportes.' ),
		'empresas'       => array( 'Cumbre Empresas', 'empresas', 'Gobernanza administrativa', 'Escala Cumbre ERP PyMEs con más usuarios, sucursales, aprobaciones, auditoría, reportes ejecutivos e implementación asistida.' ),
		'facturador'     => array( 'Cumbre Facturador ARCA', 'facturador', 'ARCA y comprobantes', 'Facturación electrónica controlada con carga manual, agente IA, CAE, errores trazables, backend seguro e implementación asistida.' ),
		'cobros'         => array( 'Cumbre Cobros', 'cobros', 'Cobros argentinos', 'Links de pago, QR, transferencias, tarjetas, billeteras, webhooks, conciliación y 0% comisión Cumbre; las pasarelas externas pueden cobrar sus aranceles.' ),
		'legal'          => array( 'Cumbre Legal', 'legal', 'Gestión documental legal', 'Borradores asistidos por IA, fuentes normativas verificables, checklist, vencimientos, trazabilidad y revisión profesional.' ),
		'stock'          => array( 'Cumbre Stock', 'stock', 'Inventario agéntico', 'Control de stock por depósito, documentos inteligentes, cotejo con Catálogo, aprobación humana, alertas y trazabilidad.' ),
		'compras'        => array( 'Cumbre Compras', 'compras', 'Compras y reposición', 'Proveedores, solicitudes de reposición, órdenes de compra, recepción de mercadería y trazabilidad conectada a Stock, Catálogo, ventas, eCommerce y Mercado Libre.' ),
		'tutoriales-api' => array( 'Tutoriales API Cumbre', 'tutoriales-api', 'Conexiones guiadas', 'Guías paso a paso, checklists, permisos, credenciales seguras, webhooks y validaciones para integrar plataformas externas.' ),
		'catalogo'       => array( 'Cumbre Catálogo', 'catalogo', 'Datos maestros', 'Productos, servicios, combos, insumos, precios bimonetarios, fiscalidad, stock, proveedores e ingesta multimodal.' ),
		'contabilidad'   => array( 'Cumbre Contabilidad', 'contabilidad', 'Contabilidad formal', 'Plan de cuentas, asientos, cierres, libros, IVA, reportes, centros de costo y exportación para trabajar mejor con el contador.' ),
		'impuestos'      => array( 'Cumbre Impuestos', 'impuestos', 'Control fiscal', 'IVA, IIBB por jurisdicción, retenciones, percepciones, saldos, vencimientos y reportes fiscales revisables.' ),
		'reportes-bi'    => array( 'Cumbre Reportes BI', 'reportes-bi', 'Dashboards y KPIs', 'Tableros gerenciales, KPIs, alertas ejecutivas, exportaciones y series históricas conectadas a módulos fuente.' ),
		'planificacion'  => array( 'Cumbre Planificación', 'planificacion', 'Presupuestos y escenarios', 'Presupuestos internos, escenarios, cashflow proyectado, forecast, real vs plan y desvíos trazables.' ),
		'activos-fijos'  => array( 'Cumbre Activos Fijos', 'activos-fijos', 'Bienes de uso', 'Altas, ubicaciones, responsables, amortización lineal, mantenimiento, bajas y trazabilidad contable de activos patrimoniales.' ),
		'whatsapp-hub'   => array( 'Cumbre WhatsApp Hub', 'whatsapp-hub', 'Comunicación inteligente', 'WhatsApp Business Cloud API por cliente, Agente Cerebro, opt-in, plantillas Meta, webhooks y trazabilidad conversacional.' ),
		'asistente'      => array( 'Asistente Guiado Cumbre', 'asistente', 'Onboarding contextual', 'Ayuda por módulo con checklist, nivel principiante/intermedio/avanzado, progreso persistente y próxima mejor acción.' ),
		'panel'          => array( 'Panel de Control Cumbre', 'panel', 'Autogestión SaaS', 'Módulos activos, trial de 14 días, alertas, billing, Gema Pagos y estado operativo de la empresa.' ),
		'ventas'         => array( 'Cumbre Ventas', 'ventas', 'POS bimonetario', 'Punto de venta físico y digital con listas en ARS/USD y protección de margen.' ),
		'personal'       => array( 'Cumbre Personal', 'personal', 'RRHH y sueldos', 'Legajos, ausentismo, recibos, Libro de Sueldos Digital y productividad conectada.' ),
		'tesoreria'      => array( 'Cumbre Tesorería', 'tesoreria', 'Bancos y cashflow', 'Cuentas bancarias, billeteras virtuales, caja, movimientos, conciliación asistida, pagos a proveedores y cashflow con seguridad y confirmación humana.' ),
		'marketing'      => array( 'Cumbre Marketing', 'marketing', 'Audiencias y campañas', 'CRM sincronizado con Google Ads, Meta Ads, email, WhatsApp y comportamiento transaccional.' ),
		'automatizaciones' => array( 'Cumbre Automatizaciones', 'automatizaciones', 'Flujos internos', 'Automatizaciones tipo Zapier interno, scripts FDE y Cloud Functions para procesos reales.' ),
		'web'            => array( 'Cumbre Web', 'web', 'CMS y SEO', 'Sitios, blogs y landings conectadas al CRM, SEO/GEO y captación de oportunidades.' ),
		'ecommerce'      => array( 'Cumbre eCommerce', 'ecommerce', 'Venta online', 'Tienda, carrito, pedidos, stock, publicaciones, Mercado Libre, cobros y facturación.' ),
		'kioscos'        => array( 'Cumbre Kioscos', 'kioscos', 'Retail de alta rotación', 'Precios, góndolas, listas de proveedores, márgenes e inflación diaria.' ),
		'resto'          => array( 'Cumbre Resto', 'resto', 'Gastronomía Zero-UI', 'Comandas por voz, WhatsApp, cocina, caja, mesas, pre-factura y cobros.' ),
		'wms'            => array( 'Cumbre Depósitos WMS', 'wms', 'Stock y trazabilidad', 'Depósitos, racks, QR, códigos, visión computacional, vencimientos y lotes.' ),
		'constructoras'  => array( 'Cumbre Constructoras', 'constructoras', 'Obras e Índice CAC', 'Certificados, redeterminación, compras, proveedores, costos, avances y facturación.' ),
		'agro'           => array( 'Cumbre Agro', 'agro', 'CPe y LPG', 'Cartas de porte, liquidaciones primarias, kilos, patentes, acopios y trazabilidad rural.' ),
		'mercados'       => array( 'Cumbre Mercados', 'mercados', 'Retail alimentos', 'Mermas, vencimientos, precios dinámicos, góndola digital, caja y ecommerce.' ),
	);
}

function gema_sovereign_get_cumbre_facturador_page_definition(): array {
	return array(
		'title'               => 'Cumbre Facturador ARCA: facturación electrónica controlada para empresas argentinas',
		'seo_title'           => 'Cumbre Facturador ARCA | Portal ARCA vs facturador vs ERP integrado',
		'meta_description'    => 'Facturación electrónica ARCA integrada al ERP: portal ARCA vs facturador simple, CAE, errores trazables, cobros y producción asistida.',
		'keywords'            => 'facturación electrónica ARCA, portal ARCA vs facturador, facturador para empresas argentinas, ERP con facturación electrónica, facturas A B C, notas de crédito y débito, remitos y recibos digitales, software de facturación para PyMEs, CAE, errores trazables',
		'kicker'              => 'Facturación electrónica ARCA · Backend seguro · CAE · Errores trazables',
		'description'         => 'Cumbre Facturador ARCA es el módulo fiscal y documental de ERP Cumbre para emitir y administrar facturas, notas, remitos, recibos y documentación comercial/fiscal argentina con carga manual, agente IA, validación fiscal, worker ARCA e implementación asistida.',
		'primary_cta_label'   => 'Solicitar implementación asistida',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Probar 14 días',
		'secondary_cta_url'   => '/erp/precios',
		'modules_title'       => 'Qué resuelve Cumbre Facturador ARCA',
		'list_title'          => 'Planes, límites y add-ons del módulo fiscal',
		'links_title'         => 'Integración del Facturador con ERP Cumbre',
		'faq_title'           => 'Preguntas frecuentes sobre facturación electrónica ARCA controlada',
		'bottom_cta_title'    => 'Activá facturación ARCA con implementación asistida',
		'bottom_cta_copy'     => 'Revisamos CUIT, punto de venta, régimen, certificados, permisos, volumen documental, usuarios y conexión con CRM, Cobros, PyMEs o Empresas antes de habilitar producción.',
		'modules'             => array(
			array( 'Documentación fiscal y comercial', 'Administra facturas A, B y C, notas de crédito, notas de débito, remitos, recibos y documentos comerciales desde el ecosistema ERP Cumbre.' ),
			array( 'No es emisión directa insegura', 'No se vende como botón automático desde frontend. La emisión productiva se controla con backend seguro, validación fiscal, job ARCA, worker protegido, CAE o error trazable.' ),
			array( 'Carga manual e ingesta IA', 'Según el plan, el usuario puede cargar manualmente, usar ingesta por agente IA y editar completamente antes de emitir.' ),
			array( 'Errores trazables', 'Cada rechazo, error técnico o respuesta fiscal queda registrado para corrección, auditoría y soporte.' ),
			array( 'Integración transversal', 'Conecta con Cumbre CRM, ERP Negocios, ERP PyMEs, Cumbre Empresas, Catálogo, Cobros y Tesorería por implementación asistida.' ),
			array( 'Producción asistida', 'La puesta en producción requiere revisar permisos, certificados, CUIT, punto de venta, régimen, datos y responsabilidad fiscal del contribuyente.' ),
		),
		'list'                => array(
			'Facturador Base: USD 19/mes lista, USD 15/mes lanzamiento. Carga manual, 3 modelos disponibles, 300 facturas/mes, 100 documentos comerciales/mes, 1 punto de venta, 1 CUIT y sin IA.',
			'Facturador Standard: USD 49/mes lista, USD 39/mes lanzamiento. Carga manual + ingesta por agente IA, 5 modelos disponibles, 2.500 facturas/mes, 300 notas fiscales/mes, 1.000 documentos comerciales/mes, 3 puntos de venta y 1 CUIT. Plan recomendado.',
			'Facturador Full: USD 149/mes lista, USD 119/mes lanzamiento. Control total por agente IA, ingreso manual + ingesta IA, edición total antes de emitir, toda documentación, 25.000 facturas/mes, 2.500 notas fiscales/mes, 25.000 documentos comerciales/mes, 10 puntos de venta y 3 CUITs.',
			'Modelos disponibles significa tipos de comprobante o documento que el usuario puede elegir. No representa la cantidad de facturas que puede emitir; la cantidad se controla por límites mensuales.',
			'Add-ons: punto de venta adicional USD 9 / USD 7 lanzamiento; CUIT adicional asistido USD 39 / USD 31; remitos y recibos avanzados USD 19 / USD 15; documentación comercial avanzada USD 29 / USD 23; mayor volumen mensual USD 49 / USD 39; implementación ARCA productiva asistida USD 299 / USD 239; soporte fiscal prioritario USD 99 / USD 79.',
			'Flujo de emisión: origen, validación, job ARCA, worker seguro, CAE o error, auditoría.',
			'Trial de 14 días con datos preservados al pasar a plan pago.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_facturador_decision_section(),
		'links'               => array(
			array( 'ERP Cumbre', '/erp-cumbre/#cumbre-facturador-arca', 'Ver el módulo dentro de la landing principal y compararlo con PyMEs, Empresas y Cobros.' ),
			array( 'Cumbre CRM', '/cumbre-crm', 'Conectar oportunidades, presupuestos, clientes y emisión documental.' ),
			array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'Cruzar cobros, pagos, facturas y conciliación operativa.' ),
			array( 'Cumbre ERP Negocios', '/cumbre-erp-negocios', 'Sumar facturación controlada a comercios que venden por mostrador.' ),
			array( 'Cumbre Empresas', '/erp-cumbre/#cumbre-empresas', 'Escalar gobernanza, aprobaciones, auditoría y múltiples responsables.' ),
			array( 'Condiciones legales pagos, ARCA e IA', '/legal/cumbre-pagos-arca-ia', 'Consultar límites legales y responsabilidades del cliente y de GEMA/Cumbre.' ),
		),
		'faq'                 => array(
			array( 'Qué es Cumbre Facturador ARCA?', 'Es el módulo fiscal y documental de ERP Cumbre para facturas, notas, remitos, recibos y documentación comercial/fiscal argentina con carga manual, agente IA, CAE, errores trazables e implementación asistida.' ),
			array( 'Emite automáticamente desde el frontend?', 'No. El mensaje correcto es emisión controlada: backend seguro, validación fiscal, job ARCA, worker seguro, CAE o error trazable e implementación asistida para producción.' ),
			array( 'Qué significa modelos disponibles?', 'Significa los tipos de comprobante o documento que el usuario puede elegir. No representa la cantidad de facturas que puede emitir; la cantidad se controla por límites mensuales.' ),
			array( 'Qué plan conviene para empezar?', 'Standard es el plan recomendado porque combina carga manual, ingesta por agente IA, facturas A/B/C, notas de crédito y débito, más volumen y 3 puntos de venta.' ),
			array( 'La IA puede emitir sin revisar?', 'No debería operar sin control. La IA ayuda a ingresar, interpretar y preparar información, pero el usuario conserva edición y validación antes de emitir.' ),
			array( 'Qué se necesita para producción ARCA?', 'Se requiere implementación asistida: revisar CUIT, punto de venta, régimen, certificados, permisos, pruebas, datos, usuarios y responsabilidad fiscal del contribuyente.' ),
			array( 'Tiene prueba gratis?', 'Sí. La prueba dura 14 días y los datos se conservan al pasar a plan pago.' ),
		),
	);
}

function gema_sovereign_build_cumbre_facturador_decision_section(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-facturador-decision-section","layout":{"type":"constrained"}} --><section id="portal-arca-vs-facturador-vs-erp" class="wp-block-group gema-content-section cumbre-facturador-decision-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Comparativa ARCA</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Portal ARCA, facturador simple o facturación integrada al ERP</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"gema-section-copy"} --><p class="gema-section-copy">El estudio competitivo mostró que el usuario busca entender qué conviene antes de emitir: usar el portal oficial, contratar un facturador simple o conectar la facturación con ventas, cobros, stock y administración.</p><!-- /wp:paragraph --><!-- wp:html --><div class="cumbre-limit-table" role="table" aria-label="Comparativa portal ARCA vs facturador simple vs ERP integrado"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Opción</span><span>Conviene cuando</span><span>Límite habitual</span><span>Rol de Cumbre</span></div><div class="cumbre-limit-row" role="row"><span>Portal ARCA</span><span>Se emite poco volumen y se acepta carga manual</span><span>No conecta naturalmente ventas, stock, cobros y reportes</span><span>Puede convivir como inicio o contingencia</span></div><div class="cumbre-limit-row" role="row"><span>Facturador simple</span><span>La prioridad es emitir comprobantes básicos</span><span>Puede quedar separado de CRM, caja, compras y tesorería</span><span>Se compara por costo, volumen y trazabilidad</span></div><div class="cumbre-limit-row" role="row"><span>ERP integrado</span><span>La factura nace de una venta, cobro, remito o proceso administrativo</span><span>Requiere implementación fiscal asistida</span><span>Cumbre conecta documento, cliente, cobro, auditoría y error trazable</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>No prometer activación inmediata</strong><span>Producción requiere CUIT, certificado, punto de venta, régimen, permisos, pruebas y responsabilidad fiscal del contribuyente.</span></article><article class="cumbre-proof-card"><strong>CAE o error trazable</strong><span>El objetivo no es ocultar fallas: cada rechazo o error debe quedar registrado para soporte y corrección.</span></article><article class="cumbre-proof-card"><strong>Flujo integrado</strong><span>Cuando hay operación real, la ventaja es conectar presupuesto, cobro, factura, tesorería, contabilidad e impuestos.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_cumbre_legal_page_definition(): array {
	return array(
		'title'               => 'Cumbre Legal: documentos legales asistidos por IA para empresas',
		'seo_title'           => 'Cumbre Legal | Gestión documental legal asistida por IA para empresas',
		'meta_description'    => 'Cumbre Legal ayuda a crear, organizar y controlar borradores de contratos, acuerdos, NDAs, vencimientos y fuentes normativas verificables con IA y trazabilidad.',
		'keywords'            => 'gestión documental legal con IA, contratos asistidos por IA, borradores legales para empresas, documentos legales para PyMEs, fuentes normativas verificables, checklist legal empresarial, vencimientos legales, contratos con trazabilidad, Cumbre Legal',
		'kicker'              => 'Gestión documental legal · IA asistida · Fuentes verificables · Trazabilidad',
		'description'         => 'Cumbre Legal te ayuda a crear, organizar y controlar documentos legales de tu empresa con IA, datos reales de tu negocio, fuentes normativas verificables y trazabilidad completa.',
		'primary_cta_label'   => 'Solicitar demo',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Ver cómo funciona',
		'secondary_cta_url'   => '/erp-cumbre/cumbre-legal/#como-funciona',
		'modules_title'       => 'Qué podés hacer con Cumbre Legal',
		'list_title'          => 'Planes, control documental y responsabilidad profesional',
		'links_title'         => 'Cómo se conecta Cumbre Legal con ERP Cumbre',
		'faq_title'           => 'Preguntas frecuentes sobre Cumbre Legal',
		'bottom_cta_title'    => 'Prepará documentos legales con IA y revisión profesional',
		'bottom_cta_copy'     => 'Cumbre Legal organiza datos, fuentes, borradores, vencimientos, riesgos y aprobaciones para que tu empresa llegue mejor preparada a la revisión profesional.',
		'modules'             => array(
			array( 'Borradores asistidos por IA', 'Generación guiada de borradores de contratos, acuerdos comerciales, NDAs, convenios de pago, alquileres, documentos laborales y consultas legales frecuentes.' ),
			array( 'Datos reales de la empresa', 'Usa razón social, CUIT, domicilio legal, representante, email legal, logo, color institucional y pie de documento para evitar documentos genéricos.' ),
			array( 'Fuentes normativas verificables', 'Cada documento puede incluir organismo, norma, artículo o sección, jurisdicción, fecha de consulta, URL de verificación, vigencia y resumen de aplicación.' ),
			array( 'Checklist antes de aprobar', 'Detecta datos faltantes, riesgos, campos incompletos, vencimientos, necesidad de revisión profesional y pasos pendientes antes de exportar.' ),
			array( 'Historial y trazabilidad', 'Guarda versiones, aprobaciones, cambios, responsables, fuentes usadas y estado documental para auditoría interna.' ),
			array( 'Almacenamiento configurable', 'Permite guardar documentación en Cumbre Storage, carpeta local del cliente o modo híbrido según política de la empresa.' ),
		),
		'list'                => array(
			'Subtítulo comercial: No reemplaza a un abogado. Te ayuda a trabajar mejor: preparar borradores, detectar datos faltantes, citar la base legal, organizar vencimientos y dejar todo listo para revisión profesional.',
			'Aclaración legal obligatoria: Cumbre Legal no es un estudio jurídico ni reemplaza a un abogado matriculado. Los documentos y respuestas generados son borradores asistidos por IA y no constituyen asesoramiento legal profesional. Todo contrato debe ser revisado y validado por un profesional habilitado antes de ser usado, firmado, enviado o presentado.',
			'Diferenciador contra una caja de texto: no se limita a pedir contratos; trabaja conectado al ERP con datos reales del cliente, plantillas versionadas, fuentes normativas, checklist de datos faltantes, análisis de riesgo, historial documental, aprobaciones, vencimientos y panel de control.',
			'Legal Base: para negocios que necesitan documentos simples, consultas básicas, NDAs, convenios y organización inicial de vencimientos.',
			'Legal Standard: para PyMEs con más volumen documental, plantillas, branding propio, fuentes verificables, checklist y control de aprobaciones.',
			'Legal Full: para empresas con múltiples áreas, aprobaciones, vencimientos, flujos avanzados, almacenamiento híbrido y reportes de riesgo documental.',
			'Integración con CRM, Cobros, Facturador, ERP PyMEs y Cumbre Empresas para usar clientes, razón social, CUIT, facturas, convenios de pago, acuerdos comerciales y aprobaciones.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_legal_custom_sections(),
		'links'               => array(
			array( 'ERP Cumbre', '/erp-cumbre', 'Ver el ecosistema completo y sus módulos administrativos, fiscales y comerciales.' ),
			array( 'Cumbre CRM', '/cumbre-crm', 'Usar clientes, oportunidades, acuerdos y datos comerciales en borradores documentales.' ),
			array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'Conectar convenios de pago, deudas, cobros, evidencias y conciliación.' ),
			array( 'Cumbre Facturador ARCA', '/erp-cumbre/cumbre-facturador-arca', 'Relacionar documentos comerciales con facturación, CAE, errores y auditoría fiscal.' ),
			array( 'Cumbre Empresas', '/erp-cumbre/#cumbre-empresas', 'Sumar aprobaciones, responsables, auditoría y reportes ejecutivos.' ),
			array( 'Centro legal público', '/legal/cumbre', 'Ver condiciones legales públicas de Cumbre y GEMA Digital.' ),
		),
		'faq'                 => array(
			array( 'Qué es Cumbre Legal?', 'Cumbre Legal es un módulo de gestión documental legal asistida por IA para crear, organizar y controlar borradores, fuentes, vencimientos, aprobaciones y trazabilidad dentro del ecosistema ERP Cumbre.' ),
			array( 'Cumbre Legal reemplaza a un abogado?', 'No. Cumbre Legal no es un estudio jurídico ni reemplaza a un abogado matriculado. Los documentos y respuestas son borradores asistidos por IA y deben revisarse con un profesional habilitado cuando corresponda.' ),
			array( 'Los documentos generados tienen validez automática?', 'No se promete validez automática. Cumbre Legal ayuda a preparar borradores, detectar datos faltantes, citar fuentes y ordenar revisión, pero la validez depende del caso, normativa, jurisdicción, partes y revisión profesional.' ),
			array( 'Qué fuentes puede mostrar?', 'Puede registrar organismo, tipo de norma, artículo o sección, jurisdicción, fecha de consulta, URL verificable, estado de vigencia y resumen de aplicación al contrato.' ),
			array( 'Sirve para contratos y NDAs?', 'Sí. Puede preparar borradores de contratos, acuerdos comerciales, NDAs, convenios de pago, alquileres, documentos laborales y consultas legales guiadas.' ),
			array( 'Dónde se guardan los documentos?', 'La configuración puede usar Cumbre Storage, carpeta local del cliente o modo híbrido, según política documental, permisos y alcance de implementación.' ),
		),
	);
}

function gema_sovereign_build_cumbre_legal_custom_sections(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-legal-section","layout":{"type":"constrained"}} --><section id="como-funciona" class="wp-block-group gema-content-section cumbre-legal-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Seguridad y responsabilidad</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">No reemplaza profesionales: prepara mejor el trabajo legal</h2><!-- /wp:heading --><!-- wp:html --><div class="cumbre-legal-disclaimer"><strong>Aclaración legal obligatoria:</strong><span>Cumbre Legal no es un estudio jurídico ni reemplaza a un abogado matriculado. Los documentos y respuestas generados son borradores asistidos por IA y no constituyen asesoramiento legal profesional. Todo contrato debe ser revisado y validado por un profesional habilitado antes de ser usado, firmado, enviado o presentado.</span></div><div class="cumbre-module-grid cumbre-module-grid--dense"><article class="cumbre-module-card"><span>Fuentes verificables</span><h3>Citas normativas auditables</h3><p>Organismo, norma, artículo o sección, jurisdicción, fecha de consulta, URL verificable, vigencia y resumen de aplicación al documento.</p></article><article class="cumbre-module-card"><span>Panel de control</span><h3>Riesgos, vencimientos y pendientes</h3><p>Documentos generados, riesgos detectados, fuentes desactualizadas, vencimientos próximos, chequeos pendientes y documentos que requieren abogado.</p></article><article class="cumbre-module-card"><span>Branding documental</span><h3>Documentos con identidad de empresa</h3><p>Logo, color institucional, razón social, CUIT, domicilio legal, representante, email legal y pie de documento configurable.</p></article></div><div class="cumbre-limit-table" role="table" aria-label="Componentes verificables de Cumbre Legal"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Control</span><span>Base</span><span>Standard</span><span>Full</span></div><div class="cumbre-limit-row" role="row"><span>Borradores asistidos</span><span>Contratos simples</span><span>Plantillas versionadas</span><span>Flujos por área</span></div><div class="cumbre-limit-row" role="row"><span>Fuentes normativas</span><span>Registro básico</span><span>Citas verificables</span><span>Monitoreo de vigencia</span></div><div class="cumbre-limit-row" role="row"><span>Checklist</span><span>Datos faltantes</span><span>Riesgos y revisión</span><span>Aprobaciones avanzadas</span></div><div class="cumbre-limit-row" role="row"><span>Vencimientos</span><span>Alertas simples</span><span>Renovaciones y preavisos</span><span>Panel ejecutivo</span></div><div class="cumbre-limit-row" role="row"><span>Almacenamiento</span><span>Cumbre Storage</span><span>Local o Cumbre</span><span>Híbrido configurable</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>Preparado para revisión profesional</strong><span>El módulo ordena borradores, datos y fuentes para que un profesional habilitado revise con mejor contexto.</span></article><article class="cumbre-proof-card"><strong>Gestión conectada al ERP</strong><span>Usa datos de CRM, Cobros, Facturador, PyMEs y Empresas para evitar recargar información manualmente.</span></article><article class="cumbre-proof-card"><strong>Trazabilidad documental</strong><span>Historial, versiones, aprobaciones, fuentes usadas, responsables y cambios quedan listos para auditoría.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_cumbre_stock_page_definition(): array {
	return array(
		'title'               => 'Cumbre Stock: control de inventario agéntico para negocios y empresas',
		'seo_title'           => 'Cumbre Stock | Inventario agéntico con IA, depósitos y aprobación humana',
		'meta_description'    => 'Cumbre Stock controla inventario por depósito con IA, documentos inteligentes, cotejo contra Catálogo, aprobación humana, alertas y trazabilidad.',
		'keywords'            => 'control de stock con IA, inventario agéntico, software de stock para PyMEs, stock por depósito, remitos con IA, facturas con IA, control de inventario ERP, alertas de bajo stock, stock con WhatsApp, Cumbre Stock',
		'kicker'              => 'Inventario agéntico · Depósitos · Documentos inteligentes · Aprobación humana',
		'description'         => 'Cumbre Stock controla tu inventario con IA, trazabilidad y aprobación humana.',
		'primary_cta_label'   => 'Solicitar demo',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Ver cómo funciona',
		'secondary_cta_url'   => '/erp-cumbre/cumbre-stock/#como-funciona',
		'modules_title'       => 'Qué controla Cumbre Stock',
		'list_title'          => 'Planes, ingesta, alertas y trazabilidad',
		'links_title'         => 'Cómo se conecta Cumbre Stock con ERP Cumbre',
		'faq_title'           => 'Preguntas frecuentes sobre Cumbre Stock',
		'bottom_cta_title'    => 'Controlá inventario con IA sin perder aprobación humana',
		'bottom_cta_copy'     => 'Revisamos depósitos, catálogo, documentos, canales de ingesta, alertas y reglas de aprobación antes de activar movimientos reales.',
		'modules'             => array(
			array( 'Stock por ubicación', 'Controla inventario por depósito, local, tránsito o tercero, con saldos por producto: actual, reservado, disponible y mínimo.' ),
			array( 'Movimientos trazables', 'Registra entradas, salidas, reservas, liberaciones, transferencias internas y ajustes con origen, usuario, fecha, documento e idempotencia.' ),
			array( 'Ingesta agéntica', 'Permite cargar o reenviar PDFs, imágenes, remitos, facturas, CSV, Excel, emails, WhatsApp o escaneos para interpretación asistida.' ),
			array( 'Cotejo contra Catálogo', 'El agente compara productos y cantidades contra Cumbre Catálogo y saldos existentes antes de proponer movimientos.' ),
			array( 'Bandeja de aprobación', 'El agente propone entradas, salidas, reservas o ajustes, pero no impacta inventario sin aprobación humana.' ),
			array( 'Alertas operativas', 'Notifica bajo stock, stock negativo, reservas vencidas, lotes por vencer, conteos pendientes e ingestas pendientes de aprobación.' ),
		),
		'list'                => array(
			'Subtítulo comercial: Cargá remitos, facturas, PDFs, imágenes, planillas, emails o mensajes de WhatsApp. El agente interpreta el documento, coteja los datos contra tu catálogo y tus saldos, te propone el movimiento y vos decidís si aprobarlo antes de impactar stock.',
			'Diferenciador: no es un stock manual tradicional. Cumbre Stock interpreta documentos reales, detecta productos y cantidades, compara con el catálogo, revisa saldos, sugiere acciones y deja todo listo para aprobación humana antes de impactar inventario.',
			'Stock Base: para negocios simples con un depósito o local, movimientos básicos, stock mínimo, alertas de bajo stock y bandeja de aprobación manual.',
			'Stock Standard: para PyMEs con varios depósitos o locales, ingesta agéntica de documentos, reservas, transferencias internas, lotes, vencimientos, conteos cíclicos y notificaciones por panel/email/WhatsApp con opt-in.',
			'Stock Full: para empresas con múltiples áreas, mayor volumen documental, reglas avanzadas de aprobación, reportes, documentación local configurable, trazabilidad ampliada e integración asistida con canales ecommerce o Mercado Libre.',
			'Guardrails: el agente no impacta stock sin aprobación humana, no duplica productos porque usa Cumbre Catálogo como fuente única y no reemplaza Compras ni Facturador ARCA; se integra con esos módulos según alcance.',
			'Integración con Cumbre Catálogo, ERP Negocios, ERP PyMEs, Cumbre Empresas, Facturador ARCA y futuros canales eCommerce/Mercado Libre.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_stock_custom_sections(),
		'links'               => array(
			array( 'ERP Cumbre', '/erp-cumbre', 'Ver el ecosistema completo y cómo Stock se conecta con ventas, compras, cobros y facturación.' ),
			array( 'Cumbre Catálogo', '/cumbre/catalogo', 'Usar productos, servicios, SKUs, precios, IVA y proveedores como fuente única.' ),
			array( 'Cumbre ERP Negocios', '/cumbre-erp-negocios', 'Conectar mostrador, caja, reposición diaria y stock de comercios minoristas.' ),
			array( 'Cumbre Facturador ARCA', '/erp-cumbre/cumbre-facturador-arca', 'Relacionar comprobantes, remitos, facturas y documentación comercial con movimientos trazables.' ),
			array( 'Cumbre Empresas', '/erp-cumbre/#cumbre-empresas', 'Sumar aprobaciones, auditoría, responsables y reportes ejecutivos.' ),
			array( 'Cumbre eCommerce', '/competencia/cumbre-ecommerce-mercado-libre-vs-sync-legacy', 'Preparar stock para futuros canales online y Mercado Libre.' ),
		),
		'faq'                 => array(
			array( 'Qué es Cumbre Stock?', 'Cumbre Stock es el módulo de inventario agéntico de ERP Cumbre. Controla stock por depósito, interpreta documentos con IA, coteja contra Catálogo, propone movimientos y pide aprobación humana antes de impactar inventario.' ),
			array( 'La IA modifica el stock automáticamente?', 'No. El agente puede interpretar documentos, detectar productos, revisar saldos y proponer movimientos, pero no impacta stock sin aprobación humana.' ),
			array( 'Qué documentos puede interpretar?', 'Puede trabajar con PDFs, imágenes, remitos, facturas, planillas CSV o Excel, emails, mensajes de WhatsApp y escaneos, según plan y configuración.' ),
			array( 'Cómo evita duplicar productos?', 'Usa Cumbre Catálogo como fuente única. El agente busca coincidencias y propone acciones cuando detecta productos dudosos, pero la aprobación queda en manos del usuario.' ),
			array( 'Qué alertas incluye?', 'Bajo stock, stock negativo, reservas vencidas, lotes por vencer, conteos pendientes e ingestas pendientes de aprobación, con notificaciones por panel, email o WhatsApp con opt-in.' ),
			array( 'Reemplaza Compras o Facturador ARCA?', 'No. Cumbre Stock controla inventario y se integra con Compras, Facturador ARCA, ERP Negocios, PyMEs, Empresas y canales futuros cuando corresponde.' ),
		),
	);
}

function gema_sovereign_build_cumbre_stock_custom_sections(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-stock-section","layout":{"type":"constrained"}} --><section id="como-funciona" class="wp-block-group gema-content-section cumbre-stock-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Ingesta inteligente</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Documentos reales, cotejo contra Catálogo y aprobación antes de impactar stock</h2><!-- /wp:heading --><!-- wp:html --><div class="cumbre-stock-flow"><article><span>01</span><h3>Cargar o reenviar</h3><p>PDFs, imágenes, remitos, facturas, planillas, emails, WhatsApp o escaneos.</p></article><article><span>02</span><h3>Interpretar con IA</h3><p>El agente lee el documento, detecta productos, cantidades, fechas, depósitos y posibles inconsistencias.</p></article><article><span>03</span><h3>Cotejar contra Catálogo</h3><p>Busca coincidencias en Cumbre Catálogo y revisa saldos actuales, reservados, disponibles y mínimos.</p></article><article><span>04</span><h3>Proponer movimiento</h3><p>Sugiere entradas, salidas, reservas, liberaciones, transferencias o ajustes con trazabilidad.</p></article><article><span>05</span><h3>Aprobar humanamente</h3><p>El usuario revisa la bandeja y decide antes de modificar inventario.</p></article></div><div class="cumbre-limit-table" role="table" aria-label="Planes de Cumbre Stock"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Capacidad</span><span>Base</span><span>Standard</span><span>Full</span></div><div class="cumbre-limit-row" role="row"><span>Ubicaciones</span><span>1 depósito/local</span><span>Varios depósitos</span><span>Multiárea asistido</span></div><div class="cumbre-limit-row" role="row"><span>Ingesta IA</span><span>Documentos básicos</span><span>PDF, imagen, Excel, email y WhatsApp</span><span>Mayor volumen y reglas</span></div><div class="cumbre-limit-row" role="row"><span>Aprobaciones</span><span>Bandeja manual</span><span>Roles y estados</span><span>Flujos avanzados</span></div><div class="cumbre-limit-row" role="row"><span>Alertas</span><span>Bajo stock</span><span>Panel, email y WhatsApp con opt-in</span><span>Panel ejecutivo</span></div><div class="cumbre-limit-row" role="row"><span>Control avanzado</span><span>Stock mínimo</span><span>Lotes, vencimientos y conteos</span><span>Reportes y documentación local</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>Aprobación humana</strong><span>El agente no impacta stock sin confirmación. Propone movimientos y deja evidencia para revisar antes de aprobar.</span></article><article class="cumbre-proof-card"><strong>Catálogo como fuente única</strong><span>No duplica productos: coteja contra Cumbre Catálogo y marca coincidencias dudosas para revisión.</span></article><article class="cumbre-proof-card"><strong>Trazabilidad completa</strong><span>Cada movimiento conserva origen, documento, usuario, fecha, estado e idempotencia para evitar dobles impactos.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_cumbre_compras_page_definition(): array {
	return array(
		'title'               => 'Cumbre Compras',
		'seo_title'           => 'Cumbre Compras | Proveedores, reposición y órdenes de compra para PyMEs',
		'meta_description'    => 'Cumbre Compras ayuda a comprar mejor, reponer a tiempo, evitar quiebres de stock y gestionar proveedores, solicitudes, órdenes y recepciones conectadas a Stock y Catálogo.',
		'keywords'            => 'software de compras para PyMEs, gestión de proveedores, órdenes de compra, solicitudes de reposición, reposición de stock, compras conectadas a inventario, compras Mercado Libre, compras ecommerce, Cumbre Compras',
		'kicker'              => 'Compras · Proveedores · Reposición · Órdenes · Recepción conectada a Stock',
		'description'         => 'Comprá mejor, reponé a tiempo y evitá quedarte sin stock. Cumbre Compras convierte alertas de stock, ventas altas, demanda de Mercado Libre y eCommerce en solicitudes de reposición, órdenes de compra y recepciones conectadas al inventario.',
		'primary_cta_label'   => 'Organizar mis compras',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Ver cómo funciona',
		'secondary_cta_url'   => '/erp-cumbre/cumbre-compras/#como-funciona',
		'modules_title'       => 'Todo el circuito de compras conectado',
		'list_title'          => 'Control, aprobación y trazabilidad en compras',
		'links_title'         => 'Cómo se conecta Cumbre Compras con ERP Cumbre',
		'faq_title'           => 'Preguntas frecuentes sobre Cumbre Compras',
		'bottom_cta_title'    => 'Menos quiebres de stock, mejores decisiones de compra',
		'bottom_cta_copy'     => 'Cumbre Compras conecta ventas, stock, proveedores y administración para que cada compra tenga sentido operativo, margen y trazabilidad.',
		'modules'             => array(
			array( 'Comprar tarde, mal o sin control impacta directo en tus ventas', 'Cuando el stock se corta, se pierden ventas. Cuando se compra sin comparar proveedores, se pierde margen. Y cuando las compras no quedan conectadas al inventario, la administración se vuelve confusa.' ),
			array( 'De la señal de stock a la orden de compra', 'Cumbre puede generar solicitudes a partir de stock mínimo, ventas de alta rotación, demanda en Mercado Libre, ventas de eCommerce o sugerencias del agente IA.' ),
			array( 'Proveedores', 'Datos comerciales, contacto, plazo de entrega, condiciones de pago, calificación y estado activo para decidir mejor antes de comprar.' ),
			array( 'Solicitudes de reposición', 'Generadas desde stock, ventas, Mercado Libre, eCommerce o agente IA, siempre listas para revisión y aprobación.' ),
			array( 'Comparador de proveedores', 'Compara costo, plazo, calificación y conveniencia para ayudar a elegir proveedor sin perder margen.' ),
			array( 'Órdenes y recepción', 'Las órdenes de compra se aprueban antes de enviarse al proveedor. La recepción puede ser parcial o total y deja observaciones si hay diferencias.' ),
			array( 'Impacto en Stock', 'Solo una recepción aprobada puede generar movimientos de inventario, evitando impactos automáticos o duplicados.' ),
			array( 'Integración PyMEs', 'Conecta documentos administrativos, facturas de compra, cuentas corrientes, Catálogo, Stock, ventas, eCommerce y Mercado Libre.' ),
		),
		'list'                => array(
			'Mensaje principal: Comprá mejor, reponé a tiempo y evitá quedarte sin stock.',
			'Flujo operativo: señal de reposición, solicitud de compra, aprobación, orden de compra, envío al proveedor, recepción y actualización de Stock.',
			'Poder agéntico: el agente analiza productos con bajo stock, ventas aceleradas, demanda en marketplaces y rotación por canal. Sugiere cantidades de reposición y proveedores posibles.',
			'Aclaración obligatoria: ninguna compra sugerida por IA se envía automáticamente sin revisión y aprobación humana.',
			'Seguridad: no se crean productos paralelos porque todo usa Cumbre Catálogo; no se emiten órdenes sin aprobación cuando la política lo requiere; no se impacta stock sin recepción aprobada.',
			'Recepciones observadas o rechazadas requieren comentarios. Los proveedores activos deben tener contacto y condiciones de pago.',
			'Cada solicitud, orden y recepción queda trazada con idempotencia para evitar duplicados y permitir auditoría.',
			'Ideal para comercios, PyMEs y empresas con stock físico, comercios minoristas, distribuidores, tiendas online, vendedores de Mercado Libre, empresas de servicios con insumos y PyMEs que necesitan ordenar proveedores y compras.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_compras_custom_sections(),
		'links'               => array(
			array( 'ERP Cumbre', '/erp-cumbre', 'Ver el ecosistema completo y cómo Compras se conecta con ventas, stock, cobros y administración.' ),
			array( 'Cumbre Stock', '/erp-cumbre/cumbre-stock', 'Transformar stock mínimo, bajo stock, saldos y recepciones aprobadas en decisiones de compra trazables.' ),
			array( 'Cumbre Catálogo', '/cumbre/catalogo', 'Usar productos, SKUs, proveedores, costos, precios e IVA como fuente única para comprar sin duplicar datos.' ),
			array( 'Cumbre ERP PyMEs', '/erp-cumbre/#cumbre-erp-pymes', 'Conectar compras con administración, facturas de compra, cuentas corrientes y reportes.' ),
			array( 'Tutoriales API Cumbre', '/erp-cumbre/tutoriales-api-cumbre', 'Preparar conexiones con Mercado Libre, eCommerce, WooCommerce y plataformas externas.' ),
			array( 'Cumbre Empresas', '/erp-cumbre/#cumbre-empresas', 'Sumar aprobaciones, políticas internas, responsables y auditoría ejecutiva.' ),
		),
		'faq'                 => array(
			array( 'Qué es Cumbre Compras?', 'Cumbre Compras es el módulo de ERP Cumbre para gestionar proveedores, solicitudes de reposición, órdenes de compra y recepción de mercadería conectada a Stock, Catálogo, ventas, eCommerce y Mercado Libre.' ),
			array( 'La IA puede enviar compras automáticamente?', 'No. El agente puede sugerir cantidades, proveedores y solicitudes, pero ninguna compra sugerida por IA se envía automáticamente sin revisión y aprobación humana.' ),
			array( 'Cómo evita quiebres de stock?', 'Convierte señales como stock mínimo, bajo stock, ventas aceleradas, demanda en Mercado Libre o eCommerce y rotación por canal en solicitudes de reposición revisables.' ),
			array( 'Impacta el inventario al crear una orden?', 'No. El stock solo se actualiza cuando existe una recepción aprobada. Las recepciones parciales, observadas o rechazadas conservan comentarios y trazabilidad.' ),
			array( 'Se integra con proveedores?', 'Sí. Permite gestionar datos comerciales, contacto, plazos de entrega, condiciones de pago, calificación y comparador de conveniencia por proveedor.' ),
			array( 'Para quién es útil?', 'Para comercios, PyMEs, distribuidores, tiendas online, vendedores de Mercado Libre, empresas con insumos y negocios que necesitan ordenar reposición, proveedores y compras.' ),
		),
	);
}

function gema_sovereign_build_cumbre_compras_custom_sections(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-compras-section","layout":{"type":"constrained"}} --><section id="como-funciona" class="wp-block-group gema-content-section cumbre-compras-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Reposición inteligente</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">De la señal operativa a una compra aprobada y trazable</h2><!-- /wp:heading --><!-- wp:html --><div class="cumbre-compras-flow"><article><span>01</span><h3>Señal de reposición</h3><p>Stock mínimo, ventas altas, demanda en Mercado Libre, eCommerce o sugerencia del agente IA.</p></article><article><span>02</span><h3>Solicitud de compra</h3><p>El sistema propone productos, cantidades, urgencia, proveedor posible y motivo operativo.</p></article><article><span>03</span><h3>Aprobación</h3><p>El usuario revisa, compara proveedores y aprueba según política de compra, margen y necesidad real.</p></article><article><span>04</span><h3>Orden de compra</h3><p>La solicitud aprobada se convierte en orden trazable antes de enviarse al proveedor.</p></article><article><span>05</span><h3>Recepción y Stock</h3><p>La recepción parcial o total actualiza inventario solo cuando queda aprobada.</p></article></div><div class="cumbre-limit-table" role="table" aria-label="Controles de Cumbre Compras"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Control</span><span>Objetivo</span><span>Guardrail</span><span>Conexión</span></div><div class="cumbre-limit-row" role="row"><span>Proveedores</span><span>Costo, plazo y condiciones</span><span>Contacto y pago requeridos</span><span>Catálogo y PyMEs</span></div><div class="cumbre-limit-row" role="row"><span>Reposición</span><span>Evitar quiebres</span><span>Revisión humana</span><span>Stock y ventas</span></div><div class="cumbre-limit-row" role="row"><span>Órdenes</span><span>Comprar con aprobación</span><span>No se envían solas</span><span>Proveedores</span></div><div class="cumbre-limit-row" role="row"><span>Recepción</span><span>Confirmar mercadería</span><span>Parcial, observada o rechazada</span><span>Stock</span></div><div class="cumbre-limit-row" role="row"><span>IA</span><span>Sugerir cantidades</span><span>Nunca compra sin aprobación</span><span>Mercado Libre y eCommerce</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>Catálogo como fuente única</strong><span>No se crean productos paralelos: cada compra trabaja contra productos, SKUs, costos y proveedores registrados.</span></article><article class="cumbre-proof-card"><strong>Aprobación antes de comprar</strong><span>Las solicitudes sugeridas por IA o por stock no se envían al proveedor sin revisión humana y política aprobatoria.</span></article><article class="cumbre-proof-card"><strong>Recepción antes de impactar stock</strong><span>El inventario se actualiza solo con recepción aprobada, conservando observaciones, diferencias e idempotencia.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_cumbre_tesoreria_page_definition(): array {
	return array(
		'title'               => 'Cumbre Tesorería',
		'seo_title'           => 'Cumbre Tesorería | Bancos, caja, conciliación y cashflow para PyMEs',
		'meta_description'    => 'Cumbre Tesorería centraliza bancos, billeteras y caja, importa movimientos, concilia con confirmación humana, programa pagos a proveedores y proyecta cashflow.',
		'keywords'            => 'tesorería para PyMEs, software de tesorería Argentina, conciliación bancaria asistida, cashflow para empresas, control de caja y bancos, billeteras virtuales empresas, pagos a proveedores, ERP financiero Argentina, Cumbre Tesorería',
		'kicker'              => 'Tesorería · Bancos argentinos · Caja · Conciliación · Cashflow',
		'description'         => 'Controlá el dinero real de tu empresa, conciliá movimientos y anticipá tu cashflow.',
		'primary_cta_label'   => 'Activar Tesorería',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Ver cómo funciona',
		'secondary_cta_url'   => '/erp-cumbre/cumbre-tesoreria/#como-funciona',
		'modules_title'       => 'Tesorería conectada al ERP',
		'list_title'          => 'Seguridad, bancos argentinos y control humano',
		'links_title'         => 'Cómo se conecta Cumbre Tesorería con ERP Cumbre',
		'faq_title'           => 'Preguntas frecuentes sobre Cumbre Tesorería',
		'bottom_cta_title'    => 'Control financiero real, conciliación asistida y cashflow visible',
		'bottom_cta_copy'     => 'Cumbre Tesorería conecta bancos, billeteras, caja, cobros, compras, pagos y documentos para que una PyME vea su dinero real con trazabilidad y aprobación humana.',
		'modules'             => array(
			array( 'Bancos dispersos y caja separada', 'Muchas empresas miran bancos, billeteras, Mercado Pago, transferencias y caja en pantallas distintas. Eso vuelve lenta la conciliación y deja puntos ciegos en el cashflow.' ),
			array( 'Tesorería conectada al ERP', 'Cumbre Tesorería centraliza cuentas bancarias, billeteras virtuales, caja, movimientos, conciliaciones, pagos a proveedores y proyección de cashflow dentro del ecosistema ERP Cumbre.' ),
			array( 'Preparado para bancos argentinos', 'El módulo contempla la realidad local: bancos argentinos, billeteras virtuales, agregadores, transferencias, extractos CSV/XLSX/OFX/PDF y conexiones por API cuando el banco o proveedor lo permite.' ),
			array( 'Importación de movimientos', 'Puede importar movimientos por API bancaria, agregadores o extractos CSV, XLSX, OFX y PDF según alcance, banco, permisos y calidad del archivo.' ),
			array( 'Conciliación asistida', 'Cruza movimientos contra cobros, ventas, compras, pagos, facturas, documentos administrativos y referencias. La conciliación crítica requiere confirmación humana.' ),
			array( 'Pagos a proveedores', 'Permite programar pagos, ordenar vencimientos, preparar autorizaciones y exigir aprobación antes de ejecutar o marcar un pago como realizado.' ),
			array( 'Cashflow proyectado', 'Combina ingresos y egresos previstos para estimar flujo de caja. El cashflow se comunica como proyección operativa, no como garantía financiera.' ),
			array( 'Alertas financieras', 'Genera alertas de saldo, pagos próximos, movimientos observados, conciliaciones pendientes, vencimientos y diferencias que requieren revisión.' ),
		),
		'list'                => array(
			'Mensaje principal: Controlá el dinero real de tu empresa, conciliá movimientos y anticipá tu cashflow.',
			'Flujo operativo: banco o extracto, movimiento, conciliación, aprobación y cashflow actualizado.',
			'Seguridad bancaria: Cumbre Tesorería no pide passwords de home banking y no debe guardar credenciales sensibles en claro.',
			'Credenciales protegidas: las conexiones se modelan con referencias seguras tipo Secret Manager o mecanismo equivalente, según infraestructura y proveedor.',
			'Conciliación con control: el sistema asiste, sugiere cruces y detecta diferencias, pero no realiza ajustes irreversibles sin confirmación humana.',
			'Pagos con aprobación: los pagos a proveedores se programan, revisan y aprueban antes de ejecutarse o darse por realizados.',
			'Planes: Tesorería Base para caja, cuentas y extractos; Tesorería Standard para conciliación asistida, pagos y alertas; Tesorería Full para multi-cuenta, reportes, cashflow avanzado e integración asistida.',
			'Guardrails: no se promete conexión bancaria universal inmediata; cada banco, API, agregador o extracto se valida por alcance técnico y comercial.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_tesoreria_custom_sections(),
		'links'               => array(
			array( 'ERP Cumbre', '/erp-cumbre', 'Ver el ecosistema completo y cómo Tesorería conecta dinero, documentos, ventas, compras y reportes.' ),
			array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'Cruzar cobros, links, QR, transferencias, webhooks y conciliación de pagos.' ),
			array( 'Cumbre Compras', '/erp-cumbre/cumbre-compras', 'Programar pagos a proveedores y conectar órdenes, recepciones y cuentas corrientes.' ),
			array( 'Cumbre ERP PyMEs', '/erp-cumbre/#cumbre-erp-pymes', 'Integrar administración, bancos, compras, ventas, impuestos, reportes y contabilidad opcional.' ),
			array( 'Cumbre ERP Negocios', '/cumbre-erp-negocios', 'Conectar caja de comercio, ventas de mostrador, cobros y movimientos diarios.' ),
			array( 'Cumbre Facturador ARCA', '/erp-cumbre/cumbre-facturador-arca', 'Relacionar facturas, documentos comerciales, cobros, pagos y auditoría fiscal.' ),
		),
		'faq'                 => array(
			array( 'Qué es Cumbre Tesorería?', 'Cumbre Tesorería es el módulo financiero de ERP Cumbre para centralizar bancos, billeteras virtuales, caja, movimientos, conciliaciones, pagos a proveedores y cashflow de una empresa.' ),
			array( 'Pide passwords de home banking?', 'No. Cumbre Tesorería no debe pedir passwords de home banking. Las integraciones se trabajan con APIs, agregadores, archivos o credenciales protegidas mediante referencias seguras según el caso.' ),
			array( 'Funciona con bancos argentinos?', 'Está pensado para la realidad de bancos argentinos, billeteras virtuales, Mercado Pago, Nave, MODO, transferencias, agregadores y extractos CSV, XLSX, OFX o PDF, según disponibilidad técnica.' ),
			array( 'La conciliación es automática?', 'Es conciliación asistida. El sistema puede sugerir cruces y detectar diferencias, pero los ajustes críticos requieren confirmación humana.' ),
			array( 'Puede programar pagos a proveedores?', 'Sí. Permite ordenar vencimientos y programar pagos a proveedores con aprobación antes de ejecutar, registrar o marcar un pago como realizado.' ),
			array( 'El cashflow es una garantía financiera?', 'No. El cashflow proyectado es una estimación operativa basada en ingresos y egresos previstos, movimientos, documentos y datos cargados.' ),
		),
	);
}

function gema_sovereign_build_cumbre_tesoreria_custom_sections(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-tesoreria-section","layout":{"type":"constrained"}} --><section id="como-funciona" class="wp-block-group gema-content-section cumbre-tesoreria-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Flujo financiero asistido</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Del banco o extracto al cashflow actualizado</h2><!-- /wp:heading --><!-- wp:html --><div class="cumbre-tesoreria-flow"><article><span>01</span><h3>Banco o extracto</h3><p>API bancaria, agregador, billetera virtual o archivo CSV, XLSX, OFX o PDF según disponibilidad.</p></article><article><span>02</span><h3>Movimiento</h3><p>El sistema normaliza importes, fechas, conceptos, referencias y cuenta de origen sin pedir passwords de home banking.</p></article><article><span>03</span><h3>Conciliación</h3><p>Cruza contra cobros, ventas, compras, pagos, facturas y documentos administrativos con sugerencias asistidas.</p></article><article><span>04</span><h3>Aprobación</h3><p>Los cruces sensibles, pagos a proveedores y diferencias requieren revisión y confirmación humana.</p></article><article><span>05</span><h3>Cashflow actualizado</h3><p>Ingresos y egresos previstos alimentan una proyección operativa con alertas de saldo y vencimientos.</p></article></div><div class="cumbre-limit-table" role="table" aria-label="Planes de Cumbre Tesorería"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Capacidad</span><span>Base</span><span>Standard</span><span>Full</span></div><div class="cumbre-limit-row" role="row"><span>Cuentas y caja</span><span>Cuentas principales</span><span>Bancos, billeteras y caja</span><span>Multi-cuenta y multiárea</span></div><div class="cumbre-limit-row" role="row"><span>Importación</span><span>CSV/XLSX</span><span>CSV/XLSX/OFX/PDF</span><span>API/agregador asistido</span></div><div class="cumbre-limit-row" role="row"><span>Conciliación</span><span>Manual guiada</span><span>Asistida con revisión</span><span>Reglas avanzadas</span></div><div class="cumbre-limit-row" role="row"><span>Pagos a proveedores</span><span>Vencimientos</span><span>Programación y aprobación</span><span>Flujos por responsable</span></div><div class="cumbre-limit-row" role="row"><span>Cashflow</span><span>Vista simple</span><span>Proyección mensual</span><span>Escenarios y alertas</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>Sin passwords de home banking</strong><span>No se piden claves bancarias personales. Las conexiones se resuelven por API, agregador, archivo o credenciales protegidas por referencia segura.</span></article><article class="cumbre-proof-card"><strong>Confirmación humana</strong><span>Conciliaciones observadas, ajustes críticos y pagos a proveedores se revisan antes de impactar estados financieros.</span></article><article class="cumbre-proof-card"><strong>Trazabilidad financiera</strong><span>Cada movimiento conserva cuenta, origen, archivo, referencia, estado, responsable, fecha e idempotencia para auditoría.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_cumbre_contabilidad_page_definition(): array {
	return array(
		'title'               => 'Cumbre Contabilidad',
		'seo_title'           => 'Cumbre Contabilidad | Asientos, cierres y libros conectados al ERP',
		'meta_description'    => 'Cumbre Contabilidad transforma ventas, compras, cobros, pagos y tesorería en asientos, cierres, libros, IVA y reportes trazables listos para revisar con tu contador.',
		'keywords'            => 'contabilidad conectada al ERP, software contable para PyMEs, asientos contables ERP, plan de cuentas, libro diario, libro mayor, IVA compras, IVA ventas, cierre contable mensual, reportes contables, exportación para contador, Cumbre Contabilidad',
		'kicker'              => 'Contabilidad formal · Plan de cuentas · Asientos · Cierres · Libros',
		'description'         => 'Convertí ventas, compras, cobros, pagos y movimientos en contabilidad clara, trazable y lista para revisar con tu contador.',
		'primary_cta_label'   => 'Activar Cumbre Contabilidad',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Ver cómo funciona',
		'secondary_cta_url'   => '/erp-cumbre/cumbre-contabilidad/#como-funciona',
		'modules_title'       => 'Contabilidad conectada al ERP, lista para revisar con tu contador',
		'list_title'          => 'Control formal, revisión profesional y reportes contables',
		'links_title'         => 'Cómo se conecta Cumbre Contabilidad con ERP Cumbre',
		'faq_title'           => 'Preguntas frecuentes sobre Cumbre Contabilidad',
		'bottom_cta_title'    => 'Ordená la contabilidad sin sacar al contador del circuito',
		'bottom_cta_copy'     => 'Cumbre Contabilidad prepara asientos, cierres, libros, IVA y reportes para que la empresa y el contador trabajen sobre datos más completos, trazables y revisables.',
		'modules'             => array(
			array( 'Información contable dispersa', 'Ventas, compras, cobros, pagos, bancos y documentos suelen llegar al contador en planillas, PDFs, mails o sistemas separados, con datos duplicados y cierres lentos.' ),
			array( 'Contabilidad conectada al ERP', 'El módulo toma operaciones reales de Cumbre ERP y las convierte en información contable ordenada: cuentas, asientos, libros, cierres, balances y reportes.' ),
			array( 'No reemplaza al contador', 'Cumbre Contabilidad no promete contabilidad automática sin contador. Prepara, ordena y traza la información para que el contador o responsable revise mejor.' ),
			array( 'Plan de cuentas jerárquico', 'Permite estructurar cuentas contables por nivel, tipo, rubro, centro de costo y reglas de uso según la configuración de la empresa.' ),
			array( 'Asientos desde operaciones', 'Genera asientos borrador desde ventas, compras, cobros, pagos, movimientos de Tesorería, facturación y documentos administrativos.' ),
			array( 'Estados de revisión', 'Los asientos pueden ser borrador, validados o definitivos. La revisión del contador o responsable ocurre antes de convertirlos en definitivos.' ),
			array( 'Cierres y libros', 'Ayuda a revisar pendientes antes del cierre mensual y prepara Libro Diario, Mayor, IVA Compras, IVA Ventas y sumas/saldos.' ),
			array( 'Reportes y exportación', 'Genera reportes de balance, estado de resultados, IVA, centros de costo y exportación para contador o estudio contable.' ),
		),
		'list'                => array(
			'Copy principal: Transformá ventas, compras, cobros, pagos y tesorería en asientos, cierres, libros y reportes trazables.',
			'Diferencia con Tesorería: Tesorería controla el dinero real: bancos, caja, pagos, conciliaciones y cashflow. Contabilidad ordena el registro formal: cuentas contables, asientos, libros, cierres, balances y reportes.',
			'Flujo operativo: documento, cobro, pago o movimiento; asiento borrador; revisión; asiento definitivo; cierre; libros y reportes.',
			'Seguridad y control: revisión humana, trazabilidad, asientos balanceados, cierres sin pendientes críticos y exportación revisable.',
			'Integraciones: Cumbre ERP PyMEs, Facturador ARCA, Cobros, Compras, Tesorería, ERP Negocios y Cumbre Empresas.',
			'Planes: Contabilidad Base para plan de cuentas, asientos borrador y exportación simple; Contabilidad Standard para libros, IVA, cierres y reportes; Contabilidad Full para centros de costo, aprobaciones avanzadas, multiárea y reportes ejecutivos.',
			'Guardrail: no se promete “contabilidad automática sin contador”. El módulo asiste, ordena y prepara información para revisión profesional.',
			'Ideal para PyMEs argentinas, empresas con operación administrativa creciente y estudios contables que necesitan recibir datos más ordenados de sus clientes.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_contabilidad_custom_sections(),
		'links'               => array(
			array( 'ERP Cumbre', '/erp-cumbre', 'Ver el ecosistema completo y cómo Contabilidad se alimenta de ventas, compras, cobros, pagos y documentos.' ),
			array( 'Cumbre Tesorería', '/erp-cumbre/cumbre-tesoreria', 'Diferenciar dinero real, bancos, caja y cashflow del registro contable formal.' ),
			array( 'Cumbre Facturador ARCA', '/erp-cumbre/cumbre-facturador-arca', 'Relacionar facturas, notas, remitos y documentación fiscal con asientos y libros.' ),
			array( 'Cumbre Compras', '/erp-cumbre/cumbre-compras', 'Conectar compras, proveedores, recepciones, facturas de compra y cuentas corrientes.' ),
			array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'Cruzar cobros, referencias, comprobantes y conciliación con la información contable.' ),
			array( 'Cumbre ERP PyMEs', '/erp-cumbre/#cumbre-erp-pymes', 'Activar contabilidad formal como complemento de administración, bancos, ventas, compras e impuestos.' ),
		),
		'faq'                 => array(
			array( 'Qué es Cumbre Contabilidad?', 'Cumbre Contabilidad es el módulo de ERP Cumbre que convierte operaciones del ERP en información contable ordenada: plan de cuentas, asientos, cierres, libros, IVA, reportes y exportación para contador.' ),
			array( 'Reemplaza al contador?', 'No. Cumbre Contabilidad no reemplaza al contador. Prepara y ordena información para que el contador o responsable revise con mejor trazabilidad antes de cierres y reportes formales.' ),
			array( 'Cuál es la diferencia con Tesorería?', 'Tesorería controla dinero real: bancos, caja, pagos, conciliaciones y cashflow. Contabilidad ordena el registro formal: cuentas, asientos, libros, cierres, balances y reportes.' ),
			array( 'Los asientos se generan automáticamente como definitivos?', 'No. Pueden generarse asientos borrador desde operaciones del ERP, pero deben validarse y revisarse antes de quedar definitivos.' ),
			array( 'Qué libros y reportes contempla?', 'Libro Diario, Mayor, IVA Compras, IVA Ventas, sumas/saldos, balance, estado de resultados, IVA, centros de costo y exportaciones para contador según plan y configuración.' ),
			array( 'Sirve para estudios contables?', 'Sí. Puede ayudar a estudios contables que trabajan con PyMEs a recibir operaciones más ordenadas, exportables y trazables, sin quitar la revisión profesional.' ),
		),
	);
}

function gema_sovereign_build_cumbre_contabilidad_custom_sections(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-contabilidad-section","layout":{"type":"constrained"}} --><section id="como-funciona" class="wp-block-group gema-content-section cumbre-contabilidad-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Contabilidad revisable</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">De la operación diaria al asiento revisado y al cierre</h2><!-- /wp:heading --><!-- wp:html --><div class="cumbre-contabilidad-flow"><article><span>01</span><h3>Documento u operación</h3><p>Venta, compra, cobro, pago, movimiento de Tesorería, factura o documento administrativo.</p></article><article><span>02</span><h3>Asiento borrador</h3><p>El sistema propone cuentas, importes, centro de costo y relación con documento de origen.</p></article><article><span>03</span><h3>Revisión</h3><p>El contador o responsable valida criterios, cuentas, imputaciones, IVA y pendientes.</p></article><article><span>04</span><h3>Asiento definitivo</h3><p>Solo después de revisión queda listo para libros, reportes, cierre y exportación.</p></article><article><span>05</span><h3>Cierre y reportes</h3><p>Libro Diario, Mayor, IVA, sumas/saldos, balance, resultados y centros de costo.</p></article></div><div class="cumbre-limit-table" role="table" aria-label="Diferencia entre Cumbre Tesorería y Cumbre Contabilidad"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Área</span><span>Controla</span><span>Resultado</span><span>Revisión</span></div><div class="cumbre-limit-row" role="row"><span>Tesorería</span><span>Dinero real</span><span>Bancos, caja, pagos y cashflow</span><span>Responsable financiero</span></div><div class="cumbre-limit-row" role="row"><span>Contabilidad</span><span>Registro formal</span><span>Asientos, libros, cierres y reportes</span><span>Contador o responsable</span></div><div class="cumbre-limit-row" role="row"><span>Conexión</span><span>Movimientos y documentos</span><span>Datos trazables</span><span>Humana antes del definitivo</span></div></div><div class="cumbre-limit-table" role="table" aria-label="Planes de Cumbre Contabilidad"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Capacidad</span><span>Base</span><span>Standard</span><span>Full</span></div><div class="cumbre-limit-row" role="row"><span>Plan de cuentas</span><span>Jerárquico base</span><span>Reglas por módulo</span><span>Multiárea y centros</span></div><div class="cumbre-limit-row" role="row"><span>Asientos</span><span>Borrador</span><span>Borrador y validado</span><span>Flujos de aprobación</span></div><div class="cumbre-limit-row" role="row"><span>Libros</span><span>Exportación simple</span><span>Diario, Mayor e IVA</span><span>Reportes ampliados</span></div><div class="cumbre-limit-row" role="row"><span>Cierres</span><span>Pendientes básicos</span><span>Cierre mensual</span><span>Control avanzado</span></div><div class="cumbre-limit-row" role="row"><span>Reportes</span><span>Sumas/saldos</span><span>Balance, resultados e IVA</span><span>Centros de costo</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>No reemplaza al contador</strong><span>Prepara asientos, libros y reportes para revisión profesional; no define criterios contables definitivos sin responsable.</span></article><article class="cumbre-proof-card"><strong>Asientos balanceados</strong><span>Los asientos deben conservar cuenta, importe, origen, estado, responsable, fecha y relación con documento.</span></article><article class="cumbre-proof-card"><strong>Cierres sin pendientes críticos</strong><span>Antes del cierre mensual el sistema muestra documentos, asientos y conciliaciones pendientes de revisión.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_cumbre_impuestos_page_definition(): array {
	return array(
		'title'               => 'Cumbre Impuestos',
		'seo_title'           => 'Cumbre Impuestos | IVA, IIBB, retenciones y vencimientos para PyMEs',
		'meta_description'    => 'Cumbre Impuestos ordena IVA, IIBB, retenciones, percepciones, saldos, vencimientos y reportes fiscales trazables para revisar con tu contador.',
		'keywords'            => 'impuestos para PyMEs argentinas, software fiscal para PyMEs, posición IVA, IIBB por jurisdicción, retenciones y percepciones, calendario fiscal, vencimientos fiscales, reportes fiscales para contador, Cumbre Impuestos',
		'kicker'              => 'Impuestos · IVA · IIBB · Retenciones · Vencimientos fiscales',
		'description'         => 'Mantené tus impuestos ordenados, con posiciones fiscales trazables y vencimientos claros para revisar con tu contador.',
		'primary_cta_label'   => 'Activar Cumbre Impuestos',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Ver cómo funciona',
		'secondary_cta_url'   => '/erp-cumbre/cumbre-impuestos/#como-funciona',
		'modules_title'       => 'Impuestos ordenados y conectados a tu ERP',
		'list_title'          => 'Posiciones fiscales, vencimientos y reportes revisables',
		'links_title'         => 'Cómo se conecta Cumbre Impuestos con ERP Cumbre',
		'faq_title'           => 'Preguntas frecuentes sobre Cumbre Impuestos',
		'bottom_cta_title'    => 'Orden fiscal sin prometer presentación automática',
		'bottom_cta_copy'     => 'Cumbre Impuestos consolida información fiscal, vencimientos, saldos y reportes para que la empresa y el contador revisen con trazabilidad antes de decidir, presentar o pagar.',
		'modules'             => array(
			array( 'Impuestos dispersos', 'Muchas PyMEs calculan IVA, IIBB, retenciones, percepciones y vencimientos en planillas, portales, mails o sistemas separados, con datos duplicados y poca trazabilidad.' ),
			array( 'Impuestos conectados al ERP', 'Cumbre Impuestos toma comprobantes, compras, cobros, pagos, movimientos y registros contables para armar posiciones fiscales y reportes revisables.' ),
			array( 'No reemplaza al contador', 'El módulo no presenta impuestos automáticamente ni define criterios fiscales definitivos. Ordena la información para revisión profesional y control interno.' ),
			array( 'Posición IVA por período', 'Consolida IVA compras, IVA ventas, saldos a pagar, saldos a favor y diferencias que requieren revisión antes del cierre fiscal.' ),
			array( 'IIBB por jurisdicción', 'Permite ordenar jurisdicciones, movimientos asociados, percepciones, retenciones y reportes por período según alcance configurado.' ),
			array( 'Retenciones y percepciones', 'Agrupa importes retenidos o percibidos, origen, comprobante, contraparte, período, estado y relación con cobros, compras o pagos.' ),
			array( 'Calendario fiscal', 'Muestra vencimientos fiscales, alertas, períodos formales, pendientes y vínculos con pagos programables desde Tesorería.' ),
			array( 'Reportes exportables', 'Prepara reportes fiscales exportables para contador, administración interna o estudio contable con trazabilidad desde módulos Cumbre.' ),
		),
		'list'                => array(
			'Copy principal: Centralizá IVA, IIBB, retenciones, percepciones y vencimientos con información trazable para revisar con tu contador.',
			'Diferencia entre módulos: Facturador ARCA emite comprobantes fiscales; Contabilidad registra asientos, libros y cierres; Tesorería paga obligaciones y muestra cashflow; Impuestos arma posiciones fiscales, vencimientos y reportes.',
			'Flujo operativo: comprobante, documento, cobro o pago; movimiento fiscal; posición fiscal; revisión contador; vencimiento; pago Tesorería; reporte.',
			'Seguridad y control: revisión profesional, trazabilidad, períodos formales, jurisdicciones IIBB y no presentación automática de impuestos.',
			'Integraciones: Facturador ARCA, ERP PyMEs, Contabilidad, Cobros, Compras, Tesorería, Catálogo y Cumbre Empresas.',
			'Planes: Impuestos Base para IVA, vencimientos y reportes simples; Impuestos Standard para IIBB, retenciones, percepciones y alertas; Impuestos Full para multi-jurisdicción, centros, reportes avanzados e integración asistida.',
			'Alertas: vencimientos próximos, saldos a pagar, saldos a favor, posiciones incompletas, comprobantes pendientes y pagos fiscales por programar.',
			'Guardrail: no se promete presentación automática ni reemplazo del contador. Cumbre asiste, organiza y deja evidencia para revisar.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_impuestos_custom_sections(),
		'links'               => array(
			array( 'ERP Cumbre', '/erp-cumbre', 'Ver el ecosistema completo donde Impuestos consolida información fiscal de operación, contabilidad y tesorería.' ),
			array( 'Cumbre Facturador ARCA', '/erp-cumbre/cumbre-facturador-arca', 'Tomar comprobantes fiscales emitidos, notas y documentación comercial como origen trazable.' ),
			array( 'Cumbre Contabilidad', '/erp-cumbre/cumbre-contabilidad', 'Cruzar asientos, libros, cierres y reportes con posiciones fiscales revisables.' ),
			array( 'Cumbre Tesorería', '/erp-cumbre/cumbre-tesoreria', 'Vincular vencimientos fiscales con pagos programados, caja, bancos y cashflow.' ),
			array( 'Cumbre Compras', '/erp-cumbre/cumbre-compras', 'Conectar facturas de compra, proveedores, percepciones, retenciones y saldos fiscales.' ),
			array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'Relacionar cobros, retenciones, percepciones y referencias de pago con reportes fiscales.' ),
		),
		'faq'                 => array(
			array( 'Qué es Cumbre Impuestos?', 'Cumbre Impuestos es el módulo fiscal de ERP Cumbre para ordenar IVA, IIBB, retenciones, percepciones, saldos, vencimientos y reportes fiscales trazables para revisar con el contador.' ),
			array( 'Presenta impuestos automáticamente?', 'No. Cumbre Impuestos no presenta impuestos automáticamente. Ordena información, detecta vencimientos, consolida movimientos y prepara reportes revisables.' ),
			array( 'Reemplaza al contador?', 'No. El contador o responsable profesional sigue revisando criterios, posiciones, vencimientos, reportes y decisiones fiscales antes de presentar o pagar.' ),
			array( 'En qué se diferencia del Facturador ARCA?', 'Facturador ARCA emite comprobantes fiscales. Impuestos usa esa información, junto con compras, cobros, pagos y contabilidad, para armar posiciones fiscales y vencimientos.' ),
			array( 'Cómo se diferencia de Contabilidad y Tesorería?', 'Contabilidad registra asientos, libros y cierres. Tesorería controla dinero real y pagos. Impuestos organiza posiciones fiscales, vencimientos, saldos y reportes.' ),
			array( 'Qué reportes prepara?', 'Puede preparar posición IVA por período, IIBB por jurisdicción, retenciones, percepciones, saldos a pagar o a favor, vencimientos y exportaciones para contador según plan y configuración.' ),
		),
	);
}

function gema_sovereign_build_cumbre_impuestos_custom_sections(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-impuestos-section","layout":{"type":"constrained"}} --><section id="como-funciona" class="wp-block-group gema-content-section cumbre-impuestos-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Control fiscal revisable</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Del comprobante a la posición fiscal y al vencimiento controlado</h2><!-- /wp:heading --><!-- wp:html --><div class="cumbre-impuestos-flow"><article><span>01</span><h3>Origen fiscal</h3><p>Comprobante, documento, compra, cobro, pago o movimiento conectado al ERP.</p></article><article><span>02</span><h3>Movimiento fiscal</h3><p>El sistema ordena IVA, IIBB, retenciones, percepciones, jurisdicción, período y origen.</p></article><article><span>03</span><h3>Posición fiscal</h3><p>Se consolida el período con saldos a pagar, saldos a favor, diferencias y pendientes.</p></article><article><span>04</span><h3>Revisión contador</h3><p>El contador o responsable revisa criterios, reportes, pendientes y documentación soporte.</p></article><article><span>05</span><h3>Vencimiento y pago</h3><p>El calendario fiscal alerta vencimientos y puede vincular pagos a Cumbre Tesorería.</p></article></div><div class="cumbre-limit-table" role="table" aria-label="Diferencia entre módulos fiscales y financieros Cumbre"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Módulo</span><span>Función</span><span>Resultado</span><span>Guardrail</span></div><div class="cumbre-limit-row" role="row"><span>Facturador ARCA</span><span>Emite comprobantes</span><span>Facturas, notas, CAE o errores</span><span>Producción asistida</span></div><div class="cumbre-limit-row" role="row"><span>Contabilidad</span><span>Registra formalmente</span><span>Asientos, libros y cierres</span><span>Revisión profesional</span></div><div class="cumbre-limit-row" role="row"><span>Tesorería</span><span>Controla dinero</span><span>Pagos, bancos y cashflow</span><span>Confirmación humana</span></div><div class="cumbre-limit-row" role="row"><span>Impuestos</span><span>Arma posiciones</span><span>IVA, IIBB, vencimientos y reportes</span><span>No presenta automáticamente</span></div></div><div class="cumbre-limit-table" role="table" aria-label="Planes de Cumbre Impuestos"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Capacidad</span><span>Base</span><span>Standard</span><span>Full</span></div><div class="cumbre-limit-row" role="row"><span>IVA</span><span>Posición simple</span><span>IVA compras/ventas</span><span>Análisis ampliado</span></div><div class="cumbre-limit-row" role="row"><span>IIBB</span><span>Jurisdicción principal</span><span>Varias jurisdicciones</span><span>Multi-jurisdicción asistida</span></div><div class="cumbre-limit-row" role="row"><span>Retenciones</span><span>Registro básico</span><span>Retenciones y percepciones</span><span>Reglas y alertas avanzadas</span></div><div class="cumbre-limit-row" role="row"><span>Vencimientos</span><span>Calendario fiscal</span><span>Alertas y pendientes</span><span>Integración Tesorería</span></div><div class="cumbre-limit-row" role="row"><span>Reportes</span><span>Exportación simple</span><span>Reportes para contador</span><span>Reportes multiárea</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>No presentación automática</strong><span>El módulo prepara posiciones, saldos y reportes; no presenta impuestos sin validación profesional y alcance definido.</span></article><article class="cumbre-proof-card"><strong>Jurisdicciones y períodos</strong><span>IIBB, IVA, retenciones y percepciones se ordenan por período formal, jurisdicción, origen y estado de revisión.</span></article><article class="cumbre-proof-card"><strong>Vencimientos trazables</strong><span>Cada vencimiento puede conservar origen, saldo, responsable, estado, alerta y relación con pago de Tesorería.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_cumbre_reportes_bi_page_definition(): array {
	return array(
		'title'               => 'Cumbre Reportes BI',
		'seo_title'           => 'Cumbre Reportes BI | Dashboards, KPIs y alertas para PyMEs',
		'meta_description'    => 'Módulo BI de Cumbre ERP para consolidar dashboards, KPIs, alertas y reportes gerenciales conectados a ventas, stock, compras, tesorería, contabilidad e impuestos.',
		'keywords'            => 'dashboards para PyMEs, KPIs empresariales, reportes gerenciales ERP, business intelligence para PyMEs, BI conectado al ERP, alertas ejecutivas, tableros de control, reportes Excel PDF CSV, Cumbre Reportes BI',
		'kicker'              => 'BI gerencial · Dashboards · KPIs · Alertas ejecutivas · Reportes',
		'description'         => 'Cumbre Reportes BI consolida ventas, stock, compras, tesorería, contabilidad, impuestos, eCommerce y Mercado Libre en tableros gerenciales simples, claros y accionables.',
		'primary_cta_label'   => 'Solicitar demo',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Ver módulos conectados',
		'secondary_cta_url'   => '/erp-cumbre/cumbre-reportes-bi/#modulos-conectados',
		'modules_title'       => 'Dashboards, KPIs y alertas para ver tu empresa en tiempo real',
		'list_title'          => 'Decisiones claras sin duplicar información',
		'links_title'         => 'Módulos conectados a Cumbre Reportes BI',
		'faq_title'           => 'Preguntas frecuentes sobre Cumbre Reportes BI',
		'bottom_cta_title'    => 'Tomá decisiones con datos claros, no con intuición',
		'bottom_cta_copy'     => 'Conectá tus módulos de Cumbre ERP y empezá a ver tu empresa desde una vista ejecutiva con indicadores trazables, alertas revisables y reportes exportables.',
		'modules'             => array(
			array( 'Datos repartidos, decisiones tarde', 'Muchas empresas tienen ventas, bancos, stock, impuestos, contabilidad, eCommerce y Mercado Libre en pantallas o planillas separadas, pero no una vista ejecutiva confiable.' ),
			array( 'BI conectado al ERP', 'Cumbre Reportes BI convierte datos del ERP en dashboards, KPIs, alertas ejecutivas, series históricas y reportes gerenciales accionables.' ),
			array( 'No duplica módulos fuente', 'El módulo no reemplaza CRM, Stock, Compras, Tesorería, Contabilidad ni Impuestos. Toma referencias, snapshots e indicadores desde esos módulos.' ),
			array( 'Dashboards ejecutivos', 'Vistas por dirección, administración, gerencia y contador para revisar ventas, margen, caja, stock, impuestos, compras y canales digitales.' ),
			array( 'KPIs por período', 'Indicadores diarios, semanales, mensuales o personalizados, con origen verificable y referencia al módulo fuente.' ),
			array( 'Alertas inteligentes', 'Detecta stock crítico, caída de ventas, vencimientos fiscales, desvíos de caja, cobranzas pendientes o márgenes en baja.' ),
			array( 'Exportaciones trazables', 'Reportes PDF, Excel y CSV con registro de exportación, usuario, período, filtros y origen de datos.' ),
			array( 'Históricos avanzados', 'Preparado para series históricas e integración con Bigtable cuando la empresa necesita mayor volumen, consulta o evolución temporal.' ),
		),
		'list'                => array(
			'Texto clave: Cuando la información está dispersa, las decisiones llegan tarde. Cumbre Reportes BI ordena los indicadores críticos de tu empresa en un solo lugar.',
			'Módulos conectados: CRM, Ventas, Cobros, Stock, Compras, Tesorería, Contabilidad, Impuestos, eCommerce y Mercado Libre.',
			'Funcionalidades: dashboards ejecutivos, KPIs por período, alertas inteligentes, reportes PDF/Excel/CSV, series históricas e indicadores financieros, comerciales, fiscales y operativos.',
			'Casos de uso: ver ventas, margen y caja del mes; detectar stock crítico; controlar impuestos por vencer; revisar cashflow proyectado; comparar canales digitales; preparar reportes para dirección o contador.',
			'Diferenciales: no duplica datos, usa información del ERP en tiempo real, respeta roles y permisos, conserva origen verificable, registra exportaciones y está preparado para IA con control humano.',
			'Alertas críticas: las alertas ejecutivas ayudan a anticipar problemas, pero requieren revisión humana para mantener control, responsabilidad y criterio de negocio.',
			'Planes: Reportes BI Base para dashboards y KPIs operativos; Reportes BI Standard para dashboards multimódulo, alertas IA y exportaciones; Reportes BI Full para BI ejecutivo, multiempresa, históricos avanzados y soporte prioritario.',
			'Confianza: cada indicador conserva referencia al módulo fuente y cada exportación queda registrada.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_reportes_bi_custom_sections(),
		'links'               => array(
			array( 'Cumbre CRM', '/cumbre-crm', 'Tomar leads, pipeline, conversión, oportunidades y actividad comercial como indicadores.' ),
			array( 'Cumbre Stock', '/erp-cumbre/cumbre-stock', 'Detectar stock crítico, movimientos, reservas, saldos por depósito y alertas operativas.' ),
			array( 'Cumbre Compras', '/erp-cumbre/cumbre-compras', 'Analizar proveedores, órdenes, recepciones, reposición y desvíos de compra.' ),
			array( 'Cumbre Tesorería', '/erp-cumbre/cumbre-tesoreria', 'Ver caja, bancos, pagos, conciliación, cashflow y desvíos financieros.' ),
			array( 'Cumbre Contabilidad', '/erp-cumbre/cumbre-contabilidad', 'Relacionar asientos, cierres, libros, centros de costo y reportes contables.' ),
			array( 'Cumbre Impuestos', '/erp-cumbre/cumbre-impuestos', 'Cruzar vencimientos fiscales, posiciones, saldos y alertas impositivas.' ),
			array( 'Tutoriales API Cumbre', '/erp-cumbre/tutoriales-api-cumbre', 'Preparar conexiones con eCommerce, Mercado Libre, Mercado Pago, WooCommerce y otras fuentes externas.' ),
		),
		'faq'                 => array(
			array( 'Qué es Cumbre Reportes BI?', 'Es la capa de Business Intelligence de Cumbre ERP para consolidar dashboards, KPIs, alertas ejecutivas y reportes gerenciales conectados a los módulos fuente.' ),
			array( 'Duplica la información de los módulos?', 'No. Reportes BI no reemplaza ni duplica datos operativos. Usa referencias, snapshots e indicadores desde los módulos fuente para mantener trazabilidad.' ),
			array( 'Qué módulos puede conectar?', 'CRM, Ventas, Cobros, Stock, Compras, Tesorería, Contabilidad, Impuestos, eCommerce, Mercado Libre y otras integraciones según configuración.' ),
			array( 'Las alertas actúan automáticamente?', 'No deberían ejecutar acciones críticas sin revisión. Las alertas ayudan a detectar riesgos, pero las decisiones importantes requieren control humano.' ),
			array( 'Puede exportar reportes?', 'Sí. Puede preparar exportaciones PDF, Excel y CSV con registro de usuario, período, filtros y origen de los datos.' ),
			array( 'Para quién está pensado?', 'Para dueños, gerentes, administradores, contadores y equipos de dirección que necesitan ver indicadores claros sin depender de planillas dispersas.' ),
		),
	);
}

function gema_sovereign_build_cumbre_reportes_bi_custom_sections(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-reportes-bi-section","layout":{"type":"constrained"}} --><section id="como-funciona" class="wp-block-group gema-content-section cumbre-reportes-bi-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">BI conectado al ERP</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">De los módulos fuente a decisiones ejecutivas trazables</h2><!-- /wp:heading --><!-- wp:html --><div class="cumbre-bi-metrics" aria-label="Indicadores principales de Cumbre Reportes BI"><article><span>Ventas mes</span><strong>+18%</strong><p>Comparado contra período anterior con referencia a Ventas, CRM y canales digitales.</p></article><article><span>Margen bruto</span><strong>31%</strong><p>Indicador gerencial con origen en ventas, compras, stock y costos asociados.</p></article><article><span>Cashflow</span><strong>30 días</strong><p>Proyección operativa conectada a Tesorería, cobros, pagos y vencimientos.</p></article><article><span>Alertas</span><strong>7</strong><p>Stock crítico, impuestos próximos a vencer, cobranzas pendientes y desvíos de caja.</p></article></div><div class="cumbre-reportes-bi-flow"><article><span>01</span><h3>Módulo fuente</h3><p>CRM, Ventas, Cobros, Stock, Compras, Tesorería, Contabilidad, Impuestos, eCommerce o Mercado Libre.</p></article><article><span>02</span><h3>Referencia y snapshot</h3><p>El indicador conserva origen verificable, período, filtros, permisos y estado de datos.</p></article><article><span>03</span><h3>KPI y dashboard</h3><p>La información se transforma en tableros ejecutivos, series históricas y comparativas accionables.</p></article><article><span>04</span><h3>Alerta ejecutiva</h3><p>Detecta caída de ventas, stock crítico, vencimientos, desvíos de caja o márgenes en baja.</p></article><article><span>05</span><h3>Reporte exportable</h3><p>PDF, Excel o CSV para dirección, administración, gerencia o contador, con exportación registrada.</p></article></div><div id="modulos-conectados" class="cumbre-payment-method-grid" aria-label="Módulos conectados a Cumbre Reportes BI"><span>CRM</span><span>Ventas</span><span>Cobros</span><span>Stock</span><span>Compras</span><span>Tesorería</span><span>Contabilidad</span><span>Impuestos</span><span>eCommerce</span><span>Mercado Libre</span><span>Bigtable</span><span>IA asistida</span></div><div class="cumbre-limit-table" role="table" aria-label="Planes de Cumbre Reportes BI"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Capacidad</span><span>Base</span><span>Standard</span><span>Full</span></div><div class="cumbre-limit-row" role="row"><span>Dashboards</span><span>Operativos</span><span>Multimódulo</span><span>Ejecutivos multiempresa</span></div><div class="cumbre-limit-row" role="row"><span>KPIs</span><span>Por período</span><span>Comparativos</span><span>Gerenciales avanzados</span></div><div class="cumbre-limit-row" role="row"><span>Alertas</span><span>Reglas simples</span><span>Alertas IA revisables</span><span>Escenarios y prioridad</span></div><div class="cumbre-limit-row" role="row"><span>Exportaciones</span><span>PDF</span><span>PDF, Excel y CSV</span><span>Trazabilidad ampliada</span></div><div class="cumbre-limit-row" role="row"><span>Históricos</span><span>Últimos períodos</span><span>Series históricas</span><span>Bigtable avanzado</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>No duplica datos</strong><span>Los dashboards usan referencias y snapshots desde los módulos fuente para evitar inconsistencias y recarga manual.</span></article><article class="cumbre-proof-card"><strong>Roles y permisos</strong><span>La vista ejecutiva respeta permisos por usuario, área, empresa, módulo y sensibilidad del dato.</span></article><article class="cumbre-proof-card"><strong>Alertas con revisión</strong><span>Las alertas críticas informan riesgos y próximas acciones, pero las decisiones sensibles conservan control humano.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_cumbre_planificacion_page_definition(): array {
	return array(
		'title'               => 'Cumbre Planificación y Proyecciones',
		'seo_title'           => 'Cumbre Planificación | Presupuestos, escenarios y proyecciones para PyMEs',
		'meta_description'    => 'Módulo de Cumbre ERP para planificar ingresos, costos, impuestos y caja con presupuestos internos, escenarios, forecast y comparativo real vs plan.',
		'keywords'            => 'planificación financiera para PyMEs, presupuestos internos, escenarios financieros, cashflow proyectado, forecast de caja, real vs plan, proyecciones empresariales, presupuesto anual empresa, Cumbre Planificación',
		'kicker'              => 'Planificación · Proyecciones · Escenarios · Forecast · Real vs plan',
		'description'         => 'Cumbre Planificación y Proyecciones te permite crear presupuestos internos, simular escenarios, proyectar caja y comparar lo planificado contra lo real, conectado a Tesorería, Contabilidad, Impuestos, Compras, Ventas y BI.',
		'primary_cta_label'   => 'Solicitar demo',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Ver cómo funciona',
		'secondary_cta_url'   => '/erp-cumbre/cumbre-planificacion/#como-funciona',
		'modules_title'       => 'Planificá el futuro de tu empresa con datos reales',
		'list_title'          => 'Presupuestos internos, escenarios y control real vs plan',
		'links_title'         => 'Módulos conectados a Cumbre Planificación',
		'faq_title'           => 'Preguntas frecuentes sobre Cumbre Planificación',
		'bottom_cta_title'    => 'Dejá de planificar a ciegas',
		'bottom_cta_copy'     => 'Conectá tus datos reales de Cumbre ERP y empezá a proyectar el futuro de tu empresa con claridad, escenarios comparables y desvíos trazables.',
		'modules'             => array(
			array( 'Planillas desconectadas', 'Muchas empresas planifican ingresos, compras, impuestos, caja e inversiones en planillas separadas, con datos desactualizados y poca relación con la operación real.' ),
			array( 'Planificación conectada al ERP', 'El módulo toma referencias de Ventas, Compras, Tesorería, Contabilidad, Impuestos, Stock y Reportes BI para armar planes con trazabilidad.' ),
			array( 'No es el presupuesto comercial del CRM', 'Los presupuestos comerciales sirven para vender. Cumbre Planificación sirve para dirigir: proyectar ingresos, egresos, impuestos, inversiones, caja y resultados futuros.' ),
			array( 'Presupuestos internos', 'Permite crear presupuestos mensuales, trimestrales y anuales por rubro: ingresos, costos, gastos, impuestos, inversiones y financieros.' ),
			array( 'Escenarios y estrés', 'Simulá escenarios base, optimista, pesimista y estrés para anticipar caídas de ventas, subas de costos, impuestos o necesidades de caja.' ),
			array( 'Cashflow proyectado', 'Proyecta caja futura conectando cobros, pagos, vencimientos, impuestos, compras, ventas e inversiones previstas.' ),
			array( 'Forecast asistido por IA', 'La IA puede sugerir proyecciones y escenarios, pero las decisiones críticas requieren revisión humana responsable.' ),
			array( 'Real vs plan', 'Compara lo planificado contra lo real, detecta desvíos de gastos, ingresos, caja, impuestos y márgenes con origen verificable.' ),
		),
		'list'                => array(
			'Texto clave: Planificar con información dispersa genera decisiones tardías. Cumbre conecta tus proyecciones con la operación real de tu empresa.',
			'Capa de planificación económica y financiera: presupuesto interno, escenarios, forecast de caja, comparativo real vs plan, revisión humana y datos reales desde módulos fuente.',
			'Funcionalidades: presupuestos internos mensuales, trimestrales y anuales; rubros de ingresos, costos, gastos, impuestos, inversiones y financieros; escenarios base, optimista, pesimista y estrés; cashflow proyectado; forecast IA; desvíos y alertas; exportación de planes y reportes.',
			'Módulos conectados: Ventas, Compras, Tesorería, Contabilidad, Impuestos, Stock y Reportes BI.',
			'Casos de uso: presupuesto anual, caída de ventas, caja de próximos meses, impacto de impuestos y vencimientos, resultado real vs planificado, desvíos de gastos, inversiones o expansión.',
			'IA con control humano: el forecast asistido ayuda a proyectar escenarios, pero las proyecciones generadas por IA requieren revisión humana antes de usarse para decisiones críticas.',
			'Guardrails: no duplica información operativa, todo plan aprobado requiere usuario responsable, escenarios de estrés requieren revisión humana, cashflow proyectado debe cerrar matemáticamente, comparativos usan origen real verificable y desvíos calculados de forma trazable.',
			'Planes: Planificación Base para presupuesto anual y real vs plan básico; Planificación Standard para escenarios, cashflow proyectado y forecast IA; Planificación Full para multiempresa, escenarios de estrés y soporte prioritario.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_planificacion_custom_sections(),
		'links'               => array(
			array( 'Cumbre Tesorería', '/erp-cumbre/cumbre-tesoreria', 'Usar caja, bancos, pagos, cobros y cashflow real como base de proyección.' ),
			array( 'Cumbre Contabilidad', '/erp-cumbre/cumbre-contabilidad', 'Cruzar cierres, resultados, centros de costo y datos contables con el plan interno.' ),
			array( 'Cumbre Impuestos', '/erp-cumbre/cumbre-impuestos', 'Incluir vencimientos, saldos fiscales e impacto impositivo en escenarios futuros.' ),
			array( 'Cumbre Compras', '/erp-cumbre/cumbre-compras', 'Proyectar costos, compras, proveedores, reposición e inversiones operativas.' ),
			array( 'Cumbre Stock', '/erp-cumbre/cumbre-stock', 'Evaluar necesidades de reposición, stock crítico y capital inmovilizado.' ),
			array( 'Cumbre Reportes BI', '/erp-cumbre/cumbre-reportes-bi', 'Comparar KPIs, real vs plan, desvíos y tableros ejecutivos.' ),
		),
		'faq'                 => array(
			array( 'Qué es Cumbre Planificación?', 'Es el módulo de Cumbre ERP para crear presupuestos internos, simular escenarios, proyectar cashflow, estimar impactos y comparar real vs plan con datos conectados a la operación.' ),
			array( 'Es lo mismo que presupuestos del CRM?', 'No. Los presupuestos comerciales del CRM sirven para vender. Cumbre Planificación sirve para dirigir la empresa con escenarios, caja, costos, impuestos, inversiones y resultados futuros.' ),
			array( 'Duplica datos de los módulos?', 'No. Toma referencias de módulos fuente como Ventas, Compras, Tesorería, Contabilidad, Impuestos, Stock y BI para mantener trazabilidad.' ),
			array( 'La IA puede decidir proyecciones críticas?', 'No. La IA puede asistir con forecast y escenarios, pero las proyecciones usadas para decisiones críticas requieren revisión humana responsable.' ),
			array( 'Qué significa real vs plan?', 'Es la comparación entre lo presupuestado o proyectado y los datos reales del ERP, mostrando desvíos, origen verificable y alertas.' ),
			array( 'Qué planes contempla?', 'Base para presupuesto anual y real vs plan básico; Standard para escenarios, cashflow proyectado y forecast IA; Full para multiempresa, estrés y soporte prioritario.' ),
		),
	);
}

function gema_sovereign_build_cumbre_planificacion_custom_sections(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-planificacion-section","layout":{"type":"constrained"}} --><section id="como-funciona" class="wp-block-group gema-content-section cumbre-planificacion-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Planificación estratégica</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Del dato real al escenario, al forecast y al desvío controlado</h2><!-- /wp:heading --><!-- wp:html --><div class="cumbre-bi-metrics cumbre-planificacion-metrics" aria-label="Indicadores de Cumbre Planificación"><article><span>Escenario base</span><strong>+12%</strong><p>Crecimiento proyectado con ventas, compras, impuestos y caja conectados.</p></article><article><span>Cashflow</span><strong>90 días</strong><p>Forecast de caja con vencimientos, cobros, pagos e inversiones previstas.</p></article><article><span>Desvío gastos</span><strong>4,8%</strong><p>Comparativo real vs plan con alertas por rubro y responsable.</p></article><article><span>Estrés</span><strong>-15%</strong><p>Simulación de caída de ventas o aumento de costos con revisión humana.</p></article></div><div class="cumbre-planificacion-flow"><article><span>01</span><h3>Datos reales</h3><p>Ventas, Compras, Tesorería, Contabilidad, Impuestos, Stock y Reportes BI como módulos fuente.</p></article><article><span>02</span><h3>Presupuesto interno</h3><p>Rubros de ingresos, costos, gastos, impuestos, inversiones y financieros por período.</p></article><article><span>03</span><h3>Escenarios</h3><p>Base, optimista, pesimista y estrés para anticipar decisiones de caja, costos e inversión.</p></article><article><span>04</span><h3>Forecast</h3><p>Proyección asistida con IA, siempre revisable antes de decisiones críticas.</p></article><article><span>05</span><h3>Real vs plan</h3><p>Comparativo trazable entre planificación y datos reales, con desvíos y alertas.</p></article></div><div class="cumbre-limit-table" role="table" aria-label="Diferencia entre presupuesto comercial y planificación"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Herramienta</span><span>Objetivo</span><span>Datos</span><span>Uso</span></div><div class="cumbre-limit-row" role="row"><span>Presupuesto CRM</span><span>Vender</span><span>Cliente, productos y propuesta</span><span>Comercial</span></div><div class="cumbre-limit-row" role="row"><span>Planificación</span><span>Dirigir</span><span>Ingresos, costos, caja e impuestos</span><span>Dirección y finanzas</span></div><div class="cumbre-limit-row" role="row"><span>Reportes BI</span><span>Medir</span><span>KPIs y datos reales</span><span>Control ejecutivo</span></div></div><div class="cumbre-limit-table" role="table" aria-label="Planes de Cumbre Planificación"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Capacidad</span><span>Base</span><span>Standard</span><span>Full</span></div><div class="cumbre-limit-row" role="row"><span>Presupuesto</span><span>Anual</span><span>Mensual/trimestral/anual</span><span>Multiempresa</span></div><div class="cumbre-limit-row" role="row"><span>Escenarios</span><span>Base</span><span>Base, optimista y pesimista</span><span>Estrés avanzado</span></div><div class="cumbre-limit-row" role="row"><span>Cashflow</span><span>Vista simple</span><span>Proyección conectada</span><span>Escenarios de caja</span></div><div class="cumbre-limit-row" role="row"><span>IA</span><span>No incluida</span><span>Forecast asistido</span><span>Modelos y revisión prioritaria</span></div><div class="cumbre-limit-row" role="row"><span>Real vs plan</span><span>Básico</span><span>Desvíos y alertas</span><span>Dirección multiárea</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>No duplica operación</strong><span>Los planes toman referencias de módulos fuente para evitar planillas paralelas sin trazabilidad.</span></article><article class="cumbre-proof-card"><strong>Responsable del plan</strong><span>Todo plan aprobado conserva usuario responsable, período, versión, escenario y fecha de revisión.</span></article><article class="cumbre-proof-card"><strong>IA con revisión humana</strong><span>Forecasts y escenarios de estrés ayudan a pensar, pero no sustituyen criterio financiero ni decisiones de dirección.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_cumbre_activos_fijos_page_definition(): array {
	return array(
		'title'               => 'Cumbre Activos Fijos',
		'seo_title'           => 'Cumbre Activos Fijos | Bienes de uso, amortizaciones y trazabilidad contable',
		'meta_description'    => 'Módulo de Cumbre ERP para administrar bienes de uso: altas, ubicaciones, responsables, amortización lineal, mantenimiento, bajas y trazabilidad contable.',
		'keywords'            => 'activos fijos ERP, bienes de uso, control de activos fijos, amortización lineal, mantenimiento de activos, bajas de activos, trazabilidad contable, patrimonio empresa, activos fijos PyMEs, Cumbre Activos Fijos',
		'kicker'              => 'Bienes de uso · Amortización · Mantenimiento · Bajas · Trazabilidad contable',
		'description'         => 'Cumbre Activos Fijos organiza los bienes de uso de tu empresa: computadoras, muebles, maquinaria, rodados, inmuebles y software capitalizable. Conecta compras, contabilidad, tesorería, planificación, reportes BI y WhatsApp Hub para que cada activo tenga historia operativa, financiera y contable.',
		'primary_cta_label'   => 'Solicitar demo',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Ver planes',
		'secondary_cta_url'   => '/erp-cumbre/cumbre-activos-fijos/#planes',
		'modules_title'       => 'Controlá tus activos fijos con trazabilidad contable, mantenimiento planificado y conexión real con tu ERP',
		'list_title'          => 'Bienes de uso ordenados, responsables claros y amortización revisable',
		'links_title'         => 'Módulos conectados a Cumbre Activos Fijos',
		'faq_title'           => 'Preguntas frecuentes sobre Cumbre Activos Fijos',
		'bottom_cta_title'    => 'Ordená tus bienes de uso y conectalos con tu contabilidad',
		'bottom_cta_copy'     => 'Pasá de planillas sueltas a un registro patrimonial conectado con compras, contabilidad, mantenimiento, reportes y aprobación humana para bajas definitivas.',
		'modules'             => array(
			array( 'El problema: activos en planillas', 'Muchas empresas registran computadoras, muebles, maquinaria, rodados, inmuebles o software capitalizable en planillas sin responsable claro, sin mantenimiento y sin conexión contable.' ),
			array( 'Alta desde compras o carga manual', 'El módulo permite registrar activos desde Compras, importación guiada o carga manual, manteniendo origen e idempotencia para no duplicar bienes.' ),
			array( 'Ubicación y responsable', 'Cada activo puede tener sucursal, sector, ubicación física, responsable, estado, categoría y documentación relacionada.' ),
			array( 'Amortización lineal', 'Permite definir valor de origen, vida útil, valor residual y calcular amortización mensual como información revisable para Contabilidad.' ),
			array( 'Mantenimiento planificado', 'Organiza mantenimientos preventivos o correctivos, próximos vencimientos, historial técnico y alertas por WhatsApp Hub cuando corresponda.' ),
			array( 'Bajas controladas', 'Gestiona bajas por venta, rotura, obsolescencia, pérdida, donación o ajuste, con aprobación humana e impacto contable revisable.' ),
			array( 'No es Stock', 'Activos Fijos no crea inventario vendible paralelo. Está pensado para bienes de uso y patrimonio de la empresa, no para mercadería.' ),
			array( 'Trazabilidad contable', 'Cada alta, amortización, mantenimiento y baja conserva origen, responsable, fecha, documento y referencia contable cuando corresponda.' ),
		),
		'list'                => array(
			'Mensaje principal: Controlá tus activos fijos con trazabilidad contable, mantenimiento planificado y conexión real con tu ERP.',
			'Cumbre Activos Fijos administra bienes de uso: computadoras, muebles, maquinaria, rodados, inmuebles y software capitalizable, sin mezclarlos con mercadería de Stock.',
			'Funcionalidades: altas desde Compras, importación o carga manual; ubicación y responsable; vida útil; valor residual; amortización lineal; mantenimiento preventivo/correctivo; bajas por venta, rotura, obsolescencia, pérdida, donación o ajuste; trazabilidad contable.',
			'Diferencial ERP: conecta Compras y PyMEs para altas, Contabilidad para amortizaciones y bajas, Tesorería para pagos vinculados, Reportes BI para indicadores, Planificación para inversiones y reposiciones, WhatsApp Hub para alertas y aprobaciones, e Importador Universal para migrar planillas.',
			'Guardrails: no reemplaza Stock ni inventario vendible; amortizaciones definitivas requieren revisión contable; bajas contabilizadas requieren aprobación humana y asiento contable; toda operación conserva origen e idempotencia.',
			'Casos de uso: equipos asignados a empleados, comercios con muebles/heladeras/maquinaria, rodados con mantenimiento periódico, reportes para contador y orden patrimonial antes de crecer.',
			'Planes: Base hasta 100 activos por USD 19/mes, lanzamiento USD 15; Standard hasta 1000 activos por USD 49/mes, lanzamiento USD 39; Full hasta 10000 activos por USD 129/mes, lanzamiento USD 103.',
			'Add-ons: bloque de 500 activos, mantenimiento avanzado y soporte activos prioritario.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_activos_fijos_custom_sections(),
		'links'               => array(
			array( 'Cumbre Compras', '/erp-cumbre/cumbre-compras', 'Registrar altas de activos desde compras aprobadas, proveedores y documentos de origen.' ),
			array( 'Cumbre Contabilidad', '/erp-cumbre/cumbre-contabilidad', 'Revisar amortizaciones, bajas y asientos contables vinculados.' ),
			array( 'Cumbre Tesorería', '/erp-cumbre/cumbre-tesoreria', 'Relacionar pagos, cuotas, seguros, gastos o desembolsos asociados al activo.' ),
			array( 'Cumbre Reportes BI', '/erp-cumbre/cumbre-reportes-bi', 'Ver valor libro, activos por categoría, mantenimiento pendiente y evolución patrimonial.' ),
			array( 'Cumbre Planificación', '/erp-cumbre/cumbre-planificacion', 'Planificar inversiones, reposiciones, renovación de equipos y impacto futuro.' ),
			array( 'Cumbre WhatsApp Hub', '/erp-cumbre/cumbre-whatsapp-hub', 'Enviar alertas de mantenimiento, aprobaciones de baja y avisos a responsables con opt-in.' ),
			array( 'Cumbre ERP PyMEs', '/erp-cumbre/#cumbre-erp-pymes', 'Conectar activos con administración, documentos, usuarios, sucursales y auditoría.' ),
			array( 'Tutoriales API Cumbre', '/erp-cumbre/tutoriales-api-cumbre', 'Preparar importaciones desde planillas y futuras integraciones de mantenimiento o patrimonio.' ),
		),
		'faq'                 => array(
			array( 'Qué es Cumbre Activos Fijos?', 'Es el módulo de Cumbre ERP para administrar bienes de uso de la empresa: altas, ubicación, responsable, amortización, mantenimiento, bajas y trazabilidad contable.' ),
			array( 'Es lo mismo que Cumbre Stock?', 'No. Stock es para mercadería e inventario vendible. Activos Fijos es para bienes de uso y patrimonio: equipos, muebles, maquinaria, rodados, inmuebles o software capitalizable.' ),
			array( 'Calcula amortizaciones automáticamente?', 'Puede calcular amortización lineal según vida útil y valor residual, pero las amortizaciones definitivas requieren revisión contable responsable.' ),
			array( 'Puede registrar bajas de activos?', 'Sí. Permite bajas por venta, rotura, obsolescencia, pérdida, donación o ajuste, pero las bajas contabilizadas requieren aprobación humana y asiento contable.' ),
			array( 'Se conecta con Compras y Contabilidad?', 'Sí. Compras puede originar altas y Contabilidad puede revisar amortizaciones, bajas, asientos y reportes patrimoniales.' ),
			array( 'Qué planes contempla?', 'Base hasta 100 activos, Standard hasta 1000 activos y Full hasta 10000 activos con auditoría, multi sucursal e integración BI.' ),
		),
	);
}

function gema_sovereign_build_cumbre_activos_fijos_custom_sections(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-activos-section","layout":{"type":"constrained"}} --><section id="planes" class="wp-block-group gema-content-section cumbre-activos-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Patrimonio y trazabilidad</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Dashboard de bienes de uso, valor libro, amortizaciones y mantenimientos</h2><!-- /wp:heading --><!-- wp:html --><div class="cumbre-bi-metrics cumbre-activos-metrics" aria-label="Indicadores de Cumbre Activos Fijos"><article><span>Activos</span><strong>846</strong><p>Bienes de uso categorizados por sucursal, ubicación, responsable y estado.</p></article><article><span>Valor libro</span><strong>USD 218k</strong><p>Vista patrimonial con valor de origen, amortización acumulada y saldo contable.</p></article><article><span>Amortización mes</span><strong>USD 4,9k</strong><p>Cálculo lineal revisable por Contabilidad antes de dejarlo definitivo.</p></article><article><span>Mantenimientos</span><strong>17</strong><p>Próximos preventivos, correctivos y alertas a responsables.</p></article></div><div class="cumbre-activos-flow"><article><span>01</span><h3>Alta del activo</h3><p>Desde Compras, importación guiada o carga manual con documento de origen.</p></article><article><span>02</span><h3>Ubicación y responsable</h3><p>Sucursal, sector, ubicación física, empleado responsable y estado operativo.</p></article><article><span>03</span><h3>Vida útil y residual</h3><p>Valor de origen, vida útil, valor residual, categoría y política contable revisable.</p></article><article><span>04</span><h3>Amortización mensual</h3><p>Cálculo lineal, revisión contable, asiento borrador y trazabilidad de período.</p></article><article><span>05</span><h3>Mantenimiento y baja</h3><p>Alertas, intervenciones, aprobación humana y baja con impacto contable controlado.</p></article></div><div class="cumbre-limit-table" role="table" aria-label="Planes de Cumbre Activos Fijos"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Capacidad</span><span>Base</span><span>Standard</span><span>Full</span></div><div class="cumbre-limit-row" role="row"><span>Precio</span><span>USD 19/mes</span><span>USD 49/mes</span><span>USD 129/mes</span></div><div class="cumbre-limit-row" role="row"><span>Lanzamiento</span><span>USD 15/mes</span><span>USD 39/mes</span><span>USD 103/mes</span></div><div class="cumbre-limit-row" role="row"><span>Activos incluidos</span><span>Hasta 100</span><span>Hasta 1000</span><span>Hasta 10000</span></div><div class="cumbre-limit-row" role="row"><span>Amortización</span><span>Lineal básica</span><span>Lineal + revisión</span><span>Auditoría y BI</span></div><div class="cumbre-limit-row" role="row"><span>Operación</span><span>Alta y responsable</span><span>Mantenimiento y alertas</span><span>Multi sucursal</span></div></div><div class="cumbre-payment-method-grid" aria-label="Add-ons de Cumbre Activos Fijos"><span>Bloque 500 activos</span><span>Mantenimiento avanzado</span><span>Soporte activos prioritario</span><span>Importación asistida</span><span>Auditoría patrimonial</span><span>Alertas WhatsApp</span></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>No es inventario vendible</strong><span>El módulo no reemplaza Stock ni crea mercadería paralela. Administra bienes de uso y patrimonio.</span></article><article class="cumbre-proof-card"><strong>Revisión contable</strong><span>Amortizaciones definitivas y bajas contabilizadas requieren aprobación humana y asiento revisado.</span></article><article class="cumbre-proof-card"><strong>Origen e idempotencia</strong><span>Cada alta, ajuste, mantenimiento o baja conserva referencia al documento, usuario y operación origen.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_make_cumbre_remaining_landing( array $config ): array {
	$features = array_map(
		static fn( $feature ) => array( $feature[0], $feature[1] ),
		$config['features']
	);

	$modules = array_merge(
		array(
			array( 'El problema', $config['problem'] ),
			array( 'La solución Cumbre', $config['value'] ),
		),
		$features
	);

	return array(
		'title'               => $config['title'],
		'seo_title'           => $config['seo_title'],
		'meta_description'    => $config['meta_description'],
		'keywords'            => $config['keywords'],
		'kicker'              => $config['kicker'],
		'description'         => $config['description'],
		'primary_cta_label'   => 'Solicitar demo',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => $config['secondary_cta'] ?? 'Ver planes',
		'secondary_cta_url'   => '/erp-cumbre/' . $config['slug'] . '/#planes',
		'modules_title'       => $config['headline'],
		'list_title'          => 'Funciones, conexiones y controles principales',
		'links_title'         => 'Módulos conectados',
		'faq_title'           => 'Preguntas frecuentes sobre ' . $config['title'],
		'bottom_cta_title'    => $config['cta_title'],
		'bottom_cta_copy'     => $config['cta_copy'],
		'modules'             => $modules,
		'list'                => array_merge(
			array(
				'Mensaje principal: ' . $config['headline'],
				'Subtítulo: ' . $config['description'],
				'No es una base paralela: se apoya en módulos Cumbre existentes y conserva trazabilidad, permisos y auditoría.',
			),
			$config['list']
		),
		'custom_sections'     => gema_sovereign_build_cumbre_remaining_landing_sections( $config ),
		'links'               => $config['links'],
		'faq'                 => array(
			array( 'Qué es ' . $config['title'] . '?', $config['faq_what'] ),
			array( 'Qué módulos conecta?', $config['faq_links'] ),
			array( 'Automatiza acciones críticas?', 'Puede asistir y sugerir acciones, pero las operaciones sensibles respetan permisos, auditoría, idempotencia y aprobación humana cuando corresponde.' ),
			array( 'Reemplaza controles profesionales?', $config['faq_guardrail'] ),
			array( 'Cómo se implementa?', 'Se activa con diagnóstico, configuración asistida y validación de datos, usuarios, permisos e integraciones antes de operar flujos críticos.' ),
		),
	);
}

function gema_sovereign_build_cumbre_remaining_landing_sections( array $config ): string {
	$slug_class = sanitize_html_class( $config['slug'] );
	$html       = '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-remaining-section cumbre-remaining-section--' . esc_attr( $slug_class ) . '","layout":{"type":"constrained"}} --><section id="planes" class="wp-block-group gema-content-section cumbre-remaining-section cumbre-remaining-section--' . esc_attr( $slug_class ) . '"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">' . esc_html( $config['section_kicker'] ) . '</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">' . esc_html( $config['section_title'] ) . '</h2><!-- /wp:heading --><!-- wp:html -->';

	$html .= '<div class="cumbre-bi-metrics cumbre-remaining-metrics" aria-label="Indicadores de ' . esc_attr( $config['title'] ) . '">';
	foreach ( $config['metrics'] as $metric ) {
		$html .= '<article><span>' . esc_html( $metric[0] ) . '</span><strong>' . esc_html( $metric[1] ) . '</strong><p>' . esc_html( $metric[2] ) . '</p></article>';
	}
	$html .= '</div>';

	$html .= '<div class="cumbre-remaining-flow">';
	foreach ( $config['flow'] as $index => $step ) {
		$html .= '<article><span>' . esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ) . '</span><h3>' . esc_html( $step[0] ) . '</h3><p>' . esc_html( $step[1] ) . '</p></article>';
	}
	$html .= '</div>';

	$html .= '<div class="cumbre-limit-table" role="table" aria-label="Planes de ' . esc_attr( $config['title'] ) . '"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Plan</span><span>Base</span><span>Standard</span><span>Full</span></div>';
	$html .= '<div class="cumbre-limit-row" role="row"><span>Alcance</span><span>' . esc_html( $config['plans'][0] ) . '</span><span>' . esc_html( $config['plans'][1] ) . '</span><span>' . esc_html( $config['plans'][2] ) . '</span></div>';
	$html .= '<div class="cumbre-limit-row" role="row"><span>Perfil</span><span>Inicio ordenado</span><span>Operación conectada</span><span>Escala y auditoría</span></div></div>';

	$html .= '<div class="cumbre-payment-method-grid" aria-label="Add-ons y capacidades">';
	foreach ( $config['addons'] as $addon ) {
		$html .= '<span>' . esc_html( $addon ) . '</span>';
	}
	$html .= '</div>';

	$html .= '<div class="cumbre-pymes-guardrails">';
	foreach ( array_slice( $config['guardrails'], 0, 3 ) as $guardrail ) {
		$html .= '<article class="cumbre-proof-card"><strong>' . esc_html( $guardrail[0] ) . '</strong><span>' . esc_html( $guardrail[1] ) . '</span></article>';
	}
	$html .= '</div><!-- /wp:html --></section><!-- /wp:group -->';

	return $html;
}

function gema_sovereign_get_remaining_cumbre_landing_definitions(): array {
	$common = array(
		'crm'             => array( 'Cumbre CRM', '/cumbre-crm', 'Contactos, oportunidades, seguimiento y trazabilidad comercial.' ),
		'ventas'          => array( 'Cumbre Ventas', '/erp-cumbre/cumbre-ventas', 'Ventas físicas, digitales y administrativas conectadas al ERP.' ),
		'catalogo'        => array( 'Cumbre Catálogo', '/cumbre/catalogo', 'Productos, servicios, precios, IVA y costos como fuente única.' ),
		'stock'           => array( 'Cumbre Stock', '/erp-cumbre/cumbre-stock', 'Reservas, movimientos, saldos y trazabilidad de inventario.' ),
		'cobros'          => array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'Links, QR, estados de cobro, conciliación y webhooks.' ),
		'facturador'      => array( 'Cumbre Facturador ARCA', '/erp-cumbre/cumbre-facturador-arca', 'Comprobantes fiscales/documentales con implementación asistida.' ),
		'tesoreria'       => array( 'Cumbre Tesorería', '/erp-cumbre/cumbre-tesoreria', 'Pagos, bancos, caja, conciliación y cashflow.' ),
		'contabilidad'    => array( 'Cumbre Contabilidad', '/erp-cumbre/cumbre-contabilidad', 'Asientos, cierres, provisiones y reportes revisables.' ),
		'legal'           => array( 'Cumbre Legal', '/erp-cumbre/cumbre-legal', 'Documentos, contratos, políticas y revisión profesional.' ),
		'bi'              => array( 'Cumbre Reportes BI', '/erp-cumbre/cumbre-reportes-bi', 'KPIs, tableros, alertas y reportes gerenciales.' ),
		'planificacion'   => array( 'Cumbre Planificación', '/erp-cumbre/cumbre-planificacion', 'Presupuestos, escenarios, forecast y real vs plan.' ),
		'whatsapp'        => array( 'Cumbre WhatsApp Hub', '/erp-cumbre/cumbre-whatsapp-hub', 'Mensajes, alertas, opt-in, plantillas y seguimiento.' ),
		'automatizaciones'=> array( 'Cumbre Automatizaciones', '/erp-cumbre/cumbre-automatizaciones', 'Triggers, condiciones, acciones, webhooks y auditoría.' ),
		'marketing'       => array( 'Cumbre Marketing', '/erp-cumbre/cumbre-marketing', 'Segmentos, campañas, audiencias, atribución y medición.' ),
		'web'             => array( 'Cumbre Web', '/erp-cumbre/cumbre-web', 'Landings, formularios, SEO, eventos y captación conectada.' ),
	);

	$configs = array(
		'cumbre-personal' => array(
			'slug' => 'cumbre-personal', 'title' => 'Cumbre Personal', 'headline' => 'RRHH simple, trazable y conectado a tu ERP', 'kicker' => 'RRHH · Legajos · Asistencia · Novedades · Costos laborales', 'section_kicker' => 'Personas y administración laboral', 'section_title' => 'Legajos, asistencia, novedades y costos laborales en un solo flujo', 'seo_title' => 'Cumbre Personal | Software de RRHH, legajos y asistencia para PyMEs', 'meta_description' => 'Gestioná legajos digitales, asistencia, ausencias, novedades de liquidación y documentos laborales con Cumbre Personal, el módulo RRHH conectado a tu ERP.', 'keywords' => 'software de recursos humanos para PyMEs, RRHH para empresas argentinas, legajos digitales, control de asistencia, ausentismo laboral, novedades de liquidación, liquidación de sueldos asistida', 'description' => 'Cumbre Personal centraliza legajos digitales, asistencia, ausencias, licencias, novedades de liquidación y documentos laborales. Conecta RRHH con Tesorería, Contabilidad, Legal, Reportes BI, Planificación, Empresas y WhatsApp Hub para que cada novedad tenga trazabilidad administrativa.', 'problem' => 'Muchas PyMEs administran empleados con planillas, chats, carpetas dispersas y documentos sin seguimiento.', 'value' => 'Ordena la información diaria de personas y la conecta con el ERP para revisar, aprobar, reportar y preparar liquidaciones asistidas con más control.', 'features' => array( array( 'Legajos digitales', 'Datos laborales, puestos, áreas, sucursales, responsables y documentos referenciados.' ), array( 'Asistencia y ausencias', 'Control simple de asistencia, licencias, vacaciones, certificados y ausentismo.' ), array( 'Novedades revisables', 'Novedades de liquidación, vencimientos y costos laborales preparados para revisión profesional.' ) ), 'list' => array( 'No reemplaza contador, abogado laboralista ni asesor profesional.', 'No almacena datos médicos sensibles en claro ni envía información laboral sensible sin opt-in y minimización.', 'Toda importación requiere previsualización, mapeo, aprobación e idempotencia.' ), 'metrics' => array( array( 'Personas activas', '86', 'Legajos por área, sucursal y responsable.' ), array( 'Ausencias mes', '14', 'Licencias y certificados con seguimiento.' ), array( 'Novedades', '22', 'Pendientes de revisión para liquidación.' ), array( 'Vencimientos', '9', 'Documentos laborales próximos a vencer.' ) ), 'flow' => array( array( 'Alta del legajo', 'Datos mínimos, puesto, área, responsable y documentos.' ), array( 'Asistencia o ausencia', 'Registro diario, licencia, certificado o novedad.' ), array( 'Revisión', 'Aprobación administrativa o derivación profesional.' ), array( 'Liquidación asistida', 'Novedades preparadas para contador o asesor.' ), array( 'Pago y asiento', 'Conexión con Tesorería y Contabilidad cuando corresponda.' ) ), 'plans' => array( 'Hasta 20 personas', 'Hasta 100 personas, aprobaciones y WhatsApp', 'Hasta 500 personas, multi sucursal e integración BI' ), 'addons' => array( 'Bloque adicional de legajos', 'Firma digital/documental', 'Soporte laboral prioritario', 'Convenios asistidos', 'Importador Universal', 'Alertas WhatsApp' ), 'guardrails' => array( array( 'Revisión profesional', 'No promete liquidación legal definitiva ni reemplaza asesoramiento laboral.' ), array( 'Datos sensibles', 'Minimización, permisos y cuidado especial de información laboral.' ), array( 'Auditoría', 'Toda acción crítica conserva usuario, fecha, origen y estado.' ) ), 'links' => array( $common['tesoreria'], $common['contabilidad'], $common['legal'], $common['bi'], $common['planificacion'], $common['whatsapp'] ), 'faq_what' => 'Es el módulo de ERP Cumbre para legajos digitales, asistencia, ausentismo, novedades laborales, documentos, vencimientos y costos de personal.', 'faq_links' => 'Conecta Tesorería, Contabilidad, Legal, Reportes BI, Planificación, Empresas, WhatsApp Hub e Importador Universal.', 'faq_guardrail' => 'No reemplaza contador, abogado laboralista ni asesor profesional; prepara información para revisión responsable.', 'cta_title' => 'Ordená tu equipo dentro del ERP', 'cta_copy' => 'Centralizá legajos, asistencia, novedades y costos laborales con trazabilidad y revisión profesional.'
		),
		'cumbre-marketing' => array(
			'slug' => 'cumbre-marketing', 'title' => 'Cumbre Marketing', 'headline' => 'Campañas conectadas a tus clientes y ventas reales', 'kicker' => 'Marketing · Segmentos · Audiencias · WhatsApp · Atribución', 'section_kicker' => 'Marketing conectado al ERP', 'section_title' => 'Segmentos, campañas, canales y atribución sobre datos reales', 'seo_title' => 'Cumbre Marketing | Campañas, CRM y automatizaciones para PyMEs', 'meta_description' => 'Creá segmentos, campañas por WhatsApp/email, audiencias y atribución comercial con Cumbre Marketing, conectado al CRM, eCommerce y ERP.', 'keywords' => 'software de marketing para PyMEs, CRM con marketing, campañas por WhatsApp, automatizaciones comerciales, audiencias para Meta Ads, marketing para eCommerce, atribución de ventas', 'description' => 'Cumbre Marketing crea segmentos, audiencias y campañas multicanal usando información del CRM, eCommerce, Mercado Libre, Cobros y WhatsApp Hub. Activá acciones comerciales con consentimiento, trazabilidad y medición real de impacto.', 'problem' => 'Muchas empresas hacen marketing con listas sueltas, contactos duplicados, campañas sin atribución y datos desconectados de ventas reales.', 'value' => 'Conecta campañas con el ciclo completo: contacto, oportunidad, mensaje, venta, cobro, recompra y reporte.', 'features' => array( array( 'Segmentos reales', 'Audiencias desde CRM, ventas, eCommerce, Mercado Libre y comportamiento.' ), array( 'Campañas multicanal', 'WhatsApp, email, anuncios, calendarios, plantillas, UTM y variantes.' ), array( 'Atribución comercial', 'Mide impacto en oportunidades, ventas, cobros, recompra y reportes BI.' ) ), 'list' => array( 'No reemplaza Meta Ads, Google Ads ni plataformas de email; las orquesta con datos propios.', 'No envía campañas sin consentimiento, opt-in o base legal suficiente.', 'Credenciales externas por credencial_ref y webhooks con firma o secreto.' ), 'metrics' => array( array( 'Campañas', '12', 'Acciones activas por segmento y canal.' ), array( 'Conversión', '8,4%', 'Impacto real en oportunidades y ventas.' ), array( 'Reactivados', '137', 'Clientes recuperados con campañas trazables.' ), array( 'ROAS', '3,1x', 'Medición conectada a ventas y cobros.' ) ), 'flow' => array( array( 'Segmento', 'Clientes, oportunidades o audiencias según datos ERP.' ), array( 'Campaña', 'Mensaje, canal, plantilla, UTM y calendario.' ), array( 'Evento', 'Apertura, clic, respuesta, venta o cobro.' ), array( 'Atribución', 'Relación con CRM, Cobros, eCommerce y BI.' ), array( 'Optimización', 'Alertas, cohortes, repetición o pausa.' ) ), 'plans' => array( '5 campañas activas y atribución básica', 'Audiencias, WhatsApp, email, automatizaciones y reportes', 'Multicanal avanzado, Meta/Google asistido, cohortes y BI' ), 'addons' => array( 'Bloque de campañas', 'Conector publicitario', 'Automatizaciones avanzadas', 'Soporte growth', 'A/B testing', 'Reportes BI' ), 'guardrails' => array( array( 'Consentimiento', 'No se envían campañas sin opt-in o base legal cuando corresponde.' ), array( 'Sin bases paralelas', 'Usa contactos del CRM/empresas_clientes para evitar duplicidad.' ), array( 'Sin resultados garantizados', 'Mide y optimiza, pero no promete ventas o posicionamiento garantizado.' ) ), 'links' => array( $common['crm'], $common['whatsapp'], $common['web'], $common['cobros'], $common['bi'], $common['automatizaciones'] ), 'faq_what' => 'Es el módulo transversal para campañas, segmentos, audiencias, WhatsApp, email, anuncios y atribución conectada al ERP.', 'faq_links' => 'Conecta CRM, WhatsApp Hub, Web, eCommerce, Mercado Libre, Cobros, Reportes BI, Legal y Tutoriales API.', 'faq_guardrail' => 'No habilita spam ni reemplaza plataformas publicitarias; exige consentimiento, opt-out, minimización y credenciales seguras.', 'cta_title' => 'Activá marketing con datos reales', 'cta_copy' => 'Convertí contactos, ventas y comportamiento en campañas medibles y trazables.'
		),
		'cumbre-automatizaciones' => array(
			'slug' => 'cumbre-automatizaciones', 'title' => 'Cumbre Automatizaciones', 'headline' => 'Automatizaciones seguras para tu ERP', 'kicker' => 'Workflows · Triggers · Webhooks · Auditoría · Idempotencia', 'section_kicker' => 'Motor transversal', 'section_title' => 'Evento, condición, acción, auditoría y pausa por módulo', 'seo_title' => 'Cumbre Automatizaciones | Workflows seguros para ERP y PyMEs', 'meta_description' => 'Automatizá tareas entre módulos del ERP con triggers, condiciones, acciones, webhooks, auditoría, idempotencia y aprobaciones humanas.', 'keywords' => 'automatizaciones para ERP, workflows empresariales, automatizar tareas PyME, flujos no-code para empresas, automatizaciones con WhatsApp, webhooks ERP', 'description' => 'Cumbre Automatizaciones conecta eventos de CRM, ventas, cobros, stock, compras, tesorería, WhatsApp, marketing, contabilidad y otros módulos para ejecutar flujos seguros, pausables e idempotentes.', 'problem' => 'Las empresas repiten tareas manuales y, cuando automatizan sin controles, aparecen errores, loops, duplicados o acciones sensibles sin revisión.', 'value' => 'Permite crear flujos dentro del ERP con contexto, permisos, trazabilidad y guardrails del módulo dueño.', 'features' => array( array( 'Flujos no-code/low-code', 'Triggers, condiciones, filtros y acciones internas entre módulos.' ), array( 'Webhooks controlados', 'Entrantes y salientes con firma, secretos, reintentos e idempotencia.' ), array( 'Auditoría y pausas', 'Logs, errores, estados, pausa por módulo o tenant y aprobación humana.' ) ), 'list' => array( 'No ejecuta acciones críticas sin permisos y aprobación cuando corresponda.', 'No permite loops infinitos; toda ejecución debe tener idempotency key.', 'No borra datos automáticamente: usa estados, anulaciones o acciones reversibles auditadas.' ), 'metrics' => array( array( 'Flujos activos', '48', 'Automatizaciones por módulo y estado.' ), array( 'Ejecuciones', '9.2k', 'Eventos procesados con trazabilidad.' ), array( 'Errores', '0,7%', 'Reintentos, alertas y diagnóstico.' ), array( 'Pausas', '6', 'Módulos con flujos detenidos preventivamente.' ) ), 'flow' => array( array( 'Elegir trigger', 'Evento de módulo, webhook o tarea programada.' ), array( 'Condición', 'Reglas, filtros, permisos y contexto.' ), array( 'Acción', 'Notificación, tarea, cambio de estado o webhook.' ), array( 'Prueba', 'Simulación, logs y validación.' ), array( 'Monitoreo', 'Auditoría, reintentos, pausa y alertas.' ) ), 'plans' => array( '5 flujos activos e historial básico', '50 flujos, condiciones, webhooks e idempotencia', '500 flujos, aprobaciones, auditoría extendida y BI' ), 'addons' => array( 'Bloque de flujos', 'Webhooks avanzados', 'Flujos críticos asistidos', 'Soporte prioritario', 'Alertas BI', 'Pausa por tenant' ), 'guardrails' => array( array( 'Permisos', 'Acciones críticas requieren permisos y aprobación cuando corresponde.' ), array( 'Anti-loop', 'Idempotencia, reintentos controlados y prevención de ciclos.' ), array( 'Trazabilidad', 'Cada ejecución conserva origen, resultado, error y usuario o sistema responsable.' ) ), 'links' => array( $common['whatsapp'], $common['marketing'], $common['bi'], $common['web'], $common['cobros'], $common['stock'] ), 'faq_what' => 'Es el motor transversal de workflows de Cumbre ERP para automatizar eventos, condiciones, acciones, webhooks y aprobaciones.', 'faq_links' => 'Puede tomar eventos de todos los módulos Cumbre y conectarse con WhatsApp Hub, Marketing, Empresas, Reportes BI y Tutoriales API.', 'faq_guardrail' => 'No reemplaza controles humanos en pagos, bajas, fiscalidad, contabilidad, mensajes sensibles o cambios críticos.', 'cta_title' => 'Automatizá sin perder control', 'cta_copy' => 'Transformá tareas repetitivas en flujos trazables, pausables y auditables.'
		),
		'cumbre-web' => array(
			'slug' => 'cumbre-web', 'title' => 'Cumbre Web', 'headline' => 'Web, formularios y SEO conectados a tu ERP', 'kicker' => 'Landings · Formularios · SEO · Eventos · CRM', 'section_kicker' => 'Captación conectada', 'section_title' => 'De la página y el formulario al CRM, seguimiento y reporte', 'seo_title' => 'Cumbre Web | Sitio web, formularios y SEO conectados al ERP', 'meta_description' => 'Conectá landings, formularios, eventos, SEO y conversiones con CRM, Marketing, WhatsApp y Reportes BI usando Cumbre Web.', 'keywords' => 'sitio web conectado al ERP, formularios conectados al CRM, landing page para PyMEs, CMS para ERP, SEO para empresas, captación de leads', 'description' => 'Cumbre Web convierte landings, formularios, eventos y contenido SEO en datos accionables dentro de ERP Cumbre. Cada consulta puede entrar al CRM, activar seguimiento, medir campañas y alimentar reportes sin duplicar contactos.', 'problem' => 'Muchas empresas tienen una web desconectada: formularios por email, leads sin seguimiento, campañas sin atribución y tracking disperso.', 'value' => 'No es otro constructor de páginas: es la capa web conectada al ERP, CRM, Marketing, WhatsApp, BI y Automatizaciones.', 'features' => array( array( 'Landings y CMS', 'Páginas por módulo, vertical o campaña, con contenido comercial versionable.' ), array( 'Formularios CRM', 'Captura de leads, UTM, fuente, consentimiento y acciones posteriores.' ), array( 'SEO y eventos', 'Metadatos, schema, canonical, redirects, tracking y conversiones.' ) ), 'list' => array( 'No publica ni despliega cambios sin aprobación explícita.', 'No crea contactos paralelos; formularios alimentan CRM o empresas_clientes.', 'No promete ranking SEO garantizado y respeta consentimiento de cookies/tracking.' ), 'metrics' => array( array( 'Páginas', '86', 'Landings, servicios, verticales y contenido SEO.' ), array( 'Leads', '312', 'Consultas conectadas a CRM.' ), array( 'Conversión', '5,8%', 'Eventos medidos por fuente y UTM.' ), array( 'SEO', '124', 'URLs con metadatos y canonical.' ) ), 'flow' => array( array( 'Página', 'Landing, formulario, SEO y contenido.' ), array( 'Evento', 'Consulta, clic, conversión o UTM.' ), array( 'CRM', 'Lead, contacto, oportunidad y responsable.' ), array( 'Automatización', 'Seguimiento, WhatsApp, email o tarea.' ), array( 'Reporte', 'Conversión, canal, campaña y performance.' ) ), 'plans' => array( '10 páginas, formularios CRM y SEO básico', '100 páginas, CMS, tracking y conversiones', 'Multi sitio, headless/API, Marketing/BI/eCommerce' ), 'addons' => array( 'Bloque de páginas', 'SEO avanzado', 'Headless/API', 'Soporte web', 'Anti-spam', 'Tracking avanzado' ), 'guardrails' => array( array( 'Publicación controlada', 'Nada se publica sin aprobación y revisión.' ), array( 'Privacidad', 'Consentimiento, anti-spam, sanitización y control de scripts.' ), array( 'SEO responsable', 'Optimiza estructura, pero no promete ranking garantizado.' ) ), 'links' => array( $common['crm'], $common['marketing'], $common['whatsapp'], $common['bi'], $common['automatizaciones'], $common['catalogo'] ), 'faq_what' => 'Es la capa web de Cumbre ERP para landings, CMS/headless, formularios, SEO, eventos y captación conectada.', 'faq_links' => 'Conecta CRM, Marketing, Catálogo, eCommerce, Reportes BI, Automatizaciones y WhatsApp Hub.', 'faq_guardrail' => 'No publica cambios sin aprobación, no promete ranking SEO garantizado y exige consentimiento cuando corresponde.', 'cta_title' => 'Convertí tu web en parte del ERP', 'cta_copy' => 'Conectá páginas, formularios y eventos con ventas, seguimiento y reportes.'
		),
		'cumbre-ventas' => array(
			'slug' => 'cumbre-ventas', 'title' => 'Cumbre Ventas', 'headline' => 'Ventas conectadas a stock, cobros y facturación', 'kicker' => 'POS · Ventas digitales · Cobros · Stock · Facturación', 'section_kicker' => 'Venta transaccional', 'section_title' => 'Del cliente y producto al cobro, stock, factura y reporte', 'seo_title' => 'Cumbre Ventas | POS, ventas, cobros, stock y facturación para PyMEs', 'meta_description' => 'Unificá ventas mostrador, digitales y administrativas con stock, cobros, facturación, CRM, eCommerce y Mercado Libre conectados al ERP.', 'keywords' => 'software de ventas para PyMEs, POS conectado al ERP, ventas con stock y facturación, listas de precios bimonetarias, ventas multicanal, sistema de ventas Argentina', 'description' => 'Cumbre Ventas conecta cada operación con Catálogo, Stock, Cobros, Facturador ARCA, CRM, eCommerce, Mercado Libre, ERP Negocios y ERP PyMEs para que ninguna venta quede aislada.', 'problem' => 'Las ventas por mostrador, WhatsApp, eCommerce, marketplace y administración suelen quedar separadas, con stock desactualizado y cobros sin vincular.', 'value' => 'Une venta, cobro, stock, factura, cliente y canal para vender en distintos puntos sin perder trazabilidad.', 'features' => array( array( 'POS y venta digital', 'Ventas mostrador, internas, administrativas y de canales digitales.' ), array( 'Precio y descuento', 'Listas bimonetarias, descuentos, autorizaciones y estados de venta.' ), array( 'Cobro, stock y factura', 'Vinculación con Cobros, Stock, Facturador ARCA, eCommerce y Mercado Libre.' ) ), 'list' => array( 'No descuenta stock sin movimiento idempotente de Stock.', 'No marca como cobrada sin evento de Cobros o evidencia aprobada.', 'No factura sin Facturador ARCA configurado o documento válido.' ), 'metrics' => array( array( 'Ventas día', '184', 'Mostrador, digitales y administrativas.' ), array( 'Ticket prom.', 'ARS 18k', 'Indicador por canal y cliente.' ), array( 'Margen', '31%', 'Precio, costo y descuento vinculados.' ), array( 'Pendientes', '12', 'Cobro, factura o preparación.' ) ), 'flow' => array( array( 'Cliente/producto', 'Catálogo, precio, IVA, stock y canal.' ), array( 'Descuento', 'Reglas, permisos o aprobación.' ), array( 'Confirmación', 'Estado de venta, reserva y documento.' ), array( 'Cobro', 'Link, QR, billetera, transferencia o manual aprobado.' ), array( 'Factura y reporte', 'Comprobante, stock, margen y BI.' ) ), 'plans' => array( 'Venta manual/POS simple', 'Multicanal, bimonetaria, descuentos y facturación', 'Multi sucursal, reglas avanzadas, BI/eCommerce' ), 'addons' => array( 'Bloque de ventas', 'Listas avanzadas', 'Reglas de descuento', 'Soporte ventas', 'eCommerce', 'Mercado Libre' ), 'guardrails' => array( array( 'Catálogo primero', 'No vende productos fuera de Catálogo salvo borrador controlado.' ), array( 'Stock idempotente', 'Cada impacto de stock se registra con movimiento auditable.' ), array( 'Fiscal controlado', 'No promete facturación si el Facturador ARCA no está configurado.' ) ), 'links' => array( $common['catalogo'], $common['stock'], $common['cobros'], $common['facturador'], $common['crm'], $common['bi'] ), 'faq_what' => 'Es la capa común de venta transaccional de ERP Cumbre: POS, ventas digitales, listas, descuentos, cobros, stock y facturación vinculada.', 'faq_links' => 'Conecta Catálogo, Stock, Cobros, Facturador ARCA, CRM, ERP Negocios, ERP PyMEs, eCommerce, Mercado Libre y Reportes BI.', 'faq_guardrail' => 'No reemplaza validaciones fiscales ni de stock; cada venta crítica conserva permisos, origen, cobro, factura y auditoría.', 'cta_title' => 'Unificá tus ventas en Cumbre', 'cta_copy' => 'Vendé por mostrador, administración o canales digitales con stock, cobros y facturación conectados.'
		),
	);

	$verticals = array(
		'cumbre-kioscos' => array( 'Cumbre Kioscos', 'Precios, stock y caja rápida para kioscos y minimercados.', 'Los kioscos trabajan con alta rotación, listas de precios cambiantes, márgenes chicos y proveedores frecuentes.', 'Leer listas de proveedores desde PDF, imagen, email o WhatsApp, sugerir costos, recalcular precios y vender rápido con reposición.', 'software para kioscos, sistema para kioscos, control de stock kiosco, lista de precios proveedores', array( 'Listas proveedor', 'POS mostrador', 'Stock crítico', 'Caja diaria' ), array( 'Actualización', 'Venta', 'Reposición', 'Reporte' ), array( $common['catalogo'], $common['stock'], $common['ventas'], $common['cobros'], $common['whatsapp'], $common['bi'] ) ),
		'cumbre-resto' => array( 'Cumbre Resto', 'Comandas, caja y stock gastronómico conectados al ERP.', 'Restaurantes y casas de comida pierden tiempo entre comandas, cocina, caja, stock de insumos, delivery y facturación.', 'Convertir pedidos de salón, mostrador, WhatsApp o audio en comandas trazables y ventas conectadas a caja, stock y cobros.', 'software para restaurantes, sistema de comandas, POS gastronómico, control de stock gastronómico', array( 'Comandas', 'Audio WhatsApp', 'Stock insumos', 'Caja y cobros' ), array( 'Pedido', 'Comanda', 'Cocina', 'Cobro' ), array( $common['ventas'], $common['catalogo'], $common['stock'], $common['cobros'], $common['facturador'], $common['whatsapp'] ) ),
		'cumbre-depositos-wms' => array( 'Cumbre Depósitos WMS', 'Depósitos, ubicaciones, picking e inventario visual para PyMEs.', 'Los depósitos pierden trazabilidad por ubicaciones informales, conteos manuales, picking sin control y stock desactualizado.', 'Usar Stock avanzado, ubicaciones, códigos, conteos cíclicos e inventario asistido por visión desde video o fotos, con revisión humana.', 'WMS para PyMEs, software para depósitos, control de ubicaciones depósito, inventario por código de barras', array( 'Ubicaciones', 'Picking', 'Conteos cíclicos', 'Inventario visual' ), array( 'Ingreso', 'Ubicación', 'Picking', 'Conteo' ), array( $common['stock'], $common['catalogo'], $common['ventas'], $common['whatsapp'], $common['bi'], $common['automatizaciones'] ) ),
		'cumbre-constructoras' => array( 'Cumbre Constructoras', 'Obras, certificados, redeterminaciones y facturación conectadas.', 'Constructoras y contratistas manejan certificados, avances, redeterminaciones, compras, pagos y facturación con planillas dispersas.', 'Interpretar certificados de avance, cruzar índices cuando corresponda, preparar redeterminaciones revisables y conectar facturación, compras y tesorería.', 'software para constructoras, gestión de obras, certificados de avance, redeterminación de precios CAC', array( 'Certificados', 'Redeterminaciones', 'Compras por obra', 'Reportes por obra' ), array( 'Obra', 'Certificado', 'Revisión', 'Factura' ), array( $common['tesoreria'], $common['contabilidad'], $common['facturador'], $common['planificacion'], $common['legal'], $common['bi'] ) ),
		'cumbre-agro' => array( 'Cumbre Agro', 'Cartas de porte, acopio, compras y trazabilidad agro conectadas.', 'El agro trabaja con cartas de porte, patentes, kilos, acopio, compras, pagos y documentación fiscal dispersa.', 'Leer Cartas de Porte electrónicas o documentos de transporte, extraer datos clave y precargar compras/acopio para revisión humana.', 'software agro, cartas de porte electrónicas, gestión agropecuaria, acopio y compras agro', array( 'Cartas de porte', 'Kilos y patentes', 'Acopio', 'Reportes campaña' ), array( 'Documento', 'Extracción', 'Triage', 'Acopio' ), array( $common['stock'], $common['tesoreria'], $common['facturador'], $common['contabilidad'], $common['bi'], $common['whatsapp'] ) ),
		'cumbre-mercados' => array( 'Cumbre Mercados', 'Góndolas, vencimientos, merma y promociones conectadas al ERP.', 'Mercados y autoservicios necesitan controlar góndola, vencimientos, merma, precios, stock y promociones sin perder velocidad.', 'Usar visión asistida sobre góndolas, alertas de vencimiento/merma, descuentos sugeridos y sincronización con ventas, stock y eCommerce.', 'software para mercados, control de góndolas, vencimientos y merma, sistema para autoservicios', array( 'Góndola', 'Vencimientos', 'Merma', 'Promociones' ), array( 'Detección', 'Revisión', 'Descuento', 'Venta' ), array( $common['catalogo'], $common['stock'], $common['ventas'], $common['marketing'], $common['whatsapp'], $common['bi'] ) ),
	);

	foreach ( $verticals as $slug => $data ) {
		$configs[ $slug ] = array(
			'slug' => $slug, 'title' => $data[0], 'headline' => $data[1], 'kicker' => 'Vertical sectorial · ERP Cumbre · IA multimodal · Guardrails', 'section_kicker' => 'Vertical sectorial', 'section_title' => 'Módulos Cumbre empaquetados para el rubro', 'seo_title' => $data[0] . ' | ERP Cumbre para el sector', 'meta_description' => $data[1] . ' Vertical sectorial conectada a ventas, stock, cobros, WhatsApp, reportes y automatizaciones de ERP Cumbre.', 'keywords' => $data[4], 'description' => $data[1] . ' Paquete sectorial de Cumbre ERP para ordenar operación, ventas, stock, cobros, documentación, alertas y reportes sin implementar un ERP corporativo pesado.', 'problem' => $data[2], 'value' => $data[3], 'features' => array( array( $data[5][0], 'Funcionalidad central adaptada al rubro con revisión humana.' ), array( $data[5][1], 'Operación conectada a módulos troncales de Cumbre.' ), array( $data[5][2], 'Alertas, trazabilidad y automatizaciones pausables.' ), array( $data[5][3], 'Indicadores y reportes para decidir con datos reales.' ) ), 'list' => array( 'Vertical sobre módulos existentes, no base paralela.', 'No publica, factura, paga ni modifica datos sensibles sin permisos del módulo dueño.', 'Toda lectura asistida por IA o visión requiere revisión cuando sea ambigua.' ), 'metrics' => array( array( 'Operación', 'Hoy', 'Vista diaria de actividad crítica del rubro.' ), array( 'Alertas', 'IA', 'Señales operativas con revisión humana.' ), array( 'Trazabilidad', '100%', 'Origen, usuario, estado y módulo dueño.' ), array( 'Reportes', 'BI', 'Indicadores por canal, stock, ventas o avance.' ) ), 'flow' => array( array( $data[6][0], 'Origen operativo del flujo sectorial.' ), array( $data[6][1], 'Validación, lectura o preparación asistida.' ), array( $data[6][2], 'Revisión humana y aplicación controlada.' ), array( $data[6][3], 'Impacto en ERP, reporte y seguimiento.' ) ), 'plans' => array( 'Paquete inicial del rubro', 'Paquete recomendado con automatizaciones y WhatsApp', 'Paquete avanzado con BI, auditoría e integraciones' ), 'addons' => array( 'Implementación asistida', 'Automatizaciones avanzadas', 'Reportes BI', 'Importador Universal', 'Soporte prioritario', 'WhatsApp Hub' ), 'guardrails' => array( array( 'No base paralela', 'La vertical empaqueta módulos Cumbre existentes y respeta su módulo dueño.' ), array( 'Revisión humana', 'Lecturas, descuentos, ajustes o documentos ambiguos requieren aprobación.' ), array( 'Permisos y auditoría', 'Toda acción crítica conserva origen, usuario, estado e idempotencia.' ) ), 'links' => $data[7], 'faq_what' => 'Es una vertical sectorial de ERP Cumbre que empaqueta módulos troncales, automatizaciones, IA y reportes para el rubro.', 'faq_links' => 'Conecta módulos como Ventas, Stock, Cobros, WhatsApp Hub, Reportes BI, Automatizaciones y los módulos específicos que requiere el sector.', 'faq_guardrail' => 'No reemplaza controles profesionales, fiscales, bromatológicos, contractuales o físicos del rubro; ayuda a ordenar y auditar la operación.', 'cta_title' => 'Adaptá Cumbre a tu rubro', 'cta_copy' => 'Empezá con un paquete sectorial conectado a módulos reales de ERP Cumbre.'
		);
	}

	$definitions = array();
	foreach ( $configs as $slug => $config ) {
		$definitions[ $slug ] = gema_sovereign_make_cumbre_remaining_landing( $config );
	}

	return $definitions;
}

function gema_sovereign_get_cumbre_whatsapp_hub_page_definition(): array {
	return array(
		'title'               => 'Cumbre WhatsApp Hub',
		'seo_title'           => 'Cumbre WhatsApp Hub | WhatsApp Business API Argentina conectado al ERP',
		'meta_description'    => 'WhatsApp Business API para PyMEs: costos Meta, API oficial por cliente, CRM, opt-in, plantillas, webhooks y ERP Cumbre conectado.',
		'keywords'            => 'WhatsApp Business API Argentina, WhatsApp Business Cloud API, Meta WhatsApp API, CRM WhatsApp para PyMEs, agente conversacional ERP, costos WhatsApp API, webhooks WhatsApp seguros, plantillas Meta, opt-in WhatsApp, Cumbre WhatsApp Hub',
		'kicker'              => 'WhatsApp Business Cloud API · Agente Cerebro · Opt-in · Webhooks seguros',
		'description'         => 'Cumbre WhatsApp Hub conecta CRM, ventas, cobros, stock, compras, tesorería, impuestos, BI, eCommerce y más con WhatsApp Business Cloud API, usando un agente cerebro que notifica, informa y da seguimiento con trazabilidad.',
		'primary_cta_label'   => 'Solicitar demo',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Ver cómo se conecta con Meta',
		'secondary_cta_url'   => '/erp-cumbre/cumbre-whatsapp-hub/#meta',
		'modules_title'       => 'Tu ERP hablando por WhatsApp, con contexto real de tu empresa',
		'list_title'          => 'Comunicación inteligente con API oficial por cliente',
		'links_title'         => 'Módulos conectados a Cumbre WhatsApp Hub',
		'faq_title'           => 'Preguntas frecuentes sobre Cumbre WhatsApp Hub',
		'bottom_cta_title'    => 'Convertí WhatsApp en el canal inteligente de tu ERP',
		'bottom_cta_copy'     => 'Conectá Cumbre con la API oficial de Meta y empezá a comunicar, alertar y dar seguimiento con contexto real de tu empresa.',
		'modules'             => array(
			array( 'WhatsApp como capa transversal', 'WhatsApp no es un canal agregado. En Cumbre es una capa transversal de comunicación inteligente conectada a la operación real.' ),
			array( 'Agente Cerebro WhatsApp', 'Trabaja con contactos del cliente, lee contexto de módulos habilitados y puede enviar mensajes, recordatorios, alertas, confirmaciones y seguimientos según reglas de negocio.' ),
			array( 'API oficial de Meta por cliente', 'Cada empresa usa su propia WhatsApp Business Cloud API: Business Manager, WABA, número, app de Meta, plantillas, opt-in y webhooks.' ),
			array( 'Control de cuenta y responsabilidad', 'Cumbre no usa una API compartida para todos los clientes. Cada empresa mantiene control sobre su cuenta, número, plantillas, calidad y responsabilidad.' ),
			array( 'Mensajes con opt-in', 'Los mensajes salientes se diseñan sobre contactos con consentimiento, plantillas aprobadas por Meta y reglas de frecuencia según el caso.' ),
			array( 'Webhooks seguros', 'La integración valida webhooks de Meta desde backend, evita secretos visibles y registra eventos, estados, errores y reintentos.' ),
			array( 'Derivación a humano', 'El agente puede sugerir respuestas y seguimiento, pero deriva a una persona cuando hay ventas complejas, reclamos, datos sensibles o acciones críticas.' ),
			array( 'Tutorial guiado Meta', 'Cumbre acompaña la conexión de Meta Developers, WhatsApp Business Account, Phone Number ID, webhooks, plantillas y prueba de conexión.' ),
		),
		'list'                => array(
			'Texto clave: El Agente Cerebro WhatsApp trabaja con los contactos del cliente, lee contexto de todos los módulos habilitados y puede enviar mensajes, recordatorios, alertas, confirmaciones y seguimientos según reglas de negocio.',
			'Cada cliente usa su propia API oficial de Meta: Business Manager propio, WhatsApp Business Account propio, número propio, app de Meta propia, plantillas aprobadas, opt-in de contactos y webhooks seguros.',
			'Funcionalidades: agente conversacional, seguimiento automático de contactos, alertas por módulo, mensajes con opt-in, plantillas aprobadas por Meta, webhooks seguros, historial, trazabilidad, derivación humana, automatizaciones pausables y tutorial guiado.',
			'Módulos conectados: CRM, Cobros, Stock, Compras, Tesorería, Contabilidad, Impuestos, Reportes BI, Planificación, eCommerce, Mercado Libre, Legal, Negocios, PyMEs y Empresas.',
			'Casos de uso: seguimiento de leads, recordatorios de pago, bajo stock, confirmación de reposición, vencimientos y pagos pendientes, recordatorios fiscales, alertas ejecutivas, pedidos, órdenes, vencimientos legales y desvíos de planificación.',
			'Seguridad: no guardar tokens en Firestore, usar credencial_ref, validar firmas de webhooks Meta, opt-in obligatorio, no enviar datos sensibles, aprobación humana en acciones críticas y automatizaciones pausables por módulo.',
			'Tutorial Meta: crear app en Meta Developers, asociar WhatsApp Business Account, obtener Phone Number ID, configurar webhooks, crear plantillas y probar conexión.',
			'Planes: WhatsApp Hub Base para un número, plantillas básicas y mensajes operativos; Standard para multi-módulo, automatizaciones y webhooks Meta; Full para multi-número, campañas avanzadas y soporte prioritario.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_whatsapp_hub_custom_sections() . gema_sovereign_build_cumbre_whatsapp_costs_section(),
		'links'               => array(
			array( 'Cumbre CRM', '/cumbre-crm', 'Seguir leads, oportunidades, clientes, próximas acciones y derivaciones comerciales.' ),
			array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'Enviar recordatorios de pago, avisos de cobro, confirmaciones y estados.' ),
			array( 'Cumbre Stock', '/erp-cumbre/cumbre-stock', 'Alertar bajo stock, movimientos observados, reservas o ingestas pendientes.' ),
			array( 'Cumbre Compras', '/erp-cumbre/cumbre-compras', 'Pedir confirmación de reposición, aprobación de órdenes y seguimiento a proveedores.' ),
			array( 'Cumbre Tesorería', '/erp-cumbre/cumbre-tesoreria', 'Notificar vencimientos, pagos pendientes, conciliaciones observadas y cashflow.' ),
			array( 'Cumbre Impuestos', '/erp-cumbre/cumbre-impuestos', 'Recordar vencimientos fiscales, saldos a pagar y reportes pendientes.' ),
			array( 'Cumbre Reportes BI', '/erp-cumbre/cumbre-reportes-bi', 'Enviar alertas ejecutivas con KPIs, desvíos y señales críticas.' ),
			array( 'Tutoriales API Cumbre', '/erp-cumbre/tutoriales-api-cumbre', 'Guiar la conexión segura con Meta, webhooks, OAuth, tokens y plantillas.' ),
		),
		'faq'                 => array(
			array( 'Qué es Cumbre WhatsApp Hub?', 'Es la plataforma transversal de comunicación por WhatsApp de Cumbre ERP, conectada a los módulos del sistema mediante un agente conversacional con contexto real de la empresa.' ),
			array( 'Usa una API compartida para todos los clientes?', 'No. El enfoque recomendado es que cada cliente use su propia WhatsApp Business Cloud API, con Business Manager, WABA, número, app, plantillas, calidad y responsabilidad propios.' ),
			array( 'Puede enviar mensajes sin opt-in?', 'No debería. Los mensajes salientes deben respetar opt-in, plantillas aprobadas por Meta, reglas de la plataforma y normativa aplicable.' ),
			array( 'Dónde se guardan los tokens?', 'La arquitectura debe evitar guardar tokens en Firestore o bases visibles. Se usa credencial_ref y mecanismos seguros como Secret Manager o equivalente.' ),
			array( 'El agente puede ejecutar acciones críticas?', 'Las acciones críticas requieren aprobación humana. El agente puede informar, sugerir, recordar y pedir confirmaciones, pero debe respetar permisos y reglas.' ),
			array( 'Cumbre ayuda a conectar Meta?', 'Sí. Incluye tutorial guiado para Meta Developers, WhatsApp Business Account, Phone Number ID, webhooks, plantillas y prueba de conexión.' ),
		),
	);
}

function gema_sovereign_build_cumbre_whatsapp_hub_custom_sections(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-whatsapp-section","layout":{"type":"constrained"}} --><section id="meta" class="wp-block-group gema-content-section cumbre-whatsapp-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">WhatsApp oficial por cliente</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Meta Cloud API propia, Agente Cerebro y trazabilidad conversacional</h2><!-- /wp:heading --><!-- wp:html --><div class="cumbre-whatsapp-chat" aria-label="Mockup conversacional de Cumbre WhatsApp Hub"><article><span>Agente Cerebro</span><p>Detecté una oportunidad sin respuesta hace 24 h y un cobro pendiente asociado. ¿Querés enviar seguimiento con plantilla aprobada?</p></article><article><span>Responsable comercial</span><p>Aprobado. Usar plantilla de seguimiento y derivar respuesta al vendedor asignado.</p></article><article><span>WhatsApp Hub</span><p>Mensaje enviado con opt-in, plantilla Meta y referencia al contacto CRM. Evento registrado.</p></article></div><div class="cumbre-whatsapp-flow"><article><span>01</span><h3>Cuenta Meta propia</h3><p>Business Manager, WABA, número, app de Meta y Phone Number ID bajo control del cliente.</p></article><article><span>02</span><h3>Credencial segura</h3><p>Tokens protegidos con credencial_ref; no se guardan secretos en Firestore ni chats.</p></article><article><span>03</span><h3>Webhook validado</h3><p>Backend con validación de firmas, eventos, reintentos, estados y trazabilidad.</p></article><article><span>04</span><h3>Agente con contexto</h3><p>Lee módulos habilitados y contactos CRM sin crear contactos paralelos.</p></article><article><span>05</span><h3>Control humano</h3><p>Acciones críticas, datos sensibles o campañas avanzadas requieren revisión y aprobación.</p></article></div><div class="cumbre-payment-method-grid" aria-label="Módulos conectados a WhatsApp Hub"><span>CRM</span><span>Cobros</span><span>Stock</span><span>Compras</span><span>Tesorería</span><span>Contabilidad</span><span>Impuestos</span><span>Reportes BI</span><span>Planificación</span><span>eCommerce</span><span>Mercado Libre</span><span>Legal</span><span>Negocios</span><span>PyMEs</span><span>Empresas</span></div><div class="cumbre-limit-table" role="table" aria-label="Planes de Cumbre WhatsApp Hub"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Capacidad</span><span>Base</span><span>Standard</span><span>Full</span></div><div class="cumbre-limit-row" role="row"><span>Números</span><span>1 número</span><span>1 número + módulos</span><span>Multi-número</span></div><div class="cumbre-limit-row" role="row"><span>Plantillas</span><span>Básicas</span><span>Operativas por módulo</span><span>Avanzadas y campañas</span></div><div class="cumbre-limit-row" role="row"><span>Automatizaciones</span><span>Mensajes operativos</span><span>Multi-módulo y pausables</span><span>Flujos avanzados</span></div><div class="cumbre-limit-row" role="row"><span>Webhooks</span><span>Configuración guiada</span><span>Meta webhooks seguros</span><span>Monitoreo prioritario</span></div><div class="cumbre-limit-row" role="row"><span>Soporte</span><span>Tutorial guiado</span><span>Implementación asistida</span><span>Soporte prioritario</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>API oficial por empresa</strong><span>Cada cliente mantiene control sobre cuenta, número, plantillas, calidad y responsabilidad en Meta.</span></article><article class="cumbre-proof-card"><strong>Opt-in y privacidad</strong><span>Los mensajes salientes requieren consentimiento o base válida, y no deben exponer datos sensibles por WhatsApp.</span></article><article class="cumbre-proof-card"><strong>Automatizaciones pausables</strong><span>Cada módulo puede pausar automatizaciones, exigir aprobación humana o derivar a un responsable.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_build_cumbre_whatsapp_costs_section(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-whatsapp-costs-section","layout":{"type":"constrained"}} --><section id="costos-whatsapp-api" class="wp-block-group gema-content-section cumbre-whatsapp-costs-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Costos reales y decisión de proveedor</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">WhatsApp API oficial: separar Meta, plataforma, implementación y soporte local</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"gema-section-copy"} --><p class="gema-section-copy">Los competidores que mejor explican WhatsApp API separan costos y evitan sorpresas. Cumbre WhatsApp Hub debe presentarse como capa ERP con API oficial, no como promesa de mensajes ilimitados ni como BSP genérico.</p><!-- /wp:paragraph --><!-- wp:html --><div class="cumbre-limit-table" role="table" aria-label="Costos y alternativas de WhatsApp Business API"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Capa</span><span>Quién la cobra</span><span>Qué incluye</span><span>Qué debe quedar claro</span></div><div class="cumbre-limit-row" role="row"><span>Consumo Meta</span><span>Meta / cuenta del cliente</span><span>Conversaciones, plantillas y categorías según reglas vigentes</span><span>No es costo fijo de Cumbre y puede cambiar por política Meta</span></div><div class="cumbre-limit-row" role="row"><span>Plataforma Cumbre</span><span>GEMA/Cumbre</span><span>ERP, módulos conectados, reglas, panel, webhooks y trazabilidad</span><span>Se cotiza como software e implementación, no como fee oculto por mensaje</span></div><div class="cumbre-limit-row" role="row"><span>BSP / proveedor externo</span><span>Proveedor elegido</span><span>Acceso, número, bandeja o infraestructura según contrato</span><span>Debe revisarse factura, moneda, soporte local y condiciones</span></div><div class="cumbre-limit-row" role="row"><span>Implementación</span><span>GEMA o implementador</span><span>Business Manager, WABA, plantillas, opt-in, webhooks, pruebas y capacitación</span><span>Es trabajo inicial separado de consumo operativo</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>Factura y moneda</strong><span>Para PyMEs argentinas importa si el proveedor factura en pesos, dólares, con factura A y soporte local.</span></article><article class="cumbre-proof-card"><strong>API vs app común</strong><span>La API oficial permite multiagente, plantillas, webhooks e integraciones; la app común sirve para uso simple pero no para operación ERP escalable.</span></article><article class="cumbre-proof-card"><strong>No spam</strong><span>WhatsApp Hub requiere opt-in, plantillas aprobadas, frecuencia responsable y trazabilidad de consentimiento.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_cumbre_api_tutorials_page_definition(): array {
	return array(
		'title'               => 'Tutoriales API Cumbre',
		'seo_title'           => 'Tutoriales API Cumbre | Guías para conectar integraciones ERP',
		'meta_description'    => 'Guías paso a paso para conectar Mercado Libre, Mercado Pago, WooCommerce, Google Merchant, ARCA, WhatsApp Business, WordPress y otras APIs con Cumbre ERP.',
		'keywords'            => 'tutoriales API ERP, conectar Mercado Libre con ERP, conectar Mercado Pago con ERP, WooCommerce ERP, Google Merchant ERP, WhatsApp Business API, credenciales API seguras, webhooks Cumbre, integraciones ERP Cumbre',
		'kicker'              => 'Integraciones externas · APIs · Credenciales seguras · Checklists guiados',
		'description'         => 'Conectá tus plataformas externas a Cumbre con guías claras, seguras y paso a paso.',
		'primary_cta_label'   => 'Ver integraciones disponibles',
		'primary_cta_url'     => '/erp-cumbre/tutoriales-api-cumbre/#integraciones',
		'secondary_cta_label' => 'Solicitar configuración asistida',
		'secondary_cta_url'   => '/contacto',
		'modules_title'       => 'Guías guiadas para cada integración',
		'list_title'          => 'Seguridad, permisos y validación de credenciales',
		'links_title'         => 'Cómo Tutoriales API se conecta con ERP Cumbre',
		'faq_title'           => 'Preguntas frecuentes sobre Tutoriales API Cumbre',
		'bottom_cta_title'    => 'Integraciones potentes, configuración más simple',
		'bottom_cta_copy'     => 'Cumbre permite que una PyME, comercio o empresa conecte plataformas críticas sin depender siempre de técnicos externos. Cuando una integración es compleja, recomendamos configuración asistida para evitar errores.',
		'modules'             => array(
			array( 'El problema: APIs poderosas, configuración compleja', 'Muchas plataformas requieren crear aplicaciones, activar permisos, generar tokens, configurar webhooks o cargar certificados. Un error puede bloquear ventas, cobros, facturación, stock o notificaciones.' ),
			array( 'Tutoriales dentro del panel', 'Cada módulo que necesita una API externa incluye pasos accionables, permisos requeridos, credenciales necesarias, prueba de conexión, errores frecuentes y recomendaciones de seguridad.' ),
			array( 'Mercado Libre', 'Guías para ventas, publicaciones, stock, precios, billing info, analytics, permisos, tokens y pruebas de sincronización.' ),
			array( 'Mercado Pago', 'Tutoriales para cobros, links de pago, webhooks, conciliación, estados de pago y separación entre modo test y producción.' ),
			array( 'WooCommerce y WordPress', 'Conexión de productos, stock, precios, órdenes, formularios y leads hacia CRM Cumbre o módulos comerciales.' ),
			array( 'ARCA, Google Merchant y WhatsApp Business', 'Acompañamiento para certificados, CUIT, puntos de venta, emisión fiscal, feeds, diagnósticos, alertas, vencimientos y aprobaciones.' ),
		),
		'list'                => array(
			'Subtítulo comercial: Cumbre te acompaña para obtener APIs, configurar permisos, validar credenciales y activar integraciones sin guardar claves sensibles en claro.',
			'No es solo documentación: los tutoriales API de Cumbre están conectados al panel del cliente y al Panel de Control. El sistema sabe qué pasos completaste, qué credencial está asociada, cuándo fue validada la conexión y qué error apareció si algo falló.',
			'Seguridad: Cumbre no guarda tokens, certificados, claves privadas ni secretos en bases de datos visibles. El sistema utiliza referencias seguras tipo credencial_ref y recomienda Secret Manager o mecanismos equivalentes.',
			'Guardrails: no se guardan secretos en Firestore, no se piden claves por chat, se separa modo test de producción, se recomienda rotación de credenciales y se valida desde backend antes de activar automatizaciones.',
			'Estados de integración: conectado, pendiente de validación, error, requiere reautorización o configuración asistida recomendada.',
			'Plataformas iniciales: Mercado Libre, Mercado Pago, WooCommerce, Google Merchant, ARCA, WhatsApp Business, WordPress y nuevas APIs según el módulo contratado.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_api_tutorials_custom_sections(),
		'links'               => array(
			array( 'ERP Cumbre', '/erp-cumbre', 'Ver el ecosistema completo donde se activan las integraciones.' ),
			array( 'Cumbre Stock', '/erp-cumbre/cumbre-stock', 'Conectar stock con Mercado Libre, WooCommerce y canales futuros.' ),
			array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'Configurar Mercado Pago, links de pago, webhooks y conciliación.' ),
			array( 'Cumbre Facturador ARCA', '/erp-cumbre/cumbre-facturador-arca', 'Preparar certificados, CUIT, puntos de venta y emisión fiscal controlada.' ),
			array( 'Cumbre CRM', '/cumbre-crm', 'Conectar WordPress, formularios, leads y automatizaciones comerciales.' ),
			array( 'Integraciones GEMA', '/integraciones', 'Ver el enfoque general de integraciones, APIs y automatizaciones.' ),
		),
		'faq'                 => array(
			array( 'Qué son los Tutoriales API Cumbre?', 'Son guías paso a paso conectadas al panel de Cumbre para obtener credenciales, configurar permisos, validar conexiones y activar integraciones externas con menos fricción técnica.' ),
			array( 'Qué plataformas cubren?', 'Inicialmente Mercado Libre, Mercado Pago, WooCommerce, Google Merchant, ARCA, WhatsApp Business, WordPress y otras plataformas según el módulo contratado.' ),
			array( 'Cumbre guarda mis claves en claro?', 'No. La arquitectura evita guardar tokens, certificados, claves privadas o secretos en bases de datos visibles. Se usan referencias seguras tipo credencial_ref y se recomienda Secret Manager o mecanismos equivalentes.' ),
			array( 'Puedo cargar claves por chat?', 'No es recomendable y el sistema lo desalienta. Las credenciales deben cargarse o autorizarse por mecanismos seguros, nunca pegarse en chats, tickets o documentos expuestos.' ),
			array( 'Cómo se valida una integración?', 'Cumbre prueba la conexión desde backend y deja el estado como conectado, pendiente de validación, error o requiere reautorización, según respuesta de la plataforma externa.' ),
			array( 'Qué pasa si una integración es compleja?', 'El panel recomienda configuración asistida para evitar errores en permisos, webhooks, certificados, tokens o modo producción.' ),
		),
	);
}

function gema_sovereign_build_cumbre_api_tutorials_custom_sections(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-api-section","layout":{"type":"constrained"}} --><section id="integraciones" class="wp-block-group gema-content-section cumbre-api-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Flujo guiado</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">No dejamos al usuario solo frente a una pantalla técnica</h2><!-- /wp:heading --><!-- wp:html --><div class="cumbre-api-flow"><article><span>01</span><h3>Elegís plataforma</h3><p>Mercado Libre, Mercado Pago, WooCommerce, Google Merchant, ARCA, WhatsApp Business, WordPress u otra API disponible.</p></article><article><span>02</span><h3>Seguís checklist</h3><p>Cumbre muestra cuenta requerida, permisos, pantallas, credenciales, webhooks, certificados y pruebas necesarias.</p></article><article><span>03</span><h3>Autorizás seguro</h3><p>Cargás o autorizás la credencial por un mecanismo seguro, sin pegar claves en chats ni guardarlas visibles en claro.</p></article><article><span>04</span><h3>Validación backend</h3><p>El sistema prueba la conexión desde backend antes de activar automatizaciones o sincronizaciones críticas.</p></article><article><span>05</span><h3>Estado claro</h3><p>La integración queda conectada, pendiente, con error, requiere reautorización o recomienda configuración asistida.</p></article></div><div class="cumbre-payment-method-grid" aria-label="Plataformas con tutoriales API Cumbre"><span>Mercado Libre</span><span>Mercado Pago</span><span>WooCommerce</span><span>Google Merchant</span><span>ARCA</span><span>WhatsApp Business</span><span>WordPress</span><span>Webhooks</span><span>Secret Manager</span><span>OAuth</span><span>Tokens</span><span>Certificados</span></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>Sin secretos en claro</strong><span>No se guardan tokens, certificados, claves privadas ni secretos en bases de datos visibles; se usan referencias seguras.</span></article><article class="cumbre-proof-card"><strong>Test y producción separados</strong><span>Los tutoriales distinguen pruebas, permisos, webhooks, credenciales productivas y activación asistida cuando hace falta.</span></article><article class="cumbre-proof-card"><strong>Auditoría de errores</strong><span>El panel conserva estado, último test, error recibido, credencial asociada y recomendación de próxima acción.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_cumbre_crm_page_definition(): array {
	return array(
		'title'             => 'Cumbre CRM: el tronco comercial de tu empresa',
		'seo_title'         => 'Cumbre CRM | CRM para PyMEs argentinas con WhatsApp, presupuestos y ERP',
		'meta_description'  => 'CRM para PyMEs argentinas B2B: leads, WhatsApp, presupuestos, catálogo, stock, cobros y próximas acciones conectadas al ERP Cumbre.',
		'keywords'          => 'CRM para PyMEs argentinas, CRM WhatsApp para PyMEs, CRM con presupuestos, CRM con catálogo y stock, CRM conectado al ERP, CRM con facturación electrónica ARCA, CRM para ventas B2B, CRM con asistente de IA, software de gestión comercial para PyMEs',
		'kicker'            => 'CRM para PyMEs argentinas · Ventas B2B · Presupuestos · Catálogo · Cobros',
		'description'       => 'De la consulta al presupuesto, del presupuesto al cobro, y del cobro a la factura: Cumbre CRM ayuda a PyMEs argentinas B2B a ordenar leads, clientes, presupuestos, cobros y próximas acciones comerciales en un solo flujo guiado.',
		'primary_cta_label' => 'Solicitar demo',
		'primary_cta_url'   => '/contacto',
		'secondary_cta_label' => 'Probar 14 días',
		'secondary_cta_url' => '/erp/precios',
		'visual'            => array(
			'src' => '/wp-content/themes/gema-sovereign/assets/seo-visuals/cumbre-crm-og.png',
			'alt' => 'Mockup de Cumbre CRM para PyMEs argentinas con leads, presupuestos, catálogo, stock y cobros conectados',
		),
		'modules_title'     => 'CRM para ventas B2B conectado a la operación',
		'list_title'        => 'Funciones y planes de Cumbre CRM',
		'links_title'       => 'Conexiones del CRM dentro de Cumbre ERP',
		'faq_title'         => 'Preguntas frecuentes sobre CRM para PyMEs argentinas',
		'bottom_cta_title'  => 'Solicitá una demo de Cumbre CRM o probá el flujo durante 14 días',
		'bottom_cta_copy'   => 'Validamos tu caso antes de prometer integraciones críticas: ventas, catálogo, stock, cobros y facturación ARCA se implementan con acompañamiento y alcance claro.',
		'modules'           => array(
			array( 'El problema: leads dispersos', 'Consultas que llegan por WhatsApp, web, email o redes quedan repartidas entre personas, planillas y chats sin prioridad clara.' ),
			array( 'Presupuestos sin seguimiento', 'Muchas PyMEs cotizan en USD o ARS, pero después no tienen trazabilidad de estado, vencimiento, próxima acción o cobro esperado.' ),
			array( 'Productos, precios y stock desconectados', 'El equipo comercial vende con información incompleta cuando Catálogo, precios, IVA, stock y proveedores no están conectados al presupuesto.' ),
			array( 'La solución: CRM como tronco', 'Cumbre CRM centraliza leads, clientes, pipeline, historial comercial, scoring básico, siguiente mejor acción, presupuestos bimonetarios, cobros conectados y Vista Hoy.' ),
			array( 'CRM con Catálogo y stock', 'Cumbre Catálogo aporta productos, servicios, precios, IVA, stock y proveedores para presupuestar con información consistente y evitar ventas imposibles.' ),
			array( 'CRM con cobros y facturación', 'Cumbre Cobros registra medios de pago y cobros vinculados a la oportunidad. La facturación ARCA se comunica como demo o piloto controlado con implementación asistida.' ),
			array( 'CRM con asistente de IA', 'El asistente guiado acompaña al usuario con recomendaciones por contexto, checklist de acciones y ayuda para acelerar aprendizaje.' ),
			array( 'Vista Hoy', 'Una vista diaria ayuda a priorizar leads calientes, tareas vencidas, presupuestos por vencer, cobros esperados y oportunidades pendientes.' ),
		),
		'list'              => array(
			'Funciones principales: captura de leads desde web/WordPress, pipeline comercial, scoring IA básico, siguiente mejor acción, presupuestos en USD/ARS, IVA por línea/alícuota, relación con Catálogo, eventos e historial comercial y Vista Hoy.',
			'Planes de Cumbre CRM: Starter para ordenar ventas y presupuestos básicos; Growth para PyMEs que necesitan Catálogo, stock y seguimiento; Pro para equipos comerciales con más volumen y automatización; AI/FDE para operaciones con alto volumen, IA avanzada e implementación asistida.',
			'Trial de 14 días: el objetivo es llegar rápido al momento de valor, cargando Catálogo, creando un lead, emitiendo un presupuesto, registrando un cobro y viendo Vista Hoy.',
			'Los datos cargados durante la prueba se preservan al pasar a plan pago. Algunas funciones avanzadas pueden estar bloqueadas durante el trial.',
			'Demo comercial disponible. Los flujos con facturación ARCA real requieren piloto controlado, validación fiscal previa e implementación asistida.',
		),
		'custom_sections'   => gema_sovereign_build_cumbre_crm_decision_section(),
		'links'             => array(
			array( 'Solicitar demo comercial', '/contacto', 'Evaluar si Cumbre CRM encaja con tu operación comercial actual.' ),
			array( 'ERP Cumbre', '/erp-cumbre', 'Ver el producto completo y su estado de demo comercial / beta técnica controlada.' ),
			array( 'Cumbre Catálogo', '/cumbre/catalogo', 'Productos, servicios, precios, IVA, stock y proveedores conectados al presupuesto.' ),
			array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'Medios de pago y registro de cobros conectados al flujo comercial.' ),
			array( 'Panel de Control', '/cumbre/panel', 'Planes, límites, trial, módulos activos y activación asistida.' ),
			array( 'Asistente Guiado', '/cumbre/asistente', 'Onboarding contextual, checklist y próxima mejor acción por módulo.' ),
		),
		'faq'               => array(
			array( 'Qué es Cumbre CRM?', 'Cumbre CRM es el tronco comercial de Cumbre ERP. Ordena consultas, leads, clientes, presupuestos, cobros y próximas acciones en un flujo conectado con Catálogo, Stock, Cobros y Facturación en piloto controlado.' ),
			array( 'Cumbre CRM sirve para PyMEs argentinas B2B?', 'Sí. Está pensado para PyMEs argentinas B2B que reciben consultas, cotizan en USD o ARS, manejan productos o servicios y necesitan conectar ventas con cobros, stock y facturación.' ),
			array( 'Cumbre CRM incluye presupuestos?', 'Sí. El flujo contempla presupuestos bimonetarios en USD/ARS, relación con Catálogo, IVA por línea o alícuota y seguimiento comercial de estado y próxima acción.' ),
			array( 'Cumbre CRM se conecta con Catálogo y stock?', 'Sí. Cumbre Catálogo funciona como fuente de productos, servicios, precios, IVA, stock y proveedores para que el equipo comercial presupueste con información consistente.' ),
				array( 'Cumbre CRM tiene facturación electrónica ARCA?', 'La facturación ARCA se comunica como demo comercial o piloto fiscal controlado. No se promete activación automática sin validación fiscal, técnica y operativa previa.' ),
			array( 'Hay prueba gratis de Cumbre CRM?', 'Sí. Cumbre CRM contempla prueba de 14 días. Los datos cargados se preservan al pasar a plan pago, aunque algunas funciones avanzadas pueden estar bloqueadas durante el trial.' ),
		),
	);
}

function gema_sovereign_build_cumbre_crm_decision_section(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-crm-decision-section","layout":{"type":"constrained"}} --><section id="crm-whatsapp-vs-erp" class="wp-block-group gema-content-section cumbre-crm-decision-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Comparativa de decisión</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">CRM tradicional, CRM WhatsApp o CRM conectado al ERP</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"gema-section-copy"} --><p class="gema-section-copy">El estudio competitivo mostró que muchas búsquedas de CRM para PyMEs mezclan ventas, WhatsApp, agenda, multiagente, IA y precios. Cumbre CRM se posiciona como tronco comercial conectado a operación, no como bandeja aislada de chats.</p><!-- /wp:paragraph --><!-- wp:html --><div class="cumbre-limit-table" role="table" aria-label="Comparativa CRM tradicional vs CRM WhatsApp vs CRM conectado al ERP"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Opción</span><span>Conviene cuando</span><span>Límite habitual</span><span>Enfoque Cumbre</span></div><div class="cumbre-limit-row" role="row"><span>CRM tradicional</span><span>El equipo necesita pipeline, tareas y oportunidades</span><span>Puede quedar lejos de stock, cobros y facturación local</span><span>CRM conectado a Catálogo, Cobros, Stock y Facturador</span></div><div class="cumbre-limit-row" role="row"><span>CRM WhatsApp</span><span>La mayoría de consultas llega por chat</span><span>Puede ordenar conversaciones pero no la operación completa</span><span>WhatsApp Hub con opt-in y contexto ERP por módulo</span></div><div class="cumbre-limit-row" role="row"><span>CRM conectado al ERP</span><span>La venta necesita presupuesto, productos, cobro y trazabilidad</span><span>Requiere implementación asistida para datos y procesos</span><span>Cumbre CRM como tronco comercial del ecosistema</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>WhatsApp no alcanza solo</strong><span>Una bandeja multiagente ayuda, pero la ventaja aparece cuando el chat conecta lead, presupuesto, producto, stock, cobro y próxima acción.</span></article><article class="cumbre-proof-card"><strong>Costo total claro</strong><span>Hay que separar abono del CRM, costo de WhatsApp/Meta si aplica, implementación, usuarios e integraciones reales.</span></article><article class="cumbre-proof-card"><strong>Derivación humana</strong><span>La IA asiste seguimiento y respuesta, pero ventas complejas, reclamos y datos sensibles requieren responsable humano.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_cumbre_negocios_page_definition(): array {
	return array(
		'title'               => 'Cumbre ERP Negocios: sistema POS y gestión para comercios minoristas',
		'seo_title'           => 'Cumbre ERP Negocios | Sistema POS para kioscos, almacenes y comercios',
		'meta_description'    => 'Sistema POS para comercios argentinos: caja, stock, códigos de barra, precios, cierre diario, reposición y facturación ARCA asistida.',
		'keywords'            => 'sistema para kioscos, sistema para kiosco Argentina, sistema para almacenes, software para mercados, sistema POS para comercios, software POS Argentina, sistema para restaurantes chicos, sistema para casa de comidas, control de stock para kioscos, sistema de caja para negocios, software de gestión para comercios argentinos, ERP económico para comercios, programa para almacén, sistema para verdulería, sistema para carnicería, control de caja comercio, sistema con stock y caja, sistema para depósito chico',
		'kicker'              => 'POS económico · Caja · Stock · Precios · Reposición diaria',
		'description'         => 'Una solución simple y económica para kioscos, almacenes, mercados, restaurantes chicos, casas de comida y depósitos. Vendé, controlá caja, stock, precios y reposición diaria desde una sola plataforma guiada.',
		'primary_cta_label'   => 'Solicitar demo',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Probar 14 días',
		'secondary_cta_url'   => '/erp/precios',
		'visual'              => array(
			'src' => '/wp-content/themes/gema-sovereign/assets/seo-visuals/cumbre-erp-negocios-og.png',
			'alt' => 'Mockup de Cumbre ERP Negocios como sistema POS con caja, stock, precios y reposición para comercios minoristas argentinos',
		),
		'modules_title'       => 'Sistema POS para vender, controlar caja, stock y precios',
		'list_title'          => 'Planes, límites, submódulos y add-ons',
		'links_title'         => 'Cómo se conecta Cumbre ERP Negocios con el ecosistema Cumbre',
		'faq_title'           => 'Preguntas frecuentes sobre sistema POS para comercios minoristas',
		'bottom_cta_title'    => 'Empezá con lo esencial y sumá módulos cuando tu comercio crezca',
		'bottom_cta_copy'     => 'Cumbre ERP Negocios no se presenta como ERP empresarial grande: es el paquete económico de entrada para ordenar mostrador, caja, stock, precios y reposición con prueba de 14 días.',
		'modules'             => array(
			array( 'El problema: caja desordenada', 'Muchos comercios cierran el día con diferencias, ventas anotadas a mano, referencias de transferencia separadas y poca visibilidad de efectivo, turnos o movimientos.' ),
			array( 'Stock sin control', 'Kioscos, almacenes, mercados y depósitos simples suelen trabajar con cuadernos, planillas o sistemas aislados que no avisan faltantes ni stock mínimo.' ),
			array( 'Precios y márgenes difíciles de sostener', 'Los cambios de precios manuales, listas de proveedores y productos de alta rotación pueden dejar márgenes bajos sin que el dueño lo vea a tiempo.' ),
			array( 'La solución: tronco operativo de mostrador', 'Cumbre ERP Negocios funciona como tronco operativo para comercios de venta inmediata: POS simple, ventas rápidas, apertura/cierre de caja, productos, precios, código de barras, stock básico, compras simples y reporte diario.' ),
			array( 'Diferencia con Cumbre CRM', 'Cumbre CRM es para ventas consultivas, leads, presupuestos y seguimiento B2B. Cumbre ERP Negocios es para mostrador, caja y rotación diaria. Comparten plataforma, pero tienen experiencias distintas.' ),
			array( 'Cumbre Catálogo como fuente única', 'Productos, precios, IVA, stock base y proveedores se ordenan desde Catálogo para que el comercio venda con información consistente y pueda escalar por etapas.' ),
			array( 'Vista Hoy del Negocio', 'La pantalla diaria muestra caja abierta/cerrada, ventas del día, margen estimado, diferencias de caja, productos bajo mínimo, reposición sugerida, top vendidos y acciones recomendadas.' ),
			array( 'Asistente guiado', 'El sistema acompaña paso a paso: cargar productos, abrir caja, registrar la primera venta, revisar stock mínimo, cerrar caja y ver la Vista Hoy del Negocio.' ),
			array( 'Trial y límites claros', 'La prueba gratis dura 14 días y conserva datos al pasar a pago. Al acercarse a límites, el sistema avisa antes de bloquear nuevas altas o funciones premium.' ),
			array( 'Qué no promete el paquete base', 'No es un ERP empresarial completo. Multiempresa, Multi-CUIT avanzado, integraciones a medida, stock complejo y facturación ARCA productiva se tratan como add-ons, planes superiores o implementación asistida.' ),
		),
		'list'                => array(
			'Promesa principal: empezá con lo esencial para ordenar tu comercio. Sumá usuarios, cajas, locales y submódulos cuando tu negocio crezca.',
			'Negocios Kiosco Express: venta rápida, productos favoritos, promos simples, carga rápida y reporte diario simplificado. Submódulo USD 9 lista / USD 7 promo.',
			'Negocios Mercado / Almacén: productos por vencer, reposición sugerida, ofertas simples, margen por categoría y control de precios por proveedor. Submódulo USD 19 lista / USD 15 promo.',
			'Negocios Resto: comandas, mesas, cocina, take away / delivery básico, platos, combos, insumos, recetas simples, mozo/turno, propinas y merma básica. Submódulo USD 29 lista / USD 23 promo.',
			'Negocios Depósito: remitos, recibos, picking simple, ingreso/egreso de mercadería, transferencias internas, stock por ubicación simple y preparación de pedidos. Submódulo USD 29 lista / USD 23 promo.',
			'Negocios Panadería / Comidas: producción diaria, recetas simples, insumos, merma, venta por peso/unidad, sobrante del día y pedidos anticipados. Submódulo USD 19 lista / USD 15 promo.',
			'Incluido en paquete base: efectivo/manual, registro de caja, referencia manual de transferencia, stock básico, Vista diaria y Asistente guiado.',
			'Add-ons disponibles: QR/link de pago, Cumbre Cobros, conciliación digital, Facturador ARCA controlado, integraciones de pasarela y Asistente IA Plus.',
			'Promo de lanzamiento 20% OFF por tiempo limitado, redondeada al dólar entero.',
			'Negocios Micro: USD 19 lista / USD 15 promo. 1 usuario, 1 caja, 1 local, 300 productos, 100 comprobantes/mes y facturación sugerida hasta USD 1.500/mes.',
			'Negocios Base: USD 29 lista / USD 23 promo. 1 usuario, 1 caja, 1 local, 1.000 productos, 300 comprobantes/mes y facturación sugerida hasta USD 3.000/mes.',
			'Negocios Plus: USD 49 lista / USD 39 promo. 2 usuarios, 1 caja, 1 local, 3.000 productos, 800 comprobantes/mes y facturación sugerida hasta USD 8.000/mes.',
			'Negocios Pro: USD 79 lista / USD 63 promo. 4 usuarios, 2 cajas, 1 local, 1 depósito, 8.000 productos, 2.000 comprobantes/mes y facturación sugerida hasta USD 20.000/mes.',
			'Negocios Multi: USD 119 lista / USD 95 promo. 6 usuarios, 3 cajas, 2 locales, 1 depósito, 15.000 productos, 5.000 comprobantes/mes y facturación sugerida hasta USD 50.000/mes.',
			'Extras: usuario adicional USD 7 / USD 6 promo; caja adicional USD 12 / USD 10 promo; local adicional USD 29 / USD 23 promo; depósito adicional USD 19 / USD 15 promo; bloque extra 5.000 productos USD 9 / USD 7 promo.',
			'Add-ons: Facturador ARCA controlado USD 19 / USD 15 promo; Cumbre Cobros USD 15 / USD 12 promo; Asistente IA Plus USD 19 / USD 15 promo.',
			'Trial y upgrade: al 80% de uso el sistema muestra alerta; al 100% puede aplicarse una gracia operativa corta. Luego se bloquean nuevas altas o funciones premium, pero se mantiene lectura, cierre de caja y exportación básica. Nunca se borran datos por superar límites o vencer trial.',
			'Ejemplos del asistente: “Abrí la caja antes de vender”, “Este producto está por debajo del stock mínimo”, “Revisá el margen de productos de alta rotación”, “Cerrá caja al finalizar el turno” y “Conviene preparar reposición para mañana”.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_negocios_pos_flow_section(),
		'links'               => array(
			array( 'Solicitar demo comercial', '/contacto', 'Hablar con GEMA para elegir plan, submódulo y prueba de 14 días.' ),
			array( 'ERP Cumbre', '/erp-cumbre', 'Ver el ecosistema completo y cómo se escala desde Negocios hacia otros módulos.' ),
			array( 'Cumbre Catálogo', '/cumbre/catalogo', 'Productos, precios, IVA, stock base y proveedores como fuente única.' ),
			array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'QR/link de pago, conciliación y cobros digitales como add-on.' ),
			array( 'Cumbre CRM', '/cumbre-crm', 'Para empresas con ventas consultivas, leads, presupuestos y seguimiento B2B.' ),
			array( 'Panel de Control', '/cumbre/panel', 'Planes, límites, trial, módulos activos y crecimiento por etapas.' ),
		),
		'faq'                 => array(
			array( 'Qué es Cumbre ERP Negocios?', 'Es el paquete económico de entrada a Cumbre para comercios minoristas argentinos. Permite vender, controlar caja, stock, precios, reposición diaria y operación básica desde una plataforma guiada.' ),
			array( 'Sirve para kioscos y almacenes?', 'Sí. Está pensado para kioscos, almacenes, despensas, mercados, minimercados, verdulerías, carnicerías y comercios de alta rotación.' ),
			array( 'Sirve para restaurantes o casas de comida?', 'Sí. Puede sumar el submódulo Negocios Resto o Panadería / Comidas para comandas, mesas, cocina, combos, insumos, recetas simples, merma y venta por peso o unidad.' ),
			array( 'Incluye control de caja?', 'Sí. El paquete base incluye registro de caja, efectivo/manual, referencia manual de transferencia, apertura, cierre y vista diaria.' ),
			array( 'Incluye stock?', 'Sí. Incluye stock básico, productos, precios, código de barras, stock mínimo y alertas simples de reposición. El stock avanzado complejo se evalúa en planes superiores o add-ons.' ),
			array( 'Puedo sumar usuarios o cajas?', 'Sí. Se pueden sumar usuarios, cajas, locales, depósitos, bloques de productos y submódulos según crecimiento.' ),
			array( 'Tiene prueba gratis?', 'Sí. La prueba gratis dura 14 días y está pensada para cargar productos, abrir caja, registrar ventas, revisar stock y cerrar el día.' ),
			array( 'Qué pasa con mis datos si paso a un plan pago?', 'Los datos se conservan al pasar a pago. Nunca se borran datos por superar límites o vencer el trial.' ),
			array( 'Incluye facturación ARCA?', 'El paquete puede sumar Facturador ARCA controlado como add-on. La facturación real requiere piloto controlado, validación e implementación asistida.' ),
			array( 'Cuál es la diferencia con Cumbre CRM?', 'Cumbre CRM es para ventas consultivas con leads, presupuestos y seguimiento. Cumbre ERP Negocios es para comercios de mostrador donde la venta es inmediata y el foco es caja, stock, precios y reposición.' ),
		),
	);
}

function gema_sovereign_build_cumbre_negocios_pos_flow_section(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-negocios-pos-section","layout":{"type":"constrained"}} --><section id="flujo-pos-comercio" class="wp-block-group gema-content-section cumbre-negocios-pos-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Flujo de mostrador</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Del código de barras al cierre de caja, con stock y reposición visibles</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"gema-section-copy"} --><p class="gema-section-copy">Las páginas POS que mejor compiten muestran el día real del comercio. Por eso Cumbre ERP Negocios explicita el flujo completo: venta, medio de pago, caja, stock, reposición, cierre y facturación asistida cuando corresponde.</p><!-- /wp:paragraph --><!-- wp:html --><div class="cumbre-compras-flow"><article><span>01</span><h3>Abrir caja</h3><p>Usuario, turno, efectivo inicial, caja asignada y permisos del comercio.</p></article><article><span>02</span><h3>Vender rápido</h3><p>Búsqueda, favoritos, código de barras, promociones simples y medios de pago habilitados.</p></article><article><span>03</span><h3>Actualizar stock</h3><p>Salida de productos, alerta de mínimo, productos de alta rotación y reposición sugerida.</p></article><article><span>04</span><h3>Controlar precios</h3><p>Lista por proveedor, margen por categoría, cambios de costo y productos sensibles a inflación.</p></article><article><span>05</span><h3>Cerrar el día</h3><p>Cierre de caja, diferencias, ventas, cobros, comprobantes, reporte diario y próximas acciones.</p></article></div><div class="cumbre-limit-table" role="table" aria-label="Checklist para comprar sistema POS para comercios"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Rubro</span><span>Dolor típico</span><span>Función clave</span><span>Módulo recomendado</span></div><div class="cumbre-limit-row" role="row"><span>Kiosco</span><span>Muchos SKUs y precios cambiantes</span><span>Código de barras, favoritos y reposición</span><span>Negocios Kiosco Express</span></div><div class="cumbre-limit-row" role="row"><span>Almacén / mercado</span><span>Vencimientos, margen y categorías</span><span>Stock mínimo, ofertas y precios por proveedor</span><span>Negocios Mercado</span></div><div class="cumbre-limit-row" role="row"><span>Resto / comida</span><span>Comandas, combos, insumos y merma</span><span>Mesas, take away, cocina y recetas simples</span><span>Negocios Resto</span></div><div class="cumbre-limit-row" role="row"><span>Depósito chico</span><span>Ingreso, egreso y preparación</span><span>Remitos, picking simple y ubicaciones</span><span>Negocios Depósito</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>No es ERP pesado</strong><span>El foco inicial es mostrador, caja, stock básico, precios y cierre diario; administración avanzada se suma por etapas.</span></article><article class="cumbre-proof-card"><strong>ARCA asistido</strong><span>La facturación real se activa con validación de CUIT, punto de venta, régimen y alcance operativo.</span></article><article class="cumbre-proof-card"><strong>Datos preservados</strong><span>La prueba permite cargar productos y operar flujo básico sin perder datos al pasar a plan pago.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_make_cumbre_subdomain_page( string $module_name, string $subdomain, string $kicker, string $description ): array {
	$host = $subdomain . '.gema-digital.com';
	return array(
		'title'       => $module_name . ' | Landing, planes y pagos',
		'kicker'      => 'Portal preparado: ' . $host,
		'description' => $description . ' Esta landing queda lista para operar como portal modular en ' . $host . ' cuando DNS y servidor acepten el subdominio.',
		'modules'     => array(
			array( 'Landing comercial', 'Propuesta de valor, casos de uso, CTA de diagnóstico y conexión con el ecosistema ERP Cumbre.' ),
			array( 'Planes por módulo', 'Base editable para plan Inicial, PyME y Empresa. En CRM ya existen tiers Starter, Growth, Pro y AI/FDE con límites de usuarios, leads, catálogo e ingestas.' ),
			array( 'Pagos y activación', 'Conexión prevista con Gema Pagos base para suscripciones y Cumbre Cobros para cobros de la empresa hacia sus clientes.' ),
		),
		'list'        => array(
			'Subdominio previsto: https://' . $host,
			'URL interna actual: /cumbre/' . $subdomain,
			'Cada portal tendrá copy, planes, CTAs, preguntas frecuentes, pagos, trial de 14 días y rutas de contacto propias del módulo.',
			'Antes de publicar el subdominio real falta apuntar DNS, configurar vhost/wildcard SSL y validar canonical/SEO.',
			'CRM ya tiene planes internos sugeridos: Starter $19.900 + IVA, Growth $39.900 + IVA, Pro $69.900 + IVA y AI/FDE $119.900 + IVA.',
		),
		'links'       => array(
			array( 'ERP Cumbre', '/erp-cumbre', 'Portal oficial y mapa general de módulos.' ),
			array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'Base de cobros, links editables, pagos nacionales/globales y conciliación.' ),
			array( 'Plataforma de pagos', '/pagos', 'Medios de pago, seguridad, webhooks y proveedores.' ),
			array( 'Pagos Argentina', '/pagos/argentina', 'Transferencia, QR, MODO, Mercado Pago, Nave, tarjetas y comprobantes.' ),
			array( 'Contacto comercial', '/contacto', 'Diagnóstico humano para definir alcance y próximos pasos.' ),
		),
		'faq'         => array(
			array( 'El subdominio ya está activo?', 'La landing interna queda publicada. El subdominio real requiere DNS, wildcard SSL y configuración del servidor antes de apuntarlo.' ),
			array( 'Los planes ya tienen precio?', 'No. Quedan estructurados por alcance. Los valores finales se definen después del diagnóstico comercial y la configuración de pagos.' ),
			array( 'Se puede cobrar desde esta landing?', 'Queda preparada para conectarse con Cumbre Cobros y la plataforma de pagos cuando vinculemos las cuentas reales de GEMA.' ),
		),
	);
}

function gema_sovereign_get_cumbre_subdomain_page_definitions(): array {
	$catalog = gema_sovereign_get_cumbre_subdomain_catalog();
	$pages = array(
		'cumbre' => array(
			'title'       => 'Portales modulares ERP Cumbre',
			'kicker'      => 'Subdominios Cumbre preparados',
			'description' => 'Mapa de portales modulares de ERP Cumbre. Cada módulo tendrá landing, planes, pagos, diagnóstico e integración con el asistente IA.',
			'modules'     => array(
				array( 'Landings por módulo', 'Cada subdominio tendrá página comercial específica y URL interna publicada bajo /cumbre/{modulo}.' ),
				array( 'Planes y pagos', 'Cada portal queda preparado para mostrar planes y conectarse con Cumbre Cobros y la plataforma de pagos.' ),
				array( 'Asistente IA', 'El asistente podrá recomendar el portal correcto según necesidad, rubro, cobros, stock, facturación o automatización.' ),
			),
			'list'        => array(
				'Primero se publican URLs internas estables; luego se apuntan subdominios reales con DNS y SSL.',
				'La estrategia evita esperar DNS para avanzar con SEO, copy, planes y pagos por módulo.',
				'Cada portal se interconecta con ERP Cumbre, pagos, Cumbre Cobros y contacto comercial.',
			),
			'links'       => array_map(
				static fn( $item ) => array( $item[0], '/cumbre/' . $item[1], $item[2] . ' - ' . $item[3] ),
				array_values( $catalog )
			),
			'faq'         => array(
				array( 'Por qué usar subdominios por módulo?', 'Permite mensajes, campañas, SEO, planes y pagos específicos por solución sin mezclar audiencias.' ),
				array( 'Qué falta para activar los subdominios reales?', 'DNS, wildcard SSL, configuración del servidor y decisión de canonical/SEO por portal.' ),
			),
		),
	);

	foreach ( $catalog as $item ) {
		$pages[ 'cumbre/' . $item[1] ] = gema_sovereign_make_cumbre_subdomain_page( $item[0], $item[1], $item[2], $item[3] );
	}

	$pages['cumbre/crm'] = gema_sovereign_get_cumbre_crm_page_definition();
	$pages['cumbre-crm'] = gema_sovereign_get_cumbre_crm_page_definition();
	$pages['cumbre/negocios'] = gema_sovereign_get_cumbre_negocios_page_definition();
	$pages['cumbre-erp-negocios'] = gema_sovereign_get_cumbre_negocios_page_definition();
	$pages['erp-cumbre/cumbre-facturador-arca'] = gema_sovereign_get_cumbre_facturador_page_definition();
	$pages['cumbre/facturador'] = gema_sovereign_get_cumbre_facturador_page_definition();
	$pages['erp-cumbre/cumbre-legal'] = gema_sovereign_get_cumbre_legal_page_definition();
	$pages['cumbre/legal'] = gema_sovereign_get_cumbre_legal_page_definition();
	$pages['erp-cumbre/cumbre-stock'] = gema_sovereign_get_cumbre_stock_page_definition();
	$pages['cumbre/stock'] = gema_sovereign_get_cumbre_stock_page_definition();
	$pages['erp-cumbre/cumbre-compras'] = gema_sovereign_get_cumbre_compras_page_definition();
	$pages['cumbre/compras'] = gema_sovereign_get_cumbre_compras_page_definition();
	$pages['erp-cumbre/cumbre-tesoreria'] = gema_sovereign_get_cumbre_tesoreria_page_definition();
	$pages['cumbre/tesoreria'] = gema_sovereign_get_cumbre_tesoreria_page_definition();
	$pages['erp-cumbre/cumbre-contabilidad'] = gema_sovereign_get_cumbre_contabilidad_page_definition();
	$pages['cumbre/contabilidad'] = gema_sovereign_get_cumbre_contabilidad_page_definition();
	$pages['erp-cumbre/cumbre-impuestos'] = gema_sovereign_get_cumbre_impuestos_page_definition();
	$pages['cumbre/impuestos'] = gema_sovereign_get_cumbre_impuestos_page_definition();
	$pages['erp-cumbre/cumbre-reportes-bi'] = gema_sovereign_get_cumbre_reportes_bi_page_definition();
	$pages['cumbre/reportes-bi'] = gema_sovereign_get_cumbre_reportes_bi_page_definition();
	$pages['erp-cumbre/cumbre-planificacion'] = gema_sovereign_get_cumbre_planificacion_page_definition();
	$pages['cumbre/planificacion'] = gema_sovereign_get_cumbre_planificacion_page_definition();
	$pages['erp-cumbre/cumbre-activos-fijos'] = gema_sovereign_get_cumbre_activos_fijos_page_definition();
	$pages['cumbre/activos-fijos'] = gema_sovereign_get_cumbre_activos_fijos_page_definition();
	$pages['erp-cumbre/cumbre-whatsapp-hub'] = gema_sovereign_get_cumbre_whatsapp_hub_page_definition();
	$pages['cumbre/whatsapp-hub'] = gema_sovereign_get_cumbre_whatsapp_hub_page_definition();
	$pages['erp-cumbre/tutoriales-api-cumbre'] = gema_sovereign_get_cumbre_api_tutorials_page_definition();
	$pages['cumbre/tutoriales-api'] = gema_sovereign_get_cumbre_api_tutorials_page_definition();

	foreach ( gema_sovereign_get_remaining_cumbre_landing_definitions() as $slug => $definition ) {
		$pages[ 'erp-cumbre/' . $slug ] = $definition;
		$pages[ 'cumbre/' . preg_replace( '/^cumbre-/', '', $slug ) ] = $definition;
	}

	return $pages;
}

function gema_sovereign_make_payment_page( string $title, string $kicker, string $description, array $modules, array $list, array $faq ): array {
	return array(
		'title'       => $title,
		'kicker'      => $kicker,
		'description' => $description,
		'modules'     => $modules,
		'list'        => $list,
		'faq'         => $faq,
	);
}

function gema_sovereign_get_payment_links(): array {
	return array(
		array( 'Pagos GEMA', '/pagos', 'Centro operativo para cobros nacionales, globales, APIs, webhooks y conciliación.' ),
		array( 'Cumbre Cobros', '/erp-cumbre/cumbre-cobros', 'Módulo editable para generar links, instrucciones y medios de cobro por cliente.' ),
		array( 'Pagos Argentina', '/pagos/argentina', 'Transferencia bancaria, Mercado Pago y Nave para cobros locales.' ),
		array( 'Transferencia bancaria', '/pagos/transferencia-bancaria', 'CBU/CVU/Alias, conciliación y comprobantes para pagos manuales.' ),
		array( 'Mercado Pago', '/pagos/mercado-pago', 'Checkout, links de pago, suscripciones y webhooks para Argentina.' ),
		array( 'Nave', '/pagos/nave', 'Cobros con Nave para comercios argentinos y conciliación operativa.' ),
		array( 'Pagos globales', '/pagos/global', 'PayPal y Stripe para ventas internacionales incluyendo Argentina.' ),
		array( 'PayPal', '/pagos/paypal', 'Cobros internacionales, pagos con cuenta PayPal y conciliación.' ),
		array( 'Stripe', '/pagos/stripe', 'Tarjetas internacionales, Checkout, suscripciones y webhooks.' ),
		array( 'Seguridad PCI', '/pagos/seguridad', 'Buenas prácticas de seguridad, tokens, secretos, roles y auditoría.' ),
		array( 'Webhooks de pagos', '/pagos/webhooks', 'Eventos, reintentos, idempotencia y validación de firmas.' ),
		array( 'Conciliación', '/pagos/conciliacion', 'Cruce de pagos, facturas, comisiones, retenciones y estados.' ),
	);
}

function gema_sovereign_get_cumbre_cobros_page_definition(): array {
	return array(
		'title'               => 'Cumbre Cobros: links de pago, QR y conciliación sin comisión Cumbre',
		'seo_title'           => 'Cumbre Cobros | Links de pago, QR, webhooks y conciliación',
		'meta_description'    => 'Cobros para PyMEs: links de pago, QR, transferencias, tarjetas, billeteras, webhooks, conciliación y 0% comisión Cumbre por transacción.',
		'keywords'            => 'links de pago para empresas Argentina, cobros online Argentina, conciliación de pagos, ERP con cobros, módulo de cobros para PyMEs, QR Mercado Pago MODO Payway, gestión de cobranzas, panel de cobros, webhooks de pago',
		'kicker'              => 'Links de pago · QR · Webhooks · Conciliación · 0% comisión Cumbre',
		'description'         => 'Cumbre Cobros es el módulo de ERP Cumbre para gestionar cobros de clientes con links de pago, QR, transferencias, tarjetas, billeteras, efectivo/manual, webhooks, conciliación y auditoría desde un panel simple y autogestionable.',
		'primary_cta_label'   => 'Activar Cumbre Cobros',
		'primary_cta_url'     => '/contacto',
		'secondary_cta_label' => 'Probar 14 días',
		'secondary_cta_url'   => '/erp/precios',
		'visual'              => array(
			'src' => '/wp-content/themes/gema-sovereign/assets/seo-visuals/pagos-cobros-og.png',
			'alt' => 'Cumbre Cobros con links de pago, QR, transferencias, tarjetas, billeteras, panel cliente, webhooks y conciliación sin comisión Cumbre',
		),
		'modules_title'       => 'Qué resuelve Cumbre Cobros',
		'list_title'          => 'Planes, medios, eventos y conciliación',
		'links_title'         => 'Cómo se integra Cumbre Cobros con ERP Cumbre',
		'faq_title'           => 'Preguntas frecuentes sobre Cumbre Cobros',
		'bottom_cta_title'    => 'Cobrá con múltiples medios, sin comisión Cumbre por transacción',
		'bottom_cta_copy'     => 'Separá el abono fijo del sistema de los aranceles de cada pasarela. Validamos medios, cuentas, webhooks, conciliación, panel cliente y reportes antes de la puesta en marcha.',
		'modules'             => array(
			array( 'Links, QR y medios múltiples', 'Permite cobrar con links de pago, QR, transferencias, tarjetas, billeteras, efectivo/manual, cheque, POS físico y pasarelas externas según el plan y la cuenta conectada.' ),
			array( '0% comisión Cumbre', 'Cumbre Cobros no cobra comisión por transacción. El cliente paga un abono fijo por el sistema; Mercado Pago, Payway, MODO, Stripe, PayPal u otra pasarela pueden cobrar sus propios aranceles.' ),
			array( 'Panel cliente autogestionable', 'El cliente puede ver medios habilitados, links, estados, comprobantes, instrucciones, webhooks, conciliaciones, reportes y seguridad según permisos.' ),
			array( 'Panel de Control', 'Muestra estado del módulo, consumo de eventos, trial, alertas, bloqueos, upgrade, webhooks activos y necesidades de configuración.' ),
			array( 'Conciliación y auditoría', 'Cruza pagos, referencias, comprobantes, eventos, comisiones de pasarela, impuestos, facturas, clientes y estados para reducir carga manual.' ),
			array( 'Integración comercial y fiscal', 'Se conecta con CRM, ERP Negocios, ERP PyMEs, Cumbre Empresas y Cumbre Facturador ARCA para seguir el camino cliente, cobro, factura y auditoría.' ),
		),
		'list'                => array(
			'Cobros Base: USD 15/mes lista, USD 12/mes lanzamiento. Hasta 5 medios activos, 50 pagos/eventos incluidos, 1 webhook activo, links de pago, transferencias, QR, tarjeta básica, efectivo/manual, panel cliente básico y 0% comisión Cumbre.',
			'Cobros Standard: USD 39/mes lista, USD 31/mes lanzamiento. Hasta 12 medios activos, 5.000 eventos/mes, 5 webhooks activos, Gema Pagos, Mercado Pago, MODO/QR, transferencias, conciliación asistida, panel cliente completo, alertas en Panel de Control y 0% comisión Cumbre. Plan recomendado.',
			'Cobros Full: USD 99/mes lista, USD 79/mes lanzamiento. Hasta 18 medios activos, 25.000 eventos/mes, 20 webhooks activos, multi-cuenta bancaria, Multi-CUIT asistido, conciliación masiva, contracargos/devoluciones, reportes de comisiones e impuestos y 0% comisión Cumbre.',
			'Medios soportados: Gema Pagos, Mercado Pago, MODO, transferencia bancaria, DEBIN, COELSA, Payway, Fiserv/PosNet, Naranja X, Cuenta DNI, Ualá Bis, Getnet, Stripe, PayPal, efectivo, cheque, POS físico y manual.',
			'Add-ons: medio de cobro adicional USD 5 / USD 4 lanzamiento; webhook adicional USD 9 / USD 7; cuenta bancaria adicional USD 12 / USD 10; Multi-CUIT cobros asistido USD 39 / USD 31; conciliación masiva USD 49 / USD 39; soporte cobros prioritario USD 79 / USD 63.',
			'Guardrails: Cumbre no guarda credenciales reales en texto plano, no acredita cobros manuales sin evidencia y no reemplaza a las pasarelas externas; las integra, registra y concilia según alcance.',
			'Trial de 14 días con datos preservados al pasar a plan pago.',
		),
		'custom_sections'     => gema_sovereign_build_cumbre_cobros_custom_sections() . gema_sovereign_build_cumbre_cobros_flow_section(),
		'links'               => array(
			array( 'ERP Cumbre', '/erp-cumbre', 'Ver cómo Cumbre Cobros se integra con CRM, PyMEs, Empresas y Facturador ARCA.' ),
			array( 'Cumbre CRM', '/cumbre-crm', 'Cobros vinculados a oportunidades, presupuestos y seguimiento comercial.' ),
			array( 'Cumbre Facturador ARCA', '/erp-cumbre/cumbre-facturador-arca', 'Cruzar cobro, factura, CAE, error, cliente y auditoría.' ),
			array( 'Pagos Argentina', '/pagos/argentina', 'Mapa de medios nacionales: transferencia, Mercado Pago, Nave, billeteras, QR y tarjetas.' ),
			array( 'Webhooks de pagos', '/pagos/webhooks', 'Eventos, idempotencia, reintentos y actualización de estados.' ),
			array( 'Conciliación', '/pagos/conciliacion', 'Cruce de pagos, facturas, comisiones, retenciones y saldos.' ),
		),
		'faq'                 => array(
			array( 'Cumbre Cobros cobra comisión por transacción?', 'No. Cumbre Cobros tiene 0% comisión Cumbre por transacción. El cliente paga un abono fijo por el sistema. Si usa Mercado Pago, Payway, MODO, Stripe, PayPal u otra pasarela externa, esa pasarela puede cobrar sus propios aranceles.' ),
			array( 'Qué diferencia hay entre abono Cumbre y arancel de pasarela?', 'El abono Cumbre paga el software, panel, límites, webhooks, conciliación y soporte del módulo. El arancel de pasarela es el costo que puede cobrar un proveedor externo por procesar pagos.' ),
			array( 'Qué medios de cobro soporta?', 'Gema Pagos, Mercado Pago, MODO, transferencia bancaria, DEBIN, COELSA, Payway, Fiserv/PosNet, Naranja X, Cuenta DNI, Ualá Bis, Getnet, Stripe, PayPal, efectivo, cheque, POS físico y manual, según cuenta, proveedor y plan.' ),
			array( 'Cumbre Cobros reemplaza a Mercado Pago, Payway o Stripe?', 'No. Cumbre Cobros no reemplaza pasarelas: las integra, organiza, registra eventos, muestra estados y ayuda a conciliar. Cada pasarela conserva sus reglas, aranceles, acreditaciones y condiciones.' ),
			array( 'Puede conciliar pagos manuales?', 'Sí, pero no acredita cobros manuales sin evidencia. Transferencias, efectivo o cheques requieren comprobante, registro o validación administrativa según el flujo definido.' ),
			array( 'Tiene prueba gratis?', 'Sí. La prueba dura 14 días y los datos se conservan al pasar a plan pago.' ),
		),
	);
}

function gema_sovereign_build_cumbre_cobros_custom_sections(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-cobros-section","layout":{"type":"constrained"}} --><section class="wp-block-group gema-content-section cumbre-cobros-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Promesa comercial</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">Cobrá con múltiples medios, sin comisión Cumbre por transacción</h2><!-- /wp:heading --><!-- wp:html --><div class="cumbre-fee-comparison"><article><span>Abono Cumbre</span><strong>0% comisión Cumbre</strong><p>Pagás un abono fijo por usar el sistema, panel cliente, webhooks, límites, reportes, alertas, conciliación y soporte según el plan.</p></article><article><span>Arancel de pasarela</span><strong>Costo externo</strong><p>Mercado Pago, Payway, MODO, Stripe, PayPal u otra pasarela pueden cobrar sus propios aranceles, plazos de acreditación, retenciones o costos por operación.</p></article></div><div class="cumbre-pricing-grid" aria-label="Planes de Cumbre Cobros"><article class="cumbre-pricing-card"><span class="cumbre-pricing-eyebrow">Cobros Base</span><h3>Cobros Base</h3><p class="cumbre-pricing-price"><strong>USD 12</strong><span>/mes lanzamiento</span></p><p class="cumbre-pricing-list-price">Lista: USD 15/mes</p><ul><li>Hasta 5 medios activos</li><li>50 pagos/eventos incluidos</li><li>1 webhook activo</li><li>Links de pago</li><li>Transferencias, QR, tarjeta básica y efectivo/manual</li><li>Panel cliente básico</li><li>0% comisión Cumbre</li></ul></article><article class="cumbre-pricing-card cumbre-pricing-card--featured"><span class="cumbre-pricing-eyebrow">Recomendado</span><h3>Cobros Standard</h3><p class="cumbre-pricing-price"><strong>USD 31</strong><span>/mes lanzamiento</span></p><p class="cumbre-pricing-list-price">Lista: USD 39/mes</p><ul><li>Hasta 12 medios activos</li><li>5.000 eventos/mes</li><li>5 webhooks activos</li><li>Gema Pagos, Mercado Pago, MODO/QR y transferencias</li><li>Conciliación asistida</li><li>Panel cliente completo y alertas en Panel de Control</li><li>0% comisión Cumbre</li></ul></article><article class="cumbre-pricing-card"><span class="cumbre-pricing-eyebrow">Mayor volumen</span><h3>Cobros Full</h3><p class="cumbre-pricing-price"><strong>USD 79</strong><span>/mes lanzamiento</span></p><p class="cumbre-pricing-list-price">Lista: USD 99/mes</p><ul><li>Hasta 18 medios activos</li><li>25.000 eventos/mes</li><li>20 webhooks activos</li><li>Multi-cuenta bancaria y Multi-CUIT asistido</li><li>Conciliación masiva</li><li>Contracargos, devoluciones, comisiones e impuestos</li><li>0% comisión Cumbre</li></ul></article></div><div class="cumbre-limit-table" role="table" aria-label="Límites por plan de Cumbre Cobros"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Capacidad</span><span>Base</span><span>Standard</span><span>Full</span></div><div class="cumbre-limit-row" role="row"><span>Medios activos</span><span>Hasta 5</span><span>Hasta 12</span><span>Hasta 18</span></div><div class="cumbre-limit-row" role="row"><span>Eventos mensuales</span><span>50 incluidos</span><span>5.000</span><span>25.000</span></div><div class="cumbre-limit-row" role="row"><span>Webhooks activos</span><span>1</span><span>5</span><span>20</span></div><div class="cumbre-limit-row" role="row"><span>Conciliación</span><span>Básica/manual</span><span>Asistida</span><span>Masiva</span></div><div class="cumbre-limit-row" role="row"><span>Panel cliente</span><span>Básico</span><span>Completo</span><span>Completo + reportes</span></div><div class="cumbre-limit-row" role="row"><span>Comisión Cumbre</span><span>0%</span><span>0%</span><span>0%</span></div></div><div class="cumbre-addon-panel" aria-label="Add-ons de Cumbre Cobros"><div><span class="cumbre-pricing-eyebrow">Add-ons Cobros</span><h3>Sumá medios, webhooks, cuentas y conciliación cuando crezca el volumen</h3><p>El módulo permite aumentar capacidad sin cambiar todo el plan, manteniendo separado el abono Cumbre de los aranceles externos.</p></div><ul><li><strong>Medio de cobro adicional:</strong> USD 5 lista / USD 4 lanzamiento</li><li><strong>Webhook adicional:</strong> USD 9 lista / USD 7 lanzamiento</li><li><strong>Cuenta bancaria adicional:</strong> USD 12 lista / USD 10 lanzamiento</li><li><strong>Multi-CUIT cobros asistido:</strong> USD 39 lista / USD 31 lanzamiento</li><li><strong>Conciliación masiva:</strong> USD 49 lista / USD 39 lanzamiento</li><li><strong>Soporte cobros prioritario:</strong> USD 79 lista / USD 63 lanzamiento</li></ul></div><div class="cumbre-payment-method-grid" aria-label="Medios de cobro soportados"><span>Gema Pagos</span><span>Mercado Pago</span><span>MODO</span><span>Transferencia</span><span>DEBIN</span><span>COELSA</span><span>Payway</span><span>Fiserv/PosNet</span><span>Naranja X</span><span>Cuenta DNI</span><span>Ualá Bis</span><span>Getnet</span><span>Stripe</span><span>PayPal</span><span>Efectivo</span><span>Cheque</span><span>POS físico</span><span>Manual</span></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>Panel cliente</strong><span>Medios habilitados, links, webhooks, conciliaciones, reportes, seguridad, comprobantes e historial por cliente.</span></article><article class="cumbre-proof-card"><strong>Panel de Control</strong><span>Estado del módulo, consumo, trial, alertas, bloqueos, upgrade, webhooks y configuración pendiente.</span></article><article class="cumbre-proof-card"><strong>Guardrails</strong><span>No guarda credenciales reales en texto plano, no acredita cobros manuales sin evidencia y no reemplaza pasarelas externas.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_build_cumbre_cobros_flow_section(): string {
	return '<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-cobros-flow-section","layout":{"type":"constrained"}} --><section id="flujo-conciliacion-cobros" class="wp-block-group gema-content-section cumbre-cobros-flow-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Flujo completo de cobro</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">De la factura o pedido al pago conciliado y registrado</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"gema-section-copy"} --><p class="gema-section-copy">Los competidores fuertes nombran pasarelas y conciliación, pero la PyME necesita ver el circuito entero. Cumbre Cobros muestra cómo viaja un cobro desde la venta hasta Tesorería, Contabilidad e Impuestos.</p><!-- /wp:paragraph --><!-- wp:html --><div class="cumbre-compras-flow"><article><span>01</span><h3>Factura, pedido o presupuesto</h3><p>El cobro nace desde CRM, Ventas, ERP Negocios, PyMEs o Facturador ARCA.</p></article><article><span>02</span><h3>Link, QR o instrucción</h3><p>Se genera medio de cobro según cuenta, moneda, vencimiento, cliente y pasarela habilitada.</p></article><article><span>03</span><h3>Evento o evidencia</h3><p>Webhook, comprobante, transferencia, efectivo/manual o reporte del proveedor externo.</p></article><article><span>04</span><h3>Conciliación asistida</h3><p>Se cruza pago, cliente, importe, comisión, retención, factura, referencia y estado.</p></article><article><span>05</span><h3>Registro y trazabilidad</h3><p>El cobro alimenta Tesorería, cuentas corrientes, reportes, contabilidad e impuestos según alcance.</p></article></div><div class="cumbre-limit-table" role="table" aria-label="Qué se valida en conciliación de pagos"><div class="cumbre-limit-row cumbre-limit-row--head" role="row"><span>Dato</span><span>Origen posible</span><span>Uso</span><span>Guardrail</span></div><div class="cumbre-limit-row" role="row"><span>Importe y moneda</span><span>Pasarela, transferencia o carga manual</span><span>Comparar contra pedido/factura</span><span>Diferencias requieren revisión</span></div><div class="cumbre-limit-row" role="row"><span>Comisión y retención</span><span>Mercado Pago, Payway, MODO, banco o proveedor</span><span>Reporte financiero y contable</span><span>No asumir costo si el proveedor no lo informa</span></div><div class="cumbre-limit-row" role="row"><span>Estado</span><span>Webhook, panel externo o comprobante</span><span>Pendiente, aprobado, rechazado, devuelto o disputa</span><span>Eventos idempotentes para no duplicar</span></div><div class="cumbre-limit-row" role="row"><span>Evidencia manual</span><span>Comprobante, caja, cheque o transferencia</span><span>Acreditación administrativa</span><span>No marcar como cobrado sin evidencia</span></div></div><div class="cumbre-pymes-guardrails"><article class="cumbre-proof-card"><strong>Separar costos</strong><span>El abono Cumbre no elimina aranceles, retenciones o plazos de acreditación de proveedores externos.</span></article><article class="cumbre-proof-card"><strong>Idempotencia</strong><span>Un webhook repetido no debe duplicar cobros, facturas, recibos ni movimientos de tesorería.</span></article><article class="cumbre-proof-card"><strong>Conciliación revisable</strong><span>El sistema sugiere cruces, pero diferencias, devoluciones, contracargos y pagos manuales necesitan control humano.</span></article></div><!-- /wp:html --></section><!-- /wp:group -->';
}

function gema_sovereign_get_payment_page_definitions(): array {
	$links = gema_sovereign_get_payment_links();

	return array(

		'erp-cumbre/cumbre-cobros' => gema_sovereign_get_cumbre_cobros_page_definition(),
		'pagos' => array(
			'title'       => 'Plataforma de pagos GEMA: Argentina y global',
			'kicker'      => 'Pagos nacionales + internacionales',
			'description' => 'Arquitectura de pagos de GEMA para cobrar por transferencia bancaria, Mercado Pago, Nave, PayPal y Stripe, preparada para integrarse con ERP Cumbre, CRM, facturación y conciliación.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/seo-visuals/seo-geo-nodo-conocimiento-lite.webp',
				'alt' => 'Arquitectura de pagos GEMA con transferencia bancaria, Mercado Pago, Nave, PayPal, Stripe, webhooks, seguridad y conciliación',
			),
			'modules'     => array(
				array( 'Argentina', 'Transferencia bancaria, Mercado Pago y Nave para cobros locales, billeteras, QR, links de pago y conciliación.' ),
				array( 'Global', 'PayPal y Stripe para cobros internacionales, tarjetas, Checkout, suscripciones y operación multicurrency.' ),
				array( 'Backoffice', 'Webhooks, idempotencia, conciliación, seguridad, roles, auditoría y conexión futura con cuentas reales de GEMA.' ),
			),
			'list'        => array(
				'Primero dejamos la plataforma preparada sin credenciales; luego conectamos las cuentas reales de GEMA proveedor por proveedor.',
				'Cada medio de pago tiene una página propia SEO, un flujo operativo y una estrategia de conciliación.',
				'La arquitectura queda lista para conectarse con Cumbre Cobros, Cumbre Tesorería, Cumbre Facturador, Cumbre CRM y Cumbre eCommerce.',
			),
			'links'       => $links,
			'faq'         => array(
				array( 'Ya quedan conectadas las cuentas?', 'No. Esta etapa prepara estructura, páginas, plugins y endpoints. Las credenciales reales se vinculan después con acceso controlado.' ),
				array( 'Qué medios quedan contemplados?', 'Transferencia bancaria nacional, QR, Mercado Pago, Nave, MODO, DEBIN, COELSA, Payway, Fiserv/PosNet, Naranja X, Cuenta DNI, Ualá Bis, Getnet, tarjetas, efectivo, cheque, PayPal y Stripe, con webhooks, seguridad y conciliación.' ),
			),
		),
		'pagos/argentina' => gema_sovereign_make_payment_page(
			'Pagos en Argentina: transferencia, QR, billeteras, tarjetas, Mercado Pago y Nave',
			'Cobros locales',
			'Centro de pagos nacionales de GEMA para operar transferencias bancarias, QR interoperable, MODO, Mercado Pago, Nave, DEBIN, COELSA, Payway, Fiserv/PosNet, Naranja X, Cuenta DNI, Ualá Bis, Getnet, tarjetas, links de pago, terminales, efectivo, cheque y comprobantes con conciliación y conexión futura con ERP Cumbre.',
			array(
				array( 'Transferencia bancaria', 'Cobros por CBU, CVU o Alias con registro de comprobantes y conciliación manual o semiautomática.' ),
				array( 'Billeteras, QR y MODO', 'Cobros con QR interoperable, billeteras virtuales, MODO y experiencias móviles según disponibilidad de cuenta y proveedor.' ),
				array( 'Mercado Pago, Nave, tarjetas y adquirentes', 'Links de pago, checkout, tarjetas de débito/crédito, Payway, Fiserv/PosNet, Getnet, Naranja X, Cuenta DNI, Ualá Bis, POS o terminales y webhooks de acreditación cuando correspondan.' ),
			),
			array(
				'Ideal para clientes argentinos que pagan en pesos, transferencia, QR, billeteras virtuales, tarjetas o bancos locales.',
				'Cada medio puede habilitarse por cliente, propuesta, importe, vencimiento, comisión y disponibilidad comercial.',
				'La etapa de cuenta real queda pendiente para vincular credenciales, permisos, webhooks y ambiente productivo.',
				'Puede conectarse luego con Cumbre Tesorería y Cumbre Facturador para conciliar pagos contra facturas.',
			),
			array(
				array( 'Qué se conecta primero?', 'Normalmente transferencia bancaria, Mercado Pago y Nave; QR, MODO, tarjetas y terminales se validan según cuenta, API, plugin y credenciales comerciales.' ),
				array( 'Se puede usar para cuotas o suscripciones?', 'Mercado Pago y Stripe pueden cubrir escenarios recurrentes según configuración, país y producto.' ),
			)
		),
		'pagos/transferencia-bancaria' => gema_sovereign_make_payment_page(
			'Transferencia bancaria para GEMA',
			'CBU, CVU y Alias',
			'Página operativa para cobros por transferencia bancaria nacional, registro de comprobantes, validación administrativa y conciliación con facturas o propuestas.',
			array(
				array( 'Datos bancarios', 'Preparado para publicar CBU, CVU, Alias, CUIT, razón social y referencias cuando GEMA confirme datos definitivos.' ),
				array( 'Comprobante', 'Formulario o flujo para que el cliente informe pago, importe, fecha, banco y número de operación.' ),
				array( 'Conciliación', 'Cruce posterior contra factura, propuesta, lead, cliente o cuenta corriente.' ),
			),
			array(
				'No se publican datos bancarios reales hasta confirmación final.',
				'Sirve como medio de bajo costo para pagos nacionales y anticipos.',
				'Debe integrarse con notificaciones internas para validar acreditación.',
			),
			array(
				array( 'Requiere plugin?', 'No necesariamente. Puede funcionar con página, formulario y conciliación administrativa; si se usa WooCommerce, transferencia bancaria puede configurarse como BACS.' ),
				array( 'Se puede automatizar?', 'Sí, con APIs bancarias o conciliación por extractos cuando estén disponibles.' ),
			)
		),
		'pagos/mercado-pago' => gema_sovereign_make_payment_page(
			'Mercado Pago para GEMA',
			'Checkout local Argentina',
			'Integración preparada para Mercado Pago: checkout, links de pago, QR, suscripciones cuando aplique, webhooks y conciliación con el backoffice GEMA.',
			array(
				array( 'Checkout y links', 'Preparado para enviar links de pago o checkout desde propuestas, CRM o páginas comerciales.' ),
				array( 'Webhooks', 'Eventos de pago aprobado, pendiente, rechazado o devuelto para actualizar estados internos.' ),
				array( 'Conciliación', 'Cruce de cobros, comisiones, retenciones, liquidaciones y comprobantes.' ),
			),
			array(
				'Plugin recomendado: Mercado Pago payments for WooCommerce si se activa checkout WooCommerce.',
				'API recomendada: credenciales de producción y sandbox con webhooks HTTPS bajo dominio GEMA.',
				'La cuenta real se vincula en la etapa final con usuario administrador autorizado.',
			),
			array(
				array( 'Ya está conectado Mercado Pago?', 'No. Queda preparada la arquitectura; falta vincular access token, public key, webhooks y modo producción.' ),
				array( 'Puede emitir facturas automáticamente?', 'El pago puede disparar una integración posterior con Cumbre Facturador o el flujo fiscal definido.' ),
			)
		),
		'pagos/nave' => gema_sovereign_make_payment_page(
			'Nave para cobros GEMA',
			'Cobros locales con Nave',
			'Página de preparación para integrar Nave como medio de pago nacional, orientado a comercios argentinos, links o terminales disponibles y conciliación operativa.',
			array(
				array( 'Canal comercial', 'Validar tipo de cuenta Nave, condiciones, documentación y medios de cobro disponibles.' ),
				array( 'API o plugin', 'Confirmar disponibilidad de plugin oficial o integración por API/documentación de Nave.' ),
				array( 'Backoffice', 'Registrar estado de pago, comprobante, operación, comisión y conciliación.' ),
			),
			array(
				'Nave queda contemplado en la arquitectura nacional aunque la conexión final depende de credenciales y documentación oficial vigente.',
				'El flujo puede integrarse con Cumbre Tesorería para validar cobros y liquidaciones.',
				'No se inventan credenciales ni endpoints privados; se deja preparado para integración real.',
			),
			array(
				array( 'Nave tiene plugin WordPress?', 'Debe verificarse contra la documentación oficial vigente. Si no hay plugin estable, se implementa por API o flujo manual asistido.' ),
				array( 'Se puede conciliar?', 'Sí. La conciliación depende de reportes, APIs o exportaciones disponibles.' ),
			)
		),
		'pagos/global' => gema_sovereign_make_payment_page(
			'Pagos globales: PayPal y Stripe para GEMA',
			'Cobros internacionales',
			'Arquitectura de pagos internacionales de GEMA con PayPal y Stripe para cobrar fuera y dentro de Argentina según disponibilidad, moneda, impuestos y proveedor.',
			array(
				array( 'PayPal', 'Cobros internacionales con cuenta PayPal, botones o checkout, sujeto a condiciones de país y cuenta.' ),
				array( 'Stripe', 'Checkout, tarjetas, suscripciones, webhooks y conciliación, sujeto a disponibilidad por país y estructura legal.' ),
				array( 'Riesgo y cumplimiento', 'Validación de KYC, moneda, impuestos, contracargos, disputas y reportes contables.' ),
			),
			array(
				'Global no reemplaza medios locales: complementa Argentina con cobros internacionales.',
				'La cuenta real se conectará después, separando sandbox y producción.',
				'Cada proveedor debe tener webhooks firmados, secretos seguros y monitoreo de eventos.',
			),
			array(
				array( 'Stripe funciona en Argentina?', 'Depende de la disponibilidad de Stripe para la entidad legal usada y la cuenta configurada. La arquitectura queda preparada sin asumir credenciales.' ),
				array( 'PayPal sirve para clientes argentinos?', 'Puede servir en escenarios específicos, pero comisiones, moneda y retiro deben validarse con la cuenta real.' ),
			)
		),
		'pagos/paypal' => gema_sovereign_make_payment_page(
			'PayPal para GEMA',
			'Checkout internacional',
			'Preparación para cobrar con PayPal en servicios, propuestas, anticipos o productos digitales de GEMA, con webhooks y conciliación posterior.',
			array(
				array( 'Cuenta PayPal', 'Vinculación futura de cuenta business, ambiente sandbox y producción.' ),
				array( 'Eventos', 'Captura, aprobación, rechazo, reembolso, disputa y contracargo mediante webhooks.' ),
				array( 'Conciliación', 'Cruce de monto bruto, comisión, moneda, saldo disponible y factura o propuesta asociada.' ),
			),
			array(
				'Plugin recomendado: WooCommerce PayPal Payments si se usa WooCommerce checkout.',
				'API recomendada: REST API con client ID/secret guardados como secretos, no en código.',
				'Pendiente: conectar cuenta business real de GEMA.',
			),
			array(
				array( 'Se puede probar antes?', 'Sí. PayPal permite sandbox para validar checkout, webhooks y estados sin dinero real.' ),
				array( 'Conviene para todos los pagos?', 'No siempre. Debe compararse comisión, moneda, retiro y experiencia del cliente.' ),
			)
		),
		'pagos/stripe' => gema_sovereign_make_payment_page(
			'Stripe para GEMA',
			'Tarjetas, Checkout y suscripciones',
			'Preparación para integrar Stripe como plataforma global de tarjetas, checkout, suscripciones, webhooks, disputas y conciliación de pagos.',
			array(
				array( 'Checkout', 'Checkout alojado, Payment Links o integración API según producto y país.' ),
				array( 'Suscripciones', 'Planes recurrentes para SaaS, soporte, mantenimiento o servicios continuos.' ),
				array( 'Webhooks firmados', 'Eventos de pago, factura, suscripción, reembolso, disputa y actualización de método de pago.' ),
			),
			array(
				'Plugin recomendado: WooCommerce Stripe Payment Gateway para checkout WordPress/WooCommerce.',
				'API recomendada: claves sandbox y live separadas, secrets rotables y validación de firma.',
				'Pendiente: confirmar entidad legal, país de cuenta y monedas habilitadas.',
			),
			array(
				array( 'Puede cobrar suscripciones?', 'Sí, Stripe es fuerte para suscripciones, siempre sujeto a configuración de cuenta y país.' ),
				array( 'Se guardan tarjetas en GEMA?', 'No debería guardarse PAN en servidores propios. Se usan tokens/proveedores certificados.' ),
			)
		),
		'pagos/seguridad' => gema_sovereign_make_payment_page(
			'Seguridad de pagos GEMA',
			'PCI, secretos y control',
			'Lineamientos de seguridad para la plataforma de pagos GEMA: PCI, tokens, webhooks firmados, secretos, roles, auditoría, backups y separación sandbox/producción.',
			array(
				array( 'No almacenar tarjetas', 'Los datos sensibles de tarjeta deben quedar en proveedores certificados como Stripe, PayPal o Mercado Pago.' ),
				array( 'Secretos seguros', 'Access tokens, client secrets y webhook secrets deben ir en variables/secretos, nunca en páginas o repositorio.' ),
				array( 'Auditoría', 'Registrar eventos, IPs, usuario, proveedor, firma, estado y correlación con factura o lead.' ),
			),
			array(
				'Sandbox y producción deben estar separados.',
				'Todo webhook debe validar firma o token secreto.',
				'Los errores de pago no deben exponer datos sensibles al usuario final.',
			),
			array(
				array( 'Qué nivel PCI necesita GEMA?', 'Depende del flujo final. Si se usan checkouts/tokenización de proveedores, se reduce el alcance PCI propio.' ),
				array( 'Quién puede ver credenciales?', 'Sólo administradores autorizados; deben rotarse y registrarse con mínimo privilegio.' ),
			)
		),
		'pagos/webhooks' => gema_sovereign_make_payment_page(
			'Webhooks de pagos GEMA',
			'Eventos e idempotencia',
			'Arquitectura de webhooks para recibir eventos de Mercado Pago, PayPal, Stripe y futuros proveedores, con validación, idempotencia, reintentos y auditoría.',
			array(
				array( 'Recepción', 'Endpoint HTTPS por proveedor, con validación de firma, token o secreto según documentación oficial.' ),
				array( 'Idempotencia', 'Cada evento debe tener ID único para evitar duplicar pagos, facturas o conciliaciones.' ),
				array( 'Reintentos', 'Estados pendientes, backoff, dead-letter operativo y alertas para fallas recurrentes.' ),
			),
			array(
				'Los webhooks se dejan preparados en la capa técnica, pero sin secretos reales hasta vincular cuentas.',
				'Cada proveedor debe mapear estados a un modelo común: pendiente, aprobado, rechazado, devuelto, disputa.',
				'El objetivo es conectar pagos con leads, clientes, facturas, propuestas y Cumbre Tesorería.',
			),
			array(
				array( 'Qué pasa si el proveedor reintenta?', 'La idempotencia evita duplicar operaciones si llega el mismo evento más de una vez.' ),
				array( 'Se puede auditar?', 'Sí. Cada evento debe conservar proveedor, ID externo, payload resumido, firma validada y resultado interno.' ),
			)
		),
		'pagos/conciliacion' => gema_sovereign_make_payment_page(
			'Conciliación de pagos GEMA',
			'Tesorería y control',
			'Modelo de conciliación para cruzar pagos de transferencia, Mercado Pago, Nave, PayPal y Stripe contra facturas, propuestas, comisiones, retenciones y estados.',
			array(
				array( 'Cruce contable', 'Relacionar pago, proveedor, cliente, factura, propuesta, moneda, comisión y fecha de acreditación.' ),
				array( 'Estados', 'Pendiente, acreditado, rechazado, reembolsado, contracargo, en disputa y conciliado.' ),
				array( 'Cumbre Tesorería', 'Preparado para conectar con el módulo de tesorería, cuentas corrientes y reportes financieros.' ),
			),
			array(
				'La conciliación no depende sólo del checkout; también requiere reportes, liquidaciones, comisiones e impuestos.',
				'Cada proveedor debe mapear sus estados a un modelo común de GEMA.',
				'Cuando se conecten las cuentas reales se define el flujo de cierre diario/mensual.',
			),
			array(
				array( 'Se concilia automáticamente?', 'Puede automatizarse parcialmente con webhooks y reportes; algunos casos requieren revisión humana.' ),
				array( 'Sirve para bancos y billeteras?', 'Sí. El modelo contempla transferencia bancaria, billeteras locales y procesadores globales.' ),
			)
		),
	);
}

function gema_sovereign_get_comparison_page_definitions(): array {
	$pages = array(
		'competencia' => array(
			'title'       => 'Comparativas ERP Cumbre vs competencia',
			'kicker'      => 'Comparativas AI-First por módulo',
			'description' => 'Informe técnico-comparativo de ERP Cumbre frente a CRM, ERP, facturadores, automatizadores y software vertical legacy del mercado argentino.',
			'visual'      => array(
				'src' => '/wp-content/themes/gema-sovereign/assets/seo-visuals/seo-geo-nodo-conocimiento-lite.webp',
				'alt' => 'Mapa SEO de comparativas ERP Cumbre frente a competencia, módulos, verticales, CRM, ARCA, IA y sistemas legacy',
			),
			'modules'     => array(
				array( 'Tiers de producto', 'Comparativas de Cumbre CRM, ERP Negocios, ERP PyMEs y Cumbre Empresas frente a HubSpot, Salesforce, Tango, Bejerman, Odoo, SAP y NetSuite.' ),
				array( 'Submódulos funcionales', 'Comparativas de facturación, compras, ventas, personal, tesorería, marketing, automatizaciones, web, ecommerce y Mercado Libre.' ),
				array( 'Verticales especializados', 'Comparativas para kioscos, restaurantes, depósitos WMS, constructoras, agro y mercados con foco AI-First, Zero-UI y multi-tenant.' ),
			),
			'list'        => array(
				'Cada comparativa tiene una URL SEO propia dentro de /competencia/ para capturar búsquedas transaccionales y long-tail.',
				'El enfoque no es atacar marcas: es explicar arquitectura, límites legacy, costos ocultos, localización argentina e IA operativa.',
				'Las páginas funcionan como landing pages satélite conectadas al portal ERP Cumbre y al diagnóstico comercial.',
			),
			'links'       => gema_sovereign_get_comparison_links(),
			'faq'         => array(
				array( 'Qué compara esta sección?', 'Compara ERP Cumbre contra soluciones legacy, CRM globales, facturadores locales, automatizadores externos y software vertical tradicional.' ),
				array( 'Todas las comparativas son para migrar?', 'No. También sirven para decidir si conviene integrar, convivir por etapas o reemplazar módulos puntuales.' ),
			),
		),
		'competencia/cumbre-crm-vs-hubspot-salesforce' => gema_sovereign_make_comparison_page( 'Cumbre CRM vs HubSpot y Salesforce', 'CRM argentino conectado a operación', 'Comparativa entre Cumbre CRM, HubSpot y Salesforce para PyMEs argentinas que necesitan conectar leads, clientes, presupuestos, cobros, catálogo, stock y facturación en un mismo flujo comercial.', 'HubSpot y Salesforce son CRM excelentes, pero suelen quedar desconectados de la realidad transaccional argentina. Integrarlos con facturación local requiere conectores de terceros como Zapier o Make, con costo, latencia e inestabilidad en escenarios ARS/USD.', 'Cumbre CRM funciona como tronco comercial de Cumbre ERP: captura leads desde web o WhatsApp, ordena oportunidades, presupuestos, próximas acciones y conecta Catálogo, Cobros, Stock y Facturación ARCA en modo demo o piloto controlado.', 'CRM conectado a operación real: menos datos duplicados, mejor seguimiento comercial y camino asistido desde la consulta hasta el cobro y la factura.', array( 'crm argentina tipo hubspot', 'crm para pymes argentina', 'hubspot argentina alternativa' ) ),
		'competencia/cumbre-erp-negocios-vs-tango-factura' => gema_sovereign_make_comparison_page( 'Cumbre ERP Negocios vs Tango Factura y Facturante', 'Zero-UI para comercios', 'Comparativa para monotributistas, comercios y emprendedores que comparan Cumbre ERP Negocios contra facturadores web tradicionales.', 'Los facturadores tradicionales resuelven emisión básica, pero obligan a navegar pantallas rígidas, cargar productos manualmente y sostener conciliaciones por fuera del sistema.', 'Cumbre ERP Negocios permite operar offline u online, dictar ventas o enviar audios por WhatsApp, conciliar Mercado Pago, Nave y MODO, y avanzar sin menús complejos.', 'Zero-UI, billeteras virtuales conciliadas y administración liviana para comercios reales.', array( 'sistema de gestión para monotributistas', 'facturador arca para comercios', 'erp negocios argentina' ) ),
		'competencia/cumbre-erp-pymes-vs-tango-bejerman-odoo' => gema_sovereign_make_comparison_page( 'Cumbre ERP PyMEs vs Tango, Bejerman y Odoo', 'Administración PyME con contabilidad opcional', 'Comparativa de ERP Cumbre PyMEs frente a Tango Software, Bejerman y Odoo para empresas argentinas que necesitan ordenar administración, bancos, impuestos y reportes.', 'Tango y Bejerman suelen depender de infraestructura local o nubes pesadas. Odoo puede requerir localización impositiva por partners y parches de terceros.', 'Cumbre ERP PyMEs está diseñado para PyMEs de Comercio y Servicios que necesitan ventas, compras, cuentas corrientes, bancos, impuestos, reportes y contabilidad formal opcional con implementación asistida.', 'Administración fuerte primero: contabilidad formal como add-on cuando la empresa necesita plan de cuentas, asientos, cierres y soporte al contador.', array( 'erp para pymes argentinas', 'software administrativo para pymes', 'alternativa tango software argentina', 'alternativa odoo argentina', 'contabilidad opcional para pymes' ) ),
		'competencia/cumbre-empresas-vs-sap-netsuite' => gema_sovereign_make_comparison_page( 'Cumbre Empresas vs ERP corporativo pesado', 'Gobernanza administrativa sin sobredimensionar', 'Comparativa para empresas argentinas en crecimiento que necesitan más usuarios, sucursales, aprobaciones, auditoría y reportes ejecutivos sin iniciar una implementación corporativa pesada.', 'Los ERP corporativos globales pueden ser adecuados para estructuras muy grandes, pero suelen exigir mayor consultoría, tiempos extensos y cambios organizacionales profundos.', 'Cumbre Empresas escala Cumbre ERP PyMEs con gobernanza por área, flujos de aprobación, Vista Ejecutiva, auditoría extendida, reportes gerenciales, asistente IA e implementación asistida por etapas.', 'Más control sobre la administración sin duplicar el mensaje de PyMEs: PyMEs ordena la administración; Empresas gobierna la administración.', array( 'cumbre empresas', 'erp administrativo con gobernanza', 'software administrativo para empresas argentinas', 'flujos de aprobación erp', 'auditoría administrativa erp' ) ),
		'competencia/cumbre-facturador-vs-facturadores-arca' => gema_sovereign_make_comparison_page( 'Cumbre Facturador vs facturadores ARCA tradicionales', 'Facturación electrónica resiliente', 'Comparativa de software de facturación electrónica ARCA con foco en preparación, control operativo y piloto fiscal asistido.', 'Muchos facturadores dependen de procesos por lote o se paralizan ante micro-cortes de AFIP/ARCA.', 'Cumbre Facturador prepara el flujo fiscal desde presupuestos y cobros, dejando la emisión real ARCA para un piloto controlado con validación técnica, normativa y operativa antes de validar el caso.', 'Prepara resiliencia fiscal mediante implementación asistida, sin prometer activación automática antes de validar el caso.', array( 'software de facturación electrónica arca', 'facturación masiva caeas afip arca', 'facturador arca argentina' ) ),
		'competencia/cumbre-compras-vs-carga-manual' => gema_sovereign_make_comparison_page( 'Cumbre Compras vs carga manual de facturas', 'OCR multimodal inteligente', 'Comparativa entre carga manual de facturas de proveedores y Cumbre Compras con OCR multimodal IA.', 'La carga manual exige revisar CUIT por CUIT, neto por neto, percepción por percepción, con errores y demoras administrativas.', 'Cumbre Compras permite subir un PDF o foto del comprobante. Gemini Vision lee datos fiscales, valida CUIT, extrae ítems, IVA e IIBB y genera el asiento en IVA Compras.', 'Menos carga manual y más trazabilidad contable desde el origen del documento.', array( 'ocr facturas proveedores argentina', 'iva compras automático', 'compras erp con ia' ) ),
		'competencia/cumbre-ventas-vs-pos-tradicional' => gema_sovereign_make_comparison_page( 'Cumbre Ventas vs POS tradicional', 'Ventas bimonetarias síncronas', 'Comparativa para puntos de venta que necesitan proteger márgenes ante inflación, devaluación y listas en ARS/USD.', 'Los POS tradicionales trabajan con precios fijos en pesos que quedan desactualizados en contextos de inflación o saltos cambiarios.', 'Cumbre Ventas vincula listas al tipo de cambio elegido por el cliente: BNA oficial, MEP o tarjeta. Si el dólar se mueve, el POS actualiza precios en pesos en el acto.', 'Control bimonetario en caja, ecommerce y ventas sin recalcular márgenes manualmente.', array( 'pos bimonetario argentina', 'punto de venta dólar mep', 'software ventas bimonetario' ) ),
		'competencia/cumbre-personal-vs-liquidadores-sueldos' => gema_sovereign_make_comparison_page( 'Cumbre Personal vs sistemas de liquidación legacy', 'RRHH conectado al negocio', 'Comparativa de Cumbre Personal frente a sistemas de liquidación de sueldos desconectados de productividad, CRM y facturación.', 'Los liquidadores pre-IA suelen resolver nómina, pero no conectan legajos, productividad, CRM y facturación real.', 'Cumbre Personal automatiza Libro de Sueldos Digital ARCA y conecta semánticamente legajos con cierres comerciales, productividad y facturación.', 'RRHH deja de ser isla administrativa y se integra al control operativo.', array( 'libro de sueldos digital arca', 'software rrhh argentina', 'liquidación sueldos erp' ) ),
		'competencia/cumbre-tesoreria-vs-conciliacion-manual' => gema_sovereign_make_comparison_page( 'Cumbre Tesorería vs conciliación manual', 'Ruteador financiero asíncrono', 'Comparativa para empresas que pierden días conciliando bancos, billeteras y retenciones a fin de mes.', 'La conciliación manual de PDFs y extractos consume horas, demora cierres y multiplica errores de retenciones y ajustes.', 'El agente de tesorería conecta bancos y fintechs como MODO, Mercado Pago y Nave, cruza ingresos contra facturas, propone asientos de ajuste y pide confirmación humana sólo en montos críticos.', 'Automatización financiera con human-in-the-loop y control de riesgo.', array( 'conciliación bancaria automática argentina', 'tesorería erp argentina', 'mercado pago nave modo conciliación' ) ),
		'competencia/cumbre-marketing-vs-email-masivo' => gema_sovereign_make_comparison_page( 'Cumbre Marketing vs email masivo tradicional', 'Marketing conectado al ERP', 'Comparativa de Cumbre Marketing frente a campañas masivas desconectadas del comportamiento real de clientes.', 'Las campañas tradicionales no conocen compras, tickets, frecuencia ni valor transaccional real del cliente.', 'Cumbre Marketing sincroniza CRM y ERP. Si un cliente no compra hace 30 días, dispara audiencias para Google Ads o flujos de WhatsApp operados por el agente de ventas.', 'Marketing accionado por datos reales de compra, no sólo por listas estáticas.', array( 'automatización marketing erp', 'crm google ads whatsapp', 'recuperación clientes con ia' ) ),
		'competencia/cumbre-automatizaciones-vs-zapier-make' => gema_sovereign_make_comparison_page( 'Cumbre Automatizaciones vs Zapier y Make', 'Zapier interno sobre Google Cloud', 'Comparativa entre automatizadores externos con costos en dólares y automatizaciones internas de ERP Cumbre.', 'Zapier y Make son útiles, pero pueden volverse caros por volumen de ejecuciones y sumar dependencia externa en flujos críticos.', 'Cumbre Automatizaciones permite diseñar flujos específicos para cada PyME, con trazabilidad, control y acompañamiento técnico de GEMA.', 'Automatización controlada, trazable y cercana al negocio, sin plataformas intermedias costosas.', array( 'alternativa zapier make argentina', 'automatización pyme google cloud', 'cloud functions erp' ) ),
		'competencia/cumbre-web-vs-hosting-compartido' => gema_sovereign_make_comparison_page( 'Cumbre Web vs hosting compartido', 'CMS headless conectado al CRM', 'Comparativa para empresas que necesitan web rápida, SEO y captación conectada con CRM.', 'Los sitios en hosting compartido pueden ser lentos, frágiles y desconectados de ventas.', 'Cumbre Web propone CMS headless y blogs optimizados para SEO sobre Cloud Run, conectados nativamente al CRM de leads.', 'Velocidad, SEO técnico y trazabilidad comercial desde el primer contacto.', array( 'cms headless argentina', 'web seo para erp', 'cloud run wordpress crm' ) ),
		'competencia/cumbre-ecommerce-mercado-libre-vs-sync-legacy' => gema_sovereign_make_comparison_page( 'Cumbre eCommerce y Mercado Libre vs sincronizadores legacy', 'Sync sub-segundo de stock', 'Comparativa de integración ecommerce y Mercado Libre frente a sincronizadores lentos que generan quiebres de stock.', 'Los integradores tradicionales pueden tardar demasiado en sincronizar stock y provocar ventas imposibles, cancelaciones y penalizaciones.', 'Cumbre eCommerce y Mercado Libre busca sincronizar stock físico, pedidos y publicaciones online para reducir quiebres, cancelaciones y trabajo manual.', 'Protección de reputación, stock y margen en canales digitales.', array( 'mercado libre erp stock', 'sincronización stock mercado libre', 'ecommerce erp argentina' ) ),
		'competencia/cumbre-kioscos-vs-software-kioscos' => gema_sovereign_make_comparison_page( 'Cumbre Kioscos vs software de kioscos tradicional', 'Actualizador inteligente de góndolas', 'Comparativa para kioscos con inflación, miles de SKUs y listas de proveedores que cambian cada semana.', 'La actualización manual de precios en kioscos es casi imposible con inflación diaria y listas extensas de proveedores.', 'El kiosquero reenvía el PDF de su distribuidor al agente de IA. El sistema lee el documento, actualiza costos y recalcula precio de góndola según margen.', 'Menos horas de carga y menor pérdida de margen por precios atrasados.', array( 'software para kioscos argentina', 'actualizar precios kiosco pdf', 'erp kioscos ia' ) ),
		'competencia/cumbre-resto-vs-software-restaurantes' => gema_sovereign_make_comparison_page( 'Cumbre Resto vs software para restaurantes tradicional', 'WhatsApp Zero-UI Comandas', 'Comparativa para restaurantes, bares y restos que necesitan velocidad en comandas y facturación.', 'Los sistemas tradicionales dependen de pantallas lentas o papelitos que retrasan cocina y caja.', 'El mozo habla a un grupo cerrado de WhatsApp. Vertex procesa el audio, extrae ítems, envía la comanda a cocina y abre el ticket en caja.', 'Zero-UI para operación gastronómica real, sin fricción en salón.', array( 'software para restaurant y resto command de voz', 'comandas whatsapp ia', 'sistema restaurante argentina' ) ),
		'competencia/cumbre-depositos-wms-vs-lectores-manuales' => gema_sovereign_make_comparison_page( 'Cumbre Depósitos WMS vs lectores manuales', 'Visión computacional para inventario', 'Comparativa de gestión de depósitos WMS con visión computacional frente a carga manual y pistolas lectoras.', 'Los lectores manuales son lentos, caros y frágiles para operaciones con racks, etiquetas y rotación alta.', 'El operario puede relevar racks con su celular y asistencia de visión computacional para acelerar control de QR, códigos de barra, etiquetas y vencimientos.', 'Inventario más rápido, menos hardware dedicado y mejor control de vencimientos.', array( 'sistema de gestión de stock wms', 'inventario visión computacional', 'wms argentina ia' ) ),
		'competencia/cumbre-constructoras-vs-software-construccion' => gema_sovereign_make_comparison_page( 'Cumbre Constructoras vs software de construcción tradicional', 'Índice CAC y redeterminación automática', 'Comparativa para constructoras que necesitan redeterminar certificados, proteger margen y facturar readecuaciones.', 'La redeterminación manual queda atrasada frente a inflación, devaluación e Índice CAC.', 'El agente puede asistir el cálculo y preparar documentación; la factura ARCA queda sujeta a piloto fiscal controlado e implementación asistida.', 'Automatización de obra, costos y facturación fiscal en un mismo flujo.', array( 'software para constructoras indice cac', 'redeterminación certificados obra', 'erp constructoras argentina' ) ),
		'competencia/cumbre-agro-vs-software-agro' => gema_sovereign_make_comparison_page( 'Cumbre Agro vs software agro manual', 'Ingesta inteligente de CPe y LPG', 'Comparativa para acopios y agroindustria con Cartas de Porte electrónicas, Liquidaciones Primarias de Granos y trazabilidad.', 'La carga de CPe y LPG suele ser burocrática, manual y lenta en campo o administración.', 'El transportista envía una foto de la Carta de Porte. El agente extrae patentes, peso neto, valida datos y precarga libros de compras.', 'Menos carga operativa y más trazabilidad para acopios y operaciones rurales.', array( 'sistema de gestión para agro lpg', 'carta de porte electrónica ia', 'software agro argentina' ) ),
		'competencia/cumbre-mercados-vs-software-retail' => gema_sovereign_make_comparison_page( 'Cumbre Mercados vs software retail tradicional', 'Precios dinámicos por merma', 'Comparativa para mercados y retail alimenticio que pierden margen por vencimientos y mermas.', 'Los sistemas tradicionales no cruzan cámaras, inventario y ecommerce para reaccionar ante productos próximos a vencer.', 'Cumbre Mercados detecta mercadería próxima a vencer, dispara descuentos automáticos en ecommerce y actualiza etiquetas digitales en góndola.', 'Menos merma, más rotación y mejor sincronización físico-digital.', array( 'software retail alimentos frescos', 'precios dinámicos merma', 'erp mercados argentina' ) ),
	);

	return $pages;
}

function gema_sovereign_get_authority_references( string $path ): array {
	$references = array(
		'gestion'             => array(
			array( 'Normas internacionales de gestión de calidad ISO', 'https://www.iso.org/' ),
		),
		'empresas'            => array(
			array( 'Estrategia digital de la Unión Europea', 'https://digital-strategy.ec.europa.eu/' ),
			array( 'Productividad empresarial según la OCDE', 'https://www.oecd.org/' ),
		),
		'marketing'           => array(
			array( 'Documentación oficial de Google Search Central', 'https://developers.google.com/search/docs' ),
			array( 'Buenas prácticas de medición digital en Google Analytics', 'https://support.google.com/analytics' ),
		),
		'automatizacion'      => array(
			array( 'Concepto de hiperautomatización según Gartner', 'https://www.gartner.com/en/information-technology/glossary/hyperautomation' ),
		),
		'integraciones'       => array(
			array( 'Arquitectura de servicios web REST', 'https://restfulapi.net/' ),
			array( 'Estándares PCI para seguridad de pagos', 'https://www.pci-securitystandards.org/' ),
		),
		'tecnologia'          => array(
			array( 'Fundamentos de computación en la nube de Google Cloud', 'https://cloud.google.com/learn' ),
		),
		'blog'                => array(
			array( 'World Economic Forum sobre futuro del empleo y tecnología', 'https://www.weforum.org/' ),
			array( 'Documentación oficial de Google Search Central', 'https://developers.google.com/search/docs' ),
		),
		'competencia'         => array(
			array( 'Comparativas de software de gestión en Capterra', 'https://www.capterra.es/' ),
		),
		'nosotros'            => array(
			array( 'Recomendación de UNESCO sobre ética de la inteligencia artificial', 'https://www.unesco.org/en/artificial-intelligence/recommendation-ethics' ),
		),
		'privacidad'          => array(
			array( 'Guía oficial de la AEPD sobre protección de datos', 'https://www.aepd.es/' ),
		),
		'terminos'            => array(
			array( 'Boletín Oficial del Estado sobre legislación vigente', 'https://www.boe.es/' ),
		),
		'politica-de-cookies' => array(
			array( 'Guía oficial de la AEPD sobre cookies', 'https://www.aepd.es/guía-cookies' ),
		),
		'legal/cumbre' => array(
			array( 'AAIP - obligaciones de responsables de bases de datos personales', 'https://www.argentina.gob.ar/aaip/datospersonales/responsables/obligaciones' ),
			array( 'Ley simple - Propiedad intelectual en Argentina', 'https://www.argentina.gob.ar/justicia/derechofacil/leysimple/propiedad-intelectual' ),
			array( 'BCRA - Registro de proveedores de servicios de pago', 'https://www.bcra.gob.ar/registro-de-proveedores-de-servicios-de-pago/' ),
		),
		'legal/cumbre-terminos-servicio' => array(
			array( 'Ley 25.506 de firma digital y electrónica', 'https://www.argentina.gob.ar/normativa/nacional/ley-25506-70749/actualizacion' ),
			array( 'Ley 24.240 de Defensa del Consumidor', 'https://www.argentina.gob.ar/justicia/derechofacil/leysimple/defensa-del-consumidor' ),
		),
		'legal/cumbre-privacidad-dpa' => array(
			array( 'AAIP - obligaciones de responsables de bases de datos personales', 'https://www.argentina.gob.ar/aaip/datospersonales/responsables/obligaciones' ),
			array( 'Ley simple - Datos personales', 'https://www.argentina.gob.ar/justicia/derechofacil/leysimple/datos-personales' ),
		),
		'legal/cumbre-propiedad-intelectual' => array(
			array( 'Ley simple - Propiedad intelectual', 'https://www.argentina.gob.ar/justicia/derechofacil/leysimple/propiedad-intelectual' ),
			array( 'DNDA - Depósito en custodia de software inédito', 'https://www.argentina.gob.ar/servicio/deposito-en-custodia-de-obra-inedita-software' ),
			array( 'WIPO Lex - Ley argentina de marcas', 'https://www.wipo.int/wipolex/es/legislation/details/19069' ),
		),
		'legal/cumbre-pagos-arca-ia' => array(
			array( 'BCRA - Registro de proveedores de servicios de pago', 'https://www.bcra.gob.ar/registro-de-proveedores-de-servicios-de-pago/' ),
			array( 'PCI Security Standards Council', 'https://www.pci-securitystandards.org/' ),
			array( 'AAIP - Programa de transparencia y protección de datos personales en IA', 'https://www.argentina.gob.ar/programa-nacional-de-transparencia-y-proteccion-de-datos-personales-en-el-uso-de-la-inteligencia' ),
		),
		'legal/cumbre-seguridad-baja' => array(
			array( 'Resolución AAIP 47/2018 sobre medidas de seguridad recomendadas', 'https://www.argentina.gob.ar/normativa/nacional/resoluci%C3%B3n-47-2018-312662/texto' ),
			array( 'Ley simple - Datos personales', 'https://www.argentina.gob.ar/justicia/derechofacil/leysimple/datos-personales' ),
		),
		'legal/cumbre-comunicaciones-modulos' => array(
			array( 'Registro Nacional No Llame', 'https://nollame.aaip.gob.ar/faqs.html' ),
			array( 'Ley 26.951 - Registro Nacional No Llame', 'https://www.argentina.gob.ar/normativa/nacional/ley-26951-233066/texto' ),
		),
	);

	return $references[ trim( $path, '/' ) ] ?? array();
}

function gema_sovereign_get_cumbre_legal_links(): array {
	return array(
		array( 'Centro legal Cumbre', '/legal/cumbre', 'Resumen de términos, privacidad, propiedad intelectual, pagos, ARCA, IA, seguridad, baja y módulos.' ),
		array( 'Términos de Servicio SaaS Cumbre', '/legal/cumbre-terminos-servicio', 'Licencia de uso, planes, límites, responsabilidades, suspensión, baja e integraciones.' ),
		array( 'Privacidad y DPA Cumbre', '/legal/cumbre-privacidad-dpa', 'Datos personales, roles de responsable y encargado, subprocesadores, derechos ARCO y transferencias.' ),
		array( 'Propiedad intelectual Cumbre', '/legal/cumbre-propiedad-intelectual', 'Software, marcas, código, interfaces, documentación, prompts, flujos y derechos reservados.' ),
		array( 'Pagos, ARCA e IA', '/legal/cumbre-pagos-arca-ia', 'Condiciones para Cumbre Cobros, proveedores de pago, Facturador ARCA y asistentes de IA.' ),
		array( 'Seguridad, baja y exportación', '/legal/cumbre-seguridad-baja', 'Seguridad razonable, disponibilidad, backups, soporte, retención, baja y exportación de datos.' ),
		array( 'Comunicaciones y módulos', '/legal/cumbre-comunicaciones-modulos', 'CRM, marketing, Registro No Llame, uso aceptable, contenidos del cliente y anexos por módulo.' ),
	);
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

	$primary_cta_label   = $page['primary_cta_label'] ?? 'Solicitar diagnóstico';
	$primary_cta_url     = $page['primary_cta_url'] ?? '/contacto';
	$secondary_cta_label = $page['secondary_cta_label'] ?? 'Volver al inicio';
	$secondary_cta_url   = $page['secondary_cta_url'] ?? '/';
	$modules_title       = $page['modules_title'] ?? 'Qué resuelve esta página';
	$list_title          = $page['list_title'] ?? 'Información útil para decidir';
	$links_title         = $page['links_title'] ?? 'Enlaces relacionados';
	$faq_title           = $page['faq_title'] ?? 'Respuestas rápidas';
	$bottom_cta_title    = $page['bottom_cta_title'] ?? 'Solicitá un diagnóstico para elegir el mejor camino';
	$bottom_cta_copy     = $page['bottom_cta_copy'] ?? 'Revisamos tu operación, prioridades e integraciones antes de recomendar una solución concreta.';

	$links_section = '';
	if ( ! empty( $page['links'] ) && is_array( $page['links'] ) ) {
		$link_cards = '';
		foreach ( $page['links'] as $link ) {
			$link_cards .= sprintf(
				'<article class="cumbre-module-card gema-comparison-link-card"><span>%s</span><h3><a href="%s">%s</a></h3><p>%s</p></article>',
				esc_html( wp_parse_url( $link[1], PHP_URL_PATH ) ?: $link[1] ),
				esc_url( $link[1] ),
				esc_html( $link[0] ),
				esc_html( $link[2] )
			);
		}

		$links_section = sprintf(
			'<!-- wp:group {"tagName":"section","className":"gema-content-section gema-comparison-links-section","layout":{"type":"constrained"}} --><section class="wp-block-group gema-content-section gema-comparison-links-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Enlaces relacionados</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">%s</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"gema-section-copy"} --><p class="gema-section-copy">Rutas útiles para comparar, ampliar alcance o pedir asesoramiento según el momento del negocio.</p><!-- /wp:paragraph --><!-- wp:html --><div class="cumbre-module-grid cumbre-module-grid--dense gema-comparison-link-grid">%s</div><!-- /wp:html --></section><!-- /wp:group -->',
			esc_html( $links_title ),
			$link_cards
		);
	}

	$custom_sections = '';
	if ( ! empty( $page['custom_sections'] ) && is_string( $page['custom_sections'] ) ) {
		$custom_sections = $page['custom_sections'];
	}

	$module_links_section = gema_sovereign_build_cumbre_module_links_section( $path );

	$authority_section = $module_links_section . $links_section . $authority_section;

	$bottom_cta_section = sprintf(
		'<!-- wp:group {"tagName":"section","className":"gema-content-section cumbre-ai-section","layout":{"type":"constrained"}} --><section class="wp-block-group gema-content-section cumbre-ai-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Próximo paso</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">%s</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"gema-section-copy"} --><p class="gema-section-copy">%s</p><!-- /wp:paragraph --><!-- wp:buttons {"className":"gema-content-actions"} --><div class="wp-block-buttons gema-content-actions"><!-- wp:button {"className":"btn-cta-primary"} --><div class="wp-block-button btn-cta-primary"><a class="wp-block-button__link wp-element-button" href="%s">%s</a></div><!-- /wp:button --><!-- wp:button {"className":"btn-cta-secondary"} --><div class="wp-block-button btn-cta-secondary"><a class="wp-block-button__link wp-element-button" href="%s">%s</a></div><!-- /wp:button --></div><!-- /wp:buttons --></section><!-- /wp:group -->',
		esc_html( $bottom_cta_title ),
		esc_html( $bottom_cta_copy ),
		esc_url( $primary_cta_url ),
		esc_html( $primary_cta_label ),
		esc_url( $secondary_cta_url ),
		esc_html( $secondary_cta_label )
	);

	return sprintf(
		'<!-- wp:group {"tagName":"section","className":"gema-content-hero","layout":{"type":"constrained"}} --><section class="wp-block-group gema-content-hero"><!-- wp:paragraph {"className":"gema-kicker"} --><p class="gema-kicker">%1$s</p><!-- /wp:paragraph --><!-- wp:heading {"level":1,"className":"cumbre-title"} --><h1 class="wp-block-heading cumbre-title">%2$s</h1><!-- /wp:heading --><!-- wp:paragraph {"className":"gema-content-copy"} --><p class="gema-content-copy">%3$s</p><!-- /wp:paragraph --><!-- wp:buttons {"className":"gema-content-actions"} --><div class="wp-block-buttons gema-content-actions"><!-- wp:button {"className":"btn-cta-primary"} --><div class="wp-block-button btn-cta-primary"><a class="wp-block-button__link wp-element-button" href="%12$s">%11$s</a></div><!-- /wp:button --><!-- wp:button {"className":"btn-cta-secondary"} --><div class="wp-block-button btn-cta-secondary"><a class="wp-block-button__link wp-element-button" href="%14$s">%13$s</a></div><!-- /wp:button --></div><!-- /wp:buttons -->%7$s</section><!-- /wp:group --><!-- wp:group {"tagName":"section","className":"gema-content-section","layout":{"type":"constrained"}} --><section class="wp-block-group gema-content-section"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Puntos clave</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">%9$s</h2><!-- /wp:heading --><!-- wp:html --><div class="gema-content-grid">%4$s</div><!-- /wp:html --></section><!-- /wp:group --><!-- wp:group {"tagName":"section","className":"gema-content-section gema-content-band","layout":{"type":"constrained"}} --><section class="wp-block-group gema-content-section gema-content-band"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">Resumen operativo</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">%10$s</h2><!-- /wp:heading --><!-- wp:html --><div class="gema-content-list">%5$s</div><!-- /wp:html --></section><!-- /wp:group -->%17$s%8$s%15$s<!-- wp:group {"tagName":"section","className":"gema-faq-section","layout":{"type":"constrained"}} --><section class="wp-block-group gema-faq-section" aria-label="Preguntas frecuentes"><!-- wp:paragraph {"className":"gema-section-kicker"} --><p class="gema-section-kicker">FAQ SEO</p><!-- /wp:paragraph --><!-- wp:heading {"level":2,"className":"gema-section-title"} --><h2 class="wp-block-heading gema-section-title">%16$s</h2><!-- /wp:heading --><!-- wp:html --><div class="gema-faq-list">%6$s</div><!-- /wp:html --></section><!-- /wp:group -->',
		esc_html( $page['kicker'] ),
		esc_html( $page['title'] ),
		esc_html( $page['description'] ),
		$modules,
		$list,
		$faq,
		$visual,
		$authority_section,
		esc_html( $modules_title ),
		esc_html( $list_title ),
		esc_html( $primary_cta_label ),
		esc_url( $primary_cta_url ),
		esc_html( $secondary_cta_label ),
		esc_url( $secondary_cta_url ),
		$bottom_cta_section,
		esc_html( $faq_title ),
		$custom_sections
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

		$breadcrumb_parents = array();
		$clean_path         = trim( $path, '/' );
		if ( 0 === strpos( $clean_path, 'erp-cumbre/' ) ) {
			$breadcrumb_parents[] = array( 'ERP Cumbre', '/erp-cumbre/' );
		} elseif ( 0 === strpos( $clean_path, 'competencia/' ) ) {
			$breadcrumb_parents[] = array( 'Comparativas', '/competencia/' );
		} elseif ( 0 === strpos( $clean_path, 'legal/' ) && 'legal/cumbre' !== $clean_path ) {
			$breadcrumb_parents[] = array( 'Legal Cumbre', '/legal/cumbre/' );
		}

		$schema = array(
			'@context' => 'https://schema.org',
			'@graph'   => array(
				gema_sovereign_get_organization_schema(),
				$webpage,
				gema_sovereign_get_breadcrumb_schema( '/' . $clean_path . '/', $page['title'], $breadcrumb_parents ),
				array(
					'@type'      => 'FAQPage',
					'@id'        => home_url( '/' . trim( $path, '/' ) . '/#faq' ),
					'inLanguage' => 'es-AR',
					'mainEntity' => $faq,
				),
			),
		);

		if ( in_array( trim( $path, '/' ), array( 'cumbre-crm', 'cumbre/crm' ), true ) ) {
			$schema['@graph'][] = array(
				'@type'               => 'SoftwareApplication',
				'@id'                 => home_url( '/cumbre-crm/#software' ),
				'name'                => 'Cumbre CRM',
				'applicationCategory' => 'BusinessApplication',
				'operatingSystem'     => 'Web',
				'url'                 => home_url( '/cumbre-crm/' ),
				'description'         => $page['meta_description'] ?? $page['description'],
				'offers'              => array(
					'@type'         => 'Offer',
					'priceCurrency' => 'ARS',
					'availability'  => 'https://schema.org/PreOrder',
					'description'   => 'Demo comercial, prueba de 14 días e implementación asistida según alcance.',
				),
				'publisher'           => array(
					'@id' => home_url( '/#organization' ),
				),
			);

			$schema['@graph'][] = array(
				'@type'       => 'Product',
				'@id'         => home_url( '/cumbre-crm/#product' ),
				'name'        => 'Cumbre CRM',
				'brand'       => array(
					'@type' => 'Brand',
					'name'  => 'ERP Cumbre',
				),
				'description' => 'CRM para PyMEs argentinas con presupuestos, catálogo, stock, cobros y facturación ARCA en piloto controlado.',
				'category'    => 'CRM y software de gestión comercial',
			);
		}

		if ( in_array( trim( $path, '/' ), array( 'cumbre-erp-negocios', 'cumbre/negocios' ), true ) ) {
			$schema['@graph'][] = array(
				'@type'               => 'SoftwareApplication',
				'@id'                 => home_url( '/cumbre-erp-negocios/#software' ),
				'name'                => 'Cumbre ERP Negocios',
				'applicationCategory' => 'BusinessApplication',
				'operatingSystem'     => 'Web',
				'url'                 => home_url( '/cumbre-erp-negocios/' ),
				'description'         => $page['meta_description'] ?? $page['description'],
				'offers'              => array(
					'@type'         => 'AggregateOffer',
					'priceCurrency' => 'USD',
					'lowPrice'      => '15',
					'highPrice'     => '95',
					'description'   => 'Promo de lanzamiento 20% OFF por tiempo limitado, con planes desde Micro hasta Multi.',
				),
				'publisher'           => array(
					'@id' => home_url( '/#organization' ),
				),
			);

			$schema['@graph'][] = array(
				'@type'       => 'Product',
				'@id'         => home_url( '/cumbre-erp-negocios/#product' ),
				'name'        => 'Cumbre ERP Negocios',
				'brand'       => array(
					'@type' => 'Brand',
					'name'  => 'ERP Cumbre',
				),
				'description' => 'Sistema POS y gestión económica para kioscos, almacenes, mercados, restaurantes chicos y depósitos simples.',
				'category'    => 'Sistema POS y software de gestión para comercios minoristas',
			);
		}

		$cumbre_application_pages = array(
			'erp-cumbre/cumbre-facturador-arca' => array(
				'id'          => '/erp-cumbre/cumbre-facturador-arca',
				'name'        => 'Cumbre Facturador ARCA',
				'category'    => 'Facturación electrónica ARCA y documentación fiscal',
				'description' => 'Facturación electrónica ARCA integrada al ERP con CAE, errores trazables, cobros, documentos comerciales y producción asistida.',
			),
			'erp-cumbre/cumbre-cobros'          => array(
				'id'          => '/erp-cumbre/cumbre-cobros',
				'name'        => 'Cumbre Cobros',
				'category'    => 'Links de pago, QR, webhooks y conciliación',
				'description' => 'Módulo de cobros para PyMEs con links de pago, QR, transferencias, tarjetas, billeteras, webhooks y conciliación.',
			),
			'erp-cumbre/cumbre-whatsapp-hub'    => array(
				'id'          => '/erp-cumbre/cumbre-whatsapp-hub',
				'name'        => 'Cumbre WhatsApp Hub',
				'category'    => 'WhatsApp Business API conectado al ERP',
				'description' => 'WhatsApp Business API para PyMEs conectada a CRM, módulos ERP, opt-in, plantillas, webhooks y trazabilidad.',
			),
		);

		$cumbre_application = $cumbre_application_pages[ trim( $path, '/' ) ] ?? null;
		if ( $cumbre_application ) {
			$software_url       = home_url( $cumbre_application['id'] . '/' );
			$schema['@graph'][] = array(
				'@type'               => 'SoftwareApplication',
				'@id'                 => home_url( $cumbre_application['id'] . '/#software' ),
				'name'                => $cumbre_application['name'],
				'applicationCategory' => 'BusinessApplication',
				'operatingSystem'     => 'Web',
				'url'                 => $software_url,
				'description'         => $cumbre_application['description'],
				'offers'              => array(
					'@type'         => 'Offer',
					'priceCurrency' => 'USD',
					'availability'  => 'https://schema.org/InStock',
					'description'   => 'Demo, prueba o implementación asistida según alcance del módulo.',
				),
				'publisher'           => array(
					'@id' => home_url( '/#organization' ),
				),
			);

			$schema['@graph'][] = array(
				'@type'       => 'Product',
				'@id'         => home_url( $cumbre_application['id'] . '/#product' ),
				'name'        => $cumbre_application['name'],
				'brand'       => array(
					'@type' => 'Brand',
					'name'  => 'ERP Cumbre',
				),
				'description' => $cumbre_application['description'],
				'category'    => $cumbre_application['category'],
			);
		}

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
		$force_update = in_array( $path, array( 'gestion', 'empresas', 'marketing', 'automatizacion', 'nosotros', 'contacto', 'servicios', 'terminos', 'privacidad', 'politica-de-cookies', 'blog', 'competencia', 'integraciones', 'tecnologia', 'erp/precios', 'erp/funciones/facturacion-electronica', 'ia/automatizacion-whatsapp', 'cumbre', 'cumbre-crm', 'cumbre-erp-negocios' ), true ) || 0 === strpos( $path, 'competencia/' ) || 0 === strpos( $path, 'cumbre/' ) || 0 === strpos( $path, 'pagos/' ) || 0 === strpos( $path, 'legal/' );

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

require_once get_stylesheet_directory() . '/inc/seo-yoast.php';

