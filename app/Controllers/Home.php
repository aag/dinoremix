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

namespace App\Controllers;

use App\Lib\AssetManager;
use App\Lib\Comic;
use App\Lib\HtmlResponse;
use App\Lib\Renderer;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Home
{
    private $assetManager;
    private $comic;
    private $renderer;

    public function __construct(
        AssetManager $assetManager = null,
        Comic $comic = null,
        Renderer $renderer = null
    ) {
        if (is_null($assetManager)) {
            $assetManager = new AssetManager();
        }

        if (is_null($comic)) {
            $comic = new Comic();
        }
 
        if (is_null($renderer)) {
            $renderer = new Renderer();
        }

        $this->assetManager = $assetManager;
        $this->comic = $comic;
        $this->renderer = $renderer;
    }

    private function createLockedPanelInfo(array $queryParams)
    {
        $lockedPanels = [];

        $posAbbrs = $this->comic->getPositionAbbrs();
        foreach ($posAbbrs as $pos) {
            if (isset($queryParams[$pos])) {
                $lockedPanels[] = [
                    'pos' => $pos,
                    'comic' => $queryParams[$pos],
                ];
            }
        }
 
        return $lockedPanels;
    }

    private function createImageFilenames(array $panels)
    {
        return array_map(function ($panel) {
            return $panel['filename'];
        }, $panels);
    }

    private function createPanelLockClasses(array $panels)
    {
        return array_map(function ($panel) {
            return $panel['isLocked'] ? 'locked' : 'unlocked';
        }, $panels);
    }

    public function index(ServerRequestInterface $request) : ResponseInterface
    {
        $queryParams = $request->getQueryParams();

        $this->comic->setLockedPanels($this->createLockedPanelInfo($queryParams));

        if (isset($queryParams['alt'])) {
            $this->comic->setAltText($queryParams['alt']);
        }

        if (isset($queryParams['numpanels'])) {
            $queryNumPanels = intval($queryParams['numpanels'], 10);
            $this->comic->setNumPanels($queryNumPanels);
        }

        $this->comic->generateRandomPanels();
        $panels = $this->comic->getPanels();

        $pageContent = $this->renderer->renderTemplate('pagetemplate', [
            'assets' => $this->assetManager,
            'imgFileNames' => $this->createImageFilenames($panels),
            'lockClasses' => $this->createPanelLockClasses($panels),
            'numComics' => $this->comic->getNumComics(),
            'numPanels' => $this->comic->getNumPanels(),
            'numPerms' => $this->comic->getNumComicPermutations(),
            'outAltText' => $this->comic->getAltTextForHtmlAttribute(),
            'permaLink' => $this->comic->getPermalink(),
            'permaLink2Panels' => $this->comic->getPermalink(2),
            'permaLink3Panels' => $this->comic->getPermalink(3),
            'permaLink6Panels' => $this->comic->getPermalink(6),
            'reloadUri' => $this->comic->getReloadUri(),
        ]);

        return HtmlResponse::ok($pageContent);
    }
}
