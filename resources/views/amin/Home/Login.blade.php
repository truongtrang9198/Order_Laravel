@include('amin.Home.Head')

<div id="login-frame">
    <div id="img_login">
        <img src="{{ asset('http://localhost/Order_Laravel/storage/app/img/order.png') }}" alt="Hình ảnh logo">
    </div>
    <div id="form-login-admin">
        <form action="{{ route('getlogin') }}" method="GET">
            @csrf
            <div class="input-group mb3 input-admin">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                </div>
                <input type="text" class="form-control input-admin" placeholder="Phone number" name="STAFF_PHONE"
                    aria-describedby="basic-addon1">
            </div>
            <br>
            <div class="input-group mb3 input-admin">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                </div>
                <input type="password" class="form-control input-admin" placeholder="Password" name="STAFF_PWD"
                    aria-describedby="basic-addon1">
            </div>
            @if ($errors->any())
                <span class="text-muted">{{ $errors->first() }}</span>
                @endif

                <br>
                <button type="submit" class="btn btn-admin-login btn-light" id="">Login</button>
        </form>
        @if (session('error'))
        <div class="alert alert-dark text-center" role="alert">
                {{ session('error') }}
        </div>
    @endif
    </div>

</div>
