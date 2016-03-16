<?php
class Thim_Icon_Box_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'icon-box',
			__( 'Thim: Icon Box', 'thim' ),
			array(
				'description'   => __( 'Add icon box', 'thim' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'title_group'        => array(
					'type'   => 'section',
					'label'  => __( 'Title Options', 'thim' ),
					'hide'   => true,
					'fields' => array(
						'title'              => array(
							'type'        => 'text',
							'label'       => __( 'Title', 'thim' ),
							"default"     => "This is an icon box.",
							"description" => __( "Provide the title for this icon box.", "thim" ),
						),
						'color_title'        => array(
							'type'  => 'color',
							'label' => __( 'Color Title', 'thim' ),
						),
						'size'               => array(
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
						'font_heading'       => array(
							"type"          => "select",
							"label"         => __( "Font Heading", "thim" ),
							"options"       => array(
								"default" => __( "Default", "thim" ),
								"custom"  => __( "Custom", "thim" )
							),
							"description"   => __( "Select Font heading.", "thim" ),
							'state_emitter' => array(
								'callback' => 'select',
								'args'     => array( 'font_heading_cutom' )
							)
						),
						'custom_font_size'   => array(
							"type"          => "number",
							"label"         => __( "Font Size", "thim" ),
							"suffix"        => "px",
							"default"       => "14",
							"description"   => __( "custom font size", "thim" ),
							'state_handler' => array(
								'font_heading_cutom[custom]'  => array( 'show' ),
								'font_heading_cutom[default]' => array( 'hide' ),
							)
						),
						'custom_font_weight' => array(
							"type"          => "select",
							"label"         => __( "Custom Font Weight", "thim" ),
							"options"       => array(
								"normal" => __( "Normal", "thim" ),
								"bold"   => __( "Bold", "thim" ),
								"100"    => __( "100", "thim" ),
								"200"    => __( "200", "thim" ),
								"300"    => __( "300", "thim" ),
								"400"    => __( "400", "thim" ),
								"500"    => __( "500", "thim" ),
								"600"    => __( "600", "thim" ),
								"700"    => __( "700", "thim" ),
								"800"    => __( "800", "thim" ),
								"900"    => __( "900", "thim" )
							),
							"description"   => __( "Select Custom Font Weight", "thim" ),
							'state_handler' => array(
								'font_heading_cutom[custom]'  => array( 'show' ),
								'font_heading_cutom[default]' => array( 'hide' ),
							)
						),
						'custom_mg_bt'       => array(
							"type"          => "number",
							"label"         => __( "Margin Bottom Value", "thim" ),
							"value"         => 0,
							"suffix"        => "px",
							'state_handler' => array(
								'font_heading_cutom[custom]'  => array( 'show' ),
								'font_heading_cutom[default]' => array( 'hide' ),
							)
						),
//						'padding_top'        => array(
//							"type"   => "number",
//							"label"  => __( "Padding Top Value", "thim" ),
//							"value"  => 0,
//							"suffix" => "%",
//						),

					),
				),
				'desc_group'         => array(
					'type'   => 'section',
					'label'  => __( 'Description', 'thim' ),
					'hide'   => true,
					'fields' => array(
						'content'    => array(
							"type"        => "editor",
							"label"       => __( "Add description", "thim" ),
							"default"     => "Write a short description, that will describe the title or something informational and useful.",
							"description" => __( "Provide the description for this icon box.", "thim" )
						),

						'color_desc' => array(
							'type'  => 'color',
							'label' => __( 'Color Desc', 'thim' ),
						),
					),
				),

				// Play with icon selector
//				'icon_type'          => array(
//					"type"        => "select",
//					"class"       => "",
//					"label"       => __( "Icon to display:", "thim" ),
//					"options"     => array(
//						"font-awesome" => "Font Awesome Icon",
//					),
//					"description" => __( "Select which icon you would like to use", "thim" )
//				),
				'font_awesome_group' => array(
					'type'   => 'section',
					'label'  => __( 'Font Awesome Icon', 'thim' ),
					'hide'   => true,
					'fields' => array(
						'icon'      => array(
							"type"        => "icon",
							"class"       => "",
							"label"       => __( "Select Icon:", "thim" ),
							"description" => __( "Select the icon from the list.", "thim" ),
							"class_name"  => 'font-awesome',
						),
						// Resize the icon
						'icon_size' => array(
							"type"        => "number",
							"class"       => "",
							"label"       => __( "Icon Font Size ", "thim" ),
							"suffix"      => "px",
							"default"     => "14",
							"description" => __( "Select the icon font size.", "thim" ),
							"class_name"  => 'font-awesome'
						),
					),
				),

				// // Resize the icon
				'width_icon_box'     => array(
					"type"    => "number",
					"class"   => "",
					"default" => "40",
					"label"   => __( "Width Box Icon", "thim" ),
					"suffix"  => "px",
				),

				'color_group'        => array(
					'type'   => 'section',
					'label'  => __( 'Color Options', 'thim' ),
					'hide'   => true,
					'fields' => array(
						// Customize Icon Color
						'icon_color'          => array(
							"type"        => "color",
							"class"       => "color-mini",
							"label"       => __( "Select Icon Color:", "thim" ),
							"description" => __( "Select the icon color.", "thim" ),
							"class"       => "color-mini",
						),
						// Give some background to icon
						'icon_bg_color'       => array(
							"type"        => "color",
							"label"       => __( "Icon Background Color:", "thim" ),
							"description" => __( "Select the color for icon background.", "thim" ),
							"class"       => "color-mini",

						),
						'bg_color'            => array(
							"type"        => "color",
							"class"       => "color-mini",
							"label"       => __( "Select Background Color Widget:", "thim" ),
							"description" => __( "Select the Background color for widget.", "thim" ),
						),
						'icon_hover_color'    => array(
							"type"        => "color",
							"label"       => __( "Hover Icon Color:", "thim" ),
							"description" => __( "Select the color hover for icon.", "thim" ),
							"class"       => "color-mini",
						),
						// Give some background to icon
						'icon_bg_color_hover' => array(
							"type"        => "color",
							"label"       => __( "Hover Icon Background Color:", "thim" ),
							"description" => __( "Select the color hover for icon background header.", "thim" ),
							"class"       => "color-mini",
						),
						'icon_border_color'   => array(
							"type"        => "color",
							"label"       => __( "Border Color:", "thim" ),
							"description" => __( "Select the color for border", "thim" ),
							"class"       => "color-mini",
						),
					)
				),
				'layout_group'       => array(
					'type'   => 'section',
					'label'  => __( 'Layout Options', 'thim' ),
					'hide'   => true,
					'fields' => array(
 						'box_icon_style' => array(
							"type"    => "select",
							"class"   => "",
							"label"   => __( "Icon Shape", "thim" ),
							"options" => array(
								""       => __( "None", "thim" ),
								"circle" => __( "Circle", "thim" ),
							),
							"std"     => "",
						),
						'pos'            => array(
							"type"        => "select",
							"class"       => "",
							"label"       => __( "Box Style:", "thim" ),
							"default"     => "top",
							"options"     => array(
								"left"   => "Icon at Left",
								"right"  => "Icon at Right",
								"top"    => "Icon at Top",
								"center" => "Icon at Top Center"
							),
							"description" => __( "Select icon position. Icon box style will be changed according to the icon position.", "thim" ),
						),
						'text_align_sc'  => array(
							"type"    => "select",
							"class"   => "",
							"label"   => __( "Text Align :", "thim" ),
							"options" => array(
								"text-left"   => "Text Left",
								"text-right"  => "Text Right",
								"text-center" => "Text Center"
							)
						),

						'padding_widget' => array(
							"type"        => "text",
							"class"       => "",
							"default"     => "",
							"label"       => __( "Padding Box Icon", "thim" ),
							'description' => __( 'input padding of widget (top right bottom left) ex: 25px 50px 25px 50px', 'thim' ),
						),
					),
				),

			),
			TP_THEME_DIR . 'inc/widgets/icon-box/'
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

function thim_icon_box_widget() {
	register_widget( 'Thim_Icon_Box_Widget' );
}

add_action( 'widgets_init', 'thim_icon_box_widget' );