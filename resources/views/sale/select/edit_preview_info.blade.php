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
		<h1>{{$select_record->name_th}} <?php if($select_record->name_en!=""){ echo "/ ".$select_record->name_en;}	?> / โทรครั้งที่ {{$select_record->call_amount}}</h1>
		<h3>ข้อมูลเบื้องต้นของ {{$select_record->name_th}} / {{$select_record->name_en}} / ติดต่อ {{$select_record->record->contact_person}} / โทร {{$select_record->record->contact_tel}} </h3>
		{{Form::open(array('action' => 'CallController@preview_edit_record_info','id'=>'submit_form'))}}
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-12">
				<label>ข้อมูลสำหรับ Record</label>
				<input type="hidden" id="record_id" name="record_id" value="{{$select_record->record_id}}" />
				<input type="hidden" id="call_amount" name="call_amount" value="{{$select_record->record->call_amount}}" />
				<table class="table table-bordered table-striped">
					<tr>
						<th>No.</th>
						<th>Code.</th>
						<th>Status</th>
						<th>แหล่งที่มา</th>
						<th>dtac type</th>
						<th>Categories<span class="red">*</span></th>
						<th>ประเภทร้าน<span class="red">*</span></th>
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
						if($select_record->sources=="online_search")
						{
							echo "Online Search";
						}
						elseif($select_record->sources=="dtac_recommend")
						{
							echo "dtac Recommend";
						}
						elseif($select_record->sources=="walking")
						{
							echo "Walking";
						}
						?>
						</td>
						<td>
						<?php
							if($select_record->dtac_type=="ร้านกทม./นนทบุรี/สมุทรปราการ")
							{
								echo "ร้าน กทม./นนทบุรี/สมุทรปราการ";
							}
							elseif($select_record->dtac_type=="ร้านต่างจังหวัด")
							{
								echo "ร้าน ต่างจังหวัด";
							}
							elseif($select_record->dtac_type=="ร้านdtacแนะนำ")
							{
								echo "ร้าน dtac แนะนำ";
							}
							elseif($select_record->dtac_type=="ร้านonline")
							{
								echo "ร้าน online";
							}
							elseif($select_record->dtac_type=="ร้านต่ออายุ")
							{
								echo "ร้านต่ออายุ";
							}
							elseif($select_record->dtac_type=="ร้านดีลอย่างเดียว")
							{
								echo "ร้านดีลอย่างเดียว";
							}
							elseif($select_record->dtac_type=="ร้านเฉพาะอาร์ทเวิร์ค")
							{
								echo "ร้านเฉพาะอาร์ทเวิร์ค";
							}
						?>
						</td>
						<td>
							<select name="categories"  class="selectpicker categories" id="categories">
							<option value="dinning_and_beverage" <?php if($edit_record['categories']=="dinning_and_beverage"){echo "selected";}?>>Dining & Beverage</option>
							<option value="shopping_and_lifestyle" <?php if($edit_record['categories']=="shopping_and_lifestyle"){echo "selected";}?>>Shopping & Lifestyle</option>
							<option value="beauty_and_healthy" <?php if($edit_record['categories']=="beauty_and_healthy"){echo "selected";}?>>Beauty & Healthy</option>
							<option value="hotel_and_travel" <?php if($edit_record['categories']=="hotel_and_travel"){echo "selected";}?>>Hotel & Travel</option>
							<option value="online" <?php if($edit_record['categories']=="online"){echo "selected";}?>>Online</option>
						</select>
						</td>
						<td>
						<select name="shop_type"  class="selectpicker shop_type" id="shop_type">
							<optgroup label="Dining">
							<option value="ร้านอาหาร" <?php if($edit_record['shop_type']=="ร้านอาหาร"){echo "selected";}?>>ร้านอาหาร</option>
							<option value="ร้านเครื่องดื่ม" <?php if($edit_record['shop_type']=="ร้านเครื่องดื่ม"){echo "selected";}?>>ร้านเครื่องดื่ม</option>
							<option value="ร้านกาแฟ" <?php if($edit_record['shop_type']=="ร้านกาแฟ"){echo "selected";}?>>ร้านกาแฟ</option>
							<option value="ร้านเบเกอรี่" <?php if($edit_record['shop_type']=="ร้านเบเกอรี่"){echo "selected";}?>>ร้านเบเกอรี่</option>
							<option value="ผับ (ร้านอาหารและเครื่องดื่ม)" <?php if($edit_record['shop_type']=="ผับ (ร้านอาหารและเครื่องดื่ม)"){echo "selected";}?>>ผับ (ร้านอาหารและเครื่องดื่ม)</option>
							<option value="ร้านขนมหวาน" <?php if($edit_record['shop_type']=="ร้านขนมหวาน"){echo "selected";}?>>ร้านขนมหวาน</option>
							<option value="ร้านเครื่องดื่มและเบเกอรี่" <?php if($edit_record['shop_type']=="ร้านเครื่องดื่มและเบเกอรี่"){echo "selected";}?>>ร้านเครื่องดื่มและเบเกอรี่</option>
							<option value="ร้านอาหารและเบเกอรี่" <?php if($edit_record['shop_type']=="ร้านอาหารและเบเกอรี่"){echo "selected";}?>>ร้านอาหารและเบเกอรี่</option>
							<option value="ร้านไอศครีม" <?php if($edit_record['shop_type']=="ร้านไอศครีม"){echo "selected";}?>>ร้านไอศครีม</option>
							<option value="ร้านเพื่อสุขภาพ" <?php if($edit_record['shop_type']=="ร้านเพื่อสุขภาพ"){echo "selected";}?>>ร้านเพื่อสุขภาพ</option>
							<option value="ร้านบุฟเฟ่ต์" <?php if($edit_record['shop_type']=="ร้านบุฟเฟ่ต์"){echo "selected";}?>>ร้านบุฟเฟ่ต์</option>
							<option value="โต๊ะจีน" <?php if($edit_record['shop_type']=="โต๊ะจีน"){echo "selected";}?>>โต๊ะจีน</option>
							<optgroup label="Beauty & Healty">
							<option value="ร้านสปา" <?php if($edit_record['shop_type']=="ร้านสปา"){echo "selected";}?>>ร้านสปา</option>
							<option value="ร้านนวด" <?php if($edit_record['shop_type']=="ร้านนวด"){echo "selected";}?>>ร้านนวด</option>
							<option value="ร้านเสริมสวย" <?php if($edit_record['shop_type']=="ร้านเสริมสวย"){echo "selected";}?>>ร้านเสริมสวย</option>
							<option value="ร้านทำเล็บ" <?php if($edit_record['shop_type']=="ร้านทำเล็บ"){echo "selected";}?>>ร้านทำเล็บ	</option>
							<option value="ร้านความงาม" <?php if($edit_record['shop_type']=="ร้านความงาม"){echo "selected";}?>>ร้านความงาม</option>
							<option value="ฟิสเนส" <?php if($edit_record['shop_type']=="ฟิสเนส"){echo "selected";}?>>ฟิสเนส</option>
							<option value="ร้านนวดและสปา" <?php if($edit_record['shop_type']=="ร้านนวดและสปา"){echo "selected";}?>>ร้านนวดและสปา</option>
							<optgroup label="Hotel & Travel">
							<option value="โรงแรม" <?php if($edit_record['shop_type']=="โรงแรม"){echo "selected";}?>>โรงแรม</option>
							<option value="รีสอร์ท" <?php if($edit_record['shop_type']=="รีสอร์ท"){echo "selected";}?>>รีสอร์ท</option>
							<option value="โฮมสเตย์" <?php if($edit_record['shop_type']=="โฮมสเตย์"){echo "selected";}?>>โฮมสเตย์</option>
							<option value="เรือนำเที่ยว" <?php if($edit_record['shop_type']=="เรือนำเที่ยว"){echo "selected";}?>>เรือนำเที่ยว</option>
							<option value="สถานที่ท่องเที่ยว" <?php if($edit_record['shop_type']=="สถานที่ท่องเที่ยว"){echo "selected";}?>>สถานที่ท่องเที่ยว</option>
							<option value="อพาร์ทเม้นท์" <?php if($edit_record['shop_type']=="อพาร์ทเม้นท์"){echo "selected";}?>>อพาร์ทเม้นท์</option>
							<option value="ทัวร์" <?php if($edit_record['shop_type']=="ทัวร์"){echo "selected";}?>>ทัวร์</option>
							<option value="ฟาร์ม" <?php if($edit_record['shop_type']=="ฟาร์ม"){echo "selected";}?>>ฟาร์ม</option>
							<optgroup label="Shopping & Lifestyle">
							<option value="ร้านเบ็ดเตล็ด" <?php if($edit_record['shop_type']=="ร้านเบ็ดเตล็ด"){echo "selected";}?>>ร้านเบ็ดเตล็ด</option>
							<option value="ร้านของฝาก" <?php if($edit_record['shop_type']=="ร้านของฝาก"){echo "selected";}?>>ร้านของฝาก</option>
							<option value="โรงเรียน" <?php if($edit_record['shop_type']=="โรงเรียน"){echo "selected";}?>>โรงเรียน</option>
							<option value="ร้านเสื้อผ้า" <?php if($edit_record['shop_type']=="ร้านเสื้อผ้า"){echo "selected";}?>>ร้านเสื้อผ้า</option>
							<option value="ร้านเวดดิ้ง" <?php if($edit_record['shop_type']=="ร้านเวดดิ้ง"){echo "selected";}?>>ร้านเวดดิ้ง</option>
							<option value="ร้านสัตว์เลี้ยง" <?php if($edit_record['shop_type']=="ร้านสัตว์เลี้ยง"){echo "selected";}?>>ร้านสัตว์เลี้ยง</option>
							<option value="คาร์แคร์" <?php if($edit_record['shop_type']=="คาร์แคร์"){echo "selected";}?>>คาร์แคร์</option>
							<option value="ร้านรองเท้า" <?php if($edit_record['shop_type']=="ร้านรองเท้า"){echo "selected";}?>>ร้านรองเท้า</option>
							<option value="ร้านกระเป๋า" <?php if($edit_record['shop_type']=="ร้านกระเป๋า"){echo "selected";}?>>ร้านกระเป๋า</option>
							<option value="ร้านเครื่องเขียน" <?php if($edit_record['shop_type']=="ร้านเครื่องเขียน"){echo "selected";}?>>ร้านเครื่องเขียน</option>
							<option value="ร้านหนังสือ" <?php if($edit_record['shop_type']=="ร้านหนังสือ"){echo "selected";}?>>ร้านหนังสือ</option>
							<option value="ร้านอิเล็กทรอนิคส์" <?php if($edit_record['shop_type']=="ร้านอิเล็กทรอนิคส์"){echo "selected";}?>>ร้านอิเล็กทรอนิคส์</option>
							<option value="ร้านอุปกรณ์ไอที" <?php if($edit_record['shop_type']=="ร้านอุปกรณ์ไอที"){echo "selected";}?>>ร้านอุปกรณ์ไอที</option>
							<option value="ร้านอุปกรณ์เบเกอรี่" <?php if($edit_record['shop_type']=="ร้านอุปกรณ์เบเกอรี่"){echo "selected";}?>>ร้านอุปกรณ์เบเกอรี่</option>
							<option value="ร้านเครื่องดนตรี" <?php if($edit_record['shop_type']=="ร้านเครื่องดนตรี"){echo "selected";}?>>ร้านเครื่องดนตรี</option>
							<option value="โรงภาพยนต์" <?php if($edit_record['shop_type']=="โรงภาพยนต์"){echo "selected";}?>>โรงภาพยนต์</option>
							<option value="ร้านเครื่องประดับ" <?php if($edit_record['shop_type']=="ร้านเครื่องประดับ"){echo "selected";}?>>ร้านเครื่องประดับ</option>
							<option value="ร้านเฟอร์นิเจอร์" <?php if($edit_record['shop_type']=="ร้านเฟอร์นิเจอร์"){echo "selected";}?>>ร้านเฟอร์นิเจอร์</option>
							<option value="ร้านสินค้าเด็ก" <?php if($edit_record['shop_type']=="ร้านสินค้าเด็ก"){echo "selected";}?>>ร้านสินค้าเด็ก</option>
							<option value="ร้านผลิตภัณฑ์ความงาม" <?php if($edit_record['shop_type']=="ร้านผลิตภัณฑ์ความงาม"){echo "selected";}?>>ร้านผลิตภัณฑ์ความงาม</option>
						</select>
						</td>
                        <td>
                            {{$select_record->special_type}}
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
						<th>ชื่อภาษาไทย<span class="red">*</span></th>
						<th>ชื่อภาษาอังกฤษ<span class="red">*</span></th>
						<th>สาขา<span class="red">*</span></th>
                        <th>จำนวนสาขา<span class="red">*</span></th>
					</tr>
					<tr>
						<td><input type="text" name="name_th" id="name_th" value="{{$edit_record['name_th']}}" class="form-control"/></td>
						<td><input type="text" name="name_en" id="name_en" value="{{$edit_record['name_en']}}" class="form-control"/></td>
						<td><textarea name="branch" id="branch" cols="50" class="form-control">{{$edit_record['branch']}}</textarea></td>
                        <td>
                        <input type="text" name="branch_amount" id="branch_amount" value="{{$edit_record['branch_amount']}}" class="form-control"/>
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
							<textarea name="address" id="address" cols="50" rows="5" class="form-control" >{{$edit_record['address']}}</textarea>
						</td>
						<td>
							<select name="province" id="province" class="selectpicker">
							<option value="empty">กรุณาเลือกจังหวัด</option>
							<?php
								$province_list = Record::province_list();
								foreach($province_list as $province_list_each)
								{
									if($province_list_each==$edit_record['province'])
									{
										echo "<option value='".$province_list_each."' selected>".$province_list_each."</option>";
									}
									else
									{
										echo "<option value='".$province_list_each."'>".$province_list_each."</option>";
									}
								}
							?>
						</select>
						</td>
						<td><textarea name="latitude" id="latitude" value="" class="form-control" rows="5">{{$edit_record['latitude']}}</textarea></td>
						<td><textarea name="longtitude" id="longtitude" value="" class="form-control" rows="5">{{$edit_record['longtitude']}}</textarea></td>
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
							<input type="text" name="contact_person" id="contact_person" value="{{$edit_record['contact_person']}}" size="10" class="form-control" />
						</td>
						<td><input type="text" name="contact_tel" id="contact_tel" value="{{$edit_record['contact_tel']}}" class="form-control" /></td>
						<td><input type="text" name="contact_email" id="contact_email" value="{{$edit_record['contact_email']}}" class="form-control" /></td>
						<td>
                            <textarea name="sending_address" id="sending_address" class="form-control">{{$edit_record['sending_address']}}</textarea>
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
							<input type="text" name="links" id="links" value="{{$edit_record['links']}}" class="form-control" />
						</td>
						<td>
							<input type="text" name="remarks" id="remarks" value="{{$edit_record['remarks']}}" class="form-control" />
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
                                <textarea id="note" name="note" class="form-control">{{$edit_record['note']}}</textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
		</div>
		<hr>
	<div class="row">
		<div class="col-xs-12">
			<a href="#" class="btn btn-primary" id="confirm_btn" onClick="">แก้ไข</a> <a href="{{url('/sale/edit_record/record/show_preview_edit_info')}}" class="btn btn-danger">ยกเลิก</a>
		</div>
	</div>
{{Form::close()}}
</div>
</div>

@endsection