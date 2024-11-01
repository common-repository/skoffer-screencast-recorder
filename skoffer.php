<?php
/*
Plugin Name: Skoffer Screencasting
Plugin URI: http://www.skoffer.com/
Description: Adds a button to the "Write page" to record and insert a video of your PC screen
Version: 1.0
License: GPL
Author: http://www.skoffer.com
Author URI: http://www.skoffer.com
Contact mail: team@skoffer.com
Instructions
Copy the folder you unzipped into the wp-content/plugins folder of WordPress,
then go to Administration > Plugins and activtate the plugin.
Thanks
to Stefan He&szlig (http://www.jovelstefan.de) because reading the code of his plugin "Embedded Video with Link"
(http://www.jovelstefan.de/embedded-video/)
was very helpful to make this plugin
*/
global $wp_db_version;
if ( $wp_db_version >= 7558 ) {
if ('skoffer.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not access this file directly. Thanks!');
// this part replaces the video-id with the actual HTML code.
define("SKOFFER_WIDTH", 425);
define("SKOFFER_HEIGHT", 350);
define("SKOFFER_REGEXP", "/\[skoffer ([[:print:]]+)\]/");
define("SKOFFER_TARGET", "
<embed src=http://media.skoffer.com/api/v1/skoffer_player.swf?config={\"playlist\":[{\"url\":\"http://media.skoffer.com/###URL###.flv\",\"autoPlay\":false,\"autoBuffering\":true,\"scaling\":\"fit\"}]} type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"".SKOFFER_WIDTH."\" height=\"".SKOFFER_HEIGHT."\" allowFullScreen=\"true\" allowScriptAccess=\"always\" allowNetworking=\"all\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"></embed>");
function skoffer_plugin_callback($match)
{
$output = SKOFFER_TARGET;
$output = str_replace("###URL###", $match[1], $output);
return ($output);
}
function skoffer_plugin($content)
{
return (preg_replace_callback(SKOFFER_REGEXP, 'skoffer_plugin_callback', $content));
}
add_filter('the_content', 'skoffer_plugin');
add_filter('comment_text', 'skoffer_plugin');
/***********************/
function skoffer_mcebutton($buttons) {
array_push($buttons, "|", "skoffer");
return $buttons;
}
function skoffer_mceplugin($ext_plu) {
if (is_array($ext_plu) == false) {
$ext_plu = array();
}
$url = get_option('siteurl')."/wp-content/plugins/skoffer-screencast-recorder/editor_plugin.js";
$result = array_merge($ext_plu, array("skoffer" => $url));
return $result;
}
function skoffer_mceinit() {
if ( 'true' == get_user_option('rich_editing') ) {
add_filter("mce_external_plugins", "skoffer_mceplugin", 0);
add_filter("mce_buttons", "skoffer_mcebutton", 0);
}
}
function skoffer_script() {
echo "<script type='text/javascript' src='".get_option('siteurl')."/wp-content/plugins/skoffer-screencast-recorder/skoffer.js'></script>\n";
}
if ( function_exists('add_action') ) {
add_action('init', 'skoffer_mceinit');
add_action('admin_print_scripts', 'skoffer_script');
}
}
?>