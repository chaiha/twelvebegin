@extends('sale.layouts.master')

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
    $('#export_btn').click(function(){
    	$("#submit_export_form").submit();
    });
});
</script>
@stop
<?php
use App\Record;
use App\SelectRecord;
$record = new Record;
?>
<!-- Services Section -->
<div class="container">
	<div class="row">
		<h1>Select Sale : {{$sale->first_name}} : จำนวน Lead ที่ตอบรับ Yes = <span class="red"><?php echo sizeof($result);?></span></h1>
		{{Form::open(array('action' => 'CallController@show_sale_perform_by_range','id'=>'submit_form'))}}
			{{csrf_field()}}
		<input type="hidden" name="sale_id" id="sale_id" value="{{$sale->id}}" />
		Start date: <input class="yes_form datepicker" type="text" id="start_priviledge_date" name="start_date" value="{{$start_date}}"/> End date : <input class="yes_form datepicker" type="text" id="end_priviledge_date" name="end_date" value="{{$end_date}}"/>
		<a href="#" class="btn btn-primary" id="submit_btn">Submit</a>
		{{Form::close() }}
		<table class="table">
		  <thead class="thead-inverse">
		  	<tr>
		  		<th>No.</th>
		  		<th>ชื่อร้านภาษาไทย</th>
		  		<th>ชื่อร้านภาษาภาษาอังกฤษ</th>
		  		<th>Privilege Start</th>
		  		<th>dtac type</th>
		  		<th>categories</th>
		  		<th>วันที่Approve</th>
		  		<th>Lot No.</th>
		  		<th>เดือน</th>
		  	</tr>
		  	</thead>
		  	<?php $x=1; ?>
		  	@foreach($result as $result_each)
		  	<tr>
		  		<td><?php echo $x;$x++;?></td>
		  		<td>{{$result_each->name_th}}</td>
		  		<td>{{$result_each->name_en}}</td>
		  		<?php
		  			$start_date = $record->convert_date_formate($result_each->yes_privilege_start)
		  		?>
		  		<td>{{$start_date}}</td>
		  		<td>{{$result_each->dtac_type}}</td>
		  		<td><?php echo $record->check_category_name($result_each->categories); ?></td>
		  		<td>{{$result_each->approve_date}}</td>
		  		<td>{{$result_each->lot_no}}</td>
		  		<td>{{$result_each->month}}</td>
		  	</tr>
		  	@endforeach
		</table>
		<input type="hidden" name="sale_id_submit" id="sale_id_submit" value="{{$sale->id}}" />
		<input  type="hidden" id="start_priviledge_date_submit" name="start_date_submit" value="{{$start_date}}"/>
		<input  type="hidden" id="end_priviledge_date_submit" name="end_date_submit" value="{{$end_date}}"/>
	</div>
	<div class="row">
			<a href="{{url('/sale/show_sale_perform')}}" class="btn btn-danger">Back</a>
	</div>
</div>

@endsection