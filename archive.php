<?php 
  // this template is for the all archive pages
  get_header(); 

?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">
          <?php
            //this is too much work for all archives (author, date, month, year, category, etc)
            // if(is_category()){
            //     echo 'All posts in <b>'; single_cat_title(); '</b>';
            // }else if(is_author()){
            //     echo 'All Posts by <b>'; the_author(); '</b>';
            // }
            
            //new way for handling archive
            // the_archive_title();
          
            //or we can combine:
            if(is_category()){
                echo 'All posts in <b>'; single_cat_title(); '</b>';
            }else if(is_author()){
                echo 'All Posts by <b>'; the_author(); '</b>';
            } else{
                the_archive_title();
            }
          
          
          ?>
      </h1>
      <div class="page-banner__intro">
        <p>
        <?php
            // this will display the description for the archive
            // but we need to add the description (ie: Biographical Info or Category Description)
            // otherwise it will show emtpy text.
            the_archive_description(); 
        ?>
        </p>
      </div>
    </div>  
  </div>
  
  <div class="container container--narrow page-section">
    <?php
      while(have_posts()){
        the_post();
    ?>
    
    <div class="post-item">
      <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="metabox">
        <p>Posted by <?php the_author_posts_link(); ?> on <?php the_date('F j, Y'); ?> at <?php the_time('g:i a'); ?> in <?php echo get_the_category_list(', '); ?>.</p>
      </div>
      
      <div class="generic-content">
        <?php the_excerpt(); ?>
        <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading</a></p>
      </div>
      
    </div>
    
    
    <?php 
        
      } //end while-loop
      
      echo paginate_links();
    ?>
    
  </div>

<?php get_footer(); ?>