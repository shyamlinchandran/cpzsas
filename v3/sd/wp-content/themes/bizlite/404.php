
<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package bizlite
 */ 
get_header(); if(get_header_image()){
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
                        <h1><?php echo esc_html__( 'Page Not Found', 'bizlite' ); ?></h1>
                        <ul class="brc">
                            <li>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"> <?php echo esc_html__( 'Home', 'bizlite' ); ?></a>
                            </li>
                            <li><span><?php echo esc_html__( '404', 'bizlite' ); ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--  /breadcrumb_area -->

    <!-- ====== page 404 ====== -->
    
    <div class="error_area sp">
        <div class="container">
            <div class="row">
              
				
				   <div class="col-md-12 text-center error_col">
                    <!-- <h1>404</h1>-->
                    <!-- you can use text or image -->
                    <h2><?php echo esc_html__( '404', 'bizlite' ); ?></h2>
                    <h4><?php echo esc_html__('nothing found','bizlite') ?></h4>
                    <h3><?php echo esc_html__('Ups, what you are looking for is not found! Try searching here...','bizlite') ?> </h3>                    
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button-2"><i class="fa fa-angle-left"></i><?php echo esc_html__('Back to home','bizlite'); ?> </a>
                </div>
				
            </div>
        </div>
    </div>

<?php get_footer(); ?>