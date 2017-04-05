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
    	var result = $("#call_result").val();
    	// alert(result);
    	if(result=="empty")
    	{
    		alert("กรุณาเลือกผลการโทร");
    		exit();
    	}
    	else
    	{
    		var is_tel_number = $('input[name=is_tel_correct]:checked').val();
    		if(is_tel_number=="0")
    		{
    			var new_tel = $("#new_tel").val();
    			if(new_tel=="")
    			{
    				alert("กรุณากรอกหมายเลขที่ถูกต้อง");
    			}
    			else
    			{
    				if(result=="yes")
    				{
    					var yes_feedback = $("#feedback").val();
    					var yes_start_priviledge_day = $("#start_priviledge_day").val();
    					var yes_start_priviledge_month = $("#start_priviledge_month").val();
    					var yes_start_priviledge_year = $("#start_priviledge_year").val();
    					var yes_end_priviledge_day = $("#end_priviledge_day").val();
    					var yes_end_priviledge_month = $("#end_priviledge_month").val();
    					var yes_end_priviledge_year = $("#end_priviledge_year").val();

    					if(yes_feedback==""||yes_start_priviledge_day==""||yes_start_priviledge_month==""||yes_start_priviledge_year==""||yes_end_priviledge_day==""||yes_end_priviledge_month==""||yes_end_priviledge_year=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();
    					}
    					$("#submit_form").submit();	

    				}
    				else if(result=="no_reply")
    				{
    					var cannot_contact_amount_call = $("#cannot_contact_amount_call").val();
    					var cannot_contact_reason = $("#cannot_contact_reason").val();
    					var cannot_contact_appointment_day = $("#cannot_contact_appointment_day").val();
    					var cannot_contact_appointment_month = $("#cannot_contact_appointment_month").val();
    					var cannot_contact_appointment_year = $("#cannot_contact_appointment_year").val();

    					if(cannot_contact_amount_call==""||cannot_contact_reason==""||cannot_contact_appointment_day==""||cannot_contact_appointment_month==""||cannot_contact_appointment_year=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();
    					}
    					$("#submit_form").submit();	
    				}
    				else if(result=="rejected")
    				{
    					var no_reason = $("#no_reason").val();
    					var no_note = $("#no_note").val();

    					if(no_reason==""||no_note=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();                                                                                                                                                                            
    					}
    					$("#submit_form").submit();	
    				}
    				else if(result=="waiting")
    				{
    					var consider_reason = $("#consider_reason").val();
    					var consider_appointment_feedback_day = $("#consider_appointment_feedback_day").val();
    					var consider_appointment_feedback_month = $("#consider_appointment_feedback_month").val();
    					var consider_appointment_feedback_year = $("#consider_appointment_feedback_year").val();

    					if(consider_reason==""||consider_appointment_feedback_day==""||consider_appointment_feedback_month==""||consider_appointment_feedback_year=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();
    					}
    					$("#submit_form").submit();	
    				}
    				else if(result=="closed")
    				{
    					var x = document.getElementById("closed").checked;
    					if(x==false)
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();
    					}
    					$("#submit_form").submit();	

    				}
    				//alert("Submit data");
    				// $("#submit_form").submit();	
    			}
    		}
    		else
    		{
    			if(result=="yes")
    				{
    					var yes_feedback = $("#feedback").val();
    					var yes_start_priviledge_day = $("#start_priviledge_day").val();
    					var yes_start_priviledge_month = $("#start_priviledge_month").val();
    					var yes_start_priviledge_year = $("#start_priviledge_year").val();
    					var yes_end_priviledge_day = $("#end_priviledge_day").val();
    					var yes_end_priviledge_month = $("#end_priviledge_month").val();
    					var yes_end_priviledge_year = $("#end_priviledge_year").val();

    					if(yes_feedback==""||yes_start_priviledge_day==""||yes_start_priviledge_month==""||yes_start_priviledge_year==""||yes_end_priviledge_day==""||yes_end_priviledge_month==""||yes_end_priviledge_year=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();
    					}
    					$("#submit_form").submit();	

    				}
    				else if(result=="no_reply")
    				{
    					var cannot_contact_amount_call = $("#cannot_contact_amount_call").val();
    					var cannot_contact_reason = $("#cannot_contact_reason").val();
    					var cannot_contact_appointment_day = $("#cannot_contact_appointment_day").val();
    					var cannot_contact_appointment_month = $("#cannot_contact_appointment_month").val();
    					var cannot_contact_appointment_year = $("#cannot_contact_appointment_year").val();

    					if(cannot_contact_amount_call==""||cannot_contact_reason==""||cannot_contact_appointment_day==""||cannot_contact_appointment_month==""||cannot_contact_appointment_year=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();
    					}
    					$("#submit_form").submit();	
    				}
    				else if(result=="rejected")
    				{
    					var no_reason = $("#no_reason").val();
    					var no_note = $("#no_note").val();

    					if(no_reason==""||no_note=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();                                                                                                                                                                            
    					}
    					$("#submit_form").submit();	
    				}
    				else if(result=="waiting")
    				{
    					var consider_reason = $("#consider_reason").val();
    					var consider_appointment_feedback_day = $("#consider_appointment_feedback_day").val();
    					var consider_appointment_feedback_month = $("#consider_appointment_feedback_month").val();
    					var consider_appointment_feedback_year = $("#consider_appointment_feedback_year").val();

    					if(consider_reason==""||consider_appointment_feedback_day==""||consider_appointment_feedback_month==""||consider_appointment_feedback_year=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();
    					}
    					$("#submit_form").submit();	
    				}
    				else if(result=="closed")
    				{
    					var x = document.getElementById("closed").checked;
    					if(x==false)
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();
    					}
    					$("#submit_form").submit();	

    				}
    		}
    	}
        

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

    		$(".no_reply_form").val('');
    		$(".rejected_form").val('');
    		$(".waiting_form").val('');
    		$('#closed').prop('checked', false);

    	}
    	else if(result=="no_reply")
    	{
    		$("#yes_form").attr('class', 'hide');
    		$("#no_reply_form").attr('class', 'show');
    		$("#rejected_form").attr('class', 'hide');
    		$("#waiting_form").attr('class', 'hide');
    		$("#closed_form").attr('class', 'hide');

    		$(".yes_form").val('');
    		$(".rejected_form").val('');
    		$(".waiting_form").val('');
    		$('#closed').prop('checked', false);
    	}
    	else if(result=="rejected")
    	{
    		$("#yes_form").attr('class', 'hide');
    		$("#no_reply_form").attr('class', 'hide');
    		$("#rejected_form").attr('class', 'show');
    		$("#waiting_form").attr('class', 'hide');
    		$("#closed_form").attr('class', 'hide');

	   		$(".yes_form").val('');
	   		$(".no_reply_form").val('');
    		$(".waiting_form").val('');
    		$('#closed').prop('checked', false);
    	}
    	else if(result=="waiting")
    	{
    		$("#yes_form").attr('class', 'hide');
    		$("#no_reply_form").attr('class', 'hide');
    		$("#rejected_form").attr('class', 'hide');
    		$("#waiting_form").attr('class', 'show');
    		$("#closed_form").attr('class', 'hide');

    		$(".yes_form").val('');
    		$(".no_reply_form").val('');
    		$(".rejected_form").val('');
    		$('#closed').prop('checked', false);
    	}
    	else if(result=="closed")
    	{
    		$("#yes_form").attr('class', 'hide');
    		$("#no_reply_form").attr('class', 'hide');
    		$("#rejected_form").attr('class', 'hide');
    		$("#waiting_form").attr('class', 'hide');
    		$("#closed_form").attr('class', 'show');

    		$(".yes_form").val('');
    		$(".no_reply_form").val('');
    		$(".rejected_form").val('');
    		$(".waiting_form").val('');
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
		{{Form::open(array('action' => 'CallController@submit_edit_call_record','id'=>'submit_form'))}}
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-2">
				<label>No.</label>
				<input type="hidden" id="record_id" name="record_id" value="{{$select_record->record->id}}" />
				<input type="hidden" id="call_amount" name="call_amount" value="{{$select_record->record->call_amount}}" />
				{{$select_record->record->no}}
			</div>
			<div class="col-xs-2">
				<label>Code.</label>
				{{$select_record->record->code}}
			</div>
			<div class="col-xs-2">
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
			<div class="col-xs-2">
				<label>Sources.</label>
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
			</div>
			<div class="col-xs-2">
				<label>Categories.</label>
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
			</div>
			<div class="col-xs-2">
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
			<div class="col-xs-2">
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
			<div class="col-xs-4">
				<label>ประเภทร้านพิเศษ</label>
				{{$select_record->record->special_type}}
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
				<label>เบอร์โทรศัพท์ </label>
				<label>ถูกต้อง</label> <input type="radio" name="is_tel_correct" id="is_tel_correct" value="1" checked="1" <?php if($sale_filled['is_tel_correct']=="1"){echo "checked";} ;?>/>
				<label>ไม่ถูกต้อง</label> <input type="radio" name="is_tel_correct" id="is_tel_not_correct" value="0" <?php if($sale_filled['is_tel_correct']=="0"){echo "checked";} ;?>/>
				<div class="row <?php if($sale_filled['is_tel_correct']=="0"){ echo "show"; }else{ echo "hide"; } ;?>" id="new_tel_form">
					<div class="col-xs-12  add-margin-20">
						<label>หมายเลขที่ถูกต้องคือ</label>
						<input type="text" name="new_tel" id="new_tel" value="<?php if($sale_filled['is_tel_correct']=="0"){ echo $sale_filled['new_tel']; } ?>"/>
					</div>
				</div>
			</div>
			<div class="row">
		</div>
		<div class="row">
			<div class="col-xs-12"><label>ผลการโทร : </label>
				<select name="call_result" id="call_result">
					<option value="empty">กรุณาเลือกผลการโทร</option>
					<option value="yes" <?php if($sale_filled['call_result']=="yes"){ echo "selected"; } ;?> >Yes</option>
					<option value="no_reply" <?php if($sale_filled['call_result']=="no_reply"){ echo "selected"; } ;?> >No Reply</option>
					<option value="rejected" <?php if($sale_filled['call_result']=="rejected"){ echo "selected"; } ;?> >Rejected</option>
					<option value="waiting" <?php if($sale_filled['call_result']=="waiting"){ echo "selected"; } ;?> >Waiting</option>
					<option value="closed" <?php if($sale_filled['call_result']=="closed"){ echo "selected"; } ;?> >Closed</option>
				</select>
			</div>
		</div>
		<div class="row <?php if($sale_filled['call_result']=="yes"){ echo "show"; }else{ echo "hide"; } ;?>" id="yes_form">
			<div class="col-xs-12">
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>Feedback: </label>
							<input type="text" name="feedback" id="feedback" value="<?php if($sale_filled['call_result']=="yes"){ echo $sale_filled['feedback']; } ?>" class="form-control yes_form"/>
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>Start Privilege Date [ วัน / เดือน / ปี ]</label>
						<div class="row">
							<div class="col-xs-4">
								<div class="input-group">
									<span class="input-group-addon">วัน</span>
									<input class="form-control yes_form" type="text" id="start_priviledge_day" name="start_priviledge_day" value="<?php if($sale_filled['call_result']=="yes"){ echo $sale_filled['start_priviledge_day']; } ?>"/>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
									<span class="input-group-addon">เดือน</span>
									<input class="form-control yes_form" type="text" id="start_priviledge_month" name="start_priviledge_month" value="<?php if($sale_filled['call_result']=="yes"){ echo $sale_filled['start_priviledge_month']; } ?>"/>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
									<span class="input-group-addon">ปี</span>
									<input class="form-control yes_form" type="text" id="start_priviledge_year" name="start_priviledge_year" value="<?php if($sale_filled['call_result']=="yes"){ echo $sale_filled['start_priviledge_year']; } ?>"/>
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
										<input class="form-control yes_form" type="text" id="end_priviledge_day" name="end_priviledge_day" value="<?php if($sale_filled['call_result']=="yes"){ echo $sale_filled['end_priviledge_day']; } ?>"/>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">เดือน</span>
										<input class="form-control yes_form" type="text" id="end_priviledge_month" name="end_priviledge_month" value="<?php if($sale_filled['call_result']=="yes"){ echo $sale_filled['end_priviledge_month']; } ?>"/>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">ปี</span>
										<input class="form-control yes_form" type="text" id="end_priviledge_year" name="end_priviledge_year" value="<?php if($sale_filled['call_result']=="yes"){ echo $sale_filled['end_priviledge_year']; } ?>"/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
		<div class="row  <?php if($sale_filled['call_result']=="no_reply"){ echo "show"; }else{ echo "hide"; } ;?>" id="no_reply_form">
			<div class="col-xs-12">
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>จำนวนครั้งที่โทรก่อนหน้า : </label>
						<?php if($sale_filled['call_result']=="no_reply"){ echo $sale_filled['cannot_contact_amount_call']; } ?>
						<input type="hidden" name="cannot_contact_amount_call" id="cannot_contact_amount_call" value="<?php if($sale_filled['call_result']=="no_reply"){ echo $sale_filled['cannot_contact_amount_call']; } ?>" class="form-control no_reply_form" />
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>เหตุผล</label>
						<input type="text" name="cannot_contact_reason" id="cannot_contact_reason" value="<?php if($sale_filled['call_result']=="no_reply"){ echo $sale_filled['cannot_contact_reason']; } ?>" class="form-control no_reply_form" />
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>นัดโทรครั้งถัดไป [ วัน / เดือน / ปี ]</label>
							<div class="row">
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">วัน</span>
										<input class="form-control no_reply_form" type="text" id="cannot_contact_appointment_day" name="cannot_contact_appointment_day" value="<?php if($sale_filled['call_result']=="no_reply"){ echo $sale_filled['cannot_contact_appointment_day']; } ?>"/>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">เดือน</span>
										<input class="form-control no_reply_form" type="text" id="cannot_contact_appointment_month" name="cannot_contact_appointment_month" value="<?php if($sale_filled['call_result']=="no_reply"){ echo $sale_filled['cannot_contact_appointment_month']; } ?>"/>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">ปี</span>
										<input class="form-control no_reply_form" type="text" id="cannot_contact_appointment_year" name="cannot_contact_appointment_year" value="<?php if($sale_filled['call_result']=="no_reply"){ echo $sale_filled['cannot_contact_appointment_year']; } ?>"/>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row  <?php if($sale_filled['call_result']=="rejected"){ echo "show"; }else{ echo "hide"; } ;?>" id="rejected_form">
			<div class="col-xs-12">
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>No Reason</label>
						<input type="text" name="no_reason" id="no_reason" value="<?php if($sale_filled['call_result']=="rejected"){ echo $sale_filled['no_reason']; } ?>" class="form-control rejected_form" />
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>No Note</label>
						<input type="text" name="no_note" id="no_note" value="<?php if($sale_filled['call_result']=="rejected"){ echo $sale_filled['no_note']; } ?>" class="form-control rejected_form" />
					</div>
				</div>
			</div>
		</div>
		<div class="row  <?php if($sale_filled['call_result']=="waiting"){ echo "show"; }else{ echo "hide"; } ;?>" id="waiting_form">
			<div class="col-xs-12">
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>เหตุผลที่ขอพิจารณาดูก่อน</label>
						<input type="text" name="consider_reason" value="<?php if($sale_filled['call_result']=="waiting"){ echo $sale_filled['consider_reason']; } ?>" class="form-control waiting_form" />
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>วันที่นัดรับ Feedback [ วัน / เดือน / ปี ]</label>
							<div class="row">
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">วัน</span>
										<input class="form-control waiting_form" type="text" id="consider_appointment_feedback_day" name="consider_appointment_feedback_day" value="<?php if($sale_filled['call_result']=="waiting"){ echo $sale_filled['consider_appointment_feedback_day']; } ?>"/>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">เดือน</span>
										<input class="form-control waiting_form" type="text" id="consider_appointment_feedback_month" name="consider_appointment_feedback_month" value="<?php if($sale_filled['call_result']=="waiting"){ echo $sale_filled['consider_appointment_feedback_month']; } ?>"/>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="input-group">
										<span class="input-group-addon">ปี</span>
										<input class="form-control waiting_form" type="text" id="consider_appointment_feedback_year" name="consider_appointment_feedback_year" value="<?php if($sale_filled['call_result']=="waiting"){ echo $sale_filled['consider_appointment_feedback_year']; } ?>"/>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row  <?php if($sale_filled['call_result']=="closed"){ echo "show"; }else{ echo "hide"; } ;?>" id="closed_form">
			<div class="col-xs-12">
				<label>ร้านปิดไปแล้ว </label>
				<input type="checkbox" name="closed" id="closed" value="1" <?php if($sale_filled['call_result']=="closed"){ echo "checked"; }else{ echo ""; } ;?>/>
			</div>
		</div>
		<br />
		<a class="btn btn-success" href="#" role="button" id="confirm_btn">ยืนยันแก้ไข</a>
		<a class="btn btn-danger" href="{{ url('sale/select_record/show_preview_filled_record') }}" role="button" id="cancel_btn">ยกเลิกแก้ไข</a>
		{{Form::close() }}
		</div>
	</div>
</div>

@endsection