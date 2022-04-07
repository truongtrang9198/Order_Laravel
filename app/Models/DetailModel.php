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

    public function getBill($id_bill){

        $data = DB::select("call show_bill(".$id_bill.")");
    //     $data = DetailModel::with('menu')->where('ID_BILL',$id_bill)
    //                                     ->get();
    //    //$total = DetailModel::with('bill')->where('ID_BILL',$id_bill)
    //                                //     ->get();
    //     $totals = BillModel::find($id_bill);
    //     $total = $totals->TOTAL;
    //     $bill_status = $totals->BILL_STATUS;
    //    // $arr['menu'] = $data;
    //   //  $arr[1] = $total;
    //     return ["data"=>$data,'total'=>$total,"bill_status"=>$bill_status];
        return $data;
    }

    public function order(){
        $data = DB::select("call show_all_order()");
        return $data;
    }


}
