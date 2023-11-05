<?php

namespace App\Livewire;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCondition;
use Livewire\Component;

class CartModal extends Component
{
    protected $listeners = ['update-cart' => 'render'];
    protected $cart;
    protected $config = [
        'format_numbers' => true,
        'decimals' => 2,
        'dec_point' => '.',
        'thousands_sep' => ',',
    ];
    private $cartContent;
    public array $quantity = [];

    public function render()
    {
        if (is_null($this->cart)) {
            $this->cart = new Cart(app('session'), app('events'), 'default', 'cart', $this->config);
        }
        
        // add condition to only apply on totals, not in subtotal
        $condition = new CartCondition(array(
            'name' => 'Delivery ₦750',
            'type' => 'shipping',
            'target' => 'total', // this condition will be applied to cart's total when getTotal() is called.
            'value' => '+750',
            'order' => 1 // the order of calculation of cart base conditions. The bigger the later to be applied.
        ));
        $this->cart->condition($condition);
        

        $items = $this->cart->getContent();
        
        $this->cartContent = $this->cart->getContent();

        $cart = $this->cart;
        return view('livewire.cart-modal',compact('items','cart'));
    }  
    
    public function updateQuantity($product_id){
        if (is_null($this->cart)) {            
            $this->cart = new Cart(app('session'), app('events'), 'default', 'cart', $this->config);
        }
        // you may also want to update a product's quantity
        $this->cart->update($product_id, array(
            'quantity' => 1, // so if the current product has a quantity of 4, another 1 will be added so this will result to 5
        ));
        $this->cartContent = $this->cart->getContent();
        $this->dispatch('update-cart');
    }

    public function reduceQuantity($product_id)
    {
        
        // Instantiate the Cart class if it's null
        if (is_null($this->cart)) {
           
            $this->cart = new Cart(app('session'), app('events'), 'default', 'cart', $this->config);
        }
        
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

