<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{asset('css/Detail_comment.css')}}">
@extends('Homepage.Home')
@section('tile', 'Welcome')
@section('main')
@parent
<div class="container">
    <div class="row">
        <div class="col-xm-12">
            <button class="btn btn-primary" id="btn_back" onclick="history.back()"><i class="fas fa-backward"></i></button>
            <br>
            @php
            foreach($data as $data){
                $price = number_format($data->DISH_PRICE);
            $url  = asset($data->DISH_IMG);
            $tr =
            '<div class="card card-menu mb-3" >
                <img src="'.$url.'" class="card-img-top" alt="...">
                <div class="card-body card-body-custom">
                  <h5 class="card-title">'.$data->DISH_NAME.'</h5>
                  <span class="text-muted">Loại: '.$data->DISH_TYPE_NAME.' </span> <br>
                 <span class="text-danger text-bold">'.$price.'VND/'.$data->UNIT_NAME.'</span> <br>
                  <p class="card-text">'.$data->DISH_DESCRIPTION.'</p>
                  <button class="btn btn-outline-primary"><i class="fas fa-utensils"></i></button>
                </div>
              </div>';
              echo $tr;
            }

        @endphp
        </div>
        <div>
            <p>Khu vực hiển thị bình luận</p>
            <span id="">
                &nbsp;
                 <button id="fa-frown" class="btn btn-rating" data-toggle="tooltip"data-placement="bottom" title="Rất tệ" disabled="disabled">
                     <i class="far fa-frown" style="font-size:34px"></i> {{$rating_bad}}</button> &nbsp;
                 <button id="fa-smile" class="btn btn-rating" data-toggle="tooltip"data-placement="bottom" title="Bình thường thôi" disabled="disabled">
                    <i class="far fa-smile"style="font-size:34px" ></i> {{$rating_normal}}</button> &nbsp;
                 <button id="fa-heart" class="btn btn-rating" data-toggle="tooltip"data-placement="bottom" title="Ngon tuyệt" disabled="disabled">
                     <i class="far fa-grin-hearts"style="font-size:34px"></i> {{$rating_wonder}}</button>
            </span>
            <br>
            {{-- Hiển thị bình luận --}}
            <div class="comment">
              @foreach ($comment as $cmt)

                    <div class="card">
                        <div class="body">
                            <p class="fort-weight-bold"><i class="fas fa-user-tag"></i> {{$cmt->FULLNAME}}
                                <br><small class="text-muted"><i class="fas fa-clock"></i>{{$cmt->TIME}} </small></p>
                             <p>{{$cmt->COMMENT_DETAIL}}</p>
                        </div>
                    </div>
                    <br>

                 @endforeach
             </div>
        </div>

    </div>
</div>


@endsection

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


