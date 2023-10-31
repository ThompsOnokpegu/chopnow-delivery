<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class UpdateCart extends Component
{
    public $name;
    public $description;
    public $price;
    public $quantity;
    public $image;
    public $itemId;

    public function updateQuantity()
    {

        $cartItem = Cart::findOrFail($this->itemId);
        $cartItem->update(['quantity' => $this->quantity]);
       
        // Refresh the cart items
        $user_id = session()->getId();
        $cartItems = Cart::where('session_id', $user_id)->get();
       
        return redirect('/cart',compact('cartItems'));
    }
    
    

    public function mount($cartItemId){
        
        $cartItem = Cart::findOrFail($cartItemId);
        
        $this->name = $cartItem->menu->name;
        $this->description = $cartItem->menu->description;
        $this->price = $cartItem->menu->regular_price;
        $this->quantity = $cartItem->quantity;
        $this->image = $cartItem->menu->product_image;
        $this->itemId = $cartItem->id;
        
    }

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function render()
    {
        return view('livewire.update-cart');
    }
}
