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

namespace Test\Unit;

use App\Lib\Paths;
use PHPUnit\Framework\TestCase;

class PathsTest extends TestCase
{
    public function testDefaultRootPath()
    {
        $paths = new Paths();
        $expectedRootPath = dirname(dirname(__DIR__));
        $this->assertEquals($expectedRootPath, $paths->getRootPath());
    }

    public function testSettableRootPath()
    {
        $paths = new Paths('/test');
        $this->assertEquals('/test', $paths->getRootPath());
    }

    public function testSettableRootPathWithTrailingSpace()
    {
        $paths = new Paths('/test ');
        $this->assertEquals('/test', $paths->getRootPath());
    }

    public function testSettableRootPathWithTrailingSlash()
    {
        $paths = new Paths('/test/');
        $this->assertEquals('/test', $paths->getRootPath());
    }

    public function testFilelistsPath()
    {
        $paths = new Paths('/test');
        $this->assertEquals('/test/data/filelists', $paths->getFilelistsPath());
    }

    public function testTemplatesPath()
    {
        $paths = new Paths('/test');
        $this->assertEquals('/test/templates', $paths->getTemplatesPath());
    }

    public function testPanelsPath()
    {
        $paths = new Paths('/test');
        $this->assertEquals('/test/public/panels', $paths->getPanelsPath());
    }
}
