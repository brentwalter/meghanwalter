/*! Copyright 2012, Ben Lin (http://dreamerslab.com/)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version: 1.0.14
 *
 * Requires: jQuery 1.2.3 ~ 1.9.0
 */
;(function(e){e.fn.extend({actual:function(t,n){if(!this[t]){throw'$.actual => The jQuery method "'+t+'" you called does not exist'}var r={absolute:false,clone:false,includeMargin:false};var i=e.extend(r,n);var s=this.eq(0);var o,u;if(i.clone===true){o=function(){var e="position: absolute !important; top: -1000 !important; ";s=s.clone().attr("style",e).appendTo("body")};u=function(){s.remove()}}else{var a=[];var f="";var l;o=function(){if(e.fn.jquery>="1.8.0")l=s.parents().addBack().filter(":hidden");else l=s.parents().andSelf().filter(":hidden");f+="visibility: hidden !important; display: block !important; ";if(i.absolute===true)f+="position: absolute !important; ";l.each(function(){var t=e(this);a.push(t.attr("style"));t.attr("style",f)})};u=function(){l.each(function(t){var n=e(this);var r=a[t];if(r===undefined){n.removeAttr("style")}else{n.attr("style",r)}})}}o();var c=/(outer)/g.test(t)?s[t](i.includeMargin):s[t]();u();return c}})})(jQuery);

/******************************************************
*
*   Loading effect for images
*
******************************************************/
function isScrolledIntoView(elem) {
    var docViewTop = jQuery(window).scrollTop(),
		docViewBottom = docViewTop + jQuery(window).height(),
		elemTop = jQuery(elem).offset().top,
		elemBottom = elemTop + jQuery(elem).actual('height'),
		val = jQuery(elem).actual('height') < 80 ? jQuery(elem).actual('height') : 80;

    return ( (elemTop <= (docViewBottom-val) && elemTop >= docViewTop ) || (elemBottom <= (docViewBottom-val) && elemBottom >= docViewTop ) );
}
function initPixElem(elem) {
	var top = 0,
		delay = 0,
		start = -100,
		setDelay;
    jQuery(elem).not(".pix-lazy-load").each(function(){
		var t = jQuery(this),
			opt = t.data('delay');
        if (isScrolledIntoView(t)){
        	t.addClass('pix-lazy-load');
			var newtop = t.offset().top;
			if ( typeof opt != 'undefined' && opt !== '' ) {
				delay = parseFloat(opt);
			} else {
				if ( newtop != top ) {
					top = newtop;
					setDelay = 0;
				} else {
					setDelay = (setDelay+200);
				}
				delay = start+setDelay;
			}

			if(!Modernizr.csstransforms3d) {
				t.filter('.pix-flipClock').removeClass('pix-flipClock').addClass('pix-fadeDown');
				t.filter('.pix-swing').removeClass('pix-swing').addClass('pix-fadeDown');
				t.filter('.pix-turnBackward').removeClass('pix-turnBackward').addClass('pix-fadeRight');
				t.filter('.pix-turnForward').removeClass('pix-turnForward').addClass('pix-fadeLeft');
			}

			if ( !t.is('.none, .available, .pix-fadeIn, .pix-fadeDown, .pix-fadeUp, .pix-fadeLeft, .pix-fadeRight, .pix-zoomIn, .pix-zoomOut, .pix-rotateIn, .pix-rotateOut, .pix-flipClock, .pix-swing, .pix-turnBackward, .pix-turnForward') ) {
				t.addClass(pixgridder_fx);
			}

			if ( !jQuery('iframe',t).length && !t.hasClass('none') ) {
				setTimeout(function(){
					if(!Modernizr.cssanimations){
						t.not('.pix-loaded').addClass('pix-loaded-inanim');
						jQuery('body').removeClass('pix-scroll-load');
					} else {
						t.addClass('pix-loaded');
						t.not('.pix-loaded').not('.available').not('.none').addClass('pix-loaded');
					}
				}, delay);
			} else {
				t.addClass('pix-loaded-inanim')
					.removeClass('pix-fadeIn')
					.removeClass('pix-fadeDown')
					.removeClass('pix-fadeUp')
					.removeClass('pix-fadeLeft')
					.removeClass('pix-fadeRight')
					.removeClass('pix-zoomIn')
					.removeClass('pix-zoomOut')
					.removeClass('pix-rotateIn')
					.removeClass('pix-rotateOut')
					.removeClass('pix-flipClock')
					.removeClass('pix-swing')
					.removeClass('pix-turnBackward')
					.removeClass('pix-turnForward');
			}
        }
    });
}

jQuery(window).bind('scroll resize',function(){
	var elems = jQuery('.pix-fadeIn, .pix-fadeDown, .pix-fadeUp, .pix-fadeLeft, .pix-fadeRight, .pix-zoomIn, .pix-zoomOut, .pix-rotateIn, .pix-rotateOut, .pix-flipClock, .pix-swing, .pix-turnBackward, .pix-turnForward').add(pixgridder_css_selector);
	if ( typeof pixgridder_fx !== 'undefined' && pixgridder_fx !== '' && pixgridder_fx !== 'none' ) {
		setTimeout(function() { initPixElem(elems); },100);

		jQuery('body').ajaxSuccess(function() {
			setTimeout(function() { initPixElem(elems); },100);
		});
	}
});
jQuery(function(){
			setTimeout(function() { jQuery(window).triggerHandler('scroll'); },100);
});