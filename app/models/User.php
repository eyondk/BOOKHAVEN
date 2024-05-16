<?php

class User extends Model
{
    // protected $table = 'user';

    // protected $allowedColumns = [
    //     'CUS_FNAME',
    //     'CUS_LNAME',
    //     'CUS_ADDRESS',
    //     'CUS_CONTACT_NUM',
    //     'CUS_EMAIL',
    //     'CUS_PASS'
    // ];

    public function validate_signup($data) {
        $this->errors = [];

        if (empty($data['fname'])) {
            $this->errors['fname'] = "Firstname is required.";
        }

        if (empty($data['lname'])) {
            $this->errors['lname'] = "Lastname is required.";
        }

        if (empty($data['address'])) {
            $this->errors['address'] = "Address is required.";
        }

        if (empty($data['contact_num'])) {
            $this->errors['contact_num'] = "Contact number is required.";
        }

        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required.";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";            
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required.";
        } else if (strlen($data['password']) < 8) {
            $this->errors['password'] = "Password must be at least 8 characters long.";
        }

        if (empty($data['cpassword'])) {
            $this->errors['cpassword'] = "Confirm your password.";
        } else if ($data['password'] != $data['cpassword']) {
            $this->errors['confirm'] = "Password does not match.";
        }

        $conn = $this->openConnection();
        $select = $conn->prepare("SELECT * FROM user WHERE CUS_EMAIL = ?");
        $select->execute([$data['email']]);
        if ($select->rowCount() > 0) {
            $this->errors['email'] = 'User email already exists!';
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function validate_change_pass($data, $user_id) {
        $this->errors = [];
    
        $data = array_merge(['c_pass' => '', 'n_pass' => '', 'cpass' => ''], $data);
    
        $conn = $this->openConnection();
        $select = $conn->prepare("SELECT CUS_PASS FROM user WHERE CUS_ID = ?");
        $select->execute([$user_id]);
        $user = $select->fetch(PDO::FETCH_ASSOC);
    
        $current_hashed_password = $user['CUS_PASS'];
        $c_password = md5($data['c_pass']);
    
        if (empty($data['c_pass']) || (empty($data['n_pass'])) || empty($data['cpass'])) {
            $this->errors['c_pass'] = "All fields are required.";
        } elseif ($c_password != $current_hashed_password) {
            $this->errors['c_pass'] = "Current password is incorrect.";
        }
    
        if (strlen($data['n_pass']) < 8) {
            $this->errors['n_pass'] = "New password must be at least 8 characters long.";
        }
    
        if ($data['n_pass'] !== $data['cpass']) {
            $this->errors['cpass'] = "New password and confirmation password do not match.";
        }
    
        if (empty($this->errors)) {
            return true;
        }
        
        // show($user);
        // show($c_password);
        // show($data['n_pass']);
        // show($data['cpass']);
        return false;
    }

    public function getUserById($user_id) {
        $conn = $this->openConnection();

        $select = $conn->prepare("SELECT * FROM user WHERE CUS_ID = ?");
        $select->execute([$user_id]);
        $userData = $select->fetch(PDO::FETCH_ASSOC);

        return $userData;
    }
}
