<div class="col-md-<?php print function_exists( 'cobalt_get_column_size' ) ? cobalt_get_column_size('sidebar') : 4;?>">
	<div class="sidebar-blog">
		<?php dynamic_sidebar( 'main-sidebar' );?>
	</div>
</div>