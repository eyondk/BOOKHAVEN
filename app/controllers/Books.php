<?php

class Books extends Controller
{

    public function index()
    {   
        $connection = new Database;
        $conn = $connection->connect();
     
    
        $message = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
             /*INSERT BOOK*/ 
            if(isset($_POST['add_book'])){
                $title = $_POST['books_title'];
                $genre = $_POST['books_genre'];
                $year = $_POST['books_year'];
                $description = $_POST['books_description'];
                $price = $_POST['books_price'];
                $book_cover = $_FILES['books_cover']['name'];
                $book_cover_tmp_name = $_FILES['books_cover']['tmp_name'];
                $book_cover_folder = '../public/assets/uploaded_img/';
                $book_cover_path = $book_cover_folder . $book_cover;



                
                if (empty($title) || empty($genre) || empty($description) || empty($price) || empty($year) || empty($book_cover)) {
                    $message[] = 'Please fill out all fields';
                } else {
                    try {
                        
                        $insert = "INSERT INTO books (book_title, book_genre, book_year, book_description, book_price, book_image) VALUES(:title, :genre, :year, :description, :price, :image)";
                        $stmt = $conn->prepare($insert);

                        
                        $stmt->bindParam(':title', $title);
                        $stmt->bindParam(':genre', $genre);
                        $stmt->bindParam(':year', $year);
                        $stmt->bindParam(':description', $description);
                        $stmt->bindParam(':price', $price);
                        $stmt->bindParam(':image', $book_cover);

                
                        if ($stmt->execute()) {
                    
                            move_uploaded_file($book_cover_tmp_name, $book_cover_path);
                            $message = 'New product added successfully';
                        } else {
                            $message = 'Failed to add the product';
                        }
                    } catch (PDOException $e) {
                        $message = 'Could not add the product: ' . $e->getMessage();
                    }

                
                    }
                }
            
            /*UPDATE BOOK*/    
            if(isset($_POST['update_book'])){
                $id = $_POST['update_id'];
                $title = $_POST['update_title'];
                $genre = $_POST['update_genre'];
                $year = $_POST['update_year'];
                $description = $_POST['update_description'];
                $price = $_POST['update_price'];
                $book_cover = $_FILES['update_cover']['name'];
                $book_cover_tmp_name = $_FILES['update_cover']['tmp_name'];
                $book_cover_folder = '../public/assets/uploaded_img/';
                $book_cover_path = $book_cover_folder . $book_cover;

                    try {
                        
                        $update = "UPDATE books SET book_title = :title, book_genre = :genre, book_year = :year, book_description = :description, book_price = :price, book_image = :image WHERE book_id = :id";
                        $stmt = $conn->prepare($update);

                        
                        $stmt->bindParam(':title', $title);
                        $stmt->bindParam(':genre', $genre);
                        $stmt->bindParam(':year', $year);
                        $stmt->bindParam(':description', $description);
                        $stmt->bindParam(':price', $price);
                        $stmt->bindParam(':image', $book_cover);
                        $stmt->bindParam(':id', $id);

                
                        if ($stmt->execute()) {
                    
                            move_uploaded_file($book_cover_tmp_name, $book_cover_path);
                            $message = 'Updated product successfully';
                        } else {
                            $message = 'Failed to update the product';
                        }
                    } catch (PDOException $e) {
                        $message = 'Could not update the product: ' . $e->getMessage();
                    }

                    
                    }




            }

            /*DELETE BOOK*/  
            if(isset($_POST['delete_book'])){
                $id = $_POST['delete_id'];

                $stmt = $conn->prepare("DELETE FROM books WHERE book_id = :id");
                $stmt->bindParam(':id', $id);
                
                if($stmt->execute()){
                    $message = 'Book Deleted';
                    header('location:Books');
                }else{
                    $message = 'Failed to delete book';
                }


                }
                
            

              
            
                
            $this->view('books');
    }

    
    
}


