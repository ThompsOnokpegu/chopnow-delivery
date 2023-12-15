<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OrderOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $vendor = Auth::guard('vendor')->user();
        if($vendor->id != $request->order->vendor_id){
            return redirect()->route('orders.index')->with('permission','You do not have permission to perform this action!');
        }
        return $next($request);
    }
}
