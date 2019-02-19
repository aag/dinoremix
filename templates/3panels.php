<div class="ButtonsRow">
    <a href="<?= htmlspecialchars($reloadUri) ?>"
        class="Button Button--with-icon ReloadButton">Reload the unlocked panels</a>

    <div class="NumPanelsWrapper">
        Number of panels: <span class="NumPanelsSwitcher">
            <a href="<?= htmlspecialchars($permaLink2Panels) ?>" class="Button">2</a>
            <a href="<?= htmlspecialchars($permaLink3Panels) ?>" class="Button Button--pressed">3</a>
            <a href="<?= htmlspecialchars($permaLink6Panels) ?>" class="Button">6</a>
        </span>
    </div>
</div>

<div class="LocksRow">
    <a class="Lock Lock--tl <?=$lockClasses["tl"] ?>">
    </a><a class="Lock Lock--tm <?=$lockClasses["tm"] ?>">
    </a><a class="Lock Lock--br <?=$lockClasses["br"] ?>">
    </a>
</div>

<div class="PanelsContainer">
    <img class="Panel Panel--tl" src="panels/topleft/<?=$imgFileNames["tl"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />
    <img class="Panel Panel--tm" src="panels/topmiddle/<?=$imgFileNames["tm"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />
    <img class="Panel Panel--br" src="panels/bottomright/<?=$imgFileNames["br"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />

    <div class="CreditsRow">
        <img src="panels/credits_left.png" alt="(C) 2003-2018 Ryan North" />
        <img src="panels/credits_right.png" alt="www.qwantz.com" />
    </div>

    <a id="setAltTextLink" href="./" hidden><img src="images/edit_alt_text.png" alt="" /></a>
    <div id="altTextInputControls" hidden>
        <form id="altTextForm" action="./">
            <input id="altTextInput" name="altText" class="" type="text" size="60" value="<?=$outAltText?>" />
        </form><br />
        <a href="./" id="altTextOKButton"><img src="images/ok.png" class="altTextInputButton" alt="" /></a> <a href="./" id="altTextCancelButton"><img src="images/cancel.png" class="altTextInputButton" alt="" /></a>
    </div>
</div>

