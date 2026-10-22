<?php
/**
 * Template part - Service Section of FrontPage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bizlite
 */
    $bizlite_services_section = get_theme_mod( 'bizlite_services_section_hideshow','hide');
    $bizlite_services_title   =  get_theme_mod('bizlite_services_title'); 
    $bizlite_col_layout       = get_theme_mod( 'bizlite_service_col_layout', '4' ); 
   
    $bizlite_services_no        = 8;
    $bizlite_services_pages      = array();
    $bizlite_services_icons     = array();
    
    for( $i = 1; $i <= $bizlite_services_no; $i++ ) {
        $bizlite_services_pages[]    =  get_theme_mod( "bizlite_service_page_$i", 1 );
        $bizlite_services_icons[]    = get_theme_mod( "bizlite_page_service_icon_$i", '' );
    }

    $bizlite_services_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $bizlite_services_pages ),
        'posts_per_page' => absint($bizlite_services_no),
        'orderby' => 'post__in'
    ); 
    
    $bizlite_services_query = new wp_Query( $bizlite_services_args );
     
     if( $bizlite_services_section == "show") :
    
?>

        <section class=" sbb sp">
            <div class="container">
                <div class="row  section_title">
                    <div class="col-md-12 text-center">
                        <?php if($bizlite_services_title != "") {?>
                            <h2><?php echo esc_html(get_theme_mod('bizlite_services_title')); ?></h2>
                            <div class="section-seprater"> </div>
                        <?php } ?>
                        
                            <p><?php echo esc_html(get_theme_mod('bizlite_services_subtitle')); ?></p>
                    </div>
                </div>
                <!--first services-->
                <div class="service_area">
                    <div class="container">
                        <div class="row text-center">
                           <?php
                            if($bizlite_services_query->have_posts()):
                            $count = 0;
                              while($bizlite_services_query->have_posts()) :
                              $bizlite_services_query->the_post();
                            ?>
                               <div class="col-lg-<?php echo esc_attr($bizlite_col_layout); ?> col-md-<?php echo esc_attr($bizlite_col_layout); ?>">
                                    <div class="inner-header-wraper">
                                        <?php 
                                        if($bizlite_services_icons[$count] !=""){
                                        ?>
                                            <a><i class="icon-circle fa <?php echo esc_attr($bizlite_services_icons[$count]); ?>" aria-hidden="true"></i></a>
                                        <?php } ?>
                                        <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                                        <?php the_excerpt(); ?>
                                        <a href="<?php the_permalink() ?>" class="ser-btn"><?php echo esc_html__( 'read more', 'bizlite' ); ?></a>
                                    </div>
                                </div>
                            <?php
                              $count = $count + 1;
                              endwhile;
                              wp_reset_postdata();
                            endif;
                             ?> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
 <?php
    endif;
?>