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
    private static function getRandomString(array $strings)
    {
        $stringIdx = random_int(0, sizeof($strings) - 1);
        return $strings[$stringIdx];
    }

    private static function getImagePaths(string $dir, string $pos)
    {
        $serializedPaths = file_get_contents($dir . '/' . $pos . "Paths.txt");
        return unserialize($serializedPaths);
    }

    private static function removeDots(array $filelist)
    {
        return array_slice($filelist, 2);
    }

    public static function countComics()
    {
        $paths = new Paths();
        $comicsfiles = self::removeDots(scandir($paths->getRootPath() . "/public/panels/topleft"));
        return sizeof($comicsfiles);
    }

    public static function storeImagePaths(
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

    public static function getRandomImageForPos(string $pos)
    {
        $fullPosName = Comic::posAbbrToFull($pos);
        $filename = "";

        if ($fullPosName != "") {
            $paths = new Paths();
            $allFiles = self::getImagePaths($paths->getFilelistsPath(), $fullPosName);
            $filename = self::getRandomString($allFiles);
        }

        return $filename;
    }
}
