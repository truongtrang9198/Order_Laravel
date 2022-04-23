<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
class CommentController extends Controller
{
    //
    public function check_condition(){
        if(session('username') != null){
            return session('username');
        }else{
            return "null";
        }

    }

    public function go_comment($id_bill){
        $data = DB::select("call show_menu_comment($id_bill)");
        //dd($data);
        return view('Homepage.rating',["data"=>$data]);
    }
}
