<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
if( !function_exists( 'cobalt_widgets' ) ){
	function cobalt_widgets() {
		// social widget
		register_widget('Cobalt_Widget_Social');
	}
	add_action( 'widgets_init', 'cobalt_widgets');
}

if( !class_exists( 'Cobalt_Widget_Social' ) ){
	class Cobalt_Widget_Social extends WP_Widget {
		function Cobalt_Widget_Social() {
			$widget_ops = array( 'classname' => 'socials-widget', 'description' => __('Displaying the social links.', 'neat') );
			
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'socials-widget' );
			
			$this->WP_Widget( 'socials-widget', __('Cobalt Socials', 'neat'), $widget_ops, $control_ops );	
		}
		function widget($args, $instance){
			$output = '';
			extract( $args );
			$title = apply_filters('widget_title', isset( $instance['title'] ) ? $instance['title'] : null );
			$output .=  $before_widget;
			if( !empty( $title ) ){
				$output .= $before_title . $title . $after_title;
			}
			$socials = function_exists( 'cobalt_socials_provider' ) ? cobalt_socials_provider() : null;
			
			$output .= '<div class="social-box"><ul class="social-icons">';
			
			if( is_array( $socials ) && !empty( $socials ) ){
				foreach ( $socials  as $key=>$value) {
					if( isset( $instance[$key] ) && !empty( $instance[$key] ) ){
						$output .= '<li><a href="'.esc_url( $instance[$key] ).'" class="'.$key.'" ><i class="fa fa-'.$key.'"></i></a></li>';
					}
				}	
			}
			
			$output .= '</ul></div>';
			
			$output .= $after_widget;
			print $output;				
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			$socials = function_exists( 'cobalt_socials_provider' ) ? cobalt_socials_provider() : null;
			if( is_array( $socials ) && !empty( $socials ) ){
				foreach ( $socials  as $key=>$value) {
					if( isset( $new_instance[ $key ] ) ){
						$instance[$key] = esc_url( $new_instance[$key] );
					}		
				}
			}		
			return $instance;
		}
		function form( $instance ){
			$defaults = array(
				'title' 	=> __('Socials', 'cobalt')
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			$socials = function_exists( 'cobalt_socials_provider' ) ? cobalt_socials_provider() : null;
			?>
				<p>
					<label for="<?php echo $this->get_field_id( "title" ); ?>"><?php _e( 'Title','cobalt' ); ?></label>
					<input id="<?php echo $this->get_field_id( "title" ); ?>" name="<?php echo $this->get_field_name( "title" ); ?>" type="text" value="<?php echo esc_attr( $instance["title"] ); ?>" style="width:100%;"/>
				</p>
			<?php 
			if( is_array( $socials ) && !empty( $socials ) ){
				foreach ( $socials  as $key=>$value) {
					?>
						<p>
							<label for="<?php echo $this->get_field_id( $key ); ?>"><?php print $value; ?></label>
							<input id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php echo isset( $instance[$key] ) ? esc_url( $instance[$key] ) : ''; ?>" style="width:100%;"/>
						</p>					
					<?php 
				}
			}
		}
	}
}
