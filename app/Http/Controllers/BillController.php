<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillModel as BillModel;
use App\Models\PaymentModel as PaymentModel;
use Carbon\Carbon;
use App\Models\Table_order as Table_order;
use App\Models\CustomerModel as CustomerModel;
use Illuminate\Support\Facades\Auth;
use DB;
class BillController extends Controller
{
    public function get_confirm(Request $request){
        $id_bill = $request->id_bill;
        $discount = $request->discount;
        $billmodel = new BillModel();
        $data = BillModel::find($id_bill);
       // dd( $data);
        $data->BILL_STATUS = "Chờ thanh toán";
        if(session('id_customer') !='' && $discount!=''){
            $id_customer = session('id_customer');
          // Tính toán lại giá tiền khi áp khuyến mãi
            DB::select("call proc_pay($id_bill,$discount)");
          // Sửa điểm trong bảng customer
            $cs = CustomerModel::find($id_customer);
            $cs->POINT_TOTAL = $cs->POINT_TOTAL -$discount;
            $cs->save() ;
        }
        $discount=0;
        DB::select("call proc_pay($id_bill,$discount)");
        $data->DISCOUNT = $discount;
        $data->save();

        session()->push('id_table','');
        session()->push('status',"");
        return redirect()->route('show_bill1',['id_bill'=>$id_bill]);
    }

    public function page_payment(){
        $data = new BillModel();
        $dt = $data->get_all_bill();
        $paymentItems = PaymentModel::all();
       // return $dt;
        return view('staff.page_payment',["items"=>$dt,"payment"=>$paymentItems]);
    }

    public function confirmed(Request $re){
        $id_staff = Auth::guard('admin')->id();
       // đặt trạng thái trong bảng bill
        $id_bill = $re->id_bill;
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $data = BillModel::find($id_bill);
        $data->PAY = $re->paid;
        $data->ID_PAYMENT   = $re->payment_type ;
        $data->BILL_STATUS  = "Đã thanh toán";
        $data->Time_end  = $date;
        $point = round($re->paid/100000);
        $data->point = $point;
        $data->ID_STAFF = $id_staff;
        $data->save();
        $discount = $data->DISCOUNT;
        if($discount ==NULL){
            $discount =0;
        }

    // lưu dữ liệu vào bảng history_customer, cộng dồn điểm trong bảng customer
        if(session('id_customer') !=''){
            $id_customer = session('id_customer');
            DB::insert("insert history_customer(ID_CUSTOMERS,ID_BILL,POINT_USED)
               values($id_customer,$id_bill,$discount)");
            $cs = CustomerModel::find($id_customer);
            $cs->POINT_TOTAL += $point;
            $cs->save();

        }



       // đặt trạng thái trong bảng table

       $id_table = $re->id_table;
       $table = Table_order::find($id_table);
       $table->STATUS = "Sẵn sàng";
       $table->save();

        return "Success";
    }

    public function chart(){
        $BillModel = new BillModel();
        $data = $BillModel->get_chart() ;
        return view("amin.Home.chart",["data"=>$data]);
    }

    public function end_of(){
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $id_staff = Auth::guard('admin')->id();
        $billmodel = new BillModel();
        $sum = $billmodel->staff_end($id_staff);
        $detail = BillModel::where('ID_STAFF',$id_staff)
                            ->get(['ID_BILL','PAY']);
        return view("staff.end_of_shift",["sum"=>$sum,"detail"=>$detail,"date"=>$date]);
    }
}





