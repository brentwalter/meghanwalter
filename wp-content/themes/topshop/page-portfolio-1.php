<?php 
/* 
Template Name: Portfolio One Column 
*/
?>
<?php get_header();?>

<div id="entry-full">
	<div id="left" class="full-width">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; endif; ?>

		<?php
	    $args = array(
			'post_type'=>'portfolio',
			'paged' => $paged,
			'posts_per_page' => -1,
			'post_status' => 'publish'
	    );

		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query( $args );
	    ?>

		<?php if ( $wp_query->have_posts() ) : ?>

			<div class="galleries one-column">
				<div class="one-column portfolio-filtered">

		        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					
					<?php
					$item_classes = '';
					$item_cats = get_the_terms($post->ID, 'pcategory');
					if($item_cats):
					foreach($item_cats as $item_cat) {
						$item_classes .= $item_cat->slug . ' ';
					}
					endif;
					?>
					
					<?php $do_not_duplicate = $post->ID; ?>
					<article id="post-<?php the_ID(); ?>" class="portfolio <?php echo $item_classes; ?>">
						<div class="gallery-image-wrap">
							<div class="portfolio-content-front">
							<?php if ( has_post_thumbnail() ) { ?>
								<?php $thumbid = get_post_thumbnail_id($post->ID);
									  $img = wp_get_attachment_image_src($thumbid,'full');
									  $img['title'] = get_the_title($thumbid); ?>


									<?php the_post_thumbnail("gallery-thumb"); ?>
									<?php
									$content = get_the_content();
									preg_match('/\[gallery(.*?)]/', $content , $matches);

									if ( ! empty($matches) && ! is_single() ) { ?>
										<div class="portfolio-has-gallery">
											<span class="icon-images"></span>
										</div>
									<?php } ?>
									</div><!-- portfolio-content-front -->

									<div class="portfolio-content-back">
									<div class="portfolio-overlay">
										<?php the_post_thumbnail("gallery-thumb"); ?>

										<div class="portfolio-overlay-details">
											<h2 class="gallery-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											<a href="<?php the_permalink(); ?>" class="link-icon"><span class="icon-menu-3"> <?php _e('Details', 'TopShop'); ?></span></a>
											<a href="<?php echo $img[0]; ?>" class="zoom-icon" rel="shadowbox" ><span class="icon-eye"> <?php _e('View', 'TopShop'); ?></span></a>

											<div class="like-counter">
												<a id="like-<?php the_ID(); ?>" class="like-count icons-thumbs-up" href="#" <?php ufo_liked_class(); ?>>
													<?php ufo_post_liked_count(); ?>
												</a>
											</div>
										</div>
									</div>
									
									</div><!-- portfolio-content-back -->
							<?php } else { ?>
									  <a href="<?php the_permalink(); ?>">
									  <?php echo '<img src="'.get_stylesheet_directory_uri().'/images/no-portfolio-archive.png" class="wp-post-image"/>'; ?></a>
							<?php } ?>

						</div>
						<?php the_excerpt(); ?>
					</article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; ?>

				</div><!-- .three-column .portfolio-filtered -->
			</div> <!-- .galleries -->

			<?php get_template_part( 'navigation', 'index' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>

	</div> <!-- #left  -->
</div> <!-- #entry-full  -->
<?php get_footer(); ?>