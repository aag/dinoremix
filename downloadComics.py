"""
Python script to download all of the comics from
the Dinosaur Comics web site.

Written by: Adam Goforth
Started on: 2008.07.31
"""

from BeautifulSoup import BeautifulSoup
import urllib
import re
import os.path
import sys

scriptDir = sys.path[0]
guestComicsPath = scriptDir + "/GuestComicsURLs.txt"
visitedPagesPath = scriptDir + "/AlreadyDownloaded.txt"

def getImageOnArchivePage(url):
	"""Accepts the url of a Dinosaur Comics archive page and saves the contained comic image to disk."""
	comicPage = urllib.urlopen(url)
	pageContents = comicPage.read()
	comicSoup = BeautifulSoup(pageContents)
	comicImg = comicSoup.find('img', src=re.compile("comics\/comic2-.*\.[png|gif|jpg]"), width="735", height="500")
	if comicImg == None:
		comicImg = comicSoup.find('img', src=re.compile("comics\/.*\.[png|jpg|jpeg|gif]"))
		print "\t*** NO MATCH *** Guess: " + comicImg['src']

		"""Add the page url to a list of guest comics"""
		guestListFile = open(guestComicsPath, 'a')
		guestListFile.write(url + "\n")
		guestListFile.close()
	else:
		print "\tDownloading " + comicImg['src']
		filename = comicImg['src'].replace("http://www.qwantz.com/comics/", "")
		urllib.urlretrieve(comicImg['src'], "downloads/" + filename)
		
		"""Add the page url to a list of already downloaded comics"""
		dlListFile = open(visitedPagesPath, 'a')
		dlListFile.write(url + "\n")
		dlListFile.close()


""" Get a list of the archive pages we've already visited."""
visitedPages = []
if os.path.exists(visitedPagesPath):
	dlListFile = open(visitedPagesPath, 'r')
	fileContents = dlListFile.read()
	dlListFile.close()
	visitedPages = fileContents.split("\n")

guestPages = []
if os.path.exists(guestComicsPath):
	guestComicsFile = open(guestComicsPath, 'r')
	fileContents = guestComicsFile.read()
	guestComicsFile.close()
	guestPages = fileContents.split("\n")

excludePages = visitedPages + guestPages

archivePage = urllib.urlopen("http://www.qwantz.com/archive/list.html")
contents = archivePage.read()

archiveSoup = BeautifulSoup(contents)
allLinks = archiveSoup.findAll('a', href=re.compile("\/archive\/[0-9]+\.html"))
for link in allLinks:
	url = "http://www.qwantz.com" + link['href']
	if url not in excludePages:
		print url
		getImageOnArchivePage(url)
	else:
		print "Already downloaded: " + url
