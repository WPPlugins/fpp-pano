/* tinymce 3 plugin for fpp-pano
 */

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('fpppano');

	tinymce.create('tinymce.plugins.fpppano', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('mcefpppano', function() {
				ed.windowManager.open({
					file : url + '/popupdialog.php',
					width : 320 + ed.getLang('fpppano.delta_width', 0),
					height : 120 + ed.getLang('fpppano.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url, // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('fpppano', {
				title : 'fpppano.desc',
				cmd : 'mcefpppano',
				image : url + '/img/fpppano.gif'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('fpppano', n.nodeName == 'IMG');
			});
		},


		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'FPP-Pano editor plugin',
				author : 'Roger Theriault',
				authorurl : 'http://www.rogertheriault.com/',
				infourl : 'http://www.rogertheriault.com/plugins',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('fpppano', tinymce.plugins.fpppano);
})();

