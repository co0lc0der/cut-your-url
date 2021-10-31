<?php
error_reporting(E_ALL && E_NOTICE);       // устанавливает уровень отслеживаемых ошибок интерпретатором php
ini_set('display_errors', 1); // дает команду интерпретатору php выводить все отслеживаемые ошибки в браузере

define('SITE_NAME', "Cut your URL");
define('HOST', "http://{$_SERVER['HTTP_HOST']}"); // http сервер
// define('HOST', "http://{$_SERVER['HTTP_HOST']}/cut_your_url"); // если в подпапке cut_your_url
define('DB_HOST', "127.0.0.1"); // сервер БД
define('DB_NAME', "cut_url"); // имя БД
define('DB_USER', "root"); // логин к БД
define('DB_PASS', "4321"); // пароль к БД

define('URL_CHARS', 'abcdefghijklmnopqrstuvwxyz0123456789-');

session_start();
