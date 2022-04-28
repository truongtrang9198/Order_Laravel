<style>
    /* #select_menu{
        width: 250px;
    } */
</style>
<link rel="stylesheet" href="{{asset('http://localhost/Order_Laravel/resources/css/main.css')}}">

@extends('Homepage.Home')
@section('tile', 'Welcome')
@section('main')
@parent
<div class="container-fluid">
    <div class="row">
        <div class="col-xm-12 col-md-6">
            @include('Homepage.slide_img')
            <br>
            <div class="detail_table">
                <h5>Bàn:
                    @php
                    if (empty($table_number)) {
                          return redirect()->route('/');
                    }else
                        $tr ="<input id='number_table' type='text' value='$table_number' hidden>";
                        echo $tr;
                        echo $table_number;
                    @endphp
                    <a href="{{route("show_bill",["id_bill"=>$id_bill])}}"> <lord-icon
                        src="https://cdn.lordicon.com/aslgozpd.json"
                        trigger="hover"
                        style="width:24px;height:24px">
                    </lord-icon></a>
                    <button class="btn btn-outline-info " data-toggle="modal" data-target="#show_discount"> <small> Khuyến mãi </small></button>

                </h5>
                <span>
                    <form action="{{route('menu_type')}}" method="get" id="form-search">
                        <select name="dish_type" id="select_menu" class="custom-select">
                            @php
                                 foreach ($type as $ty){
                                     $tr = " <option value='$ty->ID_DISH_TYPE'>$ty->DISH_TYPE_NAME</option>";
                                     echo $tr;
                                 }
                            @endphp

                        </select>
                        <button class="btn btn-outline-info" type="submit"><i class="fas fa-search" style="font-size:21px"></i></button>
                        <input type="text" name="id_table" value="{{$id_table}}" hidden>
                    </form></span>
            {{--  --}}



            </div>
            @include('Homepage.menu')
        </div>
    </div>

{{-- Modal --}}
<div class="modal fade" tabindex="-1" id="show_discount">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
              <h5><b>Chương trình khuyến mãi</b>  </h5>
              <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
              </button>
             </div>
             <div class="modal-body">
                 <p><b>*Tích lũy</b> </p>
                <p>Với mỗi 100.000 trên hóa đơn khách hàng sẽ tích lũy được 1 điểm.</p>
                <p> <b>*Sử dụng điểm</b> </p>
                <p>Giảm 10% trên tổng giá trị hóa đơn sẽ sử dụng 10 điểm bạn tích lũy được</p>
             </div>
          </div>
        </div>

</div>

</div>


@endsection

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.lordicon.com/lusqsztk.js"></script>
{{-- Ngăn không cho quay lại giao diện chọn bàn tạo vòng lặp vô hạn mỗi khi nhắn quay lại--}}
<script>
    $( window ).on( "load", function(){
        var number_table = $('#number_table').val();
    });
    history.pushState(null, null, number_table);
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, number_table);
    });
    </script>
