<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bare 
 * @since Bare 1.0
 */

get_header(); ?>
		<div id="left-column">
<?php
	/* Queue the first post, that way we know
	 * what date we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>

			<h1 class="entry-title">
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'bare' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'bare' ), get_the_date('F Y') ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'bare' ), get_the_date('Y') ); ?>
<?php elseif ( is_tag() ) : ?>
        <?php	printf( __( '%s', 'bare' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
<?php elseif ( is_category() ) : ?>
        <?php	printf( __( '%s', 'bare' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
<?php elseif ( is_tax() ) : ?>
        <?php	printf( __( '%s', 'bare' ), '<span>' . single_term_title() . '</span>' ); ?>
<?php elseif ( is_post_type_archive() ) : ?>
        <?php	printf( __( '%s', 'bare' ), '<span>' . post_type_archive_title() . '</span>' ); ?>
<?php else : ?>
				<?php _e( 'Archive', 'bare' ); ?>
<?php endif; ?>
			</h1>			<div class="clear"></div>
			<div id="content" role="main">
<?php if(is_tag()){?>
     <div class="taxonomy-heading"> <?php  echo term_description(); ?></div>
<?php }?>
<?php if(is_tax()){?>
     <div class="taxonomy-heading"> <?php  echo term_description(); ?></div>
<?php }?>
                  <div> <h2>Podcast Available On:</h2>
                    <a href="https://itunes.apple.com/us/podcast/conscientization-101/id973594847" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/IT_button.png" border=0 alt="Podcast Available on iTunes" style="width: 250px;float:left;"></a>
                    <div style="float:left;padding:10px;"><br>and</div>
                    <a href="http://www.podcastdirectory.com/podcasts/conscientization-101-600016.html" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/PD_button.png" border=0 alt="Podcast Available on iTunes" style="width: 250px;float:left;"></a><br style="clear:both;">
                  </div>
<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	/* Run the loop for the archives page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-archives.php and that will be used instead.
	 */
	 get_template_part( 'loop', 'archive' );
?>
			</div><!-- #content -->
		</div><!--left-column-->
		<div id="right-column">
				<?php get_sidebar(); ?>
		</div><!--right-column-->
<?php get_footer(); 
