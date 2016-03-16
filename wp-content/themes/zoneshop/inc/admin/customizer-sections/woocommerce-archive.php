<?php
$woocommerce->addSubSection( array(
	'name'     => 'Category Products',
	'id'       => 'woo_archive',
	'position' => 1,
) );
$woocommerce->createOption( array(
	'name'    => 'Archive Layout',
	'id'      => 'woo_cate_layout',
	'type'    => 'radio-image',
	'options' => array(
		'1col-fixed' => $url . 'body-full.png',
		'2c-l-fixed' => $url . 'sidebar-left.png',
		'2c-r-fixed' => $url . 'sidebar-right.png'
	),
	'default' => '2c-l-fixed'
) );


$woocommerce->createOption( array(
	'name'    => 'Hide Breadcrumbs?',
	'id'      => 'woo_cate_hide_breadcrumbs',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide Breadcrumbs",
	'default' => false,
) );



$woocommerce->createOption( array(
	'name'        => 'Background Breadcrumbs Color',
	'id'          => 'woo_cate_heading_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	'livepreview' => ''
) );


$woocommerce->createOption( array(
	'name'    => 'Text Color Breadcrumbs',
	'id'      => 'woo_cate_heading_text_color',
	'type'    => 'color-opacity',
	'default' => '#111',
) );


$woocommerce->createOption( array(
	'name'    => 'Height Breadcrumbs',
	'id'      => 'woo_cate_height_heading',
	'type'    => 'number',
	"desc"    => "Use a number without 'px', default is 100. ex: 100",
	'default' => '100',
	'max'     => '300',
	'min'     => '50',
) );