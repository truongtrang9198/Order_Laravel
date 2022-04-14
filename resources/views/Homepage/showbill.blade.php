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
                                <td scope="row">Tổng</td>
                                <td colspan="2" class="text-right"> <b> '.number_format($b->TOTAL).'
                                     </b></td>
                                     </tr>
                                <tr>

                                <td scope="row">Trạng thái</td>
                                <td colspan="2" class="text-right text-muted"> <i>'.$b->BILL_STATUS.'
                                </i> </td>

                            </tr>';
                            echo $tr;
                            $s = '<input type="text" id="id_bill" value="'. $b->ID_BILL.'" hidden>';
                            echo $s;
                            }
                        @endphp


                    </tbody>
                </table>
                <button type="button" onclick="history.back()" class="btn btn-danger">Trở về</button>
                <button type="submit" id="pay-btn" class="btn btn-warning">Thanh toán</button>
            </div>
        </div>
    </div>


@endsection

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('#pay-btn').click(function(){
            let id_bill = $('#id_bill').val();
            $.post("{{route('get-confirm')}}",{id_bill:id_bill},function(data){
                location.reload();
                console.log(data);
            })
           // alert(id_bill);
        })
    });
</script>
