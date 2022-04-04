@extends('Homepage.Home')
@section('tile', 'Welcome')
@section('main')
@parent
<div class="container">
    <div class="row">
        <div class="col-xm-12">
          <form action="{{route('custom_login')}}" method="POST" class="form-group" id="form-login">
                <label for="">Tên</label>
                <input type="text" id="name_cutomer" name="name_cutomer" class="form-control">
                <label for="">Số điện thoại</label>
                <input type="text" id="phone_cutomer" name="phone_cutomer"class="form-control">
            <br>
                <button class="btn btn-warning" type="submit">Tiếp</button>
          </form>
        </div>

    </div>
</div>


@endsection

<style>
    #form-login{
        padding-left: 100px;
    }
</style>
