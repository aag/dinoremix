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

use App\Lib\PanelGenerator;
use App\Lib\Storage;

use Mockery as m;
use PHPUnit\Framework\TestCase;

class PanelGeneratorTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testGetRandomPanelsForNoPositions()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldNotReceive('getRandomImageForPos');

        $panelGenerator = new PanelGenerator($storage);
        $panels = $panelGenerator->getRandomPanelsForPositions([]);
        $this->assertEmpty($panels);
    }

    public function testGetRandomPanelsNoFiles()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getRandomImageForPos')
            ->andReturn([]);

        $panelGenerator = new PanelGenerator($storage);
        $panels = $panelGenerator->getRandomPanelsForPositions(['tl']);
        $this->assertEmpty($panels);
    }

    public function testGetRandomPanelsOnePanel()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getRandomImageForPos')
            ->andReturn('testfile.png');

        $panelGenerator = new PanelGenerator($storage);
        $panels = $panelGenerator->getRandomPanelsForPositions(['tl']);
        $panelInfo = ['pos' => 'tl', 'file' => 'testfile.png'];
        $this->assertEquals([$panelInfo], $panels);
    }

    public function testGetRandomPanelsThreePanels()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getRandomImageForPos')
            ->andReturn('testfile_tl.png', 'testfile_tr.png', 'testfile_bm.png');

        $panelGenerator = new PanelGenerator($storage);
        $panels = $panelGenerator->getRandomPanelsForPositions(['tl', 'tr', 'bm']);
        $panelInfo = [
            ['pos' => 'tl', 'file' => 'testfile_tl.png'],
            ['pos' => 'tr', 'file' => 'testfile_tr.png'],
            ['pos' => 'bm', 'file' => 'testfile_bm.png']
        ];
        $this->assertEquals($panelInfo, $panels);
    }
}
