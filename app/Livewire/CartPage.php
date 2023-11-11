<?php

namespace App\Livewire;

use App\Repos\ChopCart;
use Livewire\Component;

class CartPage extends Component
{
    protected $listeners = ['update-cart' => 'render'];
    protected $cart;
    private $cartContent;
    public array $quantity = [];

    public function render()
    {
        //Create Cart instance
        $this->cart = new ChopCart();

        $items = $this->cart->getContent();
        
        $this->cartContent = $this->cart->getContent();

        $cart = $this->cart;
        return view('livewire.cart-page',compact('items','cart'));
    }  
    
    public function updateQuantity($product_id){
        //Create Cart instance
        $this->cart = new ChopCart();
        // you may also want to update a product's quantity
        $this->cart->update($product_id, array(
            'quantity' => 1, // so if the current product has a quantity of 4, another 1 will be added so this will result to 5
        ));
        $this->cartContent = $this->cart->getContent();
        $this->dispatch('update-cart');
    }

    public function reduceQuantity($product_id)
    {
        
        //Create Cart instance
        $this->cart = new ChopCart();
        
        $this->cartContent = $this->cart->getContent();

       // Item quanity is more than 1? 
       if ($this->cartContent[$product_id]['quantity'] != 1) {
           //Reduce quanity by 1.
            $this->cart->update($product_id, array(
                'quantity' => -1, // so if the current product has a quantity of 4, it will subtract 1 and will result in 3
            ));
        //item quantity is exactly 1.
        }else{
            //Remove item from cart
            $this->cart->remove($product_id);
            
        }
        // Update the cartContent property
        $this->cartContent = $this->cart->getContent();
        
        $this->dispatch('update-cart');
    }
}

