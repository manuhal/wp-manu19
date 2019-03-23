<?php
 //template for single PROFESSOR post
 get_header();
 
 //echo 'template for single PROFESSOR post';

 while(have_posts()){
     the_post(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title() ?></h1>
      <div class="page-banner__intro">
        <p>!!!! WILL FIX THIS LATER !!!!</p>
      </div>
    </div>  
  </div>
  
  <div class="container container--narrow page-section">
     <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo site_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to home</a>
        </p>
     </div>
     
     <div class="generic-content">
         <div class="row group">
             <div class="one-third">
                 <?php the_post_thumbnail('profile_portrait'); ?>
             </div>
             <div class="two-third">
                 <?php the_content(); ?>
             </div>
         </div>
     </div>
     
     
     <?php
     
        // get the value of 'related_program' custom field
        $related_programs = get_field('related_programs');
        // print_r($related_programs);

        // show related-program if there is        
        if ($related_programs){
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--small">Subject(s) Taught</h2>';
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