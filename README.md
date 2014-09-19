#Bacula Status - Monitor your backups
- - - - 


Tool developed to monitor the backups made by bacula. The goal is to provide a clear view of your backups in one tool for easy installation.

> Developed in PHP, using the framework Symfony 2 and Netbeans IDE 8.
>
> Supports English (EN) and Brazilian Portuguese (PT_BR) languages.


####Screenshots
[baculastatus album](https://plus.google.com/photos/109969415199973437597/albums/6008162396758304289)

- - - - 
### Requirements:

- Apache
- PHP 5.x
- php-pdo
- php-mysql (or php-pgsql) 
- php-xml
- Connection data of bacula database

- - - - 
### Installation 

1) Set the default timezone in php.ini 

2) Unzip the package within your web server (eg: /var/www/html/) 

3) write permission for the user apache in baculastatus/app/cache 
   directory (eg /var/www/html/baculastatus/app/cache). 

4) write permission for the user apache in baculastatus/app/log directory 
   (eg /var/www/html/baculastatus/app/log). 

5) Delete everything you have within the directory "baculastatus/app/cache"

6) In the file "baculastatus/app/config/parameters.yml" configure your database
   data connection, locale variables.

7) Configure your date format on parameters: "date_format_php" and "date_format_js". 
   
   >Heads up! Both parameters must be in the same format, changing only the mask of 
   >each according to the documentation below:
   >
   >date_format_php: http://php.net/manual/en/function.date.php
   >date_format_js: http://momentjs.com/docs/#/parsing/string-format/
    

8) Point your browser to the address *http://yourserver/baculastatus/*

- - - - 
### Updating

1) Unzip the package within your web server (eg: /var/www/html/) 

2) Delete everything you have within the directory "baculastatus/app/cache"

3) In the file "baculastatus/app/config/parameters.yml" configure your database
   data connection, locale variables.

4) Configure your date format on parameters: <strong>"date_format_php"</strong> and <strong>"date_format_js"</strong>. 
   Heads up! Both parameters must be in the same format, changing only the mask of 
   each according to the documentation below:

   date_format_php: http://php.net/manual/en/function.date.php
   date_format_js: http://momentjs.com/docs/#/parsing/string-format/
