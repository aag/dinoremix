"""
Unit tests for the cutimages.py script.

Copyright 2008, 2009 Adam Goforth

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
"""

import unittest
import cutimages
import Image

class CutImage(unittest.TestCase):
	"""Tests whether the script can load and cut up an image."""


	def testCutImageReturnsPanels(self):
		"""Tests whether cutImage returns correctly sized panels."""
		image = Image.open("test/comic.png")
		dict = cutimages.cutImage(image)

		width, height = dict["topleft"].size
		self.assertEqual(width, 244)
		self.assertEqual(height, 242)

		width, height = dict["topmiddle"].size
		self.assertEqual(width, 129)
		self.assertEqual(height, 242)

		width, height = dict["topright"].size
		self.assertEqual(width, 362)
		self.assertEqual(height, 242)

		width, height = dict["bottomleft"].size
		self.assertEqual(width, 194)
		self.assertEqual(height, 245)

		width, height = dict["bottommiddle"].size
		self.assertEqual(width, 298)
		self.assertEqual(height, 245)

		width, height = dict["bottomright"].size
		self.assertEqual(width, 243)
		self.assertEqual(height, 245)

	def testDumpPanels(self):
		testImage = Image.open("test/comic.png")
		images = cutimages.cutImage(testImage)
		cutimages.dumpPanels("test", "comic", images)

		tlpanelImage = Image.open("test/topleft/comic-topleft.png")
		width, height = tlpanelImage.size
		self.assertEqual(width, 244)
		self.assertEqual(height, 242)

if __name__ == "__main__":
	unittest.main()

