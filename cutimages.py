""" 
Python script to cut up Dinosaur Comics strips into their
constituent panels.

Written by: Adam Goforth
Started on: 2008.04.20
"""

import Image
import os
import sys


def cutImage(image):
	"""Accepts an image containing a whole comic and returns a dict of images, each a panel of the comic."""
	retDict = {}
	
	tlwidth = 244
	tmwidth = 129
	trwidth = 362

	blwidth = 194
	bmwidth = 298
	brwidth = 243

	theight = 242
	bheight = 245

	tlcoords = (0, 0, tlwidth, theight)
	tlimage = image.crop(tlcoords)
	tlimage.load()
	retDict["topleft"] = tlimage

	tmcoords = (tlwidth, 0, tlwidth + tmwidth, theight)
	tmimage = image.crop(tmcoords)
	tmimage.load()
	retDict["topmiddle"] = tmimage

	trcoords = (tlwidth + tmwidth, 0, tlwidth + tmwidth + trwidth, theight)
	trimage = image.crop(trcoords)
	trimage.load()
	retDict["topright"] = trimage

	blcoords = (0, theight, blwidth, theight + bheight)
	blimage = image.crop(blcoords)
	blimage.load()
	retDict["bottomleft"] = blimage

	bmcoords = (blwidth, theight, blwidth + bmwidth, theight + bheight)
	bmimage = image.crop(bmcoords)
	bmimage.load()
	retDict["bottommiddle"] = bmimage

	brcoords = (blwidth + bmwidth, theight, blwidth + bmwidth + brwidth, theight + bheight)
	brimage = image.crop(brcoords)
	brimage.load()
	retDict["bottomright"] = brimage

	return retDict


def dumpPanels(outdir, comicFileName, imageDict):
	for panelname, image in imageDict.iteritems():
		outputdir = os.path.join(outdir, panelname)
		if not os.path.exists(outputdir):
			os.mkdir(outputdir)

		outfileName = os.path.join(outputdir, comicFileName) + "-" + panelname + ".png"
		image.save(outfileName)


numImages = 0

for arg in sys.argv:
	if not arg == "cutimages.py":
		print 'processing', arg

		image = Image.open(arg)
		panels = cutImage(image)

		dirs, filename = os.path.split(arg)
		filename, sep, ext = filename.rpartition(".")

		dumpPanels("panels", filename, panels)
		numImages = numImages + 1

print numImages, 'images processed'

	
