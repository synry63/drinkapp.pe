<?php
$css_bg      = '';
$title       = $instance['title'] ? $instance['title'] : 'heading';
$title_color = $instance['title_color'] ? $instance['title_color'] : '#ffffff';
$bg          = $instance['background'] ? $instance['background'] : '#313133';
if ( $bg ) {
	$css_bg = 'background:' . $bg . '; color:' . $title_color . ';';
}
if ( $instance['type_title'] == 'no_boder' ) {
	$class_border = 'no_boder_title';
} else {
	$class_border = '';
}
echo '
	<div class="box ' . $class_border . '">
        <div class="box-heading ">
			<span style="' . $css_bg . '">' . $title . '</span>
		</div>
	</div>
    ';
