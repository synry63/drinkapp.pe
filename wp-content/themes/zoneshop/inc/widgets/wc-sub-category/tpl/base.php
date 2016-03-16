<?php
$taxonomy_name = 'product_cat';
//var_dump( $instance['cats'] );
$term = get_term( $instance['cats'], $taxonomy_name );
//var_dump($term);
$link_cat = '?product_cat=' . $term->slug;
echo '<div class="sub-category">';
echo '<a href="' . esc_url( home_url( '/' ) ) . $link_cat . '" class="menu-category-title">' . esc_attr( $term->name ) . '</a>';
if ( $term->description ) {
	$desc = explode( ' ', $term->description, 50 );
	array_pop( $desc );
	$desc = implode( " ", $desc ) . '..';
	echo '<p class="menu-category-description">' . esc_attr( $desc ) . '</p>';
}
$thumbnail_id = get_woocommerce_term_meta( $term->term_taxonomy_id, 'thumbnail_id', true );
$image        = wp_get_attachment_url( $thumbnail_id );
if ( $image ) {
	echo '<img class="menu-category-image alignleft" src="' . $image . '" alt="' . esc_attr( $term->name ) . '"/>';
}
$termchildren = get_term_children( $instance['cats'], $taxonomy_name );

echo '<ul class="subcat">';
foreach ( $termchildren as $child ) {
	$term = get_term_by( 'id', $child, $taxonomy_name );
	echo '<li><a href="' . esc_url( get_term_link( $child, $taxonomy_name ) ) . '">' . esc_attr( $term->name ) . '</a></li>';
}
echo '</ul>';
echo '</div>';