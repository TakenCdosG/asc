<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
/**
 * Archived all core functions of Cobalt theme.
 * Version 1.0.0
 * Author: Toan Nguyen
 * http://marstheme.com
 * global var: $cobalt_data
 */
if ( !isset( $content_width ) ) $content_width = 900;
// including the required libraries.
require_once ( get_template_directory() . '/includes/functions.php');
require_once ( get_template_directory() . '/includes/class-tgm-plugin-activation.php');
require_once ( get_template_directory() . '/includes/required-plugins.php');
require_once ( get_template_directory() . '/includes/class-theme-options.php');
require_once ( get_template_directory() . '/includes/class-widgets.php');
require_once ( get_template_directory() . '/includes/custom-header.php');
require_once ( get_template_directory() . '/includes/class-shortcodes.php');
require_once ( get_template_directory() . '/includes/class-vc-map.php');
require_once ( get_template_directory() . '/includes/class-metabox.php');
require_once ( get_template_directory() . '/includes/templates.php');
require_once ( get_template_directory() . '/page-templates/js_composer/custom/index.php');

if( !function_exists( 'cobalt_after_setup_theme' ) ){
	/**
	 * Do the action after setup the theme.
	 */
	function cobalt_after_setup_theme() {
		// Loading theme textdomain.
		load_theme_textdomain( 'cobalt', get_template_directory() . '/languages' );
		// Adding html5 support.
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );
		// require Jetpack installed.
		add_theme_support( 'jetpack-responsive-videos' );		
		// adding woocommerce support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'title-tag' );
		// adding menu support.
		add_theme_support('menus');
		// adding thumbnail support.
		add_theme_support('post-thumbnails');
		// adding custom background support.
		add_theme_support('custom-background', array(
			'default-color'          => '',
			'default-image'          => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		));	
		// adding post format support.
 		add_theme_support( 'post-formats', array(
			'audio', 'gallery', 'image', 'video'
		) ); 
		add_theme_support( 'automatic-feed-links' );
		add_image_size( 'post-364-471', 364, 471, true );
		//add_image_size( 'post-364-auto', 364 );
		add_image_size( 'post-273-706', 273, 706, true );
		add_image_size( 'post-273-295', 273, 295, true );
		add_image_size( 'post-547-350', 547, 350, true );
		add_image_size( 'post-943-527', 943, 527, true );
	}
	add_action( 'after_setup_theme' , 'cobalt_after_setup_theme');
}

if( !function_exists( 'cobalt_enqueue_scripts' ) ){
	/**
	 * Loading the script/style.
	 */
	function cobalt_enqueue_scripts() {
		global $post, $cobalttheme;
		wp_enqueue_script('jquery');
		if( is_single() || is_page() ){
			wp_enqueue_script('comment-reply');
		}
		// script.
		wp_enqueue_script('jquery.appear.js', get_template_directory_uri() . '/assets/js/jquery.appear.js', array(), '', true);
		wp_enqueue_script('jquery.countTo.js', get_template_directory_uri() . '/assets/js/jquery.countTo.js', array(), '', true);
		wp_enqueue_script('raphael-min.js', get_template_directory_uri() . '/assets/js/raphael-min.js', array(), '', true);
		wp_enqueue_script('DevSolutionSkill.min.js', get_template_directory_uri() . '/assets/js/DevSolutionSkill.min.js', array(), '', true);
		wp_enqueue_script('jquery.quovolver.js', get_template_directory_uri() . '/assets/js/jquery.quovolver.js', array(), '', true);
		wp_enqueue_script('jquery.magnific-popup.min.js', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array(), '', true);
		wp_enqueue_script('owl.carousel.min.js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '', true);
		wp_enqueue_script('plugins-scroll.js', get_template_directory_uri() . '/assets/js/plugins-scroll.js', array(), '', true);
		wp_enqueue_script('bootstrap.min.js', get_template_directory_uri() . '/assets/js/bootstrap.js', array(), '', true);
		wp_enqueue_script('jquery.imagesloaded.min.js', get_template_directory_uri() . '/assets/js/jquery.imagesloaded.min.js', array(), '', true);
		wp_enqueue_script('jquery.isotope.min.js', get_template_directory_uri() . '/assets/js/jquery.isotope.min.js', array(), '', true);
		wp_enqueue_script('retina-1.1.0.min.js', get_template_directory_uri() . '/assets/js/retina-1.1.0.min.js', array(), '', true);
		if( is_page_template( 'page-templates/template-contact.php' ) ){
			wp_enqueue_script('maps.google.com', 'http://maps.google.com/maps/api/js?sensor=false', array(), '', true);
			wp_enqueue_script('gmap3.min.js', get_template_directory_uri() . '/assets/js/gmap3.min.js', array(), '', true);			
		}
		wp_enqueue_script('jquery.flexslider.js', get_template_directory_uri() . '/assets/js/jquery.flexslider.js', array(), '', true);
		$preloader_active	=	( isset( $cobalttheme['preloader_active'] ) && $cobalttheme['preloader_active'] == 1 ) ? true : false;
		if( $preloader_active ){
			wp_enqueue_script('preloader.js', get_template_directory_uri() . '/assets/js/preloader.js', array(), '', true);
		}
		wp_enqueue_script('script.js', get_template_directory_uri() . '/assets/js/script.js', array(), '', true);
		// style.
		wp_enqueue_style( 'cobalt-roboto', cobalt_font_url(), array(), 'all' );
		wp_enqueue_style('bootstrap.min.css', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), null);
		wp_enqueue_style('magnific-popup.css', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), null);
		wp_enqueue_style('font-awesome.css', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), null);
		wp_enqueue_style('owl.carousel.css', get_template_directory_uri() . '/assets/css/owl.carousel.css', array(), null);
		wp_enqueue_style('owl.theme.css', get_template_directory_uri() . '/assets/css/owl.theme.css', array(), null);
		wp_enqueue_style('settings.css', get_template_directory_uri() . '/assets/css/settings.css', array(), null);
		wp_enqueue_style('flexslider.css', get_template_directory_uri() . '/assets/css/flexslider.css', array(), null);			
		wp_enqueue_style( 'style', get_bloginfo( 'stylesheet_url' ), array(), 'screen' );
		// loading custom color.
		$colorscheme	=	isset( $cobalttheme['colorscheme'] ) && $cobalttheme['colorscheme'] != 'default' ? esc_attr( $cobalttheme['colorscheme'] ) : null;
		if( !empty( $colorscheme ) ){
			wp_enqueue_style($colorscheme, get_template_directory_uri() . '/assets/css/colors/'.$colorscheme.'.css', array(), null);
		}
		$preloader_active	=	( isset( $cobalttheme['preloader_active'] ) && $cobalttheme['preloader_active'] == 1 ) ? true : false;
		if( $preloader_active === false ){
			wp_enqueue_style('body.css', get_template_directory_uri() . '/assets/css/body.css', array(), null);
		}
		wp_enqueue_style('responsive.css', get_template_directory_uri() . '/assets/css/responsive.css', array(), null);
	}
	add_action( 'wp_enqueue_scripts' , 'cobalt_enqueue_scripts');
}
if( !function_exists('cobalt_admin_enqueue_scripts') ){
	function cobalt_admin_enqueue_scripts() {
		wp_enqueue_style('redux-admin.css', get_template_directory_uri() . '/assets/css/redux-admin.css');
	}
	add_action('admin_enqueue_scripts', 'cobalt_admin_enqueue_scripts');
}
if( !function_exists('cobalt_font_url') ){
	function cobalt_font_url() {
		$font_url = '';
		if ( 'off' !== _x( 'on', 'Roboto+Slab font: on or off', 'cobalt' ) ) {
			$font_url = add_query_arg( 'family','Roboto+Slab:400,300,100,700', "//fonts.googleapis.com/css" );
		}
		return $font_url;
	}
}

if( !function_exists( 'cobalt_widgets_init' ) ){
	/**
	 * Adding the sidebars.
	 */
	function cobalt_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Primary Sidebar', 'cobalt' ),
			'description'	=>	__('Archive the Widgets on Right sidebar.','cobalt'),
			'id'            => 'main-sidebar',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Second Sidebar', 'cobalt' ),
			'description'	=>	__('Archive the Widgets on Left sidebar.','cobalt'),
			'id'            => 'second-sidebar',
			'before_widget' => '<div id="%1$s" class="sidebar-widget second-sidebar %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );		
	}
	add_action( 'widgets_init', 'cobalt_widgets_init' );
}

if( !function_exists('cobalt_register_menus') ){
	/**
	 * Adding the main menu.
	 */
	function cobalt_register_menus() {
		register_nav_menus(array('main_navigation' => __('Main Navigation','cobalt')));
	}
	add_action( 'init', 'cobalt_register_menus' );
}

if( !function_exists( 'cobalt_menu' ) ){
	/**
	 * Display the menu.
	 */
	function cobalt_menu() {
		if( has_nav_menu('main_navigation') ){
			wp_nav_menu(array(
				'menu_class'		=>	'menu',
				'theme_location'	=>	'main_navigation',
				'container'			=>	null,
				'walker'			=>	new Cobalt_Walker_Nav_Menu()
			));
		}
		else{
			?>
				<ul class="menu">
					<li><a href="<?php print home_url();?>"><span><?php _e('Homepage','cobalt');?></span></a></li>
					<li><a href="<?php print admin_url( 'nav-menus.php' );?>"><span><?php _e('Setup menu','cobalt');?></span></a></li>
				</ul>			
			<?php 
		}
		
	}
	add_action( 'cobalt_menu' , 'cobalt_menu', 10);
}

if( !function_exists( 'cobalt_comments_template' ) ){
	/**
	 * Comment template callback
	 * @param unknown_type $comment
	 * @param unknown_type $args
	 * @param unknown_type $depth
	 */
	function cobalt_comments_template( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<div class="comment-box">
					<a href="<?php print get_comment_author_url( $comment->comment_ID );?>"><?php echo get_avatar( $comment, $args['avatar_size'] );?></a>
					<div class="comment-content">
						<h6><a href="<?php print get_comment_author_url( $comment->comment_ID );?>"><?php print $comment->comment_author;?></a> <span> |  <?php  printf( __('%s ago','cobalt'), human_time_diff( get_comment_time('U'), current_time('timestamp') ));?> |</span>  <?php comment_reply_link(array_merge( $args, array('add_below' => null, 'depth' => $depth, 'max_depth' => $args['max_depth'],'reply_text'=>__('Reply','cobalt')))) ?></h6>
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'copper' ); ?></p>
						<?php endif; ?>
						<?php comment_text() ?>
					</div>
				</div>
		<?php 
	}
}
