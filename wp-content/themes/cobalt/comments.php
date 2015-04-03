<?php
/**
 * The template for displaying Comments
 * The area of the page that contains comments and the comment form.
 */
global $post;
if ( post_password_required() ) {
	return;
}
?>
<?php if ( have_comments() ) :?>
<div class="comment-section">
	<div class="comment-section-head">
		<h1>
			<?php
				printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'cobalt' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>		
		</h1>
	</div>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'cobalt' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'cobalt' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'cobalt' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>		
	<ul class="comment-tree">
		<?php
			$args	=	array(
				'style'      	=> 'ul',
				'type'			=>	'all',
				'short_ping' 	=>	true,
				'avatar_size'	=>	64,
				'callback'		=>	function_exists( 'cobalt_comments_template' ) ? 'cobalt_comments_template' : null
			);
			wp_list_comments( apply_filters( 'cobalt_comments_template_args' , $args) );
		?>
	</ul>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'cobalt' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'cobalt' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'cobalt' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>	
</div>
<?php endif;?>
	<?php 
	$required_text = '';
	$commenter = wp_get_current_commenter();
	$textarea_wrapper = get_current_user_id() ? 12 : 8;
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$args = array(
		'id_form'           => 'comments',
		'id_submit'         => 'submit',
		'title_reply'       => __( 'Write the message', 'cobalt' ),
		'title_reply_to'    => __( 'Write the message %s','cobalt' ),
		'cancel_reply_link' => __( 'Cancel Reply', 'cobalt' ),
		'label_submit'      => __( 'Send Now','cobalt' ),
	
		'comment_field' =>  '<div class="col-md-'.$textarea_wrapper.'"><textarea id="comment" name="comment" aria-required="true" placeholder="'.__('Message','cobalt').'"></textarea></div>',
			
		'must_log_in' => '<p class="must-log-in">' .
		sprintf(
				__( 'You must be <a href="%s">logged in</a> to post a comment.', 'cobalt'  ),
				wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		) . '</p>',
	
		'logged_in_as' => '<p class="logged-in-as">' .
		sprintf(
				__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'cobalt'  ),
				admin_url( 'profile.php' ),
				$user_identity,
				wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
		) . '</p>',
	
		'comment_notes_before' => '<p class="comment-notes">' .
		__( 'Your email address will not be published.', 'cobalt'  ) . ( $req ? $required_text : '' ) .
		'</p>',
	
		'comment_notes_after' => '<p class="form-allowed-tags">' .
		sprintf(
				__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'cobalt'  ),
				' <code>' . allowed_tags() . '</code>'
		) . '</p>',
	
		'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<input id="author" name="author" type="text" placeholder="'.__('Name','cobalt').'" value="' . esc_attr( $commenter['comment_author'] ) .'">',
				'email' => '<input id="email" name="email" type="text" placeholder="'.__('Email','cobalt').'" value="'.esc_attr(  $commenter['comment_author_email'] ).'">',
				'url' => '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'">'
			)
		)
	);
	comment_form( $args ); 
	?>
