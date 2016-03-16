<?php
if ( class_exists( 'WooCommerce' ) ) {
	class Thim_Wc_Product_Showcase_Widget extends Thim_Widget {
		function __construct() {
			parent::__construct(
				'wc-product-showcase',
				__( 'Thim Product Showcase', 'thim' ),
				array(
					'description' => __( 'Show product Showcase', 'thim' ),
					'help'        => '',
					'panels_groups' => array('thim_widget_group')
				),
				array(),
				array(
					'show'           => array(
						'type'    => 'select',
						'std'     => '',
						'label'   => __( 'Show', 'thim' ),
						'options' => array(
							''            => __( 'All Products', 'thim' ),
							'featured'    => __( 'Featured Products', 'thim' ),
							'onsale'      => __( 'On-sale Products', 'thim' ),
							"bestsellers" => __( "Best-Sellers Products", "cilo" )
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
					'number_product' => array(
						'type'  => 'text',
						'std'   => '5',
						'label' => __( 'Number Product', 'thim' )
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
				TP_THEME_DIR . 'inc/widgets/wc-product-showcase/'
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
			wp_enqueue_script( 'js-ob_accordion', TP_THEME_URI . 'inc/widgets/wc-product-showcase/js/ob_accordion.js', array( 'jquery' ), '', true );
		}
	}

	function thim_wc_product_showcase_widget_register() {
		register_widget( 'Thim_Wc_Product_Showcase_Widget' );
	}

	add_action( 'widgets_init', 'thim_wc_product_showcase_widget_register' );
}