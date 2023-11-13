<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Vendor;


class RestaurantController extends Controller
{
    public function index(){
        //create session variable to store user address
        //if they choose to add one before the checkout page
        
        $vendors = Vendor::all();
        $nearby = Vendor::where('featured',true)->get();
        return view('frontend.restaurant.index',compact('vendors','nearby'));
    }

    public function show(Vendor $vendor){
        return view('frontend.restaurant.single',compact('vendor'));
    }
    
    public function productDetails(Menu $menu){
        return view('frontend.restaurant.product-details',compact('menu'));
    }

    public function cart(){
        return view('frontend.restaurant.cart');
    }
}
