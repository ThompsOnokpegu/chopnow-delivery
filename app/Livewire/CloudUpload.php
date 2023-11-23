<?php

namespace App\Livewire;

// use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use Cloudinary\Api\Admin\AdminApi;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CloudUpload extends Component
{
    use WithFileUploads;
    public $media;

    public function render()
    {
        return view('livewire.cloud-upload');
    }
    public function uploadImage() {
        // // First we validate the input from the user
        // $data = $this->validate([
        //   'media' => [
        //     'required',
        //     'image',
        //     'mimes:jpeg,jpg,png',
        //     ],
        // ]);
       
        // /*Set the transformations required to optimize the images based on recommended optimization solutions*/
        // $folder = 'vendor-banners';
        // $media = $data['media'];
        // $width = '1053';
        // $height = '468';
        // $quality = 'auto';
        // $fetch = 'auto';
        // $crop = 'scale';
      
        // $uploadedFileUrl = cloudinary()->upload($data['media']->getRealPath(),[
        //     'folder' => $folder,
        //     'transformation' => [
        //         'width'   => $width,
        //         'height'  => $height,
        //         'quality' => $quality,
        //         'fetch'   => $fetch,
        //         'crop'    => $crop
        //     ]
        // ])->getSecurePath();//RESULT: "https://res.cloudinary.com/dydkg8ykt/image/upload/v1700736919/vendor-banners/ei4lfu3nwxsnrxfsrgv3.jpg"
      
        // Upload an image file to cloudinary with one line of code
        //$uploadedFileUrl = cloudinary()->upload($data['media']->getRealPath())->getSecurePath();//RESULT: 'https://res.cloudinary.com/dydkg8ykt/image/upload/v1700735544/xn6ote7c4wq128epnhuh.jpg'
               
        $url = "https://res.cloudinary.com/dydkg8ykt/image/upload/v1700736919/vendor-banners/ei4lfu3nwxsnrxfsrgv3.jpg";
        
        $db_path = Str::after($url, 'upload/');//"v1700736919/vendor-banners/ei4lfu3nwxsnrxfsrgv3.jpg"
        $cloud_base = "https://res.cloudinary.com/dydkg8ykt/image/upload/";
        $public_id = Str::before(basename($url),'.',);

        cloudinary()->destroy('folder/public_id');
        //OR
        $result = (new AdminApi())->deleteAssets([$public_id]);

        dd($public_id);       
      
      } 
      
}
