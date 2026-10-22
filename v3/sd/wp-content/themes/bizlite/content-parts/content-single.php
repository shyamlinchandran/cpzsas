<?php   

/* For Single page Results
*/

?>
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <article class="col-md-12">
          <div class="singel_blog">
              <?php if(has_post_thumbnail()) : ?>
                  <div class="blog_img">
                      <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                  </div>
              <?php endif; ?>
              <div class="blog_content">
                  <h4><?php the_title(); ?></h4>
                  <ul class="meta-cat clearfix">
                      <li>
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><i class="fa fa-user"></i><?php the_author(); ?></a>
                      </li>

                      <li>
                          <a><i class="fa fa-calendar"></i><?php echo esc_html(get_the_date()); ?></a>
                      </li>
                      <li>
                        <a><i class="fa fa-comments"></i><?php comments_number( __('0 Comment', 'bizlite'), __('1 Comment', 'bizlite'), __('% Comments', 'bizlite') ); ?></a>
                      </li>
                    <?php if (has_tag()) : ?>
                      <li>
                        <i class="fa fa-tag"></i>
                        <?php echo esc_html__(' ', 'bizlite' ); ?><?php the_tags('&nbsp;'); ?>
                      </li>     
                    <?php endif; ?>
                  </ul>
                  <div class="blog-desc">
						<?php the_content(); ?>
					</div>
                  <?php
                      wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__('Pages: ', 'bizlite' ),
                        'after'  => '</div>',
                      ) );
                  ?>
              </div>
          </div>
      </article>
      <?php 
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif; 
      ?> 
  </div>