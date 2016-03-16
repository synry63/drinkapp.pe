<?php
/**
 * Recent Reviews Widget
 *
 * @author        WooThemes
 * @category      Widgets
 * @package       WooCommerce/Widgets
 * @version       2.1.0
 * @extends       WC_Widget
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Custom_WC_Widget_Recent_Reviews extends WC_Widget_Recent_Reviews {

	/**
	 * widget function.
	 *
	 * @see    WP_Widget
	 * @access public
	 *
	 * @param array $args
	 * @param array $instance
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		global $comments, $comment;

		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();
		extract( $args );

		$title    = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number   = absint( $instance['number'] );
		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'post_type' => 'product' ) );

		if ( $comments ) {
			echo ent2ncr($before_widget);
			if ( $title ) {
				echo ent2ncr($before_title . esc_attr($title) . $after_title);
			}
			echo '<ul class="product_list_widget">';

			foreach ( (array) $comments as $comment ) {

				$_product = wc_get_product( $comment->comment_post_ID );

				$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

				$rating_html = $_product->get_rating_html( $rating );

				echo '<li>';
				echo '<div class="wrapper"><div class="thumb">';
				echo '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">';
				echo ent2ncr($_product->get_image());
				echo "</a>";
				echo '<div class="thumb__product_info"><div class="name">';
				echo '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">';

				echo esc_attr( $_product->get_title() ) . '</a></div>';
				echo ent2ncr($rating_html);
				printf( '<span class="reviewer">' . _x( 'by %1$s', 'by comment author', 'woocommerce' ) . '</span>', get_comment_author() );
				echo '</div></div></div>';
				echo '</li>';
			}
			echo '</ul>';
			echo ent2ncr($after_widget);
		}
		$content = ob_get_clean();
		echo ent2ncr($content);
		$this->cache_widget( $args, $content );
	}
}
