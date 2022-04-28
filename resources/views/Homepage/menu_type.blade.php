@extends('Homepage.Home')
@section('tile', 'Welcome')
@section('main')
@parent
<button type="button" onclick="history.back()" class="btn btn-danger">Trở về</button>

@php
    foreach ($data as $dt)
    {
        $url = asset($dt->DISH_IMG);
        $url_detail = route("detail_menu",["id"=>$dt->ID_DISH]);
       //$url_detail = "eeer0";
     //  echo  $url_detail;
        $price = number_format($dt->DISH_PRICE);
      $s = '';
      $tr='
        <div class="card mb-3 ">

            <div class="row no-gutters ">
            <div class="col-xm-4">
                <img class="img_detail" src="'.$url.'" class="card-img" alt="..." style="padding-top:10px; padding-bottom:10px; "
                width="200px" height="150px"    >
            </div>
            <div class="col-xm-8">
                <form class="form-order">
                <div class="card-body card-body-custom">
                <h5 class="card-title">'.$dt->DISH_NAME.'</h5>
                <span class="text-muted">Loại: '.$dt->DISH_TYPE_NAME.' </span> <br>
                <span class="text-danger text-bold">'.$price.' VND/'.$dt->UNIT_NAME.'</span> <br>';
            if($dt->DISH_STATUS == "Phục vụ"){
                $s='<button type="submit" class="btn btn-outline-primary"><i class="fas fa-utensils"></i></button>';
            } else {
                $s='<button type="submit" class="btn btn-outline-danger" disabled="disabled"><i class="fas fa-ban"></i></button>';
            }

            $s2='&nbsp; <a href="'.$url_detail.'">Chi tiết</a>
                </div>
                <input type="text" name="id_menu" value="'.$dt->ID_DISH.'" hidden>
              </form>
            </div>
            </div>
        </div>';
        echo $tr.$s.$s2;
}
    echo "<span class='text-muted'><i> Không còn món ăn để hiển thị</i></span>"
@endphp

<input type="text" name="id_table" id="id_table" value="{{ $id_table }}" hidden>
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
// set up ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.form-order').submit(function(event){
        event.preventDefault();
        var form_menu = $(this).serialize();
        var index = form_menu.indexOf('=');;
        let id_menu = form_menu.slice(index + 1);
        // khai báo let thì bên kia nhận, var thì hông ? méo hiểu
      // var id_menu = $(this).siblings('input').val();
        var id_table = $('#id_table').val();
        //alert(id_table);
     $('#ModelNote').show();
      let note = prompt("Thêm ghi chú cho nhân viên");
        $.post("{{route('add_order')}}",{id_menu:id_menu,id_table:id_table,note:note},function(data){
             alert(data);
        })
    })



});
</script>

