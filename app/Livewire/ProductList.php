<?php

namespace App\Livewire;

use App\Models\Menu;
use Darryldecode\Cart\Cart;
use Livewire\Component;

class ProductList extends Component
{
    private $config = [
        'format_numbers' => true,
        'decimals' => 2,
        'dec_point' => '.',
        'thousands_sep' => ',',
    ];
    public $cartContent;
    public array $quantity = [];
    public $products;
    protected $cart; // Declare a property to hold the Cart instance;
    protected $listeners = ['update-cart' => 'render'];
    
    public function render()
    {
        // Instantiate the Cart class if it's null
        if (is_null($this->cart)) {
            $this->cart = new Cart(app('session'), app('events'), 'default', 'cart',$this->config);
        }
        $cart = $this->cart->getContent();
        $this->cartContent = $cart;
        return view('livewire.product-list',compact('cart'));
    }
    
    public function mount($vendorId){
        $this->products = Menu::where('vendor_id',$vendorId)->get();
        foreach($this->products as $product){
            $this->quantity[$product->id] = 1;
        }  
    }
    
    public function addToCart($product_id){
        
        // Instantiate the Cart class if it's null
        if (is_null($this->cart)) {
            $this->cart = new Cart(app('session'), app('events'), 'default', 'cart',$this->config);
        }

        //find the product
        $product = Menu::findOrFail($product_id);

        //Add to cart
        $this->cart->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->regular_price,
            'quantity' => $this->quantity[$product_id],
            'associatedModel' => $product
        ));
        
        $this->dispatch('update-cart'); // Emit an event to update the cart on the frontend.

        // Update the cartContent property
        $this->cartContent = $this->cart->getContent();
        
    }

    public function reduceQuantity($product_id)
    {
        // Instantiate the Cart class if it's null
        if (is_null($this->cart)) {
           
            $this->cart = new Cart(app('session'), app('events'), 'default', 'cart', $this->config);
        }

       // Item quanity is more than 1? 
       if ($this->cartContent[$product_id]['quantity'] != 1) {
           //Reduce quanity by 1.
            $this->cart->update($product_id, array(
                'quantity' => -1, // so if the current product has a quantity of 4, it will subtract 1 and will result in 3
            ));

            // Update the cartContent property
            $this->cartContent = $this->cart->getContent();
        
        //item quantity is exactly 1.
        }else{

            //Remove item from cart
            $this->cart->remove($product_id);
            
            // Update the cartContent property
            $this->cartContent = $this->cart->getContent();
        }
        $this->dispatch('update-cart');
    }

}

