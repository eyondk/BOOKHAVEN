<?php

class App 
{
    private $controller = 'Login';
	private $method 	= 'index';

    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'login';
        $URL = explode("/", $URL);
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitURL();

        $filename = "../app/controllers/".ucfirst($URL[0]).".php";
        $filenameAdmin = "../app/controllers/admin/".ucfirst($URL[0]).".php";
        $filenameSuperAdmin = "../app/controllers/superadmin/".ucfirst($URL[0]).".php";

        if (file_exists($filename)) 
        {
            require $filename;
            $this->controller = ucfirst($URL[0]);
        } else if (file_exists($filenameAdmin)) {
            require $filenameAdmin;
            $this->controller = ucfirst($URL[0]);
            
        } else if (file_exists($filenameSuperAdmin)){
            require $filenameSuperAdmin;
            $this->controller = ucfirst($URL[0]);

        } else {
            $filename404 = "../app/controllers/_404.php";
            require $filename404;
            $this->controller = "_404";
        }

        $controller = new $this->controller;
        call_user_func_array([$controller, $this->method], []);
    }

}