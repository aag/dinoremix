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

class Paths
{
    private $assetsPath;
    private $assetsDistPath;
    private $filelistsPath;
    private $panelsPath;
    private $rootPath;
    private $templatesPath;

    public function __construct(string $rootPath = null)
    {
        if (empty($rootPath)) {
            $rootPath = dirname(dirname(__DIR__));
        }

        // Strip whitespace and trailing slashes from the path
        $rootPath = rtrim($rootPath);
        $rootPath = rtrim($rootPath, '/');

        $this->rootPath = $rootPath;
        $this->assetsPath = $rootPath . '/public/assets';
        $this->assetsDistPath = $rootPath . '/public/assets/dist';
        $this->filelistsPath = $rootPath . '/data/filelists';
        $this->panelsPath = $rootPath . '/public/panels';
        $this->templatesPath = $rootPath . '/templates';
    }

    public function getAssetsPath()
    {
        return $this->assetsPath;
    }

    public function getAssetsDistPath()
    {
        return $this->assetsDistPath;
    }

    public function getFilelistsPath()
    {
        return $this->filelistsPath;
    }

    public function getPanelsPath()
    {
        return $this->panelsPath;
    }

    public function getRootPath()
    {
        return $this->rootPath;
    }

    public function getTemplatesPath()
    {
        return $this->templatesPath;
    }
}
