<?php
/**
 * WooCommerce All Currencies - Settings
 *
 * @version 2.0.0
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_Settings_All_Currencies' ) ) :

class WC_Settings_All_Currencies extends WC_Settings_Page {

	/**
	 * Constructor.
	 */
	function __construct() {

		$this->id    = 'currencies';
		$this->label = __( 'Currencies', 'woocommerce-all-currencies' );

		parent::__construct();
	}

	public function get_settings() {
		global $current_section;
		$the_current_section = ( '' != $current_section ) ? $current_section : 'general';
		return apply_filters( 'woocommerce_get_settings_' . $this->id . '_' . $the_current_section, array() );
	}
}

endif;

return new WC_Settings_All_Currencies();
