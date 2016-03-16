<?php

/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 12/3/2014
 * Time: 9:54 AM
 */
if ( class_exists( 'WooCommerce' ) ) {
	class Thim_Tab_Widget extends Thim_Widget {

		function __construct() {
			$product_categories = get_terms( 'product_cat', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
			$cate               = '';
			if ( is_array( $product_categories ) ) {
				foreach ( $product_categories as $cat ) {
					$cate[$cat->term_id] = $cat->name;
				}
			}
			parent::__construct(
				'tab',
				__( 'Thim: Tab', 'thim' ),
				array(
					'description' => __( 'Add tab', 'thim' ),
					'help'        => '',
					'panels_groups' => array('thim_widget_group')
				),
				array(),
				array(
					'tab'        => array(
						'type'      => 'repeater',
						'label'     => __( 'Tab', 'thim' ),
						'item_name' => __( 'Tab', 'thim' ),
						'fields'    => array(
							'title'          => array(
								"type"    => "text",
								"label"   => __( "Tab Title", "thim" ),
								"default" => "Tab Title",
							),
							'show'           => array(
								'type'    => 'select',
								'std'     => '',
								'label'   => __( 'Show', 'thim' ),
								'options' => array(
									'all'            => 'All Products',
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
								'type'    => 'select',
								'std'     => '',
								'label'   => __( 'Select Category', 'thim' ),
								'options' => $cate,
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
									'4' => __( '4', 'thim' ),
									'5' => __( '5', 'thim' )
								)
							),
							'number_product' => array(
								'type'  => 'text',
								'std'   => '5',
								'label' => __( 'Number Product', 'thim' )
							),
						),
					),
					'type_title' => array(
						"type"    => "select",
						"label"   => __( "Type Title", "thim" ),
						"options" => array(
							"boder"    => __( "Border", "thim" ),
							"no_boder" => __( "No border left", "thim" ),
						),
					)
				),
				TP_THEME_DIR . 'inc/widgets/tab/'
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
 	function thim_tab_widget_register() {
		register_widget( 'Thim_Tab_Widget' );
	}
 	add_action( 'widgets_init', 'thim_tab_widget_register' );
}
