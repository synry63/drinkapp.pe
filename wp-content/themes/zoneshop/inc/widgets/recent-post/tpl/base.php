<?php
global $theme_options_data;
$custom_font_size = $width = $des = '';

$number_posts = 2;
if ( $instance['number_posts'] <> '' ) {
	$number_posts = $instance['number_posts'];
}

$query_args = array(
	'posts_per_page' => $number_posts,
	'order'          => $instance['order'] == 'asc' ? 'asc' : 'desc',
);
switch ( $instance['orderby'] ) {
	case 'recent' :
		$query_args['orderby'] = 'post_date';
		break;
	case 'title' :
		$query_args['orderby'] = 'post_title';
		break;
	case 'popular' :
		$query_args['orderby'] = 'comment_count';
		break;
	default : //random
		$query_args['orderby'] = 'rand';
}

$posts_display = new WP_Query( $query_args );
$post_format   = '';

if ( $posts_display->have_posts() ) {
	add_image_size( "resize", 380, 190, true );
	$img_size = 'resize';
	echo '<div class="kbm-recent-article ' . esc_attr( $layout ) . '">
	<div class="box kuler-module">';
	if ( $instance['title'] ) {
		echo '<div class="box-heading"><span>' . esc_attr( $instance['title'] ) . '</span></div>';
	}
//echo '     <div class="nav">
//					<span class="prev"><i class="fa fa-angle-left"></i></span>
//					<span class="next"><i class="fa fa fa-angle-right"></i></span>
//				</div>';
	echo '<div class="box-content">';
	echo '<div class="articles">';
	echo '<div class="owl-carousel">';

	while ( $posts_display->have_posts() ) {
		$posts_display->the_post();
		$format = $post_format = get_post_format();
		if ( false === $format ) {
			$format = 'format-standard' . $col;
		} else {
			$format = 'format-' . $format . $col;
		}

		echo '<div class="item ' . $format . ' show-hidden">';
		$attr = array(
			'title' => get_the_title(),
			'alt'   => get_the_title()
		);

		switch ( get_post_format() ) {
			case 'video':
				echo '<div class="wrapper-video">';
				do_action( 'thim_entry_top', $img_size );
				echo '</div>';
				echo '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="article-title">' . esc_attr( get_the_title() ) . '</a>';
				$length = $instance['excerpt_words'];
				echo '<div class="article-description">' . thim_excerpt( $length ) . '</div>';
				if ( $instance['hide_read_more'] == 1 ) {
					echo '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="button"><span>' . __( 'Read More', 'thim' ) . '</span></a>';
				}
				break;
			case 'audio':
				wp_enqueue_style( 'thim-pixel-industry', TP_THEME_FRAMEWORK_URI . 'js/jplayer/skin/pixel-industry/pixel-industry.css', array() );
				wp_enqueue_script( 'thim-jquery.jplayer', TP_THEME_FRAMEWORK_URI . 'js/jplayer/jquery.jplayer.min.js', array( 'jquery' ), '', true );
				echo '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="article-title">' . esc_attr( get_the_title() ) . '</a>';
				$length = $instance['excerpt_words'];
				echo '<div class="article-description">' . thim_excerpt( $length ) . '</div>';
				echo '<div class="wrapper-audio">';
				do_action( 'thim_entry_top', $img_size );
				echo '</div>';
				if ( $instance['hide_read_more'] == 1 ) {
					echo '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="button"><span>' . __( 'Read More', 'thim' ) . '</span></a>';
				}
				break;
			default:
				do_action( 'thim_entry_top', $img_size );
				echo '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="article-title">' . esc_attr( get_the_title() ) . '</a>';
				$length = $instance['excerpt_words'];
				echo '<div class="article-description">' . thim_excerpt( $length ) . '</div>';
				if ( $instance['hide_read_more'] == 1 ) {
					echo '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="button"><span>' . __( 'Read More', 'thim' ) . '</span></a>';
				}
		}
		echo '</div>';
	}
	wp_reset_postdata();

	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
}
?>