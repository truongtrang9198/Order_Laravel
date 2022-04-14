@extends('staff.home')
@section('tile', 'Bếp')
@section('main')
    @parent


            <table class="table table-striped table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>Tên món</th>
                        <th>Số bàn</th>
                        <th>Ghi chú</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            foreach($data as $dt){
                                $str = '
                                    <tr>
                                    <td>'.$dt->DISH_NAME.'</td>
                                    <td>'.$dt->NUMBER_TABLE.'</td>
                                    <td>'.$dt->NOTE.'</td>
                                    <td>'.$dt->TIME_ORDER.'</td>
                                    <td>'.$dt->STATUS_DETAIL.'</td>
                                    <form action="" class="form-confirm">
                                    <td><button type="submit" class="btn btn-outline-primary btn-click">Làm xong</button></td>
                                    <input type="text" name="status" value="Hoàn thành" hidden>
                                    <input type="text" name="id_detail" value="'.$dt->ID_DETAIL.'" hidden>
                                    </form>
                                    </tr>
                                ';
                                echo $str;
                            }
                        @endphp

                    </tbody>
            </table>

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
        $(".form-confirm").submit(function(event){
            event.preventDefault();

            var form_data = $(this).serializeArray();

            $.post("{{route('confirm')}}",{form_data:form_data},function(data){
                console.log(data);
                location.reload();

            })
          // console.log(form_data);
        });
     })
 </script>
