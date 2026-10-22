<?php
/**
 * Functions hooked to core hooks.
 *
 */

if ( ! function_exists( 'bizlite_customize_search_form' ) ) :

	function bizlite_customize_search_form() {

		$form = '<form role="search" method="get" class="search-form " action="' . esc_url( home_url( '/' ) ) . '">
					<label><input type="search"  placeholder="' . esc_attr_x( 'search here...', 'placeholder', 'bizlite' ) . '" value="' . get_search_query() . '" name="s" class="search-field form-control" title="' . esc_attr_x( 'Search for:', 'label', 'bizlite' ) . '" /></label>
					<input class="search-submit fa fa-search" value="&#xf002;" type="submit">
		        </form>';
		return $form;
	}
	
endif;

add_filter( 'get_search_form', 'bizlite_customize_search_form', 15 );
?>