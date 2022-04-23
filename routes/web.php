<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ManageMenu;
use App\Http\Controllers\admin\ManageTable;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CommentController;

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
Route::post('custom_login2/',[CustomerController::class,'custom_login2'] )->name('login2');

Route::get('detail_menu/{id}',[ManageMenu::class,'detail_menu'])->name('detail_menu')
->where('id','[0-9]+');
Route::get('choose_table/',[ManageTable::class,'choose_table'] )->name('choose_table');
Route::get('menu/{id_table}/{number_table}/',[ManageMenu::class,'_menu'])->name('menu')
->where('id_table','[0-9]+');
Route::post('add_order/',[DetailController::class,'add_order'])->name('add_order');
Route::get('show_bill/{id_bill}',[DetailController::class,'show_bill'])->name('show_bill');
Route::get('order_process/',[DetailController::class,'order_process'])->name('order_process');
Route::post('Staff/confirm/',[DetailController::class,'confirm'])->name('confirm');

Route::post('Staff/get-confirm/',[BillController::class,'get_confirm'])->name('get-confirm');
Route::get('Staff/page_payment/',[BillController::class,'page_payment'])->name('page_payment');
Route::post('Staff/confirmed/',[BillController::class,'confirmed'])->name('confirmed');
Route::get('Comment/check_condition',[CommentController::class,'check_condition'])->name('check_condition');
// Route::get('Comment/{id_bill}',[CommentController::class,'check_condition'])->name('go_cmt')
// ->where('id_bill','[0-9]+');
Route::get('Comment/comment/{id_bill}',[CommentController::class,'go_comment'])->name('go_cmt');
