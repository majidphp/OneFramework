# Framework

This is a very simple MVC model PHP application. You will able to run it via Docker as well.
This Framework supports Web URLS, Linux CLI application, Crons easily.

## Install 

- PHP 8
- Apache / Nginx
- Mysql / Postgresql / Oracle


To use this framework
- import `DB` files into database
- change database information in this file `Private/.env` and `Config/Database.php`
- make this folder `Views/template_c`
- change `Views/template_c` permition to 777
- run `composer install`
- using apache "http://YOUR_SERVER/"
- using php Built-in web server "php -S 0.0.0.0:80" OR "bash server.sh"

If you like to use Docker container ``` docker run -d --name=oneframework -p 80:80 majidphp/oneframework ```
OR use docker composer ``` docker-compose up -d ```


# Folder stracture #

Commands: put your php script, I can run them via CLI

Config: all defined variables

Controllers: Web app class files

Crons: put your cron files and modify Crons/index.php $crons array

Libs: user library files (Each one must be a folder)

Models: Classes connected to database

Private: put your env files or everythings you don't want show in web (protected by .htaccess file)

Public: put your public files that you want to share over website. (like static files)

System: Core system files

Views: put your template files (Oneframework uses Smarty as a template engine)