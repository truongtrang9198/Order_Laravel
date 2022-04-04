<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Table_order extends Model
{
    protected $table  = 'table_order';
    protected $primaryKey = 'ID_TABLE';
    public $timestamps = false;



    public function get($param,$option){
        $result = NULL;
        if($options['task']=="get-all"){
            $result = Table_order::where('active',1)->get();// lấy hết giá trị trong bảng city = select * from city;
        }
        if($options['task']=="get-with-id"){
            $result = Table_order::where('ID_TABLE',$param)->get();
        }


        return $result;
    }

    public function list(){
        $result = DB::select('call list_table() ');

        return $result;
    }

}
