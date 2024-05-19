<?php
class Model extends Database {
   
    public function __construct() {
        
        $this->conn = $this->connect();
    }


    public function transactQuery($transactionId) {
        
        $sql = "SELECT * FROM rent r JOIN books b on r.book_id = b.book_id JOIN customers c on r.cus_id = c.cus_id WHERE r_id = :transaction_id";
        $stmt = $this->conn->prepare($sql);
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
    $conn = $this->connect();
    $sql = "SELECT r.*, b.book_title, b.book_genre, b.book_year, c.cus_fname, c.cus_lname,  c.cus_email, s.s_name
            FROM rent r
            JOIN status s ON r.s_id = s.s_id    
            JOIN books b ON r.book_id = b.book_id
            JOIN customers c ON r.cus_id = c.cus_id
            WHERE r.s_id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function getApproveRentals() {
    $conn = $this->connect();
    $sql = "SELECT r.*, b.book_title, b.book_genre, b.book_year, c.cus_fname, c.cus_lname,  c.cus_email, s.s_name
            FROM rent r
            JOIN status s ON r.s_id = s.s_id
            JOIN books b ON r.book_id = b.book_id
            JOIN customers c ON r.cus_id = c.cus_id
            WHERE r.s_id = 2";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function getReturnedRentals() {
    $conn = $this->connect();
    $sql = "SELECT r.*, b.book_title, b.book_genre, b.book_year, c.cus_fname, c.cus_lname,  c.cus_email, s.s_name
            FROM rent r
            JOIN status s ON s.s_id = r.s_id
            JOIN books b ON r.book_id = b.book_id
            JOIN customers c ON r.cus_id = c.cus_id
            
            WHERE r.s_id = 4";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function updateRentalStatus($rentalId, $status)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE rent SET s_id = :status WHERE r_id = :r_id");
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->bindParam(':r_id', $rentalId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Update failed: " . $e->getMessage();
            return false;
        }
    }


public function addPayment($transactionId,$customerId, $amountTendered, $amountToBePaid){
    $conn = $this->connect();

    try {


        $sql = "INSERT INTO payment (R_ID, CUS_ID, P_TOTAL, P_AMOUNT) VALUES (:transaction_id, :customer_id, :amount_to_be_paid, :amount_tendered)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':transaction_id', $transactionId);
        $stmt->bindParam(':customer_id', $customerId);
        $stmt->bindParam(':amount_to_be_paid', $amountToBePaid);
        $stmt->bindParam(':amount_tendered', $amountTendered);
        $stmt->execute();

       
        $sql = "UPDATE rent SET s_id = '5' WHERE r_id = :transaction_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':transaction_id', $transactionId);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
      
        return false;
    }


}

public function getPaidRentals() {
    $conn = $this->connect();
    $sql = "SELECT *
            FROM payment p
            JOIN rent r  ON r.r_id = p.r_id
            JOIN status s  ON s.s_id = r.s_id";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

}