<?php


class Pending extends Controller
{

    public function index()
    {
        
        $rent = new Rent();
        $rentals = $rent->getPendingRentals();
        $data['rentals'] = $rentals;
       

        
       
        $this->view('pending', $data);
    }


       
       
        
}