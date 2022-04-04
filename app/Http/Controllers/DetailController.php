<?php
    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\TypetabModel as TypetabModel;
    use App\Models\Table_order as Table_order;
    use App\Models\MenuModel as MenuModel;
    use App\Models\BillModel as BillModel;
    use DB;
    class DetailController extends Controller
{

    public function add_order(Request $re){
        $data = $re->input();
        $id_menu = $data['id_menu'];
        $id_table = $data['id_table'];
        $note = $data['note'];
       $condition = DB::select('call condition_id('.$id_table.')');
        // lấy giá tiền
        $menu = MenuModel::find($id_menu);
        $price =  $menu->DISH_PRICE;
        if($condition ==NULL){
            // DB::select('call insert_bill('.$id_menu.')');
            DB::insert('insert into bill (TOTAL,BILL_STATUS) values (?, ?)', [$price,'Chưa thanh toán']);
            $lastID = DB::getPDO()->lastInsertId();
            DB::insert('insert into order_detail (ID_TABLE, ID_DISH,ID_BILL,QUANTITY,STATUS_DETAIL,
            NOTE) values (?,?,?,?,?,?)', [$id_table,$id_menu,$lastID,
                                                    1,'Tiếp nhận',$note]);

        }else{
            $id = $condition['ID_BILL'];
            // Thêm vào order_detail
            DB::insert('insert into order_detail (ID_TABLE, ID_DISH,ID_BILL,QUANTITY,STATUS_DETAIL,
            NOTE) values (?,?,?,?,?,?)', [$id_table,$id_menu,$id,
                                                    1,'Tiếp nhận',$note]);
            // cộng dồn giá tiền
            $bill = BillModel::find($id);
            $bill->TOTAL = $bill->TOTAL + $price;
            $bill->save();
        }

        return $condition[0]->ID_BILL;
    }



}
?>
