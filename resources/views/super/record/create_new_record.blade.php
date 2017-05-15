@extends('super.layouts.master')
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
<div class="container add-margin-left-right">
	<div class="row">
		<div class="form-group">
		<h1>Create new record</h1>
		{{Form::open(array('action' => 'SuperController@preview_new_record','id'=>'submit_form'))}}
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
					<option value="online_search" >ค้นหากจากเว็บไซต์</option>
					<option value="dtac_recommend" >ร้านแนะนำจาก dtac</option>
					<option value="walking" >Walk in</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>Categories.</label>
				<select name="categories"  class="selectpicker">
					<option value="dinning_and_beverage" >Dining & Beverage</option>
					<option value="shopping_and_lifestyle" >Shopping & Lifestyle</option>
					<option value="beauty_and_healthy" >Beauty & Healthy</option>
					<option value="hotel_and_travel" >Hotel & Travel</option>
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
					<option value="ร้านเบ็ดเตล็ด" >ร้าน เบ็ดเตล็ด</option>
					<option value="ร้านอาหาร" >ร้าน อาหาร</option>
					<option value="ร้านอาหารนานาชาติ" >ร้าน อาหารนานาชาติ</option>
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
				<input class="form-control" type="text" id="longitude" name="longitude" value=""/>
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
		<a class="btn btn-danger" href="{{url('/super/record/list_records')}}" role="button" id="cancel">Cancel</a>
		{{ Form::close() }}
		</div>
	</div>
</div>

@endsection