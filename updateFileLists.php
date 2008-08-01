<?php
/* A PHP script to get the list of files in the panels directories,
 * put them in arrays, and serialize them to disk.
 * When other scripts need a file list, they will unserialize these
 * files, instead of doing a directory listing.  This gives a 3-4x
 * speedup.
 *
 * Written by: Adam Goforth
 * Started on: 2008.07.31
 */

require_once("utils.php");

function storeImagePathsToDisk($panelsDir, $outputDir, $pos) {
    $allfiles = removeDots(scandir($panelsDir . $pos));

    $serializedPaths = serialize($allfiles);
    $fp = fopen($outputDir . $pos . "Paths.txt", "w");
    fwrite($fp, $serializedPaths);
    fclose($fp);
}

$scriptDir = dirname(__FILE__);
$panelsDir = $scriptDir . "/panels/";
$outputDir = $scriptDir . "/filelists/";

print("Rewriting files in $outputDir\n");
storeImagePathsToDisk($panelsDir, $outputDir, "topleft");
storeImagePathsToDisk($panelsDir, $outputDir, "topmiddle");
storeImagePathsToDisk($panelsDir, $outputDir, "topright");
storeImagePathsToDisk($panelsDir, $outputDir, "bottomleft");
storeImagePathsToDisk($panelsDir, $outputDir, "bottommiddle");
storeImagePathsToDisk($panelsDir, $outputDir, "bottomright");

?>
