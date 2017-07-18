<?php

/*
 * You can use these functions in your themes
 *
 * Or use the shortcode [fpp-pano ids="1,2,3"] in your content,
 * where the list of numbers are the attachment ids of the MOV files
 *
 */

function show_fpp_panos( $ids ) { 
	echo get_fpp_panos( $ids );
}

function get_fpp_panos ( $ids ) {
	// uses the FPP flash viewer to display the given attachment
	// id = the posts table ID of the attachment (or comma list)
	//
	
	if ( ! $ids ) 
		return;
	$allids = explode( ',', $ids );
	foreach ( $allids as $id ) {
		$id = (int) $id;
		$link = wp_get_attachment_url($id);
		# $rel_link = str_replace( '.mov', '', $link );
		$title = get_the_title($id);
		$noscripting = __('You need to enable JavaScript to view this content','fpp-pano');
		$choices .= '<a class="vrchoice" title="' . $title .
			'" rel="noindex" href="' . $link . '">' . $title . '</a>';
	}
	$label1 = __('360&deg; Virtual Reality  | Click and drag with the mouse to move, mouse wheel to zoom.','fpp-pano'); 
	$label2 = __('Right click for full screen.','fpp-pano'); 
	$output = <<<HERE
<div id="panodiv" class="vrbox">
	$choices
	<div class="vrwindow" id="vr_canvas">$noscripting</div>
	<div class="vrcaption">$label1<br /><strong>$label2</strong></div>
</div>
HERE;
	return $output;
}


?>
