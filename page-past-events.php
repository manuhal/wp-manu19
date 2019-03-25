<?php 
  // this template is for the PAST EVENT type archives
  get_header(); 
  // echo 'EVENT ARCHIVE';
  
  page_banner(array(
    'title'=> 'Past Events',
    'subtitle' => 'See our past events in our campus',
  ));
  

?>
  
  <div class="container container--narrow page-section">
    <?php
    
      //create custom query for PAST EVENTS
      $today = date('Y-m-d h:i:s');
      $past_events = new WP_Query(array(
        // 'posts_per_page' => 1,
        'paged' => get_query_var('paged',1),
        'post_type' => 'event',
        'order' => 'asc',  //default is DESC
        'meta_key' => 'event_date',
        'orderby' => 'meta_value', //default value is 'post_date'. you can use 'rand' for random. use meta_value or meta_value_num for custom
        'meta_query' => array(
            array(
              'key' => 'event_date',
              'compare' => '<',
              'value' => $today,
              'type' => 'DATETIME',
            ),
        ),
      ));
      
      while($past_events->have_posts()):
        $past_events->the_post();
        
        get_template_part('partials/content-event');
        
      endwhile; 
      
      //activate pagination, need special tweak for custom query
      echo paginate_links(array(
          'total' => $past_events->max_num_pages,
          
        ));  
      
      
    ?>
    
  </div>

<?php get_footer(); ?>