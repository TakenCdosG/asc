<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php wp_head();?>
</head>
<body <?php body_class();?>>
<?php global $cobalttheme;?>
	<!-- Container -->
	<div id="container">
		<!-- Header
		    ================================================== -->
		<header>
			<div class="logo-box">
				<?php cobalt_get_logo();?>
			</div>

			<a class="elemadded responsive-link" href="<?php print home_url();?>"><?php _e('Menu','cobalt');?></a>

			<div class="menu-box">
				<?php 
				/**
				 * cobalt_menu
				 * hooked cobalt_menu, 10
				 */
				do_action( 'cobalt_menu' );
				?>
			</div>
			<div class="header-foot">
				<?php dynamic_sidebar( 'second-sidebar' );?>
			</div>

		</header>
		<!-- End Header -->
