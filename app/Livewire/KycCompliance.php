<?php

namespace App\Livewire;

use App\Models\Vendor;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KycCompliance extends Component
{
    use WithFileUploads;

    public $kyc_document;

    public $kyc_type='';

    public $kyc_number='';
    public $upload;


    public function render(){
        $business = Auth::guard('vendor')->user()->business_type;
        $approved = Auth::guard('vendor')->user()->account_status;
        return view('livewire.kyc-compliance',compact('business','approved'));
    }

    public function comply(){
        $directory = 'chopnow/business-certificates';
        //validate file
        $data = $this->validate([
            'kyc_document' => [
              'required',
              'mimes:jpeg,jpg,png,pdf',
              'max:1024', // 1MB Max
              ],
            'kyc_type' => 'required',
            'kyc_number' => 'required',
        ]);

        $id = Auth::guard('vendor')->user()->id;
        $vendor = Vendor::where('id',$id)->first(); 
        
        //dd($this->kyc_document);
        //check if file has changed
        if($this->kyc_document){
            $cloudinary = app(\App\Services\CloudinaryService::class);
            //check if the old file exists
            if($vendor->kyc_document_pid){
                //delete old image from cloudinary
                $this->cloudinary->delete($vendor->kyc_document_pid);
            }
            
            //upload new image to cloudinary
            $this->upload = $cloudinary->upload($data['kyc_document'], $directory);
            
            $vendor->update([
                'kyc_document' => $this->upload['url'],
                'kyc_document_pid' => $this->upload['public_id'],
            ]);
        }
        //store the file name in the database
        $vendor->kyc_type = $data['kyc_type'];
        $vendor->kyc_number = $data['kyc_number'];
        $vendor->save();
        
        //Approve if account is Registered Business
        //and the document is uploaded
        if($vendor->business_type=="Registered"){
            $vendor->account_status = 'approved';
            $vendor->save();
        }

        session()->flash('kyc-uploaded','Document uploaded for review!');
    }
}
