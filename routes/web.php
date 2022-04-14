<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ManageMenu;
use App\Http\Controllers\admin\ManageTable;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BillController;

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

// Route::get('/',[ManageMenu::class,'show_menu'])->name('show_menu');
Route::get('/', function () {
    return view("Homepage.custom_login");
});
Route::post('custom_login/',[CustomerController::class,'custom_login'] )->name('custom_login');

Route::get('detail_menu/{id}',[ManageMenu::class,'detail_menu'])->name('detail_menu')
->where('id','[0-9]+');
Route::get('choose_table/',[ManageTable::class,'choose_table'] )->name('choose_table');
Route::get('menu/{id_table}/{number_table}/',[ManageMenu::class,'_menu'])->name('menu')
->where('id_table','[0-9]+');
Route::post('add_order/',[DetailController::class,'add_order'])->name('add_order');
Route::get('show_bill/{id_bill}',[DetailController::class,'show_bill'])->name('show_bill');
Route::get('order_process/',[DetailController::class,'order_process'])->name('order_process');
Route::post('confirm/',[DetailController::class,'confirm'])->name('confirm');

Route::post('get-confirm/',[BillController::class,'get_confirm'])->name('get-confirm');
Route::get('page_payment/',[BillController::class,'page_payment'])->name('page_payment');
