<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
if( !class_exists( 'Cobalt_Shortcodes' ) ){
	class Cobalt_Shortcodes {
		function __construct() {
			add_action( 'init' , array( $this, 'add_shortcodes' ));
		}
		function add_shortcodes(){
			add_shortcode( 'cobalt_team' , array( $this, 'cobalt_team' ));
			add_shortcode( 'cobalt_skill' , array( $this, 'cobalt_skill' ));
			add_shortcode( 'cobalt_testimonial' , array( $this, 'cobalt_testimonial' ));
			add_shortcode( 'cobalt_feature' , array( $this, 'cobalt_feature' ));
			add_shortcode( 'cobalt_statistic' , array( $this, 'cobalt_statistic' ) );
			add_shortcode( 'cobalt_slider' , array( $this, 'cobalt_slider' ) );
		}
		function cobalt_slider( $attr, $content = null ){
			$output = '';
			extract(shortcode_atts(array(
				'title'			=>	'',
				'ids'		=>	'',
				'el_class'		=>	'',
				'size'			=>	'full',
				'id'			=>	'slider-'. rand(1000, 9999)
			), $attr));	

			if( empty( $ids ) )
				$output .= '<div class="alert alert-warning" role="alert">'.__('Nothing in slider.','cobalt').'</div>';
			$ids =	explode( "," , $ids);
			if( is_array( $ids ) ){
				$output .= '
					<div class="flexslider" id="'.$id.'">
						<ul class="slides">';
							for ($i = 0; $i < count( $ids ); $i++) {
								$image_output = wp_get_attachment_image( $ids[$i], $size, false );
								$output .= '
									<li>'.$image_output.'</li>
								';
							}
						$output .= '</ul>
					</div>
				';
			}
			return $output;
		}
		function cobalt_statistic( $attr, $content = null ) {
			ob_start();
			extract(shortcode_atts(array(
				'title'			=>	'',
				'icon'			=>	'',
				'from'			=>	'',
				'to'			=>	'',
				'el_class'		=>	'',
				'id'			=>	'statistic-'. rand(1000, 9999)
			), $attr));
			?>
				<div id="<?php print $id;?>" class="statistic-counter <?php print $el_class?>">
					<div class="statistic-counter-content">
						<i class="fa <?php print $icon;?>"></i>
					</div>
					<p><span class="timer" data-from="<?php print $from;?>" data-to="<?php print $to?>"></span></p>
					<?php if( !empty( $title ) ):?><p><?php print $title;?></p><?php endif;?>
				</div>
			<?php 
			return ob_get_clean();
		}
		function cobalt_feature( $attr, $content = null ) {
			ob_start();
			extract(shortcode_atts(array(
				'title'			=>	'',
				'icon'			=>	'',
				'el_class'		=>	'',
				'id'			=>	'feature-'. rand(1000, 9999)
			), $attr));			
			?>
				<div class="services-post <?php print $el_class?>" id="<?php print $id;?>">
					<div class="services-post-head">
						<span><i class="fa <?php print $icon;?>"></i></span>
						<?php if( !empty( $title ) ): print '<h2>'. $title . '</h2>';endif;?>
					</div>
					<?php if( !empty($content ) ):?><p><?php print $content;?></p><?php endif;?>
				</div>
			<?php
			return ob_get_clean();			
		}
		function cobalt_testimonial( $attr, $content = null ){
			ob_start();
			wp_reset_postdata();wp_reset_query();
			$prefix = apply_filters( 'cobalt_testimonial_prefix' , 'testimonial_');
			if( !post_type_exists( 'testimonial' ) ){
				return __('The testimonial can not be found :(','cobalt');
			}
			extract(shortcode_atts(array(
				'title'					=>	'',
				'slider'				=>	'',
				'testimonial_group'		=>	'',
				'testimonial_in'		=>	'',
				'testimonial__not_in'	=>	'',
				'showposts'				=>	5,
				'el_class'				=>	'',
				'id'					=>	'testimonial-'. rand(1000, 9999)
			), $attr));
			
			$post_data= array(
				'post_type'			=>		'testimonial',
				'post_status'		=>		'publish',
				'showposts'			=>		$showposts
			);
			
			if( !empty( $testimonial_group ) ){
				$testimonial_group	=	absint( $testimonial_group );
				if( $testimonial_group > 0 ){
					if( $portfolio_category != 0 ){
						$post_data['tax_query'][] = array(
							'taxonomy' => 'testimonial_group',
							'field' => 'id',
							'terms' => $testimonial_group
						);
					}
				}
			}
			
			if( !empty( $testimonial_in ) ){
				$testimonial_in	=	explode( "," , $testimonial_in);
				if( is_array( $testimonial_in ) ){
					$post_data['post__in']	=	$testimonial_in;
				}
			}
			if( !empty( $testimonial__not_in ) ){
				$testimonial__not_in	=	explode( "," , $testimonial__not_in);
				if( is_array( $testimonial__not_in ) ){
					$post_data['post__not_in']	=	$testimonial__not_in;
				}
			}

			$post_data	=	apply_filters( 'cobalt_testimonial_sc_args' , $post_data, $id);
			$post_query = new WP_Query( $post_data );
			if( $post_query->have_posts() ):
			?>
				<?php if( !empty( $title ) ):?><?php print '<h1>'.esc_attr( $title ).'</h1>';?><?php endif;?>
				<div id="<?php print $id;?>" class="testimonial <?php if($slider=='on'):?>testimonial-slider<?php endif;?> <?php print $el_class?>">
					<ul>
						<?php while ( $post_query->have_posts() ) : $post_query->the_post();?>
						<li>
							<div class="client">
								<?php 
									if( has_post_thumbnail() ){
										print get_the_post_thumbnail( get_the_ID(), 'full' );
									}
								?>
								<h2><?php the_title();?></h2>
								<h3><?php if( get_post_meta( get_the_ID(), $prefix . 'position', true ) ): print get_post_meta( get_the_ID(), $prefix . 'position', true ); endif;?> <span> <?php if( get_post_meta( get_the_ID(), $prefix . 'website', true ) ):?>| <a href="<?php print get_post_meta( get_the_ID(), $prefix . 'website', true );?>"><?php print get_post_meta( get_the_ID(), $prefix . 'website', true );?></a></span><?php endif;?></h3>
								<?php the_content();?>
								<?php cobalt_get_testimonial_rating( get_the_ID() );?>
							</div>
						</li>
						<?php endwhile;?>
					</ul>
				</div>		
			<?php 
			else:
				print '<div class="alert alert-warning" role="alert">';
					if( get_current_user_id() == 1 ){
						printf( __('Nothing found! you may add %s here','cobalt'), '<a href="'.admin_url( 'edit.php?post_type=testimonial' ).'">'.__('the testimonial','cobalt').'</a>' );	
					}
					else{
						printf( __('Nothing found!','cobalt'), '' );
					}
				print '</div>';
			endif;
			wp_reset_postdata();wp_reset_query();
			return ob_get_clean();
		}
		function cobalt_skill( $attr, $content = null ) {
			ob_start();
			extract(shortcode_atts(array(
				'title'			=>	'',
				'percent'		=>	0,
				'background'	=>	'#343434',
				'forground'		=>	'#a5a5a5',
				'fontcolor'		=>	'#343434',
				'el_class'		=>	'',
				'id'			=>	'skill-'. rand(1000, 9999)
			), $attr));
			?>
				<div class="circle-box <?php print $el_class;?>">
					<div id="<?php print $id;?>" class="circle" data-percent="<?php print $percent?>" data-background="<?php print $background;?>" data-forground="<?php print $forground;?>" data-fontcolor="<?php print $fontcolor;?>"></div>
					<?php if( !empty( $title ) ):?><p><?php print $title;?></p><?php endif;?>	
				</div>
			<?php 
			return ob_get_clean();
		}
		function cobalt_team( $attr, $content = null ) {
			ob_start();
			extract(shortcode_atts(array(
				'el_class'		=>	'',
				'fullname'		=>	'',
				'position'		=>	'',
				'image'			=>	'',
				'facebook'		=>	'',
				'googleplus'	=>	'',
				'linkedin'		=>	'',
				'pinterest'		=>	'',
				'twitter'		=>	'',
				'instagram'		=>	'',
				'tumblr'		=>	'',
				'flickr'		=>	'',
				'weibo'			=>	'',
				'youtube'		=>	'',
				'id'	=>	'team-'. rand(1000, 9999)
			), $attr));
			$src = isset( $image ) ? wp_get_attachment_image_src( $image, 'full' ) : null;
			?>
				<div id="<?php print $id; ?>" class="team-post <?php print $el_class;?>">
					<?php if( !empty(  $src[0] ) ):?>
						<img src="<?php print  $src[0];?>" alt="<?php print $fullname;?>">
					<?php endif;?>
					<div class="team-hover">
						<?php if( !empty( $fullname ) ): print '<h2>'.esc_attr( $fullname ).'</h2>';endif;?>
						<?php if( !empty( $position ) ): print '<span>'.esc_attr( $position ).'</span>';endif;?>
						<ul class="team-social">
							<?php 
							if( !empty( $facebook ) ){
								print '<li><a class="facebook" href="'.esc_url( $facebook ).'"><i class="fa fa-facebook"></i></a></li>';
							}
							if( !empty( $googleplus ) ){
								print'<li><a class="google-plus" href="'.esc_url( $googleplus ).'"><i class="fa fa-google-plus"></i></a></li>';
							}
							if( !empty( $linkedin ) ){
								print '<li><a class="linkedin" href="'.esc_url( $linkedin ).'"><i class="fa fa-linkedin"></i></a></li>';
							}
							if( !empty( $pinterest ) ){
								print'<li><a class="pinterest" href="'.esc_url( $pinterest ).'"><i class="fa fa-pinterest"></i></a></li>';
							}
							if( !empty( $twitter ) ){
								print '<li><a class="twitter" href="'.esc_url( $twitter ).'"><i class="fa fa-twitter"></i></a></li>';
							}
							if( !empty( $instagram ) ){
								print '<li><a class="instagram" href="'.esc_url( $instagram ).'"><i class="fa fa-instagram"></i></a></li>';
							}
							if( !empty( $tumblr ) ){
								print'<li><a class="tumblr" href="'.esc_url( $tumblr ).'"><i class="fa fa-tumblr"></i></a></li>';
							}
							if( !empty( $flickr ) ){
								print '<li><a class="flickr" href="'.esc_url( $flickr ).'"><i class="fa fa-flickr"></i></a></li>';
							}
							if( !empty( $weibo ) ){
								print '<li><a class="weibo" href="'.esc_url( $weibo ).'"><i class="fa fa-weibo"></i></a></li>';
							}
							if( !empty( $youtube ) ){
								print '<li><a class="youtube" href="'.esc_url( $youtube ).'"><i class="fa fa-youtube"></i></a></li>';
							}
							?>
						</ul>
					</div>
				</div>			
			<?php 
			return ob_get_clean();
		}
	}
	new Cobalt_Shortcodes();
}