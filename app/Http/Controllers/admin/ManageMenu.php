<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnitModel as UnitModel;
use App\Models\DishtypeModel as DishtypeModel;
use App\Models\MenuModel as MenuModel;
use App\Models\Table_order as Table_order;
use App\Models\BillModel as  BillModel;
use App\Models\CommentModel as  CommentModel;

use DB;
use Illuminate\Support\Facades\Session;
class ManageMenu extends Controller
{
    private $path = "amin.Home.";
    public function list_menu(){
        $MenuModel = new MenuModel();
        $data = $MenuModel->get(null,['task'=>"get_all"]);
      //  $data =((array) $data);

        return view($this->path."List_menu",['items'=>$data]);
    }

    public function add_menu(){
        $UnitModel = new UnitModel();
        $DishtypeModel = new DishtypeModel();
        $Unit_arr = $UnitModel->get_all();
        $Dishtype_arr = $DishtypeModel->get_all();
       // print_r($Dishtype_arr);
        return view($this->path."Add_menu",['Units'=>$Unit_arr,'Dishtypes'=>$Dishtype_arr]);
    }

    public function submit_menu(Request $re){
        $MenuModel = new MenuModel();
        //$data = $re->input();
        $MenuModel->ID_DISH_TYPE = $re->dish_type;
        $MenuModel->ID_UNIT  = $re->unit;
        $MenuModel->DISH_PRICE= $re->price;
        $MenuModel->DISH_STATUS = $re->status;
       // $MenuModel->DISH_IMG  = $data->file('img');
       //$imageName = time().'.'.$re->image->extension();

        //$re->image->move(public_path('img/menu'), $imageName);
        $path = $re->img->move('img/menu');
        $MenuModel->DISH_IMG  = $path;
        $MenuModel-> DISH_NAME = $re->name;
        $MenuModel->DISH_DESCRIPTION = $re->description;
        $MenuModel->save();
      // echo $re->img;
        return redirect()->route('list_menu');
    }

    public function update_menu($id){
        return "update";
    }
    public function delete_menu($id){
        $MenuModel = new MenuModel();
        $data = MenuModel::find($id);
        $data->active = 0;
        $data->save();
        return redirect()->route('list_menu');
    }

////////////////////////////////////////////////////////////////////////////
    public function show_menu(){
        $MenuModel = new MenuModel();
        $data = $MenuModel->get(null,['task'=>'get_all']);
        $DishtypeModel = new DishtypeModel();
        $type = $DishtypeModel->get_all();
      //  dd($type);
        return view("Homepage.main",["data"=>$data,"type"=>$type]);
    }

    public function detail_menu($id){
        // lấy chi tiết món ăn
        $MenuModel = new MenuModel();
        $data = $MenuModel->get($id,['task'=>'menu_with_id']);

        // Lấy bình luận đánh giá
        $CommentModel = new CommentModel();
        $comment = $CommentModel->get_cmt($id);
        $cmt = CommentModel::where('ID_DISH',$id)->get();
        $rating_bad = $cmt->where('RATE','Tệ')->count();
        $rating_normal=$cmt->where('RATE','Bình thường')->count();
        $rating_wonder=$cmt->where('RATE','Xuất sắc')->count();

        return view('Homepage.detail_menu',['data'=>$data,'comment'=>$comment,
        'rating_bad'=>$rating_bad,'rating_normal'=>$rating_normal,'rating_wonder'=>$rating_wonder]);
    }

    public function _menu($id_table,$table_number){
        $MenuModel = new MenuModel();
        $table = new Table_order();
    // Đặt trạng thái hoạt động của bàn

        $datas=Table_order::find($id_table);
        if ( $datas->STATUS == "Sẵn sàng") {
            $datas->STATUS = "Hoạt động";
            $datas->save();
            session()->push('id_table',$id_table);
            session()->push('status',"Hoạt động");
            $BillModel = new BillModel();
            $BillModel->ID_TABLE = $id_table;
            $BillModel->BILL_STATUS = "Chưa thanh toán";
            $BillModel->TOTAL = 0;
            $BillModel->save();
            $lastID = DB::getPdo()->lastInsertID();
            $data = $MenuModel->get(null,['task'=>'get_all']);
            $DishtypeModel = new DishtypeModel();
            $type = $DishtypeModel->get_all();
            return view('Homepage.main',['data'=>$data,'id_table'=>$id_table,
            'table_number'=>$table_number,'id_bill'=>$lastID,"type"=>$type]);
        }
        else{
            //return redirect()->back();
            if (session()->exists('status')) {
                //
                $data = $MenuModel->get(null,['task'=>'get_all']);
                $BillModel = new BillModel();
                $items = BillModel::where('ID_TABLE',$id_table)
                                    ->where('BILL_STATUS','Chưa thanh toán')->get();
                $id_bill=$items[0]->ID_BILL;
               //return $id_bill;
               $DishtypeModel = new DishtypeModel();
               $type = $DishtypeModel->get_all();
                return view('Homepage.main',['data'=>$data,'id_table'=>$id_table,
                'table_number'=>$table_number,'id_bill'=>$id_bill,"type"=>$type]);

            }else{
                return redirect()->back();
            }
            // return view('Homepage.main',['data'=>$data,'id_table'=>$id_table,'table_number'=>$table_number,'id_bill'=>$lastID]);
        }

    }
    public function menu_type(Request $re){
        $id_dish_type = $re->dish_type;
        $id_table = $re->id_table;
       // dd($id_table);
        $MenuModel = new MenuModel();
        $data = $MenuModel->get($id_dish_type,['task'=>'menu_type']);
        return view("Homepage.menu_type",["data"=>$data,"id_table"=>$id_table]);
    }

    public function status_menu(){
        $data = MenuModel::where('active',1)
                        ->get(['ID_DISH','DISH_NAME','DISH_STATUS']);
        return view('staff.status_menu',['data'=>$data]);
    }

    public function handling_update_status(Request $re){
        $id_dish = $re->id_dish;
        $dish_status = $re->dish_status;
        $data = MenuModel::find($id_dish);
        $data->DISH_STATUS=$dish_status;
        $data->save();
        return "success";
    }

}
