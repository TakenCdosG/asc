<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
if( !function_exists( 'cobalt_widget_tag_cloud_args' ) ){
	function cobalt_widget_tag_cloud_args( $args ) {
		$args['format']	=	'list';
		$args['largest']	=	15;
		return $args;
	}
	add_filter( 'widget_tag_cloud_args' , 'cobalt_widget_tag_cloud_args', 100, 1);
}

if( !function_exists( 'cobalt_post_class' ) ){
	function cobalt_post_class( $classes ) {
		return $classes;
	}
	add_filter( 'post_class' , 'cobalt_post_class', 100, 1);
}

if( !function_exists( 'cobalt_register_cpt_portfolio' ) ){
	/**
	 * Adding the Portfolio post type.
	 */
	function cobalt_register_cpt_portfolio() {
		$args	=	array(
			'label' => __('Portfolios','cobalt'),
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'portfolio' , 'with_front' => true),
			'query_var' => true,
			'has_archive' => false,
			'supports' => array('title','editor','comments','thumbnail','excerpt','trackbacks','publicize'),
			'menu_icon'	=>	'dashicons-portfolio',
			'labels' => array (
				'name' => __('Portfolios','cobalt'),
				'singular_name' => __('Portfolios','cobalt'),
				'menu_name' => __('Portfolios','cobalt'),
				'add_new' => __('Add Portfolios','cobalt'),
				'add_new_item' => __('Add New Portfolios','cobalt'),
				'edit' => 'Edit',
				'edit_item' => __('Edit Portfolios','cobalt'),
				'new_item' => __('New Portfolios','cobalt'),
				'view' => __('View Portfolios','cobalt'),
				'view_item' => __('View Portfolios','cobalt'),
				'search_items' => __('Search Portfolios','cobalt'),
				'not_found' => __('No Portfolios Found','cobalt'),
				'not_found_in_trash' => __('No Portfolios Found in Trash','cobalt'),
				'parent' => __('Parent Portfolios','cobalt'),
			)
		);
		register_post_type('portfolio', apply_filters( 'cobalt_cpt_portfolio_args' , $args) );
	}
	add_action('init', 'cobalt_register_cpt_portfolio');
}

if( !function_exists( 'cobalt_register_cpt_testimonial' ) ){
	function cobalt_register_cpt_testimonial() {
		$args = apply_filters( 'cobalt_cpt_testimonial_args' , array(
			'label' => __('Testimonials','cobalt'),
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'testimonial', 'with_front' => true),
			'query_var' => true,
			'exclude_from_search' => true,
			'supports' => array('title','editor','thumbnail','publicize'),
			'menu_icon'	=>	'dashicons-testimonial',
			'labels' => array (
				'name' => __('Testimonials','cobalt'),
				'singular_name' => __('Testimonials','cobalt'),
				'menu_name' => __('Testimonials','cobalt'),
				'add_new' => __('Add Testimonials','cobalt'),
				'add_new_item' => __('Add New Testimonials','cobalt'),
				'edit' => __('Edit','cobalt'),
				'edit_item' => __('Edit Testimonials','cobalt'),
				'new_item' => __('New Testimonials','cobalt'),
				'view' => __('View Testimonials','cobalt'),
				'view_item' => __('View Testimonials','cobalt'),
				'search_items' => __('Search Testimonials','cobalt'),
				'not_found' => __('No Testimonials Found','cobalt'),
				'not_found_in_trash' => __('No Testimonials Found in Trash','cobalt'),
				'parent' => __('Parent Testimonials','cobalt'),
			)
		));
		register_post_type('testimonial', $args);
	}	
	add_action('init', 'cobalt_register_cpt_testimonial');
}
/**
if( !function_exists( 'cobalt_register_cpt_team' ) ){
	function cobalt_register_cpt_team() {
		$args = apply_filters( 'cobalt_cpt_team_args' , array(
			'label' => __('Teams','cobalt'),
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'team', 'with_front' => true),
			'query_var' => true,
			'exclude_from_search' => true,
			'supports' => array('title','editor','thumbnail'),
			'menu_icon'	=>	'dashicons-groups',
			'labels' => array (
				'name' => __('Teams','cobalt'),
				'singular_name' => __('Teams','cobalt'),
				'menu_name' => __('Teams','cobalt'),
				'add_new' => __('Add Teams','cobalt'),
				'add_new_item' => __('Add New Teams','cobalt'),
				'edit' => __('Edit','cobalt'),
				'edit_item' => __('Edit Teams','cobalt'),
				'new_item' => __('New Teams','cobalt'),
				'view' => __('View Teams','cobalt'),
				'view_item' => __('View Teams','cobalt'),
				'search_items' => __('Search Teams','cobalt'),
				'not_found' => __('No Teams Found','cobalt'),
				'not_found_in_trash' => __('No Teams Found in Trash','cobalt'),
				'parent' => __('Parent Teams','cobalt'),
			)
		));
		register_post_type('team', $args);
	}
	add_action('init', 'cobalt_register_cpt_team');
}
**/
if( !function_exists( 'cobalt_register_portfolio_category' ) ){
	function cobalt_register_portfolio_category() {
		$labels = array(
			'name'              => __( 'Portfolio Category', 'cobalt' ),
			'singular_name'     => __( 'Portfolio Category', 'cobalt' ),
			'search_items'      => __( 'Search Category','cobalt' ),
			'all_items'         => __( 'All Category','cobalt' ),
			'parent_item'       => __( 'Parent Category','cobalt' ),
			'parent_item_colon' => __( 'Parent Category:','cobalt' ),
			'edit_item'         => __( 'Edit Category','cobalt' ),
			'update_item'       => __( 'Update Category','cobalt' ),
			'add_new_item'      => __( 'Add New Category','cobalt' ),
			'new_item_name'     => __( 'New Category','cobalt' ),
			'menu_name'         => __( 'Portfolio Category','cobalt' ),
		);
		$tax_args = 		array( 'hierarchical' => true,
			'label' => __('Portfolio Category','cobalt'),
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'portfolio_category' ),
			'show_admin_column' => true,
			'labels' => $labels
		);
		register_taxonomy( 'portfolio_category',array ( 0 => 'portfolio'), apply_filters( 'cobalt_tax_portfolio_category_args' , $tax_args) );
	}
	add_action( 'init' , 'cobalt_register_portfolio_category');
}

if( !function_exists( 'cobalt_register_testimonial_group' ) ){
	function cobalt_register_testimonial_group() {
		$labels = array(
			'name'              => __( 'Group', 'cobalt' ),
			'singular_name'     => __( 'Group', 'cobalt' ),
			'search_items'      => __( 'Search Group','cobalt' ),
			'all_items'         => __( 'All Group','cobalt' ),
			'parent_item'       => __( 'Parent Group','cobalt' ),
			'parent_item_colon' => __( 'Parent Group:','cobalt' ),
			'edit_item'         => __( 'Edit Group','cobalt' ),
			'update_item'       => __( 'Update Group','cobalt' ),
			'add_new_item'      => __( 'Add New Group','cobalt' ),
			'new_item_name'     => __( 'New Group','cobalt' ),
			'menu_name'         => __( 'Group','cobalt' ),
		);
		$tax_args = 		array( 'hierarchical' => true,
			'label' => __('Group','cobalt'),
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'testimonial_group' ),
			'show_admin_column' => true,
			'labels' => $labels
		);
		register_taxonomy( 'testimonial_group',array ( 0 => 'testimonial'), apply_filters( 'cobalt_tax_testimonial_group_args' , $tax_args) );
	}
	add_action( 'init' , 'cobalt_register_testimonial_group');
}

if( !function_exists( 'cobalt_get_gmap_marker' ) ){
	/**
	 * Get gmap marker image;
	 * @return string
	 */
	function cobalt_get_gmap_marker() {
		global $cobalttheme;
		if( empty( $cobalttheme['gmap_marker'] ) ){
			return get_template_directory_uri() . '/assets/images/marker.png';
		}
		else{
			$marker_url = $cobalttheme['gmap_marker'];
			return $marker_url['url'];
		}
	}
}

if( !function_exists( 'cobalt_get_gmap_lat' ) ){
	function cobalt_get_gmap_lat() {
		global $cobalttheme;
		if( !empty( $cobalttheme['gmap_lat'] ) )
			return esc_attr( $cobalttheme['gmap_lat'] );
		return;
	}
}

if( !function_exists( 'cobalt_get_gmap_lng' ) ){
	function cobalt_get_gmap_lng() {
		global $cobalttheme;
		if( !empty( $cobalttheme['gmap_lng'] ) )
			return esc_attr( $cobalttheme['gmap_lng'] );
		return;
	}
}

if( !function_exists( 'cobalt_get_gmap_zoom' ) ){
	function cobalt_get_gmap_zoom() {
		global $cobalttheme;
		if( !empty( $cobalttheme['gmap_zoom'] ) ){
			return ($cobalttheme['gmap_zoom']) > 0 ? absint( $cobalttheme['gmap_zoom'] ) : 14;
		}
		else return 14;
	}
}

if( !function_exists( 'cobalt_get_gmap_center' ) ){
	function cobalt_get_gmap_center() {
		$lat = $lng = '';
		global $cobalttheme;
		if( !empty( $cobalttheme['gmap_center'] ) )
			return explode( "," , $cobalttheme['gmap_center']);
		else{
			$lat = function_exists( 'cobalt_get_gmap_lat' ) ? cobalt_get_gmap_lat() : '';
			$lng = function_exists( 'cobalt_get_gmap_lng' ) ? cobalt_get_gmap_lng() : '';
			return array( $lat, $lng );
		}
	}
}

if( !function_exists( 'cobalt_get_preloader_image' ) ){
	function cobalt_get_preloader_image() {
		global $cobalttheme;
		if( isset( $cobalttheme ) ){
			$preloader_active	=	( isset( $cobalttheme['preloader_active'] ) && $cobalttheme['preloader_active'] == 1 ) ? true : false;
			if( $preloader_active === true && !empty( $cobalttheme['preloader']['url'] ) ){
				$preloader	=	$cobalttheme['preloader']['url'];
				print '<div class="preloader">';
					print '<img alt="preloader" src="'.$preloader.'">';
				print '</div>';
			}			
		}
		else{
			print '<div class="preloader"></div>';
		}
	}
}

if( !function_exists( 'cobalt_get_logo' ) ){
	function cobalt_get_logo() {
		if( get_header_image() ){
			?>
			<a class="logo" href="<?php print home_url();?>"><img alt="" src="<?php header_image(); ?>"></a>
			<?php 
		}
		else{
			?>
				<h1><a class="logo" href="<?php print home_url();?>"><?php bloginfo( 'name' );?></a></h1>
			<?php 
		}
	}
}

if( !function_exists('cobalt_socials_provider') ){
	function cobalt_socials_provider() {
		$social_array = array(
			'facebook'	=>	__('Facebook','cobalt'),
			'twitter'	=>	__('Twitter','cobalt'),
			'google-plus'	=>	__('Google Plus','cobalt'),
			'pinterest'		=>	__('Pinterest','cobalt'),
			'instagram'	=>	__('Instagram','cobalt'),
			'linkedin'	=>	__('Linkedin','cobalt'),
			'tumblr'	=>	__('Tumblr','cobalt'),
			'youtube'	=>	__('Youtube','cobalt'),
			'vimeo-square'	=>	__('Vimeo','cobalt')
		);
		return apply_filters( 'cobalt_socials_provider' , $social_array);
	}
}

if( !function_exists( 'cobalt_get_testimonial_rating' ) ){
	/**
	 * Get the star rating
	 * @param int $testimonial_id
	 * return html;
	 */
	function cobalt_get_testimonial_rating( $testimonial_id ) {
		$prefix = apply_filters( 'cobalt_testimonial_prefix' , 'testimonial_');
		$star	=	apply_filters( 'cobalt_star_rating_number' , 5);
		$rating = get_post_meta( $testimonial_id, $prefix . 'rating', true );
		$rating	=	absint( $rating );
		if( $rating > $star )
			$rating	=	$star;
		if( !$rating || $rating == 0 )
			return;
		$unrate	=	$star - $rating;
		?>
			<ul class="star-rate">
				<li><span><?php _e('Client Rating:','cobalt');?></span></li>
				<?php 
					for ($i = 0; $i < $rating; $i++) {
						?><li><a href="#"><i class="fa fa-star"></i></a></li><?php 
					}
					if( $unrate > 0 ){
						for ($i = 0; $i < $unrate; $i++) {
							?><li><a class="unchecked" href="#"><i class="fa fa-star-o"></i></a></li><?php 
						}
					}
				?>
			</ul>		
		<?php 
	}
}

if( !function_exists( 'cobalt_hide_js_composer_noted' ) ){
	function cobalt_hide_js_composer_noted() {
		if( !function_exists( 'vc_set_as_theme' ) )
			return;
		vc_set_as_theme(true);
	}
	add_action( 'init', 'cobalt_hide_js_composer_noted' );
}
if( !function_exists( 'cobalt_set_vc_composer_template' ) ){
	function cobalt_set_vc_composer_template() {
		if( !function_exists( 'vc_set_shortcodes_templates_dir' ) )
			return;
		$dir = get_template_directory() . '/page-templates/js_composer/';
		vc_set_shortcodes_templates_dir($dir);
	}
	add_action( 'init' , 'cobalt_set_vc_composer_template');
}

if( !function_exists( 'testimonial_group_attr' ) ){

	/**
	 * post_category_attr
	 * @param array $settings
	 * @param string_type $value
	 * @return string
	 */
	function testimonial_group_attr( $settings, $value ){
		$html = null;
		$dependency = function_exists( 'vc_generate_dependencies_attributes' ) ?  vc_generate_dependencies_attributes($settings) : '';
		$html .= '<div class="post_category_attr">';
		$args = array(
			'show_option_all'    => __('All','cobalt'),
			'orderby'            => 'ID',
			'order'              => 'ASC',
			'show_count'         => 1,
			'hide_empty'         => 1,
			'child_of'           => 0,
			'echo'               => 0,
			'selected'           => $value,
			'hierarchical'       => 0,
			'name'               => $settings['param_name'],
			'id'                 => $settings['param_name'],
			'class'              => 'wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'_field',
			'taxonomy'           => 'testimonial_group',
			'hide_if_empty'      => true,
		);
		$html .= wp_dropdown_categories( $args );
		$html .= '</div>';
		return $html;
	}
	if( function_exists( 'add_shortcode_param' ) ){
		add_shortcode_param( 'testimonial_group' , 'testimonial_group_attr');
	}
}

if( !function_exists( 'cobalt_vc_fontawesome_attr' ) ){
	function cobalt_vc_fontawesome_attr( $settings, $value ) {
		$html = null;
		if( !function_exists( 'ebor_icons_list' ) ){
			require 'awesomeicon-array.php';
		}
		$icon_array = ebor_icons_list();
		$dependency = function_exists( 'vc_generate_dependencies_attributes' ) ?  vc_generate_dependencies_attributes($settings) : '';
		$html .= '<div class="vc_fontawesome_attr">';
		$html .= '<select name="'.$settings['param_name'].'" id="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'_field">';
		foreach ( $icon_array  as $k=>$v) {
			$html .= '<option '.selected( $value, $k, false ).' value="'.$k.'">'.$v.'</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		return $html;
	}
	if( function_exists( 'add_shortcode_param' ) ){
		add_shortcode_param( 'fontawesome' , 'cobalt_vc_fontawesome_attr');
	}	
}

if( !function_exists( 'cobalt_testimonial_group_attr' ) ){
	function cobalt_testimonial_group_attr( $settings, $value ) {
		$html = null;
		$dependency =  function_exists( 'vc_generate_dependencies_attributes' ) ? vc_generate_dependencies_attributes($settings) : '';
		$html .= '<div class="cobalt_testimonial_group_attr">';
		$args = array(
			'show_option_all'    => __('All','cobalt'),
			//'show_option_none'	=>	__('None','cobalt'),
			'orderby'            => 'ID',
			'order'              => 'ASC',
			'show_count'         => 1,
			'hide_empty'         => 1,
			'child_of'           => 0,
			'echo'               => 0,
			'selected'           => $value,
			'hierarchical'       => 0,
			'name'               => $settings['param_name'],
			'id'                 => $settings['param_name'],
			'class'              => 'wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'_field',
			'taxonomy'           => 'testimonial_group',
			'hide_if_empty'      => true,
		);
		$html .= wp_dropdown_categories( apply_filters( 'cobalt_testimonial_group_attr_args' , $args) );
		$html .= '</div>';
		return $html;		
	}
	if( function_exists( 'add_shortcode_param' ) ){
		add_shortcode_param( 'testimonial_group' , 'cobalt_testimonial_group_attr');
	}	
}

if( !function_exists( 'cobalt_get_column_size' ) ){
	function cobalt_get_column_size( $area = 'main' ) {
		$sidebar_size	=	4;
		$main_size	=	apply_filters( 'cobalt_main_column_size' , 8);
		if( is_integer( $main_size ) && $main_size < 12 ){
			$sidebar_size = 12 - $main_size;
		}
		if( $area == 'sidebar' )
			return $sidebar_size;
		return $main_size;
	}
}

if( !function_exists( 'cobalt_get_post_archive_link' ) ){
	/**
	 * Get the post archive link.
	 * return the link.
	 * @param int $post_id
	 */
	function cobalt_get_post_archive_link( $post_id ) {
		if( !$post_id )
			return;
		$post_day = get_the_date('d', $post_id);
		$post_month = get_the_date('m', $post_id);
		$post_year = get_the_date('Y', $post_id);
		$date_archive_link	=	get_day_link($post_year, $post_month, $post_day);
		return $date_archive_link;
	}
}

if( !function_exists( 'cobalt_temp_pre_query' ) ){
	function cobalt_temp_pre_query( $args ) {
		global $post;
		$prefix_pre_query = 'pre_query_';
		if( is_page() ){
			$post_type	=	$args['post_type'];
			
			$ignore_sticky_posts	=	get_post_meta( $post->ID, $prefix_pre_query . 'ignore_sticky_posts', true );
			$post__in				=	get_post_meta( $post->ID, $prefix_pre_query . 'post__in', true );
			$post__not_in			=	get_post_meta( $post->ID, $prefix_pre_query . 'post__not_in', true );
			$category__in			=	get_post_meta( $post->ID, $prefix_pre_query . 'category__in', true );
			$category__not_in		=	get_post_meta( $post->ID, $prefix_pre_query . 'category__not_in', true );
			$tag__in				=	get_post_meta( $post->ID, $prefix_pre_query . 'tag__in', true );
			$tag__not_in			=	get_post_meta( $post->ID, $prefix_pre_query . 'tag__not_in', true );
			$orderby				=	get_post_meta( $post->ID, $prefix_pre_query . 'orderby', true );
			$order					=	get_post_meta( $post->ID, $prefix_pre_query . 'order', true );
			$showposts				=	get_post_meta( $post->ID, $prefix_pre_query . 'showposts', true );
			
			if( $ignore_sticky_posts == 'on' && $post_type == 'post' ){
				$args['ignore_sticky_posts']	=	$ignore_sticky_posts;
			}
			if( !empty( $post__in ) ){
				$post__in	=	explode(",", $post__in);
				if( is_array( $post__in ) ){
					$args['post__in']	=	$post__in;
				}
			}
			if( !empty( $post__not_in ) ){
				$post__not_in	=	explode(",", $post__not_in);
				if( is_array( $post__not_in ) ){
					$args['post__not_in']	=	$post__not_in;
				}
			}
			if( !empty( $category__in ) ){
				$category__in	=	explode(",", $category__in);
				if( is_array( $category__in ) ){
					if( $post_type == 'post' ){
						$args['category__in']	=	$category__in;
					}
					else{
						$args['tax_query'][] = array(
								'taxonomy' => 'portfolio_category',
								'field' => 'id',
								'terms' => $category__in
						);
					}
				}
			}
			if( !empty( $category__not_in ) ){
				$category__not_in	=	explode(",", $category__not_in);
				if( is_array( $category__not_in ) ){
					if( $post_type == 'post' ){
						$args['category__not_in']	=	$category__not_in;
					}
					else{
						$args['tax_query'][] = array(
							'taxonomy' => 'portfolio_category',
							'field' => 'id',
							'terms' => $category__not_in,
							'operator'	=>	'NOT IN'
						);
					}
				}
			}
			if( $post_type == 'post' ){
				if( !empty( $tag__in ) ){
					$tag__in	=	explode(",", $tag__in);
					if( is_array( $tag__in ) ){
						$args['tag__in']	=	$tag__in;
					}
				}
				if( !empty( $tag__not_in ) ){
					$tag__not_in	=	explode(",", $tag__not_in);
					if( is_array( $tag__not_in ) ){
						$args['tag__not_in']	=	$tag__not_in;
					}
				}
			}
			
			if( !empty( $orderby ) ){
				$args['orderby']	=	$orderby;
			}
			if( !empty( $order ) ){
				$args['order']	=	$order;
			}
			if( !empty( $showposts ) && $showposts != 0 ){
				$args['showposts']	=	$showposts;
			}
			return $args;	
		}
	}
	add_filter( 'cobalt_post_data_args' , 'cobalt_temp_pre_query', 20, 1);
}

if( !function_exists( 'cobalt_get_paged' ) ){
	function cobalt_get_paged() {
		$paged = 1;
		$paged	=	get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) :  ( get_query_var( 'page' ) ? intval( get_query_var( 'page' ) ) : 1 ) ;
		return $paged;
	}	
}

if( !function_exists( 'cobalt_post_pre_query' ) ){
	/**
	 * Only display the post in search results page.
	 * @param unknown_type $query
	 * @return unknown
	 */
	function cobalt_post_pre_query( $query ) {
		global $cobalttheme;
		$post_search	=	( isset( $cobalttheme['post_search'] ) && $cobalttheme['post_search'] == 1 ) ? true : false;
		if( $post_search === true && $query->is_main_query() && is_search() ){
			$query->set('post_type', 'post');
		}
		return $query;
	}
	add_action( 'pre_get_posts', 'cobalt_post_pre_query' );
}

if( !function_exists( 'cobalt_clean_jetpack_sharing_buttons' ) ){
	function cobalt_clean_jetpack_sharing_buttons() {
		if( !is_single() && function_exists( 'sharing_display' ) && apply_filters( 'cobalt_clean_jetpack_sharing_buttons' , true ) === true ){
			remove_filter( 'the_content', 'sharing_display', 19 );
			remove_filter( 'the_excerpt', 'sharing_display', 19 );			
		}
	}
	add_action( 'wp' , 'cobalt_clean_jetpack_sharing_buttons', 20);
}