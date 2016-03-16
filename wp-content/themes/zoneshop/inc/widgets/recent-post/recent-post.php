<?php

class Thim_Recent_Post_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'recent-post',
			__( 'Thim: Display Post Slider', 'thim' ),
			array(
				'description' => __( 'Show Post', 'thim' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'title'          => array(
					'type'    => 'text',
					'label'   => __( 'Heading title', 'thim' ),
					'default' => __( "Heading title", "thim" )
				),
				'number_posts'   => array(
					'type'  => 'text',
					'label' => __( 'Number Post', 'thim' ),
				),
				'excerpt_words'  => array(
					'type'    => 'text',
					'label'   => __( 'Content Length Excerpt Words', 'thim' ),
					'default' => __( "15", "thim" )
				),
				'orderby'        => array(
					"type"    => "select",
					"label"   => __( "Order by", "thim" ),
					"options" => array(
						"popular" => __( "Popular", "thim" ),
						"recent"  => __( "Recent", "thim" ),
						"title"   => __( "Title", "thim" ),
						"random"  => __( "Random", "thim" ),
					),
				),
				'order'          => array(
					"type"    => "select",
					"label"   => __( "Order by", "thim" ),
					"options" => array(
						"asc"  => __( "ASC", "thim" ),
						"desc" => __( "DESC", "thim" )
					),
				),
				'hide_read_more' => array(
					'type'  => 'checkbox',
					'std'   => 1,
					'label' => __( 'Show Read More', 'thim' )
				),
			),
			TP_THEME_DIR . 'inc/widgets/recent-post/'
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

	function enqueue_admin_scripts() {
		wp_enqueue_script( 'js-admin-post-slider', TP_THEME_URI . 'inc/widgets/recent-post/js/admin-post-slider.js', array( 'jquery' ), '', true );
	}

	function enqueue_frontend_scripts() {
		wp_enqueue_script( 'js-post-slider', TP_THEME_URI . 'inc/widgets/recent-post/js/post-slider.js', array( 'jquery' ), '', true );
	}
}

function thim_recent_post_widget_register() {
	register_widget( 'Thim_Recent_Post_Widget' );
}

add_action( 'widgets_init', 'thim_recent_post_widget_register' );