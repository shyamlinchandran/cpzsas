<?php
/**
 * The template for displaying search results pages.
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

<div class="breadcrumb_area <?php echo esc_attr($bizlite_overlay);?>" <?php if ( get_header_image() ){ ?> style="background-image:url('<?php header_image(); ?>')"  <?php } ?>>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <?php if ( have_posts() ) : ?>
                            <h1><?php 
                               /* translators: %s: search term */
                                printf( esc_html__( 'Search Results for : %s', 'bizlite' ), '<span>' . get_search_query() . '</span>' ); 
                             ?></h1>
                        <?php else : ?>
                            <h1><?php
                            /* translators: %s: nothing found term */
                               printf( esc_html__( 'Nothing Found for : %s', 'bizlite' ), '<span>' . get_search_query() . '</span>' ); 
                            ?></h1>
                        <?php endif; ?>
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