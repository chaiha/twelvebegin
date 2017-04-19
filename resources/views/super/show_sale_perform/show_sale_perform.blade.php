@extends('super.layouts.master')

@section('content')
@section('js_files')

<script>

  $(document).ready(function(){

    $(function(){
       $( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
    });
    $('#submit_btn').click(function(){
    	$("#submit_form").submit();
    });
});
</script>
@stop
<?php
use App\Record;
use App\SelectRecord;
?>
<!-- Services Section -->
<div class="container">
	<div class="row">
		<h1>Select Sale : {{$sale->first_name}}</h1>
		{{Form::open(array('action' => 'SuperController@show_sale_perform_by_range','id'=>'submit_form'))}}
			{{csrf_field()}}
		<input type="text" name="sale_id" id="sale_id" value="{{$sale->id}}" />
		Start date: <input class="yes_form datepicker" type="text" id="start_priviledge_date" name="start_date" value=""/> End date : <input class="yes_form datepicker" type="text" id="end_priviledge_date" name="end_date" value=""/>
		<a href="#" class="btn btn-primary" id="submit_btn">Submit</a>
		{{Form::close() }}
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
		
	</div>
</div>

@endsection