<?php
/* 
 * Copyright 2017 Adam Goforth
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

class AssetManager
{
    const DIST_URL_PATH = 'assets/dist/';

    private $paths;

    public function __construct(Paths $paths = null)
    {
        if (is_null($paths)) {
            $paths = new Paths();
        }

        $this->paths = $paths;
    }

    private function getGlobPatternForFilename(string $filename)
    {
        $lastDotPos = strrpos($filename, '.');
        $namePart = substr($filename, 0, $lastDotPos);
        $extPart = substr($filename, $lastDotPos);

        return $namePart . '-[0-9a-f]*.{dev,min}' . $extPart;
    }

    private function getLastModifiedPath(array $filepaths)
    {
        if (empty($filepaths)) {
            return '';
        }

        usort($filepaths, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });

        return $filepaths[0];
    }

    public function getUrl(string $filename)
    {
        $path = self::DIST_URL_PATH . $filename;

        $fileGlobPattern = $this->getGlobPatternForFilename($filename);
        $distDirGlobPattern = $this->paths->getAssetsDistPath() . '/' . $fileGlobPattern;
        $minifiedFiles = glob($distDirGlobPattern, GLOB_BRACE);

        if (!empty($minifiedFiles)) {
            $path = $this->getLastModifiedPath($minifiedFiles);
            $path = substr($path, strrpos($path, self::DIST_URL_PATH));
        }

        return $path;
    }
}
