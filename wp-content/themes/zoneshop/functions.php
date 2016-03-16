<?php

/**
 * thim functions and definitions
 *
 * @package thim
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}


if ( ! function_exists( 'thim_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thim_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on thim, use a find and replace
		 * to change 'thim' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'thim', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'thim' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio'
		) );

		add_theme_support( "title-tag" );
		add_theme_support( 'woocommerce' );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'thim_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	}

endif; // thim_setup
add_action( 'after_setup_theme', 'thim_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */

function thim_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'thim' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => 'Top Drawer',
		'id'            => 'drawer_top',
		'description'   => __( 'Drawer Top', 'thim' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Toolbar', 'thim' ),
		'id'            => 'toolbar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s" >',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Offcanvas Sidebar', 'thim' ),
		'id'            => 'offcanvas_sidebar',
		'description'   => 'Offcanvas Sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );


	register_sidebar( array(
		'name'          => __( 'Header Left', 'thim' ),
		'id'            => 'header_left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s" >',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header Right', 'thim' ),
		'id'            => 'header_right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Menu Right', 'thim' ),
		'id'            => 'menu_right',
		'description'   => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s" >',
		'after_widget'  => '</li>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer', 'thim' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Bottom', 'thim' ),
		'id'            => 'footer_bottom',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Copyright', 'thim' ),
		'id'            => 'copyright',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar Shop', 'thim' ),
		'id'            => 'sidebar-shop',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="box-heading">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'thim_widgets_init' );

/**
 * load framework
 */
require_once get_template_directory() . '/framework/tp-framework.php';


// require
require TP_THEME_DIR . 'inc/custom-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';
require TP_THEME_DIR . 'inc/admin/customize-options.php';

if ( class_exists( 'WooCommerce' ) ) {
	// Woocomerce
	WC_Post_types::register_taxonomies();
	require get_template_directory() . '/woocommerce/woocommerce.php';
}
//
require TP_THEME_DIR . 'inc/widgets/widgets.php';

// tax meta
require TP_THEME_DIR . 'inc/tax-meta.php';

if ( is_admin() ) {
	require TP_THEME_DIR . 'inc/admin/plugins-require.php';
}

//pannel Widget Group
function thim_widget_group($tabs) {
	$tabs[] = array(
		'title' => __('Thim Widget', 'thim'),
		'filter' => array(
			'groups' => array('thim_widget_group')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'thim_widget_group', 19);
// MOI START
add_filter('wp_enqueue_scripts', 'enqueue_my_scripts', 20);
function enqueue_my_scripts() {
    wp_enqueue_style( 'moi-custom-style',get_stylesheet_directory_uri() . '/moi_custom/style.css');
}




/**Add the field to the checkout **/

add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );

function my_custom_checkout_field( $checkout ) {

    echo '<div id="my_custom_checkout_field"><h2>' . __('Distrito') . '</h2>';

    woocommerce_form_field( 'distrito_name', array(
        'type'          => 'select',
        'options'     => array(
            '' => __('', 'woocommerce' ),
            'San Isidro' => __('San Isidro', 'woocommerce' ),
            'San Borja' => __('San Borja', 'woocommerce' ),
            'La Molina' => __('La Molina', 'woocommerce' ),
            'Miraflores' => __('Miraflores', 'woocommerce' ),
            'Surco' => __('Surco', 'woocommerce' )
        ),
        'label'     => __('Selecionar Distrito', 'woocommerce'),
        'clear' => true,
        'class'         => array('my-field-class form-row-wide'),
        'required'  => true,
    ), $checkout->get_value( 'distrito_name' ));

    echo '</div>';
}
/**
 * Process the checkout
 */
add_action('woocommerce_checkout_process', 'distrito_name_checkout_field_process');

function distrito_name_checkout_field_process() {
    // Check if set, if its not set add an error.
    if ( empty($_POST['distrito_name']) )
        wc_add_notice( __( 'Por favor, seleccione un distrito válido.' ), 'error' );

}

// Our hooked in function - remove unsed attribut
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );

function custom_override_default_address_fields( $address_fields ) {
    //$address_fields['city']['required'] = false;
    unset($address_fields['city']);
    unset($address_fields['state']);
    unset($address_fields['postcode']);
    unset($address_fields['company']);
    return $address_fields;

}
/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['distrito_name'] ) ) {
        update_post_meta( $order_id, 'Distrito', sanitize_text_field( $_POST['distrito_name'] ) );
    }
}
/**
 * Change Proceed To Checkout Text in WooCommerce
 * Place this in your Functions.php file
 **/

function woocommerce_button_proceed_to_checkout() {
    $checkout_url = WC()->cart->get_checkout_url();
    ?>
    <a href="<?php echo $checkout_url; ?>" class="checkout-button button alt wc-forward"><?php _e( 'Comprar', 'woocommerce' ); ?></a>
<?php
}
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );

remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );

// remove version on static files

function _remove_script_version( $src ){
    $parts = explode( '?ver', $src );
    return $parts[0];
}

add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

// remove some metas
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version