<?php get_header();?>
		<!-- content ================================================== -->
		<div id="content">
			<div class="inner-content">
				<div class="single-page">
					<div class="single-post with-sidebar">
						<div class="container">
							<div class="row">
								<div class="col-md-<?php print function_exists( 'cobalt_get_column_size' ) ? cobalt_get_column_size() : 8;?>">
									<?php 
									if( have_posts() ):
										if( function_exists( 'woocommerce_content' ) ):
											woocommerce_content();
										endif;
									else:
										get_template_part( 'content', 'none' );
									endif;
									?>
								</div>
								<?php get_sidebar();?>
							</div>				
						</div>
					</div>
				</div>			
			</div>
		</div>
		<!-- End content -->
	</div>
	<!-- End Container -->
<?php get_footer();?>