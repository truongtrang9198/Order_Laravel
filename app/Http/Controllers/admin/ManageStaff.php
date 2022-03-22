<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\CityModel as CityModel;
use App\Models\DistrictModel as DistrictModel;
use App\Models\StaffModel as StaffModel;
use App\Models\AddressModel as AddressModel;
use App\Models\PositionModel as PositionModel;
class ManageStaff extends Controller
{
    //
    // public function __construct() {
    //     $this->middleware('auth');
    // }
    private $pathview = "amin.";
    public function show()
    {
        return "hello";
    }

    public function login(){
        return view($this->pathview."home.login");
    }

    public function getlogin(Request $request){

        $phone = $request->phone;
        $password = $request->password;
        if(Auth::attempt(['phone' => $phone, 'password' => $password])){
            echo "thành công";
        }else{
            echo "Thất bại";
        }
       // return view($this->pathview."home.login");
    }
    public function home(){
        return view($this->pathview."home");
    }
    // public function add(){
    //     return view($this->pathview.'Home.Add_staff');
    // }
    public function list(){
        $StaffModel = new StaffModel();
        $items = $StaffModel ->getData(null,['task'=>"get-all"]);
        return view('amin.Home.list_staff',['items'=>$items]);
    }
// Kiểm tra kết nối database
    public function add(){
        $CityModel = new CityModel();// lấy hết giá trị trong bảng city = select * from city;
        $PositionModel = new PositionModel();
        $items = $CityModel->getData(null,['task'=>"get-city"]);
        $data = $PositionModel->getData(null,['task'=>"get-all"]);
        return view($this->pathview.'Home.Add_staff',['items'=>$items,'data'=>$data]);

    }
// lấy dữ liệu của table District
    public function get_district(Request $request){
        $DistrictModel = new DistrictModel();
        $param = $request->ID_CITY;
        $items = $DistrictModel ->getData($param,['task'=>"get-district"]);
         return response()->json(['id_district'=> $items]);
    }
// Kiểm tra thông tin nhập
    public function check_info(Request $request){
       $StaffModel = new StaffModel();
       $items = $StaffModel ->getData($request,['task'=>"check_info"]);
       return response()->json(['inx'=>$items]);
    }
// Thêm dữ liệu của nhân viên
    public function submit_staff(Request $request){
        $StaffModel = new StaffModel();
        $addresModel = new AddressModel();
        $data = $request->input();
        $StaffModel->STAFF_FULLNAME = $data['name'];
        $StaffModel->SEX = $data['sex'];
        $StaffModel->BIRTHDAY = $data['birthday'];
        $StaffModel->IDENTITY_PAPER = $data['cccd'];
        $StaffModel->STAFF_PHONE= $data['phone'];
        $StaffModel->STAFF_STATUS= 'Làm việc';
        $StaffModel->ID_POSITION= $data['position'];
        $StaffModel->START_DAY = Carbon::now();
        // Xử lý mật khẩu
        $StaffModel->STAFF_PWD = bcrypt($data['pwd']);
        $path = $request->img_staff->move('img/staff');
        $StaffModel->STAFF_IMG = $path;
        $StaffModel->save();
        // Thêm dữ liệu vào bảng address
        $addresModel->ID_DISTRICT = $data['district'];
        $addresModel->ADDRESS_DETAIL= $data['address'];
        $addresModel->ID_STAFF = DB::getPdo()->lastInsertId();
        $addresModel->save();
       return redirect()->route('ManageStaff');
     }

     public function delete_staff($id){
        return view($this->pathview.'Home.del_staff',['id'=>$id]);

     }

     public function update_staff($id){
        $StaffModel = new StaffModel();
        $param = $id;
        $data = $StaffModel->getData($param,['task'=>"get_with_id"]);
        $address = $StaffModel->getData($param,['task'=>"get_address_with_id"]);

       return view($this->pathview.'Home.update_staff',['item'=>$data,'address'=>$address]);

    }

    public function _del_staff(Request $request){
        $id = $request->id_staff;
        $StaffModel = new StaffModel();
        $addressModel = new  AddressModel();
// cập nhật lại trường active = 0 ;
        $data=StaffModel::find($id);
        $data->active = 0;
        $data->save();

        // $dt = addressModel::where('ID_STAFF',$id)->get();
        // $dt->active =0;
        // $dt->save();

        return response()->json(['bool'=> 'True']);

    }

    public function update_img(Request $re){
        $StaffModel = new StaffModel();
        $id = $re->ID_STAFF;
        $path = $re->img_staff->move('img/staff');
        $data = StaffModel::find($id);

        $data->STAFF_IMG = $path;
        return redirect()->route('ManageStaff');
    }




};
