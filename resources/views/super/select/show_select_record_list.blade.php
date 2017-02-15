@extends('super.layouts.master')
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
use App\User;
?>
<!-- Services Section -->
<div class="container" style="margin-left: 5px;">
	<div class="row" style="width:2000px;">
		<h1>Show result of {{$sale->first_name}}</h1>
		จำนวน Record ที่เลือก : <span style="color:red;"><?php echo sizeof($record_list);?></span>
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
		      <th>ผลการโทร</th>
		      <th>จำนวนครั้งที่โทรไปแล้ว</th>
		      <th>code</th>
		      <th>name th</th>
		      <th>name en</th>
		      <th>branch</th>
		      <th>province</th>
		      <th>sources</th>
		      <th>categories</th>
		      <th>shop type</th>
		      <th>dtact type</th>
		      <th>input date</th>
		      <th>distributed date</th>
		      <th>deadline</th>
		      <th>contact person</th>
		      <th>contact email</th>
		      <th>contact date</th>
		      <th>created_by</th>
		      <th>created_at</th>
		      <th>updated_by</th>
		      <th>updated_at</th>
		    </tr>
		  </thead>
		  <tbody>
		  @foreach ($record_list as $each_record)
		    <tr>
		      <td>{{$each_record->record->result}}</td>
		      <td>{{$each_record->record->call_amount}}</td>
		      <td>{{$each_record->record->code}}</td>
		      <td>{{$each_record->record->name_th}}</td>
		      <td>{{$each_record->record->name_en}}</td>
		      <td>{{$each_record->record->branch}}</td>
		      <td>{{$each_record->record->province}}</td>
		      <td>{{$each_record->record->sources}}</td>
		      <td>{{$each_record->record->categories}}</td>
		      <td>{{$each_record->record->shop_type}}</td>
		      <td>{{$each_record->record->dtac_type}}</td>
		      <td>{{$each_record->record->input_date}}</td>
		      <td>{{$each_record->record->distributed_date}}</td>
		      <td>{{$each_record->record->deadline}}</td>
		      <td>{{$each_record->record->contact_person}}</td>
		      <td>{{$each_record->record->contact_email}}</td>
		      <td>{{$each_record->record->contact_date}}</td>
		      <td><?php echo $user = User::get_first_name_by_id($each_record->record->created_by); ?></td>
		      <td>{{$each_record->record->created_at}}</td>
		      <td><?php echo $user = User::get_first_name_by_id($each_record->record->updated_by) ; ?></td>
		      <td>{{$each_record->record->updated_at}}</td>
		    </tr>
		   @endforeach
		  </tbody>
		  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		
		</table>
		
		
	</div>
</div>

@endsection