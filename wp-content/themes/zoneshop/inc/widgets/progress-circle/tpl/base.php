<?php
$jugas_animation = $value =  $style='';
$units           = '$';
$size            = '150';
$color           = 'data-color="008d71"';
$style ='style="';


$jugas_animation .= thim_getCSSAnimation( $instance['css_animation'] );

if ( $instance['value_progress_circle'] <> '' ) {
	$value = $instance['value_progress_circle'];
}

if ( $instance['units'] <> '' ) {
	$units = $instance['units'];
}

if ( $instance['color'] <> '' ) {
	$color = 'data-color="' . $instance['color'] . '"';
	$value_color = $instance['color'];
}

$style .='border:3px solid #DCDCDC;';

if ( $instance['size'] <> '' ) {
	$size = $instance['size'];
	$style .='width: '.($instance['size']) .'px; height: '.($instance['size']).'px "';
}

if ( $instance['label_progress_circle'] <> '' ) {
	$label_progress_circle = '<div class="progress-label"><h3>' . $instance['label_progress_circle'] . '</h3></div>';
}

echo '<div class="progress-circle">
		<div class="progress-single-circle" data-progress-value="' . $value . '" data-units="' . $units . '" data-size="' . $size . '" ' . $color . $style.' ><strong style="color:'.$value_color.'">' . $value . '<i> ' . $units . '</i></strong>
 		</div>
		' . $label_progress_circle . '
	</div>';