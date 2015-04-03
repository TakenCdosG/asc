<?php
if( !defined('ABSPATH') ) exit;
if( !class_exists( 'Cobalt_MetaBox' ) ){
	class Cobalt_MetaBox {
		function __construct() {
			add_action( 'init' , array( $this ,'load_cmb_Meta_Box' ), 9999);
			add_filter( 'cmb_meta_boxes', array( $this ,'metaboxes' ) );
		}
		function load_cmb_Meta_Box(){
			if ( ! class_exists( 'cmb_Meta_Box' ) )
				require_once ( get_template_directory() . '/includes/metaboxs/init.php');		
		}
		function metaboxes( array $meta_boxes ){
			// testimonial.
			$prefix = apply_filters( 'cobalt_testimonial_prefix' , 'testimonial_');
			$star	=	apply_filters( 'cobalt_star_rating_number' , 5);
			$meta_boxes['testimonial'] = array(
				'id'         => 'testimonial',
				'title'      => __( 'Testimonial', 'cobalt' ),
				'pages'      => array( 'testimonial' ), // Post type
				'context'    => 'normal',
				'priority'   => 'default',
				'show_names' => true, // Show field names on the left
				'fields'     => array(					
					array(
						'name'       => __( 'Position', 'neat' ),
						'id'         => $prefix . 'position',
						'type'       => 'text'
					),
					array(
						'name'       => __( 'Website', 'neat' ),
						'id'         => $prefix . 'website',
						'type'       => 'text'
					),
					array(
						'name'       => __( 'Rating', 'neat' ),
						'id'         => $prefix . 'rating',
						'type'       => 'text_small',
						'description'	=> sprintf( __('Put a number, smaller than %s','cobalt'), $star )
					)
				)
			);	
			
			$meta_boxes['post_advanced_options'] = array(
				'id'         => 'post_advanced_options',
				'title'      => __( 'Advanced Options', 'cobalt' ),
				'pages'      => array( 'post','portfolio', 'page' ), // Post type
				'context'    => 'normal',
				'priority'   => 'default',
				'show_names' => true, // Show field names on the left
				'fields'     => array(
					array(
						'name'       => __( 'Layout', 'cobalt' ),
						'id'         => 'post_layout',
						'type'       => 'select',
						'description'	=>	__('This option is only available for the Post/Blog','cobalt'),
						'options' => array(
							'normal'		=> __( 'Default', 'cobalt' ),
							'r_sidebar'		=> __( 'Right Sidebar', 'cobalt' ),
							'fullwidth'		=> __( 'Fullwidth', 'cobalt' )
						)
					),
					array(
						'name'       => __( 'Do not display the background', 'cobalt' ),
						'id'         => 'is_background',
						'type'       => 'checkbox',
						'description'	=>	__('The theme display the background by default for the regular post, portfolio and static page.','cobalt')
					),
					array(
						'name'       => __( 'Background', 'cobalt' ),
						'id'         => 'page_background',
						'description'	=>	__('The theme use the Featured image to set the background, but you can override it here.','cobalt'),
						'type'       => 'file'
					)
				)
			);
			$prefix_pre_query = 'pre_query_';
			$meta_boxes['page_pre_query'] = array(
				'id'         => 'page_pre_query',
				'title'      => __( 'Pre Query - This feature will affect to the Blog/Portfolio Template.', 'cobalt' ),
				'pages'      => array( 'page' ), // Post type
				'context'    => 'normal',
				'priority'   => 'default',
				'show_names' => true, // Show field names on the left
				'fields'     => array(
					array(
						'name'       => __( 'Ignore sticky posts', 'cobalt' ),
						'id'         => $prefix_pre_query .'ignore_sticky_posts',
						'type'       => 'checkbox'
					),
					array(
						'name'       => __( 'Post In', 'cobalt' ),
						'id'         => $prefix_pre_query .'post__in',
						'type'       => 'text',
						'description'	=>	__('Use post ids. Specify posts to retrieve, example: 3,5,7,8','colbat')
					),
					array(
						'name'       => __( 'Post Not In', 'cobalt' ),
						'id'         => $prefix_pre_query .'post__not_in',
						'type'       => 'text',
						'description'	=>	__('Use post ids. Specify posts NOT to retrieve, example: 3,5,7,8','colbat')
					),
					array(
						'name'       => __( 'Category In', 'cobalt' ),
						'id'         => $prefix_pre_query .'category__in',
						'type'       => 'text',
						'description'	=>	__('Use category ids. Specify Category to retrieve, example: 3,5,7,8','colbat')
					),						
					array(
						'name'       => __( 'Category Not In', 'cobalt' ),
						'id'         => $prefix_pre_query .'category__not_in',
						'type'       => 'text',
						'description'	=>	__('Use category ids. Specify Category NOT to retrieve, example: 3,5,7,8','colbat')
					),
					array(
						'name'       => __( 'Tags In', 'cobalt' ),
						'id'         => $prefix_pre_query .'tag__in',
						'type'       => 'text',
						'description'	=>	__('Use Tag ids. Specify Tag to retrieve, example: 3,5,7,8','colbat')
					),
					array(
						'name'       => __( 'Tags Not In', 'cobalt' ),
						'id'         => $prefix_pre_query .'tag__not_in',
						'type'       => 'text',
						'description'	=>	__('Use Tag ids. Specify Tag NOT to retrieve, example: 3,5,7,8','colbat')
					),
					array(
						'name'       => __( 'Order by', 'cobalt' ),
						'id'         => $prefix_pre_query .'orderby',
						'type'       => 'select',
						'options'	=>	array(
							''		=>	__('Default','cobalt'),
							'ID'	=>	__('Order by Post ID','colbat'),
							'author'	=>	__('Order by author','colbat'),
							'title'	=>	__('Order by Title','colbat'),
							'name'	=>	__('Order by Post name (Post slug)','colbat'),
							'date'	=>	__('Order by Date','colbat'),
							'modified'	=>	__('Order by last modified date','colbat'),
							'rand'	=>	__('Order by Random','colbat')
						)
					),
					array(
						'name'       => __( 'Order', 'cobalt' ),
						'id'         => $prefix_pre_query .'order',
						'type'       => 'select',
						'options'	=>	array(
							''		=>	__('Default','cobalt'),
							'DESC'	=>	__('DESC','colbat'),
							'ASC'	=>	__('ASC','colbat'),
						)
					),
					array(
						'name'       => __( 'Show posts', 'cobalt' ),
						'id'         => $prefix_pre_query . 'showposts',
						'type'       => 'text_small',
						'default'	=>	get_option( 'posts_per_page' )
					)
				)
			);			
			
			return $meta_boxes;
		}
	}
	new Cobalt_MetaBox();
}