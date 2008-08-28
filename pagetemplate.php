<?php
/*
 * The template for the Dinosaur Remix HTML page.
 *
 * Written by: Adam Goforth
 * Started on: 2008.04.18
 */

// Must be included in the main page
if (!$IN_DINOREMIX){
	exit();
}

// Can't put this outside of the php tags because of the <? at
// the beginning.
echo('<?xml version="1.0" encoding="iso-8859-1"?>');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

    <title>Dinosaur Remix</title>

	<link rel="stylesheet" title="Default Style" href="reset.css" type="text/css" />
	<link rel="stylesheet" title="Default Style" href="dino.css" type="text/css" />
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="dino.js"></script>
</head>
<body>
<div id="content">
	<h1>Dinosaur Remix!</h1>
		<ol>
			<li>Take a bunch of <a href="http://qwantz.com">Dinosaur Comics</a>.</li>
			<li>Cut out all of the panels.</li>
			<li>Randomly pick panels from different comics and hook them up to make a new, <i>remixed</i> comic!</li>
			<li>Reload the page to your little heart's content.</li>
		</ol>
	<br />
	<br />
	<br />
	<?php
	if ($_GET['numpanels'] == "2") {
		include("2panels.php");
	} elseif ($_GET['numpanels'] == "6") {
		include("6panels.php");
	} else {
		include("3panels.php");
	}
	?>
	<div>
		<br />
		<br />
		<br />
		<br />
		<div id="permaLinkHolder">
			Link to this remix: <a id="permaLink" href="<?=$permaLink ?>">Rawr!</a>
		</div>
		<br />
		<br />
		<br />
		<br />
		Currently remixing <?=$numComics ?> comics, making for <?=$numPerms ?> possible remixes.
		<br />
		<br />
	</div>
</div>
</body>
</html>
