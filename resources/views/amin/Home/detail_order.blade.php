@extends('amin.Home')
@section('tile', 'Quản lý đặt món')
@section('main')
    @parent
    <div class="container-fluid">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên món</th>
                    <th>Ghi chú</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            <tbody>
                @php
                    $n=0;
                @endphp

                @foreach ($detail as $dt)

                    <tr>
                        <td>{{ $n++ }}</td>
                        <td>{{ $dt->DISH_NAME }}</td>
                        <td>{{ $dt->NOTE }}</td>
                        <td>{{ $dt->TIME_ORDER }}</td>
                        <td>{{ $dt->STATUS_DETAIL }}</td>
                        <td>
                            <form action="" class="form_delete">
                                <input type="text" name="id_detail" value="{{$dt->ID_DETAIL}}" hidden>
                                @if ($dt->STATUS_DETAIL == 'Hoàn tất')
                                    <button type="submit" class="btn btn-primary" disabled><i class="fas fa-minus-circle"></i></button>

                                @endif
                                <button type="submit" class="btn btn-primary"><i class="fas fa-minus-circle"></i></button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
            </thead>
        </table>

    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.form_delete').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serializeArray();
        let id_detail = form_data[0]['value'];
        let ask = confirm("Xóa món ăn?");
       // console.log(ask);
        if(ask==true){
            $.get("{{route('delete_order')}}",{id_detail:id_detail},function(data){
                //console.log(data);
                location.reload();
            })
        }
    })

    })
</script>
@endsection
