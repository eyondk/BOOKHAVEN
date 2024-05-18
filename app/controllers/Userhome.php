<?php

/**
 *  home class
 */

class Userhome extends Controller

{  
   

    public function index()
    {   

      
    $book = new Book;
    $search_results = [];
    $is_search = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
        $keyword = trim($_POST['search']);
        if (!empty($keyword)) {
            $search_results = $book->search_books($keyword);
            $is_search = true;
        }
    }

    // Get books by genre only if it's not a search
    if (!$is_search) {
        $fantasy_books = $book->get_books_by_genre('Fantasy');
        $mystery_books = $book->get_books_by_genre('Mystery');
        $manga_books = $book->get_books_by_genre('Manga');
    } else {
        $fantasy_books = [];
        $mystery_books = [];
        $manga_books = [];
    }

    // Pass the data to the view
    $this->view('/user/homeuser', [
        'fantasy_books' => $fantasy_books,
        'mystery_books' => $mystery_books,
        'manga_books' => $manga_books,
        'search_results' => $search_results,
        'is_search' => $is_search
    ]);

    // $this->view('user/homeuser');


    }
    
    public function search()
    {
        $this->index();
    }
}