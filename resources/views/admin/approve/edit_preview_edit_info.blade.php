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

    $(function(){
       $( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
    });

    $("#confirm_btn").click(function(){
    	var error = 0;
		if($("#categories").val()=="empty")
		   {
		    alert('กรุษรกรอกขข้อมูลให้ครบถ้วน categories');
		    error = error+1;
	
		   }
		if($("#shop_type").val()=="empty")
		   {
		    alert('กรุษรกรอกขข้อมูลให้ครบถ้วน shop_type');
		    error = error+1;
	
		   }
		if($("#name_th").val()=="")
		   {
		    alert('กรุษรกรอกขข้อมูลให้ครบถ้วน ชื่อภาษาไทย');
		    error = error+1;
	
		   }
		if($("#name_en").val()=="")
		   {
		    alert('กรุษรกรอกขข้อมูลให้ครบถ้วน ชื่อภาษาอังกฤษ');
		    error = error+1;
	
		   }
		if($("#branch").val()=="")
		   {
			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน สาขา');
			error = error+1;
	
		   }
		if($("#branch_amount").val()=="")
		   {
			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน จำนวนสาขา');
			error = error+1;
	
		   }
		 if($("#address").val()=="")
		   {
			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน ที่อยู่');
			error = error+1;
	
		   }
		 if($("#province").val()=="empty")
		   {
			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน จังหวัด');
			error = error+1;
	
		   }
		 if($("#latitude").val()=="")
		   {
			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน ละติจูด');
			error = error+1;
	
		   }
		   if($("#longtitude").val()=="")
		   {
			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน ลองติจูด');
			error = error+1;
	
		   }
		   if($("#contact_person").val()=="")
		   {
			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน ชื่อผู้ติดต่อ');
			error = error+1;
	
		   }
		   if($("#contact_tel").val()=="")
		   {
			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน เบอร์โทรติดต่อ');
			error = error+1;
	
		   }
		   if($("#sending_address").val()=="")
		   {
			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน ที่อยู่ให้จัดส่ง');
			error = error+1;
	
		   }
		   if($("#contact_email").val()=="")
		   {
			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน E-mail');

		   }
		if(error==0)
		{
			if(confirm("กรุณายืนยัน"))
			{
				$("#submit_form").submit();
			}
		}

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
?>
<!-- Services Section -->
<div class="container-fluid add-margin-20">
	<div class="row">
		<div class="form-group">
		<h1>{{$select_record_info->record->code}} / {{$select_record['name_th']}} <?php if($select_record['name_en']!=""){ echo "/ ".$select_record['name_en'];}	?></h1>
		<h3>ข้อมูลเบื้องต้นของ {{$select_record['name_th']}} / {{$select_record['name_en']}} / ติดต่อ {{$select_record['contact_person']}} / โทร {{$select_record['contact_tel']}} </h3>
		{{Form::open(array('action' => 'AdminController@preview_edit_submit_select_record','id'=>'submit_form'))}}
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-12">
				<label>ข้อมูลสำหรับ Record</label>
				<input type="hidden" id="record_id" name="record_id" value="{{$select_record_info->record_id}}" />
				<input type="hidden" id="sale_id" name="sale_id" value="{{$select_record_info->sale_id}}" />
				<table class="table table-bordered table-striped">
					<tr>
						<th>Status</th>
						<th>แหล่งที่มา</th>
						<th>dtac type</th>
						<th>Categories<span class="red">*</span></th>
						<th>ประเภทร้าน<span class="red">*</span></th>
                        <th>ประเภทร้านพิเศษ</th>
					</tr>
					<tr>
						<td>
							<?php
								if($select_record_info->record->status=="Available")
								{
									echo "Available";
								}
								elseif ($select_record_info->record->status=="Not_available") 
								{
									echo "Not Available";
								}
							?>
						</td>
						<td>
						<?php 
						if($select_record_info->sources=="online_search")
						{
							echo "ค้นหาจากเว็บไซต์";
						}
						elseif($select_record_info->sources=="dtac_recommend")
						{
							echo "ร้านแนะนำจาก dtac";
						}
						elseif($select_record_info->sources=="walking")
						{
							echo "Walk in";
						}
						?>
						</td>
						<td>
						<?php
							if($select_record_info->dtac_type=="กทม./นนทบุรี/สมุทรปราการ")
							{
								echo "กทม./นนทบุรี/สมุทรปราการ";
							}
							elseif($select_record_info->dtac_type=="ต่างจังหวัด")
							{
								echo "ต่างจังหวัด";
							}
							elseif($select_record_info->dtac_type=="dtacแนะนำ")
							{
								echo "dtac แนะนำ";
							}
							elseif($select_record_info->dtac_type=="online")
							{
								echo "online";
							}
							elseif($select_record_info->dtac_type=="ต่ออายุ")
							{
								echo "ต่ออายุ";
							}
							elseif($select_record_info->dtac_type=="ดีลอย่างเดียว")
							{
								echo "ดีลอย่างเดียว";
							}
							elseif($select_record_info->dtac_type=="เฉพาะอาร์ทเวิร์ค")
							{
								echo "เฉพาะอาร์ทเวิร์ค";
							}
						?>
						</td>
						<td>
							<input type="hidden" name="categories" id="categories" value="{{$select_record['categories']}}" />
							<?php if($select_record['categories']=="dinning_and_beverage"){echo "Dining and Beverage";}?>
							<?php if($select_record['categories']=="shopping_and_lifestyle"){echo "Shopping and Lifestyle";}?>
							<?php if($select_record['categories']=="beauty_and_healthy"){echo "Beauty and Healthy";}?>
							<?php if($select_record['categories']=="hotel_and_travel"){echo "Hotel and Travel";}?>
							<?php if($select_record['categories']=="online"){echo "Online";}?>
						</td>
						<td>
						<input type="hidden" name="shop_type" id="shop_type" value="{{$select_record['shop_type']}}" />
						{{$select_record['shop_type']}}
						</td>
                        <td>
                            {{$select_record_info->special_type}}
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
						<th>ชื่อไทย<span class="red">*</span></th>
						<th>ชื่ออังกฤษ<span class="red">*</span></th>
						<th>สาขา<span class="red">*</span></th>
                        <th>จำนวนสาขา<span class="red">*</span></th>
					</tr>
					<tr>
						<td><input type="text" name="name_th" id="name_th" value="{{$select_record['name_th']}}" class="form-control"/></td>
						<td><input type="text" name="name_en" id="name_en" value="{{$select_record['name_en']}}" class="form-control"/></td>
						<td><input type="hidden" name="branch" id="branch" class="form-control" value="{{$select_record['branch']}}" />{{$select_record['branch']}}</td>
                        <td>
                        <input type="hidden" name="branch_amount" id="branch_amount" value="{{$select_record['branch_amount']}}" class="form-control"/>{{$select_record['branch_amount']}}
                        </td>
					</tr>
				</table>
				<table class="table table-bordered table-striped">
					<tr>
						<th>ที่อยู่<span class="red">*</span></th>
						<th>จังหวัด<span class="red">*</span></th>
						<th>ละติจูด<span class="red">*</span></th>
						<th>ลองติจูด<span class="red">*</span></th>
					</tr>
					<tr>
						<td>
							<textarea name="address" id="address" cols="50" rows="5" class="form-control" >{{$select_record['address']}}</textarea>
						</td>
						<td>
							<input type="hidden" name="province" id="province" value="{{$select_record['province']}}" />{{$select_record['province']}}
						</td>
						<td><input type="hidden" name="latitude" id="latitude"  class="form-control" value="{{$select_record['latitude']}}" />{{$select_record['latitude']}}</td>
						<td><input type="hidden" name="longtitude" id="longtitude"  class="form-control" value="{{$select_record['longtitude']}}" />{{$select_record['longtitude']}}</td>
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
						<th>ชื่อผู้ติดต่อ<span class="red">*</span></th>
						<th>เบอร์โทรติดต่อ<span class="red">*</span></th>
						<th>อีเมลที่ติดต่อ</th>
                        <th>ที่อยู่ให้จัดส่ง<span class="red">*</span></th>
					</tr>
					<tr>
						<td>
							<input type="hidden" name="contact_person" id="contact_person" value="{{$select_record['contact_person']}}" size="10" class="form-control" />{{$select_record['contact_person']}}
						</td>
						<td><input type="hidden" name="contact_tel" id="contact_tel" value="{{$select_record['contact_tel']}}" class="form-control" />{{$select_record['contact_tel']}}</td>
						<td><input type="hidden" name="contact_email" id="contact_email" value="{{$select_record['contact_email']}}" class="form-control" />{{$select_record['contact_email']}}</td>
						<td>
                            <textarea name="sending_address" id="sending_address" class="form-control">{{$select_record['sending_address']}}</textarea>
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
							<input type="hidden" name="links" id="links" value="{{$select_record['links']}}" class="form-control" />{{$select_record['links']}}
						</td>
						<td>
							<input type="hidden" name="remarks" id="remarks" value="{{$select_record['remarks']}}" class="form-control" />{{$select_record['remarks']}}
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
                                <input type="hidden" id="note" name="note" class="form-control" value="{{$select_record['note']}}" />{{$select_record['note']}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
		</div>
		<hr>
	<div class="row" id="yes_form">
			<div class="col-xs-12">
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>Feedback: </label>
							<input type="text" name="feedback" id="feedback" value="{{$select_record['feedback']}}" class="form-control yes_form"/>
					</div>
				</div>
				<div class="row add-margin-20">
					<div class="col-xs-12">
						<label>เงื่อนไขเพิ่มเติม: </label>
							<input type="text" name="condition" id="condition" value="{{$select_record['condition']}}" class="form-control yes_form"/>
					</div>
				</div>
				<div class="row add-margin-20">
				<div class="col-xs-12">
						<label>Start Privilege Date [ วัน / เดือน / ปี ]</label>
						<div class="row">
							<div class="col-xs-4">
								<div class="input-group">
									<input class="form-control yes_form datepicker" type="text" id="start_priviledge_date" name="start_priviledge_date" value="{{$select_record['start_priviledge_date']}}"/>
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
										<input class="form-control yes_form datepicker" type="text" id="end_priviledge_date" name="end_priviledge_date" value="{{$select_record['end_priviledge_date']}}"/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
	<div class="row">
		<div class="col-xs-12">
			<a href="#" class="btn btn-primary" id="confirm_btn" onClick="">แก้ไข</a> <a href="{{url('/admin/approve_record_from_sale/edit_submit_select_record_cancel')}}" class="btn btn-danger">ยกเลิก</a>
		</div>
	</div>
{{Form::close()}}
</div>
</div>

@endsection