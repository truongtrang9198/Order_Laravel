<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnitModel as UnitModel;
use App\Models\DishtypeModel as DishtypeModel;
use App\Models\MenuModel as MenuModel;
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

        return view('Homepage.main',['data'=>$data]);
    }
    public function detail_menu($id){
        $MenuModel = new MenuModel();
        $data = $MenuModel->get($id,['task'=>'menu_with_id']);
       // return $data;
        return view('Homepage.detail_menu',['data'=>$data]);
    }


}
