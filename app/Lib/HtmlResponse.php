<?php
/*
 * Copyright 2018 Adam Goforth
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

namespace App\Lib;

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

class HtmlResponse
{
    public static function ok(string $body) : ResponseInterface
    {
        $response = new Response();
        $response->withStatus(200);
        $response->getBody()->write($body);
        return $response;
    }
}
