<?php 
/* For Search Results
*/
?>
<article class="col-md-12">
	<div class="singel_blog">
		<?php if(has_post_thumbnail()) : ?>
			<div class="blog_img">
				<?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
				<a><i class="fa fa-calendar"></i><?php echo get_the_date(); ?></a>
			</div>
		<?php endif; ?>
		<div class="blog_content">
			<h4>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h4>
				<?php the_excerpt(); ?>
					<ul class="meta-cat clearfix">
						<li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><i class="fa fa-user"></i>     <?php the_author(); ?></a>
						</li>
						<li>
							<a><i class="fa fa-comments"></i><?php comments_number( __('0 Comment', 'bizlite'),
								__('1 Comment', 'bizlite'), __('% Comments', 'bizlite') ); ?> </a>   
						</li>
						<?php if (has_tag()) : ?>
						<li>
							<a><i class="fa fa-tag"></i><?php echo esc_html__(' ', 'bizlite' ); ?><?php the_tags('&nbsp;'); ?>
							</a>
						</li>
						<?php endif; ?>
						<a href="<?php the_permalink(); ?>" class="button-2 std-blog-btn"><?php echo esc_html__( 'Continue Reading', 'bizlite' ); ?></a>
					</ul>
		</div>
	</div>
</article>      