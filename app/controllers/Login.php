<?php

class Login extends Controller
{
    public function index()
    {
        $user = new User();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST;
            $user->login($data);
        }

        $data['errors'] = $user->errors;
        $this->view('login', $data);
    }
}
