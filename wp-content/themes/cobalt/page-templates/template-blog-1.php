<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
/**
 * Template Name: Blog 1
 */
get_header()?>
		<!-- content 
			================================================== -->
		<div id="content">
			<div class="inner-content">
				<div class="blog-page">
					<?php 
					$post_data = array( 
						'post_type'		=>		'post',
						'post_status'	=>		'publish',
						'showposts'		=>		get_option( 'posts_per_page' ),
						'paged'			=>		function_exists( 'cobalt_get_paged' ) ? cobalt_get_paged() : 1,
						'thumbnail_size'	=>		'post-364-471'
					);
					// for developer
					// hooked, cobalt_temp_pre_query, 10;
					$post_data	=	apply_filters( 'cobalt_post_data_args' , $post_data);
					
					$post_query = new WP_Query( $post_data );
					if( $post_query->have_posts() ):
					?>
					<div class="blog-box">
						<?php while ( $post_query->have_posts() ) : $post_query->the_post();?>
						<div <?php post_class( 'blog-post' );?>>
							<?php 
								if( has_post_thumbnail( get_the_ID() ) ){
									print '<a href="'.get_permalink( get_the_ID()  ).'">' . get_the_post_thumbnail( get_the_ID(), $post_data['thumbnail_size'] ) . '</a>';
								}
							?>
							<div class="hover-blog">
								<a class="post-type" href="<?php the_permalink();?>"><i class="fa fa-<?php print cobalt_post_format_class( get_the_ID() );?>"></i></a>
								<div class="hover-content">
									<a class="link-tag" href="<?php the_permalink();?>"></a>
									<div class="post-head">
										<?php the_title( '<h2><a href="'.get_permalink().'">', '</a></h2>' )?>
										<?php if( has_category(null, get_the_ID()) ):?>
											<span class="category"><?php the_category(' | ');?></span>
										<?php endif;?>	
									</div>
									<?php the_excerpt();?>
									<ul class="post-tags">
										<li><a href="<?php print cobalt_get_post_archive_link( get_the_ID() );?>"><?php print get_the_date()?></a></li>
										<li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php print get_the_author_meta('display_name');?></a></li>
										<?php if( comments_open( get_the_ID() ) ):?>
											<li><a href="<?php comments_link();?>"><?php comments_number( __('no comment','cobalt'), __('1 comment','cobalt'), __('% comments','cobalt') ); ?></a></li>
										<?php endif;?>
									</ul>
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
					<?php else:?>
						<?php get_template_part( 'content', 'none' );?>
					<?php endif;?>
				</div>
			</div>
		</div>
		<!-- End content -->
		</div>
<?php get_footer();?>