<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage wpbootstrap
 * @since wpbootstrap 0.1
 */

get_header(); ?>

<div class="row">
  <div class="span11 columns">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<article>
					<div class="page-header">
						<h1>
							<?php the_title(); ?>
						</h1>
					</div> <!-- /page-header -->
					<p class="muted">
						<?php twentyten_posted_on(); ?>
					</p>
					
					<hr />
		
					<div class="post_content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>

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

					<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
						<div class="author_box box clearfix">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 80 ) ); ?>
							<h2><?php printf( esc_attr__( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
							<p><?php the_author_meta( 'description' ); ?></p>
						</div>
					<?php endif; ?>




					<?php 
						global $sa_options;
						$sa_settings = get_option( 'sa_options', $sa_options );
					?>
					<?php
						if( $sa_settings['social_buttons'] == '1' ) : 
					?>
				<div class="well clearfix">

					<div class="box_count">
						<iframe src="http://www.facebook.com/plugins/like.php?app_id=146466722109827&amp;href=<?php the_permalink(); ?>&amp;send=false&amp;layout=box_count&amp;width=90&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:62px;" allowTransparency="true"></iframe>
					</div>

					<div class="box_count">
						<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-count="vertical">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
					</div>

					<div class="box_count">
						<g:plusone size="tall" href="<?php the_permalink(); ?>"></g:plusone>
						<script type="text/javascript">
						  (function() {
						    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
						    po.src = 'https://apis.google.com/js/plusone.js';
						    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
						  })();
						</script>
					</div>
				
				</div> <!-- /well -->
					<?php endif; ?>


				<?php comments_template( '', true ); ?>
	</article>

<?php endwhile; // end of the loop. ?>

  </div>
  <div class="span5 columns">
		<?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>