<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Dinosaur Remix</title>

    <link rel="stylesheet" title="Default Style" href="<?= $assets->getUrl('dino.css') ?>" type="text/css" />
</head>
<body>
<div id="content">
    <h1 class="pageTitle">Dinosaur Remix</h1>

    <noscript>
        <div class="nojs-notice">
            <span style="color: black; background-color: #ffffaf;">Psst! This
                page is way more fun with JavaScript enabled.</span>
        </div>
    </noscript>

    <script>
        var dr = dr || {};
        dr.initialComic = <?= json_encode($jsBootstrap) ?>;
    </script>

    <div class="comic-wrapper">
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

<script defer type="text/javascript" src="<?= $assets->getUrl('dino.js') ?>"></script>

</body>
</html>
