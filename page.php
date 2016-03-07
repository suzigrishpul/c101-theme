<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Bare 
 * @since Bare 1.0
 */

get_header(); ?>
		
		<div id="left-column">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>
					<div class="clear"></div>
					<div id="content" role="main">
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->
						<?php #comments_template( '', true ); ?>
					</div><!-- #content -->
				</div><!-- #post-## -->



<?php endwhile; ?>


		</div><!--left-column-->
		<div id="right-column">
				<?php get_sidebar(); ?>
		</div><!--right-column-->
<?php get_footer(); 
