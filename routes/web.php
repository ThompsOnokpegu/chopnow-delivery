<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WebhookController;

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
    Route::post('/destroy',[VendorController::class,'deactivateAccount'])->name('vendor.destroy')->middleware('vendor');
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

/*------------------End Vendor Routes------------------*/

 //CUSTOM RESTAURANT ROUTES
 Route::get('/', [RestaurantController::class,'index'])->name('restaurants.index');
 Route::get('/restaurants/{vendor}', [RestaurantController::class,'show'])->name('restaurants.show');
 Route::get('/restaurants/menu/{menu}',[RestaurantController::class,'productDetails'])->name('restaurants.product');
 Route::get('/thank-you',[CheckoutController::class,'thankYou'])->name('order.thankyou');
 Route::post('/webhook',[WebhookController::class,'handle']);


 //CUSTOM USER ROUTES
 Route::get('/login',[UserController::class,'showLogin'])->name('user.login');
 Route::get('/register',[UserController::class,'register'])->name('user.register');
 Route::post('/register',[UserController::class,'create'])->name('user.create');
 Route::post('/login',[UserController::class,'login'])->name('login');
 Route::get('/delivery',[UserController::class,'address'])->name('user.address')->middleware(['verified']);
 
 Route::get('/cart',[CheckoutController::class,'cartPage'])->name('order.cart');
 Route::get('/checkout',[CheckoutController::class,'checkoutPage'])->name('user.checkout')->middleware(['auth','verified','has.products']);
 Route::post('/checkout',[CheckoutController::class,'placeOrder'])->name('order.checkout');

 Route::get('/verify', [UserController::class,'emailVerificationNotice'])->middleware('auth')->name('verification.notice');
 Route::get('email/verify/{id}/{hash}', [UserController::class,'emailVerificationHandler'])->middleware(['auth', 'signed'])->name('verification.verify');
 Route::post('email/verification-notification', [UserController::class,'resendEmailLink'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
 Route::get('/forgot-password',[UserController::class,'forgotPassword'])->middleware('guest')->name('password.request');
 Route::post('/forgot-password', [UserController::class,'sendResetLink'])->middleware('guest')->name('password.email');
 Route::get('/reset-password/{token}',[UserController::class,'handlePasswordReset'])->middleware('guest')->name('password.reset');
 Route::post('/reset-password',[UserController::class,'passwordUpdate'])->middleware('guest')->name('password.update');

 Route::get('/profile', [UserController::class,'userProfile'])->middleware(['auth'])->name('user.profile');
 Route::post('/logout', [UserController::class,'logout'])->name('user.logout');
 Route::post('/deactivate', [UserController::class,'deactivateAccount'])->name('user.deactivate');


/*------------------User Routes------------------*/
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
/*------------------END User Routes------------------*/
