<?php

if($_SERVER['SERVER_NAME'] == 'localhost')
{
    define('DBNAME', 'bookhaven');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', 'hannahmae615');
    // define('DBDRIVER', '');

    define('ROOT', 'http://localhost/bookhaven/public');
    // define('ROOT', 'http://localhost/bookhaven/app');
} else {
    define('DBNAME', 'bookhaven');
    define('DBNHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', 'hannahmae615');
    // define('DBDRIVER', '');

    define('ROOT', 'http://localhost/bookhaven/public');
    define('ROOT', 'https://www.yourwebsite.com');
}