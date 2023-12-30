<?php

namespace App\Http\Middleware;

use App\Models\Vendor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdatedProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth = Auth::guard('vendor')->user();
        $vendor = Vendor::where('id',$auth->id)->first();
        if(is_null($vendor->business_type) || is_null($vendor->business_name) || is_null($vendor->phone || is_null($vendor->address))){
            return redirect()->route('vendor.profile')->with('updated-profile','You need to update your profile information!');
        }
        return $next($request);
    }
}
