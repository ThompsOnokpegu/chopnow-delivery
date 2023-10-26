<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\VendorController;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*------------------Vendor Routes------------------*/

Route::prefix('vendor')->group(function(){
    //VENDOR ROUTE
    Route::get('/login',[VendorController::class,'login'])->name('vendor.login');//load login form
    Route::post('/login',[VendorController::class,'verify'])->name('vendor.verify');//verify vendor credentials
    Route::get('/dashboard',[VendorController::class,'dashboard'])->name('vendor.dashboard')->middleware('vendor');//redirect to vendor's home
    Route::post('/logout',[VendorController::class,'logout'])->name('vendor.logout')->middleware('vendor');
    Route::get('/register',[VendorController::class,'register'])->name('vendor.register');
    Route::post('/register',[VendorController::class,'create']);
    Route::get('/profile',[VendorController::class,'profile'])->name('vendor.profile')->middleware('vendor');
    Route::put('/profile/{vendor}',[VendorController::class,'update'])->name('vendor.update')->middleware('vendor');
    Route::get('/authentication',[VendorController::class,'changePassword'])->name('vendor.auth')->middleware('vendor');
    Route::put('authentication',[VendorController::class,'resetPassword'])->name('vendor.resetpassword')->middleware('vendor');
    Route::get('/compliance',[VendorController::class,'compliance'])->name('vendor.compliance')->middleware('vendor');
    Route::get('/payout',[VendorController::class,'payout'])->name('vendor.payout')->middleware('vendor');
    Route::post('/payout',[VendorController::class,'createRecipient'])->name('vendor.payout')->middleware('vendor');


});
Route::prefix('menus')->group(function(){
    //MENU ROUTE
    Route::get('/', [MenuController::class,'index'])->name('menus.index')->middleware('vendor');
    Route::get('/upload', [MenuController::class,'uploadform'])->name('menus.uploadform')->middleware('vendor');
    Route::post('/upload', [MenuController::class,'upload'])->name('menus.upload')->middleware('vendor');
    Route::get('/create',[MenuController::class,'create'])->name('menus.create')->middleware('vendor');
    Route::post('/store',[MenuController::class,'store'])->name('menus.store')->middleware('vendor');
    Route::get('/{menu}/edit',[MenuController::class,'edit'])->name('menus.edit')->middleware('vendor');
    Route::put('/{menu}/update',[MenuController::class,'update'])->name('menus.update')->middleware('vendor');
    Route::delete('/{menu}/delete',[MenuController::class,'destroy'])->name('menus.destroy')->middleware('vendor');
    
    Route::post('/dropzone',[MenuController::class,'storeImage'])->name('menu.image.store')->middleware('vendor');

});
Route::prefix('orders')->group(function(){
    //ORDER ROUTES
    Route::get('/', [OrderController::class,'index'])->name('orders.index')->middleware('vendor');
    Route::get('/{order}', [OrderController::class,'orderDetails'])->name('orders.detail')->middleware('vendor');
    Route::post('/{order}',[OrderController::class,'updateOrderStatus'])->name('order.status')->middleware('vendor');
    

});


 //CUSTOM USER ROUTES
 Route::get('/restaurants', [RestaurantController::class,'index'])->name('restaurants.index');
 Route::get('/restaurants/{vendor}', [RestaurantController::class,'show'])->name('restaurants.show');
 Route::get('/restaurants/menu/{menu}',[RestaurantController::class,'productDetails'])->name('restaurants.product');
    



// Route::controller(ItemController::class)->group(function(){

//     Route::get('items', 'index')->name('items.index');

//     Route::post('items', 'store')->name('items.store');

//     Route::get('items/create', 'create')->name('items.create');

//     Route::get('items/{item}', 'show')->name('items.show');

//     Route::put('items/{item}', 'update')->name('items.update');

//     Route::delete('items/{item}', 'destroy')->name('items.destroy');

//     Route::get('items/{item}/edit', 'edit')->name('items.edit');

// });

/*------------------END Vendor Routes------------------*/



/*------------------User Routes------------------*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
/*------------------END User Routes------------------*/
