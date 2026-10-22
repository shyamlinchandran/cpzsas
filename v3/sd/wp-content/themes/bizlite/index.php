<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package bizlite
 */
 get_header(); 
if(get_header_image()){
    $bizlite_overlay = "overlay";
 }
 else{
    $bizlite_overlay = "noverlay";
 }
 ?>
<!--  breadcrumb_area -->
        <div class="breadcrumb_area <?php echo esc_attr($bizlite_overlay);?>" <?php if ( get_header_image() ){ ?> style="background-image:url('<?php header_image(); ?>')"  <?php } ?>>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
						<?php if (is_home() || is_front_page()) { ?>						
							<h1><?php echo esc_html__('Blog', 'bizlite') ?></h1>
						<?php } else { ?>
							<h1><?php wp_title(''); ?></h1>							
						<?php } ?>				
                    </div>
                </div>
            </div>
        </div>
        <!--  /breadcrumb_area -->

 <!-- blog_area -->
        <div class="blog_area sp">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 post_col">
                        <div class="row">
                            <?php if(have_posts()) : ?>
                                <?php while(have_posts()) : the_post(); ?>
                                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <?php get_template_part('content-parts/content', get_post_format()); ?>
                                    </div>
                                <?php endwhile; ?>
                                <div class="col-md-12">
                                    <div class="pagination-wrapper">
                                         <div class="pagi">
                                            <?php the_posts_pagination(
                                                array(
                                                    'prev_text' => esc_html__('Prev','bizlite'),
                                                    'next_text' => esc_html__('Next','bizlite')
                                                )
                                            ); ?>
                                         </div>
                                    </div>
                                </div>
                            <?php else : 
                                 get_template_part( 'content-parts/content', 'none' );
                            endif; ?>
                        </div>
                    </div>
                    <aside class="col-md-4 widget_col">
                           <?php get_sidebar(); ?>
                    </aside>
                </div>
            </div>
        </div>
        <!-- /blog_area -->

<?php get_footer(); ?>