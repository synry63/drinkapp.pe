<?php
/**
 * widget empty space
 **/
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	class Thim_Shop_By_Cat_Widget extends Thim_Widget {

		function __construct() {

			parent::__construct(
				'shop-by-cat',
				__( 'Thim: Shop by category', 'thim' ),
				array(
					'description' => __( 'Empty space.', 'thim' ),
					'help'        => '',
					'panels_groups' => array('thim_widget_group')
				),
				array(),

				array(
					'heading'            => array(
						'type'  => 'text',
						'label' => 'Input Heading',
					),
					'heading_text_color' => array(
						'type'  => 'color',
						'label' => 'color text heading',
					),
					'heading_bg_color'   => array(
						'type'  => 'color',
						'label' => 'Background color heading',
					),
					'heading_font_size'  => array(
						'type'  => 'number',
						'label' => 'Font size Heading text',
					),
					'num_post'           => array(
						'type'    => 'number',
						'label'   => __( 'Number category', 'thim' ),
						'default' => 4,
					),
					'num_column'         => array(
						'type'    => 'select',
						'label'   => __( 'number column', 'thim' ),
						'options' => array(
							'1' => __( '1', 'thim' ),
							'2' => __( '2', 'thim' ),
							'3' => __( '3', 'thim' ),
							'4' => __( '4', 'thim' ),
						),
						'default' => __( '4', 'thim' ),
					),
					'show_read_more'     => array(
						'type'  => 'checkbox',
						'label' => 'Show button read more',
					),
					'read_more_color'    => array(
						'type'  => 'color',
						'label' => __( 'Color button read more', 'thim' ),
					),
					'type_title'         => array(
						"type"    => "select",
						"label"   => __( "Type Title", "thim" ),
						"options" => array(
							"boder"    => __( "Border", "thim" ),
							"no_boder" => __( "No border left", "thim" ),
						),
					)
				),
				TP_THEME_DIR . 'inc/widgets/shop-by-cat/'
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

	function thim_shop_by_cat_widget_register() {
		register_widget( 'Thim_Shop_By_Cat_Widget' );
	}

	add_action( 'widgets_init', 'thim_shop_by_cat_widget_register' );
}