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
            
<?php 
if ( get_field('uncut_version') ) {
  if (current_user_can("access_s2member_level2")){ 
    echo '<a class="green button small" href="'. get_field('uncut_version') .'">Listen to the Full Interview &raquo;</a>';
  } else {
    if (current_user_can("access_s2member_level1")){ // Level 1 - upgrade
      echo '<a class="red button small" href="/membership/forms/upgrade-to-the-praxis/">Want to listen to the Full Interview? Upgrade to The Praxis!</a>';
    } else{ // Level 0 (guest) - join
      echo '<a class="red button small" href="/subscription-benefits/?access=2">Want to listen to the Full Interview? Become a Praxis Member!</a>';
    }
  }
}    
?>            
                  <div> <h2>Podcast Available On:</h2>
                    <a href="https://itunes.apple.com/us/podcast/conscientization-101/id973594847" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/IT_button.png" border=0 alt="Podcast Available on iTunes" style="width: 250px;float:left;"></a>
                    <div style="float:left;padding:10px;"><br>and</div>
                    <a href="http://www.podcastdirectory.com/podcasts/conscientization-101-600016.html" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/PD_button.png" border=0 alt="Podcast Available on iTunes" style="width: 250px;float:left;"></a><br style="clear:both;">
                  </div>
					</div><!-- .entry-content -->

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
