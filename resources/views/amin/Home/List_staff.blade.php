{{-- mẫu test --}}
@extends('amin.Home')
@section('tile', 'Quản lý nhân viên')
@section('main')
@parent
    <div class="container-fluid" id="">
        <div class="add-staff">
            <a class="btn" id="btn-add-form" href="{{ route('add_staff') }}"><i class="fa-solid fa-plus"></i> </a>
        </div>
        <table class="table" id="table-staff">
            <thead>
              <tr>
                <th colspan="6" class="text-center"><h4>Danh sách nhân viên</h4> </th>
              </tr>
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Họ tên</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Chức vụ</th>
                <th scope="col">Trạng thái</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>

                  <?php
                      $n=1;
                      foreach ($items as $item){
                        $url_update =  route("update_staff",["id"=>$item->ID_STAFF]);
                        $url_delete =  route("delete_staff",["id"=>$item->ID_STAFF]);
                          $str = '
                          <tr>
                            <th scope="row">'.$n.'</th>
                            <td>'.$item->STAFF_FULLNAME.'</td>
                            <td>'.$item->STAFF_PHONE.'</td>
                            <td>'.$item->POSITION_NAME.'</td>
                            <td>'.$item->STAFF_STATUS.'</td>
                            <td> <a href="'.$url_update.'"><i class="fa-regular fa-address-card"></i></a></td>
                            <td> <a href="'.$url_delete.'"><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>
                          ';
                          $n++;
                          echo $str;
                      }
                  ?>

            </tbody>
          </table>
    </div>
@endsection


