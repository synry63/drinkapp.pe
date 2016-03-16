<?php

$header->addSubSection( array(
	'name'     => __( 'Header Layout', 'thim' ),
	'id'       => 'display_header_layout',
	'position' => 10,
) );

$header->createOption( array(
	'name'    => __( 'Header Width', 'thim' ),
	'id'      => 'header_layout',
	'type'    => 'select',
	'options' => array(
		'boxed' => __( 'Boxed', 'thim' ),
		'wide'  => __( 'Wide', 'thim' ),
	),
	'default' => 'boxed',
) );
$header->createOption( array(
	'name'    => __( 'Margin Bottom', 'thim' ),
	'id'      => 'margin_header_bottom',
	'type'    => 'number',
	'max'     => '50',
	'min'     => '-50',
	'default' => '-25'
) );

$header->createOption( array(
	'name'    => 'Header Background color',
	'desc'    => 'Pick a background color for header',
	'id'      => 'bg_header_color',
	'default' => '#ffffff',
	'type'    => 'color-opacity'
) );

$header->createOption( array(
	'name'    => 'Header Text color',
	'desc'    => 'Pick a text color for header',
	'id'      => 'header_text_color',
	'default' => '#868686',
	'type'    => 'color-opacity'
) );
$header->createOption( array(
	'name'    => 'Color Border Header',
	'id'      => 'bg_border_header_color',
	'default' => '',
	'type'    => 'color-opacity'
) );
