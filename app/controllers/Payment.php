<?php

class Payment extends Controller {
 
    public function index() {
       

        $payment = new Payments();
        $payments = $payment->getPaidRentals();
        $data['paid'] = $payments;

       
        $this->view('payment',$data);
       
    
}
}

