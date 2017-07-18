<?php

/* popup screen for TinyMCE editor to choose which Panos to insert
 *
 * Roger Theriault
 *
 * extended from WordTube by Alex Rabe
 *
 */


$wpconfig = realpath("../../../../wp-config.php");

if (!file_exists($wpconfig))  {
	echo "Could not locate wp-config.php. Error in path :\n\n".$wpconfig ;	
	die;	
}

require_once($wpconfig);
require_once(ABSPATH.'/wp-admin/admin.php');

if ( !current_user_can('edit_posts') && ! current_user_can( 'edit_pages' ) ) 
	die;

global $wpdb;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>FPP-Pano</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript">
	function init() {
		tinyMCEPopup.resizeToInnerSize();
	}
	
	function insertFppPano() {
		
		var tagtext;
		
		var allposts = document.getElementById('fppallposts_panel');
		
		var idlist = "";
		var options = document.getElementById('allpanos').options;
		for (ndx = 0; ndx < options.length; ndx++) {
			if (options[ndx].selected == true) {
				if (idlist) idlist = idlist + ",";
				idlist = idlist + options[ndx].value;
			}
		}

		if (idlist)
			tagtext = "[fpp-pano ids=" + idlist + "]";
		else
			tinyMCEPopup.close();
		
		if(window.tinyMCE) {
			window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
			//Peforms a clean up of the current editor HTML. 
			//tinyMCEPopup.editor.execCommand('mceCleanup');
			//Repaints the editor. Sometimes the browser has graphic glitches. 
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
		
		return;
	}
	</script>
	<base target="_self" />
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('allpanos').focus();" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<form name="fpppano" action="#">

	<div>
	<p>
	<label for="allpanos"><?php _e("Choose one or more Panorama file(s)",'fpp-pano'); ?></label>
	</p>
	<select id="allpanos" name="allpanos" multiple="multiple" 
		style="width: 300px; height: 50px;">
<?php

	// get QTVR ids for all media
	$args = array( 
		'post_type' => 'attachment',
		'post_mime_type' => 'video/quicktime',
		'numberposts' => null,
		'post_status' => null,
		'post_parent' => null, // any
	);
	$files = get_posts($args);
	if($files) {
		foreach( $files as $fid => $attachment ) {
			$attid = $attachment->ID;
			echo '<option value="'.$attid.'" ';
			echo '>'.$attachment->post_title;
			$parentdesc = get_the_title($attachment->post_parent);
			if ( $parentdesc ) 
				echo " - " . $parentdesc;
			echo '</option>'."\n\t"; 
		}
	}
?>		
        </select>
	</p>
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'fpp-pano'); ?>" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="<?php _e("Insert", 'fpp-pano'); ?>" onclick="insertFppPano();" />
		</div>
	</div>
</form>
</body>
</html>
<?php

?>
