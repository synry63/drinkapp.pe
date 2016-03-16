<?php
$woocommerce->addSubSection( array(
	'name'     => 'Product Page',
	'id'       => 'woo_single',
	'position' => 2,
) );

$woocommerce->createOption( array(
	'name'    => 'Select Layout Default',
	'id'      => 'woo_single_layout',
	'type'    => 'radio-image',
	'options' => array(
		'1col-fixed' => $url . 'body-full.png',
		'2c-l-fixed' => $url . 'sidebar-left.png',
		'2c-r-fixed' => $url . 'sidebar-right.png'
	),
	'default' => '2c-l-fixed',
) );

$woocommerce->createOption( array(
	'name'    => 'Hide Breadcrumbs?',
	'id'      => 'woo_single_hide_breadcrumbs',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide Breadcrumbs",
	'default' => false,
) );

$woocommerce->createOption( array(
	'name'        => 'Background Breadcrumbs Color',
	'id'          => 'woo_single_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	'livepreview' => '',
) );

$woocommerce->createOption( array(
	'name'        => 'Text Color Breadcrumbs',
	'id'          => 'woo_single_text_color',
	'type'        => 'color-opacity',
	'default'     => '#111',
	'livepreview' => '',
) );

$woocommerce->createOption( array(
	'name'    => 'Height Breadcrumbs',
	'id'      => 'woo_single_height_heading',
	'type'    => 'number',
	"desc"    => "Use a number without 'px', default is 100. ex: 100",
	'default' => '100',
	'max'     => '300',
	'min'     => '50',
) );