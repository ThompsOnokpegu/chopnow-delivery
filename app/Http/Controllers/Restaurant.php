<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Restaurant extends Controller
{
    public function single(){
        return view('customer.home');
    }
}
