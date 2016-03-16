<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product-lists.php
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

global $product, $woocommerce_loop;
?>
<div class="slide">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<div class="item-title">
		<span><?php the_title(); ?></span>
	</div>
	<div class="item-content">
		<div class="box-product product-list">
			<div class="row" style="height:100%;">
				<div class="col-md-6 col-sm-6 col-xs-12 left">
 					<div class="thumb">
						<?php
						/**
						 * woocommerce_before_shop_loop_item_title hook
						 *
						 * @hooked woocommerce_show_product_loop_sale_flash - 10
						 * @hooked woocommerce_template_loop_product_thumbnail - 10
						 */
						do_action( 'woocommerce_before_shop_loop_item_title' );
						?>
						<?php 
							/** add to cart **/
							//do_action( 'woocommerce_after_shop_loop_item' ); ?>

					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 right">
					<div class="name">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</div>
 					<div class="price">
						<?php do_action( 'woocommerce_shop_price' ); ?>
					</div>

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
					echo thim_excerpt('20').'..';
					?>
 				</div>
			</div>
		</div>
	</div>
</div>
