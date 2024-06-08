<?php

class ItemCategory extends Database {
    public $errors = [];

    public function insert_cat_validation($data) {
        $conn = $this->openConnection();

        try {
            $cat_name = strtoupper($data['cat_name']);

            // Check if the category name already exists
            $check_query = "SELECT COUNT(*) FROM ITEM_CATEGORY WHERE ITEM_CAT_DESCRIPT = :cat_name";
            $check_stmt = $conn->prepare($check_query);
            $check_stmt->bindParam(':cat_name', $cat_name);
            $check_stmt->execute();
            $count = $check_stmt->fetchColumn();

            if ($count > 0) {
                $this->errors['message'] = "Category already exists in the database.";
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            $this->errors['message'] = "Error validating category. " . $e->getMessage();
            return false;
        }
    }

    public function insert_category ($data) {
        $conn = $this->openConnection();

        if(isset($_POST['add_category'])) {

            if (!$this->insert_cat_validation($data)) {
                return;
            }

            try {
                $cat_name = strtoupper($data['cat_name']);

                $insert = "INSERT INTO ITEM_CATEGORY (ITEM_CAT_DESCRIPT) 
                            VALUES (:cat_name)";
                $stmt = $conn->prepare($insert);
                $stmt->bindParam(':cat_name', $cat_name);

                if ($stmt->execute()) {
                    $this->errors['message'] = "Category created successfully!";
                } else {
                    $this->errors['message'] = "Failed to create category.";
                }

            } catch (PDOException $e){
                $this->errors['message'] = "Could not add category." . $e->getMessage();
            }
        }
    }

    public function delete_category($data) {
        $conn = $this->openConnection();

        try {
            $delete_query = "DELETE FROM ITEM_CATEGORY WHERE ITEM_CAT_ID = :cat_id";
            $stmt = $conn->prepare($delete_query);
            $stmt->bindParam(':cat_id', $data['cat_id']);

            if ($stmt->execute()) {
                $this->errors['message'] = "Category deleted successfully!";
            } else {
                $this->errors['message'] = "Failed to delete category.";
            }
        } catch (PDOException $e) {
            $this->errors['message'] = "Could not delete category." . $e->getMessage();
        }
    }

    public function getAllCategories() {
        $conn = $this->openConnection();

        try {
            $query = "SELECT * FROM ITEM_CATEGORY";
            $stmt = $conn->query($query);
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $categories;
        } catch (PDOException $e) {
            $this->errors['message'] = "Error fetching categories. " . $e->getMessage();
            return [];
        }
    }
}