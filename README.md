## Dinosaur Remix [![Build Status](https://github.com/aag/dinoremix/actions/workflows/ci.yml/badge.svg)](https://github.com/aag/dinoremix/actions) [![License](https://img.shields.io/badge/License-GPLv2-blue.svg)](LICENSE.md)

Dinosaur Remix is a web page that takes Dinosaur Comics and remixes them randomly, hopefully in interesting ways.  It uses PHP, Python, and MithrilJS to do its remix-o-matic dance.

You can see it here:
http://dinoremix.definingterms.com/


### Using

If you want to host your own Dinosaur Remix page, just get a copy of the source and point your web server to the `public` directory.  Make sure your web server is set up to run PHP scripts from this directory and that unknown URLs will be redirected to `index.php`.  In nginx you can do so with this config snippet:

```
location / {
    try_files $uri $uri/ /index.php$is_args$args;
}
```

The file dinoremix.local is an example nginx configuration file for local
development.  Copy it to `/etc/nginx/sites-available` and customize the paths
in the file for your environment. Then create a softlink to it with the command

```sh
sudo ln -s /etc/nginx/sites-available/dinoremix.local /etc/nginx/sites-enabled/dinoremix.local
```

Add dinoremix.local to your hosts file and then restart nginx.

Before the site will work, you will need to run `./composer.phar install --no-dev` from the command line within the root directory of the repository.

Then, run `python cli/downloadComics.py` to download the comics from the Dinosaur Comics site and divide them into panels.  You can set up a cron job to do this daily if you want it to always be up-to-date.

### Requirements

The code requires PHP 8.1+ and Python 3.

The Python scripts require the Pillow and BeautifulSoup modules. Both of these
can be installed with pip:

```sh
pip install -r requirements.txt
```

### Deploying

A deploy script is already set up to use [Deployer](http://deployer.org/), but
you will need to customize it for your server. First, edit `deploy.php` and
change the `server()` details. Once you have customized the configuration,
run this command to deploy:

```
$ php deployer.phar deploy production
```

### Development

#### Backend

The PHP extensions `dom`, `simplexml`, and `mbstring` are required for the 
development scripts. After installing them, you should run
`php composer.phar install`.

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

#### Frontend

The frontend code is based on [MithrilJS](https://mithril.js.org/) and
[Sass](http://sass-lang.com/). Before running, you need to install the required
NPM packages and build the assets.

```sh
npm install
npm run build
```

During development it's helpful to have a watcher rebuild the assets whenever
they change. You can start the watcher with `npm start`.

The frontend code is written to comply with the
[AirBnB JavaScript Style](https://github.com/airbnb/javascript) and the
[Standard CSS](https://github.com/stylelint/stylelint-config-standard) for
stylelint (with a couple of exceptions). Both of these can be automatically
checked by running this command:

```sh
npm run check-style
```

There are Javascript tests written using
[ospec](https://github.com/MithrilJS/mithril.js/tree/master/ospec). You can
run them with this command:

```sh
npm test
```

### License

This code is free software licensed under the GPL 2. See the [LICENSE.md](LICENSE.md) file for details.

### Assets

This repository includes icons from the [Silk Icon Set](http://www.famfamfam.com/lab/icons/silk/).

