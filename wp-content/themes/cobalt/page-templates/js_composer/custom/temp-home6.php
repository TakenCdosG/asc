<?php
/**
 * Create the default template in VC.
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'cobalt_vc_temp_home6' ) ){
	function cobalt_vc_temp_home6($data) {
		$template               = array();
		$template['name']       = __( 'Home V6', 'cobalt' );
		$template['image_path'] = get_template_directory_uri() .'/assets/images/temp-home6.png'; // always use preg replace to be sure that "space" will not break logic
		$template['custom_class'] = 'cobalt_vc_temp_home6';
		$template['content']    = <<<CONTENT
[vc_row css=".vc_custom_1412392973269{margin-top: 0px !important;margin-right: 0px !important;margin-bottom: 0px !important;margin-left: 0px !important;}"][vc_column width="1/1" css=".vc_custom_1412393057220{padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;padding-left: 0px !important;}"][rev_slider_vc alias="mainslider"][/vc_column][/vc_row]
CONTENT;
		array_unshift($data, $template);
		return $data;
	}	
	add_filter( 'vc_load_default_templates', 'cobalt_vc_temp_home6', 110, 1 );
}