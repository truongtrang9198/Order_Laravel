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
    public function getBill($id_bill){

        $detail = DB::select("call show_bill(".$id_bill.")");
        $bill = DB::select("select ID_BILL,TOTAL,BILL_STATUS,fee,DISCOUNT,PAY from bill where ID_BILL = $id_bill");

        return ["detail"=>$detail,"bill"=>$bill];
    }

    public function getid($id){
        $data = BillModel::where('ID_TABLE',$id)
                        ->where('BILL_STATUS','Chưa thanh toán')
                        ->get('ID_BILL');

        return $data;
    }

    public function get_all_bill(){
        $items = DB::select("select ID_BILL,TOTAL,BILL_STATUS,bill.ID_TABLE,fee,PAY,Time_start,NUMBER_TABLE,DISCOUNT
                    from bill
                    inner join table_order
                    on bill.ID_TABLE = table_order.ID_TABLE
                    where bill.BILL_STATUS != 'Đã thanh toán'");

        return $items;
    }

    public function get_chart(){
        $result = DB::select("call get_chart()");
        return $result;
    }

    public function get_table_active(){
        $result = DB::select("call get_table_active()");
        return $result;
    }

    public function staff_end($id_staff){
        $result = DB::select("call staff_end($id_staff)");
        return $result;
    }
}
