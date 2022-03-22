{{-- mẫu test --}}
@extends('amin.Home')
@section('tile', 'Quản lý bàn')
@section('main')
@parent
    <div class="container-fluid">
        <div class="add-staff">
            <a class="btn " id="btn-add-table" href="{{ route('add_table') }}"><i class="fa-solid fa-plus"></i> </a>
        </div>
        <table class="table" id="table-staff">
            <thead>
              <tr>
                <th colspan="7" class="text-center"><h4>Danh sách bàn</h4> </th>
              </tr>
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Loại bàn</th>
                <th scope="col">Tên bàn</th>
                <th scope="col">Vị trí</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Ghi chú</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>

              @php
                    $n = 1;
                  foreach($items as $item){
                      $url_update = route("update_table",["id"=>$item->ID_TABLE]);
                      $url_delete = route("delete_table",["id"=>$item->ID_TABLE]);
                    $str = '
                          <tr>
                            <th scope="row">'.$n.'</th>
                            <td>'.$item->NAME_TABLE_TYPE.'</td>
                            <td>'.$item->NUMBER_TABLE.'</td>
                            <td>'.$item->LOCATION.'</td>
                            <td>'.$item->STATUS.'</td>
                            <td>'.$item->DESCRIPTION.'</td>
                            <td><a href="'.$url_update.'"><i class="fa-regular fa-address-card"></i></a></td>
                            <td><a href="'.$url_delete.'"><i class="fa-solid fa-trash-can"></i></a></td>

                            </tr>
                          ';


                          $n++;
                          echo $str;
                  }
              @endphp

            </tbody>


          </table>
    </div>

@endsection


