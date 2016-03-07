<?php

if(php_sapi_name() !== 'cli') {
  die("Meant to be run from command line");
}

function find_wordpress_base_path() {
  $dir = dirname(__FILE__);
  do {
    //it is possible to check for other files here
    if( file_exists($dir."/wp-config.php") ) {
      return $dir;
    }
  } while( $dir = realpath("$dir/..") );
  return null;
}

define('BASE_PATH', find_wordpress_base_path() . "/");
define('WP_USE_THEMES', false);
global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header;
require(BASE_PATH . 'wp-load.php');

$users = get_users();

foreach($users as $key => $user) {
  $subscription_history = get_user_field('wp_s2member_paid_registration_times', $user->data->ID );
  arsort($subscription_history);
  $keys = array_keys($subscription_history);
  $recent_payment = $subscription_history[$keys[0]];

  $s2member_subscr_id = get_user_field('s2member_subscr_id', $user->data->ID);

  if($user->data->ID == 29 || $s2member_subscr_id == '' ){
    trigger_error('Subscriber Manager: Did with id:' . $user->data->ID . ' was NOT deleted becuase it is manually added or the dev user.' );
  }elseif( in_array( array('s2member_level1', 's2member_level2'), $user->roles) && strtotime("-32 days") > $recent_payment  ){
    $message = 'Subscriber Manager: Deleted user with id:' . $user->data->ID . '. Last payment was on ' . $recent_payment . '.';
    trigger_error( $message );
    mail('editors@c101magazine.com', 'Removing User', $message );

    $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->usermeta WHERE user_id = %d", $user->data->ID ) );
    $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->users WHERE ID = %d", $user->data->ID ) );
  }else{
    // This user is up to date
    trigger_error('Subscriber Manager: User with ID:' . $user->data->ID . ' was NOT deleted becuase this user is current.' );
  }
}
