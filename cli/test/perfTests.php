<?php
/* 
 * Test performance of some of the dino remix script functions.
 *
 * Copyright 2008-2017 Adam Goforth
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

define('ROOT_DIR', dirname(dirname(__DIR__)));
define('FILELISTS_DIR', ROOT_DIR . '/filelists');
define('PATHS_FILE', __DIR__ . '/serializedTLPaths.txt');

require_once(ROOT_DIR . '/utils.php');

$numRuns = 1100;

$starttime = microtime_float();
for ($i = 0; $i < $numRuns; $i++) {
	$image = getRandomImageForPos("tl");
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

unlink(PATHS_FILE);

function storeTLImagePathsToDisk() {
	$allfiles = removeDots(scandir(ROOT_DIR . "/public/panels/topleft/"));
	$serializedPaths = serialize($allfiles);
	$fp = fopen(PATHS_FILE, "w");
	fwrite($fp, $serializedPaths);
	fclose($fp);
}

function getRandomImageFromStore() {
	$serializedPaths = file_get_contents(PATHS_FILE);
	$allPaths = unserialize($serializedPaths);
	return getRandomString($allPaths);
}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
	//return $sec . substr($usec, 1);
}

