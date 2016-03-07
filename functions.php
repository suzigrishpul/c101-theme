<?php
add_theme_support( 'post-thumbnails' );
add_image_size( 'slide', 500, 300, true );
add_image_size('book-thumb', 110, 9999);
add_theme_support( 'automatic-feed-links' );


function query_post_type($query) {
  if(is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $post_type = get_query_var('post_type');
    if($post_type)
    $post_type = $post_type;
    else
    $post_type = array('post','articles','video',
    'new-article',
    'article',
    'nav_menu_item','nav_menu_item','uncut-podcast','podcast');
    $query->set('post_type',$post_type);
    return $query;
  }
}
add_filter('pre_get_posts', 'query_post_type');


function improved_trim_excerpt($text) { // Fakes an excerpt if needed
  global $post;
  if ( '' == $text ) {
    $text = get_the_content('');
    $text = apply_filters('the_content', $text);
    $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
    $text = str_replace('\]\]\>', ']]&gt;', $text);
    $text = strip_tags($text);  // takes a second argument to exclude tag
    $excerpt_length = 55;
    $words = explode(' ', $text, $excerpt_length + 1);
    if (count($words)> $excerpt_length) {
      array_pop($words);
      array_push($words, '...');
      $text = implode(' ', $words);
    }
  }
  return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');


function new_excerpt_more( $more ) {
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


function register_c101_menus(){
  register_nav_menus(
  array(
    'header-menu' => __( 'Main Menu' )
    )
  );
}
add_action( 'init', 'register_c101_menus' );


if ( function_exists('register_sidebar') ){

  $args = array(
    'name'          => __( 'Survey', 'theme_text_domain' ),
    'id' => 'sidebar-1',
    'description'   => '',
    'class'         => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<div class="title-area red">',
    'after_title'   => '</div>' );
    register_sidebar($args);
  }


  if ( ! function_exists( 'bare_posted_in' ) ) :
    /**
    * Prints HTML with meta information for the current post (category, tags and permalink).
    */
    function bare_posted_in() {
      $tags_list = get_the_tag_list( '', ', ' );
      if ( $tags_list ):
        echo	'<span class="tag-links">';
        printf( __( '<span class="%1$s">Find more:</span> %2$s', 'bare' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
        echo '</span>';
      endif;
    }
  endif;

  if ( ! function_exists( 'bare_posted_on' ) ) :
    /**
    * Prints HTML with meta information for the current post—date/time and author.
    */
    function bare_posted_on() {
      printf( __( '%2$s', 'bare' ),
      'meta-prep meta-prep-author',
      sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
      get_permalink(),
      esc_attr( get_the_time() ),
      get_the_date()
    ),
    sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
    get_author_posts_url( get_the_author_meta( 'ID' ) ),
    sprintf( esc_attr__( 'View all posts by %s', 'bare' ), get_the_author() ),
    get_the_author()
    )
  );
}
endif;

function get_menu_children($menu, $page){
  // get the menu by the name specified
  $menu = wp_get_nav_menu_items($menu);
  // check if the page we are looking at is in the menu
  $menu_items = wp_list_pluck( $menu, 'object_id' );
  $in_menu = in_array( (int) $page, $menu_items );

  if($in_menu) { // if it's in the menu loop through all the item to get it's details
    echo '<div id="inside-menu-sidebar"><ul>';

    foreach($menu as $item){
      // if we're on a child page show others with same parent
      if(($item->object_id == $page) && ($item->menu_item_parent != 0)) {
        $parent_id = $item->menu_item_parent;
      } else if (($item->object_id == $page) && ($item->menu_item_parent == 0)) {
        // if we're on a top level pages show children
        $parent_id = $item->ID;
      }
    }
    foreach($menu as $item){
      if($item->menu_item_parent == $parent_id) {
        if($page == $item->object_id) {
          echo '<li class="submenu current-menu-item"><a href="'.$item->url.'">'. $item->title.'</a></li>';
        } else {
          echo '<li class="submenu"><a href="'.$item->url.'">'. $item->title.'</a></li>';
        }
      }
    }
    echo '</ul></div>';
  }
}


function display_latest_posts($category_id,$count) {
  global $post;
  $posts = get_posts(array('numberposts'=>$count));
  if(sizeof($posts) > 0) {
    // $post = $posts[0];
    setup_postdata($posts);
    foreach ($posts as $post) {
      ?>
      <div class="feature-item">
        <?php if(has_post_thumbnail()){ ?>
          <?php the_post_thumbnail('thumbnail'); ?>
          <?php
        }
        ?>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="feature-date"><?php echo get_the_date(); ?> <?php the_category(); ?> </div>
      </div>
      <div class="clear"></div>
      <?php
    }
  }
  wp_reset_query();
  return '';
}


function display_latest_everything($count){

  $args = array(
    'post_type' => array( 'post', 'book' ),
    'posts_per_page' => $count,
    'category__not_in' =>  array( 1036 )
  );

  $the_query = new WP_Query( $args );
  if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  <div class="feature-item">
    <?php if(has_post_thumbnail()){ ?>
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(200,9999) ); ?></a>
      <?php } ?>
      <div style="float:left;max-width: 470px;">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php
        $pt = get_post_type();
        $pt_link = get_post_type_archive_link($pt);
        if ($pt == 'post'){
          $pt = 'Article';
          $pt_link = '/articles';
        }
        echo '<div class="type-links"><a href="' . $pt_link . '">' . $pt . '</a></div>' ;
        ?>
        <?php if(('post'==get_post_type())){?>
          <div class="author">Published by: <?php the_author();?></div>
          <div class="feature-date"><?php echo get_the_date(); ?></div>
          <?php }?>
          <div style="clear:both;"><?php echo get_the_excerpt(); ?> </div></em></i></strong></bold>
        </div>
      </div>
      <div class="clear"></div>
      <?php
    endwhile;
  endif;
  wp_reset_query();
}


function display_latest_articles($type, $count){
  $args = array(
    'post_type'=> $type,
    'posts_per_page' => $count
  );

  $the_query = new WP_Query( $args );
  if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  <div class="feature-item">
    <?php if(has_post_thumbnail()){ ?>
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
      <?php
    }
    ?>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php if(('post'==get_post_type())||('premium_post'==get_post_type())){?>
      <div class="author">Published by: <?php the_author();?></div>
      <?php
    }
    ?>
    <div class="feature-date"><?php echo get_the_date(); ?></div>
    <div><?php echo get_the_excerpt(); ?> </div></em></i></strong></bold>
  </div>
  <div class="clear"></div>
<?php endwhile; endif;
wp_reset_query();
}

function get_latest_videos($limit = 1) {
  global $wpdb;
  $results = array();
  $query = $wpdb->prepare("SELECT ID FROM " . $wpdb->prefix . 'posts' . " WHERE post_type = \"%s\" AND post_status = \"%s\" ORDER BY post_date DESC LIMIT " . $limit, 'video', 'publish');
  $ids = $wpdb->get_col($query);

  foreach($ids as $id) {
    $query = $wpdb->prepare("SELECT `meta_value` FROM `" . $wpdb->prefix . 'postmeta' . "` WHERE `post_id` = %s AND `meta_key` = %s LIMIT 1;", $id, 'youtube_link');
    $temp = $wpdb->get_col($query);
    $results[] = array_shift($temp);
  }

  return $results;
}

function display_latest_video($size = 'small', $limit = 1, $echo = true) {
  $videos = get_latest_videos($limit);
  $html = '';
  foreach($videos as $video) {
    $html .= '<div class="video-item"><iframe ';
    if($size == 'medium') $html .= 'width="350" height="225" ';
    if($size == 'large') $html .= 'width="632" height="365" ';
    if($size == 'small') $html .= 'width="310" height="174" ';
    $html .= 'src="http://www.youtube.com/embed/' . $video . '" frameborder="0" allowfullscreen></iframe></div>';
  }

  if(!$echo) return $html;
  echo $html;
}

/*
function display_latest_podcast

@argument $count
*/

function display_latest_multimedia($count) {
  $args = array(
    'posts_per_page' => $count,
    'category_name' => 'multimedia'
  );

  $the_query = new WP_Query( $args );
  if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  <div class="multi-content">
    <?php if(has_post_thumbnail()){ ?>
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(200,9999) ); ?></a>
      <?php } ?>
      <div style="float:left;max-width: 170px;margin-bottom:10px;">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </div>
    </div>
    <div class="clear"></div>
  <?php endwhile; endif; wp_reset_query();
  echo '<div class="read-more myc101"><a href="/category/multimedia" class="read-more">See More</a></div>';
  return '';
}


function display_latest($type, $count = 1, $echo = true) {
  $posts = get_posts(array('numberposts'=>$count, 'post_type'=>$type));
  if(sizeof($posts) > 0) {
    setup_postdata($posts);
    $html = front_page_content($posts);
  }
  if($echo) {
    echo $html;
  } else {
    return $html;
  }
}

function front_page_content($posts) {
  global $post;
  $html = '';
  foreach ($posts as $post) {
    if( get_the_powerpress_content() ) {
      $html .= '<div class="pod-item">';
      if(has_post_thumbnail()){
        $html .=  '<div class="pod-img"><a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID,'book-thumb').'</a></div>';
      }

      $html .= '<div class="pod-content"><h2 class="pod-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
      $html .= '<div class="pod-date">'.get_the_date().'</div></div><br style="clear:both;"/>';
      $html .= '<div class="pod-desc">'.get_the_excerpt().'</div>';

      $html .= get_the_powerpress_content();
      $html .= '</div>';
    }
  }
  wp_reset_query();
  return $html;
}

function display_latest_podcast($count) {
  return display_latest('podcast', $count);
}


/*
function display_uncut_podcast
displays uncut podcasts as post
@argument $count = count of uncut podcasts to display
*/

function display_uncut_podcast($count) {
  global $post;
  $posts = get_posts(array('numberposts'=>$count, 'post_type'=>'uncut-podcast'));
  if(sizeof($posts) > 0) {
    $html = '';
    setup_postdata($posts);
    foreach ($posts as $post) {
      if( get_the_powerpress_content() ) {
        $html .= '<div class="pod-item">';
        if(has_post_thumbnail()){
          $html .=  '<div class="pod-img"><a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID,'book-thumb').'</a></div>';
        }

        $html .= '<div class="pod-content"><h2 class="pod-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
        $html .= '<div class="pod-desc">'.get_the_excerpt().'</div>';
        $html .= '<div class="pod-date">'.get_the_date().'</div></div><br style="clear:both;"/>';
        $html .= get_the_powerpress_content();
        $html .= '</div>';
      }
    }
  }
  echo $html;
  wp_reset_query();
}


/*
function namespace_add_custom_types
registers custom posts so they can be used in mixed content type loops
*/

function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
      'post',
      'video',
      'new-article',
      'article',
      'nav_menu_item',
      'book',
      'podcast',
      'uncut-podcast'
    ));
    return $query;
  }
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

// get taxonomies terms links
function custom_taxonomies_terms_links(){
  // get post by post id
  $post = get_post( $post->ID );

  // get post type by post
  $post_type = $post->post_type;

  // get post type taxonomies
  $taxonomies = get_object_taxonomies( $post_type, 'objects' );

  $out = array();
  foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

    // get the terms related to post
    $terms = get_the_terms( $post->ID, $taxonomy_slug );

    if ( !empty( $terms ) ) {
      $out[] = "<h2>" . $taxonomy->label . "</h2>\n<ul>";
      foreach ( $terms as $term ) {
        $out[] =
        '  <li><a href="'
        .    get_term_link( $term->slug, $taxonomy_slug ) .'">'
        .    $term->name
        . "</a></li>\n";
      }
      $out[] = "</ul>\n";
    }
  }

  return implode('', $out );
}


/*
function get_post_count_by_cat

@argument $cat = category
*/

function get_post_count_by_cat($cat) {
  global $wpdb;
  $post_count = 0;

  $querystr = "
  SELECT count
  FROM $wpdb->term_taxonomy, $wpdb->posts, $wpdb->term_relationships
  WHERE $wpdb->posts.ID = $wpdb->term_relationships.object_id
  AND $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id
  AND $wpdb->term_taxonomy.term_id = $cat
  AND $wpdb->posts.post_status = 'publish'
  ";
  $result = $wpdb->get_var($querystr);
  $post_count += $result;

  return $post_count;
}
function get_taxonomy_list_for_custom_post_type(){


}
function get_featured_content_by_category(){

}


/*
function get_featured_content_by_field
@argument $count = amount of items to return
@argument $offset = offset from most recently updated
*/
function get_featured_content_by_field($count,$offset=0){
  wp_reset_postdata();
  $iterator = 0;
  $args = array(
    'posts_per_page' => $count,
    'offset' => $offset,
    'post_type' => array('video','post','article','podcast','book','uncut-podcast'),
    'meta_query' => array(
      array(
        'key' => 'featured_item',
        'value' => 'isFeatured',
        'compare' => 'LIKE'
      )
    )
  );


  $the_query = new WP_Query($args);

  // The Loop
  if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
      //	while($iterator<$count){
      echo '<div class="item-wrapper">';

      $the_query->the_post();
      echo '<h3><a href="'.get_post_permalink().'">' . get_the_title() . '</a></h3>';
      echo '<p>' .the_excerpt().'</em></i></strong></bold></p>';
      #    echo '<a href="'.get_post_permalink().'" class="read-more">Read More</a><br />';
      echo '</div>';

      //$iterator++;
      //}
    }
  } else {
    // no posts found
  }
  /* Restore original Post Data */
  wp_reset_postdata();

}


/*
function get_featured_content_for_slides
function returns set of featured content as slides
slide dimensions: 500x300
*/
function get_featured_content_for_slides($count,$offset=0){
  wp_reset_postdata();
  $iterator = 0;
  $args = array(
    'posts_per_page' => $count,
    'offset' => $offset,
    'post_type' => array('video','post','article','podcast','book'),
    'meta_query' => array(
      array(
        'key' => 'featured_item',
        'value' => 'isFeatured',
        'compare' => 'LIKE'
      )
    )
  );


  $the_query = new WP_Query($args);

  // The Loop
  if ( $the_query->have_posts() ) { // if has posts
    while ( $the_query->have_posts() ) {

      $the_query->the_post();
      $image = get_field('featured_slide_image');
      $my_blurb = get_field('featured_slide_text');
      $slide_path = $image['sizes']['slide'];

      if($image){
        echo '<div class="radslide">'; // Slide wrapper
        //echo $slide_path;
        //var_dump($image);
        echo '<div class="wrap">';
        echo '<a href="'.get_post_permalink().'">'; // Link wrap
        echo '<img src="'.$slide_path.'"  alt="'.$my_blurb.'"/>';
        echo '</a>';
        echo '<span class="blurb">';
        echo '<a href="'.get_post_permalink().'">';
        echo $my_blurb;
        echo '</a></span>';
        //echo '<h3><a href="'.get_post_permalink().'">' . get_the_title() . '</a></h3>';
        //echo '<p>' .the_excerpt().'</p>';
        echo '</div>';
        echo '</div>';	// End Slide wrapper
      }else{return;}


    }
  } else {  // if no posts
    // no posts found
  }
  /* Restore original Post Data */
  wp_reset_postdata();
}


/*
function custom_tax_list
@argument $type = post type
@argument $tax = parent taxonomy term
*/

function custom_tax_list($type, $tax){
  $html = '';
  if(is_post_type_archive($type) || is_singular($type) || is_tax($tax) ){
    $html =  '<li id="inside-menu-sidebar"><ul>';
    $terms = get_terms($tax, 'orderby=name&order=ASC&hide_empty=0');
    $count = count($terms);
    if ( $count > 0 ){
      foreach ( $terms as $term ) {
        if(is_tax( $tax, $term->name )){
          $class="current-menu-item";
        } else {
          $class="";
        }
        is_wp_error( $term_link = get_term_link($term)) ? '' : $term_link;
        $html .= '<li class="'.$class.'"><a href="'.$term_link.'">'. $term->name.'</a></li>';
      }
    }
    $html .= '</ul></li>';
  }

  return $html;
}


/*
function cat_list
@argument $type = post type
@argument $tax = parent taxonomy term
*/

function cat_list($type, $tax){
  $html = '';
  if(is_page('1357') ){
    $html =  '<li id="inside-menu-sidebar"><ul>';
    $terms = get_terms($tax, 'orderby=name&order=ASC&exclude=1036');
    $count = count($terms);

    if ( $count > 0 ){
      foreach ( $terms as $term ) {
        if(is_tax( $tax, $term->name )){
          $class="current-menu-item";
        } else {
          $class="";
        }
        is_wp_error( $term_link = get_term_link($term)) ? '' : $term_link;
        $html .= '<li class="'.$class.'"><a href="'.$term_link.'">'. $term->name.'</a></li>';
      }
    }
    $html .= '</ul></li>';
  }

  return $html;
}



/*
function get_user_role()

simply displays the current users' role

*/

function get_user_role() {
  global $current_user;

  $user_roles = $current_user->roles;
  $user_role = array_shift($user_roles);

  switch($user_role){
    case 's2member_level1':
      return 'Make It Plain';
    case 's2member_level2':
      return 'The Praxis';
    default:
      return $user_role;
  }
}


function get_all_the_roles(){
  global $wp_roles;
  $roles = $wp_roles->get_names();

  // Below code will print the all list of roles.
  print_r($roles);
}

function get_s2_restricted_posts_by_access_level( $level ) {
  $ids = array();
  $s2_options = get_option( 'ws_plugin__s2member_options' );

  for( $i = 0; $i <= $level; $i++ ) {
    $key = "level$i" . "_posts";
    if( !empty($s2_options[$key]) ) {
      $ids = array_merge( $ids, explode( ',', $s2_options[$key] ) );
    }
  }
  return $ids;

}

function get_s2_restricted_posts_of_access_level( $level ) {
  $ids = array();
  $s2_options = get_option( 'ws_plugin__s2member_options' );

  for( $i = 0; $i <= $level; $i++ ) {
    $key = "level$i" . "_posts";
    if( ($i == $level) && !empty($s2_options[$key]) ) {
      $ids = array_merge( $ids, explode( ',', $s2_options[$key] ) );
    }
  }
  return $ids;

}



function myC101_exclusive_new($type,$count){

  $posts_visible_for_level_2 = get_s2_restricted_posts_of_access_level(2);
  $posts_visible_for_level_1 = get_s2_restricted_posts_of_access_level(1);

  //var_dump($posts_visible_for_level_2);

  $args = array(
    'post_type' => $type,
    'posts_per_page' => $count,
    'post__in' => $posts_visible_for_level_1,
    'category__not_in' =>  array( 1, 1036 )
  );

  $the_query = new WP_Query( $args );
  if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  <div class="feature-item">
    <?php if(has_post_thumbnail()){ ?>
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(200,9999) ); ?></a>
      <?php } ?>
      <div style="float:left;max-width: 400px;">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="feature-date"><?php echo get_the_date(); ?></div>
        <div><?php echo get_the_excerpt(); ?> </div></em></i></strong></bold>
      </div>
    </div>
    <div class="clear"></div>
    <?php
  endwhile;
endif;
wp_reset_query();

}


function myC101_exclusive($type,$count){

  $posts_visible_for_level_2 = get_s2_restricted_posts_of_access_level(2);
  $posts_visible_for_level_1 = get_s2_restricted_posts_by_access_level(1);

  //var_dump($posts_visible_for_level_2);

  $twoweeksago = date('Y-m-d', strtotime('-13 days'));

  $args = array(
    'post_type' => $type,
    'posts_per_page' => $count,
    'category__not_in' => array( 1, 1036 ),
    'date_query' => array(
      'before' => $twoweeksago
    )
  );

  $the_query = new WP_Query( $args );
  if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  <div class="feature-item">
    <?php if(has_post_thumbnail()){ ?>
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(200,9999) ); ?></a>
      <?php } ?>
      <div style="float:left;max-width: 400px;">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="feature-date"><?php echo get_the_date(); ?></div>
        <div><?php echo get_the_excerpt(); ?> </div></em></i></strong></bold>
      </div>
    </div>
    <div class="clear"></div>
    <?php
  endwhile; endif;
  wp_reset_query();
}


function my_favorites_all(){

  $qry = array('post__in' => $favorite_post_ids, 'posts_per_page'=> $post_per_page, 'orderby' => 'post__in', 'paged' => $page);
  // custom post type support can easily be added with a line of code like below.
  // $qry['post_type'] = array('post','page');
  $qry['post_type'] = array('book','video','post','new-article','articles','uncut-podcast','podcast');
  query_posts($qry);
  $row_breaker = 0;
  while ( have_posts() ) : the_post();
  if(has_post_thumbnail() || 'video' == get_post_type() || 'book' == get_post_type()){ $has_img = 'has_img';}

  //START POST
  $post_typer = get_post_type_object(get_post_type());
  ?>
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    echo "<div class='post-container'>";

    //echo get_post_type(); //TESTING
    if(has_post_thumbnail()){
      echo '<div class="img-container">';
      the_post_thumbnail( array(200,9999) );
      echo '</div>';
    } else if ( 'video' == get_post_type() ){
      ?>
      <div class="img-container"><img class="item-img" src="http://img.youtube.com/vi/<?php echo get_field('youtube_link') ?>/0.jpg"/></div>
      <?php
    }else{
      echo'<div class="img-container"></div>';
    }

    echo '<div class="favorite-content">';
    echo "<a href='".get_permalink()."' title='". get_the_title() ."' class='favorite-link'>" . get_the_title() . "</a>";
    echo '<div class="date-line"><a href="'.get_permalink().'">'.get_the_date().'&nbsp;&raquo;&nbsp;'.$post_typer->labels->singular_name.'</a></div>';
    wpfp_remove_favorite_link(get_the_ID());
    echo '</div>'; ?>
  </div>
</div>
<?php
$row_breaker = $row_breaker + 1;
if($row_breaker%2==0){
  echo '<br />';
}
endwhile;

echo '<div class="navigation">';
if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else {
  ?>
  <div class="alignleft"><?php next_posts_link( __( '&larr; Previous Entries', 'buddypress' ) ) ?></div>
  <div class="alignright"><?php previous_posts_link( __( 'Next Entries &rarr;', 'buddypress' ) ) ?></div>
  <?php
}
echo '</div>';
wp_reset_query();
}


function my_favorites_by_type($type){

}


/* Remove the "Dashboard" from the admin menu for non-admin users */
function wpse52752_remove_dashboard () {
  global $current_user, $menu, $submenu;
  get_currentuserinfo();

  if( ! in_array( 'administrator', $current_user->roles ) ) {
    reset( $menu );
    $page = key( $menu );
    while( ( __( 'Dashboard' ) != $menu[$page][0] ) && next( $menu ) ) {
      $page = key( $menu );
    }
    if( __( 'Dashboard' ) == $menu[$page][0] ) {
      unset( $menu[$page] );
    }
    reset($menu);
    $page = key($menu);
    while ( ! $current_user->has_cap( $menu[$page][1] ) && next( $menu ) ) {
      $page = key( $menu );
    }
    if ( preg_match( '#wp-admin/?(index.php)?$#', $_SERVER['REQUEST_URI'] ) &&
    ( 'index.php' != $menu[$page][2] ) ) {
      wp_redirect( get_option( 'siteurl' ) . '/wp-admin/edit.php');
    }
  }
}
add_action('admin_menu', 'wpse52752_remove_dashboard');


function latest_post_category($cat, $echo = true) {
  $posts = query_posts(array(
    'showposts' => 1,
    'orderby' => 'post_date',
    'category_name' => $cat
  ));
  $html = '';
  foreach($posts as $post) {
    $id = $post->ID;
    $html .= '<div class="pod-item">';
    if(has_post_thumbnail($id)){
      $html .=  '<div class="pod-img"><a href="'.get_permalink().'">'.get_the_post_thumbnail($id,'book-thumb').'</a></div>';
    }

    $html .= '<div class="pod-content"><h2 class="pod-title"><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></h2>';
    $html .= '<div class="pod-date">'.get_the_date(null, $id).'</div></div><br style="clear:both;"/>';
    $html .= '<div class="pod-desc">'.$post->post_excerpt.'</div>';
    $html .= '</div>';
  }
  if ($echo) {
    echo $html;
  } else {
    return $html;
  }
}
