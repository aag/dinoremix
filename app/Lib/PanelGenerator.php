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

use App\Lib\Storage;

class PanelGenerator
{
    const IMAGE_FILENAME_PATTERN = '/comic2-(.*)-.*.png/';

    private $storage;

    public function __construct(Storage $storage = null)
    {
        if (is_null($storage)) {
            $storage = new Storage();
        }

        $this->storage = $storage;
    }

    public function getRandomPanels()
    {
        $panels = [];

        foreach (array_keys(Storage::POSITIONS) as $pos) {
            $imgFilename = $this->storage->getRandomImageForPos($pos);
            if (!empty($imgFilename)) {
                $id = $this->getIdFromImageFilename($imgFilename);

                if (!empty($id)) {
                    $panels[] = ["pos" => $pos, "id" => $id];
                }
            }
        }

        return $panels;
    }

    public function getRandomPanelForPosition(string $pos)
    {
        $filename = $this->storage->getRandomImageForPos($pos);
        $comic = $this->getIdFromImageFilename($filename);

        return [
            'comic' => $comic,
            'filename' => $filename,
        ];
    }

    private function getIdFromImageFilename($filename)
    {
        $id = '';

        preg_match(self::IMAGE_FILENAME_PATTERN, $filename, $matches);
        if (count($matches) >= 1) {
            $id = $matches[1];
        }

        return $id;
    }
}
