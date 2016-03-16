<?php
class Thim_Progress_Circle_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'progress-circle',
			__( 'Thim: Progress Circle', 'thim' ),
			array(
				'description' => __( 'Progress Circle', 'thim' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'value_progress_circle' => array(
					'type' => 'number',
					'label' => __('Value', 'thim'),
					'description'=>__('Input graph value here. Choose range between 0 and 100.','thim')
				),
				'label_progress_circle' => array(
					'type' => 'text',
					'label' => __('Label', 'thim'),
					'description'=>__('Input integer value for label. If empty "Pie value" will be used.','thim')
				),
				'units' => array(
					'type' => 'text',
					'label' => __('Units', 'thim'),
 					'description'=>'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.'
				),
				'size' => array(
					'type' => 'number',
					'default'=>'150',
					'label' => __('Width Widget', 'thim'),
					'description'=>__('default (150)','thim')
				),
				'color' => array(
					'type' => 'color',
					'label' => __('Color', 'thim'),
 				),

				'css_animation' => array(
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
			TP_THEME_DIR . 'inc/widgets/progress-circle/'
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

	function enqueue_frontend_scripts(){
		wp_enqueue_script( 'thim-waypoints', TP_THEME_URI . 'js/waypoints.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script('thim-pro-Circles', TP_THEME_URI .'inc/widgets/progress-circle/js/circle-bars.js', array( 'jquery' ), '', true  );
	}

}

function thim_progress_circle_widget_register() {
	register_widget( 'Thim_Progress_Circle_Widget' );
}

add_action( 'widgets_init', 'thim_progress_circle_widget_register' );