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

use App\Lib\Storage;
use PHPUnit\Framework\TestCase;

class StorageTest extends TestCase
{
    public function testPosAbbrToFullEmpty()
    {
        $storage = new Storage();
        $this->assertEquals('', $storage->posAbbrToFull(''));
    }

    public function testPosAbbrToFullOneLetter()
    {
        $storage = new Storage();
        $this->assertEquals('', $storage->posAbbrToFull('t'));
    }

    public function testPosAbbrToFullTooLong()
    {
        $storage = new Storage();
        $this->assertEquals('', $storage->posAbbrToFull('tlt'));
    }

    public function testPosAbbrToFullWrongFormat()
    {
        $storage = new Storage();
        $this->assertEquals('', $storage->posAbbrToFull('tt'));
    }

    public function testPosAbbrToFullAllCaps()
    {
        $storage = new Storage();
        $this->assertEquals('topleft', $storage->posAbbrToFull('TL'));
    }

    public function testPosAbbrToFullOneCap()
    {
        $storage = new Storage();
        $this->assertEquals('topleft', $storage->posAbbrToFull('tL'));
    }

    public function testPosAbbrToFullTopLeft()
    {
        $storage = new Storage();
        $this->assertEquals('topleft', $storage->posAbbrToFull('tl'));
    }

    public function testPosAbbrToFullTopMiddle()
    {
        $storage = new Storage();
        $this->assertEquals('topmiddle', $storage->posAbbrToFull('tm'));
    }

    public function testPosAbbrToFullTopRight()
    {
        $storage = new Storage();
        $this->assertEquals('topright', $storage->posAbbrToFull('tr'));
    }

    public function testPosAbbrToFullBottomLeft()
    {
        $storage = new Storage();
        $this->assertEquals('bottomleft', $storage->posAbbrToFull('bl'));
    }

    public function testPosAbbrToFullBottomMiddle()
    {
        $storage = new Storage();
        $this->assertEquals('bottommiddle', $storage->posAbbrToFull('bm'));
    }

    public function testPosAbbrToFullBottomRight()
    {
        $storage = new Storage();
        $this->assertEquals('bottomright', $storage->posAbbrToFull('br'));
    }
}
