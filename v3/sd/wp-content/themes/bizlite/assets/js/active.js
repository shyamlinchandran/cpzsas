var window, document, jQuery;
(function ($) {
    "use strict";
    
    function sliders() {
        if ($.fn.owlCarousel) {
            var homeSlider = $('.home_slider');
            homeSlider.owlCarousel({
                items: 1,
                dots: false,
                loop: true,
                nav: true,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                animateIn: 'fadeIn',
                animateOut: 'fadeOut',
                touchDrag: false,
                mouseDrag: false
            });
            
            homeSlider.on('translate.owl.carousel', function () {
                $(this).find('.owl-item .home_content > div > *').removeClass('fadeInUp animated').css('opacity','0');
            });
            homeSlider.on('translated.owl.carousel', function () {
                $(this).find('.owl-item.active .home_content > div > *').addClass('fadeInUp animated').css('opacity','1');
            });
            
            homeSlider.on('translate.owl.carousel', function () {
                $(this).find('.owl-item .home_content > div > *').removeClass('fadeInUp animated').css('opacity','0');
            });
            homeSlider.on('translated.owl.carousel', function () {
                $(this).find('.owl-item.active .home_content > div > *').addClass('fadeInUp animated').css('opacity','1');
            });
            
           
        }
    }

    function plugins() {
        $(window).stellar();
        
       
        $('nav ul.menu').slicknav({
            appendTo: '.menu_col'
        });
        
        //new WOW().init();
    }
    
    

    function customCode() {
        $('.sub-menu').siblings('a').addClass('sub-siblings');
        $('.mega-menu').siblings('a').closest('li').addClass('mega-par');
        $('.search_icon, .search_close').on('click', function() {
            $('.search_form').toggleClass('active');
        });
        
        $('.mega-menu').siblings('a').closest('li').on('click', function() {
            $('this').find('.menu-column').css('display','block');
        });

    }
    
    $(document).ready(function(){
    if ( $(window).width() > 768) {   
    
    $(".header_btm").sticky({topSpacing:0});
    }  
    $(".header_btm").css('background', '#ffffff');
    $(".header_btm").css('-webkit-box-shadow: ', '-1px 11px 20px -3px rgba(0,0,0,0.09)');
    $(".header_btm").css('-moz-box-shadow:', '-1px 11px 20px -3px rgba(0,0,0,0.09)');
    $(".header_btm").css('box-shadow', '-1px 11px 20px -3px rgba(0,0,0,0.09)');
    $(".header_btm").css('z-index', '999 !important');
    
    
    });
    
    function heightConfig() {
        
        var sth = -1;
        $('.sth').each(function () {
            if ($(this).height() > sth) {
                sth = $(this).height();
            }
        });
        $('.sth').height(sth);
        
        var vdo_h = -1;
        $('.vdo_h').each(function () {
            if ($(this).height() > vdo_h) {
                vdo_h = $(this).height();
            }
        });
        $('.vdo_h').height(vdo_h);
        
        var form_h = -1;
        $('.form_h').each(function () {
            if ($(this).height() > form_h) {
                form_h = $(this).height();
            }
        });
        $('.form_h').height(form_h);
        
    }
    
    function accordion() {
        var dd = $('dd');
        dd.filter(':nth-child(n+4)').hide();
        $('dl.accordion').on('click', 'dt', function(){
            $(this)
            .addClass('active')
            .siblings('dt')
            .removeClass('active');

            $(this)
                .next()
                .slideDown()
                .siblings('dd')
                .slideUp();
        });
    }
    
    function site_preloader(){
        $('.site_preloader').fadeOut(2000, function () {
            $(this).remove();
        });
    }
    function slider_preloader(){
        $('.slider_preloader').fadeOut(2000, function () {
            $(this).remove();
        });
    }
    
    $(document).ready(function () {
        plugins();
        customCode();
        accordion();
        sliders();
        heightConfig();
        site_preloader();
    });
    
    $(window).load(function () {
        heightConfig();
        
        slider_preloader();
    });
    
     var brandSlider = $('.brand_slider');
            brandSlider.owlCarousel({
                dots: false,
                loop: true,
                nav: false,
                items: 6,
                margin: 30,
                responsive: {
                    0: {
                        items: 2
                    },
                    480: {
                        items: 4
                    },
                    992: {
                        items: 6
                    }
                }
            });
    
})(jQuery);