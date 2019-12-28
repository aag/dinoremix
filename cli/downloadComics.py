"""
Python script to download all of the comics from
the Dinosaur Comics web site.

Copyright 2008, 2009 Adam Goforth
Started on: 2008.07.31

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

from bs4 import BeautifulSoup
from subprocess import call
import urllib
import re
import os
import sys

scriptDir = sys.path[0]
dataDir = os.path.join(scriptDir, "../data")
guestComicsPath = os.path.join(dataDir, "GuestComicsURLs.txt")
visitedPagesPath = os.path.join(dataDir, "AlreadyDownloaded.txt")
downloadDirPath = os.path.join(dataDir, "comics/")

def getImageOnArchivePage(url, downloadDir):
    """Accepts the url of a Dinosaur Comics archive page and saves the contained comic image to disk."""
    comicPage = urllib.request.urlopen(url)
    pageContents = comicPage.read()
    comicSoup = BeautifulSoup(pageContents)
    comicImg = comicSoup.find('img', src=re.compile("comics\/comic2-.*\.[png|gif|jpg]"))
    if comicImg == None:
        comicImg = comicSoup.find('img', src=re.compile("comics\/.*\.[png|jpg|jpeg|gif]"))
        print("\t*** NO MATCH *** Guess: " + comicImg['src'])

        """Add the page url to a list of guest comics"""
        guestListFile = open(guestComicsPath, 'a')
        guestListFile.write(url + "\n")
        guestListFile.close()
    else:
        print("\tDownloading " + comicImg['src'])
        filename = comicImg['src'].replace("comics/", "")
        imageUrl = "http://www.qwantz.com/{}".format(comicImg['src'])
        urllib.request.urlretrieve(imageUrl, os.path.join(downloadDir, filename))
        
        """Add the page url to a list of already downloaded comics"""
        dlListFile = open(visitedPagesPath, 'a')
        dlListFile.write(url + "\n")
        dlListFile.close()

""" Create missing directories."""
if not os.path.exists(dataDir):
    os.makedirs(downloadDirPath)

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

print("Downloading comic archive list...\n")

archivePage = urllib.request.urlopen("http://www.qwantz.com/archive.php")
contents = archivePage.read()

print("Retrieving new comics...\n")

archiveSoup = BeautifulSoup(contents)
allLinks = archiveSoup.findAll('a', href=re.compile("http:\/\/www.qwantz.com\/index\.php\?comic\=\d+"))
for link in allLinks:
    url = link['href']
    if url not in excludePages:
        print(url)
        getImageOnArchivePage(url, downloadDirPath)

""" Create panels """
import cutimages
cutimages.cutAllImages()

""" Create serialized file lists """
fileListsPath = os.path.join(scriptDir, "updateFileLists.php")
call(["php", fileListsPath])
