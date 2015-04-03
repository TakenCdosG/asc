<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
get_header();?>
		<!-- content ================================================== -->
		<div id="content">
			<div class="inner-content">
				<div class="portfolio-page">
				
					<?php if( have_posts() ):?>
					
					<div class="portfolio-box">					
						<?php while ( have_posts() ) : the_post();?>
							<div <?php post_class( 'project-post' );?>>
								<?php 
									if( has_post_thumbnail( get_the_ID() ) ){
										print get_the_post_thumbnail( get_the_ID(), apply_filters( 'cobalt_portfolio_archive_thumbnail_size' , 'post-364-471') );
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
						<?php endwhile;?>
					</div>
					<?php 
						if( function_exists( 'cobalt_navigation' ) ):
							cobalt_navigation();
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