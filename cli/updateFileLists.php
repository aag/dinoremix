<?php
/* A PHP script to get the list of files in the panels directories,
 * put them in arrays, and serialize them to disk.
 * When other scripts need a file list, they will unserialize these
 * files, instead of doing a directory listing.  This gives a 3-4x
 * speedup.
 *
 * Copyright 2008, 2009 Adam Goforth
 * Started on: 2008.07.31
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

require_once("../utils.php");

function storeImagePathsToDisk($panelsDir, $outputDir, $pos) {
    $allfiles = removeDots(scandir($panelsDir . $pos));

    $serializedPaths = serialize($allfiles);
    $fp = fopen($outputDir . $pos . "Paths.txt", "w");
    fwrite($fp, $serializedPaths);
    fclose($fp);
}

$scriptDir = dirname(__FILE__);
$panelsDir = $scriptDir . "/../public/panels/";
$outputDir = $scriptDir . "/../filelists/";

print("Rewriting files in $outputDir\n");
storeImagePathsToDisk($panelsDir, $outputDir, "topleft");
storeImagePathsToDisk($panelsDir, $outputDir, "topmiddle");
storeImagePathsToDisk($panelsDir, $outputDir, "topright");
storeImagePathsToDisk($panelsDir, $outputDir, "bottomleft");
storeImagePathsToDisk($panelsDir, $outputDir, "bottommiddle");
storeImagePathsToDisk($panelsDir, $outputDir, "bottomright");

