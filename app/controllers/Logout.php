<?php

class Logout extends Controller
{
    public function index()
    {        
        // session_start();
        session_unset();
        session_destroy();

        // $this->view('user/login');
        redirect('login');
    }
}
