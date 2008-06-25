<?php
// Returns a URL to a random image
// The "pos" GET or POST variable specifies which position
// the image should be in.

if (!isset($_REQUEST["pos"])) {
	die;
}

include("utils.php");

$panelsDir = "panels/";
$pos = $_REQUEST["pos"];
$posdir = posAbbrToFull($pos);
if ($posdir != "") {
	$imgFileName = getRandomImageForPos($panelsDir, $pos);
	$imageDesc = array("pos" => $pos, "file" => $imgFileName);
	print json_encode($imageDesc);
}

?>
