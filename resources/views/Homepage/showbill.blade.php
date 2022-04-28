
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
                            $s = '<input type="text" id="id_bill" value="'. $b->ID_BILL.'" hidden>
                                  <input type="text" id="status_bill" value="'.$b->BILL_STATUS.'" hidden>';
                            echo $s;
                            }
                        @endphp
                    </tbody>
                </table>
                <button type="button" id="check_discount" class="btn btn-outline">Xem khuyến mãi</button> <br>
                <span id="mess" class="text-muted"></span> <br>
            {{-- Khu vu khuyen mai --}}

                <form action="{{route('get-confirm')}}" class="form_confirm" method="post">
                    @csrf
                    <input type="text" id="id_bill_temp" name="id_bill" hidden>
                    <input type="text" id="status_bill_temp" name="status_bill" hidden>
                    <div id="show_discount" class="collapse">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="10" name="discount" id="discount10">
                        <label class="form-check-label" >
                          Giảm 10% hóa đơn
                        </label>
                      </div>
                    </div>
                      <button type="button" onclick="history.back()" class="btn btn-danger">Trở về</button>
                      <button type="submit" id="pay-btn" class="btn btn-warning">Thanh toán</button>
                      <button type="button" class="btn btn-primary" onclick="window.location.reload();">Tải lại</button>
                </form>


            {{-- button --}}

                <br>
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

        $('#check_discount').click(function(){
            $.get("{{route('check_discount')}}",{},function(data){
              //alert(data);
                if(data=='Null'){
                    $('#mess').html("Bạn không thuộc đối tượng được áp dụng khuyến mãi");
                }else if(data >=10){
                    $('#show_discount').collapse('show');
                }else{
                    $('#mess').html("Vui lòng tích lũy thêm điểm để sử dụng khuyến mãi!");

                }
            })
    })

    $('.form_confirm').submit(function(event){
        event.preventDefault();
        var id_bill = $('#id_bill').val();
        var status = $('#status_bill').val();
        $('#id_bill_temp').val(id_bill);
        $('#status_bill_temp').val(status);
        //alert($('#id_bill_temp').val());
        $('.form_confirm').unbind('submit').submit();
    })

});
</script>
