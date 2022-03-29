@php
    foreach ($data as $dt)
    {
        $url = asset($dt->DISH_IMG);
        $url_detail = route("detail_menu",["id"=>$dt->ID_DISH]);
       //$url_detail = "eeer0";
     //  echo  $url_detail;
        $price = number_format($dt->DISH_PRICE);
      $tr='   <div class="card mb-3 ">
            <div class="row no-gutters ">
            <div class="col-xm-4">
                <img class="img_detail" src="'.$url.'" class="card-img" alt="..." style="padding-top:10px; padding-bottom:10px; "
                width="300px" height="200px"    >
            </div>
            <div class="col-xm-8">
                <div class="card-body card-body-custom">
                <h5 class="card-title">'.$dt->DISH_NAME.'</h5>
                <span class="text-muted">Loại: '.$dt->DISH_TYPE_NAME.' </span> <br>
                <span class="text-danger text-bold">'.$price.'VND/'.$dt->UNIT_NAME.'</span> <br>
                <button class="btn btn-outline-primary"><i class="fas fa-utensils"></i></button>
                &nbsp; <a href="'.$url_detail.'">Chi tiết</a>
                </div>
            </div>
            </div>
        </div>';
        echo $tr;
}
@endphp
