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

<?php
$firstpost = true;

 if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="video-single">
				  <iframe width="632" height="365" src="http://www.youtube.com/embed/<?php _e(get_field('youtube_link'));	?>" frameborder="0" allowfullscreen>
     		</iframe>
     		</div>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="clear"></div>
					<div id="content" role="main">

						<div class="entry-content">
							<h1 class="post-title"><?php the_title(); ?></h1>
<?php if (is_user_logged_in()) {if (function_exists('wpfp_link')) { wpfp_link(); } }?> 
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
            
              
					<div class="entry-utility">
						<?php 
							bare_posted_in(); 
						?>
					</div><!-- .entry-utility -->
		
					</div><!-- .entry-content -->
						<?php # comments_template( '', true ); ?>
					</div><!-- #content -->

				  <h2 class="entry-title red">Related Videos</h2>
					<div id="content" class="dark">
					  <?php
   if ( $firstpost ) {
        $vid_tax = get_the_terms($post->ID,'video-type'); 
        $vid_tax = array_shift($vid_tax);        
        $vid_tax = $vid_tax->slug;        
        $related_posts = get_posts(array('video-type'=>$vid_tax, 'post_type'=>'video','numberposts'=>6,'post__not_in' => array( $post->ID )));

        # Output ad-hod Loop content, e.g.
        ?>
        <?php
        foreach ( $related_posts as $related_post ) { ?>
          <div class="related-vid">
            <a class="related-vid-title" href="<?php echo get_permalink( $related_post->ID ); ?>"><img class="related-vid-img" src="http://img.youtube.com/vi/<?php _e(get_field('youtube_link', $related_post->ID));	?>/0.jpg"/></a>
            <a class="related-vid-title" href="<?php echo get_permalink( $related_post->ID ); ?>"><?php echo $related_post->post_title; ?></a>
          </div>
        <?php } ?>
    <?php }
echo '<div class="clear"></div>';
   $firstpost = false;
   
?>
					<div class="read-more"><a href="/video-type/<?php echo $vid_tax; ?>" class="read-more">Watch More</a></div><div class="clear"></div>
					</div>
									<?php  comments_template( '', true ); ?>
				</div><!-- #post-## -->



<?php endwhile; ?>


		</div><!--left-column-->
		<div id="right-column">
				<?php get_sidebar(); ?>
		</div><!--right-column-->
<?php get_footer(); 
