<?php
include_once('api.php');

$Output = 'lodestone_rss.json';

// New Lodestone
$API = new LodestoneAPI();
$Options =
[
	'topics'	=>	true,
];

// Get Lodestone object
$Lodestone = $API->Lodestone($Options);

// Json
$JSON = json_encode($Lodestone->getTopics());

// Save to file
file_put_contents($Output, $JSON);
?>
