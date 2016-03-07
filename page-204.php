<?php
// USER PORTAL PAGE

get_header(); ?>
		
		<div id="left-column">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="clear"></div>
					<div id="content" role="main">
						<div class="entry-content">
              <?php if (is_user_logged_in() == false){
                echo 'Please <a href="/wp-login.php?action=register">become a subscriber</a> to save your favorite content on our site!';
              } else { 
                the_content(); 
                } ?>							
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
