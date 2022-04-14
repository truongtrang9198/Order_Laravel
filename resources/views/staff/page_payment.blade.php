@extends('staff.home')
@section('tile', 'Bộ phận thu ngân')
@section('main')
    @parent


            <table class="table table-striped table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>STT</th>
                        <th>Số bàn</th>
                        <th>Thời gian vào</th>
                        <th>Trạng thái</th>
                        <th>Tổng tiền</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $n = 1;
                            foreach($items as $dt){

                                $str = '
                                    <tr>
                                    <td>'.$n.'</td>
                                    <td>'.$dt->NUMBER_TABLE.'</td>
                                    <td>'.$dt->Time_start.'</td>
                                    <td>'.$dt->BILL_STATUS.'</td>
                                    <td>'.$dt->TOTAL.'</td>
                                    <form action="" class="form-confirm">
                                    <td><button type="submit" class="btn btn-outline-primary btn-click">Tạm tính</button></td>
                                    <td><button type="submit" class="btn btn-outline-primary btn-click">Thanh toán</button></td>
                                    </form>
                                    <td><a href="">Xem chi tiết</a></td>
                                    </tr>
                                ';
                                $n++;
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
