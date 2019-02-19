<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Dinosaur Remix</title>

    <link rel="stylesheet" title="Default Style" href="<?= $assets->getUrl('dino.css') ?>" type="text/css" />
</head>
<body>

<div id="Content">
    <header class="Header">Dinosaur Remix</header>

    <noscript>
        <div class="nojs-notice">
            <span style="color: black; background-color: #ffffaf;">Psst! This
                page is way more fun with JavaScript enabled.</span>
        </div>
    </noscript>

    <script>
        var dr = dr || {};
        dr.initialComic = <?= json_encode($jsBootstrap['initialComic']) ?>;
        dr.nextPanels = <?= json_encode($jsBootstrap['nextPanels']) ?>;
    </script>

    <main class="ComicWrapper">
        <div class="Comic Comic--<?= $numPanels ?>_panels">
            <?php
            if ($numPanels === 2) {
                include("2panels.php");
            } elseif ($numPanels === 6) {
                include("6panels.php");
            } else {
                include("3panels.php");
            }
            ?>

            <a class="Permalink" href="<?= htmlspecialchars($permaLink) ?>">
                Permalink to this remix
            </a>
        </div>
    </main>

    <div class="ComicCount">
        Currently remixing <?= $numComics ?> comics, making for
        <?= $numPerms ?> possible remixes.
    </div>

    <p class="CodeLink">The code for this page is available here:
        <a class="CodeLink__link" href="http://github.com/aag/dinoremix/">
            http://github.com/aag/dinoremix/</a>
    </p>
</div>

<script defer type="text/javascript" src="<?= $assets->getUrl('dino.js') ?>"></script>

</body>
</html>
