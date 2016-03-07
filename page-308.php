<?php
// SUBSCRIBER BENEFITS PAGE
/*
$_GET['access'] codes
1 = guest user, trying to access Level 1 paid content
2 = guest user, trying to access Level 2 paid content
3 = Level 1 user, trying to access Level 2 paid content

see guide to content access here: https://docs.google.com/spreadsheets/d/1GiQYkZoWOhahtNT0WLz1sokAun9PIYQN7wLNiTE8tsE/

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
<?php
if(@$_GET['access']==1){ ?>
<h2>RESTRICTED CONTENT</h2>
<p>You're trying to access content that is only available to paid members. See exclusive features listed below. To view this content, please sign in or become a member of our site.</p>
<div style="text-align:center;">
<a href="/wp-login.php" class="green button">Sign In</a>&nbsp;&nbsp;
<a href="#table" class="red button">Sign Up</a>
</div>
<?php } else
if(@$_GET['access']==2){
?>
<h2>RESTRICTED CONTENT</h2>
<p>You're trying to access content that is only available to 'The Praxis' members. See exclusive features listed below, and sign up for The Praxis subscription today for full access!</p>
<div style="text-align:center;">
<a href="/membership/forms/the-praxis/" class="red button">Sign Up for The Praxis</a>
</div>
</p>
<?php } else
if(@$_GET['access']==3){
?>
<h2>RESTRICTED CONTENT</h2>
<p>You're trying to access content that is only available to 'The Praxis' members. See exclusive features listed below, and upgrade to The Praxis subscription today for full access!</p>
<div style="text-align:center;">
<a href="/membership/forms/upgrade-to-the-praxis/" class="red button">Upgrade to The Praxis</a>
</div>
<?php } ?>

							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'bare' ), 'after' => '</div>' ) ); ?>
							<?php edit_post_link( __( 'Edit', 'bare' ), '<span class="edit-link">', '</span>' ); ?>
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
