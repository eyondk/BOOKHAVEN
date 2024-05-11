<?php

if($_SERVER['SERVER_NAME'] == 'localhost')
{
    define('ROOT', 'http://localhost/bookhaven/public');
    // define('ROOT', 'http://localhost/bookhaven/app');
} else {
    define('ROOT', 'http://localhost/bookhaven/public');
    define('ROOT', 'https://www.yourwebsite.com');
}