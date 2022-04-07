<?php
    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\TypetabModel as TypetabModel;
    use App\Models\Table_order as Table_order;
    use App\Models\MenuModel as MenuModel;
    use App\Models\BillModel as BillModel;
    use App\Models\DetailModel as DetailModel;
    use DB;
    use Carbon\Carbon;

    class DetailController extends Controller
{

    public function add_order(Request $re){
        $data = $re->input();
        $id_menu = $data['id_menu'];
        $id_table = $data['id_table'];
        $note = $data['note'];
        $time = Carbon::now('Asia/Ho_Chi_Minh');
      // $condition = DB::select('call condition_id('.$id_table.')');
        // lấy giá tiền
        $menu = MenuModel::find($id_menu);
        $price =  $menu->DISH_PRICE;

        $data_id = BillModel::getid( $id_table);
        $id_detail = $data_id[0]->ID_BILL;
            DB::insert('insert into order_detail (ID_DISH,ID_BILL,QUANTITY,STATUS_DETAIL,
            NOTE,TIME_ORDER) values (?,?,?,?,?,?)', [$id_menu,$id_detail,
                                                    1,'Tiếp nhận',$note,$time]);
        //     // cộng dồn giá tiền
            $bill = BillModel::find($id_detail);
            $bill->TOTAL = $bill->TOTAL + $price;
            $bill->save();


        return "Gọi món thành công!";
       //return  $id;
    }

    public function show_bill($id_bill){

        $DetailModel = new DetailModel();
        $items = $DetailModel->getBill($id_bill);

        // print_r($items);
       return  view("Homepage.showbill",["items"=>$items]);
    }

    public function order_process(){
            $DetailModel = new DetailModel();
            $data = $DetailModel->order();
            //return $data;
        return view("staff.order",["data"=>$data]);
    }




}
?>
