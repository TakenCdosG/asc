<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
/**
 * Template Name: Page Builder
 */
get_header();?>
	<div id="content">
		<div class="inner-content">
			<div class="page-builder">
				<div class="page-builder-content">
					<div class="container">
						<?php if( have_posts() ): the_post();?>
							<h1><?php the_title();?> <span><?php _e('&lt; back to home','cobalt');?> <a href="<?php print home_url();?>"><i class="fa fa-times"></i></a></span></h1>
							<?php the_content();?>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer();?>