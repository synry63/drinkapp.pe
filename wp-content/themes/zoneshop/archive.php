<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package thim
 */
 ?>
<?php
if ( have_posts() ) :
	/* Blog Type */
	if ( $select_style == 'masonry' ) {
		wp_enqueue_script( 'thim-isotope' );
		echo '<div class="blog-masonry">';
	} else {
		$html= esc_html("<h2 class='box-heading'>");
		echo "<h2 class='box-heading'>";

		if ( is_category() ) :
			$catTitle = single_cat_title( "", false );
			//$cat      = get_cat_ID( $catTitle );
			//var_dump($cat);
			echo get_the_category_by_ID( $cat );
		elseif ( is_author() ) :
			printf( __( 'Author: %s', 'thim' ), '<span class="vcard">' . esc_attr( get_the_author() ) . '</span>' );

		elseif ( is_day() ) :
			printf( __( 'Day: %s', 'thim' ), '<span>' . esc_attr( get_the_date() ) . '</span>' );

		elseif ( is_month() ) :
			printf( __( 'Month: %s', 'thim' ), '<span>' . esc_attr( get_the_date( _x( 'F Y', 'monthly archives date format', 'thim' ) ) ) . '</span>' );

		elseif ( is_year() ) :
			printf( __( 'Year: %s', 'thim' ), '<span>' . esc_attr( get_the_date( _x( 'Y', 'yearly archives date format', 'thim' ) ) ) . '</span>' );
		elseif ( is_search() ) :
			printf( __( 'Search Results for: %s', 'thim' ), '<span>' . get_search_query() . '</span>' );
		elseif ( is_404() ) :
			echo __( '404', 'thim' );
		elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
			echo __( 'Asides', 'thim' );

		elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
			echo __( 'Galleries', 'thim' );

		elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
			echo __( 'Images', 'thim' );

		elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
			echo __( 'Videos', 'thim' );

		elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
			echo __( 'Quotes', 'thim' );

		elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
			echo __( 'Links', 'thim' );

		elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
			echo __( 'Statuses', 'thim' );

		elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
			echo __( 'Audios', 'thim' );

		elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
			echo __( 'Chats', 'thim' );
		else :
			echo __( 'Archives', 'thim' );
		endif;
		echo '</h2>';
		echo '<div class="article-list clearafter">';
	}
	/* Start the Loop */
	while ( have_posts() ) : the_post();
		if ( $select_style == 'masonry' ) {
			get_template_part( 'content', 'grid' );
		} else {
			get_template_part( 'content' );
		}
	endwhile;
	echo '</div>';

	/* Paging Type */
 	thim_paging_nav();
 else :
	get_template_part( 'content', 'none' );
endif;