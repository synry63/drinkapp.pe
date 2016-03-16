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
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop'] ++;

// show column widget thim product
 if($column){
	$column_product = 12 / $column;
}
// Extra post classes
$classes = array();
$classes[] = 'col-md-'.$column_product.' col-sm-6';
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>
<li <?php post_class( $classes ); ?>>
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
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
 		</div>
		<div class="special-product-info">
			<div class="name">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
			<?php
			do_action( 'woocommerce_shop_price' );
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
		<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_price - 10
		 */
		//do_action( 'woocommerce_shop_price' );
		?>

	</div>
</li>