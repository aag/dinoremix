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

require __DIR__ . '/../app/globals.php';
require ROOT_DIR . '/vendor/autoload.php';

use App\Controllers;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;
use League\Container\Container;
use League\Route\RouteCollection;
use League\Route\Strategy\JsonStrategy;

$container = new Container();

$container->share('response', Response::class);
$container->share('request', function () {
    return ServerRequestFactory::fromGlobals(
        $_SERVER,
        $_GET,
        $_POST,
        $_COOKIE,
        $_FILES
    );
});
$container->share('emitter', SapiEmitter::class);

$route = new RouteCollection($container);

$route->map('GET', '/', [new Controllers\Home(), 'index']);
$route->map('GET', '/images/random', [new Controllers\Images(), 'random'])
    ->setStrategy(new JsonStrategy);

$response = $route->dispatch($container->get('request'), $container->get('response'));
$container->get('emitter')->emit($response);
