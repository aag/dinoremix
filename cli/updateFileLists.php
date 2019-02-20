<?php
/* A PHP script to get the list of files in the panels directories,
 * put them in arrays, and serialize them to disk.
 * When other scripts need a file list, they will unserialize these
 * files, instead of doing a directory listing.  This gives a 3-4x
 * speedup.
 *
 * Copyright 2008-2018 Adam Goforth
 * Started on: 2008.07.31
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

use App\Lib\Comic;

print("Rewriting image path files\n");

$comic = new Comic();
$comic->storeAllImagePaths();
