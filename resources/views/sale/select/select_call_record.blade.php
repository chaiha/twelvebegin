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
    $("#call_result").change(function(){
    	var result = $("#call_result").val();
    	if(result=="yes")
    	{
    		$("#yes_form").attr('class', 'show');
    		$("#no_reply_form").attr('class', 'hide');
    		$("#rejected_form").attr('class', 'hide');
    		$("#waiting_form").attr('class', 'hide');
    		$("#closed_form").attr('class', 'hide');

    	}
    	else if(result=="no_reply")
    	{
    		$("#yes_form").attr('class', 'hide');
    		$("#no_reply_form").attr('class', 'show');
    		$("#rejected_form").attr('class', 'hide');
    		$("#waiting_form").attr('class', 'hide');
    		$("#closed_form").attr('class', 'hide');
    	}
    	else if(result=="rejected")
    	{
    		$("#yes_form").attr('class', 'hide');
    		$("#no_reply_form").attr('class', 'hide');
    		$("#rejected_form").attr('class', 'show');
    		$("#waiting_form").attr('class', 'hide');
    		$("#closed_form").attr('class', 'hide');
    	}
    	else if(result=="waiting")
    	{
    		$("#yes_form").attr('class', 'hide');
    		$("#no_reply_form").attr('class', 'hide');
    		$("#rejected_form").attr('class', 'hide');
    		$("#waiting_form").attr('class', 'show');
    		$("#closed_form").attr('class', 'hide');
    	}
    	else if(result=="closed")
    	{
    		$("#yes_form").attr('class', 'hide');
    		$("#no_reply_form").attr('class', 'hide');
    		$("#rejected_form").attr('class', 'hide');
    		$("#waiting_form").attr('class', 'hide');
    		$("#closed_form").attr('class', 'show');
    	}
    	else
    	{
    		$("#yes_form").attr('class', 'hide');
    		$("#no_reply_form").attr('class', 'hide');
    		$("#rejected_form").attr('class', 'hide');
    		$("#waiting_form").attr('class', 'hide');
    		$("#closed_form").attr('class', 'hide');
    	}
    });
    $('input[type=radio][name=is_tel_correct]').change(function() {
        if (this.value == '1') {
            $("#new_tel_form").attr('class','hide');
        }
        else if (this.value == '0') {
            $("#new_tel_form").attr('class','show');
        }
    });


  });
$(window).bind('beforeunload', function(e) {
    // Your code and validation
    if (confirm) {
        return "Are you sure?";
    }
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
		<h1>{{$record->name_th}} <?php if($record->name_en!=""){ echo "/ ".$record->name_en;}	?> / โทรครั้งที่ {{$call_amount}}</h1>
		<h3>ข้อมูลเบื้องต้นของ {{$record->name_th}}</h3>
		{{Form::open(array('action' => 'CallController@preview_filled_record','id'=>'submit_form'))}}
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-2">
				<label>No.</label>
				<input type="hidden" id="id" name="id" value="{{$record->id}}" />
				{{$record->no}}
			</div>
			<div class="col-xs-2">
				<label>Code.</label>
				{{$record->code}}
			</div>
			<div class="col-xs-3">
				<label>Status.</label>
				<?php
				if($record->status=="Available")
				{
					echo "Available";
				}
				elseif ($record->status=="Not_available") 
				{
					echo "Not Available";
				}
				?>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-3">
				<label>Sources.</label>
				<?php
				if($record->sources=="online_search")
				{
					echo "Online Search";
				}
				elseif ($record->sources=="dtac_recommend") 
				{
					echo "DTAC Recommend";
				}
				elseif ($record->sources=="walking") 
				{
					echo "Walking";
				}
				?>
			</div>
			<div class="col-xs-3">
				<label>Categories.</label>
				<?php
				if($record->categories=="dinning_and_beverage")
				{
					echo "Dining & Beverage";
				}
				elseif ($record->categories=="shopping_and_lifestyle") 
				{
					echo "Shopping & Lifestyle";
				}
				elseif ($record->categories=="beauty_and_healthy") 
				{
					echo "Beauty & Healthy";
				}
				elseif ($record->categories=="hotel_and_travel") 
				{
					echo "Hotel & Travel";
				}
				elseif ($record->categories=="online") 
				{
					echo "Online";
				}
				?>
			</div>
			<div class="col-xs-3">
				<label>Dtac Type.</label>
				<?php
				if($record->dtac_type=="ร้านกทม")
				{
					echo "ร้าน กทม";
				}
				elseif ($record->dtac_type=="ร้านตจว") 
				{
					echo "ร้าน ตจว";
				}
				elseif ($record->dtac_type=="ร้านonline") 
				{
					echo "ร้าน online";
				}
				elseif ($record->dtac_type=="ร้านต่ออายุ") 
				{
					echo "ร้านต่ออายุ";
				}
				elseif ($record->dtac_type=="ร้านดีลอย่างเดียว") 
				{
					echo "ร้านดีลอย่างเดียว";
				}
				elseif ($record->dtac_type=="ร้านเฉพาะอาร์ทเวิร์ค") 
				{
					echo "ร้านเฉพาะอาร์ทเวิร์ค";
				}
				?>
			</div>
			<div class="col-xs-3">
				<label>ประเภทร้าน.</label>
				
					<?php
				if($record->shop_type=="ร้านเบ็ดเตล็ด")
				{
					echo "ร้าน เบ็ดเตล็ด";
				}
				elseif ($record->shop_type=="ร้านอาหาร") 
				{
					echo "ร้าน อาหาร";
				}
				elseif ($record->shop_type=="ร้านอาหารนานาชาติ") 
				{
					echo "้าน อาหารนานาชาติ";
				}
				
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Name Thai.</label>
				{{$record->name_th}}
			</div>
			<div class="col-xs-4">
				<label>Name English.</label>
				{{$record->name_en}}
			</div>
			<div class="col-xs-4">
				<label>สาขา.</label>
				{{$record->branch}}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ที่อยู่.</label>
				{{$record->address}}
			</div>
			<div class="col-xs-6">
				<label>จังหวัด.</label>
				{{$record->province}}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ละติจูด.</label>
				{{$record->latitude}}
			</div>
			<div class="col-xs-6">
				<label>ลองติจูด.</label>
				{{$record->longitude}}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Contact Person.</label>
				{{$record->contact_person}}
			</div>
			<div class="col-xs-4">
				<label>Contact Telephone number.</label>
				{{$record->contact_tel}}
			</div>
			<div class="col-xs-4">
				<label>Contact Email.</label>
				{{$record->contact_email}}
			</div>
			<div class="col-xs-4">
				<label>Contact Date [ วัน / เดือน / ปี ]</label>
				<?php
					$contact_date = explode("-",$record->contact_date);
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
					if($record->links!=NULL)
					{
						print_r($record->links);
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
					if($record->remarks!=NULL)
					{
						echo $record->remarks;
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
				<label>เบอร์โทรศัพท์ </label>
				<label>ถูกต้อง</label> <input type="radio" name="is_tel_correct" id="is_tel_correct" value="1" checked="1" />
				<label>ไม่ถูกต้อง</label> <input type="radio" name="is_tel_correct" id="is_tel_correct" value="0" />
				<div class="row hide" id="new_tel_form">
					<div class="col-xs-12  add-margin-20">
						<label>หมายเลขที่ถูกต้องคือ</label>
						<input type="text" name="new_tel" id="new_tel" value=""/>
					</div>
				</div>
			</div>
			<div class="row"
		</div>
		<div class="row">
			<div class="col-xs-12"><label>ผลการโทร : </label>
				<select name="call_result" id="call_result">
					<option value="empty">กรุณาเลือกผลการโทร</option>
					<option value="yes">Yes</option>
					<option value="no_reply">No Reply</option>
					<option value="rejected">Rejected</option>
					<option value="waiting">Waiting</option>
					<option value="closed">Closed</option>
				</select>
			</div>
		</div>
		<div class="row hide" id="yes_form">
			<div class="col-xs-12">
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>Feedback: </label>
							<input type="text" name="feedback" value="" class="form-control"/>
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>Start Privilege Date [ วัน / เดือน / ปี ]</label>
						<div class="row">
							<div class="col-xs-4">
								<div class="input-group">
									<span class="input-group-addon">วัน</span>
									<input class="form-control" type="text" id="start_priviledge_day" name="start_priviledge_day" value=""/>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
									<span class="input-group-addon">เดือน</span>
									<input class="form-control" type="text" id="start_priviledge_month" name="start_priviledge_month" value=""/>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
									<span class="input-group-addon">ปี</span>
									<input class="form-control" type="text" id="start_priviledge_year" name="start_priviledge_year" value=""
									/>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>End Privilege Date [ วัน / เดือน / ปี ]</label>
							<div class="row">
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">วัน</span>
										<input class="form-control" type="text" id="start_priviledge_day" name="start_priviledge_day" value=""/>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">เดือน</span>
										<input class="form-control" type="text" id="start_priviledge_month" name="start_priviledge_month" value=""/>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">ปี</span>
										<input class="form-control" type="text" id="start_priviledge_year" name="start_priviledge_year" value=""
										/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
		<div class="row hide" id="no_reply_form">
			<div class="col-xs-12">
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>จำนวนครั้งที่โทรก่อนหน้า</label>
						<input type="text" name="cannot_contact_amount_call" value="" class="form-control" />
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>เหตุผล</label>
						<input type="text" name="cannot_contact_reason" value="" class="form-control" />
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>นัดโทรครั้งถัดไป [ วัน / เดือน / ปี ]</label>
							<div class="row">
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">วัน</span>
										<input class="form-control" type="text" id="cannot_contact_appointment_day" name="cannot_contact_appointment_day" value=""/>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">เดือน</span>
										<input class="form-control" type="text" id="cannot_contact_appointment_month" name="cannot_contact_appointment_month" value=""/>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">ปี</span>
										<input class="form-control" type="text" id="cannot_contact_appointment_year" name="cannot_contact_appointment_year" value=""
										/>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row hide" id="rejected_form">
			<div class="col-xs-12">
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>No Reason</label>
						<input type="text" name="no_reason" value="" class="form-control" />
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>No Note</label>
						<input type="text" name="no_note" value="" class="form-control" />
					</div>
				</div>
			</div>
		</div>
		<div class="row hide" id="waiting_form">
			<div class="col-xs-12">
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>เหตุผลที่ขอพิจารณาดูก่อน</label>
						<input type="text" name="consider_reason" value="" class="form-control" />
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>วันที่นัดรับ Feedback [ วัน / เดือน / ปี ]</label>
							<div class="row">
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">วัน</span>
										<input class="form-control" type="text" id="consider_appointment_feedback_day" name="consider_appointment_feedback_day" value=""/>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">เดือน</span>
										<input class="form-control" type="text" id="consider_appointment_feedback_month" name="consider_appointment_feedback_month" value=""/>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">ปี</span>
										<input class="form-control" type="text" id="consider_appointment_feedback_year" name="cannot_contact_year" value=""
										/>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row hide" id="closed_form">
			<div class="col-xs-12">
				<label>ร้านปิดไปแล้ว </label>
				<input type="checkbox" name="closed" value="" />
			</div>
		</div>
		<br />
		<a class="btn btn-success" href="#" role="button" id="confirm_btn">Submit</a>
		<a class="btn btn-danger" href="{{ url('admin/record/list_records') }}" role="button" id="cancel_btn">Cancel</a>
		{{Form::close() }}
		</div>
	</div>
</div>

@endsection