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
    const POSITIONS = [
        "tl" => "topleft",
        "tm" => "topmiddle",
        "tr" => "topright",
        "bl" => "bottomleft",
        "bm" => "bottommiddle",
        "br" => "bottomright"
    ];

    public function getPositionAbbrs()
    {
        return array_keys(self::POSITIONS);
    }

    public function posAbbrToFull(string $abbr)
    {
        $abbr = strtolower($abbr);

        if (!array_key_exists($abbr, self::POSITIONS)) {
            return '';
        }

        return self::POSITIONS[$abbr];
    }
}
