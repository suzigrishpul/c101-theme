<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bare 
 * @since Bare 1.0
 */

get_header(); ?>
		<div id="home-top">
			<div id="home-top-left">
				<?php //radslide(1); ?>
        <div id="radslide-1">
          <?php get_featured_content_for_slides(4);?>
        </div>
				<div id="pager"></div>
			</div>
			<div id="home-top-right">	
				<div id="videos">
					<div id="video-title">C-101 TV</div>
					<?php display_latest_video('medium'); ?>
				</div>
			</div>
		</div>

		<div id="left-column">
				
				<h1 class="entry-title">Latest Books & Articles</h1>
				<div class="clear"></div>
				<div id="content" role="main">
				<?php
				/* Run the loop to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-index.php and that will be used instead.
				 */
				 display_latest_everything(3) ;         

#				 display_latest_articles('post' , 3) ;         
				?>
					<div class="read-more"><a href="/analysis" class="read-more">Read More</a></div>
					<div class="clear"></div>
				</div><!-- #content -->

			<div id="twitter">
				<div id="twitter-title"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/c101-twitter_03.png" alt="Twitter Logo" /><span>Recent Tweets</span><div class="clear"></div></div>
				<div id="twitter-body"> <div id="last-tweet"><?php echo do_shortcode('[twitter-widget username="Conscien1" title="&nbsp;" items="1" showfollow="false" showintents="false" avatar="bigger"]'); ?> </div>

					<div id="twitter-follow"><a href="">Follow Us on Twitter @Conscien1</a></div>
					<div class="clear"></div>
				</div>
			</div>
		</div><!--left-column-->
		<div id="right-column">
                  <h1 class="entry-title-white"><a href="/podcasts">Latest Podcast</a></h1>
                  <div class="clear"></div>
                  <div id="content" class="dark" role="main">
                    <?php display_latest_podcast(1); ?>
<!--
                    <div class="iTunes"><a href="https://itunes.apple.com/us/podcast/conscientization-101/id973594847"><img src="<?php //bloginfo('template_directory'); ?>/images/PodcastiTunesButton.png" border=0 alt="Podcast Available on iTunes"></a></div> 
-->                    
                    <div class="read-more"><a href="/podcasts" class="read-more">Hear More</a></div>
                    <div class="clear"></div>
                  <div style="margin-top:20px;"> <h3>Podcast Available On:</h3>
                    <a href="https://itunes.apple.com/us/podcast/conscientization-101/id973594847" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/IT_button.png" border=0 alt="Podcast Available on iTunes" style="width: 250px;float:left;"></a>
                    <div style="float:left;padding:5px 10px;">and</div>
                    <a href="http://www.podcastdirectory.com/podcasts/conscientization-101-600016.html" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/PD_button.png" border=0 alt="Podcast Available on iTunes" style="width: 250px;float:left;"></a><br style="clear:both;">
                  </div>
                    
                  </div>

                  <h1 class="entry-title-white"><a href="/category/musical-news-analysis-commentarie/">Latest Commentary</a></h1>
                  <div class="clear"></div>
                  <div id="content" class="dark" role="main">
                    <?php $post = latest_post_category('musical-news-analysis-commentarie'); ?>
                    <div class="read-more"><a href="/category/musical-news-analysis-commentarie/" class="read-more">Hear More</a></div>
                    <div class="clear"></div>
                  </div>

                  <div id="tabs">
                    <div class="tab active" id="latest">Featured</div>
                    <div class="tab" id="tags">Tags</div>
                    <div class="tab-details active" id="latest-details"><div class="adjust"><?php get_featured_content_by_field(1,0);?><br />
                      <div class="read-more"><a href="/featured" class="read-more">Read More</a></div><div style="clear:both;"></div>
                    </div></div>
                    <div class="tab-details" id="tags-details"><div class="adjust"><?php wp_tag_cloud('smallest=10&largest=16&number=20&'); ?></div></div>
                    <div class="clear"></div>
                  </div>
                  <div class="clear"></div>
                  <script>
                    jQuery().ready(function(){
                      jQuery('#tabs .tab').click(function(){              
                          var swapString = jQuery(this).attr('id');
                          var contentId = '#'+swapString+'-details';
                          
                          jQuery('#tabs .tab').not(this).removeClass('active');  // select matches that are not this and remove active
                          jQuery(this).addClass('active');
                          jQuery('#tabs .tab-details').not(contentId).removeClass('active');  // similar to above but passing a reference to content
                          jQuery(contentId).addClass('active');                          
                      });
                    });
                  </script>
                </div><!--right-column-->
                <div class="clear"></div>
<?php get_footer(); 
