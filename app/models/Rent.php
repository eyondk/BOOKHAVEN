<?php

class Rent extends Model {

    protected $table = 'rent';

    protected $allowedColumns = [

      'R_ID',
      'R_PICK-UP_DATE',
      'R_RETURN_DATE',
      'R_TOTAL',
      'R_STATUS',
      'R_ADDED',
      'R_BOOK_ID',
      'R_CUS_ID'
    ];

    public function getWaitingApprovalReservationByUserID ($user_id) {
        $conn = $this->openConnection();
        $select = $conn->prepare("SELECT * FROM {$this->table} WHERE R_CUS_ID = :user_id AND UPPER(R_STATUS) = 'TO BE APPROVE'");
        $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $select->execute();
        $reservations = $select->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;
    }

    public function getApprovedReservationByUserID ($user_id) {
        $conn = $this->openConnection();
        $select = $conn->prepare("SELECT * FROM {$this->table} WHERE R_CUS_ID = :user_id AND UPPER(R_STATUS) = 'APPROVED'");
        $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $select->execute();
        $reservations = $select->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;
    }

    public function getPaidReservationByUserID ($user_id) {
        $conn = $this->openConnection();
        $select = $conn->prepare("SELECT * FROM {$this->table} WHERE R_CUS_ID = :user_id AND UPPER(R_STATUS) = 'PAID'");
        $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $select->execute();
        $reservations = $select->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;
    }

    public function getReturnedReservationByUserID ($user_id) {
        $conn = $this->openConnection();
        $select = $conn->prepare("SELECT * FROM {$this->table} WHERE R_CUS_ID = :user_id AND UPPER(R_STATUS) = 'RETURNED'");
        $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $select->execute();
        $reservations = $select->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;
    }

    public function getCancelledReservationByUserID ($user_id) {
        $conn = $this->openConnection();
        $select = $conn->prepare("SELECT * FROM {$this->table} WHERE R_CUS_ID = :user_id AND UPPER(R_STATUS) = 'CANCELLED'");
        $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $select->execute();
        $reservations = $select->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;
    }

    public function validate_rent($data) {
        $this->errors = [];
    
        // $data = array_merge(['pickup-date' => '', 'return-date' => '', 'total' => '', 'terms' => ''], $data);
    
        if ($data['pickup-date'] > $data['return-date']) {
            $this->errors['date'] = "Pick-up date should be before the return date.";
        }
    
        if (!isset($data['terms']) || $data['terms'] != '1') {
            $this->errors['terms'] = "You must agree to the terms and conditions.";
        }
    
        if (empty($this->errors)) {
            return true;
        }
    
        return false;
    } 
}