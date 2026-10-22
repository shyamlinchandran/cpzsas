<?php 
/**
 * The header for our theme.
 *
 * Displays all of the <head> section 
 *
 * @package bizlite
 */
 ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
 <?php endif; ?>

  <?php wp_head(); ?>
</head> 
<body <?php body_class(); ?>>
 <div class="main_wrap">

  <!-- ====== loader ====== -->

    

    <!-- ====== header ====== -->
    

<header class="header_area">
    <?php  
                $bizlite_header_section = get_theme_mod('bizlite_header_section_hideshow' ,'hide');
				if ($bizlite_header_section =='show') { 
                $bizlite_email_value = get_theme_mod('bizlite_header_email_value');
                $bizlite_phone_value = get_theme_mod('bizlite_header_phone_value');
                $bizlite_time_value = get_theme_mod('bizlite_header_time_value');
                $bizlite_social_link_1 = get_theme_mod('bizlite_header_social_link_1');
                $bizlite_social_link_2 = get_theme_mod('bizlite_header_social_link_2');
                $bizlite_social_link_3 = get_theme_mod('bizlite_header_social_link_3');
                $bizlite_social_link_4 = get_theme_mod('bizlite_header_social_link_4');
    ?>
            <div class="header_top theme-bg">
                <div class="container">
                    <div class="row">
                    
                        <div class="col-md-8">
                            <ul class="header_link">
                                <?php if (!empty($bizlite_email_value)) { ?>
                                    <li><i class="fa fa-envelope"></i><span><?php echo esc_html($bizlite_email_value); ?></span>
                                    </li>
                                <?php } ?>
                                <?php if (!empty($bizlite_phone_value)) { ?>
                                    <li><i class="fa fa-phone"></i><span><?php echo esc_html($bizlite_phone_value); ?></span></li>
                                <?php } ?>
                                <?php if (!empty($bizlite_time_value)) { ?>
                                    <li><i class="fa fa-clock-o"></i><span><?php echo esc_html($bizlite_time_value); ?></span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="col-md-4">
                          <ul class="top-social">
                            <?php 
                            if (!empty($bizlite_social_link_1)) { ?>
                                <li>
                                    <a href="<?php echo esc_url($bizlite_social_link_1); ?>">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </a>
                                </li>    
                            <?php } 
                            if (!empty($bizlite_social_link_2)) { ?>
                                <li>
                                    <a href="<?php echo esc_url($bizlite_social_link_2); ?>">
                                       <i class="fa fa-twitter" aria-hidden="true"></i>
                                    </a>
                                </li>    
                            <?php } 
                            if (!empty($bizlite_social_link_3)) { ?>
                                <li>
                                    <a href="<?php echo esc_url($bizlite_social_link_3); ?>">
                                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                                    </a>
                                </li>    
                            <?php } 
                            if (!empty($bizlite_social_link_4)) { ?>
                                <li>
                                    <a href="<?php echo esc_url($bizlite_social_link_4); ?>">
                                        <i class="fa fa-youtube" aria-hidden="true"></i>
                                    </a>
                                </li>
                            <?php } ?>
                          </ul>
                        </div>
                    </div>
                </div>
            </div>
    <?php } ?>
            <div class="sticky-anchor"></div>
            <div class="header_btm">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                                <span>
                                    <?php if (has_custom_logo()) : ?> 
                                        <h2> <?php the_custom_logo(); ?></h2>
                                    <?php else : ?>
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-two">
                                           <?php bloginfo( 'title' ); ?>
                                           <span class="site-description sub-logo"><?php bloginfo( 'description' ); ?></span>
                                        </a>
                                        
                                   <?php endif; ?>
                               </span>
                        </div>
                         <?php
                        $bizlite_quote_section = get_theme_mod('bizlite_quote_section_hideshow' ,'show');
						$bizlite_ctah_btn_text = get_theme_mod('bizlite_ctah_btn_text');
                        $bizlite_ctah_btn_url = get_theme_mod('bizlite_ctah_btn_url');
                        if ($bizlite_quote_section =='show' && $bizlite_ctah_btn_url) { 
                             ?>
                            <div class="col-sm-7 menu_col col-xs-6">
                                <nav class="menu-container">
                                    <?php wp_nav_menu( 
                                          array(
                                                'container'        => 'ul', 
                                                'theme_location'    => 'primary', 
                                                'menu_class'        => 'menu', 
                                                'items_wrap'        => '<ul class="menu">%3$s</ul>',
                                                'fallback_cb'       => 'bizlite_wp_bootstrap_navwalker::fallback',
                                                'walker'            => new bizlite_wp_bootstrap_navwalker()
                                            )
                                        ); 
                                    ?>
                                </nav>
                            </div>
                            
							<div class="col-sm-2">
								<div class="qoute-btn">
									<a href="<?php echo esc_url($bizlite_ctah_btn_url); ?>"><?php echo esc_html($bizlite_ctah_btn_text); ?></a>
							   </div>                                  
							</div>
                         <?php   
                        }
                        else{ ?>
                            <div class="col-sm-9 menu_col col-xs-6">
                                <nav class="menu-container">
                                    <?php wp_nav_menu( 
                                          array(
                                                'container'        => 'ul', 
                                                'theme_location'    => 'primary', 
                                                'menu_class'        => 'menu', 
                                                'items_wrap'        => '<ul class="menu">%3$s</ul>',
                                                'fallback_cb'       => 'bizlite_wp_bootstrap_navwalker::fallback',
                                                'walker'            => new bizlite_wp_bootstrap_navwalker()
                                            )
                                        ); 
                                    ?>
                                </nav>
                            </div><?php
                        }
                        ?>  
                    </div>
                </div>
            </div>
</header>