<?php

namespace App\Http\Middleware;

use App\Models\Vendor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KYCCompliant
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
        if($vendor->business_type == "Registered"){
            if(is_null($vendor->kyc_type) || is_null($vendor->kyc_number) || is_null($vendor->kyc_document)){
                return redirect()->route('vendor.compliance')->with('kyc-compliant','You need to submit your CAC Registration Number and Certificate!');
            }
        }
        return $next($request);
    }
}
