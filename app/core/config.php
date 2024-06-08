<?php

if($_SERVER['SERVER_NAME'] == 'localhost')
{
    define('DBNAME', 'CHEAPTHRILLS');
    define('DBHOST', 'localhost');
    define('DBUSER', 'postgres');
    define('DBPASS', 'hannahmae6154');
    // define('DBDRIVER', '');

    define('ROOT', 'http://localhost/cheapthrills/public');
    // define('ROOT', 'http://localhost/mvc/app');
} else {
    define('DBNAME', 'CHEAPTHRILLS');
    define('DBHOST', 'localhost');
    define('DBUSER', 'postgres');
    define('DBPASS', 'hannahmae6154');
    // define('DBDRIVER', '');

    define('ROOT', 'http://localhost/cheapthrills/public');
    define('ROOT', 'https://www.yourwebsite.com');
}