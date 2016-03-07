<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Bare 
 * @since Bare 1.0
 */

get_header(); ?>

<div id="left-column">

			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="post-title"><?php the_title(); ?></h1>
          <?php if (is_user_logged_in()) {if (function_exists('wpfp_link')) { wpfp_link(); } }?>     
 <?php if(has_post_thumbnail()){ 
  the_post_thumbnail('medium'); 
  }?>

					<div class="entry-content">
						<?php the_content(); ?>
			     <?php if( get_field( 'link' ) ): ?>			
				    <a href="<?php the_field('link'); ?>" id="amazon-link" target="_blank">Buy This Book &raquo;</a>
				    <?php endif; ?>
					<div class="entry-utility">
						<?php 
							bare_posted_in(); 
						?>
					</div><!-- .entry-utility -->

					</div><!-- .entry-content -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'bare' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'bare' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->

				<?php  comments_template( '', true ); ?>


				</div><!-- #post-## -->


<?php endwhile; // end of the loop. ?>

								</div><!-- #content -->
		</div><!--left-column-->
		<div id="right-column">
				<?php get_sidebar(); ?>
		</div><!--right-column-->
<?php get_footer(); 
