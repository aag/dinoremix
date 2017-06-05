<?php
/*
 * The template for the Dinosaur Remix HTML page.
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

	<link rel="stylesheet" title="Default Style" href="assets/reset.css" type="text/css" />
	<link rel="stylesheet" title="Default Style" href="assets/dino.css" type="text/css" />
	<script type="text/javascript" src="assets/jquery.min.js"></script>
	<script type="text/javascript" src="assets/dino.js"></script>
</head>
<body>
<div id="content">
	<h1>Dinosaur Remix!</h1>
		<ol>
			<li>Take a bunch of <a href="http://qwantz.com">Dinosaur Comics</a>.</li>
			<li>Cut out all of the panels.</li>
			<li>Randomly pick panels from different comics and hook them up.</li>
			<li>Lock the panels you like and reload the ones you don't.</li>
			<li>Add a funny alt text.</li>
			<li>Send links of the good ones to your friends and enemies.</li>
		</ol>
	<br />
	<noscript>
		<div><span style="color: black; background-color: #ffffaf;">Psst!  This page is way more fun with JavaScript enabled.</span></div>
		<br />
	</noscript>
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
		<div id="permaLinkHolder">
			<a id="permaLink" style="text-decoration: none" href="<?=$permaLink ?>"><img src="images/link.png" alt="Link" /> <span style="text-decoration: underline">Permalink to this remix</span></a>
		</div>
		<br />
		<br />
		<br />
		<br />
		Currently remixing <?=$numComics ?> comics, making for <?=$numPerms ?> possible remixes.
		<br />
		<br />
		<br />
		<br />
		<br />
		<p style="font-size: small; color: gray">The code for this page is available here: <a href="http://github.com/aag/dinoremix/" style="color: gray;">http://github.com/aag/dinoremix/</a></p>
	</div>
</div>
</body>
</html>
