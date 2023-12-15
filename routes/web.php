<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorAuthController;
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
Route::prefix('vendor')->middleware(['guest'])->group(function(){
    //AUTH ROUTES
    Route::get('/login',[VendorAuthController::class,'showLogin'])->name('vendor.login');//load login form
    Route::post('/login',[VendorAuthController::class,'login']);//verify vendor credentials
    Route::get('/register',[VendorAuthController::class,'register'])->name('vendor.register');
    Route::post('/register',[VendorAuthController::class,'create']);
    Route::get('/verify',[VendorAuthController::class,'verifyEmail'])->name('vendor.verify');
    Route::get('/forgot-password',[VendorAuthController::class,'forgotPassword'])->name('vendor.password.request');
    Route::post('/forgot-password', [VendorAuthController::class,'sendResetLink'])->name('vendor.password.email');
    Route::get('/reset-password/{token}',[VendorAuthController::class,'handlePasswordReset'])->name('vendor.password.reset');
    Route::post('/reset-password',[VendorAuthController::class,'passwordUpdate'])->name('vendor.password.update');   
});

Route::prefix('vendor')->middleware(['vendor','vendor.verified'])->group(function(){
    Route::get('/email-notice',[VendorAuthController::class,'emailVerificationNotice'])->name('vendor.email.notice')->withoutMiddleware('vendor.verified');
    Route::post('/email-notice',[VendorAuthController::class,'resendEmail'])->name('vendor.email.send')->withoutMiddleware('vendor.verified');
    Route::post('/logout',[VendorAuthController::class,'logout'])->name('vendor.logout')->withoutMiddleware('vendor.verified');
    //ACCOUNT
    Route::get('/dashboard',[VendorController::class,'dashboard'])->name('vendor.dashboard');//redirect to vendor's home
    Route::get('/profile',[VendorController::class,'profile'])->name('vendor.profile');
    Route::put('/profile/{vendor}',[VendorController::class,'update'])->name('vendor.update');
    Route::get('/authentication',[VendorController::class,'changePassword'])->name('vendor.auth');
    Route::put('authentication',[VendorController::class,'resetPassword'])->name('vendor.resetpassword');
    Route::get('/compliance',[VendorController::class,'compliance'])->name('vendor.compliance');
    Route::get('/payout',[VendorController::class,'payout'])->name('vendor.payout');
    Route::post('/destroy',[VendorController::class,'deactivateAccount'])->name('vendor.destroy');
});
Route::prefix('menus')->middleware(['vendor','vendor.verified','kyc.compliant'])->group(function(){
    //MENU ROUTE
    Route::get('/', [MenuController::class,'index'])->name('menus.index');
    Route::get('/upload', [MenuController::class,'uploadform'])->name('menus.uploadform');
    Route::post('/upload', [MenuController::class,'upload'])->name('menus.upload');
    Route::get('/create',[MenuController::class,'create'])->name('menus.create');
    Route::post('/store',[MenuController::class,'store'])->name('menus.store');
    Route::get('/{menu}/edit',[MenuController::class,'edit'])->name('menus.edit')->middleware('menu.owner');
    Route::put('/{menu}/update',[MenuController::class,'update'])->name('menus.update')->middleware('menu.owner');
    Route::delete('/{menu}/delete',[MenuController::class,'destroy'])->name('menus.destroy')->middleware('menu.owner');
    Route::post('/dropzone',[MenuController::class,'storeImage'])->name('menu.image.store');
});
Route::prefix('orders')->middleware(['vendor','vendor.verified','order.owner'])->group(function(){
    //ORDER ROUTES
    Route::get('/', [OrderController::class,'index'])->name('orders.index')->withoutMiddleware('order.owner');
    Route::get('/{order}', [OrderController::class,'orderDetails'])->name('orders.detail');
    Route::post('/{order}',[OrderController::class,'updateOrderStatus'])->name('order.status');
});


/*------------------End Vendor Routes------------------*/

 //CUSTOM GUEST ROUTES
 Route::get('/', [RestaurantController::class,'index'])->name('restaurants.index');
 Route::get('/restaurants/{vendor}', [RestaurantController::class,'show'])->name('restaurants.show');

 Route::get('/restaurants',[RestaurantController::class,'filter'])->name('restaurants.filter');
 Route::get('/vouchers',[RestaurantController::class,'offers'])->name('restaurants.offers');
 Route::post('/webhook',[WebhookController::class,'handle']);
 Route::get('/login',[UserController::class,'showLogin'])->name('user.login');
 Route::get('/register',[UserController::class,'register'])->name('user.register');
 Route::post('/register',[UserController::class,'create'])->name('user.create');
 Route::post('/login',[UserController::class,'login'])->name('login');
 //CUSTOM USER ROUTES
 Route::get('/delivery',[UserController::class,'address'])->name('user.address')->middleware(['verified']);
 Route::get('/cart',[CheckoutController::class,'cartPage'])->name('order.cart');
 Route::get('/checkout',[CheckoutController::class,'checkoutPage'])->name('user.checkout')->middleware(['auth','verified','cart.empty']);
 Route::post('/checkout',[CheckoutController::class,'placeOrder'])->name('order.checkout');
 Route::get('/thank-you',[CheckoutController::class,'thankYou'])->name('order.thankyou');
 Route::get('/verify', [UserController::class,'emailVerificationNotice'])->middleware('auth')->name('verification.notice');
 Route::get('email/verify/{id}/{hash}', [UserController::class,'emailVerificationHandler'])->middleware(['auth', 'signed'])->name('verification.verify');
 Route::post('email/verification-notification', [UserController::class,'resendEmailLink'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
 Route::get('/forgot-password',[UserController::class,'forgotPassword'])->middleware('guest')->name('password.request');
 Route::post('/forgot-password', [UserController::class,'sendResetLink'])->middleware('guest')->name('password.email');
 Route::get('/reset-password/{token}',[UserController::class,'handlePasswordReset'])->middleware('guest')->name('password.reset');
 Route::post('/reset-password',[UserController::class,'passwordUpdate'])->middleware('guest')->name('password.update');
 Route::get('/profile', [UserController::class,'userProfile'])->middleware(['auth'])->name('user.profile');
 Route::get('/my-account', [UserController::class,'myAccount'])->middleware(['auth'])->name('user.account');
 Route::get('/my-chops', [UserController::class,'myOrders'])->middleware(['auth'])->name('user.chops');
 Route::get('/my-chops/{order}', [UserController::class,'orderDetails'])->middleware(['auth'])->name('chop.details');
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
