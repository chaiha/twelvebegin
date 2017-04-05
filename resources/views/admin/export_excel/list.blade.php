@extends('admin.layouts.master')

@section('content')
<?php
use App\Record;
use App\SelectRecord;
?>
<!-- Services Section -->
<div class="container">
	<div class="row">
		<h1>กรุณาเลือก Lot Date | วันนี้ <?php echo date('Y-m-d');?></h1>
		<table class="table">
		  <thead class="thead-inverse">
		  	<tr>
		  		<th>Lot date</th>
		  		<th>Total</th>
		  		<th>เลือก</th>
		  	</tr>
		  </thead>
		@foreach($list_lot_date as $list_lot_date_each)
		  <tbody>
		  	<tr>
		  		<td>{{$list_lot_date_each->lot_date}}</td>
		  		<td>{{$list_lot_date_each->total}}</td>
		  		<td>
		  		<a href="{{url('/admin/export_excel/show_selected_lot_date/'.$list_lot_date_each->lot_date)}}">เลือก</a>
		  		</td>
		  	</tr>
		  </tbody>
		@endforeach
	</table>
		{{$list_lot_date->links()}}
	</div>
</div>

@endsection