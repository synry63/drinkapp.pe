<?php
$number_post = $instance['number_post'];
$layout      = $instance['layout'];
$columns     = $instance['columns'];

$css_animation = $instance['css_animation'];

$css_animation = thim_getCSSAnimation( $css_animation );

$our_team_args = array(
	'posts_per_page' => $number_post,
	'post_type'      => 'our_team'
);

if ( $cat_our_team ) {
	$cat_id                     = explode( ',', $cat_our_team );
	$our_team_args['tax_query'] = array(
		array(
			'taxonomy' => 'our_team_category',
			'field'    => 'term_id',
			'terms'    => $cat_id
		)
	);
}

// $columns = 4;

if ( ( $columns <> '' ) && ( $columns <> '5' ) ) {
	$columns = 12 / $columns;
}
if ( $columns == '5' ) {
	$columns = ' col-lg-20';
}

$our_team = new WP_Query( $our_team_args );

if ( $our_team->have_posts() ) {
	switch ( $layout ) {
		/****************************Lists1**************************/
		case 'list1':
			echo '<div class="wrapper-lists-our-team ' . $css_animation . " " . $layout . '"><ul class="row">';
			while ( $our_team->have_posts() ): $our_team->the_post();
				$regency      = get_post_meta( get_the_ID(), 'regency', true );
				$link_face    = get_post_meta( get_the_ID(), 'face_url', true );
				$link_twitter = get_post_meta( get_the_ID(), 'twitter_url', true );
				$skype_url    = get_post_meta( get_the_ID(), 'skype_url', true );
				//$email_url    = get_post_meta( get_the_ID(), 'our_team_email', true );
				$dribbble_url = get_post_meta( get_the_ID(), 'dribbble_url', true );
				$linkedin_url = get_post_meta( get_the_ID(), 'linkedin_url', true );

				echo '<li class="col-sm-' . $columns . '">';
				echo '<div class="our-team-image">';
				if ( has_post_thumbnail() ) {
					$thumb = get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'item-img', 'alt' => esc_attr( get_the_title( get_the_ID() ) ) ) );
					if ( $thumb ) {
						echo ent2ncr( $thumb );
					}
				}

				echo '</div> ';
				echo '<div class="content-team">
                                   <h4>' . get_the_title( get_the_ID() ) . '</h4>';
				if ( $regency <> '' ) {
					echo '<div class = "regency">' . $regency . '</div>';
				}
				echo '<div class="hidden-child">
  								<ul class="social-team">';
				if ( $link_face <> '' ) {
					echo '<li><a href="' . $link_face . '"><i class="fa fa-facebook-square"></i></a></li>';
				}
				if ( $link_twitter <> '' ) {
					echo '<li><a href="' . $link_twitter . '"><i class="fa fa-twitter-square"></i></a></li>';
				}
				if ( $skype_url <> '' ) {
					echo '<li><a href="' . $skype_url . '"><i class="fa fa-skype"></i></a></li>';
				}
				if ( $linkedin_url <> '' ) {
					echo '<li><a href="' . $linkedin_url . '"><i class="fa fa-linkedin-square"></i></a></li>';
				}
				if ( $dribbble_url <> '' ) {
					echo '<li><a href="' . $dribbble_url . '"><i class="fa fa-dribbble"></i></a></li>';
				}
				echo '</ul></div>';
				echo '<div class="desc-our-team">';
				the_content();
				echo '</div>';
				echo '</div>';
				echo '</li>';

			endwhile;
			echo '</ul></div>';
			wp_reset_postdata();
		/***********************End List 1***************************/
	}
}