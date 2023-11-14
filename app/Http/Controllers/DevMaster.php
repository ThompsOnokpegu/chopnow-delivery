<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PayoutAccount;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DevMaster extends Controller
{
    public function makeFeatured(Vendor $vendor){
        $vendor->featured = 1;
        $vendor->save();
    }

    public function resetPayoutAccount(PayoutAccount $account){
        $account->delete();
    }
}
