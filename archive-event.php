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
      while(have_posts()){
        the_post();
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
      
      echo paginate_links();  //activate pagination
    ?>
    <p>Check out our <a href="<?php echo site_url('/past-events'); ?> ">past event archive</a></p>
    
  </div>

<?php get_footer(); ?>