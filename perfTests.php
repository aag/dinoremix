<?php
/* Test performance of some of the dino remix script functions.
 */

include("utils.php");

$numRuns = 1100;

$starttime = microtime_float();
for ($i = 0; $i < $numRuns; $i++) {
	$image = getRandomImageForPos("panels/", "tl");
}
$endtime = microtime_float();
print $numRuns . " x getRandomImageForPos took " . ($endtime - $starttime) . " sec.\n";

storeTLImagePathsToDisk();

$starttime = microtime_float();
for ($i = 0; $i < $numRuns; $i++){
	$image = getRandomImageFromStore();
}
$endtime = microtime_float();
print $numRuns . " x getRandomImageFromStore took " . ($endtime - $starttime) . " sec.\n";

function storeTLImagePathsToDisk() {
	$allfiles = removeDots(scandir("panels/topleft/"));
	$serializedPaths = serialize($allfiles);
	$fp = fopen("serializedTLPaths.txt", "w");
	fwrite($fp, $serializedPaths);
	fclose($fp);
}

function getRandomImageFromStore() {
	$serializedPaths = file_get_contents("serializedTLPaths.txt");
	$allPaths = unserialize($serializedPaths);
	return getRandomString($allPaths);
}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
	//return $sec . substr($usec, 1);
}

?>
