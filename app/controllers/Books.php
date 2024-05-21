<?php

class Books extends Controller
{
    public function index()
    {   
        $connection = new Database;
        $conn = $connection->openConnection();
     
        $message = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            /*INSERT BOOK*/ 
            if (isset($_POST['add_book'])) {
                $title = $_POST['books_title'];
                $author = $_POST['books_author'];
                $genre = $_POST['books_genre'];
                $year = $_POST['books_year'];
                $description = $_POST['books_description'];
                $price = $_POST['books_price'];
                $book_cover = $_FILES['books_cover']['name'];
                $book_cover_tmp_name = $_FILES['books_cover']['tmp_name'];
                $book_cover_folder = realpath(dirname(__FILE__)) . '/../../public/assets/images/bookcover/';
                $book_cover_path = $book_cover_folder . $book_cover;

                if (!is_dir($book_cover_folder)) {
                    mkdir($book_cover_folder, 0777, true);
                }

                if (empty($title) || empty($author) || empty($genre) || empty($description) || empty($price) || empty($year) || empty($book_cover)) {
                    $message = 'Please fill out all fields';
                } else {
                    try {
                        $insert = "INSERT INTO book (B_TITLE, B_AUTHOR, B_GENRE, B_YR_PUB, B_DESCRIPT, B_PRICE, B_COVER) VALUES(:title, :author, :genre, :year, :description, :price, :image)";
                        $stmt = $conn->prepare($insert);

                        $stmt->bindParam(':title', $title);
                        $stmt->bindParam(':author', $author);
                        $stmt->bindParam(':genre', $genre);
                        $stmt->bindParam(':year', $year);
                        $stmt->bindParam(':description', $description);
                        $stmt->bindParam(':price', $price);
                        $stmt->bindParam(':image', $book_cover);

                        if ($stmt->execute()) {
                            if (move_uploaded_file($book_cover_tmp_name, $book_cover_path)) {
                                $message = 'New product added successfully';
                            } else {
                                $message = 'Failed to upload the book cover. Check permissions or path: ' . $book_cover_path;
                            }
                        } else {
                            $message = 'Failed to add the product';
                        }
                    } catch (PDOException $e) {
                        $message = 'Could not add the product: ' . $e->getMessage();
                    }
                }
            }

            /*UPDATE BOOK*/    
            if (isset($_POST['update_book'])) {
                $id = $_POST['update_id'];
                $title = $_POST['update_title'];
                $author = $_POST['update_author'];
                $genre = $_POST['update_genre'];
                $year = $_POST['update_year'];
                $description = $_POST['update_description'];
                $price = $_POST['update_price'];
                $book_cover = $_FILES['update_cover']['name'];
                $book_cover_tmp_name = $_FILES['update_cover']['tmp_name'];
                $book_cover_folder = realpath(dirname(__FILE__)) . '/../../public/assets/images/bookcover/';
                $book_cover_path = $book_cover_folder . $book_cover;

                if (!is_dir($book_cover_folder)) {
                    mkdir($book_cover_folder, 0777, true);
                }

                try {
                    $update = "UPDATE book SET B_TITLE = :title, B_AUTHOR = :author, B_GENRE = :genre, B_YR_PUB = :year, B_DESCRIPT = :description, B_PRICE = :price, B_COVER = :image WHERE B_ID = :id";
                    $stmt = $conn->prepare($update);

                    $stmt->bindParam(':title', $title);
                    $stmt->bindParam(':author', $author);
                    $stmt->bindParam(':genre', $genre);
                    $stmt->bindParam(':year', $year);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':image', $book_cover);
                    $stmt->bindParam(':id', $id);

                    if ($stmt->execute()) {
                        if (move_uploaded_file($book_cover_tmp_name, $book_cover_path)) {
                            $message = 'Updated product successfully';
                        } else {
                            $message = 'Failed to upload the book cover. Check permissions or path: ' . $book_cover_path;
                        }
                    } else {
                        $message = 'Failed to update the product';
                    }
                } catch (PDOException $e) {
                    $message = 'Could not update the product: ' . $e->getMessage();
                }
            }

            /*DELETE BOOK*/  
            if (isset($_POST['delete_book'])) {
                $id = $_POST['delete_id'];

                $stmt = $conn->prepare("DELETE FROM book WHERE B_ID = :id");
                $stmt->bindParam(':id', $id);
                
                if ($stmt->execute()) {
                    $message = 'Book Deleted';
                    header('Location: Books');
                    exit();
                } else {
                    $message = 'Failed to delete book';
                }
            }
        }

        $this->view('admin/book', ['message' => $message]);
    }
}
?>
