    <div id="linksBar" style="width: 618px;">
        <a id="reloadLink" href="/"><span id="reloadButton" class="unpressedReloadButton"><img src="images/reload.png" alt="" />&nbsp;<span id="reloadText">Reload the panels</span></span></a>

    <div id="numPanelsHolder">Number of panels: <span id="panelNumSwitcher"><a id="twoPanelsLink" href="./?numpanels=2" class="panelNumLink unchosenPanelNumLink">2</a> <a id="threePanelsLink" href="./?numpanels=3" class="panelNumLink chosenPanelNumLink">3</a> <a id="sixPanelsLink" href="./?numpanels=6" class="panelNumLink unchosenPanelNumLink">6</a></span></div>
<br />
<br />
<br />
<br />
</div>

<div>
    <span id="tlLock" class="<?=$lockClasses["tl"] ?>Lock twoPanelLock threePanelLock lockSpan startingLock" style="width: 244px;"><img src="images/lock_open.png" alt="Click to lock" /></span>
    <span id="tmLock" class="<?=$lockClasses["tm"] ?>Lock threePanelLock lockSpan startingLock" style="width: 129px;"><img src="images/lock_open.png" alt="Click to lock" /></span>
    <span id="brLock" class="<?=$lockClasses["br"] ?>Lock lockSpan twoPanelLock threePanelLock startingLock" style="width: 243px;"><img src="images/lock_open.png" alt="Click to lock" /></span>
    <span id="trLock" class="<?=$lockClasses["tr"] ?>Lock lockSpan hidden notShowing" style="width: 362px;"><img src="images/lock_open.png" alt="Click to lock" /></span>
</div>
<div><br class="clearBR" /></div>

<div id="panelContainer" style="width: 618px">
    <img id="tlImage" class="<?=$lockClasses["tl"] ?>Image panelImage twoPanelImage threePanelImage" src="panels/topleft/<?=$imgFileNames["tl"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" /><img id="tmImage" class="<?=$lockClasses["tm"] ?>Image panelImage threePanelImage" src="panels/topmiddle/<?=$imgFileNames["tm"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" /><img id="trImage" class="<?=$lockClasses["tr"] ?>Image panelImage hidden notShowing" src="panels/topright/<?=$imgFileNames["tr"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />
    <br id="rowDivider" class="hidden clearBR" />
    <img id="blImage" class="<?=$lockClasses["bl"] ?>Image panelImage hidden notShowing" src="panels/bottomleft/<?=$imgFileNames["bl"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" /><img id="bmImage" class="<?=$lockClasses["bm"] ?>Image panelImage hidden notShowing" src="panels/bottommiddle/<?=$imgFileNames["bm"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" /><img id="brImage" class="<?=$lockClasses["br"] ?>Image panelImage twoPanelImage threePanelImage shiftDownOnePx" src="panels/bottomright/<?=$imgFileNames["br"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />
    <br class="clearBR" />
    <img id="lCredit" src="panels/credits_left.png" alt="" class="creditsImage twoPanelImage threePanelImage" /><img id="TwoPanelCreditsSpacer" class="creditsSpacer twoPanelImage hidden notShowing" src="panels/2panel_credits_spacer.gif" alt="" /><img id="ThreePanelCreditsSpacer" class="creditsSpacer threePanelImage" src="panels/3panel_credits_spacer.gif" alt="" /><img id="mCredit" src="panels/credits_middle.png" alt="" class="creditsImage hidden notShowing" /><img id="rCredit" src="panels/credits_right.png" alt="" class="creditsImage twoPanelImage threePanelImage" />

    <a id="setAltTextLink" class="hidden" href="./"><img src="images/edit_alt_text.png" alt="" /></a>
    <div id="altTextInputControls" class="hidden">
        <form id="altTextForm" action="./">
            <input id="altTextInput" name="altText" class="" type="text" size="60" value="<?=$outAltText?>" />
        </form><br />
        <a href="./" id="altTextOKButton"><img src="images/ok.png" class="altTextInputButton" alt="" /></a> <a href="./" id="altTextCancelButton"><img src="images/cancel.png" class="altTextInputButton" alt="" /></a>
    </div>
</div>

<div><br class="clearBR" /></div>
<div>
    <span id="blLock" class="<?=$lockClasses["bl"] ?>Lock lockSpan hidden" style="width: 194px;"><img src="images/lock_open.png" alt="Click to lock" /></span>
    <span id="bmLock" class="<?=$lockClasses["bm"] ?>Lock lockSpan hidden" style="width: 298px;"><img src="images/lock_open.png" alt="Click to lock" /></span>
</div>

