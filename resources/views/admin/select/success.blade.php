@extends('admin.layouts.master')
@section('js_files')

<script>


  		

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
		<h1>เลือกร้านค้าให้ {{$sale->first_name}}</h1>
		<h2>ทำการเลือก Leads ให้เซล {{$sale->first_name}} เสร็จสิ้น</h2>
		
	</div>
	<a class="btn btn-primary" href="{{url('/admin/select_record/select_sale')}}" role="button" id="confirm_btn">ย้อนกลับ</a>
</div>

@endsection