<?php
// 
// Utility functions for dino remix.
//

function removeDots($filelist){
	for ($i = 0; $i < sizeof($filelist); $i++){
		if ($filelist[$i] == "." || $filelist[$i] == ".."){
			unset($filelist[$i]);
		}
	}
	$filelist = array_values($filelist);
	return $filelist;
}

function getRandomImageForPos($panelsDir, $pos) {
	$fullPosName = posAbbrToFull($pos);
	$filename = "";
	$fileListDir = "filelists/";

	if ($fullPosName != "") {
		$serializedPaths = file_get_contents($fileListDir . $fullPosName . "Paths.txt");
		$allFiles = unserialize($serializedPaths);
		$filename = getRandomString($allFiles);
	}

	return $filename;
}

function getComicNumFromImageURL($url) {
	// Match the unique part of the filename: what's between
	// "comic2-" and "-{position}"
	preg_match_all("/comic2-(.*)-\w+.*\.(png|jpg|gif)/", $url, $out, PREG_PATTERN_ORDER);
	return $out[1][0];
}

function getRandomString($strings){
	$stringIdx = mt_rand(0, sizeof($strings) - 1);
	return $strings[$stringIdx];
}

function posAbbrToFull($abbr) {
	$fullName = "";

	$firstChar = substr($abbr, 0, 1);
	if ($firstChar == "t") {
		$fullName = "top";
	} else if ($firstChar == "b") {
		$fullName = "bottom";
	}

	$secondChar = substr($abbr, 1, 1);
	if ($secondChar == "l") {
		$fullName .= "left";
	} else if ($secondChar == "m") {
		$fullName .= "middle";
	} else if ($secondChar == "r") {
		$fullName .= "right";
	}

	return $fullName;
}
?>
