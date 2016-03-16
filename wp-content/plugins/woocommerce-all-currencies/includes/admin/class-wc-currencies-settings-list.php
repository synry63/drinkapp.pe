<?php
/**
 * WooCommerce All Currencies - List Section Settings
 *
 * @version 2.0.1
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_All_Currencies_Settings_List' ) ) :

class WC_All_Currencies_Settings_List {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id   = 'currencies_list';
		$this->desc = __( 'All Currencies', 'woocommerce-all-currencies' );

		if ( 'yes' === get_option( 'woocommerce_currencies_enabled' ) ) {
			add_filter( 'woocommerce_general_settings', array( $this, 'add_edit_currency_symbol_field' ), PHP_INT_MAX );
		}
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

		$settings = array();

		$settings[] = array(
			'title' => __( 'Currency Symbol Options', 'woocommerce-all-currencies' ),
			'desc'  => __( 'You will need <a href="http://coder.fm/items/woocommerce-all-currencies/">All Currencies for WooCommerce Pro</a> to change values.', 'woocommerce-all-currencies' ),
			'type'  => 'title',
			'id'    => 'woocommerce_currencies_all_currencies_list_options',
		);

		$currencies = wcal_get_all_currencies();
		foreach( $currencies as $data ) {
			$woocommerce_default_symbol = wcac_get_woocommerce_currency_symbol( $data['code'] );
			$settings[] = array(
				'title'   => $data['name'],
				'id'      => 'woocommerce_currencies_currency_' . $data['code'],
				'default' => ( '' != $woocommerce_default_symbol ) ? $woocommerce_default_symbol : $data['symbol'],
				'type'    => 'text',
				'custom_attributes' => array( 'readonly' => 'readonly' ),
			);
		}

		$settings[] = array(
			'type' => 'sectionend',
			'id'   => 'woocommerce_currencies_all_currencies_list_options',
		);

		return $settings;
	}

	/**
	 * add_edit_currency_symbol_field.
	 *
	 * @version 2.0.1
	 */
	function add_edit_currency_symbol_field( $settings ) {
		$updated_settings = array();
		foreach ( $settings as $section ) {
			if ( isset( $section['id'] ) && 'woocommerce_currency_pos' == $section['id'] ) {
				$updated_settings[] = array(
					'name'     => __( 'Currency Symbol', 'woocommerce-all-currencies' ),
					'desc'     => __( 'You will need <a href="http://coder.fm/items/woocommerce-all-currencies/">All Currencies for WooCommerce Pro</a> to change value.', 'woocommerce-all-currencies' ),
					'desc_tip' => __( 'This sets the currency symbol.', 'woocommerce-all-currencies' ),
					'id'       => 'woocommerce_currencies_currency_' . get_woocommerce_currency(),
					'type'     => 'text',
					'default'  => get_woocommerce_currency_symbol(),
					'css'      => 'width: 50px;',
					'custom_attributes' => array( 'readonly' => 'readonly' ),
				);
			}
			$updated_settings[] = $section;
		}
		return $updated_settings;
	}
}

endif;

return new WC_All_Currencies_Settings_List();
