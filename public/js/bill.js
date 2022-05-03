$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('#btn_update').click(function(){
            var ne_name = $('#ne_username').val();
        $.post("user_update/",{ne_name:ne_name},function(data){
            console.log(data);
            location.reload();
        })

        })
})


