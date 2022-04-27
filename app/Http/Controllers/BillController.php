<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillModel as BillModel;
use App\Models\PaymentModel as PaymentModel;
use Carbon\Carbon;
use App\Models\Table_order as Table_order;
class BillController extends Controller
{
    public function get_confirm(Request $request){
        $id_bill = $request->id_bill;
        $billmodel = new BillModel();
        $data = BillModel::find($id_bill);
        $data->BILL_STATUS = "Chờ thanh toán";
        $data->save();
        session()->push('id_table','');
        session()->push('status',"");
        return "Susscess";
    }

    public function page_payment(){
        $data = new BillModel();
        $dt = $data->get_all_bill();
        $paymentItems = PaymentModel::all();
       // return $dt;
        return view('staff.page_payment',["items"=>$dt,"payment"=>$paymentItems]);
    }

    public function confirmed(Request $re){
       // đặt trạng thái trong bảng bill
        $id_bill = $re->id_bill;
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $data = BillModel::find($id_bill);
        $data->PAY = $re->paid;
        $data->ID_PAYMENT   = $re->payment_type ;
        $data->BILL_STATUS  = "Đã thanh toán";
        $data->	Time_end  = $date;
        $data->save();

    // Tích điểm
        if(session('id_customer') !=''){
            $paid = round($re->paid/g100000);
        }

       // đặt trạng thái trong bảng table

       $id_table = $re->id_table;
       $table = Table_order::find($id_table);
       $table->STATUS = "Sẵn sàng";
       $table->save();

        return "Success";
    }
}
