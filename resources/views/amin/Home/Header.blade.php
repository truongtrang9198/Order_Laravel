
<nav class="navbar navbar-expand-sm">
    <a class="nav-brand" href=""><img height="150px" src="{{asset('http://localhost/Order_Laravel/storage/app/img/order.png')}}" alt="Hình ảnh logo"> </a>

</nav>

<nav class="navbar navbar-expand-sm">
  <ul class="navbar-nav mr-auto" id="ul-navbar">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('ManageStaff') }}" >Nhân Viên</a>
        </li>
        <li class="nav-item page-item">
            <a class="nav-link" href="{{ route('ManageTable') }}" >Quản Lý Bàn</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('list_menu') }}" >Quản Lý Menu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('manage_order') }}" >Quản Lý Đặt Món</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{route('chart')}}" >Doanh Thu</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link " href="{{route('logout')}}" >Đăng Xuất</a>
        </li>
    </ul>
</nav>


