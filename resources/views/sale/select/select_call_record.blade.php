@extends('sale.layouts.master')

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

    $(function(){
       $( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
    });

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
    					var yes_start_priviledge_date = $("#start_priviledge_date").val();
    					var yes_end_priviledge_date = $("#end_priviledge_date").val();

    					if(yes_feedback==""||yes_start_priviledge_date==""||yes_end_priviledge_date=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();
    					}
    					$("#submit_form").submit();	

    				}
    				else if(result=="no_reply")
    				{
    					var cannot_contact_reason = $("#cannot_contact_reason").val();
    					var cannot_contact_appointment_date = $("#cannot_contact_appointment_date").val();

    					if(cannot_contact_reason==""||cannot_contact_appointment_date=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();
    					}
    					$("#submit_form").submit();	
    				}
    				else if(result=="rejected")
    				{
    					var no_reason = $("#no_reason").val();

    					if(no_reason=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();                                                                                                                                                                            
    					}
    					$("#submit_form").submit();	
    				}
    				else if(result=="waiting")
    				{
    					var consider_reason = $("#consider_reason").val();
    					var consider_appointment_feedback_date = $("#consider_appointment_feedback_date").val();

    					if(consider_reason==""||consider_appointment_feedback_date=="")
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
    				//$("#submit_form").submit();	
    			}
    		}
    		else
    		{
    			if(result=="yes")
    				{
    					var yes_feedback = $("#feedback").val();
                        var yes_start_priviledge_date = $("#start_priviledge_date").val();
                        var yes_end_priviledge_date = $("#end_priviledge_date").val();
                        
    					if(yes_feedback==""||yes_start_priviledge_date==""||yes_end_priviledge_date=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();
    					}
    					$("#submit_form").submit();	

    				}
    				else if(result=="no_reply")
    				{
    					var cannot_contact_reason = $("#cannot_contact_reason").val();
    					var cannot_contact_appointment_date = $("#cannot_contact_appointment_date").val();

    					if(cannot_contact_reason==""||cannot_contact_appointment_date=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();
    					}
    					$("#submit_form").submit();	
    				}
    				else if(result=="rejected")
    				{
    					var no_reason = $("#no_reason").val();

    					if(no_reason=="")
    					{
    						alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    						exit();                                                                                                                                                                            
    					}
    					$("#submit_form").submit();	
    				}
    				else if(result=="waiting")
    				{
    					var consider_reason = $("#consider_reason").val();
    					var consider_appointment_feedback_date = $("#consider_appointment_feedback_date").val();

    					if(consider_reason==""||consider_appointment_feedback_date=="")
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
    		$('.yes_form_check').prop('checked', false);
    		$("#has_product_img").prop('checked',false);
    		$("#has_logo_img").prop('checked',false);
    		$("#has_product_img").attr('class', 'hide');
			$("#has_logo_img").attr('class', 'hide');
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
	   		$('.yes_form_check').prop('checked', false);
	   		$("#has_product_img").prop('checked',false);
    		$("#has_logo_img").prop('checked',false);
    		$("#has_product_img").attr('class', 'hide');
			$("#has_logo_img").attr('class', 'hide');
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
    		$('.yes_form_check').prop('checked', false);
    		$("#has_product_img").prop('checked',false);
    		$("#has_logo_img").prop('checked',false);
    		$("#has_product_img").attr('class', 'hide');
			$("#has_logo_img").attr('class', 'hide');
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
    		$('.yes_form_check').prop('checked', false);
    		$("#has_product_img").prop('checked',false);
    		$("#has_logo_img").prop('checked',false);
    		$("#has_product_img").attr('class', 'hide');
			$("#has_logo_img").attr('class', 'hide');
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


$("#btn_edit_address").click(function(){
	$("#edit_address").toggle(function() {
		var text = $("#btn_edit_address").text();
		if(text=="แก้ไข")
		{
			$("#btn_edit_address").text('ซ่อน');
		}
		else if(text=="ซ่อน")
		{
			$("#btn_edit_address").text('แก้ไข');	
		}
    	$("#edit_address").val('');
  });
});

$("#btn_edit_contact_person").click(function(){
	$("#edit_contact_person").toggle(function() {
		var text = $("#btn_edit_contact_person").text();
		if(text=="แก้ไข")
		{
			$("#btn_edit_contact_person").text('ซ่อน');
		}
		else if(text=="ซ่อน")
		{
			$("#btn_edit_contact_person").text('แก้ไข');	
		}
    	$("#edit_contact_person").val('');
  });
});

  	$('#has_confirm_product_img').click(function(){
  		var check = $('#has_confirm_product_img').is(':checked');
  		if(check==true)
  		{
  			$("#has_product_img").attr('class', 'show');
  		}
  		else if(check==false)
  		{
  			$("#has_product_img").prop('checked',false);
  			$("#has_product_img").attr('class', 'hide');
  		}
	});

	$('#has_confirm_logo_img').click(function(){
  		var check = $('#has_confirm_logo_img').is(':checked');
  		if(check==true)
  		{
  			$("#has_logo_img").attr('class', 'show');
  		}
  		else if(check==false)
  		{
  			$("#has_logo_img").prop('checked',false);
  			$("#has_logo_img").attr('class', 'hide');
  		}
	});

  });
</script>
@stop
<?php
use App\Record;
$record = new Record;
?>
<!-- Services Section -->
<div class="container-fluid add-margin-20">
	<div class="row">
		<div class="form-group">
		<h1>{{$select_record->record->code}} / {{$select_record->name_th}} <?php if($select_record->name_en!=""){ echo "/ ".$select_record->name_en;}	?> / โทรครั้งที่ {{$select_record->call_amount}}</h1>
		<h3>ข้อมูลเบื้องต้นของ {{$select_record->name_th}} / {{$select_record->name_en}} / ติดต่อ {{$select_record->contact_person}} / โทร {{$select_record->contact_tel}} <a href="{{url('/sale/edit_record/record/show/'.$select_record->record_id)}}" class="btn btn-danger">แก้ไขข้อมูล</a></h3>
		{{Form::open(array('action' => 'CallController@preview_filled_record','id'=>'submit_form'))}}
			{{csrf_field()}}
        @if($select_record->record->yes_feedback!=NULL||$select_record->record->yes_feedback!="")
        <div class="row">
            <div class="col-xs-12">
            <label>ข้อมูล Privilege ก่อนหน้า</label>
            <table class="table table-bordered table-striped">
            <tr>
                <th>Privilege</th>
                <th>เงิ้อรไขเพิ่มเติม</th>
                <th>Privilege-start</th>
                <th>Privilege-end</th>
            </tr>
            <tr>
                <td>{{$select_record->record->yes_feedback}}</td>
                <td>{{$select_record->record->yes_condition}}</td>
                <td><?php echo $record->convert_date_format_dash($select_record->record->yes_privilege_start); ?></td>
                <td><?php echo $record->convert_date_format_dash($select_record->record->yes_privilege_end); ?></td>
            </tr>
            </table>
            </div>
        </div>
        @endif
		<div class="row">
			<div class="col-xs-12">
				<label>ข้อมูลสำหรับ Record</label>
				<input type="hidden" id="record_id" name="record_id" value="{{$select_record->record_id}}" />
				<input type="hidden" id="call_amount" name="call_amount" value="{{$select_record->record->call_amount}}" />
				<table class="table table-bordered table-striped">
					<tr>
						<th>Status</th>
						<th>แหล่งที่มา</th>
						<th>dtac type</th>
						<th>Categories</th>
						<th>ประเภทร้าน</th>
                        <th>ประเภทร้านพิเศษ</th>
					</tr>
					<tr>
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
								if($select_record->sources=="online_search")
								{
									echo "ค้นหาจากเว็บไซต์";
								}
								elseif ($select_record->sources=="dtac_recommend") 
								{
									echo "ร้านแนะนำจาก dtac";
								}
								elseif ($select_record->sources=="walking") 
								{
									echo "Walk in";
								}
								?>
						</td>
						<td>
							<?php
								if($select_record->dtac_type=="กทม./นนทบุรี/สมุทรปราการ")
								{
									echo "กทม./นนทบุรี/สมุทรปราการ";
								}
								elseif($select_record->dtac_type=="ต่างจังหวัด")
								{
									echo "ต่างจังหวัด";
								}
								elseif($select_record->dtac_type=="dtacแนะนำ")
								{
									echo "dtac แนะนำ";
								}
								elseif($select_record->dtac_type=="online")
								{
									echo "online";
								}
								elseif($select_record->dtac_type=="ต่ออายุ")
								{
									echo "ต่ออายุ";
								}
								elseif($select_record->dtac_type=="ดีลอย่างเดียว")
								{
									echo "ดีลอย่างเดียว";
								}
								elseif($select_record->dtac_type=="เฉพาะอาร์ทเวิร์ค")
								{
									echo "เฉพาะอาร์ทเวิร์ค";
								}

								?>
						</td>
						<td>
							<?php
								if($select_record->categories=="dinning_and_beverage")
								{
									echo "Dining and Beverage";
								}
								elseif ($select_record->categories=="shopping_and_lifestyle") 
								{
									echo "Shopping and Lifestyle";
								}
								elseif ($select_record->categories=="beauty_and_healthy") 
								{
									echo "Beauty and Healthy";
								}
								elseif ($select_record->categories=="hotel_and_travel") 
								{
									echo "Hotel and Travel";
								}
								elseif ($select_record->categories=="online") 
								{
									echo "Online";
								}
								?>
						</td>
						<td>
						<?php
						if($select_record->shop_type=="ร้านอาหาร")
						{
							echo "ร้านอาหาร";
						}
						elseif($select_record->shop_type=="ร้านเครื่องดื่ม")
						{
							echo "ร้านเครื่องดื่ม";
						}
						elseif($select_record->shop_type=="ร้านกาแฟ")
						{
							echo "ร้านกาแฟ";
						}
						elseif($select_record->shop_type=="ร้านเบเกอรี่")
						{
							echo "ร้านเบเกอรี่";
						}
						elseif($select_record->shop_type=="ผับ (ร้านอาหารและเครื่องดื่ม)")
						{
							echo "ผับ (ร้านอาหารและเครื่องดื่ม)";
						}
						elseif($select_record->shop_type=="ร้านขนมหวาน")
						{
							echo "ร้านขนมหวาน";
						}
						elseif($select_record->shop_type=="ร้านเครื่องดื่มและเบเกอรี่")
						{
							echo "ร้านเครื่องดื่มและเบเกอรี่";
						}
						elseif($select_record->shop_type=="ร้านอาหารและเบเกอรี่")
						{
							echo "ร้านอาหารและเบเกอรี่";
						}
						elseif($select_record->shop_type=="ร้านไอศครีม")
						{
							echo "ร้านไอศครีม";
						}
						elseif($select_record->shop_type=="ร้านเพื่อสุขภาพ")
						{
							echo "ร้านเพื่อสุขภาพ";
						}
						elseif($select_record->shop_type=="ร้านบุฟเฟ่ต์")
						{
							echo "ร้านบุฟเฟ่ต์";
						}
						elseif($select_record->shop_type=="โต๊ะจีน")
						{
							echo "โต๊ะจีน";
						}
						elseif($select_record->shop_type=="ร้านสปา")
						{
							echo "ร้านสปา";
						}
						elseif($select_record->shop_type=="ร้านนวด")
						{
							echo "ร้านนวด";
						}
						elseif($select_record->shop_type=="ร้านเสริมสวย")
						{
							echo "ร้านเสริมสวย";
						}
						elseif($select_record->shop_type=="ร้านทำเล็บ")
						{
							echo "ร้านทำเล็บ";
						}
						elseif($select_record->shop_type=="ร้านความงาม")
						{
							echo "ร้านความงาม";
						}
						elseif($select_record->shop_type=="ฟิสเนส")
						{
							echo "ฟิสเนส";
						}
						elseif($select_record->shop_type=="ร้านนวดและสปา")
						{
							echo "ร้านนวดและสปา";
						}
						elseif($select_record->shop_type=="โรงแรม")
						{
							echo "โรงแรม";
						}
						elseif($select_record->shop_type=="รีสอร์ท")
						{
							echo "รีสอร์ท";
						}
						elseif($select_record->shop_type=="โฮมสเตย์")
						{
							echo "โฮมสเตย์";
						}
						elseif($select_record->shop_type=="เรือนำเที่ยว")
						{
							echo "เรือนำเที่ยว";
						}
						elseif($select_record->shop_type=="สถานที่ท่องเที่ยว")
						{
							echo "สถานที่ท่องเที่ยว";
						}
						elseif($select_record->shop_type=="อพาร์ทเม้นท์")
						{
							echo "อพาร์ทเม้นท์";
						}
						elseif($select_record->shop_type=="ทัวร์")
						{
							echo "ทัวร์";
						}
						elseif($select_record->shop_type=="ฟาร์ม")
						{
							echo "ฟาร์ม";
						}
						elseif($select_record->shop_type=="ร้านเบ็ดเตล็ด")
						{
							echo "ร้านเบ็ดเตล็ด";
						}
						elseif($select_record->shop_type=="ร้านของฝาก")
						{
							echo "ร้านของฝาก";
						}
						elseif($select_record->shop_type=="โรงเรียน")
						{
							echo "โรงเรียน";
						}
						elseif($select_record->shop_type=="ร้านเสื้อผ้า")
						{
							echo "ร้านเสื้อผ้า";
						}
						elseif($select_record->shop_type=="ร้านเวดดิ้ง")
						{
							echo "ร้านเวดดิ้ง";
						}
						elseif($select_record->shop_type=="ร้านสัตว์เลี้ยง")
						{
							echo "ร้านสัตว์เลี้ยง";
						}
						elseif($select_record->shop_type=="คาร์แคร์")
						{
							echo "คาร์แคร์";
						}
						elseif($select_record->shop_type=="ร้านรองเท้า")
						{
							echo "ร้านรองเท้า";
						}
						elseif($select_record->shop_type=="ร้านกระเป๋า")
						{
							echo "ร้านกระเป๋า";
						}
						elseif($select_record->shop_type=="ร้านเครื่องเขียน")
						{
							echo "ร้านเครื่องเขียน";
						}
						elseif($select_record->shop_type=="ร้านหนังสือ")
						{
							echo "ร้านหนังสือ";
						}
						elseif($select_record->shop_type=="ร้านอิเล็กทรอนิคส์")
						{
							echo "ร้านอิเล็กทรอนิคส์";
						}
						elseif($select_record->shop_type=="ร้านอุปกรณ์ไอที")
						{
							echo "ร้านอุปกรณ์ไอที";
						}
						elseif($select_record->shop_type=="ร้านอุปกรณ์เบเกอรี่")
						{
							echo "ร้านอุปกรณ์เบเกอรี่";
						}
						elseif($select_record->shop_type=="ร้านเครื่องดนตรี")
						{
							echo "ร้านเครื่องดนตรี";
						}
						elseif($select_record->shop_type=="โรงภาพยนต์")
						{
							echo "โรงภาพยนต์";
						}
						elseif($select_record->shop_type=="ร้านเครื่องประดับ")
						{
							echo "ร้านเครื่องประดับ";
						}
						elseif($select_record->shop_type=="ร้านเฟอร์นิเจอร์")
						{
							echo "ร้านเฟอร์นิเจอร์";
						}
						elseif($select_record->shop_type=="ร้านสินค้าเด็ก")
						{
							echo "ร้านสินค้าเด็ก";
						}
						elseif($select_record->shop_type=="ร้านผลิตภัณฑ์ความงาม")
						{
							echo "ร้านผลิตภัณฑ์ความงาม";
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
						<th>ชื่อไทย</th>
						<th>ชื่ออังกฤษ</th>
						<th>สาขา</th>
                        <th>จำนวนสาขา</th>
						<th>ที่อยู่</th>
						<th>จังหวัด</th>
						<th>ละติจูด</th>
						<th>ลองติจูด</th>
					</tr>
					<tr>
						<td>{{$select_record->name_th}}</td>
						<td>{{$select_record->name_en}}</td>
						<td>{{$select_record->branch}}</td>
                        <td>
                        {{$select_record->branch_amount}}
                        </td>
						<td>
							{{$select_record->address}}<br />
							<textarea name="edit_address" id="edit_address" cols="50" rows="5" class="form-control"  style="display: none"></textarea>
						</td>
						<td>{{$select_record->province}}</td>
						<td>{{$select_record->latitude}}</td>
						<td>{{$select_record->longtitude}}</td>
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
						<th>ชื่อผู้ติดต่อ</th>
						<th>เบอร์โทรที่ติดต่อ</th>
						<th>อีเมลที่ติดต่อ</th>
						<th>วันที่ให้ติดต่อ [ วัน / เดือน / ปี ]</th>
                        <th>ที่อยู่ให้จัดส่ง</th>
					</tr>
					<tr>
						<td>
							{{$select_record->contact_person}}<br />
							<input type="text" name="edit_contact_person" id="edit_contact_person" value="" size="30" class="form-control"  style="display: none" />
						</td>
						<td>{{$select_record->contact_tel}}</td>
						<td>{{$select_record->contact_email}}</td>
						<td>
							<?php
								$contact_date = explode("-",$select_record->record->contact_date);
								$contact_day = $contact_date[1];
								$contact_month = $contact_date[2];
								$contact_year = $contact_date[0];
							?>
							{{$contact_day}} / {{$contact_month}} / {{$contact_year}}
						</td>
						<td>
                            {{$select_record->sending_address}}
                        </td>
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
						<th>หมายเหตุ</th>
					</tr>
					<tr>
						<td>
							@if($select_record->links!=NULL)
								{{ Html::link($select_record->links,null,array('target'=>'_blank')) }}
							@else
								-
							@endif
						</td>
						<td>
							<?php
								if($select_record->remarks!=NULL)
								{
									echo $select_record->remarks;
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
		</div>
		<hr>
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
						<label>Privilege: </label>
							<input type="text" name="feedback" id="feedback" value="" class="form-control yes_form"/>
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>เงื่อนไขเพิ่มเติม: </label>
							<input type="text" name="condition" id="condition" value="" class="form-control yes_form"/>
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>Start Privilege Date [ วัน / เดือน / ปี ]</label>
						<div class="row">
							<div class="col-xs-4">
								<div class="input-group">
									<input class="form-control yes_form datepicker" type="text" id="start_priviledge_date" name="start_priviledge_date" value=""/>
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
										<input class="form-control yes_form datepicker" type="text" id="end_priviledge_date" name="end_priviledge_date" value=""/>
									</div>
								</div>
							</div>
						</div>
                    </div>
                <div class="row add-margin-20">
                	<div class="col-xs-3">
                		<label>ตรวจสอบ</label>
                		<table class="table table-bordered table-striped">
                			<tr>
                				<td>เอกสารตอบรับ</td>
                				<td><input type="checkbox" name="has_reply_doc" id="has_reply_doc" class="yes_form_check" value="1"/></td>
                			</tr>
                			<tr>
                				<td>ยืนยันรูปสินค้า</td>
                				<td><input type="checkbox" name="has_confirm_product_img" id="has_confirm_product_img" class="yes_form_check" value="1"/></td>
                			</tr>
                			<tr>
                				<td>ยืนยันรูปLogo</td>
                				<td><input type="checkbox" name="has_confirm_logo_img" id="has_confirm_logo_img" class="yes_form_check" value="1"/></td>
                			</tr>
                		</table>
                	</div>
                	<div class="col-xs-3">
                		<label>ยืนยันตรวจสอบ</label>
                		<table class="table table-bordered table-striped">
                			<tr>
                				<td>รูปหน้าร้าน</td>
                				<td><input type="checkbox" name="has_shop_img" id="has_shop_img" class="yes_form_check" value="1"/></td>
                			</tr>
                			<tr>
                				<td>รูปสินค้า</td>
                				<td><input type="checkbox" name="has_product_img" id="has_product_img" value="1" class="yes_form_check hide"/></td>
                			</tr>
                			<tr>
                				<td>Logo ร้าน</td>
                				<td><input type="checkbox" name="has_logo_img" id="has_logo_img" value="1" class="yes_form_check hide"/></td>
                			</tr>
                		</table>
                	</div>
                </div>
			</div>
		</div>
		<div class="row hide" id="no_reply_form">
			<div class="col-xs-12">
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>เหตุผล</label>
						<input type="text" name="cannot_contact_reason" id="cannot_contact_reason" value="" class="form-control no_reply_form" />
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>นัดโทรครั้งถัดไป [ วัน / เดือน / ปี ]</label>
							<div class="row">
								<div class="col-xs-4">
									<div class="input-group">
										<input class="form-control no_reply_form datepicker" type="text" id="cannot_contact_appointment_date" name="cannot_contact_appointment_date" value=""/>
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
						<label>เหตุผลที่ปฏิเสธ</label>
						<input type="text" name="no_reason" id="no_reason" value="" class="form-control rejected_form" />
					</div>
				</div>
			</div>
		</div>
		<div class="row hide" id="waiting_form">
			<div class="col-xs-12">
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>เหตุผลที่ขอพิจารณาดูก่อน</label>
						<input type="text" name="consider_reason" value="" class="form-control waiting_form" />
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>วันที่นัดรับ Feedback [ วัน / เดือน / ปี ]</label>
							<div class="row">
								<div class="col-xs-4">
									<div class="input-group">
										<input class="form-control waiting_form datepicker" type="text" id="consider_appointment_feedback_date" name="consider_appointment_feedback_date" value=""/>
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
				<input type="checkbox" name="closed" id="closed" value="1" />
			</div>
		</div>
		<br />
		<a class="btn btn-success" href="#" role="button" id="confirm_btn">ต่อไป</a>
		<a class="btn btn-danger" href="{{ url('sale/show_selected_record_list') }}" role="button" id="cancel_btn">ยกเลิก</a>
		{{Form::close() }}
		</div>
	</div>
</div>

@endsection