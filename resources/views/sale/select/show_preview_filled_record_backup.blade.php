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
<div class="content">
	<div class="row">
		<div class="form-group">
		<h1>{{$select_record->record->name_th}} <?php if($select_record->record->name_en!=""){ echo "/ ".$select_record->record->name_en;}	?> / โทรครั้งที่ {{$select_record->record->call_amount}}</h1>
		<h3>ข้อมูลเบื้องต้นของ {{$select_record->record->name_th}}</h3>
		{{Form::open(array('action' => 'CallController@submit_filled_record','id'=>'submit_form'))}}
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-2">
				<label>No.</label>
				<input type="hidden" id="record_id" name="record_id" value="{{$select_record->record->id}}" />
				{{$select_record->record->no}}
			</div>
			<div class="col-xs-2">
				<label>Code.</label>
				{{$select_record->record->code}}
			</div>
			<div class="col-xs-3">
				<label>Status.</label>
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
			</div>
		</div>
		<br />
		{{$select_record->record->dtac_type}}
		<div class="row">
			<div class="col-xs-3">
				<label>Sources.</label>
				<?php
				if($select_record->record->sources=="online_search")
				{
					echo "ค้นหาจากเว็บไซต์";
				}
				elseif ($select_record->record->sources=="dtac_recommend") 
				{
					echo "ร้านแนะนำจาก dtac";
				}
				elseif ($select_record->record->sources=="walking") 
				{
					echo "Walk in";
				}
				?>
			</div>
			<div class="col-xs-3">
				<label>Categories.</label>
				<?php
				if($select_record->record->categories=="dinning_and_beverage")
				{
					echo "Dining and Beverage";
				}
				elseif ($select_record->record->categories=="shopping_and_lifestyle") 
				{
					echo "Shopping and Lifestyle";
				}
				elseif ($select_record->record->categories=="beauty_and_healthy") 
				{
					echo "Beauty and Healthy";
				}
				elseif ($select_record->record->categories=="hotel_and_travel") 
				{
					echo "Hotel and Travel";
				}
				elseif ($select_record->record->categories=="online") 
				{
					echo "Online";
				}
				?>
			</div>
			<div class="col-xs-3">
				<label>Dtac Type.</label>
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
			</div>
			<div class="col-xs-3">
				<label>ประเภทร้าน.</label>
				
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
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Name Thai.</label>
				{{$select_record->record->name_th}}
			</div>
			<div class="col-xs-4">
				<label>Name English.</label>
				{{$select_record->record->name_en}}
			</div>
			<div class="col-xs-4">
				<label>สาขา.</label>
				{{$select_record->record->branch}}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ที่อยู่.</label>
				{{$select_record->record->address}}
			</div>
			<div class="col-xs-6">
				<label>จังหวัด.</label>
				{{$select_record->record->province}}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ละติจูด.</label>
				{{$select_record->record->latitude}}
			</div>
			<div class="col-xs-6">
				<label>ลองติจูด.</label>
				{{$select_record->record->longitude}}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Contact Person.</label>
				{{$select_record->record->contact_person}}
			</div>
			<div class="col-xs-4">
				<label>Contact Telephone number.</label>
				{{$select_record->record->contact_tel}}
			</div>
			<div class="col-xs-4">
				<label>Contact Email.</label>
				{{$select_record->record->contact_email}}
			</div>
			<div class="col-xs-4">
				<label>Contact Date [ วัน / เดือน / ปี ]</label>
				<?php
					$contact_date = explode("-",$select_record->record->contact_date);
					$contact_day = $contact_date[1];
					$contact_month = $contact_date[2];
					$contact_year = $contact_date[0];
				?>
				<div class="row">
					<div class="col-xs-4">
						<div class="input-group">
							<b>วัน</b>
							{{$contact_day}}
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<b>เดือน</b>
							{{$contact_month}}
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<b>ปี</b>
							{{$contact_year}}
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Link.</label>
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
			</div>
			<div class="col-xs-6">
				<label>Remarks.</label>
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