<?php
$link_before = $after_link = $image = $thim_animation = '';
$src         = wp_get_attachment_image_src( $instance['image'], $instance['image_size'] );

$thim_animation .= thim_getCSSAnimation( $instance['css_animation'] );

if ( $src ) {
	$src_size_single_img = '';
	$src_size_single_img = @getimagesize( $src['0'] );
	$image               = '<img src ="' . esc_url( $src['0'] ) . '" ' . $src_size_single_img[3] . ' alt=""/>';
}
if ( $instance['image_link'] ) {
	$link_before = '<a href="' . esc_url( $instance['image_link'] ) . '">';
	$after_link  = "</a>";
}
echo '<div class="single-image '  . esc_attr( $thim_animation ) . '">' . $link_before . $image . $after_link . '</div>';