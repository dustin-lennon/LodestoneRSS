FFXIV Lodestone RSS Information
=====================================
Developer: Dustin Lennon<br />
Email: <demonicpagan@gmail.com>

Display the official Lodestone announcements on your blog.

Setup:

1. Extract and upload the plugin to your wp-content/plugins folder.

2. Activate the plugin.

3. Create a new page and put <!-- FFXIV_RSS --> in the editor and publish your page.

Hosting Local JSON file
------------------------
If you would like to host your own JSON file, make the following adjustments and additions:

1. Upload api.php and lodestone_rss.php as well to your web server.

2. Edit line 69 to where it reads something similar to `$Data = json_decode(file_get_contents('http://ffxiv.stelth2000inc.com/wp-content/plugins/ffxiv-lodestone-rss/lodestone_rss.json'), true);`.

3. Create a cron job to run lodestone_rss.php hourly
	`0 * * * * php5 /path/to/lodestone_rss.php`

In the future, I'll add this as a feature to enable/disable running locally after creating an administration back-end for the plug-in.

If you experience any issues please submit a bug report on
<http://github.com/demonicpagan/LodestoneRSS/issues>.

You can always get the latest source from <http://github.com/demonicpagan/LodestoneRSS>.

Change log - Dates are in Epoch time
-----------------------------------
1394739095

*	Created lodestone_rss.php file and included XIVPads-LodestoneAPI <https://github.com/viion/XIVPads-LodestoneAPI>
*	Updated README to explain how to host locally.

1394237093

*	Fixed spelling errors and removed excess white space

1394236566

*	Initial creation and upload of this WordPress plug-in.