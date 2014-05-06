Bacula Status - Monitor your backups
============


Tool developed to monitor the backups made by bacula. The goal is to provide a clear view of your backups in one tool for easy installation.

> Developed in PHP, using the framework Symfony 2 and Netbeans IDE 8.
>
> Supports English (EN) and Brazilian Portuguese (PT_BR) languages.


####Screenshots
[baculastatus album](https://plus.google.com/photos/109969415199973437597/albums/6008162396758304289)


Requeriments:
============
- Apache
- PHP 5.x
- Enabled php-intl extension
- Connection data of bacula database


Installation 
============
1) Set the default timezone in php.ini 

2) Unzip the package within your web server (eg: /var/www/html/) 

3) write permission for the user apache in baculastatus/app/cache 
   directory (eg /var/www/html/baculastatus/app/cache). 

4) write permission for the user apache in baculastatus/app/log directory 
   (eg /var/www/html/baculastatus/app/log). 

5) Delete everything you have within the directory "baculastatus/app/cache"

6) In the file "baculastatus/app/config/parameters.yml" configure your database
   data connection, locale and date_format variables.

7) Point your browser to the address http://yourserver/baculastatus/