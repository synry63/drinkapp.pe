<?php

/**
 * Widget testimonials
 * user: longpq
 */
class Thim_Testimonials_Widget extends Thim_Widget {

	function __construct() {
		$link_img = TP_THEME_URI . 'images/admin/widgets/testimonials/';
		parent::__construct(
			'testimonials',
			__( 'Thim: Testimonials', 'thim' ),
			array(
				'description' => __( 'Show testimonials', 'thim' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),

			// options
			array(
				// number posts view
				't_num_posts'   => array(
					'type'    => 'number',
					'label'   => __( 'Number posts view', 'thim' ),
					'integer' => true,
					'min'     => 1,
					'default' => 3,
				),

				// order by
				't_order_by'    => array(
					'type'    => 'select',
					'label'   => __( 'Order by', 'thim' ),
					'options' => array(
						'rand'    => __( 'random', 'thim' ),
						'comment' => __( 'comment', 'thim' ),
						'date'    => __( 'date', 'thim' ),
						'title'   => __( 'title', 'thim' ),
					),
					'default' => 'title',
				),

				// order
				't_order'       => array(
					'type'    => 'select',
					'label'   => __( 'Order', 'thim' ),
					'options' => array(
						'asc'  => __( 'ASC', 'thim' ),
						'desc' => __( 'DESC', 'thim' ),
					),
					'default' => 'asc',
				),

				// config
				't_config'      => array(
					'type'   => 'section',
					'label'  => __( 'Config', 'thim' ),
					'fields' => array(
						// text color
						't_text_color' => array(
							'type'    => 'color',
							'label'   => __( 'Content color', 'thim' ),
							'default' => '#111',
							"class"       => "color-mini"
						),
						'author_color' => array(
							'type'    => 'color',
							'label'   => __( 'Author color', 'thim' ),
							'default' => '#111',
							"class"       => "color-mini"
						),

						'link_color'   => array(
							'type'    => 'color',
							'label'   => __( 'Link color', 'thim' ),
							'default' => '#111',
							"class"       => "color-mini"
						),
					),
				),
				// animation
				'css_animation' => array(
					'type'    => 'select',
					'label'   => __( 'Css animation', 'thim' ),
					'options' => array(
						'none'          => __( 'No', 'thim' ),
						'left-to-right' => __( 'Left to right', 'thim' ),
						'right-to-left' => __( 'Right to left', 'thim' ),
						'top-to-bottom' => __( 'Top to bottom', 'thim' ),
						'bottom-to-top' => __( 'Bottom to top', 'thim' ),
						'appear'        => __( 'Appear form center', 'thim' ),
					),
				),

				// extract class
				'else_class'    => array(
					'type'        => 'text',
					'label'       => __( 'Extract class name', 'thim' ),
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'thim' )
				),

			), // end options

			TP_THEME_DIR . 'inc/widgets/testimonials/'
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
		wp_enqueue_script( 'thim-testimonial', TP_THEME_URI . 'inc/widgets/testimonials/js/thim.testimonials.js', array( 'jquery' ), '', true );
	}
}

function thim_testimonials_widget_register() {
	register_widget( 'Thim_Testimonials_Widget' );
}

add_action( 'widgets_init', 'thim_testimonials_widget_register' );