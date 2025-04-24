<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Repos\MenuRepo;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MenuController extends Controller
{
    /**
     * The Cloudinary service instance.
     *
     * @var \App\Services\CloudinaryService
     */
    // protected $cloudinary;
    protected CloudinaryService $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        // Initialize the Cloudinary service instance.
        // This allows us to use the Cloudinary service for file uploads and deletions.
        $this->cloudinary = $cloudinary;
    }

    public function index(){
       
        $vendor_id = Auth::guard('vendor')->user()->id;
        $menus = Menu::where('vendor_id', $vendor_id)
               ->orderBy('category')
               ->take(20)
               ->get();
        return view('vendor.menu.index',compact('menus'));
    }

    public function edit(Menu $menu){  
        $imagename = $menu->product_image;
        return view('vendor.menu.edit',compact('imagename','menu'));
    }

    public function update(Menu $menu, Request $request, MenuRepo $MenuRepo){
        
        $directory = 'chopnow/menu-images';
        $request['slug'] = str()->slug($request->name);
        $filename = "";
        //validate input
        $validated = $request->validate($MenuRepo->rules());

        //check if the product image has changed
        if($request->hasFile('product_image')){
            
            //check if the old image exists
            if($menu->product_image_pid){
                //delete old image from cloudinary
                $this->cloudinary->delete($menu->product_image_pid);
            }
            
            //upload new image to cloudinary
             $upload = $this->cloudinary->upload(request()->file('product_image'), $directory);
            //store the file name in the database
             $menu->update([
                 'product_image' => $upload['url'],
                 'product_image_pid' => $upload['public_id'],
             ]);
            
            $filename = $upload['url'];
        }else{
            //product image did not change
            $filename = $menu->product_image;
        }
        //update the file name
        $validated['product_image'] = $filename;
        //update the menu record
        $menu->update($validated);
        return redirect()->route('menus.index')->with('message','Menu updated successfully!');
    }

    public function create(Menu $menu){  
        $vendor_id = Auth::guard('vendor')->user()->id;
        return view('vendor.menu.create',compact('vendor_id','menu'));
    }

    
    public function store(Request $request, MenuRepo $MenuRepo){
        $directory = 'chopnow/menu-images';
        $request['slug'] = str()->slug($request->name);
        
        //validate input
        $validated = $request->validate($MenuRepo->rules());
         //check if the product image has changed
        if($request->hasFile('product_image')){
            //upload new image to cloudinary
             $upload = $this->cloudinary->upload(request()->file('product_image'), $directory);
            
            //inject file name into validated input
            $validated['product_image'] = $upload['url'];
            $validated['product_image_pid'] = $upload['public_id'];
        }else{
            //set default product image
            $validated['product_image'] = "https://res.cloudinary.com/dy4k6jokm/image/upload/v1745244843/default_menu_mogbyi.png";
            
        }
        
        //create menu
        Menu::create($validated);
        //redirect vendor to enter new record
        return redirect()->route('menus.create')->with('message','Menu created successfully!');     

    }
    public function destroy(Menu $menu){
        //check if the menu has a product image
        if($menu->product_image_pid){
            //delete old image from cloudinary
            $this->cloudinary->delete($menu->product_image_pid);
        }
        //delete the menu record
        $menu->delete();
        return redirect()->route('menus.index')->with('message','Menu deleted successfully!');
    }   
    

}
