<?php

use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('category',[CategoryController::class,'index'])->name('category');
Route::post('addCategory',[CategoryController::class,'add'])->name('addCategory');
Route::post('editCategory',[CategoryController::class,'edit'])->name('editCategory');
Route::get('category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');