<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = (object) 
        [
            'obj1' => (object)[
                'id' => '#2345',
                'customer_id' => '45283743',
                'total' => 5600,
                'date' => '2023-10-13 00:00:00',
            ],
            'obj2' => (object)[
                'id' => '#2366',
                'customer_id' => '22283740',
                'total' => 7000,
                'date' => '2023-10-12 00:00:00',
            ]
            
            ];
        
        return view('vendor.orders.index', compact('orders'));
    }

    public function orderDetails(){
        return view('vendor.orders.order-details');
    }
}
