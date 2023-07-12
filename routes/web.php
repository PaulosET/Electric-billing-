<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Livewire\Admin\Category\Category;
use App\Http\Livewire\Admin\Category\SliderController;
use App\Http\Livewire\Admin\Brand\Index;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/',function () {
    return view('welcome');
});
 */
Auth::routes();
Auth::routes([ 'verify' =>true]);
Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {

Route::get('/','index');
Route::get('/collections','categories');
Route::get('/collections/{category_slug}','products');
Route::get('/collections/{category_slug}/{product_slug}','productview');

Route::get('/new-arrivals','newArrival');
Route::get('/featured-products','featuredProducts');
Route::get('/search','searchProducts');

});


Route::middleware(['auth','verified'])->group(function(){

  Route::get('wishlist',[App\Http\Controllers\Frontend\WishListController::class,'index']);
  Route::get('cart',[App\Http\Controllers\Frontend\CartController::class,'index']);
  Route::get('checkout',[App\Http\Controllers\Frontend\checkoutController::class,'index']);
  Route::get('orders',[App\Http\Controllers\Frontend\OrderController::class,'index']);
  Route::get('orders/{orderId}',[App\Http\Controllers\Frontend\OrderController::class,'show']);
  Route::get('orders/{orderId}/print',[App\Http\Controllers\Frontend\OrderController::class,'printOrder']);
  Route::get('profile',[App\Http\Controllers\Frontend\UserController::class,'index']);
  Route::post('profile',[App\Http\Controllers\Frontend\UserController::class,'UpdateUserDetails']);
  Route::get('change-password',[App\Http\Controllers\Frontend\UserController::class,'PasswordCreate']);
  Route::post('change-password',[App\Http\Controllers\Frontend\UserController::class,'changePassword']);
  
});

Route::get('/thank-you',[App\Http\Controllers\Frontend\FrontendController::class,'thankyou']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index']);
Route::get('setting',[App\Http\Controllers\Admin\SettingController::class, 'index']);
Route::post('setting',[App\Http\Controllers\Admin\SettingController::class, 'store']);

Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
  Route::get('/sliders', 'index');
  Route::get('/sliders/create', 'create');
  Route::post('/sliders/create', 'store'); 
  Route::get('/sliders/{slider}/edit', 'edit');
  Route::PUT('/sliders/{slider}/','update');
  Route::get('/sliders/{slider}/delete', 'destroy');

});

Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
    Route::get('/category', 'index');
    Route::get('/category/create', 'create');
    Route::post('/category','store');
    Route::get('/category/{category}/edit', 'edit');
    Route::PUT('/category/{category}','update');
});
Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
Route::get('/products','index');
Route::get('/products/create','create');
Route::POST('/products','store');
Route::get('/products/{product}/edit','edit');
Route::PUT('/products/{product}','update');
Route::get('/product-image/{product_image_id}/delete','destroyImage');
Route::get('/products/{product}/delete','destroy');

Route::post('product-color/{prod_color_id}','updateProdColorQty');
Route::get('product-color/{prod_color_id}/delete','deleteProductColor');


});
Route::get('/brand',App\Http\Livewire\Admin\Brand\Index::class);
Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function () {
Route::get('/colors','index');
Route::get('/colors/create','create');
Route::Post('/colors/create','store');
Route::get('/colors/{color}/edit','edit');
Route::put('/colors/{color_id}','update');
Route::get('/colors/{color_id}/delete','destroy');
});
 
Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
Route::get('/orders','index');
Route::get('/orders/{orderID}','show');
Route::PUT('/orders/{orderID}','updateOrderStatus');
Route::get('/invoice/{orderID}','viewinvoIce');
Route::get('/invoice/{orderID}/generate','generateInvoice');
Route::get('/invoice/{orderID}/mail','mailInvoice');


});
Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
    Route::get('/users','index');
    Route::get('/users/create','create');
    Route::post('/users','store');
    Route::get('/users/{user_id}/edit','edit');
    Route::put('/users/{user_id}', 'update');
    Route::get('/users/{user_id}/delete', 'destroy');
   
  });
});
