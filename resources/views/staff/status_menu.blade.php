@extends('staff.home')
@section('tile', 'Bộ phận bếp')
@section('main')
@parent
<div class="container-fluid">
    <table class="table table-hover">
        <thead>
            <tr>
               <th>ID</th>
                <th>Tên món</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>

        </thead>
        <tbody>
            @foreach ($data as $dt)
                <tr>
                    <td>{{$dt->ID_DISH}}</td>
                    <td>{{$dt->DISH_NAME}}</td>
                    <td>{{$dt->DISH_STATUS}}</td>

                    <td>
                    <form action="" method="get" class="form_change_status">
                        @csrf
                        <input type="text" name="id_dish" value="{{$dt->ID_DISH}}" hidden>
                    @if ($dt->DISH_STATUS=="Hết món")
                        <input type="text" name="idish_status" value="Phục vụ" hidden>
                        <button class="btn btn-info" type="submit">Phục vụ</button>

                    @else
                    <input type="text" name="idish_status" value="Hết món" hidden>
                    <button class="btn btn-danger" type="submit">Hết món</button>
                    @endif
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
<script>
    $(document).ready(function(){
        // set up ajax
        //cập nhật status
        $('.form_change_status').submit(function(event){
            event.preventDefault();
            var form_data = $(this).serializeArray();
          //  console.log(form_data);
          //form[0] in ra token
            let id_dish = form_data[1]['value'];
            let dish_status = form_data[2]['value'];
            $.get("{{route('handling_update_status')}}",
            {id_dish:id_dish,dish_status:dish_status},
            function(data){
                //alert(data);
                location.reload();
            })
        })
    })
</script>


@endsection
