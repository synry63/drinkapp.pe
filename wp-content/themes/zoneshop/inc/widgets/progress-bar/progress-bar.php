<?php

class Thim_Progress_Bar_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'progress-bar',
			__( 'Thim: Progress Bar', 'thim' ),
			array(
				'description' => __( 'Progress Bar', 'thim' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'value_progress_bar' => array(
					'type'        => 'textarea',
					'label'       => __( 'Value', 'thim' ),
					'default'     => __( '90|Development,70|Design', 'thim' ),
					'description' => __( 'Input graph values, titles here. Divide values with linebreaks (Enter). Example: 90|Development,70|Design', 'thim' )
				),
				'units'              => array(
					'type'        => 'text',
					'label'       => __( 'Units', 'thim' ),
					'description' => 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.'
				),
				'css_animation'      => array(
					"type"    => "select",
					"label"   => __( "CSS Animation", "thim" ),
					"options" => array(
						""              => __( "No", "thim" ),
						"top-to-bottom" => __( "Top to bottom", "thim" ),
						"bottom-to-top" => __( "Bottom to top", "thim" ),
						"left-to-right" => __( "Left to right", "thim" ),
						"right-to-left" => __( "Right to left", "thim" ),
						"appear"        => __( "Appear from center", "thim" )
					),
				)
			),
			TP_THEME_DIR . 'inc/widgets/progress-bar/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return 'basic';
	}

	function enqueue_frontend_scripts() {
		wp_enqueue_script( 'thim-waypoints', TP_THEME_URI . 'js/waypoints.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'thim-pro-bars', TP_THEME_URI . 'inc/widgets/progress-bar/js/pro-bars.js', array( 'jquery' ), '', true );
	}

}

function thim_progress_bar_widget_register() {
	register_widget( 'Thim_Progress_Bar_Widget' );
}

add_action( 'widgets_init', 'thim_progress_bar_widget_register' );