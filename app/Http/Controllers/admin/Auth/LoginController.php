<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StaffModel as StaffModel;
use DB;
use App\Models\User as User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // if ($request->getMethod() == 'GET') {
        //     return view('amin.home.login');
        // }
        return view('amin.home.login');

        // $credentials = $request->only(['email', 'password']);
        // if (Auth::guard('admin')->attempt($credentials)) {
        //     return redirect()->route('dashboard');
        // } else {
        //     return redirect()->back()->withInput();
        // }
    }
    public function getlogin(Request $request){
        $phone = $request->STAFF_PHONE;
        $password = $request->STAFF_PWD;
       // $password =  bcrypt($password);
        $StaffModel = new User();
       // echo bcrypt(123456);
      //  dd($request->only('STAFF_PHONE','STAFF_PWD'));
        $i = User::where('STAFF_PHONE',$phone)
                ->where('active',1)
                ->count();


        if($i!=0){
          // $pwd = DB::select("select STAFF_PWD from staff where STAFF_PHONE = $phone");
         //  $password_db = $pwd[0]->STAFF_PWD;

        dd(Auth::attempt(['STAFF_PHONE'=>$phone,'STAFF_PWD'=>$password,
                                           'active'=>1]));
          // dd(Auth::attempt($request->only('STAFF_PHONE','STAFF_PWD')));
           if(Auth::guard('admin')->attempt($request->only('STAFF_PHONE','STAFF_PWD')));

        }else{

            return redirect()->route('login')->with('error',('Số điện thoại không chính xác'));
        }

    }
}
