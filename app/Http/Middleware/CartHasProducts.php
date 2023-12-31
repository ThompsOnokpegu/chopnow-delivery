<?php

namespace App\Http\Middleware;

use App\Repos\ChopCart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Darryldecode\Cart\Cart;

class CartHasProducts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cart = new ChopCart(); 

        if($cart->isEmpty()){
            return redirect()->route('order.cart')->with('message',"Your cart is empty");
        }
        return $next($request);
    }
}
