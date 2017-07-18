var fpp_dir, fpp_lbefore, fpp_lafter;

jQuery(document).ready(function () {
 	jQuery('#panodiv a.vrchoice').click(function (event) {
//		jQuery('#vr_canvas').after('<p>clicked '+jQuery(event.target).attr('href')+' </p>');

		jQuery('#vr_label').html(fpp_lbefore+jQuery(event.target).attr('title')+fpp_lafter);
		var movfile = '' + jQuery(event.target).attr('href');
		var movref = movfile.replace(/.mov/i,'');
		set_pano(movref, 'vr_canvas');
		jQuery('#panodiv a').removeClass('current-pano');
		jQuery(event.target).addClass('current-pano');

		return false;
	});
	jQuery('#panodiv a.vrchoice:first').click();
});


 function set_pano(panofile, target) {
   	var so = new SWFObject(fpp_dir+"show_pano.swf", "pano", "100%", "100%", "6.0.65", "#999999");
   	so.addParam("allowFullScreen","true");
   	so.addParam("allowScriptAccess","sameDomain");
	// note: the funny swf?foo=bar& deal is pretty important...
   	so.addVariable("movie", fpp_dir+"pano.swf?loaderStreamed=1"); 
   	so.addVariable("panoType", "mov");
   	so.addVariable("layer_7", fpp_dir+"movDecoder.swf");
   	so.addVariable("panoName", panofile);
   	so.addVariable("segments", "25");
   	so.addVariable("loaderText", "");
   	so.addVariable("layer_10", fpp_dir+"glassMeter.swf");
   	so.addVariable("layer_6", fpp_dir+"autorotator.swf");
   	so.addVariable("layer_8", fpp_dir+"menuFullscreen.swf");
   	//so.addVariable("qualityMotion", "low");
   	so.addVariable("redirect", window.location);
   	so.write(target);
   }

/*
<embed id="pano" width="100%" height="100%" flashvars="movie=pano.swf?xml_file=qtvr.xml&&panoName=/devel2.5/wp-content/uploads/2008/04/livingroomhdr&redirect=http://roger-bizpc/" allowscriptaccess="sameDomain" allowfullscreen="true" quality="high" bgcolor="#999999" name="pano" style="" src="show_pano.swf" type="application/x-shockwave-flash"/>
*/

