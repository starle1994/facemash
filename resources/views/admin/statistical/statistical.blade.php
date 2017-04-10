@extends('admin.layouts.master')

@section('content')
<style type="text/css">
	.number{
		font-size: 26px;
	}
	.bg{
		background-color: #fff; padding: 20px
	}
</style>
<div class="row">
	<div class="col-sm-4 bg" >
		<p>Tổng Số lần truy Cập </p>
		<p class="text-right number" > <b> {{$totalClick}} </b></p>
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-4 bg">
		<p>Số Lần truy cập trong ngày </p>
		<p class="text-right number" ><b> {{$onday}} </b></p>
	</div>
</div>
	
	 
	 <p>Phần trăm trái : <b> {{$left}} % </b></p>
	 <p>Phần trăm phải : <b> {{$right}} % </b> </p>
	 <p>Số Thời gian trung bình của mỗi lần truy cập : <b> {{$timeAvg}} minute </b> </p>
	 <p>Số phần trăm người Click : <b> {{$percentClick}} % </b></p>
@endsection