<?php
//require_once get_template_directory() . '/framework/libs/tax-meta-class/Tax-meta-class.php';
//
//if ( is_admin() ) {
//	/*
//	   * prefix of meta keys, optional
//	   */
//	$prefix = 'thim_';
//	/*
//	   * configure your meta box
//	   */
//	$config = array(
//		'id'             => 'category_meta_box', // meta box id, unique per meta box
//		'title'          => 'Category Meta Box', // meta box title
//		'pages'          => array( 'category' ), // taxonomy name, accept categories, post_tag and custom taxonomies
//		'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
//		'fields'         => array(), // list of meta fields (can be added by field arrays)
//		'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
//		'use_with_theme' => false //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
//	);
//
//	/*
//	   * Initiate your meta box
//	   */
//	$my_meta = new Tax_Meta_Class( $config );
//
//	/*
//   * Add fields to your meta box
//   */
//	/* category */
//	$my_meta->addSelect(
//		$prefix . 'layout',
//		array(
//			''              => __( 'Using in Theme Option', 'thim' ),
//			'no-sidebar'    => __( 'No Sidebar', 'thim' ),
//			'left-sidebar'  => __( 'Left Sidebar', 'thim' ),
//			'right-sidebar' => __( 'Right Sidebar', 'thim' )
//		),
//		array(
//			'name' => __( 'Custom Layout ', 'thim' ),
//			'std'  => array( '' )
//		)
//	);
//
//	$my_meta->addColor( $prefix . 'cat_bg_header_color', array( 'name' => __( 'Background Heading', 'thim' ) ) );
//	$my_meta->addColor( $prefix . 'cat_text_header_color', array( 'name' => __( 'Text Color Heading', 'thim' ) ) );
//	$my_meta->Finish();
//}

require_once get_template_directory() . '/framework/libs/tax-meta-class/Tax-meta-class.php';

if ( is_admin() ) {
	/*
	   * prefix of meta keys, optional
	   */
	$prefix = 'thim_';
	/*
	   * configure your meta box
	   */
	$config  = array(
		'id'             => 'demo_meta_box', // meta box id, unique per meta box
		'title'          => 'Demo Meta Box', // meta box title
		'pages'          => array( 'category' ), // taxonomy name, accept categories, post_tag and custom taxonomies
		'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
		'fields'         => array(), // list of meta fields (can be added by field arrays)
		'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => false //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
	$config1 = array(
		'id'             => 'demo_meta_box', // meta box id, unique per meta box
		'title'          => 'Demo Meta Box', // meta box title
		'pages'          => array( 'product_cat' ), // taxonomy name, accept categories, post_tag and custom taxonomies
		'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
		'fields'         => array(), // list of meta fields (can be added by field arrays)
		'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => false //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
//	$config_portfolio = array(
//		'id'             => 'demo_meta_box', // meta box id, unique per meta box
//		'title'          => 'Demo Meta Box', // meta box title
//		'pages'          => array( 'portfolio_category' ), // taxonomy name, accept categories, post_tag and custom taxonomies
//		'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
//		'fields'         => array(), // list of meta fields (can be added by field arrays)
//		'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
//		'use_with_theme' => false //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
//	);

	/*
	   * Initiate your meta box
	   */
	$my_meta  = new Tax_Meta_Class( $config );
	$my_meta1 = new Tax_Meta_Class( $config1 );
//	$my_meta_portfolio = new Tax_Meta_Class( $config_portfolio );

	/*
	   * Add fields to your meta box
	   */

	/* blog */
	$my_meta = new Tax_Meta_Class( $config );
	$my_meta->addSelect( $prefix . 'layout', array( '' => 'Using in Theme Option',
													'no-sidebar' => 'No Sidebar',
													'left-sidebar' => 'Left Sidebar',
													'right-sidebar' => 'Right Sidebar'),
		array( 'name' => __( 'Custom Layout ', 'thim' ), 'std' => array( '' ) ) );

//	$my_meta1->addSelect( $prefix . 'cate_product_heading_bg', array( 'default' => 'Using in Theme Option',
//																	  'bg_color' => 'Background Color',
//																	  'bg_img' => 'Background Image' ),
//		array( 'name' => 'Custom Background Heading ', 'std' => array( 'default' ) ) );
//	$my_meta1->addColor($prefix . 'bg_color_product', array('name' => __('Background Color ', 'thim')));
//	$my_meta1->addImage( $prefix . 'bg_img_product', array( 'name' => __( 'Background Image ', 'thim' ) ) );

	$my_meta1->addSelect( $prefix . 'custom_cate_layout', array( 'default' => 'Using in Theme Option',
																 'left_sidebar' => 'Left Sidebar',
																 'right_sidebar' => 'Right Sidebar',
																 'fullwidth' => 'No Sidebar' ),
		array( 'name' => 'Custom Layout ', 'std' => array( 'left_sidebar' ) ) );

//	/* portfolio */
//	$my_meta_portfolio->addText( $prefix . 'icon_single', array( 'name' => 'Icon for Single Portfolio','desc'=>'enter name icon fontawesome ex: fa-home') );
//	$my_meta_portfolio->addImage( $prefix . 'icon_images_single', array( 'name' => __( 'Or Upload Icon', 'thim' ) ) );

	$my_meta->Finish();
}
