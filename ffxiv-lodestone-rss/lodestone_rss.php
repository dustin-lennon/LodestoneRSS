<?php
#Check if exec by Command line (this is where path is sent from sh file)
if (isset($argv[1]) && $argv[1])
{
	$path = $argv[1];
	include $path .'api.php';
	$Output = $path .'lodestone_rss.json';
}

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
