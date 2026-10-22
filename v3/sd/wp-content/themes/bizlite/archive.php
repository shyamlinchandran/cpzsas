<?php 
/**
 * The template for displaying archive pages.
 *
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
                        <h1><?php the_archive_title(); ?></h1>
                        <ul class="brc">
                            <li>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"> <?php echo esc_html__( 'Home', 'bizlite' ); ?></a>
                            </li>
                            <li><span><?php wp_title(''); ?></span></li>
                        </ul>
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