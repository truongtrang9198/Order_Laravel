@extends('staff.home')
@section('tile', 'Bộ phận thu ngân')
@section('main')
    @parent
    <div class="container">
        {{$date}}
        <table class="table">
            <thead>
                <tr>
                <th>STT</th>
                <th>Số hóa đơn</th>
                <th>Thu vào</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $n=0;
                @endphp
                @foreach ($detail as $dt)
                  <tr><td> {{$n++}}</td>
                    <td>{{$dt->ID_BILL}}</td>
                    <td>{{$dt->PAY}}</td>
                </tr>

                @endforeach
                <tr >
                    <td>Tổng</td>
                    @foreach ($sum as $s)
                        <td colspan="2"><b>{{$s->sum_}}</b></td>
                    @endforeach
                </tr>
            </tbody>
        </table>

    </div>
@endsection
