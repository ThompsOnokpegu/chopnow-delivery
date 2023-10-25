<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index(){
        $vendor = Auth::guard('vendor')->user();
        return view('restaurant.index',compact('vendor'));
    }
    public function show(){
        $vendor = Auth::guard('vendor')->user();
        return view('restaurant.single',compact('vendor'));
    }
    
    public function productDetails(Menu $menu){
        return view('restaurant.product-details',compact('menu'));
    }
}
