<?php
/**
 * WooCommerce All Currencies Pro
 *
 * @version 2.0.1
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_All_Currencies_Pro' ) ) :

class WC_All_Currencies_Pro {

	/**
	 * Constructor.
	 *
	 * @version 2.0.1
	 */
	public function __construct() {

		if ( 'yes' === get_option( 'woocommerce_currencies_pro_enabled' ) ) {
			add_filter( 'woocommerce_currencies',      array( $this, 'add_all_currencies'),  PHP_INT_MAX );
			add_filter( 'woocommerce_currency_symbol', array( $this, 'change_currency_symbol'), PHP_INT_MAX, 2 );
		}
	}

	/**
	 * add_all_currencies.
	 */
	function add_all_currencies( $default_currencies ) {
		$currencies = wcal_get_all_currencies();
		foreach( $currencies as $data ) {
			$default_currencies[ $data['code'] ] = $data['name'];
		}
		asort( $default_currencies );
		return $default_currencies;
	}

	/**
	 * change_currency_symbol.
	 *
	 * @version 2.0.1
	 */
	function change_currency_symbol( $currency_symbol, $currency ) {
		if ( 'yes' === get_option( 'woocommerce_currencies_pro_hide_symbol' ) ) {
			if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ! is_admin() ) return ''; // if frontend, then return empty symbol
		}
		return get_option( 'woocommerce_currencies_pro_currency_' . $currency, $currency_symbol );
	}
}

endif;

return new WC_All_Currencies_Pro();
