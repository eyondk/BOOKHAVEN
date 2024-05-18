<?php

/**
 * User class
 */

class Book extends Model
{

    protected $table = 'book';

    protected $allowedColumns = [

      'B_TITLE',
      'B_GENRE',
      'B_YR_PUB',
      'B_DESCRIPT',
      'B_PRICE',
      'B_COVER',
      
    ];

   
    public function get_books_by_genre($genre)
    {
        $conn = $this->openConnection();
        $stmt = $conn->prepare("SELECT * FROM {$this->table} WHERE B_GENRE = :genre");
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
    {   $conn = $this->openConnection();
        $stmt = $conn->prepare("SELECT * FROM {$this->table} WHERE B_TITLE LIKE :keyword");
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $books;
    }

          
}