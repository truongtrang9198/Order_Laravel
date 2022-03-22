<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ManageStaff;
use App\Http\Controllers\admin\ManageTable;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\ManageMenu;
use App\Http\Controllers\Admin\Auth\LoginController;


Route::get('/', [LoginController::class,'login'])->name('login');
Route::get('getlogin', [LoginController1::class,'getLogin'])->name('getlogin');
   // quản lý nhân viên

Route::get('home/', [ManageStaff::class,'list'])->name('show');

Route::prefix('ManageStaff')->group(function () {
    Route::get('home/',[ManageStaff::class,'list'])->name("ManageStaff");
    Route::get('add/',[ManageStaff::class,'add'])->name('add_staff');
    Route::get('index/',[ManageStaff::class,'index'])->name('index'); // kiem tra ket noi database
    Route::get('/', function () {
        return view("amin.Home.Login");
    });
    Route::post('get_district/',[ManageStaff::class,'get_district'])->name("get_district");
    Route::post('check_info/',[ManageStaff::class,'check_info'])->name("check_info");
    Route::post('submit_staff/',[ManageStaff::class,'submit_staff'])->name("submit_staff");
    Route::get('delete_staff/{id}',[ManageStaff::class,'delete_staff'])->name('delete_staff')
    ->where('id','[0-9]+');
    Route::get('update_staff/{id}',[ManageStaff::class,'update_staff'])->name('update_staff')
    ->where('id','[0-9]+');

    Route::get('_del_staff/',[ManageStaff::class,'_del_staff'])->name("_del_staff");

    Route::POST('update_img/',[ManageStaff::class,'update_img'])->name('update_img');
});


///



    // Quản lý bàn
   // $tab = 'ManageTable';
    Route::prefix('ManageTable')->group(function () {
        //Route::pattern('id', '[0-9]+');
        Route::get('/',[ManageTable::class,'home'])->name('ManageTable');
        Route::get('add/',[ManageTable::class,'add'])->name('add_table');
        Route::get('insert_table/',[ManageTable::class,'insert_table'])->name('insert_table');
        Route::get('insert_type_table/',[ManageTable::class,'insert_type_table'])->name('insert_type_table');
        Route::get('update_table/{id}',[ManageTable::class,'update_table'])->name('update_table')
        ->where('id','[0-9]+');
        Route::get('delete_table/{id}',[ManageTable::class,'delete_table'])->name('delete_table')
        ->where('id','[0-9]+');

        Route::get('_del_table/',[ManageTable::class,'_del_table'])->name("_del_table");
    });
// Quản lý Menu
    Route::prefix('ManageMenu')->group(function () {
        Route::get('/',[ManageMenu::class,'list_menu'])->name('list_menu');
        Route::get('add_menu/',[ManageMenu::class,'add_menu'])->name('add_menu');
        Route::post('submit_menu/',[ManageMenu::class,'submit_menu'])->name('submit_menu');
        Route::get('delete_menu/{id}',[ManageMenu::class,'delete_menu'])->name('delete_menu')
        ->where('id','[0-9]+');
        Route::get('update_menu/{id}',[ManageMenu::class,'update_menu'])->name('update_menu')
        ->where('id','[0-9]+');
    });




?>
