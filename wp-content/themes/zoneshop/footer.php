<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package thim
 */
?>
<footer id="footer" class="site-footer" role="contentinfo">
	<?php global $theme_options_data; ?>
	<?php if ( is_active_sidebar( 'footer' ) ) :
		$footer_boxed  = '';
		$footer_border = '';
		if ( isset( $theme_options_data['thim_footer_box_layout'] ) && $theme_options_data['thim_footer_box_layout'] == "boxed" ) {
			$footer_boxed = " boxed-area";
		}
		if ( isset( $theme_options_data['thim_show_border_column'] ) && ( $theme_options_data['thim_show_border_column'] == true ) ) {
			$footer_border = " show-border";
		}
		?>
		<div class="footer<?php echo esc_attr( $footer_boxed );
		echo esc_attr( $footer_border ); ?>">
			<div class="container">
				<div class="contact">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="<?php echo esc_attr( $footer_boxed ); ?>">
		<!--    footer bottom-->
		<?php if ( is_active_sidebar( 'footer_bottom' ) ) : ?>
			<div class="footer-bottom">
				<div class="container">
					<div class="row-footer-bottom">
						<?php dynamic_sidebar( 'footer_bottom' ); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<!--==============================powered=====================================-->
		<?php if ( isset( $theme_options_data['thim_copyright_text'] ) || is_active_sidebar( 'copyright' ) ) { ?>
			<div id="powered">
				<div class="container">
					<div class="contact">
						<?php
						if ( isset( $theme_options_data['thim_copyright_text'] ) ) {
							echo '<div class="col-lg-4 col-md-6 col-sm-5 col-xs-12 copyright">';
							echo ent2ncr( $theme_options_data['thim_copyright_text'] );
							echo '</div>';
						}
						?>
						<?php if ( is_active_sidebar( 'copyright' ) ) : ?>
							<div class="col-lg-8 col-md-6 col-sm-7 col-xs-12 payment">
								<?php dynamic_sidebar( 'copyright' ); ?>
							</div><!-- col-sm-6 -->
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
    <div class="footer-fix">TOMAR BEBIDAS ALCOHÓLICAS EN EXCESO ES DAÑINO.</div>
</footer><!-- #colophon -->
</div><!--end main-content-->
</div></div><!-- .wrapper-container -->

<!-- .box-area -->
<?php if ( isset( $theme_options_data['thim_show_to_top'] ) && $theme_options_data['thim_show_to_top'] == 1 ) { ?>
	<a id='topcontrol' class="scrollup show" title="<?php esc_attr_e( 'IR AL INICIO', 'thim' ); ?>"><?php esc_attr_e( 'IR AL INICIO', 'thim' ); ?></a>
<?php } ?>

<?php if ( isset( $theme_options_data['thim_box_layout'] ) && $theme_options_data['thim_box_layout'] == "boxed" ) {
	echo '</div>';
} ?>

<?php if ( isset( $theme_options_data['thim_show_offcanvas_sidebar'] ) && $theme_options_data['thim_show_offcanvas_sidebar'] == '1' && is_active_sidebar( 'offcanvas_sidebar' ) ) { ?>
	<div class="slider-sidebar">
		<?php dynamic_sidebar( 'offcanvas_sidebar' ); ?>
	</div>  <!--slider_sidebar-->
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>

