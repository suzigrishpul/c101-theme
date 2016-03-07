<?php 
/*
  Template Name: myC101
*/

?>
<?php // include('myC101-header.php');?>
<?php
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
if(!((get_user_role())==('Make It Plain')||(get_user_role())==('The Praxis')||(get_user_role())==('administrator'))){
  header('Location: /membership/subscription-benefits?access=1');
  }  
  
   get_header(); ?>
<div class="my-c101-wrap">
  <div id="left-column">
    <div id="my_c101_fav_head" class="tabbed-title-area black">My Bookbag</div>
    <div id="small-tabs">
      <div id="all-tab">
        All
      </div>
      <div id="post-tab"> 
        Articles 
      </div>
      <div id="podcast-tab">      
        Podcasts
      </div>
      <div id="video-tab">
        Videos
      </div>
      <div id="book-tab">
        Books
      </div>    
    </div><br style="clear: both;"/>
    <div class="" id="favorites_area">
    <?php 
      
    do_shortcode('[wp-favorite-posts]');
    ?>
    <div id="favorites-tabbed-area">
      <ul>
      <script type="text/javascript">
        jQuery(document).ready(function(){
          jQuery('#all-tab').addClass('active');
         
          jQuery('#small-tabs div').click(function(){
            
            jQuery('#small-tabs div').removeClass('active');
            jQuery(this).addClass('active');
            $what_tab = jQuery(this).attr('id');
            
            if($what_tab == 'all-tab'){
              jQuery('.wpfp-span div.status-publish').addClass('show-fave');
            }
            else{
            $content_type = $what_tab.replace('-tab','');
            $content_selector = ".type-"+$content_type;
            //console.log($content_selector);
            
            jQuery('.wpfp-span div.status-publish').not($content_selector).addClass('hide-fave').removeClass('show-fave');
            jQuery('.wpfp-span div.status-publish'+$content_selector).addClass('show-fave').removeClass('hide-fave');
            }
            // hide all non matched types. 
            // clicking all will unhide all
            
          });
          
          
        });

      </script>
      </ul>
    </div>
    </div>
    <br class="clearfix" />
<?php 
  $role = get_user_role();
  if(($role=='The Praxis')||($role=='administrator')){ ?>

    <div class="left-column-child col-left" style="width:100%;float:none;">
      <div class="title-area green">Latest Uncut Podcasts</div>
      <?php display_uncut_podcast(2); ?>  
      <div class="read-more myc101"><a href="/uncut-podcast/" class="read-more">Hear More</a></div>
      <div class="clear"></div>
    </div>
      <div class="clear"></div>  
<br>
<?php }?>
    <div id="exclusive_content_area" style="width:100%;float:none;">
      <div class="title-area black">
        Exclusive Content
      </div>
      <?php  myC101_exclusive_new('post',10); ?>
      <?php  myC101_exclusive('post',5); ?>
    <br class="clearfix" />
    </div>    
    <br class="clearfix" />
  </div>
  <div id="right-column">
    <div id="my_account_area">
      <div class="title-area red">
      My Account
      </div>
      <div class="account-data">
        <div class="user-avatar">
<?php global $userdata; get_currentuserinfo(); echo get_avatar( $userdata->ID, 100 ); ?>
        </div>
        <div class="user-stats">
          <div class="info">
            <div class="small-title">
              account holder
            </div>
            <div class="user-content">
              <?php $currentUser = wp_get_current_user();
                echo $currentUser->display_name;
              ?>
            </div>
           </div>
           <div class="info">
            <div class="small-title">
              account level
            </div>
            <div class="user-content">
              <?php echo get_user_role();?>
              <?php if((get_user_role())==('Make It Plain')){
                echo '<a href="/membership/myconscientization/upgrade/" style="font-size: 14px;white-space: nowrap;">upgrade account</a>';
              }?>

              <?php if((get_user_role())==('The Praxis')||(get_user_role())==('administrator')){
                echo '<a href="/membership/myconscientization/downgrade/" style="font-size: 14px;white-space: nowrap;">downgrade account</a>';
              }?>

              <?php 
                  // ROLE BASE UPGRADE LINKS
                                    
              
              ?>
            </div>
           </div>
          </div>
          <br class="clearfix" />          
          <div style="width: 100%;clear: both;"><a href="/wp-admin/profile.php" class="small-title red edit-account">edit account information</a>
</div>

        </div>
      </div>
                <br class="clearfix" />          

    <div id="myC101_social_area">
      <div class="title-area red">Connect With Us</div>

        <a style="float:left;margin:0 8px;" href="http://www.facebook.com/Conscientization101" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/fb.png" alt="" /></a>
        <a style="float:left;margin:0 8px;" href="https://twitter.com/Conscien1" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/tw.png" alt="" /></a>
        <a style="float:left;" href="http://instagram.com/c101editors" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/in.png" alt="" /></a>
    </div>
    <br class="clearfix" />          
    <div class="left-column-child col-right">
<?php if ( function_exists ( dynamic_sidebar(1) ) ) : 
 dynamic_sidebar (1); 
endif; 
?>
    </div>
    <br class="clearfix" />
<?php  if(($role=='The Praxis')||($role=='administrator')){   ?>
    <div class="left-column-child col-right" style="width:100%;float:none;">      
      <div class="title-area green">Exclusive Multimedia</div>
      <?php display_latest_multimedia(1); ?>
      <div class="clear"></div>  
    </div>
<?php } ?>    
  </div>
</div>
<?php get_footer(); 
