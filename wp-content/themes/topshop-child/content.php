<?php
global $theme_options;
$location = icore_get_location();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-content">

		<?php if( isset($theme_options['blog_style']) && $theme_options['blog_style'] == '1' ) { ?>

			<h2 class="blog-style title"><a href="<?php the_permalink() ?>" class="title" title="Read <?php the_title_attribute(); ?>"><?php the_title();  ?></a></h2>

			<div class="meta">
				<?php the_time('M j, Y | ');  _e('Posted by ','TopShop');  the_author_posts_link(); ?> <?php _e('in ','TopShop');  the_category(', ') ?> | <?php comments_popup_link(__('0 comments','TopShop'), __('1 comment','TopShop'), '% '.__('comments','TopShop')); ?>
				<div class="like-counter">
					<a id="like-<?php the_ID(); ?>" class="like-count icons-thumbs-up" href="#" <?php ufo_liked_class(); ?>>
						<?php ufo_post_liked_count(); ?>
					</a>
				</div>
			</div>  <!-- .meta  -->

			<?php the_content(); ?>

		<?php } else { ?>

				<!-- Print Thumbnail -->
				<?php if ( has_post_thumbnail() && isset( $theme_options[$location . '_thumb'] ) && $theme_options[$location . '_thumb'] == '1' ) : ?>
					<div class="index-thumb">
						<a href="<?php the_permalink() ?>" title="Read <?php the_title_attribute(); ?>">
							<?php the_post_thumbnail("full"); ?>
						</a>
					</div> <!-- .index-thumb -->
					<div style="clear:both"></div>
				<?php endif; ?>
				
				<div class="articleHead">
					<div class="category">
						<?php MW_the_category() ?>
					</div>
					<h2 class="title"><a href="<?php the_permalink() ?>" class="title" title="Read <?php the_title_attribute(); ?>"><?php the_title();  ?></a></h2>
					<div class="date"><?php the_time('d.m.y');?></div>
				</div> <!-- /.articleHead -->
				
				<div class="articleContent">
					<?php  the_content(); ?>
				</div>
				
				<div class="imageWaterfall">
				<?php
					$attachments = get_posts( array(
			            'post_type' => 'attachment',
			            'posts_per_page' => -1,
			            'post_parent' => $post->ID,
			            'exclude'     => get_post_thumbnail_id()
			        ) );
			 
			        if ( $attachments ) {
			            foreach ( $attachments as $attachment ) {
			            	//echo print_r( $attachment );
			            	//echo print_r( wp_get_attachment_metadata( $attachment->ID ) );
			                $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
			                $title = wp_get_attachment_image( $attachment->ID, $attachment->post_content );
			                echo '<div class="contain_'. $attachment->post_content. '">'. $title .'</div>';
			            }
			             
			        }
			    ?>
			    <div style="clear:both"></div>
				</div>
				
				<div class="sources">
					<?php the_field('sources'); ?>
				</div>
				
				<div id="sharrre">
					<div class="comment">
						<i class="sprite-comment"></i> <?php comments_popup_link(__('0 comments','TopShop'), __('1 comment','TopShop'), '% '.__('comments','TopShop')); ?>
					</div>
					<div class="social">
						<h4 class="share-single-text"><?php _e('Share:', 'TopShop'); ?></h4>
						<div id="twitter" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Tweet"></div>
						<div id="facebook" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Share"></div>
						<div id="pinterest" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Pin"></div>
						<div id="googleplus" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Share"></div>
					</div><!-- /social -->
				</div>

				<!-- <a href="<?php the_permalink(); ?>" class="readmore"><?php _e('Read More', 'TopShop'); ?></a> -->

		<?php } ?>

	</div><!-- .post-content  -->
</article>