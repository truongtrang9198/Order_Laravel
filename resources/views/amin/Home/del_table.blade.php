@extends('amin.Home')
@section('tile', 'Xóa bảng')
@section('main')
    @parent

   <body>
     <input type="text" id="id_table" value="@php echo $id; @endphp" name="id_table" hidden>
     <img src="{{asset('http://localhost/Order_Laravel/storage/app/img/gif_delete.gif')}}" alt="" id="loading">
   </body>

 @endsection
 <style media="screen">
    #loading{
      margin-left: 750px;
      margin-top: 100px;
    }
    body{
      background-color:#FFFFFF;
    }
  </style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

 <script type="text/javascript">
    // xoa nhan NhanVien
    window.onload=function(){
      // alert("click r");
       var id_table = $('#id_table').val();
       var xacnhan = confirm("Xóa bàn ra khỏi hệ thống?");
       if(xacnhan){
         $.get("{{route('_del_table')}}",{id_table:id_table},function(data){
            // if(data =="True"){

            // }
            $(location).attr("href", "{{route('ManageTable')}}");
         })
       }
    };
    </script>
