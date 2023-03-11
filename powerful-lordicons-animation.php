<?php
/**
 * Plugin Name: Powerful Lordicons Animation
 * Description: Powerful Lordicons Animation plugin for Elementor with 20+ responsive and modern lordicons designs.
 * Plugin URI:  https://bwdplugins.com/plugins/powerful-lordicons-animation
 * Version:     1.0
 * Author:      Best WP Developer
 * Author URI:  https://bestwpdeveloper.com/
 * Text Domain: powerful-lordicons-animation
 * Elementor tested up to: 3.0.0
 * Elementor Pro tested up to: 3.7.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once ( plugin_dir_path(__FILE__) ) . '/includes/plordiconsa-plugin-activition.php';
final class plordiconsa_swiper_lordicons{

	const VERSION = '1.0';

	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {
		// Load translation
		add_action( 'plordiconsa_init', array( $this, 'plordiconsa_loaded_textdomain' ) );
		// plordiconsa_init Plugin
		add_action( 'plugins_loaded', array( $this, 'plordiconsa_init' ) );
	}

	public function plordiconsa_loaded_textdomain() {
		load_plugin_textdomain( 'powerful-lordicons-animation' );
	}

	public function plordiconsa_init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', 'plordiconsa_addon_failed_load');
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'plordiconsa_admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'plordiconsa_admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plordiconsa-lordicons-boots.php' );
	}

	public function plordiconsa_admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'powerful-lordicons-animation' ),
			'<strong>' . esc_html__( 'Powerful Lordicons Animation', 'powerful-lordicons-animation' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'powerful-lordicons-animation' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'powerful-lordicons-animation') . '</p></div>', $message );
	}

	public function plordiconsa_admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'powerful-lordicons-animation' ),
			'<strong>' . esc_html__( 'Powerful Lordicons Animation', 'powerful-lordicons-animation' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'powerful-lordicons-animation' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'powerful-lordicons-animation') . '</p></div>', $message );
	}
}

// Instantiate lordicons.
new plordiconsa_swiper_lordicons();
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );