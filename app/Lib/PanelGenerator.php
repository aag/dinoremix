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

use App\Lib\Storage;

class PanelGenerator
{
    private $storage;

    public function __construct(Storage $storage = null)
    {
        if (is_null($storage)) {
            $storage = new Storage();
        }

        $this->storage = $storage;
    }

    public function getRandomPanelsForPositions(array $positions)
    {
        $panels = [];

        foreach ($positions as $pos) {
            $imgFilename = $this->storage->getRandomImageForPos($pos);
            if (!empty($imgFilename)) {
                $panel = ["pos" => $pos, "file" => $imgFilename];
                $panels[] = $panel;
            }
        }

        return $panels;
    }
}
