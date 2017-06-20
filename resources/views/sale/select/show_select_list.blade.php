@extends('sale.layouts.master')
@section('js_files')

<script type="text/javascript">
function submit_all_result()
{
	if(confirm("ถ้าท่านกดยืนยันแล้วจะไม่สามารถแก้ไขข้อมูลได้ ท่านจะตกลงหรือไม่?"))
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
$record = new Record;
?>
<!-- Services Section -->
<div class="container" style="margin-left: 5px;">
	<div class="row" style="width:2000px;">
	<?php 
		$today = date('Y-m-d');
		$today_array =explode('-', $today);
	?>
		<h1>รายการที่ต้องโทร ของ {{$sale->first_name}} / วันที่ {{$today_array[2]}}-{{$today_array[1]}}-{{$today_array[0]}}</h1>
		จำนวน Record ที่เลือก : ต่อายุ: <span style="color:red;"><?php $mem_selected_record_extend = $record_list_extend; echo sizeof($mem_selected_record_extend	);?></span> + รอการพิจารณา: <span style="color:red;"><?php $mem_selected_record_waiting = $record_list_waiting; echo sizeof($mem_selected_record_waiting	);?></span> + ยังไม่สามารถติดต่อได้: <span style="color:red;"><?php $mem_selected_record_noreply = $record_list_noreply; echo sizeof($mem_selected_record_noreply	);?></span> + ใหม่: <span style="color:red;"><?php $mem_selected_record_new = $record_list_new; echo sizeof($mem_selected_record_new	);?></span> = รวมทั้งหมด <span style="color:red;"><?php $total_selected = sizeof($mem_selected_record_extend)+sizeof($mem_selected_record_waiting)+sizeof($mem_selected_record_noreply)+sizeof($mem_selected_record_new); echo $total_selected; ?></span>

		<h3>Lead ต่ออายุ : <span class="red"><?php echo sizeof($record_list_extend); ?></span></h3>
		{{Form::open(array('action' => 'CallController@submit_allresult_selected_record','id'=>'submit_form'))}}
		<table class="table-condensed table-bordered table-striped">
		  <thead class="thead-inverse">
		    <tr>
		      <th class="text-center">ผลการโทร</th>
              <th class="text-center">สถานะของ Leads</th>
              <th class="text-center">ข้อมูลร้านค้า</th>
		      <th class="text-center">ชื่อไทย</th>
		      <th class="text-center">ชื่ออังกฤษ</th>
		      <th class="text-center">สาขา</th>
		      <th class="text-center">categories</th>
		      <th class="text-center">dtac type</th>
		      <th class="text-center">start privilege</th>
		      <th class="text-center">end privilege</th>
		    </tr>
		  </thead>
		  <tbody class="text-center">
		  @foreach ($record_list_extend as $each_record)
		    <tr>
		      <td style="margin:0px;">
		      @if($each_record->result!=NULL)
		      	@if($each_record->cannot_send=="0"||$each_record->cannot_send==NULL)
		      		<b style="color:green"><?php echo $record->check_result_and_show($each_record->result); ?></b><br /><br /><a href="{{url('/sale/select_record/edit_record/'.$each_record->record_id)}}" class="btn btn-warning">แก้ไขผลการโทร</a>
		      	@elseif($each_record->cannot_send=="1")
		      		ข้อมูลได้ถูกจัดส่งแล้ว
		      	@endif
		      @elseif($each_record->result==NULL)
		      	@if($each_record->cannot_send=="0"||$each_record->cannot_send==NULL)
		      		<a href="{{url('sale/select_record/call/'.$each_record->record_id)}}" class="btn btn-primary">โทร</a></td>
		      	@elseif($each_record->cannot_send=="1")
		      		ข้อมูลได้ถูกจัดส่งแล้ว
		      	@endif
              @endif
		      </td>
		      <td>
		      <?php
		      	if($each_record->cannot_send=="1")
		      	{
		      		echo "ข้อมูลได้ถูกส่งแล้ว";
		      	}
		      	else
		      	{
			      	if($each_record->result!=NULL)
			      	{
			      		if($each_record->sending_status=="not_approve"&&$each_record->is_corrected!="1")
			      		{
			      			echo "<b style='color:red;'>ไม่อนุมัติ</b>";
			      		}
			      		elseif($each_record->sending_status=="not_approve"&&$each_record->is_corrected=="1")
			      		{
			      			echo "<b>แก้ไขแล้ว</b>";
			      		}
			      	}
		      	}
		      ?>
		      <input type="hidden" name="record_id_list[]" value="{{$each_record->record_id}}" />
		      </td>
              <td>
              @if($each_record->cannot_send=="1")
              	<?php echo "กำลังรอตรวจสอบ"; ?>
              @else
              <a href="{{url('/sale/edit_record/record/show/'.$each_record->record_id)}}" >แก้ไขข้อมูล</a>
              @endif
              </td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->branch}}</td>
		      <td><?php echo $record->check_category_name($each_record->categories); ?></td>
		      <td>{{$each_record->dtac_type}}</td>
		      <td>
		      <?php 
		      if($each_record->record->yes_privilege_start!=NULL)
		      {
		      echo $record->convert_date_formate($each_record->record->yes_privilege_start);
		      }?>
		      </td>
		      <td>
		      <?php 
		      if($each_record->record->yes_privilege_end!=NULL)
		      {
		      echo $record->convert_date_formate($each_record->record->yes_privilege_end);
		      }?>
		      </td>
		    </tr>
		   @endforeach
		  </tbody>
		
		</table>
		
		<h3>Lead รอการพิจารณา : <span class="red"><?php echo sizeof($record_list_waiting); ?></span></h3>
		<table class="table-condensed table-bordered table-striped">
		  <thead class="thead-inverse">
		    <tr>
		      <th class="text-center">ผลการโทร</th>
		      <th class="text-center">สถานะของ Leads</th>
              <th class="text-center">ข้อมูลร้านค้า</th>
		      <th class="text-center">ชื่อไทย</th>
		      <th class="text-center">ชื่ออังกฤษ</th>
		      <th class="text-center">สาขา</th>
		      <th class="text-center">categories</th>
		      <th class="text-center">dtac type</th>
		      <th class="text-center">เหตุผลที่ขอพิจารณาดูก่อนหน้านี้</th>
		      <th class="text-center">วันที่นัดรับ feedback ก่อนหน้า</th>
		      <th class="text-center">จำนวนครั้งที่ติดต่อไปก่อนหน้า</th>
		      <th class="text-center">วันที่ติดต่อล่าสุด</th>
		    </tr>
		  </thead>
		  <tbody class="text-center">
		  @foreach ($record_list_waiting as $each_record)
		    <tr>
		      <td style="margin:0px;">
		      @if($each_record->result!=NULL)
		      	@if($each_record->cannot_send=="0"||$each_record->cannot_send==NULL)
		      		<b style="color:green"><?php echo $record->check_result_and_show($each_record->result); ?></b><br /><br /><a href="{{url('/sale/select_record/edit_record/'.$each_record->record_id)}}" class="btn btn-warning">แก้ไขผลการโทร</a>
		      	@elseif($each_record->cannot_send=="1")
		      		ข้อมูลได้ถูกจัดส่งแล้ว
		      	@endif
		      @elseif($each_record->result==NULL)
		      	@if($each_record->cannot_send=="0"||$each_record->cannot_send==NULL)
		      		<a href="{{url('sale/select_record/call/'.$each_record->record_id)}}" class="btn btn-primary">โทร</a></td>
		      	@elseif($each_record->cannot_send=="1")
		      		ข้อมูลได้ถูกจัดส่งแล้ว
		      	@endif
              @endif
		      </td>
		      <td>
		      <?php
		      	if($each_record->cannot_send=="1")
		      	{
		      		echo "ข้อมูลได้ถูกส่งแล้ว";
		      	}
		      	else
		      	{
			      	if($each_record->result!=NULL)
			      	{
			      		if($each_record->sending_status=="not_approve"&&$each_record->is_corrected!="1")
			      		{
			      			echo "<b style='color:red;'>ไม่อนุมัติ</b>";
			      		}
			      		elseif($each_record->sending_status=="not_approve"&&$each_record->is_corrected=="1")
			      		{
			      			echo "<b>แก้ไขแล้ว</b>";
			      		}
			      	}
		      	}
		      ?>
		      <input type="hidden" name="record_id_list[]" value="{{$each_record->record_id}}" />
		      </td>
              <td>
              @if($each_record->cannot_send=="1")
              	<?php echo "กำลังรอตรวจสอบ"; ?>
              @else
              <a href="{{url('/sale/edit_record/record/show/'.$each_record->record_id)}}" >แก้ไขข้อมูล</a>
              @endif
              </td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->branch}}</td>
		      <td><?php echo $record->check_category_name($each_record->categories); ?></td>
		      <td>{{$each_record->dtac_type}}</td>
		      <td>
		      	{{$each_record->record->consider_reason}}
		      </td>
		      <td>
		      	<?php
		      		if($each_record->record->consider_appointment_feedback!=NULL)
		      		{
		      			echo $record->convert_date_formate($each_record->record->consider_appointment_feedback);
		      		}
		      	?>
		      </td>
		      <td>
		      	{{$each_record->record->waiting_count}}
		      </td>
		      <td>
		      	<?php
		      		if($each_record->record->updated_at!=NULL)
		      		{
		      			echo $record->convert_datetime_to_date($each_record->record->updated_at);
		      		}
		      	?>
		      </td>
		    </tr>
		   @endforeach
		  </tbody>
		
		</table>

		<h3>Lead ยังไม่สามารถติดต่อได้ : <span class="red"><?php echo sizeof($record_list_noreply); ?></span></h3>
		<table class="table-condensed table-bordered table-striped">
		  <thead class="thead-inverse">
		    <tr>
		      <th class="text-center">ผลการโทร</th>
		      <th class="text-center">สถานะของ Leads</th>
              <th class="text-center">ข้อมูลร้านค้า</th>
		      <th class="text-center">ชื่อไทย</th>
		      <th class="text-center">ชื่ออังกฤษ</th>
		      <th class="text-center">สาขา</th>
		      <th class="text-center">categories</th>
		      <th class="text-center">dtac type</th>
		      <th class="text-center">เหตุผลก่อนหน้า</th>
		      <th class="text-center">นัดครั้งถัดไป</th>
		      <th class="text-center">จำนวนครั้งที่ติดต่อไปก่อนหน้า</th>
		      <th class="text-center">วันที่ติดต่อล่าสุด</th>
		    </tr>
		  </thead>
		  <tbody class="text-center">
		  @foreach ($record_list_noreply as $each_record)
		    <tr>
		      <td>
		      	@if($each_record->result!=NULL)
		      		@if($each_record->cannot_send=="0"||$each_record->cannot_send==NULL)
		      			<b style="color:green"><?php echo $record->check_result_and_show($each_record->result); ?></b><br /><br /><a href="{{url('/sale/select_record/edit_record/'.$each_record->record_id)}}" class="btn btn-warning">แก้ไขผลการโทร</a>
		      		@elseif($each_record->cannot_send=="1")
		      		ข้อมูลได้ถูกจัดส่งแล้ว
		      		@endif
		        @elseif($each_record->result==NULL)
		        	@if($each_record->cannot_send=="0"||$each_record->cannot_send==NULL)
		      	  		<a href="{{url('sale/select_record/call/'.$each_record->record_id)}}" class="btn btn-primary">โทร</a></td>
		      	  	@elseif($each_record->cannot_send=="1")
		      		ข้อมูลได้ถูกจัดส่งแล้ว
		      		@endif
                @endif
		      </td>
		      <td>
		       <?php
		      	if($each_record->cannot_send=="1")
		      	{
		      		echo "ข้อมูลได้ถูกส่งแล้ว";
		      	}
		      	else
		      	{
			      	if($each_record->result!=NULL)
			      	{
			      		if($each_record->sending_status=="not_approve"&&$each_record->is_corrected!="1")
			      		{
			      			echo "<b style='color:red;'>ไม่อนุมัติ</b>";
			      		}
			      		elseif($each_record->sending_status=="not_approve"&&$each_record->is_corrected=="1")
			      		{
			      			echo "<b>แก้ไขแล้ว</b>";
			      		}
			      	}
		      	}
		      ?>
		      <input type="hidden" name="record_id_list[]" value="{{$each_record->record_id}}" />
		      </td>
              <td>
              @if($each_record->cannot_send=="1")
              	<?php echo "กำลังรอตรวจสอบ"; ?>
              @else
              <a href="{{url('/sale/edit_record/record/show/'.$each_record->record_id)}}" >แก้ไขข้อมูล</a>
              @endif
              </td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->branch}}</td>
		      <td><?php echo $record->check_category_name($each_record->categories); ?></td>
		      <td>{{$each_record->dtac_type}}</td>
		      <td>{{$each_record->record->cannot_contact_reason}}</td>
		      <td>
		      	<?php
		      		if($each_record->record->cannot_contact_appointment!=NULL)
		      		{
		      			echo $record->convert_date_formate($each_record->record->cannot_contact_appointment);
		      		}
		      	?>
		      </td>
		      <td>{{$each_record->record->waiting_count}}</td>
		      <td>
		      	<?php
		      		if($each_record->record->updated_at!=NULL)
		      		{
		      			echo $record->convert_datetime_to_date($each_record->record->updated_at);
		      		}
		      	?>
		      </td>
		    </tr>
		   @endforeach
		  </tbody>
		
		</table>

		<h3>Lead ใหม่ : <span class="red"><?php echo sizeof($record_list_new); ?></span></h3>
		<table class="table-condensed table-bordered table-striped">
		  <thead class="thead-inverse">
		    <tr>
		      <th class="text-center">ผลการโทร</th>
		      <th class="text-center">สถานะของ Leads</th>
              <th class="text-center">ข้อมูลร้านค้า</th>
		      <th class="text-center">ชื่อไทย</th>
		      <th class="text-center">ชื่ออังกฤษ</th>
		      <th class="text-center">สาขา</th>
		      <th class="text-center">categories</th>
		      <th class="text-center">dtac type</th>
		    </tr>
		  </thead>
		  <tbody class="text-center">
		  @foreach ($record_list_new as $each_record)
		    <tr>
		      <td>
		      	@if($each_record->result!=NULL)
		      		@if($each_record->cannot_send=="0"||$each_record->cannot_send==NULL)
		      			<b style="color:green"><?php echo $record->check_result_and_show($each_record->result); ?></b><br /><br /><a href="{{url('/sale/select_record/edit_record/'.$each_record->record_id)}}" class="btn btn-warning">แก้ไขผลการโทร</a>
		      		@elseif($each_record->cannot_send=="1")
		      		ข้อมูลได้ถูกจัดส่งแล้ว
		      		@endif
		        @elseif($each_record->result==NULL)
		       		@if($each_record->cannot_send=="0"||$each_record->cannot_send==NULL)
		      	  		<a href="{{url('sale/select_record/call/'.$each_record->record_id)}}" class="btn btn-primary">โทร</a></td>
		      	  	@elseif($each_record->cannot_send=="1")
		      		ข้อมูลได้ถูกจัดส่งแล้ว
		      		@endif
                @endif
		      </td>
		      <td>
		     <?php
		      	if($each_record->cannot_send=="1")
		      	{
		      		echo "ข้อมูลได้ถูกส่งแล้ว";
		      	}
		      	else
		      	{
			      	if($each_record->result!=NULL)
			      	{
			      		if($each_record->sending_status=="not_approve"&&$each_record->is_corrected!="1")
			      		{
			      			echo "<b style='color:red;'>ไม่อนุมัติ</b>";
			      		}
			      		elseif($each_record->sending_status=="not_approve"&&$each_record->is_corrected=="1")
			      		{
			      			echo "<b>แก้ไขแล้ว</b>";
			      		}
			      	}
		      	}
		      ?>
		       <input type="hidden" name="record_id_list[]" value="{{$each_record->record_id}}" />
		      </td>
              <td>
              @if($each_record->cannot_send=="1")
              	<?php echo "กำลังรอตรวจสอบ"; ?>
              @else
              <a href="{{url('/sale/edit_record/record/show/'.$each_record->record_id)}}" >แก้ไขข้อมูล</a>
              @endif
              </td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->branch}}</td>
		      <td><?php echo $record->check_category_name($each_record->categories); ?></td>
		      <td>{{$each_record->dtac_type}}</td>
		    </tr>
		   @endforeach
		  </tbody>
		  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		
		</table>
	</div>
	<div class="row">
		<div class="col-md-12">
				{{csrf_field()}}
				<input type="hidden" name="sale_id" value="{{$sale->id}}" />
				<hr>
				@if(($check_cannot_send)!="1")
				<a href="#" class="btn btn-success" onClick="submit_all_result()">ส่งข้อมูลทั้งหมดให้ แอดมิน</a>
				@elseif(($check_cannot_send)=="1")
				-
				@endif
			{{Form::close() }}
		</div>
	</div>
</div>

@endsection