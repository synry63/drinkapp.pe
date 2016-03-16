<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
	return $enqueue_styles;
}

// Override WooCommerce function
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 12 );
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
	function woocommerce_template_loop_product_thumbnail() {
		global $product, $theme_options_data;
		$theme_options_data['thim_woo_set_hover_item'] = 'changeimages';
		$attachment_ids                                = $product->get_gallery_attachment_ids();
		$image                                         = "";
		if ( isset( $attachment_ids[0] ) ) {
			$image = wp_get_attachment_image( $attachment_ids[0], apply_filters( 'shop_catalog', 'shop_catalog' ) );
		}
		if ( isset( $theme_options_data['thim_woo_set_hover_item'] ) && $theme_options_data['thim_woo_set_hover_item'] == "changeimages" ) {
			echo '<div class="image">';
			echo woocommerce_get_product_thumbnail();
			echo '</div>';
			if ( $image != "" ) {
				echo '<span class="hover">' . $image . '</span>';
			} else {
				echo '<span class="hover">' . woocommerce_get_product_thumbnail() . '</span>';
			}
		} else {
			echo '<div class="thumb flip">';
			echo '<span class="face">' . woocommerce_get_product_thumbnail() . '</span>';
			if ( $image != "" ) {
				echo '<span class="face back">' . $image . '</span>';
			} else {
				echo '<span class="face back">' . woocommerce_get_product_thumbnail() . '</span>';
			}
			echo '</div>';
		}
	}

}

// Override WooCommerce function
add_action( 'woocommerce_before_product_slider_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 12 );
add_action( 'woocommerce_before_product_slider_loop_item_title', 'woocommerce_template_loop_product_slider_thumbnail', 10 );

if ( ! function_exists( 'woocommerce_template_loop_product_slider_thumbnail' ) ) {
	function woocommerce_template_loop_product_slider_thumbnail( $images_size ) {
		global $product, $theme_options_data;
		$theme_options_data['thim_woo_set_hover_item'] = 'changeimages';
		$attachment_ids                                = $product->get_gallery_attachment_ids();
		$image                                         = "";
		if ( isset( $attachment_ids[0] ) ) {
			$image = wp_get_attachment_image( $attachment_ids[0], apply_filters( $images_size, $images_size ) );
		}
		if ( isset( $theme_options_data['thim_woo_set_hover_item'] ) && $theme_options_data['thim_woo_set_hover_item'] == "changeimages" ) {
			echo '<div class="image">';
			echo woocommerce_get_product_thumbnail( $images_size );
			echo '</div>';
			$linkimg = the_permalink();
			if ( $image != "" ) {
				echo '<a href="' . $linkimg . '"> <span class="hover">' . $image . '</span></a>';
			} else {
				echo '<a href="' . $linkimg . '"><span class="hover">' . woocommerce_get_product_thumbnail() . '</span></a>';
			}
		} else {
			echo '<div class="thumb flip">';
			echo '<span class="face">' . woocommerce_get_product_thumbnail() . '</span>';
			if ( $image != "" ) {
				echo '<span class="face back">' . $image . '</span>';
			} else {
				echo '<span class="face back">' . woocommerce_get_product_thumbnail() . '</span>';
			}
			echo '</div>';
		}
	}

}

// custom hook content product

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
//add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 4 );
add_action( 'woocommerce_shop_price', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_shop_description', 'woocommerce_content_description', 20 );
if ( ! function_exists( 'woocommerce_content_description' ) ) {
	function woocommerce_content_description() {
		global $post;
		if ( ! $post->post_excerpt ) {
			return;
		}
		?>
		<div class="description">
			<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
		</div>
		<?php
	}
}

add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
	if ( is_product_category() ) {
		global $wp_query;
		$cat          = $wp_query->get_queried_object();
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		$image        = wp_get_attachment_url( $thumbnail_id );
		if ( $image ) {
            //	echo '<div class="image col-md-4 col-xs-12"><img src="' . $image . '" alt="" /></div>';  MOI
            echo '<div class="image col-md-12 col-xs-12"><img src="' . $image . '" alt="" /></div>';
		}
	}
}

if ( ! function_exists( 'woocommerce_taxonomy_archive_description' ) ) {
	/**
	 * Show a shop page description on product archives
	 *
	 * @access        public
	 * @subpackage    Archives
	 * @return void
	 */

	function woocommerce_taxonomy_archive_description() {
		if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) {
			$description = wpautop( do_shortcode( term_description() ) );
			if ( $description ) {
				echo '<div class="col-md-8 col-xs-12">' . $description . '</div>';
			}
		}
	}
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title_detail', 60 );

if ( ! function_exists( 'woocommerce_template_single_title_detail' ) ) {

	/**
	 * Output the product short description (excerpt).
	 *
	 * @access        public
	 * @subpackage    Product
	 * @return void
	 */
	function woocommerce_template_single_title_detail() {
		wc_get_template( 'single-product/title-detail.php' );
	}
}

if ( ! function_exists( 'woocommerce_product_archive_description' ) ) {
	/**
	 * Show a shop page description on product archives
	 *
	 * @access        public
	 * @subpackage    Archives
	 * @return void
	 */
	function woocommerce_product_archive_description() {
		if ( is_post_type_archive( 'product' ) && get_query_var( 'paged' ) == 0 ) {
			$shop_page = get_post( wc_get_page_id( 'shop' ) );
			if ( $shop_page ) {
				$description = wpautop( do_shortcode( $shop_page->post_content ) );
				if ( $description ) {
					echo '<div class="col-md-8 col-xs-12">' . $description . '</div>';
				}
			}
		}
	}
}
// remove woocommerce_breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
//add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// custom hook single product
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 1 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 9 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 15 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 28 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title_detail', 60 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title_detail', 12 );

//product list/grid
add_action( 'woocommerce_before_shop_loop', 'woocommerce_product_filter', 15 );
if ( ! function_exists( 'woocommerce_product_filter' ) ) {
	function woocommerce_product_filter() {
		echo '<div class="col-lg-3 col-sm-6 display">
					<a href="javascript:;" class="grid switchToGrid">' . __( 'TABLA', 'thim' ) . '</a>
					<a href="javascript:;" class="list switchToList">' . __( 'LISTA', 'thim' ) . '</a>
				</div>';
	}
}

if ( is_plugin_active( 'yith-woocommerce-compare/init.php' ) || is_plugin_active_for_network( 'yith-woocommerce-compare/init.php' ) ) {
	add_action( 'woocommerce_before_shop_loop', 'woocommerce_product_compare', 16 );
	if ( ! function_exists( 'woocommerce_product_compare' ) ) {
		function woocommerce_product_compare() {
			$product_compare_obj   = new YITH_Woocompare_Frontend();
			$total_product_compare = count( $product_compare_obj->products_list );
			echo '<div class="col-lg-3 col-sm-6 product-compare">
				<a href="javascript:;" id="compare-total">' . __( 'Product Compare (' . $total_product_compare . ')', 'thim' ) . '</a>
			</div>';
		}
	}
}

add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

add_filter( 'loop_shop_per_page', 'thim_loop_shop_per_page' );
function thim_loop_shop_per_page() {
	global $theme_options_data;

	parse_str( $_SERVER['QUERY_STRING'], $params );

	if ( isset( $theme_options_data['thim_woo_product_per_page'] ) && $theme_options_data['thim_woo_product_per_page'] ) {
		$per_page = $theme_options_data['thim_woo_product_per_page'];
	} else {
		$per_page = 12;
	}

	$pc = ! empty( $params['product_count'] ) ? $params['product_count'] : $per_page;

	return $pc;

}

function tf_addURLParameter( $url, $paramName, $paramValue ) {
	$url_data = parse_url( $url );
	if ( ! isset( $url_data["query"] ) ) {
		$url_data["query"] = "";
	}

	$params = array();
	parse_str( $url_data['query'], $params );
	$params[ $paramName ] = $paramValue;
	$url_data['query']    = http_build_query( $params );

	return tf_build_url( $url_data );
}

function tf_build_url( $url_data ) {
	$url = "";
	if ( isset( $url_data['host'] ) ) {
		$url .= $url_data['scheme'] . '://';
		if ( isset( $url_data['user'] ) ) {
			$url .= $url_data['user'];
			if ( isset( $url_data['pass'] ) ) {
				$url .= ':' . $url_data['pass'];
			}
			$url .= '@';
		}
		$url .= $url_data['host'];
		if ( isset( $url_data['port'] ) ) {
			$url .= ':' . $url_data['port'];
		}
	}
	if ( isset( $url_data['path'] ) ) {
		$url .= $url_data['path'];
	}
	if ( isset( $url_data['query'] ) ) {
		$url .= '?' . $url_data['query'];
	}
	if ( isset( $url_data['fragment'] ) ) {
		$url .= '#' . $url_data['fragment'];
	}

	return $url;
}

if ( ! function_exists( 'woocommerce_result_count' ) ) {
	function woocommerce_result_count() {
		global $theme_options_data;
		parse_str( $_SERVER['QUERY_STRING'], $params );
		$query_string = '?' . $_SERVER['QUERY_STRING'];
		// replace it with theme option
		if ( isset( $theme_options_data['thim_woo_product_per_page'] ) && $theme_options_data['thim_woo_product_per_page'] ) {
			$per_page = $theme_options_data['thim_woo_product_per_page'];
		} else {
			$per_page = 12;
		}
		$pc   = ! empty( $params['product_count'] ) ? $params['product_count'] : $per_page;
		$html = '<div class="col-lg-2 col-sm-6 limit"><b>' . __( 'MOSTRAR', 'thim' ) . '</b>';
		$html .= '<select onchange="location = this.value;">
				<option value="' . tf_addURLParameter( $query_string, 'product_count', $per_page ) . '"  ' . ( ( $pc == $per_page ) ? 'selected="selected"' : '' ) . '>' . $per_page . '</option>
				<option value="' . tf_addURLParameter( $query_string, 'product_count', $per_page * 2 ) . '" ' . ( ( $pc == $per_page * 2 ) ? 'selected="selected"' : '' ) . '>' . ( $per_page * 2 ) . '</option>
				<option value="' . tf_addURLParameter( $query_string, 'product_count', $per_page * 3 ) . '" ' . ( ( $pc == $per_page * 3 ) ? 'selected="selected"' : '' ) . '>' . ( $per_page * 3 ) . '</option>
         </select>';
		$html .= '</div>';
		echo ent2ncr( $html );
	}
}

// add button compare before button wishlist in single product
global $yith_woocompare;
if ( isset( $yith_woocompare ) ) {
	remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
	add_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 30 );
}

/*****************quick view*****************/
remove_action( 'woocommerce_single_product_summary_quick', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_show_product_sale_flash', 1 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_rating', 15 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_loop_add_to_cart_quick_view', 20 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_excerpt', 30 );

remove_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_meta', 7 );

add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_sharing', 50 );

if ( ! function_exists( 'woocommerce_template_loop_add_to_cart_quick_view' ) ) {
	function woocommerce_template_loop_add_to_cart_quick_view() {
		global $product;
		do_action( 'woocommerce_' . $product->product_type . '_add_to_cart' );
		echo '<a href="' . esc_attr( get_the_permalink( $product->id ) ) . '" target="_top" class="button quick-view-detail">' . __( 'Detail', 'thim' ) . '</a><div class="clear"></div>';
	}
}

/* PRODUCT QUICK VIEW */
add_action( 'wp_head', 'lazy_ajax', 0, 0 );
function lazy_ajax() {
	?>
	<script type="text/javascript">
		/* <![CDATA[ */
		var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
		/* ]]> */
	</script>
	<?php
}

add_action( 'wp_ajax_jck_quickview', 'jck_quickview' );
add_action( 'wp_ajax_nopriv_jck_quickview', 'jck_quickview' );
/** The Quickview Ajax Output **/
function jck_quickview() {
	global $post, $product, $woocommerce;
	$prod_id = $_POST["product"];
	$post    = get_post( $prod_id );
	$product = get_product( $prod_id );
	// Get category permalink
	ob_start();
	?>
	<?php woocommerce_get_template( 'content-single-product-lightbox.php' ); ?>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	echo ent2ncr( $output );
	die();
}

/* End PRODUCT QUICK VIEW */

/* custom WC_Widget_Cart */
function thim_get_current_cart_info() {
	global $woocommerce;
	$items = count( $woocommerce->cart->get_cart() );

	return array(
		$items,
		get_woocommerce_currency_symbol()
	);
}

function thim_add_to_cart_success_ajax( $count_cat_product ) {
	global $woocommerce;
	list( $cart_items ) = thim_get_current_cart_info();
	if ( $cart_items > 0 ) {
		$cart_items = $cart_items . ' ' . __( 'ITEM(S)', 'thim' );
	} else {
		$cart_items = '0' . ' ' . __( 'item', 'thim' );
	}
	$cat_total                                                 = $woocommerce->cart->get_cart_subtotal();
	$count_cat_product['#header-mini-cart #cart-items-number'] = '<span id="cart-items-number">' . $cart_items . '</span>';
	$count_cat_product['#header-mini-cart #cart-total']        = '<span id="cart-total">' . $cat_total . '</span>';

	return $count_cat_product;
}

add_filter( 'add_to_cart_fragments', 'thim_add_to_cart_success_ajax' );


// Override WooCommerce Widgets
add_action( 'widgets_init', 'override_woocommerce_widgets', 15 );
function override_woocommerce_widgets() {
	if ( class_exists( 'WC_Widget_Cart' ) ) {
		unregister_widget( 'WC_Widget_Cart' );
		include_once( 'widgets/class-wc-widget-cart.php' );
		register_widget( 'Custom_WC_Widget_Cart' );
	}

	if ( class_exists( 'WC_Widget_Recent_Reviews' ) ) {
		unregister_widget( 'WC_Widget_Recent_Reviews' );
		include_once( 'widgets/class-wc-widget-recent-reviews.php' );
		register_widget( 'Custom_WC_Widget_Recent_Reviews' );
	}
}


/* Share Product */
add_action( 'woocommerce_share', 'wooshare' );

function wooshare() {
	global $theme_options_data;
	$html = '';
	if ( $theme_options_data['thim_woo_sharing_facebook'] == 1 ||
	     $theme_options_data['thim_woo_sharing_twitter'] == 1 ||
	     $theme_options_data['thim_woo_sharing_pinterest'] == 1 ||
	     $theme_options_data['thim_woo_sharing_google'] == 1
	) {
		$html .= '<div class="woo-share">';
		$html .= '<span>Share:</span>';
		$html .= '<ul>';
		if ( $theme_options_data['thim_woo_sharing_facebook'] == 1 ) {
			$html .= '<li><a target="_blank" class="facebook" href="https://www.facebook.com/sharer.php?s=100&amp;p[title]=' . get_the_title() . '&amp;p[url]=' . urlencode( get_permalink() ) . '&amp;p[images][0]=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) . '" title="' . __( 'Facebook', 'thim' ) . '"><i class="fa fa-facebook"></i></a></li>';
		}
		if ( $theme_options_data['thim_woo_sharing_twitter'] == 1 ) {
			$html .= '<li><a target="_blank" class="twitter" href="https://twitter.com/share?url=' . urlencode( get_permalink() ) . '&amp;text=' . esc_attr( get_the_title() ) . '" title="' . __( 'Twitter', 'thim' ) . '"><i class="fa fa-twitter"></i></a></li>';
		}
		if ( $theme_options_data['thim_woo_sharing_pinterest'] == 1 ) {
			$html .= '<li><a target="_blank" class="pinterest" href="http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . get_the_excerpt() . '&media=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) . '" onclick="window.open(this.href); return false;" title="' . __( 'Pinterest', 'thim' ) . '"><i class="fa fa-pinterest"></i></a></li>';
		}
		if ( $theme_options_data['thim_woo_sharing_google'] == 1 ) {
			$html .= '<li><a target="_blank" class="googleplus" href="https://plus.google.com/share?url=' . urlencode( get_permalink() ) . '&amp;title=' . esc_attr( get_the_title() ) . '" title="' . __( 'Google Plus', 'thim' ) . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'><i class="fa fa-google"></i></a></li>';
		}
		$html .= '</ul>';
		$html .= '</div>';
	}
	echo ent2ncr( $html );

}

// Change the breadcrumb separator
add_filter( 'woocommerce_breadcrumb_defaults', 'thim_change_breadcrumb_delimiter' );
function thim_change_breadcrumb_delimiter( $defaults ) {
	if ( is_singular( 'product' ) ) {
		$defaults['delimiter'] = '';

		return $defaults;
	} else {
		$defaults['delimiter'] = '';

		return $defaults;
	}
}

// New Product
function thim_woo_add_custom_general_fields() {
	echo '<div class="options_group" id="product_custom_affiliate">';
	woocommerce_wp_checkbox(
		array(
			'id'       => 'thim_product_new',
			'label'    => __( 'Product New', 'thim' ),
			'desc_tip' => 'true',
		)
	);

	woocommerce_wp_checkbox(
		array(
			'id'       => 'thim_product_hot',
			'label'    => __( 'Product Hot', 'thim' ),
			'desc_tip' => 'true',
		)
	);
	echo '</div>';
}

function thim_woo_add_custom_general_fields_save( $post_id ) {
	$thim_product_new = isset( $_POST['thim_product_new'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, 'thim_product_new', $thim_product_new );
	// Checkbox
	$thim_product_hot = isset( $_POST['thim_product_hot'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, 'thim_product_hot', $thim_product_hot );
}

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'thim_woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'thim_woo_add_custom_general_fields_save' );

function woo_add_style_yith_compare() {
	$css_file = get_template_directory_uri() . '/css/yith_compare.css';
	echo '<link rel="stylesheet" type="text/css" media="all" href="' . esc_url( $css_file ) . '" />';
}

if ( isset( $_GET['action'], $_GET['iframe'] ) && $_GET['action'] == 'yith-woocompare-view-table' && $_GET['iframe'] == "true" ) {
	add_action( 'wp_head', 'woo_add_style_yith_compare' );
}

function woocommerce_version_check( $version = '2.3.8' ) {
	global $woocommerce;
	if ( version_compare( $woocommerce->version, $version, ">=" ) ) {
		return true;
	}

	return false;
}

?>