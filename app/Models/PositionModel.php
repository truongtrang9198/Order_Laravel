<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionModel extends Model
{
    use HasFactory;
    protected $table  = 'position';
    protected $primaryKey = 'ID_POSITION';
    public $timestamps = false;

    // relationship voi bang staff
    public function Staff()
    {
        return $this->hasMany('App\Models\StaffModel','ID_POSITION','ID_POSITION');
    }
    public function getData($params, $options){
        $result = NULL;
        if($options['task']=="get-all"){
            $result = PositionModel::all();// lấy hết giá trị trong bảng city = select * from city;
        }
        return $result;
    }

}
