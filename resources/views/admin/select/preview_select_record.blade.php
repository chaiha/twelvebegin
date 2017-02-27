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

  $(document).ready(function(){

    $("#confirm_btn").click(function(){
        $("#submit_form").submit();

    });

  });

  		

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
<div class="container">
	<div class="row">
		<h1>Reocord ที่เลือกให้สำหรับ เซล {{$sale->first_name}}</h1>
		จำนวน Record ที่เลือก : <span style="color:red;"><?php $mem_selected_record = session('mem_selected_record'); echo sizeof($mem_selected_record	);?></span>
		{{Form::open(array('action' => 'AdminController@submit_select_record','id'=>'submit_form'))}}
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
		      <input type="hidden" name="sale_id" id="sale_id" value="{{$sale->id}}" />
		      <th>#</th>
		      <th>no</th>
		      <th>code</th>
		      <th>status</th>
		      <th>effective date</th>
		      <th>sources</th>
		      <th>categories</th>
		      <th>dtact type</th>
		      <th>input date</th>
		      <th>distributed date</th>
		      <th>deadline</th>
		      <th>name th</th>
		      <th>name en</th>
		      <th>branch</th>
		      <th>province</th>
		      <th>address</th>
		      <th>contact person</th>
		      <th>contact email</th>
		      <th>contact tel</th>
		      <th>contact date</th>
		      <th>shop type</th>
		      <th>sale name</th>
		      <th>created_by</th>
		      <th>created_at</th>
		      <th>updated_by</th>
		      <th>updated_at</th>
		    </tr>
		  </thead>
		  <tbody>
		  @foreach ($selected_record_list as $each_record)
		    <tr>
		      <td>{{$each_record->id}}</td>
		      <td>{{$each_record->no}}</td>
		      <td>{{$each_record->code}}</td>
		      <td>{{$each_record->status}}</td>
		      <td>{{$each_record->effective_date}}</td>
		      <td>{{$each_record->sources}}</td>
		      <td>{{$each_record->categories}}</td>
		      <td>{{$each_record->dtac_type}}</td>
		      <td>{{$each_record->input_date}}</td>
		      <td>{{$each_record->distributed_date}}</td>
		      <td>{{$each_record->deadline}}</td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->branch}}</td>
		      <td>{{$each_record->province}}</td>
		      <td>{{$each_record->address}}</td>
		      <td>{{$each_record->contact_person}}</td>
		      <td>{{$each_record->contact_email}}</td>
		      <td>{{$each_record->contact_tel}}</td>
		      <td>{{$each_record->contact_date}}</td>
		      <td>{{$each_record->shop_type}}</td>
		      <td>{{$each_record->sale_name}}</td>
		      <td>{{$each_record->created_by}}</td>
		      <td>{{$each_record->created_at}}</td>
		      <td>{{$each_record->updated_by}}</td>
		      <td>{{$each_record->updated_at}}</td>
		    </tr>
		   @endforeach
		  </tbody>
		  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		
		</table>
		{{ Form::close() }}
	</div>
	<a class="btn btn-primary" href="#" role="button" id="confirm_btn">Submit</a>
</div>

@endsection