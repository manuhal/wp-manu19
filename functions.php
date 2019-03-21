<?php
  
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
  
  
  
  function manu_features(){
      add_theme_support('title-tag');
  }
  
  add_action('after_setup_theme', 'manu_features')



?>