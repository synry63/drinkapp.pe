<?php
/**
 * WooCommerce All Currencies - General Section Settings
 *
 * @version 2.0.1
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_All_Currencies_Settings_General' ) ) :

class WC_All_Currencies_Settings_General {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id   = 'general';
		$this->desc = __( 'General', 'woocommerce-all-currencies' );

		add_filter( 'woocommerce_get_sections_currencies',              array( $this, 'settings_section' ) );
		add_filter( 'woocommerce_get_settings_currencies_' . $this->id, array( $this, 'get_settings' ), PHP_INT_MAX );
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
	 *
	 * @version 2.0.1
	 */
	function get_settings() {

		$settings = array(

			array(
				'title'    => __( 'Currencies Options', 'woocommerce-all-currencies' ),
				'type'     => 'title',
				'desc'     => '',
				'id'       => 'woocommerce_currencies_options',
			),

			array(
				'title'    => __( 'WooCommerce All Currencies', 'woocommerce-all-currencies' ),
				'desc'     => '<strong>' . __( 'Enable', 'woocommerce-all-currencies' ) . '</strong>',
				'desc_tip' => __( 'Add all world currencies to your WooCommerce store; modify currency symbol.', 'woocommerce-all-currencies' ),
				'id'       => 'woocommerce_currencies_enabled',
				'default'  => 'yes',
				'type'     => 'checkbox'
			),

			array(
				'name'     => __( 'Current Currency Symbol', 'woocommerce-all-currencies' ),
				'desc'     => __( 'You will need <a href="http://coder.fm/items/woocommerce-all-currencies/">All Currencies for WooCommerce Pro</a> to change value.', 'woocommerce-all-currencies' ),
				'desc_tip' => __( 'This sets the current currency symbol.', 'woocommerce-all-currencies' ),
				'id'       => 'woocommerce_currencies_currency_' . wcac_get_woocommerce_currency(),
				'type'     => 'text',
				'default'  => wcac_get_woocommerce_currency_symbol(),
				'css'      => 'width: 50px;',
				'custom_attributes' => array( 'readonly' => 'readonly' ),
			),

			array(
				'title'    => __( 'Hide Currency Symbol on Frontend', 'woocommerce-all-currencies' ),
				'desc'     => __( 'Hide', 'woocommerce-all-currencies' ),
				'id'       => 'woocommerce_currencies_hide_symbol',
				'default'  => 'no',
				'type'     => 'checkbox',
			),

			array(
				'type'     => 'sectionend',
				'id'       => 'woocommerce_currencies_options',
			),

		);

		return $settings;
	}

}

endif;

return new WC_All_Currencies_Settings_General();
