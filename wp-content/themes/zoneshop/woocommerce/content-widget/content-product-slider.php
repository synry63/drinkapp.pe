<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

global $product, $woocommerce_loop, $theme_options_data;

// Ensure visibility
if ( !$product || !$product->is_visible() ) {
	return;
}
//echo ($count_product);
$before = $after = '';
if ( $link_images <> '' ) {
	$column_slider = $column_slider - 1;
}
 $col = 12 / $column_slider;
if ( $column_slider == '5' ) {
	$column = 'col-lg-20';
} else {
	$column = 'col-sm-6 col-md-' . $col;
}

?>
	<div class="product <?php echo esc_attr($column); ?>">
		<div class="wrapper">
			<div class="thumb">
				<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				//echo "quick view";
				do_action( 'woocommerce_before_shop_loop_item_title' );

				if ( isset( $theme_options_data['thim_woo_set_show_qv'] ) && $theme_options_data['thim_woo_set_show_qv'] == '1' ) {
					echo '<div class="details"><div class="quick-view" data-prod="' . esc_attr( get_the_id() ) . '"><a href="javascript:;">' . __( "Quick View", "thim" ) . '</a></div> </div>';
				}
				?>
			</div>

			<div class="row product-title-rating">
				<div class="col-md-8">
					<div class="name">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</div>
					<div class="rating">
						<?php
						/**
						 * woocommerce_after_shop_loop_item_title hook
						 *
						 * @hooked woocommerce_template_loop_rating - 5
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );

						/**********desctiption********/
						//do_action( 'woocommerce_shop_description' );
						?>
					</div>
				</div>
				<div class="col-md-4">
					<?php
					do_action( 'woocommerce_shop_price' );
					?>
				</div>

				<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */

				echo '<div class="list-info">';
				do_action( 'woocommerce_after_shop_loop_item_title' );
				do_action( 'woocommerce_shop_description' );
				echo '</div>';
				?>
			</div>
			<?php
			do_action( 'woocommerce_after_shop_loop_item' );

			?>

			<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			//do_action( 'woocommerce_after_shop_loop_item_title' );

			/**********desctiption********/
			do_action( 'woocommerce_shop_description' );
			?>
		</div>
	</div>