<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index(){

        $vendors = Vendor::all();
        for ($i=0; $i < 4; $i++) { 
            $nearby[] = $vendors[$i];
        }
        return view('restaurant.index',compact('vendors','nearby'));
    }

    public function show(Vendor $vendor){
        $menus = Menu::where('vendor_id',$vendor->id)->get();
        return view('restaurant.single',compact('vendor','menus'));
    }
    
    public function productDetails(Menu $menu){
        return view('restaurant.product-details',compact('menu'));
    }

    public function cart(){
        return view('restaurant.cart');
    }
}
