<?php

namespace App\Livewire;

use App\Models\Vendor;
use App\Repos\CheckoutRepo;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCondition;
use Livewire\Component;

class ValidateCheckout extends Component
{
    public function render()
    {
        //Initialize Cart
        $cart = $this->cart(); 
        $vendor = $this->vendor();      
        //return view
        return view('livewire.validate-checkout',compact('cart','vendor'));
    }
    public function validateForm(){
        //validate inputs
        $validated = $request->validate(CheckoutRepo::rules());
    }
    private function cart(){ 
        $config = [
            'format_numbers' => true,
            'decimals' => 2,
            'dec_point' => '.',
            'thousands_sep' => ',',
        ]; 

        $cart = new Cart(app('session'), app('events'), 'default', 'cart', $config);  
        // add condition to only apply on totals, not in subtotal
        $condition = new CartCondition(array(
            'name' => 'Delivery ₦750',
            'type' => 'shipping',
            'target' => 'total', // this condition will be applied to cart's total when getTotal() is called.
            'value' => '+750',
            'order' => 1 // the order of calculation of cart base conditions. The bigger the later to be applied.
        ));
        // $condition2 = new CartCondition(array(
        //     'name' => 'VAT 7.5%',
        //     'type' => 'tax',
        //     'target' => 'total', // this condition will be applied to cart's total when getTotal() is called.
        //     'value' => '7.5%',
        //     'order' => 1 // the order of calculation of cart base conditions. The bigger the later to be applied.
        // ));
        
        $cart->condition($condition);
        
        return $cart;
    }

    private function vendor(){
        $vendor_id = "";
         //Initialize Cart
         $cart = $this->cart();

         //find the vendor that owns the menu items
         $items = $cart->getContent();
         foreach($items as $item){
             $vendor_id = $item->associatedModel->vendor_id;
             break;
         }
         $vendor = Vendor::where('id',$vendor_id)->first();
       
         return $vendor;
    }
}
