<?php
error_reporting(E_ALL && E_NOTICE);       // устанавливает уровень отслеживаемых ошибок интерпретатором php
ini_set('display_errors', 1); // дает команду интерпретатору php выводить все отслеживаемые ошибки в браузере

define('SITE_NAME', "Cut your URL");
define('HOST', "http://{$_SERVER['HTTP_HOST']}"); // http сервер
define('DB_HOST', "127.0.0.1"); // сервер БД
define('DB_NAME', "red"); // имя БД
define('DB_USER', "root"); // логин к БД
define('DB_PASS', "4321"); // пароль к БД

session_start();
