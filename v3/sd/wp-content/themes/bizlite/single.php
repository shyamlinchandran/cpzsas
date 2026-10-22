<?php
/**
 * The template for displaying all single posts.
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
                        <h1><?php wp_title(''); ?></h1>
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

     <!-- 23. blog_area -->
        <div class="blog_area sp single-blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 post_col">
                        <div class="row">
                            <?php 
                       if(have_posts()) : 
							?>
							<?php while(have_posts()) : the_post(); ?>
							
							   <?php  get_template_part( 'content-parts/content', 'single' ); ?>
							
							 <?php endwhile; ?>
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
        <!-- 23. /blog_area -->
 
<?php get_footer(); ?>