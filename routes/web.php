<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\Checkoutcontroller;
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Models\Wishlist;
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
Route::post('add-to-wishlist',[WishlistController::class, 'add']);


/* samo za ulogovane user-e */
Route::middleware(['auth'])->group(function(){
    Route::get('cart',[CartController::class, 'viewCart']);
    Route::post('update-cart',[CartController::class, 'updatecart']);
    Route::post('delete-cart-item',[CartController::class, 'deleteproduct']);
    Route::resource('checkout', Checkoutcontroller::class);
    Route::post('place-order',[Checkoutcontroller::class, 'placeorder']);
    Route::resource('my-orders', UserController::class);
    Route::get('view-order/{id}',[UserController::class, 'view']);
    Route::get('wishlist',[WishlistController::class, 'index']);
    Route::post('delete-wishlist-item',[WishlistController::class, 'destroy']);

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

    Route::resource('orders', OrderController::class);
    Route::get('admin/view-order/{id}',[OrderController::class , 'view']);
    Route::put('update-order/{id}',[OrderController::class,'update']);
    Route::get('order-history',[OrderController::class,'complitedOrders']);

    Route::get('users', [DashboardController::class,'users']);
    Route::get('view-user/{id}',[DashboardController::class, 'viewuser']);
    Route::resource('userss', DashboardController::class);

    //Route::post('delete-user/{user}', [DashboardController::class, 'destroy']);
});