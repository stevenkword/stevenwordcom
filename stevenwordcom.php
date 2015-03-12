<?php
/*
Plugin Name: stevenword.com companion
Version: 0.1-alpha
Description: PLUGIN DESCRIPTION HERE
Author: YOUR NAME HERE
Author URI: YOUR SITE HERE
Plugin URI: PLUGIN SITE HERE
Text Domain: stevenwordcom
Domain Path: /languages
*/

/**
 * Change the site title depending on category
 *
 * @param  [type] $bloginfo [description]
 * @param  [type] $show     [description]
 * @return [type]           [description]
 */
function s8d_filter_bloginfo_description( $bloginfo, $show ) {
	if( isset( $bloginfo ) && $show == 'description' ) {
		global $post;

		if( ! is_front_page() && ( is_category( 'blog' ) || in_category( 'blog', $post ) ) ) {
			$bloginfo = str_replace( "creating things", "<u>all the things</ul>!", $bloginfo );
		}

		if( ! is_front_page() && ( is_category( 'wordpress' ) || in_category( 'wordpress', $post ) ) ) {
			$bloginfo = str_replace( "creating things", "WordPress", $bloginfo );
		}

		if( ! is_front_page() && ( is_category( 'hiking' ) || in_category( 'hiking', $post ) ) ) {
			$bloginfo = str_replace( "creating things", "climbing things", $bloginfo );
		}

		if( ! is_front_page() && ( is_category( 'cars' ) || in_category( 'cars', $post ) ) ) {
			$bloginfo = str_replace( "creating things", "wrenching on things", $bloginfo );
		}
	}
	return $bloginfo;
}
add_filter( 'bloginfo', 's8d_filter_bloginfo_description', 10, 2 );