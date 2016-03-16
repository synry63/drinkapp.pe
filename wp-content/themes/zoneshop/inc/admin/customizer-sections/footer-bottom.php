<?php
$footer->addSubSection( array(
	'name'     => __( 'Footer Bottom', 'thim' ),
	'id'       => 'display_footer_bottom',
	'position' => 11,
) );
$footer->createOption( array(
	'name'    => 'Background Bottom Footer Color',
	'id'      => 'footer_bottom_bg_color',
	'type'    => 'color-opacity',
	'default' => '#313133',
 ) );
$footer->createOption( array(
	'name'    => 'Text Color Bottom Footer Color',
	'id'      => 'footer_bottom_text_color',
	'type'    => 'color-opacity',
	'default' => '#fff',
 ) );