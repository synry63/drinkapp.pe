<?php
/**
 * Author: Thimpress
 */
$link_before = $after_link = $image = $sensei_animation = '';
if ( $instance['image'] ) {
	$randnumber = rand( 0, 10000 );
	$number_id  = $randnumber;
	if ( $instance['link_target'] ) {
		$t = 'target="_blank"';
	} else {
		$t = '';
	}
	wp_enqueue_script( 'thim-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '', false );

	if ( $instance['number'] ) {
		$number = ",items: " . $instance['number'];
	} else {
		$number = ",singleItem:true";
	}
	$config = $number;


	$img_id = explode( ",", $instance['image'] );
	if ( $instance['image_link'] ) {
		$img_url = explode( ",", $instance['image_link'] );
	}

	$css_animation = $instance['css_animation'];
	$css_animation = thim_getCSSAnimation( $css_animation );
	if ( $bg ) {
		$css_bg = 'background:' . $bg . '; color:' . $title_color . ';';
	}
	if ( $instance['type_title'] == 'no_boder' ) {
		$class_border = 'no_boder_title';
	} else {
		$class_border = '';
	}
	echo '<div id="gallery_img_' . esc_attr( $number_id ) . '" class="gallery-img ' . $class_border . '' . esc_attr( $css_animation ) . '">';
	$i = 0;
	foreach ( $img_id as $id ) {
		$src = wp_get_attachment_image_src( $id, $instance['image_size'] );
		if ( $src ) {
			$img_size = '';
			$src_size = @getimagesize( $src['0'] );
			$image    = '<img src ="' . esc_url( $src['0'] ) . '" ' . $src_size[3] . ' alt=""/>';
		}
		if ( $instance['image_link'] ) {
			$link_before = '<a ' . $t . ' href="' . esc_url( $img_url[ $i ] ) . '">';
			$after_link  = "</a>";
		}
		echo '<div class="item">' . $link_before . $image . $after_link . "</div>";
		$i ++;
	}
	echo "</div>";

	echo '
		<script>
		jQuery(function($) {
			$("#gallery_img_' . $number_id . '").owlCarousel({
				autoPlay: 3000
				,navigation: true
				,navigationText: ["<i class=\'fa fa-angle-left\'></i>","<i class=\'fa fa-angle-right\'></i>"]
				,pagination: false
				' . $config . '
		  });
		});
	</script>';

}