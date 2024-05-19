<?php

class Transaction extends Controller
{

    public function index()
    {
        
        
        $rent = new Rent();
        $rentals = $rent->getApproveRentals();
        $data['rentals'] = $rentals;
        
        $this->view('transaction', $data);
    }

}