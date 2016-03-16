<?php
/*
 * Creating a logo Options
 */
$logo = $titan->createThemeCustomizerSection( array(
	'name'     => __( 'Logo', 'thim' ),
	'position' => 1,
) );

$logo->createOption( array(
	'name'    => __( 'Header Logo', 'thim' ),
	'id'      => 'logo',
	'type'    => 'upload',
	'desc'    => __( 'Upload your logo', 'thim' ),
	'default' => get_template_directory_uri( 'template_directory' ) . "/images/logo.png",
) );

$logo->createOption( array(
	'name' => __( 'Sticky Logo', 'thim' ),
	'id'   => 'sticky_logo',
	'type' => 'upload',
	'desc' => __( 'Upload your sticky logo', 'thim' ),
) );

$logo->createOption( array(
	'name'    => __( 'Width Logo', 'thim' ),
	'id'      => 'width_logo',
	'type'    => 'number',
	'default' => '25',
	'max'     => '100',
	'min'     => '0',
	'step'    => '8.33333333333',
	'desc'    => 'width logo (%)'
) );

$logo->createOption( array(
	'name' => __( 'Favicon', 'thim' ),
	'id'   => 'favicon',
	'type' => 'upload',
	'desc' => __( 'Upload your favicon', 'thim' ),
) );
?>