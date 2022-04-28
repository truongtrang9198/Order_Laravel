<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class DetailModel extends Model
{
    use HasFactory;
    protected $table = "order_detail";
    protected $primaryKey = 'ID_DETAIL';
    public $timestamps = false;


    // relationship
    public function menu()
    {
        return $this->belongsTo('App\Models\MenuModel','ID_DISH','ID_DISH');
    }
    public function bill()
    {
        return $this->belongsTo('App\Models\BillModel','ID_BILL','ID_BILL');
    }



    public function order(){
        $data = DB::select("call show_all_order()");
        return $data;
    }


}
