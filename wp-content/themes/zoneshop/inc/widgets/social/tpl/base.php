<?php
$title          = $link_face = $link_twitter = $link_google = $link_instagram = $link_pinterest = $link_youtube = '';
$title          = $instance['title'];
$link_face      = $instance['link_face'];
$link_twitter   = $instance['link_twitter'];
$link_google    = $instance['link_google'];
$link_instagram = $instance['link_instagram'];
$link_pinterest = $instance['link_pinterest'];
$link_youtube   = $instance['link_youtube'];
$icon_style     = $instance['icon_style'];
$icon_size      = $instance['icon_size'];
$css            = 'style ="background-color:' . $instance['bg_social_color'] . '"';
if ( $title ) {
	echo ent2ncr($before_title .$title  . $after_title);
}
?>
<div class="thim-social">
	<ul class="<?php echo esc_attr( $icon_style ) . ' ' . esc_attr( $icon_size ); ?>">
		<?php
		if ( $link_face != '' ) {
			echo '<li ' . ent2ncr( $css ) . '><a class="facebook" href="' . esc_url( $link_face ) . '" target="_blank"></a></li>';
		}
		if ( $link_twitter != '' ) {
			echo '<li ' . ent2ncr( $css ) . '><a class="twitter" href="' . esc_url( $link_twitter ) . '" target="_blank"></a></li>';
		}
		if ( $link_google != '' ) {
			echo '<li ' . ent2ncr( $css ) . '><a class="google_plus" href="' . esc_url( $link_google ) . '"  target="_blank"></a></li>';
		}
		if ( $link_instagram != '' ) {
			echo '<li ' . ent2ncr( $css ) . '><a class="instagram" href="' . esc_url( $link_instagram ) . '"  target="_blank"></a></li>';
		}

		if ( $link_pinterest != '' ) {
			echo '<li ' . ent2ncr( $css ) . '><a class="pinterest" href="' . esc_url( $link_pinterest ) . '"  target="_blank"></a></li>';
		}

		if ( $link_youtube != '' ) {
			echo '<li ' . ent2ncr( $css ) . '><a class="youtube" href="' . esc_url( $link_youtube ) . '"  target="_blank"></a></li>';
		}
		?>
	</ul>
</div>