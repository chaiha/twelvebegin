@extends('admin.layouts.master')

@section('content')
@section('styles')
<style type="text/css">
.hide
{
	display:none;
}
.show
{
	display:block;
}
.add-margin-20
{
	margin:20px;
}
</style>
@stop
@section('js_files')

<script>

  $(document).ready(function(){

    $("#confirm_btn").click(function(){
    	$("#submit_form").submit();	
    });
    $("#edit_btn").click(function(){
    	$("#edit_form").submit();	
    });
  });
</script>
@stop
<?php
use App\Record;
?>
<!-- Services Section -->
<div class="container-fluid add-margin-20">
	<div class="row">
		<div class="form-group">
		<h1>{{$select_record->record->name_th}} <?php if($select_record->record->name_en!=""){ echo "/ ".$select_record->record->name_en;}	?> / โทรครั้งที่ {{$select_record->call_amount}}</h1>
		<h3>ข้อมูลเบื้องต้นของ {{$select_record->record->name_th}} / {{$select_record->record->name_en}} / ติดต่อ {{$select_record->record->contact_person}} / โทร {{$select_record->record->contact_tel}}</h3>
		{{Form::open(array('action' => 'CallController@submit_filled_record','id'=>'submit_form'))}}
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-12">
				<label>ข้อมูลสำหรับ Record</label>
				<input type="hidden" id="record_id" name="record_id" value="{{$select_record->record->id}}" />
				<input type="hidden" id="call_amount" name="call_amount" value="{{$select_record->record->call_amount}}" />
				<table class="table table-bordered table-striped">
					<tr>
						<th>No.</th>
						<th>Code.</th>
						<th>Status</th>
						<th>Sources</th>
						<th>Dtac Type</th>
						<th>Categories</th>
						<th>ประเภทร้าน</th>
						<th>ประเภทร้านพิเศษ</th>
					</tr>
					<tr>
						<td>{{$select_record->record->no}}</td>
						<td>{{$select_record->record->code}}</td>
						<td>
							<?php
								if($select_record->record->status=="Available")
								{
									echo "Available";
								}
								elseif ($select_record->record->status=="Not_available") 
								{
									echo "Not Available";
								}
							?>
						</td>
						<td>
							<?php
								if($select_record->record->sources=="online_search")
								{
									echo "Online Search";
								}
								elseif ($select_record->record->sources=="dtac_recommend") 
								{
									echo "DTAC Recommend";
								}
								elseif ($select_record->record->sources=="walking") 
								{
									echo "Walking";
								}
								?>
						</td>
						<td>
							<?php
								if($select_record->record->dtac_type=="ร้านกทม")
								{
									echo "ร้าน กทม";
								}
								elseif ($select_record->record->dtac_type=="ร้านตจว") 
								{
									echo "ร้าน ตจว";
								}
								elseif ($select_record->record->dtac_type=="ร้านonline") 
								{
									echo "ร้าน online";
								}
								elseif ($select_record->record->dtac_type=="ร้านต่ออายุ") 
								{
									echo "ร้านต่ออายุ";
								}
								elseif ($select_record->record->dtac_type=="ร้านดีลอย่างเดียว") 
								{
									echo "ร้านดีลอย่างเดียว";
								}
								elseif ($select_record->record->dtac_type=="ร้านเฉพาะอาร์ทเวิร์ค") 
								{
									echo "ร้านเฉพาะอาร์ทเวิร์ค";
								}
								?>
						</td>
						<td>
							<?php
								if($select_record->record->categories=="dinning_and_beverage")
								{
									echo "Dining & Beverage";
								}
								elseif ($select_record->record->categories=="shopping_and_lifestyle") 
								{
									echo "Shopping & Lifestyle";
								}
								elseif ($select_record->record->categories=="beauty_and_healthy") 
								{
									echo "Beauty & Healthy";
								}
								elseif ($select_record->record->categories=="hotel_and_travel") 
								{
									echo "Hotel & Travel";
								}
								elseif ($select_record->record->categories=="online") 
								{
									echo "Online";
								}
								?>
						</td>
						<td>
							<?php
								if($select_record->record->shop_type=="ร้านเบ็ดเตล็ด")
								{
									echo "ร้าน เบ็ดเตล็ด";
								}
								elseif ($select_record->record->shop_type=="ร้านอาหาร") 
								{
									echo "ร้าน อาหาร";
								}
								elseif ($select_record->record->shop_type=="ร้านอาหารนานาชาติ") 
								{
									echo "ร้าน อาหารนานาชาติ";
								}
								
								?>
						</td>
						<td>
							{{$select_record->record->special_type}}
						</td>
					</tr>
				</table>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-12">
				<label>ข้อมูลของร้าน</label>
				<table class="table table-bordered table-striped">
					<tr>
						<th>ชื่อภาษาไทย</th>
						<th>ชื่อภาษาอังกฤษ</th>
						<th>สาขา</th>
						<th>จำนวนสาขา</th>
						<th>ที่อยู่  </th>
						<th>จังหวัด</th>
						<th>ละติจูด</th>
						<th>ลองติจูด</th>
					</tr>
					<tr>
						<td>{{$select_record->record->name_th}}</td>
						<td>{{$select_record->record->name_en}}</td>
						<td>{{$select_record->record->branch}}</td>
						<td>{{$sale_filled['branch_amount']}}</td>
						<td>
						@if($edit_address!="none")
							{{$edit_address}}
						@else
							{{$select_record->record->address}}
						@endif
						</td>
						<td>{{$select_record->record->province}}</td>
						<td>{{$select_record->record->latitude}}</td>
						<td>{{$select_record->record->longtitude}}</td>
					</tr>
				</table>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-12">
			<label>ข้อมูลสำหรับติดต่อ</label>
			<table class="table table-bordered table-striped">
					<tr>
						<th>Contact Person</th>
						<th>Contact Telephone number</th>
						<th>Contact Email</th>
						<th>Contact Date [ วัน / เดือน / ปี ]</th>
						<th>ที่อยู่ให้จัดส่ง</th>
					</tr>
					<tr>
						<td>
						@if($edit_contact_person!="none")
							{{$edit_contact_person}}
						@else
							{{$select_record->record->contact_person}}
						@endif
						</td>
						<td>{{$select_record->record->contact_tel}}</td>
						<td>{{$select_record->record->contact_email}}</td>
						<td>
							<?php
								$contact_date = explode("-",$select_record->record->contact_date);
								$contact_day = $contact_date[1];
								$contact_month = $contact_date[2];
								$contact_year = $contact_date[0];
							?>
							{{$contact_day}} / {{$contact_month}} / {{$contact_year}}
						</td>
						<td>{{$sale_filled['sending_address']}}</td>
					</tr>
				</table>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-12">
			<label>ข้อมูลอื่นๆ</label>
			<table class="table table-bordered table-striped">
					<tr>
						<th>Links</th>
						<th>Remark</th>
					</tr>
					<tr>
						<td>
							<?php
								if($select_record->record->links!=NULL)
								{
									echo($select_record->record->links);
								}
								else
								{
									echo "-";
								}
								?>
						</td>
						<td>
							<?php
								if($select_record->record->remarks!=NULL)
								{
									echo $select_record->record->remarks;
								}
								else
								{
									echo "-";
								}
								
							?>
						</td>
					</tr>
				</table>
			</div>
			</div>
		<br />
		<div class="row">
			<div class="col-xs-12">
			<label>หมายเหตุ</label>
			<table class="table table-bordered table-striped">
					<tr>
						<th>หมายเหตุ</th>
					</tr>
					<tr>
						<td>
							{{$sale_filled['note']}}
						</td>
					</tr>
				</table>
			</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-12">
				<label>เบอร์โทรศัพท์: </label> <?php if($sale_filled['is_tel_correct']=="1"){ echo "ถูกต้อง";} else { echo "เบอร์โทรศัพท์ไม่ถูกต้อง เบอร์ที่ถูกต้องคือ ".$sale_filled['new_tel']; } ?>
				
			</div>
			<div class="row">
		</div>
		<div class="row">
			<div class="col-xs-12"><b>ผลการโทร : </b>
				@if($call_result=="yes") 
					<span>Yes</span><br />					
					<b>Feedback : </b> {{$sale_filled['feedback']}} <br />
					<b>เงื่อนไข : </b> {{$sale_filled['condition']}} <br />
					<b>Start Privilege Date [ วัน / เดือน / ปี ] : </b> {{$sale_filled['start_priviledge_day']}} / {{$sale_filled['start_priviledge_month']}} / {{$sale_filled['start_priviledge_year']}} <br />
					<b>End Privilege Date [ วัน / เดือน / ปี ] : </b> {{$sale_filled['end_priviledge_day']}} / {{$sale_filled['end_priviledge_month']}} / {{$sale_filled['end_priviledge_year']}}

				@elseif($call_result=="no_reply")
					<span>No Reply</span><br />
					<b>จำนวนครั้งที่โทรก่อนหน้า : </b> <?php echo $select_record->record->call_amount ;?> <br />
					<b>เหตุผล : </b> {{$sale_filled['cannot_contact_reason']}} <br />
					<b>นัดโทรครั้งถัดไป [ วัน / เดือน / ปี ] : </b> {{$sale_filled['cannot_contact_appointment_day']}} / {{$sale_filled['cannot_contact_appointment_month']}} / {{$sale_filled['cannot_contact_appointment_year']}} <br />
					
				@elseif($call_result=="rejected")
					<span>Rejected</span><br />
					<b>No Reason : </b> {{$sale_filled['no_reason']}} <br />
					<b>No Note : </b> {{$sale_filled['no_note']}} <br />

				@elseif($call_result=="waiting")
					<span>Waiting</span><br />
					<b>เหตุผลที่ขอพิจารณาดูก่อน : </b> {{$sale_filled['consider_reason']}} <br />
					<b>วันที่นัดรับ Feedback [ วัน / เดือน / ปี ] </b> {{$sale_filled['consider_appointment_feedback_day']}} / {{$sale_filled['consider_appointment_feedback_month']}} / {{$sale_filled['consider_appointment_feedback_year']}} <br />

				@elseif($call_result=="closed")
					<span>ร้านปิดไปแล้ว</span><br />
				@endif
				
			</div>
		</div>
		<br />
		<a class="btn btn-success" href="#" role="button" id="confirm_btn">ยืนยัน</a>
		<a class="btn btn-primary" href="#" role="button" id="edit_btn">แก้ไข</a>
		<a class="btn btn-danger" href="{{ url('sale/show_selected_record_list') }}" role="button" id="cancel_btn">ยกเลิก</a>
		{{Form::close() }}
		{{Form::open(array('action' => 'CallController@edit_filled_record','id'=>'edit_form'))}}
		<input type="hidden" id="record_id" name="record_id" value="{{$select_record->record->id}}" />
		{{Form::close() }}
		</div>
	</div>
</div>
</div>

@endsection