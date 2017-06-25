<?php
/*
 * Returns a list of URLs to random panel images
 * The "pos" POST variable specifies which positions
 * the images should be in.  It is a list of two-letter
 * position abbreviations, separated by dashes, "-".
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

require __DIR__ . '/../vendor/autoload.php';

define('ROOT_DIR', dirname(__DIR__));
define('FILELISTS_DIR', ROOT_DIR . '/data/filelists');

require_once(ROOT_DIR . "/utils.php");

use GuzzleHttp\Psr7\ServerRequest;

$request = ServerRequest::fromGlobals();
$postData = $request->getParsedBody();

if (!isset($postData["pos"])) {
	die;
}

$posList = explode("-", $postData["pos"]);
$imgDescList = array();

foreach ($posList as $pos) {
	$posdir = posAbbrToFull($pos);
	if ($posdir != "") {
		$imgFileName = getRandomImageForPos($pos);
		$imgDesc = array("pos" => $pos, "file" => $imgFileName);
		$imgDescList[] = $imgDesc;
	}
}
print json_encode($imgDescList);

