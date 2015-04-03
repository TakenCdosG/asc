<?php
/**
 * Don't access me directly.
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'cobalt_remove_VC_default_templates' ) ){
	function cobalt_remove_VC_default_templates($data) {
		return array(); // This will remove all default templates
	}
	add_filter( 'vc_load_default_templates', 'cobalt_remove_VC_default_templates' );
}

// custom template
require_once ( get_template_directory() . '/page-templates/js_composer/custom/temp-about-us.php');
require_once ( get_template_directory() . '/page-templates/js_composer/custom/temp-about-me.php');
require_once ( get_template_directory() . '/page-templates/js_composer/custom/temp-services.php');
require_once ( get_template_directory() . '/page-templates/js_composer/custom/temp-portfolio-single.php');
require_once ( get_template_directory() . '/page-templates/js_composer/custom/temp-home6.php');