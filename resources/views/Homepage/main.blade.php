
@extends('Homepage.Home')
@section('tile', 'Welcome')
@section('main')
@parent
<div class="container-fluid">
    <div class="row">
        <div class="col-xm-12 col-md-6">
            @include('Homepage.slide_img')
            <br>
            <div class="detail_table">
                <h5>Bàn:
                    @php
                    if (empty($table_number)) {
                          return redirect()->route('/');
                    }else
                        echo $table_number;
                    @endphp
                    <a href="{{route("show_bill",["id_bill"=>$id_bill])}}"> <lord-icon
                        src="https://cdn.lordicon.com/aslgozpd.json"
                        trigger="hover"
                        style="width:24px;height:24px">
                    </lord-icon></a>
                </h5>
                    <input type="text" value=" @php
                    echo $id_table;
                @endphp" hidden>
            </div>
            @include('Homepage.menu')
        </div>
    </div>
</div>


@endsection

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.lordicon.com/lusqsztk.js"></script>

