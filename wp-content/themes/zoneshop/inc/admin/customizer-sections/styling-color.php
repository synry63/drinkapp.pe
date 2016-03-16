<?php
$styling->addSubSection( array(
	'name'     => 'Background Color & Text Color',
	'id'       => 'styling_color',
	'position' => 13,
) );


$styling->createOption( array(
	'name'        => 'Body Background Color',
	'id'          => 'body_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#F1F1F1',
	'livepreview' => '$("body").css("background-color", value);'
) );

$styling->createOption( array(
	'name'        => 'Theme Primary Color',
	'id'          => 'body_primary_color',
	'type'        => 'color-opacity',
	'default'     => '#313133',
	'livepreview' => '
		$(".bg-color-primary .sc-testimonials ul#testimonials li #testimonial-scrollbar a").css("background-color", value);
 	'

) );
$styling->createOption( array(
	'name'        => 'Theme Second Color',
	'id'          => 'body_second_color',
	'type'        => 'color-opacity',
	'default'     => '#82D5DB',
 ) );
$styling->createOption( array(
	'name'        => 'Text Second Color',
	'id'          => 'text_second_color',
	'type'        => 'color-opacity',
	'default'     => '#111',
) );

$styling->createOption( array(
	'name'        => 'Border Bottom Color',
	'id'          => 'border_bottom_color',
	'type'        => 'color-opacity',
	'default'     => '#313133',
) );

$styling->createOption( array(
	'name'    => __( 'border bottom size', 'thim' ),
	'id'      => 'border_bottom_size',
	'type'    => 'number',
	'max'     => '5',
	'min'     => '1',
	'default' => '3'
) );
