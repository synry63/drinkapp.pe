<?php
if ( class_exists( 'WooCommerce' ) ) {
	class Thim_Wc_Sub_Category_Widget extends Thim_Widget {
		function __construct() {
			$product_categories = get_terms( 'product_cat', array( 'hide_empty' => 0, 'orderby' => 'ASC', 'parent' => 0 ) );
			$cate               = '';
			if ( is_array( $product_categories ) ) {
				foreach ( $product_categories as $cat ) {
					$cate[$cat->term_id] = $cat->name;
				}
			}
			parent::__construct(
				'wc-sub-category',
				__( 'Thim: Sub Category product', 'Thim' ),
				array(
					'description' => __( 'show sub category', 'Thim' ),
					'help'        => '',
					'panels_groups' => array('thim_widget_group')
				),
				array(),
				array(
					'cats' => array(
						'type'        => 'select',
						'std'         => '',
						'label'       => __( 'Select Category', 'thim' ),
						"description" => __( "show category lever 1", "Thim" ),
						'options'     => $cate
					),
				),
				TP_THEME_DIR . 'inc/widgets/wc-sub-category/'
			);
		}

		function get_template_name( $instance ) {
			return 'base';
		}

		function get_style_name( $instance ) {
			return false;
		}
	}

	function thim_wc_sub_category_widget_register() {
		register_widget( 'Thim_Wc_Sub_Category_Widget' );
	}

	add_action( 'widgets_init', 'thim_wc_sub_category_widget_register' );
}