<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StaffModel as StaffModel;
use DB;
use App\Models\User as User;
use App\Models\PositionModel as PositionModel;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        return view('amin.home.login');
    }
    public function getlogin(Request $request){
        $phone = $request->STAFF_PHONE;
        $password = $request->password;
        $StaffModel = new User();
       // echo bcrypt(123456);
      //  dd($request->only('STAFF_PHONE','STAFF_PWD'));
        $i = User::where('STAFF_PHONE',$phone)
                ->where('active',1)
                ->count();


        if($i!=0){

        // dd(Auth::guard('admin')->attempt($request->only('STAFF_PHONE','password')));
        if(Auth::guard('admin')->attempt($request->only('STAFF_PHONE','password')));
            $position = User::where('STAFF_PHONE',$phone)
                                ->where('active',1)
                                ->get('ID_POSITION');

            foreach($position as $pos)
                $id_pos = $pos->ID_POSITION;

            // điều hướng
            $data = PositionModel::find($id_pos);
            if($data->POSITION_NAME == "Admin")
                return redirect()->route('home');

            if($data->POSITION_NAME == "Thu ngân")
                return redirect()->route('page_payment');

            if($data->POSITION_NAME == "Bếp")
                return redirect()->route('order_process');

        }else{

            return redirect()->route('login')->with('error',('Số điện thoại không chính xác'));
        }

    }
}
