<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillModel as BillModel;
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
        return view('staff.page_payment',["items"=>$dt]);
    }
}
