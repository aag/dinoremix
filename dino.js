$(document).ready(function() {
	// Set up the initial display for browsers with JavaScript
	$(".startingLock").css({ display: "inline" });
	$("#reloadText").text("Reload the unlocked panels");

	// All of the lock images default to the "open" image, so
	// set it to the closed image if the user has passed in
	// specific comics in the URL
	$(".lockedLock > img").attr("src","lock.png");

	$(".lockSpan").click(doLockUnlock);
	$("#reloadLink").click(doReloadClick);
	$(".panelNumLink").click(changeNumPanels);

	$("#setAltTextLink").click(showAltTextInput);
	$("#altTextForm").submit(updateAltText);
	$("#altTextOKButton").click(updateAltText);
	$("#altTextCancelButton").click(hideAltTextInput);

	$("#panelContainer").hover(enterHoverPanelImage, exitHoverPanelImage);

	buildLinkURLFromDOM();
});

	
function doLockUnlock() {
	var clickedSpan = this;
	var pos = clickedSpan.id.substr(0,2);
    if (hasClass(clickedSpan.id, "lockedLock")) {
        clickedSpan.firstChild.src = "lock_open.png";
		unlockPanel(pos);
	} else {
        clickedSpan.firstChild.src = "lock.png";
		lockPanel(pos);
		var comicNum = getComicNumForLock(clickedSpan.id);
    }
	buildLinkURLFromDOM();
}

function changeNumPanels(event) {
	event.preventDefault();
	var clickedLink = this;

	$(".panelNumLink").addClass("unchosenPanelNumLink");
	$(".panelNumLink").removeClass("chosenPanelNumLink");

	$(clickedLink).addClass("chosenPanelNumLink");
	$(clickedLink).removeClass("unchosenPanelNumLink");

	if (clickedLink.id == "twoPanelsLink") {
		$(".creditsSpacer").fadeOut("fast");
		$(".panelImage").fadeOut("fast");
		$(".lockSpan").fadeOut("fast");
		$(".creditsImage").fadeOut("fast");
		$("#rowDivider").fadeOut("fast");

		$(".panelImage").removeClass("notShowing");
		$(".panelImage:not(.2panelImage)").addClass("notShowing");

		$(".2panelImage").fadeIn("fast");
		$("#lCredit").after( $("#TwoPanelCreditsSpacer") );
		$("#brImage").css("top", "1px");
		$(".2panelLock").fadeIn("fast");
		$("#tlLock").after( $("#brLock") );
		$("#linksBar").css("width", "489px");
		$("#panelContainer").css("width", "489px");
	} else if (clickedLink.id == "threePanelsLink") {
		$(".creditsSpacer").fadeOut("fast");
		$(".panelImage").fadeOut("fast");
		$(".lockSpan").fadeOut("fast");
		$("#rowDivider").fadeOut("fast");
		$(".creditsImage").fadeOut("fast");

		$(".panelImage").removeClass("notShowing");
		$(".panelImage:not(.3panelImage)").addClass("notShowing");

		$(".3panelImage").fadeIn("fast");
		$("#lCredit").after( $("#ThreePanelCreditsSpacer") );
		$("#brImage").css("top", "1px");
		$(".3panelLock").fadeIn("fast");
		$("#tmLock").after( $("#brLock") );
		$("#linksBar").css("width", "618px");
		$("#panelContainer").css("width", "618px");
	} else if (clickedLink.id == "sixPanelsLink") {
		$(".creditsSpacer").fadeOut("fast");

		$(".panelImage").removeClass("notShowing");

		$("#brImage").css("top", "0px");
		$("#rowDivider").fadeIn("fast");
		$(".panelImage").fadeIn("fast");
		$(".lockSpan").fadeIn("fast");
		$(".creditsImage").fadeIn("fast");
		$("#bmLock").after( $("#brLock") );
		$("#linksBar").css("width", "735px");
		$("#panelContainer").css("width", "735px");
	}

	allImagesLoaded();
	setPermaLink();
}

function lockPanel(pos) {
	replaceClass(pos + "Lock", "unlockedLock", "lockedLock");
	replaceClass(pos + "Image", "unlockedImage", "lockedImage");
}

function unlockPanel(pos) {
	replaceClass(pos + "Lock", "lockedLock", "unlockedLock");
	replaceClass(pos + "Image", "lockedImage", "unlockedImage");
}

function hasClass(elementID, className) {
	var classes = new Array();
	var classString = $("#" + elementID).attr("class");
	classes = classString.split(' ');
	if ( jQuery.inArray(className, classes) != -1) {
		return true;
	}
	return false;
}

function replaceClass(elementID, oldClass, newClass) {
	$("#" + elementID).addClass(newClass);
	$("#" + elementID).removeClass(oldClass);
}

function getComicNumForLock(lockID) {
	var pos = lockID.substr(0, 2);
	var filepath = $("#" + pos + "Image").attr("src");
	var filename = filepath.substr(filepath.indexOf("comic2"));
	var comicNum = filename.substring(7, filename.lastIndexOf("-"));
	return comicNum;
}

function addToLinkURL() {
	var pos = this.id.substr(0, 2);
	var currentURL = $("#reloadLink").attr("href");
	var urlString = currentURL + pos + "=" + getComicNumForLock(this.id) + "&";
	$("#reloadLink").attr("href", urlString);
}

function buildLinkURLFromDOM() {
	$("#reloadLink").attr("href", "./?");
	$(".lockedLock").each(addToLinkURL);
	var cleanURL = $("#reloadLink").attr("href").substring(0, $("#reloadLink").attr("href").length - 1);
	$("#reloadLink").attr("href", cleanURL);
}

var allPanelsURL = "";

function getAllPanelsURL() {
	allPanelsURL = "";
	$(".panelImage").each(addToAllPanelsURL);
	return allPanelsURL;
}

function addToAllPanelsURL() {
	if (allPanelsURL.length > 0) {
		allPanelsURL = allPanelsURL + "&";
	}

	var pos = this.id.substr(0, 2);
	var filepath = $(this).attr("src");
	var filename = filepath.substr(filepath.indexOf("comic2"));
	var comicNum = filename.substring(7, filename.lastIndexOf("-"));
	allPanelsURL = allPanelsURL + pos + "=" + comicNum;
}

var unlockedPanels = "";

function doReloadClick(event) {
	event.preventDefault();

	unlockedPanels = "";
	$(".unlockedLock").each(addToUnlockedPanelsString);
	if (unlockedPanels != "") {
		replaceClass("reloadButton", "unpressedReloadButton", "depressedReloadButton");
		// Fade to 1% opacity instead of invisible so the space
		// won't collapse.
		$(".unlockedImage:not(.notShowing)").fadeTo("fast", 0.01);
		// The "load" event gets fired when an img's src changes
		$(".unlockedImage:not(.notShowing)").load(fadeInImage);

		resetLoadedImages();
		$(".unlockedImage:not(.notShowing)").load(imageLoaded);
		$("#reloadLink").unbind('click', doReloadClick);
		$("#reloadLink").click(preventDefault);

		$.post("randomImages.php", { pos: unlockedPanels }, setAllPanelURLs, "json");
	}
}

function preventDefault(event) {
	event.preventDefault();
}

function fadeInImage() {
	$("#" + this.id).fadeTo("fast", 1.0);
}

var loadedImages = 0;

function resetLoadedImages() {
	loadedImages = 0;
}

function imageLoaded() {
	loadedImages++;

	var numImages = numImagesToReload();

	if (loadedImages == numImages) {
		allImagesLoaded();
	}
}

function allImagesLoaded() {
	replaceClass("reloadButton", "depressedReloadButton", "unpressedReloadButton");
	$("#reloadLink").unbind('click', preventDefault);
	$("#reloadLink").click(doReloadClick);
}

function numImagesToReload() {
	return $(".unlockedImage:not(.notShowing)").length;
}

function addToUnlockedPanelsString() {
	if (!hasClass(this.id.substr(0, 2) + "Image", "notShowing")) {
		if (unlockedPanels.length > 0) {
			unlockedPanels = unlockedPanels + "-";
		}

		unlockedPanels = unlockedPanels + this.id.substr(0, 2);
	}
}

function setAllPanelURLs(imgDescList) {
	jQuery.each(imgDescList, setPanelImgURL);
	setPermaLink();
}

function setPermaLink() {
	var numPanels = getNumPanels();
	var panelsURL = "";

	if (numPanels != 3) {
		panelsURL = "&numpanels=" + numPanels;
	}

	var fullLink = "http://" + document.location.host + document.location.pathname + "?" + getAllPanelsURL() + panelsURL;

	var altText = $("#tlImage").attr("title"); 
	if (altText != "")
	{
		fullLink = fullLink + "&alt=" + urlEncode(altText);
	}

	$("#permaLink").attr("href", fullLink);
}

function setPanelImgURL() {
	var pos = this.pos;
	var imgURL = "panels/" + posAbbrToFull(pos) + "/" + this.file;
	$("#" + pos + "Image").attr("src", imgURL);
}

function posAbbrToFull(abbr) {
	var fullName = "";

	var firstChar = abbr.substr(0,1);
	if (firstChar == "t") {
		fullName = "top";
	} else if (firstChar == "b") {
		fullName = "bottom";
	}

	var secondChar = abbr.substr(1,1);
	if (secondChar == "l") {
		fullName += "left";
	} else if (secondChar == "m") {
		fullName += "middle";
	} else if (secondChar == "r") {
		fullName += "right";
	}

	return fullName;
}

function getNumPanels() {
	var numPanels = 0;

	if ( hasClass("twoPanelsLink", "chosenPanelNumLink") ) {
		numPanels = 2;
	} else if ( hasClass("threePanelsLink", "chosenPanelNumLink") ) {
		numPanels = 3;
	} else if ( hasClass("sixPanelsLink", "chosenPanelNumLink") ) {
		numPanels = 6;
	}

	return numPanels;
}

function enterHoverPanelImage() {
	if (!$("#altTextInputControls").is(':visible')) {
		$("#setAltTextLink").fadeIn("fast");
	}
}

function exitHoverPanelImage() {
	$("#setAltTextLink").fadeOut("fast");
}

function showAltTextInput(event) {
	event.preventDefault();
	exitHoverPanelImage();
	$("#altTextInputControls").fadeIn("fast");
	$("#altTextInput").focus();
}

function hideAltTextInput(event) {
	event.preventDefault();
	$("#altTextInputControls").fadeOut("fast");
	enterHoverPanelImage();
}

function updateAltText(event) {
	event.preventDefault();
	rawInput = $("#altTextInput").val();

	$("#altTextInputControls").fadeOut("fast");

	cleanInput = sanitizeForOutput(rawInput);
	$(".panelImage").attr("alt", rawInput);
	$(".panelImage").attr("title", rawInput);

	setPermaLink();

	return false;
}

function urlEncode(str) {
	// % must be first, or it will destroy other entities
	str = str.replace(/%/g, "%25");
	str = str.replace(/;/g, "%3B");
	str = str.replace(/\?/g, "%3F");
	str = str.replace(/\//g, "%2F");
	str = str.replace(/:/g, "%3A");
	str = str.replace(/#/g, "%23");
	str = str.replace(/&/g, "%24");
	str = str.replace(/\+/g, "%2B");
	str = str.replace(/\$/g, "%26");
	str = str.replace(/,/g, "%2C");
	str = str.replace(/ /g, "%20");
	str = str.replace(/\</gi, "%3C");
	str = str.replace(/\>/gi, "%3E");
	str = str.replace(/~/g, "%7E");
	return str;
}

// Return the given string, but sanitized so it's safe to include
// it in a page, preventing XSS and other injections
function sanitizeForOutput(str) {
	str = str.replace(/\"/g, "&#34;");
	str = str.replace(/\'/g, "&#39;");
	str = str.replace(/\</g, "&#60;");
	str = str.replace(/\>/g, "&#62;");
	str = str.replace(/\n/g, "<br />");
	return str;
}
