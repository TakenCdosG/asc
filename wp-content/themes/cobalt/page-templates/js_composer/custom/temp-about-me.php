<?php
/**
 * Create the default template in VC.
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'cobalt_vc_temp_about_me' ) ){
	function cobalt_vc_temp_about_me($data) {
		$template               = array();
		$template['name']       = __( 'About Me', 'cobalt' );
		$template['image_path'] = get_template_directory_uri() .'/assets/images/temp-about-me.png'; // always use preg replace to be sure that "space" will not break logic
		$template['custom_class'] = 'cobalt_vc_temp_about_me';
		$template['content']    = <<<CONTENT
[vc_row el_class="about-box about-me"][vc_column width="1/1"][vc_row_inner][vc_column_inner width="5/12"][vc_single_image image="124" border_color="grey" img_link_target="_self" img_size="full"][/vc_column_inner][vc_column_inner width="7/12"][vc_column_text]
<h2>Hansom Rob</h2>
<h3>CEO &amp; Founder</h3>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore agna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco oris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate elit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint ecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste atus error sit voluptatem accusantium doloremque laudantium, totam rem am, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.

Nemo enim psam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni olores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia or sit amet, consectetur, adipisci velit, sed quia non nutmquam eius modi tempora incidunt ut bore et dolore magnam aliquam quaerat tatem, bore et dolore, dolorem ipsum quia or sit amet.

<img class="alignright size-full wp-image-125" src="http://marstheme.com/theme/cobalt/wp-content/uploads/2014/09/signature.png" alt="signature" width="174" height="58" />e-mail: hansom.rob@cobalttheme.com
phone: 0 800 55 55 123 45[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column width="8/12" el_class="circle-box-skills"][vc_column_text]
<h1>SOFTWARE KNOWLEDGE &amp; SKILLS</h1>
[/vc_column_text][vc_row_inner][vc_column_inner width="1/4"][cobalt_skill title="Web Design" percent="85" background="#343434" forground="#a5a5a5" fontcolor="#343434" id="skill-5862"][/vc_column_inner][vc_column_inner width="1/4"][cobalt_skill title="Photoshop" percent="98" background="#343434" forground="#a5a5a5" fontcolor="#343434" id="skill-5863"][/vc_column_inner][vc_column_inner width="1/4"][cobalt_skill title="HTML &amp; CSS" percent="65" background="#343434" forground="#a5a5a5" fontcolor="#343434" id="skill-5864"][/vc_column_inner][vc_column_inner width="1/4"][cobalt_skill title="Illustrator" percent="90" background="#343434" forground="#a5a5a5" fontcolor="#343434" id="skill-7803"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="4/12"][cobalt_testimonial title="HAPPY CLIENTS &amp; TESTIMONIALS" showposts="2" id="testimonial-8985" slider="on"][/vc_column][/vc_row]
CONTENT;
		array_unshift($data, $template);
		return $data;
	}	
	add_filter( 'vc_load_default_templates', 'cobalt_vc_temp_about_me', 110, 1 );
}