<?php get_header();?>

<div id="entry-full">
    <div id="left">
		<div id="head-line">
	    <h1 class="title"><?php  the_title();  ?></h1>
		<div class="meta">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_time('M j, Y | ');  _e('Posted by ','TopShop'); the_author_posts_link(); ?> <?php _e('in ','TopShop');  the_category(', ') ?> | <?php comments_popup_link(__('0 comments','TopShop'), __('1 comment','TopShop'), '% '.__('comments','TopShop')); ?>
			<div class="like-counter">
				<a id="like-<?php the_ID(); ?>" class="like-count icons-thumbs-up" href="#" <?php ufo_liked_class(); ?>>
					<?php ufo_post_liked_count(); ?>
				</a>
			</div>
        </div><!-- .meta  -->
		</div>
        <div class="post-full single">
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="post-content">
						<?php
						if ( has_post_format('image') ) {
							the_post_thumbnail("large");
						}
						?>

						<?php
						if ( has_post_format('quote') ) { ?>
							<blockquote>
								<?php the_content(); ?>
							</blockquote>
						<?php } else {
							the_content(); 
						} ?>
                    </div>  <!--  end .post-content  -->
					<div id="sharrre"><h4 class="share-single-text"><?php _e('Share:', 'TopShop'); ?></h4>
					<div id="twitter" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Tweet"></div>
					<div id="facebook" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Share"></div>
					<div id="pinterest" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Pin"></div>
					<div id="googleplus" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Share"></div>
					</div>
					<?php if ( has_tag()) { ?>
					<div id="tags"><?php _e('Tags: ', 'TopShop'); ?></h4>
						<?php the_tags('', ', ', ''); ?>
					</div>
					<?php } ?>
					<?php comments_template(); ?>

				<?php endwhile; else: ?>

					<p><?php _e('Sorry, no posts matched your criteria.','TopShop'); ?></p>

				<?php endif; ?>
			</div>  
		</div> <!--  end .post  -->
	</div> <!--  end #right  -->
<?php get_sidebar(); ?>
</div> <!--  end #entry-full  -->
<?php get_footer(); ?>