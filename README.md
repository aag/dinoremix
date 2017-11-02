## Dinosaur Remix [![Build Status](https://travis-ci.org/aag/dinoremix.svg?branch=master)](https://travis-ci.org/aag/dinoremix) [![License](https://img.shields.io/badge/License-GPLv2-blue.svg)](LICENSE.md)

Dinosaur Remix is a web page that takes Dinosaur Comics and remixes them randomly, hopefully in interesting ways.  It uses PHP, Python, and jQuery to do its remix-o-matic dance.

You can see it here:
http://dinoremix.definingterms.com/


### Using

If you want to host your own Dinosaur Remix page, just get a copy of the source and point your web server to the `public` directory.  Make sure your web server is set up to run PHP scripts from this directory and that unknown URLs will be redirected to `index.php`.  In nginx you can do so with this config snippet:

```
location / {
    try_files $uri $uri/ /index.php$is_args$args;
}
```

Before the site will work, you will need to run `./composer.phar install --no-dev` from the command line within the root directory of the repository.

Then, run `python cli/downloadComics.py` to download the comics from the Dinosaur Comics site and divide them into panels.  You can set up a cron job to do this daily if you want it to always be up-to-date.

### Requirements

The code requires PHP 7.0+ and Python 2.7 or 3.


The Python scripts require the Python Image Library module. On Ubuntu systems, you can install the module with this console command:

```sh
sudo apt-get install python2.7-pil
```

Or, for Python 3:

```sh
sudo apt-get install python3-pil
```

The BeautifulSoup module is also required. It can be installed with pip:

```sh
sudo pip install beautifulsoup
```

### Deploying

A deploy script is already set up to use [Deployer](http://deployer.org/), but
you will need to customize it for your server. First, edit `deploy.php` and
change the `server()` details and the `cron_user` setting. The `cron_user`
is the user on the server that will run the `cli/downloadComics.py` script.
Once you have customized the configuration, run this command to deploy:

```
$ php deployer.phar deploy production
```

### Development

The PHP extensions `dom` and `simplexml` are required for the development
scripts. After installing them, you should run `php composer.phar install`.

The PHP code is written to comply with [PSR1](http://www.php-fig.org/psr/psr-1/)
and [PSR2](http://www.php-fig.org/psr/psr-2/). A composer script to verify
the conformance to those style guides with PHP\_CodeSniffer can be run with:

```sh
php composer.phar check-style
```

If there are any problems that can be fixed automatically by PHPCBF, you can
fix them with this command:

```sh
php composer.phar fix-style
```

There are automated tests in the `test` directory. They can be run with this
command:

```sh
php composer.phar test
```

### License

This code is free software licensed under the GPL 2. See the [LICENSE.md](LICENSE.md) file for details.
