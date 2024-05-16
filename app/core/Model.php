<?php

class Model extends Database{

    public $errors = [];

    public function insert_user ($data) {
        $conn = $this->openConnection();
        $user = new User;
        
        if ($user->validate_signup($data)) {
            try {
                $password = md5($data['password']);

                $insert = "INSERT INTO user (CUS_FNAME, CUS_LNAME, CUS_ADDRESS, CUS_CONTACT_NUM, CUS_EMAIL, CUS_PASS) 
                            VALUES(:fname, :lname, :address, :contact_num, :email, :pass)";
                $stmt = $conn->prepare($insert);

                $stmt->bindParam(':fname', $data['fname']);
                $stmt->bindParam(':lname', $data['lname']);
                $stmt->bindParam(':address', $data['address']);
                $stmt->bindParam(':contact_num', $data['contact_num']);
                $stmt->bindParam(':email', $data['email']);
                $stmt->bindParam(':pass', $password);

                if ($stmt->execute()) {
                    $this->errors['message'] = "Signed up successfully!";
                } else {
                    $this->errors['message'] = "Failed to sign up.";
                }
            } catch (PDOException $e) {
                $this->errors['message'] = "Could not sign up." . $e->getMessage();
            }
        }
    }

    public function login ($data) {
        $conn = $this->openConnection();

        if(isset($_POST['login'])) {
            try {
                $password = md5($data['password']);

                $select = $conn->prepare("SELECT * FROM user WHERE CUS_EMAIL = ? AND CUS_PASS = ?");
                $select->execute([$data['email'], $password]);
                $row = $select->fetch(PDO::FETCH_ASSOC);

                if($select->rowCount() > 0) {
                    $_SESSION['user']= $row['CUS_ID'];
                    redirect('profile');
            } else {
                $this->errors['message'] = "Incorrect email or password.";
            }
            } catch (PDOException $e) {
                $this->errors['message'] = "Could not login." . $e->getMessage();
            }
        }
    }

    public function edit_user_info($data)
    {
        $conn = $this->openConnection();

        if(isset($_POST['edit'])) {
            try {
                $update = "UPDATE user SET CUS_FNAME = :fname, CUS_LNAME = :lname, CUS_ADDRESS = :address, CUS_CONTACT_NUM = :contactnum WHERE CUS_ID = :user_id";
                $stmt = $conn->prepare($update);

                $stmt->bindParam(':fname', $data['fname']);
                $stmt->bindParam(':lname', $data['lname']);
                $stmt->bindParam(':address', $data['address']);
                $stmt->bindParam(':contactnum', $data['contactnum']);
                $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);

                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        $this->errors['message'] = "Edited successfully.";
                        return true;
                    } else {
                        $this->errors['message'] = "No changes made.";
                    }
                } else {
                        $this->errors['message'] = "Error updating record." . $stmt->errorInfo()[2];
                }
            } catch (PDOException $e) {
                $this->errors['message'] = "Could not update information." . $e->getMessage();
            }
        }

        return false;
    }

    public function delete_user ($data) {
        $conn = $this->openConnection();

        if(isset($_POST['delete_user'])) {
            try {
                $delete = "DELETE FROM user WHERE CUS_ID = :user_id";
                $stmt = $conn->prepare($delete);
                
                $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
    
                if ($stmt->execute()) {
                    $this->errors['message'] = "User deleted successfully.";
                    return true;
                } else {
                    $this->errors['message'] = "Failed to delete user.";
                }
            } catch (PDOException $e) {
                $this->errors['message'] = "Could not delete user." . $e->getMessage();
            }
        }

        return false;
    }

    public function change_pass ($data, $user_id) {
        $user = new User;
        $conn = $this->openConnection();

        $password = md5($data['c_pass']);

        if ($user->validate_change_pass($data, $user_id)) {
            if(isset($_POST['confirm_changepass'])) {
                try {
                    $update = "UPDATE user SET CUS_PASS = : ? WHERE CUS_ID = : ?";
                    $stmt = $conn->prepare($update);
                    $stmt->bindParam(':c_pass', $password);

                    if ($stmt->execute()) {
                        if ($stmt->rowCount() > 0) {
                            $this->errors['message'] = "Password changed successfully.";
                            return true;
                        } else {
                            $this->errors['message'] = "Unable to change password.";
                        }
                    } else {
                        $this->errors['message'] = "Password not changed.";
                    }
                } catch (PDOException $e) {
                    $this->errors['message'] = "Could change password." . $e->getMessage();
                }
            }
        }

        return false;
    }
}