<?php
/**
 * The template for displaying Search Results pages.
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

<?php if ( have_posts() ) : ?>
		<div class="page-header">
				<h1><?php printf( __( 'Search Results for: %s', 'twentyten' ), '' . get_search_query() . '' ); ?></h1>
		</div>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
		<div class="page-header">
			<h1><?php _e( 'Not Found', 'twentyten' ); ?></h1>
		</div>
		
		<div class="alert-message block-message error">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
			<div class="alert-actions"
				<?php get_search_form(); ?>
			</div>
		</div>
<?php endif; ?>

  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
