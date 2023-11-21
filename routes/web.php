<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LotController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ReportController;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::post('addCategory', [CategoryController::class, 'add'])->name('addCategory');
    Route::post('editCategory', [CategoryController::class, 'edit'])->name('editCategory');
    Route::get('category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('category/ajax',[CategoryController::class,'getall'])->name('category.getall');

    Route::controller(LotController::class)->prefix('lot')->group(function () {
        Route::get('/', 'index')->name('lot');
        Route::get('/getAll', 'getAll')->name('lot.getAll');
        Route::post('getById', 'getById')->name('lot.getById');
        Route::post('/create', 'creare')->name('lot.create');
        Route::post('getQuantity', 'getQuantity')->name('lot.getQuantity');
        Route::post('getAmount', 'getAmount')->name('lot.getAmount');
        Route::post('process', 'process')->name('lot.process');
    });
    Route::resource('purchasing', PurchaseController::class);
    Route::delete('/purchasing/{purchase}', 'PurchaseController@destroy')->name('purchasing.destroy');

    Route::resource('investment', InvestmentController::class);
    Route::resource('supplier', SupplierController::class);

    Route::controller(ReportController::class)->prefix('report')->group(function () {
        Route::get('/','index')->name('report');
        Route::get('balanceStatement/{filter?}','balanceStatement')->name('report.balanceStatement');
        Route::get('balanceStatementExport','balanceStatementExport')->name('report.balanceStatement.export');

        Route::get('purchaseStatement/{filter?}','purchaseStatement')->name('report.purchaseStatement');
        Route::get('purchaseStatementExport','purchaseStatementExport')->name('report.purchaseStatement.export');

        Route::get('lotStatement/{filter?}','purchaseStatement')->name('report.lotStatement');
        Route::get('lotStatementExport','purchaseStatementExport')->name('report.lotStatement.export');


    });
});
