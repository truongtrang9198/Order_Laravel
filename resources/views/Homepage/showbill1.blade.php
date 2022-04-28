
@extends('Homepage.Home')
@section('tile', 'Tạm tính')
@section('main')
    @parent
    <div class="container-fluid">
        <div class="row">
            <div class="col-xm-12 col-md-6">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr><th  colspan="3" class="text-center"> Bảng tạm tính</th> </tr>
                        <tr>
                            <th>STT</th>
                            <th>Tên món</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php

                            $n = 0;
                            foreach ($detail as $dt) {
                                $n++;
                                $tr =
                                    "<tr>
                                        <td>" .
                                    $n .
                                    "</td>
                                        <td>" .
                                    $dt->DISH_NAME .
                                    "</td>
                                        <td> <b>".
                                          number_format($dt->DISH_PRICE) .
                                    "</b></td>

                                </tr>
                                <tr><td colspan=". 2 ."> <small>Ghi chú: ".$dt->NOTE. "<br>
                                    <span class='text-muted'>". $dt->TIME_ORDER."
                                    </span></small> </td>
                                    <td><small><span class='text-left'> Trạng thái:</span> <br><span class='text-muted'> ".$dt->STATUS_DETAIL."</span></small> </td>
                                </tr>";
                                echo $tr;
                            }

                        @endphp
                        @php
                            foreach($bill as $b){
                               $tr ='  <tr>
                                <td  class="text-muted"><small>Giảm giá</small></td>
                                <td colspan="2" class="text-right"><small>'.$b->DISCOUNT.'</small></td> </tr>
                                <tr>
                                <td class="text-muted"><small>Phụ thu</small></td>
                                <td colspan="2" class="text-right"><small>'.$b->fee.'</small></td> </tr>
                                <tr>
                                <td scope="row" class=" text-muted">Tổng</td>
                                <td colspan="2" class="text-right"> <b> '.number_format($b->TOTAL).'
                                     </b></td>
                                     </tr>
                                <tr>

                                <td scope="row">Trạng thái</td>
                                <td colspan="2" class="text-right text-muted"> <i>'.$b->BILL_STATUS.'
                                </i> </td>

                            </tr>';
                            echo $tr;
                            $url = route("go_cmt",["id_bill"=>$b->ID_BILL]);
                            $s = '<input type="text" id="id_bill" value="'. $b->ID_BILL.'" hidden>
                                  <input type="text" id="status_bill" value="'.$b->BILL_STATUS.'" hidden>';
                            echo $s;
                            }
                        @endphp


                    </tbody>
                </table>
            {{-- button --}}
                <button type="button" class="btn btn-primary" onclick="window.location.reload();">Tải lại</button>
                <br>
            {{-- Khu vực đánh  giá bình luận --}}
                <div id="hidden_cmt" class="collapse" >
                   <a href="@php echo $url; @endphp">Bình luận đánh giá</a> &nbsp;
                    <a href="{{route('exit')}}">Thoát</a>
                </div>

                <div  class="collapse" id="ask_login">
                    <br>
                     <br>
                    <p class="text-muted">Đăng nhập để đánh giá món ăn?</p>
                    <button class="btn btn-info" data-toggle="modal" data-target="#modal_login">Đăng nhập</button>
                    <a href="{{route('exit')}}">Thoát</a>
                </div>
            </div>
        </div>
    </div>
{{-- modal đăng nhập ở đây --}}
<div class="modal fade" id="modal_login">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Đăng nhập</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" class="form-group" method="post" id="login_custom">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" ><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" id="name"  placeholder="Tên">
                      </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" ><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại" required pattern="(0)+([0-9]{9})">
                      </div>

                      <button type="submit" class="btn btn-info">Đăng nhập</button>

                </form>

            </div>
        </div>
</div>
</div>
{{-- @php
    echo asset('js/customscript/bill.js');
@endphp --}}

@endsection

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- <script src="{{('resources/js/customscript/bill.js')}}"></script> --}}
<script>
    $(document).ready(function(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    // hiển thị button đánh giá sau khi đã thanh toán
    var status = $('#status_bill').val();

    if(status =="Đã thanh toán"){
        $.get("{{route('check_condition')}}",{status:status},function(data){
            console.log(data)
            if(data == 'null'){
                // open modal    dang nhap
                $('#ask_login').collapse('show');
            }else{
                $('#hidden_cmt').collapse('show');

            }
        })

    }

    $('#login_custom').submit(function(event){
        event.preventDefault();
        let phone = $('#phone').val();
        let name = $('#name').val();
        $.post("{{route('login2')}}",{phone:phone,name:name},function(data){
           // location.reload();
           console.log(data);
        })
    })

});
</script>
