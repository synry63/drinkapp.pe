<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package thim
 */
if ( ! is_active_sidebar( 'sidebar-shop' ) ) {
	return;
}
?>
<div id="secondary" class="widget-sidebar-shop col-sm-3" role="complementary">
	<div class="sidebar">
		<?php dynamic_sidebar( 'sidebar-shop' ); ?>
	</div>
</div><!-- #secondary -->