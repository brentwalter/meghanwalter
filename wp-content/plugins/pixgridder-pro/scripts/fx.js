;function isScrolledIntoView(e){var t=jQuery(window).scrollTop(),n=t+jQuery(window).height(),r=jQuery(e).offset().top,i=r+jQuery(e).actual("height"),s=jQuery(e).actual("height")<80?jQuery(e).actual("height"):80;return r<=n-s&&r>=t||i<=n-s&&i>=t}function initPixElem(e){var t=0,n=0,r=-100,i;jQuery(e).not(".pix-lazy-load").each(function(){var e=jQuery(this),s=e.data("delay");if(isScrolledIntoView(e)){e.addClass("pix-lazy-load");var o=e.offset().top;if(typeof s!="undefined"&&s!==""){n=parseFloat(s)}else{if(o!=t){t=o;i=0}else{i=i+200}n=r+i}if(!Modernizr.csstransforms3d){e.filter(".pix-flipClock").removeClass("pix-flipClock").addClass("pix-fadeDown");e.filter(".pix-swing").removeClass("pix-swing").addClass("pix-fadeDown");e.filter(".pix-turnBackward").removeClass("pix-turnBackward").addClass("pix-fadeRight");e.filter(".pix-turnForward").removeClass("pix-turnForward").addClass("pix-fadeLeft")}if(!e.is(".none, .available, .pix-fadeIn, .pix-fadeDown, .pix-fadeUp, .pix-fadeLeft, .pix-fadeRight, .pix-zoomIn, .pix-zoomOut, .pix-rotateIn, .pix-rotateOut, .pix-flipClock, .pix-swing, .pix-turnBackward, .pix-turnForward")){e.addClass(pixgridder_fx)}if(!jQuery("iframe",e).length&&!e.hasClass("none")){setTimeout(function(){if(!Modernizr.cssanimations){e.not(".pix-loaded").addClass("pix-loaded-inanim");jQuery("body").removeClass("pix-scroll-load")}else{e.addClass("pix-loaded");e.not(".pix-loaded").not(".available").not(".none").addClass("pix-loaded")}},n)}else{e.addClass("pix-loaded-inanim").removeClass("pix-fadeIn").removeClass("pix-fadeDown").removeClass("pix-fadeUp").removeClass("pix-fadeLeft").removeClass("pix-fadeRight").removeClass("pix-zoomIn").removeClass("pix-zoomOut").removeClass("pix-rotateIn").removeClass("pix-rotateOut").removeClass("pix-flipClock").removeClass("pix-swing").removeClass("pix-turnBackward").removeClass("pix-turnForward")}}})}(function(e){e.fn.extend({actual:function(t,n){if(!this[t]){throw'$.actual => The jQuery method "'+t+'" you called does not exist'}var r={absolute:false,clone:false,includeMargin:false};var i=e.extend(r,n);var s=this.eq(0);var o,u;if(i.clone===true){o=function(){var e="position: absolute !important; top: -1000 !important; ";s=s.clone().attr("style",e).appendTo("body")};u=function(){s.remove()}}else{var a=[];var f="";var l;o=function(){if(e.fn.jquery>="1.8.0")l=s.parents().addBack().filter(":hidden");else l=s.parents().andSelf().filter(":hidden");f+="visibility: hidden !important; display: block !important; ";if(i.absolute===true)f+="position: absolute !important; ";l.each(function(){var t=e(this);a.push(t.attr("style"));t.attr("style",f)})};u=function(){l.each(function(t){var n=e(this);var r=a[t];if(r===undefined){n.removeAttr("style")}else{n.attr("style",r)}})}}o();var c=/(outer)/g.test(t)?s[t](i.includeMargin):s[t]();u();return c}})})(jQuery);jQuery(window).bind("scroll resize",function(){var e=jQuery(".pix-fadeIn, .pix-fadeDown, .pix-fadeUp, .pix-fadeLeft, .pix-fadeRight, .pix-zoomIn, .pix-zoomOut, .pix-rotateIn, .pix-rotateOut, .pix-flipClock, .pix-swing, .pix-turnBackward, .pix-turnForward").add(pixgridder_css_selector);if(typeof pixgridder_fx!=="undefined"&&pixgridder_fx!==""&&pixgridder_fx!=="none"){setTimeout(function(){initPixElem(e)},100);jQuery("body").ajaxSuccess(function(){setTimeout(function(){initPixElem(e)},100)})}});jQuery(function(){setTimeout(function(){jQuery(window).triggerHandler("scroll")},100)});