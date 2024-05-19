<?php

class Approved extends Controller
{
    public function index()
    {
        $user = new User;
        $book = new Book;
        $rent = new Rent;

        $user_id = $_SESSION['user'] ?? null;
        $userData = $user_id ? $this->getUserData($user_id) : null;
        
        $data['user_fname'] = $userData ? $userData['CUS_FNAME'] : 'User Fname';
        $data['user_lname'] = $userData ? $userData['CUS_LNAME'] : 'User Lname';
        $data['user_email'] = $userData ? $userData['CUS_EMAIL'] : 'User Email';
        $data['user_address'] = $userData ? $userData['CUS_ADDRESS'] : 'User Address';
        $data['user_contact_num'] = $userData ? $userData['CUS_CONTACT_NUM'] : 'User Contact Num';
        $data['user_id'] = $user_id;

        $book_id = $_GET['book_id'] ?? null;
        $bookData = $book_id ? $this->getBookData($book_id) : null;

        $data['book_title'] = $bookData ? $bookData['B_TITLE'] : 'Book Title';
        $data['book_genre'] = $bookData ? $bookData['B_GENRE'] : 'Book Genre';
        $data['book_year'] = $bookData ? $bookData['B_YR_PUB'] : 'Book Yr. Pub';
        $data['book_price_rate'] = $bookData ? $bookData['B_PRICE'] : 'Book Price Rate';
        $data['book_id'] = $book_id;

        $reservations = $rent->getApprovedReservationByUserID($user_id);

        foreach ($reservations as &$res) {
            $res['customer'] = $user->getUserById($res['R_CUS_ID']);
            $res['book'] = $book->getBookById($res['R_BOOK_ID']);
        }

        // show(['reservations' => $reservations]);

        $this->view('user/approved', ['reservations' => $reservations]);
    }

    private function getUserData($user_id)
    {
        $user = new User();
        return $user->getUserById($user_id);
    }

    private function getBookData($book_id)
    {
        $book = new Book();
        return $book->getBookById($book_id);
    }
}
