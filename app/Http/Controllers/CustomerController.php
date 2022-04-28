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
}
