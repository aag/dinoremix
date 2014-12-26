""" 
Python script to cut up Dinosaur Comics strips into their
constituent panels.

Copyright 2008, 2009 Adam Goforth
Started on: 2008.04.20

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
"""

import os
import sys
from PIL import Image


def cutImage(image):
	"""Accepts an image containing a whole comic and returns a dict of images, each a panel of the comic."""
	retDict = {}
	
	tlwidth = 244
	tmwidth = 129
	trwidth = 362

	blwidth = 194
	bmwidth = 298
	brwidth = 243

	theight = 243
	bheight = 244

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


def cutAllImagesInDir(indir, outdir):
	allFiles = os.listdir(indir)
	numImages = 0

	print "Looking for new files to cut..."

	for filename in allFiles:
		filePath = os.path.join(indir + filename)
		filenamePrefix = filename[0:filename.rfind(".")]
		tlPanelFileName = filenamePrefix + "-topleft.png"

		if not os.path.exists(os.path.join(outdir, "topleft", tlPanelFileName)):
			print 'processing', filePath

			image = Image.open(filePath)
			panels = cutImage(image)

			dirs, filename = os.path.split(filePath)
			filename, sep, ext = filename.rpartition(".")

			dumpPanels(outdir, filename, panels)
			numImages = numImages + 1

	return numImages


def cutAllImages():
	scriptDir = sys.path[0]
	comicsDir = os.path.join(scriptDir, "comics/")
	panelsDir = os.path.join(scriptDir, "panels/")
	processedImages = cutAllImagesInDir(comicsDir, panelsDir)

	print processedImages, 'images processed\n'

if __name__ == "__main__":
	cutAllImages()
