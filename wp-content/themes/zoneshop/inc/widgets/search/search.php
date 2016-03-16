<?php
require get_template_directory() . '/inc/widgets/search/lib/function-search.php';

class Thim_Search_Widget extends WP_Widget {

	function __construct() {
		//Constructor
		$widget_ops = array(
			'classname'   => 'thim_search_widget',
			'description' => 'A search form for ranger site.'
		);
		parent::__construct( 'thim_search_widget', 'Thim: Search on Page', $widget_ops );
	}

	function widget( $args, $instance ) {
		$before_widget = $args['before_widget'];
		$after_widget  = $args['after_widget'];
		extract( $args, EXTR_SKIP );
		$class_custom = empty( $instance['class_custom'] ) ? '' : apply_filters( 'widget_class_custom', $instance['class_custom'] );
		echo ent2ncr($before_widget);
		?>
		<div id="header-search-form-input" class="main-header-search-form-input <?php echo esc_attr( $class_custom ); ?>">
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e( 'BUSCAR', 'thim' ); ?>" class="form-control ob-search-input" autocomplete="off" />
				<button type="submit" class="button-search" role="button"><i></i></button>
				<span class="header-search-close"></span>
				<ul class="ob-list-search">
				</ul>
			</form>
			<div class="clear"></div>
		</div>
		<?php
		echo ent2ncr($after_widget);
	}

	function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['class_custom'] = strip_tags( $new_instance['class_custom'] );
		return $instance;
	}

	function form( $instance ) {
		$instance     = wp_parse_args( (array) $instance, array( 'class_custom' => 'default' ) );
		$class_custom = strip_tags( $instance['class_custom'] );
		?>
	<?php
	}

}

function thim_search_widget_register() {
	register_widget( 'Thim_Search_Widget' );
}

add_action( 'widgets_init', 'thim_search_widget_register' );