<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Bare
 * @since Bare 1.0
 */
 ?>
<?php
// Adding main.js file
wp_enqueue_script( 'c101_main', get_template_directory_uri() . '/js/main.js', array('jquery'), FALSE, FALSE );
 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="google-translate-customization" content="51b72100761f03a-79e42f3584da8eac-g9c9bf0e3596372d0-1d"></meta>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'bare' ), max( $paged, $page ) );

	?></title>
<!--
<link rel="profile" href="uri for xhtml profile" />
-->
<link href='http://fonts.googleapis.com/css?family=Bitter:400,400italic,700|Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>
<body <?php body_class(); ?>>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<div id="wrapper">
	<div id="container">
		<div id="header">

				<div id="social">
          <div id="header-login">
            <?php if(!is_user_logged_in()){?>
            <div id="header-not-logged-in" class="">
              <div class="log-in">
                <a href="<?php echo wp_login_url();?>">Login</a>
              </div>
              <div style="font-size: 20px; font-weight: bold;">&nbsp;|&nbsp;</div>
              <div class="sign-up">
                <a href="/subscription-benefits">Sign Up</a>
              </div>
            </div>
            <?php }else{?>
            <div id="header-logged-in" class="">
              <div class="information">
                Welcome &nbsp;&nbsp;<a href="/my-conscientization/"><?php $current_user=wp_get_current_user();
                echo $current_user->user_login; ?></a>
              </div>
              <div style="font-size: 20px; font-weight: bold;">&nbsp;|&nbsp;</div>
              <div>
                <a href="/">Home</a>
              </div>
              <div style="font-size: 20px; font-weight: bold;">&nbsp;|&nbsp;</div>
              <div>
                <a href="<?php echo wp_logout_url(); ?>">Logout</a>
              </div>
            </div>
            <?php }?>

          </div>
					<div id="social-buttons"><a href="https://twitter.com/Conscien1" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/twitter.png" alt="twitter" /></a><a href="http://www.facebook.com/Conscientization101" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/facebook.png" alt="facebook" /></a><a href="http://instagram.com/c101editors" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/instagram.png" alt="instagram"  /></a><a href="http://www.youtube.com/channel/UCY1fiJaq-j5LkKYSCzbsubA" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/youtube.png" alt="youtube" /></a><?php /*<a href="http://feeds.feedburner.com/Conscientization101org"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/rss.png" alt="rss"  /></a>*/?><a href="/feed/atom" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/rss.png" alt="rss"  /></a></div>
					<div id="social-signup"><div id="mc_embed_signup"><form action="http://conscientization101.us3.list-manage.com/subscribe/post?u=dbea5d521fe90f53fdb877b10&amp;id=f6086e9b8a" id="mc-embedded-subscribe-form" method="post"><input type="text" id="mce-EMAIL" name="EMAIL" value="Join Our Mailing List" onclick="if(this.value=='Join Our Mailing List'){this.value=''}" onblur="if(this.value==''){this.value='Join Our Mailing List'}"><input type="submit" value="Submit" name="subscribe" id="mc-embedded-subscribe"></form></div></div>

				</div>
				<div id="menu">
				 <?php  wp_nav_menu( array('menu' => 'Main Menu' )); ?>
				</div><!--menu-->
				<div id="banner">
					<?php if(is_user_logged_in()){?>
            		<a href="/my-conscientization/">
					 <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/my_c101_banner.png" alt="Conscientization101 - An online magazine combining reflection, music &amp; action through independent media"/>
          </a>
          <?php }else{ ?>
          <a href="/">
					 <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/c101-banner_03-01.jpg" alt="Conscientization101 - An online magazine combining reflection, music &amp; action through independent media"/>
          </a>
          <a href="/membership/subscription-benefits" class="subscribe-overlay"><img src="<?php bloginfo('stylesheet_directory');?>/images/transparent.png"/></a>
          <?php }?>
				</div><!--banner-->
		</div><!--header-->
				<div id="main">
