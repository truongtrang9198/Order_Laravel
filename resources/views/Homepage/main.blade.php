

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
                <h5><a href="">Bàn: 4 </a> <a href=""> &nbsp;  <i class="fas fa-receipt"></i></a> </h5>

            </div>
            @include('Homepage.menu')
        </div>
    </div>
</div>


@endsection

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


