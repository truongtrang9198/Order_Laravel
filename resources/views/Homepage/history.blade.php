<link rel="stylesheet" href="{{asset('/css/customer_history.css')}}">
@extends('Homepage.Home')
@section('tile', 'Lịch sử giao dịch')
@section('main')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- <script src="{{ URL::asset('js/bill.js')}}" rel="javascript" type="text/javascript" defer></script> --}}
@parent
    <div class="container">
        <div class="row">
        <div class="col-xm-12 col-md-6">
        <button type="button" onclick="history.back()" id="btn-back" class="btn"><i class="fas fa-backward"></i></button>
        {{-- <a href="">Xem hóa đơn</a> --}}
        {{-- <a href="{{route('logout')}}">Thoát</a> --}}
    <div >

        <table class="table table-bordered">
            <tr>
                <td colspan="4">
                    <span class="text-muted">
                        <i class="fas fa-user-circle" style="font-size: 50px"></i></span>
                    <span class="info"> {{strtoupper($info->FULLNAME)}}</span>
                    <span ><small><b>{{$info->PHONE}}</b></small></span>
                    <button class="btn btn-light" data-toggle="modal" data-target="#modal_update"><i class="fas fa-pen"></i></button>

                </td>
            </tr>

            <tr>
                <td>
                    Tổng điểm: <br>
                    <b>{{$info->POINT_TOTAL}}</b>
                </td>
                @foreach ($total as $tl)
                <td>
                    Số lần ghé: <br><b>{{$tl->times}}</b>
                </td>
                <td colspan="2">
                    Tổng tiền đã tiêu:  <br><b>{{$tl->total}}</b>
                </td>
                @endforeach

            </tr>
            <tr colspan="4"></tr>
            <tr>
                <th>Số bàn</th>
                <th>Thời gian đến</th>
                <th>Thời gian đi</th>
                <th>Thanh toán</th>
            </tr>
            @foreach ($detail as $data)
                <tr>
                    <td>{{$data->NUMBER_TABLE}}</td>
                    <td>{{$data->Time_start}}</td>
                    <td>{{$data->Time_end}}</td>
                    <td>{{$data->PAY}}</td>

                </tr>
            @endforeach

        </table>
    </div>
</div>
{{-- modal update thông tin --}}
    <div class="modal" id="modal_update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Cập nhật thông tin</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" class="form-group" method="get" id="form_update">
                        @csrf
                         <label for="">Tên mới</label>
                         <input type="text" name="ne_username" id="ne_username" class="form-control">
                         <br> <button type="button" id="btn_update" class="btn btn-info">Cập nhật</button>

                    </form>

                </div>
            </div>
    </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('#btn_update').click(function(){
            var ne_name = $('#ne_username').val();
        $.post("{{route('user_update')}}",{ne_name:ne_name},function(data){
            console.log(data);
            location.reload();
        })

        })
})
</script>
@endsection

