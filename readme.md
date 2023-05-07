# Framework
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
