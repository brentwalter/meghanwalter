<?php get_header(); ?>
<?php global $theme_shortname; global $theme_options; ?>
<div class="main home-no-page">

	<?php if(is_active_sidebar('homepage')) { ?>
       <section id="home-widgets">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage') ) : ?>
       	    <?php endif; ?>
       </section> <!-- #home-widgets  -->
	<?php } ?>

</div> <!-- .main -->
</div> <!-- .main-content -->

</div> <!-- .wrap-inside -->
</div> <!-- .wrapper -->


	<div class="wrapper container">

		<div class="wrap-inside">

        	<div class="main-content">

				<div class="main home-no-page">

					
					<?php if( is_active_sidebar('homepage-bottom') ) { ?>
				       <section id="home-widgets-bottom">
				            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('homepage-bottom') ) : ?>
				       	    <?php endif; ?>
				       </section> <!-- #home-widgets  -->
					<?php } ?>
					
					
					<div id="left" class="full-width">
				        <?php
					    $args = array(
					    	'paged' => $paged
					    );
					    $wp_query = null;
					    $wp_query = new WP_Query();
					    $wp_query->query( $args );
					    ?>
				
					    <?php if ( $wp_query->have_posts() ) : ?>
								
							<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();
				    	 			
									get_template_part( 'content', get_post_format() ); 
							endwhile;?>
							
							<?php if(function_exists('wp_pagenavi')) { ?>
								 
									<?php wp_pagenavi(); ?>
								
								<?php } else { ?> 
										
									<?php get_template_part( 'navigation', 'index' ); ?>
										 
								<?php } else : ?>
							
									<?php get_template_part( 'no-results', 'index' ); ?>
							
								<?php endif; wp_reset_query(); ?>
				    </div> <!--  end #left  -->
				    
				    
				    
				</div><!-- .main  -->
<?php get_footer(); ?>