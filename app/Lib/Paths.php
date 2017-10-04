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

class Paths
{
    private $rootPath;
    private $filelistsPath;
    private $templatesPath;
    private $panelsPath;

    public function __construct()
    {
        $this->rootPath = dirname(dirname(__DIR__));
        $this->filelistsPath = $this->rootPath . '/data/filelists';
        $this->templatesPath = $this->rootPath . '/templates';
        $this->panelsPath = $this->rootPath . '/public/panels';
    }

    public function getRootPath()
    {
        return $this->rootPath;
    }

    public function getFilelistsPath()
    {
        return $this->filelistsPath;
    }

    public function getTemplatesPath()
    {
        return $this->templatesPath;
    }

    public function getPanelsPath()
    {
        return $this->panelsPath;
    }
}
