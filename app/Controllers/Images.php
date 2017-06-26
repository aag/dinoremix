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

namespace App\Controllers;

use App\Lib\Util;
use League\Route\Http\Exception\BadRequestException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Images {
    public function random(ServerRequestInterface $request, ResponseInterface $response)
    {
        $postData = $request->getParsedBody();
        if (!isset($postData["pos"])) {
            throw new BadRequestException();
        }

        $posList = explode("-", $postData["pos"]);
        $imgDescList = array();

        foreach ($posList as $pos) {
            $posdir = Util::posAbbrToFull($pos);
            if ($posdir != "") {
                $imgFileName = Util::getRandomImageForPos($pos);
                $imgDesc = array("pos" => $pos, "file" => $imgFileName);
                $imgDescList[] = $imgDesc;
            }
        }
        $response->getBody()->write(json_encode($imgDescList));
        return $response->withStatus(200);
    }
}
