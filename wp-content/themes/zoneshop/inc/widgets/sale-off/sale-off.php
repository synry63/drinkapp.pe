<?php

class Thim_Sale_Off_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'sale-off',
			__( 'Sale-Off', 'siteorigin-widgets' ),
			array(
				'description' => __( 'A simple call to action widget with massive power.', 'thim' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'title_group'          => array(
					'type'   => 'section',
					'label'  => __( 'Title Options', 'thim' ),
					'hide'   => true,
					'fields' => array(
						'title'        => array(
							'type'        => 'text',
							'label'       => __( 'Title', 'thim' ),
							"default"     => "This is an icon box.",
							"description" => __( "Provide the title for this icon box.", "thim" ),
						),
						'color_title'  => array(
							'type'  => 'color',
							'label' => __( 'Color Title', 'thim' ),
						),
						'size'         => array(
							"type"        => "select",
							"label"       => __( "Size Heading", "thim" ),
							"options"     => array(
								"h3" => __( "h3", "thim" ),
								"h2" => __( "h2", "thim" ),
								"h4" => __( "h4", "thim" ),
								"h5" => __( "h5", "thim" ),
								"h6" => __( "h6", "thim" )
							),
							"description" => __( "Select size heading.", "thim" )
						),

						'custom_mg_bt' => array(
							"type"   => "number",
							"label"  => __( "Margin Bottom Value", "thim" ),
							"value"  => 0,
							"suffix" => "px",
						),

					),
				),
				'desc_group'           => array(
					'type'   => 'section',
					'label'  => __( 'Description', 'thim' ),
					'hide'   => true,
					'fields' => array(
						'content'          => array(
							"type"        => "editor",
							"label"       => __( "Add description", "thim" ),
							"default"     => "Write a short description, that will describe the title or something informational and useful.",
							"description" => __( "Provide the description for this icon box.", "thim" )
						),
						'content_location' => array(
							"type"    => "select",
							"label"   => __( "Select location of content", "thim" ),
							"options" => array(
								"top"    => __( "Top", "thim" ),
								"center" => __( "Center", 'thim' )
							),
						),
						'show_border'      => array(
							'type'    => 'checkbox',
							'label'   => __( 'Border text', 'thim' ),
							'default' => true
						),
						'color_desc'       => array(
							'type'  => 'color',
							'label' => __( 'Color Desc', 'thim' ),
						),
						'desc_padding'     => array(
							"type"        => "text",
							"label"       => __( "padding desc content off box", "thim" ),
							"description" => __( "input value padding of desc box ex:30px", "thim" ),
						),
					),
				),
				'image_bg_group'       => array(
					'type'   => 'section',
					'label'  => __( 'Custom Image Box Sale Off', 'thim' ),
					'hide'   => true,
					'fields' => array(
						// Play with icon selector
						'bg_img'         => array(
							"type"        => "media",
							"label"       => __( "Upload Image background:", "thim" ),
							"description" => __( "Upload the custom image background icon.", "thim" ),
							"class_name"  => 'custom',
						),
						'img_margin_top' => array(
							"type"        => "text",
							"label"       => __( "img margin top", "thim" ),
							"description" => __( "input margin top of image ex:30px", "thim" ),
						),
					),
				),
				'sale_off_padding'     => array(
					"type"        => "text",
					"label"       => __( "padding sale off box", "thim" ),
					"description" => __( "input value padding of sale off box ex:30px", "thim" ),
				),
				'css_animation'        => array(
					"type"    => "select",
					"label"   => __( "CSS Animation", "thim" ),
					"options" => array(
						"zoom-in"     => __( "Zoom in image", "thim" ),
						"zoom-in-out" => __( "Zoom out and zoom in image", "thim" ),
						"none"        => __( "None", "thim" ),
					),
				),
				'box_background_color' => array(
					"type"        => "color",
					"label"       => __( "Background Color Box:", "thim" ),
					"default"     => "#fff",
					"description" => __( "Select background  color for Box sale", "thim" ),
					"class"       => "color-mini",
				),
				'read_more_group'      => array(
					'type'   => 'section',
					'label'  => __( 'Link Icon Box', 'thim' ),
					'hide'   => true,
					'fields' => array(
						// Add link to existing content or to another resource
						'link'                       => array(
							"type"        => "text",
							"label"       => __( "Add Link", "thim" ),
							"description" => __( "Provide the link that will be applied to this icon box.", "thim" )
						),

						'read_text'                  => array(
							"type"        => "text",
							"label"       => __( "Read More Text", "thim" ),
							"default"     => "Read More",
							"description" => __( "Customize the read more text.", "thim" ),
						),
						'read_more_text_color'       => array(
							"type"        => "color",
							"label"       => __( "Color Read More Text:", "thim" ),
							"default"     => "#fff",
							"description" => __( "Select whether to use text color for Read More Text or default.", "thim" ),
							"class"       => "color-mini",
						),
						'read_more_text_color_hover' => array(
							"type"        => "color",
							"label"       => __( "Color hover Read More Text:", "thim" ),
							"default"     => "#fff",
							"description" => __( "Select whether to use text color for Read More Text or default.", "thim" ),
							"class"       => "color-mini",
						),
						'read_text_margin_top'       => array(
							"type"        => "text",
							"label"       => __( "Read More Margin top", "thim" ),
							"default"     => "Read More",
							"description" => __( "Customize the read more margin top ex:30px.", "thim" ),
							"class"       => "color-mini"
						),
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/sale-off/'
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

function thim_sale_off_widget_register() {
	register_widget( 'Thim_Sale_Off_Widget' );
}

add_action( 'widgets_init', 'thim_sale_off_widget_register' );
