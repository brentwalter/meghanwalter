<?php
global $theme_options;
$location = icore_get_location();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-content">

		<?php if( isset($theme_options['blog_style']) && $theme_options['blog_style'] == '1' ) { ?>

			<a href="<?php the_permalink(); ?>" >
				<blockquote>
					<?php the_content(); ?>
				</blockquote>
			</a>
			<div class="meta">
				<?php the_time('M j, Y | ');  _e('Posted by ','TopShop');  the_author_posts_link(); ?> <?php _e('in ','TopShop');  the_category(', ') ?> | <?php comments_popup_link(__('0 comments','TopShop'), __('1 comment','TopShop'), '% '.__('comments','TopShop')); ?>
				<div class="like-counter">
					<a id="like-<?php the_ID(); ?>" class="like-count icons-thumbs-up" href="#" <?php ufo_liked_class(); ?>>
						<?php ufo_post_liked_count(); ?>
					</a>
				</div>
			</div>  <!-- .meta  -->

		<?php } else { ?>

				<div class="post-format-content">
					<a href="<?php the_permalink(); ?>" >
						<blockquote>
							<?php the_content(); ?>
						</blockquote>
					</a>
				</div>

				<div class="meta">
					<?php the_time('M j, Y | ');  _e('Posted by ','TopShop');  the_author_posts_link(); ?> <?php _e('in ','TopShop');  the_category(', ') ?> | <?php comments_popup_link(__('0 comments','TopShop'), __('1 comment','TopShop'), '% '.__('comments','TopShop')); ?>
					<div class="like-counter">
						<a id="like-<?php the_ID(); ?>" class="like-count icons-thumbs-up" href="#" <?php ufo_liked_class(); ?>>
							<?php ufo_post_liked_count(); ?>
						</a>
					</div>
				</div>  <!-- .meta  -->

		<?php } ?>

	</div><!-- .post-content  -->
</article>