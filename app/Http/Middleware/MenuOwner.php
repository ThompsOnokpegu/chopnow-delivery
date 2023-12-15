<?php

namespace App\Http\Middleware;

use App\Models\Vendor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MenuOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $vendor = Auth::guard('vendor')->user();
        if($vendor->id != $request->menu->vendor_id){
            return redirect()->route('menus.index')->with('permission','You do not have permission to perform this action!');
        }
        return $next($request);
    }
}
