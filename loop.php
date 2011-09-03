<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage wpbootstrap
 * @since wpbootstrap 0.1
 */
?>
<?php 
	// Filters for adding classes to various functions
	$comments_link_attributes_css = 'btn small primary';
?>


<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
		
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

<?php 
	global $sa_options;
	$sa_settings = get_option( 'sa_options', $sa_options );
?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>

<?php 
// Set the first post value to 1, outside the loop
if ( ( is_paged() == false && $sa_settings['compact_homepage'] == '1' ) || ( $sa_settings['compact_homepage'] == false ) ) { $firstpost  = '1'; }
?>

<?php while ( have_posts() ) : the_post(); ?>


			<?php
				if ( $firstpost == '1' ) :
			?>
	<article>
				<div class="page-header">
					<h1>
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h1>
				</div> <!-- /page-header -->
			<?php endif; ?>

			<?php
				if ( $firstpost == '' ) :
			?>
				<div class="page-header" style="margin-top: 50px;">
					<h2>
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
				</div> <!-- /page-header -->
			<?php endif; ?>
	
			<p class="muted">
				<?php twentyten_posted_on(); ?>
			</p>
			
			<hr />
	
			<?php
			// Compact home page if start
				if ( $firstpost == '1' ) :
			?>
			
			<div class="post_content">
				<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
						<?php the_excerpt(); ?>
				<?php else : ?>
						<?php the_content( __( 'Continue reading &rarr;', 'twentyten' ) ); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
				<?php endif; ?>
			</div>

			<p class="muted">
				<?php twentyten_posted_on(); ?>
					|
				<?php if ( count( get_the_category() ) ) : ?>
					<?php printf( __( 'Posted in %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					|
					<?php printf( __( 'Tagged %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
				<?php endif; ?>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '| ', '' ); ?>
			</p>

			<hr />


				<div class="well">
						<?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ),$comments_link_attributes_css); ?>

					<?php
						if( $sa_settings['social_buttons'] == '1' ) : 
					?>
						<div class="post_social_buttons">
							<iframe src="http://www.facebook.com/plugins/like.php?app_id=124765724272783&amp;href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=lucida+grande&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:20px;" allowTransparency="true"></iframe>
							<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

							<div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div>
							<script type="text/javascript">
							  (function() {
							    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
							    po.src = 'https://apis.google.com/js/plusone.js';
							    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
							  })();
							</script>
						</div>
					<?php endif; ?>

				</div> <!-- /well -->




		<?php comments_template( '', true ); ?>

	</article>

	<?php
	// Block this part of the loop by setting $firstpost to '0'
		if( $sa_settings['compact_homepage'] == '1' && is_home() == true) { $firstpost = ''; }
	?>
		
	<?php
	// Compact home page if end
	 endif; ?>



<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div class="pagination">
		<ul>
			<li class="prev">
				<?php next_posts_link( __( '&larr; Older posts', 'twentyten' ) ); ?>
			</li>
			<li class="next">
				<?php previous_posts_link( __( 'Newer posts &rarr;', 'twentyten' ) ); ?>
			</li>
		</ul>
	</div>
<?php endif; ?>