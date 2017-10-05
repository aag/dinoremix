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
    public function posAbbrToFull(string $abbr)
    {
        $fullName = "";

        $firstChar = substr($abbr, 0, 1);
        if ($firstChar == "t") {
            $fullName = "top";
        } elseif ($firstChar == "b") {
            $fullName = "bottom";
        }

        $secondChar = substr($abbr, 1, 1);
        if ($secondChar == "l") {
            $fullName .= "left";
        } elseif ($secondChar == "m") {
            $fullName .= "middle";
        } elseif ($secondChar == "r") {
            $fullName .= "right";
        }

        return $fullName;
    }
}
