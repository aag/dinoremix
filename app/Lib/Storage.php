<?php
/* 
 * Storage functions for dino remix.
 *
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

use App\Lib\Comic;
use App\Lib\Paths;

class Storage
{
    private $comic;
    private $paths;

    public function __construct(Comic $comic = null, Paths $paths = null)
    {
        if (is_null($comic)) {
            $comic = new Comic();
        }

        if (is_null($paths)) {
            $paths = new Paths();
        }

        $this->comic = $comic;
        $this->paths = $paths;
    }

    private function getRandomString(array $strings)
    {
        $stringIdx = random_int(0, sizeof($strings) - 1);
        return $strings[$stringIdx];
    }

    private function getImagePaths(string $pos)
    {
        $dir = $this->paths->getFilelistsPath();
        $serializedPaths = file_get_contents($dir . '/' . $pos . "Paths.txt");
        return unserialize($serializedPaths);
    }

    public function countComics()
    {
        // Take the topleft panel as representative
        return sizeof($this->getImagePaths('topleft'));
    }

    public function storeImagePaths(
        string $panelsDir,
        string $outputDir,
        string $pos
    ) {
        $allfiles = array_slice(scandir($panelsDir . "/" . $pos), 2);

        $serializedPaths = serialize($allfiles);
        $fp = fopen($outputDir . "/" . $pos . "Paths.txt", "w");
        fwrite($fp, $serializedPaths);
        fclose($fp);
    }

    public function getRandomImageForPos(string $pos)
    {
        $fullPosName = $this->comic->posAbbrToFull($pos);
        $filename = "";

        if ($fullPosName != "") {
            $allFiles = $this->getImagePaths($fullPosName);
            $filename = $this->getRandomString($allFiles);
        }

        return $filename;
    }
}
