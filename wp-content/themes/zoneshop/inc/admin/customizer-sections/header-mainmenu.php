<?php

// main menu

$header->addSubSection( array(
	'name'     => __( 'Main Menu', 'thim' ),
	'id'       => 'display_main_menu',
	'position' => 15,
) );


$header->createOption( array(
	"name"    => __( "Background color", "thim" ),
	"desc"    => "Pick a background color for main menu",
	"id"      => "bg_main_menu_color",
	"default" => "#313133",
	"type"    => "color-opacity"
) );


$header->createOption( array(
	"name"    => __( "Text color", "thim" ),
	"desc"    => __( "Pick a text color for main menu", "thim" ),
	"id"      => "main_menu_text_color",
	"default" => "#fff",
	"type"    => "color-opacity"
) );
$header->createOption( array(
	"name"    => __( "Border Top Color", "thim" ),
	"desc"    => __( "Pick a border top color for main menu", "thim" ),
	"id"      => "main_menu_border_top_color",
	"default" => "#82D5DB",
	"type"    => "color-opacity"
) );
$header->createOption( array(
	"name"    => __( "Text Hover color", "thim" ),
	"desc"    => __( "Pick a text hover color for main menu", "thim" ),
	"id"      => "main_menu_text_hover_color",
	"default" => "#fff",
	"type"    => "color-opacity"
) );


$header->createOption( array(
	"name"    => __( "Font Size", "thim" ),
	"desc"    => "Default is 13",
	"id"      => "font_size_main_menu",
	"default" => "13px",
	"type"    => "select",
	"options" => $font_sizes
) );
//
//$typography->createOption( array(
//	"name"    => __( "Custom Font()", "thim" ),
//	"id"      => "font_futura",
//	"type"    => "select",
//	"options" =>array(
//		''=>__('Us'),
//	)
//) );