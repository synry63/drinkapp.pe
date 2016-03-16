<?php
global $theme_options_data;
$class_container = $sticky_custom = '';
if ( $theme_options_data['thim_header_layout'] == 'wide' ) {
	$class_container = ' container';
}
if ( $theme_options_data['thim_config_att_sticky'] == 'sticky_custom' ) {
	$sticky_custom = ' sticky-custom';
}

$width_logo = 3;
if ( isset( $theme_options_data['thim_width_logo'] ) ) {
	$width_logo = (int) ( $theme_options_data['thim_width_logo'] / 8.3 );
}
$width_menu = 12 - $width_logo;

if ( is_active_sidebar( 'header_right' ) ) {
	$header_right_css = "";
} else {
	$header_right_css = " no_header_right";
}
?>

<div class="wrapper-logo <?php echo esc_attr( $class_container . $header_right_css ); ?>">
	<div class="row tm-table">
		<div class="col-md-<?php echo esc_attr( $width_logo ) ?> col-sm-2 table-cell sm-logo">
		<?php do_action( 'thim_logo' ); ?>
		</div>
		<?php if ( is_active_sidebar( 'header_right' ) ) : ?>
			<div class="col-md-<?php echo esc_attr($width_menu); ?> col-sm-10 table-cell table-right">
			<div class="header-right">
					<?php dynamic_sidebar( 'header_right' ); ?>
				</div>
			</div><!-- col-sm-6 -->
		<?php endif; ?>

	</div>
	<!--end container tm-table-->
</div>
<!--end wrapper-logo-->

<div class="navigation affix-top<?php echo esc_attr($sticky_custom); ?>" <?php if ( isset( $theme_options_data['thim_header_sticky'] ) && $theme_options_data['thim_header_sticky'] == 1 ) {
	echo 'data-spy="affix" data-offset-top="' . esc_attr( $theme_options_data['thim_header_height_sticky'] ) . '" ';
} ?>>
	<?php if ( $theme_options_data['thim_header_layout'] == 'wide' || $theme_options_data['thim_header_sticky'] == 1 ) {
		echo '<div class="container">';
	} ?>
	<!-- <div class="main-menu"> -->
	<div class="row tm-table">

		<div class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</div>

		<div class="col-sm-<?php echo esc_attr( $width_logo ); ?> table-cell logo sm-logo-affix">
			<?php do_action( 'thim_sticky_logo' ); ?>
		</div>
		<nav class="col-sm-<?php echo esc_attr( $width_menu ); ?> table-cell" role="navigation">
			<?php get_template_part( 'inc/header/main-menu' ); ?>
		</nav>
	</div>

	<?php if ( $theme_options_data['thim_header_layout'] == 'wide' || $theme_options_data['thim_header_sticky'] == 1 ) {
		echo '</div>';
	} ?>
	<!-- </div> -->
</div>
