<?php
/**
 * Loop Add to Cart
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

global $product, $post, $theme_options_data;

?>
<div class="inf row">
	<div class="col-md-8">
		<?php
		echo apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( '<div class="row cart"><a href="%s"  rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s">%s</a></div>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( $product->id ),
				esc_attr( $product->get_sku() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				esc_attr( $product->product_type ),
				esc_html( $product->add_to_cart_text() )
			),
			$product );
		?>
	</div>
	<div class="col-md-2">
	<?php
		if ( isset( $theme_options_data['thim_woo_set_show_wishlist'] ) && $theme_options_data['thim_woo_set_show_wishlist'] == '1' ) {
			if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) || is_plugin_active_for_network( 'yith-woocommerce-wishlist/init.php' ) ) {
				echo '<div class="wishlist">' . do_shortcode( '[yith_wcwl_add_to_wishlist]' ) . '</div>';
			}
		}
		?>
	</div>

	<div class="col-md-2">
		<?php
		if ( isset( $theme_options_data['thim_woo_set_show_compare'] ) && $theme_options_data['thim_woo_set_show_compare'] == '1' ) {
			if ( is_plugin_active( 'yith-woocommerce-compare/init.php' ) || is_plugin_active_for_network( 'yith-woocommerce-compare/init.php' ) ) {
				echo '<div class="box-compare"> <a href="' . esc_url( get_permalink( $product->id ) ) . '&amp;action=yith-woocompare-add-product&amp;id=' . esc_attr( $product->id ) . '" class="compare button" data-product_id="' . esc_attr( $product->id ) . '" title="' . __( "Compare", "thim" ) . '">' . __( "Compare", "thim" ) . '</a></div>';
			}
		}
		?>
	</div>
</div>