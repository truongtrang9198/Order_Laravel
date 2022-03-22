@extends('amin.Home')
@section('tile', 'Cập nhật thông tin')
@section('main')
    @parent
    <?php
    use Carbon\Carbon;
    $createdAt = Carbon::parse($item['BIRTHDAY']);
    $sn = $createdAt->format('d/m/Y');

    $sex = 'Nữ';
    if ($item['SEX'] == 1) {
        $sex = 'Nam';
    }

    ?>
    <div class="fluid-container" id="add-container">
        <h4 class="text-center">Cập nhật thông tin</h4>

        {{-- <form class="form-group" enctype="multipart/form-data" action="" method="post"> --}}
        <div class="row">
    {{-- show ảnh --}}
            <div class="col-md-3 offset-1 col-custom2">
                @if ($item['STAFF_IMG'] != null)
                @php  $url = $item["STAFF_IMG"] @endphp
                    <img src="{{asset($url)}}" alt="" width="200px">

                @else
                    <a class="nav-link" data-toggle="collapse" href="#form-add_img">
                        <span class="text-muted display-1"><i class="fa-solid fa-camera"></i></span>
                        <br>
                        <p class="text-muted pl-3"> Thêm ảnh</p>
                    </a>
                    <div class="collapse" id="form-add_img">
                        <form class="" id="form-img" action="{{ route('update_img') }}" method="post"
                            enctype="multipart/form-data">
                            <div class="input-group">
                                <input type="text" name="id_staff" value="@php echo $item['ID_STAFF']; @endphp " hidden>
                                <input type="file" class="form-control" name="img_staff" id="img_staff" value="">
                                <button type="submit" class="btn btn-outline-secondary" id="up_img" name="button">Tải
                                    lên</button>
                            </div>
                        </form>
                        <span class="text-error" id="err_mess"></span>
                    </div>
                @endif
            </div>

            <div class="col-md-4 col-custom2">

                <label for="" class="text-dark font-weight-bold">Họ tên</label>
                <div class="input-group mb3">
                    <input type="text" class="form-control-plaintext" name="name" id="name" value="@php echo $item['STAFF_FULLNAME']; @endphp"
                        readonly>
                    <button class="btn btn-light"><i class="fa-solid fa-pen"></i></button>
                </div>

                <label for="" class="text-dark font-weight-bold">Ngày sinh</label>
                {{-- chỉnh button calender show lịch --}}
                <div class="input-group mb3">
                    <input type="text" class="form-control-plaintext" name="birthday" id="birthday"
                        value="@php echo $sn @endphp" readonly>
                    <button class="btn btn-light"><i class="fa-solid fa-calendar"></i></button>
                </div>

                <label for="" class="text-dark font-weight-bold">Giới tính</label>
                <div class="input-group mb3">
                    <input type="text" name="sdt" class="form-control-plaintext" id="sex" value="@php echo $sex; @endphp"
                        required>
                    <button class="btn btn-light"><i class="fa-solid fa-pen"></i></button>
                </div>

                <label for="sdt" class="text-dark font-weight-bold">Điện thoại</label>
                <div class="input-group mb3">
                    <input type="text" name="phone" class="form-control-plaintext" id="phone" required length='10'
                        pattern="[0]?[0-9]{10,11}" value="@php echo $item['STAFF_PHONE']; @endphp">
                    <button class="btn btn-light"><i class="fa-solid fa-pen"></i></button>
                </div>

                <label for="sdt" class="text-dark font-weight-bold">Căn cước công dân</label>
                <div class="input-group mb3">
                    <input type="text" class="form-control-plaintext" name="birthday" id="birthday"
                        value="@php echo $item['IDENTITY_PAPER']; @endphp" readonly>
                    <button class="btn btn-light"><i class="fa-solid fa-pen"></i></button>
                </div>
            </div>


            <div class="col-md-4 col-custom1">
                <!-- <div class="form-group" enctype="multipart/form-data"> -->

                <label for="sdt" class="text-dark font-weight-bold">Địa chỉ</label>
                <div class="input-group mb3">
                    <input type="text" class="form-control-plaintext" id="address" name="address" value="@php echo $address[0]->ADDRESS_DETAIL; @endphp"
                        readonly>
                    <button class="btn btn-light"><i class="fa-solid fa-pen"></i></button>
                </div>

                <label for="sdt" class="text-dark font-weight-bold">Quận/Huyện</label>
                <div class="input-group mb3">
                    <input type="text" class="form-control-plaintext" id="district" name="district"
                        value="@php echo $address[0]->DISTRICT_NAME; @endphp" readonly>
                    <button class="btn btn-light"><i class="fa-solid fa-pen"></i></button>
                </div>

                <label for="sdt" class="text-dark font-weight-bold">Tỉnh/Thành phố</label>
                <div class="input-group mb3">
                    <input type="text" class="form-control-plaintext" name="city" id="city" value="@php echo $address[0]->CITY_NAME; @endphp"
                        readonly>
                    <button class="btn btn-light"><i class="fa-solid fa-pen"></i></button>
                </div>

                <label for="sdt" class="text-dark font-weight-bold">Trạng thái</label>
                <div class="input-group mb3">
                    <input type="text" class="form-control-plaintext" id="status" name="status" value="@php echo $item['STAFF_STATUS']; @endphp"
                        readonly>
                    <button class="btn btn-light"><i class="fa-solid fa-pen"></i></button>
                </div>
            </div>

        </div>
        {{-- </form> --}}
        <br>
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $(document).ready(function() {
        // check img

        // $('.btn').click(function(event){
        //     event.preventDefault();
        // })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#form-img').submit(function(event) {
            event.preventDefault();
            $data = $('#form-img').serialize();
            var id_staff_val = $('#id_staff').val();

            var url_img = $('#img_staff').val();
            var id_staff = $('#id_staff').attr("name");
            var fd = new FormData();
            fd.append('url_img', $('#img_staff')[0].files['0']);
            fd.append('id_staff', id_staff_val);
            var url_index = url_img.indexOf('.');;
            var url_ex = url_img.slice(url_index + 1);
            url_ex = url_ex.toUpperCase();
            alert(url_ex);
            if (url_ex == 'PNG' || url_ex == 'JPG' || url_ex == 'PDF') {
                $('#img_staff').css('border-color', '');
                $('#form-img').unbind('submit').submit();

                //     $.ajax({
                // url: "{{ route('update_img') }}",
                // method: 'POST',
                // dataType: 'text',
                // processData:false,
                // contentType: false,
                // data: fd,
                // success: function(re){
                //     //
                //   //  alert(re);

                // }
                // })
            } else {
                $('#img_staff').css('border-color', 'red');
                $('#err_mess').html('Định dạng .jpg,pdf,png');
            }
        })
    })
</script>
