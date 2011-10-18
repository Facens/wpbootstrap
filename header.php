<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage wpbootstrap
 * @since wpbootstrap 0.1
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * twentyten_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?>
	</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

	<link href="<?php bloginfo('template_directory'); ?>/js/google-code-prettify/prettify.css" rel="stylesheet">
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery/jquery.tablesorter.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/google-code-prettify/prettify.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/application.js"></script>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

    <div class="container">

			
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" style="position: relative">
				<?php 
					global $sa_options;
					$sa_settings = get_option( 'sa_options', $sa_options );
				?>
				<?php
					if( $sa_settings['back_to_main'] != '' ) : 
				?>
	  	    <a class="btn small" style="position: absolute; top: -45px; left: 0px" href="<?php echo $sa_settings['back_to_main']; ?>">&laquo; go to the main website</a>
				<?php endif; ?>
		
				<h1>
					<a href="<?php echo home_url( '/' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<p><?php bloginfo( 'description' ); ?></p>
      </div>

<div id="access" role="navigation">

		<?php
		if( $sa_settings['nav_view'] == 'pills' ) {
	    wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'menu_class' => 'pills', 'fallback_cb' => false) ); 
		}; 
		?>
	
		<?php
		if( $sa_settings['nav_view'] == 'tabs' ) {
	    wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'menu_class' => 'tabs', 'fallback_cb' => false) ); 
		}; 
		?>

</div><!-- #access -->