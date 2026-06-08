<?php
/**
 * Plugin Name: GEMA Payments Platform
 * Description: Capa base para proveedores de pago, webhooks y auditoría operativa de GEMA.
 * Version: 0.1.0
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
		),
		'mercado_pago'  => array(
			'label'       => 'Mercado Pago',
			'country'     => 'AR',
			'page'        => '/pagos/mercado-pago',
			'description' => 'Checkout, links de pago, QR, suscripciones y webhooks.',
		),
		'nave'          => array(
			'label'       => 'Nave',
			'country'     => 'AR',
			'page'        => '/pagos/nave',
			'description' => 'Cobros locales, documentación/API pendiente de vinculación final.',
		),
		'paypal'        => array(
			'label'       => 'PayPal',
			'country'     => 'GLOBAL',
			'page'        => '/pagos/paypal',
			'description' => 'Checkout internacional, sandbox/producción y webhooks.',
		),
		'stripe'        => array(
			'label'       => 'Stripe',
			'country'     => 'GLOBAL',
			'page'        => '/pagos/stripe',
			'description' => 'Tarjetas, Checkout, suscripciones y webhooks firmados.',
		),
	);
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
}
add_action( 'rest_api_init', 'gema_payments_register_rest_routes' );

function gema_payments_validate_provider( $provider ): bool {
	return is_string( $provider ) && array_key_exists( $provider, gema_payments_get_provider_catalog() );
}

function gema_payments_rest_get_providers(): WP_REST_Response {
	$providers = array();

	foreach ( gema_payments_get_provider_catalog() as $provider => $config ) {
		$providers[ $provider ] = array(
			'label'       => $config['label'],
			'country'     => $config['country'],
			'page'        => home_url( $config['page'] ),
			'description' => $config['description'],
			'configured'  => gema_payments_provider_is_configured( $provider ),
		);
	}

	return rest_ensure_response(
		array(
			'status'    => 'ready_for_credentials',
			'providers' => $providers,
		)
	);
}

function gema_payments_rest_receive_webhook( WP_REST_Request $request ): WP_REST_Response {
	$provider = (string) $request['provider'];
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
