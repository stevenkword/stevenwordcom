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
 * Used to determine if we are looking at WordPressy content or archive pages
 * @return [type] [description]
 */
function s8d_is_wordpressy_view() {
	global $post;

	$current_cat = get_queried_object();
	$current_cat_id = $current_cat->term_id;

	$wordpress_cat = get_category_by_slug( 'wordpress' );
	$wordpress_cat_id = $wordpress_cat->term_id;

	$plugins_page = get_page_by_path( 'plugins' );
	$plugins_page_id = $plugins_page->ID;

	if ( ! is_front_page()
		&& ( cat_is_ancestor_of( $wordpress_cat_id, $current_cat_id ) || is_category( 'wordpress' ) || ( is_single() && in_category( 'wordpress', $post ) ) )
		|| is_page( 'plugins' )
		|| $post->post_parent == $plugins_page_id
	) {
		return true;
	}
	return false;
}

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

		$current_cat = get_queried_object();
		$current_cat_id = $current_cat->term_id;

		$wordpress_cat = get_category_by_slug( 'wordpress' );
		$wordpress_cat_id = $wordpress_cat->term_id;

		if( ! is_front_page() && ( is_category( 'blog' ) || ( is_single() && in_category( 'blog', $post ) ) ) ) {
			$bloginfo = str_replace( "creating things", "<u>all</u> the things", $bloginfo );
		} elseif ( s8d_is_wordpressy_view() ) {
			$bloginfo = str_replace( "creating things", "WordPress", $bloginfo );
		} elseif ( ! is_front_page() && ( is_category( 'hiking' ) || ( is_single() && in_category( 'hiking', $post ) ) ) ) {
			$bloginfo = str_replace( "creating things", "climbing things", $bloginfo );
		} elseif ( ! is_front_page() && ( is_category( 'cars' ) || ( is_single() && in_category( 'cars', $post ) ) ) ) {
			$bloginfo = str_replace( "creating things", "wrenching on things", $bloginfo );
		}
	}
	return $bloginfo;
}
add_filter( 'bloginfo', 's8d_filter_bloginfo_description', 10, 2 );

/**
 * Change styles based on category
 */
function s8d_filter_wp_head_override() {

	$lcol_color   = '';
	$rcol_color   = '';
	$header_color = '';

	global $post;

	$current_cat = get_queried_object();
	$current_cat_id = $current_cat->term_id;

	$wordpress_cat = get_category_by_slug( 'wordpress' );
	$wordpress_cat_id = $wordpress_cat->term_id;

	if( ! is_front_page() && ( is_category( 'blog' ) || ( is_single() && in_category( 'blog', $post ) ) ) ) {
		//things
	} elseif ( s8d_is_wordpressy_view() ) {
		$lcol_color   = '#21759b';
		$rcol_color   = '#d54e21';
		$header_color = '#464646';
	} elseif ( ! is_front_page() && ( is_category( 'hiking' ) || ( is_single() && in_category( 'hiking', $post ) ) ) ) {
		// Komoot
		$lcol_color   = '#8A9574';
		$rcol_color   = '#95C24B';
		$header_color = '#383838';
	} elseif ( ! is_front_page() && ( is_category( 'cars' ) || ( is_single() && in_category( 'cars', $post ) ) ) ) {

	}
	?>
	<style type="text/css">
	/* Dynamic CSS: For no styles in head, copy and put the css below in your child theme's style.css, disable dynamic styles */

	::selection { background-color: <?php echo $lcol_color; ?>; }
	::-moz-selection { background-color: <?php echo $lcol_color; ?>; }

	a,
	.themeform label .required,
	#flexslider-featured .flex-direction-nav .flex-next:hover,
	#flexslider-featured .flex-direction-nav .flex-prev:hover,
	.post-hover:hover .post-title a,
	.post-title a:hover,
	.s1 .post-nav li a:hover i,
	.content .post-nav li a:hover i,
	.post-related a:hover,
	.s1 .widget_rss ul li a,
	#footer .widget_rss ul li a,
	.s1 .widget_calendar a,
	#footer .widget_calendar a,
	.s1 .alx-tab .tab-item-category a,
	.s1 .alx-posts .post-item-category a,
	.s1 .alx-tab li:hover .tab-item-title a,
	.s1 .alx-tab li:hover .tab-item-comment a,
	.s1 .alx-posts li:hover .post-item-title a,
	#footer .alx-tab .tab-item-category a,
	#footer .alx-posts .post-item-category a,
	#footer .alx-tab li:hover .tab-item-title a,
	#footer .alx-tab li:hover .tab-item-comment a,
	#footer .alx-posts li:hover .post-item-title a,
	.comment-tabs li.active a,
	.comment-awaiting-moderation,
	.child-menu a:hover,
	.child-menu .current_page_item > a,
	.wp-pagenavi a { color: <?php echo $lcol_color; ?>; }

	.themeform input[type="submit"],
	.themeform button[type="submit"],
	.s1 .sidebar-top,
	.s1 .sidebar-toggle,
	#flexslider-featured .flex-control-nav li a.flex-active,
	.post-tags a:hover,
	.s1 .widget_calendar caption,
	#footer .widget_calendar caption,
	.author-bio .bio-avatar:after,
	.commentlist li.bypostauthor > .comment-body:after,
	.commentlist li.comment-author-admin > .comment-body:after { background-color: <?php echo $lcol_color; ?>; }

	.post-format .format-container { border-color: <?php echo $lcol_color; ?>; }

	.s1 .alx-tabs-nav li.active a,
	#footer .alx-tabs-nav li.active a,
	.comment-tabs li.active a,
	.wp-pagenavi a:hover,
	.wp-pagenavi a:active,
	.wp-pagenavi span.current { border-bottom-color: <?php echo $lcol_color; ?> !important; }


	.s2 .post-nav li a:hover i,
	.s2 .widget_rss ul li a,
	.s2 .widget_calendar a,
	.s2 .alx-tab .tab-item-category a,
	.s2 .alx-posts .post-item-category a,
	.s2 .alx-tab li:hover .tab-item-title a,
	.s2 .alx-tab li:hover .tab-item-comment a,
	.s2 .alx-posts li:hover .post-item-title a { color: <?php echo $rcol_color; ?>; }

	.s2 .sidebar-top,
	.s2 .sidebar-toggle,
	.post-comments,
	.jp-play-bar,
	.jp-volume-bar-value,
	.s2 .widget_calendar caption { background-color: <?php echo $rcol_color; ?>; }

	.s2 .alx-tabs-nav li.active a { border-bottom-color: <?php echo $rcol_color; ?>; }
	.post-comments span:before { border-right-color: <?php echo $rcol_color; ?>; }


	#header { background-color: <?php echo $header_color; ?>; }
	@media only screen and (min-width: 720px) {
		#nav-header .nav ul { background-color: <?php echo $header_color; ?>; }
	}

	#footer-bottom { background-color: <?php echo $header_color; ?>; }
	</style>
	<?php
}
add_filter( 'wp_head', 's8d_filter_wp_head_override', 999, 2 );