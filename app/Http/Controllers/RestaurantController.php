<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Vendor;


class RestaurantController extends Controller
{
    public function index(){

        $vendors = Vendor::all();
        for ($i=2; $i < 6; $i++) { 
            $nearby[] = $vendors[$i];
        }
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
