@extends('amin.Home')
@section('tile', 'Quản lý bàn')
@section('main')
@parent
    <div class="container" id="add-container">
        <a class="text-danger" href="{{route("ManageTable")}}"><i class="fa-solid fa-rectangle-xmark "></i></a>

        <h4 class="text-center">Thêm bàn</h4>
       <form action="{{route('insert_table')}}" method="GET" class="form-group" >
           @csrf
        <div class="row">
            <div class="col-4 offset-1 col-custom">
                <label for="">ID</label>
                <input class="form-control" type="text" name="num_table" required>
                {{-- Lấy dữ liệu --}}
                <label for="">Loại bàn</label>
                <select class="custom-select" name="type_table">
                    <option selected>Choose...</option>
                @php
                   foreach ($items as $item)
                        {
                            echo '<option value="'.$item->ID_TABLE_TYPE.'">'.$item->NAME_TABLE_TYPE	.'</option>';
                        }
                @endphp


                </select>
                <label for="">Mô tả</label>
                <input type="text" class="form-control" name="descript">
            </div>
            <div class="col-4 offset-1 ">
                <label for="">Vị trí</label>
                <select class="custom-select" name="locate" >
                    <option selected>Choose...</option>
                    <option value="Lầu 1">Lầu 1</option>
                    <option value="Sảnh">Sảnh</option>
                </select>
                <label for="">Trạng thái</label>
                <select class="custom-select" name="status" >
                    <option value="Hoạt động" selected>Hoạt động</option>
                </select>
                <br>
                <br>
                <button type="submit" id="add-table" class="btn btn-add">Thêm</button>
                <button type="reset" class="btn btn-primary">reset</button>
                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modal-add-type">Thêm loại bàn</button>
            </div>
        </div></form>
        <br>
    </div>
@endsection
<div id="show"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<div class="modal" tabindex="-1" role="dialog" id="modal-add-type">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm loại bàn</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('insert_type_table')}}" method="get" >
        <div class="modal-body">

              <input type="text" class="form-control" name="type-table-name" >


        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-add">Thêm</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
