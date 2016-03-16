<?php
ob_start();
//extract( $args );
$number_product = 4;
$show           = $instance['show'];
$orderby        = $instance['orderby'];
$order          = $instance['order'];
$number_product = $instance['number_product'];
$show_rating    = false;

$query_args = array(
	'posts_per_page' => $number_product,
	'post_status'    => 'publish',
	'post_type'      => 'product',
	'no_found_rows'  => 1,
	'order'          => $order == 'asc' ? 'asc' : 'desc'
);

$query_args['meta_query'] = array();

if ( empty( $instance['show_hidden'] ) ) {
	$query_args['meta_query'][] = WC()->query->visibility_meta_query();
	$query_args['post_parent']  = 0;
}

if ( !empty( $instance['hide_free'] ) ) {
	$query_args['meta_query'][] = array(
		'key'     => '_price',
		'value'   => 0,
		'compare' => '>',
		'type'    => 'DECIMAL',
	);
}

$query_args['meta_query'][] = WC()->query->stock_status_meta_query();
$query_args['meta_query']   = array_filter( $query_args['meta_query'] );

switch ( $show ) {
	case 'featured' :
		$query_args['meta_query'][] = array(
			'key'   => '_featured',
			'value' => 'yes'
		);
		break;
	case 'onsale' :
		$product_ids_on_sale    = wc_get_product_ids_on_sale();
		$product_ids_on_sale[]  = 0;
		$query_args['post__in'] = $product_ids_on_sale;
		break;
	case 'bestsellers':
		$query_args['meta_query'][] = array(
			'key'     => '_price',
			'value'   => 0,
			'compare' => '>',
			'type'    => 'DECIMAL',
		);
		break;
}

switch ( $orderby ) {
	case 'price' :
		$query_args['meta_key'] = '_price';
		$query_args['orderby']  = 'meta_value_num';
		break;
	case 'rand' :
		$query_args['orderby'] = 'rand';
		break;
	case 'sales' :
		$query_args['meta_key'] = 'total_sales';
		$query_args['orderby']  = 'meta_value_num';
		break;
	default :
		$query_args['orderby'] = 'date';
}
$r = new WP_Query( $query_args );

if ( $r->have_posts() ) {
	echo '<div class="thim-accordion">
			<div class="box thim-module">';
	echo '<div class="box-content horizontal">';
	while ( $r->have_posts() ) {
		$r->the_post();
		wc_get_template( 'content-widget/content-product-showcase.php', array( 'show_rating' => $show_rating ) );
	}
	echo '</div></div></div>';

}
wp_reset_postdata();

$content = ob_get_clean();

echo ent2ncr($content);

?>