<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{

    protected $table  = 'city';
    protected $primaryKey = 'ID_CITY';
    public $timestamps = false;

    public function getData($param,$options){
        $result = NULL;
        if($options['task']=="get-city"){

            $result = CityModel::all();// lấy hết giá trị trong bảng city = select * from city;
        }
        return $result;
    }
}
