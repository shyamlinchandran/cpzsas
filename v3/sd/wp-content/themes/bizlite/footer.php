<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package bizlite
 */
   
$bizlite_footer_section = get_theme_mod('bizlite_footer_section_hideshow','show');
$bizlite_column_layout       = get_theme_mod( 'bizlite_column_layout', '4' );

if ($bizlite_footer_section =='show') { ?>

        <footer class="footer">
            <div class="footer_top sp">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <?php dynamic_sidebar('bizlite-footer-widget-area-1'); ?>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <?php dynamic_sidebar('bizlite-footer-widget-area-2'); ?>
                        </div>
                        <div class="col-md-3 col-sm-6">
                           <?php dynamic_sidebar('bizlite-footer-widget-area-3'); ?>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <?php dynamic_sidebar('bizlite-footer-widget-area-4'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_btm">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <span class="text-center">
                                <?php if( get_theme_mod('bizlite_footer_text') ) : ?>
                                    <span><?php echo wp_kses_post( html_entity_decode(get_theme_mod('bizlite_footer_text'))); ?></span>
                                <?php else : 
                                    /* translators: 1: poweredby, 2: link, 3: span tag closed  */
                                    printf( esc_html__( ' %1$sPowered by %2$s%3$s', 'bizlite' ), '<span>', '<a href="'. esc_url( __( 'https://wordpress.org/', 'bizlite' ) ) .'" target="_blank">WordPress.</a>', '</span>' );
                                    /* translators: 1: poweredby, 2: link, 3: span tag closed  */
                                    printf( esc_html__( ' Theme: bizlite by: %1$sDesign By %2$s%3$s', 'bizlite' ), '<span>', '<a href="'. esc_url( __( 'http://freepsdworld.com/', 'bizlite' ) ) .'" target="_blank">freepsdworld.</a>', '</span>' );
                                endif;  ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>