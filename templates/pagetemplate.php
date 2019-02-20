<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Dinosaur Remix</title>

    <link rel="stylesheet" title="Default Style" href="<?= $assets->getUrl('dino.css') ?>" type="text/css" />

    <script>
        var dr = dr || {};
        dr.initialComic = <?= json_encode($jsBootstrap['initialComic']) ?>;
        dr.nextPanels = <?= json_encode($jsBootstrap['nextPanels']) ?>;
    </script>
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

    <section class="Explanation">
        <header class="Explanation__header">What is this?</header>
        <div class="Explanation__content">
            <p>This page is a toy to play with
                <a href="http://qwantz.com/">Dinosaur Comics</a>.</p>
            <p>Dinosaur Comics is a web comic created by Ryan North. The unique
                thing about it is that the pictures are the same (nearly) every
                day and only the words change. This means that if you combine
                panels from multiple days, the comic will still look right.</p>
            <p>That's what this page lets you do. You can randomly mix together
                panels from multiple comics, keeping the ones you like until
                you arrive at a complete comic, and then save or share the link
                to it.</p>
            <p>There are a lot of possible comics you can make. Dinosaur Remix
                currently contains <?= $numComics ?> comics, making for
                <?= $numPerms ?> possible remixes.</p>
        </div>
    </section>

    <aside>
    </aside>

    <footer>
        <p class="CodeLink">The code for this page is available here:
            <a class="CodeLink__link" href="http://github.com/aag/dinoremix/">
                http://github.com/aag/dinoremix/</a>
        </p>
    </footer>
</div>

<div class="SkyBackground"></div>

<script defer type="text/javascript" src="<?= $assets->getUrl('dino.js') ?>"></script>

</body>
</html>
