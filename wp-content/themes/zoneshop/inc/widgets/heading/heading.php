<?php

class Thim_Heading_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'heading',
			__( 'Thim: Heading', 'thim' ),
			array(
				'description' => __( 'Show heading', 'thim' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'title'       => array(
					'type'    => 'text',
					'label'   => __( 'Heading title', 'thim' ),
					'default' => __( "Heading ", "thim" )
				),

				'title_color' => array(
					'type'    => 'color',
					'label'   => __( 'Heading color', 'thim' ),
					'default' => '#fff'
				),
				'background'  => array(
					'type'    => 'color',
					'label'   => __( 'Background color', 'thim' ),
					'default' => '#313133'
				),
				'type_title'  => array(
					"type"    => "select",
					"label"   => __( "Type Title", "thim" ),
					"options" => array(
						"boder"    => __( "Border", "thim" ),
						"no_boder" => __( "No border left", "thim" ),
					),
				)
			),
			TP_THEME_DIR . 'inc/widgets/heading/'
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

function thim_heading_register_widget() {
	register_widget( 'Thim_Heading_Widget' );
}

add_action( 'widgets_init', 'thim_heading_register_widget' );