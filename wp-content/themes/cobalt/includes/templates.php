<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
/**
 * Template APIs.
 */
if( !function_exists( 'cobalt_breadcrumb' ) ){
	function cobalt_breadcrumb() {
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		}
	}
	add_action( 'cobalt_breadcrumb' , 'cobalt_breadcrumb', 10);
}

if( !function_exists('cobalt_wp_title') && !function_exists( '_wp_render_title_tag' ) ){
	function cobalt_wp_title( $title, $sep ) {
		global $paged, $page;
		if ( is_feed() )
			return $title;

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'cobalt' ), max( $paged, $page ) );

		return $title;
	}
	add_filter( 'wp_title', 'cobalt_wp_title', 10, 2 );
}

/**
 * Hooking into the template.
 */
if( !function_exists( 'cobalt_post_meta_category' ) ){
	/**
	 * Display the Category.
	 */
	function cobalt_post_meta_category() {
		global $post;
		$post_type	=	get_post_type( $post );
		switch ( $post_type ) {
			case 'portfolio':
				if( has_term( '', 'portfolio_category', $post->ID ) ){
					print '<div class="project-meta">';
						the_terms($post->ID, 'portfolio_category','<span>', '</span> / <span>', '</span>');
					print '</div>';
				}
			break;
			
			default:
				$layout = apply_filters( 'cobalt_singlepost_layout' , $post->ID);
				if(  !in_array( $layout , array( 'normal','fullwidth' )) && is_single() )
					return;
				?>
				<div class="post-meta">	
					<span class="autor"><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php print get_the_author_meta('display_name');?></a></span>
					<?php if( has_category(null, $post->ID) ):?>
						<span class="category"><i class="fa fa-folder-open"></i> <?php the_category(', ');?></span>
					<?php endif;?>			
					<span class="date"><i class="fa fa-clock-o"></i> <a href="<?php print cobalt_get_post_archive_link( $post->ID );?>"><?php print get_the_date('', $post->ID);?></a></span>
				</div>
				<?php 
			break;
		}	
	}
	add_action( 'cobalt_post_meta' , 'cobalt_post_meta_category', 10);
}

if( !function_exists( 'cobalt_post_info' ) ){
	/**
	 * Display the post info on right sidebar.
	 */
	function cobalt_post_info() {
		global $post;
		?>
			<div class="info-widget sidebar-widget">
				<ul class="post-tags">
					<li class="post-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="fa fa-user"></i><?php print get_the_author_meta('display_name');?></a></li>
					<li class="post-date"><a href="<?php print cobalt_get_post_archive_link( $post->ID );?>"><i class="fa fa-calendar"></i><?php print get_the_date();?></a></li>
					<?php if( is_single() && has_category('', $post->ID) ):?>
						<li class="post-categories"><i class="fa fa-folder"></i> <?php the_category( ', ' );?></li>
					<?php endif;?>
					<?php if( comments_open( $post->ID ) ):?>
						<li class="post-comments"><a href="<?php comments_link();?>"><i class="fa fa-comment"></i><?php comments_number( __('No comment','cobalt'), __('1 comment','cobalt'), __('% comments','cobalt') ); ?></a></li>
					<?php endif;?>
				</ul>
			</div>
		<?php 
	}
	add_action( 'cobalt_post_right_side' , 'cobalt_post_info', 10);
}

if( !function_exists( 'cobalt_post_tags' ) ){
	/**
	 * Display the post tags.
	 */
	function cobalt_post_tags() {
		global $post;
		if( has_tag( '', $post->ID ) ):
		?>
			<div class="widget_tag_cloud sidebar-widget">
				<h2 class="widget-title"><?php _e('Tags:','cobalt');?></h2>
				<?php the_tags('<ul class="tags-list-post"><li>','</li><li>','</li></ul>');?>
			</div>
		<?php 
		endif;
	}
	add_action( 'cobalt_post_right_side' , 'cobalt_post_tags', 20);
}

if( !function_exists( 'cobalt_navigation' ) ){
	/**
	 * Display the page navigation.
	 * @param array $query
	 */
	function cobalt_navigation( $query = null ) {
		global $wp_query;
		
		if( function_exists( 'cobalt_nav_default' ) && apply_filters( 'cobalt_navigation_default' , false) === true ){
			return cobalt_nav_default();
		}

		if( empty( $query ) )
			$query = $wp_query;
		if ( $query->max_num_pages < 2 ) {
			return;
		}
	
		$paged	=	function_exists( 'cobalt_get_paged' ) ? cobalt_get_paged() : 1;
		
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );
		
		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}
		
		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
		
		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
		
		$args = array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 3,
			'type'	=>	'list',
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Prev', 'cobalt' ),
			'next_text' => __( 'Next &rarr;', 'cobalt' ),
		);
		
		// Set up paginated links.
		$links = paginate_links( apply_filters( 'cobalt_navigation_args' , $args) );
		
		if ( $links ) :
			$links	=	str_ireplace( 'page-numbers' , 'pagination', $links);
			echo '<div class="page-number">';
				echo $links;
			echo '</div>';
		endif;	
	}
}

if( !function_exists( 'cobalt_comment_form_top_wrapper' ) ){
	function cobalt_comment_form_top_wrapper() {
		print '<div class="row">';
	}
	add_action( 'comment_form_top' , 'cobalt_comment_form_top_wrapper', 100);
}

if( !function_exists( 'cobalt_comment_form_end_wrapper' ) ){
	function cobalt_comment_form_end_wrapper() {
		print '</div>';
	}
	add_action( 'comment_form' , 'cobalt_comment_form_end_wrapper', 100);
}

if( !function_exists( 'cobalt_comment_form_before_fields' ) ){
	function cobalt_comment_form_before_fields() {
		if( !get_current_user_id() ){
			print '<div class="col-md-4">';
		}
	}
	add_action( 'comment_form_before_fields' , 'cobalt_comment_form_before_fields', 100);
}

if( !function_exists( 'cobalt_comment_form_after_fields' ) ){
	function cobalt_comment_form_after_fields() {
		if( !get_current_user_id() ){
			print '</div>';
		}
	}
	add_action( 'comment_form_after_fields' , 'cobalt_comment_form_after_fields', 100);
}

if( !function_exists( 'cobalt_404_content' ) ){
	function cobalt_404_content() {
		global $cobalttheme;	
		?>
			<?php if( !empty( $cobalttheme['404_text'] ) ): print $cobalttheme['404_text'];endif;?>
			<?php if( !empty( $cobalttheme['404_image']['url'] ) ):?>
				<img src="<?php print $cobalttheme['404_image']['url'];?>" alt="<?php _e('404 ERROR','cobalt');?>">
			<?php else:?>
				<span><i class="fa <?php print apply_filters( 'cobalt_404_icon' , 'fa-question-circle');?>"></i></span>
			<?php endif;?>
			<h1 class="error-title">
				<?php
				if( !empty( $cobalttheme['404_title']  ) ){
					print $cobalttheme['404_title'] ;
				}
				else{
					_e('404 ERROR','cobalt');
				}
				?>
			</h1>
			<a class="goback" href="javascript: history.go(-1)"><?php _e(' &lt; Go Back','cobalt');?></a>
			<?php if( !empty( $cobalttheme['404-background'] ) && $cobalttheme['404-background'] != '#a2a2aa' ):?>
				<style>.error-page{background:<?php print esc_attr( $cobalttheme['404-background'] );?>}</style>
			<?php endif;?>
		<?php 
	}
	add_action( 'cobalt_404_content' , 'cobalt_404_content', 10);
}

if( !function_exists( 'cobalt_wp_link_pages' ) ){
	function cobalt_wp_link_pages( $content ) {
		$args = array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'cobalt' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'echo'		  => 0
		);		
		$output = wp_link_pages( apply_filters( 'cobalt_link_pages_args' , $args) );
	
		return $content . $output;
			
	}
	add_action( 'the_content' , 'cobalt_wp_link_pages', 10);
}

if( !function_exists('cobalt_add_custom_css') ){
	function cobalt_add_custom_css() {
		global $cobalttheme;
		$css = NULL;
		if( isset( $cobalttheme['custom_css'] ) && trim( $cobalttheme['custom_css'] ) != '' ){
			$css = '<style>'.$cobalttheme['custom_css'].'</style>';
		}
		print $css;
	}
	add_action('wp_head', 'cobalt_add_custom_css');
}

if( !function_exists( 'cobalt_styling' ) ){
	function cobalt_styling() {
		global $cobalttheme;
		$output = '';
		if( !empty( $cobalttheme['menu-color'] ) && $cobalttheme['menu-color'] != '#606060' ){
			$output .= 'ul.menu > li > a{color:'.esc_attr($cobalttheme['menu-color']).'}';
		}
		if( !empty( $cobalttheme['menu-hover-color'] ) && $cobalttheme['menu-hover-color'] != '#000000' ){
			$output .= 'ul.menu > li > a:hover{color:'.esc_attr($cobalttheme['menu-hover-color']).'}';
		}		
		if( !empty( $output ) ){
			print '<style>'.$output.'</style>';
		}
	}
	add_action('wp_footer', 'cobalt_styling');
}

if( !function_exists('cobalt_add_custom_js') ){
	function cobalt_add_custom_js() {
		global $cobalttheme;
		$js = NULL;
		if( isset( $cobalttheme['custom_js'] ) && trim( $cobalttheme['custom_js'] ) != '' ){
			$js .= '<script>jQuery(document).ready(function(){'.$cobalttheme['custom_js'].'});</script>';
		}
		print $js;
	}
	add_action('wp_footer', 'cobalt_add_custom_js');
}

if( !function_exists('cobalt_show_favicon') ){
	function cobalt_show_favicon() {
		global $cobalttheme;
		if( isset( $cobalttheme['favicon']['url'] ) && !empty( $cobalttheme['favicon']['url'] ) ){
			print '<link rel="shortcut icon" href="'.$cobalttheme['favicon']['url'].'">';
		}
	}
	add_action('wp_head', 'cobalt_show_favicon');
}

if( !class_exists('Cobalt_Walker_Nav_Menu') ){
	class Cobalt_Walker_Nav_Menu extends Walker_Nav_Menu {
		function start_lvl(&$output, $depth = 0, $args = array()) {
			$output .= "\n<ul class=\"dropdown\">\n";
		}
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
			$item_html = '';
			parent::start_el($item_html, $item, $depth, $args);

			if ( $item->is_dropdown && $depth === 0 ) {
				if( wp_is_mobile() ){
					$item_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown"', $item_html );
				}
				else{
					$item_html = str_replace( '<a', '<a', $item_html );
					//$item_html = str_replace( '</a>', ' <b class="caret"></b></a>', $item_html );					
				}
			}
			$output .= $item_html;
		}
		function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
			if ( $element->current )
				$element->classes[] = 'active';

			$element->is_dropdown = !empty( $children_elements[$element->ID] );

			if ( $element->is_dropdown ) {
				if ( $depth === 0 ) {
					$element->classes[] = 'drop';
				} elseif ( $depth === 1 ) {
					$element->classes[] = 'dropdown';
				}
			}
			parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
		}
	}
}

if( !function_exists( 'cobalt_singlepost_layout' ) ){
	/**
	 * Get the layout.
	 * @param unknown_type $post_id
	 */
	function cobalt_singlepost_layout( $post_id ) {
		$default = 'r_sidebar';
		if( !$post_id )
			return $default;
		$layout = get_post_meta( $post_id, 'post_layout', true ) ? get_post_meta( $post_id, 'post_layout', true ) : 'normal';
		if( !empty( $layout ) ){
			return $layout;
		}
		return $default;
	}
	add_action( 'cobalt_singlepost_layout' , 'cobalt_singlepost_layout', 10, 1);
}


if( !function_exists( 'cobalt_read_more_link' ) ){
	function cobalt_read_more_link() {
		global $post;
		return '<a class="more-link" href="' . get_permalink( $post ) . '">'.__('Read More &#187;','cobalt').'</a>';
	}	
	add_filter( 'the_content_more_link', 'cobalt_read_more_link' );
}

if( !function_exists( 'cobalt_post_format_class' ) ){
	function cobalt_post_format_class( $post_id ) {
		$class = '';
		if( !$post_id ) 
			return;
		$post_format = get_post_format( $post_id );
		switch ( $post_format ) {
			case 'video':
				$class = 'play';
			break;
			
			case 'image':
				$class = 'picture-o';
			break;
			
			case 'gallery':
				$class = 'th';
			break;
			
			case 'audio':
				$class = 'volume-up';
			break;
			
			default:
				$class = 'link';
			break;
		}
		return apply_filters( 'cobalt_post_type_icon' , $class);
	}
}

if( !function_exists( 'cobalt_set_portfolio_background' ) ){
	function cobalt_set_portfolio_background() {
		global $post;
		if( !isset( $post->ID ) )
			return;
		$src = '';
		if( apply_filters( 'cobalt_set_page_background' , true) === true ){
			$page_background = get_post_meta( $post->ID, 'page_background', true );
			$is_background	=	get_post_meta( $post->ID, 'is_background', true ) ? get_post_meta( $post->ID, 'is_background', true ) : null;
			$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
			if( ( is_page() || is_single() ) && (!empty( $page_background ) || !empty( $post_thumbnail_id ) ) && $is_background != 'on' ){
				$image_src = wp_get_attachment_url( $post_thumbnail_id, 'full' );
				if( !empty( $page_background ) ){
					$src = $page_background;
				}
				else{
					$src = $image_src;
				}
				
				$src	=	apply_filters( 'cobalt_statis_background_image' , $src);
				
				if(  $src ){
					?>
						<style>
							.blog-detail-page,
							.page-builder,
							.single-page{
								background: url('<?php print $src?>') no-repeat center center fixed;
								-webkit-background-size: cover;
								-moz-background-size: cover;
								-o-background-size: cover;
								background-size: cover;
							}
						</style>
					<?php 				
				}	
			}
		}
	}
	add_action( 'wp_footer' , 'cobalt_set_portfolio_background', 100);
}

if( !function_exists('cobalt_post_nav') ){
	function cobalt_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		?>
		 <ul class="pager">
		 	<li class="previous"><?php previous_post_link( '%link', __( '&laquo; %title', 'cobalt' ) );?></li>
			<li class="next"><?php next_post_link( '%link',  __( '%title &raquo;', 'cobalt' ) );?></li>
		</ul><!-- .nav-links -->
		<?php
	}
}

if( !function_exists( 'cobalt_remove_thumbnail_dimensions' ) ){
	function cobalt_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		return $html;
	}
	add_filter( 'post_thumbnail_html', 'cobalt_remove_thumbnail_dimensions', 10, 3 );
}

if( !function_exists( 'cobalt_nav_default' ) ){
	/**
	 * Display the default navigation.
	 */
	function cobalt_nav_default() {
		return;
	}
}