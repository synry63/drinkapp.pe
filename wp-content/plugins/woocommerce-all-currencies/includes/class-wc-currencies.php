<?php
/**
 * WooCommerce All Currencies
 *
 * @version 2.0.1
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_All_Currencies' ) ) :

class WC_All_Currencies {

	/**
	 * Constructor.
	 *
	 * @version 2.0.1
	 */
	public function __construct() {

		if ( 'yes' === get_option( 'woocommerce_currencies_enabled' ) ) {
			add_filter( 'woocommerce_currencies',      array( $this, 'add_all_currencies'),  PHP_INT_MAX - 1 );
			add_filter( 'woocommerce_currency_symbol', array( $this, 'change_currency_symbol'), PHP_INT_MAX - 1, 2 );
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

		if ( 'yes' === get_option( 'woocommerce_currencies_hide_symbol' ) ) {
			if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ! is_admin() ) return ''; // if frontend, then return empty symbol
		}

		$currencies = wcal_get_all_currencies();
		foreach( $currencies as $data ) {
			if ( $currency === $data['code'] ) {
				return $data['symbol'];
			}
		}

		return $currency_symbol;
	}
}

endif;

return new WC_All_Currencies();
