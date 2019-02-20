<?php
/*
 * Copyright 2017-2018 Adam Goforth
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
    private static $filesPath;
    private static $assetPath;

    public static function setupBeforeClass(): void
    {
        self::$filesPath = dirname(__DIR__) . '/files';
        self::$assetPath = self::$filesPath . '/public/assets/dist';

        if (!file_exists(self::$assetPath)) {
            mkdir(self::$assetPath, 0755, true);
        }
    }

    protected function setUp(): void
    {
        $this->clearFiles();
    }

    protected function tearDown(): void
    {
        $this->clearFiles();
    }

    private function clearFiles()
    {
        array_map('unlink', glob(self::$assetPath . "/*"));
    }

    public function testBasicJSFile()
    {
        $paths = new Paths(self::$filesPath);
        $am = new AssetManager($paths);
        $minifiedFilename = 'dino-b4d51e3271.min.js';
        touch(self::$assetPath . '/' . $minifiedFilename);
        $this->assertEquals('assets/dist/' . $minifiedFilename, $am->getUrl('dino.js'));
    }

    public function testMultipleJSFiles()
    {
        touch(self::$assetPath . '/dino-a3582d7428.min.js', time() - 10);
        touch(self::$assetPath . '/dino-c3582d7428.min.js', time() - 10);

        $newestFilename = 'dino-b4d51e3271.min.js';
        touch(self::$assetPath . '/' . $newestFilename, time());

        $paths = new Paths(self::$filesPath);
        $am = new AssetManager($paths);
        $this->assertEquals('assets/dist/' . $newestFilename, $am->getUrl('dino.js'));
    }

    public function testBasicCssFile()
    {
        $paths = new Paths(self::$filesPath);
        $am = new AssetManager($paths);
        $minifiedFilename = 'dino-35e268eb2b.min.css';
        touch(self::$assetPath . '/' . $minifiedFilename);
        $this->assertEquals('assets/dist/' . $minifiedFilename, $am->getUrl('dino.css'));
    }

    public function testMissingJsFile()
    {
        $paths = new Paths(self::$filesPath);
        $am = new AssetManager($paths);
        $minifiedPath = 'assets/dist/missing.js';
        $this->assertEquals($minifiedPath, $am->getUrl('missing.js'));
    }
}
