<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Bare 
 * @since Bare 1.0
 */
if ( ! is_user_logged_in() ) {
header('Location: /membership/subscription-benefits?access=1'); // not a member? become a member!
}
else if (!current_user_can("access_s2member_level2")){ 
header('Location: /membership/subscription-benefits?access=3'); // not a Praxis member? become a Praxis member!
}
get_header(); ?>

<div id="left-column">

			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="post-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php 
							bare_posted_on(); 
						?>
					</div><!-- .entry-meta -->

					<div class="entry-content">
						<?php the_content(); ?>
            
             <?php if( get_field( 'amazon_link' ) ): ?>			
              <a href="<?php the_field('amazon_link'); ?>" id="amazon-link" target="_blank">Buy This Book &raquo;</a>
				    <?php endif; ?>
            <?php if (get_field('affiliate_link')){ ?>
              <?php if(get_field('itunes_or_mixtape')=='Itunes'){ ?>
                <a href="<?php the_field('affiliate_link');?>" class="itunes-link" target="_blank">Buy on iTunes &raquo;</a>
              <?php }else{?>
                  <a href="<?php the_field('affiliate_link'); ?>" class="mixtape-link" target="_blank">Download Mixtape &raquo;</a>
              <?php }?>
            <?php }?>

					</div><!-- .entry-content -->

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'bare_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'bare' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'bare' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
<?php endif; ?>

				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

								</div><!-- #content -->
		</div><!--left-column-->
		<div id="right-column">
				<?php get_sidebar(); ?>
		</div><!--right-column-->
<?php get_footer(); 
