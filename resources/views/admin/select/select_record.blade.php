@extends('admin.layouts.master')
@section('js_files')

<script>

function select_record_checkbox(record_id)
{
	var record_id = record_id;
	var is_checked = document.getElementById(record_id).checked;
	if(is_checked==true)
	  	{
	  		$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            $.ajax({
		    	type: "POST",
		    	url: "{{url('/admin/selected_record/add_selected_record')}}",
		    	data: {"data" : record_id,"_token": $('#token').val()}, 
		    	cache: false,

		        success: function(){
		        	alert('เพิ่มเข้าสู่ระบบ');
		             location.reload();
	         	}
  			});
	  	}
	else
	  	{
	  		$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            $.ajax({
		    	type: "POST",
		    	url: "{{url('/admin/selected_record/remove_selected_record')}}",
		    	data: {"data" : record_id,"_token": $('#token').val()}, 
		    	cache: false,

		        success: function(){
		        	alert('เอาออกจากระบบ');
		             location.reload();
	         	}
  			});
	  	}
}

  		

//-------------------------
 //  if(document.getElementById('isAgeSelected').checked) {
	//     // $("#txtAge").show();
	//     alert("xxx");
	// } else {
	//     $("#txtAge").hide();
	// }
	//--------------------
  //   $("#update_selected_record").click(function(){

  // //   	alert("x");
  // //   	 dataString = ['xx','yy','zz']; // array?
  // //   	//dataString = "1"; // array?
		// //  var jsonString = JSON.stringify(dataString);
		// // $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
  // //       $.ajax({
		// //         type: "POST",
		// //         url: "{{url('/admin/selected_record/add_selected_record')}}",
		// //         data: {"data" : jsonString,"_token": $('#token').val()}, 
		// //         cache: false,

		// //         success: function(){
		// //             alert("OK");
	 // //        	}
  // //       	});
  //    	});

  // });

</script>
@stop
@section('content')
<?php
use App\Record;
use App\SelectRecord;
?>
<!-- Services Section -->
<div class="content">
	<div class="row">
		<h1>Select Records for {{$sale->first_name}}</h1><?php $mem_selected_record = session('mem_selected_record'); echo sizeof($mem_selected_record	);?>
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
		      <th>Select</th>
		      <th>#</th>
		      <th>no</th>
		      <th>code</th>
		      <th>source</th>
		      <th>status</th>
		      <th>categories</th>
		      <th>sub-categories</th>
		      <th>name_th</th>
		      <th>name_en</th>
		      <th>province</th>
		      <th>contact_person</th>
		      <th>contact_tel</th>
		      <th>contact_date</th>
		      <th>created_by</th>
		      <th>created_at</th>
		      <th>updated_by</th>
		      <th>updated_at</th>
		    </tr>
		  </thead>
		  <tbody>
		  @foreach ($record_list as $each_record)
		    <tr>
		      <td><input type="checkbox" class="select_checkbox" name="selected_record[]" id="{{$each_record->id}}" value="{{$each_record->id}}" onClick="select_record_checkbox({{$each_record->id}})" <?php $has_record = SelectRecord::check_selected_record($each_record->id); if($has_record=="1"){echo "checked";}?>/></td>
		      <th>{{$each_record->id}}</th>
		      <td>{{$each_record->no}}</td>
		      <td>{{$each_record->code}}</td>
		      <td>{{$each_record->source}}</td>
		      <td>{{$each_record->status}}</td>
		      <td>{{$each_record->categories}}</td>
		      <td>{{$each_record->sub_categories}}</td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->province}}</td>
		      <td>{{$each_record->contact_person}}</td>
		      <td>{{$each_record->contact_tel}}</td>
		      <td>{{$each_record->contact_date}}</td>
		      <td>{{$each_record->created_by}}</td>
		      <td>{{$each_record->created_at}}</td>
		      <td>{{$each_record->updated_by}}</td>
		      <td>{{$each_record->updated_at}}</td>
		    </tr>
		   @endforeach
		  </tbody>
		  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		
		</table>
		<a class="btn btn-warning" href="#" role="button" id="update_selected_record" >Update</a><br /><br />
		{{$record_list->links()}}
	</div>
	<a class="btn btn-primary" href="#" role="button" id="confirm_btn">Submit</a>
</div>

@endsection