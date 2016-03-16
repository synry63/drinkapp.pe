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
	<div class="wrapper">
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

			<div class="thumb__product_info">
				<div class="name">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
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
				do_action( 'woocommerce_shop_description' );
				?>
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
		</div>
		<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_shop_price' );
		?>

	</div>
</div>