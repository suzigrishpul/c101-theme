<?php
/*
  Template Name: Login
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
							<h2>Sign In</h2>
<?php $args = array(
        'redirect'       => site_url('/my-conscientization') 
); ?> 
 <?php wp_login_form( $args ); ?> 

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
