<?php

namespace App\Livewire;

use App\Models\Vendor;
use App\Repos\VendorRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class UpdateVendor extends Component
{
    use WithFileUploads;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $kitchen_banner_image;
    public $business_name;
    public $business_phone;
    public $address;
    public $city;
    public $state;
    public $slug;
  
    public function render()
    {
        $vendor =  Auth::guard('vendor')->user();
        $this->first_name = $vendor->first_name;
        $this->last_name = $vendor->last_name;
        $this->email = $vendor->email;
        $this->phone = $vendor->phone;
        $this->kitchen_banner_image = $vendor->kitchen_banner_image;
        $this->business_name = $vendor->business_name;
        $this->business_phone = $vendor->business_phone;
        $this->address = $vendor->address;
        $this->city = $vendor->city;
        $this->state = $vendor->state;
        $this->slug = $vendor->slug;

        return view('livewire.update-vendor');
    }
    public function update(Vendor $vendor, VendorRepo $val){
        
        dd($this->kitchen_banner_image->extension());
        $filename = "";
        //validate input
        $validated = $this->validate($val->rules(),$val->messages());

        
        //check whether vendor uploaded a new image for this vendor
        if($this->hasFile('kitchen_banner_image')){
            
            //if product image already exist for this vendor
            if($vendor->kitchen_banner_image != null){
                //check if the image is still in the directory: prevent file not found exception
                if (Storage::exists(public_path('vendor/assets/img/brands/'.$vendor->kitchen_banner_image))){
                    //delete the old file
                    $oldfile = public_path('vendor/assests/img/brands/').$vendor->kitchen_banner_image;
                    unlink($oldfile);
                }
            }
            //upload the new file
            $image = $this->file('kitchen_banner_image');
            $filename = Str::orderedUuid()->toString().'.'.$image->extension(); 
            $image->move(public_path('vendor/assets/img/brands/'),$filename);
            // Store the file in the "photos" directory with the filename "avatar.png"
            $this->photo->storeAs('photos', 'avatar');
            
        }else{
            //product image did not change
            $filename = $vendor->kitchen_banner_image;   
        }
        //update the file name
        $validated['kitchen_banner_image'] = $filename;
        
        //update the vendor record
        $vendor->update($validated);
        return redirect()->route('vendor.profile')->with('message','Details updated successfully!');
    }
}
