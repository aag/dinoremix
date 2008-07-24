$(document).ready(function() {
	// Set the image
	$(".unlockedLock > img").attr("src","lock_open.png");
	$(".unlockedLock").click(doLockUnlock);
	$(".lockedLock > img").attr("src","lock.png");
	$(".lockedLock").click(doLockUnlock);

	$("#reloadLink").click(doReloadClick);

	$("#2panelsLink").click(changeNumPanels);
	$("#3panelsLink").click(changeNumPanels);
	$("#6panelsLink").click(changeNumPanels);

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
	if (clickedLink.id == "2panelsLink") {
		$(".creditsSpacer").fadeOut("fast");
		$(".panelImage").fadeOut("fast");
		$(".lockSpan").fadeOut("fast");
		$(".creditsImage").fadeOut("fast");
		$("#rowDivider").fadeOut("fast");
		$(".2panelImage").fadeIn("fast");
		$("#lCredit").after( $("#2panelCreditsSpacer") );
		$(".2panelLock").fadeIn("fast");
		$("#tlLock").after( $("#brLock") );
	} else if (clickedLink.id == "3panelsLink") {
		$(".creditsSpacer").fadeOut("fast");
		$(".panelImage").fadeOut("fast");
		$(".lockSpan").fadeOut("fast");
		$("#rowDivider").fadeOut("fast");
		$(".creditsImage").fadeOut("fast");
		$(".3panelImage").fadeIn("fast");
		$("#lCredit").after( $("#3panelCreditsSpacer") );
		$(".3panelLock").fadeIn("fast");
		$("#tmLock").after( $("#brLock") );
	} else if (clickedLink.id == "6panelsLink") {
		$(".creditsSpacer").fadeOut("fast");
		$("#rowDivider").fadeIn("fast");
		$(".panelImage").fadeIn("fast");
		$(".lockSpan").fadeIn("fast");
		$(".creditsImage").fadeIn("fast");
		$("#bmLock").after( $("#brLock") );
	}
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
	var classes = new Array();
	var classString = $("#" + elementID).attr("class");
	classes = classString.split(' ');

	for (var i = 0; i < classes.length; i++) {
		if (classes[i] == oldClass) {
			classes[i] = newClass;
		}
	}

	var newClasses = classes.join(" ");
	$("#" + elementID).attr("class", newClasses);
}

function getComicNumForLock(lockID) {
	var pos = lockID.substr(0, 2);
	var filepath = $("#" + pos + "Image").attr("src");
	var filename = filepath.substr(filepath.indexOf("comic2"));
	var comicNum = filename.substring(7, filename.indexOf("-", 8));
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

var unlockedPanels = "";

function doReloadClick(event) {
	event.preventDefault();
	// Fade to 1% opacity instead of invisible so the space
	// won't collapse.
	$(".unlockedImage").fadeTo("fast", 0.01);
	// The "load" event gets fired when an img's src changes
	$(".unlockedImage").load(fadeInImage);

	unlockedPanels = "";
	$(".unlockedLock").each(addToUnlockedPanelsString);
	if (unlockedPanels != "") {
		$.post("randomImages.php", { pos: unlockedPanels }, setAllPanelURLs, "json");
	}
}

function fadeInImage() {
	$("#" + this.id).fadeTo("fast", 1.0);
}

function addToUnlockedPanelsString() {
	if (unlockedPanels.length > 0) {
		unlockedPanels = unlockedPanels + "-";
	}

	unlockedPanels = unlockedPanels + this.id.substr(0, 2);
}

function setAllPanelURLs(imgDescList) {
	jQuery.each(imgDescList, setPanelImgURL);
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
