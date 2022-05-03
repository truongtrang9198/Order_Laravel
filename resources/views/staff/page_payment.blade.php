<style>
    #btn-reload{
    height: 36px!important;
}
</style>
@extends('staff.home')
@section('tile', 'Bộ phận thu ngân')
@section('main')
    @parent

            <button class="btn btn-success" id="btn-reload" onclick="window.location.reload();"><i class="fas fa-redo-alt"></i></button>
            <a href="" role="button" class="btn btn-primary">All</a>
            <table class="table table-striped table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>STT</th>
                        <th>Số bàn</th>
                        <th>Thời gian vào</th>
                        <th>Trạng thái</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>

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
                                    <td>'.number_format($dt->TOTAL).' VND</td>
                                    <td>'.number_format($dt->PAY).' VND</td>
                                    <form action="" class="form-confirm">

                                    <input type="text" name="id_bill" value="'.$dt->ID_BILL.'" hidden>
                                    <input type="text" name="total" value="'.$dt->TOTAL.'" hidden>
                                    <input type="text" name="fee" value="'.$dt->fee.'" hidden>
                                    <input type="text" name="discount" value="'.$dt->DISCOUNT.'" hidden>
                                    <input type="text" name="id_table" value="'.$dt->ID_TABLE.'" hidden>
                                    <input type="text" name="pay" value="'.$dt->PAY.'" hidden>

                                    <td><button type="submit" class="btn btn-outline-info btn-click"
                                         >Thanh toán</button></td>
                                    </form>
                                    <td><a href="" class="show_detail">Xem chi tiết</a></td>
                                    </tr>
                                ';
                                $n++;
                                echo $str;
                            }
                        @endphp

                    </tbody>
            </table>
            {{-- data-toggle="modal" data-target="#myModal" --}}
<!-- Button to Open the Modal -->

{{-- Hiển thị bảng để thu tiền --}}
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thanh toán</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <form action="" class="form-group" id="form-modal">

          <div class="form-group row">
          <label for="" class="col-sm-3 col-form-label">Tổng tiền</label>
          <div class="col-sm-7 offset-2">
            <input type="text" id="total" name="" value="" class="form-control" readonly>
          </div>
          </div>

          <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Giảm giá</label>
            <div class="col-sm-7 offset-2">
              <input type="text" id="discount" name="" value="" class="form-control" readonly>
            </div>
            </div>



                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Phụ thu</label>
                  <div class="col-sm-7 offset-2">
                    <input type="text" id="fee" name="" value="" class="form-control">
                  </div>
                  </div>

                  <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">VAT(%)</label>
                    <div class="col-sm-7 offset-2">
                      <input type="text" id="vat" name="" value="0.00" class="form-control">
                    </div>
                    </div>

                    <div class="form-group row">
                      <label for="" class="col-sm-3 col-form-label">Hình thức</label>
                      <div class="col-sm-7 offset-2">
                        <select name="" id="payment" class="custom-select">
                          @php
                              foreach($payment as $pm){
                                  echo '<option value="'.$pm->ID_PAYMENT.'">'.$pm->PAYMENT_NAME.'</option> ';

                              }
                          @endphp
                        </select>
                      </div>
                      </div>

                  <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Thanh toán</label>
                    <div class="col-sm-7 offset-2">
                      <input type="text" id="paid" name="paid" value="" class="form-control" readonly>
                    </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Thu vào &nbsp;</label>
                        <div class="col-sm-7 offset-2">
                          <input type="text" id="money-in" name="" value="" class="form-control">
                        </div>
                        </div>

                    <div class="form-group row">
                         <label for="" class="col-sm-3 col-form-label">Thói lại &nbsp;</label>
                         <div class="col-sm-7 offset-2">
                          <input type="text" id="excess_cash" name="" value="" class="form-control" readonly>
                        </div>
                          </div>

                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label"></label>
                  <div class="col-sm-7 offset-2">
                  <input type="text" id="id_bill_temp" value="" hidden>
                  <input type="text" id="id_table_temp" value="" hidden>
                    <button class="btn btn-info" id="btn-complete"> Hoàn tất</button>

                </div>
                </div>
        </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

 @endsection


 <script src="https://code.jquery.com/jquery-3.6.0.min.js"
 integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

 <script>
     $(document).ready(function() {

         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });


        $(".form-confirm").submit(function(event){
            event.preventDefault();
            const numberFormat = new Intl.NumberFormat('vi-VN', {
  style: 'currency',
  currency: 'VND',
});
            var form_data = $(this).serializeArray();
          //  console.log(form_data);
            let total = form_data[1]['value'];
            let id_bill = form_data[0]['value'];
            let fee  = form_data[2]['value'];
            let discount = form_data[3]['value'];
            let id_table = form_data[4]['value'];
            let pay = form_data[5]['value'];
            $('#total').val(total);
            $('#fee').val(fee);
            $('#discount').val(discount);
            $('#id_bill_temp').val(id_bill);
            $('#id_table_temp').val(id_table);
             paid = parseInt(pay) + parseInt(fee);
            $('#paid').val(paid);
            //$('#paid').val(paid);
            $("#myModal").modal();
            $("input").change(function(){
                 total = $('#total').val();
                 fee = $('#fee').val();
                 discount = $('#discount').val();

                var money_in = $('#money-in').val();
                paid = parseInt(pay)  + parseInt(fee);;
                //let paid_ = numberFormat.format(paid);
                $('#paid').val(paid);
                excess_cash = money_in - parseInt(paid);
                let cash = numberFormat.format(excess_cash);
                $('#excess_cash').val(cash);


            })

        });

        $('#form-modal').submit(function(event){
            event.preventDefault();
            let  fee = $('#fee').val();
            let payment_type = $('#payment').val();
            let paid = $('#paid').val();
            let id_bill = $('#id_bill_temp').val();
            let id_table= $('#id_table_temp').val();
          //  console.log(form_data);

            //alert(id_bill)
           // lấy id  nhân viên ?//
             $.post("{{route('confirmed')}}",{payment_type:payment_type,id_bill:id_bill
                ,paid:paid,fee:fee,id_table:id_table
                },function(data){
                    console.log(data);
                    location.reload();

            })
        })


     })
 </script>

