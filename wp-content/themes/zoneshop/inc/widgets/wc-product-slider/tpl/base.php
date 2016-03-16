<?php
ob_start();
//extract( $args );
$number_product = $column_slider = 4;
$cats           = $link_images = $no_image = '';
$show           = $instance['product_slider_show'];
$orderby        = $instance['orderby'];
$order          = $instance['order'];
$number_product = $instance['number_product'];
$title          = $instance['title'];
$column_slider = $instance['column_slider'];
$cats          = $instance['product_slider_cats'];
$show_rating = true;

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

if ( ! empty( $instance['hide_free'] ) ) {
	$query_args['meta_query'][] = array(
		'key'     => '_price',
		'value'   => 0,
		'compare' => '>',
		'type'    => 'DECIMAL',
	);
}

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
	case 'new':
		$query_args['meta_query'][] = array(
			'key'   => 'thim_product_new',
			'value' => 'yes'
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
$data_show_button = '';
if ( $column_slider ) {
	$data_show_button .= ' data-column-slider="' . esc_attr($column_slider) . '"';
}

if ( $instance['image'] ) {
	$imageAttachment = wp_get_attachment_image_src( $instance['image'], 'full' );
	$link_images     = $imageAttachment[0];
}
if ( $instance['type_title'] == 'no_boder' ) {
	$class_border = 'no_boder_title';
} else {
	$class_border = '';
}

echo "\n\n\n\n\n".'<!-- START WIDGET --->'."\n\n\n\n\n";
$r = new WP_Query( $query_args );
if ( $r->have_posts() ) {
	echo '<div class="thim-showcase-module woocommerce" id="thim-showcase-module-' . $args['widget_id'] . '">
			<div class="box thim-module ' . $class_border . '">';
	if ( $title ) {
		echo '<div class="box-heading"><span>' . esc_attr( $title ) . '</span> </div>';
	}

	echo '<div class="nav">
			<span class="prev"><i class="fa fa-angle-left"></i></span>
			<span class="next"><i class="fa fa fa-angle-right"></i></span>
		</div>';

	$col = 12 / $column_slider;

	if ( $link_images <> '' ) {
		$col_slider = $column_slider - 1;
		$no_image   = " feature-image-slider";
		if ( $column_slider == '5' ) {
			$column         = 'col-lg-20';
			$col_box_slider = "col-lg-80";
		} else {
			$column         = 'col-md-' . $col;
			$box_slider     = 12 - $col;
			$col_box_slider = 'col-md-' . $box_slider;
		}
	} else {
		$col_slider = $column_slider;
	}
	echo '<div class="widget-product-slider' . $no_image . ' ' . $class_border . '"><div class="row">';
	$before_link = $after_link = '';
	if ( $instance['link_images'] <> '' ) {
		$before_link = '<a href="' . $instance['link_images'] . '">';
		$after_link  = '</a>';
	}
	if ( $link_images <> '' ) {
		echo '<div class="product-images ' . esc_attr($column) . '"><div class="wrapper">' . $before_link . '<img src="' . esc_url($link_images) . '" alt=""/>' . $after_link . '</div></div>';
	}
	echo '<div class="wrapper-product-slider ' . esc_attr($col_box_slider) . '">';
	echo '<div class="product-grid category-product-list box-content owl-carousel owl-theme slider-' . esc_attr($column_slider) . '-column" ' . $data_show_button . '>';

	$i = $j = 1;
	$number_product = $r->post_count;
	while ( $r->have_posts() ) :
		$r->the_post();
		if ( $i == 1 ) {
			echo '<div class="showcase">';
		}
		wc_get_template( 'content-widget/content-product-slider.php', array(
			'show_rating'    => $show_rating,
			'column_slider'  => $column_slider,
			'link_images'    => $link_images,
			'count_product'  => $i,
			'number_product' => $number_product
		) );
		if ( ( $i % $col_slider ) == 0 || $j == $number_product ) {
			echo '</div>';
			$i = 0;
		}
		$i ++;
		$j ++;

	endwhile;
	echo '</div></div></div></div>
 	 </div></div>';

}
echo "\n\n\n\n\n".'<!-- END WIDGET --->'."\n\n\n\n\n";
wp_reset_postdata();
$content = ob_get_clean();
echo ent2ncr($content);
?>
