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
<div class="container-fluid add-margin-left-right">
	<div class="row">
		<h1>Reocord ที่เลือกให้สำหรับ เซล {{$sale->first_name}}</h1>
		จำนวน Record ที่เลือก : ต่อายุ: <span style="color:red;"><?php $mem_selected_record_extend = session('mem_selected_record_extend'); echo sizeof($mem_selected_record_extend	);?></span> + รอการพิจารณา: <span style="color:red;"><?php $mem_selected_record_waiting = session('mem_selected_record_waiting'); echo sizeof($mem_selected_record_waiting	);?></span> + ยังไม่สามารถติดต่อได้: <span style="color:red;"><?php $mem_selected_record_noreply = session('mem_selected_record_noreply'); echo sizeof($mem_selected_record_noreply	);?></span> + ใหม่: <span style="color:red;"><?php $mem_selected_record_new = session('mem_selected_record_new'); echo sizeof($mem_selected_record_new	);?></span> = รวมทั้งหมด <span style="color:red;"><?php $total_selected = sizeof($mem_selected_record_extend)+sizeof($mem_selected_record_waiting)+sizeof($mem_selected_record_noreply)+sizeof($mem_selected_record_new); echo $total_selected; ?></span>
		{{Form::open(array('action' => 'AdminController@submit_select_record','id'=>'submit_form'))}}
		<h3>Lead ต่ออายุ : <span class="red"><?php echo sizeof($mem_selected_record_extend); ?></span></h3>
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
		  @if($selected_record_list_extend!=NULL)
		  @foreach ($selected_record_list_extend as $each_record_extend)
		    <tr>
		      <td>{{$each_record_extend->id}}</td>
		      <td>{{$each_record_extend->no}}</td>
		      <td>{{$each_record_extend->code}}</td>
		      <td>{{$each_record_extend->status}}</td>
		      <td>{{$each_record_extend->effective_date}}</td>
		      <td>{{$each_record_extend->sources}}</td>
		      <td>{{$each_record_extend->categories}}</td>
		      <td>{{$each_record_extend->dtac_type}}</td>
		      <td>{{$each_record_extend->input_date}}</td>
		      <td>{{$each_record_extend->distributed_date}}</td>
		      <td>{{$each_record_extend->deadline}}</td>
		      <td>{{$each_record_extend->name_th}}</td>
		      <td>{{$each_record_extend->name_en}}</td>
		      <td>{{$each_record_extend->branch}}</td>
		      <td>{{$each_record_extend->province}}</td>
		      <td>{{$each_record_extend->address}}</td>
		      <td>{{$each_record_extend->contact_person}}</td>
		      <td>{{$each_record_extend->contact_email}}</td>
		      <td>{{$each_record_extend->contact_tel}}</td>
		      <td>{{$each_record_extend->contact_date}}</td>
		      <td>{{$each_record_extend->shop_type}}</td>
		      <td>{{$each_record_extend->sale_name}}</td>
		      <td>{{$each_record_extend->created_by}}</td>
		      <td>{{$each_record_extend->created_at}}</td>
		      <td>{{$each_record_extend->updated_by}}</td>
		      <td>{{$each_record_extend->updated_at}}</td>
		    </tr>
		   @endforeach
		   @endif
		  </tbody>
		  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		
		</table>

		<h3>Lead รอการพิจารณา : <span class="red"><?php echo sizeof($mem_selected_record_waiting); ?></span></h3>
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
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
		  @if($selected_record_list_waiting!=NULL)
		  @foreach ($selected_record_list_waiting as $each_record_waiting)
		    <tr>
		      <td>{{$each_record_waiting->id}}</td>
		      <td>{{$each_record_waiting->no}}</td>
		      <td>{{$each_record_waiting->code}}</td>
		      <td>{{$each_record_waiting->status}}</td>
		      <td>{{$each_record_waiting->effective_date}}</td>
		      <td>{{$each_record_waiting->sources}}</td>
		      <td>{{$each_record_waiting->categories}}</td>
		      <td>{{$each_record_waiting->dtac_type}}</td>
		      <td>{{$each_record_waiting->input_date}}</td>
		      <td>{{$each_record_waiting->distributed_date}}</td>
		      <td>{{$each_record_waiting->deadline}}</td>
		      <td>{{$each_record_waiting->name_th}}</td>
		      <td>{{$each_record_waiting->name_en}}</td>
		      <td>{{$each_record_waiting->branch}}</td>
		      <td>{{$each_record_waiting->province}}</td>
		      <td>{{$each_record_waiting->address}}</td>
		      <td>{{$each_record_waiting->contact_person}}</td>
		      <td>{{$each_record_waiting->contact_email}}</td>
		      <td>{{$each_record_waiting->contact_tel}}</td>
		      <td>{{$each_record_waiting->contact_date}}</td>
		      <td>{{$each_record_waiting->shop_type}}</td>
		      <td>{{$each_record_waiting->sale_name}}</td>
		      <td>{{$each_record_waiting->created_by}}</td>
		      <td>{{$each_record_waiting->created_at}}</td>
		      <td>{{$each_record_waiting->updated_by}}</td>
		      <td>{{$each_record_waiting->updated_at}}</td>
		    </tr>
		   @endforeach
		   @endif
		  </tbody>
		
		</table>

		<h3>Lead ยังไม่สามารถติดต่อได้ : <span class="red"><?php echo sizeof($mem_selected_record_noreply); ?></span></h3>
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
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
		  @if($selected_record_list_noreply!=NULL)
		  @foreach ($selected_record_list_noreply as $each_record_noreply)
		    <tr>
		      <td>{{$each_record_noreply->id}}</td>
		      <td>{{$each_record_noreply->no}}</td>
		      <td>{{$each_record_noreply->code}}</td>
		      <td>{{$each_record_noreply->status}}</td>
		      <td>{{$each_record_noreply->effective_date}}</td>
		      <td>{{$each_record_noreply->sources}}</td>
		      <td>{{$each_record_noreply->categories}}</td>
		      <td>{{$each_record_noreply->dtac_type}}</td>
		      <td>{{$each_record_noreply->input_date}}</td>
		      <td>{{$each_record_noreply->distributed_date}}</td>
		      <td>{{$each_record_noreply->deadline}}</td>
		      <td>{{$each_record_noreply->name_th}}</td>
		      <td>{{$each_record_noreply->name_en}}</td>
		      <td>{{$each_record_noreply->branch}}</td>
		      <td>{{$each_record_noreply->province}}</td>
		      <td>{{$each_record_noreply->address}}</td>
		      <td>{{$each_record_noreply->contact_person}}</td>
		      <td>{{$each_record_noreply->contact_email}}</td>
		      <td>{{$each_record_noreply->contact_tel}}</td>
		      <td>{{$each_record_noreply->contact_date}}</td>
		      <td>{{$each_record_noreply->shop_type}}</td>
		      <td>{{$each_record_noreply->sale_name}}</td>
		      <td>{{$each_record_noreply->created_by}}</td>
		      <td>{{$each_record_noreply->created_at}}</td>
		      <td>{{$each_record_noreply->updated_by}}</td>
		      <td>{{$each_record_noreply->updated_at}}</td>
		    </tr>
		   @endforeach
		   @endif
		  </tbody>
		
		</table>

		<h3>Lead ใหม่ : <span class="red"><?php echo sizeof($mem_selected_record_new); ?></span></h3>
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
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
		  @if($selected_record_list_new!=NULL)
		  @foreach ($selected_record_list_new as $each_record_new)
		    <tr>
		      <td>{{$each_record_new->id}}</td>
		      <td>{{$each_record_new->no}}</td>
		      <td>{{$each_record_new->code}}</td>
		      <td>{{$each_record_new->status}}</td>
		      <td>{{$each_record_new->effective_date}}</td>
		      <td>{{$each_record_new->sources}}</td>
		      <td>{{$each_record_new->categories}}</td>
		      <td>{{$each_record_new->dtac_type}}</td>
		      <td>{{$each_record_new->input_date}}</td>
		      <td>{{$each_record_new->distributed_date}}</td>
		      <td>{{$each_record_new->deadline}}</td>
		      <td>{{$each_record_new->name_th}}</td>
		      <td>{{$each_record_new->name_en}}</td>
		      <td>{{$each_record_new->branch}}</td>
		      <td>{{$each_record_new->province}}</td>
		      <td>{{$each_record_new->address}}</td>
		      <td>{{$each_record_new->contact_person}}</td>
		      <td>{{$each_record_new->contact_email}}</td>
		      <td>{{$each_record_new->contact_tel}}</td>
		      <td>{{$each_record_new->contact_date}}</td>
		      <td>{{$each_record_new->shop_type}}</td>
		      <td>{{$each_record_new->sale_name}}</td>
		      <td>{{$each_record_new->created_by}}</td>
		      <td>{{$each_record_new->created_at}}</td>
		      <td>{{$each_record_new->updated_by}}</td>
		      <td>{{$each_record_new->updated_at}}</td>
		    </tr>
		   @endforeach
		    @endif
		  </tbody>
		
		</table>
		{{ Form::close() }}
	</div>
	<a class="btn btn-primary" href="#" role="button" id="confirm_btn">Submit</a>
</div>

@endsection