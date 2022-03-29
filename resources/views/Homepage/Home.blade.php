
<!DOCTYPE html>
<html lang="en">
<head>
    @include('Homepage.head')
</head>
<body class="body">
    <div class="fluid-container">
        <div class="header">
            @include('Homepage.Header')
        </div>
        <hr>
    </div>
        @yield('main')

</body>
</html>

<div class="toast" id="Thongbaoloi" data-autohide="false">
    <div class="toast-header">
       <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
       <b class="text-danger">Hiển thị thông báo </b>
    </div>
    <div class="toast-body text-danger" id="toast-content-err">

    </div>
    </div>
