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
 * @subpackage Bare
 * @since Bare 1.0
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
		<h1 class="post-title"><?php _e( 'Not Found', 'bare' ); ?></h1>
	<div id="post-0" class="post error404 not-found">
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'bare' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Bare we use the same loop in multiple contexts.
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

<?php while ( have_posts() ) : the_post(); ?>
<?php if(has_post_thumbnail() || 'video' == get_post_type() || 'book' == get_post_type()){ $has_img = 'has_img';} ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 <?php if(has_post_thumbnail()){ ?>
          <?php the_post_thumbnail( array(200,9999) );?>
      <?php  } else if ( 'video' == get_post_type() ){ ?>
          <img class="item-img" src="http://img.youtube.com/vi/<?php echo get_field('youtube_link') ?>/0.jpg"/>
<?php          } ?>
      <div class="post-text <?php echo $has_img; ?>">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'bare' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>

			</h2>
			<?php if (is_user_logged_in() && (!is_page())) {if (function_exists('wpfp_link')) { wpfp_link(); } } // 'fave this' link ?>

      <?php if(('post'==get_post_type())){?>
        <div class="author">By <?php the_author();?></div>
      <?php }?>
			<?php if (is_tag()) :
$pt = get_post_type();
$pt_link = get_post_type_archive_link($pt);
echo '<div class="cat-links"><a href="'.$pt_link.'" class="red">'.$pt.'</a></div><div class="arrow-right"></div>' ?>

			<?php endif; ?>

			<?php if (is_tag() || is_post_type_archive() || is_search() ) :?>

				<?php if ( count( get_the_category() ) ) : ?>
					<div class="cat-links">
						<?php printf( __( '<span class="%1$s"></span> %2$s', 'bare' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( '&nbsp;' ) ); ?>
					</div>
				<?php endif; ?>
				<?php if ( count( get_the_terms($post->ID, 'video-type') ) ) : ?>
					<div class="cat-links">
						<?php echo get_the_term_list($post->ID, 'video-type', ''); ?>
					</div>
				<?php endif; ?>
				<?php if ( count( get_the_terms($post->ID, 'book-types') ) ) : ?>
					<div class="cat-links">
						<?php echo get_the_term_list($post->ID, 'book-types', ''); ?>
					</div>
				<?php endif; ?>

			<?php endif; ?>



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

		</div><!-- #post-## -->
			<div class="entry-utility">
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<span class="tag-links">
						<?php printf( __( '<span class="%1$s">Find more:</span> %2$s', 'bare' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</span>
				<?php endif; ?>
			</div><!-- .entry-utility -->

		<?php comments_template( '', true ); ?>
<div class="clear"></div></div>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<?php if(function_exists('wp_paginate')){
          wp_paginate();
        }else{?>
        <div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'bare' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'bare' ) ); ?></div>
				</div><!-- #nav-below --><?php }?>
<?php endif; ?>
<div class="clear"></div>
