<?php
$title                    = $instance['title_group']['title'] ? $instance['title_group']['title'] : '';
$title_color              = $instance['title_group']['color_title'] ? $instance['title_group']['color_title'] : '';
$title_size               = $instance['title_group']['size'] ? $instance['title_group']['size'] : '';
$title_margin             = $instance['title_group']['custom_mg_bt'] ? $instance['title_group']['custom_mg_bt'] : '';
$desc_content             = $instance['desc_group']['content'] ? $instance['desc_group']['content'] : '';
$desc_content_location    = $instance['desc_group']['content_location'] ? $instance['desc_group']['content_location'] : '';
$desc_content_show_border = $instance['desc_group']['show_border'] ? $instance['desc_group']['show_border'] : '';
$desc_color               = $instance['desc_group']['color_desc'] ? $instance['desc_group']['color_desc'] : '';
$desc_padding             = $instance['desc_group']['desc_padding'] ? $instance['desc_group']['desc_padding'] : '';
$img_link                 = wp_get_attachment_url( $instance['image_bg_group']['bg_img'], 'full' );
$img_margin_top           = $instance['image_bg_group']['img_margin_top'] ? $instance['image_bg_group']['img_margin_top'] : '';
$box_padding              = $instance['sale_off_padding'] ? $instance['sale_off_padding'] : '';
$css_animation            = $instance['css_animation'] ? $instance['css_animation'] : 'zoom-in';
if ( ( $desc_content_location == 'center' ) && ( $css_animation == 'zoom-in' ) ) {
	$desc_location .= 'position: absolute; ';
	$desc_location .= '-webkit-transform: translate(-50%, -50%);
				-moz-transform:    translate(-50%, -50%);
				-ms-transform:     translate(-50%, -50%);
				-o-transform:      translate(-50%, -50%x);
				top :50%;
				left: 50%;
				';
}
if ( ( $desc_content_location == 'center' ) && ( $css_animation == 'none' ) ) {
	$desc_location .= 'position: absolute; ';
	$desc_location .= '-webkit-transform: translate(-50%, -50%);
				-moz-transform:    translate(-50%, -50%);
				-ms-transform:     translate(-50%, -50%);
				-o-transform:      translate(-50%, -50%x);
				top :50%;
				left:50%
				';
}
if ( $desc_content_location == 'top' ) {
	$desc_location .= 'position: relative; ';
}
if ( $desc_padding ) {
	$desc_location .= 'margin:' . $desc_padding . ';';
}
$style_css = $css_border = '';
if ( $desc_content_show_border ) {
	$css_border = 'border: 1px solid ' . $title_color . ';';
}
if ( $title_color <> '' ) {
	$css_border .= 'color:' . $title_color . '';
}
if ( $css_border ) {
	$style_css = ' style="' . $css_border . '"';
}
//
$read_more = $read_more_style = '';
$read_more .= ( $instance['read_more_group']['read_more_text_color'] != '' ) ? 'color: ' . $instance['read_more_group']['read_more_text_color'] . ';' : '';
$read_more_btn = 'margin-top: ' . $instance['read_more_group']['read_text_margin_top'];

// Set link to Box
$more_link = $link_prefix = $link_sufix = '';
if ( $instance['read_more_group']['link'] != '' ) {

	$more_link = '<div class="read-more-btn" style="' . $read_more_btn . '" data-old=' . $instance['read_more_group']['read_more_text_color'] . ' data-hover=' . $instance['read_more_group']['read_more_text_color_hover'] . '><a style="padding: 5px 12px;text-decoration: none;color:' . $instance['read_more_group']['read_more_text_color'] . ';border: 1px solid ' . $instance['read_more_group']['read_more_text_color'] . ';' . $read_more_style . '" class="smicon-read sc-btn" href="' . esc_url( $instance['read_more_group']['link'] ) . '">';
	$more_link .= $instance['read_more_group']['read_text'];
	$more_link .= '</a></div>';
}


$html = '';
$html .= '<div class="box-sale-off ' . $css_animation . '" style="position: relative;padding:' . $box_padding . ';text-align: center;background: ' . $instance['box_background_color'] . '">';
$html .= '<div class="box-title">';
$html .= '<' . $title_size . $style_css . '>';
$html .= $title;
$html .= '</' . $title_size . '>'; //end title
$html .= '</div>';
$html .= '<div class="box-sale-off-content" style="' . $desc_location . '; z-index: 99;text-align: center">';
$html .= '<div style="color: ' . $desc_color . '">' . $desc_content . '</div>';
$html .= $more_link;
$html .= '</div>';
$html .= '<img style="margin-top:' . $img_margin_top . '" src="' . $img_link . '" alt="" />';
$html .= '</div>';
echo ent2ncr( $html );
?>
