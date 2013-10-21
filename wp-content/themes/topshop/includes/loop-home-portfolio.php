<?php global $theme_options; ?>

<?php if ( isset($theme_options['homepage_portfolio']) && $theme_options['homepage_portfolio'] == 1 ) { ?>
	
	<div id="home-portfolio" class="home-portfolio recent-products related">
		<h2 class="widgettitle"><span class="title-bg"><?php _e("From Portfolio", "TopShop"); ?></span></h2>
		<?php
		$portoflio_number = 3;
		$portoflio_number = $theme_options['homepage_portfolio_number'];

		$args = array(
			'post_type'=>'portfolio',
			'showposts' => $portoflio_number
		);

		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query( $args );
		?>

		<?php if ( $wp_query->have_posts() ) : ?>
			<div class="galleries">
			<div class="flexslider">
				<ul class="products slides">

		        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
		    		<?php $do_not_duplicate = $post->ID; ?>
					<?php global $post; ?>
					<?php echo "<li class='product'>"; ?>
		    		<?php get_template_part('content-portfolio'); ?>
					</li>
				<?php endwhile; endif; ?>

				</ul>
			</div>
			</div>
	</div> <!-- #home-portoflio -->
	
<?php  } ?>