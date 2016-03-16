<?php

/**
 * Function Sub word
 *
 * @param        $str     String
 * @param        $txt_len Number is cut
 * @param string $end_txt string at the end paragraph
 *
 * @return string
 */
function substr_words( $str, $txt_len, $end_txt = '...' ) {
	$words   = explode( ' ', $str );
	$new_str = '';
	foreach ( $words as $k => $val ) {
		if ( $k < $txt_len ) {
			$new_str .= $val . ' ';
		}
	}
	$new_str = rtrim( $new_str, ' ,.;:' );
	$new_str .= $end_txt;

	return $new_str;
}

function result_search_callback() {
	ob_start();
	function thim_search_title_filter( $where, &$wp_query ) {
		global $wpdb;
		if ( $keyword = $wp_query->get( 'search_prod_title' ) ) {
			$where .= ' AND ' . esc_sql( $wpdb->posts ) . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $keyword ) ) . '%\'';
		}

		return $where;
	}

	$keyword = $_REQUEST['keyword'];

	if ( $keyword ) {
		$search_query = array(
			'search_prod_title' => $keyword,
			'order'             => 'DESC',
			'orderby'           => 'date',
			'post_status'       => 'publish',
			'post_type'         => array(
				'post', 'page', 'product'
			),
		);
		add_filter( 'posts_where', 'thim_search_title_filter', 10, 2 );
		$search = new WP_Query( $search_query );
		remove_filter( 'posts_where', 'thim_search_title_filter', 10, 2 );

		$newdata = array();
		if ( $search ) {
			foreach ( $search->posts as $post ) {
				$newdata[] = array(
					'id'        => esc_attr( $post->ID ),
					'title'     => esc_attr( $post->post_title ),
					'guid'      => esc_url( get_permalink( $post->ID ) ),
					'date'      => mysql2date( 'M d Y', $post->post_date ),
					'thumbnail' => get_the_post_thumbnail( $post->ID, 'thumbnail' ),
					'shortdesc' => $post->post_content ? substr_words( strip_shortcodes( $post->post_content ), 20, '...' ) : ''
				);
			}
		}

		ob_end_clean();
		echo json_encode( $newdata );
	}
	die(); // this is required to return a proper result
}

function ob_ajax_url() {
	echo '<script type="text/javascript">
		var ob_ajax_url ="' . get_site_url() . '/wp-admin/admin-ajax.php";
		</script>';
}

add_action( 'wp_ajax_nopriv_result_search', 'result_search_callback' );
add_action( 'wp_ajax_result_search', 'result_search_callback' );
add_action( 'wp_print_scripts', 'ob_ajax_url' );

add_action( 'wp_enqueue_scripts', 'thim_search_scripts' );
function thim_search_scripts() {
	wp_enqueue_script( 'result-search', TP_THEME_URI . 'inc/widgets/search/js/result-search.js', array( 'jquery' ), '', true );

}