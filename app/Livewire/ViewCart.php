<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;

class ViewCart extends Component
{
    public $cartItems;

    public function mount()
    {
        // Load cart items for the current user or guest (based on your session logic)
        $user_id = session()->getId();
        $this->cartItems = Cart::where('session_id', $user_id)->get();
    }

    // public function updateQuantity($cartItemId)
    // {
    //     // Update the quantity of a cart item
    //     $cartItem = Cart::findOrFail($cartItemId);
    //     // $cartItem->update(['quantity' => $quantity]);
    //     $cartItem->update(['quantity' => $this->cartItems[$cartItemId]['quantity']]);

    //     // Refresh the cart items
    //     $this->cartItems = Cart::where('session_id', session()->getId())->get();
    // }
   

    public function removeItem($cartItemId)
    {
        // Remove a cart item
        Cart::findOrFail($cartItemId)->delete();

        // Refresh the cart items
        $this->cartItems = Cart::where('session_id', session()->getId())->get();
    }

    public function render()
    {
        return view('livewire.view-cart');
    }
}

