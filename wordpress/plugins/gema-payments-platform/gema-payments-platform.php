<?php
/**
 * Plugin Name: GEMA Payments Platform
 * Description: Capa base para proveedores de pago, webhooks y auditoría operativa de GEMA.
 * Version: 0.2.4
 * Author: GEMA Digital
 * Text Domain: gema-payments-platform
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const GEMA_PAYMENTS_OPTION = 'gema_payments_platform_settings';

function gema_payments_get_provider_catalog(): array {
	return array(
		'bank_transfer' => array(
			'label'       => 'Transferencia bancaria',
			'country'     => 'AR',
			'page'        => '/pagos/transferencia-bancaria',
			'description' => 'CBU/CVU/Alias, comprobantes y conciliación administrativa.',
			'status'      => 'active',
			'priority'    => 2,
		),
		'nave'          => array(
			'label'       => 'Nave Galicia',
			'country'     => 'AR',
			'page'        => '/pagos/nave',
			'description' => 'Tarjetas, QR, Naranja X y checkout online vía Nave Galicia.',
			'status'      => 'active',
			'priority'    => 1,
		),
		'mercado_pago'  => array(
			'label'       => 'Mercado Pago',
			'country'     => 'AR',
			'page'        => '/pagos/mercado-pago',
			'description' => 'Checkout, links de pago, QR, suscripciones y webhooks.',
			'status'      => 'deferred',
			'deferred_label' => 'Próximamente',
			'priority'    => 90,
		),
		'mercado_libre' => array(
			'label'       => 'Mercado Libre',
			'country'     => 'AR',
			'page'        => '/pagos/mercado-libre',
			'description' => 'Publicaciones, órdenes seller y conciliación ML.',
			'status'      => 'deferred',
			'deferred_label' => 'Próximamente',
			'priority'    => 91,
		),
		'paypal'        => array(
			'label'       => 'PayPal',
			'country'     => 'GLOBAL',
			'page'        => '/pagos/paypal',
			'description' => 'Checkout internacional, sandbox/producción y webhooks.',
			'status'      => 'deferred',
			'deferred_label' => 'Próximamente',
			'priority'    => 92,
		),
		'stripe'        => array(
			'label'       => 'Stripe',
			'country'     => 'GLOBAL',
			'page'        => '/pagos/stripe',
			'description' => 'Tarjetas, Checkout, suscripciones y webhooks firmados.',
			'status'      => 'deferred',
			'deferred_label' => 'Próximamente',
			'priority'    => 93,
		),
	);
}

function gema_payments_provider_is_active( string $provider ): bool {
	$catalog = gema_payments_get_provider_catalog();
	if ( ! array_key_exists( $provider, $catalog ) ) {
		return false;
	}

	return ( $catalog[ $provider ]['status'] ?? 'deferred' ) === 'active';
}

function gema_payments_list_active_checkout_providers(): array {
	$catalog = gema_payments_get_provider_catalog();
	$active  = array_filter(
		$catalog,
		static function ( array $config ): bool {
			return ( $config['status'] ?? 'deferred' ) === 'active';
		}
	);

	uasort(
		$active,
		static function ( array $a, array $b ): int {
			return ( $a['priority'] ?? 99 ) <=> ( $b['priority'] ?? 99 );
		}
	);

	return $active;
}

function gema_payments_get_settings(): array {
	$settings = get_option( GEMA_PAYMENTS_OPTION, array() );

	return is_array( $settings ) ? $settings : array();
}

function gema_payments_provider_is_configured( string $provider ): bool {
	$settings = gema_payments_get_settings();
	$provider_settings = $settings[ $provider ] ?? array();

	if ( 'bank_transfer' === $provider ) {
		return ! empty( $provider_settings['account_alias'] ) || ! empty( $provider_settings['cbu'] ) || ! empty( $provider_settings['cvu'] );
	}

	return ! empty( $provider_settings['enabled'] ) && ! empty( $provider_settings['webhook_secret'] );
}

function gema_payments_register_event_post_type(): void {
	register_post_type(
		'gema_payment_event',
		array(
			'labels'       => array(
				'name'          => 'Eventos de pago',
				'singular_name' => 'Evento de pago',
			),
			'public'       => false,
			'show_ui'      => current_user_can( 'manage_options' ),
			'show_in_menu' => 'tools.php',
			'supports'     => array( 'title', 'custom-fields' ),
			'capability_type' => 'post',
		)
	);
}
add_action( 'init', 'gema_payments_register_event_post_type' );

function gema_payments_register_rest_routes(): void {
	register_rest_route(
		'gema-payments/v1',
		'/providers',
		array(
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => 'gema_payments_rest_get_providers',
			'permission_callback' => '__return_true',
		)
	);

	register_rest_route(
		'gema-payments/v1',
		'/webhooks/(?P<provider>[a-z0-9_-]+)',
		array(
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => 'gema_payments_rest_receive_webhook',
			'permission_callback' => '__return_true',
			'args'                => array(
				'provider' => array(
					'required'          => true,
					'validate_callback' => 'gema_payments_validate_provider',
				),
			),
		)
	);

	register_rest_route(
		'gema-payments/v1',
		'/cart',
		array(
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => 'gema_payments_rest_get_cart',
			'permission_callback' => '__return_true',
		)
	);

	register_rest_route(
		'gema-payments/v1',
		'/cart/items',
		array(
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => 'gema_payments_rest_add_cart_item',
			'permission_callback' => '__return_true',
		)
	);

	register_rest_route(
		'gema-payments/v1',
		'/cart/checkout',
		array(
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => 'gema_payments_rest_checkout_cart',
			'permission_callback' => '__return_true',
		)
	);

	register_rest_route(
		'gema-payments/v1',
		'/trial/card-requirements',
		array(
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => 'gema_payments_rest_trial_card_requirements',
			'permission_callback' => '__return_true',
		)
	);

	register_rest_route(
		'gema-payments/v1',
		'/trial/validate-format',
		array(
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => 'gema_payments_rest_trial_validate_card_format',
			'permission_callback' => '__return_true',
		)
	);
}
add_action( 'rest_api_init', 'gema_payments_register_rest_routes' );

function gema_payments_get_institutional_catalog(): array {
	return array(
		'erp_pymes_trial' => array(
			'label'       => 'ERP Cumbre PyMEs — prueba 14 días',
			'description' => 'Diagnóstico comercial + activación trial por módulo.',
			'price_label' => 'Consultar',
			'cta'         => '/contacto',
		),
		'erp_negocios_trial' => array(
			'label'       => 'ERP Cumbre Negocios — prueba 14 días',
			'description' => 'Mostrador, caja, stock y reposición diaria.',
			'price_label' => 'Consultar',
			'cta'         => '/contacto',
		),
		'modulo_cobros' => array(
			'label'       => 'Módulo Cumbre Cobros',
			'description' => 'Links, QR, transferencias, tarjetas y conciliación.',
			'price_label' => 'Desde USD 12/mes',
			'cta'         => '/erp-cumbre/cumbre-cobros',
		),
		'modulo_cobros_base' => array(
			'label'       => 'Cumbre Cobros Base',
			'description' => 'Hasta 5 medios, 50 eventos/mes, 1 webhook, 0% comisión Cumbre.',
			'price_label' => 'USD 12/mes lanzamiento',
			'cta'         => '/erp-cumbre/cumbre-cobros',
		),
		'modulo_cobros_standard' => array(
			'label'       => 'Cumbre Cobros Standard',
			'description' => 'Hasta 12 medios, 5.000 eventos/mes, conciliación asistida. Plan recomendado.',
			'price_label' => 'USD 31/mes lanzamiento',
			'cta'         => '/erp-cumbre/cumbre-cobros',
		),
		'modulo_cobros_full' => array(
			'label'       => 'Cumbre Cobros Full',
			'description' => 'Hasta 18 medios, 25.000 eventos/mes, conciliación masiva.',
			'price_label' => 'USD 79/mes lanzamiento',
			'cta'         => '/erp-cumbre/cumbre-cobros',
		),
		'modulo_facturador' => array(
			'label'       => 'Módulo Facturador ARCA',
			'description' => 'Emisión fiscal controlada e implementación asistida.',
			'price_label' => 'Consultar',
			'cta'         => '/erp-cumbre/cumbre-facturador-arca',
		),
		'studio_base' => array(
			'label'       => 'Cumbre Studio IA — Base',
			'description' => '12 clips, 24 imágenes y 3 piezas publicables/mes. Guiones, montaje 16:9/9:16 y aprobación.',
			'price_label' => 'USD 31/mes lanzamiento',
			'cta'         => '/erp-cumbre/cumbre-studio-ia',
		),
		'studio_pro' => array(
			'label'       => 'Cumbre Studio IA — Pro',
			'description' => '40 clips, 80 imágenes, 10 piezas/mes, 4:3, subtítulos y cola Marketing. Plan recomendado.',
			'price_label' => 'USD 63/mes lanzamiento',
			'cta'         => '/erp-cumbre/cumbre-studio-ia',
		),
		'studio_full' => array(
			'label'       => 'Cumbre Studio IA — Full',
			'description' => '120 clips, 250 imágenes, 30 piezas/mes, hero premium y prioridad de cola.',
			'price_label' => 'USD 119/mes lanzamiento',
			'cta'         => '/erp-cumbre/cumbre-studio-ia',
		),
		'pack_50_clips_video' => array(
			'label'       => 'Pack 50 clips video IA',
			'description' => 'Capacidad adicional de clips de 6s para Studio IA.',
			'price_label' => 'USD 12 lanzamiento',
			'cta'         => '/erp-cumbre/cumbre-studio-ia',
		),
		'pack_200_imagenes' => array(
			'label'       => 'Pack 200 imágenes IA',
			'description' => 'Capacidad adicional de imágenes para carátulas y piezas.',
			'price_label' => 'USD 10 lanzamiento',
			'cta'         => '/erp-cumbre/cumbre-studio-ia',
		),
		'pack_10_piezas_publicables' => array(
			'label'       => 'Pack 10 piezas publicables',
			'description' => 'Piezas listas con montaje, voz y exportación al calendario Marketing.',
			'price_label' => 'USD 39 lanzamiento',
			'cta'         => '/erp-cumbre/cumbre-studio-ia',
		),
		'bloque_clips_video_adicional' => array(
			'label'       => 'Bloque +20 clips video / mes',
			'description' => 'Capacidad recurrente mensual para Studio IA.',
			'price_label' => 'USD 15/mes lanzamiento',
			'cta'         => '/erp-cumbre/cumbre-studio-ia',
		),
		'bloque_imagenes_adicional' => array(
			'label'       => 'Bloque +50 imágenes / mes',
			'description' => 'Capacidad recurrente mensual para Studio IA.',
			'price_label' => 'USD 7/mes lanzamiento',
			'cta'         => '/erp-cumbre/cumbre-studio-ia',
		),
		'bundle_marketing_studio_base' => array(
			'label'       => 'Bundle Marketing Redes + Studio Base',
			'description' => 'Marketing Redes + Studio Base con −15% sobre precios de lanzamiento.',
			'price_label' => 'USD 80/mes aprox.',
			'cta'         => '/erp-cumbre/cumbre-marketing',
		),
	);
}

function gema_payments_get_cart_session_key( WP_REST_Request $request ): string {
	$session = sanitize_text_field( (string) $request->get_param( 'session_id' ) );
	if ( '' === $session ) {
		$session = sanitize_text_field( (string) $request->get_header( 'x-gema-cart-session' ) );
	}
	if ( '' === $session ) {
		$session = wp_generate_uuid4();
	}

	return 'gema_cart_' . md5( $session );
}

function gema_payments_get_cart( string $session_key ): array {
	$cart = get_transient( $session_key );
	return is_array( $cart ) ? $cart : array( 'items' => array(), 'updated_at' => gmdate( 'c' ) );
}

function gema_payments_save_cart( string $session_key, array $cart ): void {
	$cart['updated_at'] = gmdate( 'c' );
	set_transient( $session_key, $cart, DAY_IN_SECONDS );
}

function gema_payments_rest_get_cart( WP_REST_Request $request ): WP_REST_Response {
	$session_key = gema_payments_get_cart_session_key( $request );
	$cart        = gema_payments_get_cart( $session_key );

	return rest_ensure_response(
		array(
			'status'    => 'ready_for_commercial_checkout',
			'session'   => str_replace( 'gema_cart_', '', $session_key ),
			'catalog'   => gema_payments_get_institutional_catalog(),
			'cart'      => $cart,
			'checkout'  => array(
				'mode'              => 'commercial_contact',
				'message'           => 'El checkout self-serve se coordina con ventas hasta conectar Gema Pagos / Cumbre Cobros.',
				'contact'           => home_url( '/contacto/' ),
				'precios'           => home_url( '/erp/precios/' ),
				'active_providers'  => array_keys( gema_payments_list_active_checkout_providers() ),
				'deferred_providers'=> array_values(
					array_map(
						static function ( string $provider ): string {
							return $provider;
						},
						array_keys(
							array_filter(
								gema_payments_get_provider_catalog(),
								static function ( array $config ): bool {
									return ( $config['status'] ?? 'deferred' ) !== 'active';
								}
							)
						)
					)
				),
			),
		)
	);
}

function gema_payments_rest_add_cart_item( WP_REST_Request $request ): WP_REST_Response {
	$payload = $request->get_json_params();
	if ( ! is_array( $payload ) ) {
		return new WP_REST_Response( array( 'status' => 'invalid_payload' ), 400 );
	}

	$sku = sanitize_key( (string) ( $payload['sku'] ?? '' ) );
	$catalog = gema_payments_get_institutional_catalog();
	if ( ! array_key_exists( $sku, $catalog ) ) {
		return new WP_REST_Response( array( 'status' => 'unknown_sku', 'sku' => $sku ), 404 );
	}

	$qty = max( 1, (int) ( $payload['qty'] ?? 1 ) );
	$session_key = gema_payments_get_cart_session_key( $request );
	$cart        = gema_payments_get_cart( $session_key );

	$cart['items'][ $sku ] = array(
		'sku'         => $sku,
		'label'       => $catalog[ $sku ]['label'],
		'qty'         => $qty,
		'price_label' => $catalog[ $sku ]['price_label'],
	);

	gema_payments_save_cart( $session_key, $cart );

	return rest_ensure_response(
		array(
			'status' => 'added',
			'cart'   => $cart,
		)
	);
}

function gema_payments_get_erp_signup_base_url(): string {
	if ( defined( 'GEMA_CUMBRE_ERP_SIGNUP_URL' ) && is_string( GEMA_CUMBRE_ERP_SIGNUP_URL ) ) {
		return untrailingslashit( trim( GEMA_CUMBRE_ERP_SIGNUP_URL ) );
	}

	return 'https://cumbre-erp-prod.web.app';
}

/**
 * @param array<string, mixed> $cart_items
 * @param array<string, string> $customer
 */
function gema_payments_build_signup_url( array $cart_items, array $customer = array() ): string {
	$skus = array_keys( $cart_items );
	$primary_sku = ! empty( $skus ) ? sanitize_key( (string) $skus[0] ) : 'erp_pymes_trial';

	$args = array(
		'signup' => '1',
		'sku'    => $primary_sku,
	);

	if ( ! empty( $customer['email'] ) ) {
		$args['email'] = sanitize_email( (string) $customer['email'] );
	}

	if ( ! empty( $customer['company'] ) ) {
		$args['company'] = sanitize_text_field( (string) $customer['company'] );
	}

	if ( count( $skus ) > 1 ) {
		$args['skus'] = implode( ',', array_map( 'sanitize_key', $skus ) );
	}

	return add_query_arg( $args, gema_payments_get_erp_signup_base_url() . '/' );
}

function gema_payments_notify_checkout_events( array $cart_items, array $customer, string $checkout_id, array $utm_payload ): void {
	if ( ! function_exists( 'gema_notifications_dispatch_event' ) ) {
		return;
	}

	$tenant_id = defined( 'GEMA_CUMBRE_TENANT_ID' ) ? (string) GEMA_CUMBRE_TENANT_ID : '';
	$skus      = array_keys( $cart_items );

	gema_notifications_dispatch_event(
		array(
			'event_type' => 'lead.captured',
			'tenant_id'  => $tenant_id,
			'customer'   => array(
				'name'  => sanitize_text_field( (string) ( $customer['name'] ?? 'Prospecto carrito' ) ),
				'email' => sanitize_email( (string) ( $customer['email'] ?? '' ) ),
				'phone' => sanitize_text_field( (string) ( $customer['phone'] ?? '' ) ),
			),
			'metadata'   => array(
				'source'      => 'gema_payments_cart',
				'checkout_id' => $checkout_id,
				'sku'         => ! empty( $skus ) ? (string) $skus[0] : '',
				'skus'        => implode( ',', $skus ),
				'utm'         => $utm_payload,
			),
		)
	);
}

function gema_payments_rest_checkout_cart( WP_REST_Request $request ): WP_REST_Response {
	$payload     = $request->get_json_params();
	$session_key = gema_payments_get_cart_session_key( $request );
	$cart        = gema_payments_get_cart( $session_key );
	$customer    = is_array( $payload ) ? (array) ( $payload['customer'] ?? array() ) : array();

	if ( empty( $cart['items'] ) ) {
		return new WP_REST_Response( array( 'status' => 'empty_cart' ), 400 );
	}

	$name  = sanitize_text_field( (string) ( $customer['name'] ?? '' ) );
	$email = sanitize_email( (string) ( $customer['email'] ?? '' ) );
	$phone = sanitize_text_field( (string) ( $customer['phone'] ?? '' ) );

	$summary_lines = array();
	foreach ( $cart['items'] as $item ) {
		$summary_lines[] = sprintf( '- %s x%d (%s)', $item['label'], (int) $item['qty'], $item['price_label'] );
	}

	$to = defined( 'GEMA_SALES_ALERT_EMAIL' ) ? sanitize_email( (string) GEMA_SALES_ALERT_EMAIL ) : sanitize_email( (string) get_option( 'admin_email', '' ) );
	$email_sent = false;
	if ( '' !== $to ) {
		$subject = '[GEMA] Intención de compra — carrito institucional';
		$body    = implode(
			"\n",
			array(
				'Nueva intención de checkout desde el carrito institucional WordPress.',
				'',
				'Nombre: ' . ( $name !== '' ? $name : '—' ),
				'Email: ' . ( $email !== '' ? $email : '—' ),
				'Tel/WhatsApp: ' . ( $phone !== '' ? $phone : '—' ),
				'',
				'Items:',
				implode( "\n", $summary_lines ),
				'',
				'Modo: commercial_contact (sin cobro automático todavía).',
			)
		);
		$email_sent = wp_mail( $to, $subject, $body, array( 'Content-Type: text/plain; charset=UTF-8' ) );
	}

	$utm_payload = is_array( $payload['utm'] ?? null ) ? (array) $payload['utm'] : array();
	$checkout_id = 'cart_' . md5( $session_key . wp_json_encode( $cart['items'] ) . gmdate( 'c' ) );
	$signup_url  = gema_payments_build_signup_url( $cart['items'], array(
		'email'   => $email,
		'company' => sanitize_text_field( (string) ( $customer['company'] ?? '' ) ),
	) );

	if ( function_exists( 'gema_leads_api_sync_lead_data' ) ) {
		gema_leads_api_sync_lead_data(
			array_merge(
				array(
					'external_id'      => $checkout_id,
					'name'             => $name !== '' ? $name : 'Prospecto carrito',
					'phone'            => $phone !== '' ? $phone : 'pendiente',
					'email'            => $email,
					'company_or_need'  => 'Carrito institucional: ' . implode( ', ', wp_list_pluck( $cart['items'], 'label' ) ),
					'status'           => 'nuevo',
					'primary_intent'   => 'checkout_institucional',
					'product_interest' => implode( ', ', array_keys( $cart['items'] ) ),
					'source'           => 'gema_payments_cart',
				),
				$utm_payload
			)
		);
	}

	gema_payments_notify_checkout_events(
		$cart['items'],
		array(
			'name'    => $name,
			'email'   => $email,
			'phone'   => $phone,
			'company' => sanitize_text_field( (string) ( $customer['company'] ?? '' ) ),
		),
		$checkout_id,
		$utm_payload
	);

	delete_transient( $session_key );

	return rest_ensure_response(
		array(
			'status'       => 'checkout_registered',
			'mode'         => 'commercial_contact',
			'email_sent'   => $email_sent,
			'signup_url'   => $signup_url,
			'package_sku'  => sanitize_key( (string) ( array_key_first( $cart['items'] ) ?: 'erp_pymes_trial' ) ),
			'next_step'    => $signup_url,
			'message'      => 'Registramos tu intención. Creá tu cuenta en Cumbre ERP — necesitás tarjeta de débito o crédito para activar el trial de 14 días (sin cobro hasta fin del período).',
		)
	);
}

/**
 * Requisitos de tarjeta para trial 14 días (Nave Galicia activo; MP diferido).
 */
function gema_payments_rest_trial_card_requirements(): WP_REST_Response {
	return rest_ensure_response(
		array(
			'trial_days'           => 14,
			'card_required'        => true,
			'provider'             => 'nave_galicia',
			'preauth_ars'          => 1,
			'preauth_voided'       => true,
			'charge_after_trial'   => true,
			'ux_copy'              => 'Tarjeta requerida para trial — no se cobra hasta fin del período. Verificamos fondos con preautorización de $1 ARS revertida al instante.',
			'deferred_providers'   => array( 'mercado_pago', 'mercado_libre', 'paypal', 'stripe' ),
			'cumbre_signup_hint'   => 'Completá el alta en ERP Cumbre con los datos de tu tarjeta.',
		)
	);
}

/**
 * Validación de formato local (Luhn) — la verificación real ocurre en Cumbre via verifyTrialCard.
 */
function gema_payments_rest_trial_validate_card_format( WP_REST_Request $request ): WP_REST_Response {
	$pan = preg_replace( '/\D+/', '', (string) $request->get_param( 'pan' ) );
	$exp_month = sanitize_text_field( (string) $request->get_param( 'exp_month' ) );
	$exp_year = sanitize_text_field( (string) $request->get_param( 'exp_year' ) );

	$errors = array();
	if ( strlen( $pan ) < 13 || strlen( $pan ) > 19 ) {
		$errors[] = 'Número de tarjeta inválido (longitud).';
	}
	if ( ! gema_payments_luhn_check( $pan ) ) {
		$errors[] = 'Número de tarjeta inválido (Luhn).';
	}
	if ( ! preg_match( '/^(0?[1-9]|1[0-2])$/', $exp_month ) ) {
		$errors[] = 'Mes de vencimiento inválido.';
	}

	return rest_ensure_response(
		array(
			'valid'       => empty( $errors ),
			'errors'      => $errors,
			'last4'       => substr( $pan, -4 ),
			'next_step'   => 'Completar alta en Cumbre ERP con verifyTrialCard (Nave Galicia).',
		)
	);
}

function gema_payments_luhn_check( string $pan ): bool {
	$sum = 0;
	$alt = false;
	for ( $i = strlen( $pan ) - 1; $i >= 0; $i-- ) {
		$digit = (int) $pan[ $i ];
		if ( $alt ) {
			$digit *= 2;
			if ( $digit > 9 ) {
				$digit -= 9;
			}
		}
		$sum += $digit;
		$alt = ! $alt;
	}
	return $sum % 10 === 0;
}

function gema_payments_validate_provider( $provider ): bool {
	return is_string( $provider ) && array_key_exists( $provider, gema_payments_get_provider_catalog() );
}

function gema_payments_rest_get_providers(): WP_REST_Response {
	$providers = array();

	foreach ( gema_payments_get_provider_catalog() as $provider => $config ) {
		$status = $config['status'] ?? 'deferred';
		$providers[ $provider ] = array(
			'label'          => $config['label'],
			'country'        => $config['country'],
			'page'           => home_url( $config['page'] ),
			'description'    => $config['description'],
			'status'         => $status,
			'checkout_active'=> $status === 'active',
			'deferred_label' => $config['deferred_label'] ?? null,
			'configured'     => gema_payments_provider_is_configured( $provider ),
		);
	}

	return rest_ensure_response(
		array(
			'status'            => 'ready_for_credentials',
			'active_providers'  => array_keys( gema_payments_list_active_checkout_providers() ),
			'providers'         => $providers,
		)
	);
}

function gema_payments_rest_receive_webhook( WP_REST_Request $request ): WP_REST_Response {
	$provider = (string) $request['provider'];

	if ( ! gema_payments_provider_is_active( $provider ) ) {
		return new WP_REST_Response(
			array(
				'status'   => 'deferred_provider',
				'provider' => $provider,
				'message'  => 'Proveedor diferido — no acepta webhooks hasta habilitación comercial.',
			),
			503
		);
	}

	$settings = gema_payments_get_settings();
	$provider_settings = $settings[ $provider ] ?? array();
	$secret = (string) ( $provider_settings['webhook_secret'] ?? '' );

	if ( '' === $secret ) {
		return new WP_REST_Response(
			array(
				'status'   => 'not_configured',
				'provider' => $provider,
				'message'  => 'El proveedor existe, pero falta configurar el secreto de webhook.',
			),
			503
		);
	}

	$provided_secret = (string) $request->get_header( 'x-gema-webhook-secret' );
	if ( ! hash_equals( $secret, $provided_secret ) ) {
		return new WP_REST_Response(
			array(
				'status'   => 'invalid_signature',
				'provider' => $provider,
			),
			401
		);
	}

	$payload = $request->get_json_params();
	if ( ! is_array( $payload ) ) {
		$payload = array( 'raw' => $request->get_body() );
	}

	$event_id = sanitize_text_field( (string) ( $payload['id'] ?? $request->get_header( 'x-request-id' ) ?: wp_generate_uuid4() ) );
	$title = sprintf( '%s - %s', $provider, $event_id );

	$existing = get_posts(
		array(
			'post_type'      => 'gema_payment_event',
			'post_status'    => 'private',
			'title'          => $title,
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);

	if ( ! empty( $existing ) ) {
		return rest_ensure_response(
			array(
				'status'   => 'duplicate_ignored',
				'provider' => $provider,
				'event_id' => $event_id,
			)
		);
	}

	$post_id = wp_insert_post(
		array(
			'post_type'    => 'gema_payment_event',
			'post_status'  => 'private',
			'post_title'   => $title,
			'post_content' => wp_json_encode( $payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ),
			'meta_input'   => array(
				'gema_payment_provider' => $provider,
				'gema_payment_event_id' => $event_id,
				'gema_payment_received' => gmdate( 'c' ),
			),
		),
		true
	);

	if ( is_wp_error( $post_id ) ) {
		return new WP_REST_Response(
			array(
				'status'   => 'storage_error',
				'provider' => $provider,
				'message'  => $post_id->get_error_message(),
			),
			500
		);
	}

	return rest_ensure_response(
		array(
			'status'   => 'accepted',
			'provider' => $provider,
			'event_id' => $event_id,
		)
	);
}

function gema_payments_activation(): void {
	add_option( GEMA_PAYMENTS_OPTION, array(), '', false );
	gema_payments_register_event_post_type();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'gema_payments_activation' );

function gema_payments_deactivation(): void {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'gema_payments_deactivation' );
