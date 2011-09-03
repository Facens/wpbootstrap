<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage wpbootstrap
 * @since wpbootstrap 0.1
 */
?>
		<footer>
		<?php
			/* A sidebar in the footer? Yep. You can can customize
			 * your footer with four columns of widgets.
			 */
		?>
		
		<?php 
			global $sa_options;
			$sa_settings = get_option( 'sa_options', $sa_options );
		?>
		
		<?php
			if( $sa_settings['iubenda_id'] != '' ) : 
		?>
			<a href="http://www.iubenda.com/privacy-policy/<?php echo $sa_settings['iubenda_id']; ?>" class="iubenda-green-xs" id="iubenda-embed" title="Privacy Policy">Privacy Policy (by iubenda)</a>
			<script type="text/javascript" src="http://cdn.iubenda.com/iubenda.js"></script>
		<?php endif; ?>
			
		<?php
			if( $sa_settings['credits'] == 'true' ) : 
		?>
	
			<div style="float: right">		
					<a href="http://wpbootstrap.iubenda.com/">Bootstrap for Wordpress</a> is a theme based on the <a href="http://twitter.github.com/bootstrap/">Twitter Bootstrap toolkit</a>
					- 
					<a href="http://wordpress.org/" title="Semantic Personal Publishing Platform" rel="generator">Proudly powered by WordPress </a>
			</div>
		
		<?php endif; ?>
		
		<?php
			/* Always have wp_footer() just before the closing </body>
			 * tag of your theme, or you will break many plugins, which
			 * generally use this hook to reference JavaScript files.
			 */
		
			wp_footer();
		?>
		</footer>
  </div> <!-- /container -->

</body>
</html>