<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
/**
 * Template Name: Portfolio 4
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
							'paged'				=>		function_exists( 'cobalt_get_paged' ) ? cobalt_get_paged() : 1,
							'thumbnail_size'	=>		'post-547-350',
							'columns'			=>		2,
							'rows'				=>		2
						);
						$post_data	=	apply_filters( 'cobalt_post_data_args' , $post_data);
						
						$columns	=	( isset( $post_data['columns'] ) && $post_data['columns'] > 0 ) ? $post_data['columns'] : 2;
						$rows	=	( isset( $post_data['rows'] ) && $post_data['rows'] > 0 ) ? $post_data['rows'] : 2;
						
						$post_query	=	new WP_Query( $post_data );
						if( $post_query->have_posts() ):
					?>
					<div id="owl-demo2" data-columns="<?php print $columns?>" class="owl-carousel owl-theme triggerAnimation animated" data-animate="fadeInUp">
						<?php 
							$i = 0;
							while ( $post_query->have_posts() ) : $post_query->the_post();
							$i++;
						?>
						<?php if( $i == 1 ):?><div class="item"><?php endif;?>
							<div <?php post_class( 'project-post' );?>>
								<?php 
									if( has_post_thumbnail( get_the_ID() ) ){
										print '<a href="'.get_permalink( get_the_ID() ).'">'. get_the_post_thumbnail( get_the_ID(), $post_data['thumbnail_size'] ) . '</a>';
									}
								?>
								<div class="hover-box">
									<div class="hover-content">
										<a class="plus" href="<?php the_permalink();?>"></a>
										<?php the_title( '<h2><a href="'.get_permalink().'">', '</a></h2>' )?>
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
						<?php if( $i % ( $columns ) == 0 && $i < $post_data['showposts'] ):?></div><div class="item"><?php endif;?>
						<?php endwhile;?></div>
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