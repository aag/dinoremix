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

namespace Test\Unit;

use App\Lib\AssetManager;
use App\Lib\Paths;

use PHPUnit\Framework\TestCase;

class AssetManagerTest extends TestCase
{
    private static $fixturesPath;

    public static function setupBeforeClass()
    {
        self::$fixturesPath = dirname(__DIR__) . '/fixtures';
    }

    public function testBasicJSFile()
    {
        $paths = new Paths(self::$fixturesPath);
        $am = new AssetManager($paths);
        $minifiedPath = 'assets/dist/dino-b4d51e3271.min.js';
        $this->assertEquals($minifiedPath, $am->getUrl('dino.js'));
    }

    public function testBasicCssFile()
    {
        $paths = new Paths(self::$fixturesPath);
        $am = new AssetManager($paths);
        $minifiedPath = 'assets/dist/dino-35e268eb2b.min.css';
        $this->assertEquals($minifiedPath, $am->getUrl('dino.css'));
    }

    public function testPreMinifiedJsFile()
    {
        $paths = new Paths(self::$fixturesPath);
        $am = new AssetManager($paths);
        $minifiedPath = 'assets/dist/jquery.min-f635d8f19f.min.js';
        $this->assertEquals($minifiedPath, $am->getUrl('jquery.min.js'));
    }

    public function testMissingJsFile()
    {
        $paths = new Paths(self::$fixturesPath);
        $am = new AssetManager($paths);
        $minifiedPath = 'assets/dist/missing.js';
        $this->assertEquals($minifiedPath, $am->getUrl('missing.js'));
    }
}
