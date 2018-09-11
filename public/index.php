<?php
/*
 * This script will put together panels from a bunch
 * of Dinosaur Comics and make a new one!
 *
 * Copyright 2008-2017 Adam Goforth
 * Started on: 2008.04.18
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

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers;
use Http\Factory\Diactoros\ResponseFactory;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

$responseFactory = new ResponseFactory();

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$router = new Router();
$router->map('GET', '/', [new Controllers\Home(), 'index']);

// The group is not needed here, but it's a workaround for a bug in League Route
// where a strategy cannot be set on an individual route.
$router->group('/api', function ($router) {
        $router->map('GET', '/images/random', [new Controllers\Api\Images(), 'random']);
    })
    ->setStrategy(new JsonStrategy($responseFactory));

$response = $router->dispatch($request);

// send the response to the browser
(new SapiEmitter())->emit($response);
