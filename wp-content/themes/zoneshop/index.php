<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package thim
 */

get_header(); ?>
<?php
global $theme_options_data;

$class_layout = 'col-sm-9 alignright';
$sidebar_cl   = " sidebar-left";

$layout_front_page = '2c-l-fixed';
if ( isset( $theme_options_data['thim_front_page_layout'] ) ) {
	$layout_front_page = $theme_options_data['thim_front_page_layout'];
	if ( $theme_options_data['thim_front_page_layout'] == '2c-r-fixed' ) {
		$class_layout = "col-sm-9 alignleft";
		$sidebar_cl   = " sidebar-right";
	}
	if ( $theme_options_data['thim_front_page_layout'] == '2c-l-fixed' ) {
		$class_layout = "col-sm-9 alignright";
		$sidebar_cl   = " sidebar-right";
	}
	if ( $theme_options_data['thim_front_page_layout'] == '1col-fixed' ) {
		$class_layout = "col-sm-12 full-width";
		$sidebar_cl   = '';
	}
}

?>

	<main id="main" class="site-main" role="main">
		<?php
		$text_color   = "#333";
		$custom_title = $text_color = $background_heading = $hide_breadcrubs = $height = '';
		if ( isset( $theme_options_data['thim_front_page_custom_title'] ) && $theme_options_data['thim_front_page_custom_title'] <> '' ) {
			$custom_title = $theme_options_data['thim_front_page_custom_title'];
		} else {
			$custom_title = __( 'Home', 'thim' );
		}

		if ( isset( $theme_options_data['thim_front_page_text_color'] ) && $theme_options_data['thim_front_page_text_color'] <> '' ) {
			$text_color = 'style="color: ' . $theme_options_data['thim_front_page_text_color'] . '"';
		}
		if ( isset( $theme_options_data['thim_front_page_bg_color'] ) && $theme_options_data['thim_front_page_bg_color'] <> '' ) {
			$background_heading = $theme_options_data['thim_front_page_bg_color'];
		}
		if ( isset( $theme_options_data['thim_post_page_bg_heading'] ) && $theme_options_data['thim_front_page_height_heading'] <> '' ) {
			$height = $theme_options_data['thim_front_page_height_heading'];
		} else {
			$height = '100';
		}
		if ( $custom_title <> "" ) {
			?>

		<?php
		}
		?>
		<div class="container home-content content-front-page <?php echo esc_attr( $sidebar_cl ) ?>">
			<div class="row">
				<div class="page-content-front-page <?php echo esc_attr( $class_layout ); ?>">
					<h2 class='box-heading' style="border-bottom: 1px solid #eee;">
						<?php echo esc_attr( $custom_title ); ?>
					</h2>
					<?php if ( have_posts() ) : ?>
						<?php /* Start the Loop */ ?>
						<div class="article-list">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php
								get_template_part( 'content' )
								?>
							<?php endwhile; ?>
						</div>
						<?php
						/*/ Paging Type /*/
						thim_paging_nav();
						?>
					<?php else : ?>
						<?php get_template_part( 'content', 'none' );
					endif;
					?>
				</div>
					<?php
					if ( $class_layout != "col-sm-12 full-width" ) {
						get_sidebar();
					}
					?>
			</div>
		</div>
	</main>
	<!-- #main -->
<?php get_footer(); ?>