<?php

define('SITE_NAME', 'WebForYou');
define('HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/microblog'); //адрес нашего сайта, по ключу 'HTTP_HOST' в ассоциативном массиве $_SERVER находится наш домен
define('DB_HOST', 'localhost'); //компьютер, на котором расположены наши базы данных
define('DB_NAME', 'microblog'); //название базы данных
define('DB_USER', 'root'); //пользователь под именем которого можно подключиться к серверу баз данных
define('DB_PASS', 'root'); //пароль для подключения к базе данных

session_start();

// $error = $_SESSION['error'];