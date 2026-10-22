 <?php 
// To display Blog Post section on front page
 
    $bizlite_blog_title =  get_theme_mod('bizlite_blog_title');  
    $bizlite_blog_section = get_theme_mod('bizlite_blog_section_hideshow','show');
    if ($bizlite_blog_section =='show') { 
?>

<!-- Blog Section -->
        <div class="news_area sp">
            <div class="container">
                <div class="row  section_title">
                    <div class="col-md-12 text-center">
                        <?php if($bizlite_blog_title != "") { ?>
                            <h2><?php echo esc_html(get_theme_mod('bizlite_blog_title')); ?></h2>
                            <div class="section-seprater"></div>
                        <?php } ?>
                        
                            <p><?php echo esc_html(get_theme_mod('bizlite_blog_subtitle')); ?></p>
                    </div>
                </div>
                <div class="row">
                    <?php 
                    $bizlite_latest_blog_posts = new WP_Query( array( 'posts_per_page' => 3 ) );
                    if ( $bizlite_latest_blog_posts->have_posts() ) : 
                        while ( $bizlite_latest_blog_posts->have_posts() ) : $bizlite_latest_blog_posts->the_post(); 
                    ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="singel_blog">
                                    <?php if(has_post_thumbnail()) : ?>
                                        <div class="blog_img">
                                            <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                                        </div>
                                    <?php endif ?>
                                    <div class="blog_content text-center">
                                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <ul class="meta-cat">
                                            <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><i class="fa fa-user"></i><?php the_author(); ?></a>
                                            </li>
                                            <li>
                                                <a><i class="fa fa-calendar"></i><?php echo esc_html(get_the_date()); ?></a>
                                            </li>
                                        </ul>
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            </div>
                      <?php 
                        endwhile; 
                    endif; ?>
                </div>
            </div>
        </div>

 <!-- End Blog Section -->
    <?php } ?>