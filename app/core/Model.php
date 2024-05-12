<?php

class Model extends Database{

    public $errors 		= [];

    public function insert_user ($data) {
        $conn = $this->openConnection();
        $user = new User;
        
        if ($user->validate($data)) {
            try {
                $insert = "INSERT INTO user (CUS_FNAME, CUS_LNAME, CUS_ADDRESS, CUS_CONTACT_NUM, CUS_EMAIL, CUS_PASS) 
                            VALUES(:fname, :lname, :address, :contact_num, :email, :pass)";
                $stmt = $conn->prepare($insert);

                $stmt->bindParam(':fname', $data['fname']);
                $stmt->bindParam(':lname', $data['lname']);
                $stmt->bindParam(':address', $data['address']);
                $stmt->bindParam(':contact_num', $data['contact_num']);
                $stmt->bindParam(':email', $data['email']);
                $stmt->bindParam(':pass', $data['password']);

                if ($stmt->execute()) {
                    $this->errors['message'] = "Signed up successfully!";
                } else {
                    $this->errors['message'] = "Failed to sign up.";
                }
            } catch (PDOException $e) {
                $this->errors['message'] = 'Could not add the product: ' . $e->getMessage();
            }
        }
    }
}