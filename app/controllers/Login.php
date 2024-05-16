<?php

class Login extends Controller
{
    public function index()
    {
        $user = new User;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST;
            $user->login($_POST);
        }

        $data['errors'] = $user->errors;
        $this->view('user/login', $data);
    }
}
