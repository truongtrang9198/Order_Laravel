
@extends('Homepage.Home')
@section('tile', 'Welcome')
@section('main')
@parent
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
            <form class="form-order">
            <div class="card-body card-body-custom1">
            <h5 class="card-title">'.$dt->DISH_NAME.'</h5>
            </div>
            <input type="text" name="id_menu" value="'.$dt->ID_DISH.'" hidden>
          </form>
        </div>
        </div>
    </div>';
    echo $tr;
}
@endphp
    <div>
        <span ><i class="far fa-star" style="font-size:26px"></i></span>
        <span ><i class="far fa-star" style="font-size:26px"></i></span>
        <span ><i class="far fa-star" style="font-size:26px"></i></span>
        <span ><i class="far fa-star" style="font-size:26px"></i></span>
        <span ><i class="far fa-star" style="font-size:26px"></i></span>
    </div>


@endsection
{{-- Cỉnh lại css --}}
