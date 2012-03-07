<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage wpbootstrap
 * @since wpbootstrap 0.1
 */

get_header();

global $sa_options;
$sa_settings = get_option( 'sa_options', $sa_options ); ?>

<div class="row">
  <div class="span<?php echo 16 - $sa_settings['sidebar_size'] ?> columns">

			<div class="page-header">
				<h1><?php _e( 'Not Found', 'twentyten' ); ?></h1>
				<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'twentyten' ); ?></p>
				<?php get_search_form(); ?>
			</div> <!-- /page-header -->

	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
