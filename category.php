<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage wpbootstrap
 * @since wpbootstrap 0.1
 */

get_header(); ?>

<div class="row">
  <div class="span11 columns">

			<div class="page-header">
				<h1><?php
					printf( __( 'Category Archives: %s', 'twentyten' ), '' . single_cat_title( '', false ) . '' );
				?></h1>
			</div> <!-- /page-header -->

				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '' . $category_description . '';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
				?>

  </div>
  <div class="span5 columns">
		<?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>