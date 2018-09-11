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

namespace App\Controllers\Api;

use App\Lib\HttpResponse;
use App\Lib\PanelGenerator;
use League\Route\Http\Exception\BadRequestException;
use Psr\Http\Message\ServerRequestInterface;

class Images
{
    private $panelGenerator;

    public function __construct(PanelGenerator $panelGenerator = null)
    {
        if (is_null($panelGenerator)) {
            $panelGenerator = new PanelGenerator();
        }

        $this->panelGenerator = $panelGenerator;
    }

    public function random(ServerRequestInterface $request) : array
    {
        $queryParams = $request->getQueryParams();
        if (!isset($queryParams["pos"])) {
            throw new BadRequestException();
        }

        $posList = explode("-", $queryParams["pos"]);
        $panels = $this->panelGenerator->getRandomPanelsForPositions($posList);

        return $panels;
    }
}
