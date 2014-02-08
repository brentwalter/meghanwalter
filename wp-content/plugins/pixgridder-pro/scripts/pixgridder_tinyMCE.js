jQuery.noConflict();

function pixgridderTinyMCEinit() {
	var DOM = tinymce.DOM;

	tinymce.init;

	tinymce.create('tinymce.plugins.PixGridder', {
		mceTout : 0,
		paste_remove_spans: true,
		theme_advanced_resizing: false,

		init : function(ed, url) {
			var t = this;

			ed.onBeforeSetContent.add(function(ed, o) {

				var head = tinyMCE.activeEditor.dom.select('head');

				if (pix_builder_modal=='open') {

					setTimeout(function(){
						var h = (jQuery('#textarea_builder').height() - (jQuery('#textArea_toolbargroup').height() + jQuery('#wp-textArea-editor-tools .wp-editor-tabs').height())),
							h2 = (jQuery('#textarea_builder').height() - (jQuery('#qt_textArea_toolbar').height() + jQuery('#wp-textArea-editor-tools .wp-editor-tabs').height()));

						ed.theme.resizeTo('auto', (h-42));
						jQuery('#wp-textArea-editor-container textarea').css({height:(h2-20)});

						jQuery(window).bind('resize',function(){
							h = (jQuery('#textarea_builder').height() - (jQuery('#textArea_toolbargroup').height() + jQuery('#wp-textArea-editor-tools .wp-editor-tabs').height()));
							h2 = (jQuery('#textarea_builder').height() - (jQuery('#qt_textArea_toolbar').height() + jQuery('#wp-textArea-editor-tools .wp-editor-tabs').height()));

							ed.theme.resizeTo('auto', (h-42));
							jQuery('#wp-textArea-editor-container textarea').css({height:(h2-20)});
						});
					},10);
				}

			});

		}

	});

	tinymce.PluginManager.add('pixgridder', tinymce.plugins.PixGridder);

}
jQuery(function() { pixgridderTinyMCEinit(); });