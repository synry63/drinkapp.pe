<?php

if ( class_exists( 'WooCommerce' ) ) {
	class Thim_Wc_Product_Widget extends Thim_Widget {
		function __construct() {
			$product_categories = get_terms( 'product_cat', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
			$cate               = '';
			if ( is_array( $product_categories ) ) {
				foreach ( $product_categories as $cat ) {
					$cate[$cat->term_id] = $cat->name;
				}
			}

			parent::__construct(
				'wc-product',
				__( 'Thim Product', 'thim' ),
				array(
					'description'   => __( 'Show product', 'thim' ),
					'help'          => '',
					'panels_groups' => array( 'thim_widget_group' )
				),
				array(),
				array(
					'title'          => array(
						'type'  => 'text',
						'std'   => '',
						'label' => __( 'Title Widget', 'thim' )
					),


					'show'           => array(
						'type'          => 'select',
						'std'           => '',
						'label'         => __( 'Show', 'thim' ),
						'options'       => array(
							'all'         => 'All Products',
							'featured'    => __( 'Featured Products', 'thim' ),
							'onsale'      => __( 'On-sale Products', 'thim' ),
							"bestsellers" => __( "Best-Sellers Products", "cilo" ),
							'category'    => 'Category'
						),
						'state_emitter' => array(
							'callback' => 'select',
							'args'     => array( 'category_product' )
						)
					),
					'cats'           => array(
						'type'          => 'select',
						'std'           => '',
						'label'         => __( 'Select Category', 'thim' ),
						'options'       => $cate,
						'state_handler' => array(
							'category_product[category]'    => array( 'show' ),
							'category_product[bestsellers]' => array( 'hide' ),
							'category_product[onsale]'      => array( 'hide' ),
							'category_product[featured]'    => array( 'hide' ),
							'category_product[all]'         => array( 'hide' ),
						)
					),
					'orderby'        => array(
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
					'order'          => array(
						'type'    => 'select',
						'std'     => 'desc',
						'label'   => _x( 'Order', 'Sorting order', 'thim' ),
						'options' => array(
							'asc'  => __( 'ASC', 'thim' ),
							'desc' => __( 'DESC', 'thim' ),
						)
					),
					'column'         => array(
						'type'    => 'select',
						'std'     => '4',
						'label'   => __( 'Column', 'thim' ),
						'options' => array(
							'1' => __( '1', 'thim' ), // using  column bootstrap
							'2' => __( '2', 'thim' ),
							'3' => __( '3', 'thim' ),
							'4' => __( '4', 'thim' )
						)
					),
					'number_product' => array(
						'type'  => 'text',
						'std'   => '5',
						'label' => __( 'Number Product', 'thim' )
					),
					'layout'         => array(
						'type'    => 'select',
						'std'     => 'layout-01',
						'label'   => __( 'Layout', 'thim' ),
						'options' => array(
							'default' => __( 'Default', 'thim' ), // using  column bootstrap
							'special' => __( 'Special', 'thim' ),
							'list'    => __( 'List', 'thim' ),
						)
					),
					'hide_free'      => array(
						'type'  => 'checkbox',
						'std'   => 0,
						'label' => __( 'Hide free products', 'thim' )
					),
					'show_hidden'    => array(
						'type'  => 'checkbox',
						'std'   => 0,
						'label' => __( 'Show hidden products', 'thim' )
					)
				),
				TP_THEME_DIR . 'inc/widgets/wc-product/'
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

	}

	function thim_wc_product_widget_register() {
		register_widget( 'Thim_Wc_Product_Widget' );
	}

	add_action( 'widgets_init', 'thim_wc_product_widget_register' );
}
