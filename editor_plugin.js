(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('skoffer');
	
	tinymce.create('tinymce.plugins.skofferPlugin', {
		init : function(ed, url) {
			var t = this;
			t.editor = ed;
			ed.addCommand('mce_skoffer', t._skoffer, t);
			ed.addButton('skoffer',{
				title : 'Insert a Screencast of your PC screen', 
				cmd : 'mce_skoffer',
				image : url + '/img/skoffer-button.png'
			});
		},
		
		getInfo : function() {
			return {
				longname : 'Skoffer Plugin for Wordpress',
				author : 'Stefan Schulze Steinmann;',
				authorurl : 'http://www.skoffer.com/',
				infourl : 'http://www.skoffer.com/',
				version : '1.0'
			};
		},
		
		// Private methods
		_skoffer : function() { // open a popup window
			skoffer_insert();
			return true;
		}
	});

	// Register plugin
	tinymce.PluginManager.add('skoffer', tinymce.plugins.skofferPlugin);
})();