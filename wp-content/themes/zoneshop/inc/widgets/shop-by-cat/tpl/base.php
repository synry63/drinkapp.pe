<?php
$num_post = $instance['num_post'];
$num_column = 12 / $instance['num_column'];
$heading = $instance['heading'] ? $instance['heading'] : '';
if ( $bg ) {
	$css_bg = 'background:' . $bg . '; color:' . $title_color . ';';
}
if ( $instance['type_title'] == 'no_boder' ) {
	$class_border = 'no_boder_title';
} else {
	$class_border = '';
}
echo '<div class="box ' . $class_border . '">';
echo '<div class="box-heading shop-by-cat-box-heading">
	<span style="font-size: ' . $instance['heading_font_size'] . 'px; color: ' . $instance['heading_text_color'] . ';background: ' . $instance['heading_bg_color'] . '">' . $heading . '</span>
</div>';
echo '<div class="box-content">';
$product_categories = get_terms( 'product_cat', array(
	'hide_empty' => 0,
	'number'     => '' . $num_post . '',
	'orderby'    => 'ASC',
	'parent'     => 0
) );
$cate               = '';
if ( is_array( $product_categories ) ) {
	foreach ( $product_categories as $cat ) {
		//var_dump($cat->term_id);
		//
		$taxonomy_name = 'product_cat';
		$term          = get_term( $cat->term_id, $taxonomy_name );
		//

//		var_dump($term);
		$link_cat = '?product_cat=' . $term->slug;
		echo '<div class="col-md-' . $num_column . ' shop-by-cat" style="background: white">';
		$thumbnail_id = get_woocommerce_term_meta( $term->term_taxonomy_id, 'thumbnail_id', true );
		$image        = wp_get_attachment_url( $thumbnail_id );
		if ( $image ) {
			echo '<img class="shop-by-cat-image" src="' . $image . '" alt="' . esc_attr( $term->name ) . '"  width="80"/>';
		}
		//echo '<a href="' . esc_url( home_url( '/' ) ) . $link_cat . '" class="menu-category-title">' . esc_attr($term->name) . '</a>';
		echo '<h4 style="text-transform: uppercase;">' . esc_attr( $term->name ) . '</h4>';
		if ( $term->description ) {
			$desc = explode( ' ', $term->description, 10 );
			array_pop( $desc );
			$desc = implode( " ", $desc ) . '..';
			echo '<p class="shop-by-cat-description">' . esc_attr( $desc ) . '</p>';
		}
		if ( $instance['show_read_more'] == true ) {
			echo '<a href="' . esc_url( home_url( '/' ) ) . $link_cat . '" style="color: ' . $instance['read_more_color'] . '">Read more</a>';
		}

//		$termchildren = get_term_children( $cat->term_id,$taxonomy_name );
//
//		echo '<ul class="subcat">';
//		foreach ( $termchildren as $child ) {
//			$term = get_term_by( 'id', $child, $taxonomy_name );
//			echo '<li><a href="' . esc_url(get_term_link( $child, $taxonomy_name )) . '">' . esc_attr($term->name) . '</a></li>';
//		}
		echo '</ul>';
		echo '</div>';
	}
}
echo '<div class="clear"></div>';
echo '</div>';
echo '</div>';
