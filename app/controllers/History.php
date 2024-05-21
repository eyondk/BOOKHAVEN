<?php

class History extends Controller
{

    public function index()
    {
        
         
        $rent = new Rent();
        $returnedRentals = $rent->getReturnedRentals();
        $cancelledRentals = $rent->getCancelledRentals();
        $paidRentals = $rent->getPaidsRentals();
        
        // Combine returned and cancelled rentals into a single array
        $rentals = array_merge($returnedRentals, $cancelledRentals, $paidRentals);
        
        $data = [
            'rentals' => $rentals,
        ];
        
     
        
        
        $this->view('admin/history',$data);
    }

}