@extends('admin.layouts.master')
@section('js_files')

<script>

  $(document).ready(function(){

    $("#confirm_btn").click(function(){
        $("#submit_form").submit();

    });

  });

</script>
@stop
@section('content')
<?php
use App\Record;
?>
<!-- Services Section -->
<div class="container">
	<div class="row">
		<div class="form-group">
		<h1>สร้าง Lead ร้านค้าใหม่</h1>
		{{Form::open(array('action' => 'AdminController@preview_new_record','id'=>'submit_form'))}}
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-2">
				<label>No.</label>
				<input type="hidden" id="id" name="id" value="" />
				<input class="form-control" type="text" id="no" name="no" value=""/>
			</div>
			<div class="col-xs-2">
				<label>Code.</label>
				<input class="form-control" type="text" id="code" name="code" value=""/>
			</div>
			<div class="col-xs-3">
				<label>Status.</label>
				<select name="status"  class="selectpicker">
					<option value="Available" >Available</option>
					<option value="Not_available" >Not Available</option>
				</select>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-3">
				<label>Sources.</label>
				<select name="sources"  class="selectpicker">
					<option value="online_search" >ค้นหาจากเว็บไซจ์</option>
					<option value="dtac_recommend" >ร้านแนะนำจาก dtac</option>
					<option value="walking" >Walk in</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>Categories.</label>
				<select name="categories"  class="selectpicker">
					<option value="dinning_and_beverage" >Dining and Beverage</option>
					<option value="shopping_and_lifestyle" >Shopping and Lifestyle</option>
					<option value="beauty_and_healthy" >Beauty and Healthy</option>
					<option value="hotel_and_travel" >Hotel and Travel</option>
					<option value="online" >Online</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>Dtac Type.</label>
				<select name="dtac_type"  class="selectpicker">
					<option value="กทม./นนทบุรี/สมุทรปราการ" >กทม./นนทบุรี/สมุทรปราการ</option>
					<option value="ต่างจังหวัด" >ต่างจังหวัด</option>
					<option value="dtacแนะนำ" >dtac แนะนำ</option>
					<option value="online" >online</option>
					<option value="ต่ออายุ" >ต่ออายุ</option>
					<option value="ดีลอย่างเดียว" >ดีลอย่างเดียว</option>
					<option value="เฉพาะอาร์ทเวิร์ค" >เฉพาะอาร์ทเวิร์ค</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>ประเภทร้าน.</label>
				<select name="shop_type"  class="selectpicker">
					<option value="empty">กรุณาเลือก</option>
					<optgroup label="Dining">
					<option value="ร้านอาหาร">ร้านอาหาร</option>
					<option value="ร้านเครื่องดื่ม">ร้านเครื่องดื่ม</option>
					<option value="ร้านกาแฟ">ร้านกาแฟ</option>
					<option value="ร้านเบเกอรี่">ร้านเบเกอรี่</option>
					<option value="ผับ (ร้านอาหารและเครื่องดื่ม)">ผับ (ร้านอาหารและเครื่องดื่ม)</option>
					<option value="ร้านขนมหวาน">ร้านขนมหวาน</option>
					<option value="ร้านเครื่องดื่มและเบเกอรี่">ร้านเครื่องดื่มและเบเกอรี่</option>
					<option value="ร้านอาหารและเบเกอรี่">ร้านอาหารและเบเกอรี่</option>
					<option value="ร้านไอศครีม">ร้านไอศครีม</option>
					<option value="ร้านเพื่อสุขภาพ">ร้านเพื่อสุขภาพ</option>
					<option value="ร้านบุฟเฟ่ต์">ร้านบุฟเฟ่ต์</option>
					<option value="โต๊ะจีน">โต๊ะจีน</option>
					<optgroup label="Beauty & Healty">
					<option value="ร้านสปา">ร้านสปา</option>
					<option value="ร้านนวด">ร้านนวด</option>
					<option value="ร้านเสริมสวย">ร้านเสริมสวย</option>
					<option value="ร้านทำเล็บ">ร้านทำเล็บ	</option>
					<option value="ร้านความงาม">ร้านความงาม</option>
					<option value="ฟิสเนส">ฟิสเนส</option>
					<option value="ร้านนวดและสปา">ร้านนวดและสปา</option>
					<optgroup label="Hotel & Travel">
					<option value="โรงแรม">โรงแรม</option>
					<option value="รีสอร์ท">รีสอร์ท</option>
					<option value="โฮมสเตย์">โฮมสเตย์</option>
					<option value="เรือนำเที่ยว">เรือนำเที่ยว</option>
					<option value="สถานที่ท่องเที่ยว">สถานที่ท่องเที่ยว</option>
					<option value="อพาร์ทเม้นท์">อพาร์ทเม้นท์</option>
					<option value="ทัวร์">ทัวร์</option>
					<option value="ฟาร์ม">ฟาร์ม</option>
					<optgroup label="Shopping & Lifestyle">
					<option value="ร้านเบ็ดเตล็ด">ร้านเบ็ดเตล็ด</option>
					<option value="ร้านของฝาก">ร้านของฝาก</option>
					<option value="โรงเรียน">โรงเรียน</option>
					<option value="ร้านเสื้อผ้า">ร้านเสื้อผ้า</option>
					<option value="ร้านเวดดิ้ง">ร้านเวดดิ้ง</option>
					<option value="ร้านสัตว์เลี้ยง">ร้านสัตว์เลี้ยง</option>
					<option value="คาร์แคร์">คาร์แคร์</option>
					<option value="ร้านรองเท้า">ร้านรองเท้า</option>
					<option value="ร้านกระเป๋า">ร้านกระเป๋า</option>
					<option value="ร้านเครื่องเขียน">ร้านเครื่องเขียน</option>
					<option value="ร้านหนังสือ">ร้านหนังสือ</option>
					<option value="ร้านอิเล็กทรอนิคส์">ร้านอิเล็กทรอนิคส์</option>
					<option value="ร้านอุปกรณ์ไอที">ร้านอุปกรณ์ไอที</option>
					<option value="ร้านอุปกรณ์เบเกอรี่">ร้านอุปกรณ์เบเกอรี่</option>
					<option value="ร้านเครื่องดนตรี">ร้านเครื่องดนตรี</option>
					<option value="โรงภาพยนต์">โรงภาพยนต์</option>
					<option value="ร้านเครื่องประดับ">ร้านเครื่องประดับ</option>
					<option value="ร้านเฟอร์นิเจอร์">ร้านเฟอร์นิเจอร์</option>
					<option value="ร้านสินค้าเด็ก">ร้านสินค้าเด็ก</option>
					<option value="ร้านผลิตภัณฑ์ความงาม">ร้านผลิตภัณฑ์ความงาม</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Name Thai.</label>
				<input class="form-control" type="text" id="name_th" name="name_th" value=""/>
			</div>
			<div class="col-xs-4">
				<label>Name English.</label>
				<input class="form-control" type="text" id="name_en" name="name_en" value=""/>
			</div>
			<div class="col-xs-4">
				<label>สาขา.</label>
				<input class="form-control" type="text" id="branch" name="branch" value=""/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ที่อยู่.</label>
				<input class="form-control" type="text" id="address" name="address" value=""/>
			</div>
			<div class="col-xs-6">
				<label>จังหวัด.</label>
				<input class="form-control" type="text" id="province" name="province" value=""/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ละติจูด.</label>
				<input class="form-control" type="text" id="latitude" name="latitude" value=""/>
			</div>
			<div class="col-xs-6">
				<label>ลองติจูด.</label>
				<input class="form-control" type="text" id="longtitude" name="longtitude" value=""/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Contact Person.</label>
				<input class="form-control" type="text" id="contact_person" name="contact_person" value=""/>
			</div>
			<div class="col-xs-4">
				<label>Contact Telephone number.</label>
				<input class="form-control" type="text" id="contact_tel" name="contact_tel" value=""/>
			</div>
			<div class="col-xs-4">
				<label>Contact Email.</label>
				<input class="form-control" type="text" id="contact_email" name="contact_email" value=""/>
			</div>
			<div class="col-xs-4">
				<label>Contact Date [ วัน / เดือน / ปี ]</label>
				<div class="row">
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">วัน</span>
							<input class="form-control" type="text" id="contact_day" name="contact_day" value=""/>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">เดือน</span>
							<input class="form-control" type="text" id="contact_month" name="contact_month" value=""/>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">ปี</span>
							<input class="form-control" type="text" id="contact_year" name="contact_year" value=""
							/>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Link.</label>
				<input class="form-control" type="text" id="links" name="links" value=""/>
			</div>
			<div class="col-xs-6">
				<label>Remarks.</label>
				<input class="form-control" type="text" id="remarks" name="remarks" value=""/>
			</div>
		</div>
		<br />
		<a class="btn btn-primary" href="#" role="button" id="confirm_btn">Submit</a>
		<a class="btn btn-danger" href="{{url('/admin/record/list_records')}}" role="button" id="cancel">Cancel</a>
		{{ Form::close() }}
		</div>
	</div>
</div>

@endsection