@extends('Homepage.Home')
@section('tile', 'Welcome')
@section('main')
@parent
<div class="container">
    <div class="row">
        <div class="col-xm-12">
            <p class="text-warning">Quý khách vui lòng chọn số bàn </p>
            <p class=""><small><span class="text-info">*Màu xanh</span> là bàn hiện đang sẵn dùng</small></p>
            <p class=""><small><span class="text-warning">*Màu vàng</span> là bàn đang được sử dụng</small></p>

            <div class="d-flex flex-wrap">

            @php
            foreach($items as $item){
               $url = route("menu",["id_table"=>$item->ID_TABLE,"number_table"=>$item->NUMBER_TABLE]);

               if ( $item->STATUS == 'Hoạt động') {
                    $tr = '<div class="p-2 m-2 bg-warning"><a href="#" class="button nav-link text-light">'.$item->NUMBER_TABLE.'</a></div>';
                    echo $tr;
                }else if($item->STATUS == 'Sẵn sàng'){
                    $tr = '<div class="p-2 m-2 bg-info"><a href="'. $url.'" class="button nav-link text-light">'.$item->NUMBER_TABLE.'</a></div>';
                    echo $tr;
                }else if($item->STATUS == 'Sửa chữa'){
                    $tr = '<div class="p-2 m-2 bg-secondary"><a href="#" class="button nav-link text-light">'.$item->NUMBER_TABLE.'</a></div>';
                    echo $tr;
                }

            }

        @endphp
        </div>
        </div>

    </div>
</div>


@endsection


