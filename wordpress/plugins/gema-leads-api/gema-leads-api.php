<?php
/**
 * Plugin Name: GEMA Leads API
 * Description: Endpoint interno para sincronizar leads del agente GEMA como registros privados de WordPress.
 * Version: 0.1.0
 * Author: GEMA Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'gema_leads_api_register_post_type' );
function gema_leads_api_register_post_type(): void {
	register_post_type(
		'gema_lead',
		array(
			'labels'       => array(
				'name'          => 'Leads GEMA',
				'singular_name' => 'Lead GEMA',
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-id',
			'supports'     => array( 'title', 'custom-fields' ),
			'capability_type' => 'post',
		)
	);
}

add_action( 'rest_api_init', 'gema_leads_api_register_routes' );
function gema_leads_api_register_routes(): void {
	register_rest_route(
		'gema/v1',
		'/leads',
		array(
			'methods'             => 'POST',
			'callback'            => 'gema_leads_api_upsert_lead',
			'permission_callback' => 'gema_leads_api_can_write_leads',
		)
	);
}

function gema_leads_api_can_write_leads(): bool {
	return current_user_can( 'edit_posts' );
}

function gema_leads_api_required_string( WP_REST_Request $request, string $key ): string {
	$value = trim( (string) $request->get_param( $key ) );
	if ( '' === $value ) {
		return '';
	}
	return sanitize_text_field( $value );
}

function gema_leads_api_upsert_lead( WP_REST_Request $request ): WP_REST_Response {
	$external_id = gema_leads_api_required_string( $request, 'external_id' );
	$name        = gema_leads_api_required_string( $request, 'name' );
	$email       = sanitize_email( (string) $request->get_param( 'email' ) );
	$phone       = gema_leads_api_required_string( $request, 'phone' );
	$need        = gema_leads_api_required_string( $request, 'company_or_need' );

	if ( '' === $external_id || '' === $name || '' === $phone || '' === $need ) {
		return new WP_REST_Response(
			array(
				'ok'      => false,
				'message' => 'Missing required lead fields. Required: external_id, name, phone and company_or_need. Email is recommended but optional.',
			),
			400
		);
	}

	$existing = get_posts(
		array(
			'post_type'      => 'gema_lead',
			'post_status'    => array( 'private', 'draft' ),
			'posts_per_page' => 1,
			'meta_key'       => 'external_id',
			'meta_value'     => $external_id,
			'fields'         => 'ids',
		)
	);

	$post_data = array(
		'post_type'   => 'gema_lead',
		'post_status' => 'private',
		'post_title'  => sprintf( '%s - %s', $name, $external_id ),
	);

	if ( ! empty( $existing ) ) {
		$post_data['ID'] = (int) $existing[0];
		$post_id         = wp_update_post( $post_data, true );
		$created         = false;
	} else {
		$post_id = wp_insert_post( $post_data, true );
		$created = true;
	}

	if ( is_wp_error( $post_id ) ) {
		return new WP_REST_Response(
			array(
				'ok'      => false,
				'message' => $post_id->get_error_message(),
			),
			500
		);
	}

	$meta_fields = array(
		'external_id',
		'name',
		'phone',
		'email',
		'company_or_need',
		'status',
		'primary_intent',
		'product_interest',
		'pain_summary',
		'priority_score',
		'assigned_human_phone',
		'source',
		'created_at',
		'updated_at',
	);

	foreach ( $meta_fields as $field ) {
		$value = $request->get_param( $field );
		if ( null !== $value ) {
			update_post_meta( (int) $post_id, $field, sanitize_text_field( (string) $value ) );
		}
	}

	return new WP_REST_Response(
		array(
			'ok'          => true,
			'created'     => $created,
			'post_id'     => (int) $post_id,
			'external_id' => $external_id,
		),
		200
	);
}

