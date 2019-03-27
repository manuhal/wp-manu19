<?php 
  // this template is for the CAMPUS post-type archives
  get_header(); 
  // echo 'archive: CAMPUS';
  
  page_banner(array(
    'title'=> 'Our Campuses',
    'subtitle' => 'We have several conveniently located campuses.',
  ));
?>
  
  <div class="container container--narrow page-section">
    <div class="acf-map">
    <?php
      while(have_posts()):
        the_post();
        $map_loc = get_field('map_location');
    ?>
    
    <div class="marker" data-lat="<?php echo $map_loc['lat'] ?>" data-lng="<?php echo $map_loc['lng'] ?>">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php echo $map_loc['address']; ?>
    </div>
    
    <?php endwhile; ?>
    </div>

<?php get_footer(); ?>