<?php get_header();?>
		<div id="content">
			<div class="inner-content">
				<div class="single-page">
					<div class="single-post with-sidebar">
						<div class="container">
							<?php 
							/**
							 * cobalt_breadcrumb action.
							 * hooked cobalt_breadcrumb, 10
							 */
							do_action( 'cobalt_breadcrumb' );
							?>						
							<div class="row">
								<div class="col-md-12">
									<?php 
									if( have_posts() ): the_post();
										get_template_part( 'content', 'page' );	
										if( comments_open() ):
											comments_template();
										endif;
									else:
										get_template_part( 'content', 'none' );
									endif;
									?>
								</div>
							</div>				
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>
<?php get_footer();?>