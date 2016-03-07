<div id="sidebar">
<?php echo get_menu_children('Main Menu', $post->ID) ?>
<ul>
<?php echo custom_tax_list('video', 'video-type');  ?>
<?php echo custom_tax_list('book', 'book-types');  ?>


<?php// if ( function_exists ( dynamic_sidebar(1) ) ) : 
// dynamic_sidebar (1); 
//endif; 
?>
<li>
  <div id="video-inside"><div id="videos">
    <div id="video-title">C-101 TV</div>
    <?php display_latest_video(); ?>
    </div>
  </div>
</li>

<li>
  <a href="/membership/subscription-benefits"><img src="/wp-content/uploads/c101-subscribe-button_03.png"></a>
</li> 

<li>
  <?php echo get_menu_children('Main Menu', $post->ID) ?>
</li>

<li>
   <div id="tabs">
        <div class="tab active" id="latest">Featured</div>
        <div class="tab" id="popular">Popular</div>
        <div class="tab" id="tags">Tags</div>
        <div class="tab-details active" id="latest-details"><div class="adjust"><?php get_featured_content_by_field(2,0);?><br />
<div class="read-more"><a href="/featured" class="read-more">Read More &raquo;</a></div>
</div></div>
        <div class="tab-details" id="popular-details"><div class="adjust">Popular</div></div>
        <div class="tab-details" id="tags-details"><div class="adjust"><?php wp_tag_cloud('smallest=10&largest=16&number=20&'); ?></div></div>
        <div class="clear"></div>
      </div><div class="clear"></div>
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
</li>

<li>
<!-- PayPal Logo --><table border="0" cellpadding="10" cellspacing="0" align="center" class="paypal-table" style="margin: 20px auto;"><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_secured_by_pp_2line.png" border="0" alt="Secured by PayPal"></a><div style="text-align:center"><a href="https://www.paypal.com/webapps/mpp/how-paypal-works"></a></div></td></tr></table><!-- PayPal Logo -->
</li>
</ul>
<br style="clear: both;" />
</div>
