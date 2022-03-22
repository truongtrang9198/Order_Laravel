@include('amin.Home.Head')

<div id="login-frame">
    <div id="img_login">
        <img  src="{{asset('/storage/app/img/order.png')}}" alt="Hình ảnh logo">
    </div>
    <div id="form-login-admin">
        <form action="{{route('getlogin')}}" method="GET">
        @csrf
            <div class="input-group mb3 input-admin">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                </div>
                <input type="text" class="form-control input-admin"  name="phone" aria-describedby="basic-addon1">
              </div>
              <br>
              <div class="input-group mb3 input-admin">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                </div>
                <input type="text" class="form-control input-admin" placeholder="Password" name="password"  aria-describedby="basic-addon1">
              </div>
              <br>
              <button type="submit" class="btn btn-admin-login">Login</button>
        </form>
    </div>

</div>
