<?php 
// To display About Us section on front page

    $bizlite_aboutus_section = get_theme_mod('bizlite_aboutus_section_hideshow','hide');
    $bizlite_aboutus_title   =  get_theme_mod('bizlite_aboutus_title');  
    $bizlite_aboutus_pages[] =  get_theme_mod( "bizlite_aboutus_page", 1 );

    $bizlite_aboutus_no    = 1;
    
    $bizlite_aboutus_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $bizlite_aboutus_pages ),
        'posts_per_page' => absint($bizlite_aboutus_no),
        'orderby' => 'post__in'
    ); 
    
    $bizlite_aboutus_query = new wp_Query( $bizlite_aboutus_args );
     
     if( $bizlite_aboutus_section == "show") :

?>

        <!-- Start About Section -->

        <div class="about-style-one sp">
            <div class="container">
                <div class="row  section_title">
                    <div class="col-md-12 text-center">
                        <?php if($bizlite_aboutus_title != "") { ?>
                            <h2><?php echo esc_html(get_theme_mod('bizlite_aboutus_title')); ?></h2>
                            <div class="section-seprater"></div>
                        <?php } ?>
                        
                            <p><?php echo esc_html(get_theme_mod('bizlite_aboutus_subtitle')); ?></p>
                    </div>
                </div>
                <div class="about_area">
                    <div class="container">
                        <?php if($bizlite_aboutus_query->have_posts()) :
                            $bizlite_aboutus_query->the_post(); ?>
                            <?php if(has_post_thumbnail()) { ?>
                                <div class="row about_top spb">
                                    <div class="col-md-6">
                                        
                                            <div class="about_top_img">
                                                <img src="<?php the_post_thumbnail_url('full', array('class' => 'img-responsive')); ?>">
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="about_top_content">
                                            <h3><?php the_title(); ?></h3>
                                            <?php the_content(); ?>
                                        </div>
                                        <?php if (!empty($bizlite_about_btntxt)) { ?>
                                            <a href="<?php echo esc_url($bizlite_about_btnurl); ?>" class="abt-btn"><?php echo esc_html($bizlite_about_btntxt); ?>
                                            </a>
                                       <?php } ?>
                                    </div>
                                </div>
                            <?php } 
                            else { ?>
                                <div class="row about_top spb">
                                    <div class="col-md-12">
                                        <div class="about_top_content">
                                            <h3><?php the_title(); ?></h3>
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                           <?php  
                            }
                        endif;
                        wp_reset_postdata();
                      ?> 
                    </div>
                </div>
            </div>
        </div>

<!-- End About Section -->
<?php endif; ?> 