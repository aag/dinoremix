"""Unit tests for the cutimages.py script."""

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

