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
})->name('begin');
Route::post('custom_login/',[CustomerController::class,'custom_login'] )->name('custom_login');
Route::post('custom_login2/',[CustomerController::class,'custom_login2'] )->name('login2');

Route::get('detail_menu/{id}',[ManageMenu::class,'detail_menu'])->name('detail_menu')
->where('id','[0-9]+');
Route::get('choose_table/',[ManageTable::class,'choose_table'] )->name('choose_table');
Route::get('menu/{id_table}/{number_table}/',[ManageMenu::class,'_menu'])->name('menu')
->where('id_table','[0-9]+');
Route::get('menu_type/',[ManageMenu::class,'menu_type'] )->name('menu_type');

Route::post('add_order/',[DetailController::class,'add_order'])->name('add_order');
Route::get('show_bill/{id_bill}',[DetailController::class,'show_bill'])->name('show_bill');
Route::get('show_bill1/{id_bill}',[DetailController::class,'show_bill1'])->name('show_bill1');

Route::post('get-confirm/',[BillController::class,'get_confirm'])->name('get-confirm');
Route::get('Comment/check_condition',[CommentController::class,'check_condition'])->name('check_condition');
// Route::get('Comment/{id_bill}',[CommentController::class,'check_condition'])->name('go_cmt')
// ->where('id_bill','[0-9]+');
Route::get('Comment/{id_bill}',[CommentController::class,'go_comment'])->name('go_cmt');
Route::post('Comment/insert_cmt',[CommentController::class,'insert_cmt'])->name('insert_cmt');
Route::get('exit/',[CustomerController::class,'exit'])->name('exit');
Route::get('check_discount/',[CustomerController::class,'check_discount'])->name('check_discount');

Route::get('Customer/history/',[CustomerController::class,'history'])->name('history');
Route::post('user_update/',[CustomerController::class,'user_update'])->name('user_update');
