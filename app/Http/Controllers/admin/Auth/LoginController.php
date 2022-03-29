<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StaffModel as StaffModel;
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
        $phone = $request->phone;
        $password = $request->password;
        $password =  bcrypt($password);
        $StaffModel = new StaffModel();

        $i = $StaffModel::where('STAFF_PHONE',$phone)->count();
        if($i!=0){
            $pwd = $StaffModel::get();
            return $pwd;
        }

        //return $i;
        // if($i==0)
        //     return redirect()->back()->withErrors(['err_mess'=>'Số điện thoại hoặc mật khẩu không chính xác!']);
        // else
        //     return redirect()->rouet("ManageStaff");
    }
}
