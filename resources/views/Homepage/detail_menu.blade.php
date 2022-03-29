

@extends('Homepage.Home')
@section('tile', 'Welcome')
@section('main')
@parent
<div class="container">
    <div class="row">
        <div class="col-xm-12">
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
        </div>
    </div>
</div>


@endsection

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


