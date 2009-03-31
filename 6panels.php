	<div id="linksBar" style="width: 735px;">
		<a id="reloadLink" href="./?numpanels=<?=$_GET['numpanels'] ?>"><span id="reloadButton" class="unpressedReloadButton"><img src="reload.png" alt="" />&nbsp;<span id="reloadText">Reload the panels</span></span></a>

	<div id="numPanelsHolder">Number of panels: <span id="panelNumSwitcher"><a id="twoPanelsLink" href="./?numpanels=2" class="panelNumLink unchosenPanelNumLink">2</a> <a id="threePanelsLink" href="./?numpanels=3" class="panelNumLink unchosenPanelNumLink">3</a> <a id="sixPanelsLink" href="./?numpanels=6" class="panelNumLink chosenPanelNumLink">6</a></span></div>
<br />
<br />
<br />
<br />
</div>

<div>
	<span id="tlLock" class="<?=$lockClasses["tl"] ?>Lock 2panelLock 3panelLock lockSpan startingLock" style="width: 244px;"><img src="lock_open.png" alt="Click to lock" /></span>
	<span id="tmLock" class="<?=$lockClasses["tm"] ?>Lock 3panelLock lockSpan startingLock" style="width: 129px;"><img src="lock_open.png" alt="Click to lock" /></span>
	<span id="trLock" class="<?=$lockClasses["tr"] ?>Lock lockSpan startingLock" style="width: 362px;"><img src="lock_open.png" alt="Click to lock" /></span>
</div>
<div><br class="clearBR" /></div>

<div id="panelContainer" style="width: 735px">
	<img id="tlImage" class="<?=$lockClasses["tl"] ?>Image panelImage 2panelImage 3panelImage" src="panels/topleft/<?=$imgFileNames["tl"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" /><img id="tmImage" class="<?=$lockClasses["tm"] ?>Image panelImage 3panelImage" src="panels/topmiddle/<?=$imgFileNames["tm"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" /><img id="trImage" class="<?=$lockClasses["tr"] ?>Image panelImage" src="panels/topright/<?=$imgFileNames["tr"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />
	<br id="rowDivider" class="clearBR" />
	<img id="blImage" class="<?=$lockClasses["bl"] ?>Image panelImage" src="panels/bottomleft/<?=$imgFileNames["bl"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" /><img id="bmImage" class="<?=$lockClasses["bm"] ?>Image panelImage" src="panels/bottommiddle/<?=$imgFileNames["bm"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" /><img id="brImage" class="<?=$lockClasses["br"] ?>Image panelImage 2panelImage 3panelImage flushTop" src="panels/bottomright/<?=$imgFileNames["br"] ?>" alt="<?=$outAltText?>" title="<?=$outAltText?>" />
	<br  class="clearBR" />
	<img id="lCredit" src="panels/credits_left.png" alt="" class="creditsImage 2panelImage 3panelImage" /><img id="TwoPanelCreditsSpacer" class="creditsSpacer 2panelImage hidden" src="panels/2panel_credits_spacer.gif" alt="" /><img id="ThreePanelCreditsSpacer" class="creditsSpacer 3panelImage hidden" src="panels/3panel_credits_spacer.gif" alt="" /><img id="mCredit" src="panels/credits_middle.png" alt="" class="creditsImage" /><img id="rCredit" src="panels/credits_right.png" alt="" class="creditsImage 2panelImage 3panelImage" />
	<a id="setAltTextLink" class="hidden" href="./"><img src="edit_alt_text.png" alt="" /></a>
	<div id="altTextInputControls" class="hidden">
		<form id="altTextForm" action="./">
			<input id="altTextInput" name="altText" class="" type="text" size="60" />
		</form>
		<a href="./" id="altTextOKButton" class="altTextInputButton">OK</a> <a href="./" id="altTextCancelButton" class="altTextInputButton">Cancel</a>
	</div>
</div>

<div><br class="clearBR" /></div>
<div>
        <span id="blLock" class="<?=$lockClasses["bl"] ?>Lock lockSpan startingLock" style="width: 194px;"><img src="lock_open.png" alt="Click to lock" /></span>
        <span id="bmLock" class="<?=$lockClasses["bm"] ?>Lock lockSpan startingLock" style="width: 298px;"><img src="lock_open.png" alt="Click to lock" /></span>
        <span id="brLock" class="<?=$lockClasses["br"] ?>Lock lockSpan 2panelLock 3panelLock startingLock" style="width: 243px;"><img src="lock_open.png" alt="Click to lock" /></span>
</div>

