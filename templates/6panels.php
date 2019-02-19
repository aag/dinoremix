<div class="ButtonsRow clearfix">
    <a href="<?= $reloadUri ?>">
        <span class="ReloadButton ReloadButton--unpressed">
            <img src="images/reload.png" alt="" />
            <span id="reloadText">Reload the unlocked panels</span>
        </span>
    </a>

    <div class="NumPanelsWrapper">
        Number of panels: <span class="NumPanelsSwitcher">
            <a href="<?= $permaLink2Panels ?>" class="NumPanelsButton NumPanelsButton--unchosen">2</a>
            <a href="<?= $permaLink3Panels ?>" class="NumPanelsButton NumPanelsButton--unchosen">3</a>
            <a href="<?= $permaLink6Panels ?>" class="NumPanelsButton NumPanelsButton--chosen">6</a>
        </span>
    </div>
</div>

<div class="clearfix">
    <a class="Lock">
        <div class="Lock__button Lock__button--tl <?=$lockClasses["tl"] ?>">
            <img src="images/lock_open.png" alt="Click to lock" />
        </div>
    </a>
    <a class="Lock">
        <div class="Lock__button Lock__button--tm <?=$lockClasses["tm"] ?>">
            <img src="images/lock_open.png" alt="Click to lock" />
        </div>
    </a>
    <a class="Lock">
        <div class="Lock__button Lock__button--tr <?=$lockClasses["tr"] ?>">
            <img src="images/lock_open.png" alt="Click to lock" />
        </div>
    </a>
</div>

<div class="PanelsContainer">
    <img class="Panel Panel--tl" src="panels/topleft/<?=$imgFileNames["tl"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />
    <img class="Panel Panel--tm" src="panels/topmiddle/<?=$imgFileNames["tm"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />
    <img class="Panel Panel--tr" src="panels/topright/<?=$imgFileNames["tr"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />
    <img class="Panel Panel--bl" src="panels/bottomleft/<?=$imgFileNames["bl"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />
    <img class="Panel Panel--bm" src="panels/bottommiddle/<?=$imgFileNames["bm"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />
    <img class="Panel Panel--br" src="panels/bottomright/<?=$imgFileNames["br"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />

    <div class="CreditsRow">
        <img src="panels/credits_left.png" alt="" class="lCredit" />
        <img src="panels/credits_right.png" alt="" class="rCredit" />
    </div>

    <a id="setAltTextLink" href="./" hidden><img src="images/edit_alt_text.png" alt="" /></a>
    <div id="altTextInputControls" hidden>
        <form id="altTextForm" action="./">
            <input id="altTextInput" name="altText" class="" type="text" size="60" value="<?=$outAltText?>" />
        </form>
        <a href="./" id="altTextOKButton"><img src="images/ok.png" class="altTextInputButton" alt="" /></a> <a href="./" id="altTextCancelButton"><img src="images/cancel.png" class="altTextInputButton" alt="" /></a>
    </div>
</div>

<div>
    <a class="Lock">
        <div class="Lock__button Lock__button--bl <?=$lockClasses["bl"] ?>">
            <img src="images/lock_open.png" alt="Click to lock" />
        </div>
    </a>
    <a class="Lock">
        <div class="Lock__button Lock__button--bm <?=$lockClasses["bm"] ?>">
            <img src="images/lock_open.png" alt="Click to lock" />
        </div>
    </a>
    <a class="Lock">
        <div class="Lock__button Lock__button--br <?=$lockClasses["br"] ?>">
            <img src="images/lock_open.png" alt="Click to lock" />
        </div>
    </a>
</div>

