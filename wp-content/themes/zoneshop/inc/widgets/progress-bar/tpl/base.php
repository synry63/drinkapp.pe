<?php
$jugas_animation = '';
$jugas_animation .= thim_getCSSAnimation( $instance['css_animation'] );

$units            = $instance['units'];
$values           = $instance['value_progress_bar'];
$graph_lines      = explode( ",", $values );
$max_value        = 0.0;
$graph_lines_data = array();

foreach ( $graph_lines as $line ) {
	$new_line                     = array();
	$data                         = explode( "|", $line );
	$new_line['value']            = isset( $data[0] ) ? $data[0] : 0;
	$new_line['percentage_value'] = isset( $data[1] ) && preg_match( '/^\d{1,2}\%$/', $data[1] ) ? (float) str_replace( '%', '', $data[1] ) : false;
	if ( $new_line['percentage_value'] != false ) {
		$new_line['label'] = isset( $data[2] ) ? $data[2] : '';
	} else {
		$new_line['label'] = isset( $data[1] ) ? $data[1] : '';
	}
	if ( $new_line['percentage_value'] === false && $max_value < (float) $new_line['value'] ) {
		$max_value = $new_line['value'];
	}
	$graph_lines_data[] = $new_line;
}

echo '<div class="sc_progress_bar' . $jugas_animation . '">';
foreach ( $graph_lines_data as $line ) {
	if ( $line['percentage_value'] !== false ) {
		$percentage_value = $line['percentage_value'];
	} elseif ( $max_value > 100.00 ) {
		$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
	} else {
		$percentage_value = $line['value'];
	}
	$unit = ( $units != '' ) ? ' <span class="sc_label_units" style="width:' . ( ( $line['value'] ) - 10 ) . '%"><span class="icon-units"></span>' . $line['value'] . $units . '</span>' : '';
	echo '<div class="progress_bar">';
	echo '<div class="label">';
	echo '<h4 class="sc_label">' . $line['label'] . '</h4>';
	echo ent2ncr( $unit );
	echo '</div>';
	echo '<div class="sc_single_bar animated striped">';
	if ( $line['percentage_value'] !== false ) {
		$percentage_value = $line['percentage_value'];
	} elseif ( $max_value > 100.00 ) {
		$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
	} else {
		$percentage_value = $line['value'];
	}
	echo '<span class="sc_bar" data-percentage-value="' . ( $percentage_value ) . '" data-value="' . $line['value'] . '"></span>';
	echo '</div></div>';
}
echo '</div>';