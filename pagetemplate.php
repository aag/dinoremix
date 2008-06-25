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

	<link rel="stylesheet" title="Default Style" href="dino.css" type="text/css" />
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="dino.js"></script>
</head>
<body>
<h1>Dinosaur Remix!</h1>
	<ol>
		<li>Take a bunch of <a href="http://qwantz.com">Dinosaur Comics</a>.</li>
		<li>Cut out all of the panels.</li>
		<li>Randomly pick panels from different comics and hook them up to make a new, <i>remixed</i> comic!</li>
		<li>Reload the page to your little heart's content.</li>
	</ol>
<p>
<br />
<a id="reloadLink" href="./">Reload the unlocked panels</a>
</p>
<div>
<span id="tlLock" class="<?=$lockClasses["tl"] ?>Lock" style="width: 244px; text-align: center;"><img src="" alt="Click to lock" /></span>
	<span id="tmLock" class="<?=$lockClasses["tm"] ?>Lock" style="width: 129px; text-align: center;"><img src="" alt="Click to lock" /></span>
	<span id="trLock" class="<?=$lockClasses["tr"] ?>Lock" style="width: 362px; text-align: center;"><img src="" alt="Click to lock" /></span>
</div>
<?php
include("6panels.php");
?>
<div>
	<span id="blLock" class="<?=$lockClasses["bl"] ?>Lock" style="width: 194px; text-align: center;"><img src="lock_open.png" alt="Click to lock" /></span>
	<span id="bmLock" class="<?=$lockClasses["bm"] ?>Lock" style="width: 298px; text-align: center;"><img src="lock_open.png" alt="Click to lock" /></span>
	<span id="brLock" class="<?=$lockClasses["br"] ?>Lock" style="width: 243px; text-align: center;"><img src="lock_open.png" alt="Click to lock" /></span>
</div>
<p>
<br />
<br />
Currently remixing <?=$numComics ?> comics, making for <?=$numPerms ?> possible remixes.
</p>
</body>
</html>
