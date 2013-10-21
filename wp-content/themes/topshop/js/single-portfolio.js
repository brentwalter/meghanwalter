//<![CDATA[
jQuery(document).ready(function() {
		
		var portfolio_gallery = jQuery('.portfolio-sidebar .gallery');
		jQuery('.single-portfolio article').append(portfolio_gallery);
		
		var portfolio_image = jQuery('.portfolio-sidebar .single-portfolio-image');
		jQuery('.single-portfolio article').append(portfolio_image);
		
		var portfolio_images = jQuery('.portfolio-sidebar img');
		jQuery('.single-portfolio article').append(portfolio_images);
		
		var portfolio_video = jQuery('.portfolio-sidebar embed, .portfolio-sidebar iframe, .portfolio-sidebar object');
		jQuery('.single-portfolio article').append(portfolio_video);
		
		jQuery('.single-portfolio').show();
		
		//Fixed/scrollable navigation menu
		var headerHeight = jQuery('#header-inner-wrap').outerHeight();
		var topmenuHeight = jQuery('#top-container').outerHeight();
		var totalHeight = headerHeight + topmenuHeight;

		var mainmenuHeight = jQuery('#main-menu-wrap').outerHeight();

		jQuery(window).scroll(function(){
		        if (jQuery(this).scrollTop() > totalHeight) {
		            jQuery('#main-menu-wrap').addClass('menu-static');
					jQuery('body').css('margin-top', mainmenuHeight+'px');

		        } else {
		            jQuery('#main-menu-wrap').removeClass('menu-static');
					jQuery('body').css('margin-top', '0');
		        }
		    });
});
//]]>