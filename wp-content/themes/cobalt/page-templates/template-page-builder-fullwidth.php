<?php
if( !defined('ABSPATH') ) exit; // don't access me directly.
/**
 * Template Name: Page Builder Fullwidth
 */
get_header();?>
	<div id="content">
		<?php 
			if( have_posts() ): the_post();
				the_content();
			endif;
		?>
	</div>
</div>
<?php get_footer();?>