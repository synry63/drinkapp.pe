<?php
/*
 * Post and Page Display Settings
 */
$display->addSubSection( array(
	'name'     => 'Archive',
	'id'       => 'display_archive',
	'position' => 2,
) );
$display->createOption( array(
	'name'    => 'Archive Layout',
	'id'      => 'archive_layout',
	'type'    => 'radio-image',
	'options' => array(
		'1col-fixed' => $url . 'body-full.png',
		'2c-l-fixed' => $url . 'sidebar-left.png',
		'2c-r-fixed' => $url . 'sidebar-right.png'
	),
	'default' => '2c-l-fixed'
) );

$display->createOption( array(
	'name'        => 'Background Breadcrumbs',
	'id'          => 'archive_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	'livepreview' => ''
) );

$display->createOption( array(
	'name'        => 'Text Color Breadcrumbs',
	'id'          => 'archive_text_color',
	'type'        => 'color-opacity',
	'default'     => '#111',
	'livepreview' => ''
) );

$display->createOption( array(
	'name'    => 'Height Breadcrumbs',
	'id'      => 'archive_height_heading',
	'type'    => 'number',
	"desc"    => "Use a number without 'px', default is 100. ex: 100",
	'default' => '100',
	'max'     => '300',
	'min'     => '50',
) );

$display->createOption( array(
	'name'    => 'Excerpt Length',
	'id'      => 'archive_excerpt_length',
	'type'    => 'number',
	"desc"    => "Enter the number of words you want to cut from the content to be the excerpt of search and archive and portfolio page.",
	'default' => '20',
	'max'     => '100',
	'min'     => '10',
) );

$display->createOption( array(
	'name'    => 'Show Date',
	'id'      => 'show_date',
	'type'    => 'checkbox',
	"desc"    => "show/hidden",
	'default' => true,
) );

$display->createOption( array(
	'name'    => 'Show Author',
	'id'      => 'show_author',
	'type'    => 'checkbox',
	"desc"    => "show/hidden",
	'default' => true,
) );

$link = 'http://codex.wordpress.org/Formatting_Date_and_Time';
$display->createOption( array(
	'name'    => 'Date Format',
	'id'      => 'date_format',
	'type'    => 'text',
	"desc"    => __( '<a href="' . $link . '">Formatting Date and Time</a>', 'thim' ),
	'default' => 'j M Y'
) );