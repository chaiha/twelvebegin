@extends('super.layouts.master')

@section('content')
<?php
use App\Record;
?>
<!-- Services Section -->
<div class="content add-margin-left-right">
	<div class="row">
		<h1>Select Sale</h1>
		<table class="table">
		  <thead class="thead-inverse">
		  	<tr>
		  		<th>Sale id</th>
		  		<th>Sale first name</th>
		  		<th>Sale last name</th>
		  		<th>Sale e-mail</th>
		  		<th>เลือก</th>
		  	</tr>
		  </thead>
		@foreach($sale_list as $sale_each)
		  <tbody>
		  	<tr>
		  		<td>{{$sale_each->id}}</td>
		  		<td>{{$sale_each->first_name}}</td>
		  		<td>{{$sale_each->last_name}}</td>
		  		<td>{{$sale_each->email}}</td>
		  		<td><a href="{{url('super/select_record/show_selected_record/'.$sale_each->id)}}" ><span class="glyphicon glyphicon-eye-open"></span></a></td>
		  	</tr>
		  </tbody>
		@endforeach
	</div>
</div>

@endsection