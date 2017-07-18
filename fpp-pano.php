<?php
/*
Plugin Name: FPP-Pano
Plugin URI: http://RogerTheriault.com/agents/plugins/fpp-pano-plugin/
Description: QTVR Panorama Viewer interface for WordPress
Version: 1.0.1
Author: Roger Theriault
Author URI: http://RogerTheriault.com/agents/
*/

/*  Copyright 2008  Roger Theriault  (email : roger@rogertheriault.com)

    FPP-Pano - QTVR Panorama Viewer interface for WordPress
    Copyright (C) 2008  Roger Theriault

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
/************************************************************************
 *
 *           IMPORTANT - READ THIS         IMPORTANT - READ THIS
 *
 * NOTE: This software enables the use of Flash Panorama Player for WordPress
 * However, it does not include the player executables; those are commercially
 * available from the owners of FPP at
 * 		http://flashpanoramas.com/player/
 *
 * To use this software, you'll need to follow the directions in the README.TXT
 * file to add your purchased copy of the FPP software to your system
 *
 * Specifically, your individually licensed .swf files should be placed
 * in the FPP subdirectory to this plugin directory.
 *
 * DISCLAIMER: The developer of this software is not affiliated with the 
 * developers of the Flash Panorama Player flash application, and cannot
 * provide support for that product. 
 *
 */

// STOP DIRECT CALLS
if( preg_match( '#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'] ) ) { die( 'You are not allowed to call this page directly.' ); }

#
global $wpdb, $wp_version;

define( 'FPPFOLDER', dirname( plugin_basename(__FILE__) ) );
define( 'FPP_URLPATH', get_option( 'siteurl' ).'/wp-content/plugins/' . FPPFOLDER.'/' );

// time to get any translations
load_plugin_textdomain( 'fpp-pano', FPPFOLDER );

// Check for WP2.5 installation
define( 'IS_WP25', version_compare( $wp_version, '2.4', '>=' ) );
// Shortcodes dont work unless WP2.5 or higher
if ( IS_WP25 == FALSE ){
	add_action( 'admin_notices', create_function( '', 'echo \'<div id="message" class="error fade"><p><strong>' . __( 'Warning: FPP-Pano shortcodes require WordPress 2.5 or higher', "fpp-pano" ) . '</strong></p></div>\';' ) );
}

function fpp_pano_admin_setup( ) {
	add_options_page( __('FPP-Pano','fpp-pano'), __('FPP-Pano','fpp-pano'), 'manage_options', dirname (__FILE__) . '/admin/options.php');
}

require_once( dirname (__FILE__).'/editorbuttons.php' );
////
if ( is_admin() ) {

	add_action('admin_menu', 'fpp_pano_admin_setup' );

	register_activation_hook( __FILE__, 'fpp_pano_activate' );
	function fpp_pano_activate( ) {
		# add option defaults
		add_option('fpp_pano_css','true');
		# add database files if not there
	}

	register_deactivation_hook( __FILE__, 'fpp_pano_deactivate' );
	function fpp_pano_deactivate( ) {
		# remove database files ??? no thats a separate user-initiated action
	}
	return; // we don't need anything below this line on the admin side
}
///////////////////////////////////////////////////////////////////




require_once( dirname (__FILE__) .'/templatefunctions.php' );

function fpp_pano_add_javascript( ) {

	// TODO - only add when we are displaying a page that needs this
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'swfobject', FPP_URLPATH . 'js/swfobject.js', FALSE );
	wp_enqueue_script( 'pano', FPP_URLPATH . 'js/pano.js', FALSE );

}
add_action( 'wp_print_scripts', 'fpp_pano_add_javascript' );


function fpp_pano_add_headerincludes( ) {

	// TODO - only add when we are displaying a page that needs this
	
	$defaultcss = ( 'true' == get_option( 'fpp_pano_css' ) ) ? true : false;

	// TODO - nice comments
	echo "\n<!-- added by FPP-Pano -->\n";
	if ( $defaultcss ) {
?>
	<style type="text/css" media="screen">@import "<?php echo FPP_URLPATH; ?>css/fpp.css";</style>
<?php
	}
	$fppdir = wp_make_link_relative(FPP_URLPATH) . "FPP/";
?>
<script type="text/javascript">
/* <![CDATA[ */
	fpp_dir = "<?php echo $fppdir; ?>";
	fpp_lbefore = "<?php _e(' - Now Viewing ','fpp-pano'); ?>";
	fpp_lafter = "<?php _e(' ','fpp-pano'); // for RTL ? ?>";

/* ]]> */
</script>
<?php
	echo "\n<!-- end FPP-Pano -->\n";
}
add_action( 'wp_head', 'fpp_pano_add_headerincludes', 90 );

/*
 * SHORTCODE HANDLERS
 *
 */

add_shortcode( 'fpp-pano', 'fpp_pano_sc_handler' );

function fpp_pano_sc_handler( $attr ) {
	$attr = shortcode_atts( array ( 'ids' => ''
		 ) , $attr );
	return get_fpp_panos( $attr[ids] );
}


/* HACKS (or Interfaces if you will...)
 * here go the interfaces to other plugins we access - which are likely to
 * break if those plugins change. Nice if plugin authors had more exposed 
 * functions we could use, oh well...
 *
 */

/* WIDGETS
 * Initialize our widgets
 */



?>
