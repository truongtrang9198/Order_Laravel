{{-- mẫu test --}}
@extends('amin.Home')
@section('tile', 'Đây là title của trang')
@section('list_staff')
@parent
    <div>main day</div>
@endsection
@section('content')
	<p>Đây là phần hiển thị nội dung chính của trang</p>
@endsection

