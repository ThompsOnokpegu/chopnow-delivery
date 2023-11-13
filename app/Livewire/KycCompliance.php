<?php

namespace App\Livewire;

use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use Ramsey\Uuid\Uuid;

class KycCompliance extends Component
{
    use WithFileUploads;

    #[Rule('required|image|max:1024')] // 1MB Max
    public $kyc_document;

    #[Rule('required')]
    public $kyc_type='';
    
    #[Rule('required')]
    public $kyc_number='';

    public function render(){
        $business = Auth::guard('vendor')->user()->business_type;
        $approved = Auth::guard('vendor')->user()->account_status;
        return view('livewire.kyc-compliance',compact('business','approved'));
    }

    public function comply(){
        $id = Auth::guard('vendor')->user()->id;
        $vendor = Vendor::where('id',$id)->first();
        $filename = Uuid::uuid4()->toString();
        $vendor->kyc_type = $this->kyc_type;
        $vendor->kyc_number = $this->kyc_number;
        $vendor->kyc_document = $filename;
        $vendor->save();
        // Store the file in the "certificates" directory with the filename
        $this->kyc_document->storeAs('certificates', $filename);

        //Approve if account is Registered Business
        $vendor = Vendor::where('id',$id)->first();
        if($vendor->business_type=="Registered"){
            $vendor->account_status = 'approved';
            $vendor->save();
        }
    }
}
