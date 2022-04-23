$(document).ready(function(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $('#pay-btn').click(function(){
        let id_bill = $('#id_bill').val();
        $.post("{{route('get-confirm')}}",{id_bill:id_bill},function(data){
            location.reload();
            console.log(data);
        })
       // alert(id_bill);
    })

    // hiển thị button đánh giá sau khi đã thanh toán
    var status = $('#status_bill').val();

    if(status =="Đã thanh toán"){
        $.get("{{route('check_condition')}}",{status:status},function(data){
            if(data=="null"){
                // open modal dang nhap

                $('#modal_login').modal('show');
            }else{
                $('#hidden_cmt').collapse('show');

            }
        })

    }

});
