@extends('admin.layouts.master')
@section('js_files')

<script type="text/javascript">
function submit_all_result()
{
	if(confirm("กรุณายืนยัน?"))
	{
		document.getElementById("submit_form").submit();	
	}
}
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
		<h1>รายการที่รอการ Approve </h1>
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
              <th>ID</th>
              <th>Date</th>
		      <th>Lot#</th>
		      <th>Month</th>
		      <th>Sales</th>
		      <th>Type</th>
		      <th>No.</th>
		      <th>ประเภทธุรกิจ</th>
		      <th>USSD No.</th>
		      <th>Xtra</th>
		      <th>Prefix1</th>
		      <th>Prefix2</th>
		      <th>Prefix3</th>
		      <th>ชื่อภาษาไทย</th>
		      <th>ชื่อภาษาอังกฤษ</th>
		      <th>Privilege</th>
		      <th>Eligibility(Per)</th>
		      <th>Quota</th>
		      <th>Period-Start</th>
		      <th>Period-End</th>
		      <th>Terms&Condition</th>
		      <th>เงื่อนไขเพิ่มเติม</th>
		      <th>สาขา</th>
		      <th>ที่อยู่</th>
		      <th>เบอร์โทรติดต่อ</th>
		      <th>ละติดจูด</th>
		      <th>ลองจิจูด</th>
		      <th>ประเภทร้าน</th>
		      <th>จำนวนสาขา</th>
		      <th>ขื่อเจ้าของร้าน/ผู้ประสานงาน</th>
		      <th>Standee</th>
		      <th>TentCard-A4</th>
		      <th>TentCard-A5</th>
		      <th>ที่อยู่จัดส่ง</th>
		      <th>ขอApproveสื่อ</th>
		      <th>C/FDoc</th>
		      <th>A.Logo</th>
		      <th>Logo</th>
		      <th>A.product</th>
		      <th>Product</th>
		      <th>A.shop</th>
		      <th>Shop</th>
		      <th>Done</th>
		      <th>Submit</th>
		      <th>Remark</th>
		    </tr>
		  </thead>
		  <tbody>
		  @foreach ($list_lot_date as $each_record)
		    <tr>
		      <td>{{$each_record->id}}</td>
              <td>{{$each_record->lot_date}}</td>
		      <td>{{$each_record->lot_date}}</td>
		      <td>{{$each_record->lot_date}}</td>
		      <td>{{$each_record->sale_id}}</td>
		      <td>{{$each_record->dtac_type}}</td>
		      <td>{{$each_record->id}}</td>
		      <td>{{$each_record->shop_type}}</td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->yes_feedback}}</td>
		      <td></td>
		      <td></td>
		      <td>{{$each_record->yes_privilege_start}}</td>
		      <td>{{$each_record->yes_privilege_end}}</td>
		      <td>{{$each_record->yes_condition}}</td>
		      <td></td>
		      <td>{{$each_record->branch}}</td>
		      <td>{{$each_record->address}}</td>
		      <td>{{$each_record->contact_tel}}</td>
		      <td>{{$each_record->latitude}}</td>
		      <td>{{$each_record->longtitude}}</td>
		      <td>{{$each_record->shop_type}}</td>
		      <td>{{$each_record->branch_amount}}</td>
		      <td>{{$each_record->contact_person}}</td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td>{{$each_record->sending_address}}</td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td>{{$each_record->remarks}}</td>
		    </tr>
		   @endforeach
		  </tbody>
		
		</table>
	</div>
	<div class="row">
		<div class="col-md-12" style="margin-left: 5px;">
				<hr>
				<a href="{{url('/admin/export_excel/export_excel/'.$lot_date)}}" class="btn btn-success">Export</a>
				<a href="{{url('admin/export_excel/list_lot_date')}}" class="btn btn-danger">ยกเลิก</a>
		</div>
	</div>
</div>


@endsection