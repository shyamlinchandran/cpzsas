<?php
/**
 * bizlite Theme Customizer
 *
 * @package bizlite
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function bizlite_customize_register( $wp_customize ) {
	
	// bizlite theme choice options
    if (!function_exists('bizlite_section_choice_option')) :
        function bizlite_section_choice_option()
        {
            $bizlite_section_choice_option = array(
                'show' => esc_html__('Show', 'bizlite'),
                'hide' => esc_html__('Hide', 'bizlite')
            );
            return apply_filters('bizlite_section_choice_option', $bizlite_section_choice_option);
        }
    endif;


    //Bizlite Theme Column Layout

    if (!function_exists('bizlite_col_layout_option')) :
        function bizlite_col_layout_option()
        {
            $bizlite_col_layout_option = array(
                '6' => esc_html__('2 Column Layout', 'bizlite'),
                '4' => esc_html__('3 Column Layout', 'bizlite'),
                '3' => esc_html__('4 Column Layout', 'bizlite'),
            );
            return apply_filters('bizlite_col_layout_option', $bizlite_col_layout_option);
        }
    endif;
    
    /**
     * Sanitizing the select callback example
     *
    */
    if ( !function_exists('bizlite_sanitize_select') ) :
        function bizlite_sanitize_select( $input, $setting ) {

            // Ensure input is a slug.
            $input = sanitize_text_field( $input );

            // Get list of choices from the control associated with the setting.
            $choices = $setting->manager->get_control( $setting->id )->choices;

                // If the input is a valid key, return it; otherwise, return the default.
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
        }
    endif;

    
    /**
     * Drop-down Pages sanitization callback example.
     *
     * - Sanitization: dropdown-pages
     * - Control: dropdown-pages
     * 
     * Sanitization callback for 'dropdown-pages' type controls. This callback sanitizes `$page_id`
     * as an absolute integer, and then validates that $input is the ID of a published page.
     * 
     * @see absint() https://developer.wordpress.org/reference/functions/absint/
     * @see get_post_status() https://developer.wordpress.org/reference/functions/get_post_status/
     *
     * @param int                  $page    Page ID.
     * @param WP_Customize_Setting $setting Setting instance.
     * @return int|string Page ID if the page is published; otherwise, the setting default.
     */

    function bizlite_sanitize_dropdown_pages( $page_id, $setting ) {
        // Ensure $input is an absolute integer.
        $page_id = absint( $page_id );
    
        // If $page_id is an ID of a published page, return it; otherwise, return the default.
        return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
    }


	 /** Header Section Settings Start **/

    $wp_customize->add_section('bizlite_header_info', 
        array(
            'title'       => esc_html__('Header Section', 'bizlite'),
            'description' => '',
            'priority'    => 3
        )
    );
  

    //Hide Show
    $wp_customize->add_setting(
    'bizlite_header_section_hideshow',
    array(
        'default'           => 'hide',
        'sanitize_callback' => 'bizlite_sanitize_select',
    )
    );

    $bizlite_header_section_hide_show_option = bizlite_section_choice_option();

    $wp_customize->add_control('bizlite_header_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Header Option', 'bizlite'),
            'description' => esc_html__('Show/hide option for Header Section.', 'bizlite'),
            'section'     => 'bizlite_header_info',
            'choices'     => $bizlite_header_section_hide_show_option,
            'priority'    => 1
        )
    );
  
	
	$wp_customize->add_setting('bizlite_header_email_value', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('bizlite_header_email_value',
         array(
            'label'     => esc_html__('Email', 'bizlite'),
            'section'   => 'bizlite_header_info',
            'priority'  => 2
        )
     );

    $wp_customize->add_setting('bizlite_header_phone_value', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('bizlite_header_phone_value',
         array(
            'label'     => esc_html__('Toll Free', 'bizlite'),
            'section'   => 'bizlite_header_info',
            'priority'  => 2
        )
     );

    $wp_customize->add_setting('bizlite_header_time_value', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('bizlite_header_time_value',
        array(
            'label'    => esc_html__('Office Timing', 'bizlite'),
            'section'  => 'bizlite_header_info',
            'priority' => 1
        )
    );
	
	 
    //Setting - Header Social Links

    $wp_customize->add_setting('bizlite_header_social_link_1', 
        array(
            'default'   =>  '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control('bizlite_header_social_link_1', 
        array(
            'label'   => esc_html__('Facebook URL', 'bizlite'),
            'section' => 'bizlite_header_info',
            'priority'  => 3
        )
    );

    $wp_customize->add_setting('bizlite_header_social_link_2', 
        array(
            'default'   =>  '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control('bizlite_header_social_link_2', 
        array(
            'label'   => esc_html__('Twitter URL', 'bizlite'),
            'section' => 'bizlite_header_info',
            'priority'  => 3
        )
    );

    $wp_customize->add_setting('bizlite_header_social_link_3', 
        array(
            'default'   =>  '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control('bizlite_header_social_link_3', 
        array(
            'label'   => esc_html__('Linkedin URL', 'bizlite'),
            'section' => 'bizlite_header_info',
            'priority'  => 3
        )
    );

    $wp_customize->add_setting('bizlite_header_social_link_4', 
        array(
            'default'   =>  '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control('bizlite_header_social_link_4', 
        array(
            'label'   => esc_html__('Youtube URL', 'bizlite'),
            'section' => 'bizlite_header_info',
            'priority'  => 3
        )
    );
	
	
	 $wp_customize->add_section('bizlite_quote_info',
        array(
            'title'       => esc_html__('Header Quote Button Option', 'bizlite'),
            'description' => '',
            'priority'    => 3
        )
    );

    $wp_customize->add_setting('bizlite_quote_section_hideshow',
        array(
            'default'           => 'hide',
            'sanitize_callback' => 'bizlite_sanitize_select',
        )
    );

    $bizlite_quote_section_hide_show_option = bizlite_section_choice_option();

    $wp_customize->add_control('bizlite_quote_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Quote Option', 'bizlite'),
            'description' => esc_html__('Show/hide option for Quote Section.', 'bizlite'),
            'section'     => 'bizlite_quote_info',
            'choices'     => $bizlite_quote_section_hide_show_option,
            'priority'    => 1
        ) 
    );

    $wp_customize->add_setting('bizlite_ctah_btn_text',
         array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('bizlite_ctah_btn_text',
        array(
            'label'    => esc_html__('Quote Button Text', 'bizlite'),
            'section'  => 'bizlite_quote_info',
            'priority' => 4
        )
    );  


    
    $wp_customize->add_setting('bizlite_ctah_btn_url', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );


    $wp_customize->add_control('bizlite_ctah_btn_url', 
        array(
            'label'    => esc_html__('Quote Button URL', 'bizlite'),
            'section'  => 'bizlite_quote_info',
            'priority' => 3
        )
    );

	 /** Client Section Settings End **/

    /** Footer Section Settings Start **/

	$wp_customize->add_section('bizlite_footer_info',
        array(
            'title'       => esc_html__('Footer Section', 'bizlite'),
            'description' => '',
            'priority'    => 180
        )
    );

    $wp_customize->add_setting('bizlite_footer_section_hideshow',
        array(
            'default'           => 'show',
            'sanitize_callback' => 'bizlite_sanitize_select',
        )
    );

    $bizlite_footer_section_hide_show_option = bizlite_section_choice_option();

    $wp_customize->add_control('bizlite_footer_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Footer Option', 'bizlite'),
            'description' => esc_html__('Show/hide option for Footer Section.', 'bizlite'),
            'section'     => 'bizlite_footer_info',
            'choices'     => $bizlite_footer_section_hide_show_option,
            'priority'    => 1
        ) 
    );

    

    $wp_customize->add_setting('bizlite_footer_text',
         array(
            'default'             => '',
            'type'                => 'theme_mod',
            'sanitize_callback'   => 'wp_kses_post'
        )
    );

    $wp_customize->add_control('bizlite_footer_text',
         array(
            'label'    => esc_html__('Copyright', 'bizlite'),
            'section'  => 'bizlite_footer_info',
            'type'     => 'textarea',
            'priority' => 2
    ));	
    
	
    /** Front Page Section Settings starts **/	

    $wp_customize->add_panel('bizlite_frontpage', 
        array(
            'title'       => esc_html__('Bizlite Options', 'bizlite'),        
		    'description' => '',                                        
		     'priority'   => 3,
        )
    );
 

    // Panel - Slider Section 1
    $wp_customize->add_section('bizlite_sliderinfo', 
        array(
            'title'       => esc_html__('Home Slider Section', 'bizlite'),
            'description' => '',
            'panel'       => 'bizlite_frontpage',
             'priority'   => 110
        )
    );

    // hide show
    
    $wp_customize->add_setting('bizlite_slider_section_hideshow',
        array(
            'default'           => 'hide',
            'sanitize_callback' => 'bizlite_sanitize_select',
        )
    );

    $bizlite_slider_section_hide_show_option = bizlite_section_choice_option();

    $wp_customize->add_control('bizlite_slider_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Slider Option', 'bizlite'),
            'description' => esc_html__('Show/hide option for Slider Section.', 'bizlite'),
            'section'     => 'bizlite_sliderinfo',
            'choices'     => $bizlite_slider_section_hide_show_option,
            'priority'    => 1
        )
    );
  
    $slider_no = 3;
        for( $i = 1; $i <= $slider_no; $i++ ) {
            $bizlite_slider_page   = 'bizlite_slider_page_' .$i;
            $bizlite_slider_btntxt1 = 'bizlite_slider_btntxt1_' . $i;
            $bizlite_slider_btnurl1 = 'bizlite_slider_btnurl1_' .$i;
            $bizlite_slider_btntxt2 = 'bizlite_slider_btntxt2_' . $i;
            $bizlite_slider_btnurl2 = 'bizlite_slider_btnurl2_' .$i;
        

    $wp_customize->add_setting( $bizlite_slider_page,
        array(
            'default'           => 1,
            'sanitize_callback' => 'bizlite_sanitize_dropdown_pages',
        )
    );

    $wp_customize->add_control( $bizlite_slider_page,
        array(
            'label'     => esc_html__( 'Slider Page ', 'bizlite' ) .$i,
            'section'   => 'bizlite_sliderinfo',
            'type'      => 'dropdown-pages',
            'priority'  => 100,
        )
    );


    $wp_customize->add_setting( $bizlite_slider_btntxt1,
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control( $bizlite_slider_btntxt1,
        array(
            'label'        => esc_html__( 'Button -1 Text','bizlite' ),
            'section'      => 'bizlite_sliderinfo',
            'type'         => 'text',
            'priority'     => 100,
        )
    );
        
    $wp_customize->add_setting( $bizlite_slider_btnurl1,
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control( $bizlite_slider_btnurl1,
        array(
            'label'       => esc_html__( 'Button -1 URL', 'bizlite' ),
            'section'     => 'bizlite_sliderinfo',
            'type'        => 'text',
            'priority'    => 100,
        )
        );

        $wp_customize->add_setting( $bizlite_slider_btntxt2,
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control( $bizlite_slider_btntxt2,
        array(
            'label'        => esc_html__( 'Button -2 Text','bizlite' ),
            'section'      => 'bizlite_sliderinfo',
            'type'         => 'text',
            'priority'     => 100,
        )
    );
        
    $wp_customize->add_setting( $bizlite_slider_btnurl2,
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control( $bizlite_slider_btnurl2,
        array(
            'label'       => esc_html__( 'Button - 2 URL', 'bizlite' ),
            'section'     => 'bizlite_sliderinfo',
            'type'        => 'text',
            'priority'    => 100,
        )
    );

                
    }	
    /** Slider Section Settings End **/

    /** Callout Section Settings Start **/
    $wp_customize->add_section(
        'bizlite_footer_contact', 
        array(
            'title'   => esc_html__('Home Callout Section', 'bizlite'),
            'description' => '',
            'panel' => 'bizlite_frontpage',
            'priority'    => 120
        )
    );

    // Setting - Callout Hideshow
    
    $wp_customize->add_setting(
        'bizlite_contact_section_hideshow',
        array(
            'default' => 'hide',
            'sanitize_callback' => 'bizlite_sanitize_select',
        )
    );

    $bizlite_section_choice_option = bizlite_section_choice_option();
    $wp_customize->add_control(
        'bizlite_contact_section_hideshow',
        array(
            'type' => 'radio',
            'label' => esc_html__('Callout Option', 'bizlite'),
            'description' => esc_html__('Show/hide option for Footer Callout Section.', 'bizlite'),
            'section' => 'bizlite_footer_contact',
            'choices' => $bizlite_section_choice_option,
            'priority' => 5
        )
    );

    // Setting - Callout details

    $wp_customize->add_setting(
        'bizlite_callout_heading', 
        array(
            'default'   => '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'bizlite_callout_heading', 
        array(
            'label'   => esc_html__('Callout Title', 'bizlite'),
            'section' => 'bizlite_footer_contact',
            'priority'  => 8
        )
    );


    $wp_customize->add_setting(
        'bizlite_callout_btn_url', 
        array(
            'default'   =>'',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control(
        'bizlite_callout_btn_url', 
        array(
            'label'   => esc_html__('Button URL', 'bizlite'),
            'section' => 'bizlite_footer_contact',
            'priority'  => 11
        )
    );

    $wp_customize->add_setting(
        'bizlite_callout_btn_text', 
        array(
            'default'   => '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'bizlite_callout_btn_text', 
        array(
            'label'   => esc_html__('Button Text', 'bizlite'),
            'section' => 'bizlite_footer_contact',
            'priority'  => 10
        )
    );

    /** Callout Section Settings End **/

    /** Aboutus Section Settings Start **/

    $wp_customize->add_section('bizlite_aboutus',              
        array(
            'title'       => esc_html__('Home About Us Section', 'bizlite'),          
            'description' => '',             
            'panel'       => 'bizlite_frontpage',      
            'priority'    => 130,
        )
    );
    
    //Setting - About Hideshow
    $wp_customize->add_setting('bizlite_aboutus_section_hideshow',
        array(
            'default'           => 'hide',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $bizlite_aboutus_section_hide_show_option = bizlite_section_choice_option();

    $wp_customize->add_control('bizlite_aboutus_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('About Us Option', 'bizlite'),
            'description' => esc_html__('Show/hide option for About Section.', 'bizlite'),
            'section'     => 'bizlite_aboutus',
            'choices'     => $bizlite_aboutus_section_hide_show_option,
            'priority'    => 1
        )
    );


    // About title
    $wp_customize->add_setting('bizlite_aboutus_title', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );


    $wp_customize->add_control('bizlite_aboutus_title',
        array(
           'label'    => esc_html__('About Title', 'bizlite'),
           'section'  => 'bizlite_aboutus',
           'priority' => 1
        )
    );

  
    $wp_customize->add_setting('bizlite_aboutus_subtitle',
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );


    $wp_customize->add_control('bizlite_aboutus_subtitle', 
        array(
           'label'    => esc_html__('About description', 'bizlite'),
           'section'  => 'bizlite_aboutus', 
           'priority' => 4
        )
    );
    // Setting - About Page
   
  
    $wp_customize->add_setting( 'bizlite_aboutus_page',
        array(
            'default'           => 1,
            'sanitize_callback' => 'bizlite_sanitize_dropdown_pages',
        )
    );

    $wp_customize->add_control( 'bizlite_aboutus_page',
        array(
            'label'        => esc_html__( 'About Us Page ', 'bizlite' ) ,
            'section'      => 'bizlite_aboutus',
            'type'         => 'dropdown-pages',
            'priority'     => 12,
        )
    );

   
    /** About Us Section Settings End **/

    /** Service Section Settings Start **/

	$wp_customize->add_section('bizlite_services',              
        array(
            'title'       => esc_html__('Home Service Section', 'bizlite'),          
            'description' => '',             
            'panel'       => 'bizlite_frontpage',      
            'priority'    => 140,
        )
    );
    
    $wp_customize->add_setting('bizlite_services_section_hideshow',
        array(
            'default'           => 'hide',
            'sanitize_callback' => 'bizlite_sanitize_select',
        )
    );

    $bizlite_services_section_hide_show_option = bizlite_section_choice_option();

    $wp_customize->add_control(
        'bizlite_services_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Services Option', 'bizlite'),
            'description' => esc_html__('Show/hide option Section.', 'bizlite'),
            'section'     => 'bizlite_services',
            'choices'     => $bizlite_services_section_hide_show_option,
            'priority'    => 1
        )
    );


    // Services title
    $wp_customize->add_setting('bizlite_services_title', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );


    $wp_customize->add_control('bizlite_services_title',
        array(
           'label'    => esc_html__('Service Title', 'bizlite'),
           'section'  => 'bizlite_services',
           'priority' => 1
        )
    );

  
    $wp_customize->add_setting('bizlite_services_subtitle',
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );


    $wp_customize->add_control('bizlite_services_subtitle', 
        array(
           'label'    => esc_html__('Service Description', 'bizlite'),
           'section'  => 'bizlite_services', 
           'priority' => 1
        )
    );

    //Setting - Service Column Layout
    $wp_customize->add_setting(
    'bizlite_service_col_layout',
        array(
            'default' => '4',
            'sanitize_callback' => 'bizlite_sanitize_select',
        )
    );
    $bizlite_section_col_layout = bizlite_col_layout_option();
    
    $wp_customize->add_control(
    'bizlite_service_col_layout',
        array(
            'type' => 'radio',
            'label' => esc_html__('Column Layout option ', 'bizlite'),
            'description' => '',
            'section' => 'bizlite_services',
            'choices' => $bizlite_section_col_layout,
            'priority' => 2
        )
    );

    // Services 
   
    $service_no = 8;
        for( $i = 1; $i <= $service_no; $i++ ) {
            $bizlite_servicepage = 'bizlite_service_page_' . $i;
            $bizlite_serviceicon = 'bizlite_page_service_icon_' . $i;
        
    // Setting - Feature Icon
    $wp_customize->add_setting( $bizlite_serviceicon,
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control( $bizlite_serviceicon,
        array(
            'label'         => esc_html__( 'Service Icon ', 'bizlite' ).$i,
            'description'   =>  __('Select a icon in this list <a target="_blank" href="https://fontawesome.com/v4.7.0/icons/">Font Awesome icons</a> and enter the class name','bizlite'),
            'section'       => 'bizlite_services',
            'type'          => 'text',
            'priority'      => 100,
        )
    );
        
    $wp_customize->add_setting( $bizlite_servicepage,
        array(
            'default'           => 1,
            'sanitize_callback' => 'bizlite_sanitize_dropdown_pages',
        )
    );

    $wp_customize->add_control( $bizlite_servicepage,
        array(
            'label'        => esc_html__( 'Service Page ', 'bizlite' ) .$i,
            'section'      => 'bizlite_services',
            'type'         => 'dropdown-pages',
            'priority'     => 100,
        )
    );
    }
    /** Service Section Settings End **/

    /** Blog Section Settings Start **/

    $wp_customize->add_section('bizlite_blog_info', 
        array(
            'title'       => esc_html__('Home Blog Section', 'bizlite'),
            'description' => '',
            'panel'       => 'bizlite_frontpage',
            'priority'    => 160
        )
     );
    
    $wp_customize->add_setting('bizlite_blog_section_hideshow',
        array(
            'default'           => 'show',
            'sanitize_callback' => 'bizlite_sanitize_select',
        )
    );

    $bizlite_blog_section_hide_show_option = bizlite_section_choice_option();

    $wp_customize->add_control('bizlite_blog_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Blog Option', 'bizlite'),
            'description' => esc_html__('Show/hide option for Blog Section.', 'bizlite'),
            'section'     => 'bizlite_blog_info',
            'choices'     => $bizlite_blog_section_hide_show_option,
            'priority'    => 1
        )
    );
    
    $wp_customize->add_setting('bizlite_blog_title', 
         array(
            'default'            => '',
            'type'               => 'theme_mod',
            'sanitize_callback'  => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('bizlite_blog_title', 
        array(
            'label'    => esc_html__('Blog Title', 'bizlite'),
            'section'  => 'bizlite_blog_info',
            'priority' => 1
        )
    );
    
    $wp_customize->add_setting('bizlite_blog_subtitle', 
        array(
            'default'             => '',
            'type'                => 'theme_mod',
            'sanitize_callback'   => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('bizlite_blog_subtitle', 
        array(
            'label'    => esc_html__('Blog Subheading', 'bizlite'),
            'section'  => 'bizlite_blog_info', 
            'priority' => 4
        )
    );
    /** Blog Section Settings End **/

    /** Client Section Settings Start **/

    $wp_customize->add_section('bizlite_clients_logo', 
        array(
            'title'       => esc_html__('Home Clients logo Section', 'bizlite'),
            'description' => '',
            'panel'       => 'bizlite_frontpage', 
            'priority'    => 170
        )
    );

    $wp_customize->add_setting('bizlite_clients_section_hideshow',
        array(
            'default'          => 'hide',
           'sanitize_callback' => 'bizlite_sanitize_select',
        )
    );

  $bizlite_section_choice_option = bizlite_section_choice_option();

    $wp_customize->add_control('bizlite_clients_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Clients-logo Option', 'bizlite'),
            'description' => esc_html__('Show/hide option for Clients-logo Section.', 'bizlite'),
            'section'     => 'bizlite_clients_logo',
            'choices'     => $bizlite_section_choice_option,
            'priority'    => 5
        )
    );

    // Clientss title

    $client_no = 6;
        for( $i = 1; $i <= $client_no; $i++ ) {
    $bizlite_client_logo = 'bizlite_client_logo_' . $i;   

    $wp_customize->add_setting( $bizlite_client_logo,
        array(
            'default'           => 1,
            'sanitize_callback' => 'bizlite_sanitize_dropdown_pages',
        )
    );

    $wp_customize->add_control( $bizlite_client_logo,
        array(
            'label'      => esc_html__( 'Client Page ', 'bizlite' ) .$i,
            'section'    => 'bizlite_clients_logo',
            'type'       => 'dropdown-pages',
            'priority'   => 100,
        )
    );

    }
   

    /** Footer Section Settings End **/

}
add_action( 'customize_register', 'bizlite_customize_register' );


/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class bizlite_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'bizlite_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new bizlite_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 1,
					'title'    => esc_html__( 'Bizlite Pro Theme', 'bizlite' ),
					'pro_text' => esc_html__( 'Upgrade Pro', 'bizlite' ),
					'pro_url'  => esc_url('https://freepsdworld.com/themes/bizlite-pro/'),
				)
			)
		);
		// Register sections.
		$manager->add_section(
			new bizlite_Customize_Section_Pro(
				$manager,
				'example_2',
				array(
					'priority'   => 2,
					'title'    => esc_html__( 'Bizlite Doc', 'bizlite' ),
					'pro_text' => esc_html__( 'Documentation', 'bizlite' ),
					'pro_url'  => esc_url('https://freepsdworld.com/docs/bizlite-free/documentation.htm'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {
		wp_enqueue_script( 'bizlite-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );
		
		wp_enqueue_style( 'bizlite-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
bizlite_Customize::get_instance();