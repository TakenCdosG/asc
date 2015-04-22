<?php
if( !defined('ABSPATH') ) exit;
// Write your functions here.

// Custom post type function
function create_timeline_posttype() {

	register_post_type( 'timeline',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Timeline' ),
				'singular_name' => __( 'Timeline' )
			),
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
			'public' => true,
			'show_in_admin_bar' => true,
			'has_archive' => true,
			'capability_type' => 'post',
			'rewrite' => array('slug' => 'timeline'),
		)
	);
}

// Shortcode: [bb-timeline]
function build_timeline( $attr ) {
	$structure = '<div class="bb-custom-wrapper"><div id="bb-bookblock" class="bb-bookblock">';
	
	// The Query
	$args = array(
		'post_type' => 'timeline',
		'meta_key' => 'page_date',
		'order' => 'ASC',
		'orderby' => 'page_date'
	);
	$the_query = new WP_Query( $args );
	
	// The Loop
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$structure .= '<div class="bb-item">';
			//$structure .= '<h3 class="timeline-title">' . get_the_title() . '</h3>';
			$structure .= '<div class="timeline-content">' . get_the_content() . '</div>';
			$structure .= '</div>';
		}
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	$structure .= '</div><nav>'
				. '<a id="bb-nav-first" href="#" class="bb-custom-icon bb-custom-icon-first">First page</a>'
				. '<a id="bb-nav-prev" href="#" class="bb-custom-icon bb-custom-icon-arrow-left">Previous</a>'
				. '<a id="bb-nav-next" href="#" class="bb-custom-icon bb-custom-icon-arrow-right">Next</a>'
				. '<a id="bb-nav-last" href="#" class="bb-custom-icon bb-custom-icon-last">Last page</a></nav></div>';
	
	return $structure;
}

// Hooking up function to create the Timeline post type
add_action( 'init', 'create_timeline_posttype' );

// Shortcode generator for the Bookblock timeline
add_shortcode( 'bb-timeline', 'build_timeline' );

// Advanced TinyMCE editor styles
wp_enqueue_style( 'editor', get_stylesheet_directory_uri() . '/editor-style.css' );

// Booblock styles
wp_enqueue_style( 'bookblock', get_stylesheet_directory_uri() . '/css/bookblock/bookblock.css' );
wp_enqueue_style( 'bookblock-default', get_stylesheet_directory_uri() . '/css/bookblock/default.css' );

// Bookblock scripts
wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/js/bookblock/modernizr.custom.js', array('jquery'), null );
wp_enqueue_script( 'jquerypp', get_stylesheet_directory_uri() . '/js/bookblock/jquerypp.custom.js', array('jquery'), null );
wp_enqueue_script( 'jquery-bookblock', get_stylesheet_directory_uri() . '/js/bookblock/jquery.bookblock.min.js', array('jquery'), null );
wp_enqueue_script( 'timeline-script', get_stylesheet_directory_uri() . '/js/timeline-script.js', array('jquery'), null );