<?php
/**
 * @package thim
 */
$class_single = "box kbm-article-page";
$c_css='';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class_single ); ?>>
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	<?php thim_posted_on(); ?>

	<div class="article article-details">
		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'thim' ),
			'after'  => '</div>',
		) );
		?>
		<?php thim_entry_footer(); ?>
	</div>
	<!-- .entry-content -->
</article><!-- #post-## -->
