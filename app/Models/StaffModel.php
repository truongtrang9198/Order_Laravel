<?php

namespace App\Models;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class StaffModel extends Model
{
    protected $table  = 'staff';
    protected $primaryKey = 'ID_STAFF';
    public $timestamps = false;
    protected $hidden = [
        'STAFF_PWD',
        'remember_token',
    ];

    public function position()
    {
        return $this->belongsTo('App\Models\PositionModel','ID_POSITION','ID_POSITION');
    }
    public function getData($params, $options){
        $result = NULL;
        if($options['task']=="get-all"){
            $result = DB::select('call list_staff()');
           // $result = StaffModel::all();// lấy hết giá trị trong bảng city = select * from city;
        }
        if($options['task']=="check_info"){
            $phone = $params->phone;
            $cccd = $params->cccd;
           // $inx_cccd = StaffModel::where('IDENTITY_PAPER',$cccd)->count();
          // $inx_phone = StaffModel::where('STAFF_PHONE',$phone)->count();
           $inx_cccd = StaffModel::where([['IDENTITY_PAPER',$cccd],['active',1]] )->count();
          $inx_phone = StaffModel::where([['STAFF_PHONE',$phone],['active',1]] )->count();
           $result = array("inx_phone" =>$inx_phone,
           "inx_cccd" =>$inx_cccd);
        }
//dùng collect để lấy dữ liệu
        if($options['task']=="get_with_id"){
         $result1 = StaffModel::with('position:ID_POSITION,POSITION_NAME')->find($params);
          // $result = StaffModel::where('ID_STAFF',$params)->get();
           $result = collect($result1)->all();
        }

        if($options['task']=="get_address_with_id"){
              $result =  DB::select('call proc_get_add('.$params.')');
           }
        return $result;
    }
}
