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

namespace Test\Unit;

use App\Lib\Comic;
use App\Lib\Storage;
use App\Lib\PanelGenerator;

use Mockery as m;
use PHPUnit\Framework\TestCase;

class ComicTest extends TestCase
{
    private $storageMock;
    private $panelGeneratorMock;

    // Sets up mocks with reasonable defaults
    public function setUp(): void
    {
        $this->storageMock = m::mock(Storage::class);
        $this->storageMock->shouldReceive('getPositionAbbrs')
            ->andReturn(['tl', 'tm', 'br']);

        $this->storageMock->shouldReceive('getTotalComicsCount')
            ->andReturn(100);

        $this->storageMock->shouldReceive('posAbbrToFull')
            ->andReturnUsing(function ($pos) {
                switch ($pos) {
                    case 'tl':
                        return 'topleft';
                    case 'tm':
                        return 'topmiddle';
                    case 'br':
                    default:
                        return 'bottomright';
                }
            });


        $this->panelGeneratorMock = m::mock(PanelGenerator::class);
        $this->panelGeneratorMock->shouldReceive('getRandomPanelForPosition')
            ->andReturnUsing(function ($pos) {
                $id = rand(1, 5000);
                return ['comic' => $id, 'filename' => "comic2-$id-$pos.png"];
            });
    }

    public function tearDown(): void
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
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);
        $this->assertEquals(100, $comic->getNumComics());
    }

    public function testGetNumComicPermutations()
    {
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);

        $this->assertEquals('1,000,001,010,000', $comic->getNumComicPermutations());
    }

    public function testSetNumPanelWithValidNumber()
    {
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);
        $comic->setNumPanels(6);
        
        $this->assertEquals(6, $comic->getNumPanels());
    }

    public function testSetNumPanelWithInvalidNumber()
    {
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);
        $comic->setNumPanels(9);
        
        $this->assertEquals(3, $comic->getNumPanels());
    }

    public function testGetPositionAbbrs()
    {
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);
        $this->assertEquals(['tl', 'tm', 'br'], $comic->getPositionAbbrs());
    }

    public function testSetLockedPanels()
    {
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);
        $comic->setLockedPanels([
            ['pos' => 'tl', 'comic' => 1],
            ['pos' => 'tm', 'comic' => 2],
        ]);

        $expectedPanel = [
            'tl' => [
                'pos' => 'tl',
                'comic' => 1,
                'isLocked' => true,
                'filename' => 'comic2-1-topleft.png',
            ],
            'tm' => [
                'pos' => 'tm',
                'comic' => 2,
                'isLocked' => true,
                'filename' => 'comic2-2-topmiddle.png',
            ],
        ];
        $panels = $comic->getPanels();
        $this->assertEquals($expectedPanel['tl'], $panels['tl']);
        $this->assertEquals($expectedPanel['tm'], $panels['tm']);
    }

    public function testGenerateRandomPanelsSetsComicNumber()
    {
        $panelGenerator = m::mock(PanelGenerator::class);
        $panelGenerator->shouldReceive('getRandomPanelForPosition')
            ->andReturn(['comic' => '1234', 'filename' => 'testfile.png']);

        $comic = new Comic($this->storageMock, $panelGenerator);
        $comic->generateRandomPanels();
 
        $panels = $comic->getPanels();
        $this->assertEquals('1234', $panels['tl']['comic']);
    }

    public function testGenerateRandomPanelsSetsFilename()
    {
        $panelGenerator = m::mock(PanelGenerator::class);
        $panelGenerator->shouldReceive('getRandomPanelForPosition')
            ->andReturn(['comic' => '1', 'filename' => 'testfile.png']);

        $comic = new Comic($this->storageMock, $panelGenerator);
        $comic->generateRandomPanels();
 
        $panels = $comic->getPanels();
        $this->assertEquals('testfile.png', $panels['tl']['filename']);
    }

    public function testGenerateRandomPanelsSkipsLockedPanel()
    {
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);
        $comic->setLockedPanels([
            ['pos' => 'tl', 'comic' => '1'],
        ])->generateRandomPanels();
 
        $panels = $comic->getPanels();
        $this->assertEquals('1', $panels['tl']['comic']);
    }

    public function testGetPermalinkThreePanels()
    {
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);
        $comic->setLockedPanels([
            ['pos' => 'tl', 'comic' => '1'],
            ['pos' => 'tm', 'comic' => '2'],
            ['pos' => 'br', 'comic' => '3'],
        ]);

        $this->assertEquals('?tl=1&tm=2&br=3', $comic->getPermalink());
    }

    public function testGetPermalinkTwoPanels()
    {
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);
        $comic->setNumPanels(2);
        $comic->setLockedPanels([
            ['pos' => 'tl', 'comic' => '1'],
            ['pos' => 'br', 'comic' => '3'],
        ]);

        $this->assertEquals('?tl=1&br=3&numpanels=2', $comic->getPermalink());
    }

    public function testGetJsBootstrapContainsNumPanels()
    {
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);
        $comic->setNumPanels(2);

        $this->assertEquals(2, $comic->getJsBootstrap()['initialComic']['numPanels']);
    }

    public function testGetJsBootstrapContainsLockedPanels()
    {
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);
        $comic->setLockedPanels([
            ['pos' => 'tl', 'comic' => '101'],
            ['pos' => 'br', 'comic' => '102'],
        ]);

        $this->assertEquals(['tl', 'br'], $comic->getJsBootstrap()['initialComic']['lockedPanels']);
    }

    public function testGetJsBootstrapContainsPanels()
    {
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);
        $comic->setLockedPanels([
            ['pos' => 'tl', 'comic' => '101'],
            ['pos' => 'tm', 'comic' => '102'],
            ['pos' => 'br', 'comic' => '103'],
        ]);

        $expectedPanels = [
            'tl' => '101',
            'tm' => '102',
            'br' => '103',
        ];
        $this->assertEquals($expectedPanels, $comic->getJsBootstrap()['initialComic']['panels']);
    }

    public function testGetJsBootstrapContainsNextPanels()
    {
        // Note: the storageMock only returns 3 panel positions
        $comic = new Comic($this->storageMock, $this->panelGeneratorMock);

        $nextPanels = $comic->getJsBootstrap()['nextPanels'];
        $this->assertEquals(3, count($nextPanels));
        $this->assertArrayHasKey('tl', $nextPanels);
        $this->assertStringMatchesFormat('%d', $nextPanels['tl']);

        $this->assertArrayHasKey('tm', $nextPanels);
        $this->assertStringMatchesFormat('%d', $nextPanels['tm']);

        $this->assertArrayHasKey('br', $nextPanels);
        $this->assertStringMatchesFormat('%d', $nextPanels['br']);
    }
}
