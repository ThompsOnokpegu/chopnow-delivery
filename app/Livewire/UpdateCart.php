<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class UpdateCart extends Component
{
    public $name;
    public $description;
    public $price;


    public function updateTuantity($cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);
        $cartItem->update(['quantity' => $this->cartItems[$cartItemId]['quantity']]);

        // Refresh the cart items
        //$this->cartItems = Cart::where('session_id', session()->getId())->get();
    }

    // public function mount($cartItemId){
    //     $cartItem = Cart::findOrFail($cartItemId);
    //     $this->name = $cartItem->menu->name;
    //     $this->description = $cartItem->menu->description;
    //     $this->price = $cartItem->menu->regular_price;

    // }

    public function render()
    {

        return view('livewire.update-cart');
    }
}
