<?php
/* Set Default value when theme option not save at first time setup */
global $theme_options_data, $wp_query;

if (
	is_page_template( 'page-templates/homepage_02.php' )
	|| is_page_template( 'page-templates/homepage_03.php' )
	|| is_page_template( 'page-templates/homepage.php' )
    || is_page_template( 'page-templates/readerpage.php' )
) {
	$file = tp_template_path();
	include $file;
	return;
} else {

}
$file = tp_template_path();
get_header();

// product
if ( get_post_type() == "product" && ! is_search() ) {
	$class_col  = 'col-sm-9 alignright';
	$sidebar_cl = " sidebar-left";
	// layout
	if ( is_page() || is_single() ) {
		/***********custom layout in page*************/
		$custom_layout = get_post_meta( get_the_ID(), 'thim_mtb_custom_layout', true );
		/*custom select layout*/
		$select_layout = get_post_meta( get_the_ID(), 'thim_mtb_layout', true );

		if ( isset( $theme_options_data['thim_woo_single_layout'] ) && $theme_options_data['thim_woo_single_layout'] == '2c-r-fixed' ) {
			$class_col  = "col-sm-9 alignleft";
			$sidebar_cl = " sidebar-right";
		}
		if ( isset( $theme_options_data['thim_woo_single_layout'] ) && $theme_options_data['thim_woo_single_layout'] == '1col-fixed' ) {
			$class_col  = "col-sm-12 full-width";
			$sidebar_cl = "";
		}
		if ( $custom_layout == '1' ) {
			if ( $select_layout == 'full-content' ) {
				$class_col = "col-sm-12 full-width";
			}
			if ( $select_layout == 'sidebar-right' ) {
				$class_col  = "col-sm-9 alignleft";
				$sidebar_cl = " sidebar-right";
			}
			if ( $select_layout == 'sidebar-left' ) {
				$class_col  = 'col-sm-9 alignright';
				$sidebar_cl = " sidebar-left";
			}
		}
	} else {
		if ( isset( $theme_options_data['thim_woo_cate_layout'] ) && $theme_options_data['thim_woo_cate_layout'] == '2c-r-fixed' ) {
			$class_col  = "col-sm-9 alignleft";
			$sidebar_cl = " sidebar-right";
		}
		if ( isset( $theme_options_data['thim_woo_cate_layout'] ) && $theme_options_data['thim_woo_cate_layout'] == '1col-fixed' ) {
			$class_col  = "col-sm-12 full-width";
			$sidebar_cl = "";
		}
		$cat_obj = $wp_query->get_queried_object();
		if ( $cat_obj ) {
			if ( property_exists( $cat_obj, 'term_id' ) ) {
				$category_ID   = $cat_obj->term_id;
				$select_layout = get_tax_meta( $category_ID, 'thim_custom_cate_layout', true );
				if ( $select_layout == "right_sidebar" ) {
					$class_col  = "col-sm-9 alignleft";
					$sidebar_cl = " sidebar-right";
				} else {
					if ( $select_layout == "fullwidth" ) {
						$class_col = "col-sm-12 full-width";
					} else {
						if ( $select_layout == "left_sidebar" ) {
							$class_col  = "col-sm-9 alignright";
							$sidebar_cl = " sidebar-left";
						} else {

						}
					}
				}
			}

		}

	}
	/*********** Theme option*************/

	?>
	<section class="content-area">

		<div class="container site-content<?php echo esc_attr( $sidebar_cl ); ?>">
			<div class="row">
				<main id="main-product" class="<?php echo esc_attr( $class_col ); ?>" role="main">
					<?php
					if ( is_page() || is_single() ) {
						get_template_part( 'inc/templates/content', 'top' );
					} else {
						get_template_part( 'inc/templates/archive', 'top' );
					}
					?>

					<?php include $file; ?>
				</main>
				<?php
				if ( $class_col == "col-sm-9 alignleft" || $class_col == "col-sm-9 alignright" ) {
					/**
					 * woocommerce_sidebar hook
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					do_action( 'woocommerce_sidebar' );
				}
				?>
			</div>
		</div>
	</section>

<?php } elseif ( is_category() || is_archive() || is_search() ) {
	global $sidebar_thumb_size, $wp_query;
	$select_style = '';
	/* custom style layout */
	$select_style = get_tax_meta( $cat, 'thim_style_archive', true );

 	/* cutom style layout columns */
	if ( $select_style == "masonry" ) {
		$select_style_columns = get_tax_meta( $cat, 'thim_style_archive_columns', true );
		if ( $select_style_columns <> '' ) {
		} else {
			$select_style_columns = $theme_options_data['thim_archive_style_columns'];
		}
	} else {
		$select_style_columns = "";
	}

	/* cutom layout */
	$select_sidebar = get_tax_meta( $cat, 'thim_layout', true );
	$class_col      = 'col-sm-9 alignright';
	$sidebar_cl     = " sidebar-left";
	//$sidebar_thumb_size = "thumbnail";

	if ( isset( $theme_options_data['thim_archive_layout'] ) && $theme_options_data['thim_archive_layout'] == '2c-r-fixed' ) {
		$class_col  = "col-sm-9 alignleft";
		$sidebar_cl = " sidebar-right";
	}
	if ( isset( $theme_options_data['thim_archive_layout'] ) && $theme_options_data['thim_archive_layout'] == '1col-fixed' ) {
		$class_col  = "col-sm-12 full-width";
		$sidebar_cl = "";
		//$sidebar_thumb_size = "medium";
	}
	if ( $select_sidebar <> '' ) {
		if ( $select_sidebar == 'no-sidebar' ) {
			$class_col = "col-sm-12 full-width";
			//$sidebar_thumb_size = "medium";
		}
		if ( $select_sidebar == 'right-sidebar' ) {
			$class_col  = "col-sm-9 alignleft";
			$sidebar_cl = " sidebar-right";
		}
		if ( $select_sidebar == 'left-sidebar' ) {
			$class_col  = 'col-sm-9 alignright';
			$sidebar_cl = " sidebar-left";
		}
	}
 	/* Paging style */
	$paging_style = "paging";

 	?>
	<!-- list archive-->
	<section class="content-area <?php echo esc_attr( $sidebar_cl ); ?>">
		<div class="container site-content">
			<div class="row">
				<main id="main" class="site-main <?php echo esc_attr( $class_col ); ?>" role="main">
					<?php get_template_part( 'inc/templates/archive', 'top' ); ?>
					<div class="page-content-inner <?php echo esc_attr( $paging_style ); ?>">
						<?php include $file; ?>
					</div>
				</main>
				<?php
				if ( $class_col == "col-sm-9 alignleft" || $class_col == "col-sm-9 alignright" ) {
					get_sidebar();
				}
				?>
			</div>
		</div>
	</section>

<?php
} else {
	if ( is_page() || is_single() ) {

		/***********custom layout in page*************/
		$custom_layout = get_post_meta( get_the_ID(), 'thim_mtb_custom_layout', true );
		/*custom select layout*/
		$select_layout = get_post_meta( get_the_ID(), 'thim_mtb_layout', true );
		/*custom color*/
		$select_color = get_post_meta( get_the_ID(), 'thim_mtb_bg_content_boxed', true );
		/*custom layout style*/
		$layout_style = 'boxed';
		//$layout_style = get_post_meta( get_the_ID(), 'thim_mtb_layout_style', true );
		/***********custom layout in page*************/
		$padding = get_post_meta( get_the_ID(), 'thim_mtb_padding', true );
		/*********** Theme option*************/
		$class_col = 'col-sm-9 col-xs-12 alignright';
		$sidebar_cl = " sidebar-left";
		$bg ='';
		if ( $select_color && $custom_layout == '1' ) {
			$custom_color = get_post_meta( get_the_ID(), 'thim_mtb_bg_content_boxed', true );
			$bg = 'style="background:' .$custom_color . ';"';

		}

		if ( isset( $theme_options_data['thim_post_page_layout'] ) && $theme_options_data['thim_post_page_layout'] == '2c-r-fixed' ) {
			$class_col = "col-sm-9 col-xs-12 alignleft";
			$sidebar_cl = " sidebar-right";
		}
		if ( isset( $theme_options_data['thim_post_page_layout'] ) && $theme_options_data['thim_post_page_layout'] == '1col-fixed' ) {
			$class_col  = "col-sm-12 full-width";
			$sidebar_cl = "";
		}
		if ( $custom_layout == '1' ) {
			if ( $layout_style == 'boxed' ) {
				if ( $select_layout == 'full-content' ) {
					$class_col = "col-sm-12 full-width";
				}
				if ( $select_layout == 'sidebar-right' ) {
					$class_col = "col-sm-9 col-xs-12 alignleft";
					$sidebar_cl = " sidebar-right";
				}
				if ( $select_layout == 'sidebar-left' ) {
					$class_col = 'col-sm-9 col-xs-12 alignright';
					$sidebar_cl = " sidebar-left";
				}
			} elseif ( $layout_style == 'wide' ) {
				$class_col = "box-full";
			}
		}
		if ( $padding == '1' ) {
			$sidebar_cl .= 'no-padding ';
		}
		?>
		<section class="content-area<?php echo esc_attr( $sidebar_cl ); ?>">
			<?php
			// layout # wide
			if ( $custom_layout == '1' ) {
				if ( $layout_style == 'boxed' ) {
					echo '<div class="container site-content"><div class="row">';
				}
			} else {
				echo '<div class="container site-content"><div class="row">';
			}
			?>
			<main id="main" class="main-single <?php echo esc_attr( $class_col ); ?>" role="main">
				<?php get_template_part( 'inc/templates/content', 'top' ); ?>
				<?php if($bg){
					echo '<div '.$bg.'>';
				}?>
					<?php include $file; ?>
				<?php if($bg){
					echo '</div>';
				}?>
			</main>
			<?php
			if ( $class_col == "col-sm-9 col-xs-12 alignleft" || $class_col == "col-sm-9 col-xs-12 alignright" ) {
				get_sidebar();
			}
			?>
			<?php
			if ( $custom_layout == '1' ) {
				if ( $layout_style == 'boxed' ) {
					echo '</div></div>';
				}
			} else {
				echo '</div></div>';
			}
			?>
		</section>
	<?php
	} else {
		include $file;
	}
}

get_footer();
?>