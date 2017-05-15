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
// 		    	url: "{{url('/admin/selected_record/add_selected_record_waiting')}}",
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
// 		    	url: "{{url('/admin/selected_record/remove_selected_record_waiting')}}",
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
$record = new Record;
?>
<!-- Services Section -->
<div class="container-fluid" style="margin-left:20px;margin-right: 20px;">
	<div class="row">
		<h1>เลือกร้านค้าให้ {{$sale->first_name}}</h1>
		<?php
			$check_amount = new Record;
		?>
		<a class="btn btn-primary" href="{{url('/admin/select_record/select_sale/filter_extend/'.$sale->id)}}" role="button" id="confirm_btn">ต่ออายุ ({{$check_amount->amount_extend_priviledge()}})</a>
		<a class="btn btn-primary" href="{{url('/admin/select_record/select_sale/filter_waiting/'.$sale->id)}}" role="button" id="confirm_btn">รอการพิจารณา  ({{$check_amount->amount_waiting_record($sale->id)}})</a>
		<a class="btn btn-primary" href="{{url('/admin/select_record/select_sale/filter_noreply/'.$sale->id)}}" role="button" id="confirm_btn">ยังไม่สามารถติดต่อได้  ({{$check_amount->amount_noreply_record($sale->id)}})</a>
		<a class="btn btn-primary" href="{{url('/admin/select_record/select_sale/filter_new_record/'.$sale->id)}}" role="button" id="confirm_btn">Lead ใหม่  ({{$check_amount->amount_new_record()}})</a>
		<a class="btn btn-success" href="#" role="button" id="confirm_btn" onClick="submit_list()">ยืนยัน</a>
		{{Form::open(array('action'=>'AdminController@preview_select_record','id'=>'submit_list_form'))}}
		<input type="hidden" name="sale_id" id="sale_id_submit" value="{{$sale->id}}" />
		{{Form::close()}}
		<h3>Lead รอการพิจารณา</h3>
		จำนวน Leads ที่เลือก : ต่อายุ: <span style="color:red;"><?php $mem_selected_record_extend = session('mem_selected_record_extend'); echo sizeof($mem_selected_record_extend	);?></span> + รอการพิจารณา: <span style="color:red;"><?php $mem_selected_record_waiting = session('mem_selected_record_waiting'); echo sizeof($mem_selected_record_waiting	);?></span> + ยังไม่สามารถติดต่อได้: <span style="color:red;"><?php $mem_selected_record_noreply = session('mem_selected_record_noreply'); echo sizeof($mem_selected_record_noreply	);?></span> + ใหม่: <span style="color:red;"><?php $mem_selected_record_new = session('mem_selected_record_new'); echo sizeof($mem_selected_record_new	);?></span> = รวมทั้งหมด <span style="color:red;"><?php $total_selected = sizeof($mem_selected_record_extend)+sizeof($mem_selected_record_waiting)+sizeof($mem_selected_record_noreply)+sizeof($mem_selected_record_new); echo $total_selected; ?></span>
		{{Form::open(array('action' => 'AdminController@add_selected_record_waiting','id'=>'submit_form'))}}
		{{$record_list->links()}}
		<table class="table table-bordered table-striped">
		  <thead class="thead-inverse">
		    <tr>
		      <th>Select<input type="hidden" name="sale_id" id="sale_id" value="{{$sale->id}}" /></th>
		      <th>ID<input type="hidden" name="currentPage" id="currentPage" value="{{$record_list->currentPage()}}" /></th>
		      <th>status</th>
		      <th>แหล่งที่มา</th>
		      <th>categories</th>
		      <th>dtact type</th>
		      <th>ประเภทร้านพิเศษ</th>
		      <th>input date</th>
		      <th>ชื่อไทย</th>
		      <th>ชื่ออังกฤษ</th>
		      <th>สาขา</th>
		      <th>จังหวัด</th>
		      <th>ที่อยู่</th>
		      <th>ชื่อsale</th>
		    </tr>
		  </thead>
		  <tbody>
		  @foreach ($record_list as $each_record)
		    <tr>
		      <td><input type="checkbox" class="select_checkbox" name="selected_record[]" id="{{$each_record->id}}" value="{{$each_record->id}}" /></td>
		      <td>{{$each_record->id}}</td>
		      <td>{{$each_record->status}}</td>
		      <td>
		      @if($each_record->sources=="online_search")
		      ค้นหาจากเว็บไซต์
		      @elseif($each_record->sources=="dtac_recommend")
		      ร้านแนะนำจาก dtac
		      @elseif($each_record->sources=="walking")
		      Walk in
		      @endif
		      </td>
		      <td><?php echo $record->check_category_name($each_record->categories); ?></td>
		      <td>
		      <?php 
						if($each_record->dtac_type=="กทม./นนทบุรี/สมุทรปราการ")
						{
							echo "กทม./นนทบุรี/สมุทรปราการ";
						}
						elseif($each_record->dtac_type=="ต่างจังหวัด")
						{
							echo "ต่างจังหวัด";
						}
						elseif($each_record->dtac_type=="dtacแนะนำ")
						{
							echo "dtac แนะนำ";
						}
						elseif($each_record->dtac_type=="online")
						{
							echo "online";
						}
						elseif($each_record->dtac_type=="ต่ออายุ")
						{
							echo "ต่ออายุ";
						}
						elseif($each_record->dtac_type=="ดีลอย่างเดียว")
						{
							echo "ดีลอย่างเดียว";
						}
						elseif($each_record->dtac_type=="เฉพาะอาร์ทเวิร์ค")
						{
							echo "เฉพาะอาร์ทเวิร์ค";
						}
						?>
						
		      </td>
		      <td>{{$each_record->special_type}}</td>
		      <td><?php echo $record->convert_date_formate($each_record->input_date); ?></td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->branch}}</td>
		      <td>{{$each_record->province}}</td>
		      <td>{{$each_record->address}}</td>
		      <td>{{$each_record->sale_name}}</td>
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