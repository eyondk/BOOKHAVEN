<?php

class Transaction extends Controller
{

    public function index()
    {
        
        
        $rent = new Rent();
        $apprentals = $rent->getApproveRentals();
        $paidrentals = $rent->getPaidsRentals();

        $rentals = array_merge($apprentals, $paidrentals);
        
        $data = [
            'rentals' => $rentals,
        ];
        
        $this->view('admin/transaction', $data);
    }

}