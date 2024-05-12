<?php

spl_autoload_register(function($classname){
    require $filname = "../app/models/".ucfirst($classname).".php";
});

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Contoller.php';
require 'App.php';