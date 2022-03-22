{{-- mẫu test --}}
@extends('amin.Home')
@section('tile', 'Quản lý menu')
@section('main')
    @parent
    <div class="container-fluid" id="add-container">
        <div class="add-menu">
            <a class="btn " id="btn-add-menu" href="{{ route('add_menu') }}"><i class="fa-solid fa-plus"></i>
            </a>
        </div>
        <table class="table" id="">
            <thead>
              <tr>
                <th colspan="6" class="text-center"><h4>Danh sách món ăn</h4> </th>
              </tr>
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên món</th>
                <th scope="col">Đơn vị</th>
                <th scope="col">Loại</th>
                <th scope="col">Giá</th>
                <th>Trạng thái</th>
                <th>Mô tả</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>

                  <?php
                      $n=1;
                      //$items = (array)$items;
                      //echo $items->DISH_NAME;
                      foreach ($items as $item){
                        $url_update =  route("update_menu",["id"=>$item->ID_DISH]);
                        $url_delete =  route("delete_menu",["id"=>$item->ID_DISH]);
                          $str = '
                          <tr>
                            <th scope="row">'.$n.'</th>
                            <td>'.$item->DISH_NAME.'</td>
                            <td>'.$item->UNIT_NAME.'</td>
                            <td>'.$item->DISH_TYPE_NAME.'</td>
                            <td>'.$item->DISH_PRICE.'</td>
                            <td>'.$item->DISH_STATUS.'</td>
                            <td>'.$item->DISH_DESCRIPTION.'</td>
                            <td> <a href="'.$url_update.'"><i class="fa-solid fa-pen"></i></a></td>
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
