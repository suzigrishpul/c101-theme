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
<h1 class="entry-title">Articles</h1>
<div class="clear"></div>
<div id="content" role="main">
<?php

$args = array(
	'post_type' => 'post'
);
// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {

	while ( $the_query->have_posts() ) {
 if(has_post_thumbnail()){ $has_img = 'has_img';} ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 <?php if(has_post_thumbnail()){ ?>
      <div class="post-text <?php echo $has_img; ?>">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'bare' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<?php if (is_tag() || is_post_type_archive() || is_search() ) :?>

				<?php if ( count( get_the_category() ) ) : ?>
					<div class="cat-links"> 
						<?php printf( __( '<span class="%1$s"></span> %2$s', 'bare' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					</div>
				<?php endif; ?>
				<?php if ( count( get_the_terms($post->ID, 'category') ) ) : ?>
					<div class="cat-links">
						<?php echo get_the_term_list($post->ID, 'category', ''); ?>
					</div>
				<?php endif; ?>

			<?php endif; ?>
			
			<?php if (is_user_logged_in() && (!is_page())) {if (function_exists('wpfp_link')) { wpfp_link(); } } // 'fave this' link ?>      


			<div class="entry-meta">
				<?php 
					bare_posted_on(); 
				?>
			</div><!-- .entry-meta -->

	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bare' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'bare' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
	<?php endif; ?>

			<div class="entry-utility">
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<span class="tag-links">
						<?php printf( __( '<span class="%1$s">Find more:</span> %2$s', 'bare' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</span>
				<?php endif; ?>
<!-- 				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'bare' ), __( '1 Comment', 'bare' ), __( '% Comments', 'bare' ) ); ?></span>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->
<?php	}
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();?>


		</div><!--left-column-->
		<div id="right-column">
				<?php get_sidebar(); ?>
		</div><!--right-column-->
<?php get_footer(); 
