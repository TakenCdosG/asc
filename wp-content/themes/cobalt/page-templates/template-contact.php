<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
/**
 * Template Name: Contact
 */
get_header();
global $cobalttheme;
?>
	<div id="content">
		<div class="contact-page">
			<?php if( have_posts() ) : the_post();?>
			<?php 
				$gmap_center = function_exists( 'cobalt_get_gmap_center' ) ? cobalt_get_gmap_center() : '';
			?>
			<div 
				data-marker="<?php print function_exists( 'cobalt_get_gmap_marker' ) ? cobalt_get_gmap_marker() : '';?>" 
				data-lat="<?php print function_exists( 'cobalt_get_gmap_lat' ) ? cobalt_get_gmap_lat() : '';?>"
				data-lng="<?php print function_exists( 'cobalt_get_gmap_lng' ) ? cobalt_get_gmap_lng() : '';?>"
				data-center-lat="<?php print is_array( $gmap_center ) ? $gmap_center[0] : '';?>"
				data-center-lng="<?php print is_array( $gmap_center ) ? $gmap_center[1] : '';?>"
				data-gzoom="<?php print function_exists( 'cobalt_get_gmap_zoom' ) ? cobalt_get_gmap_zoom() : 14;?>"
				class="map">
			</div>
			<div class="contact-box">
				<div class="top-contact-part">
					<span>&lt; back to home <a href="<?php print home_url();?>"><i class="fa fa-times"></i></a></span>
				</div>
				<?php the_title( '<h2>', '</h2>' );?>
				<p>
					<?php 
						if( !empty( $cobalttheme['address'] ) ){
							print '<span>'.$cobalttheme['address'].'</span>';
						}
						if( !empty( $cobalttheme['phone'] ) ){
							print '<span>'.$cobalttheme['phone'].'</span>';
						}
						if( !empty( $cobalttheme['fax'] ) ){
							print '<span>'.$cobalttheme['fax'].'</span>';
						}	
						if( !empty( $cobalttheme['email'] ) ){
							print '<span>'.$cobalttheme['email'].'</span>';
						}
					?>
				</p>
				<?php 
					if( !empty( $cobalttheme['cf7id'] ) ){
						print do_shortcode( '[contact-form-7 html_id="contact-form" id="'.$cobalttheme['cf7id'].'"]' );
					}
				?>
			</div>
			<?php endif;?>
		</div>
	</div>
	</div>
<?php get_footer();?>