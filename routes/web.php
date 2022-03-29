<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ManageMenu;
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

Route::get('/',[ManageMenu::class,'show_menu'])->name('show_menu');
Route::get('detail_menu/{id}',[ManageMenu::class,'detail_menu'])->name('detail_menu')
->where('id','[0-9]+');
Route::get('choose_table',[ManageMenu::class,'choose_table'] )->name('choose_table');
