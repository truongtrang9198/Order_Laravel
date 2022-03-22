@extends('amin.Home')
@section('tile', 'Cập nhật thông tin')
@section('main')
    @parent

   <body>
     <input type="text" id="id_staff" value="@php echo $id; @endphp" name="id_staff" hidden>
     <img src="{{asset('\storage\app\img\gif_delete.gif')}}" alt="" id="loading">
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
       var id_staff = $('#id_staff').val();
       var xacnhan = confirm("Xóa nhân viên ra khỏi hệ thống?");
       if(xacnhan){
         $.get("{{route('_del_staff')}}",{id_staff:id_staff},function(data){
            // if(data =="True"){

            // }
            $(location).attr("href", "{{route('ManageStaff')}}");
         })
       }
    };
    </script>
