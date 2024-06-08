<?php

class ItemColor extends Database {
    public $errors = [];

    public function insert_color_validation($data) {
        $conn = $this->openConnection();

        try {
            $color_d = strtoupper($data['color_d']);

            // Check if the category name already exists
            $check_query = "SELECT COUNT(*) FROM ITEM_COLOR WHERE ITEM_COL_DESCRIPT = :color_d";
            $check_stmt = $conn->prepare($check_query);
            $check_stmt->bindParam(':color_d', $color_d);
            $check_stmt->execute();
            $count = $check_stmt->fetchColumn();

            if ($count > 0) {
                $this->errors['message'] = "Color already exists in the database.";
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            $this->errors['message'] = "Error validating color. " . $e->getMessage();
            return false;
        }
    }

    public function insert_color ($data) {
        $conn = $this->openConnection();

        if(isset($_POST['add_color'])) {

            if (!$this->insert_color_validation($data)) {
                return;
            }

            try {
                $color_d = strtoupper($data['color_d']);

                $insert = "INSERT INTO ITEM_COLOR (ITEM_COL_DESCRIPT) 
                            VALUES (:color_d)";
                $stmt = $conn->prepare($insert);
                $stmt->bindParam(':color_d', $color_d);

                if ($stmt->execute()) {
                    $this->errors['message'] = "Color created successfully!";
                } else {
                    $this->errors['message'] = "Failed to create color.";
                }

            } catch (PDOException $e){
                $this->errors['message'] = "Could not add color." . $e->getMessage();
            }
        }
    }

    public function delete_color($data) {
        $conn = $this->openConnection();

        try {
            $delete_query = "DELETE FROM ITEM_COLOR WHERE ITEM_COL_ID = :col_id";
            $stmt = $conn->prepare($delete_query);
            $stmt->bindParam(':col_id', $data['col_id']);

            if ($stmt->execute()) {
                $this->errors['message'] = "Category deleted successfully!";
            } else {
                $this->errors['message'] = "Failed to delete category.";
            }
        } catch (PDOException $e) {
            $this->errors['message'] = "Could not delete category." . $e->getMessage();
        }
    }

    public function getAllColors() {
        $conn = $this->openConnection();

        try {
            $query = "SELECT * FROM ITEM_COLOR";
            $stmt = $conn->query($query);
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $categories;
        } catch (PDOException $e) {
            $this->errors['message'] = "Error fetching categories. " . $e->getMessage();
            return [];
        }
    }
}