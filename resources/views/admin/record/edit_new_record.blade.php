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
<div class="container-fluid">
	<div class="row">
		<div class="form-group">
		<h1>Create new record</h1>
		<h3>กรุณาตรวจทานข้อมูลก่อนยืนยัน</h3>
		{{Form::open(array('action' => 'AdminController@preview_new_record','id'=>'submit_form'))}}
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-2">
				<label>No.</label>
				<input class="form-control" type="text" id="no" name="no" value="{{$record['no']}}"/>
			</div>
			<div class="col-xs-2">
				<label>Code.</label>
				<input class="form-control" type="text" id="code" name="code" value="{{$record['code']}}"/>
			</div>
			<div class="col-xs-3">
				<label>Status.</label>
				<select name="status"  class="selectpicker">
					<option value="Available" <?php if($record['status']=="Available"){echo "selected";}?>>Available</option>
					<option value="Not_available" <?php if($record['status']=="Not_available"){echo "selected";}?>>Not Available</option>
				</select>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-2">
				<label>Sources.</label>
				<select name="sources"  class="selectpicker">
					<option value="online_search" <?php if($record['sources']=="online_search"){echo "selected";}?>>Online Search</option>
					<option value="dtac_recommend" <?php if($record['sources']=="dtac_recommend"){echo "selected";}?>>DTAC Recommend</option>
					<option value="walking" <?php if($record['sources']=="walking"){echo "selected";}?>>Walking</option>
				</select>
			</div>
			<div class="col-xs-2">
				<label>Categories.</label>
				<select name="categories"  class="selectpicker">
					<option value="dinning_and_beverage" <?php if($record['categories']=="dinning_and_beverage"){echo "selected";}?>>Dining & Beverage</option>
					<option value="shopping_and_lifestyle" <?php if($record['categories']=="shopping_and_lifestyle"){echo "selected";}?>>Shopping & Lifestyle</option>
					<option value="beauty_and_healthy" <?php if($record['categories']=="beauty_and_healthy"){echo "selected";}?>>Beauty & Healthy</option>
					<option value="hotel_and_travel" <?php if($record['categories']=="hotel_and_travel"){echo "selected";}?>>Hotel & Travel</option>
					<option value="online" <?php if($record['categories']=="dinning_and_beverage"){echo "selected";}?>>Online</option>
				</select>
			</div>
			<div class="col-xs-2">
				<label>Dtac Type.</label>
				<select name="dtac_type"  class="selectpicker">
					<option value="ร้านกทม" <?php if($record['dtac_type']=="ร้านกทม"){echo "selected";}?>>ร้าน กทม</option>
					<option value="ร้านตจว" <?php if($record['dtac_type']=="ร้านตจว"){echo "selected";}?>>ร้าน ตจว</option>
					<option value="ร้านonline" <?php if($record['dtac_type']=="ร้านonline"){echo "selected";}?>>ร้าน online</option>
					<option value="ร้านต่ออายุ" <?php if($record['dtac_type']=="ร้านต่ออายุ"){echo "selected";}?>>ร้านต่ออายุ</option>
					<option value="ร้านดีลอย่างเดียว" <?php if($record['dtac_type']=="ร้านดีลอย่างเดียว"){echo "selected";}?>>ร้านดีลอย่างเดียว</option>
					<option value="ร้านเฉพาะอาร์ทเวิร์ค" <?php if($record['dtac_type']=="ร้านเฉพาะอาร์ทเวิร์ค"){echo "selected";}?>>ร้านเฉพาะอาร์ทเวิร์ค</option>
				</select>
			</div>
			<div class="col-xs-2">
				<label>ประเภทร้าน.</label>
				<select name="shop_type"  class="selectpicker">
					<optgroup label="Dining">
					<option value="ร้านอาหาร" <?php if($record['shop_type']=="ร้านอาหาร"){echo "selected";}?>>ร้านอาหาร</option>
					<option value="ร้านเครื่องดื่ม" <?php if($record['shop_type']=="ร้านเครื่องดื่ม"){echo "selected";}?>>ร้านเครื่องดื่ม</option>
					<option value="ร้านกาแฟ" <?php if($record['shop_type']=="ร้านกาแฟ"){echo "selected";}?>>ร้านกาแฟ</option>
					<option value="ร้านเบเกอรี่" <?php if($record['shop_type']=="ร้านเบเกอรี่"){echo "selected";}?>>ร้านเบเกอรี่</option>
					<option value="ผับ (ร้านอาหารและเครื่องดื่ม)" <?php if($record['shop_type']=="ผับ (ร้านอาหารและเครื่องดื่ม)"){echo "selected";}?>>ผับ (ร้านอาหารและเครื่องดื่ม)</option>
					<option value="ร้านขนมหวาน" <?php if($record['shop_type']=="ร้านขนมหวาน"){echo "selected";}?>>ร้านขนมหวาน</option>
					<option value="ร้านเครื่องดื่มและเบเกอรี่" <?php if($record['shop_type']=="ร้านเครื่องดื่มและเบเกอรี่"){echo "selected";}?>>ร้านเครื่องดื่มและเบเกอรี่</option>
					<option value="ร้านอาหารและเบเกอรี่" <?php if($record['shop_type']=="ร้านอาหารและเบเกอรี่"){echo "selected";}?>>ร้านอาหารและเบเกอรี่</option>
					<option value="ร้านไอศครีม" <?php if($record['shop_type']=="ร้านไอศครีม"){echo "selected";}?>>ร้านไอศครีม</option>
					<option value="ร้านเพื่อสุขภาพ" <?php if($record['shop_type']=="ร้านเพื่อสุขภาพ"){echo "selected";}?>>ร้านเพื่อสุขภาพ</option>
					<option value="ร้านบุฟเฟ่ต์" <?php if($record['shop_type']=="ร้านบุฟเฟ่ต์"){echo "selected";}?>>ร้านบุฟเฟ่ต์</option>
					<option value="โต๊ะจีน" <?php if($record['shop_type']=="โต๊ะจีน"){echo "selected";}?>>โต๊ะจีน</option>
					<optgroup label="Beauty & Healty">
					<option value="ร้านสปา" <?php if($record['shop_type']=="ร้านสปา"){echo "selected";}?>>ร้านสปา</option>
					<option value="ร้านนวด" <?php if($record['shop_type']=="ร้านนวด"){echo "selected";}?>>ร้านนวด</option>
					<option value="ร้านเสริมสวย" <?php if($record['shop_type']=="ร้านเสริมสวย"){echo "selected";}?>>ร้านเสริมสวย</option>
					<option value="ร้านทำเล็บ" <?php if($record['shop_type']=="ร้านทำเล็บ"){echo "selected";}?>>ร้านทำเล็บ	</option>
					<option value="ร้านความงาม" <?php if($record['shop_type']=="ร้านความงาม"){echo "selected";}?>>ร้านความงาม</option>
					<option value="ฟิสเนส" <?php if($record['shop_type']=="ฟิสเนส"){echo "selected";}?>>ฟิสเนส</option>
					<option value="ร้านนวดและสปา" <?php if($record['shop_type']=="ร้านนวดและสปา"){echo "selected";}?>>ร้านนวดและสปา</option>
					<optgroup label="Hotel & Travel">
					<option value="โรงแรม" <?php if($record['shop_type']=="โรงแรม"){echo "selected";}?>>โรงแรม</option>
					<option value="รีสอร์ท" <?php if($record['shop_type']=="รีสอร์ท"){echo "selected";}?>>รีสอร์ท</option>
					<option value="โฮมสเตย์" <?php if($record['shop_type']=="โฮมสเตย์"){echo "selected";}?>>โฮมสเตย์</option>
					<option value="เรือนำเที่ยว" <?php if($record['shop_type']=="เรือนำเที่ยว"){echo "selected";}?>>เรือนำเที่ยว</option>
					<option value="สถานที่ท่องเที่ยว" <?php if($record['shop_type']=="สถานที่ท่องเที่ยว"){echo "selected";}?>>สถานที่ท่องเที่ยว</option>
					<option value="อพาร์ทเม้นท์" <?php if($record['shop_type']=="อพาร์ทเม้นท์"){echo "selected";}?>>อพาร์ทเม้นท์</option>
					<option value="ทัวร์" <?php if($record['shop_type']=="ทัวร์"){echo "selected";}?>>ทัวร์</option>
					<option value="ฟาร์ม" <?php if($record['shop_type']=="ฟาร์ม"){echo "selected";}?>>ฟาร์ม</option>
					<optgroup label="Shopping & Lifestyle">
					<option value="ร้านเบ็ดเตล็ด" <?php if($record['shop_type']=="ร้านเบ็ดเตล็ด"){echo "selected";}?>>ร้านเบ็ดเตล็ด</option>
					<option value="ร้านของฝาก" <?php if($record['shop_type']=="ร้านของฝาก"){echo "selected";}?>>ร้านของฝาก</option>
					<option value="โรงเรียน" <?php if($record['shop_type']=="โรงเรียน"){echo "selected";}?>>โรงเรียน</option>
					<option value="ร้านเสื้อผ้า" <?php if($record['shop_type']=="ร้านเสื้อผ้า"){echo "selected";}?>>ร้านเสื้อผ้า</option>
					<option value="ร้านเวดดิ้ง" <?php if($record['shop_type']=="ร้านเวดดิ้ง"){echo "selected";}?>>ร้านเวดดิ้ง</option>
					<option value="ร้านสัตว์เลี้ยง" <?php if($record['shop_type']=="ร้านสัตว์เลี้ยง"){echo "selected";}?>>ร้านสัตว์เลี้ยง</option>
					<option value="คาร์แคร์" <?php if($record['shop_type']=="คาร์แคร์"){echo "selected";}?>>คาร์แคร์</option>
					<option value="ร้านรองเท้า" <?php if($record['shop_type']=="ร้านรองเท้า"){echo "selected";}?>>ร้านรองเท้า</option>
					<option value="ร้านกระเป๋า" <?php if($record['shop_type']=="ร้านกระเป๋า"){echo "selected";}?>>ร้านกระเป๋า</option>
					<option value="ร้านเครื่องเขียน" <?php if($record['shop_type']=="ร้านเครื่องเขียน"){echo "selected";}?>>ร้านเครื่องเขียน</option>
					<option value="ร้านหนังสือ" <?php if($record['shop_type']=="ร้านหนังสือ"){echo "selected";}?>>ร้านหนังสือ</option>
					<option value="ร้านอิเล็กทรอนิคส์" <?php if($record['shop_type']=="ร้านอิเล็กทรอนิคส์"){echo "selected";}?>>ร้านอิเล็กทรอนิคส์</option>
					<option value="ร้านอุปกรณ์ไอที" <?php if($record['shop_type']=="ร้านอุปกรณ์ไอที"){echo "selected";}?>>ร้านอุปกรณ์ไอที</option>
					<option value="ร้านอุปกรณ์เบเกอรี่" <?php if($record['shop_type']=="ร้านอุปกรณ์เบเกอรี่"){echo "selected";}?>>ร้านอุปกรณ์เบเกอรี่</option>
					<option value="ร้านเครื่องดนตรี" <?php if($record['shop_type']=="ร้านเครื่องดนตรี"){echo "selected";}?>>ร้านเครื่องดนตรี</option>
					<option value="โรงภาพยนต์" <?php if($record['shop_type']=="โรงภาพยนต์"){echo "selected";}?>>โรงภาพยนต์</option>
					<option value="ร้านเครื่องประดับ" <?php if($record['shop_type']=="ร้านเครื่องประดับ"){echo "selected";}?>>ร้านเครื่องประดับ</option>
					<option value="ร้านเฟอร์นิเจอร์" <?php if($record['shop_type']=="ร้านเฟอร์นิเจอร์"){echo "selected";}?>>ร้านเฟอร์นิเจอร์</option>
					<option value="ร้านสินค้าเด็ก" <?php if($record['shop_type']=="ร้านสินค้าเด็ก"){echo "selected";}?>>ร้านสินค้าเด็ก</option>
					<option value="ร้านผลิตภัณฑ์ความงาม" <?php if($record['shop_type']=="ร้านผลิตภัณฑ์ความงาม"){echo "selected";}?>>ร้านผลิตภัณฑ์ความงาม</option>
				</select>
			</div>
		</div>
		<div class="col-xs-4">
			<input class="form-control" type="text" name="special_type" id="special_type" value="" />
		</div>>
		<div class="row">
			<div class="col-xs-4">
				<label>Name Thai.</label>
				<input class="form-control" type="text" id="name_th" name="name_th" value="{{$record['name_th']}}"/>
			</div>
			<div class="col-xs-4">
				<label>Name English.</label>
				<input class="form-control" type="text" id="name_en" name="name_en" value="{{$record['name_en']}}"/>
			</div>
			<div class="col-xs-4">
				<label>สาขา.</label>
				<input class="form-control" type="text" id="branch" name="branch" value="{{$record['branch']}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ที่อยู่.</label>
				<input class="form-control" type="text" id="address" name="address" value="{{$record['address']}}"/>
			</div>
			<div class="col-xs-6">
				<label>จังหวัด.</label>
				<input class="form-control" type="text" id="province" name="province" value="{{$record['province']}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ละติจูด.</label>
				<input class="form-control" type="text" id="latitude" name="latitude" value="{{$record['latitude']}}"/>
			</div>
			<div class="col-xs-6">
				<label>ลองติจูด.</label>
				<input class="form-control" type="text" id="longtitude" name="longtitude" value="{{$record['longtitude']}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Contact Person.</label>
				<input class="form-control" type="text" id="contact_person" name="contact_person" value="{{$record['contact_person']}}"/>
			</div>
			<div class="col-xs-4">
				<label>Contact Telephone number.</label>
				<input class="form-control" type="text" id="contact_tel" name="contact_tel" value="{{$record['contact_tel']}}"/>
			</div>
			<div class="col-xs-4">
				<label>Contact Email.</label>
				<input class="form-control" type="text" id="contact_email" name="contact_email" value="{{$record['contact_email']}}"/>
			</div>
			<div class="col-xs-4">
				<label>Contact Date [ วัน / เดือน / ปี ]</label>
				<div class="row">
					<div class="col-xs-4">
						<div class="input-group">
							<b>วัน</b>
							<input class="form-control" type="text" id="contact_day" name="contact_day" value="{{$record['contact_day']}}"/>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<b>เดือน</b>
							<input class="form-control" type="text" id="contact_month" name="contact_month" value="{{$record['contact_month']}}"/>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<b>ปี</b>
							<input class="form-control" type="text" id="contact_year" name="contact_year" value="{{$record['contact_year']}}" />
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Link.</label>
				<input class="form-control" type="text" id="links" name="links" value="{{$record['links']}}"/>
			</div>
			<div class="col-xs-6">
				<label>Remarks.</label>
				<input class="form-control" type="text" id="remarks" name="remarks" value="{{$record['remarks']}}"/>
			</div>
		</div>
		<br />
		<a class="btn btn-success" href="#" role="button" id="confirm_btn">Submit</a>
		<a class="btn btn-danger" href="{{ url('admin/record/create_new_record') }}" role="button" id="cancel_btn">Cancel</a>
		{{ Form::close() }}
		</div>
	</div>
</div>

@endsection