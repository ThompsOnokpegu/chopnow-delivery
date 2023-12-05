<?php

namespace App\Livewire;

use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class KycCompliance extends Component
{
    use WithFileUploads;

    public $kyc_document;

    public $kyc_type='';

    public $kyc_number='';

    public function render(){
        $business = Auth::guard('vendor')->user()->business_type;
        $approved = Auth::guard('vendor')->user()->account_status;
        return view('livewire.kyc-compliance',compact('business','approved'));
    }

    public function comply(){

        //validate file
        $data = $this->validate([
            'kyc_document' => [
              'required',
              'mimes:jpeg,jpg,png,pdf',
              ],
            'kyc_type' => 'required',
            'kyc_number' => 'required',
        ]);

        $id = Auth::guard('vendor')->user()->id;
        $vendor = Vendor::where('id',$id)->first();        

        // Upload an image file to cloudinary
        $uploadedFileUrl = cloudinary()->uploadFile($data['kyc_document']->getRealPath(),[
            'folder'=> 'chopnow/business-certificates',
        ])->getSecurePath();
        $filename = Str::after($uploadedFileUrl, 'upload/');

        $vendor->kyc_type = $this->kyc_type;
        $vendor->kyc_number = $this->kyc_number;
        $vendor->kyc_document = $filename;
        $vendor->save();
        
        //Approve if account is Registered Business
        $vendor = Vendor::where('id',$id)->first();
        if($vendor->business_type=="Registered"){
            $vendor->account_status = 'Approved';
            $vendor->save();
        }

        session()->flash('kyc-uploaded','Document uploaded for review!');
    }
}
