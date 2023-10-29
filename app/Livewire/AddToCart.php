<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Menu;

class AddToCart extends Component
{
    public $quantity = 1;
    public $menu_id;
    public $menu;

    public function addProduct(){
        
        $user_id = auth()->check() ? auth()->user()->id : null;
        $session_id = session()->getId();
    
        $cartItem = Cart::where(function ($query) use ($user_id, $session_id) {
            $query->where('user_id', $user_id)->orWhere('session_id', $session_id);
        })
        ->where('menu_id', $this->menu_id)
        ->first();
  
        if ($cartItem) {
           
            // Update the quantity if the item exists
            $cartItem->update(['quantity' => $cartItem->quantity + $this->quantity]);
        } else {
            // Create a new cart item if it doesn't exist
            Cart::create([
                'user_id' => $user_id,
                'session_id' => $session_id,
                'menu_id' => $this->menu_id,
                'quantity' => $this->quantity,
            ]);
        }
       
    }
    

    public function mount($menu)
    {
        $this->menu = $menu;
        $this->menu_id = $menu->id;
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
        return view('livewire.add-to-cart');
    }
}
