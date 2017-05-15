@extends('admin.layouts.master')

@section('content')
<?php
use App\Record;
use App\SelectRecord;

?>
<!-- Services Section -->
<div class="container">
	<div class="row">
		<h1>เลือกเซลเพื่อ Approve Leads | <?php echo date('Y-m-d H:i:s');?></h1>
		<table class="table text-center">
		  <thead class="thead-inverse text-center">
		  	<tr>
		  		<th class="text-center">Sale ID</th>
		  		<th class="text-center">ชื่อพนักงานขาย</th>
		  		<th class="text-center">จำนวน Lead ที่ส่งมา Approve</th>
		  		<th class="text-center">เลือก</th>
		  	</tr>
		  </thead>
		@foreach($result as $result_each)
		  <tbody class="text-center">
		  	<tr>
		  	<?php
		  		$sale_each = Sentinel::findUserById($result_each->sale_id);
		  	?>
		  		<td>{{$sale_each->id}}</td>
		  		<td>{{$sale_each->first_name}}</td>
		  		<td>{{$result_each->record_count}}</a>
		  		</td>
		  		<td><a href="{{url('admin/approve_record_from_sale/select_sale/'.$sale_each->id)}}" >เลือก</a></td>
		  	</tr>
		  </tbody>
		@endforeach
	</div>
</div>

@endsection