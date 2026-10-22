<?php 
// To display Clients-logo section on front page

?>
<?php
  $bizlite_clients_section_hideshow = get_theme_mod('bizlite_clients_section_hideshow','hide');
  $bizlite_clients_title = get_theme_mod('bizlite_clients_title');

  $bizlite_clients_no        = 6;
  $bizlite_clients_logo      = array();
  for( $i = 1; $i <= $bizlite_clients_no; $i++ ) {
    $bizlite_clients_logo[]    =  get_theme_mod( "bizlite_client_logo_$i", 1 );
  }

  $bizlite_client_args  = array(
      'post_type' => 'page',
      'post__in' => array_map( 'absint', $bizlite_clients_logo ),
      'posts_per_page' => absint($bizlite_clients_no),
      'orderby' => 'post__in'
  );

  $bizlite_client_query = new   wp_Query( $bizlite_client_args );
  

  if ($bizlite_clients_section_hideshow =='show' && $bizlite_client_query->have_posts()) { 
?>
<!-- Partners Section -->
      <div class="brand_area grey-bg sp">
          <div class="container">
              <div class="brand_slider owl-carousel owl-theme owl-loaded">
                  <?php
                  while($bizlite_client_query->have_posts()) :
                  $bizlite_client_query->the_post();
                  ?>
                    <a class="single_brand single_slide">
                        <?php 
                          if(has_post_thumbnail()): 
                            the_post_thumbnail('full', array('class' => 'img-responsive'));
                          endif; 
                        ?>
                    </a>
                  <?php
                  endwhile;
                  wp_reset_postdata();
                  ?>
              </div>
          </div>
      </div>
<!-- End partner section -->
<?php } ?>