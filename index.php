<?php
/*
 * This script will put together panels from a bunch
 * of Dinosaur Comics and make a new one!
 *
 * Written by: Adam Goforth
 * Started on: 2008.04.18
 */

$IN_DINOREMIX = true;

require_once("utils.php");

$panelsDir = "panels/";

// Get permutation information
$comicsfiles = removeDots(scandir("panels/topleft"));
$numComics = sizeof($comicsfiles);
$numPerms = number_format(pow($numComics, 6));

$lockClasses = array();
$imgFileNames = array();
$posAbbrs = array(0 => "tl", "tm", "tr", "bl", "bm", "br");
$posNums = array();

// Check each panel to see if it's locked
foreach ($posAbbrs as $key => $pos) {
	$fullName = posAbbrToFull($pos);
	if (isset($_GET[$pos]) && is_numeric($_GET[$pos])) {
		// Panel is locked
		$imgFileNames[$pos] = "comic2-" . $_GET[$pos] . "-" . $fullName . ".png";
		$lockClasses[$pos] = "locked";
		$posNums[$pos] = $_GET[$pos];
	} else {
		// Panel is unlocked
		$imgFileNames[$pos] = getRandomImageForPos($panelsDir, $pos);
		$lockClasses[$pos] = "unlocked";
		$posNums[$pos] = getComicNumFromImageURL($imgFileNames[$pos]);
	}
}

// Build the permalink
$currentURL = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
$permaLink = substr($currentURL, 0, strrpos($currentURL, "/") + 1) . "?";

foreach ($posAbbrs as $key => $pos) {
	$permaLink = $permaLink . "&" . $pos . "=" . $posNums[$pos];
}

if (isset($_GET['numpanels']) && is_numeric($_GET['numpanels'])) {
	$permaLink = $permaLink . "&numpanels=" . $_GET['numpanels'];
}

include("pagetemplate.php");
?>

