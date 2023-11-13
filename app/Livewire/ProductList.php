<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Repos\ChopCart;
use Livewire\Component;

class ProductList extends Component
{
    
    public $cartContent;
    public array $quantity = [];
    public $products;
    protected $cart; // Declare a property to hold the Cart instance;
    protected $listeners = ['update-cart' => 'render'];

    
    public function render()
    {
        //Create Cart instance
        $this->cart = new ChopCart();
        $cart = $this->cart->getContent();
        $this->cartContent = $cart;
        return view('livewire.product-list',compact('cart'));
    }
    
    public function mount($vendorId){
        //TODO: CHECK CART'S VENOR IS THE SAME
        $this->products = Menu::where('vendor_id',$vendorId)->get();
        foreach($this->products as $product){
            $this->quantity[$product->id] = 1;
        }  
    }
    
    public function addToCart($product_id){
        //Create Cart instance
        $this->cart = new ChopCart();
        
        //find the vendor of the new product
        $productToAdd = Menu::where('id',$product_id)->first();
        
        /*prevent order from multiple vendors*/
        //check whether cart is empty
        if(!$this->cart->isEmpty()){   
            //find the vendor of the existing product in cart
            $items = $this->cart->getContent();
            foreach($items as $item){
                $productInCart = $item->associatedModel;//associated model is Menu
                break;
            }            
            //compare product vendors
            if($productInCart->vendor_id != $productToAdd->vendor_id){
                $this->cart->clear();
            }
        }
        //Add to cart
        $this->cart->add(array(
            'id' => $productToAdd->id,
            'name' => $productToAdd->name,
            'price' => $productToAdd->regular_price,
            'quantity' => $this->quantity[$product_id],
            'associatedModel' => $productToAdd
        ));
        
        $this->dispatch('update-cart'); // Emit an event to update the cart on the frontend.

        // Update the cartContent property
        $this->cartContent = $this->cart->getContent();
        
    }

    public function reduceQuantity($product_id)
    {
        //Create Cart instance
        $this->cart = new ChopCart();

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

