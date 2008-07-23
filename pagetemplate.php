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
<br />
<br />
Number of panels: <a id="2panelsLink" href="./?numpanels=2">2</a> <a id="3panelsLink" href="./?numpanels=3">3</a> <a id="6panelsLink" href="./?numpanels=6">6</a>
<br />
<br />
<br />
</p>
<div>
<span id="tlLock" class="<?=$lockClasses["tl"] ?>Lock 2panelLock 3panelLock lockSpan" style="width: 244px; text-align: center;"><img src="" alt="Click to lock" /></span>
	<span id="tmLock" class="<?=$lockClasses["tm"] ?>Lock 3panelLock lockSpan" style="width: 129px; text-align: center;"><img src="" alt="Click to lock" /></span>
	<span id="trLock" class="<?=$lockClasses["tr"] ?>Lock lockSpan" style="width: 362px; text-align: center;"><img src="" alt="Click to lock" /></span>
</div>
<br style="clear: both" />
<?php
include("6panels.php");
?>
<br style="clear: both" />
<div>
	<span id="blLock" class="<?=$lockClasses["bl"] ?>Lock lockSpan" style="width: 194px; text-align: center;"><img src="lock_open.png" alt="Click to lock" /></span>
	<span id="bmLock" class="<?=$lockClasses["bm"] ?>Lock lockSpan" style="width: 298px; text-align: center;"><img src="lock_open.png" alt="Click to lock" /></span>
	<span id="brLock" class="<?=$lockClasses["br"] ?>Lock lockSpan 2panelLock 3panelLock" style="width: 243px; text-align: center;"><img src="lock_open.png" alt="Click to lock" /></span>
</div>
<br />
<br />
<p>
<img id="2panelCreditsSpacer" class="creditsImage 2panelImage" src="panels/2panel_credits_spacer.gif" />
<img id="3panelCreditsSpacer" class="creditsImage 3panelImage" src="panels/3panel_credits_spacer.gif" />
<br />
<br />
Currently remixing <?=$numComics ?> comics, making for <?=$numPerms ?> possible remixes.
</p>
<br />
<br />

</body>
</html>
