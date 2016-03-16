<?php
/*
 * Front page displays settings: Posts page
 */
$display->addSubSection( array(
	'name'     => 'Frontpage',
	'id'       => 'display_frontpage',
	'position' => 1,
) );

$display->createOption( array(
	'name'    => 'Select Layout Default',
	'id'      => 'front_page_layout',
	'type'    => 'radio-image',
	'options' => array(
		'1col-fixed' => $url . 'body-full.png',
		'2c-l-fixed' => $url . 'sidebar-left.png',
		'2c-r-fixed' => $url . 'sidebar-right.png',
	),
	'default' => '2c-l-fixed',
) );

$display->createOption( array(
	'name'    => 'Custom Title',
	'id'      => 'front_page_custom_title',
	'type'    => 'text',
	'default' => '',
) );

$display->createOption( array(
	'name'        => 'Background Breadcrumbs',
	'id'          => 'front_page_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	'livepreview' => '',
) );
$display->createOption( array(
	'name'        => 'Text Color Breadcrumbs',
	'id'          => 'front_page_text_color',
	'type'        => 'color-opacity',
	'default'     => '#111',
	'livepreview' => '',
) );
$display->createOption( array(
	'name'    => 'Height Breadcrumbs',
	'id'      => 'front_page_height_heading',
	'type'    => 'number',
	"desc"    => "Use a number without 'px', default is 100. ex: 100",
	'default' => '100',
	'max'     => '300',
	'min'     => '50',
) );