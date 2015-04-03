<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
get_header();?>
		<!-- content ================================================== -->
		<div id="content">
			<div class="inner-content">
				<div class="single-page">
					<?php if( have_posts() ) : the_post();?>
					<div <?php post_class( 'single-project single-content' );?>>
						<div class="container">
							<?php 
							/**
							 * cobalt_breadcrumb action.
							 * hooked cobalt_breadcrumb, 10
							 */
							do_action( 'cobalt_breadcrumb' );
							?>					
							<h1><?php the_title();?></h1>
							<?php
							/**
							 * cobalt_post_meta action.
							 * hooked cobalt_post_meta_category, 10
							 */
							do_action( 'cobalt_post_meta' );
							?>
							<?php
								// do the magic here. 
								the_content(); 
								if( comments_open() && apply_filters( 'cobalt_enable_comment' , true) === true ){
									comments_template();
								}
							?>								
						</div>
					</div>
					<?php endif;?>
				</div>				
			</div>
		</div>
		<!-- End content -->
		</div>
<?php get_footer();?>