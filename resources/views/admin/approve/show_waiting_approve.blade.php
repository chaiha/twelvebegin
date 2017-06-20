@extends('admin.layouts.master')
@section('js_files')

<script type="text/javascript">
function submit_all_result()
{
	value = document.getElementById('lot_no_number_1').value;

	if(value=="")
	{
		alert('กรุณากรอกหมายเลข Lot Number');
	}
	else
	{
		if(confirm("กรุณายืนยัน?"))
		{
			document.getElementById("submit_form").submit();	
		}	
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
		<h1>รายการที่รอการ Approve ของ {{$sale->first_name}}</h1>
		<h3>Lead ต่ออายุ : <span class="red"><?php echo sizeof($record_list_extend); ?></span></h3>
		{{Form::open(array('action' => 'AdminController@submit_all_approve_record','id'=>'submit_form'))}}
		<table class=" table-condensed table-bordered table-striped">
		  <thead class="thead-inverse">
		    <tr>
              <th class="text-center">สถานะ</th>
              <th class="text-center">ดู</th>
              <th class="text-center">แก้ไขข้อมูล</th>
		      <th class="text-center">ผลการโทร</th>
		      <th class="text-center">ชื่อไทย</th>
		      <th class="text-center">ชื่ออังกฤษ</th>
		      <th class="text-center">สาขา</th>
		      <th class="text-center">แหล่งที่มา</th>
		      <th class="text-center">categories</th>
		      <th class="text-center">dtact type</th>
		      <th class="text-center">Privilege Start</th>
		      <th class="text-center">Privilege End</th>
		    </tr>
		  </thead>
		  <tbody class="text-center">
		  @foreach ($record_list_extend as $each_record)
		    <tr>
		      <td>
		      <?php
		      	if($each_record->sending_status=="approve")
		      	{
		      		echo "<span style='color:green'>Approve</span>";
		      	}
		      	elseif($each_record->sending_status=="not_approve")
		      	{
		      		echo "<span style='color:red'>Not Approve</span>";
		      	}
		      	elseif((($each_record->sending_status!="not_approve")&&($each_record->sending_status!="approve"))&&($each_record->is_corrected=="1"))
		      	{
		      		echo "<span style='color:black'>Lead แก้ไข</span>";
		      	}
		      ?>
		      <input type="hidden" name="record_id_list[]" value="{{$each_record->record_id}}" />
		      </td>
              <td>
              <a href="{{url('admin/approve_record_from_sale/show_record_detail/'.$each_record->record_id.'/'.$sale->id)}}">ดูรายละเอียด</a>
              </td>
              <td>
              @if($each_record->result=="yes")
              <a href="{{url('/admin/approve_record_from_sale/edit_record/'.$each_record->record_id.'/'.$each_record->sale_id)}}" class="btn btn-warning">แก้ไขข้อมูล</a>
              @else
              -
              @endif
              </td>
		      <td>
		      <span <?php if($each_record->result=="yes"){echo "style='color:green'";}elseif($each_record->result=="no_reply"||$each_record->result=="waiting"){echo "style='color:#FF8000'";}elseif($each_record->result=="rejected"||$each_record->result=="closed"){echo "style='color:red'";} ?>>
		      {{$record->check_result_and_show($each_record->result)}}
		      </span>
		      </td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->branch}}</td>
		      <td>{{$each_record->sources}}</td>
		      <td><?php echo $record->check_category_name($each_record->categories); ?></td>
		      <td>{{$each_record->dtac_type}}</td>
		      <td>
		      <?php
		      	if($each_record->result=="yes")
		      	{
		      		echo $record->convert_date_format_dash($each_record->yes_privilege_start);

		      	}
		      	else
		      	{
		      		echo "-";
		      	}
		      ?>
		      </td>
		      <td>
		      	<?php
		      	if($each_record->result=="yes")
		      	{
		      		echo $record->convert_date_format_dash($each_record->yes_privilege_end);

		      	}
		      	else
		      	{
		      		echo "-";
		      	}
		      ?>
		      </td>
		    </tr>
		   @endforeach
		  </tbody>
		
		</table>
		
		<h3>Lead รอการพิจารณา : <span class="red"><?php echo sizeof($record_list_waiting); ?></span></h3>
		<table class=" table-condensed table-bordered table-striped">
		  <thead class="thead-inverse">
		    <tr>
		      <th class="text-center">สถานะ</th>
              <th class="text-center">ดู</th>
              <th class="text-center">แก้ไขข้อมูล</th>
		      <th class="text-center">ผลการโทร</th>
		      <th class="text-center">ชื่อไทย</th>
		      <th class="text-center">ชื่ออังกฤษ</th>
		      <th class="text-center">สาขา</th>
		      <th class="text-center">แหล่งที่มา</th>
		      <th class="text-center">categories</th>
		      <th class="text-center">dtact type</th>
		      <th class="text-center">Privilege Start</th>
		      <th class="text-center">Privilege End</th>
		    </tr>
		  </thead>
		  <tbody  class="text-center">
		  @foreach ($record_list_waiting as $each_record)
		    <tr>
		      <td>
		      <?php
		      	if($each_record->sending_status=="approve")
		      	{
		      		echo "<span style='color:green'>Approve</span>";
		      	}
		      	elseif($each_record->sending_status=="not_approve")
		      	{
		      		echo "<span style='color:red'>Not Approve</span>";
		      	}
		      	elseif((($each_record->sending_status!="not_approve")&&($each_record->sending_status!="approve"))&&($each_record->is_corrected=="1"))
		      	{
		      		echo "<span style='color:red'>Lead แก้ไข</span>";
		      	}
		      ?>
		      <input type="hidden" name="record_id_list[]" value="{{$each_record->record_id}}" />
		      </td>
              <td>
              	<a href="{{url('admin/approve_record_from_sale/show_record_detail/'.$each_record->record_id.'/'.$sale->id)}}">ดูรายละเอียด</a>
             </td>
             <td>
              @if($each_record->result=="yes")
              <a href="{{url('/admin/approve_record_from_sale/edit_record/'.$each_record->record_id.'/'.$each_record->sale_id)}}" class="btn btn-warning">แก้ไขข้อมูล</a>
              @else
              -
              @endif
              </td>
		      <td>
		      <span <?php if($each_record->result=="yes"){echo "style='color:green'";}elseif($each_record->result=="no_reply"||$each_record->result=="waiting"){echo "style='color:#FF8000'";}elseif($each_record->result=="rejected"||$each_record->result=="closed"){echo "style='color:red'";} ?>>
		      {{$record->check_result_and_show($each_record->result)}}
		      </span>
		      </td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->branch}}</td>
		      <td>{{$each_record->sources}}</td>
			  <td><?php echo $record->check_category_name($each_record->categories); ?></td>
		      <td>{{$each_record->dtac_type}}</td>
		      <td>
		      <?php
		      	if($each_record->result=="yes")
		      	{
		      		echo $record->convert_date_format_dash($each_record->yes_privilege_start);

		      	}
		      	else
		      	{
		      		echo "-";
		      	}
		      ?>
		      </td>
		      <td>
		      	<?php
		      	if($each_record->result=="yes")
		      	{
		      		echo $record->convert_date_format_dash($each_record->yes_privilege_end);

		      	}
		      	else
		      	{
		      		echo "-";
		      	}
		      ?>
		      </td>
		    </tr>
		   @endforeach
		  </tbody>
		
		</table>

		<h3>Lead ยังไม่สามารถติดต่อได้ : <span class="red"><?php echo sizeof($record_list_noreply); ?></span></h3>
		<table class=" table-condensed table-bordered table-striped">
		  <thead class="thead-inverse">
		    <tr>
		     <th class="text-center">สถานะ</th>
              <th class="text-center">ดู</th>
              <th class="text-center">แก้ไขข้อมูล</th>
		      <th class="text-center">ผลการโทร</th>
		      <th class="text-center">ชื่อไทย</th>
		      <th class="text-center">ชื่ออังกฤษ</th>
		      <th class="text-center">สาขา</th>
		      <th class="text-center">แหล่งที่มา</th>
		      <th class="text-center">categories</th>
		      <th class="text-center">dtact type</th>
		      <th class="text-center">Privilege Start</th>
		      <th class="text-center">Privilege End</th>
		    </tr>
		  </thead>
		  <tbody  class="text-center">
		  @foreach ($record_list_noreply as $each_record)
		    <tr>
		      <td>
		      <?php
		      	if($each_record->sending_status=="approve")
		      	{
		      		echo "<span style='color:green'>Approve</span>";
		      	}
		      	elseif($each_record->sending_status=="not_approve")
		      	{
		      		echo "<span style='color:red'>Not Approve</span>";
		      	}
		      	elseif((($each_record->sending_status!="not_approve")&&($each_record->sending_status!="approve"))&&($each_record->is_corrected=="1"))
		      	{
		      		echo "<span style='color:black'>Lead แก้ไข</span>";
		      	}
		      ?>
		      <input type="hidden" name="record_id_list[]" value="{{$each_record->record_id}}" />
		      </td>
              <td>
              	<a href="{{url('admin/approve_record_from_sale/show_record_detail/'.$each_record->record_id.'/'.$sale->id)}}">ดูรายละเอียด</a>
              </td>
              <td>
              @if($each_record->result=="yes")
              <a href="{{url('/admin/approve_record_from_sale/edit_record/'.$each_record->record_id.'/'.$each_record->sale_id)}}" class="btn btn-warning">แก้ไขข้อมูล</a>
              @else
              -
              @endif
              </td>
		      <td>
		      <span <?php if($each_record->result=="yes"){echo "style='color:green'";}elseif($each_record->result=="no_reply"||$each_record->result=="waiting"){echo "style='color:#FF8000'";}elseif($each_record->result=="rejected"||$each_record->result=="closed"){echo "style='color:red'";} ?>>
		      {{$record->check_result_and_show($each_record->result)}}
		      </span>
		      </td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->branch}}</td>
		      <td>{{$each_record->sources}}</td>
		      <td><?php echo $record->check_category_name($each_record->categories); ?></td>
		      <td>{{$each_record->dtac_type}}</td>
		      <td>
		      <?php
		      	if($each_record->result=="yes")
		      	{
		      		echo $record->convert_date_format_dash($each_record->yes_privilege_start);

		      	}
		      	else
		      	{
		      		echo "-";
		      	}
		      ?>
		      </td>
		      <td>
		      	<?php
		      	if($each_record->result=="yes")
		      	{
		      		echo $record->convert_date_format_dash($each_record->yes_privilege_end);

		      	}
		      	else
		      	{
		      		echo "-";
		      	}
		      ?>
		      </td>
		    </tr>
		   @endforeach
		  </tbody>
		
		</table>

		<h3>Lead ใหม่ : <span class="red"><?php echo sizeof($record_list_new); ?></span></h3>
		<table class="table-condensed table-bordered table-striped ">
		  <thead class="thead-inverse">
		    <tr>
		      <th class="text-center">สถานะ</th>
              <th class="text-center">ดู</th>
              <th class="text-center">แก้ไขข้อมูล</th>
		      <th class="text-center">ผลการโทร</th>
		      <th class="text-center">ชื่อไทย</th>
		      <th class="text-center">ชื่ออังกฤษ</th>
		      <th class="text-center">สาขา</th>
		      <th class="text-center">แหล่งที่มา</th>
		      <th class="text-center">categories</th>
		      <th class="text-center">dtact type</th>
		      <th class="text-center">Privilege Start</th>
		      <th class="text-center">Privilege End</th>
		    </tr>
		  </thead>
		  <tbody class="text-center">
		  @foreach ($record_list_new as $each_record)
		    <tr>
		      <td>
		      <?php
		      	if($each_record->sending_status=="approve")
		      	{
		      		echo "<span style='color:green'>Approve</span>";
		      	}
		      	elseif($each_record->sending_status=="not_approve")
		      	{
		      		echo "<span style='color:red'>Not Approve</span>";
		      	}
		      	elseif((($each_record->sending_status!="not_approve")&&($each_record->sending_status!="approve"))&&($each_record->is_corrected=="1"))
		      	{
		      		echo "<span style='color:black'>Lead แก้ไข</span>";
		      	}
		      ?>
		      <input type="hidden" name="record_id_list[]" value="{{$each_record->record_id}}" />
		      </td>
              <td>
              	<a href="{{url('admin/approve_record_from_sale/show_record_detail/'.$each_record->record_id.'/'.$sale->id)}}">ดูรายละเอียด</a>
              </td>
              <td>
              @if($each_record->result=="yes")
              <a href="{{url('/admin/approve_record_from_sale/edit_record/'.$each_record->record_id.'/'.$each_record->sale_id)}}" class="btn btn-warning">แก้ไขข้อมูล</a>
              @else
              -
              @endif
              </td>
		      <td>
		      <span <?php if($each_record->result=="yes"){echo "style='color:green'";}elseif($each_record->result=="no_reply"||$each_record->result=="waiting"){echo "style='color:#FF8000'";}elseif($each_record->result=="rejected"||$each_record->result=="closed"){echo "style='color:red'";} ?>>
		      {{$record->check_result_and_show($each_record->result)}}
		      </span>
		      </td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->branch}}</td>
		      <td>{{$each_record->sources}}</td>
		      <td><?php echo $record->check_category_name($each_record->categories); ?></td>
		      <td>{{$each_record->dtac_type}}</td>
		      <td>
		      <?php
		      	if($each_record->result=="yes")
		      	{
		      		echo $record->convert_date_format_dash($each_record->yes_privilege_start);

		      	}
		      	else
		      	{
		      		echo "-";
		      	}
		      ?>
		      </td>
		      <td>
		      	<?php
		      	if($each_record->result=="yes")
		      	{
		      		echo $record->convert_date_format_dash($each_record->yes_privilege_end);

		      	}
		      	else
		      	{
		      		echo "-";
		      	}
		      ?>
		      </td>
		    </tr>
		   @endforeach
		  </tbody>
		  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		
		</table>
	</div>
	<div class="row">
		<div class="col-md-12" style="margin-left: 5px;">
		<hr>
			
				{{csrf_field()}}
				<b>Lot Number: </b>
				<input type="text" name="lot_no_number_1" id="lot_no_number_1" value="" size="3"/> - <input type="text" name="lot_no_number_2" id="lot_no_number_2" value="" size="3"/> -
				<?php $current_year = date('y');?>
				<select name="lot_no_month">
					<option value="Jan-{{$current_year}}">Jan-{{$current_year}}</option>
					<option value="Feb-{{$current_year}}">Feb-{{$current_year}}</option>
					<option value="Mar-{{$current_year}}">Mar-{{$current_year}}</option>
					<option value="Apr-{{$current_year}}">Apr-{{$current_year}}</option>
					<option value="May-{{$current_year}}">May-{{$current_year}}</option>
					<option value="June-{{$current_year}}">June-{{$current_year}}</option>
					<option value="July-{{$current_year}}">July-{{$current_year}}</option>
					<option value="Aug-{{$current_year}}">Aug-{{$current_year}}</option>
					<option value="Sept-{{$current_year}}">Sept-{{$current_year}}</option>
					<option value="Oct-{{$current_year}}">Oct-{{$current_year}}</option>
					<option value="Nov-{{$current_year}}">Nov-{{$current_year}}</option>
					<option value="Dec-{{$current_year}}">Dec-{{$current_year}}</option>
				</select>
				<input type="hidden" name="sale_id" value="{{$sale->id}}" />
				<hr>
				<a href="#" class="btn btn-success" onClick="submit_all_result()">Submit</a>
				<a href="{{url('/admin/approve_record_from_sale/show_sale_list')}}" class="btn btn-danger">ยกเลิก</a>
			{{Form::close() }}
		</div>
	</div>
</div>


@endsection