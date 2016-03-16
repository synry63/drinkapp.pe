<?php
/**
 * WooCommerce All Currencies Pro - General Section Settings
 *
 * @version 2.0.0
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_All_Currencies_Settings_General_Pro' ) ) :

class WC_All_Currencies_Settings_General_Pro {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id   = 'general';
		$this->desc = __( 'General', 'woocommerce-all-currencies-pro' );

		add_filter( 'woocommerce_get_sections_currencies_pro',              array( $this, 'settings_section' ) );
		add_filter( 'woocommerce_get_settings_currencies_pro_' . $this->id, array( $this, 'get_settings' ), PHP_INT_MAX );
	}

	/**
	 * settings_section.
	 */
	function settings_section( $sections ) {
		$sections[ $this->id ] = $this->desc;
		return $sections;
	}

	/**
	 * get_settings.
	 */
	function get_settings() {

		$settings = array(

			array(
				'title'    => __( 'Currencies Options', 'woocommerce-all-currencies-pro' ),
				'type'     => 'title',
				'desc'     => '',
				'id'       => 'woocommerce_currencies_pro_options',
			),

			array(
				'title'    => __( 'WooCommerce All Currencies', 'woocommerce-all-currencies-pro' ),
				'desc'     => '<strong>' . __( 'Enable', 'woocommerce-all-currencies-pro' ) . '</strong>',
				'desc_tip' => __( 'Add all world currencies to your WooCommerce store; modify currency symbol.', 'woocommerce-all-currencies-pro' ),
				'id'       => 'woocommerce_currencies_pro_enabled',
				'default'  => 'yes',
				'type'     => 'checkbox'
			),

			array(
				'name'     => __( 'Current Currency Symbol', 'woocommerce-all-currencies-pro' ) . ' (' . wcac_get_woocommerce_currency() . ')',
				'desc_tip' => __( 'This sets the current currency symbol.', 'woocommerce-all-currencies-pro' ),
				'id'       => 'woocommerce_currencies_pro_currency_' . wcac_get_woocommerce_currency(),
				'type'     => 'text',
				'default'  => wcac_get_woocommerce_currency_symbol(),
				'css'      => 'width: 50px;',
			),

			array(
				'title'    => __( 'Hide Currency Symbol on Frontend', 'woocommerce-all-currencies-pro' ),
				'desc'     => __( 'Hide', 'woocommerce-all-currencies-pro' ),
				'id'       => 'woocommerce_currencies_pro_hide_symbol',
				'default'  => 'no',
				'type'     => 'checkbox',
			),

			array(
				'type'     => 'sectionend',
				'id'       => 'woocommerce_currencies_pro_options',
			),

		);

		return $settings;
	}

}

endif;

return new WC_All_Currencies_Settings_General_Pro();
