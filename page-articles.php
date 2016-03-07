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

		<div id="left-column" class="post-archive">
<h1 class="entry-title">Articles</h1>
<div class="clear"></div>
<div id="content" role="main">
<?php
wp_reset_postdata();

//Query Args
$args = array('post_type'=>'post', 'category__not_in' =>  array( 1036 ));

// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {

	// An individual post
  while ( $the_query->have_posts() ) {
		$the_query->the_post();

    ?>
    <div id="post-<?php the_ID();?>" <?php post_class();?>>
    <?php
    if(has_post_thumbnail()){
      $has_img = 'has_img';
      the_post_thumbnail( array(200,9999) );
    }else{$has_img ='no_img';}
		?>

      <div class="post-text <?php echo $has_img; ?>">
        <h2 class="entry-title"><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'bare' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title();?></a></h2><?php if (is_user_logged_in()) {if (function_exists('wpfp_link')) { wpfp_link(); } }?>

        <div class="author">By <?php the_author();?></div>

       <div class="entry-meta">
				<?php bare_posted_on(); ?>
        </div>

          <?php if (count(get_the_category() ) ):?>
            <div class="cat-links">
                <?php printf( __( '<span class="%1$s"></span> %2$s', 'bare' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ' ' ) ); ?>
            </div>
          <?php endif;?>
          <div class="entry-summary">
            <?php the_excerpt();?></em></i></strong></bold>
          </div>
      </div>
<!-- <div class="entry-utility">
				<?php /*
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<span class="tag-links">
						<?php printf( __( '<span class="%1$s">Find more:</span> %2$s', 'bare' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</span>
				<?php endif; ?>
<!-- 				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'bare' ), __( '1 Comment', 'bare' ), __( '% Comments', 'bare' ) );*/ ?></span>

			</div><!-- .entry-utility -->
      <br style="clear: both;"/>

    </div>
    <?php
  }
  // End individual post

} else {
	// no posts found
  echo 'No Articles found';
}

wp_reset_postdata();?>


		</div><!--left-column-->
  </div>
		<div id="right-column">
				<?php get_sidebar(); ?>
		</div><!--right-column-->
<?php get_footer();
