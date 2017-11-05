<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Dinosaur Remix</title>

    <link rel="stylesheet" title="Default Style" href="<?= $assets->getUrl('reset.css') ?>" type="text/css" />
    <link rel="stylesheet" title="Default Style" href="<?= $assets->getUrl('dino.css') ?>" type="text/css" />
</head>
<body>
<div id="content">
    <h1 class="pageTitle">Dinosaur Remix!</h1>
    <div class="description">
        <ol>
            <li>Take a bunch of <a href="http://qwantz.com">Dinosaur Comics</a>.</li>
            <li>Cut out all of the panels.</li>
            <li>Randomly pick panels from different comics and hook them up.</li>
            <li>Lock the panels you like and reload the ones you don't.</li>
            <li>Add a funny alt text.</li>
            <li>Send links of the good ones to your friends and enemies.</li>
        </ol>
    </div>

    <noscript>
        <div class="nojs-notice">
            <span style="color: black; background-color: #ffffaf;">Psst! This
                page is way more fun with JavaScript enabled.</span>
        </div>
    </noscript>

    <div class="comic">
        <?php
        if ($numPanels === 2) {
            include("2panels.php");
        } elseif ($numPanels === 6) {
            include("6panels.php");
        } else {
            include("3panels.php");
        }
        ?>

        <div id="permaLinkHolder">
            <a id="permaLink" style="text-decoration: none" href="<?= $permaLink ?>">
                <img src="images/link.png" alt="Link" />
                <span style="text-decoration: underline">Permalink to this remix</span>
            </a>
        </div>
    </div>

    <div class="comicCount">
        Currently remixing <?= $numComics ?> comics, making for
        <?= $numPerms ?> possible remixes.
    </div>
</div>

<div class="credits">
    <p style="font-size: small; color: gray">The code for this page is
        available here:
        <a href="http://github.com/aag/dinoremix/" style="color: gray;">
            http://github.com/aag/dinoremix/</a>
    </p>
</div>

<script defer type="text/javascript" src="<?= $assets->getUrl('jquery.min.js') ?>"></script>
<script defer type="text/javascript" src="<?= $assets->getUrl('dino.js') ?>"></script>

</body>
</html>
