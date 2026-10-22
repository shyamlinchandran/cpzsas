<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: Use this page template to remove the sidebar from any page.
 * @package bizlite
 */
?>

<?php get_header(); 

if(get_header_image()){
    $bizlite_overlay = "overlay";
 }
 else{
    $bizlite_overlay = "noverlay";
 }
?>

        <div class="breadcrumb_area <?php echo esc_attr($bizlite_overlay);?>" <?php if ( get_header_image() ){ ?> style="background-image:url('<?php header_image(); ?>')"  <?php } ?>>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <?php if (is_home() || is_front_page()) { ?>                        
                            <h1><?php the_title(); ?></h1>
                        <?php } else { ?>
                            <h1><?php wp_title(''); ?></h1>    
							<ul class="brc">
								<li>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>"> <?php echo esc_html__( 'Home', 'bizlite' ); ?></a>
								</li>
								<li><span><?php wp_title(''); ?></span></li>
							</ul>	
                        <?php } ?>  
                      
                    </div>
                </div>
            </div>
        </div>


        <div class="blog_area sp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 post_col">
                        <div class="row">
                            <?php if(have_posts()) : ?>
                                <?php while(have_posts()) : the_post(); ?>
                                    <article class="col-md-12">
                                        <div class="singel_blog">
                                            <?php if(has_post_thumbnail()) : ?>
                                                <div class="blog_img page-img">
                                                    <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="blog_contents">
                                                <?php the_content(); ?>
                                                <?php
                                                     wp_link_pages( array(
                                                        'before' => '<div class="page-links">' . esc_html__( 'Pages: ', 'bizlite' ),
                                                        'after'  => '</div>',
                                                                 ) );
                                                ?>  
                                            </div>
                                        </div>
                                    </article>          
                                <?php endwhile; ?>
                                <div class="comment-box">
                                    <?php 
                                        if ( comments_open() || get_comments_number() ) :
                                            comments_template();
                                        endif; 
                                    ?> 
                                </div>
                            <?php else : 
                                get_template_part( 'content-parts/content', 'none' );
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /blog_area -->
<?php get_footer(); ?>