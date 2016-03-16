<?php
/*
Plugin Name: All Currencies for WooCommerce
Plugin URI: http://coder.fm/items/woocommerce-all-currencies/
Description: Add all countries currencies to WooCommerce.
Version: 2.0.1
Author: Algoritmika Ltd
Author URI: http://www.algoritmika.com
Copyright: © 2015 Algoritmika Ltd.
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Check if WooCommerce is active
if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

// Check if Pro is active, if so then return
if ( in_array( 'woocommerce-all-currencies-pro/woocommerce-all-currencies-pro.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

if ( ! class_exists( 'Woocommerce_All_Currencies' ) ) :

/**
 * Main Woocommerce_All_Currencies Class
 *
 * @class Woocommerce_All_Currencies
 */

final class Woocommerce_All_Currencies {

	/**
	 * @var Woocommerce_All_Currencies The single instance of the class
	 */
	protected static $_instance = null;

	/**
	 * Main Woocommerce_All_Currencies Instance
	 *
	 * Ensures only one instance of Woocommerce_All_Currencies is loaded or can be loaded.
	 *
	 * @static
	 * @return Woocommerce_All_Currencies - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	}

	/**
	 * Woocommerce_All_Currencies Constructor.
	 * @access public
	 */
	public function __construct() {

		// Include required files
		$this->includes();

		add_action( 'init', array( $this, 'init' ), 0 );

		// Settings
		if ( is_admin() ) {
			add_filter( 'woocommerce_get_settings_pages',                     array( $this, 'add_woocommerce_currencies_settings_tab' ) );
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );
		}
	}

	/**
	 * Show action links on the plugin screen
	 *
	 * @param   mixed $links
	 * @return  array
	 */
	public function action_links( $links ) {
		return array_merge(
			array( '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=currencies' ) . '">' . __( 'Settings', 'woocommerce' ) . '</a>', ),
			$links
		);
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 *
	 * @version 2.0.1
	 */
	private function includes() {

		require_once( 'includes/admin/admin-functions.php' );

		require_once( 'includes/currencies.php' );

		require_once( 'includes/class-wc-currencies.php' );

		$settings = array();
		$settings[] = require_once( 'includes/admin/class-wc-currencies-settings-general.php' );
		$settings[] = require_once( 'includes/admin/class-wc-currencies-settings-list.php' );
		if ( is_admin() ) {
			foreach ( $settings as $section ) {
				foreach ( $section->get_settings() as $value ) {
					if ( isset( $value['default'] ) && isset( $value['id'] ) ) {
						if ( isset ( $_GET['woocommerce_currencies_admin_options_reset'] ) ) {
							require_once( ABSPATH . 'wp-includes/pluggable.php' );
							if ( is_super_admin() ) {
								delete_option( $value['id'] );
							}
						}
						$autoload = isset( $value['autoload'] ) ? ( bool ) $value['autoload'] : true;
						add_option( $value['id'], $value['default'], '', ( $autoload ? 'yes' : 'no' ) );
					}
				}
			}
		}
	}

	/**
	 * Add Woocommerce Currencies settings tab to WooCommerce settings.
	 */
	public function add_woocommerce_currencies_settings_tab( $settings ) {
		$settings[] = include( 'includes/admin/class-wc-settings-currencies.php' );
		return $settings;
	}

	/**
	 * Init Woocommerce_All_Currencies when WordPress initialises.
	 */
	public function init() {
		// Set up localisation
		load_plugin_textdomain( 'woocommerce-all-currencies', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugin_dir_url( __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}
}

endif;

/**
 * Returns the main instance of Woocommerce_All_Currencies to prevent the need to use globals.
 *
 * @version 2.0.1
 * @return  Woocommerce_All_Currencies
 */
if ( ! function_exists( 'WCAL' ) ) {
	function WCAL() {
		return Woocommerce_All_Currencies::instance();
	}
}

WCAL();
