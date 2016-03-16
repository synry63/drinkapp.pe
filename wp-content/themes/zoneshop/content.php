<?php
/**
 * @package thim
 */

$classes   = array();
$classes[] = 'article';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<?php
	$sidebar_thumb_size = "thumbnail";
	if (has_post_format( 'link' ) && thim_meta( 'thim_url' ) && thim_meta( 'thim_text' )) {
		$url  = thim_meta( 'thim_url' );
		$text = thim_meta( 'thim_text' );
		if ( $url && $text ) {
			echo '<header class="entry-header">
						<h3 class="blog_title"><a class="link" href="' . esc_url( $url ) . '">' . esc_attr( $text ) . '</a><h3>
					</header>';
		}
	} elseif ( has_post_format( 'quote' ) && thim_meta( 'thim_quote' ) && thim_meta( 'thim_author_url' ) ) {
		$quote      = thim_meta( 'thim_quote' );
		$author     = thim_meta( 'thim_author' );
		$author_url = thim_meta( 'thim_author_url' );
		if ( $author_url ) {
			$author = ' <a href=' . esc_url( $author_url ) . '>' . $author . '</a>';
		}
		if ( $quote && $author ) {
			echo '
					<header class="entry-header">
					<div class="box-header box-quote">
						<blockquote>' . $quote . '<cite>' . $author . '</cite></blockquote>
					</div>
					</header>
					';
		}
	} elseif ( has_post_format( 'audio' ) ) {
		echo '
					 <header class="entry-header">
 						<h3 class="blog_title"><a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" rel="bookmark">' . esc_attr( get_the_title( get_the_ID() ) ) . '</a></h3>
 					</header>
				 ';
	}
	else {
	$full_no_images = '';
	if ( ! ( has_post_thumbnail() ) ) {
		$full_no_images = 'no-images';
	}
	do_action( 'thim_entry_top', $sidebar_thumb_size );
	?>
	<div class="content-article <?php echo esc_attr($full_no_images); ?>">
		<div class="article-header">
			<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		</div>
		<div class="article-content">
			<?php
			global $theme_options_data;
			$length = '50';
			if ( isset( $theme_options_data['thim_archive_excerpt_length'] ) ) {
				$length = $theme_options_data['thim_archive_excerpt_length'];
			}
			echo thim_excerpt( $length ) . '';

			global $theme_options_data;

			if ( ! isset( $theme_options_data['thim_show_date'] ) ) {
				$theme_options_data['thim_show_date']    = 1;
				$theme_options_data['thim_show_comment'] = 1;
				$theme_options_data['thim_date_format']  = "F j, Y";
			}
			if ( ! isset( $theme_options_data['thim_show_author'] ) ) {
				$theme_options_data['thim_show_author']   = 1;
				$theme_options_data['thim_show_category'] = 1;
			}
			?>
			<div class="article-read-more">
				<a href="<?php the_permalink(); ?>" class="read-more-link"><?php echo _e( 'Read more...', 'thim' ); ?></a>
				<?php thim_posted_on(); ?>
			</div>
		</div>
		<?php } ?>
</article>