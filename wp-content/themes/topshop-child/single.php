<?php get_header();?>

<div id="entry-full">
    <div id="left">
		
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
        <div class="post-full single">
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					
					
					<!-- Print Thumbnail -->
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="index-thumb">
								<?php the_post_thumbnail("full"); ?>
						</div> <!-- .index-thumb -->
						<div style="clear:both"></div>
					<?php endif; ?>
					
					<div class="articleHead">
						<div class="category">
							<?php MW_the_category() ?>
						</div>
						<h2 class="title"><?php the_title();  ?></h2>
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
<?php //get_sidebar(); ?>
</div> <!--  end #entry-full  -->
<?php get_footer(); ?>