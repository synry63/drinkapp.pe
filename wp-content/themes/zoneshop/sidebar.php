<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package thim
 */
if (!is_active_sidebar('sidebar-1')) {
	return;
}
?>

<div id="secondary" class="widget-area col-md-3 col-sm-3 col-xs-12 hidden-sm" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
