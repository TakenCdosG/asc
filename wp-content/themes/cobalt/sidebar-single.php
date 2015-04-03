<div class="col-md-<?php print function_exists( 'cobalt_get_column_size' ) ? cobalt_get_column_size('sidebar') : 4;?>">
	<div class="sidebar-blog">
		<?php 
		/**
		 * cobalt_post_left_side action.
		 * hooked cobalt_post_info, 10
		 * hooked cobalt_post_tags, 20
		 */
		do_action( 'cobalt_post_right_side' );
		?>	
		<?php dynamic_sidebar( 'main-sidebar' );?>
	</div>
</div>