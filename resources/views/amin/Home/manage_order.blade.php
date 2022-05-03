@extends('amin.Home')
@section('tile', 'Quản lý đặt món')
@section('main')
@parent
    <div class="container-fluid">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Số bàn</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th>Tổng giá</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $dt)
                    <tr>
                        <td>{{$dt->NUMBER_TABLE}}</td>
                        <td>{{$dt->Time_start}}</td>
                        <td>{{$dt->BILL_STATUS}}</td>
                        <td>{{$dt->TOTAL}}</td>
                        <td><a href="{{route('detail_order',['id_bill'=>$dt->ID_BILL])}}">Chi tiết</a> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
