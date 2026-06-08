<?php
/**
 * Plugin Name: GEMA Cumbre Subdomains
 * Description: Mapa preparatorio de subdominios por módulo ERP Cumbre.
 * Version: 0.1.0
 * Author: GEMA Digital
 * Text Domain: gema-cumbre-subdomains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function gema_cumbre_subdomain_map(): array {
	return array(
		'crm'              => '/cumbre/crm',
		'negocios'         => '/cumbre/negocios',
		'pymes'            => '/cumbre/pymes',
		'empresas'         => '/cumbre/empresas',
		'facturador'       => '/cumbre/facturador',
		'cobros'           => '/cumbre/cobros',
		'catalogo'         => '/cumbre/catalogo',
		'compras'          => '/cumbre/compras',
		'ventas'           => '/cumbre/ventas',
		'personal'         => '/cumbre/personal',
		'tesoreria'        => '/cumbre/tesoreria',
		'marketing'        => '/cumbre/marketing',
		'automatizaciones' => '/cumbre/automatizaciones',
		'web'              => '/cumbre/web',
		'ecommerce'        => '/cumbre/ecommerce',
		'kioscos'          => '/cumbre/kioscos',
		'resto'            => '/cumbre/resto',
		'wms'              => '/cumbre/wms',
		'constructoras'    => '/cumbre/constructoras',
		'agro'             => '/cumbre/agro',
		'mercados'         => '/cumbre/mercados',
		'asistente'        => '/cumbre/asistente',
		'panel'            => '/cumbre/panel',
	);
}

function gema_cumbre_current_subdomain(): string {
	$host = strtolower( sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ?? '' ) ) );
	$host = preg_replace( '/:\\d+$/', '', $host );

	if ( substr( $host, -strlen( '.gema-digital.com' ) ) !== '.gema-digital.com' ) {
		return '';
	}

	$subdomain = substr( $host, 0, -strlen( '.gema-digital.com' ) );
	if ( in_array( $subdomain, array( '', 'www' ), true ) ) {
		return '';
	}

	return $subdomain;
}

function gema_cumbre_redirect_subdomain_to_landing(): void {
	$subdomain = gema_cumbre_current_subdomain();
	$map       = gema_cumbre_subdomain_map();

	if ( '' === $subdomain || empty( $map[ $subdomain ] ) ) {
		return;
	}

	$current_path = strtok( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ?? '/' ) ), '?' );
	if ( '/' !== $current_path && '' !== $current_path ) {
		return;
	}

	wp_safe_redirect( home_url( $map[ $subdomain ] ), 302 );
	exit;
}
add_action( 'template_redirect', 'gema_cumbre_redirect_subdomain_to_landing', 1 );

function gema_cumbre_register_subdomain_rest_routes(): void {
	register_rest_route(
		'gema-cumbre/v1',
		'/subdomains',
		array(
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => 'gema_cumbre_rest_get_subdomains',
			'permission_callback' => '__return_true',
		)
	);
}
add_action( 'rest_api_init', 'gema_cumbre_register_subdomain_rest_routes' );

function gema_cumbre_rest_get_subdomains(): WP_REST_Response {
	$items = array();

	foreach ( gema_cumbre_subdomain_map() as $subdomain => $path ) {
		$items[ $subdomain ] = array(
			'host'       => $subdomain . '.gema-digital.com',
			'landing'    => home_url( $path ),
			'status'     => 'prepared_pending_dns',
			'requires'   => array( 'DNS', 'wildcard_ssl', 'server_alias' ),
		);
	}

	return rest_ensure_response(
		array(
			'status'     => 'prepared_pending_dns',
			'base_domain' => 'gema-digital.com',
			'subdomains' => $items,
		)
	);
}
