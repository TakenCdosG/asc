<?php
if( !defined('ABSPATH') ) exit;
// Write your functions here.

// Custom post type function
/*function create_news_posttype() {

	register_post_type( 'ascnews',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'News' ),
				'singular_name' => __( 'News' )
			),
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
			'public' => true,
			'show_in_admin_bar' => true,
			'has_archive' => true,
			'capability_type' => 'post',
			'rewrite' => array('slug' => 'news'),
			'register_meta_box_cb' => 'advanced_options_metabox',
		)
	);
}

function advanced_options_metabox() {
	add_meta_box('post_advanced_options', 'Advanced Options', '', 'ascnews', 'normal', 'default');
}

// Hooking up function to theme setup
add_action( 'init', 'create_news_posttype' );*/

wp_enqueue_style( 'editor', get_stylesheet_directory_uri() . '/editor-style.css' );