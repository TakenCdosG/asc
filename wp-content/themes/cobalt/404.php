<?php get_header();?>
	<div id="content">
		<div class="error-page">
			<div class="container">			
				<?php 
				/**
				 * cobalt_404_content action.
				 * hooked cobalt_404_content, 10
				 */
				do_action( 'cobalt_404_content' );
				?>
			</div>
		</div>
	</div>
	</div>
<?php get_footer();?>