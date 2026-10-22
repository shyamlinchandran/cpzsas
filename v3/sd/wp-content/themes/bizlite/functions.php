<?php 

/**
 * bizlite functions and definitions
 * @package bizlite
 */

if( ! function_exists( 'bizlite_theme_setup' ) ) {

	function bizlite_theme_setup() {
		
	    load_theme_textdomain( 'bizlite', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		
		// Add default title support
		add_theme_support( 'title-tag' ); 		

		// Add default logo support		
        add_theme_support( 'custom-logo' );	

        // To use additional css
 	    add_editor_style( 'css/editor-style.css' );		

	    
		add_theme_support('post-thumbnails');
		
		$defaults = array(
			'default-image'          => get_template_directory_uri() .'/assets/img/header.jpg',
			'width'                  => 1920,
			'height'                 => 540,
			'uploads'                => true,
			'default-text-color'     => "3a3a3a",
			'wp-head-callback'       => 'bizlite_header_style',
			);
		add_theme_support( 'custom-header', $defaults );

		/**
		* Set the content width in pixels, based on the theme's design and stylesheet.
		*/
		$GLOBALS['content_width'] = apply_filters( 'bizlite_content_width', 980 );
		
		// Add theme support for Semantic Markup
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );
		 
		 add_theme_support( 'customize-selective-refresh-widgets' );
		 
		// add excerpt support for pages
		add_post_type_support( 'page', 'excerpt' );
		
		if ( is_singular() && comments_open() ) {
			wp_enqueue_script( 'comment-reply' );
		}
	   
		// Menus
		//add_theme_support( 'menus' );

        register_nav_menus(array(
       'primary' => esc_html__('primary Menu', 'bizlite')
       ));		

	}
	add_action( 'after_setup_theme', 'bizlite_theme_setup' );
}


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/init.php';

/**
 * Styles the header text color displayed on the page header title
 *
 */
function bizlite_header_style()
{
	$header_text_color = get_header_textcolor();
	?>
		<style type="text/css">
			<?php
				//Check if user has defined any header image.
				if ( get_header_image() ) :
			?>
				.logo-two, .sub-logo{
					color: #<?php echo esc_attr($header_text_color); ?> !important;					
				}
			<?php endif; ?>	
		</style>
	<?php
}


/**
 * Customizer additions.
 */

// Register Nav Walker class_alias
require get_template_directory() . '/class-wp-bootstrap-navwalker.php';
require get_template_directory(). '/inc/customizer.php';
require get_template_directory(). '/inc/extras.php';

/**
 * Enqueue CSS stylesheets
 */
  
if( ! function_exists( 'bizlite_enqueue_styles' ) ) {
	function bizlite_enqueue_styles() {
		
	// Bootstrap CSS 
	wp_enqueue_style('bizlite-font', 'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css');
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css');	
	wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css');
	wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css');
	
	wp_enqueue_style('bizlite-style', get_stylesheet_uri() );
	
	}
	add_action( 'wp_enqueue_scripts', 'bizlite_enqueue_styles' );
}

/**
 * Enqueue JS scripts
 */

if( ! function_exists( 'bizlite_enqueue_scripts' ) ) {
	function bizlite_enqueue_scripts() {
   
	    wp_enqueue_script('jquery');		
	    
	    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array(), '', true);
	    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array(), '', true);
	    wp_enqueue_script('slicknav', get_template_directory_uri() . '/assets/js/slicknav.js', array(), '', true);
	    wp_enqueue_script('jquery-sticky-js', get_template_directory_uri() . '/assets/js/jquery.sticky.js', array(), '1.0.4', true);
		wp_enqueue_script('bizlite-active-js', get_template_directory_uri() . '/assets/js/active.js', array(), '', true);
		
	}
	add_action( 'wp_enqueue_scripts', 'bizlite_enqueue_scripts' );
}


/**
 * Register sidebars for bizlite
*/

function bizlite_sidebars() {

	// Blog Sidebar
	
	register_sidebar(array(
		'name' => esc_html__( 'Blog Sidebar', "bizlite"),
		'id' => 'blog-sidebar',
		'description' => esc_html__( 'Sidebar on the blog layout.', "bizlite"),
		'before_widget' => '<section class="widget wow fadeInUp %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
  	

	// Footer Sidebar
	
	register_sidebar(array(
		'name' => esc_html__( 'Footer Widget Area 1', "bizlite"),
		'id' => 'bizlite-footer-widget-area-1',
		'description' => esc_html__( 'The footer widget area 1', "bizlite"),
		'before_widget' => '<section id="%1$s" class="widget widget_text %2$s">',
		'after_widget' => '</section>',
		'before_title' => ' <h4 class="widget-title">',
		'after_title' => '</h4>',
	));	
	
	register_sidebar(array(
		'name' => esc_html__( 'Footer Widget Area 2', "bizlite"),
		'id' => 'bizlite-footer-widget-area-2',
		'description' => esc_html__( 'The footer widget area 2', "bizlite"),
		'before_widget' => '<section id="%1$s" class="widget widget_nav_menu %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));	
	
	register_sidebar(array(
		'name' => esc_html__( 'Footer Widget Area 3', "bizlite"),
		'id' => 'bizlite-footer-widget-area-3',
		'description' => esc_html__( 'The footer widget area 3', "bizlite"),
		'before_widget' => '<section id="%1$s" class="widget widget_nav_menu %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));	


	register_sidebar(array(
		'name' => esc_html__( 'Footer Widget Area 4', "bizlite"),
		'id' => 'bizlite-footer-widget-area-4',
		'description' => esc_html__( 'The footer widget area 4', "bizlite"),
		'before_widget' => ' <section id="%1$s" class="widget widget_text %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));	
		
}

add_action( 'widgets_init', 'bizlite_sidebars' );




    /**
     * Comment layout
    */
    function bizlite_comments( $comment, $args, $depth ) { ?>
        <div id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-box'); ?>>
		    <?php if ($comment->comment_approved == '0') : ?>
			<div class="alert alert-info">
			  <p><?php esc_html_e( 'Your comment is awaiting moderation.', 'bizlite' ) ?></p>
			</div>
		    <?php endif; ?>

		   <div class="media">
                <div class="media-left">
                    <a href="#">
                        <?php echo get_avatar( $comment,60, null,'comments user', array( 'class' => array( 'media-object','' ) )); ?>
                    </a>
               </div>
               <div class="media-body">
                    <h4 class="media-heading"><?php 
                        /* translators: '%1$s %2$s: edit term */
                        printf(esc_html__( '%1$s %2$s', 'bizlite' ), get_comment_author_link(), edit_comment_link(esc_html__( '(Edit)', 'bizlite' ),'  ','') )
                            ?>
                    </h4>
                    <span>
                    	<time datetime="<?php echo comment_time('c'); ?>">
                            <?php printf(  /* translators: 1: date, 2: time */
                                _x( '%1$s at %2$s', '1: date, 2: time', 'bizlite' ),
                                         get_comment_date(),
                                         get_comment_time()
                            ); ?>
                         </time>
                    </span>
                    <p><?php comment_text() ?></p>
                    <?php comment_reply_link (array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
            </div>                    
        </div>
<?php
  } 
?>