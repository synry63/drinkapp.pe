<?php
/*
	Plugin Name:  Conditional Tags Shortcode
	Plugin URI:   http://shazdeh.me/wordpress-plugins/conditional-tags-shortcode/
	Version:      0.1
	Author:       Hassan Derakhshandeh
	Author URI:   http://shazdeh.me/
	Description:  A shortcode to display content based on context.

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

function conditional_tags_shortcode( $atts, $content ) {

	foreach( $atts as $key => $value ) {
		/* normalize empty attributes */
		if( is_int( $key ) ) {
			$key = $value;
			$value = true;
		}

		$reverse_logic = false;
		if( substr( $key, 0, 4 ) == 'not_' ) {
			$reverse_logic = true;
			$key = substr( $key, 4 );
		}
		if( function_exists( $key ) ) {
			$values = ( true === $value ) ? null : array_filter( explode( ',', $value ) );
			$result = call_user_func( $key, $values );
			if( $result !== $reverse_logic ) {
				return do_shortcode( $content );
			}
		}
	}

	return '';
}
add_shortcode( 'if', 'conditional_tags_shortcode' );