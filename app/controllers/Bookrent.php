<?php

/**
 * book rent controller
 */

class Bookrent extends Controller
{
    public function index()
    {
        $book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $book = null;

        if ($book_id > 0)
        {
            $bookModel = new Book();
            $book = $bookModel->get_book_by_id($book_id);
        }

        $this->view('bookrent', ['book' => $book]);
    }
}
