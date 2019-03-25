<?php
 //template for single EVENT post
 get_header();

 while(have_posts()){
     the_post(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title() ?></h1>
      <div class="page-banner__intro">
        <!--<p>!!!! WILL FIX THIS LATER !!!!</p>-->
      </div>
    </div>  
  </div>
  
  <div class="container container--narrow page-section">
     <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to events</a>
            <!--<span class="metabox__main">Posted by <?php the_author_posts_link(); ?> on <?php the_date('F j, Y'); ?> at <?php the_time('g:i a'); ?> in <?php echo get_the_category_list(', '); ?>.</span>-->
            <span class="metabox__main"><?php the_title(); ?></span>
        </p>
     </div>
     
     <div class="generic-content">
      <?php the_content(); ?>
     </div>
     
     
     <?php
     
        // get the value of 'related_program' custom field
        $related_programs = get_field('related_programs');
        // print_r($related_programs);

        // show related-program if there is        
        if ($related_programs){
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--small">Related Program</h2>';
            echo '<ul class="link-list min-list">';
            foreach($related_programs as $program){ 
     ?>
                <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
     <?php  
            }  //end foreach
            echo '</ul>';
        } //endif
     ?>
  
  </div>

  
<?php     
 }
 
 get_footer();

?>