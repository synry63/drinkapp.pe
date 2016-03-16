<?php

// header Options
$header->addSubSection( array(
	'name'     => __( 'Sticky Menu', 'thim' ),
	'id'       => 'display_header_menu',
	'position' => 14,
) );

$header->createOption( array(
	'name' => __( 'Sticky Menu on scroll', 'thim' ),
	'desc' => __( 'Check to enable a fixed header when scrolling, uncheck to disable.', 'thim' ),
	'id'   => 'header_sticky',
	'type' => 'checkbox'
) );

$header->createOption( array(
	'name'    => __( 'When sticky header appear?', 'thim' ),
	'id'      => 'config_height_sticky',
	'options' => array( 'height_sticky_auto'   => __( 'Auto caculate', 'thim' ),
						'height_sticky_custom' => __( 'Custom', 'thim' )
	),
	'type'    => 'select',
	'default' => 'height_sticky_auto'
) );

$header->createOption( array(
	'name'    => 'Sticky Header height',
	'desc'    => 'Controls the space between each menu item in the sticky header.',
	'id'      => 'header_height_sticky',
	'default' => '153',
	'min'     => '30',
	'step'    => '1',
	'max'     => '650',
	'type'    => 'number'
) );

$header->createOption( array(
	'name'    => 'Config Sticky Menu?',
	'desc'    => '',
	'id'      => 'config_att_sticky',
	'options' => array( 'sticky_same'   => 'The same with main menu',
						'sticky_custom' => 'Custom'
	),
	'type'    => 'select'
) );

$header->createOption( array(
	'name'    => 'Sticky Background color',
	'desc'    => 'Pick a background color for main menu',
	'id'      => 'sticky_bg_main_menu_color',
	'default' => '#0e2a36',
	'type'    => 'color-opacity'
) );

$header->createOption( array(
	'name'    => 'Text color',
	'desc'    => 'Pick a text color for main menu',
	'id'      => 'sticky_main_menu_text_color',
	'default' => '#999',
	'type'    => 'color-opacity'
) );

$header->createOption( array(
	'name'    => 'Text Hover color',
	'desc'    => 'Pick a text hover color for main menu',
	'id'      => 'sticky_main_menu_text_hover_color',
	'default' => '#01b888',
	'type'    => 'color-opacity'
) );

/* sub menu */
$header->createOption( array(
	'name'    => 'Background Color Submenu',
	'desc'    => 'Pick a color.',
	'id'      => 'sticky_sub_menu_bg_color',
	'default' => '#0e2a36',
	'type'    => 'color-opacity'
) );
