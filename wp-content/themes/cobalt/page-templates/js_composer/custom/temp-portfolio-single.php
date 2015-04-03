<?php
/**
 * Create the default template in VC.
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'cobalt_vc_temp_portfolio_single' ) ){
	function cobalt_vc_temp_portfolio_single($data) {
		$template               = array();
		$template['name']       = __( 'Portfolio Single', 'cobalt' );
		$template['image_path'] = get_template_directory_uri() .'/assets/images/temp-portfolio_single.png'; // always use preg replace to be sure that "space" will not break logic
		$template['custom_class'] = 'cobalt_vc_temp_portfolio_single';
		$template['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][vc_row_inner][vc_column_inner width="1/1"][vc_gallery type="flexslider_slide" interval="3" images="16,17,18,19" onclick="link_image" custom_links_target="_self" img_size="post-943-527"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row el_class="project-description"][vc_column width="1/1"][vc_row_inner][vc_column_inner width="3/12" el_class="project-info"][vc_column_text]
<h2>Info About Client</h2>
Client: ignitionthemes

Date: 12.12.2014

Skills: Photoshop, Illustrator

Preview:<a href="#">www.thesite.com</a>[/vc_column_text][/vc_column_inner][vc_column_inner width="9/12"][vc_column_text]Lorem ipsum dolor sit amet, consectetur icing elit, sed do eiusmod tempor incididunt ut ore et dolore magna iqua. Ut enim ad minim iam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

Duis ute re dolor in reprehenderit in voluptate velit sse cillum dolore eu fugiat nulla pariatur. Xcepteur sint occaecat cupidatat non ent sunt in culpa qui officia deserunt mollit. anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
		array_unshift($data, $template);
		return $data;
	}	
	add_filter( 'vc_load_default_templates', 'cobalt_vc_temp_portfolio_single', 110, 1 );
}