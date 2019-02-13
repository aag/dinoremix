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

use App\Lib\PanelGenerator;
use App\Lib\Storage;

use Mockery as m;
use PHPUnit\Framework\TestCase;

class PanelGeneratorTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    public function testGetRandomPanels()
    {
        $storage = m::mock(Storage::class);
        $storage->shouldReceive('getRandomImageForPos')
            ->andReturnUsing(function ($pos) {
                return "comic2-100-$pos-a-$pos.png";
            });

        $panelGenerator = new PanelGenerator($storage);
        $panels = $panelGenerator->getRandomPanels();
        $panelInfo = [
            ['pos' => 'tl', 'id' => '100-tl-a'],
            ['pos' => 'tm', 'id' => '100-tm-a'],
            ['pos' => 'tr', 'id' => '100-tr-a'],
            ['pos' => 'bl', 'id' => '100-bl-a'],
            ['pos' => 'bm', 'id' => '100-bm-a'],
            ['pos' => 'br', 'id' => '100-br-a'],
        ];
        $this->assertEquals($panelInfo, $panels);
    }
}
