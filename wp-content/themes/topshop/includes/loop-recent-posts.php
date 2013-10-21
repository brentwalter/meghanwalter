<?php global $theme_options; ?>

<?php if ( isset( $theme_options['home_blog_recent'] ) && $theme_options['home_blog_recent'] == 1 ) { ?>

	<section id="home-from-blog" class="home-products recent-products related">
	
		<h2 class="widgettitle"><span class="title-bg"><?php _e("From the Blog", "TopShop"); ?></span></h2>
		<div class="flexslider">
			<ul class="products slides">
				<?php
				$wpq = array(
						'showposts'=> $theme_options['home_blog_number'],
						'post_status'=> 'publish'
					);
				$type_posts = new WP_Query ($wpq);
				?>
				<?php while ( $type_posts->have_posts() ) : $type_posts->the_post(); 

					global $post;
		
					echo "<li class='product'>"; ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="home-blog-thumb">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_post_thumbnail("gallery-thumb"); ?>
								</a>
							</div>
						<?php } ?>
						<a href="<?php echo get_permalink(); ?>" class="home-product-title"><h3><?php echo the_title() ?></h3></a>
						<?php the_excerpt(); ?>
					</li> <!--  .product  -->

		<?php endwhile; wp_reset_postdata(); ?>

			</ul>
		</div>
	</section><!-- home-products featured-products related -->
<?php  } ?>