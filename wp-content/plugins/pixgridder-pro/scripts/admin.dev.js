jQuery.noConflict();

/*! Copyright 2012, Ben Lin (http://dreamerslab.com/)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version: 1.0.14
 *
 * Requires: jQuery 1.2.3 ~ 1.9.0
 */
;(function(e){e.fn.extend({actual:function(t,n){if(!this[t]){throw'$.actual => The jQuery method "'+t+'" you called does not exist'}var r={absolute:false,clone:false,includeMargin:false};var i=e.extend(r,n);var s=this.eq(0);var o,u;if(i.clone===true){o=function(){var e="position: absolute !important; top: -1000 !important; ";s=s.clone().attr("style",e).appendTo("body")};u=function(){s.remove()}}else{var a=[];var f="";var l;o=function(){if(e.fn.jquery>="1.8.0")l=s.parents().addBack().filter(":hidden");else l=s.parents().andSelf().filter(":hidden");f+="visibility: hidden !important; display: block !important; ";if(i.absolute===true)f+="position: absolute !important; ";l.each(function(){var t=e(this);a.push(t.attr("style"));t.attr("style",f)})};u=function(){l.each(function(t){var n=e(this);var r=a[t];if(r===undefined){n.removeAttr("style")}else{n.attr("style",r)}})}}o();var c=/(outer)/g.test(t)?s[t](i.includeMargin):s[t]();u();return c}})})(jQuery);


/*!
	jQuery Autosize v1.16.15
	(c) 2013 Jack Moore - jacklmoore.com
	updated: 2013-06-07
	license: http://www.opensource.org/licenses/mit-license.php
*/
;(function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i="hidden",n="border-box",s="lineHeight",a='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',r=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],l="oninput",c="onpropertychange",h=e(a).data("autosize",!0)[0];h.style.lineHeight="99px","99px"===e(h).css(s)&&r.push(s),h.style.lineHeight="",e.fn.autosize=function(s){return s=e.extend({},o,s||{}),h.parentNode!==document.body&&e(document.body).append(h),this.each(function(){function o(){if(t=w,h.className=s.className,p=parseInt(f.css("maxHeight"),10),e.each(r,function(e,t){h.style[t]=f.css(t)}),l in w){var o=w.style.width;w.style.width="0px",w.offsetWidth,w.style.width=o}}function a(){var e,n,a;t!==w&&o(),h.value=w.value+s.append,h.style.overflowY=w.style.overflowY,a=parseInt(w.style.height,10),h.style.width=Math.max(f.width(),0)+"px",h.scrollTop=0,h.scrollTop=9e4,e=h.scrollTop,p&&e>p?(e=p,n="scroll"):d>e&&(e=d),e+=b,w.style.overflowY=n||i,a!==e&&(w.style.height=e+"px",z&&s.callback.call(w,w))}var d,p,u,w=this,f=e(w),b=0,z=e.isFunction(s.callback);if(!f.data("autosize")){if((f.css("box-sizing")===n||f.css("-moz-box-sizing")===n||f.css("-webkit-box-sizing")===n)&&(b=f.outerHeight()-f.height()),d=Math.max(parseInt(f.css("minHeight"),10)-b||0,f.height()),u="none"===f.css("resize")||"vertical"===f.css("resize")?"none":"horizontal",f.css({overflow:i,overflowY:i,wordWrap:"break-word",resize:u}).data("autosize",!0),c in w?l in w?w[l]=w.onkeyup=a:w[c]=function(){"value"===event.propertyName&&a()}:w[l]=a,s.resizeDelay!==!1){var x,y=e(w).width();e(window).on("resize.autosize",function(){clearTimeout(x),x=setTimeout(function(){e(w).width()!==y&&a()},parseInt(s.resizeDelay,10))})}f.on("autosize",a),a()}})}})(window.jQuery||window.Zepto);

/*
 * jQuery resize event - v1.1 - 3/14/2010
 * http://benalman.com/projects/jquery-resize-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
;(function($,h,c){var a=$([]),e=$.resize=$.extend($.resize,{}),i,k="setTimeout",j="resize",d=j+"-special-event",b="delay",f="throttleWindow";e[b]=250;e[f]=true;$.event.special[j]={setup:function(){if(!e[f]&&this[k]){return false}var l=$(this);a=a.add(l);$.data(this,d,{w:l.width(),h:l.height()});if(a.length===1){g()}},teardown:function(){if(!e[f]&&this[k]){return false}var l=$(this);a=a.not(l);l.removeData(d);if(!a.length){clearTimeout(i)}},add:function(l){if(!e[f]&&this[k]){return false}var n;function m(s,o,p){var q=$(this),r=$.data(this,d);r.w=o!==c?o:q.width();r.h=p!==c?p:q.height();n.apply(this,arguments)}if($.isFunction(l)){n=l;return m}else{n=l.handler;l.handler=m}}};function g(){i=h[k](function(){a.each(function(){var n=$(this),m=n.width(),l=n.height(),o=$.data(this,d);if(m!==o.w||l!==o.h){n.trigger(j,[o.w=m,o.h=l])}});g()},e[b])}})(jQuery,this);

/********************************
*
*   If an element if visible
*
********************************/
function isScrolledIntoCompleteView(elem, val) {
    var docViewTop = jQuery(window).scrollTop();
    var docViewBottom = docViewTop + jQuery(window).height();

    var elemTop = jQuery(elem).offset().top;
    var elemBottom = elemTop + jQuery(elem).actual('height') + val;

    return ( elemTop >= docViewTop && elemBottom <= docViewBottom);
}

/********************************
*
*   Select
*
********************************/
function getSelValue(){
    jQuery('#pix_content_loaded select').each(function(){
	    jQuery(this).bind('change',function(){
	        var tx = jQuery('option:selected',this).text();
	        if ( !jQuery(this).parents('span').eq(0).find('.appended').length ) {
				jQuery(this).parents('span').eq(0).prepend('<span class="appended" />');
			}
			var elm = jQuery(this).siblings('.appended');
			jQuery(elm).text(tx);
	    }).triggerHandler('change');
	});
}

/********************************
*
*   Sliders
*
********************************/
function init_sliders() {
	if(jQuery.isFunction(jQuery.fn.slider)) {
		jQuery('.slider_div').each(function(){
			var t = jQuery(this);
			var value = jQuery('input',t).val();
			if(t.hasClass('milliseconds')){
				var mi = 0;
				var m = 50000;
				var s = 100;
			} else if(t.hasClass('milliseconds_2')){
				var mi = 0;
				var m = 5000;
				var s = 10;
			} else if(t.hasClass('opacity')){
				var mi = 0;
				var m = 1;
				var s = 0.05;
			} else if(t.hasClass('border')){
				var mi = 0;
				var m = 50;
				var s = 1;
			} else if(t.hasClass('em')){
				var mi = 0;
				var m = 8;
				var s = 0.001;
			} else if(t.hasClass('percent')){
				var mi = 0;
				var m = 100;
				var s = 1;
			} else if(t.hasClass('ratio')){
				var mi = 0;
				var m = 20;
				var s = 0.01;
			} else {
				var mi = 1;
				var m = 20;
				var s = 1;
			}
			jQuery('.slider_cursor',t).slider({
				range: 'min',
				value: value,
				min: mi,
				max: m,
				step: s,
				slide: function( event, ui ) {
					jQuery('input',t).val( ui.value );
				}
			});
			jQuery('a',t).mousedown(function(event){
				t.addClass('active');
			});
			jQuery(document).mouseup(function(){
				t.removeClass('active');
			});
			jQuery('input',t).keyup(function(){
				var v = jQuery('input',t).val();
				jQuery('.slider_cursor',t).slider({
					range: 'min',
					value: v,
					min: 0,
					max: m,
					step: s,
					slide: function( event, ui ) {
						jQuery('input',t).val( ui.value );
					}
				});
			});
			jQuery('.slider_cursor',t).each(function(){
				if ( jQuery('.ui-slider-range-min',this).length > 1 ) {
					jQuery('.ui-slider-range-min',this).not(':last').remove();
				}
			});
		});
	}
}

/********************************
*
*	Navsidebar menu
*
********************************/
function adminNav(){
	if(pagenow=='toplevel_page_pixgridder_admin') {
		function pix_ajax_update() {
			var spinner = jQuery('#spinner2');
			jQuery('#pix_ap_header h2').append(spinner.animate({opacity:1},100));

			var pixgridder_active_tab = localStorage.getItem("pixgridder_active_tab"),
				pixgridder_active_link = localStorage.getItem("pixgridder_active_link");

			if(typeof pixgridder_active_tab == 'undefined' || pixgridder_active_tab == false || pixgridder_active_tab == null) {
				pixgridder_active_tab = 'general';
			}
			if(typeof pixgridder_active_link == 'undefined' || pixgridder_active_link == false || pixgridder_active_link == null) {
				pixgridder_active_link = 'register';
			}

			var url = jQuery('#pix_ap_body li[data-store='+pixgridder_active_link+'] a').attr('href');

			jQuery.ajax({
				url: url,
				success: function(loadeddata){
					var height = jQuery('#pix_content_loaded').outerHeight();
					jQuery('#pix_content_loaded').outerHeight(height);

					jQuery('#pix_ap_body').find('li[data-store='+pixgridder_active_tab+'], li[data-store='+pixgridder_active_link+']').addClass('current');

					var html = jQuery("<div/>").append(loadeddata.replace(/<script(.|\s)*?\/script>/g, "")).find('#pix_content_loaded').html();
					jQuery('#pix_content_loaded').animate({opacity:0},0).html('<div class="cf">'+html+'</div>');
					var newH = jQuery('#pix_content_loaded > div').actual('outerHeight');
					jQuery('#pix_content_loaded').html(html);
						
					jQuery('#pix_content_loaded').animate({height:newH},800,'easeOutQuad',function(){
						spinner.animate({opacity:0},100,function(){
							jQuery('#spinner_wrap').prepend(spinner);
						});
						jQuery('#pix_content_loaded').css({height:'auto'});
						jQuery('#pix_content_loaded').animate({opacity:1},250,function(){
							floatingSaveButton();
						});
					});
					floatingSaveButton();
					saveOptions();
					compileCSS();
					getSelValue();
					init_sliders();
					infoDialog();
					changelogButton();
					sortElems();
					pagesCheckboxes();
					checkLicense();
					closeAlerts();
					if(jQuery('#pixgridder_css_code').length){
						var editor = CodeMirror.fromTextArea(document.getElementById("pixgridder_css_code"), {theme:'solarized light'});
					}

				},
				error: function(){
					/*pixgridder_active_tab = 'general_head';
					pixgridder_active_link = 'admin_panel';*/
				}
			});
		}
	
		pix_ajax_update();

		jQuery('nav#pix_ap_main_nav > ul > li').not('.current').each(function(){

			var li = jQuery(this);

				jQuery('> a, > ul', li).hover(function(){
					if ( !li.hasClass('current') ) {
						li.addClass('hover');
						jQuery('nav#pix_ap_main_nav li.current').removeClass('current').addClass('fake-current');
					}
				},function(){
					li.removeClass('hover');
					jQuery('nav#pix_ap_main_nav li.fake-current').removeClass('fake-current').addClass('current');
				});

			jQuery('> a', li).bind('click',function(){
				return false;
			});
		});

		jQuery('nav#pix_ap_main_nav > ul > li li').not('.current').each(function(){

			var li = jQuery(this);

			jQuery('> a', li).bind('click',function(){
				var t = jQuery(this);

				jQuery('nav#pix_ap_main_nav > ul li').removeClass('current').removeClass('fake-current');
				li.parents('li').eq(0).addClass('current');
				li.addClass('current');

				if ( jQuery('nav#pix_ap_main_nav > ul li.hover').length ) {
					var tab = jQuery('nav#pix_ap_main_nav > ul li.hover').attr('data-store');
					if (Modernizr.localstorage) {
						localStorage.setItem("pixgridder_active_tab", tab);
					}
				}

				var link = li.attr('data-store');
				if (Modernizr.localstorage) {
					localStorage.setItem("pixgridder_active_link", link);
				}
				pix_ajax_update();
				return false;
			});
		});

		/*Height of the ULs*/
		jQuery('nav#pix_ap_main_nav > ul > li ul').each(function(){
			var h = jQuery(this).actual('outerHeight'),
				wrapH = jQuery(this).parents('ul').eq(0).actual('outerHeight');

			if ( h < wrapH ) {
				jQuery(this).outerHeight(wrapH);
			}
		});
	}
}

/********************************
*
*	Show option
*
********************************/
function floatingSaveButton(){
	jQuery(window).bind('scroll resize',function(){
		jQuery('#pix_content_loaded .pix-save-options.fake_button2').each(function(){
			var t = jQuery(this),
				l = jQuery(window).width()-(t.offset().left+t.outerWidth()),
				cont = jQuery('#pix_content_loaded'),
				lCont = cont.offset().left,
				wCont = cont.outerWidth();
			jQuery('#pix_content_loaded #gradient-save-button').css({
				left: lCont,
				width: wCont
			});
			if (isScrolledIntoCompleteView(this, 20))	{
				jQuery('#pix_content_loaded .pix-save-options').not('.fake_button').not('.fake_button2').removeClass('fixed').css({
					right: 20
				});
				jQuery('#pix_content_loaded #gradient-save-button').fadeOut(150);
			} else {
				jQuery('#pix_content_loaded .pix-save-options').not('.fake_button').not('.fake_button2').addClass('fixed').css({
					right: l
				});
				jQuery('#pix_content_loaded #gradient-save-button').fadeIn(150);
			}
		});
	}).triggerHandler('scroll');
}

/********************************
*
*	Save options
*
********************************/
function saveOptions(){
	jQuery(document).off('submit','form.ajax_form');
	jQuery(document).on('submit','form.ajax_form',function() {
		var spinner = jQuery('#spinner'),
			t = jQuery(this),
			data = t.serialize();

		if ( jQuery(this).find('input[name="compile_css"]').val() != 'compile_css' ) {

			t.find('button[type="submit"]').not('.push').not('.download').append(spinner).animate({paddingLeft:40},150,function(){spinner.animate({opacity:1},100);});

			jQuery.post(ajaxurl, data)
				.success(function() {
		console.log(data);
					spinner.delay(500).animate({opacity:0},100,function(){
						jQuery('#spinner_wrap').append(spinner);
						jQuery('form.ajax_form button[type="submit"] i').fadeIn(100).delay(500).fadeOut(100,function(){
							jQuery('button[type="submit"].pix-save-options',t).animate({paddingLeft:15},150);
						});
					});
				})
				.error(function() { console.log('no'); });

		} else {

			t.find('button[type="submit"].push').append(spinner).animate({paddingRight:40},150,function(){spinner.animate({opacity:1},100);});	

			var cont = { action: 'css_pixgridder_ajax', context: data };

			jQuery.post(ajaxurl, cont).success(function(html){ 
				jQuery.post(ajaxurl, data).success(function(html){ 
					spinner.delay(500).animate({opacity:0},100,function(){
						jQuery('#spinner_wrap').append(spinner);
						t.find('.pix_button.compile.push').animate({paddingRight:20},150);
						t.find('input[name="compile_css"]').val('');
					});
				});
			});
		
		}
		return false;
	});
}

/********************************
*
*	Save options
*
********************************/
function compileCSS(){
	jQuery(document).off('click','button[type="submit"].download');
	jQuery(document).on('click','button[type="submit"].download',function() {
		var t = jQuery(this),
			form = t.parents('form').eq(0),
			oldAction = form.attr('action'),
			newAction = t.attr('data-action');
		if ( form.hasClass('ajax_form') ) {
			form.removeClass('ajax_form').attr('action',newAction).attr('method','post').submit();
			form.addClass('ajax_form').removeAttr('method');
		} else {
			form.attr('action',newAction).submit();
		}
		form.attr('action',oldAction);
		return false;
	});

	jQuery(document).off('click','button[type="submit"].push');
	jQuery(document).on('click','button[type="submit"].push',function() {
		var t = jQuery(this),
			form = t.parents('form').eq(0),
			input = form.find('input[name="compile_css"]').val('compile_css');

		jQuery('button[type="submit"].pix-save-options',form).click();
		
		input.val('');

		return false;
	});
}

/********************************
*
*	Changelog button
*
********************************/
function changelogButton(){
	jQuery(document).off('click','.pix-iframe');
	jQuery(document).on('click','.pix-iframe',function() {
		var href = jQuery(this).attr('href'),
			title = jQuery(this).text(),
			h = jQuery(window).height(),
			div = jQuery('<div />');
		if ( href.match(/\.(jpg|png|gif)/i) ) {
			var spinner = jQuery('#spinner2');
			jQuery('#pix_ap_header h2').append(spinner.animate({opacity:1},100));
            jQuery('<img />').load( function(){
            	//alert(jQuery(this).get(0).naturalWidth);
				spinner.animate({opacity:0},100,function(){
					jQuery('#spinner_wrap').prepend(spinner);
				});
				div.append(jQuery(this)).dialog({
					height: jQuery(this).get(0).naturalHeight,
					width: jQuery(this).get(0).naturalWidth,
					modal: false,
					dialogClass: 'wp-dialog pix-dialog pix-dialog-info pix-dialog-iframe',
					position: 'center',
					title: title,
					zIndex: 100,
					open: function(){
				        jQuery('body').addClass('overflowHidden');        
						jQuery('body').append('<div id="pix-modal-overlay" />');
					},
					close: function(){
						jQuery('#pix-modal-overlay').remove();
				        jQuery('body').removeClass('overflowHidden');     
				        div.remove();   
		    			jQuery(window).unbind('resize');  
					}
				});
				div.bind('resize',function() {
					div.dialog('option','position','center');
				}).triggerHandler('resize');
            }).attr('src', href).each(function() {
                if(this.complete) jQuery(this).load();
            });
        } else {
			div.append(jQuery("<iframe />").attr("src", href)).dialog({
				height: (h*0.8),
				width: '80%',
				modal: false,
				dialogClass: 'wp-dialog pix-dialog pix-dialog-info pix-dialog-iframe',
				position: 'center',
				title: title,
				zIndex: 100,
				open: function(){
			        jQuery('body').addClass('overflowHidden');        
					jQuery('body').append('<div id="pix-modal-overlay" />');
				},
				close: function(){
					jQuery('#pix-modal-overlay').remove();
			        jQuery('body').removeClass('overflowHidden');     
			        div.remove();   
	    			jQuery(window).unbind('resize');  
				}
			});
			jQuery(window).bind('resize',function() {
				h = jQuery(window).height();
				div.dialog( 'option', {'height':(h*0.8)} );
			});
			div.bind('resize',function() {
				div.dialog('option','position','center');
			}).triggerHandler('resize');
		}
		return false;
	});
}


/********************************
*
*	Dialog boxes for info
*
********************************/
function infoDialog(){
	jQuery(document).off('click','[data-dialog]');
	jQuery(document).on('click','[data-dialog]',function() {
		var html = jQuery(this).attr('data-dialog'),
			w = (typeof jQuery(this).attr('data-width') != 'undefined') ? jQuery(this).attr('data-width') : 400,
			title = jQuery(this).text(),
			div = jQuery('<div />').html(html);
		div.dialog({
			height: 'auto',
			width: w,
			modal: false,
			dialogClass: 'wp-dialog pix-dialog pix-dialog-info',
			position: 'center',
			title: title,
			zIndex: 100,
			open: function(){
		        jQuery('body').addClass('overflowHidden');        
				jQuery('body').append('<div id="pix-modal-overlay" />');
			},
			close: function(){
				jQuery('#pix-modal-overlay').remove();
		        jQuery('body').removeClass('overflowHidden');        
		        div.remove();   
    			jQuery(window).unbind('resize');  
			}
		});
		jQuery(window).bind('resize',function() {
			h = jQuery(window).height(),
			div.dialog('option',{'position':'center'});
		});
		return false;
	});
}

/******************************************************
*
*	Sortable
*
******************************************************/
function sortElems(){
	jQuery('.pix-sorting').each(function(){ 
		var pixsorting = jQuery(this);

/* Add an element */
		jQuery(document).off('click','.add-element');
		jQuery(document).on('click','.add-element',function(){
			var clone = pixsorting.find('.clone').clone();
			clone.find('textarea').trigger('oninput');
			clone.fadeIn().removeClass('hidden').removeClass('clone');
			clone.find('[data-clone]').each(function(){
				var attrb = jQuery(this).attr('data-clone');
				jQuery(this).removeAttr('data-clone');
				attrb = attrb.replace(/\[i\]/g, '['+pixsorting.find('> div').not('.clone').length+']');
				jQuery(this).attr('name',attrb).trigger('oninput');
			});
			jQuery(this).before(clone);
			getSelValue();
			infoDialog();
			sortElems();
			return false;
		});

/* Remove an element */
		jQuery(document).off('click','.pix-sorting-elem .delete-element');
		jQuery(document).on('click','.pix-sorting-elem .delete-element',function(){
			var el = jQuery(this).parents('.pix-sorting-elem').eq(0);
			el.animate({opacity:0,height:0,minHeight:0,paddingTop:0,paddingBottom:0,margin:0},400, 'easeOutQuad', function(){ 
				jQuery(this).remove();
	            pixsorting.find('> div').not('.clone').each(function(){
	            	var ind = jQuery(this).index();
	            	jQuery('[name]',this).each(function(){
						var attrb = jQuery(this).attr('name');
						attrb = attrb.replace(/_\[(.*?)\]\[/g, '_['+ ( ind - 1 ) +'][');
						jQuery(this).attr('name',attrb);
					});
	            });
	        });
			return false;
		});

/* Edit an element */
		jQuery(document).off('click','.edit-element');
		jQuery(document).on('click','.edit-element',function(){
			var t = jQuery(this),
				par = t.parents('.pix-sorting-elem').eq(0),
				div = jQuery('.dialog-edit-sorting-elements').clone(),
				h = jQuery(window).height(),
				w = (typeof div.attr('data-width') != 'undefined') ? div.attr('data-width') : 400,
				title = div.attr('data-title');
			div.dialog({
				height: 'auto',
				width: w,
				modal: false,
				dialogClass: 'wp-dialog pix-dialog pix-dialog-info pix-dialog-input',
				title: title,
				zIndex: 100,
				open: function(){
					getSelValue();
			        jQuery('body').addClass('overflowHidden');        
					jQuery('body').append('<div id="pix-modal-overlay" />');
					jQuery(this).closest('.ui-dialog').find('.ui-button').last().addClass('ui-dialog-titlebar-edit pix_button');

					par.find('[data-name]').each(function(){
						if ( jQuery(this).attr('data-name')=='color' && jQuery(this).val()=='' ) {
							div.find('[data-name="'+jQuery(this).attr('data-name')+'"]').val('transparent');
						} else {
							div.find('[data-name="'+jQuery(this).attr('data-name')+'"] option[value="'+jQuery(this).val()+'"]').prop('selected',true).trigger('change');
							div.find('[data-name="'+jQuery(this).attr('data-name')+'"]').val(jQuery(this).val()).trigger('keyup');
							if ( jQuery(this).attr('data-name')=='icon' ) {
								div.find('.pixgridder-icon-preview i').attr('class',jQuery(this).val());
							}							
						}
					});
				},
				buttons: {
					'': function() {
						jQuery(this).find('[data-name]').each(function(){
							par.find('[data-name="'+jQuery(this).attr('data-name')+'"]').val(jQuery(this).val()).prop('readOnly',false).trigger('oninput').prop('readOnly',true);
							par.find('[data-class="'+jQuery(this).attr('data-name')+'"]').attr('class',jQuery(this).val());
							par.find('[data-color="'+jQuery(this).attr('data-name')+'"]').css('background-color',jQuery(this).val());
						});
						jQuery(this).dialog('close');
					}
				},
				close: function(){
					jQuery('#pix-modal-overlay').remove();
					div.remove();
			        jQuery('body').removeClass('overflowHidden'); 
        			jQuery(window).unbind('resize');  
				}
			});
			jQuery(window).bind('resize',function() {
				div.dialog( 'option', {'height':'auto'} );
				h = jQuery(window).height();
				var divH = div.parents('.ui-dialog').eq(0).outerHeight();
				if (divH > (h*0.8)) {
					div.dialog( 'option', {'height':(h*0.8)} );
				}
			}).triggerHandler('resize');
			div.bind('resize',function() {
				div.dialog('option','position','center');
			}).triggerHandler('resize');
			return false;
		});
	});
}

/********************************
*
*	Pages checkboxes
*
********************************/
function pagesCheckboxes(){
	jQuery(document).off('click','.for_pages input[type="checkbox"]');
	jQuery(document).on('click','.for_pages input[type="checkbox"]',function() {
		if (jQuery(this).is(':checked')) {
			checked = true;
		} else {
			checked = false;
		}
		jQuery(this).parents('blockquote').eq(0).find('blockquote input[type="checkbox"]').prop('checked',checked);
	});
}

/********************************
*
*	Check license
*
********************************/
function checkLicense(){
	if ( typeof pixgridder_check_license != 'undefined' && pixgridder_check_license != false && pixgridder_check_license != null) {
		jQuery('#check_license_message').html(pixgridder_check_message).slideDown();
	}

	pixgridder_check_license = undefined;
}

/********************************
*
*	Close alerts
*
********************************/
function closeAlerts(){
	jQuery(document).off('click', '.info_close');
	jQuery(document).on('click', '.info_close', function(){
		jQuery('input[type=hidden]',this).val('close');
		jQuery(this).parents('.outer_info').eq(0).slideUp(250,'easeOutQuad').animate({opacity:0},{queue:false,duration:250},'easeOutQuad');
		var data = jQuery(this).parents('.outer_info').eq(0).find('input').serialize();
		jQuery.post(ajaxurl, data);
	});
}

jQuery(function(){
	floatingSaveButton();
	saveOptions();
	compileCSS();
	adminNav();
	jQuery('textarea').livequery(function(){
		jQuery(this).autosize();
	});
	getSelValue();
	init_sliders();
	infoDialog();
	changelogButton();
	sortElems();
	pagesCheckboxes();
});
