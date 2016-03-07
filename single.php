<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Bare 
 * @since Bare 1.0
 */
  $now = strtotime("now");
  $two_weeks_ago = strtotime("-2 weeks");
  $posted_on = strtotime(get_the_date());
  $todays_date = date('F d, Y');

  if($two_weeks_ago>$posted_on){
    $old = true;
    $new = false;
  }
  else{
    $old = false;
    $new = true;
  } 
if (!in_category( 'news' )){ // 'news' category is free forever
  if (in_category( 'multimedia' ) && !current_user_can("access_s2member_level2")){  // 'multimedia' category is only for praxis
    header('Location: /membership/subscription-benefits?access=2'); // must be level 2!
  } else if(($old)&&(!is_user_logged_in())&&('post'==get_post_type())){
    header('Location: /membership/subscription-benefits?access=1'); // not a member? become a member!
  }
}
get_header(); ?>

<div id="left-column">
<?php
// $current_user = get_current_user_id();
 // if($current_user==1){
 
 // }
 ?>
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="post-title"><?php the_title(); ?></h1>
       
        <div class="entry-meta">
          <?php 
            bare_posted_on(); 
          ?>
        </div><!-- .entry-meta -->
         <?php if(('post'==get_post_type())||('premium_post'==get_post_type())){?>
      <div class="author">Published by: <?php the_author();?></div>       
    <?php }?>
                   
          <?php if(get_field('audio_link')){
          $audio_link = get_field('audio_link');
          $shortcode_str = '[audio mp3="'.$audio_link.'"][/audio]';  
          $download_link = "";
            
            echo "<div id='post_player'>";
            echo do_shortcode($shortcode_str);
            echo "</div>";
            if (current_user_can("access_s2member_level2")){ 
              echo "<div id='download_link_area'><a href='".$audio_link."' download='".$audio_link."' class='green button small full-width'>Download This Commentary</a></div>";      } else {

              if (current_user_can("access_s2member_level1")){ // Level 1 - upgrade
                echo "<div id='download_link_area'><a href='/membership/forms/upgrade-to-the-praxis/' class='red button small full-width'>Want to download this commentary? Upgrade to The Praxis!</a></div>"; 
              } else{ // Level 0 (guest) - join
                echo "<div id='download_link_area'><a href='/membership/forms/the-praxis/' class='red button small full-width'>Want to download this commentary? Become a Praxis Member!</a></div>";
              }
            }
            
                      };?>
          
        <div class="entry-content">
          <?php the_content(); ?>
          
           <?php if( get_field( 'amazon_link' ) ): ?>			
            <a href="<?php the_field('amazon_link'); ?>" id="amazon-link" target="_blank">Buy Now &raquo;</a>
          <?php endif; ?>
          <?php if (get_field('affiliate_link')){ ?>
            <?php if(get_field('itunes_or_mixtape')=='Itunes'){ ?>
              <a href="<?php the_field('affiliate_link');?>" class="itunes-link" target="_blank">Buy on iTunes &raquo;</a>
            <?php }else{?>
                <a href="<?php the_field('affiliate_link'); ?>" class="mixtape-link" target="_blank">Download Mixtape &raquo;</a>
            <?php }?>
          <?php }?>
          <?php if( get_field( 'downloadable_file' ) ) { ?>
            <div id='download_link_area'><a href='<?php the_field('downloadable_file'); ?>' download='<?php the_field('downloadable_file'); ?>' class='green button small full-width'>Download Now</a></div>
            
            
          <?php } ?>
          
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

      <?php comments_template( '', true ); ?>

        
      </div><!-- #post-## -->
<?php endwhile; // end of the loop. ?>

								</div><!-- #content -->
		</div><!--left-column-->
		<div id="right-column">
				<?php get_sidebar(); ?>
		</div><!--right-column-->
<?php get_footer(); 
