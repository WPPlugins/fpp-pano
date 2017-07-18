=== FPP-Pano ===
Contributors: RogerTheriault
Donate link: http://www.rogertheriault.com/agents/
Tags: panorama,QTVR,VR,360,FPP,Flash Panorama Player,Flash
Requires at least: 2.5
Tested up to: 2.5.1
Stable tag: 1.0.1

FPP-Pano enables your WordPress blog to easily display your panoramas using the Flash Panorama Player (FPP)

== Description ==

Easily embed a panorama scene in your WordPress blog. If you own the Flash Panorama Player (available at http://flashpanoramas.com/player/) you can simply and easily upload a QTVR (Quicktime VR) file (or several) to your blog and then embed a Flash viewer window for them.

Note that this plugin will not work without your licensed FPP swf files. See the installation instructions for where to put the files.

== Installation ==

1. Unzip into your `/wp-content/plugins/` directory. 
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Drop the following files from your "Flash Panorama Player" software
   into the FPP directory:
* menuFullscreen.swf
* autorotator.swf
* glassMeter.swf
* movDecoder.swf
* show_pano.swf
* pano.swf
4. Go to Settings | FPP-Pano and choose whether you'd like this plugin to serve
up the CSS for your player
* if you make your own settings in your theme's stylesheet, disable this
4. Upload a MOV file of your panorama using the Insert Media button in the editor (you don't need to actually insert this in your post, it won't work anyway)
5. Now, to embed a player, in the edit window, select the location and click the 360 icon in the toolbar. Choose one or more Panoramas from the pop-up and click Insert. The shortcode will be inserted into the editor for you.
6. You can also insert the shortcode by hand [fpp-pano id=1,2,3]
7. You can also use the template tag <?php show_fpp_panos("1,2,3"); ?>

== Screenshots ==

1. After installing the plugin, copy your Flash Panorama Player SWF files to the FPP directory on the server.
2. Go to the Settings menu, choose FPP-Pano, and set your options.
3. On the Edit Page or Edit Post screen, select the Add Media button to bring up this standard WordPress 2.5 Media Upload screen. Select a compatible QTVR file and upload it, then set an appropriate title (this will be displayed on the tabs of the web interface) and choose Save All Changes. You don't need to select "insert Into Post"... patience!
4. Back on the editor screen, select an insertion point for the panorama. Then click the FPP-Pano button (labelled 360).
5. You should see this pop-up dialog. Choose one or more files from the multi-select menu - use the scroll bar if you have a lot of files. Then choose Insert.
6. The shortcode for FPP-Pano will be inserted into your post. If you need to change it, just delete the text and try again. Save or Publish your post.
7. You should see an interface like this on the actual post. If you don't like the CSS styling, copy the CSS in css/fpp.css, tweak it, and then change the options for FPP-Pano to not serve its css.

== Frequently Asked Questions ==

= What type of file should I upload? What's a QTVR? =

QTVR is Quicktime VR. It usually has a .mov extension, but it's not a video. It's a collection of photos stitched together in a panorama. 

= How can I make a panorama? =

There are plenty of resources on the web for creating panoramas. You'll want the resulting file to be a QTVR file to work with this viewer interface.

= What is Flash Panorama Player? =

Flash Panorama Player is a Flash based method for viewing panoramas. More information is available at http://flashpanoramas.com/player/


== Credits ==

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


== Updates == 

See the GNU General Public License for more details:
http://www.gnu.org/licenses/gpl.txt
