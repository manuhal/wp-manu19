<?php
 
   get_header();
 
   while(have_posts()){
       the_post();
       page_banner();
?>


  <div class="container container--narrow page-section">
      
    <?php
      // $parent_id will be 0 (or false) if this page itself is a parent or 
      // $parent_id will show the parent ID number (true), if this page is a child page
      $parent_id = wp_get_post_parent_id(get_the_ID());
      if($parent_id){
    ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
          <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($parent_id) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($parent_id) ?></a> <span class="metabox__main"><?php the_title() ?></span></p>
        </div>
    <?php } else { ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
          <p><a class="metabox__blog-home-link" href="<?php echo site_url() ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to home</a></p>
        </div>
    
    <?php } ?>

    
    <!-- show this side menu if this page is parent page that has a child OR it's a child page -->
    <?php 
      $has_child = get_pages(array(
        'child_of' => get_the_ID(),
      )); 
      
      if ($parent_id or $has_child) {   
        // echo '<h3>this page is has a parent (a child-page) OR a parent-page that has a child</h3>';
      ?>
        <div class="page-links">
          <h2 class="page-links__title"><a href="<?php echo get_permalink($parent_id) ?>"><?php echo get_the_title($parent_id) ?></a></h2>
          <ul class="min-list">
            <?php 
              if($parent_id){
                $child_of = $parent_id; //will set the parent-ID of this page
              }else{
                $child_of = get_the_ID(); // will set this page-ID itself
              }
              wp_list_pages(array(
                'title_li' => NULL,
                'child_of' => $child_of,
                'sort_column' => 'menu_order',
              ));
            ?>
            <!--<li class="current_page_item"><a href="#">Our History</a></li>-->
            <!--<li><a href="#">Our Goals</a></li>-->
          </ul>
        </div>
    <?php } //end if ?>
    

    <div class="generic-content">
        <?php the_content(); ?>
    </div>

  </div>

<?php

   }
   
  get_footer();
  
?> 