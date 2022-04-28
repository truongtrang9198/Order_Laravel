@extends('Homepage.Home')
@section('tile', 'Welcome')
@section('main')
@parent
<div class="container">
    <div class="row">
        <div class="col-xm-12">
            <h4 class="text-center">Đăng nhập để tích điểm</h4>
          <form action="{{route('custom_login')}}" method="POST" class="form-group" id="form-login">
            @csrf
            <label for="">Tên</label>
                <input type="text" id="name" name="name" class="form-control" required>
                <label for="">Số điện thoại</label>
                <input type="text" id="phone" name="phone"class="form-control" required pattern="(0)+([0-9]{9})">
            <br>
            <a class="btn btn-info" role="button" href="{{route('choose_table')}}">Bỏ qua</a>
            <button class="btn btn-warning" type="submit">Đăng nhập</button>
          </form>
        </div>

    </div>
</div>


@endsection

<style>
    #form-login{
        padding-left: 100px;
        font-family: Arial, Helvetica, sans-serif;
    }
    h4{
        font-family: Arial, Helvetica, sans-serif;
    }

</style>
