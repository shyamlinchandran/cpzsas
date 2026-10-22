 <?php 
// To display Footer Call Out section on front page
?>
<?php
$bizlite_contact_section_hideshow = get_theme_mod('bizlite_contact_section_hideshow','hide');
if ($bizlite_contact_section_hideshow =='show') { ?>
<?php $bizlite_callout_btn_text = get_theme_mod('bizlite_callout_btn_text'); ?> 

    <!-- Start Cloud Section -->

        <div class="cta_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="cta">
                            <h2><?php echo esc_html(get_theme_mod('bizlite_callout_heading')); ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3 text-right">
                        <?php if (!empty($bizlite_callout_btn_text)) { ?>
                            <a href="<?php echo esc_url(get_theme_mod('bizlite_callout_btn_url')); ?>" class="button"><i class="fa fa-long-arrow-right"></i> <?php echo esc_html($bizlite_callout_btn_text); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

<!-- End Cloud section -->
  
<?php } ?>