@extends('Homepage.Home')
@section('tile', 'Welcome')
@section('main')
@parent
<div id="rating">
    <h5>Bạn cảm thấy bữa ăn này như thế nào?</h5>
    <span id="">
    &nbsp;
     <button id="fa-frown" class="btn btn-rating" data-toggle="tooltip"data-placement="bottom" title="Bình thường thôi">
         <i class="far fa-frown" style="font-size:34px"></i></button> &nbsp;
     <button id="fa-smile" class="btn btn-rating" data-toggle="tooltip"data-placement="bottom" title="Bình thường thôi">
        <i class="far fa-smile"style="font-size:34px" ></i> </button> &nbsp;
     <button id="fa-heart" class="btn btn-rating" data-toggle="tooltip"data-placement="bottom" title="Bình thường thôi">
         <i class="far fa-grin-hearts"style="font-size:34px"></i></button>
</span>
<span id="mess" class="text-muted"></span>

</div>
<div>

</div>
<a href="{{route('exit')}}"><i class="fas fa-arrow-alt-circle-left"></i>Thoát</a>
<div id="comment_area">

<input type="text" id="count" value="{{$count}}" hidden>
@php


foreach ($data as $dt)
{
    $url = asset($dt->DISH_IMG);

   //$url_detail = "eeer0";
 //  echo  $url_detail;

  $tr='
    <div class="card mb-3 ">

        <div class="row no-gutters ">
        <div class="col-xm-4">
            <img class="img_detail" src="'.$url.'" class="card-img" alt="..." style="padding-top:10px; padding-bottom:10px; "
            width="200px" height="150px"    >
        </div>
        <div class="col-xm-8">
            <div class="card-body card-body-custom1">
            <h5 class="card-title">'.$dt->DISH_NAME.'</h5>
            </div>
        </div>

        </div>
        <form class="form_cmt">
            <input type="text" name="id_menu" value="'.$dt->ID_DISH.'" hidden>
                <textarea name="content" class="md-textarea form-control" rows="3"></textarea>
                <input name="id_detail" value="'.$dt->ID_DETAIL.'" hidden>
                <button type="submit" class="btn btn-primary" name="btn_submit">Bình luận</button>
          </form>
    </div>';

    echo $tr;
}
@endphp
{{-- <input type="text" id="id_bill" value="{{ $id_bill}}" hidden> --}}
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.lordicon.com/lusqsztk.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
    #farss{
        border: none;
        background-color:white;
    }
    i:hover{
        color: orangered;
    }

</style>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    // Kiểm tra giá trị count để điều hướng
        var count = $('#count').val();
        //alert(count);
        if(count==0){
            let mess ="<br><br><small>Không còn món ăn để đánh giá</small><br></br>";
            $('#mess').html(mess);

        }
    // đặt giá trị rating và hiển thị thông báo
        var rating ='none';
        $('#fa-frown').click(function(){
            // reset trạng thái
            $('#fa-smile').css('border-color','');
            $('#fa-smile').css('color','');
            $('#fa-heart').css('border-color','');
            $('#fa-heart').css('color','');
            rating='Tệ';
        // Đặt trạng thái
            $('#fa-frown').css('border-color','blue');
            $('#fa-frown').css('color','#838B8B');
            let mess ="<br><br><small>Chúng tôi xin lỗi vì đã không phục vụ chu đáo!</small><br></br>";
            $('#mess').html(mess);
        })

        $('#fa-smile').click(function(){
            rating='Bình thường';
            // reset trạng thái
            $('#fa-frown').css('border-color','');
            $('#fa-frown').css('color','');
            $('#fa-heart').css('border-color','');
            $('#fa-heart').css('color','');
        // đặt trạng thái
            $('#fa-smile').css('border-color','blue');
            $('#fa-smile').css('color','pink');
              let mess ='<br><br><lord-icon src="https://cdn.lordicon.com/dzllstvg.json" trigger="loop" style="width:34px;height:34px"> </lord-icon>';
                 mess +=  '<small>Chúng tôi sẽ cải thiện để phục vụ tốt hơn!</small><br></br>';
            $('#mess').html(mess);
        })

        $('#fa-heart').click(function(){
            rating='Xuất sắc';
        // reset trạng thái
            $('#fa-frown').css('border-color','');
            $('#fa-frown').css('color','');
            $('#fa-smile').css('border-color','');
            $('#fa-smile').css('color','');
        // đặt trạng thái
            $('#fa-heart').css('border-color','blue');
            $('#fa-heart').css('color','red');
              let mess ='<br><br><lord-icon src="https://cdn.lordicon.com/pithnlch.json" trigger="loop" style="width:34px;height:34px"> </lord-icon>';
                 mess +=  '<small>Lần sau nhớ ủng hộ!</small><br></br>';
            $('#mess').html(mess);
        })

// Lấy bình luận và lưu bình luận

        $('.form_cmt').submit(function(event){
            event.preventDefault();
            form_data = $(this).serializeArray();
            let id_dish = form_data[0]['value'];
            let content = form_data[1]['value'];
            let id_detail = form_data[2]['value'];
            alert(id_detail);
           // let id_bill = $('#id_bill').val();
           // alert(id_bill);
           // console.log(content);
            $.post("{{route('insert_cmt')}}",{id_dish:id_dish,content:content,
                rating:rating,id_detail:id_detail},function(data){

                 console.log(data);
                 location.reload();

        })
        })

    })
</script>
