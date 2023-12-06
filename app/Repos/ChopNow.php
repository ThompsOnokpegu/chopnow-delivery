<?php
namespace App\Repos;

class ChopNow {

    public function orderCharges($amount){
        $fees = 0;
        $charges = ($amount * 0.015) + 100;  //For Transactions 1.5% + NGN 100
        $cap = 2000; //Transactions fees are capped at ₦2000, 

        $fees = $charges;

        if($amount < 2500){   
            //₦100 fee waived for transactions under ₦2500
            $fees = $charges - 100;
        }

        if($charges > $cap){
            // 2000 is the absolute maximum you'll ever pay in fees per transaction
            $fees = 2000;
        }

        return $fees;
    }
}