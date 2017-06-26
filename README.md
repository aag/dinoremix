Dinosaur Remix
==============

Dinosaur Remix is a web page that takes Dinosaur Comics and remixes them randomly, hopefully in interesting ways.  It uses PHP, Python, and jQuery to do its remix-o-matic dance.

You can see it here:
http://definingterms.com/dinoremix/


Using
-----
If you want to host your own Dinosaur Remix page, just get a copy of the source and point your web server to the `public` directory.  Make sure your web server is set up to run PHP scripts from this directory and that unknown URLs will be redirected to `index.php`.  In nginx you can do so with this config snippet:

```
location / {
    try_files $uri $uri/ /index.php;
}
```

Before the site will work, you will need to run `./composer.phar install` from the command line within the root directory of the repository.

Then, run "python downloadComics.py" to download the comics from the Dinosaur Comics site and divide them into panels.  You can set up a cron job to do this daily if you want it to always be up-to-date.

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

License
-------
This code is free software licensed under the GPL 2. See the [LICENSE.md](LICENSE.md) file for details.
