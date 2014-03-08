<?php
/*
Plugin Name: FFXIV Lodestone RSS for Wordpress
Description: Using XIVPads.com json file, display an RSS to show announcements made on the official lodestone.
Version: 1.0
Author: Demonicpagan
Author URI: http://ffxiv.stelth2000inc.com

Copyright 2007-2014  Demonicpagan  (email : demonicpagan@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Define <!-- FFXIV_RSS -->
define('WP_STR_SHOW_FFXIV_RSS', '/<!-- FFXIV_RSS(\((([0-9],|[0-9]|,)*?)\))? -->/i');

function ffxiv_replace_string($searchstr, $replacestr, $haystack) {

	// Faster, but in PHP5.
	if (function_exists("str_ireplace")) {
		return str_ireplace($searchstr, $replacestr, $haystack);
	}
	// Slower but handles PHP4
	else { 
		return preg_replace("/$searchstr/i", $replacestr, $haystack);
	}
}

// Display Lodestone RSS
// ------------------------------
// <!-- FFXIV_RSS -->
function FFXIV_lodestone_show_rss($oldcontent)
{
	// Ensure we don't lose the original page
	$newcontent = $oldcontent;

	// Detect if we need to render the information by looking for the 
	// special string <!-- FFXIV_RSS -->
	if (preg_match(WP_STR_SHOW_FFXIV_RSS, $oldcontent, $matches))
	{
		// Turn DB stuff into HTML
		$content = FFXIV_Render_RSS();

		// Now replace search string with formatted information
		$newcontent = ffxiv_replace_string($matches[0], $content, $oldcontent);
	}
	return $newcontent;
}
add_filter('the_content', 'FFXIV_lodestone_show_rss');

function FFXIV_Render_RSS()
{
	$content .= "\n\n";

	// Get json file data
	$Data = json_decode(file_get_contents('http://xivpads.com/lodestone_rss.json'), true);

	// Parse the json data file
	$total = $Data['total'];

	for ($i = 0; $i < $total; $i++)
	{
		$timestamp = $Data['data'][$i]['time'];
		$url = $Data['data'][$i]['url'];
		$title = $Data['data'][$i]['title'];
		$image = $Data['data'][$i]['image'];

		$datetime = gmdate("F j, Y @ g:i a", $timestamp);

		$content .= "<a href='$url' target='_blank'>$title</a><br /><img src='$image' /><br />Posted on $datetime.<br />";
	}

	// Credit link
	$content .= "<div sytle='font-size: 8pt; font-family: Verdana;' align='center'>Powered By FFXIV Lodestone RSS Plugin Created By <a href='http://ffxiv.stelth2000inc.com'>Demonic Pagan</a></div>";

	// Add some space after the HTML
	$content .= "<br /><br />\n\n";

	return $content;
}

?>