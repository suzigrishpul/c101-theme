<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Bare 
 * @since Bare 1.0
 */

get_header(); ?>


		<div id="left-column">	
		
		<h1 class="entry-title">
		<?php	printf( __( 'Tag Archives: %s', 'bare' ), '<span>' . single_tag_title( '', false ) . '</span>' );
				?></h1><div class="clear"></div>
			<div id="content" role="main">
<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>
			</div><!-- #content -->
		</div><!--left-column-->
		<div id="right-column">
				<?php get_sidebar(); ?>
				<div class="clear"></div>
		</div><!--right-column-->
		<div class="clear"></div>
<?php get_footer(); 
