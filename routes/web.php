<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    if(Auth::check()){
        return redirect('/home');
    }
    else{
        return redirect('/login');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add-product', [ProductController::class, 'index'])->name('add_product');
Route::post('/addProduct', [ProductController::class, 'add_product'])->name('addProduct');
Route::get('/list-products', [ProductController::class, 'list_product'])->name('list_product');
Route::get('/delete-product/{id}', [ProductController::class, 'delete_product'])->name('delete_product');
Route::get('/edit-product/{id}', [ProductController::class, 'edit_product'])->name('edit_product');
Route::post('/update-product/{id}', [ProductController::class, 'update_product'])->name('update_product');
