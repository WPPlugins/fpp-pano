<div class="wrap">
<h2><?php _e('FPP-Pano Options','fpp-pano'); ?></h2>
<h3 class="tablenav">About FPP-Pano</h3>
<h4>by Roger Theriault</h4>
<p>
This WordPress plugin enables the use of the separate <a href="http://flashpanoramas.com/player/">Flash Panorama Player</a> (FPP) for displaying your 360 degree virtual reality scenes. 
</p>
<?php if (! file_exists(dirname(__FILE__). '/../FPP/pano.swf')) { ?>
<div id="message" class="error fade">
<h3>Installation Incomplete</h3>
<p>
You'll need to install your copy of the FPP files on your WordPress server.
Please read the README file and setup instructions in the plugin directory.
</p>
</div>
<?php } ?>
<p>
For instructions on setup and use of this plugin, please visit the <a href="http://www.rogertheriault.com/agents/plugins/fpp-pano-plugin/">FPP-Pano plugin website</a>.
</p>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>


<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
</p>

<fieldset><legend><?php _e('Settings','fpp-pano'); ?></legend>
<div>

<input type="checkbox" name="fpp_pano_css" value="true" <?php echo ("true" == get_option('fpp_pano_css')) ? "checked='checked'" : ""; ?> />
<label for="fpp_pano_css"><?php _e('Enable plugin delivered CSS stylesheet for the player','fpp-pano'); ?></label>
</div>
</fieldset>

<input type="hidden" name="action" value="update" />

<input type="hidden" name="page_options" value="fpp_pano_css" />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
</p>
</form>

</div>

