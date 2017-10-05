<?php
/* 
 * Copyright 2008-2017 Adam Goforth
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
    private $storage;

    public function __construct(Storage $storage = null)
    {
        if (is_null($storage)) {
            $storage = new Storage();
        }

        $this->storage = $storage;
    }

    public function getPositionAbbrs()
    {
        return $this->storage->getPositionAbbrs();
    }

    public function getPanelImageFilename(string $comicId, string $pos)
    {
        $fullName = $this->storage->posAbbrToFull($pos);
        if (!empty($fullName) && !empty($comicId)) {
            return "comic2-" . $comicId . "-" . $fullName . ".png";
        }

        return '';
    }

    public function storeAllImagePaths()
    {
        foreach ($this->getPositionAbbrs() as $pos) {
            $this->storage->storeImagePaths($pos);
        }
    }

    public function getNumComicPermutations()
    {
        $numComics = $this->storage->getTotalComicsCount();
        $numPerms = $numComics ** 6 + $numComics ** 3 + $numComics ** 2;

        return number_format($numPerms);
    }

    public function getRandomImageForPos(string $pos)
    {
        return $this->storage->getRandomImageForPos($pos);
    }
}
