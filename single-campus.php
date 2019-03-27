<?php
  //template for single CAMPUS post type
  
  get_header();
  
  while(have_posts()){
      the_post(); 
      page_banner();
?>
  
  <div class="container container--narrow page-section">
    
     <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>">
            <i class="fa fa-home" aria-hidden="true"></i> Our Campuses</a><span class="metabox__main"><?php the_title(); ?></span>
        </p>
     </div>
     
     <div class="generic-content">
      <?php the_content(); ?>
     </div>
     
       <?php
          //custom query for related programs------------------------------------------
          $related_programs = new WP_Query(array(
            'posts_per_page' => -1, //show all records
            'post_type' => 'program',
            'order' => 'asc',  //default is DESC
            'orderby' => 'title',
            'meta_query' => array( //meta_query can have multiple selections
                array(//select program(s) that has 'related_campuses' field match with this campus-ID
                    'key' => 'related_campuses',
                    'compare' => 'like',
                    'value' => '"'. get_the_ID() . '"', //we need to wrap this with double quotes
                    // 'value' => get_the_ID(), //kayanya without quotes is working juga
                ),
            ),
          ));
          
          // print_r($related_programs);
          
          //show the program(s) that related with this program if there is
          if ($related_programs->have_posts()):
          
              echo '<hr class="section-break"/>';
              echo '<h2 class="headline headline--small">Program(s) available at this ' . get_the_title() .' campus</h2>';
              echo '<ul class="min-list link-list">';
              
              while($related_programs->have_posts()):
                
                $related_programs->the_post();
            ?>
                <li>
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
              
            <?php
              endwhile; 
              
              echo '</ul>';
              
              //Restore original Post Data
              wp_reset_postdata();

          endif;     
       
          //create custom query for event_date and related_programs post-type-------------------------------------
          // $today = date('Ymd');
          // $today = date('Y-m-d h:i:s');
          
          // $related_events = new WP_Query(array(
          //   'posts_per_page' => 2,
          //   'post_type' => 'event',
          //   'order' => 'asc',  //default is DESC
          //   'meta_key' => 'event_date',
          //   'orderby' => 'meta_value',
          //   'meta_query' => array( //meta_query can have multiple selections
                
          //       array( //query only upcoming events (event_date >= today's date)
          //           'key' => 'event_date',
          //           'compare' => '>=',
          //           'value' => $today,
          //           'type' => 'DATETIME',
          //       ),
          //       array(//query event(s) that has 'related_programs' field match with this program-ID
          //           'key' => 'related_programs',
          //           'compare' => 'like',
          //           'value' => '"'. get_the_ID() . '"', //we need to wrap this with double quotes
          //           // 'value' => get_the_ID(), //kayanya without quotes is working juga
          //       ),
          //   ),
          // ));
          
          // if ($related_events->have_posts()):
          
          //     echo '<hr class="section-break"/>';
          //     echo '<h2 class="headline headline--small">Upcoming <b>' . get_the_title() .'</b> Program Events</h2>';
              
          //     while($related_events->have_posts()):
                
          //       $related_events->the_post();
          //       get_template_part('partials/content-event');
              
          //     endwhile;
              
          //     //Restore original Post Data
          //     wp_reset_postdata();
              
          // endif;
          
        ?>
  
  </div>

  
<?php     
 }
 
 get_footer();

?>