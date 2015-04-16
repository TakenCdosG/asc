<?php
    
    /*
	Plugin Name: Vimeo Grid Video Gallery
	Plugin URI: http://www.builtapp.com
	Description: This plugin will enable blog owners to include their vimeo channel to their blogs or blog posts
	Author: Builtapp
	Version: 0.0.1
	Author URI: http://builtapp.com
	*/
	

//Include the vimeo class


define('VIM_FILE_PATH', dirname(__FILE__));
define('VIM_FOLDER', dirname(plugin_basename(__FILE__)));

require(VIM_FILE_PATH."/libraries/vimeo.php" );

add_action('wp_head', 'load_vim_scripts');
add_shortcode("vm_gallery", "vim_show_gallery");


	
if (!function_exists('load_vim_scripts')) {  
    function load_vim_scripts() {
	    wp_register_script('vim_modernizr', plugins_url( "/assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js" , __FILE__ ) );  
	    wp_register_script('vim_lightbox', plugins_url( "/assets/prettyphoto/js/jquery.prettyPhoto.js" , __FILE__ ) );  
	    wp_register_script('vim_fitvid', plugins_url( "/assets/js/fitvid.js" , __FILE__ ) );  
	    wp_register_script('vim_main', plugins_url( "/assets/js/main.js" , __FILE__ ) );  
	    wp_register_script('vim_capslide', plugins_url( "/assets/js/vendor/jquery.capSlide.js" , __FILE__ ) );  
        wp_enqueue_script('vim_lightbox');        
        wp_enqueue_script('vim_fitvid');        
        wp_enqueue_script('vim_main');        
        wp_enqueue_script('vim_capslide');        
        wp_enqueue_script('vim_modernizr');        
        wp_enqueue_script('jquery');
		wp_enqueue_style('vim-style',  plugins_url( "/assets/css/main.css" , __FILE__ ));	
		wp_enqueue_style('vim_lightbox-style',  plugins_url( "/assets/prettyphoto/css/prettyPhoto.css" , __FILE__ ));	
		wp_enqueue_style('vim-mobile',  plugins_url( "/assets/css/mobile.css" , __FILE__ ));	
		
        }
		  
    
} 



function vim_show_gallery($channel){
		extract(shortcode_atts(array(
        'profile' => '',
    	), $channel));
	//Initiate the class
	$vimeo = new vimeo;
	//The default videos to show.
	$default_display_list = "uploads";
	//Variable to store display list
	$displaylist ="";
	//Get the list to display
if(isset($_GET['videos'])){
	if($_GET['videos']==="likes"){
		$videos = $vimeo->get_likes($profile);
		$displaylist = "likes";
	}elseif($_GET['videos']==="subscriptions"){
		$videos = $vimeo->get_subscriptions($profile);
		$displaylist = "subscriptions";
	}elseif($_GET['videos']==="tagged"){
		$videos = $vimeo->get_tagged($profile);
		$displaylist = "tagged";
	}else{
		$videos = $vimeo->get_uploads($profile);
		$displaylist = "uploads";
	}
}else{
	if($default_display_list==="likes"){
		$videos = $vimeo->get_likes($profile);
		$displaylist = "likes";
	}elseif($default_display_list==="subscriptions"){
		$videos = $vimeo->get_subscriptions($profile);
		$displaylist = "subscriptions";
	}elseif($default_display_list==="tagged"){
		$videos = $vimeo->get_tagged($profile);
		$displaylist = "tagged";
	}else{
		$videos = $vimeo->get_uploads($profile);
		$displaylist = "uploads";
	}
}
	//get profile details
	$user_details = $vimeo->get_user_details($profile);

	
	require(VIM_FILE_PATH."/frontend.php");
}

?>