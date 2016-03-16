<?php
if ( class_exists( 'WooCommerce' ) ) {
	class Thim_Wc_Product_Slider_Widget extends Thim_Widget {
		function __construct() {
			$product_categories = get_terms( 'product_cat', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
			$cate               = '';
			if ( is_array( $product_categories ) ) {
				foreach ( $product_categories as $cat ) {
					$cate[$cat->term_id] = $cat->name;
				}
			}

			parent::__construct(
				'wc-product-slider',
				__( 'Thim Product Slider', 'thim' ),
				array(
					'description'   => __( 'Show product Slider', 'thim' ),
					'help'          => '',
					'panels_groups' => array( 'thim_widget_group' )
				),
				array(),
				array(
					'title'               => array(
						'type'  => 'text',
						'std'   => '',
						'label' => __( 'Title Widget', 'thim' )
					),
					'product_slider_show' => array(
						'type'          => 'select',
						'std'           => '',
						'label'         => __( 'Show', 'thim' ),
						'options'       => array(
							'all'			=> 'All Products',
							'new'			=> __( 'New', 'thim' ),
							'featured'    => __( 'Featured Products', 'thim' ),
							'onsale'      => __( 'On-sale Products', 'thim' ),
							'bestsellers' => __( 'Best-Sellers Products', 'thim' ),
							'category'    => __( 'Category', 'thim' ),
							

						),
						'state_emitter' => array(
							'callback' => 'select',
							'args'     => array( 'category_tab_product' )
						)
					),
					'product_slider_cats' => array(
						'type'          => 'select',
						'std'           => '',
						'label'         => __( 'Select Category', 'thim' ),
						'options'       => $cate,
						'state_handler' => array(
							'category_tab_product[category]'    => array( 'show' ),
							'category_tab_product[bestsellers]' => array( 'hide' ),
							'category_tab_product[onsale]'      => array( 'hide' ),
							'category_tab_product[featured]'    => array( 'hide' ),
							'category_tab_product[all]'         => array( 'hide' ),
						)
					),
					'image'               => array(
						'type'    => 'media',
						'label'   => __( 'Insert a image', 'thim' ),
						'default' => 'null'
					),
					'link_images'         => array(
						'type'  => 'text',
						'std'   => '',
						'label' => __( 'Link Feature Images', 'thim' )
					),
					'show_image'          => array(
						'type'    => 'checkbox',
						'label'   => __( 'Show image', 'thim' ),
						'default' => 0
					),
					'column_slider'       => array(
						'type'    => 'select',
						'std'     => '4',
						'label'   => __( 'Column', 'thim' ),
						'options' => array(
							'1' => __( '1', 'thim' ),
							'2' => __( '2', 'thim' ),
							'3' => __( '3', 'thim' ),
							'4' => __( '4', 'thim' ),
							'5' => __( '5', 'thim' ),
						)
					),
					'orderby'             => array(
						'type'    => 'select',
						'std'     => 'date',
						'label'   => __( 'Order by', 'thim' ),
						'options' => array(
							'date'  => __( 'Date', 'thim' ),
							'price' => __( 'Price', 'thim' ),
							'rand'  => __( 'Random', 'thim' ),
							'sales' => __( 'Sales', 'thim' ),
						)
					),
					'order'               => array(
						'type'    => 'select',
						'std'     => 'desc',
						'label'   => __( 'Order', 'Sorting order', 'thim' ),
						'options' => array(
							'asc'  => __( 'ASC', 'thim' ),
							'desc' => __( 'DESC', 'thim' ),
						)
					),
					'number_product'      => array(
						'type'    => 'number',
						'std'     => '12',
						'default' => '8',
						'label'   => __( 'Number Product', 'thim' )
					),
					'hide_free'           => array(
						'type'  => 'checkbox',
						'std'   => 0,
						'label' => __( 'Hide free products', 'thim' )
					),
					'show_hidden'         => array(
						'type'  => 'checkbox',
						'std'   => 0,
						'label' => __( 'Show hidden products', 'thim' )
					),
					'type_title'          => array(
						"type"    => "select",
						"label"   => __( "Type Title", "thim" ),
						"options" => array(
							"boder"    => __( "Border", "thim" ),
							"no_boder" => __( "No border left", "thim" ),
						),
					),
				),
				TP_THEME_DIR . 'inc/widgets/wc-product-slider/'
			);
		}

		/**
		 * Initialize the CTA widget
		 */

		function get_template_name( $instance ) {
			return 'base';
		}

		function get_style_name( $instance ) {
			return false;
		}

		function enqueue_frontend_scripts() {
			wp_enqueue_script( 'js-product-slider', TP_THEME_URI . 'inc/widgets/wc-product-slider/js/product-slider.js', array( 'jquery' ), '', true );
		}
	}

	function thim_wc_product_slider_widget_register() {
		register_widget( 'Thim_Wc_Product_Slider_Widget' );
	}

	add_action( 'widgets_init', 'thim_wc_product_slider_widget_register' );
}
