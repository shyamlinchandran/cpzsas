<?php
/**
 * Template part - Features Section of FrontPage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bizlite
 */

    $bizlite_slider_section     = get_theme_mod( 'bizlite_slider_section_hideshow','hide');
    
    $bizlite_slider_no        = 3;
    $bizlite_slider_pages      = array();
    for( $i = 1; $i <= $bizlite_slider_no; $i++ ) {
        $bizlite_slider_pages[]    =  get_theme_mod( "bizlite_slider_page_$i", 1 );
        $bizlite_slider_btntxt1[]    =  get_theme_mod( "bizlite_slider_btntxt1_$i", '' );
        $bizlite_slider_btnurl1[]    =  get_theme_mod( "bizlite_slider_btnurl1_$i", '' );
        $bizlite_slider_btntxt2[]    =  get_theme_mod( "bizlite_slider_btntxt2_$i", '' );
        $bizlite_slider_btnurl2[]    =  get_theme_mod( "bizlite_slider_btnurl2_$i", '' );
    }

    $bizlite_slider_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $bizlite_slider_pages ),
        'posts_per_page' => absint($bizlite_slider_no),
        'orderby' => 'post__in'
    ); 
    
    $bizlite_slider_query = new wp_Query( $bizlite_slider_args );

    if ($bizlite_slider_section =='show' && $bizlite_slider_query->have_posts() ) { ?>
    <!-- 02. home_area -->
        <div class="home_area">
            <div class="slider_preloader flex_center">
                <div class="slider_preloader_inner"></div>
            </div>
            
            <div class="home_slider">
              <?php
               $count = 0;
               while($bizlite_slider_query->have_posts()) :
               $bizlite_slider_query->the_post();
              ?>
                <div class="single_slide overlay" <?php if(has_post_thumbnail()) : ?> style="background-image: url(<?php the_post_thumbnail_url('full', array('class' => 'img-responsive')); ?>);" <?php endif; ?>>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="home_content">
                                    <div class="cell text-center">
                                        <h1><?php the_title(); ?></h1>
                                        <?php the_content(); ?>
                                        <?php if (!empty($bizlite_slider_btntxt1[$count])) { ?>
                                            <a href="<?php echo esc_url($bizlite_slider_btnurl1[$count]); ?>" class="button home_btn fix-btn"><?php echo esc_html($bizlite_slider_btntxt1[$count]); ?>
                                             </a>
                                        <?php } ?>
                                        <?php if (!empty($bizlite_slider_btntxt2[$count])) { ?>
                                            <a href="<?php echo esc_url($bizlite_slider_btnurl2[$count]); ?>" class="button home_btn"><?php echo esc_html($bizlite_slider_btntxt2[$count]); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              <?php
              $count = $count + 1;
              endwhile;
              wp_reset_postdata();
              ?>  
            </div>
        </div>
        <!-- 02. /home_area -->

    <?php } ?>