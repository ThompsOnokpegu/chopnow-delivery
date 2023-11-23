<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Repos\MenuRepo;
use App\Repos\VendorRepo;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MenuController extends Controller
{
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
        
        $path = 'menu-images';
        $request['slug'] = str()->slug($request->name);
        $filename = "";
        //validate input
        $validated = $request->validate($MenuRepo->rules());

        //check whether vendor uploaded a new image for this menu
        // if($request->hasFile('product_image')){
        //     //check if the old image is still in the directory: prevent file not found exception
        //     if(Storage::disk('local')->exists($path.$menu->product_image)){
        //         //delete old image
        //         Storage::disk('local')->delete($path.$menu->product_image);
        //         //upload the new file
        //         $filename = VendorRepo::storeMenuImage($path,$request->file('product_image')); 
        //     }
        //  //upload the new file
        //  $filename = VendorRepo::storeMenuImage($path,$request->file('product_image'));     
        // }else{
        //     //product image did not change
        //     $filename = $menu->product_image;   
        // }
        
        //Upload file to cloudinary
        $filename = VendorRepo::cloudinaryUpload($path,$validated['product_image']);
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
        $request['slug'] = str()->slug($request->name);
        //set default product image
        $filename = "main-dish.png";
        //validate input
        $validated = $request->validate($MenuRepo->rules());

        $filename = VendorRepo::cloudinaryUpload('menu-images',$validated['product_image']);
        //inject file name into validated input
        $validated['product_image'] = $filename;
        //create menu
        Menu::create($validated);
        //redirect vendor to enter new record
        return redirect()->route('menus.create')->with('message','Menu created successfully!');     

    }

    public function destroy(Menu $menu){
        $path = 'public/menu-images/';
        if(Storage::disk('local')->exists($path.$menu->product_image)){
            //delete old image
            Storage::disk('local')->delete($path.$menu->product_image);
        }
        
        $menu->delete();
        return redirect()->route('menus.index');
    }

    

}
