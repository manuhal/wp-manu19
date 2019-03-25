<?php

  function page_banner($args = null){
    
    // echo $page_banner_image['sizes']['page_banner'];
    // echo get_theme_file_uri('images/ocean.jpg')
    
    if(!$args['title']) $args['title'] = get_the_title();

    if(!$args['subtitle']) $args['subtitle'] = get_field('page_banner_subtitle');

    if(!$args['banner_img']) {
      $page_banner_image = get_field('page_banner_background_image');
      if($page_banner_image){
        $args['banner_img'] = $page_banner_image['sizes']['page_banner'];
      }else{
        $args['banner_img'] = get_theme_file_uri('images/ocean.jpg');
      }
    }
    echo '<div class="page-banner">';
    echo '  <div class="page-banner__bg-image" style="background-image: url('. $args['banner_img'] .');"></div> ';
    echo '  <div class="page-banner__content container container--narrow">';
    echo '    <h1 class="page-banner__title">' . $args['title'] .'</h1>';
    echo '    <div class="page-banner__intro">';
    echo '      <p>' . $args['subtitle'] . '</p>';
    echo '    </div>';
    echo '  </div>';
    echo '</div>';
    
    // echo '$page_banner_image=' ; print_r($page_banner_image);
  }
  
  function manu_files(){
      wp_enqueue_style('google-font','https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
      wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    // FOR PRODUCTON   
    //   wp_enqueue_style('manu_main_styles', get_stylesheet_uri());
    //   wp_enqueue_script('manu_main_js', get_theme_file_uri('js/scripts-bundled.js'),NULL, '1.0', true);
    
    //   FOR DEV ONLY: trick to disable cache during dev, by replacing version with microtime() php function
      wp_enqueue_style('manu_main_styles', get_stylesheet_uri(), NULL, microtime());
      wp_enqueue_script('manu_main_js', get_theme_file_uri('js/scripts-bundled.js'),NULL, microtime(), true);
  }
  
  add_action('wp_enqueue_scripts', 'manu_files');
  
  //-----------------------------------------------------------------------------------------------
  
  function manu_features(){
      add_theme_support('title-tag'); //add html page name based on post/page name
      add_theme_support('post-thumbnails'); //add feature-image functionality. also need to add to the custom post-type in the  MU-Plugin 
      add_image_size('prof_landscape', 400, 260, true); // crop = true
      add_image_size('prof_portrait', 480, 650, true); // crop = true
      add_image_size('page_banner', 1500, 350, true); // crop = true
      register_nav_menu('manu-header-menu', 'Header Menu Location'); //register menu & specify the location name 
      register_nav_menu('manu-footer1-menu', 'Footer Menu Location One'); 
      register_nav_menu('manu-footer2-menu', 'Footer Menu Location Two'); 
  }
  
  add_action('after_setup_theme', 'manu_features');
  
  
  //----------------------------------------------------------------------------------------------- 
  
  // create custom archive query
  function manu_adjust_queries($query){
    
    if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()){
      $query->set('post_per_page', -1); // -1 means display all
      $query->set('orderby', 'title');
      $query->set('order', 'asc');
    }
    
    //custom queries for events type archive
    if(!is_admin() && is_post_type_archive('event') && $query->is_main_query()){
      //NOTE: $query->is_main_query(): to make sure that this query is default url-based query
      $today = date('Y-m-d h:i:s');
      $query->set('meta_key', 'event_date');
      $query->set('orderby', 'meta_value' );  //'meta_value_num' is not working
      $query->set('order', 'asc' );
      $query->set('meta_query', array(
              array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'DATETIME',
              )
          ));
    }
  }
  
  
  add_action('pre_get_posts', 'manu_adjust_queries');
  
  
  // adding custom post type in this function.php is not a good idea, since it's only avaible in the Manu19 theme.
  // Once user change theme, they won't be able to access all posts using this type
  // A better place is to store this into a special plugins called 'must use plugins' (under mu-plugins folder)
  // I will copy & paste these code to 'manu-post-types.php' under mu-plugins folder 
  // -------------------------------------------------
  // function manu_post_types(){
  //   //register or create custom post type
  //   register_post_type('event', array(
  //     'menu_icon' => 'dashicons-calendar-alt',
  //     'public' => true,
  //     'labels' => array( 'name' => 'Events'),
  //   ));
    
  // }
  
  // //create / register custom post type
  // add_action('init', 'manu_post_types');

?>