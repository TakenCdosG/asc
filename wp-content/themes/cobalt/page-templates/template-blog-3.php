<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
/**
 * Template Name: Blog 3
 */
get_header()?>

		<!-- content ================================================== -->
		<div id="content">
			<div class="inner-content">
				<div class="blog-page">
					<?php 
					$post_data = array( 
						'post_type'		=>		'post',
						'post_status'	=>		'publish',
						'showposts'		=>		get_option( 'posts_per_page' ),
						'paged'			=>		function_exists( 'cobalt_get_paged' ) ? cobalt_get_paged() : 1,
						'thumbnail_size'	=>		'post-547-350'
					);
					// For Developer
					$post_data	=	apply_filters( 'cobalt_post_data_args' , $post_data);
					// Wanna custom the layout as columns, row?
					$template_grid	=	apply_filters( 'cobalt_template_grid' , array( 'columns'=> 2, 'rows' => 2 ));
					
					$columns = (isset( $template_grid['columns'] ) && (int)$template_grid['columns'] > 0 ) ? absint( $template_grid['columns'] ) : 2;
					$rows = (isset( $template_grid['rows'] ) && (int)$template_grid['rows'] > 0 ) ? absint( $template_grid['rows'] ) : 2;
					
					// Processing the query.
					$post_query = new WP_Query( $post_data );
					if( $post_query->have_posts() ):
					?>					
					<div id="owl-demo2" data-columns=<?php print $columns;?> class="owl-carousel owl-theme triggerAnimation animated" data-animate="fadeInUp">
						<?php 
						$i = 0;
						while ( $post_query->have_posts() ) : $post_query->the_post();
						$i++;
						?>
						<?php if( $i == 1 ):?><div class="item"><?php endif;?>
							<div <?php post_class( 'blog-post big-post' );?>>
								<?php 
									if( has_post_thumbnail( get_the_ID() ) ){
										print '<a href="'.get_permalink( get_the_ID()  ).'">' . get_the_post_thumbnail( get_the_ID(), $post_data['thumbnail_size'] ) .'</a>';
									}
								?>
								<a class="post-type" href="<?php the_permalink();?>"><i class="fa fa-<?php print cobalt_post_format_class( get_the_ID() );?>"></i></a>
								<div class="hover-blog">
									<div class="hover-content">
										<a class="link-tag" href="<?php the_permalink()?>"></a>
										<div class="post-head">
											<?php the_title( '<h2><a href="'.get_permalink().'">', '</a></h2>' )?>
											<?php if( has_category(null, get_the_ID()) ):?>
												<span class="category"><?php the_category(', ');?></span>
											<?php endif;?>
										</div>
										<?php the_excerpt();?>
										<ul class="post-tags">
											<li><a href="#"><?php print get_the_date()?></a></li>
											<li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php print get_the_author_meta('display_name');?></a></li>
											<?php if( comments_open( get_the_ID() ) ):?>
												<li><a href="<?php comments_link();?>"><?php comments_number( __('no comment','cobalt'), __('1 comment','cobalt'), __('% comments','cobalt') ); ?></a></li>
											<?php endif;?>
										</ul>
									</div>
								</div>								
							</div>
						<?php if( $i % $rows == 0 ):?></div><div class="item"><?php endif;?>
						<?php endwhile;?></div>
					</div>
					<?php 
						if( function_exists( 'cobalt_navigation' ) ):
							cobalt_navigation( $post_query );
						endif;
					?>					
					<?php else:?>
						<?php get_template_part( 'content', 'none' );?>
					<?php endif;?>
				</div>
			</div>
		</div>
		<!-- End content -->
</div>
<?php get_footer();?>