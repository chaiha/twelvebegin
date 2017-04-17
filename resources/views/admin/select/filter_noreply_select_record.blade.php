@extends('admin.layouts.master')
@section('js_files')

<script>

// function select_record_checkbox(record_id)
// {
// 	var record_id = record_id;
// 	var is_checked = document.getElementById(record_id).checked;
// 	if(is_checked==true)
// 	  	{
// 	  		$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
//             $.ajax({
// 		    	type: "POST",
// 		    	url: "{{url('/admin/selected_record/add_selected_record_noreply')}}",
// 		    	data: {"data" : record_id,"_token": $('#token').val()}, 
// 		    	cache: false,

// 		        success: function(){
// 		        	alert('เพิ่มเข้าสู่ระบบ');
// 		             location.reload();
// 	         	}
//   			});
// 	  	}
// 	else
// 	  	{
// 	  		$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
//             $.ajax({
// 		    	type: "POST",
// 		    	url: "{{url('/admin/selected_record/remove_selected_record_noreply')}}",
// 		    	data: {"data" : record_id,"_token": $('#token').val()}, 
// 		    	cache: false,

// 		        success: function(){
// 		        	alert('เอาออกจากระบบ');
// 		             location.reload();
// 	         	}
//   			});
// 	  	}
// }

function submit_form()
{
	if(confirm('กรุณายืนยัน'))
	{
		document.getElementById("submit_form").submit();	
	}
	
}  		
function submit_list()
{
	if(confirm('กรุณายืนยันเพื่อทำการ Submit List'))
	{
		document.getElementById("submit_list_form").submit();	
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
<div class="container-fluid" style="margin-left:20px;margin-right: 20px;">
	<div class="row">
		<h1>Select Records for {{$sale->first_name}}</h1>
		<?php
			$check_amount = new Record;
		?>
		<a class="btn btn-primary" href="{{url('/admin/select_record/select_sale/filter_extend/'.$sale->id)}}" role="button" id="confirm_btn">ต่ออายุ ({{$check_amount->amount_extend_priviledge()}})</a>
		<a class="btn btn-primary" href="{{url('/admin/select_record/select_sale/filter_waiting/'.$sale->id)}}" role="button" id="confirm_btn">รอการพิจารณา  ({{$check_amount->amount_waiting_record($sale->id)}})</a>
		<a class="btn btn-primary" href="{{url('/admin/select_record/select_sale/filter_noreply/'.$sale->id)}}" role="button" id="confirm_btn">ยังไม่สามารถติดต่อได้  ({{$check_amount->amount_noreply_record($sale->id)}})</a>
		<a class="btn btn-primary" href="{{url('/admin/select_record/select_sale/filter_new_record/'.$sale->id)}}" role="button" id="confirm_btn">Lead ใหม่  ({{$check_amount->amount_new_record()}})</a>
		<a class="btn btn-success" href="#" role="button" id="confirm_btn" onClick="submit_list()">Submit</a>
		{{Form::open(array('action'=>'AdminController@preview_select_record','id'=>'submit_list_form'))}}
		<input type="hidden" name="sale_id" id="sale_id_submit" value="{{$sale->id}}" />
		{{Form::close()}}
		<h3>Lead ยังไม่สามารถติดต่อได้</h3>
		จำนวน Record ที่เลือก : ต่อายุ: <span style="color:red;"><?php $mem_selected_record_extend = session('mem_selected_record_extend'); echo sizeof($mem_selected_record_extend	);?></span> + รอการพิจารณา: <span style="color:red;"><?php $mem_selected_record_waiting = session('mem_selected_record_waiting'); echo sizeof($mem_selected_record_waiting	);?></span> + ยังไม่สามารถติดต่อได้: <span style="color:red;"><?php $mem_selected_record_noreply = session('mem_selected_record_noreply'); echo sizeof($mem_selected_record_noreply	);?></span> + ใหม่: <span style="color:red;"><?php $mem_selected_record_new = session('mem_selected_record_new'); echo sizeof($mem_selected_record_new	);?></span> = รวมทั้งหมด <span style="color:red;"><?php $total_selected = sizeof($mem_selected_record_extend)+sizeof($mem_selected_record_waiting)+sizeof($mem_selected_record_noreply)+sizeof($mem_selected_record_new); echo $total_selected; ?></span>
		{{Form::open(array('action' => 'AdminController@add_selected_record_noreply','id'=>'submit_form'))}}
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
		      <th>Select<input type="hidden" name="sale_id" id="sale_id" value="{{$sale->id}}" /></th>
		      <th>#<input type="hidden" name="currentPage" id="currentPage" value="{{$record_list->currentPage()}}" /></th>
		      <th>no</th>
		      <th>code</th>
		      <th>status</th>
		      <th>effective date</th>
		      <th>sources</th>
		      <th>categories</th>
		      <th>dtact type</th>
		      <th>ประเภทร้านพิเศษ</th>
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
		  @foreach ($record_list as $each_record)
		    <tr>
		      <td><input type="checkbox" class="select_checkbox" name="selected_record[]" id="{{$each_record->id}}" value="{{$each_record->id}}" onClick="select_record_checkbox({{$each_record->id}})" /></td>
		      <td>{{$each_record->id}}</td>
		      <td>{{$each_record->no}}</td>
		      <td>{{$each_record->code}}</td>
		      <td>{{$each_record->status}}</td>
		      <td>{{$each_record->effective_date}}</td>
		      <td>{{$each_record->sources}}</td>
		      <td>{{$each_record->categories}}</td>
		      <td>{{$each_record->dtac_type}}</td>
		      <td>{{$each_record->special_type}}</td>
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
		{{$record_list->links()}}
	</div>
	<a class="btn btn-primary" href="#" role="button" id="confirm_btn" onClick="submit_form()">Update</a>
</div>

@endsection