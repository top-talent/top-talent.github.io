// magic code to add a tinymce dropdown for shortcodes in WP post editor
// thanks to http://www.wpexplorer.com/wordpress-tinymce-tweaks/ for the help!

(function() {
	tinymce.PluginManager.add('crunch_mce_button', function( editor, url ) {
		editor.addButton( 'crunch_mce_button', {
			text: 'Shortcodes',
			icon: false,
			type: 'menubutton',
			menu: [

				//Blockquote Shortcode
				{
					text: 'Blockquote',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Blockquote',
							body: [
								{
									type: 'textbox',
									name: 'textboxQuote',
									label: 'Quote',
									value: '',
									multiline: true,
									minWidth: 400,
									minHeight: 200,
								},
								{
									type: 'textbox',
									name: 'textboxCite',
									label: 'Cite',
									value: '',
									multiline: true,
									minWidth: 400,
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[blockquote cite="' + e.data.textboxCite + '" ]' + e.data.textboxQuote + '[/blockquote]');
							}
						});
					}
				}, // end block quote

				//Button Shortcode
				// ====================================
				{
					text: 'Button',
					minWidth: 300,
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Button Shortcode',
							body: [

								// button text
								{
									type: 'textbox',
									name: 'textboxText',
									label: 'Button Text',
									value: 'Learn More',
									multiline: false,
									minWidth: 400
								},

								// button URL
								{
									type: 'textbox',
									name: 'textboxUrl',
									label: 'URL',
									value: 'http://',
									multiline: false,
									minWidth: 400,
								},

								{
									type: 'listbox',
									name: 'listboxType',
									label: 'Type',
									'values': [
										{text: 'Full Background', value: 'full-background'},
										{text: 'Text Only', value: 'text-only'}
									]
								},

							],
							onsubmit: function( e ) {
								editor.insertContent( '[button text="' + e.data.textboxText + '" url="' + e.data.textboxUrl + '" type="' + e.data.listboxType + '"]');
							}
						});
					}
				},

				{
					text: 'Panel',
					minWidth: 300,
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Panel Shortcode',
							body: [

								{
									type: 'listbox',
									name: 'listboxType',
									label: 'Type',
									'values': [
										{text: 'Full Background', value: 'full-background'},
										{text: 'Outline', value: 'outline'}
									]
								},

							],
							onsubmit: function( e ) {
								editor.insertContent( '[panel type="' + e.data.listboxType + '"]Some content goes here[/panel]');
							}
						});
					}
				},

			]

		});

	});
})();
