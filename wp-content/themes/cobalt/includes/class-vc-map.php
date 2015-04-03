<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
if( !class_exists( 'Cobalt_VC_Map' ) ){
	class Cobalt_VC_Map {
		function __construct() {
			if( !function_exists( 'vc_map' ) ){
				return;
			}
			else{
				add_action( 'init' , array( $this, 'cobalt_team' ));
				add_action( 'init' , array( $this, 'cobalt_skill' ));
				add_action( 'init' , array( $this, 'cobalt_testimonial' ));
				add_action( 'init' , array( $this, 'cobalt_feature' ) );
				add_action( 'init' , array( $this, 'cobalt_statistic' ) );
			}	
		}
		function cobalt_statistic() {
			$args = array(
				'name'	=>	__('Statistic','cobalt'),
				'base'	=>	'cobalt_statistic',
				'category'	=>	__('Cobalt Theme','cobalt'),
				'class'	=>	'statistic-box',
				'icon'	=>	'cobalt',
				'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc.css'),
				'description'	=>	__('Display the Statistic Box.','cobalt'),
				'params'	=>	array(
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Title','cobalt'),
						'param_name'	=>	'title',
						'value'	=>	''
					),
					array(
						'type'	=>	'fontawesome',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Icon','cobalt'),
						'param_name'	=>	'icon',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('From','cobalt'),
						'param_name'	=>	'from',
						'value'	=>	'0'
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('To','cobalt'),
						'param_name'	=>	'to',
						'value'	=>	'1000'
					),												
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Class','cobalt'),
						'param_name'	=>	'el_class',
						'description'	=>	__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.','cobalt')
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Element ID','cobalt'),
						'param_name'	=>	'id',
						'value'		=>	'statistic-'. rand(1000, 9999)
					)
				)
			);
			vc_map( $args );
		}		
		function cobalt_feature() {
			$args = array(
				'name'	=>	__('Feature','cobalt'),
				'base'	=>	'cobalt_feature',
				'category'	=>	__('Cobalt Theme','cobalt'),
				'class'	=>	'feature-box',
				'icon'	=>	'cobalt',
				'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc.css'),
				'description'	=>	__('Display the Feature Box.','cobalt'),
				'params'	=>	array(
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Title','cobalt'),
						'param_name'	=>	'title',
						'value'	=>	''
					),
					array(
						'type'	=>	'fontawesome',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Icon','cobalt'),
						'param_name'	=>	'icon',
						'value'	=>	''
					),
					array(
						'type'	=>	'textarea_html',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Content','cobalt'),
						'param_name'	=>	'content',
						'value'	=>	''
					),									
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Class','cobalt'),
						'param_name'	=>	'el_class',
						'description'	=>	__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.','cobalt')
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Element ID','cobalt'),
						'param_name'	=>	'id',
						'value'		=>	'feature-'. rand(1000, 9999)
					)
				)
			);
			vc_map( $args );			
		}
		function cobalt_testimonial() {
			$args = array(
				'name'	=>	__('Testimonials','cobalt'),
				'base'	=>	'cobalt_testimonial',
				'category'	=>	__('Cobalt Theme','cobalt'),
				'class'	=>	'testimonial-box',
				'icon'	=>	'cobalt',
				'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc.css'),
				'description'	=>	__('Display the Testimonial Box.','cobalt'),
				'params'	=>	array(
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Title','cobalt'),
						'param_name'	=>	'title',
						'value'	=>	''
					),
					array(
						'type'	=>	'testimonial_group',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Group','cobalt'),
						'param_name'	=>	'testimonial_group',
						'value'	=>	''
					),
					array(
						'type'	=>	'checkbox',
						'holder'	=>	'div',
						'class'	=>	'',
						'param_name'	=>	'slider',
						'value'	=>	array( __('Display as slider','cobalt')=>'on' )
					),						
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Testimonials In','cobalt'),
						'param_name'	=>	'testimonial_in',
						'value'	=>	'',
						'description'	=>	__('Use post ids, specify testimonial to retrieve, separated by comma(,)','cobalt')
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Testimonials Not In','cobalt'),
						'param_name'	=>	'testimonial__not_in',
						'value'	=>	'',
						'description'	=>	__('Use testimonial ids, specify testimonial NOT to retrieve, separated by comma(,)','cobalt')
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Show posts','cobalt'),
						'param_name'	=>	'showposts',
						'value'	=>	5
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Class','cobalt'),
						'param_name'	=>	'el_class',
						'description'	=>	__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.','cobalt')
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Element ID','cobalt'),
						'param_name'	=>	'id',
						'value'		=>	'testimonial-'. rand(1000, 9999)
					)
				)
			);
			vc_map( $args );			
		}
		function cobalt_skill() {
			$args = array(
				'name'	=>	__('Skill','cobalt'),
				'base'	=>	'cobalt_skill',
				'category'	=>	__('Cobalt Theme','cobalt'),
				'class'	=>	'skill-box',
				'icon'	=>	'cobalt',
				'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc.css'),
				'description'	=>	__('Display the Skill Box.','cobalt'),
				'params'	=>	array(
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Title','cobalt'),
						'param_name'	=>	'title',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Percent','cobalt'),
						'param_name'	=>	'percent',
						'value'	=>	''
					),
					array(
						'type'	=>	'colorpicker',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Background','cobalt'),
						'param_name'	=>	'background',
						'value'	=>	'#343434'
					),
					array(
						'type'	=>	'colorpicker',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Forground','cobalt'),
						'param_name'	=>	'forground',
						'value'	=>	'#a5a5a5'
					),
					array(
						'type'	=>	'colorpicker',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Font color','cobalt'),
						'param_name'	=>	'fontcolor',
						'value'	=>	'#343434'
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Class','cobalt'),
						'param_name'	=>	'el_class',
						'description'	=>	__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.','cobalt')
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Element ID','cobalt'),
						'param_name'	=>	'id',
						'value'		=>	'skill-'. rand(1000, 9999)
					)						
				)
			);
			vc_map( $args );			
		}
		function cobalt_team(){
			$args = array(
				'name'	=>	__('Team','cobalt'),
				'base'	=>	'cobalt_team',
				'category'	=>	__('Cobalt Theme','cobalt'),
				'class'	=>	'team-box',
				'icon'	=>	'cobalt',
				'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc.css'),
				'description'	=>	__('Display the Team Box.','cobalt'),
				'params'	=>	array(
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Full Name','cobalt'),
						'param_name'	=>	'fullname',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Position','cobalt'),
						'param_name'	=>	'position',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Class','cobalt'),
						'param_name'	=>	'el_class',
						'description'	=>	__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.','cobalt')
					),						
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Element ID','cobalt'),
						'param_name'	=>	'id',
						'value'	=>	'team-'. rand(1000, 9999),
						'description'	=>	__('Put an unique ID name.','cobalt')
					),
					array(
						'type'	=>	'attach_image',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Image','cobalt'),
						'param_name'	=>	'image',
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Facebook','cobalt'),
						'param_name'	=>	'facebook',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Google Plus','cobalt'),
						'param_name'	=>	'googleplus',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Linkedin','cobalt'),
						'param_name'	=>	'linkedin',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Pinterest','cobalt'),
						'param_name'	=>	'pinterest',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Twitter','cobalt'),
						'param_name'	=>	'twitter',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Instagram','cobalt'),
						'param_name'	=>	'instagram',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Tumblr','cobalt'),
						'param_name'	=>	'tumblr',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Flickr','cobalt'),
						'param_name'	=>	'flickr',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Youtube','cobalt'),
						'param_name'	=>	'youtube',
						'value'	=>	''
					),
					array(
						'type'	=>	'textfield',
						'holder'	=>	'div',
						'class'	=>	'',
						'heading'	=>	__('Weibo','cobalt'),
						'param_name'	=>	'weibo',
						'value'	=>	''
					)
				)
			);
			vc_map( $args );			
		}
	}
	new Cobalt_VC_Map();
}