<?php

/*
 * Editor button - add an insert button for fpppano to the TinyMCE 3 editor
 *
 * Note: WP2.5 and up only
 *
 */

// if ( FALSE == IS_WP25 ) return;

function fpppano_addbuttons() {
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
		return;

	if ( get_user_option('rich_editing') == 'true' ) {

		add_filter( 'mce_external_plugins', 'add_fpppano_tinymce_plugin', 5 );
		add_filter( 'mce_buttons', 'register_fpppano_button', 5 );
	}
}

function register_fpppano_button( $buttons ) {
	array_push( $buttons, "separator", 'fpppano' );
	return $buttons;
}

function add_fpppano_tinymce_plugin( $plugin_array ) {
	$plugin_array['fpppano'] = FPP_URLPATH . 'tinymce/editor_plugin.js';
	return $plugin_array;
}


function fpppano_bump_tinymce($version) {
	return ++$version;
}

// Modify the version when tinyMCE plugins are changed.
add_filter('tiny_mce_version', 'fpppano_bump_tinymce');

add_action( 'init', 'fpppano_addbuttons' );


// Fiddling - TODO - remove
function fpppano_change_mce_settings( $init_array ) {
    $init_array['disk_cache'] = false; // disable caching
    $init_array['compress'] = false; // disable gzip compression
    $init_array['old_cache_max'] = 3; // keep 3 different TinyMCE configurations cached (when switching between several configurations regularly)
}
 
// add_filter( 'tiny_mce_before_init', 'fpppano_change_mce_settings' );
//

?>
