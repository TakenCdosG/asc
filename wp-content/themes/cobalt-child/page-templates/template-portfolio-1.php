<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
/**
 * Template Name: Portfolio 1
 */
get_header();?>
		<!-- content ================================================== -->
		<div id="content">
			<div class="inner-content">
				<div class="portfolio-page">
					<?php 
						$post_data = array(
							'post_type'			=>		'portfolio',
							'post_status'		=>		'publish',
							'showposts'			=>		get_option( 'posts_per_page' ),			
							'paged'			=>		function_exists( 'cobalt_get_paged' ) ? cobalt_get_paged() : 1,
							'thumbnail_size'	=>		'post-364-471'
						);
						$post_data	=	apply_filters( 'cobalt_post_data_args' , $post_data);
						$post_query	=	new WP_Query( $post_data );
						if( $post_query->have_posts() ):
					?>
					
					<div class="portfolio-box">					
						<?php while ( $post_query->have_posts() ) : $post_query->the_post();?>
							<div <?php post_class( 'project-post' );?>>
								<?php 
									if( has_post_thumbnail( get_the_ID() ) ){
										if ( get_field( "redirect_url" ) ) {
											print '<a href="'. get_field( "redirect_url" ) .'">'. get_the_post_thumbnail( get_the_ID(), $post_data['thumbnail_size'] ) . '</a>';
										}
										else {
											print '<a href="'.get_permalink( get_the_ID() ).'">'. get_the_post_thumbnail( get_the_ID(), $post_data['thumbnail_size'] ) . '</a>';
										}
									}
								?>
								<div class="hover-box">
									<div class="hover-content">
										<?php if ( get_field( "redirect_url" )): ?>
											<a class="plus" href="<?php echo get_field();?>"></a>
										<?php else: ?>
											<a class="plus" href="<?php the_permalink();?>"></a>
										<?php endif; ?>
										<?php if ( get_field( "redirect_url" )): ?>
											<?php the_title( '<h2><a href="'. get_field( "redirect_url" ) .'">', '</a></h2>' )?>
										<?php else: ?>
											<?php the_title( '<h2><a href="'.get_permalink().'">', '</a></h2>' )?>
										<?php endif; ?>
										<?php
										/**
										 * cobalt_post_meta action.
										 * hooked cobalt_post_meta_category, 10
										 */
										do_action( 'cobalt_post_meta' );
										?>
									</div>
								</div>
							</div>
						<?php endwhile;?>
					</div>
					<?php 
						if( function_exists( 'cobalt_navigation' ) ):
							cobalt_navigation( $post_query );
						endif;
					?>
					<?php 
						else:
							// Nothing was found.
							get_template_part( 'content', 'none' );
						endif;
					?>
				</div>
			</div>
		</div>
		<!-- End content -->
		</div>
<?php get_footer();?>