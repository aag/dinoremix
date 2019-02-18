<?php
/*
 * Copyright 2008-2018 Adam Goforth
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Lib;

class Comic
{
    const DEFAULT_NUM_PANELS = 3;
    const AVAIL_NUM_PANELS = [2, 3, 6];

    private $storage;
    private $panelGenerator;

    private $altText = '';
    private $lockedPanels = [];
    private $numPanels = self::DEFAULT_NUM_PANELS;
    private $panels = [];
    private $positions = [];

    public function __construct(Storage $storage = null, PanelGenerator $panelGenerator = null)
    {
        if (is_null($storage)) {
            $storage = new Storage();
        }

        if (is_null($panelGenerator)) {
            $panelGenerator = new PanelGenerator($storage);
        }

        $this->storage = $storage;
        $this->panelGenerator = $panelGenerator;

        $this->positions = $this->storage->getPositionAbbrs();
        $this->initializePanels();
    }

    private function initializePanels()
    {
        foreach ($this->positions as $pos) {
            $this->panels[$pos] = [
                'comic' => -1,
                'filename' => '',
                'isLocked' => false,
                'pos' => $pos,
            ];
        }
    }

    private function getPanelImageFilename(string $comicId, string $pos)
    {
        $fullName = $this->storage->posAbbrToFull($pos);
        if (!empty($fullName) && !empty($comicId)) {
            return "comic2-" . $comicId . "-" . $fullName . ".png";
        }

        return '';
    }

    private function getComics()
    {
        $comics = array_column($this->panels, 'comic', 'pos');
        $comics = array_filter($comics, function ($comic) {
            return $comic !== -1;
        });

        return $comics;
    }

    public function getAltTextForHtmlAttribute()
    {
        return htmlspecialchars($this->altText);
    }

    public function getNumComics()
    {
        return $this->storage->getTotalComicsCount();
    }

    public function getNumComicPermutations()
    {
        $numComics = $this->storage->getTotalComicsCount();
        $numPerms = $numComics ** 6 + $numComics ** 3 + $numComics ** 2;

        return number_format($numPerms);
    }

    public function getNumPanels()
    {
        return $this->numPanels;
    }

    public function getPanels()
    {
        return $this->panels;
    }

    public function getPositionAbbrs()
    {
        return $this->storage->getPositionAbbrs();
    }

    public function getPermalink(int $numPanels = null)
    {
        $queryParams = $this->getComics();

        if (is_null($numPanels)) {
            $numPanels = $this->numPanels;
        }

        if ($numPanels !== self::DEFAULT_NUM_PANELS) {
            $queryParams['numpanels'] = $numPanels;
        }

        return '?' . http_build_query($queryParams);
    }

    public function getReloadUri()
    {
        return '?numpanels=' . $this->numPanels;
    }

    public function storeAllImagePaths()
    {
        foreach ($this->getPositionAbbrs() as $pos) {
            $this->storage->storeImagePaths($pos);
        }
    }

    public function setAltText(string $altText)
    {
        $this->altText = stripslashes($altText);
        return $this;
    }

    public function getLockedPanels()
    {
        return $this->lockedPanels;
    }

    public function setLockedPanels(array $lockedPanels)
    {
        foreach ($lockedPanels as $panelLockInfo) {
            $pos = $panelLockInfo['pos'];
            $comic = $panelLockInfo['comic'];

            $this->panels[$pos]['isLocked'] = true;
            $this->panels[$pos]['comic'] = $comic;
            $this->panels[$pos]['filename'] = $this->getPanelImageFilename($comic, $pos);

            $this->lockedPanels[] = $pos;
        }

        return $this;
    }

    public function setNumPanels(int $numPanels)
    {
        if (in_array($numPanels, self::AVAIL_NUM_PANELS)) {
            $this->numPanels = $numPanels;
        }
        return $this;
    }

    public function generateRandomPanels()
    {
        foreach ($this->panels as $pos => $panel) {
            if (!$panel['isLocked']) {
                $randomPanel = $this->panelGenerator->getRandomPanelForPosition($pos);

                $this->panels[$pos]['comic'] = $randomPanel['comic'];
                $this->panels[$pos]['filename'] = $randomPanel['filename'];
            }
        }

        return $this;
    }

    public function getJsBootstrap()
    {
        foreach ($this->storage->getPositionAbbrs() as $pos) {
            $randomPanels[$pos] = $this->panelGenerator->getRandomPanelForPosition($pos)['comic'];
        }
        
        return [
            'initialComic' => [
                'altText' => $this->altText,
                'lockedPanels' => $this->getLockedPanels(),
                'numPanels' => $this->getNumPanels(),
                'panels' => $this->getComics(),
            ],
            'nextPanels' => $randomPanels,
        ];
    }
}
