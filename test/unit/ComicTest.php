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
use App\Lib\Storage;
use App\Lib\PanelGenerator;

use Mockery as m;
use PHPUnit\Framework\TestCase;

class ComicTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testGetAltTextForHtmlAttribute()
    {
        $comic = new Comic();
        $comic->setAltText('This is a "test"!');

        $this->assertEquals('This is a &quot;test&quot;!', $comic->getAltTextForHtmlAttribute());
    }

    public function testGetNumComics()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getPositionAbbrs')
            ->andReturn(['tl']);

        $storage->shouldReceive('getTotalComicsCount')
            ->andReturn(1000);

        $comic = new Comic($storage);

        $this->assertEquals(1000, $comic->getNumComics());
    }

    public function testGetNumComicPermutations()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getPositionAbbrs')
            ->andReturn(['tl']);

        $storage->shouldReceive('getTotalComicsCount')
            ->andReturn(5);

        $comic = new Comic($storage);

        $this->assertEquals('15,775', $comic->getNumComicPermutations());
    }

    public function testSetNumPanelWithValidNumber()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getPositionAbbrs')
            ->andReturn(['tl']);

        $comic = new Comic($storage);
        $comic->setNumPanels(6);
        
        $this->assertEquals(6, $comic->getNumPanels());
    }

    public function testSetNumPanelWithInvalidNumber()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getPositionAbbrs')
            ->andReturn(['tl']);

        $comic = new Comic($storage);
        $comic->setNumPanels(9);
        
        $this->assertEquals(3, $comic->getNumPanels());
    }

    public function testGetPositionAbbrs()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getPositionAbbrs')
            ->andReturn(['tl', 'tm', 'tr']);

        $comic = new Comic($storage);
        $this->assertEquals(['tl', 'tm', 'tr'], $comic->getPositionAbbrs());
    }

    public function testSetLockedPanels()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getPositionAbbrs')
            ->andReturn(['tl', 'tm', 'tr']);
        $storage->shouldReceive('posAbbrToFull')
            ->andReturnUsing(function ($pos) {
                if ($pos === 'tl') {
                    return 'topleft';
                }

                return 'topright';
            });

        $comic = new Comic($storage);
        $comic->setLockedPanels([
            ['pos' => 'tl', 'comic' => 1],
            ['pos' => 'tr', 'comic' => 2],
        ]);

        $expectedPanel = [
            'tl' => [
                'pos' => 'tl',
                'comic' => 1,
                'isLocked' => true,
                'filename' => 'comic2-1-topleft.png',
            ],
            'tr' => [
                'pos' => 'tr',
                'comic' => 2,
                'isLocked' => true,
                'filename' => 'comic2-2-topright.png',
            ],
        ];
        $panels = $comic->getPanels();
        $this->assertArraySubset($expectedPanel, $panels);
    }

    public function testGenerateRandomPanelsSetsComicNumber()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getPositionAbbrs')
            ->andReturn(['tl']);

        $panelGenerator = m::mock(PanelGenerator::class);
        $panelGenerator->shouldReceive('getRandomPanelForPosition')
            ->andReturn(['comic' => 1234, 'filename' => 'testfile.png']);

        $comic = new Comic($storage, $panelGenerator);
        $comic->generateRandomPanels();
 
        $panels = $comic->getPanels();
        $this->assertEquals(1234, $panels['tl']['comic']);
    }

    public function testGenerateRandomPanelsSetsFilename()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getPositionAbbrs')
            ->andReturn(['tl']);

        $panelGenerator = m::mock(PanelGenerator::class);
        $panelGenerator->shouldReceive('getRandomPanelForPosition')
            ->andReturn(['comic' => 1, 'filename' => 'testfile.png']);

        $comic = new Comic($storage, $panelGenerator);
        $comic->generateRandomPanels();
 
        $panels = $comic->getPanels();
        $this->assertEquals('testfile.png', $panels['tl']['filename']);
    }

    public function testGenerateRandomPanelsSkipsLockedPanel()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getPositionAbbrs')
            ->andReturn(['tl', 'tr']);
        $storage->shouldReceive('posAbbrToFull')
            ->andReturn('topleft');
 
        $panelGenerator = m::mock(PanelGenerator::class);
        $panelGenerator->shouldReceive('getRandomPanelForPosition')
            ->andReturn(['comic' => 99, 'filename' => 'testfile.png']);

        $comic = new Comic($storage, $panelGenerator);
        $comic->setLockedPanels([
            ['pos' => 'tl', 'comic' => 1],
        ])->generateRandomPanels();
 
        $panels = $comic->getPanels();
        $this->assertEquals(1, $panels['tl']['comic']);
    }

    public function testGetPermalinkThreePanels()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getPositionAbbrs')
            ->andReturn(['tl', 'tm', 'br']);
        $storage->shouldReceive('posAbbrToFull')
            ->andReturnUsing(function ($pos) {
                if ($pos === 'tl') {
                    return 'topleft';
                }

                if ($pos === 'tm') {
                    return 'topmiddle';
                }

                return 'bottomright';
            });

        $comic = new Comic($storage);
        $comic->setLockedPanels([
            ['pos' => 'tl', 'comic' => 1],
            ['pos' => 'tm', 'comic' => 2],
            ['pos' => 'br', 'comic' => 3],
        ]);

        $this->assertEquals('?tl=1&tm=2&br=3', $comic->getPermalink());
    }

    public function testGetPermalinkTwoPanels()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getPositionAbbrs')
            ->andReturn(['tl', 'tm', 'br']);
        $storage->shouldReceive('posAbbrToFull')
            ->andReturnUsing(function ($pos) {
                if ($pos === 'tl') {
                    return 'topleft';
                }

                return 'bottomright';
            });

        $comic = new Comic($storage);
        $comic->setNumPanels(2);
        $comic->setLockedPanels([
            ['pos' => 'tl', 'comic' => 1],
            ['pos' => 'br', 'comic' => 3],
        ]);

        $this->assertEquals('?tl=1&br=3&numpanels=2', $comic->getPermalink());
    }
}
