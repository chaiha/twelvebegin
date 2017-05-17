@extends('admin.layouts.master')

@section('content')
<?php
use App\Record;
$record = new Record;
?>
<!-- Services Section -->
<div class="container-fluid">
	<div class="row add-margin-left-right">
		<h1>รายชื่อร้านค้าทั้งหมด</h1>
		{{$records->links()}}
		<table class="table table-bordered table-striped">
		  <thead class="thead-inverse">
		    <tr>
		      <th class="text-center">ID</th>
		      <th class="text-center">แหล่งที่มา</th>
		      <th class="text-center">status</th>
		      <th class="text-center">categories</th>
		      <th class="text-center">ประเภทร้านค้าพิเศษ</th>
		      <th class="text-center">ผลการโทร</th>
		      <th class="text-center">ชื่อไทย</th>
		      <th class="text-center">ชื่ออังกฤษ</th>
		      <th class="text-center">จังหวัด</th>
		      <th class="text-center">เบอร์โทรติดต่อ</th>
		      <th class="text-center">แก้ไข</th>
		    </tr>
		  </thead>
		  <tbody class="text-center">
		  @foreach ($records as $each_record)
		    <tr>
		      <th scope="row" class="text-center">{{$each_record->id}}</th>
		      <td>
		      <?php
		      if($each_record->sources=="online_search")
		      {
		      	echo "ค้นหาจากเว็บไซต์";
		      }
		      elseif($each_record->sources=="dtac_recommend")
		      {
		      	echo "ร้านแนะนำจาก dtac";
		      }
		      elseif($each_record->sources=="walking")
		      {
		      	echo "Walk in";
		      }
		      ?></td>
		      <td>{{$each_record->status}}</td>
		      <td><?php echo $record->check_category_name($each_record->categories); ?></td>
		      <td>{{$each_record->special_type}}</td>
		      <td><?php echo $record->check_result_and_show($each_record->result); ?></td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->province}}</td>
		      <td>{{$each_record->contact_tel}}</td>
		      <td><a href="{{ url('admin/record/edit_record/'.$each_record->id) }}">แก้ไข</a></td>
		    </tr>
		   @endforeach
		  </tbody>
		</table>
		{{$records->links()}}
	</div>
</div>

@endsection