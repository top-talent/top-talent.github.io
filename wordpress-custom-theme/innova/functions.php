<?php
    /**
    *   Crunch functions and definitions
    *
    *   @package Crunch
    *   @since Crunch 2.0.0
    */


	/* ~~~~~~~~~~ Add options page to Wordpress with ACF ~~~~~~~~~ */
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	if( function_exists('acf_add_options_page') ) {
	    acf_add_options_page(array(
	        'page_title'    => get_bloginfo('name'),
	        'menu_title'    => get_bloginfo('name'),
	        'menu_slug'     => 'theme-general-settings',
	        'capability'    => 'edit_posts',
	        'redirect'      => false
	    ));
	}


	/* ~~~~~~~~~~ Add custom Wordpress navigation ~~~~~~~~~~ */

	if(function_exists('register_nav_menus')) {
		register_nav_menus(
			array(
				'footer_navigation' => 'Footer Navigation'
			)
		);
	}


	/* ~~~~~~~~~~ Widget areas ~~~~~~~~~~ */

	// if ( ! function_exists( 'crunch_sidebar_widgets' ) ) :
	// 	function crunch_sidebar_widgets() {
	// 		register_sidebar(array(
	// 	  		'id' => 'sidebar-widgets',
	// 	  		'name' => __( 'Sidebar widgets', 'crunch' ),
	// 	  		'description' => __( 'Drag widgets to this sidebar container.', 'crunch' ),
	// 	  		'before_widget' => '<div class="col-md-3"><section id="%1$s" class="widget %2$s">',
	// 	  		'after_widget' => '</section></div>',
	// 	  		'before_title' => '<h3 class="widget__title">',
	// 	  		'after_title' => '</h3>',
	// 		));

	// 		register_sidebar(array(
	// 	  		'id' => 'footer-widgets',
	// 	  		'name' => __( 'Footer widgets', 'crunch' ),
	// 	  		'description' => __( 'Drag widgets to this footer container', 'crunch' ),
	// 	  		'before_widget' => '<div class="col-md-3"><section id="%1$s" class="widget %2$s">',
	// 	  		'after_widget' => '</section></div>',
	// 	  		'before_title' => '<h3 class="widget__title">',
	// 	  		'after_title' => '</h3>',
	// 		));
	// 	}
	// 	add_action( 'widgets_init', 'crunch_sidebar_widgets' );
	// endif;


	/* ~~~~~~~~~~ Specific image dimensions ~~~~~~~~~~ */

	// add_image_size( 'image-type-title', 'X', 'X', true);


	/* ~~~~~~~~~~ Set Post Thumbnail dimension ~~~~~~~~~~ */

	// set_post_thumbnail_size(X, X, true);


	/* ~~~~~~~~~~ Protection for e-mail addresses in html ~~~~~~~~~~ */

	add_filter('acf/load_value', 'eae_encode_emails');


	/* ~~~~~~~~~~ OG Image fix ~~~~~~~~~~ */

	add_filter('wpseo_pre_analysis_post_content', 'crunch_opengraph_content');
	function crunch_opengraph_content($val) {
		return preg_replace("/<img[^>]+>/i", "", $val);
	}


	/* ~~~~~~~~~~ ACF Google Maps API Key ~~~~~~~~~~ */

	// function my_acf_init() {

	//     acf_update_setting('google_api_key', 'XXXXXXXXXXXXXXXXXXXX');
	// }

	// add_action('acf/init', 'my_acf_init');


	/* ~~~~~~~~~~ Init Sidebar ~~~~~~~~~~ */

	// add_action( 'widgets_init', 'crunch_widgets_init' );
	// function crunch_widgets_init() {
	//     register_sidebar(
	//         array(
	//             'name' => __( 'Blog', 'crunch' ),
	//             'id' => 'sidebar-blog',
	//             'description' => __( 'Widgets in this section are displayed on blog pages.', 'crunch' ),
	//             'before_widget' => '<div id="%1$s" class="widget %2$s">',
	//         'after_widget'  => '</div>',
	//         'before_title'  => '<h2 class="widget__title">',
	//         'after_title'   => '</h2>',
	//         )
	//     );
	// }


	/* ~~~~~~~~~~ Removing standard posts from WP Admin ~~~~~~~~~~ */

	// add_action( 'admin_menu', 'my_remove_menu_pages' );

	// function my_remove_menu_pages() {
	//     remove_menu_page('edit.php');
	// }


	/* ~~~~~~~~~~ Hide ACF ~~~~~~~~~~ */

	// add_filter('acf/settings/show_admin', '__return_false');


	/* ~~~~~~~~~~ Add SVG Support ~~~~~~~~~~ */

	function add_file_types_to_uploads($file_types){
		$new_filetypes = array();
		$new_filetypes['svg'] = 'image/svg+xml';
		$file_types = array_merge($file_types, $new_filetypes );
		return $file_types;
	}

	add_action('upload_mimes', 'add_file_types_to_uploads');


	/* ~~~~~~~~~~ Add Styles To TINY MCE ~~~~~~~~~~ */

	add_editor_style( 'styles/style.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	/* ~~~~~~~~~~ Deregister WP Embed ~~~~~~~~~~ */

	function my_deregister_scripts(){
	  	wp_deregister_script( 'wp-embed' );
	}

	add_action( 'wp_footer', 'my_deregister_scripts' );


	/* ~~~~~~~~~~ Disable WP Emoji ~~~~~~~~~~ */

	function disable_wp_emojicons() {
	  	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	  	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	  	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	  	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	  	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	  	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	  	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	  	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
	}
	add_action( 'init', 'disable_wp_emojicons' );

	function disable_emojicons_tinymce( $plugins ) {
	  	if ( is_array( $plugins ) ) {
	    	return array_diff( $plugins, array( 'wpemoji' ) );
	  	} else {
	    	return array();
	  	}
	}


	/* ~~~~~~~~~~ Add Fancybox attribute to WordPress Gallery ~~~~~~~~~~ */

	add_filter('wp_get_attachment_link', 'crunch_add_rel_attribute');
	function crunch_add_rel_attribute($link) {
		global $post;
		return str_replace('<a href', '<a data-fancybox="group" href', $link);
	}


	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	/* ~~~~~~~~~~ Required functions ~~~~~~~~~ */
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

    require_once('inc/enqueue-scripts.php');
    require_once('inc/required-plugins-init.php');
    require_once('inc/bs4navwalker.php');
    require_once('inc/custom-functions.php');
    require_once('inc/shortcodes.php');

?>
