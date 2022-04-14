<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class BillModel extends Model
{
    use HasFactory;
    protected $table  = 'bill';
    protected $primaryKey = 'ID_BILL';
    public $timestamps = false;

//relationship
    public function order_detail()
    {
        return $this->hasMany('App\Models\DetailModel','ID_BILL','ID_BILL');
    }

    public function getid($id){
        $data = BillModel::where('ID_TABLE',$id)
                        ->where('BILL_STATUS','Chưa thanh toán')
                        ->get('ID_BILL');

        return $data;
    }

    public function get_all_bill(){
        $items = DB::select("select ID_BILL,TOTAL,BILL_STATUS,fee,Time_start,NUMBER_TABLE
                    from bill
                    inner join table_order
                    on bill.ID_TABLE = table_order.ID_TABLE");

        return $items;
    }
}
