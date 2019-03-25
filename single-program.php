<?php
  //template for single PROGRAM post type
  
  // a simple test, showing how important to run wp_reset_postdata() after running custom query (WP_Query)
  // the value of get_the_ID() is suddenly change after running the WP_Query()
  // echo 'this doc ID =' . get_the_ID();
  
  get_header();
  
  while(have_posts()){
      the_post(); 
      page_banner();
?>
  
  <div class="container container--narrow page-section">
     <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a>
            <!--<span class="metabox__main">Posted by <?php the_author_posts_link(); ?> on <?php the_date('F j, Y'); ?> at <?php the_time('g:i a'); ?> in <?php echo get_the_category_list(', '); ?>.</span>-->
            <span class="metabox__main"><?php the_title(); ?></span>
        </p>
     </div>
     
     <div class="generic-content">
      <?php the_content(); ?>
     </div>
     
       <?php
          //custom query for related professors------------------------------------------
          $related_professors = new WP_Query(array(
            'posts_per_page' => -1, //show all records
            'post_type' => 'professor',
            'order' => 'asc',  //default is DESC
            'orderby' => 'title',
            'meta_query' => array( //meta_query can have multiple selections
                array(//select professor(s) that has 'related_programs' field match with this program-ID
                    'key' => 'related_programs',
                    'compare' => 'like',
                    'value' => '"'. get_the_ID() . '"', //we need to wrap this with double quotes
                    // 'value' => get_the_ID(), //kayanya without quotes is working juga
                ),
            ),
          ));
          
          //show the professor(s) that related with this program if there is
          if ($related_professors->have_posts()){
          
              echo '<hr class="section-break"/>';
              echo '<h2 class="headline headline--small">' . get_the_title() .' Professor(s)</h2>';
              echo '<ul class="professor-cards">';
              
              while($related_professors->have_posts()){
                $related_professors->the_post();
            ?>
              <li class="professor-card__list-item">
                <a class="professor-card" href="<?php the_permalink(); ?>">
                  <img class="professor-card__image" src="<?php the_post_thumbnail_url('prof_landscape'); ?>">
                  <span class="professor-card__name"><?php the_title(); ?></span>
                </a>
              </li>
              
            <?php
              } //end-while
              echo '</ul>';
              
              //Restore original Post Data
              wp_reset_postdata();
              
            // a simple test, showing how important to run wp_reset_postdata() after running custom query (WP_Query)
            // the value of get_the_ID() is suddenly change after running the WP_Query()
            // echo 'this doc ID =' . get_the_ID();
              
          }//end-if     
       
       
          //create custom query for event_date and related_programs post-type-------------------------------------
          // $today = date('Ymd');
          $today = date('Y-m-d h:i:s');
          $related_events = new WP_Query(array(
            'posts_per_page' => 2,
            'post_type' => 'event',
            'order' => 'asc',  //default is DESC
            'meta_key' => 'event_date',
            'orderby' => 'meta_value',
            'meta_query' => array( //meta_query can have multiple selections
                
                array( //query only upcoming events (event_date >= today's date)
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'DATETIME',
                ),
                array(//query event(s) that has 'related_programs' field match with this program-ID
                    'key' => 'related_programs',
                    'compare' => 'like',
                    'value' => '"'. get_the_ID() . '"', //we need to wrap this with double quotes
                    // 'value' => get_the_ID(), //kayanya without quotes is working juga
                ),
            ),
          ));
          
          if ($related_events->have_posts()):
          
              echo '<hr class="section-break"/>';
              echo '<h2 class="headline headline--small">Upcoming <b>' . get_the_title() .'</b> Program Events</h2>';
              
              while($related_events->have_posts()):
                
                $related_events->the_post();
                get_template_part('partials/content-event');
              
              endwhile;
              
              //Restore original Post Data
              wp_reset_postdata();
              
          endif;
        ?>
  
  </div>

  
<?php     
 }
 
 get_footer();

?>