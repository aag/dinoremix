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

use App\Lib\Comic;
use PHPUnit\Framework\TestCase;

class ComicTest extends TestCase
{
    public function testPosAbbrToFullEmpty()
    {
        $comic = new Comic();
        $this->assertEquals('', $comic->posAbbrToFull(''));
    }

    public function testPosAbbrToFullOneLetter()
    {
        $comic = new Comic();
        $this->assertEquals('', $comic->posAbbrToFull('t'));
    }

    public function testPosAbbrToFullTooLong()
    {
        $comic = new Comic();
        $this->assertEquals('', $comic->posAbbrToFull('tlt'));
    }

    public function testPosAbbrToFullWrongFormat()
    {
        $comic = new Comic();
        $this->assertEquals('', $comic->posAbbrToFull('tt'));
    }

    public function testPosAbbrToFullAllCaps()
    {
        $comic = new Comic();
        $this->assertEquals('topleft', $comic->posAbbrToFull('TL'));
    }

    public function testPosAbbrToFullOneCap()
    {
        $comic = new Comic();
        $this->assertEquals('topleft', $comic->posAbbrToFull('tL'));
    }

    public function testPosAbbrToFullTopLeft()
    {
        $comic = new Comic();
        $this->assertEquals('topleft', $comic->posAbbrToFull('tl'));
    }

    public function testPosAbbrToFullTopMiddle()
    {
        $comic = new Comic();
        $this->assertEquals('topmiddle', $comic->posAbbrToFull('tm'));
    }

    public function testPosAbbrToFullTopRight()
    {
        $comic = new Comic();
        $this->assertEquals('topright', $comic->posAbbrToFull('tr'));
    }

    public function testPosAbbrToFullBottomLeft()
    {
        $comic = new Comic();
        $this->assertEquals('bottomleft', $comic->posAbbrToFull('bl'));
    }

    public function testPosAbbrToFullBottomMiddle()
    {
        $comic = new Comic();
        $this->assertEquals('bottommiddle', $comic->posAbbrToFull('bm'));
    }

    public function testPosAbbrToFullBottomRight()
    {
        $comic = new Comic();
        $this->assertEquals('bottomright', $comic->posAbbrToFull('br'));
    }
}
