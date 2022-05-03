<?php

namespace App\Http\Controllers;
use App\Models\CustomerModel as CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
class CustomerController extends Controller
{
    public function custom_login(Request $request){
        $customer = new CustomerModel();
        $data = $request->input();
        $phone = $request->phone;
        $name = $request->name;
        $condition = CustomerModel::where('PHONE',$phone)->count();
        if( $condition == 0){
            $customer->PHONE = $phone;
            $customer->FULLNAME = $name;
            $customer->POINT_TOTAL	= 0;

            $customer->save();
            $id_customer = DB::getPdo()->lastInsertId();
        }else{
            $items = CustomerModel::where('PHONE',$phone)
                    ->get();
            foreach ($items as $item)
                $id_customer = $item->ID_CUSTOMERS;
        }
    // lưu trữ session
       // session(['username' => ]);
        session(['username' => $name]);
        session(['id_customer' => $id_customer]);
        return redirect()->route('choose_table');

    }

    public function custom_login2(Request $request){

        $customer = new CustomerModel();
        $data = $request->input();
        $phone = $data['phone'];
        $name = $data['name'];
        $condition = CustomerModel::where('PHONE',$phone)->count();
        if( $condition == 0){
            $customer->PHONE = $phone;
            $customer->FULLNAME = $name;
            $customer->POINT_TOTAL	= 0;

            $customer->save();
            $id_customer = DB::getPdo()->lastInsertId();
        }else{
            $items = CustomerModel::where('PHONE',$phone)
                    ->get();
            foreach ($items as $item)
                $id_customer = $item->PHONE;
        }
    // lưu trữ session
       // session(['username' => ]);
        session(['username' => $name]);
        session(['id_customer' => $id_customer]);
        return session('username');

    }

    public function exit(){
        session()->forget('username');
        session()->forget('id_customer');

        // session(['username' => '']);
        // session(['id_customer' => '']);
        return redirect()->route('begin');
    }
// Kiểm tra đủ điều kiện sử dụng khuyến mãi hay không
    public function check_discount(){
        if(session()->exists('id_customer') && session('id_customer')!=''){
            $id_customer = session('id_customer');
            $condition = CustomerModel::where('ID_CUSTOMERS',$id_customer)
                                        ->get();
           // dd($condition);
           foreach ($condition as $item)
                $point = $item->POINT_TOTAL;

           // $point = $condition->POINT_TOTAL;
            return  $point;
        }else{
            return "Null";
        }
    }
// Xem lịch sử
    public function history(){
        $id_customer = session('id_customer');
        $CustomerModel = new CustomerModel();
        $info = CustomerModel::find($id_customer);
        $data = $CustomerModel->customer_history($id_customer);
         $total = $CustomerModel->Total($id_customer);

        return view("Homepage.history",["info"=>$info,"total"=>$total,"detail"=>$data]);
    }

    public function user_update(Request $re){
        $id_customer = session('id_customer');
        $ne_name = $re->ne_name;
       $CustomerModel =  CustomerModel::find($id_customer);
       $CustomerModel->FULLNAME = $ne_name;
       $CustomerModel->save();
        return $ne_name;

    }
}
