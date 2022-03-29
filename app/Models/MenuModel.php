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

    public function unit()
    {

        return $this->belongsTo('App\Models\UnitModel','ID_UNIT','ID_UNIT');
    }
    public function dish_type()
    {
        return $this->belongsTo('App\Models\DishtypeModel','ID_DISH_TYPE','ID_DISH_TYPE');
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
        return $result;
    }

}
