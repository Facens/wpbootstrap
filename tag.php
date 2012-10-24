<?php
/**
 * The template for displaying Tag Archive pages.
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
				<h1><?php
					printf( __( 'Tag Archives: %s', 'twentyten' ), '' . single_tag_title( '', false ) . '' );
				?></h1>
			</div> <!-- /page-header -->

<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>

  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
