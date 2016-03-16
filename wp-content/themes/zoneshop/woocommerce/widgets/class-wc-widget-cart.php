<?php
/**
 * Shopping Cart Widget
 *
 * Displays shopping cart widget
 *
 * @author        WooThemes
 * @category      Widgets
 * @package       WooCommerce/Widgets
 * @version       2.0.0
 * @extends       WP_Widget
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Custom_WC_Widget_Cart extends WC_Widget_Cart {

	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;

	function widget( $args, $instance ) {
		extract( $args );
		if ( is_cart() || is_checkout() ) {
			return;
		}
		global $woocommerce;
		$title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( '', 'woocommerce' ) : $instance['title'], $instance, $this->id_base );
		$hide_if_empty  = empty( $instance['hide_if_empty'] ) ? 0 : 1;
		$show_only_icon = empty( $instance['show_only_icon'] ) ? 0 : 1;
		echo ent2ncr( $before_widget );
		$class_show_only_icon = '';
		if ( $show_only_icon == '1' ) {
			$class_show_only_icon = ' show_only_icon';
		}
		echo '<div class="minicart_hover" id="header-mini-cart">';
		$cat_total = $woocommerce->cart->get_cart_subtotal();
		list( $cart_items ) = thim_get_current_cart_info();

		echo '<div class="main-header-cart' . esc_attr( $class_show_only_icon ) . '">
 			<span class="icon-cart"></span>
 			<p><span id="cart-total">' . $cat_total . '</span> - <span id="cart-items-number">' . $cart_items . ' ' . __( "ITEM(S)", "thim" ) . '</span><span class="title-cart">' . esc_attr( $title ) . '</span></p>
 			<div class="clear"></div></div>';

		if ( $hide_if_empty ) {
			echo '<div class="hide_cart_widget_if_empty">';
		}
		// Insert cart widget placeholder - code in woocommerce.js will update this on page load
		echo '<div class="widget_shopping_cart_content" style="display: none;"></div>';
		if ( $hide_if_empty ) {
			echo '</div>';
		}
		echo '</div>';
		echo ent2ncr( $after_widget );
	}


	/**
	 * update function.
	 *
	 * @see    WP_Widget->update
	 * @access public
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance['title']          = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['hide_if_empty']  = empty( $new_instance['hide_if_empty'] ) ? 0 : 1;
		$instance['show_only_icon'] = empty( $new_instance['show_only_icon'] ) ? 0 : 1;

		return $instance;
	}


	/**
	 * form function.
	 *
	 * @see    WP_Widget->form
	 * @access public
	 *
	 * @param array $instance
	 *
	 * @return void
	 */
	function form( $instance ) {
		$hide_if_empty  = empty( $instance['hide_if_empty'] ) ? 0 : 1;
		$show_only_icon = empty( $instance['show_only_icon'] ) ? 0 : 1;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'woocommerce' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php if ( isset ( $instance['title'] ) ) {
				echo esc_attr( $instance['title'] );
			} ?>" /></p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_only_icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_only_icon' ) ); ?>"<?php checked( $show_only_icon ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_only_icon' ) ); ?>"><?php _e( 'Show Only Icon', 'thim' ); ?></label>
		</p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hide_if_empty' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_if_empty' ) ); ?>"<?php checked( $hide_if_empty ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'hide_if_empty' ) ); ?>"><?php _e( 'Hide if cart is empty', 'woocommerce' ); ?></label>
		</p>

	<?php
	}

}