<?php

class Model extends Database{

    public $errors = [];

    // public function __construct() {
        
    //     $this->conn = $this->openConnection();
    // }

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
                    if ($row['CUS_EMAIL'] == 'testadmin@gmail.com' && $row['CUS_PASS'] == $password) {
                        redirect('books');
                    } else {
                        $_SESSION['user']= $row['CUS_ID'];
                        redirect('userhome');
                    }
                } else {
                    $this->errors['message'] = "Incorrect email or password.";
                }
            } catch (PDOException $e) {
                $this->errors['message'] = "Could not login." . $e->getMessage();
            }
        }
    }

    public function edit_user_info($data) {
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

        $password = md5($data['n_pass']);

        if ($user->validate_change_pass($data, $user_id)) {
            if(isset($_POST['changepass'])) {
                try {
                    $update = "UPDATE user SET CUS_PASS = :n_pass WHERE CUS_ID = :user_id";
                    $stmt = $conn->prepare($update);
                    $stmt->bindParam(':n_pass', $password);
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

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

    public function insert_rent ($data) {
        $conn = $this->openConnection();
        $rent = new Rent;

        if ($rent->validate_rent($data)) {
            try {
                $insert = "INSERT INTO rent (R_PICKUP_DATE, R_RETURN_DATE, R_TOTAL, R_BOOK_ID, R_CUS_ID) VALUES (:pickupdate, :returndate, :total, :book_id, :user_id)";
                $stmt = $conn->prepare($insert);

                $stmt->bindParam(':pickupdate', $data['pickup-date']);
                $stmt->bindParam(':returndate', $data['return-date']);
                $stmt->bindParam(':total', $data['total']);
                $stmt->bindParam(':book_id', $data['book_id'], PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $this->errors['message'] = "Wait for Approval";
                } else {
                    $this->errors['message'] = "Failed to submit reservation.";
                }
            } catch (PDOException $e) {
                $this->errors['message'] = "Couldn't reserve. " . $e->getMessage();
            }
        }
    }

    public function cancel_res ($data) {
        $conn = $this->openConnection();
        // show($data);

        try {
            $update = "UPDATE rent SET R_STATUS = 'CANCELLED' WHERE R_ID = :r_id";
            $stmt = $conn->prepare($update);
            $stmt->bindParam(':r_id', $_POST['r_id'], PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $this->errors['message'] = "Cancelled successfully.";
                    return true;
                } else {
                    $this->errors['message'] = "Failed to cancel.";
                }
            } else {
                $this->errors['message'] = "Error updating record." . $stmt->errorInfo()[2];
            }
        } catch (PDOException $e) {
            $this->errors['message'] = "Could not update information." . $e->getMessage();
        }

        return false;
        // return "Reservation canceled successfully.";
    }

    // ----------------------------------------------------------------------------

    public function transactQuery($transactionId) {
        $conn = $this->openConnection();
        
        $sql = "SELECT * FROM rent r 
        JOIN book b on r.R_BOOK_ID = b.B_ID 
        JOIN user c on r.R_CUS_ID = c.CUS_ID 
        WHERE R_ID = :transaction_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':transaction_id', $transactionId);
        $stmt->execute();
        $transactionDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($transactionDetails) {
            return $transactionDetails;
        } else {
           
            return null;
        }
    }


public function getPendingRentals() {
    $conn = $this->openConnection();

    $sql = "SELECT r.*, b.B_TITLE, b.B_GENRE, b.B_YR_PUB, b.B_PRICE, c.CUS_FNAME, c.CUS_LNAME,  c.CUS_EMAIL, r.R_STATUS
            FROM rent r
            -- JOIN status s ON r.s_id = s.s_id    
            JOIN book b ON r.R_BOOK_ID = b.B_ID
            JOIN user c ON r.R_CUS_ID = c.CUS_ID
            WHERE UPPER(r.R_STATUS) = 'TO BE APPROVE'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function getApproveRentals() {
    $conn = $this->openConnection();

    $sql = "SELECT r.*, b.B_TITLE, b.B_GENRE, b.B_YR_PUB, b.B_PRICE, c.CUS_FNAME, c.CUS_LNAME,  c.CUS_EMAIL, r.R_STATUS
            FROM rent r
            -- JOIN status s ON r.s_id = s.s_id    
            JOIN book b ON r.R_BOOK_ID = b.B_ID
            JOIN user c ON r.R_CUS_ID = c.CUS_ID
            WHERE UPPER(r.R_STATUS) = 'APPROVED'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function getReturnedRentals() {
    $conn = $this->openConnection();
    
    $sql = "SELECT r.*, b.B_TITLE, b.B_GENRE, b.B_YR_PUB, b.B_PRICE, c.CUS_FNAME, c.CUS_LNAME,  c.CUS_EMAIL, r.R_STATUS
    FROM rent r
    -- JOIN status s ON r.s_id = s.s_id    
    JOIN book b ON r.R_BOOK_ID = b.B_ID
    JOIN user c ON r.R_CUS_ID = c.CUS_ID
    WHERE UPPER(r.R_STATUS) = 'RETURNED'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function getCancelledRentals() {
    $conn = $this->openConnection();
    
    $sql = "SELECT r.*, b.B_TITLE, b.B_GENRE, b.B_YR_PUB, b.B_PRICE, c.CUS_FNAME, c.CUS_LNAME,  c.CUS_EMAIL, r.R_STATUS
    FROM rent r
    -- JOIN status s ON r.s_id = s.s_id    
    JOIN book b ON r.R_BOOK_ID = b.B_ID
    JOIN user c ON r.R_CUS_ID = c.CUS_ID
    WHERE UPPER(r.R_STATUS) = 'CANCELLED'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function getPaidsRentals() {
    $conn = $this->openConnection();
    
    $sql = "SELECT r.*, b.B_TITLE, b.B_GENRE, b.B_YR_PUB, b.B_PRICE, c.CUS_FNAME, c.CUS_LNAME,  c.CUS_EMAIL, r.R_STATUS
    FROM rent r
    -- JOIN status s ON r.s_id = s.s_id    
    JOIN book b ON r.R_BOOK_ID = b.B_ID
    JOIN user c ON r.R_CUS_ID = c.CUS_ID
    WHERE UPPER(r.R_STATUS) = 'PAID'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function updateRentalStatus($rentalId, $status)
    {
        $conn = $this->openConnection();

        try {
            $stmt = $conn->prepare("UPDATE rent SET R_STATUS = :status WHERE R_ID = :r_id");
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':r_id', $rentalId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Update failed: " . $e->getMessage();
            return false;
        }
    }


public function addPayment($transactionId,$customerId, $amountTendered, $amountToBePaid){
    $conn = $this->openConnection();

    try {


        $sql = "INSERT INTO payment (P_R_ID, P_CUS_ID, P_AMOUNT) VALUES (:transaction_id, :customer_id, :amount_tendered)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':transaction_id', $transactionId);
        $stmt->bindParam(':customer_id', $customerId);
        $stmt->bindParam(':amount_tendered', $amountTendered);
        $stmt->execute();

        $status = 'PAID';
        $sqlUpdate = "UPDATE rent SET R_STATUS = :status WHERE R_ID = :transaction_id";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':status', $status);
        $stmtUpdate->bindParam(':transaction_id', $transactionId, PDO::PARAM_INT);
        $stmtUpdate->execute();

        return true;
    } catch (PDOException $e) {
      
        return false;
    }


}

public function getPaidRentals() {
    $conn = $this->openConnection();
    $sql = "SELECT *
            FROM payment p
            JOIN rent r  ON r.R_ID = p.P_R_ID
            JOIN user u ON u.CUS_ID = p.P_CUS_ID";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
}