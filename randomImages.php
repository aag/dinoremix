<?php
// Returns a list of URLs to random panel images
// The "pos" GET or POST variable specifies which positions
// the images should be in.  It is a list of two-letter
// position abbreviations, separated by dashes, "-".

if (!isset($_REQUEST["pos"])) {
	die;
}

include("utils.php");

$panelsDir = "panels/";
$posList = split("-", $_REQUEST["pos"]);
$imgDescList = array();

foreach ($posList as $pos) {
	$posdir = posAbbrToFull($pos);
	if ($posdir != "") {
		$imgFileName = getRandomImageForPos($panelsDir, $pos);
		$imgDesc = array("pos" => $pos, "file" => $imgFileName);
		$imgDescList[] = $imgDesc;
	}
}
print json_encode($imgDescList);
?>
