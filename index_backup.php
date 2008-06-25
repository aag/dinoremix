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

$comicsfiles = removeDots(scandir("comics"));
$numComics = sizeof($comicsfiles);
$numPerms = number_format(pow($numComics, 6));

$lockClasses = array();

if (isset($_GET['tl']) && is_numeric($_GET['tl'])) {
	$tlfilename = "comic2-" . $_GET['tl'] . "-topleft.png";
	$lockClasses["tl"] = "closedLock";
} else {
	$tlfiles = removeDots(scandir($panelsDir . "topleft"));
	$tlfilename = getRandomString($tlfiles);
	$lockClasses["tl"] = "openLock";
}

if (isset($_GET['tm']) && is_numeric($_GET['tm'])) {
	$tmfilename = "comic2-" . $_GET['tm'] . "-topmiddle.png";
	$lockClasses["tm"] = "closedLock";
} else {
	$tmfiles = removeDots(scandir($panelsDir . "topmiddle"));
	$tmfilename = getRandomString($tmfiles);
	$lockClasses["tm"] = "openLock";
}

if (isset($_GET['tr']) && is_numeric($_GET['tr'])) {
	$trfilename = "comic2-" . $_GET['tr'] . "-topright.png";
	$lockClasses["tr"] = "closedLock";
} else {
	$trfiles = removeDots(scandir($panelsDir . "topright"));
	$trfilename = getRandomString($trfiles);
	$lockClasses["tr"] = "openLock";
}

if (isset($_GET['bl']) && is_numeric($_GET['bl'])) {
	$blfilename = "comic2-" . $_GET['bl'] . "-bottomleft.png";
	$lockClasses["bl"] = "closedLock";
} else {
	$blfiles = removeDots(scandir($panelsDir . "bottomleft"));
	$blfilename = getRandomString($blfiles);
	$lockClasses["bl"] = "openLock";
}

if (isset($_GET['bm']) && is_numeric($_GET['bm'])) {
	$bmfilename = "comic2-" . $_GET['bm'] . "-bottommiddle.png";
	$lockClasses["bm"] = "closedLock";
} else {
	$bmfiles = removeDots(scandir($panelsDir . "bottommiddle"));
	$bmfilename = getRandomString($bmfiles);
	$lockClasses["bm"] = "openLock";
}

if (isset($_GET['br']) && is_numeric($_GET['br'])) {
	$brfilename = "comic2-" . $_GET['br'] . "-bottomright.png";
	$lockClasses["br"] = "closedLock";
} else {
	$brfiles = removeDots(scandir($panelsDir . "bottomright"));
	$brfilename = getRandomString($brfiles);
	$lockClasses["br"] = "openLock";
}



include("pagetemplate.php");
?>

