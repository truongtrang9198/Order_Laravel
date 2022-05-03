
@extends('amin.Home')
@section('tile', 'Quản lý menu')
@section('main')
    @parent

    <div class="container" id="add-container">
        <a class="text-danger" href="{{ route('list_menu') }}"><i class="fa-solid fa-rectangle-xmark "></i></a>

        <h4 class="text-center">Thêm món ăn</h4>
        <form action="{{ route('submit_menu') }}" method="POST" class="" enctype="multipart/form-data" id="form-add-menu">
            @csrf
            <div class="row">
                <div class="col-4">
                    <label for="">Tên món</label>
                    <input class="form-control" type="text" name="name" required>
                    <label for="">Loại món</label>
                    <select class="custom-select" name="dish_type" id="dish_type">
                        <option selected>Select one</option>
                        @php
                            foreach($Dishtypes as $Dishtype){
                                $str = '<option value="'.$Dishtype->ID_DISH_TYPE.'">'.$Dishtype->DISH_TYPE_NAME.'</option>';
                                echo $str;
                            }
                        @endphp

                    </select>
                    <label for="">Đơn vị</label>
                    <select class="custom-select" name="unit" id="unit">
                        <option selected>Select one</option>
                        @php
                        foreach($Units as $Unit){
                            $str = '<option value="'.$Unit->ID_UNIT.'">'.$Unit->UNIT_NAME.'</option>';
                            echo $str;
                        }
                    @endphp

                    </select>

                </div>
                <div class="col-4">
                    <label for="">Giá tiền</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="VND" required>
                    {{-- Lấy dữ liệu từ server --}}
                    <label for="">Mô tả</label>
                    <input type="text" name="description" class="form-control" id="description">
                    {{-- Lấy dữ liệu từ server --}}
                    <label for="">Trạng thái</label>
                    <select class="custom-select" id="status" name="status">
                        <option value="Phục vụ" selected>Phục vụ</option>
                        <option value="Đặt trước">Đặt trước</option>

                    </select>
                    <br>

                </div>
                <div class="col-4">
                    <label for="">Chọn ảnh</label>
                    <input type="file" name="img" id="img" class="form-control">
                    <br>
                    <span id="err_mess"> </span>
                    <button type="submit" id="add-menu" class="btn">Thêm</button>&nbsp;&nbsp;
                    <button type="reset" class="btn btn-primary">reset</button>

                </div>
            </div>
        </form>
        <br>
    </div>
    <div id="show"></div>
    <!-- Toast thông báo lỗi-->

    <!-- Kết thúc Toast -->

@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        // set up ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // check info
        $('#form-add-menu').submit(function(event) {
            event.preventDefault();
            var img = $('#img').val();
            var url_index = img.indexOf('.');;
            var url_ex = img.slice(url_index + 1);
            url_ex = url_ex.toUpperCase();
            if (url_ex == 'PNG' || url_ex == 'JPG' || url_ex == 'PDF') {
                $('#img').css('border-color', '');
                $('#form-add-menu').unbind('submit').submit();
            } else {
                $('#img').css('border-color', 'red');
                $('#err_mess').html('Định dạng .jpg,pdf,png');
            }


        })


    });
</script>
