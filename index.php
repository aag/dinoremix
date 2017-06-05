<?php
/*
 * This script will put together panels from a bunch
 * of Dinosaur Comics and make a new one!
 *
 * Copyright 2008, 2009 Adam Goforth
 * Started on: 2008.04.18
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

$IN_DINOREMIX = true;

require_once("utils.php");

$panelsDir = "panels/";

// Get permutation information
$comicsfiles = removeDots(scandir("panels/topleft"));
$numComics = sizeof($comicsfiles);
$numPerms = number_format(
        pow($numComics, 6) +
        pow($numComics, 3) +
        pow($numComics, 2)
    );

$lockClasses = array();
$imgFileNames = array();
$posAbbrs = array(0 => "tl", "tm", "tr", "bl", "bm", "br");
$posNums = array();
$altText = "";

// Check each panel to see if it's locked
foreach ($posAbbrs as $key => $pos) {
	$fullName = posAbbrToFull($pos);
	if (isset($_GET[$pos])) {
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

// Get the alt text for the panels
$outAltText = "";
if (isset($_GET['alt'])) {
	$altText = stripslashes($_GET['alt']);
	$linkAltText = rawurlencode($altText);
	$outAltText = htmlspecialchars($altText);
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

$permaLink = htmlspecialchars($permaLink);

if ($altText != "") {
	$permaLink = $permaLink . "&alt=" . $linkAltText;
}

include("pagetemplate.php");
?>

