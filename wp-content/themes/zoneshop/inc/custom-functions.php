<?php

add_action( 'thim_logo', 'thim_logo' );
// logo
if ( !function_exists( 'thim_logo' ) ) :
	function thim_logo() {
		global $theme_options_data;
		if ( isset( $theme_options_data['thim_logo'] ) && $theme_options_data['thim_logo'] <> '' ) {
			$thim_logo     = $theme_options_data['thim_logo'];
			$thim_logo_src = $thim_logo; // For the default value
			if ( is_numeric( $thim_logo ) ) {
				$logo_attachment = wp_get_attachment_image_src( $thim_logo, 'full' );
				$thim_logo_src   = $logo_attachment[0];
			}
			$thim_logo_size = @getimagesize( $thim_logo_src );
			$logo_size      = $thim_logo_size[3];
			$site_title     = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home"><img src="' . $thim_logo_src . '" alt="' . $site_title . '" ' . $logo_size . ' /></a>';
		} else {
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a>';
		}
	}
endif; // logo

add_action( 'thim_sticky_logo', 'thim_sticky_logo' );
// get sticky logo
if ( !function_exists( 'thim_sticky_logo' ) ) :
	function thim_sticky_logo() {
		global $theme_options_data;
		if ( isset( $theme_options_data['thim_sticky_logo'] ) && $theme_options_data['thim_sticky_logo'] <> '' ) {
			$thim_logo_stick_logo     = $theme_options_data['thim_sticky_logo'];
			$thim_logo_stick_logo_src = $thim_logo_stick_logo; // For the default value
			if ( is_numeric( $thim_logo_stick_logo ) ) {
				$logo_attachment          = wp_get_attachment_image_src( $thim_logo_stick_logo, 'full' );
				$thim_logo_stick_logo_src = $logo_attachment[0];
			}
			$thim_logo_size = @getimagesize( $thim_logo_stick_logo_src );
			$logo_size      = $thim_logo_size[3];
			$site_title     = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">
					<img src="' . $thim_logo_stick_logo_src . '" alt="' . $site_title . '" ' . $logo_size . ' /></a>';
		} elseif ( isset( $theme_options_data['thim_logo'] ) && $theme_options_data['thim_logo'] <> '' ) {
			$thim_logo     = $theme_options_data['thim_logo'];
			$thim_logo_src = $thim_logo; // For the default value
			if ( is_numeric( $thim_logo ) ) {
				$logo_attachment = wp_get_attachment_image_src( $thim_logo, 'full' );
				$thim_logo_src   = $logo_attachment[0];
			}
			$thim_logo_size = @getimagesize( $thim_logo_src );
			$logo_size      = $thim_logo_size[3];
			$site_title     = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">
				<img src="' . $thim_logo_src . '" alt="' . $site_title . '" ' . $logo_size . ' /></a>';
		}
		if ( $theme_options_data['thim_sticky_logo'] == '' && $theme_options_data['thim_logo'] == '' ) {
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">
			' . esc_attr( get_bloginfo( 'name' ) ) . '</a>';;
		}
	}
endif; // thim_sticky_logo


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function thim_scripts() {
	global $current_blog;

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'thim-fonts-icon', TP_THEME_URI . 'fonts/fonts.css', array() );

	wp_enqueue_style( 'thim-custom', get_template_directory_uri() . '/css/custom.css' );
	// fix style for home page

	$fix_style = '';
	if ( is_page_template( 'page-templates/homepage_03.php' ) ) {
		$fix_style = 'home3-';
	}

	// include style css
	if ( is_multisite() ) {
		if ( file_exists( TP_THEME_DIR . 'style-' . $current_blog->blog_id . '.css' ) ) {
			wp_enqueue_style( 'thim-style', TP_THEME_URI . 'style-' . $current_blog->blog_id . '.css', array() );
		} else {
			wp_enqueue_style( 'thim-style', get_stylesheet_uri() );
		}
	} else {
		wp_enqueue_style( 'thim-style', TP_THEME_URI . $fix_style . 'style.css', array() );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'thim-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'thim-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

//	wp_deregister_script( 'thim-menumobile' );
//	wp_register_script( 'thim-menumobile', TP_THEME_URI . 'js/menumobile.js', array( 'jquery' ), '', true );
//	wp_enqueue_script( 'thim-menumobile' );

	wp_deregister_script( 'thim-owl-carousel' );
	wp_register_script( 'thim-owl-carousel', TP_THEME_URI . 'js/owl.carousel.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'thim-owl-carousel' );

	/* woo */
	wp_deregister_script( 'thim-flexslider' );
	wp_register_script( 'thim-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '', true );

	wp_deregister_script( 'thim-retina' );
	wp_register_script( 'thim-retina', get_template_directory_uri() . '/js/jquery.retina.min.js', array( 'jquery' ), '', false );

	wp_deregister_script( 'thim-waypoints' );
	wp_register_script( 'thim-waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'thim-waypoints' );

	wp_deregister_script( 'thim-magnific-popup' );
	wp_register_script( 'thim-magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'thim-magnific-popup' );

	wp_deregister_script( 'thim-product' );
	wp_register_script( 'thim-product', get_template_directory_uri() . '/js/product.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'thim-product' );

	wp_deregister_script( 'thim-custom-script' );
	wp_register_script( 'thim-custom-script', get_template_directory_uri() . '/js/custom-script.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'thim-custom-script' );

}

add_action( 'wp_enqueue_scripts', 'thim_scripts' );

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function thim_hex2rgb( $hex ) {
	$hex = str_replace( "#", "", $hex );
	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );

	return $rgb; // returns an array with the rgb values
}

function thim_getExtraClass( $el_class ) {
	$output = '';
	if ( $el_class != '' ) {
		$output = " " . str_replace( ".", "", $el_class );
	}

	return $output;
}

function thim_getCSSAnimation( $css_animation ) {
	$output = '';
	if ( $css_animation != '' ) {
		$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation;
	}

	return $output;
}

function thim_excerpt( $limit ) {
	$content = get_the_excerpt();
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	$content = explode( ' ', $content, $limit );
	array_pop( $content );
	$content = implode( " ", $content );

	return $content;
}


/*************************************************************
 * Breadcrumbs
 * ****************************************************************** */
function thim_breadcrumbs() {
	global $wp_query, $post;
	// Start the UL
	echo '<ul class="ulbreadcrumbs" itemprop="breadcrumb">';
	echo '<li><a href="' . esc_url( home_url() ) . '" class="home">' . __( "Home", 'thim' ) . '</a></li>';
	if ( is_category() ) {
		$catTitle = single_cat_title( "", false );
		$cat      = get_cat_ID( $catTitle );
		echo '<li>' . get_category_parents( $cat, true, "" ) . '</li>';
	} elseif ( is_archive() && !is_category() ) {
		echo '<li>' . __( 'Archives', 'thim' ) . '</li>';
	} elseif ( is_search() ) {
		echo '<li>' . __( 'Search Result', 'thim' ) . '</li>';
	} elseif ( is_404() ) {
		echo '<li>' . __( '404 Not Found', 'thim' ) . '</li>';
	} elseif ( is_single( $post ) ) {
		if ( get_post_type() == 'post' ) {
			$category    = get_the_category();
			$category_id = get_cat_ID( $category[0]->cat_name );
			echo ' <li>' . get_category_parents( $category_id, true, " " ) . '</li>';
			echo ' <li>' . the_title( '', '', false ) . '</li>';
		} else {
			echo '  <li> ' . esc_attr( get_the_title() ) . ' </li>';
		}
	} elseif ( is_page() ) {
		$post = $wp_query->get_queried_object();

		if ( $post->post_parent == 0 ) {
			echo "<li>" . the_title( '', '', false ) . "</li>";
		} else {
			$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
			array_push( $ancestors, $post->ID );

			foreach ( $ancestors as $ancestor ) {
				if ( $ancestor != end( $ancestors ) ) {
					echo '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . strip_tags( apply_filters( 'single_post_title', esc_attr( get_the_title( $ancestor ) ) ) ) . '</a></li>';
				} else {
					echo '<li>' . strip_tags( apply_filters( 'single_post_title', esc_attr( get_the_title( $ancestor ) ) ) ) . '</li>';
				}
			}
		}
	} elseif ( is_attachment() ) {
		$parent = get_post( $post->post_parent );
		if ( $parent->post_type == 'page' || $parent->post_type == 'post' ) {
			$cat = get_the_category( $parent->ID );
			$cat = $cat[0];
			echo "<li>" . get_category_parents( $cat, true, ' ' ) . "</li>";
		}

		echo '<li><a href="' . esc_url( get_permalink( $parent ) ) . '">' . esc_attr( $parent->post_title ) . '</a></li>';
		echo "<li>" . esc_attr( get_the_title() ) . "</li>";
	}
	// End the UL
	echo "</ul>";
}

// related
function thim_get_related_posts( $post_id, $number_posts = - 1 ) {
	$query = new WP_Query();
	$args  = '';
	if ( $number_posts == 0 ) {
		return $query;
	}
	$args  = wp_parse_args( $args, array(
		'posts_per_page'      => $number_posts,
		'post__not_in'        => array( $post_id ),
		'ignore_sticky_posts' => 0,
		'meta_key'            => '_thumbnail_id',
		'category__in'        => wp_get_post_categories( $post_id )
	) );
	$query = new WP_Query( $args );

	return $query;
}

/************ List Comment ***************/
if ( !function_exists( 'thim_comment' ) ) {
	function thim_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		//extract( $args, EXTR_SKIP );
		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo ent2ncr( $tag ) ?> <?php comment_class( 'description_comment' ) ?> id="comment-<?php comment_ID() ?>">
		<?php
		echo '<div class="parent-comment-li">';
		if ( $args['avatar_size'] != 0 ) {
			echo get_avatar( $comment, $args['avatar_size'] );
		}
		?>
		<div class="author"><?php printf( __( '<span class="author-name">%s</span>', 'thim' ), get_comment_author_link() ) ?></div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'thim' ) ?></em>
		<?php endif; ?>
		<div class="comment-extra-info">
			<div class="date" itemprop="commentTime"><?php printf( get_comment_date(), get_comment_time() ) ?></div>
			<?php comment_reply_link( array_merge( $args, array(
			'add_below' => $add_below,
			'depth'     => $depth,
			'max_depth' => $args['max_depth']
		) ) ) ?>
		<?php edit_comment_link( __( 'Edit', 'thim' ), '', '' ); ?>
		</div>
		<div class="message">
			<?php comment_text() ?>
		</div>
		</div>
		<div class="clear"></div>
	<?php
	}
}
/************end list comment************/