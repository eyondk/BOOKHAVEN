<?php

class ItemSize extends Database {
    public $errors = [];

    public function insert_size_validation($data) {
        $conn = $this->openConnection();

        try {
            $size_d = strtoupper($data['size_d']);

            // Check if the category name already exists
            $check_query = "SELECT COUNT(*) FROM ITEM_SIZE WHERE ITEM_SIZE_DESCRIPT = :size_d";
            $check_stmt = $conn->prepare($check_query);
            $check_stmt->bindParam(':size_d', $size_d);
            $check_stmt->execute();
            $count = $check_stmt->fetchColumn();

            if ($count > 0) {
                $this->errors['message'] = "Size already exists in the database.";
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            $this->errors['message'] = "Error validating size. " . $e->getMessage();
            return false;
        }
    }

    public function insert_size ($data) {
        $conn = $this->openConnection();

        if(isset($_POST['add_size'])) {

            if (!$this->insert_size_validation($data)) {
                return;
            }

            try {
                $size_d = strtoupper($data['size_d']);

                $insert = "INSERT INTO ITEM_SIZE (ITEM_SIZE_DESCRIPT) 
                            VALUES (:size_d)";
                $stmt = $conn->prepare($insert);
                $stmt->bindParam(':size_d', $size_d);

                if ($stmt->execute()) {
                    $this->errors['message'] = "Size created successfully!";
                } else {
                    $this->errors['message'] = "Failed to create size.";
                }

            } catch (PDOException $e){
                $this->errors['message'] = "Could not add size." . $e->getMessage();
            }
        }
    }

    public function delete_size($data) {
        $conn = $this->openConnection();

        try {
            $delete_query = "DELETE FROM ITEM_SIZE WHERE ITEM_SIZE_ID = :size_id";
            $stmt = $conn->prepare($delete_query);
            $stmt->bindParam(':size_id', $data['size_id']);

            if ($stmt->execute()) {
                $this->errors['message'] = "Category deleted successfully!";
            } else {
                $this->errors['message'] = "Failed to delete category.";
            }
        } catch (PDOException $e) {
            $this->errors['message'] = "Could not delete category." . $e->getMessage();
        }
    }


    public function getAllSizes() {
        $conn = $this->openConnection();

        try {
            $query = "SELECT * FROM ITEM_SIZE";
            $stmt = $conn->query($query);
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $categories;
        } catch (PDOException $e) {
            $this->errors['message'] = "Error fetching categories. " . $e->getMessage();
            return [];
        }
    }
}