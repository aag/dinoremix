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
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Home {
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $queryParams = $request->getQueryParams();

        // Get permutation information
        $numComics = Util::countComics();
        $numPerms = number_format(
            pow($numComics, 6) +
                pow($numComics, 3) +
                pow($numComics, 2)
        );

        $lockClasses = array();
        $imgFileNames = array();
        $posAbbrs = array(0 => "tl", "tm", "tr", "bl", "bm", "br");
        $altText = "";

        // Check each panel to see if it's locked
        foreach ($posAbbrs as $key => $pos) {
            $fullName = Util::posAbbrToFull($pos);
            if (isset($queryParams[$pos])) {
                // Panel is locked
                $imgFileNames[$pos] = "comic2-" . $queryParams[$pos] . "-" . $fullName . ".png";
                $lockClasses[$pos] = "locked";
            } else {
                // Panel is unlocked
                $imgFileNames[$pos] = Util::getRandomImageForPos($pos);
                $lockClasses[$pos] = "unlocked";
            }
        }

        // Get the alt text for the panels
        $outAltText = "";
        if (isset($queryParams['alt'])) {
            $altText = stripslashes($queryParams['alt']);
            $linkAltText = rawurlencode($altText);
            $outAltText = htmlspecialchars($altText);
        }

        // Just take the current URL as the permalink, even if it's invalid
        $permaLink = (string) $request->getUriFromGlobals();

        $pageContent = Util::renderTemplate('pagetemplate', [
            'imgFileNames' => $imgFileNames,
            'lockClasses' => $lockClasses,
            'numComics' => $numComics,
            'numPerms' => $numPerms,
            'outAltText' => $outAltText,
            'permaLink' => $permaLink
        ]);

        $response->getBody()->write($pageContent);
        return $response;
    }
}
