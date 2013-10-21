<?php
$item_classes = '';
$item_cats = get_the_terms($post->ID, 'pcategory');
if($item_cats):
foreach($item_cats as $item_cat) {
	$item_classes .= $item_cat->slug . ' ';
}
endif;
?>
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
						<span class="icon-images"><?php
						
						$photos = explode(',', $matches[0]);
						$images = count($photos);
						echo '<span class="image-count-number">' . $images . '</span>';
						
						?></span>
					</div>
				<?php } ?>
				
		</div><!-- portfolio-content-front -->
		
		<div class="portfolio-content-back">
			<?php the_post_thumbnail("gallery-thumb"); ?>
				<div class="portfolio-overlay">
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
</article><!-- #post-<?php the_ID(); ?> -->