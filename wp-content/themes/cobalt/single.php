<?php get_header();?>
		<div id="content">
			<div class="inner-content">
				<?php if( have_posts() ): the_post();?>
				<?php 
				/**
				 * Hooked cobalt_singlepost_layout, 10
				 */
				$layout = apply_filters( 'cobalt_singlepost_layout' , get_the_ID());
				$col_fullwidth = ( in_array( $layout , array( 'normal', 'fullwidth' )) ) ? 12 : cobalt_get_column_size();
				?>				
				<div class="blog-detail-page single-<?php print ( $layout == 'fullwidth') ? 'post' : 'page';?>">
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
								<div class="col-md-<?php print $col_fullwidth;?>">
									<?php 
										get_template_part( 'content', get_post_format() );
										// next,pre post link.
										if( in_array( $layout , array( 'normal', 'fullwidth' )) && has_tag( '', get_the_ID() ) ){
											?>
											<div class="widget_tag_cloud sidebar-widget">
												<h2 class="widget-title"><?php _e('Tags:','cobalt');?></h2>
												<?php the_tags('<ul class="tags-list-post"><li>','</li><li>','</li></ul>');?>
											</div>			
											<?php 
										}
										if( function_exists( 'cobalt_post_nav' ) && apply_filters( 'cobalt_next_pre_post_link' , true) === true ){
											cobalt_post_nav();
										}
										if( comments_open() && apply_filters( 'cobalt_enable_comment' , true) === true ):
											comments_template();
										endif;
									?>
								</div>
								<?php if( $layout == 'r_sidebar' ):?>
									<?php get_sidebar('single');?>
								<?php endif;?>
							</div>				
						</div>
					</div>
				</div>
				<?php else:?>
					<?php get_template_part( 'content', 'none' );?>
				<?php endif;?>	
			</div>
		</div>
	</div>
<?php get_footer();?>
