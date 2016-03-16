<?php

class Thim_Social_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'social',
			__( 'Thim: Social Links', 'thim' ),
			array(
				'description' => __( 'Social Links', 'thim' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'title'           => array(
					'type'  => 'text',
					'label' => __( 'Title', 'thim' )
				),
				'link_face'       => array(
					'type'  => 'text',
					'label' => __( 'Facebook Url', 'thim' )
				),
				'link_twitter'    => array(
					'type'  => 'text',
					'label' => __( 'Twitter Url', 'thim' )
				),
				'link_google'     => array(
					'type'  => 'text',
					'label' => __( 'Google Url', 'thim' )
				),
				'link_instagram'  => array(
					'type'  => 'text',
					'label' => __( 'Instagram Url', 'thim' )
				),
				'link_pinterest'  => array(
					'type'  => 'text',
					'label' => __( 'Pinterest Url', 'thim' )
				),
				'link_youtube'    => array(
					'type'  => 'text',
					'label' => __( 'Youtube Url', 'thim' )
				),
				'icon_style'      => array(
					'type'    => 'select',
					'label'   => __( 'Select Icon Style', 'thim' ),
					'options' => array(
						'icon-style-default' => 'Default',
						'icon-style-square'  => 'Square',
						'icon-style-circle'  => 'Circle'
					)
				),
				'icon_size'       => array(
					'type'    => 'select',
					'label'   => __( 'Select Icon Style', 'thim' ),
					'options' => array(
						'icon-size-24px' => 'Small',
						'icon-size-32px' => 'medium',
						'icon-size-48px' => 'Large'
					)
				),
				'bg_social_color' => array(
					"type"    => "color",
					"label"   => __( "Background Color :", "thim" ),
					"default" => "#fff",
					"class"   => "color-mini",
				),
			),
			TP_THEME_DIR . 'inc/widgets/social/'
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

function thim_social_widget_register() {
	register_widget( 'Thim_Social_Widget' );
}

add_action( 'widgets_init', 'thim_social_widget_register' );