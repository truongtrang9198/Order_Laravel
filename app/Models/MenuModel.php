<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class MenuModel extends Model
{
    use HasFactory;
    protected $table  = 'menu';
    protected $primaryKey = 'ID_DISH';
    public $timestamps = false;

    // relationship
    public function unit()
    {

        return $this->belongsTo('App\Models\UnitModel','ID_UNIT','ID_UNIT');
    }
    public function dish_type()
    {
        return $this->belongsTo('App\Models\DishtypeModel','ID_DISH_TYPE','ID_DISH_TYPE');
    }

    public function order_detail()
    {
        return $this->hasMany('App\Models\DetailModel','ID_DISH','ID_DISH');
    }



    public function get($params,$option){
        $result = null;
        if($option['task']=="get_all"){
            $result = DB::select('call get_all_menu()');
          // $result = StaffModel::where('ID_STAFF',$params)->get();
          //  $result = collect($result1)->all();
            //print_r($result);
        }

        if($option['task']=="menu_with_id"){
            $id = $params;
            $result = DB::select('call menu_with_id('.$id.')');
          // $result = StaffModel::where('ID_STAFF',$params)->get();
          //  $result = collect($result1)->all();
            //print_r($result);
        }

        if($option['task']=="menu_type"){
            $id_type_dish = $params;
            $result = DB::select('call menu_type('.$id_type_dish.')');
        }
        return $result;
    }

}
