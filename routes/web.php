<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\Checkoutcontroller;
use App\Http\Controllers\Frontend\FrontController;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [FrontController::class,'index']);
Route::get('category',[FrontController::class, 'category']);
Route::get('view-category/{slug}',[FrontController::class, 'viewcategory']);
Route::get('category/{cate_slug}/{prod_slug}', [FrontController::class,'prodactview']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('add-to-cart',[CartController::class, 'addProduct']);


/* samo za ulogovane user-e */
Route::middleware(['auth'])->group(function(){
    Route::get('cart',[CartController::class, 'viewCart']);
    Route::post('update-cart',[CartController::class, 'updatecart']);
    Route::post('delete-cart-item',[CartController::class, 'deleteproduct']);
    Route::resource('checkout', Checkoutcontroller::class);
    Route::post('place-order',[Checkoutcontroller::class, 'placeorder']);
});

/* samo za admin user-e*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Route::get('/dashboard', function(){
    //     return view('admin.index');
    // });
    Route::resource('dashboard', FrontendController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products',ProductController::class);
    Route::resource('product_details', ProductDetailsController::class);

});