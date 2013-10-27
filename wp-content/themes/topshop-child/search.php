<?php get_header(); ?>

<div id="index-page">
    <div id="left">
		<h1 class="title archive-title"><span class="title-bg"><?php printf( __( 'Search Results for: %s', 'TopShop' ), '' . get_search_query() . '' ); ?></span></h1>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content' ); ?>

			<?php endwhile; ?>

			<?php get_template_part( 'navigation', 'index' ); ?>
				 
		<?php  else : ?>
	
			<?php get_template_part( 'no-results', 'index' ); ?>
	
		<?php endif; ?>

	</div><!-- #left -->
</div><!-- #index-page -->
<?php get_footer(); ?>