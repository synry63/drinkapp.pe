<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 5/5/14
 * Time: 2:27 PM
 */

global $theme_options_data, $wp_query;
/***********custom Top Images*************/
$height           = 100;
$text_color       = $bg_color = $class_full = $text_color_header = '';
$hide_breadcrumbs = 0;
$hide_title       = 0;
// color theme options
if ( get_post_type() == "product" ) {
	if ( isset( $theme_options_data['thim_woo_cate_heading_text_color'] ) && $theme_options_data['thim_woo_cate_heading_text_color'] <> '' ) {
		$text_color_header = 'style="color: ' . $theme_options_data['thim_woo_cate_heading_text_color'] . '"';
	}
	if ( isset( $theme_options_data['thim_woo_cate_heading_bg_color'] ) && $theme_options_data['thim_woo_cate_heading_bg_color'] <> '' ) {
		$bg_color = 'background: ' . $theme_options_data['thim_woo_cate_heading_bg_color'] . ';';
	}

	if ( isset( $theme_options_data['thim_woo_cate_height_heading'] ) && $theme_options_data['thim_woo_cate_height_heading'] <> '' ) {
		$height = $theme_options_data['thim_woo_cate_height_heading'];
	}
	if ( isset( $theme_options_data['thim_woo_cate_hide_breadcrumbs'] ) ) {
		$hide_breadcrumbs = $theme_options_data['thim_woo_cate_hide_breadcrumbs'];
	}
	$cat_obj = $wp_query->get_queried_object();
	if ( $cat_obj ) {
		if ( property_exists( $cat_obj, 'term_id' ) ) {
			$category_ID      = $cat_obj->term_id;
			$background_color = get_tax_meta( $category_ID, 'thim_bg_header_color_product', true );
			$text_header      = get_tax_meta( $category_ID, 'thim_text_header_color_product', true );
			if ( $text_header == '' ) {
				$text_header = "#";
			}
			if ( $text_header != '#' ) {
				$text_color_header = 'style="color: ' . $text_header . '"';

			}
			if ( $background_color == '' ) {
				$background_color = '#';
			}
			if ( $background_color != '#' ) {
				$bg_color = 'background: ' . $background_color . ';';
			}
		}

	}
} else {
	if ( isset( $theme_options_data['thim_archive_text_color'] ) && $theme_options_data['thim_archive_text_color'] <> '' ) {
		$text_color_header = 'style="color: ' . $theme_options_data['thim_archive_text_color'] . '"';
	}
	if ( isset( $theme_options_data['thim_archive_bg_color'] ) && $theme_options_data['thim_archive_bg_color'] <> '' ) {
		$bg_color = 'background: ' . $theme_options_data['thim_archive_bg_color'] . ';';
	}
	if ( isset( $theme_options_data['thim_archive_height_heading'] ) && $theme_options_data['thim_archive_height_heading'] <> '' ) {
		$height = $theme_options_data['thim_archive_height_heading'];
	}
	if ( isset( $theme_options_data['thim_archive_hide_breadcrumbs'] ) ) {
		$hide_breadcrumbs = $theme_options_data['thim_archive_hide_breadcrumbs'];
	}
}

// custom color in category
$text_color = get_tax_meta( $cat, 'thim_cat_bg_header_color', true );

if ( $text_color == '' ) {
	$text_color = "#";
}
if ( $text_color != '#' ) {
	$text_color_header = 'style="color: ' . $text_color . '"';
}

$bg_header = get_tax_meta( $cat, 'thim_cat_text_header_color', true );

if ( $bg_header == '' || $bg_header == '#' ) {
} else {
	$bg_color = 'background: ' . $bg_header . ';';
}
if ( $height <> '' ) {
	$height = 'height: ' . $height . 'px;';
}

$c_css = '';

if ( $height || $bg_color ) {
	$c_css = ' style="' . $bg_color . $height . '"';
}

?>
<?php
if ( !$hide_breadcrumbs ) {
	?>
	<div class="top_site_main" <?php echo ent2ncr( $c_css ); ?>>
		<div class="page-title-wrapper" <?php echo ent2ncr( $text_color_header); ?>>
			<?php
			if ( get_post_type() == 'product' ) {
				echo '<div class="breadcrumbs width100">';
				woocommerce_breadcrumb();
				echo '</div>';
			} else {
				echo '<div class="breadcrumbs width100">';
				thim_breadcrumbs();
				echo '</div>';
			}
			?>
		</div>
	</div>
<?php } ?>