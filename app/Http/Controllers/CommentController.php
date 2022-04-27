<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentModel as CommentModel;
use App\Models\DetailModel as DetailModel;
use Session;
use DB;
use Carbon\Carbon;
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
        $count = DetailModel::where('ID_BILL',$id_bill)
                                ->where('comment_check',0)
                                ->count();
        //dd($data);
        return view('Homepage.rating',["data"=>$data,"count"=>$count]);
    }

    public function insert_cmt(Request $re){
        $id_dish = $re->id_dish;
        $content = $re->content;
        $rating =  $re->rating;
        $id_bill = $re->id_bill;
        $id_detail = $re->id_detail;
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $id_custom = session('id_customer');

        DB::insert('insert into comment (ID_CUSTOMERS,ID_DISH,COMMENT_DETAIL,
        RATE,TIME) values (?, ?,?,?,?)', [$id_custom,$id_dish,$content,$rating,$date]);

       /// DB::select("call change_comment_check($id_bill,$id_dish)");
       $data = DetailModel::find($id_detail);
       $data->comment_check = 1;
       $data->save();

        return "Success";
    }

}
