<?php
/**
 * Create the default template in VC.
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'cobalt_vc_temp_about_us' ) ){
	function cobalt_vc_temp_about_us($data) {
		$template               = array();
		$template['name']       = __( 'About Us', 'cobalt' );
		$template['image_path'] = get_template_directory_uri() .'/assets/images/temp-about-us.png'; // always use preg replace to be sure that "space" will not break logic
		$template['custom_class'] = 'cobalt_vc_temp_about_us';
		$template['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore agna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco oris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate elit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint ecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste atus error sit voluptatem accusantium doloremque laudantium, totam rem am, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.[/vc_column_text][vc_column_text]
<h1>MEET THE CREATIVE MINDS OF OUR COMPANY</h1>
[/vc_column_text][vc_row_inner][vc_column_inner width="1/4"][cobalt_team fullname="Hansom Rob" position="CEO &amp; Cool guy" id="team-1399" facebook="#" googleplus="#" linkedin="#" pinterest="#" image="112"][/vc_column_inner][vc_column_inner width="1/4"][cobalt_team fullname="Toan Nguyen" position="Wordpress Developer" id="team-4253" googleplus="#" linkedin="#" pinterest="#" twitter="#" image="113"][/vc_column_inner][vc_column_inner width="1/4"][cobalt_team fullname="Afrim Radoniqi" position="Web Designer" id="team-4253" linkedin="#" pinterest="#" twitter="#" instagram="#" image="120"][/vc_column_inner][vc_column_inner width="1/4"][cobalt_team fullname="Sami Maxhuni" position="Kundraxhi" id="team-4253" facebook="#" linkedin="#" pinterest="#" twitter="#" image="115"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column width="1/2" el_class="circle-box-skills"][vc_column_text]
<h1>SOFTWARE KNOWLEDGE &amp; SKILLS</h1>
[/vc_column_text][vc_row_inner][vc_column_inner width="1/2"][cobalt_skill title="Web Design" percent="90" background="#343434" forground="#a5a5a5" fontcolor="#343434" id="skill-0001"][/vc_column_inner][vc_column_inner width="1/2"][cobalt_skill title="Photoshop" percent="98" background="#343434" forground="#a5a5a5" fontcolor="#343434" id="skill-0002"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/2"][cobalt_skill title="HTML &amp; CSS" percent="70" background="#343434" forground="#a5a5a5" fontcolor="#343434" id="skill-0003"][/vc_column_inner][vc_column_inner width="1/2"][cobalt_skill title="Illustrator" percent="90" background="#343434" forground="#a5a5a5" fontcolor="#343434" id="skill-0004"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2"][cobalt_testimonial title="HAPPY CLIENTS &amp; TESTIMONIALS" showposts="5" id="testimonial-6484"][/vc_column][/vc_row][vc_row el_class="work-course"][vc_column width="1/1"][vc_column_text]
<h1>COURSE OF WORK</h1>
[/vc_column_text][vc_row_inner][vc_column_inner width="1/4" el_class="work-course-post"][vc_column_text]
<h2>Stage 1 / Planing</h2>
Lorem ipsum dolor sit amet, consectetur icing elit, sed do eiusmod tempor incididunt ut ore et dolore magna aliqua. Ut enim ad minim am, quis nostrud.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/4" el_class="work-course-post"][vc_column_text]
<h2>Stage 2 / Design Process</h2>
Lorem ipsum dolor sit amet, consectetur icing elit, sed do eiusmod tempor incididunt ut ore et dolore magna aliqua. Ut enim ad minim am, quis nostrud.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/4" el_class="work-course-post"][vc_column_text]
<h2>Stage 3 / Develop</h2>
Lorem ipsum dolor sit amet, consectetur icing elit, sed do eiusmod tempor incididunt ut ore et dolore magna aliqua. Ut enim ad minim am, quis nostrud.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/4" el_class="work-course-post"][vc_column_text]
<h2>Stage 4 / Final Testing</h2>
Lorem ipsum dolor sit amet, consectetur icing elit, sed do eiusmod tempor incididunt ut ore et dolore magna aliqua. Ut enim ad minim am, quis nostrud.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
		array_unshift($data, $template);
		return $data;
	}	
	add_filter( 'vc_load_default_templates', 'cobalt_vc_temp_about_us', 110, 1 );
}