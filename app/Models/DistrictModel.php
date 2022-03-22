<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictModel extends Model
{
    protected $table  = 'district';
    protected $primaryKey = 'ID_DISTRICT';
    public $timestamps = false;

    public function getData($param,$options){
        $result = NULL;
        if($options['task']=="get-district"){

            $result = DistrictModel::where('ID_CITY',$param)->get();// lấy hết giá trị trong bảng city = select * from city;
        }
        return $result;
    }
}
