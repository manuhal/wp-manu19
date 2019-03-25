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
      
      while($past_events->have_posts()){
        $past_events->the_post();
    ?>

      <div class="event-summary">
        <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
          <span class="event-summary__month"><?php 
                $date_field = get_field('event_date', false, false);
                $event_date = new DateTime($date_field);
                echo $event_date->format('M'); ?></span>
          <span class="event-summary__day"><?php echo $event_date->format('d');?></span>  
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
          <p><?php echo wp_trim_words( get_the_content(), 18, '...' ); ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
        </div>
      </div>    
      <p><hr/></p>
    
    <?php 
        
      } //end while-loop
      
      //activate pagination, need special tweak for custom query
      echo paginate_links(array(
          'total' => $past_events->max_num_pages,
          
        ));  
      
      
    ?>
    
  </div>

<?php get_footer(); ?>