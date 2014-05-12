## Mochi!

Salon software without all the fluff

**Todo**

[Trello Board](https://trello.com/b/e0TNcak3/mochi)

# Setting up a local environment

## OSX
1. Add /usr/sbin to your path:
* Create or edit a ~/.profile file: `pico ~/.profile`
* Add this line: export PATH='/usr/local/bin:/usr/bin:/bin:/sbin:/usr/sbin'
* Save your profile file
* Reload it in all active terminals: `source ~/.profile`


### Apache

1. Enable Apache `sudo apachectl start`
2. Grab the mochi repo (for example: /Users/dickason/code/mochi-php)
4. Edit your config file: `sudo pico /etc/apache2/httpd.conf`
* set `DocumentRoot` to `DocumentRoot "/Users/dickason/code/mochi-php/document_root"`
* set `ServerName` to `ServerName localhost:80`
5. Restart apache: `sudo apachectl restart`
6. Visit http://localhost:80 to make sure it works.

*If not, use this command to debug: `sudo bash -x /usr/sbin/apachectl -k restart`*


### PHP

1. Uncomment this line: `LoadModule php5_module libexec/apache2/libphp5.so`
2. Verify that it works by creating a temporary php info file:
* Create the file from your www directory: `echo "<?php phpinfo(); ?>" > test.php`
* Load test.php in your browser: http://localhost/test.php
* Remove the file from your www directory: `rm -rf test.php`


### MySQL

1. Download the OSX DMG: http://dev.mysql.com/downloads/mysql/
2. Create a link to the mysql executable: `sudo ln -s /usr/local/mysql/bin/mysql /usr/sbin/mysql`
3. Verify that it works: `sudo mysql`
4. Add the user 'mochi': `CREATE USER 'mochi'@'localhost' IDENTIFIED BY '<PASSWORD>';`
5. Create database 'mochi': `CREATE DATABASE mochi`
6. Switch to database 'mochi': `use mochi`
7. Grant the user mochi privileges: `GRANT ALL PRIVILEGES ON *.* to mochi;`
8. Import the snapshot for testing: `source snapshot.sql`


### Nette

1. Make the `temp` directory writeable: `chmod 777 app/temp`
2. Access the site!: http://localhost:80/
