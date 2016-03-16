<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package agapi
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
	<?php
	global $theme_options_data;
	if ( isset( $theme_options_data['thim_favicon'] ) ) {
		$thim_favicon     = $theme_options_data['thim_favicon'];
		$thim_favicon_src = $thim_favicon;
		// For the default value
		if ( is_numeric( $thim_favicon ) ) {
			$favicon_attachment = wp_get_attachment_image_src( $thim_favicon, 'full' );
			$thim_favicon_src   = $favicon_attachment[0];
		}
	} else {
		$thim_favicon_src = get_template_directory_uri() . "/images/favicon.png";
	}
	?>
	<link rel="shortcut icon" href=" <?php echo esc_url( $thim_favicon_src ); ?>" type="image/x-icon" />
	<?php
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>
<!-- menu for mobile-->
<div id="wrapper-container" class="wrapper-container">
	<div class="content-pusher">
		<!-- menu for mobile-->
		<nav class="visible-xs mobile-menu-container mobile-effect" role="navigation">
			<?php get_template_part( 'inc/header/mobile-menu' ); ?>
		</nav>
		<div id="main-content">
		<?php
		// Drawer
		if ( isset( $theme_options_data['thim_show_drawer'] ) && $theme_options_data['thim_show_drawer'] == '1' && is_active_sidebar( 'drawer_top' ) ) {
			get_template_part( 'inc/header/drawer' );
		}
		?>
		<header id="masthead" class="site-header header_v1" role="banner">
			<?php
			// Boxed
			if (isset($theme_options_data['thim_header_layout']) && $theme_options_data['thim_header_layout'] == 'boxed') {
			echo "<div class=\"container header-boxed\">";
			}
			// show top header
			if (isset($theme_options_data['thim_topbar_show']) && $theme_options_data['thim_topbar_show'] == '1') {
			get_template_part('inc/header/top-header');
			}
			// Header Style
 			get_template_part('inc/header/header_v1');
 			// Boxed
			if (isset($theme_options_data['thim_header_layout']) && $theme_options_data['thim_header_layout'] == 'boxed') {
			echo "</div>";
			}
			?>
		</header>
<?php if (isset($theme_options_data['thim_box_layout']) && $theme_options_data['thim_box_layout'] == "boxed") {
echo '<div id="wrapper" class="boxed-area">';
} ?>