<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\QuotationController;


Route::resource('/', HomeController::class)->only([
    'index'
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('mascustomer',[CustomerController::class,'index'])->name('customer');
Route::get('addcustomer',[CustomerController::class,'create']);
Route::get('detailcustomer/{id}',[CustomerController::class,'show']);
Route::get('editcustomer/{id}',[CustomerController::class,'edit']);
Route::post('storecustomer',[CustomerController::class,'store']);
Route::post('updatecustomer',[CustomerController::class,'update']);
Route::get('destroycustomer/{id}',[CustomerController::class,'destroy']);

Route::get('masvendor',[VendorController::class,'index'])->name('vendor');
Route::get('addvendor',[VendorController::class,'create']);
Route::get('detailvendor/{id}',[VendorController::class,'show']);
Route::get('editvendor/{id}',[VendorController::class,'edit']);
Route::post('storevendor',[VendorController::class,'store']);
Route::post('updatevendor',[VendorController::class,'update']);
Route::get('destroyvendor/{id}',[VendorController::class,'destroy']);

Route::get('quotation',[QuotationController::class,'index'])->name('quotation');
Route::get('detailquotation/{id}',[QuotationController::class,'detailquotation']);
Route::get('bataldrafquot/{id}',[QuotationController::class,'bataldrafquot']);
Route::get('addquotation',[QuotationController::class,'create'])->name('addquotation');
Route::post('storequotation',[QuotationController::class,'store']);
