<?php
class Model extends Database {

	

    
   
    public function transactQuery($transactionId) {
        $conn = $this->connect();
        $sql = "SELECT * FROM books WHERE book_id = :transaction_id";
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
}
