<?php

class Database {

    private $host = DBHOST;
    private $dbname = DBNAME;
    private $user = DBUSER;
    private $password = DBPASS;
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
    private $conn;

    public function openConnection () {
        // $this->conn = null;

        try {
            $this->conn = new PDO(
                "pgsql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->password,
                $this->options
            );
            
            return $this->conn;
          
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }        
    }

    public function closeConnection () {
        $this->conn = null;
    }

    public function query($query, $data = []) {
        $con = $this->openConnection();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);
        if($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result;
            }
        }
        return false;
    }
}