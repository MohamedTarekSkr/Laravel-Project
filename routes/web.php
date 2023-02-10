<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderDetailcontroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'view_index']);
Route::get('/shop', [HomeController::class, 'view_shop']);
Route::get('/add-product', [HomeController::class, 'add_product']);
Route::get('/like', [HomeController::class, 'like']);
Route::get('/admin', [AdminController::class, 'view_admin']);
Route::get('/w', function(){return view('welcome');});
Route::middleware(['auth', 'verified'])->get('/checkout',[CheckoutController::class, 'view_checkout']) ;
Route::get('/cart', [CartController::class, 'view_cart'])->name('cart') ;
Route::get('/detail/{id}', [OrderDetailcontroller::class, 'view_detail'])->name('detail') ;
Route::post('/add_review',[OrderDetailcontroller::class, 'review'] );
Route::post('/add_order',[CheckoutController::class, 'order'] );
Route::get('/addproduct/{id}', [CartController::class, 'addProduct']);
Route::get('/login', [HomeController::class, 'login']);
Route::get('/register', [HomeController::class, 'register']);
Route::get('/logout',[HomeController::class, 'logout'] );



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->prefix('/admin')->group (function () {

    Route::get('/categories', [CategoriesController::class, 'index']);
    Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.index');
    Route::get('/category/create', [CategoriesController::class, 'create']);
    Route::get('/category/{id}/edit', [CategoriesController::class, 'edit']);
    Route::put('/category/{id}', [CategoriesController::class, 'update']);
    Route::get('/category/{id}/show', [CategoriesController::class, 'show']);
    Route::delete('/category/{id}/', [CategoriesController::class, 'delete']);
    Route::get('/products/{id}/show', [ProductsController::class, 'show']);
    Route::resource('products', ProductsController::class);
    Route::get('/order', [AdminController::class, 'orders'])->name('orders.index');
    Route::delete('/order/{id}/', [AdminController::class, 'destroy']);
});