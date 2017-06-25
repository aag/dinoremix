<?php
/*
 * This script will put together panels from a bunch
 * of Dinosaur Comics and make a new one!
 *
 * Copyright 2008-2017 Adam Goforth
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

define('ROOT_DIR', dirname(__DIR__));
define('FILELISTS_DIR', ROOT_DIR . '/data/filelists');
define('TEMPLATES_DIR', ROOT_DIR . '/templates');

require ROOT_DIR . '/vendor/autoload.php';

use App\Lib\Util;
use GuzzleHttp\Psr7\ServerRequest;

$request = ServerRequest::fromGlobals();
$queryParams = $request->getQueryParams();

// Get permutation information
$comicsfiles = Util::removeDots(scandir("panels/topleft"));
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
	$fullName = Util::posAbbrToFull($pos);
	if (isset($queryParams[$pos])) {
		// Panel is locked
		$imgFileNames[$pos] = "comic2-" . $queryParams[$pos] . "-" . $fullName . ".png";
		$lockClasses[$pos] = "locked";
		$posNums[$pos] = $queryParams[$pos];
	} else {
		// Panel is unlocked
		$imgFileNames[$pos] = Util::getRandomImageForPos($pos);
		$lockClasses[$pos] = "unlocked";
		$posNums[$pos] = Util::getComicNumFromImageURL($imgFileNames[$pos]);
	}
}

// Get the alt text for the panels
$outAltText = "";
if (isset($queryParams['alt'])) {
	$altText = stripslashes($queryParams['alt']);
	$linkAltText = rawurlencode($altText);
	$outAltText = htmlspecialchars($altText);
}

// Just take the current URL as the permalink, even if it's invalid
$permaLink = (string) $request->getUriFromGlobals();

include(TEMPLATES_DIR . "/pagetemplate.php");

