<?php

class History extends Controller
{

    public function index()
    {
        
         
        $rent = new Rent();
        $rentals = $rent->getReturnedRentals();
        $data['rentals'] = $rentals;
        
     
        
        
        $this->view('history',$data);
    }

}