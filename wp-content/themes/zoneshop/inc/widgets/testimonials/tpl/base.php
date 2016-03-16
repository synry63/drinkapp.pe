    <?php
    /**
     * widget testimonials
     * user: longpq
     **/
    $css = $css_heading = $css_content = $text_color = $text_align = $data_show_button = '';

    // text align
    //$text_align = $instance['t_text_align'] ? $instance['t_text_align'] : 'left';

    // avatar
    //$avatar = $instance['t_avatar'] ? $instance['t_avatar'] : 'av_left';

    // content color
    $text_color = $instance['t_config']['t_text_color'] ? $instance['t_config']['t_text_color'] : '#111';

    // author color
    $author_color = $instance['t_config']['author_color'] ? $instance['t_config']['author_color'] : '#111';

    // button color
    //$button_color = $instance['t_config']['button_color'] ? $instance['t_config']['button_color'] : '#111';

    // web link color
    $link_color = $instance['t_config']['link_color'] ? $instance['t_config']['link_color'] : '#111';

    // nuber post view
    $num_posts = $instance['t_num_posts'] ? $instance['t_num_posts'] : 3;

    // order by
    $order_by = $instance['t_order_by'] ? $instance['t_order_by'] : '';

    // order
    $order = $instance['t_order'] ? $instance['t_order'] : '';

    // show button
    //$show_button = $instance['t_show_button'] ? 1 : 0;

    // animation
    $css_animation = $instance['css_animation'] ? thim_getCSSAnimation( $instance['css_animation'] ) : 'none';

    // extract class name
    $else_class = $instance['else_class'] ? thim_getExtraClass( $instance['else_class'] ) : '';

    $query_args = array(
        'posts_per_page' => $num_posts,
        'post_type'      => 'testimonials',
        'order'          => $order,
    );

    switch ( $order_by ) {
        case 'date' :
            $query_args['orderby'] = 'post_date';
            break;
        case 'title' :
            $query_args['orderby'] = 'post_title';
            break;
        case 'comment' :
            $query_args['orderby'] = 'comment_count';
            break;
        default : //random
            $query_args['orderby'] = 'rand';
    }

    $loop_posts = new WP_Query( $query_args );
    //css
    if ( $text_color ) {
        $text_color = 'color:' . $text_color . ';';
    }

    //if ( $text_align ) {
    //	$text_align = 'text-align:' . $text_align . '';
    //}
    $css = 'style="' . $text_color . '"';

    $link_color_style = $author_color_style = $button_color = '';
    if ( $author_color ) {
        $author_color_style = 'style="color:' . $author_color . '"';
    }
    if ( $link_color ) {
        $link_color_style = 'style="color:' . $link_color . '"';
    }
    if ( $text_color ) {
        $button_color = 'style="' . $text_color . '; text-align:center;"';
    }
//    if ( $show_button == 1 ) {
//        $data_show_button = 'data-show-button="' . $show_button . '"';
//    }

    echo '<div class="wg-testimonials' . esc_attr( $css_animation ) . '" ' . $button_color . ' >';

    if ( $loop_posts->have_posts() ) :
        echo '<div id="owl-demo" class="owl-carousel ' . esc_attr( $avatar ) . '">';
        while ( $loop_posts->have_posts() ) : $loop_posts->the_post();
            // web link
            $web_link = get_post_meta( get_the_ID(), 'website_url', true );
            echo '<div class="item" ' . $css . '>';
            echo '<p class="item-testimonial">' . esc_attr( get_the_content() ) . '</p>';
            // image
            if ( has_post_thumbnail() ) {
                $thumb   = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
                $url_img = $thumb[0];
                if ( $url_img ) {
                    echo '<p><img class="item-img" src="' . esc_url( $url_img ) . '" alt="' . esc_attr( get_the_title( get_the_ID() ) ) . '"></p>';
                }
            }

            echo '<p class="item-writer-name" ' . $author_color_style . '>' . esc_attr( get_the_title( get_the_ID() ) ) . '</p>';
            if ( $web_link ) {
                echo '<p class="item-testimonial-information" ' . $link_color_style . '>' . esc_attr( $web_link ) . '</p>';
            }
            echo '</div>';
        endwhile;
        echo '</div>';
    endif;
    echo '</div>';
    wp_reset_postdata();