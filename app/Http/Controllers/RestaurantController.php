<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\RestaurantType;
use App\Models\Vendor;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(){
        $vendors = Vendor::all();
        
        $restaurant_types = $this->restaurant_types();
        $nearby = Vendor::where('featured',true)->get();
        return view('frontend.restaurant.index',compact('vendors','nearby','restaurant_types'));
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

    public function filter(Request $request){
        $type = RestaurantType::where('slug',$request->query('category'))->first();
        $restaurants = Vendor::where('restaurant_type_id',$type->id)->get();
        $restaurant_types = $this->restaurant_types();
        return view('frontend.restaurant.restaurant_type_filter',compact('restaurants','restaurant_types','type'));
    }

    public function offers(){
        return view('frontend.restaurant.vouchers');
    }

    public function restaurant_types(){
         //$categories = Vendor::distinct('restaurant_type')->limit(7)->get(['restaurant_type']);
         $restaurant_types = RestaurantType::withCount('vendors')->orderByDesc('vendors_count')->get();
         //$restaurant_types = RestaurantType::has('vendors','>',0)->get();
         return $restaurant_types;
    }
}
