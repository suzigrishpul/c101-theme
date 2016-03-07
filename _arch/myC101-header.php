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

if ( is_singular( 'premium_post' ) && !(is_user_logged_in())) {
header('Location: /membership/subscription-benefits/?guest=true');
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
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
<div id="wrapper">
	<div id="container">
		<div id="header">
				<div id="social">
					<div id="social-buttons"><a href="https://twitter.com/Conscien1"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/twitter.png" alt="twitter" /></a><a href="http://www.facebook.com/Conscientization101"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/facebook.png" alt="facebook" /></a><a href="http://instagram.com/c101editors"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/instagram.png" alt="instagram"  /></a><a href="http://www.youtube.com/channel/UCY1fiJaq-j5LkKYSCzbsubA"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/youtube.png" alt="youtube" /></a><a href="http://feeds.feedburner.com/Conscientization101org"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/social_media/rss.png" alt="rss"  /></a></div>
					<div id="social-signup"><form action="" id="signup" method="get"><input type="text" id="email" name="email" value="Join Our Mailing List" onclick="if(this.value=='Join Our Mailing List'){this.value=''}" onblur="if(this.value==''){this.value='Join Our Mailing List'}"><input type="submit" value="Submit"></form></div>
				</div>
				<div id="menu">
				 <?php  wp_nav_menu( array('menu' => 'Main Menu' )); ?> 
				</div><!--menu-->
				<div id="banner">
					<a href="/">
					 <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/my_c101_banner.png" alt="Conscientization101 - An online magazine combining reflection, music & action through independent media"/>           
          </a>         
				</div><!--banner-->
		</div><!--header-->
				<div id="main">
