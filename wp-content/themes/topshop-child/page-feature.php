<?php
/*
Template Name: Feature Page Template
*/
?>
<?php get_header();?>

<div id="entry-full">
    <div id="left" class="full-width">
        <div class="post-full single">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
						<div class="date"><?php the_field('subtitle'); ?></div>
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
                    
                    
					

			<?php endwhile; else: ?>

				<p><?php _e('Sorry, no posts matched your criteria.','TopShop'); ?></p>

			<?php endif; ?>
            
         </div> <!--  end .post  -->
    </div> <!--  end #left  -->
</div> <!--  end #entry-full  -->
<?php get_footer(); ?>
