<?php

/**
 * User class
 */

class Book
{

    use Model;

    protected $table = 'book';

    protected $allowedColumns = [

      'b_title',
      'b_genre',
      'b_yr_pub',
      'b_descript',
      'b_price',
      'b_book_cover',
      
    ];

   
    public function get_books_by_genre($genre)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM {$this->table} WHERE b_genre = :genre");
        $stmt->bindParam(':genre', $genre);
        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total = $stmt->rowCount();
        if($total > 0){
            return $books;
        } else {
            return FALSE;
        }
    }

    public function search_books($keyword)
    {   $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM book WHERE b_title LIKE :keyword");
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $books;
    }

          
}
