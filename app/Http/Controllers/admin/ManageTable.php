<?php
    namespace App\Http\Controllers\admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\TypetabModel as TypetabModel;
    use App\Models\Table_order as Table_order;
    use DB;
    class ManageTable extends Controller
{


    private $path = "amin.Home.";
    public function __construct(){


    }
    public function home(){
        $Table_order = new Table_order();
        $items = $Table_order->list();
        return view($this->path.'List_table',['items'=>$items]);
    }
    public function add(){
        $TypetabModel = new TypetabModel();
        $item = $TypetabModel->get();
        return view ($this->path.'Add_table',['items'=>$item]);
    }

    public function insert_type_table(Request $request){
        $TypetabModel = new TypetabModel();
        $data = $request->input();
        $TypetabModel->NAME_TABLE_TYPE = $data['type-table-name'];
        try {
            $TypetabModel->save();
        } catch (ErrorException $exception) {
            return redirect()->route('add_table');
        }finally {
            return redirect()->route('add_table');
        }

        return redirect()->route('add_table');
    }
    public function insert_table(Request $request){
        $Table_order = new Table_order();
        $data = $request->input();
        $Table_order->NUMBER_TABLE = $data['num_table'];
        $Table_order->ID_TABLE_TYPE = $data['type_table'];
        $Table_order->DESCRIPTION = $data['descript'];
        $Table_order->LOCATION = $data['locate'];
        $Table_order->STATUS = $data['status'];
        $Table_order->save();
        return redirect()->route('ManageTable');
    }

    public function update_table($id){
        $Table_order = new Table_order();
     //   $data = $Table_order->get($id,['task'=>'get-with-id']);
       // return view('$this->path.update_table',['data'=>$data]);
       return "ok";
    }

    public function delete_table($id){
        return view($this->path.'del_table',['id'=>$id]);

     }
    public function _del_table(Request $request){
        $id = $request->id_table;
        $Table_order = new Table_order();
// cập nhật lại trường active = 0 ;
        $data=Table_order::find($id);
        $data->active = 0;
        $data->save();

        // $dt = addressModel::where('ID_STAFF',$id)->get();
        // $dt->active =0;
        // $dt->save();

        return response()->json(['bool'=> 'True']);

    }


}
?>
