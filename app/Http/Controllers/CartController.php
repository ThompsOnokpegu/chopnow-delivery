<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $user_id = session()->getId();
        $cartItems = Cart::where('session_id', $user_id)->get();
        return view('restaurant.cart',compact('cartItems'));
    }
}
