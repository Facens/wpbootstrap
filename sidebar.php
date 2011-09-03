<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>

<ul class="unstyled sidebar">

	
<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
	

			<li>
				<h3><?php _e( 'Archives', 'twentyten' ); ?></h3>
				<p>
					<ul>
						<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
				</p>
			</li>

			<li>
				<h3><?php _e( 'Meta', 'twentyten' ); ?></h3>
				<p>
					<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
				</p>
			</li>

			<li>
				<?php get_search_form(); ?>
			</li>

		<?php endif; // end primary widget area ?>
		
			<?php 
				global $sa_options;
				$sa_settings = get_option( 'sa_options', $sa_options );
			?>
			<?php
				if( $sa_settings['sidebar_feed'] == '1' ) : 
			?>
				<li>
					<div class="alert-message block-message warning">
						<a style="display: block; text-align: center" class="btn" href="<?php bloginfo('rss2_url'); ?>" title="RSS Feed">Follow this blog via RSS Feed</a>
					</div>
				</li>
			<?php endif; ?>


	<?php dynamic_sidebar( 'secondary-widget-area' ); ?>

</ul>
