<?php
global $theme_options_data;
$custom_font_size = $width = $des = $layout = '';

$number_posts = 4;
if ( $instance['number_posts'] <> '' ) {
	$number_posts = $instance['number_posts'];
}
if ( $instance['layout'] <> '' ) {
	$layout = $instance['layout'];
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
	$img_size = "medium";
	echo '<div class="kbm-recent-article ' . esc_attr( $layout ) . '">
	<div class="box kuler-module">';
	if ( $instance['title'] ) {
		echo '<div class="box-heading"><span>' . esc_attr( $instance['title'] ) . '</span></div>';
	}
	echo '<ul class="articles">';
	while ( $posts_display->have_posts() ) {
		$posts_display->the_post();
		$format = $post_format = get_post_format();
		if ( $instance['column'] ) {
			$column = 12 / $instance['column'];
			$col    = ' col-md-' . $column . ' col-sm-6';
		} else {
			$col = " col-md-3 col-sm-6";
		}
		if ( false === $format ) {
			$format = 'format-standard' . $col;
		} else {
			$format = 'format-' . $format . $col;
		}

		if ( $layout == 'layout-1' ) {
			echo '<li class="wow fadeInRight ' . $format . '">';
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
			echo '</li>';
		} else {
			echo '<li class="' . $format . '">';
			if ( has_post_thumbnail() ) {
				echo '<div class="image">' . get_the_post_thumbnail( get_the_ID(), 'thumbnail' ) . '</div>';
			}
			echo '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="article-title">' . esc_attr( get_the_title() ) . '</a>';
			echo '<span class="author-date">';
			echo '<span class="kmm-date">' . get_the_time( $theme_options_data['thim_date_format'] ) . ' </span>';
			if ( $instance['show_author'] == 1 ) {
				echo '<span class="kmm-author">' . __( 'by ', 'thim' );
				printf( '<a href="%1$s" rel="author">%2$s</a>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				);
				echo ' </span>';
			}
			echo ' </span>';
			$length = $instance['excerpt_words'];
			if ( $length > 0 ) {
				echo '<div class="article-description">' . thim_excerpt( $length ) . '</div>';
			}
			if ( $instance['hide_read_more'] == 1 ) {
				echo '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="button"><span>' . __( 'Read More', 'thim' ) . '</span></a>';
			}
			echo '</li>';
		}
		//echo '<div class="item">';

	}
	wp_reset_postdata();
	echo '</ul>';
	echo '</div>';
	echo '</div>';
}
?>