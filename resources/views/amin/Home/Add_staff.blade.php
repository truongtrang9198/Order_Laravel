<?php echo csrf_field(); ?>
@extends('amin.Home')
@section('tile', 'Quản lý nhân viên')
@section('main')
@parent

    <div class="container" id="add-container">
        <a class="text-danger" href="{{route("ManageStaff")}}"><i class="fa-solid fa-rectangle-xmark "></i></a>

        <h4 class="text-center">Thêm nhân viên</h4>
       <form action="{{route('submit_staff')}}" method="POST" class="form-example" enctype='multipart/form-data' id="form-add-staff">
        @csrf
        <div class="row">
            <div class="col-4">
                <label for="">Họ tên</label>
                <input class="form-control" type="text" name="name" required>
                <label for="">Ngày sinh</label>
                <input type="date" class="form-control" id="birthday" name="birthday">
                <label for="">Giới tính</label>
                <select class="custom-select" name="sex">
                <option selected>Choose...</option>
                <option value="1">Nam</option>
                <option value="2">Nữ</option>
                </select>
                <label for="">Căn cước công dân</label>
                <input type="text" class="form-control" name="cccd" id="cccd" required pattern="[0-9]{12}">
            </div>
            <div class="col-4">
                <label for="">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" id="phone" required pattern="[0-9]{10}">
                {{-- Lấy dữ liệu từ server --}}
                <label for="">Tỉnh/Thành phố</label>
                <select class="custom-select" id="city">
                    <option selected>Choose...</option>
                    <?php
                        foreach ($items as $item)
                        {
                            echo '<option value="'.$item->ID_CITY.'">'.$item->CITY_NAME.'</option>';
                        }
                       // echo '<option >Choose...</option>';
                    ?>


                </select>
                {{-- Lấy dữ liệu từ server --}}
                <label for="">Quận/Huyện</label>


                    <div id="select-district">
                        <select class="custom-select" id="district" name="district">
                         <option selected>Choose...</option>
                        </select>
                    </div>


                <label for="">Địa chỉ</label>
                <input type="text" class="form-control" name="address">

            </div>

            <div class="col-4">
                <label for="">Chức vụ</label>
                <select class="custom-select" name="position">
                    <?php
                    foreach ($data as $dt)
                    {
                        echo '<option value="'.$dt->ID_POSITION.'">'.$dt->POSITION_NAME.'</option>';
                    }
                   // echo '<option >Choose...</option>';
                ?>
                </select>
                <label for="">Mật khẩu</label>
                <input type="password" name="pwd" class="form-control" required>
                <br>
                <input type="file" name="img_staff" id="img_staff" class="form-control" required>
                <br>
                <span id="err_mess" class="text-danger"></span>
                <button type="submit" id="add-staff" class="btn">Thêm</button>&nbsp;&nbsp;
                <button type="reset" class="btn btn-primary">reset</button>
                {{-- <button type=" " id="rr" class="btn btn-primary">reset1</button> --}}
            </div>
        </div></form>
        <br>
    </div>
    <div id="show"></div>
       <!-- Toast thông báo lỗi-->

    <!-- Kết thúc Toast -->

@endsection

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
// set up ajax
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

// show district
    $('#city').change(function(){
        // e.preventDefault();
        var ID_CITY = $('#city').val();
        //alert(ID_CITY);
        var opt = '';
    $.ajax({
           type:'POST',
           url:"{{ route('get_district') }}",
           data:{ID_CITY:ID_CITY},
           success:function(data){
           // alert(data.id_district.length);
           var opt = '<select class="custom-select" id="district" name="district">';
            for (var i = 0; i < data.id_district.length; i++){
                 opt+='<option value="'+data.id_district[i].ID_DISTRICT+'">';
                 opt+=data.id_district[i].DISTRICT_NAME+'</option>';
                // opt+='</option';

            }
            opt += ' </select>';
            $('#select-district').html(opt);
           }
        });
    })

// age
function Tinhtuoi(ngaysinh) {
     var ns = new Date(ngaysinh);
     var today = new Date();
     var tuoi = today.getFullYear() - ns.getFullYear();
     // alert(tuoi);
     return tuoi;
   }
// check info
    $('#form-add-staff').submit(function(event)
    {
        event.preventDefault();

        var birthday = $('#birthday').val();
        var phone = $('#phone').val();
        var cccd = $('#cccd').val();
        // kiểm tra tuổi
        if(Tinhtuoi(birthday) > 18 && Tinhtuoi(birthday) < 60 ){

            $('#birthday').css('border-color','');
    // check file
            var url_img = $('#img_staff').val();
            var url_index = url_img.indexOf('.');
            var url_ex = url_img.slice(url_index + 1);
            url_ex = url_ex.toUpperCase();
            //alert(url_ex);
            if (url_ex == 'PNG' || url_ex == 'JPG') {
                $('#img_staff').css('border-color', '');
        // check info
            $.post("{{ route('check_info') }}",{phone:phone,cccd:cccd},function(data){
            $('#phone').css('border-color','');
            $('#cccd').css('border-color','');

            if(data.inx.inx_phone !=0){
                $('#phone').css('border-color','red');
                $('#toast-content-err').html('Số điện thoại đã tồn tại');
                $('#Thongbaoloi').toast('show');
               // return false;
            } else if(data.inx.inx_cccd !=0){
                $('#cccd').css('border-color','red');
                $('#toast-content-err').html('Số căn cước công dân không được trùng');
                $('#Thongbaoloi').toast('show');
               // return false;
            }else{
               // $('#form-add-staff').submit();
                $('#form-add-staff').unbind('submit').submit();
               //this.submit();
            }
        });
            } else {
                $('#img_staff').css('border-color', 'red');
                $('#err_mess').html('Định dạng .jpg,pdf,png');
            }

        }else {
                $('#birthday').css('border-color','red');
                $('#toast-content-err').html('Tuổi không hợp lệ');
                $('#Thongbaoloi').toast('show');
               // return false;
        }
        // Kiểm tra cccd, phone




    })


});
</script>
