<?php

class Signup extends Controller
{
    public function index()
    {        
        $user = new User;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST;
            $user->validate_signup($data);
            $user->insert_user($data);
        }

        $data['errors'] = $user->errors;
        $this->view('user/signup', $data);
    }
}
