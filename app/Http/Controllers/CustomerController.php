<?php

namespace App\Http\Controllers;
use App\Models\CustomerModel as CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function custom_login(Request $request){
        $customer = new CustomerModel();
        $data = $request->input();
        $phone = $data['phone_cutomer'];
        $name = $data['name_cutomer'];
        $condi = CustomerModel::where('PHONE',$phone)->count();
        if( $condi == 0){
            $customer->PHONE = $phone;
            $customer->FULLNAME = $name;
            $customer->POINT_TOTAL	= 0;

            $customer->save();
        }
    // lưu trữ session
       // session(['username' => ]);
        Session::push('username',$name);
        return redirect()->route('choose_table');

    }
}
