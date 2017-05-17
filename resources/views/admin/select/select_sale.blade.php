@extends('admin.layouts.master')

@section('content')
<?php
use App\Record;
use App\SelectRecord;
?>
<!-- Services Section -->
<div class="container">
	<div class="row">
		<h1>เลือกร้านค้าให้เซล</h1>
		<table class="table">
		  <thead class="thead-inverse">
		  	<tr>
		  		<th class="text-center">Sale ID</th>
		  		<th class="text-center">ชื่อพนักงานขาย</th>
		  		<th class="text-center">ตำแหน่ง</th>
		  		<th class="text-center">Username</th>
		  		<th class="text-center"> จำนวน lead ที่มีอยู่ จำนวนร้านค้าคงค้าง</th>
		  		<th class="text-center">เลือก</th>
		  	</tr>
		  </thead>
		@foreach($sale_list as $sale_each)
		  <tbody class="text-center" >
		  	<tr>
		  		<td>{{$sale_each->id}}</td>
		  		<td>{{$sale_each->first_name}}</td>
		  		<td>{{$sale_each->last_name}}</td>
		  		<td>{{$sale_each->email}}</td>
		  		<td>
		  		<a href="{{url('/admin/select_record/show_selected_list_sale/'.$sale_each->id)}}">
		  		<?php $select_record = new SelectRecord; 
		  		$amount_lead= $select_record->show_amount_select_record_sale($sale_each->id);
		  		echo $amount_lead; ?>
		  			</a>
		  		</td>
		  		<td><a href="{{url('admin/select_record/select_sale/'.$sale_each->id)}}" >เลือก</a></td>
		  	</tr>
		  </tbody>
		@endforeach
	</div>
</div>

@endsection