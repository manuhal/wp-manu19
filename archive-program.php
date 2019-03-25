<?php 
  // this template is for the PROGRAM post-type archives
  get_header(); 
  // echo 'archive: PROGRAM';
  
  page_banner(array(
    'title'=> 'All Programs',
    'subtitle' => 'Here is the list of our programs.',
  ));
?>
  
  <div class="container container--narrow page-section">
    <ul class="link-list min-list">
    <?php
      while(have_posts()){
        the_post();
    ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    
    <?php 
      } //end while-loop
      echo paginate_links();  //activate pagination
    ?>
    </ul>
    
  </div>

<?php get_footer(); ?>