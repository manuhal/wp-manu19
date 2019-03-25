<?php 
  // this template is for the EVENT type archives
  get_header(); 
  // echo 'EVENT ARCHIVE';
  page_banner(array(
    'title' => 'All Events',
    'subtitle' => 'Come and see all events in our campus',
    'banner_img' =>  get_theme_file_uri('images/bus.jpg'),
  ));

?>
  
  <div class="container container--narrow page-section">
    <?php
      while(have_posts()):
        the_post();
        
        get_template_part('partials/content-event');
        
      endwhile;
      
      echo paginate_links();  //activate pagination
    ?>
    <p>Check out our <a href="<?php echo site_url('/past-events'); ?> ">past event archive</a></p>
    
  </div>

<?php get_footer(); ?>