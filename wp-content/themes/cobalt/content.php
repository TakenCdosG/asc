<div <?php post_class( 'post-item' );?>>
	<div class="post-title">
		<?php 
			global $post;
			if( is_single() || is_page() ){
				the_title( '<h1>','</h1>' );
			}
			else{
				the_title( '<h3><a href="'.get_permalink().'">','</a></h3>' );
			}
		?>
	</div>
	<?php
	/**
	 * cobalt_post_meta action.
	 * hooked cobalt_post_meta_category, 10
	 */
	do_action( 'cobalt_post_meta' );
	?>	

	<?php
	if( has_post_thumbnail( get_the_ID() ) && !is_single() ){
		print '<a href="'.get_permalink( get_the_ID()  ).'">'. get_the_post_thumbnail( $post->ID, apply_filters( 'cobalt_default_blog_thumbnail_size' , 'full') ) . '</a>';
	}
	?>
	<div class="single-box-content"><?php the_content();?></div>
</div>