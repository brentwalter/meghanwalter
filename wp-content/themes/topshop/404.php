<?php get_header();?>
<div id="entry-full">
	<div id="left" class="full-width">
		<div class="post-full single">
			<div class="post-content not-found">
				<h2 class="not-found-404"><?php _e('404', 'TopShop'); ?></h2>
				<span class="not-found-404"><?php _e('Sorry, this page was not found. Try searching.', 'TopShop'); ?></span>
				<?php get_search_form(); ?>
			</div>  <!-- .post-content  -->
		</div> <!-- .post  -->
	</div> <!-- #left  -->
</div> <!-- #entry-full -->
<?php get_footer(); ?>
