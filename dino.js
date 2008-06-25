$(document).ready(function() {
	// Set the image
	$(".unlockedLock > img").attr("src","lock_open.png");
	$(".unlockedLock").click(doLockUnlock);
	$(".lockedLock > img").attr("src","lock.png");
	$(".lockedLock").click(doLockUnlock);

	$("#reloadLink").click(doReloadClick);

	buildLinkURLFromDOM();
});

	
function doLockUnlock() {
	var clickedSpan = this;
	var pos = clickedSpan.id.substr(0,2);
    if (clickedSpan.className == "lockedLock") {
        clickedSpan.firstChild.src = "lock_open.png";
		unlockPanel(pos);
	} else {
        clickedSpan.firstChild.src = "lock.png";
		lockPanel(pos);
		var comicNum = getComicNumForLock(clickedSpan.id);
    }
	buildLinkURLFromDOM();
}

function lockPanel(pos) {
	$("#" + pos + "Lock").attr("class","lockedLock");
	$("#" + pos + "Image").attr("class","lockedImage");
}

function unlockPanel(pos) {
	$("#" + pos + "Lock").attr("class","unlockedLock");
	$("#" + pos + "Image").attr("class","unlockedImage");
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

function doReloadClick(event) {
	event.preventDefault();
	// Fade to 1% opacity instead of invisible so the space
	// won't collapse.
	$(".unlockedImage").fadeTo("fast", 0.01);
	$(".unlockedImage").load(fadeInImage);
	$(".unlockedLock").each(queryForRandomPanel);
}

function fadeInImage() {
	$("#" + this.id).fadeTo("fast", 1.0);
}

function queryForRandomPanel() {
	var panel = this.id.substr(0, 2);
	// Use POST instead of GET to disable caching in IE
	$.post("randomImage.php", { pos: panel }, setPanelURL, "json");
}

function setPanelURL(imgDesc) {
	var pos = imgDesc.pos;
	var imgURL = "panels/" + posAbbrToFull(pos) + "/" + imgDesc.file;
	$("#" + pos + "Image").attr("src", imgURL);
//	$("#" + pos + "Image").fadeIn("fast");
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
