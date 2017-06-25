<?php
/* 
 * Utility functions for dino remix.
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

class Util {
    private static function getRandomString($strings) {
        $stringIdx = random_int(0, sizeof($strings) - 1);
        return $strings[$stringIdx];
    }

    private static function removeDots($filelist){
        return array_slice($filelist, 2);
    }

    public static function countComics() {
        $comicsfiles = self::removeDots(scandir(ROOT_DIR . "/public/panels/topleft"));
        return sizeof($comicsfiles);
    }

    public static function getRandomImageForPos($pos) {
        $fullPosName = self::posAbbrToFull($pos);
        $filename = "";

        if ($fullPosName != "") {
            $serializedPaths = file_get_contents(FILELISTS_DIR . "/" . $fullPosName . "Paths.txt");
            $allFiles = unserialize($serializedPaths);
            $filename = self::getRandomString($allFiles);
        }

        return $filename;
    }

    public static function posAbbrToFull($abbr) {
        $fullName = "";

        $firstChar = substr($abbr, 0, 1);
        if ($firstChar == "t") {
            $fullName = "top";
        } else if ($firstChar == "b") {
            $fullName = "bottom";
        }

        $secondChar = substr($abbr, 1, 1);
        if ($secondChar == "l") {
            $fullName .= "left";
        } else if ($secondChar == "m") {
            $fullName .= "middle";
        } else if ($secondChar == "r") {
            $fullName .= "right";
        }

        return $fullName;
    }
}
