<?php
$rand = time() . '-1-' . rand( 0, 100 );
if ( $instance['type_title'] == 'no_boder' ) {
	$class_border = 'no_boder_title';
} else {
	$class_border = '';
}
echo '<ul class="box tab-heading ' . $class_border . '" role="tablist">';
$j = $k = 1;
foreach ( $instance['tab'] as $i => $tab ) {
	$css          = $width_header = '';
	$width_header = 100 / count( $instance['tab'] );
	$css          = 'style="width:25%"';
	if ( $j == '1' ) {
		$active = "class=active";
	} else {
		$active = '';
	}
	echo '<li role="presentation" ' . esc_attr( $active ) . '><a class="box-heading" href="#thimm-widget-tab-' . $j . $rand . '" data-toggle="tab"><span>' . esc_attr( $tab['title'] ) . '</span></a></li>';
	$j ++;
}

echo '</ul>';
echo '<div class="tab-content ' . $class_border . '">';
foreach ( $instance['tab'] as $i => $tab ) {
	count( $instance['tab'] );
	if ( $k == '1' ) {
		$content_active = " active in";
	} else {
		$content_active = '';
	}
	echo ' <div role="tabpanel" class="tab-pane fade' . esc_attr( $content_active ) . '" id="thimm-widget-tab-' . $k . $rand . '">';
	?>
	<?php
	ob_start();
	extract( $args );
	$number_product = $column = 4;
	$cats           = '';
	$show           = sanitize_title( $tab['show'] );
	$orderby        = sanitize_title( $tab['orderby'] );
	$order          = sanitize_title( $tab['order'] );
	$number_product = sanitize_title( $tab['number_product'] );
	$column         = sanitize_title( $tab['column'] );
	$cats           = sanitize_title( $tab['cats'] );
	$show_rating    = true;

	$query_args = array(
		'posts_per_page' => $number_product,
		'post_status'    => 'publish',
		'post_type'      => 'product',
		'no_found_rows'  => 1,
		'order'          => $order == 'asc' ? 'asc' : 'desc'
	);

	$query_args['meta_query'] = array();

	$query_args['meta_query'][] = WC()->query->stock_status_meta_query();
	$query_args['meta_query']   = array_filter( $query_args['meta_query'] );
	if ( $show == 'category' && $cats <> '' ) {
		$cats_id                 = explode( ',', $cats );
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $cats_id
			)
		);
	}
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
				'meta_key'      => 'total_sales',
				'orderby'       => 'meta_value_num',
				'no_found_rows' => 1,
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

	$r     = new WP_Query( $query_args );
	$class = " category-product-list";
	if ( $r->have_posts() ) {
		echo '<div class="thim-widget-product woocommerce">
			<div class="box thim-module">';
		echo '<ul class="product-grid' . esc_attr( $class ) . '">';
		while ( $r->have_posts() ) {
			$r->the_post();
			wc_get_template( 'content-widget/content-product.php', array(
				'show_rating' => $show_rating,
				'column'      => $column
			) );
		}
		echo '</ul></div></div>';
	}
	wp_reset_postdata();
	$content = ob_get_clean();
	echo ent2ncr($content);
	?>
	<?php
	echo '</div>';
	$k ++;
}
echo '</div>';
?>